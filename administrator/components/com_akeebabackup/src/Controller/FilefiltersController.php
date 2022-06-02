<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Controller;

defined('_JEXEC') || die;

use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\AjaxAware;
use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\ControllerEvents;
use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\CustomACL;
use Akeeba\Component\AkeebaBackup\Administrator\Controller\Mixin\ReusableModels;

class FilefiltersController extends DatabasefiltersController
{
	use ControllerEvents;
	use CustomACL;
	use ReusableModels;
	use AjaxAware;
}