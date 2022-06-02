<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Component\ComponentHelper;

require_once JPATH_COMPONENT_ADMINISTRATOR . '/builder/classes/base.php';
require_once JPATH_COMPONENT_ADMINISTRATOR . '/builder/classes/config.php';

$doc = Factory::getDocument();
$app = Factory::getApplication();
$params = ComponentHelper::getParams('com_sppagebuilder');

SppagebuilderHelperSite::addStylesheet('pbfont.css', 'admin');

$doc->addScriptdeclaration('var useGoogleFonts = ' . $params->get('google_fonts', 0) .';');

if ($params->get('fontawesome', 1)) {
	SppagebuilderHelperSite::addStylesheet('font-awesome-5.min.css');
	SppagebuilderHelperSite::addStylesheet('font-awesome-v4-shims.css');
}

if (!$params->get('disableanimatecss', 0)) {
	SppagebuilderHelperSite::addStylesheet('animate.min.css');
}

if (!$params->get('disablecss', 0)) {
	SppagebuilderHelperSite::addStylesheet('sppagebuilder.css');
}

SppagebuilderHelperSite::addStylesheet('react-select.css');
SppagebuilderHelperSite::addStylesheet('edit.css');

HTMLHelper::_('jquery.framework');

$doc->addScriptdeclaration('var pagebuilder_base="' . Uri::root() . '";');
SppagebuilderHelper::loadEditor();
SppagebuilderHelperSite::addScript('actions.js');
SppagebuilderHelperSite::addScript('csslint.js');

if ($this->item->extension == 'com_content' && $this->item->extension_view == 'article')
{
	$extension_view = 'article';
}
elseif ($this->item->extension === 'com_spsimpleportfolio' && $this->item->extension_view === 'item')
{
	$extension_view = 'portfolio';
}
else
{
	$extension_view = 'page';
}

$menus = $app->getMenu();
$menu = $menus->getActive();
$menuClassPrefix = '';
$showPageHeading = 0;

// check active menu item
if ($menu) {
	$menuClassPrefix 	= $menu->getParams()->get('pageclass_sfx');
	$showPageHeading 	= $menu->getParams()->get('show_page_heading');
	$menuheading 		= $menu->getParams()->get('page_heading');
}

require_once JPATH_COMPONENT_ADMINISTRATOR . '/builder/classes/addon.php';
$this->item->text = SpPageBuilderAddonHelper::__($this->item->text, true);

SpPgaeBuilderBase::loadAddons();

$fa_icon_list     = SpPgaeBuilderBase::getIconList(); // Icon List
$animateNames     = SpPgaeBuilderBase::getAnimationsList(); // Animation Names
$accessLevels     = SpPgaeBuilderBase::getAccessLevelList(); // Access Levels
$article_cats     = SpPgaeBuilderBase::getArticleCategories(); // Article Categories
$moduleAttr       = SpPgaeBuilderBase::getModuleAttributes(); // Module Postions and Module Lits
$rowSettings      = SpPgaeBuilderBase::getRowGlobalSettings(); // Row Settings Attributes
$columnSettings   = SpPgaeBuilderBase::getColumnGlobalSettings(); // Column Settings Attributes
$global_attributes = SpPgaeBuilderBase::addonOptions();

$addons_list = SpAddonsConfig::$addons;
$globalDefault = SpPgaeBuilderBase::getSettingsDefaultValue($global_attributes);

/**
 * This block of code added for sppbtranslate component support.
 * @since 3.7.10
 */
PluginHelper::importPlugin('system');


foreach ($addons_list as &$addon) {
	$new_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($addon['attr']);
	$default_value = array(
		'default' => array_merge($new_default_value['default'], $globalDefault['default'])
	);
	$addon['default'] = $default_value['default'];
	// if(isset($default_value['attr'])){
	// 	$addon['attr'] = $default_value['attr'];
	// }
	$addon['visibility'] = true;

	if (!isset($addon['category']) || empty($addon['category'])) {
		$addon['category'] = 'General';
	}

	$addon_name = preg_replace('/^sp_/i', '', $addon['addon_name']);
	$class_name = 'SppagebuilderAddon' . ucfirst($addon_name);
	if (method_exists($class_name, 'getTemplate')) {
		$addon['js_template'] = true;
	}

	/**
	 * This block of code added for sppbtranslate component support.
	 * @since 3.7.10
	 */
	if (JVERSION < 4) {
		$dispatcher = JDispatcher::getInstance();
		$dispatcher->trigger('onBeforeAddonConfigure', array($addon_name, &$addon));
	} else {
		Factory::getApplication()->triggerEvent('onBeforeAddonConfigure', array($addon_name, &$addon));
	}
}

