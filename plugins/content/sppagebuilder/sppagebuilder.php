<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2019 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Application\CMSApplication;

//no direct accees
defined ('_JEXEC') or die ('Restricted access');

$sppb_helper_path = JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/sppagebuilder.php';
if (!file_exists($sppb_helper_path))
{
	return;
}
if (!class_exists('SppagebuilderHelper'))
{
	require_once $sppb_helper_path;
}

if (!class_exists('SppagebuilderHelperSite'))
{
	require_once JPATH_ROOT . '/components/com_sppagebuilder/helpers/helper.php';
}

// Load language file
$language = Factory::getLanguage();
$language->load('com_sppagebuilder', JPATH_SITE, 'en-GB', true);
$language->load('com_sppagebuilder', JPATH_SITE, null, true);

class PlgContentSppagebuilder extends CMSPlugin
{
	protected $autoloadLanguage = true;
	protected $sppagebuilder_content = '';
	protected $sppagebuilder_active = 0;
	protected $isSppagebuilderEnabled = 0;
	
	public function __construct( &$subject, $config )
	{
		$this->isSppagebuilderEnabled = $this->isSppagebuilderEnabled();
		parent::__construct($subject, $config);
	}

	public function onContentAfterSave($context, $article, $isNew)
	{
		if ( !$this->isSppagebuilderEnabled ) return;

		$input = Factory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view = 'article';
		$form = $input->post->get('jform', array(), 'ARRAY');
		$sppagebuilder_active = (isset($form['attribs']['sppagebuilder_active']) && $form['attribs']['sppagebuilder_active']) ? $form['attribs']['sppagebuilder_active'] : 0;
		$sppagebuilder_content = (isset($form['attribs']['sppagebuilder_content']) && $form['attribs']['sppagebuilder_content']) ? $form['attribs']['sppagebuilder_content'] : '[]';
		if (!$sppagebuilder_content) return;
		if ($context == 'com_content.article')
		{
			$article_state = $article->state;
			if (!$sppagebuilder_active)
			{
				$article_state = 0;
			}

			$values = array(
				'title' => $article->title,
				'text' => $sppagebuilder_content,
				'option' => $option,
				'view' => $view,
				'id' => $article->id,
				'active' => $sppagebuilder_active,
				'published' => $article_state,
				'catid'		=> $article->catid,
				'created_on' => $article->created,
				'created_by' => $article->created_by,
				'modified' => $article->modified,
				'modified_by' => $article->modified_by,
				'access' => $article->access,
				'language' => '*',
				'action' => 'apply'
			);

			if ($article->state == 2)
			{
				$values['published'] = 1;
			}

			if ($sppagebuilder_active)
			{
				self::addFullText($article->id, $sppagebuilder_content);
			}

			SppagebuilderHelper::onAfterIntegrationSave($values);
		}
	}

	private static function addFullText($id, $data)
	{
		$article = new stdClass();
		$article->id = $id;
		$article->fulltext = SppagebuilderHelperSite::getPrettyText($data);
		$result = Factory::getDbo()->updateObject('#__content', $article, 'id');
	}
	
	public function onContentPrepare($context, $article, $params, $page)
	{
		$input  = Factory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view   = $input->get('view', '', 'STRING');
		$task   = $input->get('task', '', 'STRING');
		if (!isset($article->id) || !(int) $article->id)
		{
			return true;
		}

		if ( $this->isSppagebuilderEnabled )
		{
			if (($option == 'com_content') && ($view == 'article'))
			{
				$article->text = SppagebuilderHelper::onIntegrationPrepareContent($article->text, $option, $view, $article->id);
			}
			
			if (($option == 'com_j2store') && ($view == 'products') && ($task == 'view') && ($context == 'com_content.article.productlist'))
			{
				$article->text = SppagebuilderHelper::onIntegrationPrepareContent($article->text, 'com_content', 'article', $article->id);
			}
		}
	}

