<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonProgress_bar extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$class .= (isset($settings->shape) && $settings->shape) ? 'sppb-progress-' . $settings->shape : '';
		$type = (isset($settings->type) && $settings->type) ? $settings->type : '';
		$progress = (isset($settings->progress) && $settings->progress) ? $settings->progress : '';
		$text = (isset($settings->text) && $settings->text) ? $settings->text : '';
		$stripped = (isset($settings->stripped) && $settings->stripped) ? $settings->stripped : '';
		$show_percentage = (isset($settings->show_percentage) && $settings->show_percentage) ? $settings->show_percentage : 0;

		//Output
		$output  = ($show_percentage) ? '<div class="sppb-progress-label clearfix">'.  $text .'<span>'. (int) $progress .'%</span></div>' : '';
		$output .= '<div class="sppb-progress ' . $class . '">';
		$output .= '<div class="sppb-progress-bar ' . $type . ' ' . $stripped . '" role="progressbar" aria-valuenow="' . (int) $progress . '" aria-valuemin="0" aria-valuemax="100" data-width="' . (int) $progress . '%">';
		if(!$show_percentage) {
			$output .= ($text) ? $text : '';
		}
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css() {
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$bar_height = (isset($settings->bar_height) && $settings->bar_height) ? $settings->bar_height : 0;
		$type = (isset($settings->type) && $settings->type) ? $settings->type : '';
		$bar_background = (isset($settings->bar_background) && $settings->bar_background) ? $settings->bar_background : '';
		$progress_bar_background = (isset($settings->progress_bar_background) && $settings->progress_bar_background) ? $settings->progress_bar_background : '';

		$css = '';
		if($bar_height) {
			$css .= $addon_id . ' .sppb-progress {height: '. $bar_height .'px;}';
			$css .= $addon_id . ' .sppb-progress-bar {line-height: '. $bar_height .'px;}';
		}

		if($type == 'custom') {
			if($bar_background) {
				$css .= $addon_id . ' .sppb-progress {background-color: '. $bar_background .';}';
			}

			if($progress_bar_background) {
				$css .= $addon_id . ' .sppb-progress-bar {background-color: '. $progress_bar_background .';}';
			}
		}
		//Text style
		$text_style = '';
		$text_style .= (isset($settings->text_color) && $settings->text_color) ? 'color:'.$settings->text_color.';' : '';
		$text_style .= (isset($settings->text_fontsize) && $settings->text_fontsize) ? 'font-size:'.$settings->text_fontsize.'px;' : '';
		$text_style .= (isset($settings->text_lineheight) && $settings->text_lineheight) ? 'line-height:'.$settings->text_lineheight.'px;' : '';
		$text_style .= (isset($settings->text_fontfamily) && $settings->text_fontfamily) ? 'font-family:'.$settings->text_fontfamily.';' : '';
		$text_style .= (isset($settings->text_fontweight) && $settings->text_fontweight) ? 'font-weight:'.$settings->text_fontweight.';' : '';
		if($text_style){
			$css .= $addon_id . ' .sppb-progress-label {';
				$css .= $text_style;
			$css .='}';
		}
		//Percent style
		$percent_style = '';
		$percent_style .= (isset($settings->percentage_color) && $settings->percentage_color) ? 'color:'.$settings->percentage_color.';' : '';
		$percent_style .= (isset($settings->percentage_fontsize) && $settings->percentage_fontsize) ? 'font-size:'.$settings->percentage_fontsize.'px;' : '';
		$percent_style .= (isset($settings->percentage_lineheight) && $settings->percentage_lineheight) ? 'line-height:'.$settings->percentage_lineheight.'px;' : '';
		$percent_style .= (isset($settings->percentage_fontfamily) && $settings->percentage_fontfamily) ? 'font-family:'.$settings->percentage_fontfamily.';' : '';
		$percent_style .= (isset($settings->percentage_fontweight) && $settings->percentage_fontweight) ? 'font-weight:'.$settings->percentage_fontweight.';' : '';
		if($percent_style){
			$css .= $addon_id . ' .sppb-progress-label > span {';
				$css .= $percent_style;
			$css .='}';
		}

		//Table style
		//Text style
		$text_style_sm = '';
		$text_style_sm .= (isset($settings->text_fontsize_sm) && $settings->text_fontsize_sm) ? 'font-size:'.$settings->text_fontsize_sm.'px;' : '';
		$text_style_sm .= (isset($settings->text_lineheight_sm) && $settings->text_lineheight_sm) ? 'line-height:'.$settings->text_lineheight_sm.'px;' : '';
		//Percent style
		$percent_style_sm = '';
		$percent_style_sm .= (isset($settings->percentage_fontsize_sm) && $settings->percentage_fontsize_sm) ? 'font-size:'.$settings->percentage_fontsize_sm.'px;' : '';
		$percent_style_sm .= (isset($settings->percentage_lineheight_sm) && $settings->percentage_lineheight_sm) ? 'line-height:'.$settings->percentage_lineheight_sm.'px;' : '';

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($text_style_sm){
				$css .= $addon_id . ' .sppb-progress-label {';
					$css .= $text_style_sm;
				$css .='}';
			}
			if($percent_style_sm){
				$css .= $addon_id . ' .sppb-progress-label > span {';
					$css .= $percent_style_sm;
				$css .='}';
			}
		$css .= '}';
		//Mobile style
		//Text style
		$text_style_xs = '';
		$text_style_xs .= (isset($settings->text_fontsize_xs) && $settings->text_fontsize_xs) ? 'font-size:'.$settings->text_fontsize_xs.'px;' : '';
		$text_style_xs .= (isset($settings->text_lineheight_xs) && $settings->text_lineheight_xs) ? 'line-height:'.$settings->text_lineheight_xs.'px;' : '';
		//Percent style
		$percent_style_xs = '';
		$percent_style_xs .= (isset($settings->percentage_fontsize_xs) && $settings->percentage_fontsize_xs) ? 'font-size:'.$settings->percentage_fontsize_xs.'px;' : '';
		$percent_style_xs .= (isset($settings->percentage_lineheight_xs) && $settings->percentage_lineheight_xs) ? 'line-height:'.$settings->percentage_lineheight_xs.'px;' : '';

		$css .= '@media (max-width: 767px) {';
			if($text_style_xs){
				$css .= $addon_id . ' .sppb-progress-label {';
					$css .= $text_style_xs;
				$css .='}';
			}
			if($percent_style_xs){
				$css .= $addon_id . ' .sppb-progress-label > span {';
					$css .= $percent_style_xs;
				$css .='}';
			}
		$css .= '}';

		return $css;

	}

	public static function getTemplate(){

		$output = '
			<#
				let show_percentage = data.show_percentage || 0
				let progressClass = data.class
					progressClass += (!_.isEmpty(data.shape)) ? "sppb-progress-"+data.shape:""

				let bar_height = data.bar_height || 0

			#>

			<style type="text/css">
				<# if(bar_height) { #>
					#sppb-addon-{{ data.id }} .sppb-progress {
						height: {{bar_height}}px;
					}
					#sppb-addon-{{ data.id }} .sppb-progress-bar {
						line-height: {{ bar_height }}px;
					}
				<# } #>

				<# if(data.type == "custom") { #>
					<# if(!_.isEmpty(data.bar_background)) { #>
						#sppb-addon-{{ data.id }} .sppb-progress{
							background-color: {{ data.bar_background }}
						}
					<# } #>

					<# if(!_.isEmpty(data.progress_bar_background)) { #>
						#sppb-addon-{{ data.id }} .sppb-progress-bar{
							background-color: {{ data.progress_bar_background }}
						}
					<# }
					let text_style = "";
					text_style += (!_.isEmpty(data.text_color) && data.text_color) ? `color:${data.text_color};` : "";
					text_style += (_.isObject(data.text_fontsize) && data.text_fontsize.md) ? `font-size:${data.text_fontsize.md}px;` : "";
					text_style += (_.isObject(data.text_lineheight) && data.text_lineheight.md) ? `line-height:${data.text_lineheight.md}px;` : "";
					text_style += (!_.isEmpty(data.text_fontfamily) && data.text_fontfamily) ? `font-family:${data.text_fontfamily};` : "";
					text_style += (!_.isEmpty(data.text_fontweight) && data.text_fontweight) ? `font-weight:${data.text_fontweight};` : "";
					
					if(text_style){
					#>
						#sppb-addon-{{ data.id }} .sppb-progress-label {
							{{text_style}};
						}
					<# }
					
					let percent_style = "";
					percent_style += (!_.isEmpty(data.percentage_color) && data.percentage_color) ? `color:${data.percentage_color};` : "";
					percent_style += (_.isObject(data.percentage_fontsize) && data.percentage_fontsize.md) ? `font-size:${data.percentage_fontsize.md}px;` : "";
					percent_style += (_.isObject(data.percentage_lineheight) && data.percentage_lineheight.md) ? `line-height:${data.percentage_lineheight.md}px;` : "";
					percent_style += (!_.isEmpty(data.percentage_fontfamily) && data.percentage_fontfamily) ? `font-family:${data.percentage_fontfamily};` : "";
					percent_style += (!_.isEmpty(data.percentage_fontweight) && data.percentage_fontweight) ? `font-weight:${data.percentage_fontweight};` : "";
					if(percent_style){
					#>
						#sppb-addon-{{ data.id }} .sppb-progress-label > span {
							{{percent_style}};
						}
					<# }

					let text_style_sm = "";
					text_style_sm += (_.isObject(data.text_fontsize) && data.text_fontsize.sm) ? `font-size:${data.text_fontsize.sm}px;` : "";
					text_style_sm += (_.isObject(data.text_lineheight) && data.text_lineheight.sm) ? `line-height:${data.text_lineheight.sm}px;` : "";
					
					let percent_style_sm = "";
					percent_style_sm += (_.isObject(data.percentage_fontsize) && data.percentage_fontsize.sm) ? `font-size:${data.percentage_fontsize.sm}px;` : "";
					percent_style_sm += (_.isObject(data.percentage_lineheight) && data.percentage_lineheight.sm) ? `line-height:${data.percentage_lineheight.sm}px;` : "";

					#>
					@media (min-width: 768px) and (max-width: 991px) {
						<# if(text_style_sm){ #>
							#sppb-addon-{{ data.id }} .sppb-progress-label {
								{{text_style_sm}};
							}
						<# }
						if(percent_style_sm){
						#>
							#sppb-addon-{{ data.id }} .sppb-progress-label > span {
								{{percent_style_sm}};
							}
						<# } #>
					}
					<#
					let text_style_xs = "";
					text_style_xs += (_.isObject(data.text_fontsize) && data.text_fontsize.xs) ? `font-size:${data.text_fontsize.xs}px;` : "";
					text_style_xs += (_.isObject(data.text_lineheight) && data.text_lineheight.xs) ? `line-height:${data.text_lineheight.xs}px;` : "";
					
					let percent_style_xs = "";
					percent_style_xs += (_.isObject(data.percentage_fontsize) && data.percentage_fontsize.xs) ? `font-size:${data.percentage_fontsize.xs}px;` : "";
					percent_style_xs += (_.isObject(data.percentage_lineheight) && data.percentage_lineheight.xs) ? `line-height:${data.percentage_lineheight.xs}px;` : "";
					#>
					@media (max-width: 767px) {
						<# if(text_style_xs){ #>
							#sppb-addon-{{ data.id }} .sppb-progress-label {
								{{text_style_xs}};
							}
						<# }
						if(percent_style_xs){
						#>
							#sppb-addon-{{ data.id }} .sppb-progress-label > span {
								{{percent_style_xs}};
							}
						<# } #>
					}
				<# } #>
			</style>

			<# if( show_percentage != 0 ) {#>
			<div class="sppb-progress-label clearfix">
				{{ data.text }}
				<span> {{ data.progress }}%</span>
			</div>
			<# } #>

			<div class="sppb-progress {{ progressClass }}">
			<div class="sppb-progress-bar {{ data.type }} {{ data.stripped }}" role="progressbar" aria-valuenow="{{ data.progress }}" aria-valuemin="0" aria-valuemax="100" data-width="{{ data.progress }}%">
				<# if(show_percentage == 0) { #>
					{{ data.text }}
				<# } #>
			</div>
			</div>
			';

			return $output;
	}

}
