<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Dispatcher\Mixin;

defined('_JEXEC') || die();

use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Joomla\CMS\Factory as JoomlaFactory;

trait AkeebaEngineAware
{
	public function loadAkeebaEngine()
	{
		$app = property_exists($this, 'app') ? $this->app : JoomlaFactory::getApplication();

		// Necessary defines for Akeeba Engine
		if (!defined('AKEEBAENGINE'))
		{
			define('AKEEBAENGINE', 1);
		}

		if (!defined('AKEEBAROOT'))
		{
			define('AKEEBAROOT', realpath(__DIR__ . '/../../../engine'));
		}

		if (!defined('AKEEBA_CACERT_PEM'))
		{
			$caCertPath = class_exists('\\Composer\\CaBundle\\CaBundle')
				? \Composer\CaBundle\CaBundle::getBundledCaBundlePath()
				: JPATH_LIBRARIES . '/src/Http/Transport/cacert.pem';

			define('AKEEBA_CACERT_PEM', $caCertPath);
		}

		// Make sure we have a profile set throughout the component's lifetime
		$profile_id = $app->getSession()->get('akeebabackup.profile', null);

		if (is_null($profile_id))
		{
			$app->getSession()->set('akeebabackup.profile', 1);
		}

		// Load Akeeba Engine
		require_once __DIR__ . '/../../../engine/Factory.php';
	}

	public function loadAkeebaEngineConfiguration()
	{
		Platform::addPlatform('joomla', __DIR__ . '/../../../platform/Joomla');

		$akeebaEngineConfig = Factory::getConfiguration();

		Platform::getInstance()->load_configuration();

		unset($akeebaEngineConfig);
	}
}