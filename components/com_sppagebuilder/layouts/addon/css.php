<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

$doc = JFactory::getDocument();
//Image lazy load
$config = JComponentHelper::getParams('com_sppagebuilder');	
$lazyload = $config->get('lazyloadimg', '0');
$placeholder = $config->get('lazyplaceholder', '');
$lazy_bg_image = '';
$placeholder_bg_image = '';

if( !class_exists('SppbCustomCssParser') ){
    require_once JPATH_ROOT . '/components/com_sppagebuilder/helpers/css-parser.php';
}

$selector_css = new JLayoutFile('addon.css.selector', JPATH_ROOT . '/components/com_sppagebuilder/layouts');

$addon = $displayData['addon'];
$settings = $addon->settings;
$inlineCSS = '';
$addon_css = '';
$addon_link_css = '';
$addon_link_hover_css = '';
$addon_id = "#sppb-addon-". $addon->id;
$addon_wrapper_id = "#sppb-addon-wrapper-". $addon->id;
// Color
if(isset($settings->global_text_color) && $settings->global_text_color) {
    $addon_css .= "\tcolor: " . $settings->global_text_color . ";\n";
}

if(isset($settings->global_link_color) && $settings->global_link_color) {
    $addon_link_css .= "\tcolor: " . $settings->global_link_color . ";\n";
}

if(isset($settings->global_link_hover_color) && $settings->global_link_hover_color) {
    $addon_link_hover_css .= "\tcolor: " . $settings->global_link_hover_color . ";\n";
}

