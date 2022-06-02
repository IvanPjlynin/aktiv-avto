<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

if (JVERSION >= '3.4.0') {
    JHtml::_('behavior.formvalidator');
} else {
    JHtml::_('behavior.formvalidation');
}
$pagLimit = array(
    5 => 5,
    10 => 10,
    15 => 15,
    20 => 20,
    25 => 25,
    30 => 30,
    50 => 50,
    100 => 100,
    1 => JText::_('JALL'),
);
$paginator = isset($_COOKIE['bagallery-edit']) ? $_COOKIE['bagallery-edit'] : 25;
$galleryStateStr = bagalleryHelper::checkGalleryActivation();
$galleryState = json_decode($galleryStateStr);

?>
<link rel="stylesheet" type="text/css" href="components/com_bagallery/assets/css/ba-admin.css?<?php echo $this->about->version; ?>">
<link rel="stylesheet" type="text/css" href="components/com_bagallery/assets/libraries/minicolors/css/minicolors.css">
<script type="text/javascript" src="components/com_bagallery/assets/libraries/minicolors/js/minicolors.js"></script>
<script type="text/javascript" src="components/com_bagallery/assets/js/ba-admin.js?<?php echo $this->about->version; ?>"></script>
<script type="text/javascript">
    var JUri = '<?php echo JUri::root(); ?>';
    <?php echo bagalleryHelper::getGalleryLanguage(); ?>
</script>
<?php
if ($this->item->id == 0) {
?>
<div class="ba-modal-backdrop"></div>
<div id="create-gallery-modal" class="ba-modal-sm modal in">
    <div class="modal-body">
        <h3><?php echo JText::_('ENTER_GALLERY_NAME'); ?></h3>
        <input type="text" class="gallery-name" placeholder="<?php echo JText::_('ENTER_GALLERY_NAME') ?>">
        <span class="focus-underline"></span>
    </div>
    <div class="modal-footer">
    	<a href="index.php?option=com_bagallery&view=galleries" class="ba-btn">
            <?php echo JText::_('CANCEL') ?>
        </a>
        <a href="#" class="ba-btn-primary" id="create-gallery">
            <?php echo JText::_('JTOOLBAR_APPLY') ?>
        </a>
    </div>
</div>
<?php
}
?>
<div class="product-tour step-1">
    <div>
        <i class="zmdi zmdi-close"></i>
        <p class="ba-group-title"><?php echo JText::_('STEP_1'); ?></p>
        <p><?php echo JText::_('CREATE_NEW_CATEGORY'); ?></p>
        <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
    </div>
</div>
<div class="product-tour step-2">
    <div>
        <i class="zmdi zmdi-close"></i>
        <p class="ba-group-title"><?php echo JText::_('STEP_2'); ?></p>
        <p><?php echo JText::_('UPLOAD_PICTURES'); ?></p>
        <a class="ba-btn next"><?php echo JText::_('NEXT'); ?></a>
    </div>
</div>
<div class="product-tour step-3">
    <div>
        <i class="zmdi zmdi-close"></i>
        <p class="ba-group-title"><?php echo JText::_('STEP_3'); ?></p>
        <p><?php echo JText::_('CONFIGURE_GALLERY'); ?></p>
        <a class="ba-btn close"><?php echo JText::_('CLOSE'); ?></a>
    </div>
</div>
<div id="love-gallery-modal" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3><?php echo JText::_('LOVE_GALLERY'); ?></h3>
        <p class="modal-text"><?php echo JText::_('TELL_THE_WORLD'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('NO_THANKS') ?>
        </a>
        <a href="http://extensions.joomla.org/extension/6gallery" target="_blank" class="ba-btn-primary active-button">
            <?php echo JText::_('RATE_NOW') ?>
        </a>
    </div>
</div>
<div id="color-variables-dialog" class="modal hide ba-modal-picker picker-modal-arrow" style="display: none;">
    <div class="modal-header">
        <i class="zmdi zmdi-eyedropper"></i>
    </div>
    <div class="modal-body">
        <div id="color-picker-cell">
            <input type="hidden" data-dismiss="modal">
            <input type="text" class="variables-color-picker">
            <span class="minicolors-opacity-wrapper">
                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY'); ?></span>
            </span>
        </div>
    </div>
</div>
<div id="link-select-modal" class="ba-modal-md modal ba-modal-dialog hide" style="display:none" data-check="single">
    <div class="modal-body">
        <div class="ba-modal-header">
            <h3 class="ba-modal-title"><?php echo JText::_('LINK_PICKER'); ?></h3>
            <i data-dismiss="modal" class="zmdi zmdi-close"></i>
        </div>
        <div class="availible-folders">

        </div>
        <input type="hidden" data-dismiss="modal">
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL'); ?></a>
        <a href="#" class="ba-btn-primary apply-link disable-button"><?php echo JText::_('SAVE'); ?></a>
    </div>
</div>
<div id="cke-image-modal" class="ba-modal-sm modal hide" style="display:none">
    <div class="modal-body">
        <h3><?php echo JText::_('ADD_IMAGE'); ?></h3>
        <div>
            <input type="text" class="cke-upload-image" readonly placeholder="<?php echo JText::_('BROWSE_PICTURE'); ?>">
            <span class="focus-underline"></span>
            <i class="zmdi zmdi-camera"></i>
        </div>
        <input type="text" class="cke-image-alt" placeholder="<?php echo JText::_('IMAGE_ALT'); ?>">
        <span class="focus-underline"></span>
        <div>
            <input type="text" class="cke-image-width" placeholder="<?php echo JText::_('WIDTH'); ?>">
            <span class="focus-underline"></span>
            <input type="text" class="cke-image-height" placeholder="<?php echo JText::_('HEIGHT'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-custom-select visible-select-top cke-image-select">
            <input type="text" class="cke-image-align" data-value="" readonly=""
                placeholder="<?php echo JText::_('ALIGNMENT'); ?>">
            <ul class="select-no-scroll">
                <li data-value=""><?php echo JText::_('NONE_SELECTED'); ?></li>
                <li data-value="left"><?php echo JText::_('LEFT'); ?></li>
                <li data-value="right"><?php echo JText::_('RIGHT'); ?></li>
            </ul>
            <i class="zmdi zmdi-caret-down"></i>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL') ?>
        </a>
        <a href="#" class="ba-btn-primary" id="add-cke-image">
            <?php echo JText::_('JTOOLBAR_APPLY') ?>
        </a>
    </div>
</div>
<form autocomplete="off" action="<?php echo JRoute::_('index.php?option=com_bagallery&layout=edit&id='); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
            
<?php
echo $this->form->getInput('default_editor');
echo $this->form->getInput('id');
echo $this->form->getInput('gallery_category');
echo $this->form->getInput('gallery_items');
echo $this->form->getInput('settings');
echo $this->form->getInput('all_sorting');
echo $this->form->getInput('sorting_mode');
?>
    <div class="row-fluid">
        <div class="span12 title-bar">
            <?php echo $this->form->getLabel('title'); ?>
            <?php echo $this->form->getInput('title'); ?>
            <div class="ba-toolbar-icons">
                <label class="settings">
                    <i class="zmdi zmdi-settings"></i>
                    <?php echo JText::_('SETTINGS'); ?>
                </label>
                <label class="ba-help">
                    <i class="zmdi zmdi-help"></i>
                    <?php echo JText::_('HELP'); ?>
                </label>
            </div>            
        </div>
    </div>
    <div id="ba-notification">
        <p></p>
    </div>
    <div id="uploader-modal" class="ba-modal-lg modal hide" style="display:none">
        <div class="modal-body">
            <iframe src="<?php echo jUri::base().'index.php?option=com_bagallery&view=uploader&tmpl=component'; ?>"
                    name="upload-target" id="upload-target"></iframe>
            <input type="hidden" data-dismiss="modal">
        </div>
    </div>
    <div id="rename-modal" class="ba-modal-sm modal hide" style="display:none">
            <div class="modal-body">
                <h3><?php echo JText::_('RENAME'); ?></h3>
                <input type="text" maxlength="260" class="new-name">
                <span class="focus-underline"></span>
            </div>
            <div class="modal-footer">
                <a href="#" class="ba-btn" data-dismiss="modal">
                    <?php echo JText::_('CANCEL') ?>
                </a>
                <a href="#" class="ba-btn-primary" id="apply-rename">
                    <?php echo JText::_('JTOOLBAR_APPLY') ?>
                </a>
            </div>
        </div>
    <div id="embed-modal" class="ba-modal-md modal hide" style="display:none">
        <div class="ba-modal-header">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
            <h3><?php echo JText::_('EDIT_EMBED'); ?></h3>
        </div>
        <div class="modal-body">
            <textarea type="text" class="ba-embed"></textarea>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary" id="embed-apply"><?php echo JText::_('SAVE') ?></a>
        </div>
    </div>
    <div id="select-upload-type">
        <div class="upload-type video">
            <i class="zmdi zmdi-play"></i>
            <span class="ba-tooltip ba-left"><?php echo JText::_('VIDEO'); ?></span>
        </div>
        <div class="upload-type desktop">
            <i class="zmdi zmdi-desktop-windows"></i>
            <span class="ba-tooltip ba-left"><?php echo JText::_('UPLOAD_FROM_DESKTOP'); ?></span>
        </div>
        <div class="upload-type folder">
            <i class="zmdi zmdi-folder"></i>
            <span class="ba-tooltip ba-left"><?php echo JText::_('UPLOAD_FROM_FOLDER'); ?></span>
        </div>
    </div>
    <div id="global-options" class="ba-modal-lg modal hide" style="display:none">
        <div class="ba-media-header">
            <div class="modal-header-icon">
                <i class="zmdi zmdi-check" id="apply-options" data-dismiss="modal"></i>
                <i class="zmdi zmdi-close" data-dismiss="modal"></i>
            </div>
        </div>
        <div class="modal-body">
            <div class="general-tabs">
                <ul class="nav nav-tabs uploader-nav">
                    <li class="active">
                        <a href="#general-options" data-toggle="tab">
                            <i class="zmdi zmdi-settings"></i>
                            <?php echo JText::_('GENERAL') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#album-options" data-toggle="tab">
                            <i class="zmdi zmdi-collection-bookmark"></i>
                            <?php echo JText::_('ALBUM') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#thumbnail-options" data-toggle="tab">
                            <i class="zmdi zmdi-collection-image"></i>
                            <?php echo JText::_('THUMBNAIL') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#lightbox-options" data-toggle="tab">
                            <i class="zmdi zmdi-layers"></i>
                            <?php echo JText::_('LIGHTBOX') ?>
                        </a>
                    </li>
<?php
                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                    <li>
                        <a href="#filter-options" data-toggle="tab">
                            <i class="zmdi zmdi-label"></i>
                            <?php echo JText::_('FILTER') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#pagination-options" data-toggle="tab">
                            <i class="zmdi zmdi-arrows"></i>
                            <?php echo JText::_('PAGINATION') ?>
                        </a>
                    </li>
                    <li>
                        <a href="#copyright-options" data-toggle="tab">
                            <i class="zmdi zmdi-globe-lock"></i>
                            <?php echo JText::_('PROTECTION'); ?>
                        </a>
                    </li>
<?php
                }
