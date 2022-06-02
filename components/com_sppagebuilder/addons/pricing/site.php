<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonPricing extends SppagebuilderAddons {

	public function render() {
		
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'div';

		//Options
		$price_position = (isset($settings->price_position) && $settings->price_position) ? $settings->price_position : 'before';
		$price = (isset($settings->price) && $settings->price) ? $settings->price : '';
		$price_symbol = (isset($settings->price_symbol) && $settings->price_symbol) ? $settings->price_symbol : '';
		$duration = (isset($settings->duration) && $settings->duration) ? $settings->duration : '';
		$pricing_content = (isset($settings->pricing_content) && $settings->pricing_content) ? $settings->pricing_content : '';
		$button_text = (isset($settings->button_text) && $settings->button_text) ? $settings->button_text : '';
		$button_url = (isset($settings->button_url) && $settings->button_url) ? $settings->button_url : '';
		$button_classes = (isset($settings->button_size) && $settings->button_size) ? ' sppb-btn-' . $settings->button_size : '';
		$button_classes .= (isset($settings->button_type) && $settings->button_type) ? ' sppb-btn-' . $settings->button_type : '';
		$button_classes .= (isset($settings->button_shape) && $settings->button_shape) ? ' sppb-btn-' . $settings->button_shape: ' sppb-btn-rounded';
		$button_classes .= (isset($settings->button_appearance) && $settings->button_appearance) ? ' sppb-btn-' . $settings->button_appearance : '';
		$button_classes .= (isset($settings->button_block) && $settings->button_block) ? ' ' . $settings->button_block : '';
		$button_icon = (isset($settings->button_icon) && $settings->button_icon) ? $settings->button_icon : '';
		$button_icon_position = (isset($settings->button_icon_position) && $settings->button_icon_position) ? $settings->button_icon_position: 'left';
		$button_position = (isset($settings->button_position) && $settings->button_position) ? $settings->button_position : '';
		$button_attribs = (isset($settings->button_target) && $settings->button_target) ? ' rel="noopener noreferrer" target="' . $settings->button_target . '"' : '';
		$button_attribs .= (isset($settings->button_url) && $settings->button_url) ? ' href="' . $settings->button_url . '"' : '';
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$featured = (isset($settings->featured) && $settings->featured) ? $settings->featured : '';

		$icon_arr = array_filter(explode(' ', $button_icon));
		if (count($icon_arr) === 1) {
			$button_icon = 'fa ' . $button_icon;
		}

		if($button_icon_position == 'left') {
			$button_text = ($button_icon) ? '<i class="' . $button_icon . '" aria-hidden="true"></i> ' . $button_text : $button_text;
		} else {
			$button_text = ($button_icon) ? $button_text . ' <i class="' . $button_icon . '" aria-hidden="true"></i>' : $button_text;
		}

		$button_output = ($button_text) ? '<a' . $button_attribs . ' id="btn-'. $this->addon->id .'" class="sppb-btn' . $button_classes . '">' . $button_text . '</a>' : '';

		$pricesymbol = ($price_symbol) ? '<span class="sppb-pricing-price-symbol">' . $price_symbol . '</span>' : '';

		//Output
		$output  = '<div class="sppb-addon sppb-addon-pricing-table ' . $alignment . ' ' . $class . '">';
		$output .= '<div class="sppb-pricing-box '. $featured .'">';
		$output .= '<div class="sppb-pricing-header">';

		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title sppb-pricing-title">' . $title . '</'.$heading_selector.'>' : '';
		if($price_position == 'after' ){
			$output .= '<div class="sppb-pricing-price-container">';
			$output .= ($price) ? '<span class="sppb-pricing-price">' . $pricesymbol . $price . '</span>' : '';
			$output .= ($duration) ? '<span class="sppb-pricing-duration">' . $duration . '</span>' : '';
			$output .= '</div>';
		}
		$output .= '</div>';

		if($pricing_content) {
			$output .= '<div class="sppb-pricing-features">';
			$output .= '<ul>';

			$features = explode("\n", $pricing_content);

			foreach ($features as $feature) {
				$output .= '<li>' . $feature . '</li>';
			}

			$output .= '</ul>';
			$output .= '</div>';
		}

		if($price_position == 'before' ){
			$output .= '<div class="sppb-pricing-price-container">';
			$output .= ($price) ? '<span class="sppb-pricing-price after">' . $pricesymbol . $price . '</span>' : '';
			$output .= ($duration) ? '<span class="sppb-pricing-duration">' . $duration . '</span>' : '';
			$output .= '</div>';
		}

		$output .= '<div class="sppb-pricing-footer">';
		$output .= $button_output;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css() {

		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$css = '';
		$style = '';

		$price_symbol_style = '';
		$price_symbol_style_sm = '';
		$price_symbol_style_xs = '';

		$price_style = '';
		$price_style_sm = '';
		$price_style_xs = '';

		$duration_style = '';
		$duration_style_sm = '';
		$duration_style_xs = '';

		$pricing_content_style = '';
		$pricing_content_style_sm = '';
		$pricing_content_style_xs = '';

		$price_style .= (isset($settings->price_color) && $settings->price_color) ? 'color: '. $settings->price_color .';' : '';

		$price_style .= (isset($settings->price_font_size) && $settings->price_font_size) ? 'font-size: '. $settings->price_font_size .'px; line-height: '. $settings->price_font_size .'px;' : '';
		$price_style .= (isset($settings->price_font_weight) && $settings->price_font_weight) ? 'font-weight: '. $settings->price_font_weight .';' : '';
		$price_style_sm .= (isset($settings->price_font_size_sm) && $settings->price_font_size_sm) ? 'font-size: '. $settings->price_font_size_sm .'px; line-height: '. $settings->price_font_size_sm .'px;' : '';
		$price_style_xs .= (isset($settings->price_font_size_xs) && $settings->price_font_size_xs) ? 'font-size: '. $settings->price_font_size_xs .'px; line-height: '. $settings->price_font_size_xs .'px;' : '';

		$price_symbol_style .= (isset($settings->price_symbol_color) && $settings->price_symbol_color) ? 'color: '. $settings->price_symbol_color .';' : '';
		$price_symbol_style .= (isset($settings->price_symbol_alignment) && $settings->price_symbol_alignment) ? 'vertical-align: '. $settings->price_symbol_alignment .';' : '';

		$price_symbol_style .= (isset($settings->price_symbol_font_size) && $settings->price_symbol_font_size) ? 'font-size: '. $settings->price_symbol_font_size .'px;' : '';
		$price_symbol_style_sm .= (isset($settings->price_symbol_font_size_sm) && $settings->price_symbol_font_size_sm) ? 'font-size: '. $settings->price_symbol_font_size_sm .'px;' : '';
		$price_symbol_style_xs .= (isset($settings->price_symbol_font_size_xs) && $settings->price_symbol_font_size_xs) ? 'font-size: '. $settings->price_symbol_font_size_xs .'px;' : '';

		$duration_style .= (isset($settings->duration_color) && $settings->duration_color) ? 'color: '. $settings->duration_color .';' : '';

		$duration_style .= (isset($settings->duration_font_size) && $settings->duration_font_size) ? 'font-size: '. $settings->duration_font_size .'px;' : '';
		$duration_style_sm .= (isset($settings->duration_font_size_sm) && $settings->duration_font_size_sm) ? 'font-size: '. $settings->duration_font_size_sm .'px;' : '';
		$duration_style_xs .= (isset($settings->duration_font_size_xs) && $settings->duration_font_size_xs) ? 'font-size: '. $settings->duration_font_size_xs .'px;' : '';

		$pricing_content_style .= (isset($settings->pricing_content_color) && $settings->pricing_content_color) ? 'color: '. $settings->pricing_content_color .';' : '';

		$pricing_content_style .= (isset($settings->pricing_content_font_size) && $settings->pricing_content_font_size) ? 'font-size: '. $settings->pricing_content_font_size .'px; line-height: '. $settings->pricing_content_font_size .'px;' : '';
		$pricing_content_style_sm .= (isset($settings->pricing_content_font_size_sm) && $settings->pricing_content_font_size_sm) ? 'font-size: '. $settings->pricing_content_font_size_sm .'px; line-height: '. $settings->pricing_content_font_size_sm .'px;' : '';
		$pricing_content_style_xs .= (isset($settings->pricing_content_font_size_xs) && $settings->pricing_content_font_size_xs) ? 'font-size: '. $settings->pricing_content_font_size_xs .'px; line-height: '. $settings->pricing_content_font_size_xs .'px;' : '';

		$pricing_content_style .= (isset($settings->pricing_content_gap) && $settings->pricing_content_gap) ? 'margin-bottom: '. $settings->pricing_content_gap .'px;' : '';
		$pricing_content_style_sm .= (isset($settings->pricing_content_gap_sm) && $settings->pricing_content_gap_sm) ? 'margin-bottom: '. $settings->pricing_content_gap_sm .'px;' : '';
		$pricing_content_style_xs .= (isset($settings->pricing_content_gap_xs) && $settings->pricing_content_gap_xs) ? 'margin-bottom: '. $settings->pricing_content_gap_xs .'px;' : '';

		$price_container_style = (isset($settings->price_margin_bottom) && $settings->price_margin_bottom) ? 'margin-bottom: '. $settings->price_margin_bottom .'px;' : '';
		$price_container_style .= (isset($settings->price_padding_bottom) && $settings->price_padding_bottom) ? 'padding-bottom: '. $settings->price_padding_bottom .'px;' : '';
		$price_container_style .= (isset($settings->price_border_bottom) && $settings->price_border_bottom) ? 'border-width: 0 0 '. $settings->price_border_bottom .'px;border-style:solid;' : '';
		$price_container_style .= (isset($settings->price_border_bottom_color) && $settings->price_border_bottom_color) ? 'border-color: '. $settings->price_border_bottom_color .';' : '';
		$price_container_style_sm = (isset($settings->price_margin_bottom_sm) && $settings->price_margin_bottom_sm) ? 'margin-bottom: '. $settings->price_margin_bottom_sm .'px;' : '';
		$price_container_style_sm .= (isset($settings->price_padding_bottom_sm) && $settings->price_padding_bottom_sm) ? 'padding-bottom: '. $settings->price_padding_bottom_sm .'px;' : '';
		$price_container_style_xs = (isset($settings->price_margin_bottom_xs) && $settings->price_margin_bottom_xs) ? 'margin-bottom: '. $settings->price_margin_bottom_xs .'px;' : '';
		$price_container_style_xs .= (isset($settings->price_padding_bottom) && $settings->price_padding_bottom) ? 'padding-bottom: '. $settings->price_padding_bottom .'px;' : '';

		$pricing_content_margin_bottom = (isset($settings->pricing_content_margin_bottom) && $settings->pricing_content_margin_bottom) ? 'margin-bottom: '. $settings->pricing_content_margin_bottom .'px;' : '';
		$pricing_content_margin_bottom_sm = (isset($settings->pricing_content_margin_bottom_sm) && $settings->pricing_content_margin_bottom_sm) ? 'margin-bottom: '. $settings->pricing_content_margin_bottom_sm .'px;' : '';
		$pricing_content_margin_bottom_xs = (isset($settings->pricing_content_margin_bottom_xs) && $settings->pricing_content_margin_bottom_xs) ? 'margin-bottom: '. $settings->pricing_content_margin_bottom_xs .'px;' : '';

		if($style) {
			$css .= $addon_id . ' .sppb-pricing-box {';
			$css .= $style;
			$css .= '}';
		}

		if($price_style){
			$css .= $addon_id . ' .sppb-pricing-price {';
			$css .= $price_style;
			$css .= '}';
		}
		if($price_symbol_style){
			$css .= $addon_id . ' .sppb-pricing-price-symbol {';
			$css .= $price_symbol_style;
			$css .= '}';
		}
		if($duration_style){
			$css .= $addon_id . ' .sppb-pricing-duration {';
			$css .= $duration_style;
			$css .= '}';
		}

		if($pricing_content_margin_bottom){
			$css .= $addon_id . ' .sppb-pricing-features {';
			$css .= $pricing_content_margin_bottom;
			$css .= '}';
		}

		if($pricing_content_style) {
			$css .= $addon_id . ' .sppb-pricing-features ul li {';
			$css .= $pricing_content_style;
			$css .= '}';
		}

		if($price_container_style) {
			$css .= $addon_id . ' .sppb-pricing-price-container {';
			$css .= $price_container_style;
			$css .= '}';
		}

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($price_style_sm){
				$css .= $addon_id . ' .sppb-pricing-price {';
				$css .= $price_style_sm;
				$css .= '}';
			}
			if($price_symbol_style_sm){
				$css .= $addon_id . ' .sppb-pricing-price-symbol {';
				$css .= $price_symbol_style_sm;
				$css .= '}';
			}
			if($duration_style_sm){
				$css .= $addon_id . ' .sppb-pricing-duration {';
				$css .= $duration_style_sm;
				$css .= '}';
			}

			if($pricing_content_margin_bottom_sm){
				$css .= $addon_id . ' .sppb-pricing-features {';
				$css .= $pricing_content_margin_bottom_sm;
				$css .= '}';
			}

			if($pricing_content_style_sm){
				$css .= $addon_id . ' .sppb-pricing-features ul li {';
				$css .= $pricing_content_style_sm;
				$css .= '}';
			}

			if($price_container_style_sm){
				$css .= $addon_id . ' .sppb-pricing-price-container {';
				$css .= $price_container_style_sm;
				$css .= '}';
			}
		$css .= '}';

		$css .= '@media (max-width: 767px) {';
			if($price_style_xs){
				$css .= $addon_id . ' .sppb-pricing-price {';
				$css .= $price_style_xs;
				$css .= '}';
			}
			if($price_symbol_style_xs){
				$css .= $addon_id . ' .sppb-pricing-price-symbol {';
				$css .= $price_symbol_style_xs;
				$css .= '}';
			}
			if($duration_style_xs){
				$css .= $addon_id . ' .sppb-pricing-duration {';
				$css .= $duration_style_xs;
				$css .= '}';
			}

			if($pricing_content_margin_bottom_xs){
				$css .= $addon_id . ' .sppb-pricing-features {';
				$css .= $pricing_content_margin_bottom_xs;
				$css .= '}';
			}

			if($pricing_content_style_xs){
				$css .= $addon_id . ' .sppb-pricing-features ul li {';
				$css .= $pricing_content_style_xs;
				$css .= '}';
			}

			if($price_container_style_xs){
				$css .= $addon_id . ' .sppb-pricing-price-container {';
				$css .= $price_container_style_xs;
				$css .= '}';
			}
		$css .= '}';

		// Button css
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path = new JLayoutFile('addon.css.button', $layout_path);
		$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $settings, 'id' => 'btn-' . $this->addon->id));

		//Hover style
		$pricing_hover_bg = (isset($settings->pricing_hover_bg) && $settings->pricing_hover_bg) ? 'background: '. $settings->pricing_hover_bg .';' : '';
		$pricing_hover_color = (isset($settings->pricing_hover_color) && $settings->pricing_hover_color) ? 'color: '. $settings->pricing_hover_color .';' : '';
		$pricing_hover_border_color = (isset($settings->pricing_hover_border_color) && $settings->pricing_hover_border_color) ? 'border-color: '. $settings->pricing_hover_border_color .';' : '';

		$pricing_hover_style = '';
		$pricing_hover_style .= (isset($settings->pricing_hover_scale) && $settings->pricing_hover_scale) ? 'transform: scale('. $settings->pricing_hover_scale .');' : '';

		$pricing_hover_boxshadow = (isset($settings->pricing_hover_boxshadow) && $settings->pricing_hover_boxshadow) ? $settings->pricing_hover_boxshadow : '';
		if(is_object($pricing_hover_boxshadow)){
			$ho = (isset($pricing_hover_boxshadow->ho) && $pricing_hover_boxshadow->ho != '') ? $pricing_hover_boxshadow->ho.'px' : '0px';
			$vo = (isset($pricing_hover_boxshadow->vo) && $pricing_hover_boxshadow->vo != '') ? $pricing_hover_boxshadow->vo.'px' : '0px';
			$blur = (isset($pricing_hover_boxshadow->blur) && $pricing_hover_boxshadow->blur != '') ? $pricing_hover_boxshadow->blur.'px' : '0px';
			$spread = (isset($pricing_hover_boxshadow->spread) && $pricing_hover_boxshadow->spread != '') ? $pricing_hover_boxshadow->spread.'px' : '0px';
			$color = (isset($pricing_hover_boxshadow->color) && $pricing_hover_boxshadow->color != '') ? $pricing_hover_boxshadow->color : '#fff';
			$pricing_hover_style .= "box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};";
		} else {
			$pricing_hover_style .= "box-shadow: " . $pricing_hover_boxshadow . ";";
		}

		if($pricing_hover_style){
			$css .= $addon_id . ' .sppb-pricing-header .sppb-pricing-duration';
			$css .= $addon_id . ' .sppb-pricing-header .sppb-pricing-price';
			$css .= $addon_id . ' .sppb-pricing-header .sppb-addon-title,';
			$css .= $addon_id . ' .sppb-pricing-features ul li,';
			$css .= $addon_id . ' .sppb-pricing-price-container,';
			$css .= $addon_id . ' {';
			$css .= 'transition:.4s;';
			$css .= '}';
			$css .= $addon_id . ':hover {';
			$css .= $pricing_hover_style;
			$css .= $pricing_hover_bg;
			$css .= '}';
			$css .= $addon_id . ':hover .sppb-pricing-header .sppb-pricing-duration,';
			$css .= $addon_id . ':hover .sppb-pricing-header .sppb-pricing-price,';
			$css .= $addon_id . ':hover .sppb-pricing-header .sppb-addon-title,';
			$css .= $addon_id . ':hover .sppb-pricing-features ul li {';
			$css .= $pricing_hover_color;
			$css .= '}';
			$css .= $addon_id . ':hover .sppb-pricing-price-container {';
			$css .= $pricing_hover_border_color;
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate(){

		$output ='
		<#
			let price_position = data.price_position || "before";

			var heading_selector = data.heading_selector || "div";

			let price_symbol = "";
			if(data.price_symbol){
				price_symbol = \'<span class="sppb-pricing-price-symbol">\'+data.price_symbol+\'</span>\';
			}

			let buttonText = "";
			let buttonAttribs = (data.button_target)? " target=\""+ data.button_target +"\"":"";
			buttonAttribs += (data.button_url)? " href=\""+ data.button_url +"\"":""

			let buttonClasses = (data.button_size)? " sppb-btn-"+ data.button_size : "";
			buttonClasses += (data.button_type)? " sppb-btn-"+ data.button_type : ""
			buttonClasses += (data.button_shape)? " sppb-btn-"+ data.button_shape : ""
			buttonClasses += (data.button_appearance)? " sppb-btn-"+ data.button_appearance : ""
			buttonClasses += (data.button_block)? " "+ data.button_block : ""

			let icon_arr = (typeof data.button_icon !== "undefined" && data.button_icon) ? data.button_icon.split(" ") : "";
			let icon_name = icon_arr.length === 1 ? "fa "+data.button_icon : data.button_icon;

			if ( data.button_icon_position == "left" ) {
				buttonText = ( data.button_icon )? ` <i class="${icon_name}"></i> ` + data.button_text : data.button_text
			} else {
				buttonText = ( data.button_icon )? data.button_text + ` <i class="${icon_name}"></i> ` : data.button_text
			}

			let buttonOutput = (buttonText)? "<a" + buttonAttribs + " id=\"btn-" + data.id + "\" class=\"sppb-btn"+ buttonClasses + "\">"+ buttonText +"</a>":""
			
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
			<# if( _.isObject(data.price_margin_bottom)) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
					margin-bottom: {{data.price_margin_bottom.md}}px;
				}
			<# } else { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
					margin-bottom: {{data.price_margin_bottom}}px;
				}
			<# } #>
			<# if(_.isObject(data.price_padding_bottom)) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
					padding-bottom: {{data.price_padding_bottom.md}}px;
				}
			<# } else { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
					padding-bottom: {{data.price_padding_bottom}}px;
				}
			<# } #>
			<# if(data.price_border_bottom || data.price_border_bottom_color) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
					border-width: 0 0 {{data.price_border_bottom}}px;
					border-style: solid;
					border-color: {{data.price_border_bottom_color}};
				}
			<# } #>
			<# if( data.price_color ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price {
					color: {{data.price_color}};
				}
			<# } #>

			#sppb-addon-{{ data.id }} .sppb-pricing-price {
				<# if( _.isObject(data.price_font_size) ) { #>
					font-size: {{data.price_font_size.md}}px;
					line-height: {{data.price_font_size.md}}px;
				<# } else { #>
						font-size: {{data.price_font_size}}px;
						line-height: {{data.price_font_size}}px;
				<# } #>
				font-weight: {{data.price_font_weight}};
			}

			<# if( data.price_symbol_color ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-symbol {
					color: {{data.price_symbol_color}};
				}
			<# } #>

			<# if( data.price_symbol_alignment ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-symbol {
					vertical-align: {{data.price_symbol_alignment}};
				}
			<# } #>

			<# if( _.isObject(data.price_symbol_font_size) ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-price-symbol {
					font-size: {{data.price_symbol_font_size.md}}px;
					line-height: {{data.price_symbol_font_size.md}}px;
				}
			<# } #>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if( _.isObject(data.price_symbol_font_size) ) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price-symbol {
						font-size: {{data.price_symbol_font_size.sm}}px;
						line-height: {{data.price_symbol_font_size.sm}}px;
					}
				<# } #>
				<# if( _.isObject(data.price_font_size) ) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price {
						font-size: {{data.price_font_size.sm}}px;
						line-height: {{data.price_font_size.sm}}px;
					}
				<# } #>
				<# if( _.isObject(data.price_margin_bottom)) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
						margin-bottom: {{data.price_margin_bottom.sm}}px;
					}
				<# } #>
				<# if( _.isObject(data.price_padding_bottom)) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
						padding-bottom: {{data.price_padding_bottom.sm}}px;
					}
				<# } #>
			}
			@media (max-width: 767px) {
				<# if( _.isObject(data.price_symbol_font_size) ) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price-symbol {
						font-size: {{data.price_symbol_font_size.xs}}px;
						line-height: {{data.price_symbol_font_size.xs}}px;
					}
				<# } #>
				<# if( _.isObject(data.price_font_size) ) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price {
						font-size: {{data.price_font_size.xs}}px;
						line-height: {{data.price_font_size.xs}}px;
					}
				<# } #>
				<# if( _.isObject(data.price_margin_bottom)) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
						margin-bottom: {{data.price_margin_bottom.xs}}px;
					}
				<# } #>
				<# if( _.isObject(data.price_padding_bottom)) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-price-container {
						padding-bottom: {{data.price_padding_bottom.xs}}px;
					}
				<# } #>
			}

			<# if( data.duration_color ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-duration {
					color: {{data.duration_color}};
				}
			<# } #>
			<# if( _.isObject(data.duration_font_size) ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-duration {
					font-size: {{data.duration_font_size.md}}px;
					line-height: {{data.duration_font_size.md}}px;
				}
			<# } #>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if( _.isObject(data.duration_font_size) ) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-duration {
						font-size: {{data.duration_font_size.sm}}px;
						line-height: {{data.duration_font_size.sm}}px;
					}
				<# } #>
			}
			@media (max-width: 767px) {
				<# if( _.isObject(data.duration_font_size) ) { #>
					#sppb-addon-{{ data.id }} .sppb-pricing-duration {
						font-size: {{data.duration_font_size.xs}}px;
						line-height: {{data.duration_font_size.xs}}px;
					}
				<# } #>
			}

			<# if(_.isObject(data.pricing_content_gap)){ #>
				#sppb-addon-{{ data.id }} .sppb-pricing-features ul li {
					margin-bottom: {{data.pricing_content_gap.md}}px;
				}
			<# } #>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if(_.isObject(data.pricing_content_gap)){ #>
					#sppb-addon-{{ data.id }} .sppb-pricing-features ul li {
						margin-bottom: {{data.pricing_content_gap.sm}}px;
					}
				<# } #>
			}
			@media (max-width: 767px) {
				<# if(_.isObject(data.pricing_content_gap)){ #>
					#sppb-addon-{{ data.id }} .sppb-pricing-features ul li {
						margin-bottom: {{data.pricing_content_gap.xs}}px;
					}
				<# } #>
			}

			<# if( _.isObject(data.pricing_content_font_size) ) { #>
				#sppb-addon-{{ data.id }} .sppb-pricing-features ul li {
					font-size: {{data.pricing_content_font_size.md}}px;
					line-height: {{data.pricing_content_font_size.md}}px;
				}
			<# } #>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if(_.isObject(data.pricing_content_font_size)){ #>
					#sppb-addon-{{ data.id }} .sppb-pricing-features ul li {
						font-size: {{data.pricing_content_font_size.sm}}px;
						line-height: {{data.pricing_content_font_size.sm}}px;
					}
				<# } #>
			}
			@media (max-width: 767px) {
				<# if(_.isObject(data.pricing_content_font_size)){ #>
					#sppb-addon-{{ data.id }} .sppb-pricing-features ul li {
						font-size: {{data.pricing_content_font_size.xs}}px;
						line-height: {{data.pricing_content_font_size.xs}}px;
					}
				<# } #>
			}

			<# if(_.isObject(data.pricing_content_margin_bottom)){ #>
				#sppb-addon-{{ data.id }} .sppb-pricing-features {
					margin-bottom: {{data.pricing_content_margin_bottom.md}}px;
				}
			<# } #>
			@media (min-width: 768px) and (max-width: 991px) {
				<# if(_.isObject(data.pricing_content_margin_bottom)){ #>
					#sppb-addon-{{ data.id }} .sppb-pricing-features {
						margin-bottom: {{data.pricing_content_margin_bottom.sm}}px;
					}
				<# } #>
			}
			@media (max-width: 767px) {
				<# if(_.isObject(data.pricing_content_margin_bottom)){ #>
					#sppb-addon-{{ data.id }} .sppb-pricing-features {
						margin-bottom: {{data.pricing_content_margin_bottom.xs}}px;
					}
				<# } #>
			}

			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.button_type }}{
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
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
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

				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom:hover{
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
					#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
						padding: {{ button_padding_sm }};
					}
				}
				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
						padding: {{ button_padding_xs }};
					}
				}
			<# }

			let pricing_hover_style = "";
			pricing_hover_style += (!_.isEmpty(data.pricing_hover_scale) && data.pricing_hover_scale) ? `transform: scale(${data.pricing_hover_scale});` : "";
			if(_.isObject(data.pricing_hover_boxshadow)){
				let ho = (!_.isEmpty(data.pricing_hover_boxshadow.ho) && data.pricing_hover_boxshadow.ho != "") ? data.pricing_hover_boxshadow.ho+\'px\' : "0px";
				let vo = (!_.isEmpty(data.pricing_hover_boxshadow.vo) && data.pricing_hover_boxshadow.vo != "") ? data.pricing_hover_boxshadow.vo+\'px\' : "0px";
				let blur = (!_.isEmpty(data.pricing_hover_boxshadow.blur) && data.pricing_hover_boxshadow.blur != "") ? data.pricing_hover_boxshadow.blur+\'px\' : "0px";
				let spread = (!_.isEmpty(data.pricing_hover_boxshadow.spread) && data.pricing_hover_boxshadow.spread != "") ? data.pricing_hover_boxshadow.spread+\'px\' : "0px";
				let color = (!_.isEmpty(data.pricing_hover_boxshadow.color) && data.pricing_hover_boxshadow.color != "") ? data.pricing_hover_boxshadow.color : "#fff";
				pricing_hover_style += `box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};`;
			} else {
				pricing_hover_style += `box-shadow: ${data.pricing_hover_boxshadow};`;
			}

			if(pricing_hover_style){
			#>
				#sppb-addon-{{ data.id }} .sppb-pricing-header .sppb-pricing-duration,
				#sppb-addon-{{ data.id }} .sppb-pricing-header .sppb-pricing-price,
				#sppb-addon-{{ data.id }} .sppb-pricing-header .sppb-addon-title,
				#sppb-addon-{{ data.id }} .sppb-pricing-features ul li,
				#sppb-addon-{{ data.id }} .sppb-pricing-price-container,
				#sppb-addon-{{ data.id }} {
					transition:.4s;
				}
				#sppb-addon-{{ data.id }}:hover {
					{{pricing_hover_style}};
					background:{{data.pricing_hover_bg}};
				}
				#sppb-addon-{{ data.id }}:hover .sppb-pricing-header .sppb-pricing-duration,
				#sppb-addon-{{ data.id }}:hover .sppb-pricing-header .sppb-pricing-price,
				#sppb-addon-{{ data.id }}:hover .sppb-pricing-header .sppb-addon-title,
				#sppb-addon-{{ data.id }}:hover .sppb-pricing-features ul li {
					color:{{data.pricing_hover_color}};
				}
				#sppb-addon-{{ data.id }}:hover .sppb-pricing-price-container {
					border-color:{{data.pricing_hover_border_color}};
				}
			<# } #>
		</style>

		<div class="sppb-addon sppb-addon-pricing-table {{ data.alignment }} {{ data.class }}">
			<div class="sppb-pricing-box {{ data.featured }}">
				<div class="sppb-pricing-header">
					<# if( data.title ) { #>
						<{{ heading_selector }} class="sppb-addon-title sppb-pricing-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ heading_selector }}>
					<# } #>
					<# if( price_position == "after" ) { #>
						<div class="sppb-pricing-price-container">
							<# if( data.price ) { #>
								<span class="sppb-pricing-price">{{{ price_symbol }}}{{ data.price }}</span>
							<# } #>
							<# if( data.duration ) { #>
								<span class="sppb-pricing-duration">{{ data.duration }}</span>
							<# } #>
						</div>
					<# } #>
				</div>

				<# if(data.pricing_content) { #>
					<div class="sppb-pricing-features">
						<ul>
							<# let pContentArray = data.pricing_content.split("\n") #>
							<# _.each(pContentArray,function(item,index){ #>
								<# if(item) { #> <li>{{{ item }}}</li><# } #>
							<# }) #>
						</ul>
					</div>
				<# } #>
				<# if( price_position == "before" ) { #>
					<div class="sppb-pricing-price-container">
						<# if( data.price ) { #>
							<span class="sppb-pricing-price">{{{ price_symbol }}}{{ data.price }}</span>
						<# } #>
						<# if( data.duration ) { #>
							<span class="sppb-pricing-duration">{{ data.duration }}</span>
						<# } #>
					</div>
				<# } #>
				<div class="sppb-pricing-footer">{{{ buttonOutput }}}</div>
			</div>
		</div>
		';

		return $output;
	}

}
