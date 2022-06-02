<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonPie_progress extends SppagebuilderAddons {

    public function render() {
        
        $settings = $this->addon->settings;
        $class = (isset($settings->class) && $settings->class) ? $settings->class : '';
        $title = (isset($settings->title) && $settings->title) ? $settings->title : '';
        $heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';

        //Options
        $percentage = (isset($settings->percentage) && $settings->percentage) ? $settings->percentage : '';
        $border_color = (isset($settings->border_color) && $settings->border_color) ? $settings->border_color : '#eeeeee';
        $border_active_color = (isset($settings->border_active_color) && $settings->border_active_color) ? $settings->border_active_color : '';
        $border_width = (isset($settings->border_width) && $settings->border_width) ? $settings->border_width : '';
        $size = (isset($settings->size) && $settings->size) ? $settings->size : '';
        $icon_name = (isset($settings->icon_name) && $settings->icon_name) ? $settings->icon_name : '';
        $icon_size = (isset($settings->icon_size) && $settings->icon_size) ? $settings->icon_size : '';
        $text = (isset($settings->text) && $settings->text) ? $settings->text : '';
        $animation_duration = (isset($settings->animation_duration) && $settings->animation_duration) ? $settings->animation_duration : '';

        //Output start
        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-pie-progress ' . $class . '">';
        $output .= '<div class="sppb-addon-content sppb-text-center">';
        $output .= '<div class="sppb-pie-chart" data-size="' . (int) $size . '" data-duration="'.($animation_duration ? $animation_duration : false).'" data-percent="' . $percentage . '" data-width="' . $border_width . '" data-barcolor="' . $border_active_color . '" data-trackcolor="' . $border_color . '">';

        if ($icon_name) {
            $icon_arr = array_filter(explode(' ', $icon_name));
			if (count($icon_arr) === 1) {
				$icon_name = 'fa ' . $icon_name;
			}
            $output .= '<div class="sppb-chart-icon"><span><i class="' . $icon_name . ' ' . $icon_size . '" aria-hidden="true"></i></span></div>';
        } else {
            $output .= '<div class="sppb-chart-percent"><span></span></div>';
        }

        $output .= '</div>';
        $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
        $output .= '<div class="sppb-addon-text">';
        $output .= $text;
        $output .= '</div>';

        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    public function scripts() {
        $js[] = JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.easypiechart.min.js';
        return $js;
    }

    public function css() {
        $settings = $this->addon->settings;
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $css = '';
        $style = (isset($settings->size) && $settings->size) ? 'height: ' . (int) $settings->size . 'px; width: ' . (int) $settings->size . 'px;' : '';
        //Added version 3.1.3
        $percent_style = '';
        $percent_style_sm = '';
        $percent_style_xs = '';
        $percent_style .= (isset($settings->percentage_font_size) && $settings->percentage_font_size) ? 'font-size:' . (int) $settings->percentage_font_size . 'px;' : '';
        $percent_style .= (isset($settings->percentage_color) && $settings->percentage_color) ? 'color:' . $settings->percentage_color . ';' : '';

        $percent_style_sm .= (isset($settings->percentage_font_size_sm) && $settings->percentage_font_size_sm) ? 'font-size:' . (int) $settings->percentage_font_size_sm . 'px;' : '';
        $percent_style_xs .= (isset($settings->percentage_font_size_xs) && $settings->percentage_font_size_xs) ? 'font-size:' . (int) $settings->percentage_font_size_xs . 'px;' : '';

        if ($style) {
            $css .= $addon_id . ' .sppb-pie-chart {';
            $css .= $style;
            $css .= '}';
        }

        if ($percent_style) {
            $css .= $addon_id . ' .sppb-chart-percent span{';
            $css .= $percent_style;
            $css .= '}';
        }
        if (!empty($percent_style_sm)) {
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            if ($percent_style_sm) {
                $css .= $addon_id . ' .sppb-chart-percent span{';
                $css .= $percent_style_sm;
                $css .= '}';
            }
            $css .= '}';
        }
        if (!empty($percent_style_xs)) {
            $css .= '@media (max-width: 767px) {';
            if ($percent_style_xs) {
                $css .= $addon_id . ' .sppb-chart-percent span{';
                $css .= $percent_style_xs;
                $css .= '}';
            }
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {

        $output = '
			<#
                let border_color = data.border_color || "#eeeeee"
                let duration = ""
                if(data.animation_duration){
                    duration = data.animation_duration
                } else {
                    duration = false
                }
			#>

			<style type="text/css">
                #sppb-addon-{{ data.id }} .sppb-pie-chart {
                    height: {{ data.size }}px;
                    width: {{ data.size }}px;
                }
                <# if(_.isObject(data.percentage_font_size)){ #>
                    #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                        font-size: {{data.percentage_font_size.md}}px;
                    }
                <# } else { #>
                    #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                        font-size: {{data.percentage_font_size}}px;
                    }
                <# } #>
                <# if(!_.isEmpty(data.percentage_color)){ #>
                    #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                        color: {{data.percentage_color}};
                    }
                <# } #>
                @media (min-width: 768px) and (max-width: 991px) {
                    <# if(_.isObject(data.percentage_font_size)){ #>
                        #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                            font-size: {{data.percentage_font_size.sm}}px;
                        }
                    <# } #>
                }
                @media (max-width: 767px) {
                    <# if(_.isObject(data.percentage_font_size)){ #>
                        #sppb-addon-{{ data.id }} .sppb-chart-percent span{
                            font-size: {{data.percentage_font_size.xs}}px;
                        }
                    <# } #>
                }
			</style>

			<div class="sppb-addon sppb-addon-pie-progress {{ data.class }}">
                <div class="sppb-addon-content sppb-text-center">
                    <div class="sppb-pie-chart" data-size="{{ data.size }}" data-duration="{{duration}}" data-percent="{{ data.percentage }}" data-width="{{ data.border_width }}" data-barcolor="{{ data.border_active_color }}" data-trackcolor="{{ border_color }}">

                    <#
                    if(!_.isEmpty(data.icon_name)) {
                        let icon_arr = (typeof data.icon_name !== "undefined" && data.icon_name) ? data.icon_name?.split(" ") : "";
			            let icon_name = icon_arr.length === 1 ? "fa "+data.icon_name : data.icon_name;
                    #>
                        <div class="sppb-chart-icon">
                        <span><i class="{{ icon_name }} {{ data.icon_size }}"></i></span>
                        </div>
                    <# } else { #>
                        <div class="sppb-chart-percent"><span></span></div>
                    <# } #>

                    </div>

                    <# if(!_.isEmpty(data.title) && data.heading_selector) { #>
                    <{{data.heading_selector}} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{data.heading_selector}}>
                    <# } #>

                    <div id="addon-text-{{data.id}}" class="sppb-addon-text sp-editable-content" data-id={{data.id}} data-fieldName="text">
                        {{{ data.text }}}
                    </div>
                </div>
			</div>
			';

        return $output;
    }

}