unset($addon);

$row_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($rowSettings['attr']);
$rowSettings['default'] = $row_default_value;

$column_default_value = SpPgaeBuilderBase::getSettingsDefaultValue($columnSettings['attr']);
$columnSettings['default'] = $column_default_value;


SpPgaeBuilderBase::loadAssets($addons_list);
$addon_cats = SpPgaeBuilderBase::getAddonCategories($addons_list);
$doc->addScriptdeclaration('var addonsJSON=' . json_encode($addons_list) . ';');
$doc->addScriptdeclaration('var addonCats=' . json_encode($addon_cats) . ';');

// Global Attributes
$doc->addScriptdeclaration('var globalAttr=' . json_encode($global_attributes) . ';');
$doc->addScriptdeclaration('var faIconList=' . json_encode($fa_icon_list) . ';');
$doc->addScriptdeclaration('var animateNames=' . json_encode($animateNames) . ';');
$doc->addScriptdeclaration('var accessLevels=' . json_encode($accessLevels) . ';');
$doc->addScriptdeclaration('var articleCats=' . json_encode($article_cats) . ';');
$doc->addScriptdeclaration('var moduleAttr=' . json_encode($moduleAttr) . ';');
$doc->addScriptdeclaration('var rowSettings=' . json_encode($rowSettings) . ';');
$doc->addScriptdeclaration('var colSettings=' . json_encode($columnSettings) . ';');
$doc->addScriptdeclaration('var sppbVersion="' . SppagebuilderHelperSite::getVersion() . '";');

// Media
$mediaParams = ComponentHelper::getParams('com_media');
$doc->addScriptdeclaration('var sppbMediaPath=\'/' . $mediaParams->get('file_path', 'images') . '\';');

$doc->addScriptdeclaration('var sppbSvgShape=' . json_encode(SppagebuilderHelperSite::getSvgShapes()) . ';');
$doc->addScriptdeclaration('var extensionView=\'' . $extension_view . '\';');

if (!$this->item->text) {
	$doc->addScriptdeclaration('var initialState=[];');
} else {
	$doc->addScriptdeclaration('var initialState=' . $this->item->text . ';');
}
?>

