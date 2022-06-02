<?php
/**
 * @package SP Page Builder
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonImage_overlay extends SppagebuilderAddons{

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$title_icon = (isset($settings->title_icon) && $settings->title_icon) ? $settings->title_icon : '';

		$title_icon_arr = array_filter(explode(' ', $title_icon));
		if (count($title_icon_arr) === 1) {
			$title_icon = 'fa ' . $title_icon;
		}
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h4';
		$title_link = (isset($settings->title_link) && $settings->title_link) ? $settings->title_link : '';
		$title_link_new_window = (isset($settings->title_link_new_window) && $settings->title_link_new_window) ? $settings->title_link_new_window : 0;
		
		//Subtitle Options
		$sub_title = (isset($settings->sub_title) && $settings->sub_title) ? $settings->sub_title : '';
		$subtitle_heading_selector = (isset($settings->subtitle_heading_selector) && $settings->subtitle_heading_selector) ? $settings->subtitle_heading_selector : 'div';
		$sub_title_icon = (isset($settings->sub_title_icon) && $settings->sub_title_icon) ? $settings->sub_title_icon : '';
		$subt_icon_arr = array_filter(explode(' ', $sub_title_icon));
		if (count($subt_icon_arr) === 1) {
			$sub_title_icon = 'fa ' . $sub_title_icon;
		}

		//Title subtitle position
		$title_subtitle_position = (isset($settings->title_subtitle_position) && $settings->title_subtitle_position) ? $settings->title_subtitle_position : 'top-left';
		$show_content_on_hover = (isset($settings->show_content_on_hover) && $settings->show_content_on_hover) ? $settings->show_content_on_hover : '';

		//Background Image Options
		$image = (isset($settings->image) && $settings->image) ? $settings->image : '';
		$image_src = isset($image->src) ? $image->src : $image;

		$background_image_animation = (isset($settings->background_image_animation) && $settings->background_image_animation) ? $settings->background_image_animation : '';
		$image_link = '';
		if(strpos($image_src, "http://") !== false || strpos($image_src, "https://") !== false){
			$image_link = $image_src;
		} else {
			$image_link = JURI::base() . $image_src;
		}

		$image_in_lightbox = (isset($settings->image_in_lightbox) && $settings->image_in_lightbox) ? $settings->image_in_lightbox : 0;

		//Overlay options
		$overlay_mode = (isset($settings->overlay_mode) && $settings->overlay_mode) ? $settings->overlay_mode : '';
		$overlay_type = (isset($settings->overlay_type) && $settings->overlay_type) ? $settings->overlay_type : '';

		//Button options
		$btn_class = '';
		$btn_class .= (isset($settings->type) && $settings->type) ? ' sppb-btn-' . $settings->type : '';
        $btn_class .= (isset($settings->size) && $settings->size) ? ' sppb-btn-' . $settings->size : '';
        $btn_class .= (isset($settings->block) && $settings->block) ? ' ' . $settings->block : '';
        $btn_class .= (isset($settings->shape) && $settings->shape) ? ' sppb-btn-' . $settings->shape : ' sppb-btn-rounded';
        $btn_class .= (isset($settings->appearance) && $settings->appearance) ? ' sppb-btn-' . $settings->appearance : '';
        $attribs = (isset($settings->target) && $settings->target) ? ' rel="noopener noreferrer" target="' . $settings->target . '"' : '';
        $attribs .= (isset($settings->url) && $settings->url) ? ' href="' . $settings->url . '"' : '';
        $attribs .= ' id="btn-' . $this->addon->id . '"';
        $text = (isset($settings->text) && $settings->text) ? $settings->text : '';
        $icon = (isset($settings->icon) && $settings->icon) ? $settings->icon : '';
        $icon_position = (isset($settings->icon_position) && $settings->icon_position) ? $settings->icon_position : 'left';

		$icon_arr = array_filter(explode(' ', $icon));
		if (count($icon_arr) === 1) {
			$icon = 'fa ' . $icon;
		}

        if ($icon_position == 'left') {
            $text = ($icon) ? '<i class="' . $icon . '" aria-hidden="true"></i> ' . $text : $text;
        } else {
            $text = ($icon) ? $text . ' <i class="' . $icon . '" aria-hidden="true"></i>' : $text;
        }

		$output = '';

		$output  .= '<div class="sppb-addon sppb-addon-overlay-image ' . $class . ' image-effect-'.$background_image_animation.' '.($show_content_on_hover ? 'overlay-show-content-on-hover' : '').'">';
		$output  .= '<div class="sppb-addon-overlay-image-content title-subtitle-'.$title_subtitle_position.'">';
		if(($title || $sub_title) && $title_subtitle_position){
			$output .= '<div class="overlay-image-title">';
				$output .= '<'.$heading_selector.' class="sppb-addon-title">';
					if($title_link){
						$output .= '<a href="'.$title_link.'"';
						if($title_link_new_window){
							$output .='target="_blank"';
						}
						$output .='>';
					}
					if($title_icon){
						$output .= '<i class="' . $title_icon . '" aria-hidden="true"></i>';
					}
					$output .= $title;
					if($title_link){
						$output .= '</a>';
					}
				$output .= '</'.$heading_selector.'>';
				if($sub_title){
					$output .= '<'.$subtitle_heading_selector.' class="sppb-addon-subtitle">';
						if($sub_title_icon){
							$output .= '<i class="' . $sub_title_icon . '" aria-hidden="true"></i>';
						}
						$output .= $sub_title;
					$output .= '</'.$subtitle_heading_selector.'>';
				}
			if($text){
				$output .= '<div class="overlay-image-button-wrap">';
				$output .= '<a' . $attribs . ' class="sppb-btn ' . $btn_class . '">' . $text . '</a>';
				$output .= '</div>';
			}
			$output .= '</div>';
		}
		$output  .= '<div class="overlay-background-image-wrapper">';
		$output  .= '<div class="overlay-background-image" style="background-image:url('.$image_link.');"></div>';
		if($image_in_lightbox && $title_subtitle_position !== 'center-center' && $image_link){
			$output .= '<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="' . $image_link . '">+</a>';
		}
		$output  .= '</div>';
		if($overlay_type!='none' || $overlay_mode == 'hover'){
			$output  .= '<div class="overlay-background-style"></div>';
		}
		$output  .= '</div>';
		$output  .= '</div>';

		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		$css = '';
		//Get global style to make border-radius work.
		$global_border_radius = (isset($settings->global_border_radius) && $settings->global_border_radius) ? $settings->global_border_radius : '';
		if($global_border_radius){
			$css .= $addon_id.' {';
			$css .= 'overflow:hidden;';
			$css .= '}';
		}

		//Title Style
		$title_color = (isset($settings->title_text_color) && $settings->title_text_color) ? $settings->title_text_color : '';
		$title_margin = (isset($settings->title_margin) && trim($settings->title_margin)) ? $settings->title_margin : '';
		//Subtitle Style
		$subtitle_style = '';
		$subtitle_style .= (isset($settings->sub_title_fontsize) && $settings->sub_title_fontsize) ? 'font-size:'.$settings->sub_title_fontsize.'px;' : '';
		$subtitle_style .= (isset($settings->sub_title_text_color) && $settings->sub_title_text_color) ? 'color:'.$settings->sub_title_text_color.';' : '';
		$subtitle_style .= (isset($settings->sub_title_letterspace) && $settings->sub_title_letterspace) ? 'letter-spacing:'.$settings->sub_title_letterspace.';' : '';
		$subtitle_style .= (isset($settings->sub_title_margin) && trim($settings->sub_title_margin)) ? 'margin:'.$settings->sub_title_margin.';' : '';

		$sub_title_font_style = (isset($settings->sub_title_font_style) && $settings->sub_title_font_style) ? $settings->sub_title_font_style : '';
		if(isset($sub_title_font_style->underline) && $sub_title_font_style->underline){
			$subtitle_style .= 'text-decoration:underline;';
		}
		if(isset($sub_title_font_style->italic) && $sub_title_font_style->italic){
			$subtitle_style .= 'font-style:italic;';
		}
		if(isset($sub_title_font_style->uppercase) && $sub_title_font_style->uppercase){
			$subtitle_style .= 'text-transform:uppercase;';
		}
		if(isset($sub_title_font_style->weight) && $sub_title_font_style->weight){
			$subtitle_style .= 'font-weight:'.$sub_title_font_style->weight.';';
		}

		//Image 
		$image_height = (isset($settings->image_height) && $settings->image_height) ? $settings->image_height : 300;
		$lightbox_icon_bg = (isset($settings->lightbox_icon_bg) && $settings->lightbox_icon_bg) ? $settings->lightbox_icon_bg : '';
		//Overlay options
		$overlay_type = (isset($settings->overlay_type) && $settings->overlay_type) ? $settings->overlay_type : '';
		$overlay_color = (isset($settings->overlay_color) && $settings->overlay_color) ? $settings->overlay_color : '';
		$overlay_gradient = (isset($settings->overlay_gradient) && $settings->overlay_gradient) ? $settings->overlay_gradient : '';
		
		if(!empty($title_color) || !empty($title_margin)){
			$css .= $addon_id.' .sppb-addon-title a{';
				$css .= 'color:'.$title_color.';';
			$css .= '}';
			$css .= $addon_id.' .sppb-addon-title {';
				$css .= 'margin:'.$title_margin.';';
			$css .= '}';
		}
		if($subtitle_style){
			$css .= $addon_id.' .sppb-addon-subtitle {';
				$css .= $subtitle_style;
			$css .= '}';
		}
		if($image_height){
			$css .= $addon_id . ' .sppb-addon-overlay-image-content {';
				$css .= 'height: '.$image_height.'px;';
			$css .= '}';
		}
		if($lightbox_icon_bg){
			$css .= $addon_id.' .sppb-addon-image-overlay-icon {';
				$css .= 'background: '.$lightbox_icon_bg.';';
			$css .= '}';
		}
		if($overlay_type !== 'none'){
			if($overlay_type == 'color'){
				$css .= $addon_id . ' .overlay-background-style {';
					$css .= 'background: '.$overlay_color.';';
				$css .= '}';
			} elseif($overlay_type=='gradient'){
				$gradient_color1 = (isset($overlay_gradient->color) && $overlay_gradient->color) ? $overlay_gradient->color : 'rgba(127, 0, 255, 0.8)';
				$gradient_color2 = (isset($overlay_gradient->color2) && $overlay_gradient->color2) ? $overlay_gradient->color2 : 'rgba(225, 0, 255, 0.7)';
				$degree = $overlay_gradient->deg;
				$type = $overlay_gradient->type;
				$radialPos = (isset($overlay_gradient->radialPos) && $overlay_gradient->radialPos) ? $overlay_gradient->radialPos : 'Center Center';
				$radial_angle1 = (isset($overlay_gradient->pos) && $overlay_gradient->pos) ? $overlay_gradient->pos : '0';
				$radial_angle2 = (isset($overlay_gradient->pos2) && $overlay_gradient->pos2) ? $overlay_gradient->pos2 : '100';
				$css .= $addon_id . ' .overlay-background-style {';
					if($type!=='radial'){
						$css .= 'background: -webkit-linear-gradient('.$degree.'deg, '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
						$css .= 'background: linear-gradient('.$degree.'deg, '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
					} else {
						$css .= 'background: -webkit-radial-gradient(at '.$radialPos.', '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
						$css .= 'background: radial-gradient(at '.$radialPos.', '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
					}
				$css .= '}';
			}
		} else {
			$css .= $addon_id . ' .overlay-background-style {';
				$css .= 'background: transparent;';
			$css .= '}';
		}

		//Overlay Hover
		$overlay_hover_type = (isset($settings->overlay_hover_type) && $settings->overlay_hover_type) ? $settings->overlay_hover_type : '';
		$overlay_hover_color = (isset($settings->overlay_hover_color) && $settings->overlay_hover_color) ? $settings->overlay_hover_color : '';
		$overlay_hover_gradient = (isset($settings->overlay_hover_gradient) && $settings->overlay_hover_gradient) ? $settings->overlay_hover_gradient : '';
		if($overlay_hover_type!=='none'){
			if($overlay_hover_type=='color'){
				$css .= $addon_id . ' .sppb-addon-overlay-image-content:hover .overlay-background-style {';
					$css .= 'background: '.$overlay_hover_color.';';
				$css .= '}';
			} elseif($overlay_hover_type=='gradient') {
				$gradient_hover_color1 = (isset($overlay_hover_gradient->color) && $overlay_hover_gradient->color) ? $overlay_hover_gradient->color : 'rgba(127, 0, 255, 0.8)';
				$gradient_hover_color2 = (isset($overlay_hover_gradient->color2) && $overlay_hover_gradient->color2) ? $overlay_hover_gradient->color2 : 'rgba(225, 0, 255, 0.7)';
				$hover_degree = (isset($overlay_hover_gradient->deg) && $overlay_hover_gradient->deg) ? $overlay_hover_gradient->deg : '';
				$hover_type = (isset($overlay_hover_gradient->type) && $overlay_hover_gradient->type) ? $overlay_hover_gradient->type : 'linear';
				$hover_radialPos = (isset($overlay_hover_gradient->radialPos) && $overlay_hover_gradient->radialPos) ? $overlay_hover_gradient->radialPos : 'Center Center';
				$hover_radial_angle1 = (isset($overlay_hover_gradient->pos) && $overlay_hover_gradient->pos) ? $overlay_hover_gradient->pos : '0';
				$hove_radial_angle2 = (isset($overlay_hover_gradient->pos2) && $overlay_hover_gradient->pos2) ? $overlay_hover_gradient->pos2 : '100';
				$css .= $addon_id . ' .sppb-addon-overlay-image-content:hover .overlay-background-style {';
					$css .= 'opacity:.8;';
				$css .= '}';
				$css .= $addon_id . ' .overlay-background-style::after {';
					if($hover_type!=='radial'){
						$css .= 'background: -webkit-linear-gradient('.$hover_degree.'deg, '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hove_radial_angle2.'%) transparent;';
						$css .= 'background: linear-gradient('.$hover_degree.'deg, '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hove_radial_angle2.'%) transparent;';
					} else {
						$css .= 'background: -webkit-radial-gradient(at '.$hover_radialPos.', '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hove_radial_angle2.'%) transparent;';
						$css .= 'background: radial-gradient(at '.$hover_radialPos.', '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hove_radial_angle2.'%) transparent;';
					}
				$css .= '}';
				$css .= $addon_id . ' .sppb-addon-overlay-image-content:hover .overlay-background-style::after {';
					$css .= 'opacity:1;';
				$css .= '}';
			}
		} else {
			$css .= $addon_id . ' .sppb-addon-overlay-image-content:hover .overlay-background-style {';
				$css .= 'background: transparent;';
			$css .= '}';
		}
		//Button Margin
		$button_margin = (isset($settings->button_margin) && trim($settings->button_margin)) ? $settings->button_margin : '';
        $button_margin_sm = ((isset($settings->button_margin_sm)) && trim($settings->button_margin_sm)) ? $settings->button_margin_sm : '';
		$button_margin_xs = ((isset($settings->button_margin_xs)) && trim($settings->button_margin_xs)) ? $settings->button_margin_xs : '';
		
		if ($button_margin) {
            $css .= $addon_id . ' .overlay-image-button-wrap {';
            $css .= 'margin: ' . $button_margin . ';';
            $css .= '}';
		}
		//Content Padding
		$content_padding = (isset($settings->content_padding) && trim($settings->content_padding)) ? $settings->content_padding : '';
		if ($content_padding) {
            $css .= $addon_id . ' .sppb-addon-overlay-image-content {';
            $css .= 'padding: ' . $content_padding . ';';
            $css .= '}';
		}
		
		//Tablet device
		$image_height_sm = (isset($settings->image_height_sm) && $settings->image_height_sm) ? $settings->image_height_sm : '';
		$title_margin_sm = (isset($settings->title_margin_sm) && $settings->title_margin_sm) ? $settings->title_margin_sm : '';
		$subtitle_fontsize_sm = (isset($settings->sub_title_fontsize_sm) && $settings->sub_title_fontsize_sm) ? $settings->sub_title_fontsize_sm : '';
		$sub_title_margin_sm = (isset($settings->sub_title_margin_sm) && $settings->sub_title_margin_sm) ? $settings->sub_title_margin_sm : '';
		$content_padding_sm = (isset($settings->content_padding_sm) && trim($settings->content_padding_sm)) ? $settings->content_padding_sm : '';
		
		if(!empty($image_height_sm) || !empty($title_margin_sm) || !empty($subtitle_fontsize_sm) || !empty($sub_title_margin_sm) || !empty($button_margin_sm) || !empty($content_padding_sm)){
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				if($image_height_sm) {
					$css .= $addon_id . ' .sppb-addon-overlay-image-content {';
						$css .= 'height: '.$image_height_sm.'px;';
					$css .= '}';
				}
				if($title_margin_sm) {
					$css .= $addon_id.' .sppb-addon-title {';
						$css .= 'margin: '.$title_margin_sm.';';
					$css .= '}';
				}
				if($subtitle_fontsize_sm) {
					$css .= $addon_id.' .sppb-addon-subtitle {';
						$css .= 'font-size:'.$subtitle_fontsize_sm.'px;';
					$css .= '}';
				}
				if($sub_title_margin_sm) {
					$css .= $addon_id.' .sppb-addon-subtitle {';
						$css .= 'margin:'.$sub_title_margin_sm.';';
					$css .= '}';
				}
				if ($button_margin_sm) {
					$css .= $addon_id . ' .overlay-image-button-wrap {';
					$css .= 'margin: ' . $button_margin_sm . ';';
					$css .= '}';
				}
				if ($content_padding_sm) {
					$css .= $addon_id . ' .sppb-addon-overlay-image-content {';
					$css .= 'padding: ' . $content_padding_sm . ';';
					$css .= '}';
				}
			$css .= '}';
		}
		//Mobile Device
		$image_height_xs = (isset($settings->image_height_xs) && $settings->image_height_xs) ? $settings->image_height_xs : '';
		$title_margin_xs = (isset($settings->title_margin_xs) && $settings->title_margin_xs) ? $settings->title_margin_xs : '';
		$subtitle_fontsize_xs = (isset($settings->sub_title_fontsize_xs) && $settings->sub_title_fontsize_xs) ? $settings->sub_title_fontsize_xs : '';
		$sub_title_margin_xs = (isset($settings->sub_title_margin_xs) && $settings->sub_title_margin_xs) ? $settings->sub_title_margin_xs : '';
		$content_padding_xs = (isset($settings->content_padding_xs) && trim($settings->content_padding_xs)) ? $settings->content_padding_xs : '';
		if(!empty($image_height_xs) || !empty($title_margin_xs) || !empty($subtitle_fontsize_xs) || !empty($sub_title_margin_xs) || !empty($button_margin_xs) || !empty($content_padding_xs)){
			$css .= '@media (max-width: 767px) {';
				if($image_height_xs) {
					$css .= $addon_id . ' .sppb-addon-overlay-image-content {';
						$css .= 'height: '.$image_height_xs.'px;';
					$css .= '}';
				}
				if($title_margin_xs) {
					$css .= $addon_id.' .sppb-addon-title {';
						$css .= 'margin: '.$title_margin_xs.';';
					$css .= '}';
				}
				if($subtitle_fontsize_xs) {
					$css .= $addon_id.' .sppb-addon-subtitle {';
						$css .= 'font-size:'.$subtitle_fontsize_xs.'px;';
					$css .= '}';
				}
				if($sub_title_margin_xs) {
					$css .= $addon_id.' .sppb-addon-subtitle {';
						$css .= 'margin:'.$sub_title_margin_xs.';';
					$css .= '}';
				}
				if ($button_margin_xs) {
					$css .= $addon_id . ' .overlay-image-button-wrap {';
					$css .= 'margin: ' . $button_margin_xs . ';';
					$css .= '}';
				}
				if ($content_padding_xs) {
					$css .= $addon_id . ' .sppb-addon-overlay-image-content {';
					$css .= 'padding: ' . $content_padding_xs . ';';
					$css .= '}';
				}
			$css .= '}';
		}

		//Button options
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
        $css_path = new JLayoutFile('addon.css.button', $layout_path);
        $options = new stdClass;
        $options->button_type = (isset($settings->type) && $settings->type) ? $settings->type : '';
        $options->button_appearance = (isset($settings->appearance) && $settings->appearance) ? $settings->appearance : '';
        $options->button_color = (isset($settings->color) && $settings->color) ? $settings->color : '';
        $options->button_color_hover = (isset($settings->color_hover) && $settings->color_hover) ? $settings->color_hover : '';
        $options->button_background_color = (isset($settings->background_color) && $settings->background_color) ? $settings->background_color : '';
        $options->button_background_color_hover = (isset($settings->background_color_hover) && $settings->background_color_hover) ? $settings->background_color_hover : '';
        $options->button_fontstyle = (isset($settings->fontstyle) && $settings->fontstyle) ? $settings->fontstyle : '';
        $options->button_font_style = (isset($settings->font_style) && $settings->font_style) ? $settings->font_style : '';
        $options->button_padding = (isset($settings->button_padding) && trim($settings->button_padding)) ? $settings->button_padding : '';
        $options->button_padding_sm = (isset($settings->button_padding_sm) && trim($settings->button_padding_sm)) ? $settings->button_padding_sm : '';
        $options->button_padding_xs = (isset($settings->button_padding_xs) && trim($settings->button_padding_xs)) ? $settings->button_padding_xs : '';
        $options->fontsize = (isset($settings->fontsize) && $settings->fontsize) ? $settings->fontsize : '';
        $options->fontsize_sm = (isset($settings->fontsize_sm) && $settings->fontsize_sm) ? $settings->fontsize_sm : '';
        $options->fontsize_xs = (isset($settings->fontsize_xs) && $settings->fontsize_xs) ? $settings->fontsize_xs : '';
        $options->button_letterspace = (isset($settings->letterspace) && $settings->letterspace) ? $settings->letterspace : '';
        $options->button_background_gradient = (isset($settings->background_gradient) && $settings->background_gradient) ? $settings->background_gradient : new stdClass();
        $options->button_background_gradient_hover = (isset($settings->background_gradient_hover) && $settings->background_gradient_hover) ? $settings->background_gradient_hover : new stdClass();

        $css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $options, 'id' => 'btn-' . $this->addon->id));

		return $css;

	}

	public static function getTemplate() {
		$output = '
		<#
			let subtitle_style = "";
			subtitle_style += (!_.isEmpty(data.sub_title_text_color) && data.sub_title_text_color) ? \'color:\'+data.sub_title_text_color+\';\' : "";
			subtitle_style += (!_.isEmpty(data.sub_title_letterspace) && data.sub_title_letterspace) ? \'letter-spacing:\'+data.sub_title_letterspace+\';\' : "";

			let sub_title_font_style = (!_.isEmpty(data.sub_title_font_style) && data.sub_title_font_style) ? data.sub_title_font_style : "";
			if(_.isObject(sub_title_font_style)){
				if(sub_title_font_style.underline){
					subtitle_style += \'text-decoration:underline;\';
				}
				if(sub_title_font_style.italic){
					subtitle_style += \'font-style:italic;\';
				}
				if(sub_title_font_style.uppercase){
					subtitle_style += \'text-transform:uppercase;\';
				}
				if(sub_title_font_style.weight){
					subtitle_style += \'font-weight:\'+sub_title_font_style.weight+\';\';
				}
			}
			let image_height = (!_.isEmpty(data.image_height) && data.image_height) ? data.image_height : 300;
			var img = {}
			if (typeof data.image !== "undefined" && typeof data.image.src !== "undefined") {
				img = data.image
			} else {
				img = {src: data.image}
			}
			let image_link = "";

			if(img.src?.indexOf("http://") == 0 || img.src?.indexOf("https://") == 0){
				image_link = img.src;
			} else {
				image_link = pagebuilder_base + img.src;
			}
			let overlay_color = (!_.isEmpty(data.overlay_color) && data.overlay_color) ? data.overlay_color : \'rgba(0, 91, 234, 0.5)\';

			var modern_font_style = false;
			var classList = "";
			classList += " sppb-btn-"+data.type;
			classList += " sppb-btn-"+data.size;
			classList += " sppb-btn-"+data.shape;
			if(!_.isEmpty(data.appearance)){
				classList += " sppb-btn-"+data.appearance;
			}

			classList += " "+data.block;

			var button_fontstyle = data.fontstyle || "";
			var button_font_style = data.font_style || "";

		#>
		<style type="text/css">
		<# if(image_link){ #>
			#sppb-addon-{{ data.id }} .overlay-background-image {
				background-image:url("{{image_link}}");
			}
		<# }
		if(data.title_color || data.title_margin){
		#>
			#sppb-addon-{{ data.id }} .sppb-addon-title a{
				color: {{data.title_color}};
			}
			#sppb-addon-{{ data.id }} .sppb-addon-title {
				<# if(_.isObject(data.title_margin)){ #>
					margin:{{data.title_margin.md}};
				<# } else { #>
					margin:{{data.title_margin}};
				<# } #>
			}
		<# }
		if(subtitle_style){
		#>
			#sppb-addon-{{ data.id }} .sppb-addon-subtitle {
				<# if(_.isObject(data.sub_title_fontsize)){ #>
					font-size:{{data.sub_title_fontsize.md}}px;
				<# } else { #>
					font-size:{{data.sub_title_fontsize}}px;
				<# } #>
				<# if(_.isObject(data.sub_title_margin)){ #>
					margin:{{data.sub_title_margin.md}};
				<# } else { #>
					margin:{{data.sub_title_margin}};
				<# } #>
				{{subtitle_style}}
			}
		<# }
		if(image_height){
		#>
		#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content {
				<# if(_.isObject(image_height)){ #>
					height: {{image_height.md}}px;
				<# } else { #>
					height: {{image_height}}px;
				<# } #>
			}
		<# }
		if(data.lightbox_icon_bg){
		#>
			#sppb-addon-{{ data.id }} .sppb-addon-image-overlay-icon {
				background: {{data.lightbox_icon_bg}};
			}
		<# } #>
		<# if(data.overlay_type !== "none") { #>
			<# if(data.overlay_type=="color"){ #>
				#sppb-addon-{{ data.id }} .overlay-background-style {
					background: {{data.overlay_color}};
				}
			<# } else if(data.overlay_type=="gradient"){
				let gradient_color1 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.color) && data.overlay_gradient.color) ? data.overlay_gradient.color : "rgba(127, 0, 255, 0.8)";
				let gradient_color2 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.color2) && data.overlay_gradient.color2) ? data.overlay_gradient.color2 : "rgba(225, 0, 255, 0.7)";
				let degree = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.deg) && data.overlay_gradient.deg)? data.overlay_gradient.deg : "";
				let type = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.type) && data.overlay_gradient.type) ? data.overlay_gradient.type : "linear";
				let radialPos = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.radialPos) && data.overlay_gradient.radialPos) ? data.overlay_gradient.radialPos : "Center Center";
				let radial_angle1 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.pos) && data.overlay_gradient.pos) ? data.overlay_gradient.pos : "0";
				let radial_angle2 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.pos2) && data.overlay_gradient.pos2) ? data.overlay_gradient.pos2 : "100";
			#>
			#sppb-addon-{{ data.id }} .overlay-background-style {
				<# if(type!=="radial"){ #>
					background: -webkit-linear-gradient({{degree}}deg, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
					background: linear-gradient({{degree}}deg, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
				<# } else { #>
					background: -webkit-radial-gradient(at {{radialPos}}, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
					background: radial-gradient(at {{radialPos}}, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
				<# } #>
			}
			<# } #>
		<# } else { #>
			#sppb-addon-{{ data.id }} .overlay-background-style {
				background: transparent;
			}
		<# } #>
		<#
			let overlay_hover_type = (!_.isEmpty(data.overlay_hover_type) && data.overlay_hover_type) ? data.overlay_hover_type : "";
			let overlay_hover_color = (!_.isEmpty(data.overlay_hover_color) && data.overlay_hover_color) ? data.overlay_hover_color : "";
			let overlay_hover_gradient = (!_.isEmpty(data.overlay_hover_gradient) && data.overlay_hover_gradient) ? data.overlay_hover_gradient : "";
		if(overlay_hover_type!=="none"){
			if(overlay_hover_type=="color"){
			#>
				#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content:hover .overlay-background-style {
					background: {{overlay_hover_color}};
				}
			<# } else if(overlay_hover_type=="gradient") {
				let gradient_hover_color1 = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.color) && overlay_hover_gradient.color) ? overlay_hover_gradient.color : "rgba(127, 0, 255, 0.8)";
				let gradient_hover_color2 = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.color2) && overlay_hover_gradient.color2) ? overlay_hover_gradient.color2 : "rgba(225, 0, 255, 0.7)";
				let hover_degree = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.deg) && overlay_hover_gradient.deg) ? overlay_hover_gradient.deg : "";
				let hover_type = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.type) && overlay_hover_gradient.type) ? overlay_hover_gradient.type : "linear";
				let hover_radialPos = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.radialPos) && overlay_hover_gradient.radialPos) ? overlay_hover_gradient.radialPos : "Center Center";
				let hover_radial_angle1 = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.pos) && overlay_hover_gradient.pos) ? overlay_hover_gradient.pos : "0";
				let hove_radial_angle2 = (_.isObject(overlay_hover_gradient) && !_.isEmpty(overlay_hover_gradient.pos2) && overlay_hover_gradient.pos2) ? overlay_hover_gradient.pos2 : "100";
			#>
				#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content:hover .overlay-background-style {
					opacity:.8;
				}
				#sppb-addon-{{ data.id }} .overlay-background-style::after {
					<# if(hover_type!=="radial"){ #>
						background: -webkit-linear-gradient({{hover_degree}}deg, {{gradient_hover_color1}} {{hover_radial_angle1}}%, {{gradient_hover_color2}} {{hove_radial_angle2}}%) transparent;
						background: linear-gradient({{hover_degree}}deg, {{gradient_hover_color1}} {{hover_radial_angle1}}%, {{gradient_hover_color2}} {{hove_radial_angle2}}%) transparent;
					<# } else { #>
						background: -webkit-radial-gradient(at {{hover_radialPos}}, {{gradient_hover_color1}} {{hover_radial_angle1}}%, {{gradient_hover_color2}} {{hove_radial_angle2}}%) transparent);
						background: radial-gradient(at {{hover_radialPos}}, {{gradient_hover_color1}} {{hover_radial_angle1}}%, {{gradient_hover_color2}} {{hove_radial_angle2}}%) transparent);
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content:hover .overlay-background-style::after {
					opacity:1;
				}
			<# }
		} else { #>
			#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content:hover .overlay-background-style {
				background: transparent;
			}
		<# } #>
		<# if (!_.isEmpty(data.content_padding)) { #>
            #sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content {
				<# if(_.isObject(data.content_padding)){ #>
					padding:{{data.content_padding.md}};
				<# } else { #>
					padding:{{data.content_padding}};
				<# } #>
            }
		<# } #>
		<# if (data.button_margin) { #>
			#sppb-addon-{{ data.id }} .overlay-image-button-wrap {
				<# if(_.isObject(data.button_margin)){ #>
					margin: {{data.button_margin.md}};
				<# } else { #>
					margin: {{data.button_margin}};
				<# } #>
            }
		<# }
			let image_height_sm = (!_.isEmpty(data.image_height) && data.image_height.sm) ? data.image_height.sm : "";
			let title_margin_sm = (!_.isEmpty(data.title_margin) && data.title_margin.sm) ? data.title_margin.sm : ""
			let subtitle_fontsize_sm = (!_.isEmpty(data.sub_title_fontsize) && data.sub_title_fontsize.sm) ? data.sub_title_fontsize.sm : "";
			let sub_title_margin_sm = (!_.isEmpty(data.sub_title_margin) && data.sub_title_margin.sm) ? data.sub_title_margin.sm : "";
			let content_padding_sm = (!_.isEmpty(data.content_padding) && data.content_padding.sm) ? data.content_padding.sm : "";
			
		if(image_height_sm || title_margin_sm || subtitle_fontsize_sm || sub_title_margin_sm || data.button_margin || content_padding_sm){
		#>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if(image_height_sm) { #>
					#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content {
						height: {{image_height_sm}}px;
					}
				<# }
				if(title_margin_sm) {
				#>
					#sppb-addon-{{ data.id }} .sppb-addon-title {
						margin: {{title_margin_sm}};
					}
				<# }
				if(subtitle_fontsize_sm) {
				#>
					#sppb-addon-{{ data.id }} .sppb-addon-subtitle {
						font-size:{{subtitle_fontsize_sm}}px;
					}
				<# }
				if(sub_title_margin_sm) {
				#>
					#sppb-addon-{{ data.id }} .sppb-addon-subtitle {
						margin:{{sub_title_margin_sm}};
					}
				<# }
				if(_.isObject(data.button_margin)) {
				#>
					#sppb-addon-{{ data.id }} .overlay-image-button-wrap {
						margin:{{data.button_margin.sm}};
					}
				<# } #>
				<# if (content_padding_sm) { #>
					#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content {
						padding:{{content_padding_sm}};
					}
				<# } #>
			}
		<# }
		let image_height_xs = (!_.isEmpty(data.image_height) && data.image_height.xs) ? data.image_height.xs : "";
		let title_margin_xs = (!_.isEmpty(data.title_margin) && data.title_margin.xs) ? data.title_margin.xs : "";
		let subtitle_fontsize_xs = (!_.isEmpty(data.sub_title_fontsize) && data.sub_title_fontsize.xs) ? data.sub_title_fontsize.xs : ""
		let sub_title_margin_xs = (!_.isEmpty(data.sub_title_margin) && data.sub_title_margin.xs) ? data.sub_title_margin.xs : ""
		let content_padding_xs = (!_.isEmpty(data.content_padding) && data.content_padding.xs) ? data.content_padding.xs : "";

		if(image_height_xs || title_margin_xs || subtitle_fontsize_xs || data.button_margin || sub_title_margin_xs || content_padding_xs){
		#>
			@media (max-width: 767px) {
				<# if(image_height_xs) { #>
					#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content {
						height: {{image_height_xs}}px;
					}
				<# }
				if(title_margin_xs) {
				#>
					#sppb-addon-{{ data.id }} .sppb-addon-title {
						margin: {{title_margin_xs}};
					}
				<# }
				if(subtitle_fontsize_xs) {
				#>
					#sppb-addon-{{ data.id }} .sppb-addon-subtitle {
						font-size:{{subtitle_fontsize_xs}}px;
					}
				<# }
				if(sub_title_margin_xs) {
				#>
					#sppb-addon-{{ data.id }} .sppb-addon-subtitle {
						margin:{{sub_title_margin_xs}};
					}
				<# }
				if(_.isObject(data.button_margin)) {
				#>
					#sppb-addon-{{ data.id }} .overlay-image-button-wrap {
						margin:{{data.button_margin.xs}};
					}
				<# } #>
				<# if (content_padding_xs) { #>
					#sppb-addon-{{ data.id }} .sppb-addon-overlay-image-content {
						padding:{{content_padding_xs}};
					}
				<# } #>
			}
		<# } #>

		#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.type }}{
			letter-spacing: {{ data.letterspace }};

			<# if(_.isObject(button_font_style) && button_font_style.underline) { #>
				text-decoration: underline;
				<# modern_font_style = true #>
			<# } #>

			<# if(_.isObject(button_font_style) && button_font_style.italic) { #>
				font-style: italic;
				<# modern_font_style = true #>
			<# } #>

			<# if(_.isObject(button_font_style) && button_font_style.uppercase) { #>
				text-transform: uppercase;
				<# modern_font_style = true #>
			<# } #>

			<# if(_.isObject(button_font_style) && button_font_style.weight) { #>
				font-weight: {{ button_font_style.weight }};
				<# modern_font_style = true #>
			<# } #>

			<# if(!modern_font_style) { #>
				<# if(_.isArray(button_fontstyle)) { #>
					<# if(button_fontstyle.indexOf("underline") !== -1){ #>
						text-decoration: underline;
					<# } #>
					<# if(button_fontstyle.indexOf("uppercase") !== -1){ #>
						text-transform: uppercase;
					<# } #>
					<# if(button_fontstyle.indexOf("italic") !== -1){ #>
						font-style: italic;
					<# } #>
					<# if(button_fontstyle.indexOf("lighter") !== -1){ #>
						font-weight: lighter;
					<# } else if(button_fontstyle.indexOf("normal") !== -1){#>
						font-weight: normal;
					<# } else if(button_fontstyle.indexOf("bold") !== -1){#>
						font-weight: bold;
					<# } else if(button_fontstyle.indexOf("bolder") !== -1){#>
						font-weight: bolder;
					<# } #>
				<# } #>
			<# } #>
		}

		<# if(data.type == "custom"){ #>
			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					<# if(_.isObject(data.fontsize)){ #>
						font-size: {{data.fontsize.md}}px;
					<# } else { #>
						font-size: {{data.fontsize}}px;
					<# } #>
				color: {{ data.color }};
				<# if(_.isObject(data.button_padding)) { #>
					padding: {{ data.button_padding.md }};
				<# } else { #>
					padding: {{ data.button_padding }}
				<# } #>
				<# if(data.appearance == "outline"){ #>
					border-color: {{ data.background_color }};
					background-color: transparent;
				<# } else if(data.appearance == "3d"){ #>
					border-bottom-color: {{ data.background_color_hover }};
					background-color: {{ data.background_color }};
				<# } else if(data.appearance == "gradient"){ #>
					border: none;
					<# if(typeof data.background_gradient.type !== "undefined" && data.background_gradient.type == "radial"){ #>
						background-image: radial-gradient(at {{ data.background_gradient.radialPos || "center center"}}, {{ data.background_gradient.color }} {{ data.background_gradient.pos || 0 }}%, {{ data.background_gradient.color2 }} {{ data.background_gradient.pos2 || 100 }}%);
					<# } else { #>
						background-image: linear-gradient({{ data.background_gradient.deg || 0}}deg, {{ data.background_gradient.color }} {{ data.background_gradient.pos || 0 }}%, {{ data.background_gradient.color2 }} {{ data.background_gradient.pos2 || 100 }}%);
					<# } #>
				<# } else { #>
					background-color: {{ data.background_color }};
				<# } #>
			}

			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom:hover{
				color: {{ data.color_hover }};
				background-color: {{ data.background_color_hover }};
				<# if(data.appearance == "outline"){ #>
					border-color: {{ data.background_color_hover }};
				<# } else if(data.appearance == "gradient"){ #>
					<# if(typeof data.background_gradient_hover.type !== "undefined" && data.background_gradient_hover.type == "radial"){ #>
						background-image: radial-gradient(at {{ data.background_gradient_hover.radialPos || "center center"}}, {{ data.background_gradient_hover.color }} {{ data.background_gradient_hover.pos || 0 }}%, {{ data.background_gradient_hover.color2 }} {{ data.background_gradient_hover.pos2 || 100 }}%);
					<# } else { #>
						background-image: linear-gradient({{ data.background_gradient_hover.deg || 0}}deg, {{ data.background_gradient_hover.color }} {{ data.background_gradient_hover.pos || 0 }}%, {{ data.background_gradient_hover.color2 }} {{ data.background_gradient_hover.pos2 || 100 }}%);
					<# } #>
				<# } #>
			}
			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					<# if(_.isObject(data.fontsize)){ #>
						font-size: {{data.fontsize.sm}}px;
					<# } #>
					<# if(_.isObject(data.button_padding)) { #>
						padding: {{ data.button_padding.sm }};
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					<# if(_.isObject(data.fontsize)){ #>
						font-size: {{data.fontsize.xs}}px;
					<# } #>
					<# if(_.isObject(data.button_padding)) { #>
						padding: {{ data.button_padding.xs }};
					<# } #>
				}
			}
		<# }
		if(data.global_border_radius){
		#>
			#sppb-addon-{{ data.id }} {
				overflow:hidden;
			}
		<# } #>
		</style>
		<div class="sppb-addon sppb-addon-overlay-image {{data.class}} image-effect-{{data.background_image_animation}} {{data.show_content_on_hover ? "overlay-show-content-on-hover" : ""}}">
		<div class="sppb-addon-overlay-image-content title-subtitle-{{data.title_subtitle_position}}">
		<#
		if((data.title || data.sub_title) && data.title_subtitle_position){
			let title_icon_arr = (typeof data.title_icon !== "undefined" && data.title_icon) ? data.title_icon.split(" ") : "";
			let title_icon_name = title_icon_arr.length === 1 ? "fa "+data.title_icon : data.title_icon;
		#>
			<div class="overlay-image-title">
				<{{data.heading_selector}} class="sppb-addon-title">
					<# if(data.title_link){ #>
						<a href="{{data.title_link}}"
						<# if(data.title_link_new_window){ #>
							target="_blank"
						<# } #>
						>
					<# } #>
					<# if(data.title_icon){
					#>
						<i class="{{title_icon_name}}"></i>
					<# } #>
					<span class="sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{data.title}}}</span>
					<# if(data.title_link){ #>
						</a>
					<# } #>
				</{{data.heading_selector}}>
				<{{data.subtitle_heading_selector}} class="sppb-addon-subtitle">
					<#
					let sub_icon_arr = (typeof data.sub_title_icon !== "undefined" && data.sub_title_icon) ? data.sub_title_icon.split(" ") : "";
					let sub_icon_name = sub_icon_arr.length === 1 ? "fa "+data.sub_title_icon : data.sub_title_icon;

					if(data.sub_title_icon){
					#>
						<i class="{{sub_icon_name}}"></i>
					<# } #>
					<span class="sp-inline-editable-element" data-id={{data.id}} data-fieldName="sub_title" contenteditable="true">{{{data.sub_title}}}</span>
					
				</{{data.subtitle_heading_selector}}>
			<# if(data.text){
				let icon_arr = (typeof data.icon !== "undefined" && data.icon) ? data.icon.split(" ") : "";
				let icon_name = icon_arr.length === 1 ? "fa "+data.icon : data.icon;
			#>
				<div class="overlay-image-button-wrap">
					<a href=\'{{ data.url }}\' id="btn-{{ data.id }}" target="{{ data.target }}" class="sppb-btn {{ classList }}"><# if(data.icon_position == "left" && !_.isEmpty(data.icon)) {
					#><i class="{{ icon_name }}"></i><# } #> {{ data.text }}<# if(data.icon_position == "right" && !_.isEmpty(data.icon)) { #> <i class="{{ icon_name }}"></i><# } #></a>
				</div>
			<# } #>
			</div>
		<# } #>
		<div class="overlay-background-image-wrapper">
		<div class="overlay-background-image"></div>
		<# if(data.image_in_lightbox && data.title_subtitle_position !== "center-center" && image_link){ #>
			<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href=\'{{image_link}}\'>+</a>
		<# } #>
		</div>
		<# if(data.overlay_type!="none" || data.overlay_mode == "hover"){ #>
			<div class="overlay-background-style"></div>
		<# } #>
		</div>
		</div>
		';

		return $output;
	}

}
