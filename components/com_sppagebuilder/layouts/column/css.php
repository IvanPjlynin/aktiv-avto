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
$placeholder = $config->get('lazyplaceholder', '');
$lazy_bg_image = '';
$placeholder_bg_image = '';

// Style
$style ='';
$style_sm ='';
$style_xs ='';

$style_wrap ='';
$style_wrap_sm ='';
$style_wrap_xs ='';

$column_styles = '';

if(isset($options->column_height)){
	if(is_object($options->column_height)){
		if(isset($options->column_height->md) && $options->column_height->md){
			$style .= 'height:'.$options->column_height->md.'px;';
		}
			
		if (isset($options->column_height->sm) && $options->column_height->sm){
			$style_sm .= 'height:'.$options->column_height->sm.'px;';
		}
			
		if (isset($options->column_height->xs) && $options->column_height->xs){
			$style_xs .= 'height:'.$options->column_height->xs.'px;';
		}
	} else {
		if ($options->column_height) {
			$style .= 'height:'.$options->column_height.'px;';
		}
	}
}

if(isset($options->column_min_height)){
	if(is_object($options->column_min_height)){
		if(isset($options->column_min_height->md) && $options->column_min_height->md){
			$style .= 'min-height:'.$options->column_min_height->md.'px;';
		}
			
		if (isset($options->column_min_height->sm) && $options->column_min_height->sm){
			$style_sm .= 'min-height:'.$options->column_min_height->sm.'px;';
		}
			
		if (isset($options->column_min_height->xs) && $options->column_min_height->xs){
			$style_xs .= 'min-height:'.$options->column_min_height->xs.'px;';
		}
	} else {
		if ($options->column_min_height) {
			$style .= 'min-height:'.$options->column_min_height.'px;';
		}
	}
}
if(isset($options->column_max_height)){
	if(is_object($options->column_max_height)){
		if(isset($options->column_max_height->md) && $options->column_max_height->md){
			$style .= 'max-height:'.$options->column_max_height->md.'px;';
		}
			
		if (isset($options->column_max_height->sm) && $options->column_max_height->sm){
			$style_sm .= 'max-height:'.$options->column_max_height->sm.'px;';
		}
			
		if (isset($options->column_max_height->xs) && $options->column_max_height->xs){
			$style_xs .= 'max-height:'.$options->column_max_height->xs.'px;';
		}
	} else {
		if ($options->column_max_height) {
			$style .= 'max-height:'.$options->column_max_height.'px;';
		}
	}
}

if(isset($options->padding) && is_object($options->padding)){
	if (isset($options->padding->md) && $options->padding->md) $style .= SppagebuilderHelperSite::getPaddingMargin($options->padding->md, 'padding');
	if (isset($options->padding->sm) && $options->padding->sm) $style_sm .= SppagebuilderHelperSite::getPaddingMargin($options->padding->sm, 'padding');
	if (isset($options->padding->xs) && $options->padding->xs) $style_xs .= SppagebuilderHelperSite::getPaddingMargin($options->padding->xs, 'padding');
} else {
	if (isset($options->padding) && $options->padding) $style .= SppagebuilderHelperSite::getPaddingMargin($options->padding, 'padding');
	if (isset($options->padding_sm) && $options->padding_sm) $style_sm .= SppagebuilderHelperSite::getPaddingMargin($options->padding_sm, 'padding');
	if (isset($options->padding_xs) && $options->padding_xs) $style_xs .= SppagebuilderHelperSite::getPaddingMargin($options->padding_xs, 'padding');
}

