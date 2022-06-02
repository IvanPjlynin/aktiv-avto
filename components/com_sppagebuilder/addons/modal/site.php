<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonModal extends SppagebuilderAddons{

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
        
		//Options
		$modal_selector = (isset($settings->modal_selector) && $settings->modal_selector) ? $settings->modal_selector : '';
		$button_text = (isset($settings->button_text) && $settings->button_text) ? $settings->button_text : '';
		$button_class = (isset($settings->button_type) && $settings->button_type) ? ' sppb-btn-' . $settings->button_type : ' sppb-btn-default';
		$button_class .= (isset($settings->button_size) && $settings->button_size) ? ' sppb-btn-' . $settings->button_size : '';
		$button_class .= (isset($settings->button_shape) && $settings->button_shape) ? ' sppb-btn-' . $settings->button_shape: ' sppb-btn-rounded';
		$button_class .= (isset($settings->button_appearance) && $settings->button_appearance) ? ' sppb-btn-' . $settings->button_appearance : '';
		$button_class .= (isset($settings->button_block) && $settings->button_block) ? ' ' . $settings->button_block : '';
		$button_icon = (isset($settings->button_icon) && $settings->button_icon) ? $settings->button_icon : '';
		$button_icon_position = (isset($settings->button_icon_position) && $settings->button_icon_position) ? $settings->button_icon_position: 'left';

		$icon_arr = array_filter(explode(' ', $button_icon));
		if (count($icon_arr) === 1) {
			$button_icon = 'fa ' . $button_icon;
		}

		if($button_icon_position == 'left') {
			$button_text = ($button_icon) ? '<i class="' . $button_icon . '" aria-hidden="true"></i> ' . $button_text : $button_text;
		} else {
			$button_text = ($button_icon) ? $button_text . ' <i class="' . $button_icon . '" aria-hidden="true"></i>' : $button_text;
		}

		$selector_image = (isset($settings->selector_image) && $settings->selector_image) ? $settings->selector_image : '';
		$selector_image_src = isset($selector_image->src) ? $selector_image->src : $selector_image;
		$selector_image_width = (isset($selector_image->width) && $selector_image->width) ? $selector_image->width : '';
		$selector_image_height = (isset($selector_image->height) && $selector_image->height) ? $selector_image->height : '';

		$selector_icon_name = (isset($settings->selector_icon_name) && $settings->selector_icon_name) ? $settings->selector_icon_name : '';
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$modal_unique_id = 'sppb-modal-' . $this->addon->id;
		$modal_content_type = (isset($settings->modal_content_type) && $settings->modal_content_type) ? $settings->modal_content_type : 'text';
		$modal_content_text = (isset($settings->modal_content_text) && $settings->modal_content_text) ? $settings->modal_content_text : '';
		$modal_content_image = (isset($settings->modal_content_image) && $settings->modal_content_image) ? $settings->modal_content_image : '';
		$modal_content_image_src = isset($modal_content_image->src) ? $modal_content_image->src : $modal_content_image;
		$modal_content_video_url = (isset($settings->modal_content_video_url) && $settings->modal_content_video_url) ? $settings->modal_content_video_url : '';
		$selector_text = (isset($settings->selector_text) && $settings->selector_text) ? $settings->selector_text : '';
		$show_ripple_effect = (isset($settings->show_ripple_effect) && $settings->show_ripple_effect) ? $settings->show_ripple_effect : '';

		if ( $modal_content_type == 'text' ) {
			$mfg_type = 'inline';
		} else if ( $modal_content_type == 'video' ) {
			$mfg_type = 'iframe';
		} else if ( $modal_content_type == 'image' ) {
			$mfg_type = 'image';
		}

		$output = '';

		if($modal_content_type == 'text') {
			$url = '#' . $modal_unique_id;
			$output .= '<div id="' . $modal_unique_id . '" class="mfp-hide white-popup-block">';
				$output .= '<div class="modal-inner-block">';
					$output .= $modal_content_text;
				$output .= '</div>';
			$output .= '</div>';
			$attribs = 'data-popup_type="inline" data-mainclass="mfp-no-margins mfp-with-zoom"';
		} else if( $modal_content_type == 'video') {
			$url = $modal_content_video_url;
			$attribs = 'data-popup_type="iframe" data-mainclass="mfp-no-margins mfp-with-zoom"';
		} else {
			$url_part_of_content = explode('/', $modal_content_image_src);
			$alt_for_content = end($url_part_of_content);
			$url = '#' . $modal_unique_id;
			$output .= '<div id="' . $modal_unique_id . '" class="mfp-hide popup-image-block">';
				$output .= '<div class="modal-inner-block">';
				$output .= '<img class="mfp-img" src="'.$modal_content_image_src.'" alt="'. $alt_for_content .'">';
				$output .= '</div>';
			$output .= '</div>';
			$attribs = 'data-popup_type="inline" data-mainclass="mfp-no-margins mfp-with-zoom"';
		}

		$output .= '<div class="' . $class . ' ' . $alignment . '">';

		if($modal_selector=='image') {
			if ($selector_image_src) {
				//Lazyload image
				$placeholder = $selector_image_src == '' ? false : $this->get_image_placeholder($selector_image_src);

				$url_part_of_button = explode('/', $selector_image_src);
				if($selector_text) {
					$alt_for_button = $selector_text;
				} else {
					$alt_for_button = end($url_part_of_button);
				}
				$image_link = '';
				if(strpos($selector_image_src, "http://") !== false || strpos($selector_image_src, "https://") !== false){
					$image_link = $selector_image_src;
				} else {
					$image_link = JURI::base() . $selector_image_src;
				}
				$output .= '<a class="sppb-modal-selector sppb-magnific-popup" '. $attribs .' href="'. $url . '" id="'. $modal_unique_id .'-selector"><img '.($placeholder ? 'class="sppb-element-lazy"' : '').' src="' . ($placeholder ? $placeholder : $image_link) . '" alt="'. $alt_for_button .'" '.($placeholder ? 'data-large="'.$image_link.'"' : '').' '.($selector_image_width ? 'width="'.$selector_image_width.'"' : '').' '.($selector_image_height ? 'height="'.$selector_image_height.'"' : '').' loading="lazy">';
					$output  .= ($selector_text) ? '<span class="text">' . $selector_text . '</span>' : '';
				$output  .= '</a>';
			}
		} else if ($modal_selector=='icon') {
			if($selector_icon_name) {
				$select_icon = explode(' ', $selector_icon_name);
				if (count($select_icon) === 1) {
					$selector_icon_name = 'fa ' . $selector_icon_name;
				}
				$output  .= '<a class="sppb-modal-selector sppb-magnific-popup" href="'. $url . '" '. $attribs .' id="'. $modal_unique_id .'-selector">';
				$output  .= '<span class="sppb-modal-icon-wrap">';
				$output  .= '<i class="' . $selector_icon_name . '" aria-hidden="true"></i>';
				if($show_ripple_effect) {
					$output  .= '<span class="sppb-ripple-effect"></span>';
				}
				$output  .= '</span>';
				$output  .= ($selector_text) ? '<span class="text">' . $selector_text . '</span>' : '';
				$output  .= '</a>';
			}
		} else {
			$output .= '<a class="sppb-btn ' . $button_class . ' sppb-magnific-popup sppb-modal-selector" '. $attribs .' href="'. $url . '" id="'. $modal_unique_id .'-selector">'. $button_text .'</a>';
		}

		$output .= '</div>';

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

		$modal_content_type = (isset($settings->modal_content_type) && $settings->modal_content_type) ? $settings->modal_content_type : 'text';

		$modal_size  = (isset($settings->modal_popup_width) && $settings->modal_popup_width) ? 'max-width: ' .$settings->modal_popup_width . 'px;' : '';
		$modal_size .= (isset($settings->modal_popup_height) && $settings->modal_popup_height) ? ' height: ' . $settings->modal_popup_height . 'px;' : '';

		$selector_style	= '';
		$selector_style_sm	= '';
		$selector_style_xs	= '';

		$modal_selector = (isset($settings->modal_selector) && $settings->modal_selector) ? $settings->modal_selector : '';
		$selector_icon_name = (isset($settings->selector_icon_name) && $settings->selector_icon_name) ? $settings->selector_icon_name : '';
		$selector_image = (isset($settings->selector_image) && $settings->selector_image) ? $settings->selector_image : '';
		$selector_style	.= (isset($settings->selector_margin_top) && $settings->selector_margin_top) ? 'margin-top:' . (int) $settings->selector_margin_top .'px;' : '';
		$selector_style	.= (isset($settings->selector_margin_bottom) && $settings->selector_margin_bottom) ? 'margin-bottom:' . (int) $settings->selector_margin_bottom .'px;' : '';

		$css = '';

		if( $modal_selector == 'icon' || $modal_selector == 'image' ) {
			if($selector_icon_name || $selector_image) {
				$selector_text_style	= (isset($settings->selector_text_size) && $settings->selector_text_size) ? 'font-size:' . $settings->selector_text_size .'px;' : '';
				$selector_text_style	.= (isset($settings->selector_text_weight) && $settings->selector_text_weight) ? 'font-weight:' . $settings->selector_text_weight .';' : '';
				$selector_text_style	.= (isset($settings->selector_text_margin) && trim($settings->selector_text_margin)) ? 'margin:' . $settings->selector_text_margin .';' : '';
				$selector_text_style	.= (isset($settings->selector_text_color) && $settings->selector_text_color) ? 'color:' . $settings->selector_text_color .';' : '';

				if($selector_text_style) {
					$css .= $addon_id . ' .sppb-modal-selector span.text {';
					$css .= $selector_text_style;
					$css .= '}';
				}

				$selector_text_style_sm	= (isset($settings->selector_text_size_sm) && $settings->selector_text_size_sm) ? 'font-size:' . $settings->selector_text_size_sm .'px;' : '';
				if($selector_text_style_sm){
					$css .= '@media (min-width: 768px) and (max-width: 991px) {';
						$css .= $addon_id . ' .sppb-modal-selector span.text {';
							$css .= $selector_text_style_sm;
						$css .= '}';
					$css .= '}';
				}
				$selector_text_style_xs	= (isset($settings->selector_text_size_xs) && $settings->selector_text_size_xs) ? 'font-size:' . $settings->selector_text_size_xs .'px;' : '';
				if($selector_text_style_xs){
					$css .= '@media (max-width: 767px) {';
						$css .= $addon_id . ' .sppb-modal-selector span.text {';
							$css .= $selector_text_style_xs;
						$css .= '}';
					$css .= '}';
				}
			}
		}

		if($modal_selector == 'icon') {
			if($selector_icon_name) {
				$selector_style	.= 'display:inline-block;line-height:1;';

				$selector_style	.= (isset($settings->selector_icon_padding) && $settings->selector_icon_padding) ? 'padding:' . (int) $settings->selector_icon_padding .'px;' : '';
				$selector_style_sm	.= (isset($settings->selector_icon_padding_sm) && $settings->selector_icon_padding_sm) ? 'padding:' . (int) $settings->selector_icon_padding_sm .'px;' : '';
				$selector_style_xs	.= (isset($settings->selector_icon_padding_xs) && $settings->selector_icon_padding_xs) ? 'padding:' . (int) $settings->selector_icon_padding_xs .'px;' : '';

				$selector_style	.= (isset($settings->selector_icon_color) && $settings->selector_icon_color) ? 'color:' . $settings->selector_icon_color .';' : '';
				$selector_style	.= (isset($settings->selector_icon_background) && $settings->selector_icon_background) ? 'background-color:' . $settings->selector_icon_background .';' : '';
				$selector_style	.= (isset($settings->selector_icon_border_color) && $settings->selector_icon_border_color) ? 'border-style:solid;border-color:' . $settings->selector_icon_border_color .';' : '';

				$selector_style	.= (isset($settings->selector_icon_border_width) && $settings->selector_icon_border_width) ? 'border-width:' . (int) $settings->selector_icon_border_width .'px;' : '';
				$selector_style_sm	.= (isset($settings->selector_icon_border_width_sm) && $settings->selector_icon_border_width_sm) ? 'border-width:' . (int) $settings->selector_icon_border_width_sm .'px;' : '';
				$selector_style_xs	.= (isset($settings->selector_icon_border_width_xs) && $settings->selector_icon_border_width_xs) ? 'border-width:' . (int) $settings->selector_icon_border_width_xs .'px;' : '';

				$selector_style	.= (isset($settings->selector_icon_border_radius) && $settings->selector_icon_border_radius) ? 'border-radius:' . (int) $settings->selector_icon_border_radius .'px;' : '';
				$selector_style_sm	.= (isset($settings->selector_icon_border_radius_sm) && $settings->selector_icon_border_radius_sm) ? 'border-radius:' . (int) $settings->selector_icon_border_radius_sm .'px;' : '';
				$selector_style_xs	.= (isset($settings->selector_icon_border_radius_xs) && $settings->selector_icon_border_radius_xs) ? 'border-radius:' . (int) $settings->selector_icon_border_radius_xs .'px;' : '';

				$selector_icon_style = (isset($settings->selector_icon_size) && $settings->selector_icon_size) ? 'font-size:' . (int) $settings->selector_icon_size . 'px;width:' . (int) $settings->selector_icon_size . 'px;height:' . (int) $settings->selector_icon_size . 'px;line-height:' . (int) $settings->selector_icon_size . 'px;' : '';
				$selector_icon_style_sm	= (isset($settings->selector_icon_size_sm) && $settings->selector_icon_size_sm) ? 'font-size:' . (int) $settings->selector_icon_size_sm . 'px;width:' . (int) $settings->selector_icon_size_sm . 'px;height:' . (int) $settings->selector_icon_size_sm . 'px;line-height:' . (int) $settings->selector_icon_size_sm . 'px;' : '';
				$selector_icon_style_xs	= (isset($settings->selector_icon_size_xs) && $settings->selector_icon_size_xs) ? 'font-size:' . (int) $settings->selector_icon_size_xs . 'px;width:' . (int) $settings->selector_icon_size_xs . 'px;height:' . (int) $settings->selector_icon_size_xs . 'px;line-height:' . (int) $settings->selector_icon_size_xs . 'px;' : '';

				if($selector_style) {
					$css .= $addon_id . ' .sppb-modal-selector span {';
					$css .= $selector_style;
					$css .= '}';
				}

				if($selector_style_sm) {
					$css .= '@media (min-width: 768px) and (max-width: 991px) {';
						$css .= $addon_id . ' .sppb-modal-selector span {';
							$css .= $selector_style_sm;
						$css .= '}';
					$css .= '}';
				}

				if($selector_style_xs) {
					$css .= '@media (max-width: 767px) {';
						$css .= $addon_id . ' .sppb-modal-selector span {';
							$css .= $selector_style_xs;
						$css .= '}';
					$css .= '}';
				}

				if($selector_icon_style) {
					$css .= $addon_id . ' .sppb-modal-selector span > i {';
					$css .= $selector_icon_style;
					$css .= '}';
				}

				if($selector_icon_style_sm) {
					$css .= '@media (min-width: 768px) and (max-width: 991px) {';
						$css .= $addon_id . ' .sppb-modal-selector span > i {';
							$css .= $selector_icon_style_sm;
						$css .= '}';
					$css .= '}';
				}

				if($selector_icon_style_xs) {
					$css .= '@media (max-width: 767px) {';
						$css .= $addon_id . ' .sppb-modal-selector span > i {';
							$css .= $selector_icon_style_xs;
						$css .= '}';
					$css .= '}';
				}

			}
		} else {
			if($selector_style) {
				$css .= $addon_id . ' .sppb-modal-selector {';
				$css .= $selector_style;
				$css .= '}';
			}
		}

		if( $modal_content_type != 'video' && $modal_size) {
			if ($modal_content_type == 'image') {
				$css .= '#sppb-modal-' . $this->addon->id . '.popup-image-block img{';
				$css .= $modal_size;
				$css .= '}';
			} else {
				$css .= '#sppb-modal-' . $this->addon->id . '.white-popup-block {';
				$css .= $modal_size;
				$css .= '}';
			}
		}

		// Button css
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path = new JLayoutFile('addon.css.button', $layout_path);
		$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $settings, 'id' => 'sppb-modal-' . $this->addon->id . '-selector'));

		return $css;
	}

	public static function getTemplate(){

	$output ='
	    <#
	    let modalContentType = data.modal_content_type || "text"
		let buttonIconPosition = data.button_icon_position || "left"
		let modalUniqueId = "sppb-modal-"+ data.id
		let modalUrl = "#" + modalUniqueId
		let attribs = \'data-popup_type="inline" data-mainclass="mfp-no-margins mfp-with-zoom"\'

		let buttonClass = ( data.button_type )? "sppb-btn-" + data.button_type : "sppb-btn-default"
			buttonClass += ( data.button_size )? " sppb-btn-" + data.button_size : ""
			buttonClass += ( data.button_shape )? " sppb-btn-" + data.button_shape : " sppb-btn-rounded"
			buttonClass += ( data.button_appearance )? " sppb-btn-" + data.button_appearance : ""
			buttonClass += ( data.button_block )? " " + data.button_block : ""

		let modalSize = (data.modal_popup_width)? "max-width:" + data.modal_popup_width + "px;":"";
			modalSize += (data.modal_popup_height)? "height:" + data.modal_popup_height + "px;":""

		let selectorStyle = (data.selector_margin_top)? "margin-top:" + data.selector_margin_top + "px;":"";
			selectorStyle += (data.selector_margin_bottom)? "margin-bottom:" + data.selector_margin_bottom + "px;":""

		var modern_font_style = false;
		var button_fontstyle = data.button_fontstyle || "";
		var button_font_style = data.button_font_style || "";

		var button_padding = "";
		var button_padding_sm = "";
		var button_padding_xs = "";
		if(data.button_padding){
			if(_.isObject(data.button_padding)){
				if(data.button_padding.md.trim() !== ""){
					button_padding = data.button_padding.md.split(" ").map(item => {
						if(_.isEmpty(item)){
							return "0";
						}
						return item;
					}).join(" ")
				}

				if(data.button_padding.sm.trim() !== ""){
					button_padding_sm = data.button_padding.sm.split(" ").map(item => {
						if(_.isEmpty(item)){
							return "0";
						}
						return item;
					}).join(" ")
				}

				if(data.button_padding.xs.trim() !== ""){
					button_padding_xs = data.button_padding.xs.split(" ").map(item => {
						if(_.isEmpty(item)){
							return "0";
						}
						return item;
					}).join(" ")
				}
			} else {
				if(data.button_padding.trim() !== ""){
					button_padding = data.button_padding.split(" ").map(item => {
						if(_.isEmpty(item)){
							return "0";
						}
						return item;
					}).join(" ")
				}
			}

		}
	    #>

		<style type="text/css">
		<# if( (data.modal_selector == "icon" || data.modal_selector == "image") && (data.selector_icon_name || data.selector_image)) { #>
			#sppb-addon-{{ data.id }} .sppb-modal-selector span.text {
				<# if(_.isObject(data.selector_text_size)){ #>
					font-size: {{ data.selector_text_size.md }}px;
				<# } else { #>
					font-size: {{ data.selector_text_size }}px;
				<# } #>
				font-weight: {{ data.selector_text_weight }};
				margin: {{ data.selector_text_margin }};
				color: {{ data.selector_text_color }};
			}

			<# if(_.isObject(data.selector_text_size)){ #>
				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-addon-{{ data.id }} .sppb-modal-selector span.text {
						font-size: {{ data.selector_text_size.sm }}px;
					}
				}
				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} .sppb-modal-selector span.text {
						font-size: {{ data.selector_text_size.xs }}px;
					}
				}
			<# } #>
		<# } #>
	    <# if( data.modal_selector == "icon") { #>
			<#
				if( data.selector_icon_name ) {
					selectorStyle += "display:inline-block;line-height:1;"
					selectorStyle += ( data.selector_icon_color )? "color:" + data.selector_icon_color + ";":""
					selectorStyle += ( data.selector_icon_background )? "background-color:" + data.selector_icon_background + ";":""
					selectorStyle += ( data.selector_icon_border_color )? "border-style:solid;border-color:" + data.selector_icon_border_color + ";":""
	        #>
				#sppb-addon-{{ data.id }} .sppb-modal-selector span {
					{{selectorStyle}}
					<# if(_.isObject(data.selector_icon_border_width)){ #>
						border-width: {{ data.selector_icon_border_width.md }}px;
					<# } else { #>
						border-width: {{ data.selector_icon_border_width }}px;
					<# } #>

					<# if(_.isObject(data.selector_icon_border_radius)){ #>
						border-radius: {{ data.selector_icon_border_radius.md }}px;
					<# } else { #>
						border-radius: {{ data.selector_icon_border_radius }}px;
					<# } #>

					<# if(_.isObject(data.selector_icon_padding)){ #>
						padding: {{ data.selector_icon_padding.md }}px;
					<# } else { #>
						padding: {{ data.selector_icon_padding }}px;
					<# } #>
				}
	    	<# } #>

			<# if(_.isObject(data.selector_icon_size)){ #>
				#sppb-addon-{{ data.id }} .sppb-modal-selector span > i {
					font-size: {{ data.selector_icon_size.md }}px;
					width: {{ data.selector_icon_size.md }}px;
					height: {{ data.selector_icon_size.md }}px;
					line-height: {{ data.selector_icon_size.md }}px;
				}
			<# } else { #>
				#sppb-addon-{{ data.id }} .sppb-modal-selector span > i {
					font-size: {{ data.selector_icon_size }}px;
					width: {{ data.selector_icon_size }}px;
					height: {{ data.selector_icon_size }}px;
					line-height: {{ data.selector_icon_size }}px;
				}
	        <# } #>
		<# } else { #>
			#sppb-addon-{{ data.id }} .sppb-modal-selector {
				{{selectorStyle}}
			}
		<# } #>


	    <# if ( modalContentType == "image"){ #>
	        #sppb-addon-{{ data.id }}.popup-image-block img{
	        	{{modalSize}}
	        }
	    <# } else if( modalContentType != "video"){ #>
	        #sppb-addon-{{ data.id }}.white-popup-block {
	        	{{modalSize}}
	        }
		<# } #>

		#sppb-addon-{{ data.id }} #sppb-modal-{{ data.id }}-selector.sppb-btn-{{ data.button_type }} {
			letter-spacing: {{ data.button_letterspace }};
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

		<# if(data.button_type == "custom"){ #>
			#sppb-addon-{{ data.id }} #sppb-modal-{{ data.id }}-selector.sppb-btn-custom{
				color: {{ data.button_color }};
				padding: {{ button_padding }};
				<# if(data.button_appearance == "outline"){ #>
					border-color: {{ data.button_background_color }}
				<# } else if(data.button_appearance == "3d"){ #>
					border-bottom-color: {{ data.button_background_color_hover }};
					background-color: {{ data.button_background_color }};
				<# } else if(data.button_appearance == "gradient"){ #>
					border: none;
					<# if(typeof data.button_background_gradient.type !== "undefined" && data.button_background_gradient.type == "radial"){ #>
						background-image: radial-gradient(at {{ data.button_background_gradient.radialPos || "center center"}}, {{ data.button_background_gradient.color }} {{ data.button_background_gradient.pos || 0 }}%, {{ data.button_background_gradient.color2 }} {{ data.button_background_gradient.pos2 || 100 }}%);
					<# } else { #>
						background-image: linear-gradient({{ data.button_background_gradient.deg || 0}}deg, {{ data.button_background_gradient.color }} {{ data.button_background_gradient.pos || 0 }}%, {{ data.button_background_gradient.color2 }} {{ data.button_background_gradient.pos2 || 100 }}%);
					<# } #>
				<# } else { #>
					background-color: {{ data.button_background_color }};
				<# } #>
			}

			#sppb-addon-{{ data.id }} #sppb-modal-{{ data.id }}-selector.sppb-btn-custom:hover{
				color: {{ data.button_color_hover }};
				background-color: {{ data.button_background_color_hover }};
				<# if(data.button_appearance == "outline"){ #>
					border-color: {{ data.button_background_color_hover }};
				<# } else if(data.button_appearance == "gradient"){ #>
					<# if(typeof data.button_background_gradient_hover.type !== "undefined" && data.button_background_gradient_hover.type == "radial"){ #>
						background-image: radial-gradient(at {{ data.button_background_gradient_hover.radialPos || "center center"}}, {{ data.button_background_gradient_hover.color }} {{ data.button_background_gradient_hover.pos || 0 }}%, {{ data.button_background_gradient_hover.color2 }} {{ data.button_background_gradient_hover.pos2 || 100 }}%);
					<# } else { #>
						background-image: linear-gradient({{ data.button_background_gradient_hover.deg || 0}}deg, {{ data.button_background_gradient_hover.color }} {{ data.button_background_gradient_hover.pos || 0 }}%, {{ data.button_background_gradient_hover.color2 }} {{ data.button_background_gradient_hover.pos2 || 100 }}%);
					<# } #>
				<# } #>
			}
			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }} #sppb-modal-{{ data.id }}-selector.sppb-btn-custom{
					padding: {{ button_padding_sm }};
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }} #sppb-modal-{{ data.id }}-selector.sppb-btn-custom{
					padding: {{ button_padding_xs }};
				}
			}
		<# } #>
		@media (min-width: 768px) and (max-width: 991px) {
			<# if( data.modal_selector == "icon") { #>
				<# if( data.selector_icon_name ) { #>
					#sppb-addon-{{ data.id }} .sppb-modal-selector span {
						<# if(_.isObject(data.selector_icon_border_width)){ #>
							border-width: {{ data.selector_icon_border_width.sm }}px;
						<# } #>

						<# if(_.isObject(data.selector_icon_border_radius)){ #>
							border-radius: {{ data.selector_icon_border_radius.sm }}px;
						<# } #>

						<# if(_.isObject(data.selector_icon_padding)){ #>
							padding: {{ data.selector_icon_padding.sm }}px;
						<# } #>
					}
				<# } #>

				<# if(_.isObject(data.selector_icon_size)){ #>
					#sppb-addon-{{ data.id }} .sppb-modal-selector span > i {
						font-size: {{ data.selector_icon_size.sm }}px;
						width: {{ data.selector_icon_size.sm }}px;
						height: {{ data.selector_icon_size.sm }}px;
						line-height: {{ data.selector_icon_size.sm }}px;
					}
				<# } #>
			<# } #>
		}
		@media (max-width: 767px) {
			<# if( data.modal_selector == "icon") { #>
				<# if( data.selector_icon_name ) { #>
					#sppb-addon-{{ data.id }} .sppb-modal-selector span {
						<# if(_.isObject(data.selector_icon_border_width)){ #>
							border-width: {{ data.selector_icon_border_width.xs }}px;
						<# } #>

						<# if(_.isObject(data.selector_icon_border_radius)){ #>
							border-radius: {{ data.selector_icon_border_radius.xs }}px;
						<# } #>

						<# if(_.isObject(data.selector_icon_padding)){ #>
							padding: {{ data.selector_icon_padding.xs }}px;
						<# } #>
					}
				<# } #>

				<# if(_.isObject(data.selector_icon_size)){ #>
					#sppb-addon-{{ data.id }} .sppb-modal-selector span > i {
						font-size: {{ data.selector_icon_size.xs }}px;
						width: {{ data.selector_icon_size.xs }}px;
						height: {{ data.selector_icon_size.xs }}px;
						line-height: {{ data.selector_icon_size.xs }}px;
					}
				<# } #>
			<# } #>
		}
	    </style>

		<# if( modalContentType == "text") { #>
			<div id="{{ modalUniqueId }}" class="mfp-hide white-popup-block">
				<div class="modal-inner-block">
					{{{ data.modal_content_text }}}
				</div>
			</div>
	    <#
		} else if( modalContentType == "video") {
			modalUrl = data.modal_content_video_url
			attribs = \'data-popup_type="iframe" data-mainclass="mfp-no-margins mfp-with-zoom"\'
		} else {
	    #>
			<div id="{{ modalUniqueId }}" class="mfp-hide popup-image-block">
				<div class="modal-inner-block">
					<#
					var modal_content_image = {}
					if (typeof data.modal_content_image !== "undefined" && typeof data.modal_content_image.src !== "undefined") {
						modal_content_image = data.modal_content_image
					} else {
						modal_content_image = {src: data.modal_content_image}
					}
					if(modal_content_image.src && modal_content_image.src?.indexOf("https://") == -1 && modal_content_image.src?.indexOf("http://") == -1){
					#>
						<img class="mfp-img" src=\'{{ pagebuilder_base + modal_content_image.src }}\' >
					<# } else { #>
						<img class="mfp-img" src=\'{{ modal_content_image.src }}\' >
					<# } #>
				</div>
			</div>
	    <# } #>

	    <div class="{{ data.class }} {{ data.alignment }}">
			<#
			var selector_image = {}
			if (typeof data.selector_image !== "undefined" && typeof data.selector_image.src !== "undefined") {
				selector_image = data.selector_image
			} else {
				selector_image = {src: data.selector_image}
			}
			if(data.modal_selector == "image") {
			#>
				<a class="sppb-modal-selector sppb-magnific-popup" {{{ attribs }}} href=\'{{ modalUrl }}\' id="{{ modalUniqueId }}-selector">
					<# if(selector_image.src && selector_image.src?.indexOf("https://") == -1 && selector_image.src?.indexOf("http://") == -1){ #>
						<img src=\'{{ pagebuilder_base + selector_image.src }}\' alt="">
					<# } else { #>
						<img src=\'{{ selector_image.src }}\' alt="">
					<# } #>
					<# if(data.selector_text){ #>
						<span class="text">{{ data.selector_text }}</span>
					<# } #>
				</a>
			<# } else if (data.modal_selector == "icon"){
				let select_icon_arr = (typeof data.selector_icon_name !== "undefined" && data.selector_icon_name) ? data.selector_icon_name.split(" ") : "";
				let select_icon_name = select_icon_arr.length === 1 ? "fa "+data.selector_icon_name : data.selector_icon_name;
			#>
				<a class="sppb-modal-selector sppb-magnific-popup" href=\'{{ modalUrl }}\' {{{ attribs }}} id="{{ modalUniqueId }}-selector">
					<span class="sppb-modal-icon-wrap">
						<i class="{{ select_icon_name }}"></i>
						<# if(data.show_ripple_effect) { #>
							<span class="sppb-ripple-effect"></span>
						<# } #>
					</span>
					<# if(data.selector_text){ #>
						<span class="text">{{ data.selector_text }}</span>
					<# } #>
				</a>
			<# } else {
				let btn_icon_arr = (typeof data.button_icon !== "undefined" && data.button_icon) ? data.button_icon.split(" ") : "";
				let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+data.button_icon : data.button_icon;
			#>
				<a class="sppb-btn {{ buttonClass }} sppb-magnific-popup sppb-modal-selector" {{{ attribs }}} href=\'{{ modalUrl }}\' id="{{ modalUniqueId }}-selector"><# if( buttonIconPosition == "left" && data.button_icon ) { #> <i class="{{ btn_icon_name }}"></i><# } #> {{ data.button_text }} <# if( buttonIconPosition == "right" && data.button_icon ) { #> <i class="{{ btn_icon_name }}"></i><# } #></a>
			<# } #>
	    </div>';

		return $output;
	}
}