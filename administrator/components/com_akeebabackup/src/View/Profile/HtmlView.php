<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\View\Profile;

defined('_JEXEC') or die;

use Akeeba\Component\AkeebaBackup\Administrator\Model\ProfileModel;
use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	/**
	 * The Form object
	 *
	 * @var    Form
	 * @since  1.5
	 */
	protected $form;

	/**
	 * The active item
	 *
	 * @var    object
	 * @since  1.5
	 */
	protected $item;

	/**
	 * The model state
	 *
	 * @var    object
	 * @since  1.5
	 */
	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 *
	 * @throws  Exception
	 * @since   9.0.0
	 *
	 */
	public function display($tpl = null): void
	{
		/** @var ProfileModel $model */
		$model       = $this->getModel();
		$this->form  = $model->getForm();
		$this->item  = $model->getItem();
		$this->state = $model->getState();

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}

		$this->addToolbar();

		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @throws  Exception
	 * @since   9.0.0
	 */
	protected function addToolbar(): void
	{
		Factory::getApplication()->input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		ToolbarHelper::title($isNew ? Text::_('COM_AKEEBABACKUP_PROFILES_PAGETITLE_NEW') : Text::_('COM_AKEEBABACKUP_PROFILES_PAGETITLE_EDIT'), 'icon-akeeba');

		$toolbarButtons = [];

		// If not checked out, can save the item.
		ToolbarHelper::apply('Profile.apply');
		$toolbarButtons[] = ['save', 'Profile.save'];
		$toolbarButtons[] = ['save2new', 'Profile.save2new'];

		// If an existing item, can save to a copy.
		if (!$isNew)
		{
			$toolbarButtons[] = ['save2copy', 'Profile.save2copy'];
		}

		ToolbarHelper::saveGroup(
			$toolbarButtons,
			'btn-success'
		);

		ToolbarHelper::cancel('Profile.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');

		ToolbarHelper::divider();
		ToolbarHelper::help(null, false, 'https://www.akeeba.com/documentation/akeeba-backup-joomla/using-basic-operations.html#profiles-management');
	}
}