if(isset($options->margin) && is_object($options->margin)){
	if (isset($options->margin->md) && $options->margin->md) $style_wrap .= SppagebuilderHelperSite::getPaddingMargin($options->margin->md, 'margin');
	if (isset($options->margin->sm) && $options->margin->sm) $style_wrap_sm .= SppagebuilderHelperSite::getPaddingMargin($options->margin->sm, 'margin');
	if (isset($options->margin->xs) && $options->margin->xs) $style_wrap_xs .= SppagebuilderHelperSite::getPaddingMargin($options->margin->xs, 'margin');
} else {
	if (isset($options->margin) && $options->margin) $style_wrap .= SppagebuilderHelperSite::getPaddingMargin($options->margin, 'margin');
	if (isset($options->margin_sm) && $options->margin_sm) $style_wrap_sm .= SppagebuilderHelperSite::getPaddingMargin($options->margin_sm, 'margin');
	if (isset($options->margin_xs) && $options->margin_xs) $style_wrap_xs .= SppagebuilderHelperSite::getPaddingMargin($options->margin_xs, 'margin');
}

// Border
if(isset($options->use_border) && $options->use_border) {

	if(isset($options->border_width) && is_object($options->border_width)){
		$style .= !empty($options->border_width->md) ? "border-width: " . $options->border_width->md . "px;\n" : "";
		$style_sm .= !empty($options->border_width->sm) ? "border-width: " . $options->border_width->sm . "px;\n" : "";
		$style_xs .= !empty($options->border_width->xs) ? "border-width: " . $options->border_width->xs . "px;\n" : "";
	} else {
		$style .= isset($options->border_width) && $options->border_width ? "border-width: " . $options->border_width . "px;\n" : "";
		$style_sm .= isset($options->border_width_sm) && $options->border_width_sm ? "border-width: " . $options->border_width_sm . "px;\n" : "";
		$style_xs .= isset($options->border_width_xs) && $options->border_width_xs ? "border-width: " . $options->border_width_xs . "px;\n" : "";
	}


    if(isset($options->border_color) && $options->border_color) {
        $style .= "border-color: " . $options->border_color . ";\n";
    }

    if(isset($options->boder_style) && $options->boder_style) {
        $style .= "border-style: " . $options->boder_style . ";\n";
    }
}

$border_radius_style = '';
$border_radius_style_sm = '';
$border_radius_style_xs = '';
if(isset($options->border_radius)){
	if(is_object($options->border_radius)){
		$border_radius_style .= (isset($options->border_radius->md) && $options->border_radius->md) ? "border-radius: " . $options->border_radius->md . "px;\n" : "";
		$border_radius_style_sm .= (isset($options->border_radius->sm) && $options->border_radius->sm) ? "border-radius: " . $options->border_radius->sm . "px;\n" : "";
		$border_radius_style_xs .= (isset($options->border_radius->xs) && $options->border_radius->xs) ? "border-radius: " . $options->border_radius->xs . "px;\n" : "";
	} else {
		$border_radius_style .= (isset($options->border_radius_md) && $options->border_radius_md) ? "border-radius: " . $options->border_radius_md . "px;\n" : "";
		$border_radius_style_sm .= (isset($options->border_radius_sm) && $options->border_radius_sm) ? "border-radius: " . $options->border_radius_sm . "px;\n" : "";
		$border_radius_style_xs .= (isset($options->border_radius_xs) && $options->border_radius_xs) ? "border-radius: " . $options->border_radius_xs . "px;\n" : "";

	}
}

// Box Shadow
if(isset($options->boxshadow) && $options->boxshadow){
    if(is_object($options->boxshadow)){
        $ho = (isset($options->boxshadow->ho) && $options->boxshadow->ho != '') ? $options->boxshadow->ho.'px' : '0px';
        $vo = (isset($options->boxshadow->vo) && $options->boxshadow->vo != '') ? $options->boxshadow->vo.'px' : '0px';
        $blur = (isset($options->boxshadow->blur) && $options->boxshadow->blur != '') ? $options->boxshadow->blur.'px' : '0px';
        $spread = (isset($options->boxshadow->spread) && $options->boxshadow->spread != '') ? $options->boxshadow->spread.'px' : '0px';
        $color = (isset($options->boxshadow->color) && $options->boxshadow->color != '') ? $options->boxshadow->color : '#fff';

        $style .= "box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};";
    } else {
        $style .= "box-shadow: " . $options->boxshadow . ";";
    }
}