// Background
$global_background_image = (isset($settings->global_background_image) && $settings->global_background_image) ? $settings->global_background_image : '';
$global_background_image_src = isset($global_background_image->src) ? $global_background_image->src : $global_background_image;
if(!isset($settings->global_background_type) && isset($settings->global_use_background) && $settings->global_use_background){
    if(isset($settings->global_background_color) && $settings->global_background_color) {
        $addon_css .= "\tbackground-color: " . $settings->global_background_color . ";\n";
    }
    if($global_background_image_src) {

        if($lazyload){
			if($placeholder){
				$placeholder_bg_image .= 'background-image:url(' . $placeholder.');';
			}
			if(strpos($global_background_image_src, "http://") !== false || strpos($global_background_image_src, "https://") !== false){
                $lazy_bg_image .= "\tbackground-image: url(" . $global_background_image_src . ");\n";
              } else {
                $lazy_bg_image .= "\tbackground-image: url(" . JURI::base(true) . '/' . $global_background_image_src . ");\n";
              }
		} else {
            if(strpos($global_background_image_src, "http://") !== false || strpos($global_background_image_src, "https://") !== false){
                $addon_css .= "\tbackground-image: url(" . $global_background_image_src . ");\n";
              } else {
                $addon_css .= "\tbackground-image: url(" . JURI::base(true) . '/' . $global_background_image_src . ");\n";
              }
        }
        

        if(isset($settings->global_background_repeat) && $settings->global_background_repeat) {
            $addon_css .= "\tbackground-repeat: " . $settings->global_background_repeat . ";\n";
        }

        if(isset($settings->global_background_size) && $settings->global_background_size) {
            $addon_css .= "\tbackground-size: " . $settings->global_background_size . ";\n";
        }

        if(isset($settings->global_background_attachment) && $settings->global_background_attachment) {
            $addon_css .= "\tbackground-attachment: " . $settings->global_background_attachment . ";\n";
        }
        if(isset($settings->global_background_position) && $settings->global_background_position) {
            $addon_css .= "background-position:" . $settings->global_background_position . ";";
        }
    }
} else if(isset($settings->global_background_type)) {
        if(($settings->global_background_type == 'color' || $settings->global_background_type == 'image') && isset($settings->global_background_color) && $settings->global_background_color) {
            $addon_css .= "\tbackground-color: " . $settings->global_background_color . ";\n";
        }

        if($settings->global_background_type == 'gradient' && isset($settings->global_background_gradient) && is_object($settings->global_background_gradient)){
            $radialPos = (isset($settings->global_background_gradient->radialPos) && !empty($settings->global_background_gradient->radialPos)) ? $settings->global_background_gradient->radialPos : 'center center';

            $gradientColor = (isset($settings->global_background_gradient->color) && !empty($settings->global_background_gradient->color)) ? $settings->global_background_gradient->color : '';

            $gradientColor2 = (isset($settings->global_background_gradient->color2) && !empty($settings->global_background_gradient->color2)) ? $settings->global_background_gradient->color2 : '';

            $gradientDeg = (isset($settings->global_background_gradient->deg) && !empty($settings->global_background_gradient->deg)) ? $settings->global_background_gradient->deg : '0';

            $gradientPos = (isset($settings->global_background_gradient->pos) && !empty($settings->global_background_gradient->pos)) ? $settings->global_background_gradient->pos : '0';

            $gradientPos2 = (isset($settings->global_background_gradient->pos2) && !empty($settings->global_background_gradient->pos2)) ? $settings->global_background_gradient->pos2 : '100';

            if(isset($settings->global_background_gradient->type) && $settings->global_background_gradient->type == 'radial'){
                $addon_css .= "\tbackground-image: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
            } else {
                $addon_css .= "\tbackground-image: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
            }
        }

        if($settings->global_background_type == 'image' && $global_background_image_src) {
            if($lazyload){
                if($placeholder){
                    $placeholder_bg_image .= 'background-image:url(' . $placeholder.');';
                }
                if(strpos($global_background_image_src, "http://") !== false || strpos($global_background_image_src, "https://") !== false){
                    $lazy_bg_image .= "\tbackground-image: url(" . $global_background_image_src . ");\n";
                  } else {
                    $lazy_bg_image .= "\tbackground-image: url(" . JURI::base(true) . '/' . $global_background_image_src . ");\n";
                  }
            } else {
                if(strpos($global_background_image_src, "http://") !== false || strpos($global_background_image_src, "https://") !== false){
                    $addon_css .= "\tbackground-image: url(" . $global_background_image_src . ");\n";
                  } else {
                    $addon_css .= "\tbackground-image: url(" . JURI::base(true) . '/' . $global_background_image_src . ");\n";
                  }
            }
    
            if(isset($settings->global_background_repeat) && $settings->global_background_repeat) {
                $addon_css .= "\tbackground-repeat: " . $settings->global_background_repeat . ";\n";
            }
    
            if(isset($settings->global_background_size) && $settings->global_background_size) {
                $addon_css .= "\tbackground-size: " . $settings->global_background_size . ";\n";
            }
    
            if(isset($settings->global_background_attachment) && $settings->global_background_attachment) {
                $addon_css .= "\tbackground-attachment: " . $settings->global_background_attachment . ";\n";
            }
            if(isset($settings->global_background_position) && $settings->global_background_position) {
                $addon_css .= "background-position:" . $settings->global_background_position . ";";
            }
        }
}

// Box Shadow
if(isset($settings->global_boxshadow) && $settings->global_boxshadow){
    if(is_object($settings->global_boxshadow)){
        $ho = (isset($settings->global_boxshadow->ho) && $settings->global_boxshadow->ho != '') ? $settings->global_boxshadow->ho.'px' : '0px';
        $vo = (isset($settings->global_boxshadow->vo) && $settings->global_boxshadow->vo != '') ? $settings->global_boxshadow->vo.'px' : '0px';
        $blur = (isset($settings->global_boxshadow->blur) && $settings->global_boxshadow->blur != '') ? $settings->global_boxshadow->blur.'px' : '0px';
        $spread = (isset($settings->global_boxshadow->spread) && $settings->global_boxshadow->spread != '') ? $settings->global_boxshadow->spread.'px' : '0px';
        $color = (isset($settings->global_boxshadow->color) && $settings->global_boxshadow->color != '') ? $settings->global_boxshadow->color : '#fff';

        $addon_css .= "\tbox-shadow: ${ho} ${vo} ${blur} ${spread} ${color};\n";
    } else {
        $addon_css .= "\tbox-shadow: " . $settings->global_boxshadow . ";\n";
    }
}

