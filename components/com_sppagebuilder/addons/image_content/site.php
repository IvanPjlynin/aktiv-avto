<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonImage_content extends SppagebuilderAddons{

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';

		//Options
		$image = (isset($settings->image) && $settings->image) ? $settings->image : '';
		$image_src = isset($image->src) ? $image->src : $image;
		$image_alignment = (isset($settings->image_alignment) && $settings->image_alignment) ? $settings->image_alignment : '';
		$text = (isset($settings->text) && $settings->text) ? $settings->text : '';
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

		$icon_arr = array_filter(explode(' ', $button_icon));
		if (count($icon_arr) === 1) {
			$button_icon = 'fa ' . $button_icon;
		}

		if($button_icon_position == 'left') {
			$button_text = ($button_icon) ? '<i class="' . $button_icon . '" aria-hidden="true"></i> ' . $button_text : $button_text;
		} else {
			$button_text = ($button_icon) ? $button_text . ' <i class="' . $button_icon . '" aria-hidden="true"></i>' : $button_text;
		}

		$button_output = !empty($button_text) ? '<a' . $button_attribs . ' id="btn-'. $this->addon->id .'" class="sppb-btn' . $button_classes . '">' . $button_text . '</a>' : '';

		if($image_alignment=='left') {
			$content_class = ' sppb-col-sm-offset-6';
		} else {
			$content_class = '';
		}

		if($image_src && $text) {

			$output  = '<div class="sppb-addon sppb-addon-image-content aligment-'. $image_alignment .' clearfix ' . $class . '">';

			//Image
			if(strpos($image_src, 'http://') !== false || strpos($image_src, 'https://') !== false){
				$output .= '<div class="sppb-image-holder" style="background-image: url(' . $image_src . ');" role="img" aria-label="'. strip_tags($title) .'">';
			} else {
				$output .= '<div class="sppb-image-holder" style="background-image: url(' . JURI::base(true) . '/' . $image_src . ');" role="img" aria-label="'. strip_tags($title) .'">';
			}
			$output .= '</div>';

			//Content
			$output .= '<div class="sppb-container">';
			$output .= '<div class="sppb-row">';

			if($image_alignment=='left') {
				$output .= '<div class="sppb-col-sm-6"></div>';
			}

			$output .= '<div class="sppb-col-sm-6'. $content_class .'">';
			$output .= '<div class="sppb-content-holder">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-image-content-title sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= ($text) ? '<p class="sppb-image-content-text">' . $text . '</p>' : '';

			$output .= $button_output;

			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

			$output .= '</div>';

			return $output;
		}

		return;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path = new JLayoutFile('addon.css.button', $layout_path);
		$settings = $this->addon->settings;
		$css = '';

		$padding = (isset($settings->content_padding)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_padding, 'padding') : '';
		$padding_sm = (isset($settings->content_padding_sm)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_padding_sm, 'padding') : '';
		$padding_xs = (isset($settings->content_padding_xs)) ? SppagebuilderHelperSite::getPaddingMargin($settings->content_padding_xs, 'padding') : '';

		
		$css .= (!empty($padding)) ? $addon_id .' .sppb-addon-image-content .sppb-content-holder{'.$padding.'}' : '';
		$css .= (!empty($padding_sm)) ? '@media (min-width: 768px) and (max-width: 991px) {'.$addon_id.' .sppb-addon-image-content .sppb-content-holder{'.$padding_sm.'}}' : '';
		$css .= (!empty($padding_xs)) ? '@media (max-width: 767px) {'.$addon_id.' .sppb-addon-image-content .sppb-content-holder{'.$padding_xs.'}}' : '';

		$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $settings, 'id' => 'btn-' . $this->addon->id));

		return $css;
	}

	public static function getTemplate() {
		$output = '
		<#
			var content_class = "";
			if(data.image_alignment == "left") {
				content_class = " sppb-col-sm-offset-6";
			}

			var button_text = data.button_text;
			let icon_arr = (typeof data.button_icon !== "undefined" && data.button_icon) ? data.button_icon.split(" ") : "";
			let icon_name = icon_arr.length === 1 ? "fa "+data.button_icon : data.button_icon;

			if(data.button_icon_position == "left" && data.button_icon) {
				button_text = \'<i class="\' + icon_name + \'"></i> \' + data.button_text;
			} else if(data.button_icon){
				button_text = data.button_text + \' <i class="\' + icon_name + \'"></i>\';
			}

			var button_classes = "";

			if(data.button_size){
				button_classes = button_classes + " sppb-btn-" + data.button_size;
			}

			if(data.button_type){
				button_classes = button_classes + " sppb-btn-" + data.button_type;
			}

			if(data.button_shape){
				button_classes = button_classes + " sppb-btn-" + data.button_shape;
			} else {
				button_classes = button_classes + " sppb-btn-rounded";
			}

			if(data.button_appearance){
				button_classes = button_classes + " sppb-btn-" + data.button_appearance;
			}

			if(data.button_block){
				button_classes = button_classes + " " + data.button_block;
			}

			var button_fontstyle = data.button_font_style || "";

			var padding = "";
			var padding_sm = "";
			var padding_xs = "";
			if(data.content_padding){
				if(_.isObject(data.content_padding)){
					if(data.content_padding.md.trim() !== ""){
						padding = data.content_padding.md.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}

					if(data.content_padding.sm.trim() !== ""){
						padding_sm = data.content_padding.sm.split(" ").map(item => {
							if(_.isEmpty(item)){
								return "0";
							}
							return item;
						}).join(" ")
					}

					if(data.content_padding.xs.trim() !== ""){
						padding_xs = data.content_padding.xs.split(" ").map(item => {
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
			<#
				var img = {}
				if (typeof data.image !== "undefined" && typeof data.image.src !== "undefined") {
					img = data.image
				} else {
					img = {src: data.image}
				}
			#>
			
			#sppb-addon-{{ data.id }} .sppb-image-holder{
				<# if(img.src?.indexOf("https://") == -1 && img.src?.indexOf("https://") == -1){ #>
					background-image: url({{ pagebuilder_base + img.src }});
				<# } else { #>
					background-image: url({{ img.src }});
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-addon-image-content .sppb-content-holder{
				padding: {{ padding }};
			}
			#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.button_type }}{
				letter-spacing: {{ data.button_letterspace }};
				<# if(typeof data.button_margin_top !== "undefined" && typeof data.button_margin_top.md !== "undefined"){ #>
					margin-top: {{ data.button_margin_top.md }}px;
				<# } #>
				<# if(_.isObject(button_fontstyle)) { #>
					<# if(button_fontstyle.underline == 1){ #>
						text-decoration: underline;
					<# } #>
					<# if(button_fontstyle.uppercase == 1){ #>
						text-transform: uppercase;
					<# } #>
					<# if(button_fontstyle.italic == 1){ #>
						font-style: italic;
					<# } #>
					<# if(button_fontstyle.weight == 100){ #>
						font-weight: 100;
					<# } else if(button_fontstyle.weight == 200){#>
						font-weight: 200;
					<# } else if(button_fontstyle.weight == 300){#>
						font-weight: 300;
					<# } else if(button_fontstyle.weight == 400){#>
						font-weight: 400;
					<# } else if(button_fontstyle.weight == 500){#>
						font-weight: 500;
					<# } else if(button_fontstyle.weight == 600){#>
						font-weight: 600;
					<# } else if(button_fontstyle.weight == 700){#>
						font-weight: 700;
					<# } else if(button_fontstyle.weight == 800){#>
						font-weight: 800;
					<# } else if(button_fontstyle.weight == 900){#>
						font-weight: 900;
					<# } #>
				<# } #>
			}

			<# if(data.button_type == "custom"){ #>
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
					color: {{ data.button_color }};
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
					<# if(data.appearance == "outline"){ #>
						border-color: {{ data.button_background_color_hover }};
					<# } else if(data.button_appearance == "gradient"){ #>
						<# if(typeof data.button_background_gradient_hover.type !== "undefined" && data.button_background_gradient_hover.type == "radial"){ #>
							background-image: radial-gradient(at {{ data.button_background_gradient_hover.radialPos || "center center"}}, {{ data.button_background_gradient_hover.color }} {{ data.button_background_gradient_hover.pos || 0 }}%, {{ data.button_background_gradient_hover.color2 }} {{ data.button_background_gradient_hover.pos2 || 100 }}%);
						<# } else { #>
							background-image: linear-gradient({{ data.button_background_gradient_hover.deg || 0}}deg, {{ data.button_background_gradient_hover.color }} {{ data.button_background_gradient_hover.pos || 0 }}%, {{ data.button_background_gradient_hover.color2 }} {{ data.button_background_gradient_hover.pos2 || 100 }}%);
						<# } #>
					<# } #>
				}
			<# } #>

			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }} .sppb-addon-image-content .sppb-content-holder{
					padding: {{ padding_sm }};
				}
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.button_type }}{
					<# if(typeof data.button_margin_top !== "undefined" && typeof data.button_margin_top.sm !== "undefined"){ #>
						margin-top: {{ data.button_margin_top.sm }}px;
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }} .sppb-addon-image-content .sppb-content-holder{
					padding: {{ padding_xs }};
				}
				#sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.button_type }}{
					<# if(typeof data.button_margin_top !== "undefined" && typeof data.button_margin_top.xs !== "undefined"){ #>
						margin-top: {{ data.button_margin_top.xs }}px;
					<# } #>
				}
			}
		</style>
		<div class="sppb-addon sppb-addon-image-content aligment-{{ data.image_alignment }} clearfix {{ data.class }}">
			<div class="sppb-image-holder"></div>
			<div class="sppb-container">
				<div class="sppb-row">
					<# if(data.image_alignment == "left") { #>
						<div class="sppb-col-sm-6"></div>
					<# } #>
					<div class="sppb-col-sm-6 {{ content_class }}">
						<div class="sppb-content-holder">
                            <# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-image-content-title sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
                            <# if(data.text){ #><p id="addon-text-{{data.id}}" class="sppb-image-content-text sp-editable-content" data-id={{data.id}} data-fieldName="text">{{{ data.text }}}</p><# } #>
						    <# if(button_text){ #>
                                <a href=\'{{ data.button_url }}\' target="{{ data.button_target }}" id="btn-{{ data.id }}" class="sppb-btn {{ button_classes }}">{{{ button_text }}}</a>
							<# } #>
						</div>
					</div>
				</div>
			</div>
		</div>
		';

		return $output;
	}

}