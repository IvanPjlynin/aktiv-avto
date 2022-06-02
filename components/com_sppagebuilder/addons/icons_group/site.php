<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonIcons_group extends SppagebuilderAddons {

    public function render() {
        
        $settings = $this->addon->settings;

        //Addon Options
        $class = (isset($settings->class) && $settings->class) ? $settings->class : '';
        $icon_items = (isset($settings->sp_icons_group_item) && $settings->sp_icons_group_item) ? $settings->sp_icons_group_item : '';

        $alignment = (isset($settings->icon_alignment) && $settings->icon_alignment) ? ' ' . $settings->icon_alignment : '';

        $title = (isset($settings->title) && $settings->title) ? $settings->title : '';
        $title_position = (isset($settings->title_position) && $settings->title_position) ? $settings->title_position : 'top';
        $heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h2';
        $title_icon = (isset($settings->title_icon) && $settings->title_icon) ? $settings->title_icon : '';
        $title_icon_position = (isset($settings->title_icon_position) && $settings->title_icon_position) ? $settings->title_icon_position : 'before';

        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-icons-group ' . $class . ' '.($title_position ? 'icons-group-title-postion-'.$title_position : '').'' . $alignment . '">';
        if($title) {
            $output .= '<'.$heading_selector.' class="sppb-addon-title">';
            if($title_icon) {
                $icon_arr = array_filter(explode(' ', $title_icon));
                if (count($icon_arr) === 1) {
                    $title_icon = 'fa ' . $title_icon;
                }
            }
            if($title_icon && $title_icon_position == 'before') {
                $output .= '<span class="'. $title_icon . '" aria-hidden="true"></span> ';
            }
            $output .= $title;
            if($title_icon && $title_icon_position == 'after') {
                $output .= ' <span class="'. $title_icon . '" aria-hidden="true"></span>';
            }
            $output .= '</'.$heading_selector.'>';
        }
        $output .= '<ul class="sppb-icons-group-list">';
        if(is_array($icon_items) && count($icon_items) > 0){
            foreach ($icon_items as $key => $icon_item) {
                $key ++;

                $icon_class = (isset($icon_item->icon_class) && $icon_item->icon_class !== '') ? ' ' .$icon_item->icon_class : '';
                $title = (isset($icon_item->title) && $icon_item->title) ? $icon_item->title : 'Icon group item';

                $icon_id = $this->addon->id + $key;

                $output .= '<li id="icon-' . $icon_id . '" class="'.$icon_class.'">';
                $item_url = ((isset($icon_item->icon_link) && $icon_item->icon_link !== '')) ? $icon_item->icon_link : '#';

                if ($icon_item->icon_link) {
                    $output .= '<a href="' . $icon_item->icon_link . '" aria-label="'.strip_tags($title).'"'.(isset($icon_item->link_open_new_window) && $icon_item->link_open_new_window ? ' rel="noopener noreferrer" target="_blank"' : '').'>';
                }
                if (isset($icon_item->label_position) && $icon_item->show_label !== 0 && $icon_item->label_position == 'top') {
                    $output .= '<span class="sppb-icons-label-text">' . (isset($icon_item->label_text) ? $icon_item->label_text : '') . '</span>';
                }
                if (isset($icon_item->icon_name)) {
                    $icon_arr2 = array_filter(explode(' ', $icon_item->icon_name));
                    if (count($icon_arr2) === 1) {
                        $icon_item->icon_name = 'fa ' . $icon_item->icon_name;
                    }
                    $output .= '<i class="' . $icon_item->icon_name . ' " aria-hidden="true" title="'.$title.'"></i>';
                }
                if (isset($icon_item->label_position) && $icon_item->show_label !== 0 && $icon_item->label_position == 'right') {
                    $output .= '<span class="sppb-icons-label-text right">&nbsp;' . (isset($icon_item->label_text) ? $icon_item->label_text : '') . '</span>';
                }
                if (isset($icon_item->label_position) && $icon_item->show_label !== 0 && $icon_item->label_position == 'bottom') {
                    $output .= '<span class="sppb-icons-label-text">' . (isset($icon_item->label_text) ? $icon_item->label_text : '') . '</span>';
                }
                if ($icon_item->icon_link) {
                    $output .= '</a>';
                }

                $output .= '</li>';
            }
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings = $this->addon->settings;

        $styles = array();
        foreach ($settings->sp_icons_group_item as $key => $addon_item) {
            $key ++;

            // Normal
            $icon_style = '';
            $icon_style_sm = '';
            $icon_style_xs = '';

            $font_size = '';
            $font_size_sm = '';
            $font_size_xs = '';

            $gutter_reset = '';
            $gutter_reset_sm = '';
            $gutter_reset_xs = '';

            $icon_style .= (isset($addon_item->height) && $addon_item->height) ? 'height: ' . $addon_item->height . 'px;' : '';
            $icon_style_sm .= (isset($addon_item->height_sm) && $addon_item->height_sm) ? 'height: ' . $addon_item->height_sm . 'px;' : '';
            $icon_style_xs .= (isset($addon_item->height_xs) && $addon_item->height_xs) ? 'height: ' . $addon_item->height_xs . 'px;' : '';

            $icon_style .= (isset($settings->margin) && $settings->margin) ? 'margin: ' . $settings->margin . 'px;' : '';
            $icon_style_sm .= (isset($settings->margin_sm) && $settings->margin_sm) ? 'margin: ' . $settings->margin_sm . 'px;' : '';
            $icon_style_xs .= (isset($settings->margin_xs) && $settings->margin_xs) ? 'margin: ' . $settings->margin_xs . 'px;' : '';

            $gutter_reset .= (isset($settings->margin) && $settings->margin) ? 'margin: -' . $settings->margin . 'px;' : '';
            $gutter_reset_sm .= (isset($settings->margin_sm) && $settings->margin_sm) ? 'margin: -' . $settings->margin_sm . 'px;' : '';
            $gutter_reset_xs .= (isset($settings->margin_xs) && $settings->margin_xs) ? 'margin: -' . $settings->margin_xs . 'px;' : '';

            $icon_style .= (isset($addon_item->padding) && $addon_item->padding) ? 'padding: ' . $addon_item->padding . ';' : '';
            $icon_style_sm .= (isset($addon_item->padding_sm) && $addon_item->padding_sm) ? 'padding: ' . $addon_item->padding_sm . ';' : '';
            $icon_style_xs .= (isset($addon_item->padding_xs) && $addon_item->padding_xs) ? 'padding: ' . $addon_item->padding_xs . ';' : '';

            $icon_style .= (isset($addon_item->width) && $addon_item->width) ? 'width: ' . $addon_item->width . 'px;' : '';
            $icon_style_sm .= (isset($addon_item->width_sm) && $addon_item->width_sm) ? 'width: ' . $addon_item->width_sm . 'px;' : '';
            $icon_style_xs .= (isset($addon_item->width_xs) && $addon_item->width_xs) ? 'width: ' . $addon_item->width_xs . 'px;' : '';

            $icon_style .= (isset($addon_item->color) && $addon_item->color) ? 'color: ' . $addon_item->color . ';' : '';
            $icon_style .= (isset($addon_item->background) && $addon_item->background) ? 'background-color: ' . $addon_item->background . ';' : '';
            $icon_style .= (isset($addon_item->border_color) && $addon_item->border_color) ? 'border-color: ' . $addon_item->border_color . ';' : '';
            $icon_style .= (isset($addon_item->border_style) && $addon_item->border_style) ? 'border-style: ' . $addon_item->border_style . ';' : '';

            $icon_style .= (isset($addon_item->border_width) && $addon_item->border_width) ? 'border-width: ' . $addon_item->border_width . 'px;' : '';
            $icon_style_sm .= (isset($addon_item->border_width_sm) && $addon_item->border_width_sm) ? 'border-width: ' . $addon_item->border_width_sm . 'px;' : '';
            $icon_style_xs .= (isset($addon_item->border_width_xs) && $addon_item->border_width_xs) ? 'border-width: ' . $addon_item->border_width_xs . 'px;' : '';

            $icon_style .= (isset($addon_item->border_radius) && $addon_item->border_radius) ? 'border-radius: ' . $addon_item->border_radius . 'px;' : '';
            $icon_style_sm .= (isset($addon_item->border_radius_sm) && $addon_item->border_radius_sm) ? 'border-radius: ' . $addon_item->border_radius_sm . 'px;' : '';
            $icon_style_xs .= (isset($addon_item->border_radius_xs) && $addon_item->border_radius_xs) ? 'border-radius: ' . $addon_item->border_radius_xs . 'px;' : '';

            $font_size .= (isset($settings->size) && $settings->size) ? 'font-size: ' . $settings->size . 'px;' : '';
            $font_size_sm .= (isset($settings->size_sm) && $settings->size_sm) ? 'font-size: ' . $settings->size_sm . 'px;' : '';
            $font_size_xs .= (isset($settings->size_xs) && $settings->size_xs) ? 'font-size: ' . $settings->size_xs . 'px;' : '';
            //Label style
            $label_style = '';
            $label_style .= (isset($addon_item->label_size) && $addon_item->label_size) ? 'font-size: ' . $addon_item->label_size . 'px;' : '';
            $label_style .= (isset($addon_item->label_lineheight) && $addon_item->label_lineheight) ? 'line-height: ' . $addon_item->label_lineheight . 'px;' : '';
            $label_style .= (isset($addon_item->label_letterspace) && $addon_item->label_letterspace) ? 'letter-spacing: ' . $addon_item->label_letterspace . ';' : '';
            //label font style object
            $label_font_style = (isset($addon_item->label_font_style) && $addon_item->label_font_style) ? $addon_item->label_font_style : '';
            if(isset($label_font_style->underline) && $label_font_style->underline){
                $label_style .= 'text-decoration:underline;';
            }
            if(isset($label_font_style->italic) && $label_font_style->italic){
                $label_style .= 'font-style:italic;';
            }
            if(isset($label_font_style->uppercase) && $label_font_style->uppercase){
                $label_style .= 'text-transform:uppercase;';
            }
            if(isset($label_font_style->weight) && $label_font_style->weight){
                $label_style .= 'font-weight:'.$label_font_style->weight.';';
            }
            $label_style .= (isset($addon_item->label_margin) && trim($addon_item->label_margin)) ? 'margin: ' . $addon_item->label_margin . ';' : '';
            //Label Tablet style
            $label_style_sm = '';
            $label_style_sm .= (isset($addon_item->label_size_sm) && $addon_item->label_size_sm) ? 'font-size: ' . $addon_item->label_size_sm . 'px;' : '';
            $label_style_sm .= (isset($addon_item->label_lineheight_sm) && $addon_item->label_lineheight_sm) ? 'line-height: ' . $addon_item->label_lineheight_sm . 'px;' : '';
            $label_style_sm .= (isset($addon_item->label_margin_sm) && trim($addon_item->label_margin_sm)) ? 'margin:' . $addon_item->label_margin_sm . ';' : '';
            //Label Mobile style
            $label_style_xs = '';
            $label_style_xs .= (isset($addon_item->label_size_xs) && $addon_item->label_size_xs) ? 'font-size: ' . $addon_item->label_size_xs . 'px;' : '';
            $label_style_xs .= (isset($addon_item->label_lineheight_xs) && $addon_item->label_lineheight_xs) ? 'line-height: ' . $addon_item->label_lineheight_xs . 'px;' : '';
            $label_style_xs .= (isset($addon_item->label_margin_xs) && trim($addon_item->label_margin_xs)) ? 'margin:' . $addon_item->label_margin_xs . ';' : '';

            $icon_id = $this->addon->id + $key;

            // Mouse Hover
            $icon_style_hover = '';
            $icon_style_hover_sm = '';
            $icon_style_hover_xs = '';

            $icon_style_hover .= (isset($addon_item->hover_color) && $addon_item->hover_color) ? 'color: ' . $addon_item->hover_color . ';' : '';
            $icon_style_hover .= (isset($addon_item->hover_background) && $addon_item->hover_background) ? 'background-color: ' . $addon_item->hover_background . ';' : '';
            $icon_style_hover .= (isset($addon_item->hover_border_color) && $addon_item->hover_border_color) ? 'border-color: ' . $addon_item->hover_border_color . ';' : '';
            //Item Display
            $item_display = (isset($settings->item_display) && $settings->item_display) ? 'display: ' . $settings->item_display . ';' : 'display:inline-block;';

            $css = '';
            if ($icon_style) {
                $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' a {';
                $css .= $icon_style;
                $css .= $font_size;
                $css .= '}';
            }

            if ($gutter_reset) {
                $css .= $addon_id . ' .sppb-icons-group-list {';
                $css .= $gutter_reset;
                $css .= '}';
            }

            if ($label_style) {
                $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' .sppb-icons-label-text {';
                $css .= $label_style;
                $css .= '}';
            }
            if ($item_display) {
                $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . '{';
                $css .= $item_display;
                $css .= '}';
            }

            // Hover
            if ($icon_style_hover) {
                $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' a:hover {';
                $css .= $icon_style_hover;
                $css .= '}';
            }
            if (!empty($icon_style_hover_sm) || !empty($icon_style_sm) || !empty($font_size_sm)) {
                $css .= '@media (min-width: 768px) and (max-width: 991px) {';
                if ($icon_style_sm) {
                    $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' a {';
                    $css .= $icon_style_sm;
                    $css .= $font_size_sm;
                    $css .= '}';
                }

                if ($gutter_reset_sm) {
                    $css .= $addon_id . ' .sppb-icons-group-list {';
                    $css .= $gutter_reset_sm;
                    $css .= '}';
                }

                if ($label_style_sm) {
                    $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' .sppb-icons-label-text {';
                    $css .= $label_style_sm;
                    $css .= '}';
                }

                // Hover
                if ($icon_style_hover_sm) {
                    $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' a:hover {';
                    $css .= $icon_style_hover_sm;
                    $css .= '}';
                }
                $css .= '}';
            }
            if (!empty($icon_style_hover_xs) || !empty($icon_style_xs) || !empty($font_size_xs)) {
                $css .= '@media (max-width: 767px) {';
                if ($icon_style_xs) {
                    $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' a {';
                    $css .= $icon_style_xs;
                    $css .= $font_size_xs;
                    $css .= '}';
                }

                if ($gutter_reset_xs) {
                    $css .= $addon_id . ' .sppb-icons-group-list {';
                    $css .= $gutter_reset_xs;
                    $css .= '}';
                }

                if ($label_style_xs) {
                    $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' .sppb-icons-label-text {';
                    $css .= $label_style_xs;
                    $css .= '}';
                }

                // Hover
                if ($icon_style_hover_xs) {
                    $css .= $addon_id . ' .sppb-icons-group-list li#icon-' . $icon_id . ' a:hover {';
                    $css .= $icon_style_hover_xs;
                    $css .= '}';
                }
                $css .= '}';
            }

            $styles[$key] = $css;
        }

        $styles_explode = implode("\n", $styles);

        $title_style = '';
        $title_style_sm = '';
        $title_style_xs = '';
        $title_style .= (isset($settings->title_margin) && trim($settings->title_margin)) ? 'margin: ' . $settings->title_margin  . '; ' : '';
        $title_style .= (isset($settings->title_text_transform) && trim($settings->title_text_transform)) ? 'text-transform: ' . $settings->title_text_transform  . '; ' : '';
        $title_style_sm .= (isset($settings->title_margin_sm) && trim($settings->title_margin_sm)) ? 'margin: ' . $settings->title_margin_sm  . '; ' : '';
        $title_style_xs .= (isset($settings->title_margin_xs) && trim($settings->title_margin_xs)) ? 'margin: ' . $settings->title_margin_xs  . '; ' : '';

        $title_style .= (isset($settings->title_padding) && trim($settings->title_padding)) ? 'padding: ' . $settings->title_padding  . '; ' : '';
        $title_style_sm .= (isset($settings->title_padding_sm) && trim($settings->title_padding_sm)) ? 'padding: ' . $settings->title_padding_sm  . '; ' : '';
        $title_style_xs .= (isset($settings->title_padding_xs) && trim($settings->title_padding_xs)) ? 'padding: ' . $settings->title_padding_xs  . '; ' : '';
        
        $title_css = '';
        if ($title_style) {
            $title_css .= $addon_id . ' .sppb-addon-title {' . $title_style . '}';
        }

        if ($title_style_sm) {
            $title_css .= '@media (min-width: 768px) and (max-width: 991px) {';
                $title_css .= $addon_id . ' .sppb-addon-title {' . $title_style_sm . '}';
            $title_css .= '}';
        }

        if ($title_style_xs) {
            $title_css .= '@media (max-width: 767px) {';
                $title_css .= $addon_id . ' .sppb-addon-title {' . $title_style_xs . '}';
            $title_css .= '}';
        }

        $styles_explode .=  $title_css;

        return $styles_explode;
    }

    public static function getTemplate() {
        $output = '
        <style type="text/css">
        <#
            _.each (data.sp_icons_group_item, function(addon_item, key) {
                key ++;
                var icon_id = data.id + key;
        #>

                #sppb-addon-{{data.id}} .sppb-icons-group-list {
                    <# if(_.isObject(data.margin)){ #>
                        margin: -{{ data.margin.md }}px;
                    <# } else { #>
                        margin: -{{ data.margin }}px;
                    <# } #>
                }
                #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} {
                    <# if(_.isObject(data.margin)){ #>
                        margin: {{ data.margin.md }}px;
                    <# } else { #>
                        margin: {{ data.margin }}px;
                    <# } #>
                    <# if(data.item_display){ #>
                        display: {{data.item_display}};
                    <# } #>
                }
                #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} a {
                    color: {{ addon_item.color }};
                    background-color: {{ addon_item.background }};
                    border-color: {{ addon_item.border_color }};
                    border-style: {{ addon_item.border_style }};

                    <# if(_.isObject(addon_item.width)){ #>
                        width: {{ addon_item.width.md }}px;
                    <# } else { #>
                        width: {{ addon_item.width }}px;
                    <# } #>

                    <# if(_.isObject(addon_item.border_width)){ #>
                        border-width: {{ addon_item.border_width.md }}px;
                    <# } else { #>
                        border-width: {{ addon_item.border_width }}px;
                    <# } #>

                    <# if(_.isObject(addon_item.height)){ #>
                        height: {{ addon_item.height.md }}px;
                    <# } else { #>
                        height: {{ addon_item.height }}px;
                    <# } #>

                    <# if(_.isObject(data.size)){ #>
                        font-size: {{ data.size.md }}px;
                    <# } else { #>
                        font-size: {{ data.size }}px;
                    <# } #>
                    <# if(_.isObject(addon_item.border_radius)){ #>
                        border-radius: {{ addon_item.border_radius.md }}px;
                    <# } else { #>
                        border-radius: {{ addon_item.border_radius }}px;
                    <# } #>

                    <# if(_.isObject(addon_item.padding)){ #>
                        padding: {{ addon_item.padding.md }};
                    <# } else { #>
                        padding: {{ addon_item.padding }};
                    <# } #>


                }
                #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} .sppb-icons-label-text {
                    <# if(_.isObject(addon_item.label_size)){ #>
                        font-size: {{ addon_item.label_size.md }}px;
                    <# } else { #>
                        font-size: {{ addon_item.label_size }}px;
                    <# }
                    if(addon_item.label_letterspace){ #>
                        letter-spacing: {{ addon_item.label_letterspace }};
                    <# }
                    if(_.isObject(addon_item.label_lineheight)){ #>
                        line-height: {{ addon_item.label_lineheight.md }}px;
                    <# } else { #>
                        line-height: {{ addon_item.label_lineheight }}px;
                    <# }
                    if(_.isObject(addon_item.label_font_style)){
						if(addon_item.label_font_style.underline){ #>
							text-decoration:underline;
						<# }
						if(addon_item.label_font_style.italic){
						#>
							font-style:italic;
						<# }
						if(addon_item.label_font_style.uppercase){
						#>
							text-transform:uppercase;
						<# }
						if(addon_item.label_font_style.weight){
						#>
							font-weight:{{addon_item.label_font_style.weight}};
						<# }
					} #>
                    <# if(_.isObject(addon_item.label_margin)){ #>
                        margin: {{ addon_item.label_margin.md }};
                    <# } else { #>
                        margin: {{ addon_item.label_margin }};
                    <# } #>
                }
                #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} a:hover {
                    background-color: {{addon_item.hover_background}};
                    color: {{addon_item.hover_color}};
                    border-color: {{addon_item.hover_border_color}};
                }
                @media (min-width: 768px) and (max-width: 991px) {
                    #sppb-addon-{{data.id}} .sppb-icons-group-list {
                        <# if(_.isObject(data.margin)){ #>
                            margin: -{{ data.margin.sm }}px;
                        <# } #>
                    }
                    #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} {
                        <# if(_.isObject(data.margin)){ #>
                            margin: {{ data.margin.sm }}px;
                        <# } #>
                    }
                    #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} a {
                        <# if(_.isObject(data.size)){ #>
                            font-size: {{ data.size.sm }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.width)){ #>
                            width: {{ addon_item.width.sm }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.height)){ #>
                            height: {{ addon_item.height.sm }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.border_width)){ #>
                            border-width: {{ addon_item.border_width.sm }}px;
                        <# } #>
                        <# if(_.isObject(data.border_radius)){ #>
                            border-radius: {{ data.border_radius.sm }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.padding)){ #>
                            padding: {{ addon_item.padding.sm }};
                        <# } #>
                    }
                    #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} .sppb-icons-label-text {
                        <# if(_.isObject(addon_item.label_size) && addon_item.show_label !=="0"){ #>
                            font-size: {{ addon_item.label_size.sm }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.label_margin)){ #>
                            margin: {{ addon_item.label_margin.sm }};
                        <# }
                        if(_.isObject(addon_item.label_lineheight)){ #>
                            line-height: {{ addon_item.label_lineheight.sm }}px;
                        <# } #>
                    }
                }
                @media (max-width: 767px) {
                    #sppb-addon-{{data.id}} .sppb-icons-group-list {
                        <# if(_.isObject(data.margin)){ #>
                            margin: -{{ data.margin.xs }}px;
                        <# } #>
                    }
                    #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} {
                        <# if(_.isObject(data.margin)){ #>
                            margin: {{ data.margin.xs }}px;
                        <# } #>
                    }
                    #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} a {
                        <# if(_.isObject(data.size)){ #>
                            font-size: {{ data.size.xs }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.width)){ #>
                            width: {{ addon_item.width.xs }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.height)){ #>
                            height: {{ addon_item.height.xs }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.border_width)){ #>
                            border-width: {{ addon_item.border_width.xs }}px;
                        <# } #>
                        <# if(_.isObject(data.border_radius)){ #>
                            border-radius: {{ data.border_radius.xs }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.padding)){ #>
                            padding: {{ addon_item.padding.xs }};
                        <# } #>
                    }
                    #sppb-addon-{{data.id}} .sppb-icons-group-list li#icon-{{icon_id}} .sppb-icons-label-text {
                        <# if(_.isObject(addon_item.label_size) && addon_item.show_label !=="0"){ #>
                            font-size: {{ addon_item.label_size.xs }}px;
                        <# } #>
                        <# if(_.isObject(addon_item.label_margin)){ #>
                            margin: {{ addon_item.label_margin.xs }};
                        <# }
                        if(_.isObject(addon_item.label_lineheight)){ #>
                            line-height: {{ addon_item.label_lineheight.xs }}px;
                        <# } #>
                    }
                }

            <# })
        #>

        #sppb-addon-{{ data.id }} .sppb-addon-title{
            <# if(_.isObject(data.title_margin)){ #>
                margin: {{ data.title_margin.md }};
            <# } else { #>
                margin: {{ data.title_margin }};
            <# }
            if(_.isObject(data.title_padding)) {
            #>
                padding: {{ data.title_padding.md }};
            <# } else { #>
                padding: {{ data.title_padding }};
            <# } #>
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #sppb-addon-{{ data.id }} .sppb-addon-title{
                <# if(_.isObject(data.title_margin)){ #>
                    margin: {{ data.title_margin.sm }};
                <# }
                if(_.isObject(data.title_padding)) {
                #>
                    padding: {{ data.title_padding.sm }};
                <# } #>
            }
        }
        @media (max-width: 767px) {
            #sppb-addon-{{ data.id }} .sppb-addon-title{
                <# if(_.isObject(data.title_margin)){ #>
                    margin: {{ data.title_margin.xs }};
                <# }
                if(_.isObject(data.title_padding)) {
                #>
                    padding: {{ data.title_padding.xs }};
                <# } #>
            }
        }
        </style>

            <#
                let contentClass = (!_.isEmpty(data.class) && data.class) ? data.class : "";
                let icon_items = (!_.isEmpty(data.sp_icons_group_item) && data.sp_icons_group_item) ? data.sp_icons_group_item : "";
                let alignment = (!_.isEmpty(data.icon_alignment) && data.icon_alignment) ? \' \' + data.icon_alignment : "";
            #>
                <div class="sppb-addon sppb-addon-icons-group {{contentClass}} {{(data.title_position ? "icons-group-title-postion-"+data.title_position : "")}} {{alignment}}">

                <#
                let heading_selector = data.heading_selector || "h2";
                #>
                <{{ heading_selector }} class="sppb-addon-title">
                <#
                let icon_title_arr = (typeof data.title_icon !== "undefined" && data.title_icon) ? data.title_icon.split(" ") : "";
                let icon_title_name = icon_title_arr.length === 1 ? "fa "+data.title_icon : data.title_icon;

                if(data.title_icon && data.title_icon_position == "before"){ #><span class="{{ icon_title_name }}"></span> <# } #>
                    <span class="sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</span>
                <# if(data.title_icon && data.title_icon_position == "after"){ #> <span class="{{ icon_title_name }}"></span><# } #>
                </{{ heading_selector }}>

                <ul class="sppb-icons-group-list">
                <# _.each (icon_items, function(icon_item, key) {
                    key ++;
                    let icon_class = (!_.isEmpty(icon_item.icon_class) && icon_item.icon_class !== "") ? icon_item.icon_class : " ";
                    let icon_id = data.id + key;
                #>

                    <li id="icon-{{icon_id}}" class="{{icon_class}}">

                    <#
                    let item_url = ((!_.isEmpty(icon_item.icon_link) && icon_item.icon_link !== "")) ? icon_item.icon_link : "#";

                    if (icon_item.icon_link) {
                    #>
                        <a href="{{icon_item.icon_link}}" <# if(icon_item.link_open_new_window) { #> rel="noopener noreferrer" target="_blank" <# } #> >
                    <# }
                    if (!_.isEmpty(icon_item.label_position) && icon_item.show_label !== 0 && icon_item.label_position == "top") {
                    #>
                        <span class="sppb-icons-label-text">{{icon_item.label_text}}</span>
                    <# }
                    if (!_.isEmpty(icon_item.icon_name)) {
                        let icon_arr2 = (typeof icon_item.icon_name !== "undefined" && icon_item.icon_name) ? icon_item.icon_name.split(" ") : "";
                        let icon_name2 = icon_arr2.length === 1 ? "fa "+icon_item.icon_name : icon_item.icon_name;
                    #>
                        <i class="{{icon_name2}} "></i>
                    <# }
                    if (!_.isEmpty(icon_item.label_position) && icon_item.show_label !== 0 && icon_item.label_position == "right") {
                    #>
                        <span class="sppb-icons-label-text right">{{icon_item.label_text}}</span>
                    <# }
                    if (!_.isEmpty(icon_item.label_position) && icon_item.show_label !== 0 && icon_item.label_position == "bottom") {
                    #>
                        <span class="sppb-icons-label-text">{{icon_item.label_text}}</span>
                    <# }
                    if (icon_item.icon_link) {
                    #>
                        </a>
                    <# } #>

                    </li>
                <# }) #>
                </ul>
                </div>
                ';
        return $output;
    }

}