// Border
if(isset($settings->global_user_border) && $settings->global_user_border) {
    
    if (isset($settings->global_border_width) && is_object($settings->global_border_width) && $settings->global_border_width != '') {
        $addon_css .= isset($settings->global_border_width->md) && $settings->global_border_width->md != '' ? "border-width: " . $settings->global_border_width->md . "px;\n" : "";
    } else {
        $addon_css .= isset($settings->global_border_width) && $settings->global_border_width != '' ? "border-width: " . $settings->global_border_width . "px;\n" : "";
    }

    if(isset($settings->global_border_color) && $settings->global_border_color) {
        $addon_css .= "border-color: " . $settings->global_border_color . ";\n";
    }

    if(isset($settings->global_boder_style) && $settings->global_boder_style) {
        $addon_css .= "border-style: " . $settings->global_boder_style . ";\n";
    }
}

// Border radius

if (isset($settings->global_border_radius)) {
    if (is_object($settings->global_border_radius)) {
        $addon_css .= (isset($settings->global_border_radius->md) && $settings->global_border_radius->md) ? "border-radius: " . $settings->global_border_radius->md . "px;\n" : "";
    } else {
        $addon_css .= ($settings->global_border_radius) ? "border-radius: " . $settings->global_border_radius . "px;\n" : "";
    }
}

if(isset($settings->global_padding)){
    if(is_object( $settings->global_padding ) ) {
        $addon_css .= SppagebuilderHelperSite::getPaddingMargin($settings->global_padding, 'padding');
    } else if(!empty(trim($settings->global_padding))) {
        $addon_css .= 'padding:' . $settings->global_padding . ';';
    }
}

if(isset($settings->global_use_overlay) && $settings->global_use_overlay){
    $addon_css .= "position: relative;\noverflow: hidden;\n";
}

//Custom position

$position_css = '';
if(isset($settings->global_custom_position) && $settings->global_custom_position && isset($settings->global_seclect_position) && $settings->global_seclect_position && $settings->global_seclect_position != ''){
    
    if($settings->global_seclect_position){
        $position_css .= 'position:'.$settings->global_seclect_position.';';
    }
    if(isset($settings->global_addon_position_left) && is_object($settings->global_addon_position_left) && isset($settings->global_addon_position_left->md) ){
        $position_css .= 'left:'.$settings->global_addon_position_left->md.';';
    } else if( isset($settings->global_addon_position_left) && !is_object($settings->global_addon_position_left) ) {
        $position_css .= 'left:'.$settings->global_addon_position_left.';';
    }
    if(isset($settings->global_addon_position_top) && is_object($settings->global_addon_position_top) && isset($settings->global_addon_position_top->md) ){
        $position_css .= 'top:'.$settings->global_addon_position_top->md.';';
    } else if( isset($settings->global_addon_position_top) && !is_object($settings->global_addon_position_top) ) {
        $position_css .= 'top:'.$settings->global_addon_position_top.';';
    }
    if(isset($settings->global_addon_z_index) && $settings->global_addon_z_index != '') {
        $position_css .= 'z-index:'.$settings->global_addon_z_index.';';
    }
}
if(isset($settings->global_margin)){
    if( is_object( $settings->global_margin ) ) {
        $position_css .= SppagebuilderHelperSite::getPaddingMargin($settings->global_margin, 'margin');
    } else if(!empty(trim($settings->global_margin))) {
        $position_css .= 'margin:' . $settings->global_margin . ';';
    }
}

if(isset($settings->use_global_width) && $settings->use_global_width && isset($settings->global_width) && $settings->global_width){
    $position_css .= "width: " . (int) $settings->global_width . "%;\n";
}

if($position_css) {
    $inlineCSS .= '#sppb-addon-wrapper-'.$addon->id ." {\n" . $position_css . "}\n";
}

