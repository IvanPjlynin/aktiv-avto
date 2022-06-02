<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Language\Multilanguage;

JLoader::register('SppagebuilderHelperRoute', JPATH_ROOT . '/components/com_sppagebuilder/helpers/route.php');

// Base this model on the backend version.
JLoader::register('SppagebuilderModelPage', JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/models/page.php');

class SppagebuilderModelForm extends SppagebuilderModelPage
{
	protected $_context = 'com_sppagebuilder.page';
	protected $_item    = array();

	protected function populateState()
	{
		$app = Factory::getApplication('site');

		$pageId = $app->input->getInt('id');
		$this->setState('page.id', $pageId);

		$user = Factory::getUser();

		if ((!$user->authorise('core.edit.state', 'com_sppagebuilder')) && (!$user->authorise('core.edit', 'com_sppagebuilder')))
		{
			$this->setState('filter.published', 1);
		}

		$this->setState('filter.language', Multilanguage::isEnabled());
	}

	public function getItem($pageId = null)
	{
		$user = Factory::getUser();

		$pageId = (!empty($pageId))? $pageId : (int) $this->getState('page.id');

		if (!isset($this->_item[$pageId]))
		{
			try
			{
				$db    = $this->getDbo();
				$query = $db->getQuery(true)
					->select('a.*')
					->from('#__sppagebuilder as a')
					->where('a.id = ' . (int) $pageId);

				$query->select('l.title AS language_title')
					->leftJoin($db->quoteName('#__languages') . ' AS l ON l.lang_code = a.language');

				$query->select('ua.name AS author_name')
					->leftJoin('#__users AS ua ON ua.id = a.created_by');

				// Filter by published state.
				$published = $this->getState('filter.published');

				if (is_numeric($published))
				{
					$query->where('a.published = ' . (int) $published);
				}
				elseif ($published === '')
				{
					$query->where('(a.published IN (0, 1))');
				}

				if ($this->getState('filter.language'))
				{
					$query->where('a.language in (' . $db->quote(Factory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')');
				}

				$db->setQuery($query);
				$data = $db->loadObject();

				if (empty($data))
				{
					$app = Factory::getApplication();
					$app->enqueueMessage(Text::_('COM_SPPAGEBUILDER_ERROR_PAGE_NOT_FOUND'), 'error');
					$app->setHeader('status', '404', true);

					return;
				}

				if ($access = $this->getState('filter.access'))
				{
					$data->access_view = true;
				}
				else
				{
					$user   = Factory::getUser();
					$groups = $user->getAuthorisedViewLevels();

					$data->access_view = in_array($data->access, $groups);
				}

				if (isset($data->attribs))
				{
					$attribs = json_decode($data->attribs);
				}
				else
				{
					$attribs = new stdClass;
				}

				$data->link     = SppagebuilderHelperRoute::getPageRoute($data->id, $data->language);
				$data->formLink = SppagebuilderHelperRoute::getFormRoute($data->id, $data->language);

				//
				$data->meta_description = (isset($attribs->meta_description) && $attribs->meta_description) ? $attribs->meta_description : '';
				$data->meta_keywords    = (isset($attribs->meta_keywords) && $attribs->meta_keywords) ? $attribs->meta_keywords : '';

				$menu_id             = (isset($attribs->menu_id) && $attribs->menu_id) ? $attribs->menu_id : 0;
				$menu                = $this->getMenuByPageId($data->id);
				$data->menuid        = (isset($menu->id) && $menu->id) ? $menu->id : 0;
				$data->menutitle     = (isset($menu->title) && $menu->title) ? $menu->title : '';
				$data->menualias     = (isset($menu->alias) && $menu->alias) ? $menu->alias : '';
				$data->menutype      = (isset($menu->menutype) && $menu->menutype) ? $menu->menutype : '';
				$data->menuparent_id = (isset($menu->parent_id) && $menu->parent_id) ? $menu->parent_id : 0;
				$data->menuordering  = (isset($menu->id) && $menu->id) ? $menu->id : -2;

				$this->_item[$pageId] = $data;
			}
			catch (Exception $e)
			{
				if ($e->getCode() == 404)
				{
					$app = Factory::getApplication();
					$app->enqueueMessage($e->getMessage(), 'error');
					$app->setHeader('status', '404', true);
				}
				else
				{
					$this->setError($e);
					$this->_item[$pageId] = false;
				}
			}
		}

		return $this->_item[$pageId];
	}

	public function getForm($data = array(), $loadData = true)
	{
		$app  = Factory::getApplication();
		$user = Factory::getUser();

		// Get the form.
		$form = $this->loadForm('com_sppagebuilder.page', 'page', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		// Manually check-out
		$pageId = (!empty($pageId))? $pageId : (int) $this->getState('page.id');
		/**
		 * Check user id for manual checkout.
		 * @since 3.7.10
		 */
		if ($user->id)
		{
			$this->checkout($pageId);
		}

		return parent::getForm();
	}

	public function save($data)
	{
		$attribs = array();

		if (isset($data['meta_description']) && $data['meta_description'])
		{
			$attribs['meta_description'] = $data['meta_description'];
		}

		if (isset($data['meta_keywords']) && $data['meta_keywords'])
		{
			$attribs['meta_keywords'] = $data['meta_keywords'];
		}

		$data['attribs'] = json_encode($attribs);

		return parent::save($data);
	}

	public function getMenuByPageId($pageId = 0)
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select(array('a.*'));
		$query->from('#__menu as a');
		$query->where('a.link = ' . $db->quote('index.php?option=com_sppagebuilder&view=page&id=' . $pageId));
		$query->where('a.client_id = 0');
		$db->setQuery($query);

		return $db->loadObject();
	}

	public function getMenuById($menuId = 0)
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select(array('a.*'));
		$query->from('#__menu as a');
		$query->where('a.id = ' . $menuId);
		$query->where('a.client_id = 0');
		$db->setQuery($query);

		return $db->loadObject();
	}

	public function getMenuByAlias($alias, $menuId = 0)
	{
		$db    = $this->getDbo();
		$query = $db->getQuery(true);
		$query->select(array('a.id', 'a.title', 'a.alias', 'a.menutype', 'a.parent_id', 'a.component_id'));
		$query->from('#__menu as a');
		$query->where('a.alias = ' . $db->quote($alias));

		if ($menuId)
		{
			$query->where('a.id != ' . (int) $menuId);
		}
		$query->where('a.client_id = 0');
		$db->setQuery($query);

		return $db->loadObject();
	}

	public function createNewPage($title)
	{
		$user                 = Factory::getUser();
		$date                 = Factory::getDate();
		$db                   = $this->getDbo();
		$page                 = new stdClass();
		$page->title          = $title;
		$page->text           = '[]';
		$page->extension      = 'com_sppagebuilder';
		$page->extension_view = 'page';
		$page->published      = 1;
		$page->created_by     = (int) $user->id;
		$page->created_on     = $date->toSql();
		$page->language       = '*';
		$page->access         = 1;

		if (empty($page->css))
		{
			$page->css = '';
		}
		$db->insertObject('#__sppagebuilder', $page);

		return $db->insertid();
	}

	public function deletePage($id = 0)
	{
		$db         = Factory::getDbo();
		$query      = $db->getQuery(true);
		$conditions = array(
			$db->quoteName('id') . ' = ' . $id,
		);
		$query->delete($db->quoteName('#__sppagebuilder'));
		$query->where($conditions);
		$db->setQuery($query);
		$result = $db->execute();

		return $result;
	}

	public function getPageItem($id = 0)
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('extension', 'extension_view', 'view_id', 'catid'));
		$query->from($db->quoteName('#__sppagebuilder'));
		$query->where($db->quoteName('id') . ' = ' . $db->quote($id));
		$db->setQuery($query);
		$result = $db->loadObject();

		if (count((array) $result))
		{
			return $result;
		}

		return false;
	}

	public function addArticleFullText($id, $data)
	{
		$article           = new stdClass();
		$article->id       = $id;
		$article->fulltext = SppagebuilderHelperSite::getPrettyText($data);
		$result            = Factory::getDbo()->updateObject('#__content', $article, 'id');
	}
}