	public function onContentAfterDelete($context, $data)
	{
		if ( $this->isSppagebuilderEnabled )
		{
			$input  = Factory::getApplication()->input;
			$option = $input->get('option', '', 'STRING');
			$task 	= $input->get('task', '', 'STRING');
			if ( $option == 'com_content' && $context == 'com_content.article')
			{
				$values = array(
					'option' => $option,
					'view' => 'article',
					'id' => $data->id,
					'action' => 'delete'
				);

				SppagebuilderHelper::onAfterIntegrationSave($values);
			}
		}
	}

	public function onContentAfterTitle($context, $article, $params, $limitstart)
	{

		$input  = Factory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view   = $input->get('view', '', 'STRING');
		$task   = $input->get('task', '', 'STRING');
		if (!isset($article->id) || !(int) $article->id) {
			return true;
		}
		if ( $this->isSppagebuilderEnabled )
		{
			if ($option == 'com_content' && $view == 'article' && $params->get('access-edit'))
			{
				$sppbEditLink = $this->displaySPPBEditLink($article, $params);
				if ($sppbEditLink)
				{
					return $sppbEditLink;
				}
			}
		}

		return;
	}

	public function onContentChangeState($context, $pks, $value)
	{
		if ( $this->isSppagebuilderEnabled )
		{
			$input  = Factory::getApplication()->input;
			$option = $input->get('option', '', 'STRING');
			$view   = $input->get('view', '', 'STRING');
			$task   = $input->get('task', '', 'STRING');
			if ( $option == 'com_content' && $context == 'com_content.article')
			{
				$actions = array(0,1,-2);
				if ( !in_array( $value, $actions ) ) return;
				foreach ( $pks as $id )
				{
					$values = array(
						'option' => $option,
						'view' => 'article',
						'id' => $id,
						'published' => $value,
						'action' => 'stateChange'
					);
					SppagebuilderHelper::onAfterIntegrationSave($values);
				}
			}
		}
	}

	private function isSppagebuilderEnabled()
	{
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('enabled'))
		->from($db->quoteName('#__extensions'))
		->where($db->quoteName('element') . '=' . $db->quote('com_sppagebuilder'))
		->andWhere($db->quoteName('type') . '=' . $db->quote('component'));
		
		$db->setQuery($query);

		return $db->loadResult();
	}

	private function displaySPPBEditLink( $article, $params )
	{

		$user = Factory::getUser();

		// Ignore if in a popup window.
		if ($params && $params->get('popup')) return;

		// Ignore if the state is negative (trashed).
		if ($article->state < 0) return;

		$item = SppagebuilderHelper::getPageContent('com_content','article',$article->id);

		if (!$item || !$item->id) return;

		if (property_exists($article, 'checked_out')
			&& property_exists($article, 'checked_out_time')
			&& $article->checked_out > 0
			&& $article->checked_out != $user->get('id')){
			
			return '<a href="#"><span class="fa fa-lock"></span> Checked out</a>';
		}

		$app = CMSApplication::getInstance('site');
		$router = $app->getRouter();

		// Get item language code
		$lang_code = (isset($item->language) && $item->language && explode('-',$item->language)[0])? explode('-',$item->language)[0] : '';
		// check language filter plugin is enable or not
		$enable_lang_filter = PluginHelper::getPlugin('system', 'languagefilter');
		// get joomla config
		$conf = Factory::getConfig();

		$front_link = 'index.php?option=com_sppagebuilder&view=form&tmpl=component&layout=edit&id=' . $item->id;
		$sefURI = str_replace('/administrator', '', $router->build($front_link));
		if ($lang_code && $lang_code !== '*' && $enable_lang_filter && $conf->get('sef') )
		{
			$sefURI = str_replace('/index.php/', '/index.php/' . $lang_code . '/', $sefURI);
		}
		elseif($lang_code && $lang_code !== '*')
		{
			$sefURI = $sefURI . '&lang=' . $lang_code;
		}	

		return '<a target="_blank" href="'.$sefURI.'"><span class="fa fa-pencil-square-o"></span> Edit with SP Page Builder</a>';
	}

}