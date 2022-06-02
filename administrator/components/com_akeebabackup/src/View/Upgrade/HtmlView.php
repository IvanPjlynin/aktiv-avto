<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\View\Upgrade;

defined('_JEXEC') || die;

use Akeeba\Component\AkeebaBackup\Administrator\Model\UpgradeModel;
use Akeeba\Component\AkeebaBackup\Administrator\View\Mixin\LoadAnyTemplate;
use Akeeba\Component\AkeebaBackup\Administrator\View\Mixin\TaskBasedEvents;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	use TaskBasedEvents;
	use LoadAnyTemplate;

	public $needsMigration = false;

	public $hasCompatibleVersion = false;

	protected function onBeforeMain()
	{
		$this->addToolbar();

		/** @var UpgradeModel $model */
		$model = $this->getModel();

		$this->needsMigration = in_array(true, $model->runCustomHandlerEvent('onNeedsMigration'), true);
		$this->hasCompatibleVersion = in_array(true, $model->runCustomHandlerEvent('onHasCompatibleAkeebaVersion'), true);
	}

	private function addToolbar(): void
	{
		$toolbar = Toolbar::getInstance();
		ToolbarHelper::title(Text::_('COM_AKEEBABACKUP_UPGRADE'), 'icon-akeeba');

		$toolbar->back()
			->text('COM_AKEEBABACKUP_CONTROLPANEL')
			->icon('fa fa-' . (Factory::getApplication()->getLanguage()->isRtl() ? 'arrow-right' : 'arrow-left'))
			->url('index.php?option=com_akeebabackup');

		$toolbar->help(null, false, 'https://www.akeeba.com/documentation/akeeba-backup-joomla/using-akeeba-backup-component.html#menu-upgrade');
	}
}