if (isset($options->color) && $options->color) $style .= 'color:'.$options->color.';';

$background_image = (isset($options->background_image) && $options->background_image) ? $options->background_image : '';
$background_image_src = isset($background_image->src) ? $background_image->src : $background_image;
if(isset($options->background_type)){
	if (($options->background_type == 'image' || $options->background_type == 'color') && isset($options->background) && $options->background) $style .= 'background-color:'.$options->background.';';

	if ($options->background_type == 'image' && $background_image_src) {
		if($lazyload){
			if($placeholder){
				$placeholder_bg_image .= 'background-image:url(' . $placeholder.');';
			}
			if(strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false){
				$lazy_bg_image .= 'background-image:url(' . $background_image_src.');';
			} else {
				$lazy_bg_image .= 'background-image:url('. JURI::base(true) . '/' . $background_image_src.');';
			}
		} else {
			if(strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false){
				$style .= 'background-image:url(' . $background_image_src.');';
			} else {
				$style .= 'background-image:url('. JURI::base(true) . '/' . $background_image_src.');';
			}
		}
	
		if (isset($options->background_repeat) && $options->background_repeat) $style .= 'background-repeat:'.$options->background_repeat.';';
		if (isset($options->background_size) && $options->background_size && $options->background_size != 'custom') $style .= 'background-size:'.$options->background_size.';';
		if (isset($options->background_attachment) && $options->background_attachment) $style .= 'background-attachment:'.$options->background_attachment.';';
		if (isset($options->background_position) && $options->background_position && $options->background_position != 'custom') $style .= 'background-position:'.$options->background_position.';';

		if(isset($options->background_size) && $options->background_size == 'custom'){
			if(isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->md)){
				$style .= 'background-size:'.$options->background_size_custom->md . $options->background_size_custom->unit .';';
			} else if( isset($options->background_size_custom) && !is_object($options->background_size_custom)) {
				$style .= 'background-size:'.$options->background_size_custom .$options->background_size_custom->unit .';';
			}
		}
	}

	if(isset($options->background_position) && $options->background_position == 'custom'){
		if((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->md)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->md))){
			$style .= 'background-position:'.$options->background_position_custom_x->md . $options->background_position_custom_x->unit .' '.$options->background_position_custom_y->md . $options->background_position_custom_y->unit .';';
		} else if( isset($options->background_position_custom_x) && !is_object($options->background_position_custom_x) || isset($options->background_position_custom_y) && !is_object($options->background_position_custom_y) ) {
			$style .= 'background-position:'.$options->background_position_custom_x .$options->background_position_custom_x->unit .' '.$options->background_position_custom_y . $options->background_position_custom_y->unit.';';
		}
	}

	if($options->background_type == 'gradient' && isset($options->background_gradient) && is_object($options->background_gradient)) {
		$radialPos = (isset($options->background_gradient->radialPos) && !empty($options->background_gradient->radialPos)) ? $options->background_gradient->radialPos : 'center center';
	
		$gradientColor = (isset($options->background_gradient->color) && !empty($options->background_gradient->color)) ? $options->background_gradient->color : '';
	
		$gradientColor2 = (isset($options->background_gradient->color2) && !empty($options->background_gradient->color2)) ? $options->background_gradient->color2 : '';
	
		$gradientDeg = (isset($options->background_gradient->deg) && !empty($options->background_gradient->deg)) ? $options->background_gradient->deg : '0';
	
		$gradientPos = (isset($options->background_gradient->pos) && !empty($options->background_gradient->pos)) ? $options->background_gradient->pos : '0';
	
		$gradientPos2 = (isset($options->background_gradient->pos2) && !empty($options->background_gradient->pos2)) ? $options->background_gradient->pos2 : '100';
	
		if(isset($options->background_gradient->type) && $options->background_gradient->type == 'radial'){
			$style .= "\tbackground-image: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
		} else {
			$style .= "\tbackground-image: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
		}
	}
} else {
	if (isset($options->background) && $options->background) $style .= 'background-color:'.$options->background.';';

	if ($background_image_src) {

		if($lazyload){
			if($placeholder){
				$placeholder_bg_image .= 'background-image:url(' . $placeholder.');';
			}
			if(strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false){
				$lazy_bg_image .= 'background-image:url(' . $background_image_src.');';
			} else {
				$lazy_bg_image .= 'background-image:url('. JURI::base(true) . '/' . $background_image_src.');';
			}
		} else {
			if(strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false){
				$style .= 'background-image:url(' . $background_image_src.');';
			} else {
				$style .= 'background-image:url('. JURI::base(true) . '/' . $background_image_src.');';
			}
		}
	
		if (isset($options->background_repeat) && $options->background_repeat) $style .= 'background-repeat:'.$options->background_repeat.';';
		if (isset($options->background_size) && $options->background_size && $options->background_size != 'custom') $style .= 'background-size:'.$options->background_size.';';
		if (isset($options->background_attachment) && $options->background_attachment) $style .= 'background-attachment:'.$options->background_attachment.';';
		if (isset($options->background_position) && $options->background_position && $options->background_position != 'custom') $style .= 'background-position:'.$options->background_position.';';

		if(isset($options->background_size) && $options->background_size == 'custom'){
			if(isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->md)){
				$style .= 'background-size:'.$options->background_size_custom->md . $options->background_size_custom->unit .';';
			} else if( isset($options->background_size_custom) && !is_object($options->background_size_custom)) {
				$style .= 'background-size:'.$options->background_size_custom .$options->background_size_custom->unit .';';
			}
		}
	}
	if(isset($options->background_position) && $options->background_position == 'custom'){
		if((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->md)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->md))){
			$style .= 'background-position:'.$options->background_position_custom_x->md . $options->background_position_custom_x->unit .' '.$options->background_position_custom_y->md . $options->background_position_custom_y->unit .';';
		} else if( isset($options->background_position_custom_x) && !is_object($options->background_position_custom_x) || isset($options->background_position_custom_y) && !is_object($options->background_position_custom_y) ) {
			$style .= 'background-position:'.$options->background_position_custom_x .$options->background_position_custom_x->unit .' '.$options->background_position_custom_y . $options->background_position_custom_y->unit.';';
		}
	}
}

