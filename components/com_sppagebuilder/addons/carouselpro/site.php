<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonCarouselpro extends SppagebuilderAddons {

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';

		//Addons option
		$autoplay = (isset($settings->autoplay) && $settings->autoplay) ? 1 : 0;
		$controllers = (isset($settings->controllers) && $settings->controllers) ? $settings->controllers : 0;
		$arrows = (isset($settings->arrows) && $settings->arrows) ? $settings->arrows : 0;
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$carousel_autoplay = ($autoplay) ? ' data-sppb-ride="sppb-carousel"' : '';
		$interval = (isset($settings->interval) && $settings->interval) ? ((int) $settings->interval * 1000) : 5000;
        if($autoplay == 0) {
			$interval = 'false';
		}
		//Container & Column
		$full_container = (isset($settings->full_container) && $settings->full_container) ? $settings->full_container : '';
		$content_column = (isset($settings->content_column) && $settings->content_column) ? $settings->content_column : '';
		$textColumn = '';
		$imageColumn = '';
		if($content_column){
			$textColumn = $content_column;
			$imageColumn = (12-$content_column);
		} else {
			$textColumn = 6;
			$imageColumn =6;
		}
		//Arrow style
        $arrow_position = (isset($settings->arrow_position)) ? $settings->arrow_position : 'default';
        $arrow_icon = (isset($settings->arrow_icon)) ? $settings->arrow_icon : 'chevron';
        $left_arrow ='';
        $right_arrow = '';
        if($arrow_icon=='angle_dubble'){
            $left_arrow ='fa-angle-double-left';
            $right_arrow = 'fa-angle-double-right';
        } elseif($arrow_icon=='arrow'){
            $left_arrow ='fa-arrow-left';
            $right_arrow = 'fa-arrow-right';
        } elseif($arrow_icon=='arrow_circle'){
            $left_arrow ='fa-arrow-circle-o-left';
            $right_arrow = 'fa-arrow-circle-o-right';
        } elseif($arrow_icon=='long_arrow'){
            $left_arrow ='fa-long-arrow-left';
            $right_arrow = 'fa-long-arrow-right';
        } elseif($arrow_icon=='angle'){
			$left_arrow ='fa-angle-left';
            $right_arrow = 'fa-angle-right';
        } else{
            $left_arrow ='fa-chevron-left';
            $right_arrow = 'fa-chevron-right';
		}
		//Item Height
        $carousel_height = (isset($settings->carousel_height) && $settings->carousel_height) ? $settings->carousel_height : '';
		
		//Output start
		$output = '';
		$output  .= '<div id="sppb-carousel-'. $this->addon->id .'" data-interval="'.$interval.'" class="sppb-carousel sppb-carousel-pro sppb-slide' . $class . '"'. $carousel_autoplay .'>';

		if($controllers) {
			$output .= '<ol class="sppb-carousel-indicators">';
				foreach ($settings->sp_carouselpro_item as $key1 => $value) {
					$output .= '<li data-sppb-target="#sppb-carousel-'. $this->addon->id .'" '. (($key1 == 0) ? ' class="active"': '' ) .'  data-sppb-slide-to="'. $key1 .'"></li>' . "\n";
				}
			$output .= '</ol>';
		}

		$output .= '<div class="sppb-carousel-inner ' . $alignment . '">';

		if(isset($settings->sp_carouselpro_item) && count((array) $settings->sp_carouselpro_item)){
			foreach ($settings->sp_carouselpro_item as $key => $value) {
				$bg_image = (isset($value->bg) && $value->bg) ? $value->bg : '';
				$bg_image_src = isset($bg_image->src) ? $bg_image->src : $bg_image;

				$bg_class = $bg_image_src ? ' sppb-item-has-bg' : '';
				$video = (isset($value->video) && $value->video) ? $value->video : '';

				$item_image = (isset($value->image) && $value->image) ? $value->image : '';
				$item_image_src = isset($item_image->src) ? $item_image->src : $item_image;
				
				$bg_http_check = '';
				$bg_image_style = '';
				if($bg_image_src){
					if(strpos($bg_image_src, "http://") !== false || strpos($bg_image_src, "https://") !== false){
						$bg_http_check = ($bg_image_src) ? $bg_image_src : '';
						$bg_image_style = ($bg_image_src) ? 'style="background-image: url(' . $bg_image_src . '); background-repeat: no-repeat; background-position: center center; background-size: cover;"' : '';
					} else {
						$bg_http_check = ($bg_image_src) ? JURI::base() . $bg_image_src : '';
						$bg_image_style = ($bg_image_src) ? 'style="background-image: url(' . JURI::base() . '/' . $bg_image_src . '); background-repeat: no-repeat; background-position: center center; background-size: cover;"' : '';
					}
				}
				$alt_text = (isset($value->title) && $value->title) ? $value->title : '';

				$output  .= '<div id="sppb-item-' . $this->addon->id . $key . '" class="sppb-item'. $bg_class . (($key == 0) ? ' active' : '') .' carousel-item-'.($key+1).'" '.($carousel_height ? $bg_image_style : '').'
				>';

				if(!$carousel_height){
					$output  .= ($bg_http_check) ? '<img class="sppb-carousel-pro-bg-image" src="' . $bg_http_check . '" alt="' . $alt_text . '">' : '';
				}
	
				$output  .= '<div class="sppb-carousel-item-inner">';
				$output  .= '<div class="sppb-carousel-pro-inner-content">';
				$output  .= '<div>';
				if(!$full_container ){
					$output  .= '<div class="sppb-container">';
				}
				$output  .= '<div class="sppb-row">';
				$output  .= '<div class="sppb-col-sm-'.$textColumn.' sppb-col-xs-12">';
				$output  .= '<div class="sppb-carousel-pro-text">';
	
				if((isset($value->title) && $value->title) || (isset($value->content) && $value->content) ) {
					$output  .= (isset($value->title) && $value->title) ? '<h2>' . $value->title . '</h2>' : '';
					$output  .= (isset($value->content) && $value->content) ? '<div class="sppb-carousel-pro-content">' . $value->content . '</div>' : '';
					if(isset($value->button_text) && $value->button_text) {
						$button_class = (isset($value->button_type) && $value->button_type) ? ' sppb-btn-' . $value->button_type : ' sppb-btn-default';
						$button_class .= (isset($value->button_size) && $value->button_size) ? ' sppb-btn-' . $value->button_size : '';
						$button_class .= (isset($value->button_shape) && $value->button_shape) ? ' sppb-btn-' . $value->button_shape: ' sppb-btn-rounded';
						$button_class .= (isset($value->button_appearance) && $value->button_appearance) ? ' sppb-btn-' . $value->button_appearance : '';
						$button_class .= (isset($value->button_block) && $value->button_block) ? ' ' . $value->button_block : '';
						$button_icon = (isset($value->button_icon) && $value->button_icon) ? $value->button_icon : '';
						$button_icon_position = (isset($value->button_icon_position) && $value->button_icon_position) ? $value->button_icon_position: 'left';
						$button_target = (isset($value->button_target) && $value->button_target) ? $value->button_target : '_self';
						$button_url = (isset($value->button_url) && $value->button_url) ? $value->button_url : '';
						
						$icon_arr = array_filter(explode(' ', $button_icon));
						if (count($icon_arr) === 1) {
							$button_icon = 'fa ' . $button_icon;
						}

						if($button_icon_position == 'left') {
							$value->button_text = ($button_icon) ? '<i aria-hidden="true" aria-label="'.JText::_('COM_SPPAGEBUILDER_ARIA_BUTTON_TEXT').'" class="' . $button_icon . '" aria-hidden="true"></i> ' . $value->button_text : $value->button_text;
						} else {
							$value->button_text = ($button_icon) ? $value->button_text . ' <i aria-hidden="true" aria-label="'.JText::_('COM_SPPAGEBUILDER_ARIA_BUTTON_TEXT').'" class="' . $button_icon . '" aria-hidden="true"></i>' : $value->button_text;
						}
	
						$output  .= (isset($value->button_text)) ? '<a href="' . $button_url . '" target="' . $button_target . '" '.($button_target === '_blank' ? 'rel="noopener noreferrer"' : '').' id="btn-'. ($this->addon->id + $key) .'" class="sppb-btn'. $button_class .'">' . $value->button_text . '</a>' : '';
					}
				}
	
				$output  .= '</div>';
				$output  .= '</div>';
				$output  .= '<div class="sppb-col-sm-'.$imageColumn.' sppb-col-xs-12">';
				$output  .= '<div class="sppb-text-right">';
	
				if($video) {
	
					$video = parse_url($video);
	
					switch($video['host']) {
						case 'youtu.be':
						$id = trim($video['path'],'/');
						$src = '//www.youtube.com/embed/' . $id;
						break;
	
						case 'www.youtube.com':
						case 'youtube.com':
						parse_str($video['query'], $query);
						$id = $query['v'];
						$src = '//www.youtube.com/embed/' . $id;
						break;
	
						case 'vimeo.com':
						case 'www.vimeo.com':
						$id = trim($video['path'],'/');
						$src = "//player.vimeo.com/video/{$id}";
					}
	
					$output .= '<div class="sppb-embed-responsive sppb-embed-responsive-16by9">';
					$output .= '<iframe class="sppb-embed-responsive-item" src="' . $src . '" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
					$output .= '</div>';
	
				} else {
					$output  .= ($item_image_src) ? '<img class="sppb-img-reponsive" src="' . $item_image_src . '" alt="'. (isset($value->title) ? $value->title : '') .'">' : '';
				}
	
	
				$output  .= '</div>';//.sppb-text-right
				$output  .= '</div>';//.sppb-col-xs-12
				$output  .= '</div>';//.sppb-row
				if(!$full_container ){
					$output  .= '</div>';//.sppb-container
				}
	
				$output  .= '</div>';//no class
				$output  .= '</div>';//.sppb-carousel-pro-inner-content
	
				$output  .= '</div>';//.sppb-carousel-item-inner
				$output  .= '</div>';//.sppb-item
			}
		}

		$output	.= '</div>';//.sppb-carousel-inner

		if($arrows) {
			if($arrow_position !== 'default'){
				$output  .= '<div class="sppb-container sppb-carousel-pro-arrow-'.$arrow_position.'">';
				$output  .= '<div class="sppb-row">';
				$output  .= '<div class="sppb-col-sm-12">';
			}
			$output	.= '<a href="#sppb-carousel-'. $this->addon->id .'" class="sppb-carousel-arrow left sppb-carousel-control" data-slide="prev" aria-label="'.JText::_('COM_SPPAGEBUILDER_ARIA_PREVIOUS').'"><i class="fa '.$left_arrow.'" aria-hidden="true"></i></a>';
			$output	.= '<a href="#sppb-carousel-'. $this->addon->id .'" class="sppb-carousel-arrow right sppb-carousel-control" data-slide="next" aria-label="'.JText::_('COM_SPPAGEBUILDER_ARIA_NEXT').'"><i class="fa '.$right_arrow.'" aria-hidden="true"></i></a>';
			if($arrow_position !== 'default'){
				$output  .= '</div>';
				$output  .= '</div>';
				$output  .= '</div>';
			}
		}

		$output .= '</div>';//.sppb-carousel-pro

		return $output;
	}

	public function css() {
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css = '';

		//Item Height
        $carousel_height = (isset($settings->carousel_height) && $settings->carousel_height) ? "height: " . $settings->carousel_height . "px;" : "";
		
		if($carousel_height){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-pro .sppb-item {';
                $css .= $carousel_height;
            $css .= '}';
		}

		//Arrow Style
        $arrow_style = '';
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "height: " . $settings->arrow_height . "px;" : "";
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "line-height: " . (($settings->arrow_height)-($settings->arrow_border_width)) . "px;" : "";
        $arrow_style .= (isset($settings->arrow_width) && $settings->arrow_width) ? "width: " . $settings->arrow_width . "px;" : "";
        $arrow_style .= (isset($settings->arrow_background) && $settings->arrow_background) ? "background-color: " . $settings->arrow_background . ";" : "";
        $arrow_style .= (isset($settings->arrow_color) && $settings->arrow_color) ? "color: " . $settings->arrow_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_margin) && trim($settings->arrow_margin)) ? "margin: " . $settings->arrow_margin . ";" : "";
        $arrow_style .= (isset($settings->arrow_font_size) && $settings->arrow_font_size) ? "font-size: " . $settings->arrow_font_size . "px;" : "";
        $arrow_style .= (isset($settings->arrow_border_width) && $settings->arrow_border_width) ? "border-width: " . $settings->arrow_border_width . "px;" : "";
        $arrow_style .= (isset($settings->arrow_border_width) && $settings->arrow_border_width) ? "border-style: solid;" : "";
        $arrow_style .= (isset($settings->arrow_border_color) && $settings->arrow_border_color) ? "border-color: " . $settings->arrow_border_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_border_radius) && $settings->arrow_border_radius) ? "border-radius: " . $settings->arrow_border_radius . "px;" : "";

        if($arrow_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-pro .sppb-carousel-control{';
                $css .= $arrow_style;
            $css .= '}';
		}
		
		//Arrow hover style
        $arrow_hover_style = '';
        $arrow_hover_style .= (isset($settings->arrow_hover_background) && $settings->arrow_hover_background) ? "background-color: " . $settings->arrow_hover_background . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_color) && $settings->arrow_hover_color) ? "color: " . $settings->arrow_hover_color . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_border_color) && $settings->arrow_hover_border_color) ? "border-color: " . $settings->arrow_hover_border_color . ";" : "";

        if($arrow_hover_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-pro .sppb-carousel-control:hover{';
                $css .= $arrow_hover_style;
            $css .= '}';
        }

		// Buttons style
		foreach ($settings->sp_carouselpro_item as $key => $value) {

			$uniqid = '#sppb-item-' . $this->addon->id . $key . ' ';

			if(isset($value->button_text)) {
				$css_path = new JLayoutFile('addon.css.button', $layout_path);
				$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $value, 'id' => 'btn-' . ($this->addon->id + $key)));
			}

			// Title
			$title_css = (isset($value->title_fontsize) && $value->title_fontsize) ? 'font-size: ' . $value->title_fontsize . 'px;' : '';
			$title_css .= (isset($value->title_lineheight) && $value->title_lineheight) ? 'line-height: ' . $value->title_lineheight . 'px;' : '';
			$title_css .= (isset($value->title_margin) && trim($value->title_margin)) ? 'margin: ' . $value->title_margin . ';' : '';
			$title_css .= (isset($value->title_color) && $value->title_color) ? 'color: ' . $value->title_color . ';' : '';
			$title_css .= (isset($value->title_letterspace) && $value->title_letterspace) ? 'letter-spacing: ' . $value->title_letterspace . ';' : '';
			$title_css .= (isset($value->title_font_family) && $value->title_font_family) ? 'font-family: ' . $value->title_font_family . ';' : '';

			$title_fontstyle = (isset($value->title_fontstyle) && $value->title_fontstyle) ? $value->title_fontstyle : '';
			if(isset($title_fontstyle->underline) && $title_fontstyle->underline){
				$title_css .= 'text-decoration:underline;';
			}
			if(isset($title_fontstyle->italic) && $title_fontstyle->italic){
				$title_css .= 'font-style:italic;';
			}
			if(isset($title_fontstyle->uppercase) && $title_fontstyle->uppercase){
				$title_css .= 'text-transform:uppercase;';
			}
			if(isset($title_fontstyle->weight) && $title_fontstyle->weight){
				$title_css .= 'font-weight:'.$title_fontstyle->weight.';';
			}

			if($title_css) {
				$css .= $uniqid . '.sppb-carousel-pro-text h2 {' . $title_css . '}';
			}

			$title_css_sm = (isset($value->title_fontsize_sm) && $value->title_fontsize_sm) ? 'font-size: ' . $value->title_fontsize_sm . 'px;' : '';
			$title_css_sm .= (isset($value->title_lineheight_sm) && $value->title_lineheight_sm) ? 'line-height: ' . $value->title_lineheight_sm . 'px;' : '';
			$title_css_sm .= (isset($value->title_margin_sm) && $value->title_margin_sm) ? 'margin: ' . $value->title_margin_sm . ';' : '';

			if($title_css_sm) {
				$css .= '@media (min-width: 768px) and (max-width: 991px) {';
					$css .= $uniqid . '.sppb-carousel-pro-text h2 {' . $title_css_sm . '}';
				$css .= '}';
			}

			$title_css_xs = (isset($value->title_fontsize_xs) && $value->title_fontsize_xs) ? 'font-size: ' . $value->title_fontsize_xs . 'px;' : '';
			$title_css_xs .= (isset($value->title_lineheight_xs) && $value->title_lineheight_xs) ? 'line-height: ' . $value->title_lineheight_xs . 'px;' : '';
			$title_css_xs .= (isset($value->title_margin_xs) && $value->title_margin_xs) ? 'margin: ' . $value->title_margin_xs . ';' : '';

			if($title_css_xs) {
				$css .= '@media (max-width: 767px) {';
					$css .= $uniqid . '.sppb-carousel-pro-text h2 {' . $title_css_xs . '}';
				$css .= '}';
			}

			// Content
			$content_css = (isset($value->content_fontsize) && $value->content_fontsize) ? 'font-size: ' . $value->content_fontsize . 'px;' : '';
			$content_css .= (isset($value->content_lineheight) && $value->content_lineheight) ? 'line-height: ' . $value->content_lineheight . 'px;' : '';
			$content_css .= (isset($value->content_margin) && trim($value->content_margin)) ? 'margin: ' . $value->content_margin . ';' : '';
			$content_css .= (isset($value->content_fontweight) && $value->content_fontweight) ? 'font-weight: ' . $value->content_fontweight . ';' : '';
			$content_css .= (isset($value->content_font_family) && $value->content_font_family) ? 'font-family: ' . $value->content_font_family . ';' : '';

			if($content_css) {
				$css .= $uniqid . '.sppb-carousel-pro-text .sppb-carousel-pro-content {' . $content_css . '}';
			}

			$content_css_sm = (isset($value->content_fontsize_sm) && $value->content_fontsize_sm) ? 'font-size: ' . $value->content_fontsize_sm . 'px;' : '';
			$content_css_sm .= (isset($value->content_lineheight_sm) && $value->content_lineheight_sm) ? 'line-height: ' . $value->content_lineheight_sm . 'px;' : '';
			$content_css_sm .= (isset($value->content_margin_sm) && trim($value->content_margin_sm)) ? 'margin: ' . $value->content_margin_sm . ';' : '';

			if($content_css_sm) {
				$css .= '@media (min-width: 768px) and (max-width: 991px) {';
					$css .= $uniqid . '.sppb-carousel-pro-text .sppb-carousel-pro-content {' . $content_css_sm . '}';
				$css .= '}';
			}

			$content_css_xs = (isset($value->content_fontsize_xs) && $value->content_fontsize_xs) ? 'font-size: ' . $value->content_fontsize_xs . 'px;' : '';
			$content_css_xs .= (isset($value->content_lineheight_xs) && $value->content_lineheight_xs) ? 'line-height: ' . $value->content_lineheight_xs . 'px;' : '';
			$content_css_xs .= (isset($value->content_margin_xs) && trim($value->content_margin_xs)) ? 'margin: ' . $value->content_margin_xs . ';' : '';

			if($content_css_xs) {
				$css .= '@media (max-width: 767px) {';
					$css .= $uniqid . '.sppb-carousel-pro-text .sppb-carousel-pro-content {' . $content_css_xs . '}';
				$css .= '}';
			}

		}
		//Item Style
		$item_padding = (isset($settings->item_padding) && trim($settings->item_padding)) ? $settings->item_padding : '';
		$speed = (isset($settings->speed) && $settings->speed) ? $settings->speed : 600;
		$css .= $addon_id.' .sppb-carousel-inner > .sppb-item{';
			$css .='-webkit-transition-duration: '.$speed.'ms;';
			$css .='transition-duration: '.$speed.'ms;';
			if($item_padding){
				$css .='padding:'.$item_padding.';';
			}
		$css .='}';
		//Item Tablet Style
		$carousel_height_sm = (isset($settings->carousel_height_sm) && $settings->carousel_height_sm) ? "height: " . $settings->carousel_height_sm . "px;" : "";
		$item_padding_sm = (isset($settings->item_padding_sm) && trim($settings->item_padding_sm)) ? $settings->item_padding_sm : '';
		if($item_padding_sm || $carousel_height_sm) {
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				$css .= $addon_id.' .sppb-carousel-inner > .sppb-item{';
					$css .='padding:'.$item_padding_sm.';';
				$css .='}';
				if($carousel_height_sm){
					$css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-pro .sppb-item {';
						$css .= $carousel_height_sm;
					$css .= '}';
				}
			$css .= '}';
		}
		//Item Mobile style
		$carousel_height_xs = (isset($settings->carousel_height_xs) && $settings->carousel_height_xs) ? "height: " . $settings->carousel_height_xs . "px;" : "";
		$item_padding_xs = (isset($settings->item_padding_xs) && trim($settings->item_padding_xs)) ? $settings->item_padding_xs : '';
		if($item_padding_xs || $carousel_height_xs) {
			$css .= '@media (max-width: 767px) {';
				$css .= $addon_id.' .sppb-carousel-inner > .sppb-item{';
					$css .='padding:'.$item_padding_xs.';';
				$css .='}';
				if($carousel_height_xs){
					$css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-pro .sppb-item {';
						$css .= $carousel_height_xs;
					$css .= '}';
				}
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate(){
		$output = '
		<#
		var interval = data.interval ? parseInt(data.interval) * 1000 : 5000;
		var autoplay = data.autoplay ? \'data-sppb-ride="sppb-carousel"\' : "";
		if(data.autoplay==0){
			interval = "false";
		}
		#>
		<style type="text/css">
			#sppb-addon-{{ data.id }} .sppb-carousel-inner > .sppb-item{
				-webkit-transition-duration: {{ data.speed }}ms;
				transition-duration: {{ data.speed }}ms;
			}

			#sppb-addon-{{ data.id }} .sppb-carousel-pro .sppb-item {
				<# if(_.isObject(data.carousel_height)){ #>
					height: {{data.carousel_height.md}}px;
				<# } else { #>
					height: {{data.carousel_height}}px;
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-carousel-pro .sppb-carousel-control{
				width: {{data.arrow_width}}px;
				height: {{data.arrow_height}}px;
				background-color: {{data.arrow_background}};
				color: {{data.arrow_color}};
				<# if(data.arrow_margin){ #>
					margin: {{data.arrow_margin}};
				<# } #>
				font-size: {{data.arrow_font_size}}px;
				<# if(data.arrow_height){ #>
					line-height: {{data.arrow_height-data.arrow_border_width}}px;
				<# } #>
				border-width: {{data.arrow_border_width}}px;
				<# if(data.arrow_border_width){ #>
					border-style: solid;
				<# } #>
				border-color: {{data.arrow_border_color}};
				border-radius: {{data.arrow_border_radius}}px;
			}
			#sppb-addon-{{ data.id }} .sppb-carousel-pro .sppb-carousel-control:hover{
				background-color: {{data.arrow_hover_background}};
				color: {{data.arrow_hover_color}};
				border-color: {{data.arrow_hover_border_color}};
			}
			<# _.each(data.sp_carouselpro_item, function (carousel_item, key){ #>
				<#
					var button_fontstyle = carousel_item.button_fontstyle || "";

					var modern_font_style = false;

					var margin = window.getMarginPadding(carousel_item.title_margin, "margin");
					var content_margin = window.getMarginPadding(carousel_item.content_margin, "margin");
				#>
				#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-{{ carousel_item.button_type }}{
					letter-spacing: {{ carousel_item.button_letterspace }};

					<# if(_.isObject(carousel_item.button_font_style) && carousel_item.button_font_style.underline) { #>
						text-decoration: underline;
						<# modern_font_style = true #>
					<# } #>

					<# if(_.isObject(carousel_item.button_font_style) && carousel_item.button_font_style.italic) { #>
						font-style: italic;
						<# modern_font_style = true #>
					<# } #>

					<# if(_.isObject(carousel_item.button_font_style) && carousel_item.button_font_style.uppercase) { #>
						text-transform: uppercase;
						<# modern_font_style = true #>
					<# } #>

					<# if(_.isObject(carousel_item.button_font_style) && carousel_item.button_font_style.weight) { #>
						font-weight: {{ carousel_item.button_font_style.weight }};
						<# modern_font_style = true #>
					<# } #>

					<# if(modern_font_style && _.isArray(button_fontstyle)) { #>
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
				}

				#sppb-item-{{  data.id  }}{{ key }} .sppb-carousel-pro-text h2{
					<# if(_.isObject(carousel_item.title_fontsize)){ #>
						font-size: {{ carousel_item.title_fontsize.md }}px;
					<# } else { #>
						font-size: {{ carousel_item.title_fontsize }}px;
					<# } #>

					<# if(_.isObject(carousel_item.title_lineheight)){ #>
						line-height: {{ carousel_item.title_lineheight.md }}px;
					<# } else { #>
						line-height: {{ carousel_item.title_lineheight }}px;
					<# } #>

					<# if(_.isObject(margin)){ #>
						{{ margin.md }}
					<# } else { #>
						{{ margin }}
					<# } #>

					color: {{ carousel_item.title_color }};
					letter-spacing: {{ carousel_item.title_letterspace }};
					font-family: {{ carousel_item.title_font_family }};

					<# if(_.isObject(carousel_item.title_fontstyle)){
						if(carousel_item.title_fontstyle.underline){ #>
							text-decoration:underline;
						<# }
						if(carousel_item.title_fontstyle.italic){ #>
							font-style:italic;
						<# }
						if(carousel_item.title_fontstyle.uppercase){ #>
							text-transform:uppercase;
						<# }
						if(carousel_item.title_fontstyle.weight){ #>
							font-weight:{{carousel_item.title_fontstyle.weight}};
						<# }
					} #>
				}

				#sppb-item-{{  data.id  }}{{ key }} .sppb-carousel-pro-text .sppb-carousel-pro-content{
					<# if(_.isObject(carousel_item.content_fontsize)){ #>
						font-size: {{ carousel_item.content_fontsize.md }}px;
					<# } else { #>
						font-size: {{ carousel_item.content_fontsize }}px;
					<# }
					if(_.isObject(carousel_item.content_lineheight)){
					#>
						line-height: {{ carousel_item.content_lineheight.md }}px;
					<# } else { #>
						line-height: {{ carousel_item.content_lineheight }}px;
					<# }
					if(_.isObject(content_margin)){
					#>
						{{ content_margin.md }}
					<# } else { #>
						{{ content_margin }}
					<# }
					if(carousel_item.content_font_family){ 
					#>
						font-family: {{carousel_item.content_font_family}};
					<# }
					if(carousel_item.content_fontweight){ 
					#>
					font-weight: {{carousel_item.content_fontweight}};
					<# } #>
				}
	
				<# if(carousel_item.button_type == "custom"){ #>
					#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-custom{
						color: {{ carousel_item.button_color }};
						<# if(carousel_item.button_appearance == "outline"){ #>
							border-color: {{ carousel_item.button_background_color }};
						<# } else if(carousel_item.button_appearance == "3d"){ #>
							border-bottom-color: {{ carousel_item.button_background_color_hover }};
							background-color: {{ carousel_item.button_background_color }};
						<# } else if(carousel_item.button_appearance == "gradient"){ #>
							border: none;
							<# if(typeof carousel_item.button_background_gradient.type !== "undefined" && carousel_item.button_background_gradient.type == "radial"){ #>
								background-image: radial-gradient(at {{ carousel_item.button_background_gradient.radialPos || "center center"}}, {{ carousel_item.button_background_gradient.color }} {{ carousel_item.button_background_gradient.pos || 0 }}%, {{ carousel_item.button_background_gradient.color2 }} {{ carousel_item.button_background_gradient.pos2 || 100 }}%);
							<# } else { #>
								background-image: linear-gradient({{ carousel_item.button_background_gradient.deg || 0}}deg, {{ carousel_item.button_background_gradient.color }} {{ carousel_item.button_background_gradient.pos || 0 }}%, {{ carousel_item.button_background_gradient.color2 }} {{ carousel_item.button_background_gradient.pos2 || 100 }}%);
							<# } #>
						<# } else { #>
							background-color: {{ carousel_item.button_background_color }};
						<# }
						if(_.isObject(carousel_item.fontsize)){ 
						#>
							font-size: {{carousel_item.fontsize.md}}px;
						<# }
						if(_.isObject(carousel_item.button_padding)){ 
						#>
							padding: {{carousel_item.button_padding.md}};
						<# } else { #>
							padding: {{carousel_item.button_padding}};
						<# } #>
					}
	
					#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-custom:hover{
						color: {{ carousel_item.button_color_hover }};
						background-color: {{ carousel_item.button_background_color_hover }};
						<# if(carousel_item.button_appearance == "outline"){ #>
							border-color: {{ carousel_item.button_background_color_hover }};
						<# } else if(carousel_item.button_appearance == "gradient"){ #>
							<# if(typeof carousel_item.button_background_gradient_hover.type !== "undefined" && carousel_item.button_background_gradient_hover.type == "radial"){ #>
								background-image: radial-gradient(at {{ carousel_item.button_background_gradient_hover.radialPos || "center center"}}, {{ carousel_item.button_background_gradient_hover.color }} {{ carousel_item.button_background_gradient_hover.pos || 0 }}%, {{ carousel_item.button_background_gradient_hover.color2 }} {{ carousel_item.button_background_gradient_hover.pos2 || 100 }}%);
							<# } else { #>
								background-image: linear-gradient({{ carousel_item.button_background_gradient_hover.deg || 0}}deg, {{ carousel_item.button_background_gradient_hover.color }} {{ carousel_item.button_background_gradient_hover.pos || 0 }}%, {{ carousel_item.button_background_gradient_hover.color2 }} {{ carousel_item.button_background_gradient_hover.pos2 || 100 }}%);
							<# } #>
						<# } #>
					}
				<# } #>

				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-item-{{  data.id  }}{{ key }} .sppb-carousel-pro-text h2{
						<# if(_.isObject(carousel_item.title_fontsize)){ #>
							font-size: {{ carousel_item.title_fontsize.sm }}px;
						<# } #>
						<# if(_.isObject(carousel_item.title_lineheight)){ #>
							line-height: {{ carousel_item.title_lineheight.sm }}px;
						<# } #>
						<# if(_.isObject(margin)){ #>
							{{ margin.sm }}
						<# } #>
					}

					#sppb-item-{{  data.id  }}{{ key }} .sppb-carousel-pro-text .sppb-carousel-pro-content{
						<# if(_.isObject(carousel_item.content_fontsize)){ #>
							font-size: {{ carousel_item.content_fontsize.sm }}px;
						<# } #>
	
						<# if(_.isObject(carousel_item.content_lineheight)){ #>
							line-height: {{ carousel_item.content_lineheight.sm }}px;
						<# } #>
	
						<# if(_.isObject(content_margin)){ #>
							{{ content_margin.sm }}
						<# } #>
					}
					<# if(carousel_item.button_type == "custom"){ #>
						#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-custom{
							<# if(_.isObject(carousel_item.fontsize)){ #>
								font-size: {{carousel_item.fontsize.sm}}px;
							<# }
							if(_.isObject(carousel_item.button_padding)){ 
							#>
								padding: {{carousel_item.button_padding.sm}};
							<# } #>
						}
					<# } #>
				}

				@media (max-width: 767px) {
					#sppb-item-{{  data.id  }}{{ key }} .sppb-carousel-pro-text h2{
						<# if(_.isObject(carousel_item.title_fontsize)){ #>
							font-size: {{ carousel_item.title_fontsize.xs }}px;
						<# } #>
						<# if(_.isObject(carousel_item.title_lineheight)){ #>
							line-height: {{ carousel_item.title_lineheight.xs }}px;
						<# } #>
						<# if(_.isObject(margin)){ #>
							{{ margin.xs }}
						<# } #>
					}

					#sppb-item-{{  data.id  }}{{ key }} .sppb-carousel-pro-text .sppb-carousel-pro-content{
						<# if(_.isObject(carousel_item.content_fontsize)){ #>
							font-size: {{ carousel_item.content_fontsize.xs }}px;
						<# } #>
	
						<# if(_.isObject(carousel_item.content_lineheight)){ #>
							line-height: {{ carousel_item.content_lineheight.xs }}px;
						<# } #>
	
						<# if(_.isObject(content_margin)){ #>
							{{ content_margin.xs }}
						<# } #>
					}
					<# if(carousel_item.button_type == "custom"){ #>
						#sppb-addon-{{ data.id }} #btn-{{ data.id + "" + key }}.sppb-btn-custom{
							<# if(_.isObject(carousel_item.fontsize)){ #>
								font-size: {{carousel_item.fontsize.xs}}px;
							<# }
							if(_.isObject(carousel_item.button_padding)){ 
							#>
								padding: {{carousel_item.button_padding.xs}};
							<# } #>
						}
					<# } #>
				}
			<# }); #>

			<# if(_.isObject(data.item_padding)){ #>
				#sppb-addon-{{ data.id }} .sppb-carousel-inner > .sppb-item{
					padding:{{data.item_padding.md}};
				}
			<# } #>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if(_.isObject(data.item_padding) && data.item_padding.sm){ #>
					#sppb-addon-{{ data.id }} .sppb-carousel-inner > .sppb-item{
						padding:{{data.item_padding.sm}};
					}
				<# } #>
				<# if(_.isObject(data.carousel_height)){ #>
					#sppb-addon-{{ data.id }} .sppb-carousel-pro .sppb-item {
						height: {{data.carousel_height.sm}}px;
					}
				<# } #>
			}
			@media (max-width: 767px) {
				<# if(_.isObject(data.item_padding) && data.item_padding.xs){ #>
					#sppb-addon-{{ data.id }} .sppb-carousel-inner > .sppb-item{
						padding:{{data.item_padding.xs}};
					}
				<# } #>
				<# if(_.isObject(data.carousel_height)){ #>
					#sppb-addon-{{ data.id }} .sppb-carousel-pro .sppb-item {
						height: {{data.carousel_height.xs}}px;
					}
				<# } #>
			}
			<# if(!_.isEmpty(data.carousel_height) && data.carousel_height.md !== ""){
				_.each (data.sp_carouselpro_item, function(carousel_item, key) { 
					var carouselBg = {}
					if (typeof carousel_item.bg !== "undefined" && typeof carousel_item.bg.src !== "undefined") {
						carouselBg = carousel_item.bg
					} else {
						carouselBg = {src: carousel_item.bg}
					}		
			#>
					#sppb-addon-{{ data.id }} .sppb-carousel-pro .item-{{ data.id }}-{{ key }} {
						<# if(carouselBg.src){
							if(carouselBg.src?.indexOf("http://") == 0 || carouselBg.src?.indexOf("https://") == 0){ #>
								background: url({{ carouselBg.src }});
							<# } else { #>
								background: url({{ pagebuilder_base + carouselBg.src }});
							<# }
						} #>
						background-repeat: no-repeat;
						background-size: cover;
						background-position: center center;
					}
				<# })
			} #>

		</style>
		<#
			let content_column = (!_.isEmpty(data.content_column) && data.content_column) ? data.content_column : "";
			let textColumn = "";
			let imageColumn = "";
			if(content_column){
				textColumn = content_column;
				imageColumn = (12-content_column);
			} else {
				textColumn = 6;
				imageColumn = 6;
			} 
			let arrow_icon = (!_.isEmpty(data.arrow_icon)) ? data.arrow_icon : "angle";
			let left_arrow ="";
			let right_arrow = "";
			if(arrow_icon=="angle_dubble"){
				left_arrow ="fa-angle-double-left";
				right_arrow = "fa-angle-double-right";
			} else if(arrow_icon=="arrow"){
				left_arrow ="fa-arrow-left";
				right_arrow = "fa-arrow-right";
			} else if(arrow_icon=="arrow_circle"){
				left_arrow ="fa-arrow-circle-o-left";
				right_arrow = "fa-arrow-circle-o-right";
			} else if(arrow_icon=="long_arrow"){
				left_arrow ="fa-long-arrow-left";
				right_arrow = "fa-long-arrow-right";
			} else if(arrow_icon=="angle"){
				left_arrow ="fa-angle-left";
				right_arrow = "fa-angle-right";
			} else{
				left_arrow ="fa-chevron-left";
				right_arrow = "fa-chevron-right";
			}
			if(!data.arrow_position){
				data.arrow_position = "default"
			}
		#>
		<div id="sppb-carousel-{{data.id}}" class="sppb-carousel sppb-carousel-pro sppb-slide {{ data.class }}" data-interval="{{ interval }}" {{{ autoplay }}}>
			<# if(data.controllers){ #>
				<ol class="sppb-carousel-indicators">
				<# _.each(data.sp_carouselpro_item, function (carousel_item, key){ #>
					<# var active = (key == 0) ? "active" : ""; #>
					<li data-sppb-target="#sppb-carousel-{{ data.id }}"  class="{{ active }}"  data-sppb-slide-to="{{ key }}"></li>
				<# }); #>
				</ol>
			<# } #>
			<div class="sppb-carousel-inner {{ data.alignment }}">
				<#
				_.each(data.sp_carouselpro_item, function (carousel_item, key){
					var carouselBg = {}
					if (typeof carousel_item.bg !== "undefined" && typeof carousel_item.bg.src !== "undefined") {
						carouselBg = carousel_item.bg
					} else {
						carouselBg = {src: carousel_item.bg}
					}

					var classNames = (key == 0) ? "active" : "";
					classNames += (carouselBg.src) ? " sppb-item-has-bg" : "";

				#>
					<div class="sppb-item {{ classNames }} item-{{ data.id }}-{{ key }}" id="sppb-item-{{  data.id  }}{{ key }}">
					<# if(_.isObject(data.carousel_height) && !_.isEmpty(data.carousel_height.md)){
						if(carouselBg.src){ #>
							<img class="sppb-carousel-pro-bg-image" src=\'{{ carouselBg.src }}\' alt="{{ carousel_item.title }}">
						<# }
					} #>
						<div class="sppb-carousel-item-inner">
							<div>
								<div>
								<# if(!data.full_container){ #>
									<div class="sppb-container">
								<# } #>
									<div class="sppb-row">
										<div class="sppb-col-sm-{{textColumn}} sppb-col-xs-12">
											<div class="sppb-carousel-pro-text">
												<# if(carousel_item.title || carousel_item.content) { #>
													<# if(carousel_item.title) { #>
														<h2 class="sp-editable-content" id="addon-title-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_carouselpro_item-{{key}}-title">{{ carousel_item.title }}</h2>
													<# } #>
													<# if(carousel_item.content) { #>
														<div class="sppb-carousel-pro-content sp-editable-content" id="addon-content-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_carouselpro_item-{{key}}-content">{{{ carousel_item.content }}}</div>
													<# } #>
													<# if(carousel_item.button_text) { #>
														<#
															var btnClass = "";
															btnClass += carousel_item.button_type ? " sppb-btn-"+carousel_item.button_type : " sppb-btn-default" ;
															btnClass += carousel_item.button_size ? " sppb-btn-"+carousel_item.button_size : "" ;
															btnClass += carousel_item.button_shape ? " sppb-btn-"+carousel_item.button_shape : " sppb-btn-rounded" ;
															btnClass += carousel_item.button_appearance ? " sppb-btn-"+carousel_item.button_appearance : "" ;
															btnClass += carousel_item.button_block ? " "+carousel_item.button_block : "" ;
															var button_text = carousel_item.button_text;

															let icon_arr = (typeof carousel_item.button_icon !== "undefined" && carousel_item.button_icon) ? carousel_item.button_icon.split(" ") : "";
															let icon_name = icon_arr.length === 1 ? "fa "+carousel_item.button_icon : carousel_item.button_icon;
					
															if(carousel_item.button_icon_position == "left"){
																button_text = (carousel_item.button_icon) ? \'<i class="\'+icon_name+\'"></i> \'+carousel_item.button_text : carousel_item.button_text ;
															}else{
																button_text = (carousel_item.button_icon) ? carousel_item.button_text+\' <i class="\'+icon_name+\'"></i>\' : carousel_item.button_text ;
															}
														#>
														<a href=\'{{ carousel_item.button_url }}\' target="{{ carousel_item.button_target }}" id="btn-{{ data.id + "" + key}}" class="sppb-btn{{ btnClass }}">{{{ button_text }}}</a>
													<# } #>
												<# } #>
											</div>
										</div>
										<div class="sppb-col-sm-{{imageColumn}} sppb-col-xs-12">
											<div class="sppb-text-right">
											<# if(carousel_item.video) { #>
												<#
													var video = parseUrl(carousel_item.video),
														src = "";

													if (video.host == "youtu.be") {
														var id = video["path"].replace("/", "");
														src = "//www.youtube.com/embed/"+id;
													} else if(video.host == "www.youtube.com" || video.host == "youtube.com"){
														var id = video["query"].replace("v=", "");
														src = "//www.youtube.com/embed/"+id;
													} else if (video.host == "vimeo.com" || video.host == "www.vimeo.com") {
														var id = video["path"].replace("/", "");
														src = "//player.vimeo.com/video/"+id;
													}
												#>
												<div class="sppb-embed-responsive sppb-embed-responsive-16by9">
													<iframe class="sppb-embed-responsive-item" src=\'{{ src }}\' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
												</div>
											<# } else {
												var carouselItemImg = {}
												if (typeof carousel_item.image !== "undefined" && typeof carousel_item.image.src !== "undefined") {
													carouselItemImg = carousel_item.image
												} else {
													carouselItemImg = {src: carousel_item.image}
												}
												if(carouselItemImg.src){
													if(carouselItemImg.src && carouselItemImg.src?.indexOf("https://") == -1 && carouselItemImg.src?.indexOf("http://") == -1){
											#>
														<img class="sppb-img-reponsive" src=\'{{ pagebuilder_base + carouselItemImg.src }}\' alt="{{ carousel_item.title }}">
													<# } else if(carouselItemImg.src){ #>
														<img class="sppb-img-reponsive" src=\'{{ carouselItemImg.src }}\' alt="{{ carousel_item.title }}">
													<# }
												}
											} #>
											</div>
										</div>
										</div>
									<# if(!data.full_container){ #>
									</div>
									<# } #>
								</div>
							</div>
						</div>
					</div>
				<# }); #>
			</div>
			<# if(data.arrows) {
				if(data.arrow_position!=="default") { #>
					<div class="sppb-container sppb-carousel-pro-arrow-{{data.arrow_position}}">
					<div class="sppb-row">
					<div class="sppb-col-sm-12">
				<# } #>
					<a href="#sppb-carousel-{{ data.id }}" class="sppb-carousel-arrow left sppb-carousel-control" data-slide="prev"><i class="fa {{left_arrow}}
					"></i></a>
					<a href="#sppb-carousel-{{ data.id }}" class="sppb-carousel-arrow right sppb-carousel-control" data-slide="next"><i class="fa {{right_arrow}}"></i></a>
				<# if(data.arrow_position!=="default") { #>
					</div>
					</div>
					</div>
				<# }
			} #>
		</div>
		';

		return $output;
	}

}
