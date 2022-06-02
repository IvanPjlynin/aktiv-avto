<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use JSpeed\Plugin;
use JSpeed\Helper;
 
include_once dirname ( dirname ( __FILE__ ) ) . '/Framework/loader.php';
class JFormFieldAssets extends FormField {
	protected $type = 'Assets';
	public function setup(SimpleXMLElement $element, $value, $group = NULL) {
		$params = Plugin::getPluginParams ();

		static $cnt = 1;

		if ($cnt == 1) {
			$doc = Factory::getDocument ();
			
			// Include jQuery/Bootstrap framework
			$wa = $doc->getWebAssetManager();
			$wa->useScript('jquery');
			$wa->useScript('jquery-noconflict');
			array_map ( function ($script) use ($wa) {
				$wa->useScript ( 'bootstrap.' . $script );
			}, [
					'popover'
			] );
			
			$sScript = '';

			$wa = $doc->getWebAssetManager();
			$wa->registerAndUseStyle ( 'jspeed.bootstrap-interface', 'media/plg_jspeed/css/bootstrap-interface.css');
			$wa->registerAndUseStyle ( 'jspeed.select2', 'media/plg_jspeed/css/select2.min.css');
			$wa->registerAndUseScript ( 'jchat.bootstrap-interface', 'media/plg_jspeed/js/bootstrap-interface.js', [], [], ['jquery']);
			$wa->registerAndUseScript ( 'jchat.select2', 'media/plg_jspeed/js/select2.min.js', [], [], ['jquery']);
			
			$script = <<<EOL
			jQuery(function($){
				var smallText = $('div.control-group small.form-text').hide();
				smallText.each(function(index, elem){
					var parentContainer = $(elem).parents('div.control-group');
					var targetLabel = $('div.control-label label,div.controls legend', parentContainer);
					var sourceDescription = $(elem).html();
					targetLabel.attr('title', $(targetLabel.get(0)).text());
					targetLabel.attr('data-bs-content', sourceDescription);
					targetLabel.addClass('hasPopover');
					targetLabel.attr('aria-haspopup', 'true');
				});
				[].slice.call(document.querySelectorAll('div.control-group label.hasPopover,div.controls legend.hasPopover')).map(function (popoverEl) {
					return new bootstrap.Popover(popoverEl, {
												 "template":'<div class="popover"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
												 "container":"body",
												 "html":true,
												 "placement":"top",
												 "trigger":"hover focus"
					});
				});
			});
EOL;
			$doc->getWebAssetManager()->addInlineScript($script);
			
			$uri = clone Uri::getInstance ();
			$domain = $uri->toString ( array (
					'scheme',
					'user',
					'pass',
					'host',
					'port'
			) ) . Helper::getBaseFolder ();
			$plugin_path = 'plugins/system/jspeed/';

			$ajax_url = $domain . 'administrator/index.php?option=com_jspeed';

			// Optimize htaccess
			$optimizeHtaccess = Text::_('PLG_JSPEED_HTACCESS_SETUP', true);
			$optimizeHtaccessDesc = Text::_('PLG_JSPEED_HTACCESS_SETUP_DESC', true);
			$optimizeHtaccessURL = Uri::getInstance()->toString() . '&amp;jspeedtask=optimizehtaccess';
			
			// Restore htaccess
			$restoreHtaccess = Text::_('PLG_JSPEED_HTACCESS_RESTORE', true);
			$restoreHtaccessDesc = Text::_('PLG_JSPEED_HTACCESS_RESTORE_DESC', true);
			$restoreHtaccessURL = Uri::getInstance()->toString() . '&amp;jspeedtask=restorehtaccess';	
			
			// Clear cache
			$clearCache = Text::_('PLG_JSPEED_CLEAR_CACHE', true);
			$clearCacheDesc = Text::_('PLG_JSPEED_CLEAR_CACHE_DESC', true);
			$clearCacheURL = Uri::getInstance()->toString() . '&amp;jspeedtask=clearcache';
			$sScript .= <<<JSPEEDSCRIPTS
						var ajaxEndpoint = '$ajax_url';
						var jSpeedOptimizeHtaccessURL = '$optimizeHtaccessURL';
						var jSpeedRestoreHtaccessURL = '$restoreHtaccessURL';
						var jSpeedClearCacheURL = '$clearCacheURL';
						var PLG_JSPEED_HTACCESS_SETUP = '$optimizeHtaccess';
						var PLG_JSPEED_HTACCESS_SETUP_DESC = '$optimizeHtaccessDesc';
						var PLG_JSPEED_HTACCESS_RESTORE = '$restoreHtaccess';
						var PLG_JSPEED_HTACCESS_RESTORE_DESC = '$restoreHtaccessDesc';
						var PLG_JSPEED_CLEAR_CACHE = '$clearCache';
						var PLG_JSPEED_CLEAR_CACHE_DESC = '$clearCacheDesc';
JSPEEDSCRIPTS;

			$doc->getWebAssetManager()->addInlineScript ( $sScript );
		}

		$cnt ++;

		return false;
	}
	protected function getInput() {
		return false;
	}
}