if(isset($options->background_type)){
	if(isset($options->background_position) && $options->background_position == 'custom'){
		if((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->sm)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->sm))){
			$style_sm .= 'background-position:'.$options->background_position_custom_x->sm . $options->background_position_custom_x->unit .' '.$options->background_position_custom_y->sm . $options->background_position_custom_y->unit .';';
		}
		if((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->xs)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->xs))){
			$style_xs .= 'background-position:'.$options->background_position_custom_x->xs . $options->background_position_custom_x->unit .' '.$options->background_position_custom_y->xs . $options->background_position_custom_y->unit .';';
		}
	}
}

if(isset($options->background_size) && $options->background_size == 'custom'){
	if(isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->sm)){
		$style_sm .= 'background-size:'.$options->background_size_custom->sm . $options->background_size_custom->unit .';';
	}
	if(isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->xs)){
		$style_xs .= 'background-size:'.$options->background_size_custom->xs . $options->background_size_custom->unit .';';
	}
}

if($style) {
	$column_styles .= '#column-id-' . $options->dynamicId . '{'. $style .'}';
	$column_styles .= '#column-id-' . $options->dynamicId . '{'. $placeholder_bg_image .'}';
	$column_styles .= '#column-id-' . $options->dynamicId . '.sppb-element-loaded {'. $lazy_bg_image .'}';
}
if($style_sm) {
	$column_styles .= '@media (min-width: 768px) and (max-width: 991px) { #column-id-' . $options->dynamicId . '{'. $style_sm .'} }';
}
if($style_xs) {
	$column_styles .= '@media (max-width: 767px) { #column-id-' . $options->dynamicId . '{'. $style_xs .'} }';
}

