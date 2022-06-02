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
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Component\ComponentHelper;

JLoader::register('SppagebuilderHelper', JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/sppagebuilder.php');
JLoader::register('SppagebuilderHelperRoute', JPATH_ROOT . '/components/com_sppagebuilder/helpers/route.php');

class JFormFieldPagebuilder extends FormField
{
	protected	$type = 'Pagebuilder';

	protected function getInput()
	{
		$output = '';
		$id = (int) Factory::getApplication()->input->get('id', 0, 'INT');
		if($id)
		{
			require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/builder/classes/base.php';
			require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/builder/classes/config.php';

			$this->loadPageBuilderLanguage();

			$params = ComponentHelper::getParams('com_sppagebuilder');
			$doc = Factory::getDocument();
			$input = Factory::getApplication()->input;

			HTMLHelper::_('jquery.framework');
			SppagebuilderHelper::loadAssets('css');
			$doc->addStylesheet( Uri::base(true) . '/components/com_sppagebuilder/assets/css/react-select.css' );

			SppagebuilderHelper::loadEditor();

			$doc->addScript( Uri::base(true) . '/components/com_sppagebuilder/assets/js/script.js' );
			$doc->addScript( Uri::root(true) . '/modules/mod_sppagebuilder/assets/js/action.js' );
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

			 /**
			 * This block of code added for sppbtranslate component support.
			 * @since 3.7.10
			 */
			PluginHelper::importPlugin('system','sppagebuildertranslate');

			foreach ( $addons_list as $key => &$addon ) {
				$new_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($addon['attr']);
				$addon['default'] = array_merge($new_default_value['default'], $globalDefault['default']);

				/**
				 * This block of code added for sppbtranslate component support.
				 * @since 3.7.10
				 */
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

			$doc->addScriptdeclaration('var useGoogleFonts = ' . $params->get('google_fonts', 0) .';');
			$doc->addScriptdeclaration('var addonsJSON=' . json_encode($addons_list) . ';');

			// Addon Categories
			$addon_cats = SpPgaeBuilderBase::getAddonCategories($addons_list);
			$doc->addScriptdeclaration('var addonCats=' . json_encode($addon_cats) . ';');

			// Global Attributes
			$doc->addScriptdeclaration('var globalAttr=' . json_encode( $global_attributes ) . ';');
			$doc->addScriptdeclaration('var faIconList=' . json_encode( $fa_icon_list ) . ';');
			$doc->addScriptdeclaration('var animateNames=' . json_encode( $animateNames ) . ';');
			$doc->addScriptdeclaration('var accessLevels=' . json_encode( $accessLevels ) . ';');
			$doc->addScriptdeclaration('var articleCats=' . json_encode( $article_cats ) . ';');
			$doc->addScriptdeclaration('var moduleAttr=' . json_encode( $moduleAttr ) . ';');
			$doc->addScriptdeclaration('var rowSettings=' . json_encode( $rowSettings ) . ';');
			$doc->addScriptdeclaration('var colSettings=' . json_encode( $columnSettings ) . ';');

			//Global variable for page name
			$doc->addScriptdeclaration('var pageType="module"; ');
			// Media
			$mediaParams = ComponentHelper::getParams('com_media');
			$doc->addScriptdeclaration('var sppbMediaPath=\'/'. $mediaParams->get('file_path', 'images') .'\';');

			$initialState = '[]';

			$pageData = $this->pageData($id);

			if(isset($pageData->id) && $pageData->id) {
				$view_id = $pageData->id;
				$content = $pageData->text;
				if(empty($content)) {
					$content = '[]';
				}
			} else {
				$data = $this->form->getData();
				$params = new Joomla\Registry\Registry($this->moduleParams($id));
				$title = $data->get('title');
				$content = $params->get('content', '[]');

				if(!$this->isJson($content))
				{
					$content = '[]';
				}

				$view_id = $this->insertData($id, $title, $content);

				if(empty($content))
				{
					$content = '[]';
				}
			}

			$initialState = $content;

			$doc->addScriptdeclaration('var initialState='. $initialState .';');
			$doc->addScriptdeclaration('var boxLayout=1;');

			$front_link = 'index.php?option=com_sppagebuilder&view=form&tmpl=component&layout=edit&extension=mod_sppagebuilder&extension_view=module&id=' . $view_id;
			$sefURI = str_replace('/administrator', '', SppagebuilderHelperRoute::buildRoute($front_link));

			$output = '<a class="btn btn-default" style="margin-bottom: 20px;" href="'. $sefURI .'" target="_blank">Frontend Edit with SP Page builder</a>';

			$output .= '<div class="sp-pagebuilder-admin pagebuilder-module"><div id="sp-pagebuilder-page-tools" class="sp-pagebuilder-page-tools"></div><div class="sp-pagebuilder-sidebar-and-builder"><div id="sp-pagebuilder-section-lib" class="clearfix sp-pagebuilder-section-lib"></div><div id="container"></div></div></div>';

			$output .= '<input type="hidden" name="'. $this->name .'" id="'. $this->id .'" value="">';
			$output .= '<input type="hidden" name="jform[content]" id="jform_content" value="">';
			$output .= '<input type="hidden" id="sppagebuilder_module_id" value="'. $id .'">';
			$output .= '<script type="text/javascript" src="' . Uri::base(true) . '/components/com_sppagebuilder/assets/js/engine.js" defer></script>';

			return $output;
		}
		else
		{
			$output .= '<div class="alert alert-info">Please save this module to activate Page Builder</div>';
		}

		$output .= '<style>#general .control-group .control-label {display: none;} #general .control-group .controls {margin-left: 0;}</style>';

		return $output;
	}

	private function moduleParams($id)
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('params')));
		$query->from($db->quoteName('#__modules'));
		$query->where($db->quoteName('id') . ' = '. $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadResult();

		return $result;
	}

	private function pageData($id)
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from($db->quoteName('#__sppagebuilder'));
		$query->where($db->quoteName('extension') . ' = '. $db->quote('mod_sppagebuilder'));
		$query->where($db->quoteName('extension_view') . ' = '. $db->quote('module'));
		$query->where($db->quoteName('view_id') . ' = '. $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadObject();

		return $result;
	}

	private function insertData($id, $title, $content)
	{
		$user = Factory::getUser();
		$date = Factory::getDate();
        $db = Factory::getDbo();
		$page = new stdClass();
        $page->title = $title;
        $page->text = $content;
        $page->extension = 'mod_sppagebuilder';
        $page->extension_view = 'module';
        $page->view_id = $id;
		$page->published = 1;
		$page->created_by = (int) $user->id;
		$page->created_on = $date->toSql();
		$page->modified = $date->toSql();
		$page->checked_out_time = $date->toSql();
		$page->language = '*';
		$page->access = 1;
		$page->css = '';
		$page->active = 1;

		$db->insertObject('#__sppagebuilder', $page);
		return $db->insertid();
	}

	function isJson($string)
	{
		json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	private function loadPageBuilderLanguage() {
		$lang = Factory::getLanguage();
		$lang->load('com_sppagebuilder', JPATH_ADMINISTRATOR, $lang->getName(), true);
		$lang->load('tpl_' . $this->getTemplate(), JPATH_SITE, $lang->getName(), true);
		require_once JPATH_ROOT .'/administrator/components/com_sppagebuilder/helpers/language.php';
	}

	private function getTemplate() {
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('template')));
		$query->from($db->quoteName('#__template_styles'));
		$query->where($db->quoteName('client_id') . ' = '. $db->quote(0));
		$query->where($db->quoteName('home') . ' = '. $db->quote(1));
		$db->setQuery($query);
		return $db->loadResult();
	}
}
