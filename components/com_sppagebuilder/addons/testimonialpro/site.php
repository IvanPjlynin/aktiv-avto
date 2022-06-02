<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonTestimonialpro extends SppagebuilderAddons {

    public function render() {

        $settings = $this->addon->settings;
        $class = (isset($settings->class) && $settings->class) ? $settings->class : '';

        //Options
        $autoplay = (isset($settings->autoplay) && $settings->autoplay) ? ' data-sppb-ride="sppb-carousel"' : '';
        $controls = (isset($settings->controls) && $settings->controls) ? $settings->controls : 0;
        $arrow_controls = (isset($settings->arrow_controls) && $settings->arrow_controls) ? $settings->arrow_controls : 0;
        $interval = (isset($settings->interval) && $settings->interval) ? ((int) $settings->interval * 1000) : 5000;
        $avatar_shape = (isset($settings->avatar_shape) && $settings->avatar_shape) ? $settings->avatar_shape : 'sppb-avatar-circle';
        $show_quote = (isset($settings->show_quote)) ? $settings->show_quote : true;
        $avatar_on_top = (isset($settings->avatar_on_top)) ? $settings->avatar_on_top : 0;
        $content_alignment = (isset($settings->content_alignment)) ? $settings->content_alignment : 'sppb-text-center';
        
        //Arrow icon
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

        //Output
        $output = '<div id="sppb-testimonial-pro-' . $this->addon->id . '" data-interval="' . $interval . '" class="sppb-carousel sppb-testimonial-pro sppb-slide '.$content_alignment.' ' . $class . '"' . $autoplay . '>';

        if ($controls) {
            $output .= '<ol class="sppb-carousel-indicators">';
            foreach ($settings->sp_testimonialpro_item as $key1 => $value) {
                $output .= '<li data-sppb-target="#sppb-carousel-' . $this->addon->id . '" ' . (($key1 == 0) ? ' class="active"' : '' ) . '  data-sppb-slide-to="' . $key1 . '"></li>' . "\n";
            }
            $output .= '</ol>';
        }

        if($show_quote){
            $output .= '<span class="fa fa-quote-left" aria-hidden="true"></span>';
        }
        $output .= '<div class="sppb-carousel-inner">';

        foreach ($settings->sp_testimonialpro_item as $key => $value) {
            $output .= '<div class="sppb-item ' . (($key == 0) ? ' active' : '') . '">';
            $name = (isset($value->title) && $value->title) ? $value->title : '';

            $avatar_img = isset($value->avatar) && $value->avatar ? $value->avatar : '';
            $carousel_img_src = isset($avatar_img->src) ? $avatar_img->src : $avatar_img;
            
            if($avatar_on_top == 1){
                $output .= $carousel_img_src ? '<img src="' . $carousel_img_src . '" class="' . $avatar_shape . '" alt="' . $name . '">' : '';
            }
            if(isset($value->message) && $value->message){
                $output .= '<div class="sppb-testimonial-message">' . $value->message . '</div>';
            }
            $output .= '<div class="sppb-addon-testimonial-pro-footer">';
            if($avatar_on_top != 1){
                $output .= $carousel_img_src ? '<img src="' . $carousel_img_src . '" class="' . $avatar_shape . '" alt="' . $name . '">' : '';
            }
            $output .= '<div class="testimonial-pro-client-name-wrap">';
            $output .= $name ? '<span class="sppb-addon-testimonial-pro-client-name">' . $name . '</span>' : '';
            $output .= (isset($value->url) && $value->url) ? '&nbsp;<span class="sppb-addon-testimonial-pro-client-url">' . $value->url . '</span>' : '';
            $output .= (isset($value->designation) && $value->designation) ? '&nbsp;<span class="sppb-addon-testimonial-pro-client-designation">' . $value->designation . '</span>' : '';
            $output .= '</div>';
            $output .= '</div>';

            $output .= '</div>';
        }
        $output .= '</div>';

        if($arrow_controls) {
			$output	.= '<a href="#sppb-testimonial-pro-'. $this->addon->id .'" class="left sppb-carousel-control" data-slide="prev" aria-label="'.JText::_('COM_SPPAGEBUILDER_ARIA_PREVIOUS').'"><i aria-hidden="true" class="fa '.$left_arrow.'"></i></a>';
			$output	.= '<a href="#sppb-testimonial-pro-'. $this->addon->id .'" class="right sppb-carousel-control" data-slide="next" aria-label="'.JText::_('COM_SPPAGEBUILDER_ARIA_NEXT').'"><i aria-hidden="true" class="fa '.$right_arrow.'"></i></a>';
		}

        $output .= '</div>';

        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings = $this->addon->settings;
        $speed = (isset($settings->speed) && $settings->speed) ? $settings->speed : 600;
        //Avatar Style
        $avatar_size = (isset($settings->avatar_width) && $settings->avatar_width) ? $settings->avatar_width : '32';

        //Css output start
        $css = '';

        $css .= $addon_id . ' .sppb-carousel-inner > .sppb-item{-webkit-transition-duration: ' . $speed . 'ms; transition-duration: ' . $speed . 'ms;}';

        $css .= $addon_id . ' .sppb-addon-testimonial-pro-footer img{width:'.$avatar_size.'px; height:'.$avatar_size.'px;}';
        $css .= $addon_id . ' .sppb-item > img{width:'.$avatar_size.'px; height:'.$avatar_size.'px;}';
        //Icon Style
        $icon_style = '';
        $icon_style_sm = '';
        $icon_style_xs = '';

        $icon_style .= (isset($settings->icon_color) && $settings->icon_color) ? "color: " . $settings->icon_color . ";" : "";
        $icon_style .= (isset($settings->icon_size) && $settings->icon_size) ? "font-size: " . $settings->icon_size . "px;" : "";
        $icon_style_sm .= (isset($settings->icon_size_sm) && $settings->icon_size_sm) ? "font-size: " . $settings->icon_size_sm . "px;" : "";
        $icon_style_xs .= (isset($settings->icon_size_xs) && $settings->icon_size_xs) ? "font-size: " . $settings->icon_size_xs . "px;" : "";
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
        $arrow_style .= (isset($settings->arrow_border_color) && $settings->arrow_border_color) ? "border-color: " . $settings->arrow_border_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_border_radius) && $settings->arrow_border_radius) ? "border-radius: " . $settings->arrow_border_radius . "px;" : "";

        //Arrow hover style
        $arrow_hover_style = '';
        $arrow_hover_style .= (isset($settings->arrow_hover_background) && $settings->arrow_hover_background) ? "background-color: " . $settings->arrow_hover_background . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_color) && $settings->arrow_hover_color) ? "color: " . $settings->arrow_hover_color . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_border_color) && $settings->arrow_hover_border_color) ? "border-color: " . $settings->arrow_hover_border_color . ";" : "";

        if($arrow_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control{';
                $css .= $arrow_style;
            $css .= '}';
        }

        if($arrow_hover_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control:hover{';
                $css .= $arrow_hover_style;
            $css .= '}';
        }

        if($icon_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .fa-quote-left{ ' . $icon_style . ' }';
        }
        //Content style
        $content_style ='';
        $content_style .= (isset($settings->content_color) && $settings->content_color) ? 'color:' . $settings->content_color . ';' : '';
        $content_style .= (isset($settings->content_lineheight) && $settings->content_lineheight) ? 'line-height:' . $settings->content_lineheight . 'px;' : '';
        $content_style .= (isset($settings->content_fontweight) && $settings->content_fontweight) ? 'font-weight:' . $settings->content_fontweight . ';' : '';
        $content_style .= (isset($settings->content_margin) && trim($settings->content_margin)) ? 'margin:' . $settings->content_margin . ';' : '';
        $content_fontsize = (isset($settings->content_fontsize) && $settings->content_fontsize) ? 'font-size:' . $settings->content_fontsize . 'px;' : '';
        if($content_style || $content_fontsize){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-message {';
                $css .= $content_style;
                $css .= $content_fontsize;
            $css .= '}';
        }
        //Name style
        $name_style = '';
        $name_style .= (isset($settings->name_color) && $settings->name_color) ? 'color:'.$settings->name_color . ';' : '';
        $name_style .= (isset($settings->name_font_size) && $settings->name_font_size) ? 'font-size:'.$settings->name_font_size . 'px;' : '';
        $name_style .= (isset($settings->name_line_height) && $settings->name_line_height) ? 'line-height:'.$settings->name_line_height . 'px;' : '';
        $name_style .= (isset($settings->name_letterspace) && $settings->name_letterspace) ? 'letter-spacing:'.$settings->name_letterspace . ';' : '';
        $name_font_style = (isset($settings->name_font_style) && $settings->name_font_style) ? $settings->name_font_style : '';
        if(isset($name_font_style->underline) && $name_font_style->underline){
			$name_style .= 'text-decoration:underline;';
		}
		if(isset($name_font_style->italic) && $name_font_style->italic){
			$name_style .= 'font-style:italic;';
		}
		if(isset($name_font_style->uppercase) && $name_font_style->uppercase){
			$name_style .= 'text-transform:uppercase;';
        }
        if(!isset($name_font_style->weight)){
			$name_style .= 'font-weight:700;';
		}
		if(isset($name_font_style->weight) && $name_font_style->weight){
			$name_style .= 'font-weight:'.$name_font_style->weight.';';
		}
        if($name_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {';
                $css .= $name_style;
            $css .= '}';
        }

        //Designation style
        $designation_style = '';
        $designation_style .= (isset($settings->designation_color) && $settings->designation_color) ? 'color:'.$settings->designation_color . ';' : '';
        $designation_style .= (isset($settings->designation_font_size) && $settings->designation_font_size) ? 'font-size:'.$settings->designation_font_size . 'px;' : '';
        $designation_style .= (isset($settings->designation_margin) && trim($settings->designation_margin)) ? 'margin:'.$settings->designation_margin . ';' : '';
        $designation_style .= (isset($settings->designation_letterspace) && $settings->designation_letterspace) ? 'letter-spacing:'.$settings->designation_letterspace . ';' : '';
        $designation_style .= (isset($settings->designation_line_height) && $settings->designation_line_height) ? 'line-height:'.$settings->designation_line_height . 'px;' : '';
        $designation_font_style = (isset($settings->designation_font_style) && $settings->designation_font_style) ? $settings->designation_font_style : '';
        if(isset($designation_font_style->underline) && $designation_font_style->underline){
			$designation_style .= 'text-decoration:underline;';
		}
		if(isset($designation_font_style->italic) && $designation_font_style->italic){
			$designation_style .= 'font-style:italic;';
		}
		if(isset($designation_font_style->uppercase) && $designation_font_style->uppercase){
			$designation_style .= 'text-transform:uppercase;';
		}
		if(isset($designation_font_style->weight) && $designation_font_style->weight){
			$designation_style .= 'font-weight:'.$designation_font_style->weight.';';
        }
        $designation_block = (isset($settings->designation_block) && $settings->designation_block) ? 'display:block;' : '';
        if($designation_style || $designation_block){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {';
                $css .= $designation_style;
                $css .= $designation_block;
            $css .= '}';
        }
        //Bullet style
        $bullet_border_color = (isset($settings->bullet_border_color) && $settings->bullet_border_color) ? $settings->bullet_border_color . ';' : '';
        if($bullet_border_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-indicators li {';
                $css .= 'border-color:'.$bullet_border_color.';';
            $css .= '}';
        }
        //Active Bullet
        $bullet_active_bg_color = (isset($settings->bullet_active_bg_color) && $settings->bullet_active_bg_color) ? $settings->bullet_active_bg_color . ';' : '';
        if($bullet_active_bg_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-indicators li.active {';
                $css .= 'background:'.$bullet_active_bg_color.';';
            $css .= '}';
        }
        //Style for Tablet
        $name_font_size_sm = (isset($settings->name_font_size_sm) && $settings->name_font_size_sm) ? 'font-size:' . $settings->name_font_size_sm . 'px;' : '';
        $name_line_height_sm = (isset($settings->name_line_height_sm) && $settings->name_line_height_sm) ? 'line-height:' . $settings->name_line_height_sm . 'px;' : '';
        $content_fontsize_sm = (isset($settings->content_fontsize_sm) && $settings->content_fontsize_sm) ? 'font-size:' . $settings->content_fontsize_sm . 'px;' : '';
        $content_lineheight_sm = (isset($settings->content_lineheight_sm) && $settings->content_lineheight_sm) ? 'line-height:' . $settings->content_lineheight_sm . 'px;' : '';
        $content_margin_sm = (isset($settings->content_margin_sm) && trim($settings->content_margin_sm)) ? 'margin:' . $settings->content_margin_sm . ';' : '';
        $arrow_margin_sm = (isset($settings->arrow_margin) && trim($settings->arrow_margin)) ? "margin: " . $settings->arrow_margin_sm . ";" : "";
        //Avatar Tablet Style
        $avatar_width_sm = (isset($settings->avatar_width_sm) && $settings->avatar_width_sm) ? $settings->avatar_width_sm : '';
        //Designation tablet style
        $designation_style_sm = '';
        $designation_style_sm .= (isset($settings->designation_font_size_sm) && $settings->designation_font_size_sm) ? 'font-size:'.$settings->designation_font_size_sm . 'px;' : '';
        $designation_style_sm .= (isset($settings->designation_margin_sm) && trim($settings->designation_margin_sm)) ? 'margin:'.$settings->designation_margin_sm . ';' : '';
        $designation_style_sm .= (isset($settings->designation_line_height_sm) && $settings->designation_line_height_sm) ? 'line-height:'.$settings->designation_line_height_sm . 'px;' : '';

        if($icon_style_sm || $content_fontsize_sm || $arrow_margin_sm || $content_margin_sm || $name_font_size_sm || $name_line_height_sm || $content_lineheight_sm || $avatar_width_sm || $designation_style_sm ){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .fa-quote-left{';
                    $css .= $icon_style_sm;
                $css .= '}';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-message {';
                    $css .= $content_fontsize_sm;
                    $css .= $content_margin_sm;
                    $css .= $content_lineheight_sm;
                $css .= '}';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control{';
                    $css .= $arrow_margin_sm;
                $css .= '}';
                if($name_font_size_sm || $name_line_height_sm){
                    $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {';
                        $css .= $name_font_size_sm;
                        $css .= $name_line_height_sm;
                    $css .= '}';
                }
                if($avatar_width_sm){
                    $css .= $addon_id . ' .sppb-item > img{width:'.$avatar_width_sm.'px; height:'.$avatar_width_sm.'px;}';
                }
                if($designation_style_sm){
                    $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {';
                        $css .= $designation_style_sm;
                    $css .= '}';
                }
            $css .= '}';
        }
        //Mobile
        $name_font_size_xs = (isset($settings->name_font_size_xs) && $settings->name_font_size_xs) ? 'font-size:' . $settings->name_font_size_xs . 'px;' : '';
        $name_line_height_xs = (isset($settings->name_line_height_xs) && $settings->name_line_height_xs) ? 'line-height:' . $settings->name_line_height_xs . 'px;' : '';
        $content_fontsize_xs = (isset($settings->content_fontsize_xs) && $settings->content_fontsize_xs) ? 'font-size:' . $settings->content_fontsize_xs . 'px;' : '';
        $content_lineheight_xs = (isset($settings->content_lineheight_xs) && $settings->content_lineheight_xs) ? 'line-height:' . $settings->content_lineheight_xs . 'px;' : '';
        $content_margin_xs = (isset($settings->content_margin_xs) && trim($settings->content_margin_xs)) ? 'margin:' . $settings->content_margin_xs . ';' : '';
        $arrow_margin_xs = (isset($settings->arrow_margin) && trim($settings->arrow_margin)) ? "margin: " . $settings->arrow_margin_xs . ";" : "";
        //Avatar mobile style
        $avatar_width_xs = (isset($settings->avatar_width_xs) && $settings->avatar_width_xs) ? $settings->avatar_width_xs : '';
        //Designation mobile style
        $designation_style_xs = '';
        $designation_style_xs .= (isset($settings->designation_font_size_xs) && $settings->designation_font_size_xs) ? 'font-size:'.$settings->designation_font_size_xs . 'px;' : '';
        $designation_style_xs .= (isset($settings->designation_margin_xs) && trim($settings->designation_margin_xs)) ? 'margin:'.$settings->designation_margin_xs . ';' : '';
        $designation_style_xs .= (isset($settings->designation_line_height_xs) && $settings->designation_line_height_xs) ? 'line-height:'.$settings->designation_line_height_xs . 'px;' : '';

        if($icon_style_xs || $content_fontsize_xs || $arrow_margin_xs || $content_margin_xs || $name_font_size_xs || $name_line_height_xs || $content_lineheight_xs || $avatar_width_xs || $designation_style_xs){
            $css .= '@media (max-width: 767px) {';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .fa-quote-left{';
                    $css .= $icon_style_xs;
                $css .= '}';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-message {';
                    $css .= $content_fontsize_xs;
                    $css .= $content_margin_xs;
                    $css .= $content_lineheight_xs;
                $css .= '}';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-testimonial-pro .sppb-carousel-control{';
                    $css .= $arrow_margin_xs;
                $css .= '}';
                if($name_font_size_xs || $name_line_height_xs){
                    $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {';
                        $css .= $name_font_size_xs;
                        $css .= $name_line_height_xs;
                    $css .= '}';
                }
                if($avatar_width_xs){
                    $css .= $addon_id . ' .sppb-item > img{width:'.$avatar_width_xs.'px; height:'.$avatar_width_xs.'px;}';
                }
                if($designation_style_xs){
                    $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {';
                        $css .= $designation_style_xs;
                    $css .= '}';
                }
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {

        $output = '
            <#
                let interval = (data.interval)? (data.interval*1000):5000
                let autoplay = (data.autoplay)? \'data-sppb-ride="sppb-carousel"\':""
                let avatar_size = data.avatar_width || 32
                let avatar_shape = data.avatar_shape || "sppb-avatar-circle"
                let arrow_icon = (!_.isEmpty(data.arrow_icon)) ? data.arrow_icon : "chevron";
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
            #>
            <style type="text/css">
                #sppb-addon-{{ data.id }} .sppb-testimonial-pro .sppb-carousel-control{
                    width: {{data.arrow_width}}px;
                    height: {{data.arrow_height}}px;
                    background-color: {{data.arrow_background}};
                    color: {{data.arrow_color}};
                    <# if(_.isObject(data.arrow_margin)){ #>
                        margin: {{data.arrow_margin.md}};
                    <# } #>
                    font-size: {{data.arrow_font_size}}px;
                    <# if(data.arrow_height){ #>
                        line-height: {{data.arrow_height-data.arrow_border_width}}px;
                    <# } #>
                    border-width: {{data.arrow_border_width}}px;
                    border-color: {{data.arrow_border_color}};
                    border-radius: {{data.arrow_border_radius}}px;
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-pro .sppb-carousel-control:hover{
                    background-color: {{data.arrow_hover_background}};
                    color: {{data.arrow_hover_color}};
                    border-color: {{data.arrow_hover_border_color}};
                }
                #sppb-addon-{{ data.id }} .sppb-item > img,
                #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer img{
                    <# if(_.isObject(avatar_size)){ #>
                        width: {{avatar_size.md}}px;
                        height: {{avatar_size.md}}px;
                    <# } else { #>
                        width: {{avatar_size}}px;
                        height: {{avatar_size}}px;
                    <# } #>
                }
                <# if(data.show_quote){ #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-pro .fa-quote-left{
                        <# if(_.isObject(data.icon_size)){ #>
                            font-size: {{ data.icon_size.md }}px;
                        <# } #>
                        color: {{ data.icon_color }};
                    }
                <# } #>
                #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {
                    <# if(data.name_color){ #>
                        color: {{data.name_color}};
                    <# }
                    if(_.isEmpty(data.name_font_style) && !data.name_font_style){ #>
                        font-weight:700;
                    <# }
                    if(data.name_letterspace){ #>
                        letter-spacing: {{data.name_letterspace}};
                    <# }
                    if(_.isObject(data.name_font_size)) { #>
                        font-size: {{data.name_font_size.md}}px;
                    <# } else { #>
                        font-size: {{data.name_font_size}}px;
                    <# }
                    if(_.isObject(data.name_line_height)) { #>
                        line-height: {{data.name_line_height.md}}px;
                    <# } else { #>
                        line-height: {{data.name_line_height}}px;
                    <# }
                    if(_.isObject(data.name_font_style)){ #>
                        <# if(data.name_font_style.underline){ #>
                            text-decoration:underline;
                        <# }
                        if(data.name_font_style.italic){
                        #>
                            font-style:italic;
                        <# }
                        if(data.name_font_style.uppercase){
                        #>
                            text-transform:uppercase;
                        <# }
                        if(data.name_font_style.weight){
                        #>
                            font-weight:{{data.name_font_style.weight}};
                        <# } #>
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {
                    <# if(data.designation_color){ #>
                        color: {{data.designation_color}};
                    <# }
                    if(data.designation_block){ #>
                        display:block;
                    <# }
                    if(data.designation_letterspace){ #>
                        letter-spacing: {{data.designation_letterspace}};
                    <# }
                    if(_.isObject(data.designation_font_size)){ #>
                        font-size: {{data.designation_font_size.md}}px;
                    <# } else { #>
                        font-size: {{data.designation_font_size}}px;
                    <# }
                    if(_.isObject(data.designation_line_height)){ #>
                        line-height: {{data.designation_line_height.md}}px;
                    <# }
                    if(_.isObject(data.designation_margin)){ #>
                        margin: {{data.designation_margin.md}};
                    <# } else { #>
                        margin: {{data.designation_margin}};
                    <# }
                    if(_.isObject(data.designation_font_style)){ #>
                        <# if(data.designation_font_style.underline){ #>
                            text-decoration:underline;
                        <# }
                        if(data.designation_font_style.italic){
                        #>
                            font-style:italic;
                        <# }
                        if(data.designation_font_style.uppercase){
                        #>
                            text-transform:uppercase;
                        <# }
                        if(data.designation_font_style.weight){
                        #>
                            font-weight:{{data.designation_font_style.weight}};
                        <# } #>
                    <# } #>
                }
                
               <# if(data.bullet_border_color){ #>
                    #sppb-addon-{{ data.id }} .sppb-carousel-indicators li {
                        border-color:{{data.bullet_border_color}};
                    }
                <# }
                if(data.bullet_active_bg_color){
                #>
                    #sppb-addon-{{ data.id }} .sppb-carousel-indicators li.active {
                        background:{{data.bullet_active_bg_color}};
                        border-color:{{data.bullet_active_bg_color}};
                    }
                <# } #>
                #sppb-addon-{{ data.id }} .sppb-testimonial-message {
                    color:{{data.content_color}};
                    <# if(_.isObject(data.content_margin)){ #>
                        margin:{{data.content_margin.md}};
                    <# }
                    if(_.isObject(data.content_fontsize)){ #>
                        font-size: {{data.content_fontsize.md}}px;
                    <# }
                    if(_.isObject(data.content_lineheight)){ #>
                        line-height: {{data.content_lineheight.md}}px;
                    <# } #>
                    font-weight: {{data.content_fontweight}};
                }
                @media (min-width: 768px) and (max-width: 991px) {
                    <# if(data.show_quote){ #>
                        #sppb-addon-{{ data.id }} .sppb-testimonial-pro .fa-quote-left{
                            <# if(_.isObject(data.icon_size)){ #>
                                font-size: {{ data.icon_size.sm }}px;
                            <# } #>
                        }
                    <# }
                    if(_.isObject(data.content_fontsize) || _.isObject(data.content_margin)){ #>
                        #sppb-addon-{{ data.id }} .sppb-testimonial-message {
                            <# if(_.isObject(data.content_fontsize)){ #>
                                font-size: {{data.content_fontsize.sm}}px;
                            <# }
                            if(_.isObject(data.content_margin)){ #>
                                margin:{{data.content_margin.sm}};
                            <# }
                            if(_.isObject(data.content_lineheight)){ #>
                                line-height: {{data.content_lineheight.sm}}px;
                            <# } #>
                        }
                        <# if(_.isObject(data.arrow_margin)){ #>
                            #sppb-addon-{{ data.id }} .sppb-testimonial-pro .sppb-carousel-control{
                                margin: {{data.arrow_margin.sm}};
                            }
                        <# }
                        if(!_.isEmpty(data.name_font_size) || !_.isEmpty(data.name_line_height)){
                        #>
                            #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {
                                <# if(_.isObject(data.name_font_size)) { #>
                                    font-size: {{data.name_font_size.sm}}px;
                                <# }
                                if(_.isObject(data.name_line_height)) {
                                #>
                                    line-height: {{data.name_line_height.sm}}px;
                                <# } #>
                            }
                        <# }
                    } #>
                    #sppb-addon-{{ data.id }} .sppb-item > img,
                    #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer img{
                        <# if(_.isObject(avatar_size)){ #>
                            width: {{avatar_size.sm}}px;
                            height: {{avatar_size.sm}}px;
                        <# } #>
                    }
                    #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {
                        <# if(_.isObject(data.designation_font_size)){ #>
                            font-size: {{data.designation_font_size.sm}}px;
                        <# }
                        if(_.isObject(data.designation_line_height)){ #>
                            line-height: {{data.designation_line_height.sm}}px;
                        <# }
                        if(_.isObject(data.designation_margin)){ #>
                            margin: {{data.designation_margin.sm}};
                        <# } #>
                    }
                }
                @media (max-width: 767px) {
                    <# if(data.show_quote){ #>
                        #sppb-addon-{{ data.id }} .sppb-testimonial-pro .fa-quote-left{
                            <# if(_.isObject(data.icon_size)){ #>
                                font-size: {{ data.icon_size.xs }}px;
                            <# } #>
                        }
                    <# }
                    if(_.isObject(data.content_fontsize) || _.isObject(data.content_margin)){ #>
                        #sppb-addon-{{ data.id }} .sppb-testimonial-message {
                            <# if(_.isObject(data.content_fontsize)){ #>
                                font-size: {{data.content_fontsize.xs}}px;
                            <# }
                            if(_.isObject(data.content_margin)){ #>
                                margin:{{data.content_margin.xs}};
                            <# }
                            if(_.isObject(data.content_lineheight)){ #>
                                line-height: {{data.content_lineheight.xs}}px;
                            <# } #>
                        }
                    <# }
                    if(_.isObject(data.arrow_margin)){ #>
                        #sppb-addon-{{ data.id }} .sppb-testimonial-pro .sppb-carousel-control{
                            margin: {{data.arrow_margin.xs}};
                        }
                    <# }
                    if(!_.isEmpty(data.name_font_size) || !_.isEmpty(data.name_line_height)){
                    #>
                        #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-name {
                            <# if(_.isObject(data.name_font_size)) { #>
                                font-size: {{data.name_font_size.xs}}px;
                            <# }
                            if(_.isObject(data.name_line_height)) {
                            #>
                                line-height: {{data.name_line_height.xs}}px;
                            <# } #>
                        }
                    <# } #>
                    #sppb-addon-{{ data.id }} .sppb-item > img,
                    #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer img{
                        <# if(_.isObject(avatar_size)){ #>
                            width: {{avatar_size.xs}}px;
                            height: {{avatar_size.xs}}px;
                        <# } #>
                    }
                    #sppb-addon-{{ data.id }} .sppb-addon-testimonial-pro-footer .sppb-addon-testimonial-pro-client-designation {
                        <# if(_.isObject(data.designation_font_size)){ #>
                            font-size: {{data.designation_font_size.xs}}px;
                        <# }
                        if(_.isObject(data.designation_line_height)){ #>
                            line-height: {{data.designation_line_height.xs}}px;
                        <# }
                        if(_.isObject(data.designation_margin)){ #>
                            margin: {{data.designation_margin.xs}};
                        <# } #>
                    }
                }
            </style>
            <div id="sppb-testimonial-pro-{{ data.id }}" data-interval="{{ interval }}" class="sppb-carousel sppb-testimonial-pro sppb-slide {{data.content_alignment}} {{ data.class }}" {{{ autoplay }}}>

                <# if(data.controls) { #>
                    <ol class="sppb-carousel-indicators">
                    <#
                    _.each(data.sp_testimonialpro_item, function(item,key){
                        let activeClass
                        if (key == 0) {
                            activeClass = "class=active"
                        }else{
                            activeClass = ""
                        }
                    #>
                        <li data-sppb-target="#sppb-testimonial-pro-{{ data.id }}" {{ activeClass }} data-sppb-slide-to="{{ key }}"></li>
                    <# }) #>
                    </ol>
                <# } #>

                <# if(data.show_quote){ #>
                    <span class="fa fa-quote-left"></span>
                <# } #>
                <div class="sppb-carousel-inner">
                    <#
                    _.each(data.sp_testimonialpro_item, function(itemSlide, index) {
                        let slideActClass = ""
                        if (index == 0) {
                            slideActClass = " active"
                        } else {
                            slideActClass = ""
                        }
                    #>

                        <div class="sppb-item{{ slideActClass }}">
                            <#
                            var avatarImg = {}
                            if (typeof itemSlide.avatar !== "undefined" && typeof itemSlide.avatar.src !== "undefined") {
                                avatarImg = itemSlide.avatar
                            } else {
                                avatarImg = {src: itemSlide.avatar}
                            }
                            if (data.avatar_on_top == 1) { 
                            if (!_.isEmpty(avatarImg.src)) { #>
                                <# if(avatarImg.src?.indexOf("https://") == -1 && avatarImg.src?.indexOf("http://") == -1){ #>
                                    <img class="{{ avatar_shape }}" src=\'{{ pagebuilder_base + avatarImg.src }}\' alt="">
                                <# } else { #>
                                    <img class="{{ avatar_shape }}" src=\'{{ avatarImg.src }}\' alt="">
                                <# } #>
                            <# }
                            } #>
                            <div class="sppb-testimonial-message sp-editable-content" id="addon-message-{{data.id}}-{{index}}" data-id={{data.id}} data-fieldName="sp_testimonialpro_item-{{index}}-message">{{{ itemSlide.message }}}</div>

                            <div class="sppb-addon-testimonial-pro-footer">
                            <# if (data.avatar_on_top !== 1) { 
                            if (avatarImg.src) { #>
                                <# if(avatarImg.src?.indexOf("https://") == -1 && avatarImg.src?.indexOf("http://") == -1){ #>
                                    <img class="{{ avatar_shape }}" src=\'{{ pagebuilder_base + avatarImg.src }}\' alt="">
                                <# } else { #>
                                    <img class="{{ avatar_shape }}" src=\'{{ avatarImg.src }}\' alt="">
                                <# } #>
                            <# }
                            } #>
                            <div class="testimonial-pro-client-name-wrap">
                            <# if( !_.isEmpty(itemSlide.title) ) { #>
                            <span class="sppb-addon-testimonial-pro-client-name">{{{ itemSlide.title }}}</span>
                            <# if( !_.isEmpty(itemSlide.url) ) { #>
                                &nbsp;<span class="sppb-addon-testimonial-pro-client-url">{{ itemSlide.url }}</span>
                            <# }
                            if( !_.isEmpty(itemSlide.designation) ) { #>
                                &nbsp;<span class="sppb-addon-testimonial-pro-client-designation">{{{ itemSlide.designation }}}</span>
                            <# }
                            } #>
                            </div>
                            </div>
                        </div>

                    <# }) #>
                </div>
                <# if(data.arrow_controls) { #>
                    <a href="#sppb-testimonial-pro-{{ data.id }}" class="left sppb-carousel-control" data-slide="prev"><i class="fa {{left_arrow}}"></i></a>
                    <a href="#sppb-testimonial-pro-{{ data.id }}" class="right sppb-carousel-control" data-slide="next"><i class="fa {{right_arrow}}"></i></a>
                <# } #>
            </div>
            ';

        return $output;
    }

}