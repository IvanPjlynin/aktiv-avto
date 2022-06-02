<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Plugin\PluginHelper;

JLoader::register('SppagebuilderHelperIntegrations', JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/integrations.php');
class SppagebuilderModelIntegrations extends BaseDatabaseModel
{

	public function toggle($group = '', $name = '')
	{

		$db = Factory::getDbo();
		$integrations = SppagebuilderHelperIntegrations::integrations();

		if(isset($integrations[$group]))
		{
			$enabled = PluginHelper::isEnabled($group, $name);
			$status = $enabled ? 0 : 1;

			$db = Factory::getDbo();
			$query = $db->getQuery(true);
			$fields = array($db->quoteName('enabled') . ' = ' . $status);

			$conditions = array(
				$db->quoteName('type') . ' = ' . $db->quote('plugin'),
				$db->quoteName('element') . ' = ' . $db->quote($name),
				$db->quoteName('folder') . ' = ' . $db->quote($group)
			);

			$query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$db->execute();

			return $status;
		}
		else
		{
			return false;
		}
	}
}