if($addon_css) {
    $inlineCSS .= $addon_id ." {\n" . $addon_css . "}\n";
    $inlineCSS .= $addon_id ." {\n" . $placeholder_bg_image . "}\n";
    $inlineCSS .= $addon_id .".sppb-element-loaded {\n" . $lazy_bg_image . "}\n";
}
if(!isset($settings->global_overlay_type)){
    $settings->global_overlay_type = 'overlay_color';
}
if(isset($settings->global_use_overlay) && $settings->global_use_overlay && isset($settings->global_background_overlay) && $settings->global_background_overlay && $settings->global_overlay_type == 'overlay_color'){
    $inlineCSS .= $addon_id ." .sppb-addon-overlayer { background-color: {$settings->global_background_overlay}; }\n";
}
if(isset($settings->global_use_overlay) && $settings->global_use_overlay){
    $inlineCSS .= $addon_id ." > .sppb-addon { position: relative; }\n";
}
// Overlay
$global_pattern_overlay = (isset($settings->global_pattern_overlay) && $settings->global_pattern_overlay) ? $settings->global_pattern_overlay : '';
$global_pattern_overlay_src = isset($global_pattern_overlay->src) ? $global_pattern_overlay->src : $global_pattern_overlay;
if(isset($settings->global_background_type)){
	if ($settings->global_background_type == 'image') {
		if(isset($settings->global_gradient_overlay) && $settings->global_overlay_type == 'overlay_gradient'){
			$overlay_radialPos = (isset($settings->global_gradient_overlay->radialPos) && !empty($settings->global_gradient_overlay->radialPos)) ? $settings->global_gradient_overlay->radialPos : 'center center';
	
			$overlay_gradientColor = (isset($settings->global_gradient_overlay->color) && !empty($settings->global_gradient_overlay->color)) ? $settings->global_gradient_overlay->color : '';
		
			$overlay_gradientColor2 = (isset($settings->global_gradient_overlay->color2) && !empty($settings->global_gradient_overlay->color2)) ? $settings->global_gradient_overlay->color2 : '';
		
			$overlay_gradientDeg = (isset($settings->global_gradient_overlay->deg) && !empty($settings->global_gradient_overlay->deg)) ? $settings->global_gradient_overlay->deg : '0';
		
			$overlay_gradientPos = (isset($settings->global_gradient_overlay->pos) && !empty($settings->global_gradient_overlay->pos)) ? $settings->global_gradient_overlay->pos : '0';
		
			$overlay_gradientPos2 = (isset($settings->global_gradient_overlay->pos2) && !empty($settings->global_gradient_overlay->pos2)) ? $settings->global_gradient_overlay->pos2 : '100';
		
			if(isset($settings->global_gradient_overlay->type) && $settings->global_gradient_overlay->type == 'radial'){
				$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
					background: radial-gradient(at '. $overlay_radialPos .', '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 . '%) transparent;
				}';
				
			} else {
				$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
					background: linear-gradient('. $overlay_gradientDeg .'deg, '. $overlay_gradientColor .' '. $overlay_gradientPos .'%, '. $overlay_gradientColor2 .' '. $overlay_gradientPos2 .'%) transparent;
				}';
			}
		}
		if($global_pattern_overlay_src && $settings->global_overlay_type == 'overlay_pattern'){
			if(strpos($global_pattern_overlay_src, "http://") !== false || strpos($global_pattern_overlay_src, "https://") !== false){
				$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
					background-image:url(' . $global_pattern_overlay_src .');
					background-attachment: scroll;
				}';
				if(isset($settings->global_overlay_pattern_color)){
					$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
						background-color:' . $settings->global_overlay_pattern_color.';
					}';
				}
			} else {
				$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
					background-image:url('. JURI::base() . '/' . $global_pattern_overlay_src .');
					background-attachment: scroll;
				}';
				if(isset($settings->global_overlay_pattern_color)){
					$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
						background-color:' . $settings->global_overlay_pattern_color .';
					}';
				}
			}
		}
	}
}

//Blend Mode
if(isset($settings->global_background_type) && $settings->global_background_type){
	if ($settings->global_background_type == 'image') {
		if (isset($settings->blend_mode) && $settings->blend_mode) {
			$inlineCSS .= $addon_id .' .sppb-addon-overlayer {
				mix-blend-mode:' . $settings->blend_mode .';
			}';
		}
	}
}

if($addon_link_css) {
    $inlineCSS .= $addon_id ." a {\n" . $addon_link_css . "}\n";
}

