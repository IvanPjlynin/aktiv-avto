<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonImage_layouts extends SppagebuilderAddons{

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' '.$settings->class : '';
		//Inline Layout
		$image_preset_thumb = (isset($settings->image_preset_thumb) && $settings->image_preset_thumb) ? $settings->image_preset_thumb : 'inline';

		$image = (isset($settings->image) && $settings->image) ? $settings->image : '';
		$image_src = isset($image->src) ? $image->src : $image;
		$image_width = (isset($image->width) && $image->width) ? $image->width : '';
		$image_height = (isset($image->height) && $image->height) ? $image->height : '';

		$alt_text = (isset($settings->image_alt_text) && $settings->image_alt_text) ? $settings->image_alt_text : '';
		$image_strech = (isset($settings->image_strech) && $settings->image_strech) ? ' image-fit' : '';
		$open_in_lightbox = (isset($settings->open_in_lightbox) && $settings->open_in_lightbox) ? $settings->open_in_lightbox : '';
		$image_overlay_color = (isset($settings->image_overlay_color) && $settings->image_overlay_color) ? $settings->image_overlay_color : '';
		$click_url = (isset($settings->click_url) && $settings->click_url) ? $settings->click_url : '';
		$url_in_new_window = (isset($settings->url_in_new_window) && $settings->url_in_new_window) ? $settings->url_in_new_window : '';
		$link_apear_in_title = (isset($settings->link_apear_in_title) && $settings->link_apear_in_title) ? $settings->link_apear_in_title : '';
		$caption = (isset($settings->caption) && $settings->caption) ? $settings->caption : '';
		$caption_postion = (isset($settings->caption_postion) && $settings->caption_postion) ? $settings->caption_postion : '';
		$image_container_column = (isset($settings->image_container_column) && $settings->image_container_column) ? (int) $settings->image_container_column : '';
		$popup_video_on_image = (isset($settings->popup_video_on_image) && $settings->popup_video_on_image) ? $settings->popup_video_on_image : '';
		$popup_video_src = (isset($settings->popup_video_src) && $settings->popup_video_src) ? $settings->popup_video_src : '';
		//Lazyload image size
		$image_link = '';
		if(strpos($image_src, "http://") !== false || strpos($image_src, "https://") !== false){
			$image_link = $image_src;
		} else {
			$image_link = JURI::base() . $image_src;
		}
		//Lazyload image
		$placeholder = $image_link == '' ? false : $this->get_image_placeholder($image_link);
		
		$target = '';
		if($url_in_new_window){
			$target = 'target="_blank" rel="noopener noreferrer"';
		}
		
		//Other Layout
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h4';
		$text_content = (isset($settings->text_content) && $settings->text_content) ? $settings->text_content : '';
		$content_text_align = (isset($settings->content_text_align) && $settings->content_text_align) ? ' sppb-text-alignment' : '';
		$content_vertical_align = (isset($settings->content_vertical_align) && $settings->content_vertical_align) ? $settings->content_vertical_align : '';

		$image_desktop_order = (isset($settings->image_desktop_order) && $settings->image_desktop_order != '') ? (int) $settings->image_desktop_order : '';
		$image_tab_order = (isset($settings->image_tab_order) && $settings->image_tab_order != '') ? (int) $settings->image_tab_order : '';
		$image_mob_order = (isset($settings->image_mob_order) && $settings->image_mob_order != '') ? (int) $settings->image_mob_order : '';
		
		$order_class = '';
		if($image_desktop_order && $image_preset_thumb !== 'poster'){
			$order_class .= ' sppb-order-md-'.$image_desktop_order;
		}
		if($image_tab_order && $image_preset_thumb !== 'poster'){
			$order_class .= ' sppb-order-sm-'.$image_tab_order;
		}
		if($image_mob_order && $image_preset_thumb !== 'poster'){
			$order_class .= ' sppb-order-xs-'.$image_mob_order;
		}

		$content_desktop_order = (isset($settings->content_desktop_order) && $settings->content_desktop_order != '') ? (int) $settings->content_desktop_order : '';
		$content_tab_order = (isset($settings->content_tab_order) && $settings->content_tab_order != '') ? (int) $settings->content_tab_order : '';
		$content_mob_order = (isset($settings->content_mob_order) && $settings->content_mob_order != '') ? (int) $settings->content_mob_order : '';
		$cont_order_class = '';
		if($content_desktop_order && $image_preset_thumb !== 'poster'){
			$cont_order_class .= ' sppb-order-md-'.$content_desktop_order;
		}
		if($content_tab_order && $image_preset_thumb !== 'poster'){
			$cont_order_class .= ' sppb-order-sm-'.$content_tab_order;
		}
		if($content_mob_order && $image_preset_thumb !== 'poster'){
			$cont_order_class .= ' sppb-order-xs-'.$content_mob_order;
		}
		$image_preset_class = '';
		if($image_preset_thumb){
			$image_preset_class = ' image-layout-preset-style-'.$image_preset_thumb;
		}
		if($image_preset_thumb === 'poster'){
			$content_text_align = '';
		}

		//Button options
		$btn_text = (isset($settings->btn_text) && $settings->btn_text) ? $settings->btn_text : '';
		$btn_class = '';
		$btn_class .= (isset($settings->btn_type) && $settings->btn_type) ? ' sppb-btn-' . $settings->btn_type : '';
        $btn_class .= (isset($settings->btn_size) && $settings->btn_size) ? ' sppb-btn-' . $settings->btn_size : '';
        $btn_class .= (isset($settings->btn_shape) && $settings->btn_shape) ? ' sppb-btn-' . $settings->btn_shape : ' sppb-btn-rounded';
        $btn_class .= (isset($settings->btn_appearance) && $settings->btn_appearance) ? ' sppb-btn-' . $settings->btn_appearance : '';
        $attribs = (isset($settings->btn_target) && $settings->btn_target) ? ' target="' . $settings->btn_target . '"' : '';
        $attribs .= (isset($settings->btn_url) && $settings->btn_url) ? ' href="' . $settings->btn_url . '"' : '';
        $attribs .= ' id="btn-' . $this->addon->id . '"';
        $btn_icon = (isset($settings->btn_icon) && $settings->btn_icon) ? $settings->btn_icon : '';
		$btn_icon_position = (isset($settings->btn_icon_position) && $settings->btn_icon_position) ? $settings->btn_icon_position : 'left';
		
		$icon_arr = array_filter(explode(' ', $btn_icon));
		if (count($icon_arr) === 1) {
			$btn_icon = 'fa ' . $btn_icon;
		}

        if ($btn_icon_position == 'left') {
            $btn_text = ($btn_icon) ? '<i class="' . $btn_icon . '" aria-hidden="true"></i> ' . $btn_text : $btn_text;
        } else {
            $btn_text = ($btn_icon) ? $btn_text . ' <i class="' . $btn_icon . '" aria-hidden="true"></i>' : $btn_text;
        }

		//Output start
		$output = '';
		$output .= '<div class="sppb-addon-image-layouts'.$class.'">';
		$output .= '<div class="sppb-addon-content">';
		if($image_preset_thumb === 'inline'){
			$output .= '<div class="sppb-image-layouts-inline">';
			$output .= '<div class="sppb-image-layouts-inline-img">';
			if($click_url){
				$output .= '<a '.$target.' href="' . $click_url . '">';
			}

			$output .= '<img class="sppb-img-responsive'.$image_strech.''.($placeholder ? ' sppb-element-lazy' : '').'" src="' . ($placeholder ? $placeholder : $image_link) . '" alt="'. $alt_text .'" '.($placeholder ? 'data-large="'.$image_link.'"' : '').' '.($image_width ? 'width="'.$image_width.'"' : '').' '.($image_height ? 'height="'.$image_height.'"' : '').' loading="lazy">';

			if($click_url){
				$output .= '</a>';
			}
			
			if($open_in_lightbox){
				if($image){
					$output .= '<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="' . $image_link . '">+</a>';
				}
				if($image_overlay_color) {
					$output .= '<div class="sppb-addon-image-overlay">';
					$output .= '</div>';
				}
			}
			$output .= '</div>';//.sppb-image-layouts-inline-img

			if($caption && $caption_postion !== 'no-caption'){
				$output .= '<div class="sppb-addon-image-layout-caption '.$caption_postion.'">';
				$output .= $caption;
				$output .= '</div>';
			}
			$output .= '</div>';
		} else {
			$output .= '<div class="sppb-addon-image-layout-wrap'.$image_preset_class.'">';
			if($image_preset_thumb === 'card' || $image_preset_thumb === 'overlap' || $image_preset_thumb === 'collage'){
				$output .= '<div class="sppb-row">';
				$output .= '<div class="sppb-col-sm-'.($image_container_column ? $image_container_column : 6).''.$order_class.'">';
			}
			$output .= '<div class="sppb-addon-image-layout-image'.$image_strech.''.(($image_preset_thumb !== 'card' && $image_preset_thumb !== 'overlap' && $image_preset_thumb !== 'collage') ? $order_class : '').'">';
			if($click_url){
				$output .= '<a '.$target.' href="' . $click_url . '">';
			}
			$output .= '<img class="sppb-img-responsive'.$image_strech.''.($placeholder ? ' sppb-element-lazy' : '').'" src="' . ($placeholder ? $placeholder : $image_link) . '" alt="'. $alt_text .'" '.($placeholder ? 'data-large="'.$image_link.'"' : '').' '.($image_width ? 'width="'.$image_width.'"' : '').' '.($image_height ? 'height="'.$image_height.'"' : '').' loading="lazy">';
			if($click_url){
				$output .= '</a>';
			}
			if($popup_video_on_image && $image_preset_thumb == 'card' && $popup_video_src){
				$output .= '<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="iframe" data-mainclass="mfp-no-margins mfp-with-zoom" href="' . $popup_video_src . '">';
				$output .= '</a>';
				$output .= '<div class="sppb-addon-image-layouts-card-text-caption">';
				$output .= '<span class="image-layouts-card-text-caption-icon"><i class="fa fa-play"></i></span>';
				$output .= '<h4 class="image-layouts-card-text-caption-title">'.strip_tags($title).'</h4>';
				$output .= '</div>';
			}
			$output .= '</div>';//.sppb-addon-image-layout-image
			if($image_preset_thumb === 'card' || $image_preset_thumb === 'overlap' || $image_preset_thumb === 'collage'){
				$output .= '</div>';
				$output .= '<div class="sppb-col-sm-'.($image_container_column ? ($image_container_column == 12 ? 12 : 12-$image_container_column) : 6).''.$cont_order_class.''.($image_preset_thumb === 'collage' ? ' collage-content-vertical-'.$content_vertical_align : '').'">';
			}
			$output .= '<div class="sppb-addon-image-layout-content'.(($image_preset_thumb !== 'card' && $image_preset_thumb !== 'overlap' && $image_preset_thumb !== 'collage') ? $cont_order_class : '').''.$content_text_align.''.(($content_desktop_order < $image_desktop_order) && $image_preset_thumb === 'collage' ? ' collage-content-right' : '').''.(($content_tab_order < $image_tab_order) && $image_preset_thumb === 'collage' ? ' collage-content-sm-right' : '').'">';
			if($title){
				if($image_preset_thumb === 'overlap'){
					$output .= '<div class="image-layout-tittle-wrap'.($content_desktop_order < $image_desktop_order ? ' title-align-right' : '').''.($content_tab_order < $image_tab_order ? ' title-align-sm-right' : '').'">';
				}
					$output .= '<'.$heading_selector.' class="sppb-image-layout-title">';
						if($link_apear_in_title && $image_preset_thumb === 'poster'){
							if($click_url){
								$output .= '<a '.$target.' href="' . $click_url . '">';
							}
						}
						
						$output .= $title;

						if($link_apear_in_title && $image_preset_thumb === 'poster'){
							if($click_url){
								$output .= '</a>';
							}
						}
					$output .= '</'.$heading_selector.'>';
				if($image_preset_thumb === 'overlap'){
					$output .= '</div>';
				}
			}
			if($text_content){
				$output .= '<div class="sppb-addon-image-layout-text">';
					$output .= $text_content;
				$output .= '</div>';
			}
			if($btn_text){
				$output .= '<a' . $attribs . ' class="sppb-btn ' . $btn_class . '">' . $btn_text . '</a>';
			}
			$output .= '</div>';//.sppb-addon-image-layout-content
			if($image_preset_thumb === 'card' || $image_preset_thumb === 'overlap' || $image_preset_thumb === 'collage'){
				$output .= '</div>';
				$output .= '</div>';//.sppb-row
			}
			$output .= '</div>';
		}
		
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function scripts() {
		return array(JURI::base() . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function stylesheets() {
		return array(JURI::base() . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		$image_preset_thumb = (isset($settings->image_preset_thumb) && $settings->image_preset_thumb) ? $settings->image_preset_thumb : '';
		$css = '';

		//CSS output
		$image_border_radius = (isset($settings->image_border_radius) && $settings->image_border_radius) ? 'border-radius:'.$settings->image_border_radius.'px;' : '';
		if($image_border_radius){
			$css .= $addon_id . ' .sppb-addon-image-layout-image .sppb-img-responsive,';
			$css .= $addon_id . ' .sppb-image-layouts-inline-img .sppb-img-responsive,';
			$css .= $addon_id . ' .sppb-addon-image-overlay {';
				$css .= $image_border_radius;
			$css .= '}';
		}

		//Overlay
		$image_overlay_color = (isset($settings->image_overlay_color) && $settings->image_overlay_color) ? 'background-color:'.$settings->image_overlay_color.';' : '';
		$css .= $addon_id . ' .sppb-addon-image-overlay {';
			$css .= $image_overlay_color;
		$css .= '}';

		//Light box icon
		$lightbox_icon_bg = (isset($settings->lightbox_icon_bg) && $settings->lightbox_icon_bg) ? 'background:'.$settings->lightbox_icon_bg.';' : '';
		$css .= $addon_id . ' .sppb-addon-image-overlay-icon {';
			$css .= $lightbox_icon_bg;
		$css .= '}';

		//Caption style
		$caption_style = '';
		$caption_style .= (isset($settings->caption_text_color) && $settings->caption_text_color) ? 'color:'.$settings->caption_text_color.';' : '';
		$caption_style .= (isset($settings->caption_background) && $settings->caption_background) ? 'background:'.$settings->caption_background.';' : '';
		$caption_style .= (isset($settings->caption_fontsize) && $settings->caption_fontsize) ? 'font-size:'.$settings->caption_fontsize.'px;' : '';
		$caption_style .= (isset($settings->caption_lineheight) && $settings->caption_lineheight) ? 'line-height:'.$settings->caption_lineheight.'px;' : '';
		$caption_style .= (isset($settings->caption_letterspace) && $settings->caption_letterspace) ? 'letter-spacing:'.$settings->caption_letterspace.';' : '';
		$caption_style .= (isset($settings->caption_padding) && trim($settings->caption_padding)) ? 'padding:'.$settings->caption_padding.';' : '';

		$caption_font_style = (isset($settings->caption_font_style) && $settings->caption_font_style) ? $settings->caption_font_style : '';
		if(isset($caption_font_style->underline) && $caption_font_style->underline){
			$caption_style .= 'text-decoration:underline;';
		}
		if(isset($caption_font_style->italic) && $caption_font_style->italic){
			$caption_style .= 'font-style:italic;';
		}
		if(isset($caption_font_style->uppercase) && $caption_font_style->uppercase){
			$caption_style .= 'text-transform:uppercase;';
		}
		if(isset($caption_font_style->weight) && $caption_font_style->weight){
			$caption_style .= 'font-weight:'.$caption_font_style->weight.';';
		}

		$css .= $addon_id . ' .sppb-addon-image-layout-caption {';
			$css .= $caption_style;
		$css .= '}';

		//Content style
		//title style
		$title_style = '';
		$title_style_sm = '';
		$title_style_xs = '';
		if($image_preset_thumb !== 'overlap'){
			$title_style .= (isset($settings->title_margin) && trim($settings->title_margin)) ? 'margin:'.$settings->title_margin.';' : '';
			$title_style .= (isset($settings->title_padding) && trim($settings->title_padding)) ? 'padding:'.$settings->title_padding.';' : '';
			$title_style .= (isset($settings->title_lineheight) && $settings->title_lineheight) ? 'line-height:'.$settings->title_lineheight.'px;' : '';
			
			$title_style_sm .= (isset($settings->title_margin_sm) && trim($settings->title_margin_sm)) ? 'margin:'.$settings->title_margin_sm.';' : '';
			$title_style_sm .= (isset($settings->title_padding_sm) && trim($settings->title_padding_sm)) ? 'padding:'.$settings->title_padding_sm.';' : '';
			$title_style_sm .= (isset($settings->title_lineheight_sm) && $settings->title_lineheight_sm) ? 'line-height:'.$settings->title_lineheight_sm.'px;' : '';

			$title_style_xs .= (isset($settings->title_margin_xs) && trim($settings->title_margin_xs)) ? 'margin:'.$settings->title_margin_xs.';' : '';
			$title_style_xs .= (isset($settings->title_padding_xs) && trim($settings->title_padding_xs)) ? 'padding:'.$settings->title_padding_xs.';' : '';
			$title_style_xs .= (isset($settings->title_lineheight_xs) && $settings->title_lineheight_xs) ? 'line-height:'.$settings->title_lineheight_xs.'px;' : '';
		}
		if($image_preset_thumb === 'overlap'){
			$overlap_bg = (isset($settings->title_background) && $settings->title_background) ? $settings->title_background : '';
			$css .= $addon_id.' .sppb-image-layout-title {';
				$css .= 'background:'.$overlap_bg.';';
				$css .= 'box-shadow: 12px 0 0 '.$overlap_bg.', -12px 0 0 '.$overlap_bg.';';
			$css .= '}';
		}

		$title_style .= (isset($settings->title_text_color) && $settings->title_text_color) ? 'color:'.$settings->title_text_color.';' : '';
		$title_style .= (isset($settings->title_fontsize) && $settings->title_fontsize) ? 'font-size:'.$settings->title_fontsize.'px;' : '';
		$title_style_sm .= (isset($settings->title_fontsize_sm) && $settings->title_fontsize_sm) ? 'font-size:'.$settings->title_fontsize_sm.'px;' : '';
		$title_style_xs .= (isset($settings->title_fontsize_xs) && $settings->title_fontsize_xs) ? 'font-size:'.$settings->title_fontsize_xs.'px;' : '';
		$title_style .= (isset($settings->title_letterspace) && $settings->title_letterspace) ? 'letter-spacing:'.$settings->title_letterspace.';' : '';

		$title_font_style = (isset($settings->title_font_style) && $settings->title_font_style) ? $settings->title_font_style : '';
		if(isset($title_font_style->underline) && $title_font_style->underline){
			$title_style .= 'text-decoration:underline;';
		}
		if(isset($title_font_style->italic) && $title_font_style->italic){
			$title_style .= 'font-style:italic;';
		}
		if(isset($title_font_style->uppercase) && $title_font_style->uppercase){
			$title_style .= 'text-transform:uppercase;';
		}
		if(isset($title_font_style->weight) && $title_font_style->weight){
			$title_style .= 'font-weight:'.$title_font_style->weight.';';
		}

		if($title_style){
			$css .= $addon_id.' .sppb-image-layout-title {';
				$css .= $title_style;
			$css .= '}';
		}

		// Text Content Style
		$text_cont_style = '';
		$text_cont_style_sm = '';
		$text_cont_style_xs = '';
		$text_cont_style .= (isset($settings->text_content_color) && $settings->text_content_color) ? 'color:'.$settings->text_content_color.';' : '';
		$text_cont_style .= (isset($settings->text_content_fontsize) && $settings->text_content_fontsize) ? 'font-size:'.$settings->text_content_fontsize.'px;' : '';

		$text_cont_style_sm .= (isset($settings->text_content_fontsize_sm) && $settings->text_content_fontsize_sm) ? 'font-size:'.$settings->text_content_fontsize_sm.'px;' : '';
		$text_cont_style_xs .= (isset($settings->text_content_fontsize_xs) && $settings->text_content_fontsize_xs) ? 'font-size:'.$settings->text_content_fontsize_xs.'px;' : '';

		$text_cont_style .= (isset($settings->text_content_lineheight) && $settings->text_content_lineheight) ? 'line-height:'.$settings->text_content_lineheight.'px;' : '';
		$text_cont_style_sm .= (isset($settings->text_content_lineheight_sm) && $settings->text_content_lineheight_sm) ? 'line-height:'.$settings->text_content_lineheight_sm.'px;' : '';
		$text_cont_style_xs .= (isset($settings->text_content_lineheight_xs) && $settings->text_content_lineheight_xs) ? 'line-height:'.$settings->text_content_lineheight_xs.'px;' : '';

		$text_cont_style .= (isset($settings->text_content_margin) && trim($settings->text_content_margin)) ? 'margin:'.$settings->text_content_margin.';' : '';
		$text_cont_style_sm .= (isset($settings->text_content_margin_sm) && trim($settings->text_content_margin_sm)) ? 'margin:'.$settings->text_content_margin_sm.';' : '';
		$text_cont_style_xs .= (isset($settings->text_content_margin_xs) && trim($settings->text_content_margin_xs)) ? 'margin:'.$settings->text_content_margin_xs.';' : '';
		
		$text_cont_style .= (isset($settings->text_content_padding) && trim($settings->text_content_padding)) ? 'padding:'.$settings->text_content_padding.';' : '';
		$text_cont_style_sm .= (isset($settings->text_content_padding_sm) && trim($settings->text_content_padding_sm)) ? 'padding:'.$settings->text_content_padding_sm.';' : '';
		$text_cont_style_xs .= (isset($settings->text_content_padding_xs) && trim($settings->text_content_padding_xs)) ? 'padding:'.$settings->text_content_padding_xs.';' : '';

		$text_cont_style .= (isset($settings->text_content_letterspace) && $settings->text_content_letterspace) ? 'letter-spacing:'.$settings->text_content_letterspace.';' : '';
		
		$text_content_font_style = (isset($settings->text_content_font_style) && $settings->text_content_font_style) ? $settings->text_content_font_style : '';
		if(isset($text_content_font_style->underline) && $text_content_font_style->underline){
			$text_cont_style .= 'text-decoration:underline;';
		}
		if(isset($text_content_font_style->italic) && $text_content_font_style->italic){
			$text_cont_style .= 'font-style:italic;';
		}
		if(isset($text_content_font_style->uppercase) && $text_content_font_style->uppercase){
			$text_cont_style .= 'text-transform:uppercase;';
		}
		if(isset($text_content_font_style->weight) && $text_content_font_style->weight){
			$text_cont_style .= 'font-weight:'.$text_content_font_style->weight.';';
		}

		if($text_cont_style){
			$css .= $addon_id.' .sppb-addon-image-layout-text {';
				$css .= $text_cont_style;
			$css .= '}';
		}
		
		//Content wrapper style
		$wrapper_color_type = (isset($settings->wrapper_color_type) && $settings->wrapper_color_type) ? $settings->wrapper_color_type : '';
		$wrapper_style = '';
		$wrapper_style_sm = '';
		$wrapper_style_xs = '';
		if($wrapper_color_type === 'color'){
			$wrapper_style .= (isset($settings->wrapper_background) && $settings->wrapper_background) ? 'background:'.$settings->wrapper_background.';' : '';
		} else {
			$wrapper_gradient_color1 = (isset($settings->wrapper_gradient->color) && $settings->wrapper_gradient->color) ? $settings->wrapper_gradient->color : 'rgba(38, 51, 159, 0.95)';
			$wrapper_gradient_color2 = (isset($settings->wrapper_gradient->color2) && $settings->wrapper_gradient->color2) ? $settings->wrapper_gradient->color2 : 'rgba(61, 59, 136, 0.95)';
			$wrapper_degree = (isset($settings->wrapper_gradient->deg) && $settings->wrapper_gradient->deg) ? $settings->wrapper_gradient->deg : '225';
			$wrapper_type = (isset($settings->wrapper_gradient->type) && $settings->wrapper_gradient->type) ? $settings->wrapper_gradient->type : 'linear';
			$wrapper_radialPos = (isset($settings->wrapper_gradient->radialPos) && $settings->wrapper_gradient->radialPos) ? $settings->wrapper_gradient->radialPos : 'Center Center';
			$wrapper_radial_angle1 = (isset($settings->wrapper_gradient->pos) && $settings->wrapper_gradient->pos) ? $settings->wrapper_gradient->pos : '0';
			$wrapper_radial_angle2 = (isset($settings->wrapper_gradient->pos2) && $settings->wrapper_gradient->pos2) ? $settings->wrapper_gradient->pos2 : '100';
			
			if($wrapper_type!=='radial'){
				$wrapper_style .= 'background: -webkit-linear-gradient('.$wrapper_degree.'deg, '.$wrapper_gradient_color1.' '.$wrapper_radial_angle1.'%, '.$wrapper_gradient_color2.' '.$wrapper_radial_angle2.'%) transparent;';
				$wrapper_style .= 'background: linear-gradient('.$wrapper_degree.'deg, '.$wrapper_gradient_color1.' '.$wrapper_radial_angle1.'%, '.$wrapper_gradient_color2.' '.$wrapper_radial_angle2.'%) transparent;';
			} else {
				$wrapper_style .= 'background: -webkit-radial-gradient(at '.$wrapper_radialPos.', '.$wrapper_gradient_color1.' '.$wrapper_radial_angle1.'%, '.$wrapper_gradient_color2.' '.$wrapper_radial_angle2.'%) transparent;';
				$wrapper_style .= 'background: radial-gradient(at '.$wrapper_radialPos.', '.$wrapper_gradient_color1.' '.$wrapper_radial_angle1.'%, '.$wrapper_gradient_color2.' '.$wrapper_radial_angle2.'%) transparent;';
			}
		}
		if($image_preset_thumb === 'poster'){
			$wrapper_style .= (isset($settings->wrapper_margin) && trim($settings->wrapper_margin)) ? 'margin:'.$settings->wrapper_margin.';' : '';
			$wrapper_style_sm .= (isset($settings->wrapper_margin_sm) && trim($settings->wrapper_margin_sm)) ? 'margin:'.$settings->wrapper_margin_sm.';' : '';
			$wrapper_style_xs .= (isset($settings->wrapper_margin_xs) && trim($settings->wrapper_margin_xs)) ? 'margin:'.$settings->wrapper_margin_xs.';' : '';
		}
		$wrapper_style .= (isset($settings->wrapper_padding) && trim($settings->wrapper_padding)) ? 'padding:'.$settings->wrapper_padding.';' : '';
		$wrapper_style_sm .= (isset($settings->wrapper_padding_sm) && trim($settings->wrapper_padding_sm)) ? 'padding:'.$settings->wrapper_padding_sm.';' : '';
		$wrapper_style_xs .= (isset($settings->wrapper_padding_xs) && trim($settings->wrapper_padding_xs)) ? 'padding:'.$settings->wrapper_padding_xs.';' : '';
		$wrapper_style .= (isset($settings->wrapper_border) && trim($settings->wrapper_border)) ? 'border-width:'.$settings->wrapper_border.';border-style:solid;' : '';
		$wrapper_style .= (isset($settings->wrapper_border_color) && $settings->wrapper_border_color) ? 'border-color:'.$settings->wrapper_border_color.';' : '';
		$wrapper_style .= (isset($settings->wrapper_border_radius) && $settings->wrapper_border_radius) ? 'border-radius:'.$settings->wrapper_border_radius.'px;' : '';
		$wrapper_box_shadow = (isset($settings->wrapper_box_shadow) && $settings->wrapper_box_shadow) ? $settings->wrapper_box_shadow : '';
		if(is_object($wrapper_box_shadow)){
			$ho = (isset($wrapper_box_shadow->ho) && $wrapper_box_shadow->ho != '') ? $wrapper_box_shadow->ho.'px' : '0px';
			$vo = (isset($wrapper_box_shadow->vo) && $wrapper_box_shadow->vo != '') ? $wrapper_box_shadow->vo.'px' : '0px';
			$blur = (isset($wrapper_box_shadow->blur) && $wrapper_box_shadow->blur != '') ? $wrapper_box_shadow->blur.'px' : '0px';
			$spread = (isset($wrapper_box_shadow->spread) && $wrapper_box_shadow->spread != '') ? $wrapper_box_shadow->spread.'px' : '0px';
			$color = (isset($wrapper_box_shadow->color) && $wrapper_box_shadow->color != '') ? $wrapper_box_shadow->color : '#fff';
			$wrapper_style .= "box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};";
		}

		$css .= $addon_id . ' .sppb-addon-image-layout-content {';
			$css .= $wrapper_style;
		$css .= '}';

		$content_text_align = (isset($settings->content_text_align) && $settings->content_text_align) ? $settings->content_text_align : '';

		if($content_text_align){
			$css .= $addon_id . ' .sppb-text-alignment {';
				if($content_text_align == 'left'){
					$css .= 'text-align: left;';
				} elseif( $content_text_align == 'right' ){
					$css .= 'text-align: right;';
				} elseif( $content_text_align == 'center' ){
					$css .= 'text-align: center;';
				}
			$css .= '}';
		}

		//Button style
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
        $css_path = new JLayoutFile('addon.css.button', $layout_path);
        $options = new stdClass;
        $options->button_type = (isset($settings->btn_type) && $settings->btn_type) ? $settings->btn_type : '';
        $options->button_appearance = (isset($settings->btn_appearance) && $settings->btn_appearance) ? $settings->btn_appearance : '';
        $options->button_color = (isset($settings->btn_color) && $settings->btn_color) ? $settings->btn_color : '';
        $options->button_color_hover = (isset($settings->btn_color_hover) && $settings->btn_color_hover) ? $settings->btn_color_hover : '';
        $options->button_background_color = (isset($settings->btn_background_color) && $settings->btn_background_color) ? $settings->btn_background_color : '';
        $options->button_background_color_hover = (isset($settings->btn_background_color_hover) && $settings->btn_background_color_hover) ? $settings->btn_background_color_hover : '';
        $options->button_fontstyle = (isset($settings->btn_fontstyle) && $settings->btn_fontstyle) ? $settings->btn_fontstyle : '';
        $options->button_font_style = (isset($settings->btn_font_style) && $settings->btn_font_style) ? $settings->btn_font_style : '';
        $options->button_padding = (isset($settings->button_padding) && trim($settings->button_padding)) ? $settings->button_padding : '';
        $options->button_padding_sm = (isset($settings->button_padding_sm) && trim($settings->button_padding_sm)) ? $settings->button_padding_sm : '';
        $options->button_padding_xs = (isset($settings->button_padding_xs) && trim($settings->button_padding_xs)) ? $settings->button_padding_xs : '';
        $options->fontsize = (isset($settings->btn_fontsize) && $settings->btn_fontsize) ? $settings->btn_fontsize : '';
        $options->fontsize_sm = (isset($settings->btn_fontsize_sm) && $settings->btn_fontsize_sm) ? $settings->btn_fontsize_sm : '';
        $options->fontsize_xs = (isset($settings->btn_fontsize_xs) && $settings->btn_fontsize_xs) ? $settings->btn_fontsize_xs : '';
        $options->button_letterspace = (isset($settings->btn_letterspace) && $settings->btn_letterspace) ? $settings->btn_letterspace : '';
        $options->button_background_gradient = (isset($settings->btn_background_gradient) && $settings->btn_background_gradient) ? $settings->btn_background_gradient : new stdClass();
		$options->button_background_gradient_hover = (isset($settings->btn_background_gradient_hover) && $settings->btn_background_gradient_hover) ? $settings->btn_background_gradient_hover : new stdClass();

		//Button Margin
		$button_margin = (isset($settings->button_margin) && trim($settings->button_margin)) ? $settings->button_margin : '';
        $button_margin_sm = ((isset($settings->button_margin_sm)) && trim($settings->button_margin_sm)) ? $settings->button_margin_sm : '';
		$button_margin_xs = ((isset($settings->button_margin_xs)) && trim($settings->button_margin_xs)) ? $settings->button_margin_xs : '';
		
		if ($button_margin) {
            $css .= $addon_id . ' .sppb-addon-image-layout-content .sppb-btn {';
            $css .= 'margin: ' . $button_margin . ';';
            $css .= '}';
		}

		$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $options, 'id' => 'btn-' . $this->addon->id));

		//Responsive style
		//Tablet
		
		$content_text_align_sm = (isset($settings->content_text_align_sm) && $settings->content_text_align_sm) ? $settings->content_text_align_sm : '';

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($content_text_align_sm){
				$css .= $addon_id . ' .sppb-text-alignment {';
					if($content_text_align_sm == 'left'){
						$css .= 'text-align: left;';
					} elseif( $content_text_align_sm == 'right' ){
						$css .= 'text-align: right;';
					} elseif( $content_text_align_sm == 'center' ){
						$css .= 'text-align: center;';
					}
				$css .= '}';
			}

			if($title_style_sm){
				$css .= $addon_id.' .sppb-image-layout-title {';
					$css .= $title_style_sm;
				$css .= '}';
			}

			if($text_cont_style_sm){
				$css .= $addon_id.' .sppb-addon-image-layout-text {';
					$css .= $text_cont_style_sm;
				$css .= '}';
			}

			if ($button_margin_sm) {
				$css .= $addon_id . ' .sppb-addon-image-layout-content .sppb-btn {';
				$css .= 'margin: ' . $button_margin_sm . ';';
				$css .= '}';
			}
			if($wrapper_style_sm){
				$css .= $addon_id . ' .sppb-addon-image-layout-content {';
					$css .= $wrapper_style_sm;
				$css .= '}';
			}
		$css .= '}';

		//Mobile responsive
		//Content syle
		$content_text_align_xs = (isset($settings->content_text_align_xs) && $settings->content_text_align_xs) ? $settings->content_text_align_xs : '';

		$css .= '@media (max-width: 767px) {';
			if($content_text_align_xs){
				$css .= $addon_id . ' .sppb-text-alignment {';
					if($content_text_align_xs == 'left'){
						$css .= 'text-align: left;';
					} elseif( $content_text_align_xs == 'right' ){
						$css .= 'text-align: right;';
					} elseif( $content_text_align_xs == 'center' ){
						$css .= 'text-align: center;';
					}
				$css .= '}';
			}

			if($title_style_xs){
				$css .= $addon_id.' .sppb-image-layout-title {';
					$css .= $title_style_xs;
				$css .= '}';
			}

			if($text_cont_style_xs){
				$css .= $addon_id.' .sppb-addon-image-layout-text {';
					$css .= $text_cont_style_xs;
				$css .= '}';
			}

			if ($button_margin_xs) {
				$css .= $addon_id . ' .sppb-addon-image-layout-content .sppb-btn {';
				$css .= 'margin: ' . $button_margin_xs . ';';
				$css .= '}';
			}
			if($wrapper_style_xs){
				$css .= $addon_id . ' .sppb-addon-image-layout-content {';
					$css .= $wrapper_style_xs;
				$css .= '}';
			}

		$css .= '}';
		
		return $css;
	}

	public static function getTemplate() {
		$output = '
		<# 
			var modern_font_style = false;
			var classList = "";
			classList += " sppb-btn-"+data.btn_type;
			classList += " sppb-btn-"+data.btn_size;
			classList += " sppb-btn-"+data.btn_shape;
			if(!_.isEmpty(data.btn_appearance)){
				classList += " sppb-btn-"+data.btn_appearance;
			}

			var button_fontstyle = data.btn_font_style || "";
			var button_font_style = data.btn_font_style || "";
		#>
		<style type="text/css">
			<# if(data.image_border_radius) { #>
				#sppb-addon-{{ data.id }} .sppb-addon-image-layout-image .sppb-img-responsive {
					border-radius: {{data.image_border_radius}}px;
				}
				#sppb-addon-{{ data.id }} .sppb-image-layouts-inline-img .sppb-img-responsive {
					border-radius: {{data.image_border_radius}}px;
				}
				#sppb-addon-{{ data.id }} .sppb-addon-image-overlay {
					border-radius: {{data.image_border_radius}}px;
				}
			<# } #>

			#sppb-addon-{{ data.id }} .sppb-addon-image-overlay {
				background-color:{{data.image_overlay_color}};
			}

			#sppb-addon-{{ data.id }} .sppb-addon-image-overlay-icon {
				background:{{data.lightbox_icon_bg}};
			}

			#sppb-addon-{{ data.id }} .sppb-addon-image-layout-caption {
				color:{{data.caption_text_color}};
				background:{{data.caption_background}};
				letter-spacing:{{data.caption_letterspace}};

				<# if(_.isObject(data.caption_fontsize)){ #>
					font-size:{{data.caption_fontsize.md}}px;
				<# } else { #>
					font-size:{{data.caption_fontsize}}px;
				<# }
				if(_.isObject(data.caption_lineheight)){
				#>
					line-height:{{data.caption_lineheight.md}}px;
				<# } else { #>
					line-height:{{data.caption_lineheight}}px;
				<# }
				if(_.isObject(data.caption_padding)){
				#>
					padding:{{data.caption_padding.md}};
				<# } else { #>
					padding:{{data.caption_padding}};
				<# }
				if(_.isObject(data.caption_font_style)){
					if(data.caption_font_style.underline){
				#>
						text-decoration:underline;
					<# }
					if(data.caption_font_style.italic){
					#>
						font-style:italic;
					<# }
					if(data.caption_font_style.uppercase){
					#>
						text-transform:uppercase;
					<# }
					if(data.caption_font_style.weight){
					#>
						font-weight:{{data.caption_font_style.weight}};
					<# }
				} #>
			}

			<# if(data.image_preset_thumb !== "overlap"){ #>
				#sppb-addon-{{ data.id }} .sppb-image-layout-title {
					<# if(_.isObject(data.title_margin)){ #>
						margin:{{data.title_margin.md}};
					<# } else { #>
						margin:{{data.title_margin}};
					<# }
					if(_.isObject(data.title_padding)){ #>
						padding:{{data.title_padding.md}};
					<# } else { #>
						padding:{{data.title_padding}};
					<# }
					if(_.isObject(data.title_lineheight)){ #>
						line-height:{{data.title_lineheight.md}}px;
					<# } else { #>
						line-height:{{data.title_lineheight}}px;
					<# } #>
				}
			<# }
			if(data.image_preset_thumb === "overlap"){
			#>
				#sppb-addon-{{ data.id }} .sppb-image-layout-title {
					background:{{data.title_background}};
					box-shadow: 12px 0 0 {{data.title_background}}, -12px 0 0 {{data.title_background}};
				}
			<# } #>

			#sppb-addon-{{ data.id }} .sppb-image-layout-title {
				color:{{data.title_text_color}};
				<# if(_.isObject(data.title_fontsize)){ #>
					font-size:{{data.title_fontsize.md}}px;
				<# } else { #>
					font-size:{{data.title_fontsize}}px;
				<# } #>
				letter-spacing:{{data.title_letterspace}};
				<# if(_.isObject(data.title_font_style)){
					if(data.title_font_style.underline){
				#>
						text-decoration:underline;
					<# }
					if(data.title_font_style.italic){
					#>
						font-style:italic;
					<# }
					if(data.title_font_style.uppercase){
					#>
						text-transform:uppercase;
					<# }
					if(data.title_font_style.weight){
					#>
						font-weight:{{data.title_font_style.weight}};
					<# }
				} #>
			}

			#sppb-addon-{{ data.id }} .sppb-addon-image-layout-text {
				color:{{data.text_content_color}};
				<# if(_.isObject(data.text_content_fontsize)){ #>
					font-size:{{data.text_content_fontsize.md}}px;
				<# } else { #>
					font-size:{{data.text_content_fontsize}}px;
				<# }
				if(_.isObject(data.text_content_lineheight)){
				#>
					line-height:{{data.text_content_lineheight.md}}px;
				<# } else { #>
					line-height:{{data.text_content_lineheight}}px;
				<# }
				if(_.isObject(data.text_content_margin)){
				#>
					margin:{{data.text_content_margin.md}};
				<# } else { #>
					margin:{{data.text_content_margin}};
				<# }
				if(_.isObject(data.text_content_padding)){
				#>
					padding:{{data.text_content_padding.md}};
				<# } else { #>
					padding:{{data.text_content_padding}};
				<# } #>
				
				letter-spacing:{{data.text_content_letterspace}};

				<# if(_.isObject(data.text_content_font_style)){
					if(data.text_content_font_style.underline){
				#>
						text-decoration:underline;
					<# }
					if(data.text_content_font_style.italic){
					#>
						font-style:italic;
					<# }
					if(data.text_content_font_style.uppercase){
					#>
						text-transform:uppercase;
					<# }
					if(data.text_content_font_style.weight){
					#>
						font-weight:{{data.text_content_font_style.weight}};
					<# }
				} #>
			}
			
			<# if(data.image_preset_thumb === "poster"){ #>
				#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content {
					<# if(_.isObject(data.wrapper_margin)){ #>
						margin:{{data.wrapper_margin.md}};
					<# } else { #>
						margin:{{data.wrapper_margin}};
					<# } #>
				}
			<# } #>

			#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content {
				<#
					let gradient_color1 = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.color) ? data.wrapper_gradient.color : "rgba(38, 51, 159, 0.95)";
					let gradient_color2 = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.color2) ? data.wrapper_gradient.color2 : "rgba(61, 59, 136, 0.95)";
					let degree = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.deg) ? data.wrapper_gradient.deg : "45";
					let type = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.type) ? data.wrapper_gradient.type : "linear";
					let radialPos = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.radialPos) ? data.wrapper_gradient.radialPos : "Center Center";
					let radial_angle1 = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.pos) ? data.wrapper_gradient.pos : "0";
					let radial_angle2 = (typeof data.wrapper_gradient !== "undefined" && data.wrapper_gradient.pos2) ? data.wrapper_gradient.pos2 : "100";
					if(data.wrapper_color_type !== "color") {
					if(type!=="radial"){
				#>
					background: -webkit-linear-gradient({{degree}}deg, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
					background: linear-gradient({{degree}}deg, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
				<# } else { #>
					background: -webkit-radial-gradient(at {{radialPos}}, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
					background: radial-gradient(at {{radialPos}}, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
				<# } 
				} else { 
				#>
					background:{{data.wrapper_background}};
				<# } #>

				<# if(_.isObject(data.wrapper_padding)){ #>
					padding:{{data.wrapper_padding.md}};
				<# } else { #>
					padding:{{data.wrapper_padding}};
				<# } #>
				border-width:{{data.wrapper_border}};
				<# if(_.trim(data.wrapper_border)){ #>
					border-style:solid;
				<# } #>
				border-color:{{data.wrapper_border_color}};
				border-radius:{{data.wrapper_border_radius}}px;

				<# if(_.isObject(data.wrapper_box_shadow)){ 
					let ho = data.wrapper_box_shadow.ho || 0,
						vo = data.wrapper_box_shadow.vo || 0,
						blur = data.wrapper_box_shadow.blur || 0,
						spread = data.wrapper_box_shadow.spread || 0,
						color = data.wrapper_box_shadow.color || 0;
				#>
					box-shadow: {{ho}}px {{vo}}px {{blur}}px {{spread}}px {{color}};
				<# } #>
			}

			<# if(_.isObject(data.content_text_align)){ #>
				#sppb-addon-{{ data.id }} .sppb-text-alignment {
					<# if(data.content_text_align.md == "left"){ #>
						text-align: left;
					<# } else if( data.content_text_align.md == "right" ){ #>
						text-align: right;
					<# } else if( data.content_text_align.md == "center" ){ #>
						text-align: center;
					<# } #>
				}
			<# } else { #>
				#sppb-addon-{{ data.id }} .sppb-text-alignment {
					<# if(data.content_text_align == "left"){ #>
						text-align: left;
					<# } else if( data.content_text_align == "right" ){ #>
						text-align: right;
					<# } else if( data.content_text_align == "center" ){ #>
						text-align: center;
					<# } #>
				}
			<# } #>

			#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content .sppb-btn {
				<# if(_.isObject(data.button_margin)) { #>
					margin: {{data.button_margin.md}};
				<# } else { #>
					margin: {{data.button_margin}};
				<# } #>
			}

			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.type }}{
				letter-spacing: {{ data.btn_letterspace }};

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

			<# if(data.btn_type == "custom"){ #>
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					<# if(_.isObject(data.btn_fontsize)){ #>
						font-size: {{data.btn_fontsize.md}}px;
					<# } else { #>
						font-size: {{data.btn_fontsize}}px;
					<# } #>
					color: {{ data.btn_color }};
					<# if(_.isObject(data.button_padding)) { #>
						padding: {{ data.button_padding.md }};
					<# } else { #>
						padding: {{ data.button_padding }};
					<# } #>
					<# if(data.btn_appearance == "outline"){ #>
						border-color: {{ data.btn_background_color }};
						background-color: transparent;
					<# } else if(data.btn_appearance == "3d"){ #>
						border-bottom-color: {{ data.btn_background_color_hover }};
						background-color: {{ data.btn_background_color }};
					<# } else if(data.btn_appearance == "gradient"){ #>
						border: none;
						<# if(typeof data.btn_background_gradient.type !== "undefined" && data.btn_background_gradient.type == "radial"){ #>
							background-image: radial-gradient(at {{ data.btn_background_gradient.radialPos || "center center"}}, {{ data.btn_background_gradient.color }} {{ data.btn_background_gradient.pos || 0 }}%, {{ data.btn_background_gradient.color2 }} {{ data.btn_background_gradient.pos2 || 100 }}%);
						<# } else { #>
							background-image: linear-gradient({{ data.btn_background_gradient.deg || 0}}deg, {{ data.btn_background_gradient.color }} {{ data.btn_background_gradient.pos || 0 }}%, {{ data.btn_background_gradient.color2 }} {{ data.btn_background_gradient.pos2 || 100 }}%);
						<# } #>
					<# } else { #>
						background-color: {{ data.btn_background_color }};
					<# } #>
				}

				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom:hover{
					color: {{ data.btn_color_hover }};
					background-color: {{ data.btn_background_color_hover }};
					<# if(data.btn_appearance == "outline"){ #>
						border-color: {{ data.btn_background_color_hover }};
					<# } else if(data.btn_appearance == "gradient"){ #>
						<# if(typeof data.btn_background_gradient_hover.type !== "undefined" && data.btn_background_gradient_hover.type == "radial"){ #>
							background-image: radial-gradient(at {{ data.btn_background_gradient_hover.radialPos || "center center"}}, {{ data.btn_background_gradient_hover.color }} {{ data.btn_background_gradient_hover.pos || 0 }}%, {{ data.btn_background_gradient_hover.color2 }} {{ data.btn_background_gradient_hover.pos2 || 100 }}%);
						<# } else { #>
							background-image: linear-gradient({{ data.btn_background_gradient_hover.deg || 0}}deg, {{ data.btn_background_gradient_hover.color }} {{ data.btn_background_gradient_hover.pos || 0 }}%, {{ data.btn_background_gradient_hover.color2 }} {{ data.btn_background_gradient_hover.pos2 || 100 }}%);
						<# } #>
					<# } #>
				}
				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
						<# if(_.isObject(data.btn_fontsize)){ #>
							font-size: {{data.btn_fontsize.sm}}px;
						<# } #>
						<# if(_.isObject(data.button_padding)) { #>
							padding: {{ data.button_padding.sm }};
						<# } #>
					}
				}
				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
						<# if(_.isObject(data.btn_fontsize)){ #>
							font-size: {{data.btn_fontsize.xs}}px;
						<# } #>
						<# if(_.isObject(data.button_padding)) { #>
							padding: {{ data.button_padding.xs }};
						<# } #>
					}
				}
			<# } #>

			@media (min-width: 768px) and (max-width: 991px) {
				<# if(_.isObject(data.content_text_align)){ #>
					#sppb-addon-{{ data.id }} .sppb-text-alignment {
						<# if(data.content_text_align.sm == "left"){ #>
							text-align: left;
						<# } else if( data.content_text_align.sm == "right" ){ #>
							text-align: right;
						<# } else if( data.content_text_align.sm == "center" ){ #>
							text-align: center;
						<# } #>
					}
				<# } #>

				#sppb-addon-{{ data.id }} .sppb-image-layout-title {
					<# if(_.isObject(data.title_fontsize)) { #>
						font-size:{{data.title_fontsize.sm}}px;
					<# }
					if(_.isObject(data.title_margin)) {
					#>
						margin:{{data.title_margin.sm}};
					<# }
					if(_.isObject(data.title_padding)) {
					#>
						padding:{{data.title_padding.sm}};
					<# }
					if(_.isObject(data.title_lineheight)) {
					#>
						line-height:{{data.title_lineheight.sm}}px;
					<# } #>
				}

				#sppb-addon-{{ data.id }} .sppb-addon-image-layout-text {
					<# if(_.isObject(data.text_content_lineheight)) { #>
						line-height:{{data.text_content_lineheight.sm}}px;
					<# }
					if(_.isObject(data.text_content_fontsize)) { #>
						font-size:{{data.text_content_fontsize.sm}}px;
					<# }
					if(_.isObject(data.text_content_margin)) { #>
						margin:{{data.text_content_margin.sm}};
					<# }
					if(_.isObject(data.text_content_padding)) { #>
						padding:{{data.text_content_padding.sm}};
					<# } #>
				}

				<# if(_.isObject(data.button_margin)) { #>
					#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content .sppb-btn {
						margin: {{data.button_margin.sm}};
					}
				<# } #>

				<# if(data.image_preset_thumb === "poster"){ #>
					#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content {
						<# if(_.isObject(data.wrapper_margin)){ #>
							margin:{{data.wrapper_margin.sm}};
						<# } #>
					}
				<# } #>
				#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content {
					<# if(_.isObject(data.wrapper_padding)){ #>
						padding:{{data.wrapper_padding.sm}};
					<# } #>
				}

			}

			@media (max-width: 767px) {
				<# if(_.isObject(data.content_text_align)){ #>
					#sppb-addon-{{ data.id }} .sppb-text-alignment {
						<# if(data.content_text_align.xs == "left"){ #>
							text-align: left;
						<# } else if( data.content_text_align.xs == "right" ){ #>
							text-align: right;
						<# } else if( data.content_text_align.xs == "center" ){ #>
							text-align: center;
						<# } #>
					}
				<# } #>

				#sppb-addon-{{ data.id }} .sppb-image-layout-title {
					<# if(_.isObject(data.title_fontsize)) { #>
						font-size:{{data.title_fontsize.xs}}px;
					<# } 
					if(_.isObject(data.title_margin)){ 
					#>
						margin:{{data.title_margin.xs}};
					<# } 
					if(_.isObject(data.title_padding)) {
					#>
						padding:{{data.title_padding.xs}};
					<# } 
					if(_.isObject(data.title_lineheight)) {
					#>
						line-height:{{data.title_lineheight.xs}}px;
					<# } #>
				}

				#sppb-addon-{{ data.id }} .sppb-addon-image-layout-text {
					<# if(_.isObject(data.text_content_lineheight)) { #>
						line-height:{{data.text_content_lineheight.xs}}px;
					<# }
					if(_.isObject(data.text_content_fontsize)) { #>
						font-size:{{data.text_content_fontsize.xs}}px;
					<# }
					if(_.isObject(data.text_content_margin)) { #>
						margin:{{data.text_content_margin.xs}};
					<# }
					if(_.isObject(data.text_content_padding)) { #>
						padding:{{data.text_content_padding.xs}};
					<# } #>
				}

				<# if(_.isObject(data.button_margin)) { #>
					#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content .sppb-btn {
						margin: {{data.button_margin.xs}};
					}
				<# } #>

				<# if(data.image_preset_thumb === "poster"){ #>
					#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content {
						<# if(_.isObject(data.wrapper_margin)){ #>
							margin:{{data.wrapper_margin.xs}};
						<# } #>
					}
				<# } #>
				#sppb-addon-{{ data.id }} .sppb-addon-image-layout-content {
					<# if(_.isObject(data.wrapper_padding)){ #>
						padding:{{data.wrapper_padding.xs}};
					<# } #>
				}

			}
		</style>

		<#

		let image_preset_thumb = (!_.isEmpty(data.image_preset_thumb) && data.image_preset_thumb) ? data.image_preset_thumb : "inline";
		let image_strech = (typeof data.image_strech !== undefined && data.image_strech) ? " image-fit" : "";
		
		let target = "";
		if(data.url_in_new_window){
			target = `target="_blank"`;
		}
		
		let content_text_align = (!_.isEmpty(data.content_text_align) && data.content_text_align) ?" sppb-text-alignment" : "";
		let content_vertical_align = (!_.isEmpty(data.content_vertical_align) && data.content_vertical_align) ? data.content_vertical_align : "";

		let image_desktop_order = (!_.isEmpty(data.image_desktop_order) && data.image_desktop_order != "") ? parseInt(data.image_desktop_order) : "";
		let image_tab_order = (!_.isEmpty(data.image_tab_order) && data.image_tab_order != "") ? parseInt(data.image_tab_order): "";
		let image_mob_order = (!_.isEmpty(data.image_mob_order) && data.image_mob_order != "") ? parseInt(data.image_mob_order): "";
		
		let order_class = "";
		if(image_desktop_order && image_preset_thumb !=="poster"){
			order_class +=" sppb-order-md-"+image_desktop_order;
		}
		if(image_tab_order && image_preset_thumb !=="poster"){
			order_class +=" sppb-order-sm-"+image_tab_order;
		}
		if(image_mob_order && image_preset_thumb !=="poster"){
			order_class +=" sppb-order-xs-"+image_mob_order;
		}

		let content_desktop_order = (!_.isEmpty(data.content_desktop_order) && data.content_desktop_order !="") ? parseInt(data.content_desktop_order) : "";
		let content_tab_order = (!_.isEmpty(data.content_tab_order) && data.content_tab_order !="") ? parseInt(data.content_tab_order) : "";
		let content_mob_order = (!_.isEmpty(data.content_mob_order) && data.content_mob_order !="") ? parseInt(data.content_mob_order) : "";
		let cont_order_class ="";

		if(content_desktop_order && image_preset_thumb !=="poster"){
			cont_order_class +=" sppb-order-md-"+content_desktop_order;
		}
		if(content_tab_order && image_preset_thumb !=="poster"){
			cont_order_class +=" sppb-order-sm-"+content_tab_order;
		}
		if(content_mob_order && image_preset_thumb !=="poster"){
			cont_order_class +=" sppb-order-xs-"+content_mob_order;
		}

		let image_preset_class = "";
		if(image_preset_thumb){
			image_preset_class =" image-layout-preset-style-"+image_preset_thumb;
		}
		if(image_preset_thumb ==="poster"){
			content_text_align = "";
		}
		#>

		<div class="sppb-addon-image-layouts {{data.class}}">
		<div class="sppb-addon-content">
		<#
		var img = {}
		if (typeof data.image !== "undefined" && typeof data.image.src !== "undefined") {
			img = data.image
		} else {
			img = {src: data.image}
		}
		if(image_preset_thumb === "inline"){
		#>
			<div class="sppb-image-layouts-inline">
			<div class="sppb-image-layouts-inline-img">
			<# if(data.click_url){ #>
				<a {{{target}}} href=\'{{data.click_url}}\'>
			<# } #>

			<# if(img.src?.indexOf("http://") == -1 && img.src?.indexOf("https://") == -1){ #>
				<img class="sppb-img-responsive{{image_strech}}" src=\'{{ pagebuilder_base + img.src }}\' alt="{{data.image_alt_text}}">
			<# } else { #>
				<img class="sppb-img-responsive{{image_strech}}" src=\'{{ img.src }}\' alt="{{data.image_alt_text}}">
			<# } #>

			<# if(data.click_url){ #>
				</a>
			<# }
			
			if(data.open_in_lightbox){
				if(img.src){
			#>
					<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="image" data-mainclass="mfp-no-margins mfp-with-zoom" href="{{img.src}}">+</a>
				<# } 
				if(data.image_overlay_color) {
				#>
					<div class="sppb-addon-image-overlay">
					</div>
				<# } 
			} #>
			</div>

			<# if(data.caption && data.caption_postion !== "no-caption"){ #>
				<div class="sppb-addon-image-layout-caption sp-inline-editable-element {{data.caption_postion}}" data-id={{data.id}} data-fieldName="caption" contenteditable="true">
				{{{data.caption}}}
				</div>
			<# } #>
			</div>
		<# } else { #>
			<div class="sppb-addon-image-layout-wrap{{image_preset_class}}">
			<# if(image_preset_thumb === "card" || image_preset_thumb === "overlap" || image_preset_thumb === "collage"){ #>
				<div class="sppb-row">
				<div class="sppb-col-sm-{{(data.image_container_column ? data.image_container_column : 6)}}{{order_class}}">
			<# } #>
			
			<div class="sppb-addon-image-layout-image{{image_strech}}
			<# if(image_preset_thumb !== "card" && image_preset_thumb !== "overlap" && image_preset_thumb !== "collage"){ #>
				{{order_class}}
			<# } #>
			">

			<# if(data.click_url){ #>
				<a {{{target}}} href=\'{{data.click_url}}\'>
			<# } #>

			<# if(img.src?.indexOf("http://") == -1 && img.src?.indexOf("https://") == -1){ #>
				<img class="sppb-img-responsive{{image_strech}}" src=\'{{ pagebuilder_base + img.src }}\' alt="{{data.image_alt_text}}">
			<# } else { #>
				<img class="sppb-img-responsive{{image_strech}}" src=\'{{ img.src }}\' alt="{{data.image_alt_text}}">
			<# } #>

			<# if(data.click_url){ #>
				</a>
			<# }
			if(data.popup_video_on_image && data.image_preset_thumb === "card" && data.popup_video_src){
			#>
				<a class="sppb-magnific-popup sppb-addon-image-overlay-icon" data-popup_type="iframe" data-mainclass="mfp-no-margins mfp-with-zoom" href="{{data.popup_video_src}}"></a>
				<div class="sppb-addon-image-layouts-card-text-caption">
					<span class="image-layouts-card-text-caption-icon"><i class="fa fa-play"></i></span>
					<h4 class="image-layouts-card-text-caption-title">{{data.title.replace(/<\/?[^>]+(>|$)/g, "")}}</h4>
				</div>
			<# } #>
			</div>

			<# if(image_preset_thumb === "card" || image_preset_thumb === "overlap" || image_preset_thumb === "collage"){
				let collage_content_vertical = "";
				if(image_preset_thumb === "collage"){
					collage_content_vertical = " collage-content-vertical-"+content_vertical_align;
				}
			#>
				</div>
				<div class="sppb-col-sm-{{(data.image_container_column ? (data.image_container_column == 12 ? 12 : 12-data.image_container_column) : 6)}}{{cont_order_class}}{{collage_content_vertical}}">
			<# } #>
			<# 
				let collage_content_right = "";
				if((content_desktop_order < image_desktop_order) && image_preset_thumb === "collage") {
					collage_content_right = " collage-content-right";
				}
				let collage_content_sm_right = "";
				if((content_tab_order < image_tab_order) && image_preset_thumb === "collage") {
					collage_content_sm_right = " collage-content-sm-right";
				}
			#>
			<div class="sppb-addon-image-layout-content{{content_text_align}}{{collage_content_right}}{{collage_content_sm_right}} <# if(image_preset_thumb !== "card" && image_preset_thumb !== "overlap" && image_preset_thumb !== "collage") { #>{{cont_order_class}}<# } #>
			">
			<# if(data.title){
				let heading_selector = data.heading_selector || "h3";
				if(image_preset_thumb === "overlap"){
					let title_align_right = "";
					let title_align_sm_right = "";
					if(content_desktop_order < image_desktop_order){
						title_align_right = " title-align-right";
					}

					if(content_tab_order < image_tab_order) {
						title_align_sm_right = " title-align-sm-right";
					}
			#>
					<div class="image-layout-tittle-wrap{{title_align_right}}{{title_align_sm_right}}">
				<# } #>
					<{{heading_selector}} class="sppb-image-layout-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">
					<# if(data.link_apear_in_title && image_preset_thumb === "poster") { #>
						<# if(data.click_url){ #>
							<a {{{target}}} href=\'{{data.click_url}}\'>
						<# } #>
					<# } #>

						{{{data.title}}}

					<# if(data.link_apear_in_title && image_preset_thumb === "poster") { #>
						<# if(data.click_url){ #>
							</a>
						<# } #>
					<# } #>
					</{{heading_selector}}>
				<# if(image_preset_thumb === "overlap"){ #>
					</div>
				<# } #>
			<# }
			if(data.text_content){
			#>
				<div class="sppb-addon-image-layout-text sp-editable-content" data-id={{data.id}} data-fieldName="text_content">
					{{{data.text_content}}}
				</div>
			<# }
			if(data.btn_text && _.trim(data.btn_text)){
				let icon_arr = (typeof data.btn_icon !== "undefined" && data.btn_icon) ? data.btn_icon.split(" ") : "";
				let icon_name = icon_arr.length === 1 ? "fa "+data.btn_icon : data.btn_icon;
			#>
				<a href=\'{{ data.url }}\' id="btn-{{ data.id }}" target="{{ data.target }}" class="sppb-btn {{ classList }}"><# if(data.btn_icon_position == "left" && !_.isEmpty(data.btn_icon)) { #><i class="{{ icon_name }}"></i> <# } #>{{ data.btn_text }}<# if(data.btn_icon_position == "right" && !_.isEmpty(data.btn_icon)) { #> <i class="{{ icon_name }}"></i><# } #></a>
			<# } #>
			</div>

			<# if(image_preset_thumb === "card" || image_preset_thumb === "overlap" || image_preset_thumb === "collage"){ #>
				</div>
				</div>
			<# } #>
			</div>
		<# } #>
		
		</div>
		</div>';

		return $output;
	}

}