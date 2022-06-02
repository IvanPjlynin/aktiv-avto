<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonBlocknumber extends SppagebuilderAddons{

	public function render() {
		$settings = $this->addon->settings;
		$class  	= (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title  	= (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : '';
		$text     	= (isset($settings->text) && $settings->text) ? $settings->text : '';
		$number     = (isset($settings->number) && $settings->number) ? $settings->number : '';
		$alignment  = (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$heading  	= (isset($settings->heading) && $settings->heading) ? $settings->heading : '';

		if ($number) {
			$block_number = '<span class="sppb-blocknumber-number">' . $number . '</span>';
		}
		//Output start
		$output  = '';
		$output  .= '<div class="sppb-addon sppb-addon-blocknumber ' . $class . '">';

		if($title) {
			$output  .= '<' . $heading_selector . ' class="sppb-addon-title">' . $title .'</' . $heading_selector . '>';
		}

		$output .= '<div class="sppb-addon-content">';
		$output .= '<div class="sppb-blocknumber sppb-media">';
		if( $alignment =='center' ) {
			if ($number) {
				$output .= '<div class="sppb-text-center">'.$block_number.'</div>';
			}
			$output .= '<div class="sppb-media-body sppb-text-center">';
			if($heading) $output .= '<h3 class="sppb-media-heading">'.$heading.'</h3>';
			if($text) {
				$output .= '<div class="sppb-blocknumber-text">'.$text.'</div>';
			}
		} else {
			if ($number) {
				$output .= '<div class="pull-'.$alignment.'">'.$block_number.'</div>';
			}
			$output .= '<div class="sppb-media-body sppb-text-'. $alignment .'">';
			if($heading) $output .= '<h3 class="sppb-media-heading">'.$heading.'</h3>';
			$output .= '<div class="sppb-blocknumber-text">'.$text.'</div>';
		}

		$output .= '</div>'; //.sppb-media-body
		$output .= '</div>'; //.sppb-media
		$output .= '</div>'; //.sppb-addon-content
		$output .= '</div>'; //.sppb-addon-blocknumber
		
		return $output;
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		$number_style = '';
		$number_style_sm = '';
		$number_style_xs = '';

		//number_style
		$number_style .= (isset($settings->size) && $settings->size) ? 'width: ' . (int) $settings->size . 'px; height: ' . (int) $settings->size . 'px; line-height: ' . (int) $settings->size . 'px;' : '';
		$number_style .= (isset($settings->background) && $settings->background) ? 'background-color: ' . $settings->background . ';' : '';
		$number_style .= (isset($settings->color) && $settings->color) ? 'color: ' . $settings->color . ';' : '';
		$number_style .= (isset($settings->number_font_size) && $settings->number_font_size) ? 'font-size: ' . $settings->number_font_size . 'px;' : '';

		$number_font_style = (isset($settings->number_font_style) && $settings->number_font_style) ? $settings->number_font_style : '';
		if(isset($number_font_style->underline) && $number_font_style->underline){
			$number_style .= 'text-decoration:underline;';
		}
		if(isset($number_font_style->italic) && $number_font_style->italic){
			$number_style .= 'font-style:italic;';
		}
		if(isset($number_font_style->uppercase) && $number_font_style->uppercase){
			$number_style .= 'text-transform:uppercase;';
		}
		if(isset($number_font_style->weight) && $number_font_style->weight){
			$number_style .= 'font-weight:'.$number_font_style->weight.';';
		}
		$number_style .= (isset($settings->number_border_width) && $settings->number_border_width) ? 'border-width: ' . $settings->number_border_width . 'px;' : '';
		$number_style .= (isset($settings->number_border_color) && $settings->number_border_color) ? 'border-color: ' . $settings->number_border_color . ';' : '';
		$number_style .= (isset($settings->number_border_style) && $settings->number_border_style) ? 'border-style: ' . $settings->number_border_style . ';' : '';
		$number_style .= (isset($settings->border_radius) && $settings->border_radius) ? 'border-radius: ' . $settings->border_radius . 'px;' : '';

		//Number margin
		$number_margin = (isset($settings->number_margin) && trim($settings->number_margin)) ? 'margin: ' . $settings->number_margin . ';' : '';
		$number_margin_sm = (isset($settings->number_margin_sm) && trim($settings->number_margin_sm)) ? 'margin: ' . $settings->number_margin_sm . ';' : '';
		$number_margin_xs = (isset($settings->number_margin_xs) && trim($settings->number_margin_xs)) ? 'margin: ' . $settings->number_margin_xs . ';' : '';

		//Number responsive
		$number_style_sm .= (isset($settings->size_sm) && $settings->size_sm) ? 'width: ' . (int) $settings->size_sm . 'px; height: ' . (int) $settings->size_sm . 'px; line-height: ' . (int) $settings->size_sm . 'px;' : '';
		$number_style_sm .= (isset($settings->number_font_size_sm) && $settings->number_font_size_sm) ? 'font-size: ' . $settings->number_font_size_sm . 'px;' : '';
		$number_style_xs .= (isset($settings->size_xs) && $settings->size_xs) ? 'width: ' . (int) $settings->size_xs . 'px; height: ' . (int) $settings->size_xs . 'px; line-height: ' . (int) $settings->size_xs . 'px;' : '';
		$number_style_xs .= (isset($settings->number_font_size_xs) && $settings->number_font_size_xs) ? 'font-size: ' . $settings->number_font_size_xs . 'px;' : '';

		//Heading Style
		$heading_style = '';
		$heading_style_sm = '';
		$heading_style_xs = '';

		$heading_style .= (isset($settings->heading_color) && $settings->heading_color) ? 'color: ' . $settings->heading_color . ';' : '';
		$heading_style .= (isset($settings->heading_fontsize) && $settings->heading_fontsize) ? 'font-size: ' . $settings->heading_fontsize . 'px;' : '';
		$heading_style .= (isset($settings->heading_lineheight) && $settings->heading_lineheight) ? 'line-height: ' . $settings->heading_lineheight . 'px;' : '';
		$heading_style .= (isset($settings->heading_letterspace) && $settings->heading_letterspace) ? 'letter-spacing: ' . $settings->heading_letterspace . ';' : '';
		$heading_style .= (isset($settings->heading_margin) && trim($settings->heading_margin)) ? 'margin: ' . $settings->heading_margin . ';' : '';

		$heading_font_style = (isset($settings->heading_font_style) && $settings->heading_font_style) ? $settings->heading_font_style : '';
		if(isset($heading_font_style->underline) && $heading_font_style->underline){
			$heading_style .= 'text-decoration:underline;';
		}
		if(isset($heading_font_style->italic) && $heading_font_style->italic){
			$heading_style .= 'font-style:italic;';
		}
		if(isset($heading_font_style->uppercase) && $heading_font_style->uppercase){
			$heading_style .= 'text-transform:uppercase;';
		}
		if(isset($heading_font_style->weight) && $heading_font_style->weight){
			$heading_style .= 'font-weight:'.$heading_font_style->weight.';';
		}

		//Heading responsive
		$heading_style_sm .= (isset($settings->heading_fontsize_sm) && trim($settings->heading_fontsize_sm)) ? 'font-size: ' . $settings->heading_fontsize_sm . 'px;' : '';
		$heading_style_sm .= (isset($settings->heading_lineheight_sm) && $settings->heading_lineheight_sm) ? 'line-height: ' . $settings->heading_lineheight_sm . 'px;' : '';
		$heading_style_sm .= (isset($settings->heading_margin_sm) && trim($settings->heading_margin_sm)) ? 'margin: ' . $settings->heading_margin_sm . ';' : '';

		$heading_style_xs .= (isset($settings->heading_fontsize_xs) && trim($settings->heading_fontsize_xs)) ? 'font-size: ' . $settings->heading_fontsize_xs . 'px;' : '';
		$heading_style_xs .= (isset($settings->heading_lineheight_xs) && $settings->heading_lineheight_xs) ? 'line-height: ' . $settings->heading_lineheight_xs . 'px;' : '';
		$heading_style_xs .= (isset($settings->heading_margin_xs) && trim($settings->heading_margin_xs)) ? 'margin: ' . $settings->heading_margin_xs . ';' : '';
		
		//Text Style
		$text_style = '';
		$text_style_sm = '';
		$text_style_xs = '';

		$text_style .= (isset($settings->text_color) && $settings->text_color) ? 'color: ' . $settings->text_color . ';' : '';
		$text_style .= (isset($settings->text_fontsize) && $settings->text_fontsize) ? 'font-size: ' . $settings->text_fontsize . 'px;' : '';
		$text_style .= (isset($settings->text_lineheight) && $settings->text_lineheight) ? 'line-height: ' . $settings->text_lineheight . 'px;' : '';
		$text_style .= (isset($settings->text_letterspace) && $settings->text_letterspace) ? 'letter-spacing: ' . $settings->text_letterspace . ';' : '';

		$text_font_style = (isset($settings->text_font_style) && $settings->text_font_style) ? $settings->text_font_style : '';
		if(isset($text_font_style->underline) && $text_font_style->underline){
			$text_style .= 'text-decoration:underline;';
		}
		if(isset($text_font_style->italic) && $text_font_style->italic){
			$text_style .= 'font-style:italic;';
		}
		if(isset($text_font_style->uppercase) && $text_font_style->uppercase){
			$text_style .= 'text-transform:uppercase;';
		}
		if(isset($text_font_style->weight) && $text_font_style->weight){
			$text_style .= 'font-weight:'.$text_font_style->weight.';';
		}

		//text responsive
		$text_style_sm .= (isset($settings->text_fontsize_sm) && trim($settings->text_fontsize_sm)) ? 'font-size: ' . $settings->text_fontsize_sm . 'px;' : '';
		$text_style_sm .= (isset($settings->text_lineheight_sm) && $settings->text_lineheight_sm) ? 'line-height: ' . $settings->text_lineheight_sm . 'px;' : '';

		$text_style_xs .= (isset($settings->text_fontsize_xs) && trim($settings->text_fontsize_xs)) ? 'font-size: ' . $settings->text_fontsize_xs . 'px;' : '';
		$text_style_xs .= (isset($settings->text_lineheight_xs) && $settings->text_lineheight_xs) ? 'line-height: ' . $settings->text_lineheight_xs . 'px;' : '';

		$css = '';

		if($number_style) {
			$css .= $addon_id . ' .sppb-blocknumber-number {';
			$css .= $number_style;
			$css .= '}';
		}
		if($number_margin) {
			$css .= $addon_id . ' .sppb-blocknumber .sppb-text-center,';
			$css .= $addon_id . ' .sppb-blocknumber .pull-right,';
			$css .= $addon_id . ' .sppb-blocknumber .pull-left {';
			$css .= $number_margin;
			$css .= '}';
		}
		if($heading_style) {
			$css .= $addon_id . ' .sppb-media-heading {';
			$css .= $heading_style;
			$css .= '}'	;
		}
		if($text_style) {
			$css .= $addon_id . ' .sppb-blocknumber-text {';
			$css .= $text_style;
			$css .= '}'	;
		}

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($number_style_sm) {
				$css .= $addon_id . ' .sppb-blocknumber-number {';
				$css .= $number_style_sm;
				$css .= '}'	;
			}
			if($number_margin_sm) {
				$css .= $addon_id . ' .sppb-blocknumber .sppb-text-center,';
				$css .= $addon_id . ' .sppb-blocknumber .pull-right,';
				$css .= $addon_id . ' .sppb-blocknumber .pull-left {';
				$css .= $number_margin_sm;
				$css .= '}';
			}
			if($heading_style_sm) {
				$css .= $addon_id . ' .sppb-media-heading {';
				$css .= $heading_style_sm;
				$css .= '}'	;
			}
			if($text_style_sm) {
				$css .= $addon_id . ' .sppb-blocknumber-text {';
				$css .= $text_style_sm;
				$css .= '}'	;
			}
		$css .= '}';

		$css .= '@media (max-width: 767px) {';
			if($number_style_xs) {
				$css .= $addon_id . ' .sppb-blocknumber-number {';
				$css .= $number_style_xs;
				$css .= '}';
			}
			if($number_margin_xs) {
				$css .= $addon_id . ' .sppb-blocknumber .sppb-text-center,';
				$css .= $addon_id . ' .sppb-blocknumber .pull-right,';
				$css .= $addon_id . ' .sppb-blocknumber .pull-left {';
				$css .= $number_margin_xs;
				$css .= '}';
			}
			if($heading_style_xs) {
				$css .= $addon_id . ' .sppb-media-heading {';
				$css .= $heading_style_xs;
				$css .= '}'	;
			}
			if($text_style_xs) {
				$css .= $addon_id . ' .sppb-blocknumber-text {';
				$css .= $text_style_xs;
				$css .= '}'	;
			}
		$css .= '}';

		return $css;
	}

	public static function getTemplate(){
		$output  = '
		<style type="text/css">
			#sppb-addon-{{ data.id }} .sppb-blocknumber-number {
				<# if(_.isObject(data.size)){ #>
					width: {{ data.size.md }}px;
					height: {{ data.size.md }}px;
					line-height: {{ data.size.md }}px;
				<# } else { #>
					width: {{ data.size }}px;
					height: {{ data.size }}px;
					line-height: {{ data.size }}px;
				<# } #>
				background-color: {{ data.background }};
				color: {{ data.color }};

				<# if (_.isObject(data.number_font_size)) { #>
					font-size: {{data.number_font_size.md}}px;
				<# } else { #>
					font-size: {{data.number_font_size}}px;
				<# }
				if(_.isObject(data.number_font_style)){
					if(data.number_font_style.underline){ #>
						text-decoration:underline;
					<# }
					if(data.number_font_style.italic){ #>
						font-style:italic;
					<# }
					if(data.number_font_style.uppercase){ #>
						text-transform:uppercase;
					<# }
					if(data.number_font_style.weight){ #>
						font-weight:{{data.number_font_style.weight}};
					<# }
				} #>
				border-width: {{data.number_border_width}}px;
				border-color: {{data.number_border_color}};
				border-style: {{data.number_border_style}};
				border-radius: {{data.border_radius}}px;
			}
			#sppb-addon-{{ data.id }} .sppb-blocknumber .sppb-text-center,
			#sppb-addon-{{ data.id }} .sppb-blocknumber .pull-right,
			#sppb-addon-{{ data.id }} .sppb-blocknumber .pull-left {
				<# if (_.isObject(data.number_margin)) { #>
					margin: {{data.number_margin.md}};
				<# } else { #>
					margin: {{data.number_margin}};
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sppb-media-heading {
				color: {{data.heading_color}};
				<# if (_.isObject(data.heading_fontsize)) { #>
					font-size: {{data.heading_fontsize.md}}px;
				<# } else { #>
					font-size: {{data.heading_fontsize}}px;
				<# } #>

				<# if (_.isObject(data.heading_lineheight)) { #>
					line-height: {{data.heading_lineheight.md}}px;
				<# } else { #>
					line-height: {{data.heading_lineheight}}px;
				<# } #>
				letter-spacing: {{data.heading_letterspace}};
				<# if (_.isObject(data.heading_margin)) { #>
					margin: {{data.heading_margin.md}};
				<# } else { #>
					margin: {{data.heading_margin}};
				<# }
				if(_.isObject(data.heading_font_style)){
					if(data.heading_font_style.underline){
				#>
						text-decoration:underline;
					<# }
					if(data.heading_font_style.italic){ #>
						font-style:italic;
					<# }
					if(data.heading_font_style.uppercase){ #>
						text-transform:uppercase;
					<# }
					if(data.heading_font_style.weight){ #>
						font-weight:{{data.heading_font_style.weight}};
					<# }
				} #>
			}

			#sppb-addon-{{ data.id }} .sppb-blocknumber-text {
				color: {{data.text_color}};
				<# if (_.isObject(data.text_fontsize)) { #>
					font-size: {{data.text_fontsize.md}}px;
				<# } else { #>
					font-size: {{data.text_fontsize}}px;
				<# } #>

				<# if (_.isObject(data.text_lineheight)) { #>
					line-height: {{data.text_lineheight.md}}px;
				<# } else { #>
					line-height: {{data.text_lineheight}}px;
				<# } #>
				letter-spacing: {{data.text_letterspace}};
				<# if(_.isObject(data.text_font_style)){
					if(data.text_font_style.underline){
				#>
						text-decoration:underline;
					<# }
					if(data.text_font_style.italic){ #>
						font-style:italic;
					<# }
					if(data.text_font_style.uppercase){ #>
						text-transform:uppercase;
					<# }
					if(data.text_font_style.weight){ #>
						font-weight:{{data.text_font_style.weight}};
					<# }
				} #>
			}

			@media (min-width: 768px) and (max-width: 991px) {
				#sppb-addon-{{ data.id }} .sppb-blocknumber-number {
					<# if(_.isObject(data.size)){ #>
						width: {{ data.size.sm }}px;
						height: {{ data.size.sm }}px;
						line-height: {{ data.size.sm }}px;
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-blocknumber .sppb-text-center,
				#sppb-addon-{{ data.id }} .sppb-blocknumber .pull-right,
				#sppb-addon-{{ data.id }} .sppb-blocknumber .pull-left {
					<# if (_.isObject(data.number_margin)) { #>
						margin: {{data.number_margin.sm}};
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-media-heading {
					<# if (_.isObject(data.heading_fontsize)) { #>
						font-size: {{data.heading_fontsize.sm}}px;
					<# } #>
					<# if (_.isObject(data.heading_lineheight)) { #>
						line-height: {{data.heading_lineheight.sm}}px;
					<# } #>
					<# if (_.isObject(data.heading_margin)) { #>
						margin: {{data.heading_margin.sm}};
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-blocknumber-text {
					<# if (_.isObject(data.text_fontsize)) { #>
						font-size: {{data.text_fontsize.sm}}px;
					<# } #>
					<# if (_.isObject(data.text_lineheight)) { #>
						line-height: {{data.text_lineheight.sm}}px;
					<# } #>
				}

			}
			@media (max-width: 767px) {
				#sppb-addon-{{ data.id }} .sppb-blocknumber-number {
					<# if(_.isObject(data.size)){ #>
						width: {{ data.size.xs }}px;
						height: {{ data.size.xs }}px;
						line-height: {{ data.size.xs }}px;
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-blocknumber .sppb-text-center,
				#sppb-addon-{{ data.id }} .sppb-blocknumber .pull-right,
				#sppb-addon-{{ data.id }} .sppb-blocknumber .pull-left {
					<# if (_.isObject(data.number_margin)) { #>
						margin: {{data.number_margin.xs}};
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-media-heading {
					<# if (_.isObject(data.heading_fontsize)) { #>
						font-size: {{data.heading_fontsize.xs}}px;
					<# } #>
					<# if (_.isObject(data.heading_lineheight)) { #>
						line-height: {{data.heading_lineheight.xs}}px;
					<# } #>
					<# if (_.isObject(data.heading_margin)) { #>
						margin: {{data.heading_margin.xs}};
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-blocknumber-text {
					<# if (_.isObject(data.text_fontsize)) { #>
						font-size: {{data.text_fontsize.xs}}px;
					<# } #>
					<# if (_.isObject(data.text_lineheight)) { #>
						line-height: {{data.text_lineheight.xs}}px;
					<# } #>
				}

			}
		</style>
		<div class="sppb-addon sppb-addon-blocknumber {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
				<div class="sppb-blocknumber sppb-media">
					<# if( data.alignment == "center" ) { #>
						<# if(data.number){ #>
							<div class="sppb-text-center"><span class="sppb-blocknumber-number sp-inline-editable-element" data-id={{data.id}} data-fieldName="number" contenteditable="true">{{ data.number }}</span></div>
						<# } #>
						<div class="sppb-media-body sppb-text-center">
							<# if(data.heading){ #>
								<h3 class="sppb-media-heading sp-inline-editable-element" data-id={{data.id}} data-fieldName="heading" contenteditable="true">{{{ data.heading }}}</h3>
							<# } #>
							<div class="sppb-blocknumber-text sp-inline-editable-element" data-id={{data.id}} data-fieldName="text" contenteditable="true">{{ data.text }}</div>
						</div>
					<# } else { #>
						<# if(data.number){ #>
							<div class="pull-{{ data.alignment }}"><span class="sppb-blocknumber-number sp-inline-editable-element" data-id={{data.id}} data-fieldName="number" contenteditable="true">{{ data.number }}</span></div>
						<# } #>
						<div class="sppb-media-body sppb-text-{{ data.alignment }}">
							<# if(data.heading){ #>
								<h3 class="sppb-media-heading sp-inline-editable-element" data-id={{data.id}} data-fieldName="heading" contenteditable="true">{{{ data.heading }}}</h3>
							<# } #>
							<div class="sppb-blocknumber-text sp-inline-editable-element" data-id={{data.id}} data-fieldName="text" contenteditable="true">{{ data.text }}</div>
						</div>
					<# } #>
				</div>
			</div>
		</div>';

		return $output;
	}
}
