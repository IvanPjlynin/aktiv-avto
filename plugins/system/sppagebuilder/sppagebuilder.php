<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('restricted access');

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Uri\Uri;

JLoader::register('SppagebuilderHelper', JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/sppagebuilder.php');
JLoader::register('SppagebuilderHelperIntegrations', JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/integrations.php');

class  plgSystemSppagebuilder extends JPlugin
{

  protected $autoloadLanguage = true;

  function onBeforeRender()
  {
    $app = Factory::getApplication();
    if ($app->isClient('administrator')) {
      $integration = self::getIntegration();

      if (!$integration) {
        return;
      }

      $input = $app->input;
      $option = $input->get('option', '', 'STRING');
      $view = $input->get('view', '', 'STRING');
      $layout = $input->get('layout', '', 'STRING');

      if (!($option == 'com_' . $integration['group'] && $view == $integration['view'])) {
        return;
      }

      // Get ID
      $id = $input->get($integration['id_alias'], 0, 'INT');

      require_once JPATH_ROOT . '/administrator/components/com_sppagebuilder/builder/classes/base.php';
      require_once JPATH_ROOT . '/administrator/components/com_sppagebuilder/builder/classes/config.php';

      self::loadPageBuilderLanguage();

      SppagebuilderHelper::loadAssets('css');
      SppagebuilderHelper::addStylesheet('react-select.css');

      $doc = Factory::getDocument();
      $params = ComponentHelper::getParams('com_sppagebuilder');

      HTMLHelper::_('jquery.framework');
      $doc->addScript(Uri::root(true) . '/plugins/system/sppagebuilder/assets/js/init.js?' . SppagebuilderHelper::getVersion(true));

      //SppagebuilderHelper::loadEditor();
      if (JVERSION < 4) {
        $doc->addScriptdeclaration('var tinyTheme="modern";');
      } else {
        $doc->addScriptdeclaration('var tinyTheme="silver";');
        $doc->addStyledeclaration('.tox-tinymce-aux {z-index: 130012 !important;}');
      }

      $doc->addScript(Uri::base(true) . '/components/com_sppagebuilder/assets/js/script.js?' . SppagebuilderHelper::getVersion(true));
      $doc->addScriptdeclaration('var pagebuilder_base="' . Uri::root() . '";');

      // Addon List Initialize
      SpPgaeBuilderBase::loadAddons();
      $fa_icon_list     = SpPgaeBuilderBase::getIconList(); // Icon List
      $animateNames     = SpPgaeBuilderBase::getAnimationsList(); // Animation Names
      $accessLevels     = SpPgaeBuilderBase::getAccessLevelList(); // Access Levels
      $article_cats     = SpPgaeBuilderBase::getArticleCategories(); // Article Categories
      $moduleAttr       = SpPgaeBuilderBase::getModuleAttributes(); // Module Postions and Module Lits
      $rowSettings      = SpPgaeBuilderBase::getRowGlobalSettings(); // Row Settings Attributes
      $columnSettings   = SpPgaeBuilderBase::getColumnGlobalSettings(); // Column Settings Attributes
      $global_attributes = SpPgaeBuilderBase::addonOptions();

      // Addon List
      $addons_list    = SpAddonsConfig::$addons;
      $globalDefault = SpPgaeBuilderBase::getSettingsDefaultValue($global_attributes);

      PluginHelper::importPlugin('system');

      foreach ($addons_list as $key => &$addon) {
        $new_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($addon['attr']);
        $addon['default'] = array_merge($new_default_value['default'], $globalDefault['default']);

        if (JVERSION < 4) {
          $dispatcher = JDispatcher::getInstance();
          $results = $dispatcher->trigger('onBeforeAddonConfigure', array($key, &$addon));
        } else {
          $results = Factory::getApplication()->triggerEvent('onBeforeAddonConfigure', array($key, &$addon));
        }
      }

      $row_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($rowSettings['attr']);
      $rowSettings['default'] = $row_default_value;

      $column_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($columnSettings['attr']);
      $columnSettings['default'] = $column_default_value;

      $doc->addScriptdeclaration('var useGoogleFonts = ' . $params->get('google_fonts', 0) . ';');
      $doc->addScriptdeclaration('var addonsJSON=' . json_encode($addons_list) . ';');

      // Addon Categories
      $addon_cats = SpPgaeBuilderBase::getAddonCategories($addons_list);
      $doc->addScriptdeclaration('var addonCats=' . json_encode($addon_cats) . ';');

      // Global Attributes
      $doc->addScriptdeclaration('var globalAttr=' . json_encode($global_attributes) . ';');
      $doc->addScriptdeclaration('var faIconList=' . json_encode($fa_icon_list) . ';');
      $doc->addScriptdeclaration('var animateNames=' . json_encode($animateNames) . ';');
      $doc->addScriptdeclaration('var accessLevels=' . json_encode($accessLevels) . ';');
      $doc->addScriptdeclaration('var articleCats=' . json_encode($article_cats) . ';');
      $doc->addScriptdeclaration('var moduleAttr=' . json_encode($moduleAttr) . ';');
      $doc->addScriptdeclaration('var rowSettings=' . json_encode($rowSettings) . ';');
      $doc->addScriptdeclaration('var colSettings=' . json_encode($columnSettings) . ';');
      // Media
      $mediaParams = ComponentHelper::getParams('com_media');
      $doc->addScriptdeclaration('var sppbMediaPath=\'/' . $mediaParams->get('file_path', 'images') . '\';');

      // Retrieve content
      $pagebuilder_enbaled = 0;
      $initialState = '[]';

      if ($page_content = self::getPageContent($option, $view, $id)) {
        $pagebuilder_enbaled = $page_content->active;

        if (($page_content->text != '') && ($page_content->text != '[]')) {
          $initialState = $page_content->text;
        }
      }

      $integration_element = '.adminform';

      if ($option == 'com_content') {
        $integration_element = '.adminform';
      } else if ($option == 'com_k2') {
        $integration_element = '.k2ItemFormEditor';
      }

      $doc->addScriptdeclaration('var spIntergationElement="' . $integration_element . '";');
      $doc->addScriptdeclaration('var spPagebuilderEnabled=' . $pagebuilder_enbaled . ';');
      $doc->addScriptdeclaration('var initialState=' . $initialState . ';');
    } else {
      $input  = $app->input;
      $option = $input->get('option', '', 'STRING');
      $view   = $input->get('view', '', 'STRING');
      $task   = $input->get('task', '', 'STRING');
      $id     = $input->get('id', 0, 'INT');
      $pageName = '';

      if ($option == 'com_content' && $view == 'article') {
        $pageName = "{$view}-{$id}.css";
      } elseif ($option == 'com_j2store' && $view == 'products' && $task == 'view') {
        $pageName = "article-{$id}.css";
      } elseif ($option == 'com_k2' && $view == 'item') {
        $pageName = "item-{$id}.css";
      } elseif ($option == 'com_sppagebuilder' && $view == 'page') {
        $pageName = "{$view}-{$id}.css";
      }

      $file_path  = JPATH_ROOT . '/media/sppagebuilder/css/' . $pageName;
      $file_url   = Uri::base(true) . '/media/sppagebuilder/css/' . $pageName;
      if (file_exists($file_path)) {
        $doc = Factory::getDocument();
        $doc->addStyleSheet($file_url);
      }
    }
  }


  function onAfterRender()
  {
    $app = Factory::getApplication();

    if ($app->isClient('administrator')) {
      $integration = self::getIntegration();

      if (!$integration) {
        return;
      }

      $input = $app->input;
      $option = $input->get('option', '', 'STRING');
      $view = $input->get('view', '', 'STRING');
      $layout = $input->get('layout', '', 'STRING');
      $id = $input->get($integration['id_alias'], 0, 'INT');

      if (!($option == 'com_' . $integration['group'] && $view == $integration['view'])) {
        return;
      }

      if (isset($integration['frontend_only']) && $integration['frontend_only']) {
        return;
      }

      // Page Builder state
      $pagebuilder_enbaled = 0;
      if ($page_content = self::getPageContent($option, $view, $id)) {
        $pagebuilder_enbaled = $page_content->active;
      }

      // Add script
      $body = $app->getBody();
      if ($option == 'com_k2') {
        $body = str_replace('<div class="k2ItemFormEditor">', '<div class="sp-pagebuilder-btn-group sp-pagebuilder-btns-alt"><a href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-editor" data-action="editor">Joomla Editor</a><a data-action="sppagebuilder" href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-sppagebuilder">SP Page Builder</a></div><div class="sp-pagebuilder-admin pagebuilder-' . str_replace('_', '-', $option) . '" style="display: none;"><div id="sp-pagebuilder-page-tools" class="sp-pagebuilder-page-tools"></div><div class="sp-pagebuilder-sidebar-and-builder"><div id="sp-pagebuilder-section-lib" class="clearfix sp-pagebuilder-section-lib"></div><div id="container"></div></div></div><div class="k2ItemFormEditor">', $body);
      } else {
        $body = str_replace('<fieldset class="adminform">', '<div class="sp-pagebuilder-btn-group sp-pagebuilder-btns-alt"><a href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-editor" data-action="editor">Joomla Editor</a><a data-action="sppagebuilder" href="#" class="sp-pagebuilder-btn sp-pagebuilder-btn-default sp-pagebuilder-btn-switcher btn-action-sppagebuilder">SP Page Builder</a></div><div class="sp-pagebuilder-admin pagebuilder-' . str_replace('_', '-', $option) . '" style="display: none;"><div id="sp-pagebuilder-page-tools" class="sp-pagebuilder-page-tools"></div><div class="sp-pagebuilder-sidebar-and-builder"><div id="sp-pagebuilder-section-lib" class="clearfix sp-pagebuilder-section-lib"></div><div id="container"></div></div></div><fieldset class="adminform">', $body);
      }

      // Page Builder fields
      $body = str_replace('</form>', '<input type="hidden" id="jform_attribs_sppagebuilder_content" name="jform[attribs][sppagebuilder_content]"></form>' . "\n", $body);
      $body = str_replace('</form>', '<input type="hidden" id="jform_attribs_sppagebuilder_active" name="jform[attribs][sppagebuilder_active]" value="' . $pagebuilder_enbaled . '"></form>' . "\n", $body);

      // Add script
      $body = str_replace('</body>', '<script type="text/javascript" src="' . JURI::base(true) . '/components/com_sppagebuilder/assets/js/engine.js?' . SppagebuilderHelper::getVersion(true) . '"></script>' . "\n</body>", $body);
      $app->setBody($body);
    }
  }

  private static function loadPageBuilderLanguage()
  {
    $lang = Factory::getLanguage();
    $lang->load('com_sppagebuilder', JPATH_ADMINISTRATOR, $lang->getName(), true);
    $lang->load('tpl_' . self::getTemplate(), JPATH_SITE, $lang->getName(), true);
    require_once JPATH_ROOT . '/administrator/components/com_sppagebuilder/helpers/language.php';
  }

  private static function getPageContent($extension = 'com_content', $extension_view = 'article', $view_id = 0)
  {
    $db = Factory::getDbo();
    $query = $db->getQuery(true);
    $query->select($db->quoteName(array('text', 'active')));
    $query->from($db->quoteName('#__sppagebuilder'));
    $query->where($db->quoteName('extension') . ' = ' . $db->quote($extension));
    $query->where($db->quoteName('extension_view') . ' = ' . $db->quote($extension_view));
    $query->where($db->quoteName('view_id') . ' = ' . $view_id);
    $db->setQuery($query);
    $result = $db->loadObject();

    if ($result) {
      return $result;
    }

    return false;
  }

  private static function getIntegration()
  {
    $app = Factory::getApplication();
    $option = $app->input->get('option', '', 'STRING');
    $group = str_replace('com_', '', $option);
    $integrations = SppagebuilderHelperIntegrations::integrations();

    if (!isset($integrations[$group])) {
      return false;
    }

    $integration = $integrations[$group];
    $name = $integration['name'];
    $enabled = PluginHelper::isEnabled($group, $name);

    if ($enabled) {
      return $integration;
    }

    return false;
  }

  private static function getTemplate()
  {
    $db = Factory::getDbo();
    $query = $db->getQuery(true);
    $query->select($db->quoteName(array('template')));
    $query->from($db->quoteName('#__template_styles'));
    $query->where($db->quoteName('client_id') . ' = ' . $db->quote(0));
    $query->where($db->quoteName('home') . ' = ' . $db->quote(1));
    $db->setQuery($query);
    return $db->loadResult();
  }

  public function onExtensionAfterSave($option, $data)
  {
    if (($option == 'com_config.component') && ($data->element == 'com_sppagebuilder')) {
      $admin_cache = JPATH_ROOT . '/administrator/cache/sppagebuilder';
      if (Folder::exists($admin_cache)) {
        Folder::delete($admin_cache);
      }

      $site_cache = JPATH_ROOT . '/cache/sppagebuilder';
      if (Folder::exists($site_cache)) {
        Folder::delete($site_cache);
      }
    }
  }
}
