<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Table;

defined('_JEXEC') || die;

use Akeeba\Engine\Platform;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use RuntimeException;

/**
 * Backup profile model
 *
 * @property  int    id             Profile ID
 * @property  string description    Description
 * @property  string configuration  Engine configuration data
 * @property  string filters        Engine filters
 * @property  int    quickicon      Should I include this profile in the One Click Backup profiles (1) or not (0)?
 */
class ProfileTable extends Table
{
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__akeebabackup_profiles', 'id', $db);

		$this->setColumnAlias('published', 'quickicon');
	}

	/**
	 * Tries to copy the currently loaded to a new record
	 *
	 * @return  self  The new record
	 */
	public function copy($data = null)
	{
		$id = $this->getId();

		// Check for invalid id's (not numeric, or <= 0)
		if ((!is_numeric($id)) || ($id <= 0))
		{
			throw new RuntimeException('No profile has been loaded yet', 500);
		}

		if (!is_array($data))
		{
			$data = [];
		}

		$data['id'] = 0;

		$newRecord = clone $this;

		$newRecord->save($data);

		return $newRecord;
	}

	public function delete($pk = null)
	{
		// Which record am I deleting?
		if (\is_null($pk))
		{
			$id = $this->getId();
		}
		elseif (!\is_array($pk))
		{
			$id = (int) $pk;
		}
		else
		{
			$id = $pk[$this->_tbl_key] ?? 0;
		}

		// You cannot delete the default record
		if ($id <= 1)
		{
			throw new RuntimeException(Text::_('COM_AKEEBABACKUP_PROFILE_ERR_CANNOTDELETEDEFAULT'), 500);
		}

		// If you're deleting the current backup profile we have to switch to the default profile (#1)
		$activeProfile = Platform::getInstance()->get_active_profile();

		if ($id == $activeProfile)
		{
			throw new RuntimeException(Text::sprintf('COM_AKEEBABACKUP_PROFILE_ERR_CANNOTDELETEACTIVE', $id), 500);
		}

		return parent::delete($pk);
	}

	/**
	 * Save a profile from imported configuration data. The $data array must contain the keys description (profile
	 * description), configuration (engine configuration INI data) and filters (inclusion and inclusion filters JSON
	 * configuration data).
	 *
	 * @param   array  $data  See above
	 *
	 * @returns  void
	 *
	 * @throws   RuntimeException  When an iport error occurs
	 */
	public function import(array $data)
	{
		// Check for data validity
		$isValid =
			!empty($data) &&
			array_key_exists('description', $data) &&
			array_key_exists('configuration', $data) &&
			array_key_exists('filters', $data);

		if (!$isValid)
		{
			throw new RuntimeException(Text::_('COM_AKEEBABACKUP_PROFILES_ERR_IMPORT_INVALID'));
		}

		// Unset the id, if it exists
		if (array_key_exists('id', $data))
		{
			unset($data['id']);
		}

		$data['akeeba.flag.confwiz'] = 1;

		// Try saving the profile
		$result = $this->save($data);

		if (!$result)
		{
			throw new RuntimeException(Text::_('COM_AKEEBABACKUP_PROFILES_ERR_IMPORT_FAILED'));
		}
	}

}