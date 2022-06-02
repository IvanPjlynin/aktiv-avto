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
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\MVC\Controller\BaseController;

class SppagebuilderController extends BaseController {

	protected $default_view = 'pages';

	function display( $cachable = false, $urlparams = false )
	{
		$view   = $this->input->get('view', 'pages');
		$layout = $this->input->get('layout', 'pages');
		$id     = $this->input->getInt('id');

		if ($view == 'page' && $layout == 'edit' && !$this->checkEditId('com_sppagebuilder.edit.page', $id))
		{
			$this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
			$this->setRedirect(Route::_('index.php?option=com_sppagebuilder&view=pages', false));

			return false;
		}

		return parent::display();
	}

	public function resetcss()
	{
		$css_folder_path = JPATH_ROOT . '/media/com_sppagebuilder/css';

		if (Folder::exists($css_folder_path))
		{
			Folder::delete($css_folder_path);
		}

		die();
	}

	public function export()
	{
		$input  = Factory::getApplication()->input;
		$template = $input->get('template','[]','RAW');
		$filename = 'template'. rand(10000,99999);

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=$filename.json");
		header("Content-Type: application/json");
		header("Content-Transfer-Encoding: binary ");

		echo $template;

		die();
	}
}
