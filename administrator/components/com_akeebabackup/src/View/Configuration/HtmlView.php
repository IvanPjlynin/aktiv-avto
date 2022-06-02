<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\View\Configuration;

defined('_JEXEC') || die;

use Akeeba\Component\AkeebaBackup\Administrator\View\Mixin\LoadAnyTemplate;
use Akeeba\Component\AkeebaBackup\Administrator\View\Mixin\ProfileIdAndName;
use Akeeba\Engine\Factory;
use Akeeba\Engine\Platform;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
	use ProfileIdAndName;
	use LoadAnyTemplate;

	/**
	 * Status of the settings encryption: -1 disabled by user, 0 not available, 1 enabled and active
	 *
	 * @var  int
	 */
	public $secureSettings = 0;

	/**
	 * Should I show the Configuration Wizard popup prompt?
	 *
	 * @var  bool
	 */
	public $promptForConfigurationwizard = false;

	public function display($tpl = null)
	{
		// Load our Javascript
		$wa = $this->document->getWebAssetManager();
		$wa->useScript('com_akeebabackup.configuration');

		// Set up the toolbar
		ToolbarHelper::title(Text::_('COM_AKEEBABACKUP_CONFIG'), 'icon-akeeba');

		ToolbarHelper::apply();
		ToolbarHelper::save();
		ToolbarHelper::custom('savenew', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
		ToolbarHelper::cancel();

		// Configuration wizard button. We apply styling to it.
		$bar = Toolbar::getInstance('toolbar');
		$bar->appendButton('Link', 'bolt', '<strong>' . Text::_('COM_AKEEBABACKUP_CONFWIZ') . '</strong>', 'index.php?option=com_akeebabackup&view=Configurationwizard');

		ToolbarHelper::spacer();

		if (AKEEBABACKUP_PRO)
		{
			$bar->appendButton('Link', 'calendar', Text::_('COM_AKEEBABACKUP_SCHEDULE'), 'index.php?option=com_akeebabackup&view=Schedule');
		}

		ToolbarHelper::preferences('com_akeebabackup', '500', '660');
		ToolbarHelper::help(null, false, 'https://www.akeeba.com/documentation/akeeba-backup-joomla/configuration.html');

		$js = <<< JS
window.addEventListener('DOMContentReady', function() {
    var elButtons = document.querySelectorAll('#toolbar-bolt>button');
    elButtons[0].classList += ' btn-primary';
});

JS;
		$wa->addInlineScript($js);

		// Get the backup profile ID and name
		$this->getProfileIdAndName();

		// Are the settings secured?
		$this->secureSettings = $this->getSecureSettingsOption();

		// Should I show the Configuration Wizard popup prompt?
		$this->promptForConfigurationwizard = Factory::getConfiguration()->get('akeeba.flag.confwiz', 0) != 1;

		// Push script options
		$urls = array(
			'browser'      => addslashes('index.php?option=com_akeebabackup&view=Browser&processfolder=1&tmpl=component&folder='),
			'testFtp'      => addslashes('index.php?option=com_akeebabackup&view=Configuration&task=testftp'),
			'testSftp'     => addslashes('index.php?option=com_akeebabackup&view=Configuration&task=testsftp'),
			'dpeauthopen'  => addslashes('index.php?option=com_akeebabackup&view=Configuration&task=dpeoauthopen&format=raw'),
			'dpecustomapi' => addslashes('index.php?option=com_akeebabackup&view=Configuration&task=dpecustomapi&format=raw'),
		);

		// Push script options
		$this->document->addScriptOptions('akeebabackup.Configuration.URLs', $urls);
		$this->document->addScriptOptions('akeebabackup.Configuration.GUIData', json_decode(Factory::getEngineParamsProvider()->getJsonGuiDefinition(), true));

		// Push translations
		Text::script('COM_AKEEBABACKUP_CONFIG_UI_BROWSE');
		Text::script('COM_AKEEBABACKUP_CONFIG_UI_CONFIG');
		Text::script('COM_AKEEBABACKUP_CONFIG_UI_REFRESH');
		Text::script('COM_AKEEBABACKUP_FILEFILTERS_LABEL_UIROOT');
		Text::script('COM_AKEEBABACKUP_CONFIG_UI_FTPBROWSER_TITLE');
		Text::script('COM_AKEEBABACKUP_CONFIG_DIRECTFTP_TEST_OK');
		Text::script('COM_AKEEBABACKUP_CONFIG_DIRECTFTP_TEST_FAIL');
		Text::script('COM_AKEEBABACKUP_CONFIG_DIRECTSFTP_TEST_OK');
		Text::script('COM_AKEEBABACKUP_CONFIG_DIRECTSFTP_TEST_FAIL');
		Text::script('COM_AKEEBABACKUP_CONFIG_UI_CUSTOM');
		Text::script('JYES');
		Text::script('JNO');

		parent::display($tpl);
	}

	/**
	 * Returns the support status of settings encryption. The possible values are:
	 * -1 Disabled by the user
	 *  0 Enabled by inactive (not supported by the server)
	 *  1 Enabled and active
	 *
	 * @return  int
	 */
	private function getSecureSettingsOption()
	{
		// Encryption is disabled by the user
		if (Platform::getInstance()->get_platform_configuration_option('useencryption', -1) == 0)
		{
			return -1;
		}

		// Encryption is not supported by this server
		if (!Factory::getSecureSettings()->supportsEncryption())
		{
			return 0;
		}

		$filename = AKEEBAROOT . '/serverkey.php';

		// Encryption enabled, supported and a key file is present: encryption enabled
		if (is_file($filename))
		{
			return 1;
		}

		// Encryption enabled, supported but and a key file is NOT present: encryption not available
		return 0;
	}

}