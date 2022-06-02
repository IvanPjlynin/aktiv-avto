<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Controller;

defined('_JEXEC') or die;

use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\ControllerEvents;
use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\CustomACL;
use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\RegisterControllerTasks;
use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\ReusableModels;
use Akeeba\Component\AkeebaBackup\Administrator\Model\BrowserModel;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

class BrowserController extends BaseController
{
	use ControllerEvents;
	use CustomACL;
	use RegisterControllerTasks;
	use ReusableModels;

	/**
	 * The default view.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $default_view = 'Browser';

	public function __construct($config = [], MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null)
	{
		parent::__construct($config, $factory, $app, $input);

		$this->registerControllerTasks('main');
	}

	public function onBeforeMain()
	{
		$folder        = $this->input->get('folder', '', 'string');
		$processFolder = $this->input->get('processfolder', 0, 'int');

		/** @var BrowserModel $model */
		$model = $this->getModel('Browser', 'Administrator', array('base_path' => $this->basePath));
		$model->setState('folder', $folder);
		$model->setState('processfolder', $processFolder);
		$model->makeListing();
	}

	public function main()
	{
		$this->display(false);
	}


}