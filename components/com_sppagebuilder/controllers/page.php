<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\MVC\Controller\FormController;

/**
 * Undocumented class
 *
 * @since 1.0.0
 */
class SppagebuilderControllerPage extends FormController
{
	/**
	 * Undocumented function
	 *
	 * @param array $config
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Check have access
		$user       = Factory::getUser();
		$authorised = $user->authorise('core.edit', 'com_sppagebuilder');

		if (!$authorised)
		{
			die('Restricted Access');
		}
		// Check CSRF
		Session::checkToken() or die('Restricted Access');
	}

	/**
	 * Undocumented function
	 *
	 * @param string $name
	 * @param string $prefix
	 * @param array $config
	 * @return void
	 * @since 1.0.0
	 */
	public function getModel($name = 'form', $prefix = '', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

	public function save($key = null, $urlVar = null)
	{
		$user     = Factory::getUser();
		$app      = Factory::getApplication();
		$input    = $app->input;
		$Itemid   = $input->get('Itemid', 0, 'INT');
		$root     = Uri::base();
		$root     = new Uri($root);

		$link = $root->getScheme() . '://' . $root->getHost();

		$model    = $this->getModel('Form');
		$data     = $this->input->post->get('jform', array(), 'array');
		$task     = $this->getTask();
		$context  = 'com_sppagebuilder.edit.page';
		$recordId = $data['id'];
		$output   = array();

		//Authorized
		if (empty($recordId))
		{
			$authorised = $user->authorise('core.create', 'com_sppagebuilder') || (count((array) $user->getAuthorisedCategories('com_sppagebuilder', 'core.create')));
		}
		else
		{
			$authorised = $user->authorise('core.edit', 'com_sppagebuilder') || $user->authorise('core.edit', 'com_sppagebuilder.page.' . $recordId) || ($user->authorise('core.edit.own', 'com_sppagebuilder.page.' . $recordId) && $data['created_by'] == $user->id);
		}

		if ($authorised !== true)
		{
			$output['status']  = false;
			$output['message'] = Text::_('JERROR_ALERTNOAUTHOR');
			echo json_encode($output);
			die();
		}

		// Check for request forgeries.
		$output['status']  = false;
		$output['message'] = Text::_('JINVALID_TOKEN');
		Session::checkToken() or die(json_encode($output));

		$output['status'] = true;

		// Check for validation errors.
		if ($data === false)
		{
			// Get the validation messages.
			$errors = $model->getErrors();

			$output['status']  = false;
			$output['message'] = '';

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count((array) $errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception)
				{
					$output['message'] .= $errors[$i]->getMessage();
				}
				else
				{
					$output['message'] .= $errors[$i];
				}
			}

			// Save the data in the session.
			$app->setUserState('com_sppagebuilder.edit.page.data', $data);

			// Redirect back to the edit screen.
			$url                = $link . Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $recordId . '&Itemid=' . $Itemid);
			$output['redirect'] = $url;
			echo json_encode($output);
			die();
		}

		if ($itemOld = $model->getPageItem($recordId))
		{
			if ($itemOld->extension == 'com_content' && $itemOld->extension_view == 'article' && $itemOld->view_id)
			{
				$data['catid'] = $itemOld->catid;
			}
		}

