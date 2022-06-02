<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\Installer;

class com_sppagebuilderInstallerScript
{

    /**
    * method to uninstall the component
    *
    * @return void
    */

    public function uninstall($parent)
    {
        $db = Factory::getDBO();
        $status = new stdClass;
        $status->modules = array();
        $manifest = $parent->getParent()->manifest;

        // Uninstall Plugins
        $plugins = $manifest->xpath('plugins/plugin');

        foreach ($plugins as $plugin)
        {
            $name = (string)$plugin->attributes()->name;
            $group = (string)$plugin->attributes()->group;

            $db = Factory::getDbo();
            $query = $db->getQuery(true);
            $query->select($db->quoteName(array('extension_id')));
            $query->from($db->quoteName('#__extensions'));
            $query->where($db->quoteName('type') . ' = '. $db->quote('plugin'));
            $query->where($db->quoteName('element') . ' = '. $db->quote($name));
            $query->where($db->quoteName('folder') . ' = '. $db->quote($group));
            $db->setQuery($query);
            $extensions = $db->loadColumn();

            if (count((array) $extensions))
            {
                foreach ($extensions as $id)
                {
                    $installer = new Installer;
                    $result = $installer->uninstall('plugin', $id);
                }
                $status->plugins[] = array('name' => $name, 'result' => $result);
            }
        }

        // Uninstall Modules
        $modules = $manifest->xpath('modules/module');
        foreach ($modules as $module)
        {
            $name = (string)$module->attributes()->module;
            $client = (string)$module->attributes()->client;

            $db = Factory::getDBO();
            $query = $db->getQuery(true);
            $query->select($db->qn('extension_id'));
            $query->from($db->qn('#__extensions'));
            $query->where($db->qn('type') . ' = ' . $db->q('module'));
            $query->andWhere($db->qn('element') . ' = ' . $db->q($name));
            $db->setQuery($query);
            $extensions = $db->loadColumn();

            if (count((array) $extensions))
            {
                foreach ($extensions as $id)
                {
                    $installer = new Installer;
                    $result = $installer->uninstall('module', $id);
                }
                $status->modules[] = array('name' => $name, 'client' => $client, 'result' => $result);
            }
        }
    }

    /**
    * method to run after an install/update/uninstall method
    *
    * @return void
    */

    public function postflight($type, $parent)
    {
        if ($type == 'uninstall')
        {
            return true;
        }

        $db = Factory::getDbo();
        $status = new stdClass;
        $status->modules = array();
        $src = $parent->getParent()->getPath('source');
        $manifest = $parent->getParent()->manifest;

        // Install Plugins
        $plugins = $manifest->xpath('plugins/plugin');
        foreach ($plugins as $plugin)
        {
            $name = (string)$plugin->attributes()->name;
            $group = (string)$plugin->attributes()->group;
            $activate = (string)$plugin->attributes()->activate;
            $path = $src . '/plugins/' . $group . '/' . $name;

            $installer = new Installer;
            $result = $installer->install($path);

            if ($result && $activate == "true")
            {
                $db = Factory::getDbo();
                $query = $db->getQuery(true);
                $fields = array( $db->quoteName('enabled') . ' = 1' );

                $conditions = array(
                    $db->quoteName('type') . ' = ' . $db->quote('plugin'),
                    $db->quoteName('element') . ' = ' . $db->quote($name),
                    $db->quoteName('folder') . ' = ' . $db->quote($group)
                );

                $query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);
                $db->setQuery($query);
                $db->execute();
            }
        }

        // Install Modules
        $modules = $manifest->xpath('modules/module');
        foreach ($modules as $module)
        {
            $name = (string)$module->attributes()->module;
            $client = (string)$module->attributes()->client;
            $path = $src . '/modules/' . $client . '/' . $name;
            
            $activate = (string)$module->attributes()->activate;
            $position = (isset($module->attributes()->position) && $module->attributes()->position) ? (string)$module->attributes()->position : '';
            $ordering = (isset($module->attributes()->ordering) && $module->attributes()->ordering) ? (string)$module->attributes()->ordering : 0;
            $platform = (isset($module->attributes()->platform) && $module->attributes()->platform) ? (string)$module->attributes()->platform : 'universal';

            if ($platform == 'joomla3' && JVERSION >= 4)
            {
                return;
            }
            
            $installer = new Installer;
            $result = $installer->install($path);

            if($client == 'administrator')
            {
                $db = Factory::getDbo();
                $query = $db->getQuery(true);
                $fields = array();

                $fields[] = $db->quoteName('published') . ' = 1';

                if ($position)
                {
                    $fields[] = $db->quoteName('position') . ' = ' . $db->quote($position);
                }

                if ($ordering)
                {
                    $fields[] = $db->quoteName('ordering') . ' = ' . $db->quote($ordering);
                }

                $conditions = [
                    $db->quoteName('module') . ' = ' . $db->quote($name)
                ];

                $query->update($db->quoteName('#__modules'))->set($fields)->where($conditions);
                $db->setQuery($query);
                $db->execute();

                // Retrieve ID
                $db = Factory::getDbo();
                $query = $db->getQuery(true);
                $query->select($db->quoteName('id'));
                $query->from($db->quoteName('#__modules'));
                $query->where($db->quoteName('module') . ' = ' . $db->quote($name));
                $db->setQuery($query);
                $id = (int) $db->loadResult();
                
                if ($id)
                {
                    $db = Factory::getDbo();
                    $db->getQuery(true);
                    $db->setQuery("INSERT IGNORE INTO #__modules_menu (`moduleid`,`menuid`) VALUES (".$id.", 0)");
                    $db->execute();
                }
            }
        }
    }
}
