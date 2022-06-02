<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Model;

defined('_JEXEC') || die();

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class ProfileModel extends AdminModel
{
	/**
	 * @inheritDoc
	 */
	public function getForm($data = [], $loadData = true)
	{
		$form = $this->loadForm(
			'com_akeebabackup.profile',
			'profile',
			[
				'control'   => 'jform',
				'load_data' => $loadData,
			]
		);

		if (empty($form))
		{
			return false;
		}

		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data))
		{
			// Disable fields for display.
			$form->setFieldAttribute('quickicon', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('quickicon', 'filter', 'unset');
		}

		return $form;
	}

	/**
	 * Reset the configuration and filters of a backup profile
	 *
	 * @param   int  $pk  Backup profile ID
	 *
	 * @return  bool  True if the profile exists and we can reset its configuration.
	 * @throws  \Exception
	 */
	public function resetConfiguration(int $pk)
	{
		$table = $this->getTable();

		if (!$table->load($pk))
		{
			$this->setError($table->getError());

			return false;
		}

		$table->configuration = '';
		$table->filters       = '';

		return $table->save([
			'configuration' => '',
			'filters'       => '',
		]);
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app  = Factory::getApplication();
		$data = $app->getUserState('com_akeebabackup.edit.profile.data', []);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		$this->preprocessData('com_akeebabackup.profile', $data);

		return $data;
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 *
	 * @since   1.6
	 */
	protected function canDelete($record)
	{
		if (empty($record->id))
		{
			return false;
		}

		if ($record->id == 1)
		{
			return false;
		}

		return parent::canDelete($record);
	}

}