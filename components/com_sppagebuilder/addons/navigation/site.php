<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonNavigation extends SppagebuilderAddons{

	public function render() {
        
        $settings = $this->addon->settings;
		$class = (isset($settings->global_class) && $settings->global_class) ? ' '.$settings->global_class : '';
		$links = (isset($settings->sp_link_list_item) && $settings->sp_link_list_item) ? $settings->sp_link_list_item : array();
        $type = (isset($settings->type) && $settings->type) ? $settings->type : "nav";
        $align = (isset($settings->align) && $settings->align) ? $settings->align : "left";
        $icon_position = (isset($settings->icon_position) && $settings->icon_position) ? $settings->icon_position : 'left';
        $scroll_to = (isset($settings->scroll_to) && $settings->scroll_to) ? $settings->scroll_to : false;
        $scroll_to_offset = (isset($settings->scroll_to_offset)) ? $settings->scroll_to_offset : '';
        $sticky_menu = (isset($settings->sticky_menu) && $settings->sticky_menu) ? $settings->sticky_menu : false;
        $responsive_menu = (isset($settings->responsive_menu)) ? $settings->responsive_menu : true;
        $nav_type = "sppb-link-list-${type}";
        $nav_align = " sppb-nav-align-${align}";

        $data_offset = '';
        if($scroll_to){
            $data_offset = 'data-offset='.$scroll_to_offset.'';
        }
        
        $output = '';

        $sticky_row_attr = '';
        if($sticky_menu){
            $sticky_row_attr = ' data-sticky-it="true"';
        }

        $responsive_menu_cls = '';
        if($responsive_menu){
            $responsive_menu_cls = ' sppb-link-list-responsive';
        }

        $output .= '<div class="sppb-link-list-wrap ' . $nav_type . $nav_align . $responsive_menu_cls . $class .'" ' . $sticky_row_attr . ' '.$data_offset.'>';
            $output .= ($responsive_menu) ? '<div class="sppb-responsive-bars"><span class="sppb-responsive-bar"></span><span class="sppb-responsive-bar"></span><span class="sppb-responsive-bar"></span></div>' : '';
            $output .= '<ul>';
            
            if(count((array) $links)){
                foreach($links as $key => $link){
                    if(isset($link->icon)){
                        $icon_arr = array_filter(explode(' ', $link->icon));
                        if (count($icon_arr) === 1) {
                            $link->icon = 'fa ' . $link->icon;
                        }
                    }
                    $target = isset($link->target) ? 'target="' . $link->target . '" '.( $link->target === '_blank' ? 'rel="noopener noreferrer"' : '').'' : '';
                    $icon = isset($link->icon) ? '<i class="' . $link->icon . '" aria-hidden="true"></i>' : '';
                    $scroll_to_attr = ($scroll_to) ? ' data-scroll-to="true" ' : '';
                    $active = (isset($link->active) && $link->active) ? ' sppb-active' : '';
                    
                    $title = (isset($link->title) && $link->title) ? $link->title : '';

                    $link_text = '';
                    if($icon_position == 'right'){
                        $link_text = $title . ' ' . $icon;
                    } else if($icon_position == 'top'){
                        $link_text = $icon . '<br />' . $title;
                    } else {
                        $link_text = $icon . ' ' . $title;
                    }

                    $output .= '<li class="' . (isset($link->class) ? $link->class : '') . $active . '"><a href="' . (isset($link->url) ? $link->url : '') . '" ' . $target . $scroll_to_attr . '>' . $link_text . '</a></li>';
                }
            }
            $output .= '</ul>';
        $output .= '</div>';

		return $output;
    }
    
    public function css() {
        $settings = $this->addon->settings;
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $icon_position = (isset($settings->icon_position) && $settings->icon_position) ? $settings->icon_position : 'left';

        $css = '';

        $link = '';
        $link_sm = '';
        $link_xs = '';
        $link_hover = '';

        $link .= (isset($settings->link_bg) && $settings->link_bg) ? 'background-color: ' . $settings->link_bg . ';' : '';

        if(isset($settings->link_margin) && is_object($settings->link_margin)){
            $link .= (isset($settings->link_margin->md) && $settings->link_margin->md) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_margin->md, 'margin') : '';
            $link_sm .= (isset($settings->link_margin->sm) && $settings->link_margin->sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_margin->sm, 'margin') : '';
            $link_xs .= (isset($settings->link_margin->xs) && $settings->link_margin->xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_margin->xs, 'margin') : '';
        } else {
            $link .= (isset($settings->link_margin) && $settings->link_margin) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_margin, 'margin') : '';
            $link_sm .= (isset($settings->link_margin_sm) && $settings->link_margin_sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_margin_sm, 'margin') : '';
            $link_xs .= (isset($settings->link_margin_xs) && $settings->link_margin_xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_margin_xs, 'margin') : '';
        }

        if(isset($settings->link_padding) && is_object($settings->link_padding)){
            $link .= (isset($settings->link_padding->md) && $settings->link_padding->md) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_padding->md, 'padding') : '';
            $link_sm .= (isset($settings->link_padding->sm) && $settings->link_padding->sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_padding->sm, 'padding') : '';
            $link_xs .= (isset($settings->link_padding->xs) && $settings->link_padding->xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_padding->xs, 'padding') : '';
        } else {
            $link .= (isset($settings->link_padding) && $settings->link_padding) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_padding, 'padding') : '';
            $link_sm .= (isset($settings->link_padding_sm) && $settings->link_padding_sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_padding_sm, 'padding') : '';
            $link_xs .= (isset($settings->link_padding_xs) && $settings->link_padding_xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->link_padding_xs, 'padding') : '';
        }
        if(isset($settings->link_border_radius) && is_object($settings->link_border_radius)){
            $link .= (isset($settings->link_border_radius->md) && $settings->link_border_radius->md) ? 'border-radius: ' . $settings->link_border_radius->md . 'px;' : '';
            $link_sm .= (isset($settings->link_border_radius->sm) && $settings->link_border_radius->sm) ? 'border-radius: ' . $settings->link_border_radius->sm . 'px;' : '';
            $link_xs .= (isset($settings->link_border_radius->xs) && $settings->link_border_radius->xs) ? 'border-radius: ' . $settings->link_border_radius->xs . 'px;' : '';
        } else {
            $link .= (isset($settings->link_border_radius) && $settings->link_border_radius) ? 'border-radius: ' . $settings->link_border_radius . 'px;' : '';
            $link_sm .= (isset($settings->link_border_radius_sm) && $settings->link_border_radius_sm) ? 'border-radius: ' . $settings->link_border_radius_sm . 'px;' : '';
            $link_xs .= (isset($settings->link_border_radius_xs) && $settings->link_border_radius_xs) ? 'border-radius: ' . $settings->link_border_radius_xs . 'px;' : '';
        }
        if(isset($settings->link_fontsize) && is_object($settings->link_fontsize)){
            $link .= (isset($settings->link_fontsize->md) && $settings->link_fontsize->md) ? 'font-size: ' . $settings->link_fontsize->md . 'px;' : '';
            $link_sm .= (isset($settings->link_fontsize->sm) && $settings->link_fontsize->sm) ? 'font-size: ' . $settings->link_fontsize->sm . 'px;' : '';
            $link_xs .= (isset($settings->link_fontsize->xs) && $settings->link_fontsize->xs) ? 'font-size: ' . $settings->link_fontsize->xs . 'px;' : '';
        } else {
            $link .= (isset($settings->link_fontsize) && $settings->link_fontsize) ? 'font-size: ' . $settings->link_fontsize . 'px;' : '';
            $link_sm .= (isset($settings->link_fontsize_sm) && $settings->link_fontsize_sm) ? 'font-size: ' . $settings->link_fontsize_sm . 'px;' : '';
            $link_xs .= (isset($settings->link_fontsize_xs) && $settings->link_fontsize_xs) ? 'font-size: ' . $settings->link_fontsize_xs . 'px;' : '';
        }
        if(isset($settings->link_lineheight) && is_object($settings->link_lineheight)){
            $link .= (isset($settings->link_lineheight->md) && $settings->link_lineheight->md) ? 'line-height: ' . $settings->link_lineheight->md . 'px;' : '';
            $link_sm .= (isset($settings->link_lineheight->sm) && $settings->link_lineheight->sm) ? 'line-height: ' . $settings->link_lineheight->sm . 'px;' : '';
            $link_xs .= (isset($settings->link_lineheight->xs) && $settings->link_lineheight->xs) ? 'line-height: ' . $settings->link_lineheight->xs . 'px;' : '';
        } else {
            $link .= (isset($settings->link_lineheight) && $settings->link_lineheight) ? 'line-height: ' . $settings->link_lineheight . 'px;' : '';
            $link_sm .= (isset($settings->link_lineheight_sm) && $settings->link_lineheight_sm) ? 'line-height: ' . $settings->link_lineheight_sm . 'px;' : '';
            $link_xs .= (isset($settings->link_lineheight_xs) && $settings->link_lineheight_xs) ? 'line-height: ' . $settings->link_lineheight_xs . 'px;' : '';
        }

        if(isset($settings->link_font_style) && is_object($settings->link_font_style)){
            if(isset($settings->link_font_style->underline) && $settings->link_font_style->underline) {
                $link .= 'text-decoration: underline;';
            }
        
            if(isset($settings->link_font_style->italic) && $settings->link_font_style->italic) {
                $link .= 'font-style: italic;';
            }
        
            if(isset($settings->link_font_style->uppercase) && $settings->link_font_style->uppercase) {
                $link .= 'text-transform: uppercase;';
            }
        
            if(isset($settings->link_font_style->weight) && $settings->link_font_style->weight) {
                $link .= 'font-weight: ' . $settings->link_font_style->weight . ';';
            }
        }
        $link .= (isset($settings->link_text_transform) && $settings->link_text_transform) ? 'text-transform: ' . $settings->link_text_transform  . '; ' : '';
        $link .= (isset($settings->link_letterspace) && $settings->link_letterspace) ? 'letter-spacing:' . $settings->link_letterspace . ';' : '';

        if($icon_position == 'top'){
            $link .= 'text-align:center;';
        }


        $link_hover .= (isset($settings->link_bg_hover) && $settings->link_bg_hover) ? 'background-color: ' . $settings->link_bg_hover . ';' : '';

        $link_active = '';
        $link_active_sm = '';
        $link_active_xs = '';

        if(isset($settings->link_border_radius_active) && is_object($settings->link_border_radius_active)){
            $link_active .= (isset($settings->link_border_radius_active->md) && $settings->link_border_radius_active->md) ? 'border-radius: ' . $settings->link_border_radius_active->md . 'px;' : '';
            $link_active_sm .= (isset($settings->link_border_radius_active->sm) && $settings->link_border_radius_active->sm) ? 'border-radius: ' . $settings->link_border_radius_active->sm . 'px;' : '';
            $link_active_xs .= (isset($settings->link_border_radius_active->xs) && $settings->link_border_radius_active->xs) ? 'border-radius: ' . $settings->link_border_radius_active->xs . 'px;' : '';
        } else {
            $link_active .= (isset($settings->link_border_radius_active) && $settings->link_border_radius_active) ? 'border-radius: ' . $settings->link_border_radius_active . 'px;' : '';
            $link_active_sm .= (isset($settings->link_border_radius_active_sm) && $settings->link_border_radius_active_sm) ? 'border-radius: ' . $settings->link_border_radius_active_sm . 'px;' : '';
            $link_active_xs .= (isset($settings->link_border_radius_active_xs) && $settings->link_border_radius_active_xs) ? 'border-radius: ' . $settings->link_border_radius_active_xs . 'px;' : '';
        }

        $link_active .= (isset($settings->link_bg_active) && $settings->link_bg_active) ? 'background-color: ' . $settings->link_bg_active . ';' : '';
        $link_active .= (isset($settings->link_color_active) && $settings->link_color_active) ? 'color: ' . $settings->link_color_active . ';' : '';

        // Icon Style
        $link_icon = '';
        $link_icon_sm = '';
        $link_icon_xs = '';
        if(isset($settings->icon_size) && is_object($settings->icon_size)){
            $link_icon .= (isset($settings->icon_size->md) && $settings->icon_size->md) ? 'font-size: ' . $settings->icon_size->md . 'px;line-height: ' . $settings->icon_size->md . 'px;' : '';
            $link_icon_sm .= (isset($settings->icon_size->sm) && $settings->icon_size->sm) ? 'font-size: ' . $settings->icon_size->sm . 'px;line-height: ' . $settings->icon_size->sm . 'px;' : '';
            $link_icon_xs .= (isset($settings->icon_size->xs) && $settings->icon_size->xs) ? 'font-size: ' . $settings->icon_size->xs . 'px;line-height: ' . $settings->icon_size->xs . 'px;' : '';
        } else {
            $link_icon .= (isset($settings->icon_size) && $settings->icon_size) ? 'font-size: ' . $settings->icon_size . 'px;line-height: ' . $settings->icon_size . 'px;' : '';
            $link_icon_sm .= (isset($settings->icon_size_sm) && $settings->icon_size_sm) ? 'font-size: ' . $settings->icon_size_sm . 'px;line-height: ' . $settings->icon_size_sm . 'px;' : '';
            $link_icon_xs .= (isset($settings->icon_size_xs) && $settings->icon_size_xs) ? 'font-size: ' . $settings->icon_size_xs . 'px;ine-height: ' . $settings->icon_size_xs . 'px;' : '';
        }

        if(isset($settings->icon_margin) && is_object($settings->icon_margin)){
            $link_icon .= (isset($settings->icon_margin->md) && $settings->icon_margin->md) ? SppagebuilderHelperSite::getPaddingMargin($settings->icon_margin->md, 'margin') : '';
            $link_icon_sm .= (isset($settings->icon_margin->sm) && $settings->icon_margin->sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->icon_margin->sm, 'margin') : '';
            $link_icon_xs .= (isset($settings->icon_margin->xs) && $settings->icon_margin->xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->icon_margin->xs, 'margin') : '';
        } else {
            $link_icon .= (isset($settings->icon_margin) && $settings->icon_margin) ? SppagebuilderHelperSite::getPaddingMargin($settings->icon_margin, 'margin') : '';
            $link_icon_sm .= (isset($settings->icon_margin_sm) && $settings->icon_margin_sm) ? SppagebuilderHelperSite::getPaddingMargin($settings->icon_margin_sm, 'margin') : '';
            $link_icon_xs .= (isset($settings->icon_margin_xs) && $settings->icon_margin_xs) ? SppagebuilderHelperSite::getPaddingMargin($settings->icon_margin_xs, 'margin') : '';
        }

        $responsive_bars = '';
        $responsive_bars .= (isset($settings->responsive_bar_bg) && $settings->responsive_bar_bg) ? 'background-color: ' . $settings->responsive_bar_bg . ';' : '';
        $responsive_bars_active = '';
        $responsive_bars_active .= (isset($settings->responsive_bar_bg_active) && $settings->responsive_bar_bg_active) ? 'background-color: ' . $settings->responsive_bar_bg_active . ';' : '';

        $responsive_bar = '';
        $responsive_bar .= (isset($settings->responsive_bar_color) && $settings->responsive_bar_color) ? 'background-color: ' . $settings->responsive_bar_color . ';' : '';
        $responsive_bar_active = '';
        $responsive_bar_active .= (isset($settings->responsive_bar_color_active) && $settings->responsive_bar_color_active) ? 'background-color: ' . $settings->responsive_bar_color_active . ';' : '';

        if($link){
            $css .=  $addon_id . ' li a{' . $link . '}';
        }
        if($link_icon){
            $css .=  $addon_id . ' li a i{' . $link_icon . '}';
        }
        if($link_hover){
            $css .=  $addon_id . ' li a:hover{' . $link_hover . '}';
        }
        if($link_active){
            $css .=  $addon_id . ' li.sppb-active a{' . $link_active . '}';
        }

        if($responsive_bars){
            $css .=  $addon_id . ' .sppb-responsive-bars{' . $responsive_bars . '}';
        }
        if($responsive_bars_active){
            $css .=  $addon_id . ' .sppb-responsive-bars.open{' . $responsive_bars_active . '}';
        }
        if($responsive_bar){
            $css .=  $addon_id . ' .sppb-responsive-bar{' . $responsive_bar . '}';
        }
        if($responsive_bar_active){
            $css .=  $addon_id . ' .sppb-responsive-bars.open .sppb-responsive-bar{' . $responsive_bar_active . '}';
        }

        if($link_sm || $link_icon_sm || $link_active_sm){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
                if($link_sm){
                    $css .=  $addon_id . ' li a{' . $link_sm . '}';
                }
                if($link_icon_sm){
                    $css .=  $addon_id . ' li a i{' . $link_icon_sm . '}';
                }
                if($link_active_sm){
                    $css .=  $addon_id . ' li.sppb-active a{' . $link_active_sm . '}';
                }
            $css .= '}';
        }

        if($link_xs || $link_icon_xs || $link_active_xs){
            $css .= '@media (max-width: 767px) {';
                if($link_xs){
                    $css .=  $addon_id . ' li a{' . $link_xs . '}';
                }
                if($link_icon_xs){
                    $css .=  $addon_id . ' li a i{' . $link_icon_xs . '}';
                }
                if($link_active_xs){
                    $css .=  $addon_id . ' li.sppb-active a{' . $link_active_xs . '}';
                }
            $css .= '}';
        }

        return $css;
    }


	public static function getTemplate() {
        $output = '
        <#
            var addonId = "sppb-addon-"+data.id;
            var navclass = (typeof data.class !== "undefined" && data.class) ? data.class : "";
            var links = (typeof data.sp_link_list_item  !== "undefined" && data.sp_link_list_item) ? data.sp_link_list_item : [];
            var type = (typeof data.type !== "undefined" && data.type) ? data.type : "nav";
            var align = (typeof data.align !== "undefined" && data.align) ? data.align : "left";
            var icon_position = (typeof data.icon_position !== "undefined" && data.icon_position) ? data.icon_position : "left";
            var scroll_to = (typeof data.scroll_to !== "undefined" && data.scroll_to) ? data.scroll_to : false;
            var sticky_menu = (typeof data.sticky_menu !== "undefined" && data.sticky_menu) ? data.sticky_menu : false;
            var responsive_menu = (typeof data.responsive_menu !== "undefined") ? data.responsive_menu : true;

            var margin = window.getMarginPadding(data.link_margin, "margin");
			var padding = window.getMarginPadding(data.link_padding, "padding");
			var icon_margin = window.getMarginPadding(data.icon_margin, "margin");

            var nav_type = "sppb-link-list-" + type;
            var nav_align = "sppb-nav-align-" + align;

            var sticky_row_attr = "";
            if(sticky_menu){
                sticky_row_attr = \' data-sticky-it="true"\';
            }

            var responsive_menu_cls = "";
            if(responsive_menu){
                responsive_menu_cls = "sppb-link-list-responsive";
            }
        #>
        <style type="text/css">
            #{{ addonId }} li a{
                background-color: {{ data.link_bg }};
                text-transform: {{ data.link_text_transform }};
                letter-spacing: {{ data.link_letterspace }};
                <# if(_.isObject(data.link_fontsize)){ #>
                    font-size: {{ data.link_fontsize.md }}px;
                <# } #>
                <# if(_.isObject(data.link_lineheight)){ #>
                    line-height: {{ data.link_lineheight.md }}px;
                <# } #>
                <# if(typeof data.link_font_style !== "undefined" && _.isObject(data.link_font_style)){ #>
                    <# if(typeof data.link_font_style.underline !== "undefined" && data.link_font_style.underline) { #>
                        text-decoration: underline;
                    <# } #>
                
                    <# if(typeof data.link_font_style.italic !== "undefined" && data.link_font_style.italic) { #>
                        font-style: italic;
                    <# } #>
                
                    <# if(typeof data.link_font_style.uppercase !== "undefined" && data.link_font_style.uppercase) { #>
                        text-transform: uppercase;
                    <# } #>
                
                    <# if(typeof data.link_font_style.weight !== "undefined" && data.link_font_style.weight) { #>
                        font-weight: {{ data.link_font_style.weight }};
                    <# } #>
                <# } #>
                <# if(icon_position == "top"){ #>
                    text-align: center;
                <# } #>
                <# if(_.isObject(data.link_border_radius)){ #>
                    border-radius: {{ data.link_border_radius.md }}px;
                <# } #>
                <# if(_.isObject(margin)){ #>
                    {{ margin.md }}
                <# } #>
                <# if(_.isObject(padding)){ #>
                    {{ padding.md }}
                <# } #>
            }
            #{{ addonId }} li a:hover{
                background-color: {{ data.link_bg_hover }};
            }
            #{{ addonId }} li.sppb-active a{
                background-color: {{ data.link_bg_active }};
                color: {{ data.link_color_active }};
                <# if(_.isObject(data.link_border_radius_active)){ #>
                    border-radius: {{ data.link_border_radius_active.md }}px;
                <# } #>
            }
            #{{ addonId }} li a i{
                <# if(_.isObject(data.icon_size)){ #>
                    font-size: {{ data.icon_size.md }}px;
                <# } #>
                <# if(_.isObject(icon_margin)){ #>
                    {{ icon_margin.md }}
                <# } #>
            }
            #{{ addonId }} .sppb-responsive-bars{
                background-color: {{ data.responsive_bar_bg }};
            }
            #{{ addonId }} .sppb-responsive-bars.open{
                background-color: {{ data.responsive_bar_bg_active }};
            }
            #{{ addonId }} .sppb-responsive-bar{
                background-color: {{ data.responsive_bar_color }};
            }
            #{{ addonId }} .sppb-responsive-bars.open .sppb-responsive-bar{
                background-color: {{ data.responsive_bar_color_active }};
            }
            @media (min-width: 768px) and (max-width: 991px) {
                #{{ addonId }} li a{
                    <# if(_.isObject(data.link_fontsize)){ #>
                        font-size: {{ data.link_fontsize.sm }}px;
                    <# } #>
                    <# if(_.isObject(data.link_lineheight)){ #>
                        line-height: {{ data.link_lineheight.sm }}px;
                    <# } #>
                    <# if(_.isObject(data.link_border_radius)){ #>
                        border-radius: {{ data.link_border_radius.sm }}px;
                    <# } #>
                    <# if(_.isObject(margin)){ #>
                        {{ margin.sm }}
                    <# } #>
                    <# if(_.isObject(padding)){ #>
                        {{ padding.sm }}
                    <# } #>
                }
                #{{ addonId }} li.sppb-active a{
                    <# if(_.isObject(data.link_border_radius_active)){ #>
                        border-radius: {{ data.link_border_radius_active.sm }}px;
                    <# } #>
                }
                #{{ addonId }} li a i{
                    <# if(_.isObject(data.icon_size)){ #>
                        font-size: {{ data.icon_size.sm }}px;
                    <# } #>
                    <# if(_.isObject(icon_margin)){ #>
                        {{ icon_margin.sm }}
                    <# } #>
                }
            }
            @media (max-width: 767px) {
                #{{ addonId }} li a{
                    <# if(_.isObject(data.link_fontsize)){ #>
                        font-size: {{ data.link_fontsize.xs }}px;
                    <# } #>
                    <# if(_.isObject(data.link_lineheight)){ #>
                        line-height: {{ data.link_lineheight.xs }}px;
                    <# } #>
                    <# if(_.isObject(data.link_border_radius)){ #>
                        border-radius: {{ data.link_border_radius.xs }}px;
                    <# } #>
                    <# if(_.isObject(margin)){ #>
                        {{ margin.xs }}
                    <# } #>
                    <# if(_.isObject(padding)){ #>
                        {{ padding.xs }}
                    <# } #>
                }
                #{{ addonId }} li.sppb-active a{
                    <# if(_.isObject(data.link_border_radius_active)){ #>
                        border-radius: {{ data.link_border_radius_active.xs }}px;
                    <# } #>
                }
                #{{ addonId }} li a i{
                    <# if(_.isObject(data.icon_size)){ #>
                        font-size: {{ data.icon_size.xs }}px;
                    <# } #>
                    <# if(_.isObject(icon_margin)){ #>
                        {{ icon_margin.xs }}
                    <# } #>
                }
            }
        </style>
        <div class="sppb-link-list-wrap {{ nav_type }}  {{ nav_align }} {{ responsive_menu_cls }} {{data.global_class}}" {{{ sticky_row_attr }}}>
            <# if(responsive_menu){ #>
                <div class="sppb-responsive-bars"><span class="sppb-responsive-bar"></span><span class="sppb-responsive-bar"></span><span class="sppb-responsive-bar"></span></div>
            <# } #>
            <ul>
            <#
            _.each(links, function(link, i){

                let icon_arr = (typeof link.icon !== "undefined" && link.icon) ? link.icon.split(" ") : "";
                let icon_name = icon_arr.length === 1 ? "fa "+link.icon : link.icon;
                
                var target = (typeof link.target !== "undefined") ? \'target="\' + link.target + \'"\' : "";
                var icon = (typeof link.icon !== "undefined") ? \'<i class="\' + icon_name + \'"></i>\' : "";
                var scroll_to_attr = (scroll_to) ? \' data-scroll-to="true" \' : "";
                var active = (typeof link.active !== "undefined" && link.active) ? " sppb-active" : "";
                
                var title = (typeof link.title !== "undefined" && link.title) ? link.title : "";

                var link_text = "";
                if(icon_position == "right"){
                    link_text = title + " " + icon;
                } else if(icon_position == "top"){
                    link_text = icon + "<br />" + title;
                } else {
                    link_text = icon + " " + title;
                }
            #>

                <li class="{{ link.class }} {{ active }}">
                <a href="{{ link.url }}" {{{ target }}} {{{ scroll_to_attr }}}>{{{ link_text }}}</a>
                </li>
            <# }); #>
            </ul>
        </div>
        ';

		return $output;
	}

}