		// Attempt to save the data.
		if (!$model->save($data))
		{
			// Save the data in the session.
			$app->setUserState('com_sppagebuilder.edit.page.data', $data);

			// Redirect back to the edit screen.
			$output['status']   = false;
			$output['message']  = Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError());
			$output['redirect'] = $link . Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $recordId . '&Itemid=' . $Itemid);
			echo json_encode($output);
			die();
		}

		// Save succeeded, check-in the row.
		if ($model->checkin($data['id']) === false)
		{

            // Check-in failed, go back to the row and display a notice.
			$output['status']   = false;
			$output['message']  = Text::sprintf('JLIB_APPLICATION_ERROR_CHECKIN_FAILED', $model->getError());
			$output['redirect'] = $link . Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $recordId . '&Itemid=' . $Itemid);
			echo json_encode($output);
			die();
		}

		$output['status']  = true;
		$output['message'] = Text::_('COM_SPPAGEBUILDER_PAGE_SAVE_SUCCESS');

		// Redirect the user and adjust session state based on the chosen task.
		switch ($task) {
            case 'apply':
                // Set the row data in the session.
                $this->holdEditId($context, $recordId);
                $app->setUserState('com_sppagebuilder.edit.page.data', null);

                // Convert json to readable article text
                $oldPage = $model->getItem($recordId);

                if ($oldPage->extension == 'com_content' && $oldPage->extension_view == 'article')
                {
                	$model->addArticleFullText($oldPage->view_id, $oldPage->text);
                }

                // Delete generated CSS file
                $css_folder_path = JPATH_ROOT . '/media/com_sppagebuilder/css';
                $css_file_path   = $css_folder_path . '/page-' . $recordId . '.css';

                if (file_exists($css_file_path))
                {
                	File::delete($css_file_path);
                }

                // Redirect back to the edit screen.
                $output['redirect'] = $link . Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $recordId . '&Itemid=' . $Itemid);
                // $output['redirect'] = '';
                $output['id'] = $recordId;

                break;

            default:
                // Clear the row id and data in the session.
                $this->releaseEditId($context, $recordId);
                $app->setUserState('com_sppagebuilder.edit.page.data', null);

                // Redirect to the list screen.
                $output['redirect'] = $link . Route::_('index.php?option=' . $this->option . '&view=' . $this->view_list . $this->getRedirectToListAppend(), false);

                break;
        }

		echo json_encode($output);
		die();
	}

	public function getMySections()
	{
		$model = $this->getModel();
		die($model->getMySections());
	}

	public function deleteSection()
	{
		$model = $this->getModel();
		$app   = Factory::getApplication();
		$input = $app->input;

		$id = $input->get('id', '', 'INT');

		die($model->deleteSection($id));
	}

	public function saveSection()
	{
		$model = $this->getModel();
		$app   = Factory::getApplication();
		$input = $app->input;

		$title   = htmlspecialchars($input->get('title', '', 'STRING'));
		$section = $input->get('section', '', 'RAW');

		if ($title && $section)
		{
			$section_id = $model->saveSection($title, $section);
			echo $section_id;
			die();
		}
		else
		{
			die('Failed');
		}
	}

	public function getMyAddons()
	{
		$model = $this->getModel();
		die($model->getMyAddons());
	}

	public function saveAddon()
	{
		$model = $this->getModel();
		$app   = Factory::getApplication();
		$input = $app->input;

		$title = htmlspecialchars($input->get('title', '', 'STRING'));
		$addon = $input->get('addon', '', 'RAW');

		if ($title && $addon)
		{
			$addon_id = $model->saveAddon($title, $addon);
			echo $addon_id;
			die();
		}
		else
		{
			die('Failed');
		}
	}

	public function deleteAddon()
	{
		$model = $this->getModel();
		$app   = Factory::getApplication();
		$input = $app->input;

		$id = $input->get('id', '', 'INT');

		die($model->deleteAddon($id));
	}

	public function myPages()
	{
		$model = $this->getModel('Page');
		$model->getMyPages();
		die();
	}

	public function cancel($key = 'id')
	{
		parent::cancel($key);
		$return_url = Factory::getApplication()->input->get('return_page', null, 'base64');

		$this->setRedirect(base64_decode($return_url));
	}

	public function addToMenu()
	{
		$output = array();

		$data   = $this->input->post->get('jform', array(), 'array');
		$pageId = (int) $this->input->get->get('pageId', 0, 'INT');

		BaseDatabaseModel::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_menus/models');
		Table::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_menus/tables');
		$formModel = $this->getModel('Form');
		$model     = $this->getModel('Item', 'MenusModel');

		//Check menu
		$menuId        = (isset($data['menuid']) && $data['menuid']) ? $data['menuid'] : 0;
		$menutitle     = (isset($data['menutitle']) && $data['menutitle']) ? $data['menutitle'] : '';
		$menualias     = (isset($data['menualias']) && $data['menualias']) ? $data['menualias'] : OutputFilter::stringURLSafe($menutitle);
		$menutype      = (isset($data['menutype']) && $data['menutype']) ? $data['menutype'] : '';
		$menuparent_id = (isset($data['menuparent_id']) && $data['menuparent_id']) ? $data['menuparent_id'] : 0;
		$menuordering  = (isset($data['menuordering']) && $data['menuordering']) ? $data['menuordering'] : -2;
		$link          = 'index.php?option=com_sppagebuilder&view=page&id=' . (int) $pageId;
		$component_id  = ComponentHelper::getComponent('com_sppagebuilder')->id;

		$menu = $formModel->getMenuById($menuId);
		$home = (isset($menu->home) && $menu->home) ? $menu->home : 0;

		$menuData = array(
            'id'           => (int) $menuId,
            'link'         => $link,
            'parent_id'    => (int) $menuparent_id,
            'menutype'     => htmlspecialchars($menutype),
            'title'        => htmlspecialchars($menutitle),
            'alias'        => htmlspecialchars($menualias),
            'type'         => 'component',
            'published'    => 1,
            'language'     => '*',
            'component_id' => $component_id,
            'menuordering' => (int) $menuordering,
            'home'         => (int) $home,
        );

		$message = ($menuId) ? 'Menu successfully updated' : 'Added to a new menu';

		if ($model->save($menuData))
		{
			$menu              = $formModel->getMenuByAlias($menualias);
			$menuId            = $menu->id;
			$output['status']  = true;
			$output['alias']   = $menualias;
			$output['menuid']  = $menuId;
			$output['success'] = $message;

			$Itemid     = $formModel->getMenuByPageId($pageId);
			$menuItemId = 0;

			if (isset($Itemid->id) && $Itemid->id)
			{
				$menuItemId = '&Itemid=' . $Itemid->id;
			}
			$root               = Uri::base();
			$root               = new Uri($root);
			$link               = $root->getScheme() . '://' . $root->getHost();
			$output['redirect'] = $link . Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $pageId . $menuItemId);
		}
		else
		{
			$output['status'] = false;
			$output['error']  = $model->getError();
		}

		die(json_encode($output));
	}

	public function getMenuParentItem()
	{
		BaseDatabaseModel::addIncludePath(JPATH_SITE . '/administrator/components/com_menus/models');
		$app = Factory::getApplication();

		$results   = array();
		$menutype  = $this->input->get->get('menutype', '');
		$parent_id = $this->input->get->get('parent_id', 0);

		if ($menutype)
		{
			$model = $this->getModel('Items', 'MenusModel', array());
			$model->getState();
			$model->setState('filter.menutype', $menutype);
			$model->setState('list.select', 'a.id, a.title, a.level');
			$model->setState('list.start', '0');
			$model->setState('list.limit', '0');

			$results = $model->getItems();

			for ($i = 0, $n = count($results); $i < $n; $i++)
			{
				$results[$i]->title = str_repeat(' - ', $results[$i]->level) . $results[$i]->title;
			}
		}

		echo json_encode($results);

		$app->close();
	}

	// private function saveMenu($menuId = 0, $pageId, $menutitle, $menualias, $menutype, $menuparent_id, $menuordering) {}

	public function createNewPage()
	{
		$output = array();
		$app    = Factory::getApplication();

		$user       = Factory::getUser();
		$authorised = $user->authorise('core.create', 'com_sppagebuilder');

		if (!$authorised)
		{
			$output['status']  = false;
			$output['message'] = Text::_('JERROR_ALERTNOAUTHOR');
			die(json_encode($output));
		}

		$title = trim(htmlspecialchars($this->input->post->get('title', '', 'STRING')));
		$model = $this->getModel('Form');
		$id    = $model->createNewPage($title);

		$root     = Uri::base();
		$root     = new Uri($root);
		$link     = $root->getScheme() . '://' . $root->getHost();
		$redirect = $link . Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $id);

		$output['status']   = true;
		$output['message']  = Text::_('Page created successfully.');
		$output['redirect'] = $redirect;
		die(json_encode($output));
	}

	public function deletePage()
	{
		$output = array();
		$app    = Factory::getApplication();

		$user       = Factory::getUser();
		$authorised = $user->authorise('core.delete', 'com_sppagebuilder');

		if (!$authorised)
		{
			$output['status']  = false;
			$output['message'] = Text::_('JERROR_ALERTNOAUTHOR');
			die(json_encode($output));
		}

		$pageid = (int) $this->input->post->get('pageid', '', 'INT');

		$model  = $this->getModel('Form');
		$result = $model->deletePage($pageid);

		if (!$result)
		{
			$output['message'] = Text::_('Unable to delete this page.');
		}

		$output['status'] = $result;
		die(json_encode($output));
	}
}