if($border_radius_style) {
	$column_styles .= '#column-id-' . $options->dynamicId . '{'. $border_radius_style .'}';
	$column_styles .= '#column-id-' . $options->dynamicId . ' .sppb-column-overlay{'. $border_radius_style .'}';
}
if($border_radius_style_sm) {
	$column_styles .= '#column-id-' . $options->dynamicId . '{'. $border_radius_style_sm .'}';
	$column_styles .= '@media (min-width: 768px) and (max-width: 991px) { #column-id-' . $options->dynamicId . ' .sppb-column-overlay{'. $border_radius_style_sm .'} }';
}
if($border_radius_style_xs) {
	$column_styles .= '#column-id-' . $options->dynamicId . '{'. $border_radius_style_xs .'}';
	$column_styles .= '@media (max-width: 767px) { #column-id-' . $options->dynamicId . ' .sppb-column-overlay{'. $border_radius_style_xs .'} }';
}

if($style_wrap) {
	$column_styles .= '#column-wrap-id-' . $options->dynamicId . '{'. $style_wrap .'}';
}
if($style_wrap_sm) {
	$column_styles .= '@media (min-width: 768px) and (max-width: 991px) { #column-wrap-id-' . $options->dynamicId . '{'. $style_wrap_sm .'} }';
}
if($style_wrap_xs) {
	$column_styles .= '@media (max-width: 767px) { #column-wrap-id-' . $options->dynamicId . '{'. $style_wrap_xs .'} }';
}

//Overlay
$pattern_overlay = (isset($settings->pattern_overlay) && $settings->pattern_overlay) ? $settings->pattern_overlay : '';
$pattern_overlay_src = isset($pattern_overlay->src) ? $pattern_overlay->src : $pattern_overlay;

