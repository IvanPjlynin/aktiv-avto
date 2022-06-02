<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

/** @noinspection PhpUnused */

defined('_JEXEC') || die;

use Akeeba\Component\AkeebaBackup\Administrator\Model\UpgradeModel;
use Joomla\CMS\Installer\Adapter\PackageAdapter;
use Joomla\CMS\Log\Log;

/**
 * Akeeba Backup package extension installation script file.
 *
 * @see https://docs.joomla.org/Manifest_files#Script_file
 * @see UpgradeModel
 */
class Pkg_AkeebabackupInstallerScript
{
	public function preflight($type, $parent)
	{
		// Do not run on uninstall.
		if ($type === 'uninstall')
		{
			return true;
		}

		define('AKEEBABACKUP_INSTALLATION_PRO', is_file($parent->getParent()->getPath('source') . '/com_akeebabackup-pro.zip'));

		// Prevent users from installing this on Joomla 3
		if (version_compare(JVERSION, '3.999.999', 'le'))
		{
			$msg = "<p>This version of Akeeba Backup cannot run on Joomla 3. Please download and install Akeeba Backup 8 instead. Kindly note that our site's Downloads page clearly indicates which version of our software is compatible with Joomla 3 and which version is compatible with Joomla 4.</p>";

			Log::add($msg, Log::WARNING, 'jerror');

			return false;
		}

		return true;
	}

	/**
	 * Called after any type of installation / uninstallation action.
	 *
	 * @param   string          $type    Which action is happening (install|uninstall|discover_install|update)
	 * @param   PackageAdapter  $parent  The object responsible for running this script
	 *
	 * @return  bool
	 * @since   9.0.0
	 */
	public function postflight(string $type, PackageAdapter $parent): bool
	{
		// Do not run on uninstall.
		if ($type === 'uninstall')
		{
			return true;
		}

		$model = $this->getUpgradeModel();

		if (empty($model))
		{
			return true;
		}

		return $model->postflight($type, $parent);
	}

	/**
	 * Get the UpgradeModel of the installed component
	 *
	 * @return  UpgradeModel|null  The upgrade Model. NULL if it cannot be loaded.
	 * @since   9.0.0
	 */
	private function getUpgradeModel(): ?UpgradeModel
	{
		// Make sure the latest version of the Model file will be loaded, regardless of the OPcache state.
		$filePath = JPATH_ADMINISTRATOR . '/components/com_akeebabackup/src/Model/UpgradeModel.php';

		if (function_exists('opcache_invalidate'))
		{
			opcache_invalidate($filePath = JPATH_ADMINISTRATOR . '/components/com_akeebabackup/src/Model/UpgradeModel.php');
		}

		// Can I please load the model?
		if (!class_exists('\Akeeba\Component\AkeebaBackup\Administrator\Model\UpgradeModel'))
		{
			if (!file_exists($filePath) || !is_readable($filePath))
			{
				return null;
			}

			/** @noinspection PhpIncludeInspection */
			include_once $filePath;
		}

		if (!class_exists('\Akeeba\Component\AkeebaBackup\Administrator\Model\UpgradeModel'))
		{
			return null;
		}

		try
		{
			return new UpgradeModel();
		}
		catch (Throwable $e)
		{
			return null;
		}
	}
}