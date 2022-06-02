<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonAnimated_number extends SppagebuilderAddons{

	public function render() {
		$settings = $this->addon->settings;

		$number = (isset($settings->number) && $settings->number) ? $settings->number : 0;
		$duration = (isset($settings->duration) && $settings->duration) ? $settings->duration : 0;
		$counter_title = (isset($settings->counter_title) && $settings->counter_title) ? $settings->counter_title : '';
		$alignment = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$number_position = (isset($settings->number_position) && $settings->number_position) ? 'animated-number-position-'.$settings->number_position : '';

		$output  = '<div class="sppb-addon sppb-addon-animated-number '. $alignment . ' ' . $class .' '.$number_position.'">';
		$output .= '<div class="sppb-addon-content">';
		$output .= '<div class="sppb-animated-number" data-digit="'. $number .'" data-duration="' . $duration . '">0</div>';
		if($counter_title) {
			$output .= '<div class="sppb-animated-number-title">' . $counter_title . '</div>';
		}
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		//Number Style
		$number_style = '';
		$number_style .= (isset($settings->color) && $settings->color) ? 'color:' . $settings->color  . ';' : '';
		$number_style .= (isset($settings->font_size) && $settings->font_size) ? 'font-size:' . (int) $settings->font_size . 'px;' : '';
		$number_style .= (isset($settings->line_height) && $settings->line_height) ? 'line-height:' . (int) $settings->line_height . 'px;' : '';
		$number_style .= (isset($settings->number_font_wight) && $settings->number_font_wight) ? 'font-weight:' . (int) $settings->number_font_wight . ';' : '';
		//Number Tablet Style
		$number_style_sm  = '';
		$number_style_sm .= (isset($settings->font_size_sm) && $settings->font_size_sm) ? 'font-size:' . (int) $settings->font_size_sm . 'px;' : '';
		$number_style_sm .= (isset($settings->line_height_sm) && $settings->line_height_sm) ? 'line-height:' . (int) $settings->line_height_sm . 'px;' : '';
		//Number Mobile Style
		$number_style_xs  = '';
		$number_style_xs .= (isset($settings->font_size_xs) && $settings->font_size_xs) ? 'font-size:' . (int) $settings->font_size_xs . 'px;' : '';
		$number_style_xs .= (isset($settings->line_height_xs) && $settings->line_height_xs) ? 'line-height:' . (int) $settings->line_height_xs . 'px;' : '';
		//Text Style
		$text_style = '';
		$text_style_sm = '';
		$text_style_xs = '';

		$text_style .= (isset($settings->title_font_size) && $settings->title_font_size) ? 'font-size:' . (int) $settings->title_font_size . 'px;': '';
		$text_style .= (isset($settings->title_line_height) && $settings->title_line_height) ? 'line-height:' . (int) $settings->title_line_height . 'px;': '';
		$text_style .= (isset($settings->title_color) && $settings->title_color) ? 'color:' . $settings->title_color . ';': '';
		$text_style .= (isset($settings->title_margin) && trim($settings->title_margin)) ? 'margin:' . $settings->title_margin . ';': '';
		//Title Font Style
		$title_fontstyle = (isset($settings->title_fontstyle) && $settings->title_fontstyle) ? $settings->title_fontstyle : '';
		if(isset($title_fontstyle->underline) && $title_fontstyle->underline){
			$text_style .= 'text-decoration:underline;';
		}
		if(isset($title_fontstyle->italic) && $title_fontstyle->italic){
			$text_style .= 'font-style:italic;';
		}
		if(isset($title_fontstyle->uppercase) && $title_fontstyle->uppercase){
			$text_style .= 'text-transform:uppercase;';
		}
		if(isset($title_fontstyle->weight) && $title_fontstyle->weight){
			$text_style .= 'font-weight:'.$title_fontstyle->weight.';';
		}

		//Title tablet style
		$text_style_sm .= (isset($settings->title_font_size_sm) && $settings->title_font_size_sm) ? 'font-size:' . (int) $settings->title_font_size_sm . 'px;': '';
		$text_style_sm .= (isset($settings->title_line_height_sm) && $settings->title_line_height_sm) ? 'line-height:' . (int) $settings->title_line_height_sm . 'px;': '';
		$text_style_sm .= (isset($settings->title_margin_sm) && $settings->title_margin_sm) ? 'margin:' . $settings->title_margin_sm . ';' : '';
		//Title mobile style
		$text_style_xs .= (isset($settings->title_font_size_xs) && $settings->title_font_size_xs) ? 'font-size:' . (int) $settings->title_font_size_xs . 'px;': '';
		$text_style_xs .= (isset($settings->title_line_height_xs) && $settings->title_line_height_xs) ? 'line-height:' . (int) $settings->title_line_height_xs . 'px;': '';
		$text_style_xs .= (isset($settings->title_margin_xs) && $settings->title_margin_xs) ? 'margin:' . $settings->title_margin_xs . ';' : '';

		$number_before_after_text = (isset($settings->number_before_after_text) && $settings->number_before_after_text) ? $settings->number_before_after_text : '';
		$number_before_after_text_position = (isset($settings->number_before_after_text_position) && $settings->number_before_after_text_position) ? $settings->number_before_after_text_position : '';
		//Css output start
		$css = '';
		
		if($number_before_after_text_position == 'right'){
			if($number_before_after_text) {
				$css .= $addon_id . ' .sppb-animated-number::after {';
				$css .= 'content:"'.$number_before_after_text.'";';
				$css .= 'display: inline-block;';
				$css .= '}';
			}
		} else {
			if($number_before_after_text) {
				$css .= $addon_id . ' .sppb-animated-number::before {';
				$css .= 'content:"'.$number_before_after_text.'";';
				$css .= 'display: inline-block;';
				$css .= '}';
			}
		}
		if($number_style) {
			$css .= $addon_id . ' .sppb-animated-number {';
			$css .= $number_style;
			$css .= '}';
		}
		if($text_style) {
			$css .= $addon_id . ' .sppb-animated-number-title {';
			$css .= $text_style;
			$css .= '}';
		}

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($number_style_sm) {
				$css .= $addon_id . ' .sppb-animated-number {';
					$css .= $number_style_sm;
				$css .= '}';
			}

			if($text_style_sm) {
				$css .= $addon_id . ' .sppb-animated-number-title {';
					$css .= $text_style_sm;
				$css .= '}';
			}
		$css .= '}';

		$css .= '@media (max-width: 767px) {';
			if($number_style_xs) {
				$css .= $addon_id . ' .sppb-animated-number {';
					$css .= $number_style_xs;
				$css .= '}';
			}

			if($text_style_xs) {
				$css .= $addon_id . ' .sppb-animated-number-title {';
					$css .= $text_style_xs;
				$css .= '}';
			}
		$css .= '}';

		return $css;
	}

	public static function getTemplate(){
		$output = '
		<#
			var addonId = "sppb-addon-"+data.id;
			var number_position = (!_.isEmpty(data.number_position) && data.number_position) ? "animated-number-position-"+data.number_position : "";
		#>
		<style type="text/css">
			<# if(data.number_before_after_text_position == "right") { #>
				#{{ addonId }} .sppb-animated-number::after{
					content:"{{data.number_before_after_text}}";
				}
			<# } else { #>
				#{{ addonId }} .sppb-animated-number::before{
					content:"{{data.number_before_after_text}}";
				}
			<# } #>
			#{{ addonId }} .sppb-animated-number{
				color: {{ data.color }};
				font-weight: {{ data.number_font_wight }};
				font-family: {{ data.number_font_family }};
				<# if(_.isObject(data.font_size)){ #>
					font-size: {{ data.font_size.md }}px;
				<# } else { #>
					font-size: {{ data.font_size }}px;
				<# }
				if(_.isObject(data.line_height)){ #>
					line-height: {{ data.line_height.md }}px;
				<# } else { #>
					line-height: {{ data.line_height }}px;
				<# } #>
			}
			#{{ addonId }} .sppb-animated-number-title{
				color: {{ data.title_color }};
				<# if(_.isObject(data.title_font_size)){ #>
					font-size: {{ data.title_font_size.md }}px;
				<# } else { #>
					font-size: {{ data.title_font_size }}px;
				<# }
				if(_.isObject(data.title_line_height)){ #>
					line-height: {{ data.title_line_height.md }}px;
				<# } else { #>
					line-height: {{ data.title_line_height }}px;
				<# }
				if(_.isObject(data.title_margin)){ #>
					margin: {{ data.title_margin.md }};
				<# }
				if(_.isObject(data.title_fontstyle)){ #>
					<# if(data.title_fontstyle.underline){ #>
						text-decoration:underline;
					<# }
					if(data.title_fontstyle.italic){
					#>
						font-style:italic;
					<# }
					if(data.title_fontstyle.uppercase){
					#>
						text-transform:uppercase;
					<# }
					if(data.title_fontstyle.weight){
					#>
						font-weight:{{data.title_fontstyle.weight}};
					<# }
				} #>
			}
			@media (min-width: 768px) and (max-width: 991px) {
				#{{ addonId }} .sppb-animated-number{
					<# if(_.isObject(data.font_size)){ #>
						font-size: {{ data.font_size.sm }}px;
					<# }
					if(_.isObject(data.line_height)){ #>
						line-height: {{ data.line_height.sm }}px;
					<# } #>
				}
				#{{ addonId }} .sppb-animated-number-title{
					<# if(_.isObject(data.title_font_size)){ #>
						font-size: {{ data.title_font_size.sm }}px;
					<# }
					if(_.isObject(data.title_line_height)){ #>
						line-height: {{ data.title_line_height.sm }}px;
					<# }
					if(_.isObject(data.title_margin)){ #>
						margin: {{ data.title_margin.sm }};
					<# } #>
				}
			}
			@media (max-width: 767px) {
				#{{ addonId }} .sppb-animated-number{
					<# if(_.isObject(data.font_size)){ #>
						font-size: {{ data.font_size.xs }}px;
					<# }
					if(_.isObject(data.line_height)){ #>
						line-height: {{ data.line_height.xs }}px;
					<# } #>
				}
				#{{ addonId }} .sppb-animated-number-title{
					<# if(_.isObject(data.title_font_size)){ #>
						font-size: {{ data.title_font_size.xs }}px;
					<# }
					if(_.isObject(data.title_line_height)){ #>
						line-height: {{ data.title_line_height.xs }}px;
					<# }
					if(_.isObject(data.title_margin)){ #>
						margin: {{ data.title_margin.xs }};
					<# } #>
				}
			}
		</style>
		<div class="sppb-addon sppb-addon-animated-number {{ data.alignment }} {{ data.class }} {{number_position}}">
			<div class="sppb-addon-content">
				<div class="sppb-animated-number sp-inline-editable-element" data-id={{data.id}} data-fieldName="number" contenteditable="true" data-digit="{{ data.number }}" data-duration="{{ data.duration }}">0</div>
				<# if(data.counter_title){ #>
					<div class="sppb-animated-number-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="counter_title" contenteditable="true">{{ data.counter_title }}</div>
				<# } #>
			</div>
		</div>';

		return $output;
	}
}