if(isset($options->background_type)){
	if ($options->background_type == 'image' && $background_image_src) {
		if(!isset($options->overlay_type)){
			$options->overlay_type = 'overlay_color';
		}
		if(isset($options->overlay) && $options->overlay && $options->overlay_type == 'overlay_color'){
			$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {background-color: '. $options->overlay .'}';
		}
		if(isset($options->gradient_overlay) && $options->gradient_overlay && $options->overlay_type == 'overlay_gradient'){
			$overlay_radialPos = (isset($options->gradient_overlay->radialPos) && !empty($options->gradient_overlay->radialPos)) ? $options->gradient_overlay->radialPos : 'center center';
	
			$overlay_gradientColor = (isset($options->gradient_overlay->color) && !empty($options->gradient_overlay->color)) ? $options->gradient_overlay->color : '';
		
			$overlay_gradientColor2 = (isset($options->gradient_overlay->color2) && !empty($options->gradient_overlay->color2)) ? $options->gradient_overlay->color2 : '';
		
			$overlay_gradientDeg = (isset($options->gradient_overlay->deg) && !empty($options->gradient_overlay->deg)) ? $options->gradient_overlay->deg : '0';
		
			$overlay_gradientPos = (isset($options->gradient_overlay->pos) && !empty($options->gradient_overlay->pos)) ? $options->gradient_overlay->pos : '0';
		
			$overlay_gradientPos2 = (isset($options->gradient_overlay->pos2) && !empty($options->gradient_overlay->pos2)) ? $options->gradient_overlay->pos2 : '100';
		
			if(isset($options->gradient_overlay->type) && $options->gradient_overlay->type == 'radial'){
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background: radial-gradient(at '. $overlay_radialPos .', '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 . '%) transparent;
				}';
				
			} else {
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background: linear-gradient('. $overlay_gradientDeg .'deg, '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 .'%) transparent;
				}';
			}
		}
		if($pattern_overlay_src && $options->overlay_type == 'overlay_pattern'){
			if(strpos($pattern_overlay_src, "http://") !== false || strpos($pattern_overlay_src, "https://") !== false){
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background-image:url(' . $pattern_overlay_src.');
					background-attachment: scroll;
				}';
				if(isset($options->overlay_pattern_color)){
					$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
						background-color:' . $options->overlay_pattern_color.';
					}';
				}
			} else {
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background-image:url('. JURI::base(true) . '/' . $pattern_overlay_src.');
					background-attachment: scroll;
				}';
				if(isset($options->overlay_pattern_color)){
					$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
						background-color:' . $options->overlay_pattern_color.';
					}';
				}
			}
		}
	}
} else {
	if (isset($options->background_image) && $options->background_image) {
		if(!isset($options->overlay_type)){
			$options->overlay_type = 'overlay_color';
		}
		if(isset($options->overlay) && $options->overlay && $options->overlay_type == 'overlay_color'){
			$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {background-color: '. $options->overlay .'}';
		}
		if(isset($options->gradient_overlay) && $options->gradient_overlay && $options->overlay_type == 'overlay_gradient'){
			$overlay_radialPos = (isset($options->gradient_overlay->radialPos) && !empty($options->gradient_overlay->radialPos)) ? $options->gradient_overlay->radialPos : 'center center';
	
			$overlay_gradientColor = (isset($options->gradient_overlay->color) && !empty($options->gradient_overlay->color)) ? $options->gradient_overlay->color : '';
		
			$overlay_gradientColor2 = (isset($options->gradient_overlay->color2) && !empty($options->gradient_overlay->color2)) ? $options->gradient_overlay->color2 : '';
		
			$overlay_gradientDeg = (isset($options->gradient_overlay->deg) && !empty($options->gradient_overlay->deg)) ? $options->gradient_overlay->deg : '0';
		
			$overlay_gradientPos = (isset($options->gradient_overlay->pos) && !empty($options->gradient_overlay->pos)) ? $options->gradient_overlay->pos : '0';
		
			$overlay_gradientPos2 = (isset($options->gradient_overlay->pos2) && !empty($options->gradient_overlay->pos2)) ? $options->gradient_overlay->pos2 : '100';
		
			if(isset($options->gradient_overlay->type) && $options->gradient_overlay->type == 'radial'){
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background: radial-gradient(at '. $overlay_radialPos .', '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 . '%) transparent;
				}';
				
			} else {
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background: linear-gradient('. $overlay_gradientDeg .'deg, '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 .'%) transparent;
				}';
			}
		}
		if($pattern_overlay_src && $options->overlay_type == 'overlay_pattern'){
			if(strpos($pattern_overlay_src, "http://") !== false || strpos($pattern_overlay_src, "https://") !== false){
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background-image:url(' . $pattern_overlay_src.');
					background-attachment: scroll;
				}';
				if(isset($options->overlay_pattern_color)){
					$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
						background-color:' . $options->overlay_pattern_color.';
					}';
				}
			} else {
				$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
					background-image:url('. JURI::base(true) . '/' . $pattern_overlay_src.');
					background-attachment: scroll;
				}';
				if(isset($options->overlay_pattern_color)){
					$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
						background-color:' . $options->overlay_pattern_color.';
					}';
				}
			}
		}
	}
}

//Blend Mode
if(isset($options->background_type) && $options->background_type){
	if ($options->background_type == 'image') {
		if (isset($options->blend_mode) && $options->blend_mode) {
			$column_styles .= '#column-id-' . $options->dynamicId . ' > .sppb-column-overlay {
				mix-blend-mode:' . $options->blend_mode .';
			}';
		}
	}
}


echo $column_styles;