if($addon_link_hover_css) {
    $inlineCSS .= $addon_id ." a:hover,\n#sppb-addon-". $addon->id ." a:focus,\n#sppb-addon-". $addon->id ." a:active {\n" . $addon_link_hover_css . "}\n";
}

//Addon Title
if(isset($settings->title) && $settings->title) {

    $title_style = '';

    if (isset($settings->title_margin_top) && is_object($settings->title_margin_top)) {
      $title_style .= (isset($settings->title_margin_top->md) && $settings->title_margin_top->md != '') ? 'margin-top:' . (int) $settings->title_margin_top->md . 'px;' : '';
    } else {
      $title_style .= (isset($settings->title_margin_top) && $settings->title_margin_top != '') ? 'margin-top:' . (int) $settings->title_margin_top . 'px;' : '';
    }

    if(isset($settings->title_margin_bottom) && is_object($settings->title_margin_bottom)) {
      $title_style .= (isset($settings->title_margin_bottom->md) && $settings->title_margin_bottom->md != '') ? 'margin-bottom:' . (int) $settings->title_margin_bottom->md . 'px;' : '';
    } else {
      $title_style .= (isset($settings->title_margin_bottom) && $settings->title_margin_bottom != '') ? 'margin-bottom:' . (int) $settings->title_margin_bottom . 'px;' : '';
    }

    $title_style .= (isset($settings->title_text_color) && $settings->title_text_color) ? 'color:' . $settings->title_text_color . ';' : '';

    if (isset($settings->title_fontsize) && is_object($settings->title_fontsize)) {
      $title_style .= (isset($settings->title_fontsize->md) && $settings->title_fontsize->md) ? 'font-size:' . $settings->title_fontsize->md . 'px;' : '';
    } else {
      $title_style .= (isset($settings->title_fontsize) && $settings->title_fontsize) ? 'font-size:' . $settings->title_fontsize . 'px;' : '';
    }

    if (isset($settings->title_lineheight) && is_object($settings->title_lineheight)) {
      $title_style .= (isset($settings->title_lineheight->md) && $settings->title_lineheight->md) ? 'line-height:' . $settings->title_lineheight->md . 'px;' : '';
    } else {
      $title_style .= (isset($settings->title_lineheight) && $settings->title_lineheight) ? 'line-height:' . $settings->title_lineheight . 'px;' : '';
    }

    $title_letterspace = (isset($settings->title_letterspace) && $settings->title_letterspace) ? $settings->title_letterspace : '';
    $custom_letterspacing = (isset($settings->custom_letterspacing) && $settings->custom_letterspacing) ? $settings->custom_letterspacing : '';

    if($title_letterspace != 'custom' && (!empty($title_letterspace))){
        $title_style .= 'letter-spacing:' . $title_letterspace . ';';
    } else if (!empty($custom_letterspacing)) {
        $title_style .= 'letter-spacing:' . $custom_letterspacing . ';';
    }

    // Font Style
    $modern_font_style = false;
    if(isset($settings->title_font_style->underline) && $settings->title_font_style->underline) {
        $title_style .= 'text-decoration: underline;';
        $modern_font_style = true;
    }

    if(isset($settings->title_font_style->italic) && $settings->title_font_style->italic) {
        $title_style .= 'font-style: italic;';
        $modern_font_style = true;
    }

    if(isset($settings->title_font_style->uppercase) && $settings->title_font_style->uppercase) {
        $title_style .= 'text-transform: uppercase;';
        $modern_font_style = true;
    }

    if(isset($settings->title_font_style->weight) && $settings->title_font_style->weight) {
        $title_style .= 'font-weight: ' . $settings->title_font_style->weight . ';';
        $modern_font_style = true;
    }

    // legcy font style
    if(!$modern_font_style) {
      $title_fontstyle = (isset($settings->title_fontstyle) && $settings->title_fontstyle) ? $settings->title_fontstyle : '';
      if(is_array($title_fontstyle) && count($title_fontstyle)) {

        if(in_array('underline', $title_fontstyle)) {
          $title_style .= 'text-decoration: underline;';
        }

        if(in_array('uppercase', $title_fontstyle)) {
          $title_style .= 'text-transform: uppercase;';
        }

        if(in_array('italic', $title_fontstyle)) {
          $title_style .= 'font-style: italic;';
        }

        if(in_array('lighter', $title_fontstyle)) {
          $title_style .= 'font-weight: lighter;';
        } else if(in_array('normal', $title_fontstyle)) {
          $title_style .= 'font-weight: normal;';
        } else if(in_array('bold', $title_fontstyle)) {
          $title_style .= 'font-weight: bold;';
        } else if(in_array('bolder', $title_fontstyle)) {
          $title_style .= 'font-weight: bolder;';
        }

        $title_style .= (isset($settings->title_fontweight) && $settings->title_fontweight) ? 'font-weight:' . $settings->title_fontweight . ';' : '';

      }
    }

    if($title_style) {
        $inlineCSS .= $addon_id ." .sppb-addon-title {\n" . $title_style . "}\n";
    }
}

