<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

//no direct access
defined ('_JEXEC') or die ('Restricted access');

use Joomla\CMS\Component\ComponentHelper;

$addon = $displayData['addon'];

// Visibility
$custom_class = (isset($addon->settings->hidden_md) && $addon->settings->hidden_md) ? 'sppb-hidden-md sppb-hidden-lg ' : '';
$custom_class .= (isset($addon->settings->hidden_sm) && $addon->settings->hidden_sm) ? 'sppb-hidden-sm ' : '';
$custom_class .= (isset($addon->settings->hidden_xs) && $addon->settings->hidden_xs) ? 'sppb-hidden-xs ' : '';
$global_section_z_index = (isset($addon->settings->global_section_z_index) && $addon->settings->global_section_z_index) ? $addon->settings->global_section_z_index : '';
$global_addon_z_index = (isset($addon->settings->global_addon_z_index) && $addon->settings->global_addon_z_index) ? $addon->settings->global_addon_z_index : '';
$global_custom_position = (isset($addon->settings->global_custom_position) && $addon->settings->global_custom_position) ? $addon->settings->global_custom_position : '';
$global_seclect_position = (isset($addon->settings->global_seclect_position) && $addon->settings->global_seclect_position) ? $addon->settings->global_seclect_position : '';
$rowId = (isset($addon->settings->row_id) && $addon->settings->row_id) ? $addon->settings->row_id : '';
$colId = (isset($addon->settings->column_id) && $addon->settings->column_id) ? $addon->settings->column_id : '';

//Image lazy load
$config = ComponentHelper::getParams('com_sppagebuilder');
$lazyload = $config->get('lazyloadimg', '0');
$global_background_image = (isset($addon->settings->global_background_image) && $addon->settings->global_background_image) ? $addon->settings->global_background_image : '';
$global_background_image_src = isset($global_background_image->src) ? $global_background_image->src : $global_background_image;

if($lazyload && $global_background_image_src){
	if($addon->settings->global_background_type == 'image'){
		$custom_class .= 'sppb-element-lazy ';
	}
}

// Animation
$addon_attr = '';
if(isset($addon->settings->global_use_animation) && $addon->settings->global_use_animation) {
    if(isset($addon->settings->global_animation) && $addon->settings->global_animation) {
        $custom_class .= ' sppb-wow ' . $addon->settings->global_animation . ' ';
        if(isset($addon->settings->global_animationduration) && $addon->settings->global_animationduration) {
            $addon_attr .= ' data-sppb-wow-duration="' . $addon->settings->global_animationduration . 'ms" ';
        }
        if(isset($addon->settings->global_animationdelay) && $addon->settings->global_animationdelay) {
            $addon_attr .= 'data-sppb-wow-delay="' . $addon->settings->global_animationdelay . 'ms" ';
        }
    }
}

$html = '<div id="sppb-addon-wrapper-'. $addon->id .'" class="sppb-addon-wrapper">';
$html .= '<div id="sppb-addon-'. $addon->id .'" class="'. $custom_class .'clearfix '.($global_custom_position && $global_seclect_position != '' ? 'sppb-positioned-addon' : '').'" '.  $addon_attr .' '.($global_section_z_index ? 'data-zindex="'.$global_section_z_index.'"' : '').' '.($global_addon_z_index ? 'data-col-zindex="'.$global_addon_z_index.'"' : '').' '.($global_custom_position && $rowId ? 'data-rowid="'.$rowId.'"' : '').' '.($global_custom_position && $colId ? 'data-colid="'.$colId.'"' : '').'>';

if(isset($addon->settings->global_use_overlay) && $addon->settings->global_use_overlay){
    $html .= '<div class="sppb-addon-overlayer"></div>';
}
echo $html;
