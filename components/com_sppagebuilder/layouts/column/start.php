<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

$options = $displayData['options'];
$custom_class  = (isset($options->class)) ? ' ' . $options->class : '';
$data_attr = '';
$doc = JFactory::getDocument();

//Image lazy load
$config = JComponentHelper::getParams('com_sppagebuilder');	
$lazyload = $config->get('lazyloadimg', '0');
$background_image = (isset($options->background_image) && $options->background_image) ? $options->background_image : '';
$background_image_src = isset($background_image->src) ? $background_image->src : $background_image;

if($lazyload && $background_image_src){
	if($options->background_type == 'image'){
		$custom_class .= ' sppb-element-lazy';
	}
}

// Responsive
if(isset($options->sm_col) && $options->sm_col) {
	$options->cssClassName .= ' sppb-' . $options->sm_col;
}

if(isset($options->xs_col) && $options->xs_col) {
	$options->cssClassName .= ' sppb-' . $options->xs_col;
}
if(isset($options->items_align_center) && $options->items_align_center ) {
	$options->cssClassName .= ' sppp-column-vertical-align';
}
//Column order
$column_order = '';
if(isset($options->tablet_order) && $options->tablet_order) {
	$column_order .= ' sppb-order-sm-'.$options->tablet_order;
}
if(isset($options->mobile_order) && $options->mobile_order) {
	$column_order .= ' sppb-order-xs-'.$options->mobile_order;
}
// Visibility
if(isset($options->hidden_md) && $options->hidden_md) {
	$custom_class .= ' sppb-hidden-md sppb-hidden-lg';
}

if(isset($options->hidden_sm) && $options->hidden_sm) {
	$custom_class .= ' sppb-hidden-sm';
}

if(isset($options->hidden_xs) && $options->hidden_xs) {
	$custom_class .= ' sppb-hidden-xs';
}

if(isset($options->items_content_alignment) && $options->items_content_alignment == 'top'){
	$custom_class .= (isset($options->items_align_center) && $options->items_align_center ) ?  ' sppb-align-items-top' : '';
} else if (isset($options->items_content_alignment) && $options->items_content_alignment == 'bottom'){
	$custom_class .= (isset($options->items_align_center) && $options->items_align_center ) ?  ' sppb-align-items-bottom' : '';
} else {
	$custom_class .= (isset($options->items_align_center) && $options->items_align_center ) ?  ' sppb-align-items-center' : '';
}

// Animation
if(isset($options->animation) && $options->animation) {

	$custom_class .= ' sppb-wow ' . $options->animation;

	if(isset($options->animationduration) && $options->animationduration) {
		$data_attr .= ' data-sppb-wow-duration="' . $options->animationduration . 'ms"';
	}

	if(isset($options->animationdelay) && $options->animationdelay) {
		$data_attr .= ' data-sppb-wow-delay="' . $options->animationdelay . 'ms"';
	}
}

$html  = '';
$html .= '<div class="sppb-' . $options->cssClassName . ''.$column_order.'" id="column-wrap-id-'. $options->dynamicId .'">';
$html .= '<div id="column-id-'. $options->dynamicId .'" class="sppb-column' . $custom_class . '" ' . $data_attr . '>';

if ($background_image_src) {
	if (isset($options->overlay_type) && $options->overlay_type !== 'overlay_none') {
		$html .= '<div class="sppb-column-overlay"></div>';
	}
}

$html .= '<div class="sppb-column-addons">';

echo $html;