// Responsive Tablet
$inlineCSS .= "@media (min-width: 768px) and (max-width: 991px) {";
    $inlineCSS .= $addon_id." {";

        $inlineCSS .= (isset($settings->global_padding_sm) && $settings->global_padding_sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->global_padding_sm, 'padding') : '';


        $inlineCSS .= (isset($settings->global_border_radius_sm) && $settings->global_border_radius_sm) ? "border-radius: " . $settings->global_border_radius_sm . "px;\n" : "";

        if(isset($settings->global_user_border) && $settings->global_user_border) {
            $inlineCSS .= isset($settings->global_border_width_sm) && $settings->global_border_width_sm != '' ? "border-width: " . $settings->global_border_width_sm . "px;\n" : "";
        }

    $inlineCSS .= "}";
    if(isset($settings->title) && $settings->title) {
        $title_style_sm = (isset($settings->title_fontsize_sm) && $settings->title_fontsize_sm) ? 'font-size:' . $settings->title_fontsize_sm . 'px;line-height:' . $settings->title_fontsize_sm . 'px;' : '';
        $title_style_sm .= (isset($settings->title_lineheight_sm) && $settings->title_lineheight_sm) ? 'line-height:' . $settings->title_lineheight_sm . 'px;' : '';
        $title_style_sm  .= (isset($settings->title_margin_top_sm) && $settings->title_margin_top_sm != '') ? 'margin-top:' . (int) $settings->title_margin_top_sm . 'px;' : '';
        $title_style_sm .= (isset($settings->title_margin_bottom_sm) && $settings->title_margin_bottom_sm != '') ? 'margin-bottom:' . (int) $settings->title_margin_bottom_sm . 'px;' : '';

        if($title_style_sm) {
            $inlineCSS .= $addon_id ." .sppb-addon-title {\n" . $title_style_sm . "}\n";
        }
    }

    //Custom position tablet
    $position_style_sm = '';
    if(isset($settings->global_custom_position) && $settings->global_custom_position){
        if(isset($settings->global_addon_position_left_sm) && is_object($settings->global_addon_position_left_sm) && isset($settings->global_addon_position_left_sm->sm) ){
            $position_style_sm .= 'left:'.$settings->global_addon_position_left_sm->sm.';';
        } else if( isset($settings->global_addon_position_left_sm) && !is_object($settings->global_addon_position_left_sm) ) {
            $position_style_sm .= 'left:'.$settings->global_addon_position_left_sm.';';
        }
        if(isset($settings->global_addon_position_top_sm) && is_object($settings->global_addon_position_top_sm) && isset($settings->global_addon_position_top_sm->sm) ){
            $position_style_sm .= 'top:'.$settings->global_addon_position_top_sm->sm.';';
        } else if( isset($settings->global_addon_position_top_sm) && !is_object($settings->global_addon_position_top_sm) ) {
            $position_style_sm .= 'top:'.$settings->global_addon_position_top_sm.';';
        }
    }
    if(isset($settings->use_global_width) && $settings->use_global_width && isset($settings->global_width_sm) && $settings->global_width_sm){
        $position_style_sm .= "width: " . $settings->global_width_sm . "%;\n";
    }
    $position_style_sm .= (isset($settings->global_margin_sm) && $settings->global_margin_sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->global_margin_sm, 'margin') : '';
    
    if($position_style_sm){
        $inlineCSS .= '#sppb-addon-wrapper-'.$addon->id. ' {'.$position_style_sm.'}';
    }

