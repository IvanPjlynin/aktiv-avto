<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class StatisticTable extends Table
{
	public function __construct(DatabaseDriver $db)
	{
		parent::__construct('#__akeebabackup_backups', 'id', $db);

		$this->setColumnAlias('published', 'frozen');
	}
}