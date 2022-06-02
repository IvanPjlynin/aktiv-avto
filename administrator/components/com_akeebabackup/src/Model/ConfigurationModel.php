<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Model;

defined('_JEXEC') or die;

use Akeeba\Engine\Archiver\Directftp;
use Akeeba\Engine\Archiver\Directsftp;
use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Akeeba\Engine\Util\Transfer\FtpCurl;
use Akeeba\Engine\Util\Transfer\SftpCurl;
use Exception;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Factory as JoomlaFactory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseModel;
use Joomla\CMS\Uri\Uri;
use RuntimeException;

class ConfigurationModel extends BaseModel
{
	/**
	 * Method to get state variables. Uses application input if the state is not set.
	 *
	 * @param   null   $property  Optional parameter name
	 * @param   mixed  $default   Optional default value
	 *
	 * @return  mixed  The property where specified, the state object where omitted
	 *
	 * @since   4.0.0
	 */
	public function getState($property = null, $default = null)
	{
		try
		{
			$default = JoomlaFactory::getApplication()->input
				->get($property, $default, is_array($default) ? 'array' : 'raw');
		}
		catch (Exception $e)
		{
		}

		return parent::getState($property, $default);
	}

	/**
	 * Save the engine configuration
	 *
	 * @return  void
	 * @throws  Exception
	 */
	public function saveEngineConfig(): void
	{
		/** @var CMSApplication $app */
		$app  = JoomlaFactory::getApplication();
		$data = $this->getState('engineconfig', []);

		// Forbid stupidly selecting the site's root as the output or temporary directory
		if (array_key_exists('akeeba.basic.output_directory', $data))
		{
			$folder = $data['akeeba.basic.output_directory'];
			$folder = Factory::getFilesystemTools()->translateStockDirs($folder, true, true);
			$check  = Factory::getFilesystemTools()->translateStockDirs('[SITEROOT]', true, true);

			if ($check == $folder)
			{
				$data['akeeba.basic.output_directory'] = '[DEFAULT_OUTPUT]';
			}
			else
			{
				$data['akeeba.basic.output_directory'] = Factory::getFilesystemTools()->rebaseFolderToStockDirs($data['akeeba.basic.output_directory']);
			}
		}

		// Unprotect the configuration and merge it
		$config        = Factory::getConfiguration();
		$protectedKeys = $config->getProtectedKeys();
		$config->resetProtectedKeys();
		$config->mergeArray($data, false, false);
		$config->setProtectedKeys($protectedKeys);

		// Save configuration
		Platform::getInstance()->save_configuration();
	}

	/**
	 * Test the FTP connection.
	 *
	 * @return  void
	 * @throws  RuntimeException
	 */
	public function testFTP(): void
	{
		$config = [
			'host'    => $this->getState('host'),
			'port'    => $this->getState('port'),
			'user'    => $this->getState('user'),
			'pass'    => $this->getState('pass'),
			'initdir' => $this->getState('initdir'),
			'usessl'  => $this->getState('usessl'),
			'passive' => $this->getState('passive'),
		];

		// Check for bad settings
		if (substr($config['host'], 0, 6) == 'ftp://')
		{
			throw new RuntimeException(Text::_('COM_AKEEBABACKUP_CONFIG_FTPTEST_BADPREFIX'), 500);
		}

		// Special case for cURL transport
		if ($this->getState('isCurl'))
		{
			$this->testFtpCurl();

			return;
		}

		// Perform the FTP connection test
		$test = new Directftp();

		$test->initialize('', $config);
	}

	/**
	 * Test the SFTP connection.
	 *
	 * @return  void
	 * @throws  RuntimeException
	 */
	public function testSFTP(): void
	{
		$config = [
			'host'    => $this->getState('host'),
			'port'    => $this->getState('port'),
			'user'    => $this->getState('user'),
			'pass'    => $this->getState('pass'),
			'privkey' => $this->getState('privkey'),
			'pubkey'  => $this->getState('pubkey'),
			'initdir' => $this->getState('initdir'),
		];

		// Check for bad settings
		if (substr($config['host'], 0, 7) == 'sftp://')
		{
			throw new RuntimeException(Text::_('COM_AKEEBABACKUP_CONFIG_SFTPTEST_BADPREFIX'), 500);
		}

		// Special case for cURL transport
		if ($this->getState('isCurl'))
		{
			$this->testSftpCurl();

			return;
		}

		// Perform the FTP connection test
		$test = new Directsftp();

		$test->initialize('', $config);
	}

	/**
	 * Opens an OAuth window for the selected post-processing engine
	 *
	 * @return  void
	 * @throws  Exception
	 */
	public function dpeOuthOpen(): void
	{
		$engine = $this->getState('engine');
		$params = $this->getState('params', []);

		// Get a callback URI for OAuth 2
		$params['callbackURI'] = rtrim(Uri::base(), '/') . '/index.php?option=com_akeebabackup&view=Configuration&task=dpecustomapiraw&engine=' . $engine;

		// Get the Input object
		$params['input'] = JoomlaFactory::getApplication()->input->getArray();

		// Get the engine
		$engineObject = Factory::getPostprocEngine($engine);

		if ($engineObject === false)
		{
			return;
		}

		$engineObject->oauthOpen($params);
	}

	/**
	 * Runs a custom API call for the selected post-processing engine
	 *
	 * @return  mixed
	 */
	public function dpeCustomAPICall()
	{
		$engine = $this->getState('engine');
		$method = $this->getState('method');
		$params = $this->getState('params', []);

		// Get the Input object
		$params['input'] = JoomlaFactory::getApplication()->input->getArray();

		$engineObject = Factory::getPostprocEngine($engine);

		if ($engineObject === false)
		{
			return false;
		}

		return $engineObject->customAPICall($method, $params);
	}

	/**
	 * Test the connection to a remote FTP server using cURL transport
	 *
	 * @return  void
	 * @throws  RuntimeException
	 */
	private function testFtpCurl(): void
	{
		$options = [
			'host'        => $this->getState('host'),
			'port'        => $this->getState('port'),
			'username'    => $this->getState('user'),
			'password'    => $this->getState('pass'),
			'directory'   => $this->getState('initdir'),
			'usessl'      => $this->getState('usessl'),
			'passive'     => $this->getState('passive'),
			'passive_fix' => $this->getState('passive_mode_workaround'),
		];

		$sftpTransfer = new FtpCurl($options);

		$sftpTransfer->connect();
	}

	/**
	 * Test the connection to a remote SFTP server using cURL transport
	 *
	 * @return  void
	 * @throws  RuntimeException
	 */
	private function testSftpCurl(): void
	{
		$options = [
			'host'       => $this->getState('host'),
			'port'       => $this->getState('port'),
			'username'   => $this->getState('user'),
			'password'   => $this->getState('pass'),
			'directory'  => $this->getState('initdir'),
			'privateKey' => $this->getState('privkey'),
			'publicKey'  => $this->getState('pubkey'),
		];

		$sftpTransfer = new SftpCurl($options);

		$sftpTransfer->connect();
	}
}