$inlineCSS .= "}";

// Responsive Phone
$inlineCSS .= "@media (max-width: 767px) {";
    $inlineCSS .= $addon_id." {";

      $inlineCSS .= (isset($settings->global_padding_xs) && $settings->global_padding_xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->global_padding_xs, 'padding') : '';


      $inlineCSS .= (isset($settings->global_border_radius_xs) && $settings->global_border_radius_xs) ? "border-radius: " . $settings->global_border_radius_xs . "px;\n" : "";

      if(isset($settings->global_user_border) && $settings->global_user_border) {
          $inlineCSS .= isset($settings->global_border_width_xs) && $settings->global_border_width_xs != '' ? "border-width: " . $settings->global_border_width_xs . "px;\n" : "";
      }

    $inlineCSS .= "}";
    if(isset($settings->title) && $settings->title) {
        $title_style_xs = (isset($settings->title_fontsize_xs) && $settings->title_fontsize_xs) ? 'font-size:' . $settings->title_fontsize_xs . 'px;line-height:' . $settings->title_fontsize_xs . 'px;' : '';
        $title_style_xs .= (isset($settings->title_lineheight_xs) && $settings->title_lineheight_xs) ? 'line-height:' . $settings->title_lineheight_xs . 'px;' : '';
        $title_style_xs  .= (isset($settings->title_margin_top_xs) && $settings->title_margin_top_xs != '') ? 'margin-top:' . (int) $settings->title_margin_top_xs . 'px;' : '';
        $title_style_xs .= (isset($settings->title_margin_bottom_xs) && $settings->title_margin_bottom_xs != '') ? 'margin-bottom:' . (int) $settings->title_margin_bottom_xs . 'px;' : '';

        if($title_style_xs) {
            $inlineCSS .= $addon_id ." .sppb-addon-title {\n" . $title_style_xs . "}\n";
        }
    }
    //Custom position mobile
    $position_style_xs = '';
    if(isset($settings->global_custom_position) && $settings->global_custom_position){
        
        if(isset($settings->global_addon_position_left_xs) && is_object($settings->global_addon_position_left_xs) && isset($settings->global_addon_position_left_xs->xs) ){
            $position_style_xs .= 'left:'.$settings->global_addon_position_left_xs->xs.';';
        } else if( isset($settings->global_addon_position_left_xs) && !is_object($settings->global_addon_position_left_xs) ) {
            $position_style_xs .= 'left:'.$settings->global_addon_position_left_xs.';';
        }
        if(isset($settings->global_addon_position_top_xs) && is_object($settings->global_addon_position_top_xs) && isset($settings->global_addon_position_top_xs->xs) ){
            $position_style_xs .= 'top:'.$settings->global_addon_position_top_xs->xs.';';
        } else if( isset($settings->global_addon_position_top_xs) && !is_object($settings->global_addon_position_top_xs) ) {
            $position_style_xs .= 'top:'.$settings->global_addon_position_top_xs.';';
        }
    }
    if(isset($settings->use_global_width) && $settings->use_global_width && isset($settings->global_width_xs) && $settings->global_width_xs){
        $position_style_xs .= "width: " . $settings->global_width_xs . "%;\n";
    }
    $position_style_xs .= (isset($settings->global_margin_xs) && $settings->global_margin_xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->global_margin_xs, 'margin') : '';
    
    if($position_style_xs){
        $inlineCSS .= '#sppb-addon-wrapper-'.$addon->id. ' {'.$position_style_xs.'}';
    }

$inlineCSS .= "}";


// Selector
$inlineCSS .= $selector_css->render(
  array(
    'options'=>$settings,
    'addon_id'=>$addon_id
  )
);

if( class_exists('SppbCustomCssParser') && isset($settings->global_custom_css) && !empty($settings->global_custom_css)){
    $inlineCSS .= SppbCustomCssParser::getCss($settings->global_custom_css, $addon_id, $addon_wrapper_id);
}

echo $inlineCSS;