<div id="sp-page-builder" class="sp-pagebuilder <?php echo $menuClassPrefix; ?> page-<?php echo $this->item->id; ?>" data-pageid="<?php echo $this->item->id; ?>">
	<form action="<?php echo Route::_('index.php?option=com_sppagebuilder&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate page-builder-form" style="display: none;">
		<div id="page-options">
			<?php $fieldsets = $this->form->getFieldsets(); ?>

			<div class="sp-pagebuilder-form-group-toggler active">
				<span>Basic <span class="fa fa-chevron-right"></span></span>
				<div>
					<?php foreach ($this->form->getFieldset('basic') as $key => $field) : ?>
						<div class="sp-pagebuilder-form-group">
							<?php echo $field->label; ?>
							<?php echo $field->input; ?>
							<?php if ($field->getAttribute('desc')) : ?>
								<span class="sp-pagebuilder-form-help"><?php echo Text::_($field->getAttribute('desc')); ?></span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php if ($extension_view == 'page') : ?>
				<div class="sp-pagebuilder-form-group-toggler">
					<span>SEO <span class="fa fa-chevron-right"></span></span>
					<div>
						<?php foreach ($this->form->getFieldset('seo') as $key => $field) : ?>
							<div class="sp-pagebuilder-form-group">
								<?php echo $field->label; ?>
								<?php echo $field->input; ?>
								<?php if ($field->getAttribute('desc')) : ?>
									<span class="sp-pagebuilder-form-help"><?php echo Text::_($field->getAttribute('desc')); ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($extension_view == 'page') : ?>
				<div class="sp-pagebuilder-form-group-toggler">
					<span>Page CSS <span class="fa fa-chevron-right"></span></span>
					<div>
						<?php foreach ($this->form->getFieldset('pagecss') as $key => $field) : ?>
							<div class="sp-pagebuilder-form-group">
								<?php echo $field->label; ?>
								<?php echo $field->input; ?>
								<?php if ($field->getAttribute('desc')) : ?>
									<span class="sp-pagebuilder-form-help"><?php echo Text::_($field->getAttribute('desc')); ?></span>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<input type="hidden" id="form_task" name="task" value="page.apply" />
		<?php
		$app = Factory::getApplication();
		$input = $app->input;
		$Itemid = $input->get('Itemid', 0, 'INT');

		$url = Route::_('index.php?option=com_sppagebuilder&view=page&id=' . $this->item->id . '&Itemid=' . $Itemid);
		$root = Uri::base();
		$root = new Uri($root);
		$pageUrl = $root->getScheme() . '://' . $root->getHost() . $url;
		?>
		<input type="hidden" id="return_page" name="return_page" value="<?php echo base64_encode($pageUrl); ?>" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</form>

	<?php if ($this->item->id && $extension_view == 'page') : ?>
		<form action="" method="post" class="form-validate page-builder-form-menu" style="display: none;">
			<div id="add-to-menu">
				<?php foreach ($this->form->getFieldset('addtomenu') as $key => $field) : ?>
					<div class="sp-pagebuilder-form-group">
						<?php echo $field->label; ?>
						<?php echo $field->input; ?>
						<?php if ($field->getAttribute('desc')) : ?>
							<span class="sp-pagebuilder-form-help"><?php echo Text::_($field->getAttribute('desc')); ?></span>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				<button type="submit" id="sp-pagebuilder-btn-add-to-menu" class="sp-pagebuilder-btn sp-pagebuilder-btn-success sp-pagebuilder-btn-add-to-menu"><?php echo $this->item->menuid ? '<i class="fa fa-save"></i> Update Menu' : '<i class="fa fa-plus-circle"></i> <span>Add to Menu</span>'; ?></button>
			</div>
		</form>
	<?php endif; ?>

	<div id="sp-pagebuilder-container">
		<div class="sp-pagebuilder-loading-wrapper">
			<div class="sp-pagebuilder-loading">
				<i class="pbfont pbfont-pagebuilder"></i>
			</div>
		</div>
	</div>
	<iframe name="sp-pagebuilder-view" id="sp-pagebuilder-view" data-url="<?php echo Uri::root(); ?>index.php?option=com_sppagebuilder&view=form&id=<?php echo $this->item->id; ?>&layout=edit-iframe&Itemid=<?php echo $Itemid; ?>"></iframe>
	<div id="sp-pagebuilder-page-tools" class="sp-pagebuilder-page-tools"></div>
</div>

<div class="sp-pagebuilder-media-modal-overlay" style="display:none">
	<div id="sp-pagebuilder-media-modal">
	</div>
</div>