?>
                </ul>
                <div class="tabs-underline"></div>
                <div class="tab-content">
                    <div class="tab-pane active" id="general-options">
<?php
                    if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('ALBUM_MODE') ?>
                                </lable>
                                <input type="hidden" name="jform[album_mode]" value="0">
                                <label class="ba-checkbox">
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('album_mode', $this->form); ?>
                                    <span></span>
                                </label>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('ALBUM_MODE_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
<?php
                    }
?>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('RANDOM_SORTING') ?>
                                </lable>
                                <input type="hidden" name="jform[random_sorting]" value="0">
                                <label class="ba-checkbox">
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('random_sorting', $this->form); ?>
                                    <span></span>
                                </label>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('RANDOM_SORTING_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('DISABLE_AUTO_SCROLL') ?>
                                </lable>
                                <input type="hidden" name="jform[disable_auto_scroll]" value="0">
                                <label class="ba-checkbox">
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('disable_auto_scroll', $this->form); ?>
                                    <span></span>
                                </label>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('DISABLE_AUTO_SCROLL_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
<?php
                    if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                        <p class="ba-group-title"><?php echo JText::_('PERFORMANCE'); ?></p>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('LAZY_LOAD') ?>
                                </lable>
                                <input type="hidden" name="jform[lazy_load]" value="0">
                                <label class="ba-checkbox">
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('lazy_load', $this->form); ?>
                                    <span></span>
                                </label>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('LAZY_LOAD_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('PAGE_REFRESH') ?>
                                </lable>
                                <input type="hidden" name="jform[page_refresh]" value="0">
                                <label class="ba-checkbox">
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('page_refresh', $this->form); ?>
                                    <span></span>
                                </label>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('PAGE_REFRESH_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
<?php
                    }
?>
                        <p class="ba-group-title"><?php echo JText::_('ADVANCED'); ?></p>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('CLASS_SUFFIX') ?>
                                </lable>
                                <?php echo $this->form->getInput('class_suffix');?>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('CLASS_SUFFIX_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('LOAD_JQUERY') ?>
                                </lable>
                                <input type="hidden" name="jform[load_jquery]" value="0">
                                <label class="ba-checkbox">
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('load_jquery', $this->form); ?>
                                    <span></span>
                                </label>
                                <label class="ba-help-icon">
                                    <i class="zmdi zmdi-help"></i>
                                    <span class="ba-tooltip ba-help">
                                        <?php echo JText::_('LOAD_JQUERY_TOOLTIP'); ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-wrapper" id="album-options">
                        <div class="left-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#album-general-options" data-toggle="tab">
                                        <i class="zmdi zmdi-settings"></i>
                                        <?php echo JText::_('GENERAL') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#album-caption-options" data-toggle="tab">
                                        <i class="zmdi zmdi-cast-connected"></i>
                                        <?php echo JText::_('CAPTION') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#album-typography-options" data-toggle="tab">
                                        <i class="zmdi zmdi-font"></i>
                                        <?php echo JText::_('TYPOGRAPHY') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#album-compression-options" data-toggle="tab">
                                        <i class="zmdi zmdi-scissors"></i>
                                        <?php echo JText::_('COMPRESSION') ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="album-general-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('LAYOUT') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul>
                                                    <li data-value="justified"><?php echo JText::_('JUSTIFIED') ?></li>
                                                    <li data-value="random"><?php echo JText::_('MASONRY') ?></li>
                                                    <li data-value="metro"><?php echo JText::_('METRO') ?></li>
                                                    <li data-value="grid"><?php echo JText::_('GRID') ?></li>
                                                    <li data-value="masonry"><?php echo JText::_('TILE') ?></li>
                                                    <li data-value="square"><?php echo JText::_('SQUARE') ?></li>
                                                </ul>
                                            </div>
                                            <?php echo $this->form->getInput('album_layout'); ?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('COLUMN_NUMBER') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DEVICE') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-option="device" data-value="desktop" class="active">
                                                        <i class="zmdi zmdi-desktop-windows"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('DESKTOP'); ?>
                                                        </span>
                                                    </label>
                                                    <label data-option="device" data-value="tablet">
                                                        <i class="zmdi zmdi-tablet-mac"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('TABLET_PORTRAIT'); ?>
                                                        </span>
                                                    </label>
                                                    <label data-option="device" data-value="phone-land">
                                                        <i class="zmdi zmdi-smartphone-landscape"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('PHONE_LANDSCAPE'); ?>
                                                        </span>
                                                    </label>
                                                    <label data-option="device" data-value="phone-port">
                                                        <i class="zmdi zmdi-smartphone-android"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('PHONE_PORTRAIT'); ?>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="desktop-options option-border">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('album_column_number');?>
                                            </div>
                                        </div>
                                        <div class="tablet-options option-border" style="display:none;">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('album_tablet_numb');?>
                                            </div>
                                        </div>
                                        <div class="phone-land-options option-border" style="display:none;">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('album_phone_land_numb');?>
                                            </div>
                                        </div>
                                        <div class="phone-port-options option-border" style="display:none;">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('album_phone_port_numb');?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_SPACING') ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=100>
                                            <?php echo $this->form->getInput('album_image_spacing');?>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('IMAGE_SPACING_TOOTLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISPLAY_ALBUM_PHOTOS_LIGHTBOX') ?>
                                            </lable>
                                            <input type="hidden" name="jform[album_enable_lightbox]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('album_enable_lightbox', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="album-caption-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISABLE_CAPTION'); ?>
                                            </lable>
                                            <input type="hidden" name="jform[album_disable_caption]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('album_disable_caption', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="ba-group-title album-caption-group">
                                        <?php echo JText::_('DESIGN_SETTINGS') ?>
                                    </p>
                                    <div class="ba-options-group album-caption-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('THUMBNAIL_EFFECT') ?>
                                            </lable>
                                            <div class="ba-custom-select thumbnail-effect-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul>
<?php
                                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                                    <li data-value="14">None</li>
                                                    <li data-value="13">Image Zoom</li>
                                                    <li data-value="11">Caption Fade-In Up</li>
                                                    <li data-value="12">Caption Direction Aware</li>
                                                    <li data-value="6">Caption Slide-Out Diagonal</li>
                                                    <li data-value="10">Caption Below Thumbnail
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('EFFECT_12_TOOLTIP'); ?>
                                                        </span>
                                                    </li>
                                                    <li data-value="8">Image Zoom and Caption Slide-In Up</li>
                                                    <li data-value="7">Image Zoom and Caption Slide-In Left</li>
<?php
                                                }
?>
                                                    <li data-value="1">Image Zoom and Caption Slide-In Down</li>
<?php
                                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                                    <li data-value="3">Image Slide-In Up</li>
                                                    <li data-value="4">Image Slide-In Right</li>
                                                    <li data-value="2">Image Slide-Out Up</li>
<?php
                                                }
?>
                                                </ul>
                                            </div>
                                            <?php echo $this->form->getInput('album_thumbnail_layout');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('CAPTION_BG') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="album_caption_bg" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('album_caption_bg');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title album-caption-group"><?php echo JText::_('VIEW_SETTINGS') ?></p>
                                    <div class="ba-options-group album-caption-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISPLAY_TITLE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[album_display_title]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('album_display_title', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISPLAY_NUMBER_OF_PHOTOS') ?>
                                            </lable>
                                            <input type="hidden" name="jform[album_display_img_count]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('album_display_img_count', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="album-typography-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('SELECT') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="thumbnail-typography-select" data-value="title"
                                                       readonly value="<?php echo JText::_('TITLE'); ?>">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul class="select-no-scroll">
                                                    <li data-value="title"><?php echo JText::_('TITLE') ?></li>
                                                    <li data-value="category"><?php echo JText::_('NUMBER_OF_PHOTOS') ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="title-options option-border">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT') ?>
                                                </lable>
                                                <div class="ba-gallery-settings-toolbar">
                                                    <div>
                                                        <div>
                                                            <?php echo $this->form->getInput('album_title_size'); ?>
                                                            <span class="ba-tooltip ba-top">
                                                                <?php echo JText::_('FONT_SIZE') ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label data-value="bold" data-option="album_title_weight"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-bold"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('BOLD'); ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('album_title_weight'); ?>
                                                    </div>
                                                    <div>
                                                        <label data-value="left" data-option="album_title_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-left"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('LEFT') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="center" data-option="album_title_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-center"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('CENTER') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="right" data-option="album_title_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-right"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('RIGHT') ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('album_title_alignment'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT_COLOR') ?>
                                                </lable>
                                                <input type="text" data-type="color" id="album_title_color" class="minicolors-trigger">
                                                <span class="minicolors-opacity-wrapper">
                                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                                </span>
                                                <?php echo $this->form->getInput('album_title_color');?>
                                            </div>
                                        </div>
                                        <div class="category-options option-border" style="display:none">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT') ?>
                                                </lable>
                                                <div class="ba-gallery-settings-toolbar">
                                                    <div>
                                                        <div>
                                                            <?php echo $this->form->getInput('album_img_count_size'); ?>
                                                            <span class="ba-tooltip ba-top">
                                                                <?php echo JText::_('FONT_SIZE') ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label data-value="bold" data-option="album_img_count_weight"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-bold"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('BOLD'); ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('album_img_count_weight'); ?>
                                                    </div>
                                                    <div>
                                                        <label data-value="left" data-option="album_img_count_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-left"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('LEFT') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="center" data-option="album_img_count_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-center"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('CENTER') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="right" data-option="album_img_count_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-right"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('RIGHT') ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('album_img_count_alignment'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT_COLOR'); ?>
                                                </lable>
                                                <input type="text" data-type="color" id="album_img_count_color" class="minicolors-trigger">
                                                <span class="minicolors-opacity-wrapper">
                                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                                </span>
                                                <?php echo $this->form->getInput('album_img_count_color'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="album-compression-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_WIDTH') ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="100" max=1000>
                                            <?php echo $this->form->getInput('album_width'); ?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_QUALITY') ?>, %
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=100>
                                            <?php echo $this->form->getInput('album_quality'); ?>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('IMAGE_QUALITY_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane tab-wrapper" id="thumbnail-options">
                        <div class="left-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#thumbnail-general-options" data-toggle="tab">
                                        <i class="zmdi zmdi-settings"></i>
                                        <?php echo JText::_('GENERAL') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#thumbnail-caption-options" data-toggle="tab">
                                        <i class="zmdi zmdi-cast-connected"></i>
                                        <?php echo JText::_('CAPTION') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#thumbnail-typography-options" data-toggle="tab">
                                        <i class="zmdi zmdi-font"></i>
                                        <?php echo JText::_('TYPOGRAPHY') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#thumbnail-compression-options" data-toggle="tab">
                                        <i class="zmdi zmdi-scissors"></i>
                                        <?php echo JText::_('COMPRESSION') ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="thumbnail-general-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('LAYOUT') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul>
                                                    <li data-value="justified"><?php echo JText::_('JUSTIFIED') ?></li>
<?php
                                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                                    <li data-value="random"><?php echo JText::_('MASONRY') ?></li>
                                                    <li data-value="metro"><?php echo JText::_('METRO') ?></li>
                                                    <li data-value="grid"><?php echo JText::_('GRID') ?></li>
                                                    <li data-value="masonry"><?php echo JText::_('TILE') ?></li>
                                                    <li data-value="square"><?php echo JText::_('SQUARE') ?></li>
<?php
                                                }
?>
                                                </ul>
                                            </div>
                                            <?php echo $this->form->getInput('gallery_layout');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('COLUMN_NUMBER') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DEVICE') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-option="device" data-value="desktop" class="active">
                                                        <i class="zmdi zmdi-desktop-windows"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('DESKTOP'); ?>
                                                        </span>
                                                    </label>
                                                    <label data-option="device" data-value="tablet">
                                                        <i class="zmdi zmdi-tablet-mac"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('TABLET_PORTRAIT'); ?>
                                                        </span>
                                                    </label>
                                                    <label data-option="device" data-value="phone-land">
                                                        <i class="zmdi zmdi-smartphone-landscape"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('PHONE_LANDSCAPE'); ?>
                                                        </span>
                                                    </label>
                                                    <label data-option="device" data-value="phone-port">
                                                        <i class="zmdi zmdi-smartphone-android"></i>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('PHONE_PORTRAIT'); ?>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="desktop-options option-border">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('column_number');?>
                                            </div>
                                        </div>
                                        <div class="tablet-options option-border" style="display:none;">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('tablet_numb');?>
                                            </div>
                                        </div>
                                        <div class="phone-land-options option-border" style="display:none;">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('phone_land_numb');?>
                                            </div>
                                        </div>
                                        <div class="phone-port-options option-border" style="display:none;">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('QUANTITY') ?>
                                                </lable>
                                                <span class="ba-range-liner"></span>
                                                <input type="range" class="ba-gallery-range" min="0" max=25>
                                                <?php echo $this->form->getInput('phone_port_numb');?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_SPACING') ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=100>
                                            <?php echo $this->form->getInput('image_spacing');?>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('IMAGE_SPACING_TOOTLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="thumbnail-caption-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISABLE_CAPTION'); ?>
                                            </lable>
                                            <input type="hidden" name="jform[disable_caption]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('disable_caption', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="ba-group-title caption-group"><?php echo JText::_('DESIGN_SETTINGS') ?></p>
                                    <div class="ba-options-group caption-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('THUMBNAIL_EFFECT') ?>
                                            </lable>
                                            <div class="ba-custom-select thumbnail-effect-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul>
<?php
                                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                                    <li data-value="14">None</li>
                                                    <li data-value="13">Image Zoom</li>
                                                    <li data-value="11">Caption Fade-In Up</li>
                                                    <li data-value="12">Caption Direction Aware</li>
                                                    <li data-value="6">Caption Slide-Out Diagonal</li>
                                                    <li data-value="10">Caption Below Thumbnail
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('EFFECT_12_TOOLTIP'); ?>
                                                        </span>
                                                    </li>
                                                    <li data-value="8">Image Zoom and Caption Slide-In Up</li>
                                                    <li data-value="7">Image Zoom and Caption Slide-In Left</li>
<?php
                                                }
?>
                                                    <li data-value="1">Image Zoom and Caption Slide-In Down</li>
<?php
                                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                                    <li data-value="3">Image Slide-In Up</li>
                                                    <li data-value="4">Image Slide-In Right</li>
                                                    <li data-value="2">Image Slide-Out Up</li>
<?php
                                                }
?>
                                                </ul>
                                            </div>
                                            <?php echo $this->form->getInput('thumbnail_layout');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('CAPTION_BG') ?>
                                            </lable>
                                            <input type="text" data-type="color" class="custom-minicolors-trigger"
                                                data-color-input="caption_bg" data-opacity-input="caption_opacity">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('caption_bg'); ?>
                                            <?php echo $this->form->getInput('caption_opacity'); ?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title caption-group"><?php echo JText::_('VIEW_SETTINGS') ?></p>
                                    <div class="ba-options-group caption-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISPLAY_TITLE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[display_title]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('display_title', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISPLAY_CATEGORY') ?>
                                            </lable>
                                            <input type="hidden" name="jform[display_categoty]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('display_categoty', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="thumbnail-typography-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('SELECT') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="thumbnail-typography-select" data-value="title"
                                                       readonly value="<?php echo JText::_('TITLE'); ?>">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul class="select-no-scroll">
                                                    <li data-value="title"><?php echo JText::_('TITLE') ?></li>
                                                    <li data-value="category"><?php echo JText::_('CATEGORY') ?></li>
                                                    <li data-value="description"><?php echo JText::_('SHORT_DESCRIPTION') ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="title-options option-border">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT') ?>
                                                </lable>
                                                <div class="ba-gallery-settings-toolbar">
                                                    <div>
                                                        <div>
                                                            <?php echo $this->form->getInput('title_size'); ?>
                                                            <span class="ba-tooltip ba-top">
                                                                <?php echo JText::_('FONT_SIZE') ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label data-value="bold" data-option="title_weight" data-trigger="1">
                                                            <i class="zmdi zmdi-format-bold"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('BOLD'); ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('title_weight'); ?>
                                                    </div>
                                                    <div>
                                                        <label data-value="left" data-option="title_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-left"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('LEFT') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="center" data-option="title_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-center"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('CENTER') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="right" data-option="title_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-right"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('RIGHT') ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('title_alignment'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT_COLOR') ?>
                                                </lable>
                                                <input type="text" data-type="color" id="title_color" class="minicolors-trigger">
                                                <span class="minicolors-opacity-wrapper">
                                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                    <span class="ba-tooltip ba-top ba-hide-element">
                                                        <?php echo JText::_('OPACITY') ?>
                                                    </span>
                                                </span>
                                                <?php echo $this->form->getInput('title_color');?>
                                            </div>
                                        </div>
                                        <div class="category-options option-border" style="display:none">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT') ?>
                                                </lable>
                                                <div class="ba-gallery-settings-toolbar">
                                                    <div>
                                                        <div>
                                                            <?php echo $this->form->getInput('category_size'); ?>
                                                            <span class="ba-tooltip ba-top">
                                                                <?php echo JText::_('FONT_SIZE') ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label data-value="bold" data-option="category_weight"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-bold"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('BOLD'); ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('category_weight'); ?>
                                                    </div>
                                                    <div>
                                                        <label data-value="left" data-option="category_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-left"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('LEFT') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="center" data-option="category_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-center"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('CENTER') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="right" data-option="category_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-right"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('RIGHT') ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('category_alignment'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT_COLOR') ?>
                                                </lable>
                                                <input type="text" data-type="color" id="category_color" class="minicolors-trigger">
                                                <span class="minicolors-opacity-wrapper">
                                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                                </span>
                                                <?php echo $this->form->getInput('category_color');?>
                                            </div>
                                        </div>
                                        <div class="description-options option-border" style="display:none">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT') ?>
                                                </lable>
                                                <div class="ba-gallery-settings-toolbar">
                                                    <div>
                                                        <div>
                                                            <?php echo $this->form->getInput('description_size'); ?>
                                                            <span class="ba-tooltip ba-top">
                                                                <?php echo JText::_('FONT_SIZE') ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label data-value="bold" data-option="description_weight"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-bold"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('BOLD'); ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('description_weight'); ?>
                                                    </div>
                                                    <div>
                                                        <label data-value="left" data-option="description_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-left"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('LEFT') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="center" data-option="description_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-center"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('CENTER') ?>
                                                            </span>
                                                        </label>
                                                        <label data-value="right" data-option="description_alignment"
                                                            data-trigger="1">
                                                            <i class="zmdi zmdi-format-align-right"></i>
                                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                                <?php echo JText::_('RIGHT') ?>
                                                            </span>
                                                        </label>
                                                        <?php echo $this->form->getInput('description_alignment'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('FONT_COLOR') ?>
                                                </lable>
                                                <input type="text" data-type="color" id="description_color" class="minicolors-trigger">
                                                <span class="minicolors-opacity-wrapper">
                                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                                </span>
                                                <?php echo $this->form->getInput('description_color');?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="thumbnail-compression-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_WIDTH') ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="100" max=1000>
                                            <?php echo $this->form->getInput('image_width');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_QUALITY') ?>, %
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=100>
                                            <?php echo $this->form->getInput('image_quality');?>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('IMAGE_QUALITY_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('REGENERATE_THUMBNAILS') ?>
                                            </lable>
                                            <label class="ba-checkbox">
                                                <input type="checkbox" class="regenerate-thumbnails">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="tab-pane tab-wrapper" id="lightbox-options">
                        <div class="left-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#lightbox-general-options" data-toggle="tab">
                                        <i class="zmdi zmdi-settings"></i>
                                        <?php echo JText::_('GENERAL') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#lightbox-header-options" data-toggle="tab">
                                        <i class="zmdi zmdi-movie"></i>
                                        <?php echo JText::_('HEADER') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#lightbox-navigation-options" data-toggle="tab">
                                        <i class="zmdi zmdi-caret-right-circle"></i>
                                        <?php echo JText::_('NAVIGATION') ?>
                                    </a>
                                </li>
<?php
                            if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                <li>
                                    <a href="#lightbox-comments-options" data-toggle="tab">
                                        <i class="zmdi zmdi-comment"></i>
                                        <?php echo JText::_('COMMENTS') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#lightbox-compression-options" data-toggle="tab">
                                        <i class="zmdi zmdi-scissors"></i>
                                        <?php echo JText::_('COMPRESSION') ?>
                                    </a>
                                </li>
<?php
                            }
?>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="lightbox-general-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ENABLE_LIGHTBOX') ?>
                                            </lable>
                                            <?php echo $this->form->getInput('disable_lightbox'); ?>
                                            <label class="ba-checkbox">
                                                <input type="checkbox" id="enable-lightbox">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ENABLE_ALIAS') ?>
                                            </lable>
                                            <input type="hidden" name="jform[enable_alias]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('enable_alias', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
<?php
                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('AUTO_RESIZE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[auto_resize]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('auto_resize', $this->form); ?>
                                                <span></span>
                                            </label>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('AUTO_RESIZE_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group lightbox-width">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('LIGHTBOX_WIDTH') ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=100>
                                            <?php echo $this->form->getInput('lightbox_width');?>
                                        </div>
                                    </div>
<?php
                                }
?>
<?php
                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('SLIDE_ANIMATION') ?>
                                            </lable>
                                            <div class="ba-custom-select visible-select-top">
                                                <input type="text" class="ba-form-trigger" data-value="" readonly value="">
                                                <ul class="select-no-scroll">
                                                    <li data-value="ba-gallery-fade-animation"><?php echo JText::_('FADE'); ?></li>
                                                    <li data-value="ba-gallery-slide-animation"><?php echo JText::_('SLIDE'); ?></li>
                                                </ul>
                                                <i class="zmdi zmdi-caret-down"></i>
                                            </div>
                                            <?php echo $this->form->getInput('slide_amimation'); ?>
                                        </div>
                                    </div>
<?php
                                }
?>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element ba-minicolors-top">
                                            <lable class="option-label">
                                                <?php echo JText::_('LIGHTBOX_BG') ?>
                                            </lable>
                                            <input type="text" data-type="color" class="custom-minicolors-trigger"
                                                data-color-input="lightbox_bg" data-opacity-input="lightbox_bg_transparency">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('lightbox_bg');?>
                                            <?php echo $this->form->getInput('lightbox_bg_transparency');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('DESCRIPTION') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BACKGROUND_COLOR') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="lightbox_border" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('lightbox_border');?>
                                        </div>
<?php
                                    if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DESCRIPTION_POSITION') ?>
                                            </lable>
                                            <div class="ba-custom-select visible-select-top">
                                                <input type="text" class="ba-form-trigger" data-value="" readonly value="">
                                                <ul class="select-no-scroll">
                                                    <li data-value="left"><?php echo JText::_('LEFT'); ?></li>
                                                    <li data-value="right"><?php echo JText::_('RIGHT'); ?></li>
                                                    <li data-value="below"><?php echo JText::_('BELOW'); ?></li>
                                                </ul>
                                                <i class="zmdi zmdi-caret-down"></i>
                                            </div>
                                            <?php echo $this->form->getInput('description_position');?>
                                        </div>
<?php
                                    }
?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="lightbox-header-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISPLAY_HEADER') ?>
                                            </lable>
                                            <input type="hidden" name="jform[display_header]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('display_header', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('VIEW_SETTINGS'); ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('HEADER'); ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-value="1" data-option="lightbox_display_title"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-format-size"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('DISPLAY_TITLE'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('lightbox_display_title'); ?>
                                                </div>
<?php
                                            if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                                <div>
                                                    <label data-value="1" data-option="display_zoom"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-zoom-in"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('DISPLAY_ZOOM'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('display_zoom'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="display_fullscreen"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-fullscreen"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('DISPLAY_FULLSCREEN'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('display_fullscreen'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="display_likes"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-favorite"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('DISPLAY_LIKES'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('display_likes'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="display_download"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-download"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('DISPLAY_DOWNLOAD'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('display_download'); ?>
                                                </div>
<?php
                                            }
?>
                                            </div>
                                        </div>
<?php
                                    if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('SOCIAL_SHARING') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-value="1" data-option="twitter_share"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-twitter"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            Twitter
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('twitter_share'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="facebook_share"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-facebook"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            Facebook
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('facebook_share'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="pinterest_share"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-pinterest"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            Pinterest
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('pinterest_share'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="linkedin_share"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-linkedin"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            LinkedIn
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('linkedin_share'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="vkontakte_share"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-vk"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            Vkontakte
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('vkontakte_share'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="1" data-option="odnoklassniki_share"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-odnoklassniki"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            Odnoklassniki
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('odnoklassniki_share'); ?>
                                                </div>
                                            </div>
                                        </div>
<?php
                                    }
?>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('DESIGN_SETTINGS') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element ba-minicolors-top">
                                            <lable class="option-label">
                                                <?php echo JText::_('HEADER_ITEMS_COLOR') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="header_icons_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('header_icons_color');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="lightbox-navigation-options">
                                    <p class="ba-group-title"><?php echo JText::_('ARROWS') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('NAV_ARROWS') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="nav_button_icon" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('nav_button_icon');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('NAV_ARROWS_BG') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="nav_button_bg" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('nav_button_bg');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="lightbox-comments-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('COMMENT_SYSTEM') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul>
                                                    <li data-value="0"><?php echo JText::_('NONE_EFFECT') ?></li>
                                                    <li data-value="1">Disqus</li>
                                                    <li data-value="vkontakte">VKontakte</li>
                                                </ul>
                                            </div>
                                            <?php echo $this->form->getInput('enable_disqus'); ?>
                                        </div>
                                        <div class="disqus-options option-border">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    <?php echo JText::_('DISQUS_SUBDOMEN') ?>
                                                </lable>
                                                <?php echo $this->form->getInput('disqus_subdomen'); ?>
                                            </div>
                                        </div>
                                        <div class="vk-options option-border">
                                            <div class="ba-group-element">
                                                <lable class="option-label">
                                                    API ID
                                                </lable>
                                                <?php echo $this->form->getInput('vk_api_id');?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="lightbox-compression-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ENABLE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[enable_compression]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('enable_compression', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="ba-group-element compression-options">
                                            <lable class="option-label">
                                                <?php echo JText::_('MAX_IMAGE_WIDTH_HEIGHT') ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="100" max="2560">
                                            <?php echo $this->form->getInput('compression_width'); ?>
                                        </div>
                                        <div class="ba-group-element compression-options">
                                            <lable class="option-label">
                                                <?php echo JText::_('IMAGE_QUALITY') ?>, %
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max="100">
                                            <?php echo $this->form->getInput('compression_quality'); ?>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('IMAGE_QUALITY_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                             
                    </div>
                    <div class="tab-pane" id="filter-options">
                        <div class="left-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#filter-categories-options" data-toggle="tab">
                                        <i class="zmdi zmdi-folder"></i>
                                        <?php echo JText::_('CATEGORIES'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#filter-tags-options" data-toggle="tab">
                                        <i class="zmdi zmdi-label"></i>
                                        <?php echo JText::_('TAGS'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#filter-colors-options" data-toggle="tab">
                                        <i class="zmdi zmdi-invert-colors"></i>
                                        <?php echo JText::_('COLORS'); ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="filter-categories-options">
<?php
                                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>

                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ENABLE_FILTER') ?>
                                            </lable>
                                            <input type="hidden" name="jform[category_list]" value="0">
                                            <label class="ba-checkbox">                                            
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('category_list', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
<?php
                                }
?>
                                    <p class="ba-group-title"><?php echo JText::_('TYPOGRAPHY'); ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('FONT') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <div>
                                                        <?php echo $this->form->getInput('font_size'); ?>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('FONT_SIZE') ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label data-value="bold" data-option="font_weight"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-format-bold"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('BOLD'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('font_weight'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="left" data-option="alignment"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-format-align-left"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('LEFT') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="center" data-option="alignment"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-format-align-center"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('CENTER') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="right" data-option="alignment"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-format-align-right"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('RIGHT') ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('alignment'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ba-group-element ba-minicolors-top">
                                            <lable class="option-label">
                                                <?php echo JText::_('FONT_COLOR') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="font_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('font_color');?>
                                        </div>
                                        <div class="ba-group-element ba-minicolors-top">
                                            <lable class="option-label">
                                                <?php echo JText::_('FONT_COLOR_HOVER') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="font_color_hover" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('font_color_hover');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('BACKGROUND') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BG_COLOR') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="bg_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('bg_color');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BG_COLOR_HOVER') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="bg_color_hover" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('bg_color_hover');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('BORDER') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BORDER_COLOR'); ?>
                                            </lable>
                                            <input type="text" data-type="color" id="border_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('border_color');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BORDER_RADIUS'); ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=120>
                                            <?php echo $this->form->getInput('border_radius');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="filter-tags-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ENABLE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[enable_tags]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('enable_tags', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('FILTERING_METHOD') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <ul class="select-no-scroll">
                                                    <li data-value=""><?php echo JText::_('EXCLUDE') ?></li>
                                                    <li data-value="include"><?php echo JText::_('INCLUDE') ?></li>
                                                </ul>
                                                <i class="zmdi zmdi-caret-down"></i>
                                            </div>
                                            <?php echo $this->form->getInput('tags_method');?>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('MAX_ITEMS') ?>
                                            </lable>
                                            <?php echo $this->form->getInput('max_tags'); ?>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('POSITION') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-value="left" data-option="tags_position"
                                                        data-trigger="1" data-equal="colors_position">
                                                        <i class="zmdi zmdi-format-align-left"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('LEFT') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="right" data-option="tags_position"
                                                        data-trigger="1" data-equal="colors_position">
                                                        <i class="zmdi zmdi-format-align-right"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('RIGHT') ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('tags_position'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('TYPOGRAPHY'); ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('FONT') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <div>
                                                        <?php echo $this->form->getInput('tags_font_size'); ?>
                                                        <span class="ba-tooltip ba-top">
                                                            <?php echo JText::_('FONT_SIZE') ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label data-value="bold" data-option="tags_font_weight"
                                                        data-trigger="1">
                                                        <i class="zmdi zmdi-format-bold"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('BOLD'); ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('tags_font_weight'); ?>
                                                </div>
                                                <div>
                                                    <label data-value="left" data-option="tags_alignment"
                                                        data-trigger="1" data-equal="colors_alignment">
                                                        <i class="zmdi zmdi-format-align-left"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('LEFT') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="center" data-option="tags_alignment"
                                                        data-trigger="1" data-equal="colors_alignment">
                                                        <i class="zmdi zmdi-format-align-center"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('CENTER') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="right" data-option="tags_alignment"
                                                        data-trigger="1" data-equal="colors_alignment">
                                                        <i class="zmdi zmdi-format-align-right"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('RIGHT') ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('tags_alignment'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ba-group-element ba-minicolors-top">
                                            <lable class="option-label">
                                                <?php echo JText::_('FONT_COLOR') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="tags_font_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('tags_font_color');?>
                                        </div>
                                        <div class="ba-group-element ba-minicolors-top">
                                            <lable class="option-label">
                                                <?php echo JText::_('FONT_COLOR_HOVER') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="tags_font_color_hover" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('tags_font_color_hover');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('BACKGROUND') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BG_COLOR') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="tags_bg_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('tags_bg_color');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BG_COLOR_HOVER') ?>
                                            </lable>
                                            <input type="text" data-type="color" id="tags_bg_color_hover" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('tags_bg_color_hover');?>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('BORDER') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BORDER_COLOR'); ?>
                                            </lable>
                                            <input type="text" data-type="color" id="tags_border_color" class="minicolors-trigger">
                                            <span class="minicolors-opacity-wrapper">
                                                <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                                <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                            </span>
                                            <?php echo $this->form->getInput('tags_border_color');?>
                                        </div>
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BORDER_RADIUS'); ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=120>
                                            <?php echo $this->form->getInput('tags_border_radius');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="filter-colors-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ENABLE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[enable_colors]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('enable_colors', $this->form); ?>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('FILTERING_METHOD') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <ul class="select-no-scroll">
                                                    <li data-value=""><?php echo JText::_('EXCLUDE') ?></li>
                                                    <li data-value="include"><?php echo JText::_('INCLUDE') ?></li>
                                                </ul>
                                                <i class="zmdi zmdi-caret-down"></i>
                                            </div>
                                            <?php echo $this->form->getInput('colors_method');?>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('MAX_ITEMS') ?>
                                            </lable>
                                            <?php echo $this->form->getInput('max_colors'); ?>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('POSITION') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-value="left" data-option="colors_position"
                                                        data-trigger="1" data-equal="tags_position">
                                                        <i class="zmdi zmdi-format-align-left"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('LEFT') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="right" data-option="colors_position"
                                                        data-trigger="1" data-equal="tags_position">
                                                        <i class="zmdi zmdi-format-align-right"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('RIGHT') ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('colors_position'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('ALIGNMENT') ?>
                                            </lable>
                                            <div class="ba-gallery-settings-toolbar">
                                                <div>
                                                    <label data-value="left" data-option="colors_alignment"
                                                        data-trigger="1" data-equal="tags_alignment">
                                                        <i class="zmdi zmdi-format-align-left"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('LEFT') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="center" data-option="colors_alignment"
                                                        data-trigger="1" data-equal="tags_alignment">
                                                        <i class="zmdi zmdi-format-align-center"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('CENTER') ?>
                                                        </span>
                                                    </label>
                                                    <label data-value="right" data-option="colors_alignment"
                                                        data-trigger="1" data-equal="tags_alignment">
                                                        <i class="zmdi zmdi-format-align-right"></i>
                                                        <span class="ba-tooltip ba-top ba-hide-element">
                                                            <?php echo JText::_('RIGHT') ?>
                                                        </span>
                                                    </label>
                                                    <?php echo $this->form->getInput('colors_alignment'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="ba-group-title"><?php echo JText::_('BORDER') ?></p>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('BORDER_RADIUS'); ?>
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=120>
                                            <?php echo $this->form->getInput('colors_border_radius');?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pagination-options">
<?php
                    if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('ENABLE_PAGINATION') ?>
                                </lable>
                                <input type="hidden" name="jform[pagination]" value="0">
                                <label class="ba-checkbox">                                            
                                    <?php echo bagalleryHelper::getJoomlaCheckboxes('pagination', $this->form); ?>
                                    <span></span>
                                </label>
                            </div>
                        </div>
<?php
                    }
?>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('PAGINATION_TYPE') ?>
                                </lable>
                                <div class="ba-custom-select">
                                    <input type="text" class="ba-form-trigger" data-value=""
                                           readonly value="">
                                    <i class="zmdi zmdi-caret-down"></i>
                                    <ul>
                                        <li data-value="default"><?php echo JText::_('DEFAULT') ?></li>
                                        <li data-value="infinity"><?php echo JText::_('INFINITY') ?></li>
                                        <li data-value="load"><?php echo JText::_('LOAD_MORE') ?></li>
                                        <li data-value="slider"><?php echo JText::_('SLIDER') ?></li>
                                    </ul>
                                </div>
                                <?php echo $this->form->getInput('pagination_type');?>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('IMAGES_PER_PAGE') ?>
                                </lable>
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-gallery-range" min="0" max=100>
                                <?php echo $this->form->getInput('images_per_page');?>
                            </div>
                        </div>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('ALIGNMENT') ?>
                                </lable>
                                <div class="ba-gallery-settings-toolbar">
                                    <div>
                                        <label data-value="left" data-option="pagination_alignment"
                                            data-trigger="1">
                                            <i class="zmdi zmdi-format-align-left"></i>
                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                <?php echo JText::_('LEFT') ?>
                                            </span>
                                        </label>
                                        <label data-value="center" data-option="pagination_alignment"
                                            data-trigger="1">
                                            <i class="zmdi zmdi-format-align-center"></i>
                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                <?php echo JText::_('CENTER') ?>
                                            </span>
                                        </label>
                                        <label data-value="right" data-option="pagination_alignment"
                                            data-trigger="1">
                                            <i class="zmdi zmdi-format-align-right"></i>
                                            <span class="ba-tooltip ba-top ba-hide-element">
                                                <?php echo JText::_('RIGHT') ?>
                                            </span>
                                        </label>
                                        <?php echo $this->form->getInput('pagination_alignment'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="ba-group-title"><?php echo JText::_('TYPOGRAPHY') ?></p>
                        <div class="ba-options-group">
                            <div class="ba-group-element ba-minicolors-top">
                                <lable class="option-label">
                                    <?php echo JText::_('FONT_COLOR') ?>
                                </lable>
                                <input type="text" data-type="color" id="pagination_font" class="minicolors-trigger">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                                <?php echo $this->form->getInput('pagination_font');?>
                            </div>
                            <div class="ba-group-element ba-minicolors-top">
                                <lable class="option-label">
                                    <?php echo JText::_('FONT_COLOR_HOVER') ?>
                                </lable>
                                <input type="text" data-type="color" id="pagination_font_hover" class="minicolors-trigger">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                                <?php echo $this->form->getInput('pagination_font_hover');?>
                            </div>
                        </div>
                        <p class="ba-group-title"><?php echo JText::_('BACKGROUND') ?></p>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('BG_COLOR') ?>
                                </lable>
                                <input type="text" data-type="color" id="pagination_bg" class="minicolors-trigger">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                                <?php echo $this->form->getInput('pagination_bg');?>
                            </div>
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('BG_COLOR_HOVER') ?>
                                </lable>
                                <input type="text" data-type="color" id="pagination_bg_hover" class="minicolors-trigger">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                                <?php echo $this->form->getInput('pagination_bg_hover');?>
                            </div>
                        </div>
                        <p class="ba-group-title"><?php echo JText::_('BORDER') ?></p>
                        <div class="ba-options-group">
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('BORDER_COLOR') ?>
                                </lable>
                                <input type="text" data-type="color" id="pagination_border" class="minicolors-trigger">
                                <span class="minicolors-opacity-wrapper">
                                    <input type="number" class="minicolors-opacity" min="0" max="1" step="0.01">
                                    <span class="ba-tooltip ba-top ba-hide-element"><?php echo JText::_('OPACITY') ?></span>
                                </span>
                                <?php echo $this->form->getInput('pagination_border');?>
                            </div>
                            <div class="ba-group-element">
                                <lable class="option-label">
                                    <?php echo JText::_('BORDER_RADIUS') ?>
                                </lable>
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-gallery-range" min="0" max=120>
                                <?php echo $this->form->getInput('pagination_radius');?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="copyright-options">
                        <div class="left-tabs">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#copyright-general-options" data-toggle="tab">
                                        <i class="zmdi zmdi-settings"></i>
                                        <?php echo JText::_('GENERAL') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#copyright-watermark-options" data-toggle="tab">
                                        <i class="zmdi zmdi-star"></i>
                                        <?php echo JText::_('WATERMARK') ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="copyright-general-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISABLE_RIGHT_CLICK') ?>
                                            </lable>
                                            <input type="hidden" name="jform[disable_right_clk]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('disable_right_clk', $this->form); ?>
                                                <span></span>
                                            </label>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('DISABLE_RIGHT_CLICK_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>      
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISABLE_SHORTCUTS') ?>
                                            </lable>
                                            <input type="hidden" name="jform[disable_shortcuts]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('disable_shortcuts', $this->form); ?>
                                                <span></span>
                                            </label>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('DISABLE_SHORTCUTS_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>      
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('DISABLE_DEVELOPER_CONSOLE') ?>
                                            </lable>
                                            <input type="hidden" name="jform[disable_dev_console]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('disable_dev_console', $this->form); ?>
                                                <span></span>
                                            </label>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('DISABLE_DEVELOPER_CONSOLE_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>      
                                    </div>
                                </div>
                                <div class="tab-pane" id="copyright-watermark-options">
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('UPLOAD_IMAGE') ?>
                                            </lable>
                                            <?php echo $this->form->getInput('watermark_upload');?>
                                            <div class="reset">
                                                <i class="zmdi zmdi-close" id="remove-watermark"></i>
                                                <span class="ba-tooltip ba-top"><?php echo JText::_('DELETE_WATERMARK'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('WATERMARK_POSITION') ?>
                                            </lable>
                                            <div class="ba-custom-select">
                                                <input type="text" class="ba-form-trigger" data-value=""
                                                       readonly value="">
                                                <i class="zmdi zmdi-caret-down"></i>
                                                <ul class="select-no-scroll">
                                                    <li data-value="top_left"><?php echo JText::_('TOP_LEFT') ?></li>
                                                    <li data-value="top_right"><?php echo JText::_('TOP_RIGHT') ?></li>
                                                    <li data-value="center"><?php echo JText::_('CENTER') ?></li>
                                                    <li data-value="bottom_left"><?php echo JText::_('BOTTOM_LEFT') ?></li>
                                                    <li data-value="bottom_right"><?php echo JText::_('BOTTOM_RIGHT') ?></li>
                                                </ul>
                                            </div>
                                            <?php echo $this->form->getInput('watermark_position');?>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('WATERMARK_OPACITY') ?>, %
                                            </lable>
                                            <span class="ba-range-liner"></span>
                                            <input type="range" class="ba-gallery-range" min="0" max=100>
                                            <?php echo $this->form->getInput('watermark_opacity');?>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('WATERMARK_OPACITY_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="ba-options-group">
                                        <div class="ba-group-element">
                                            <lable class="option-label">
                                                <?php echo JText::_('SCALE_WATERMARK') ?>
                                            </lable>
                                            <input type="hidden" name="jform[scale_watermark]" value="0">
                                            <label class="ba-checkbox">
                                                <?php echo bagalleryHelper::getJoomlaCheckboxes('scale_watermark', $this->form); ?>
                                                <span></span>
                                            </label>
                                            <label class="ba-help-icon">
                                                <i class="zmdi zmdi-help"></i>
                                                <span class="ba-tooltip ba-help">
                                                    <?php echo JText::_('SCALE_WATERMARK_TOOLTIP'); ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="move-to-modal" class="ba-modal-md modal hide" style="display:none">
            <div class="modal-body">
                <div class="ba-modal-header">
                    <h3><?php echo JText::_('MOVE_TO'); ?></h3>
                    <i data-dismiss="modal" class="zmdi zmdi-close"></i>
                </div>
                <div class="availible-folders">
                    <ul>
                        <li data-id="root">
                            <span>
                                <i class="zmdi zmdi-folder"></i>
                                <?php echo JText::_('ROOT'); ?>
                            </span>                            
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="ba-btn" data-dismiss="modal">
                    <?php echo JText::_('CANCEL') ?>
                </a>
                <a href="#" class="ba-btn-primary apply-move">
                    <?php echo JText::_('JTOOLBAR_APPLY') ?>
                </a>
            </div>
        </div>
    <div id="html-editor" class="ba-modal-lg modal hide" style="display:none">
        <div class="ba-modal-header">
            <h3><?php echo JText::_('EDIT_DESCRIPTION'); ?></h3>
            <div class="modal-header-icon">
                <i class="zmdi zmdi-check" id="apply-html"></i>
                <i class="zmdi zmdi-close" data-dismiss="modal"></i>    
            </div>
        </div>
        <div class="modal-body">
            <textarea name="CKE-editor"></textarea>
        </div>
    </div>
    <div id="add-link-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('INSERT_LINK'); ?></h3>
            <input type="text" class="image-link" placeholder="<?php echo JText::_('LINK'); ?>">
            <span class="focus-underline"></span>
            <div class="select-link">
                <i class="zmdi zmdi-attachment-alt"></i>
                <span class="ba-tooltip ba-top"><?php echo JText::_('LINK_PICKER'); ?></span>
            </div>
            <div class="ba-custom-select">
                <input type="text" class="link-target" data-value=""
                       readonly placeholder="<?php echo JText::_('TARGET'); ?>">
                <i class="zmdi zmdi-caret-down"></i>
                <ul>
                    <li data-value="blank"><?php echo JText::_('NEW_WINDOW') ?></li>
                    <li data-value="self"><?php echo JText::_('SAME_WINDOW') ?></li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary active-button" id="add-link">
                <?php echo JText::_('JTOOLBAR_APPLY') ?>
            </a>
        </div>
    </div>
    <div id="insert-video-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('ADD_VIDEO'); ?></h3>
            <div class="ba-custom-select">
                <input type="text" data-key="type" data-value=""
                       readonly placeholder="<?php echo JText::_('ADD_VIDEO'); ?>">
                <i class="zmdi zmdi-caret-down"></i>
                <ul>
                    <li data-value="youtube">Youtube</li>
                    <li data-value="vimeo">Vimeo</li>
                </ul>
            </div>
            <input type="text" data-key="id" placeholder="<?php echo JText::_('ENTER_VIDEO_ID'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary" id="apply-video">
                <?php echo JText::_('JTOOLBAR_APPLY') ?>
            </a>
        </div>
    </div>
<?php
    if ($this->about->tag == 'pro' && isset($galleryState->data)) {

    } else {
?>
    <input type="hidden" name="jform[category_list]" value="0">
    <input type="hidden" name="jform[pagination]" value="0">
    <input type="hidden" name="jform[album_mode]" value="0">
    <input type="hidden" name="jform[lazy_load]" value="0">
    <input type="hidden" name="jform[auto_resize]" value="1">
    <input type="hidden" name="jform[lightbox_width]" value="45">
    <input type="hidden" name="jform[description_position]" value="below">
    <input type="hidden" name="jform[display_zoom]" value="0">
    <input type="hidden" name="jform[display_fullscreen]" value="0">
    <input type="hidden" name="jform[twitter_share]" value="0">
    <input type="hidden" name="jform[facebook_share]" value="0">
    <input type="hidden" name="jform[pinterest_share]" value="0">
    <input type="hidden" name="jform[linkedin_share]" value="0">
    <input type="hidden" name="jform[vkontakte_share]" value="0">
    <input type="hidden" name="jform[odnoklassniki_share]" value="0">
    <input type="hidden" name="jform[display_likes]" value="0">
    <input type="hidden" name="jform[display_download]" value="0">
    <input type="hidden" name="jform[display_thumb_likes]" value="0">
<?php
    }
?>
    <div id="create-category-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('CREATE_CATEGORY'); ?></h3>
            <input type="text" class="category-name" placeholder="<?php echo JText::_('CATEGORY_NAME') ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary" id="create-new-category">
                <?php echo JText::_('JTOOLBAR_APPLY') ?>
            </a>
        </div>
    </div>
    <div id="delete-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('DELETE_ITEM'); ?></h3>
            <p class="modal-text can-delete"><?php echo JText::_('MODAL_DELETE') ?></p>
            <p class="modal-text cannot-delete" style="display:none"><?php echo JText::_('CANNOT_DELETE') ?></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary red-btn" id="apply-delete">
                <?php echo JText::_('DELETE') ?>
            </a>
        </div>
    </div>
    <div id="deafult-message-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <p class="modal-text"><?php echo JText::_('CANNOT_DELETE_DEFAULT') ?></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CLOSE') ?></a>
        </div>
    </div>
    <div id="message-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <p class="modal-text cannot-default"><?php echo JText::_('CANNOT_DEFAULT') ?></p>
            <p class="modal-text cannot-unpublish" style="display:none"><?php echo JText::_('CANNOT_UNPUBLISH') ?></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CLOSE') ?></a>
        </div>
    </div>
    <div class="gallery-editor row-fluid">
        <div class="category-list span3">
            <a class="create-categery">
                + <?php echo JText::_('CATEGORY'); ?>
            </a>
            <ul>
                <li class="root" id="root">
                    <a>
                        <i class="zmdi zmdi-folder"></i>
                        <span><?php echo JText::_('ROOT'); ?></span>
                    </a>
                    <ul class="root-list">
                        <li id="category-all" class="ba-category" data-id="0">
                            <a>
                                <label>
                                    <input type="checkbox">
                                    <i class="zmdi zmdi-folder"></i>
                                </label>                        
                                <span><?php echo JText::_('ALL'); ?></span>
                                <i class="zmdi zmdi-star"></i>
                                <input type="hidden" class="cat-options" name="cat-options[]"
                                       value="<?php echo JText::_('ALL') ?>;1;1;*;0">
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="images-list span6">
            <div class="table-head">
                <input type="checkbox"  id="check-all">
                <i class="zmdi zmdi-check-circle check-all"></i>
                <div class="header-icons">
                    <label class="ba-custom-select ba-sorting-action-wrapper">
                        <span>
                            <i class="zmdi zmdi-sort-asc sort-action"></i>
                            <span class="ba-tooltip ba-bottom">
                                <?php echo JText::_('SORT_OPTIONS'); ?>
                            </span>
                        </span>
                        <ul>
                            <li data-value="name"><?php echo JText::_('NAME') ?></li>
                            <li data-value="newest"><?php echo JText::_('NEWEST') ?></li>
                            <li data-value="oldest"><?php echo JText::_('OLDEST') ?></li>
                        </ul>
                    </label>
                    <label>
                        <i class="zmdi zmdi-forward move-to disabled-item"></i>
                        <span class="ba-tooltip ba-bottom">
                            <?php echo JText::_('MOVE_TO'); ?>
                        </span>
                    </label>
                    <label>
                        <i class="zmdi zmdi-playlist-plus filename-to-title disabled-item"></i>
                        <span class="ba-tooltip ba-bottom">
                            <?php echo JText::_('FILENAME_TO_TITLE'); ?>
                        </span>
                    </label>
                    <label>
                        <i class="zmdi zmdi-delete delete-selected disabled-item"></i>
                    </label>
                </div>
                <div class="pagination-limit">
                    <div class="ba-custom-select">
                        <input readonly value="<?php echo $pagLimit[$paginator]; ?>"
                           data-value="<?php echo $paginator; ?>"
                           size="<?php echo strlen($pagLimit[$paginator]); ?>" type="text">
                        <i class="zmdi zmdi-caret-down"></i>
                        <ul>
                            <?php
                            foreach ($pagLimit as $key => $lim) {
                                $str = '<li data-value="'.$key.'">';
                                $str .= $lim.'</li>';
                                echo $str;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-body">
                <table class="ba-items-list ba-category-table">
                    <tbody>
                        
                    </tbody>
                </table>
                <table class="ba-items-list ba-items-table">
                    <tbody></tbody>
                </table>
            </div>
            <div class="camera-container disabled-item">
                <i class="zmdi zmdi-camera upload-images disabled-item"></i>
            </div>            
        </div>
        <div class="gallery-options span3">
            <div class="gallery-header" style="display: none;">
                <label>
                    <i class="zmdi zmdi-edit edit-description"></i>
                    <span class="ba-tooltip ba-bottom">
                        <?php echo JText::_('EDIT_DESCRIPTION'); ?>
                    </span>
                </label>
                <label>
                    <i class="zmdi zmdi-link add-link"></i>
                    <span class="ba-tooltip ba-bottom">
                        <?php echo JText::_('INSERT_LINK'); ?>
                    </span>
                </label>
                <label>
                    <i class="zmdi zmdi-code add-embed-code"></i>
                    <span class="ba-tooltip ba-bottom">
                        <?php echo JText::_('EMBED_CODE'); ?>
                    </span>
                </label>
                <label>
                    <i class="zmdi zmdi-delete delete-item"></i>
                </label>
            </div>
            <div id="category-options" class="category-options" style="display: none;">
                <div class="img-thumbnail">
                    <div class="camera-container">
                        <i class="zmdi zmdi-camera"></i>
                    </div>
                </div>
                <div class="options">
                    <lable class="option-label"><?php echo JText::_('TITLE') ?></lable>
                    <div>
                        <input id="category-name" type="text">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('ALIAS') ?>
                    </lable>
                    <div>
                        <input type="text" class="category-alias">
                        <span class="focus-underline"></span>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('JFIELD_ACCESS_LABEL'); ?>
                    </lable>
                    <div class="ba-custom-select access-select">
                        <input readonly value="" data-value="" type="text" id="access">
                        <i class="zmdi zmdi-caret-down"></i>
                        <ul>
                            <?php
                            foreach ($this->access as $key => $access) {
                                $str = '<li data-value="'.$key.'">';
                                $str .= $access.'</li>';
                                echo $str;
                            }
                            ?>
                        </ul>
                    </div>
<?php
                if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
                    <lable class="option-label">
                        <?php echo JText::_('PASSWORD'); ?>
                    </lable>
                    <div>
                        <input type="password" class="category-password">
                        <span class="focus-underline"></span>
                        <div class="hidden-password">
                            <i class="zmdi zmdi-eye-off"></i>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('HIDDEN'); ?></span>
                        </div>
                        <div class="visible-password" style="display: none;">
                            <i class="zmdi zmdi-eye"></i>
                            <span class="ba-tooltip ba-top"><?php echo JText::_('VISIBLE'); ?></span>
                        </div>
                    </div>
<?php
                }
?>
                    <div class="checkbox-parent">
                        <div>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="default-category">
                                <span></span>
                            </label>
                            <lable class="option-label"><?php echo JText::_('DEFAULT_CATEGORY') ?></lable>
                        </div>
                        <div>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="unpublish-category">
                                <span></span>
                            </label>                            
                            <lable class="option-label"><?php echo JText::_('UNPUBLISH') ?></lable> 
                        </div>                                               
                    </div>
                </div>                
            </div>
            <div class="images-options" style="display: none;">
                <div class="img-thumbnail">
                    <div class="camera-container">
                        <i class="zmdi zmdi-camera"></i>
                    </div>
                </div>
                <div class="options">
                    <lable class="option-label">
                        <?php echo JText::_('TITLE') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-title">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('ALIAS') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-alias">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('SHORT_DESCRIPTION') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-short">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('IMAGE_ALT') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-alt">
                        <span class="focus-underline"></span>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('TAGS') ?>
                    </lable>
                    <label class="ba-help-icon">
                        <i class="zmdi zmdi-help"></i>
                        <span class="ba-tooltip ba-help ba-hide-element">
                            <?php echo JText::_('TAGS_TOOLTIP'); ?>
                        </span>
                    </label>
                    <div class="meta-tags">
                        <select style="display: none;" name="meta_tags[]" class="meta_tags" multiple></select>
                        <ul class="picked-tags">
                            <li class="search-tag">
                                <input type="text">
                            </li>
                        </ul>
                        <ul class="all-tags">
                            <?php foreach ($this->tags as $tag) {
                                echo '<li data-id="'.$tag->id.'" style="display:none;">'.$tag->title.'</li>';
                            } ?>
                        </ul>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('COLORS') ?>
                    </lable>
                    <label class="ba-help-icon">
                        <i class="zmdi zmdi-help"></i>
                        <span class="ba-tooltip ba-help ba-hide-element">
                            <?php echo JText::_('COLORS_TOOLTIP'); ?>
                        </span>
                    </label>
                    <div class="image-colors">
                        <select style="display: none;" class="image_colors" multiple></select>
                        <ul class="picked-colors">
                            <li class="search-colors">
                                <input type="text" data-type="color">
                            </li>
                        </ul>
                        <ul class="all-colors" style="display: none;">
                            <?php foreach ($this->colors as $color) {
                                echo '<li data-id="'.$color->id.'">'.$color->title.'</li>';
                            } ?>
                        </ul>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('ALTERNATIVE_IMAGE'); ?>
                    </lable>
                    <label class="ba-help-icon">
                        <i class="zmdi zmdi-help"></i>
                        <span class="ba-tooltip ba-help">
                            <?php echo JText::_('ALTERNATIVE_IMAGE_TOOLTIP'); ?>
                        </span>
                    </label>
                    <div>
                        <input type="text" class="alternative-image">
                        <span class="focus-underline"></span>
                    </div>
                    <i class="zmdi zmdi-close delete-alternative-image"></i>
                    <lable class="option-label">
                        <?php echo JText::_('CLASS_SUFFIX') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-suffix">
                        <span class="focus-underline"></span>
                    </div>
                    <div class="checkbox-parent">
                        <div>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="hide-in-category-all">
                                <span></span>
                            </label>                            
                            <lable class="option-label"><?php echo JText::_('HIDE_IN_CATEGORY_ALL') ?></lable> 
                        </div>                                               
                    </div>                 
                </div>                
            </div>
            <img src="<?php echo jUri::root().'administrator/components/com_bagallery/assets/images/gallery-logo.svg' ?>">
        </div>
    </div>    
    <div class="ba-context-menu empty-context-menu" style="display: none">
        <span class="upload-images disabled-item"><i class="zmdi zmdi-camera"></i><?php echo JText::_('ADD_IMAGE'); ?></span>
        <span class="create-categery"><i class="zmdi zmdi-folder"></i><?php echo JText::_('CREATE_CATEGORY'); ?></span>
    </div>
    <div class="ba-context-menu files-context-menu" style="display: none">
<?php
        if ($this->about->tag == 'pro' && isset($galleryState->data)) {
?>
            <span class="edit-image"><i class="zmdi zmdi-camera-alt"></i><?php echo JText::_('PHOTO_EDITOR'); ?></span>
<?php
        }
?>
        <span class="move-to"><i class="zmdi zmdi-forward"></i><?php echo JText::_('MOVE_TO'); ?>...</span>
        <span class="upload-images ba-group-element"><i class="zmdi zmdi-cloud-upload"></i><?php echo JText::_('ADD_IMAGE'); ?></span>
        <span class="create-categery"><i class="zmdi zmdi-folder"></i><?php echo JText::_('CREATE_CATEGORY'); ?></span>
        <span class="delete ba-group-element"><i class="zmdi zmdi-delete"></i><?php echo JText::_('DELETE'); ?></span>
    </div>
    <div class="ba-context-menu folders-context-menu" style="display: none">
        <span class="rename"><i class="zmdi zmdi-edit"></i><?php echo JText::_('RENAME'); ?></span>
        <span class="move-to"><i class="zmdi zmdi-forward"></i><?php echo JText::_('MOVE_TO'); ?>...</span>
        <span class="delete ba-group-element"><i class="zmdi zmdi-delete"></i><?php echo JText::_('DELETE'); ?></span>
    </div>
    <div class="ba-context-menu help-context-menu" style="display: none">
        <span class="quick-view"><i class="zmdi zmdi-graduation-cap"></i><?php echo JText::_('QUICK_VIEW'); ?></span>
        <span class="documentation">
            <a target="_blank" href="http://www.balbooa.com/joomla-gallery-documentation/basics">
                <i class="zmdi zmdi-info"></i><?php echo JText::_('DOCUMENTATION'); ?>
            </a>
        </span>
        <span class="support">
            <a target="_blank" href="http://support.balbooa.com/forum/joomla-gallery">
                <i class="zmdi zmdi-help"></i><?php echo JText::_('SUPPORT'); ?>
            </a>
        </span>
        <span class="love-gallery ba-group-element">
            <i class="zmdi zmdi-favorite"></i><?php echo JText::_('LOVE_GALLERY'); ?>
        </span>
    </div>
    <input type="hidden" name="task" value="forms.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
<div id="file-upload-form" style="display: none;">
    <form target="upload-form-target" enctype="multipart/form-data" method="post"
        action="<?php echo JUri::base(); ?>index.php?option=com_bagallery&task=gallery.formUpload">
        <input type="file" multiple name="files[]">
    </form>
</div>
<div id="photo-editor-dialog" class="ba-modal-lg modal hide" style="display:none">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('PHOTO_EDITOR'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#resize-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-wallpaper"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('RESIZE'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#crop-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-crop"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('CROP'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#filter-effects-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-invert-colors"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FILTER_AND_EFFECTS'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#adjust-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-tune"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ADJUST'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#flip-rotate-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-flip"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_ROTATE'); ?></span>
                    </a>
                </li>
                <span class="photo-editor-save-image" data-context="save-image-context-menu">
                    <span><?php echo JText::_('JTOOLBAR_APPLY'); ?></span>
                    <i class="zmdi zmdi-caret-down"></i>
                </span>
            </ul>
            <div class="tabs-underline"></div>
            <div class="resize-image-wrapper">
                <div>
                    <canvas id="photo-editor"></canvas>
                </div>
                <div class="ba-crop-overlay" style="opacity: 0;">
                    <canvas id="ba-overlay-canvas"></canvas>
                    <span class="ba-crop-overlay-resize-handle" data-resize="top-left"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="top-right"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="bottom-left"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="bottom-right"></span>
                </div>
            </div>
            <span class="show-photo-media-editor">
                <i class="zmdi zmdi-camera"></i>
                <span class="ba-tooltip ba-top"><?php echo JText::_('SELECT_PICTURE_TO_START_EDIT'); ?></span>
            </span>
            <div class="tab-content">
                <div id="resize-image-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('WIDTH'); ?></span>
                                <input type="number" class="resize-width" data-callback="emptyCallback">
                            </div>
                            <div>
                                <span><?php echo JText::_('HEIGHT'); ?></span>
                                <input type="number" class="resize-height" data-callback="emptyCallback">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('IMAGE_QUALITY'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="100">
                                <input type="number" class="photo-editor-quality" data-callback="photoEditorQuality">
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="resize-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="crop-image-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('WIDTH'); ?></span>
                                <input type="number" class="crop-width" data-callback="emptyCallback">
                            </div>
                            <div>
                                <span><?php echo JText::_('HEIGHT'); ?></span>
                                <input type="number" class="crop-height" data-callback="emptyCallback">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('KEEP_PROPORTIONS'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="keep-proportions">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('ASPECT_RATIO'); ?></span>
                            <div class="ba-custom-select aspect-ratio-select">
                                <input readonly="" onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="3">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="original"><?php echo JText::_('ORIGINAL'); ?></li>
                                    <li data-value="1:1">1:1</li>
                                    <li data-value="3:2">3:2</li>
                                    <li data-value="3:4">3:4</li>
                                    <li data-value="16:9">16:9</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="crop-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="filter-effects-image-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="original"></canvas>
                            <span>original</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="1977"></canvas>
                            <span>1977</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="aden"></canvas>
                            <span>Aden</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="amaro"></canvas>
                            <span>Amaro</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="brannan"></canvas>
                            <span>Brannan</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="brooklyn"></canvas>
                            <span>Brooklyn</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="clarendon"></canvas>
                            <span>Clarendon</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="earlybird"></canvas>
                            <span>Earlybird</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="gingham"></canvas>
                            <span>Gingham</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="hudson"></canvas>
                            <span>Hudson</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="inkwell"></canvas>
                            <span>Inkwell</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="lofi"></canvas>
                            <span>Lofi</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="maven"></canvas>
                            <span>Maven</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="perpetua"></canvas>
                            <span>Perpetua</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="reyes"></canvas>
                            <span>Reyes</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="stinson"></canvas>
                            <span>Stinson</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="toaster"></canvas>
                            <span>Toaster</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="walden"></canvas>
                            <span>Walden</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="valencia"></canvas>
                            <span>Valencia</span>
                        </div>
                        <div class="filter-effects-thumbnail">
                            <canvas class="filter-effect-canvas" data-key="xpro2"></canvas>
                            <span>Xpro2</span>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="filter-effects-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="adjust-image-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('CONTRAST'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="200" step="1">
                                <input type="number" data-filter="contrast" data-callback="photoEditorFilters">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('BRIGHTNESS'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="200" step="1">
                                <input type="number" data-filter="brightness" data-callback="photoEditorFilters">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('SATURATE'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="200" step="1">
                                <input type="number" data-filter="saturate" data-callback="photoEditorFilters">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('SEPIA'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="100" step="1">
                                <input type="number" data-filter="sepia" data-callback="photoEditorFilters">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('GRAYSCALE'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="100" step="1">
                                <input type="number" data-filter="grayscale" data-callback="photoEditorFilters">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('BLUR'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="10" step="1">
                                <input type="number" data-filter="blur" data-callback="photoEditorFilters">
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="adjust-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="flip-rotate-image-options" class="row-fluid tab-pane">
                    <span>
                        <i class="zmdi zmdi-rotate-left rotate-action" data-rotate="-90"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ROTATE_LEFT'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-rotate-right rotate-action" data-rotate="90"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ROTATE_RIGHT'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-flip flip-action" data-flip="horizontal"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_HORIZONTAL'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-flip flip-action" data-flip="vertical"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_VERTICAL'); ?></span>
                    </span>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="flip-rotate-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="save-copy-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_COPY'); ?>
        </h3>
        <div class="ba-input-lg">
            <input type="text" class="photo-editor-file-title reset-input-margin"
                placeholder="<?php echo JText::_('ENTER_FILE_NAME'); ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="ba-checkbox-parent">
            <label class="ba-checkbox ba-hide-checkbox">
                <input type="checkbox" class="save-as-webp">
                <span></span>
            </label>
            <label><?php echo JText::_('SAVE_AS_WEBP'); ?></label>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-save-copy">
            <?php echo JText::_('JTOOLBAR_APPLY'); ?>
        </a>
    </div>
</div>
<div id="save-copy-notice-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_COPY'); ?>
        </h3>
        <p class="modal-text"><?php echo JText::_('SAVE_COPY_NOTICE'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary red-btn" id="apply-overwrite-copy">
            <?php echo JText::_('JTOOLBAR_APPLY'); ?>
        </a>
    </div>
</div>
<div class="ba-context-menu save-image-context-menu" style="display: none;">
    <span class="photo-editor-save-copy">
        <span><?php echo JText::_('SAVE_COPY'); ?></span>
    </span>
    <span class="save-photo-editor-image">
        <span><?php echo JText::_('JTOOLBAR_APPLY'); ?></span>
    </span>
</div>