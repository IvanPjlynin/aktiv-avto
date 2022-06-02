<?php
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\String\StringHelper;
use JExtStore\Module\Jspeed\Administrator\Helper\JspeedHelper;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::modules
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die;

$jSpeedPlugin = JspeedHelper::getPlugin();
if(is_array($jSpeedPlugin) && empty($jSpeedPlugin)) {
	echo '<div class="container jspeed-module-container">' . Text::_('MOD_JSPEED_JSPEED_PLUGIN_UNPUBLISHED') . '</div>';
	return;
}

$pluginParams = json_decode($jSpeedPlugin->params, true);

// Compat update
if(!array_key_exists('enable_instant_page', $pluginParams)) {
	$pluginParams['enable_instant_page'] = 0;
}

$showItemsLeft = array (
		 0 => array('combine_files_enable', 'flash'),
		 1 => array('css_minify', 'contract'),
 		 2 => array('html_minify', 'contract'),
 		 3 => array('font_display_swap', 'dashboard'),
 		 4 => array('defer_combined_js', 'unblock'),
		 5 => array('load_asynchronous', 'arrow-down-4'),
		 6 => array('load_css_byjs', 'cogs'),
		 7 => array('lazyload', 'pictures'),
		 8 => array('lazyload_include_iframes', 'file'),
		 9 => array('http2_push_enabled', 'link'),
		 10 => array('inline_style', 'cube'),
		 11 => array('enable_instant_page', 'flash'),
		 12 => array('adaptive_contents_enable', 'shuffle')
);
$showItemsRight = array (
		0 => array('css', 'box-add'),
		1 => array('javascript', 'box-add'),
		2 => array('js_minify', 'contract'),
		3 => array('cache_lifetime', 'database'),
		4 => array('defer_combined_css', 'unblock'),
		5 => array('bottom_js', 'download'),
		6 => array('load_js_byjs', 'cogs'),
		7 => array('lazyload_html_enable', 'grid'),
		8 => array('lightimgs_status', 'pictures'),
		9 => array('preload_font_face', 'arrow-up-4'),
		10 => array('inline_scripts', 'cube'),
		11 => array('defer_js', 'unblock'),
		12 => array('combinedimage_enabled', 'pictures')
);
$numRows = count($showItemsLeft);
$app->getDocument()->getWebAssetManager()->addInlineStyle('div.jspeed-module-title{margin-top:5px}div.jspeed-module-container div.col-lg-4{font-size:12px;align-items:center;display:flex}div.jspeed-module-container div.col-lg-4 span{font-size:16px;margin-right: 5px}div.mod-jspeed-title{padding-bottom:10px;display:flex;align-items:center;border-bottom:1px solid #dee2e6!important}div.mod-jspeed-title + div.row > div.col-lg-4:first-child{font-weight: bold;background: #f9d71c;border-radius: 5px;border: 1px solid #949da5;padding: 1px 15px 0 15px}@media(max-width:991px){div.jspeed-module-container div.col{flex:1 0 200px}div.jspeed-module-container div.col-lg-2:nth-child(2){margin-bottom:10px}}');
?>
<div class="container jspeed-module-container">
	<div class="row mod-jspeed-title">
		<div class="col col-lg-4 jspeed-module-title">
			<?php echo Text::_('MOD_JSPEED_ACCESS_CONFIG'); ?>
		</div>
		<div class="col col-lg-8">
			<a href="index.php?option=com_plugins&task=plugin.edit&extension_id=<?php echo $jSpeedPlugin->id;?>" class="btn btn-sm btn-primary"><span class="icon-edit"></span> <?php echo Text::_('MOD_JSPEED_OPEN_CONFIG'); ?></a>
		</div>
	</div>
	<?php for($i = 0;$i < $numRows; $i++):
		$leftItem = $showItemsLeft[$i];
		$rightItem = $showItemsRight[$i];
		?>
		<div class="row pt-2 pb-2 border-bottom">
			<div class="col col-lg-4">
				<span class="icon-<?php echo $leftItem[1];?>" aria-hidden="true"></span> <?php echo Text::_('MOD_JSPEED_' . StringHelper::strtoupper($leftItem[0])); ?>
			</div>
			<div class="col col-lg-2">
				<?php if(!in_array($leftItem[0], array('cache_lifetime'))):?>
					<?php $enabledClassState = $pluginParams[$leftItem[0]] ? 'success' : 'secondary';?>
					<span class="badge bg-<?php echo $enabledClassState;?>"><?php echo $enabledClassState == 'success' ? Text::_('MOD_JSPEED_ENABLED') : Text::_('MOD_JSPEED_DISABLED');?></span>
				<?php else:?>
					<span class="badge bg-primary"><?php echo $pluginParams[$leftItem[0]];?></span>
				<?php endif;?>
			</div>
			
			<div class="col col-lg-4">
				<span class="icon-<?php echo $rightItem[1];?>" aria-hidden="true"></span> <?php echo Text::_('MOD_JSPEED_' . StringHelper::strtoupper($rightItem[0])); ?>
			</div>
			<div class="col col-lg-2">
				<?php if(!in_array($rightItem[0], array('cache_lifetime'))):?>
					<?php $enabledClassState = $pluginParams[$rightItem[0]] ? 'success' : 'secondary';?>
					<span class="badge bg-<?php echo $enabledClassState;?>"><?php echo $enabledClassState == 'success' ? Text::_('MOD_JSPEED_ENABLED') : Text::_('MOD_JSPEED_DISABLED');?></span>
				<?php else:?>
					<span class="badge bg-primary"><?php echo $pluginParams[$rightItem[0]];?></span>
				<?php endif;?>
			</div>
		</div>
	<?php endfor;?>
</div>