<?php
foreach ($addons_list as $addon) {
	$addon_name = $addon['addon_name'];
	$addon_name = preg_replace('/^sp_/i', '', $addon['addon_name']);
	$class_name = 'SppagebuilderAddon' . ucfirst($addon_name);
	if (method_exists($class_name, 'getTemplate')) {
?>
		<script id="sppb-tmpl-addon-<?php echo $addon_name; ?>" type="x-tmpl-lodash">
			<#
			var addonClass = 'clearfix';
			var addonAttr = '';
			var addonId = 'sppb-addon-'+data.id;
			var addonName = '<?php echo $addon_name; ?>';

			var textColor = data.global_text_color || '';
			var linkColor = data.global_link_color || '';
			var linkHoverColor = data.global_link_hover_color || '';
			var backgroundRepeat = data.global_background_repeat || '';
			var backgroundSize = data.global_background_size || '';
			var backgroundAttachment = data.global_background_attachment || '';
			var backgroundPosition = data.global_background_position || '';
			var modern_font_style = false;
			var title_font_style = data.title_fontstyle || "";

			var backgroundColor = '';
			if(data.global_background_color){
				backgroundColor = data.global_background_color;
			}

			var backgroundImage = '';
			var globalBgImg = {}
			if (typeof data.global_background_image !== "undefined" && typeof data.global_background_image.src !== "undefined") {
				globalBgImg = data.global_background_image
			} else {
				globalBgImg = {src: data.global_background_image}
			}

			if(globalBgImg.src && (globalBgImg.src?.indexOf('http://') != -1 || globalBgImg.src?.indexOf('https://') != -1)){
				backgroundImage = 'url('+globalBgImg.src+')';
			} else if(globalBgImg.src){
				backgroundImage = 'url('+pagebuilder_base+globalBgImg.src+')';
			}

			let borderWidth = '';
			let borderWidth_sm = '';
			let borderWidth_xs = '';
			if(data.global_user_border && _.isObject(data.global_border_width)){
				borderWidth = data.global_border_width.md+'px';
				borderWidth_sm = data.global_border_width.sm+'px';
				borderWidth_xs = data.global_border_width.xs+'px';
			} else {
				borderWidth = data.global_border_width+'px';
			}

			let borderColor = '';
			if(data.global_user_border && data.global_border_color){
				borderColor = data.global_border_color;
			}

			let borderStyle = '';
			if(data.global_user_border && data.global_boder_style){
				borderStyle = data.global_boder_style;
			}

			let borderRadius = data.global_border_radius || '';

			var margin = window.getMarginPadding(data.global_margin, 'margin');
			var padding = window.getMarginPadding(data.global_padding, 'padding');

			if(data.global_use_animation && data.global_animation){
				addonClass += ' sppb-wow '+data.global_animation;

				if(data.global_animationduration){
					addonAttr = ' data-sppb-wow-duration="'+data.global_animationduration+'ms"';
				}

				if(data.global_animationdelay){
					addonAttr = ' data-sppb-wow-delay="'+data.global_animationdelay+'ms"';
				}
			}

			var boxShadow = '';
			if(_.isObject(data.global_boxshadow)){
				let ho = data.global_boxshadow.ho || 0,
					vo = data.global_boxshadow.vo || 0,
					blur = data.global_boxshadow.blur || 0,
					spread = data.global_boxshadow.spread || 0,
					color = data.global_boxshadow.color || 0;

				boxShadow = ho+'px '+vo+'px '+blur+'px '+spread+'px '+color;
			} else {
				boxShadow = data.global_boxshadow || '';
			}
		#>
		<div id="{{ addonId }}" class="{{ addonClass }}" {{{ addonAttr }}} >
			<# if(data.global_use_overlay){ #>
				<div class="sppb-addon-overlayer"></div>
			<# } #>
			<style type="text/css">
				<#
				let unitTop = typeof data.global_addon_position_top !== "undefined" && typeof data.global_addon_position_top.unit !== "undefined" ? data.global_addon_position_top.unit : "px";
				let unitLeft = typeof data.global_addon_position_left !== "undefined" && typeof data.global_addon_position_left.unit !== "undefined" ? data.global_addon_position_left.unit : "px";

				if(data.global_seclect_position == "absolute" || data.global_seclect_position == "fixed"){
				#>
					#sp-page-builder div#sppb-addon-{{ data.id }} { 
						margin: 0;
					}
				<# } #>
				#sp-page-builder div#addon-wrap-{{ data.id }} { 
					<# if (addonName === "empty_space") { #>
						position:static;
					<# } #>
					<# if(data.global_custom_position && data.global_seclect_position){ #>
						<# if(data.global_seclect_position == "absolute"){ #>
							position:absolute;
						<# } else if(data.global_seclect_position == "fixed"){ #>
							position:fixed;
						<# }
						if(_.isObject(data.global_addon_position_top)) {
						#>
							top:{{data.global_addon_position_top.md}}{{unitTop}};
						<# } else { #>
							top:{{data.global_addon_position_top}}{{unitTop}};
						<# }
						if(_.isObject(data.global_addon_position_left)) {
						#>
							left:{{data.global_addon_position_left.md}}{{unitLeft}};
						<# } else { #>
							left:{{data.global_addon_position_left}}{{unitLeft}};
						<# }
						if(data.global_addon_z_index) {
						#>
							z-index:{{data.global_addon_z_index}};
						<# }
					} #>
					<# if(_.isObject(margin)){ #>
						{{{ margin.md }}}
					<# } else { #>
						{{{ margin }}}
					<# }
					if(typeof data.use_global_width !== "undefined" && data.use_global_width && typeof data.global_width !== "undefined" && _.isObject(data.global_width)) {
					#>
						width: {{data.global_width.md}}%;
					<# } #>
				}

				#{{ addonId }}{
					color: {{ textColor }};
					<# if(typeof data.global_background_type === "undefined" && backgroundColor){ #>
						background-color: {{ backgroundColor }};
					<# } else { #>
						<# if(data.global_background_type == "color" || data.global_background_type == "image" && backgroundColor){ #>
							background-color: {{ backgroundColor }};
						<# } #>
					<# } #>
					<# if(data.global_background_type == "gradient" && _.isObject(data.global_background_gradient)){ #>
						<# if(typeof data.global_background_gradient.type !== 'undefined' && data.global_background_gradient.type == 'radial'){ #>
							background-image: radial-gradient(at {{ data.global_background_gradient.radialPos || 'center center'}}, {{ data.global_background_gradient.color }} {{ data.global_background_gradient.pos || 0 }}%, {{ data.global_background_gradient.color2 }} {{ data.global_background_gradient.pos2 || 100 }}%);
						<# } else { #>
							background-image: linear-gradient({{ data.global_background_gradient.deg || 0}}deg, {{ data.global_background_gradient.color }} {{ data.global_background_gradient.pos || 0 }}%, {{ data.global_background_gradient.color2 }} {{ data.global_background_gradient.pos2 || 100 }}%);
						<# } #>
					<# } #>
					<# if(typeof data.global_background_type === "undefined" ){ #>
						<# if(data.global_use_background){ #>
							background-image: {{ backgroundImage }};
							background-repeat: {{ backgroundRepeat }};
							background-size: {{ backgroundSize }};
							background-attachment: {{ backgroundAttachment }};
							background-position: {{ backgroundPosition }};
						<# } #>
					<# } else { #>
						<# if(data.global_background_type == "image" && backgroundImage){ #>
							background-image: {{ backgroundImage }};
							background-repeat: {{ backgroundRepeat }};
							background-size: {{ backgroundSize }};
							background-attachment: {{ backgroundAttachment }};
							background-position: {{ backgroundPosition }};
						<# } #>
					<# } #>
					<# if(_.isObject(borderRadius)){ #>
						border-radius: {{ borderRadius.md }}px;
					<# } else { #>
						border-radius: {{ borderRadius }}px;
					<# }
					if(_.isObject(padding)){
					#>
						{{{ padding.md }}}
					<# } else { #>
						{{{ padding }}}
					<# } #>
					border-width: {{ borderWidth }};
					border-color: {{ borderColor }};
					border-style: {{ borderStyle }};
					box-shadow: {{ boxShadow }};
					<# if(data.global_use_overlay){ #>
						position: relative;
						overflow: hidden;
					<# } #>
				}
				<# if(data.global_use_overlay){ #>
					#{{ addonId }} .sppb-addon-overlayer{

						<# if(typeof data.global_overlay_type == "undefined"){
							data.global_overlay_type = "overlay_color";
						} #>
						<# if(data.global_overlay_type == "overlay_color") { #>
							background-color: {{ data.global_background_overlay }};
						<# }

						if(data.global_background_type == "image" && backgroundImage){
							if(data.global_overlay_type == "overlay_gradient" && _.isObject(data.global_gradient_overlay)){
								if(typeof data.global_gradient_overlay.type !== 'undefined' && data.global_gradient_overlay.type == 'radial'){
						#>
									background: radial-gradient(at {{ data.global_gradient_overlay.radialPos || 'center center'}}, {{ data.global_gradient_overlay.color }} {{ data.global_gradient_overlay.pos || 0 }}%, {{ data.global_gradient_overlay.color2 }} {{ data.global_gradient_overlay.pos2 || 100 }}%);
								<# } else { #>
									background: linear-gradient({{ data.global_gradient_overlay.deg || 0}}deg, {{ data.global_gradient_overlay.color }} {{ data.global_gradient_overlay.pos || 0 }}%, {{ data.global_gradient_overlay.color2 }} {{ data.global_gradient_overlay.pos2 || 100 }}%);
								<# }
							}
							var patternImgBg = {}
							if (typeof data.global_pattern_overlay !== "undefined" && typeof data.global_pattern_overlay.src !== "undefined") {
								patternImgBg = data.global_pattern_overlay
							} else {
								patternImgBg = {src: data.global_pattern_overlay}
							}
							if(patternImgBg.src && data.global_overlay_type == "overlay_pattern"){
								var patternImg = '';
								if(patternImgBg.src && (patternImgBg.src?.indexOf('http://') != -1 || patternImgBg.src?.indexOf('https://') != -1)){
									patternImg = 'url('+patternImgBg.src+')';
								} else if(patternImgBg.src){
									patternImg = 'url('+pagebuilder_base+patternImgBg.src+')';
								}
							#>
								background-image:{{patternImg}};
								background-attachment: scroll;
								<# if(!_.isEmpty(data.global_overlay_pattern_color)){ #>
									background-color:{{data.global_overlay_pattern_color}};
								<# }
							}
						} #>
						position: absolute;
						top: 0;
						left: 0;
						width: 100%;
						height: 100%;
						z-index: 0;
						<# if(data.global_background_type == "image" && backgroundImage){ #>
							<# if (data.blend_mode) { #>
								mix-blend-mode:{{data.blend_mode}};
							<# } #>
						<# } #>
					}

					#{{ addonId }} > .sppb-addon{
						position: relative;
					}
				<# } #>
				#{{ addonId }} a{
					color: {{ linkColor }};
				}
				#{{ addonId }} a:hover,
				#{{ addonId }} a:focus,
				#{{ addonId }} a:active{
					color: {{ linkHoverColor }};
				}
				<# if (!_.isEmpty(data.title)){ #>
					#sppb-addon-{{ data.id }} .sppb-addon-title{
						<# if(_.isObject(data.title_fontsize)){ #>
							font-size: {{ data.title_fontsize.md }}px;
							line-height: {{ data.title_fontsize.md }}px;
						<# } else { #>
							font-size: {{ data.title_fontsize }}px;
							line-height: {{ data.title_fontsize }}px;
						<# } #>
						<# if(_.isObject(data.title_lineheight)){ #>
							line-height: {{ data.title_lineheight.md }}px;
						<# } else { #>
							line-height: {{ data.title_lineheight }}px;
						<# }
						if(data.title_letterspace !== "custom") {
						#> 
							letter-spacing: {{ data.title_letterspace }};
						<# } else { #>
							letter-spacing: {{ data.custom_letterspacing }};
						<# } #>
						font-weight: {{ data.title_fontweight }};
						color: {{ data.title_text_color }};
						<# if(_.isObject(data.title_margin_top)){ #>
							margin-top: {{ data.title_margin_top.md }}px;
						<# } else { #>
							margin-top: {{ data.title_margin_top }}px;
						<# } #>
						<# if(_.isObject(data.title_margin_bottom)){ #>
							margin-bottom: {{ data.title_margin_bottom.md }}px;
						<# } else { #>
							margin-bottom: {{ data.title_margin_bottom }}px;
						<# } #>

						<# if(_.isObject(data.title_font_style) && data.title_font_style.underline) { #>
							text-decoration: underline;
							<# modern_font_style = true #>
						<# } #>

						<# if(_.isObject(data.title_font_style) && data.title_font_style.italic) { #>
							font-style: italic;
							<# modern_font_style = true #>
						<# } #>

						<# if(_.isObject(data.title_font_style) && data.title_font_style.uppercase) { #>
							text-transform: uppercase;
							<# modern_font_style = true #>
						<# } #>

						<# if(_.isObject(data.title_font_style) && data.title_font_style.weight) { #>
							font-weight: {{ data.title_font_style.weight }};
							<# modern_font_style = true #>
						<# } #>

						<# if(!modern_font_style) { #>
							<# if(_.isArray(title_font_style)) { #>
								<# if(title_font_style.indexOf("underline") !== -1){ #>
									text-decoration: underline;
								<# } #>
								<# if(title_font_style.indexOf("uppercase") !== -1){ #>
									text-transform: uppercase;
								<# } #>
								<# if(title_font_style.indexOf("italic") !== -1){ #>
									font-style: italic;
								<# } #>
								<# if(title_font_style.indexOf("lighter") !== -1){ #>
									font-weight: lighter;
								<# } else if(title_font_style.indexOf("normal") !== -1){#>
									font-weight: normal;
								<# } else if(title_font_style.indexOf("bold") !== -1){#>
									font-weight: bold;
								<# } else if(title_font_style.indexOf("bolder") !== -1){#>
									font-weight: bolder;
								<# } #>
							<# } #>
						<# } #>

					}
				<# } #>

				@media (min-width: 768px) and (max-width: 991px) {
					#{{ addonId }}{
						<# if(_.isObject(borderRadius)){ #>
							border-radius: {{ borderRadius.sm }}px;
						<# }
						if(_.isObject(padding)){
						#>
							{{{ padding.sm }}}
						<# } #>
						border-width: {{ borderWidth_sm }};
					}
					
					#sp-page-builder div#addon-wrap-{{ data.id }} {
						<# if(data.global_custom_position && data.global_seclect_position){ #>
							<# if(_.isObject(data.global_addon_position_top)) { #>
								top:{{data.global_addon_position_top.sm}}{{unitTop}};
							<# }

							if(_.isObject(data.global_addon_position_left)) {
							#>
								left:{{data.global_addon_position_left.sm}}{{unitLeft}};
							<# } #>
						<# }
						if(_.isObject(margin)){
						#>
							{{{ margin.sm }}}
						<# }
						if(typeof data.use_global_width !== "undefined" && data.use_global_width && typeof data.global_width !== "undefined" && _.isObject(data.global_width)) {
						#>
							width: {{data.global_width.sm}}%;
						<# } #>
					}

					<# if (!_.isEmpty(data.title)){ #>
						#sppb-addon-{{ data.id }} .sppb-addon-title{
							<# if(_.isObject(data.title_fontsize)){ #>
								font-size: {{ data.title_fontsize.sm }}px;
								line-height: {{ data.title_fontsize.sm }}px;
							<# } #>
							<# if(_.isObject(data.title_lineheight)){ #>
								line-height: {{ data.title_lineheight.sm }}px;
							<# } else { #>
								line-height: {{ data.title_lineheight }}px;
							<# } #>
							<# if(_.isObject(data.title_margin_top)){ #>
								margin-top: {{ data.title_margin_top.sm }}px;
							<# } #>
							<# if(_.isObject(data.title_margin_bottom)){ #>
								margin-bottom: {{ data.title_margin_bottom.sm }}px;
							<# } #>
						}
					<# } #>
				}
				@media (max-width: 767px) {
					#{{ addonId }}{
						border-width: {{ borderWidth_xs }};
						<# if(_.isObject(borderRadius)){ #>
							border-radius: {{ borderRadius.xs }}px;
						<# }
						if(_.isObject(padding)){
						#>
							{{{ padding.xs }}}
						<# } #>

					}
					#sp-page-builder div#addon-wrap-{{ data.id }} {
						<# if(data.global_custom_position && data.global_seclect_position){ #>
							<# if(_.isObject(data.global_addon_position_top)) { #>
								top:{{data.global_addon_position_top.xs}}{{unitTop}};
							<# }

							if(_.isObject(data.global_addon_position_left)) {
							#>
								left:{{data.global_addon_position_left.xs}}{{unitLeft}};
							<# }
						}
						if(_.isObject(margin)){
						#>
							{{{ margin.xs }}}
						<# }
						if(typeof data.use_global_width !== "undefined" && data.use_global_width && typeof data.global_width !== "undefined" && _.isObject(data.global_width)) {
						#>
							width: {{data.global_width.xs}}%;
						<# } #>
					}
					
					<# if (!_.isEmpty(data.title)){ #>
						#sppb-addon-{{ data.id }} .sppb-addon-title{
							<# if(_.isObject(data.title_fontsize)){ #>
								font-size: {{ data.title_fontsize.xs }}px;
								line-height: {{ data.title_fontsize.xs }}px;
							<# } #>
							<# if(_.isObject(data.title_lineheight)){ #>
								line-height: {{ data.title_lineheight.xs }}px;
							<# } else { #>
								line-height: {{ data.title_lineheight }}px;
							<# } #>
							<# if(_.isObject(data.title_margin_top)){ #>
								margin-top: {{ data.title_margin_top.xs }}px;
							<# } #>
							<# if(_.isObject(data.title_margin_bottom)){ #>
								margin-bottom: {{ data.title_margin_bottom.xs }}px;
							<# } #>
						}
					<# } #>
				}
			</style>
			<?php echo $class_name::getTemplate(); ?>
		</div>
		</script>
<?php
	}
}
?>

<script type="text/javascript" src="<?php echo Uri::base(true) . '/components/com_sppagebuilder/assets/js/engine.js?' . SppagebuilderHelperSite::getVersion(true); ?>"></script>