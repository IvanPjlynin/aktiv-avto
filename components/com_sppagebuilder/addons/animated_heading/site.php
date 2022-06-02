<?php

/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonAnimated_heading extends SppagebuilderAddons {

    public function render() {
        $settings = $this->addon->settings;
        $class = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';
        $class .= (isset($settings->alignment) && $settings->alignment) ? ' ' . $settings->alignment : ' sppb-text-center';
        //Heading
        $heading_style = (isset($settings->heading_style) && $settings->heading_style) ? $settings->heading_style : '';
        $heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h2';
        //Highlited options
        $heading_before_part = (isset($settings->heading_before_part) && $settings->heading_before_part) ? $settings->heading_before_part : '';
        $highlighted_text = (isset($settings->highlighted_text) && $settings->highlighted_text) ? $settings->highlighted_text : '';
        $heading_after_part = (isset($settings->heading_after_part) && $settings->heading_after_part) ? $settings->heading_after_part : '';
        $highlighted_shape = (isset($settings->highlighted_shape) && $settings->highlighted_shape) ? $settings->highlighted_shape : '';
        //Animation options
        $animated_text = (isset($settings->animated_text) && $settings->animated_text) ? $settings->animated_text : '';
        $text_animation_name = (isset($settings->text_animation_name) && $settings->text_animation_name) ? $settings->text_animation_name : '';
        $animated_text_chunk = '';
        if($animated_text){
            $animated_text_chunk = explode("\n", $animated_text);
        }
        $animated_text_class = '';
        if($animated_text && $text_animation_name){
            $animated_text_class = 'animated-heading-text ';
            switch($text_animation_name){
                case($text_animation_name == 'blinds'):
                    $animated_text_class .= 'letters animation-blinds';
                    break;
                case($text_animation_name == 'delete-typing'):
                    $animated_text_class .= 'letters type';
                    break;
                case($text_animation_name == 'flip'):
                    $animated_text_class .= 'text-animation-flip';
                    break;
                case($text_animation_name == 'fade-in'):
                    $animated_text_class .= 'zoom';
                    break;
                case($text_animation_name == 'loading-bar'):
                    $animated_text_class .= 'loading-bar';
                    break;
                case($text_animation_name == 'scale'):
                    $animated_text_class .= 'letters scale';
                    break;
                case($text_animation_name == 'slide'):
                    $animated_text_class .= 'letters scale';
                    break;
                case($text_animation_name == 'push'):
                    $animated_text_class .= 'push';
                    break;
                case($text_animation_name == 'wave'):
                    $animated_text_class .= 'letters animation-wave';
                    break;
                default:
                $animated_text_class .= 'text-clip is-full-width';
            }
        }

        //Output start
        $output = '';

        $output .= '<div class="sppb-addon sppb-addon-animated-heading' . $class . '">';
        $output .= '<'.$heading_selector.' class="sppb-addon-title '.($heading_style !== 'highlighted' ? $animated_text_class : '').'">';
        $output .= ($heading_before_part) ? '<span class="animated-heading-before-part">'.$heading_before_part.'</span>' : '';
        if($heading_style == 'highlighted'){
            if($highlighted_text){
                $output .= '<span class="animated-heading-highlighted-wrap">';
                    $output .= '<span class="animated-heading-highlighted-text '.($highlighted_shape ? 'shape-'.$highlighted_shape : '').'">';
                    $output .= $highlighted_text;
                    $output .= '</span>';
                    if($highlighted_shape == 'cross'){
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M497.4,23.9C301.6,40,155.9,80.6,4,144.4"></path>
                            <path d="M14.1,27.6c204.5,20.3,393.8,74,467.3,111.7"></path>
                        </svg>';
                    } elseif ($highlighted_shape == 'bg-fill') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                        <path fill="none" stroke="#020202" stroke-width="150" stroke-miterlimit="10" d="M0 75h500"/>
                      </svg>';
                    } elseif ($highlighted_shape == 'square') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                        <path d="M44.22 0c2.46 51.77-2.05 99.72-13.51 143.84 50.37-7.64 316.96-30.55 469.29-5.09-16.41-40.58-21.99-71.11-23.34-127.29C378.38 22.92 97.06 34.37 0 22.92"/>
                      </svg>';
                    } elseif ($highlighted_shape == 'sharpe-zigzag') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                        <path d="M.23 139.83l28.27-19.78 25.43 19.79 28.27-19.77 22.6 19.79 29.68-19.78 25.44 19.79 25.44-19.78 28.27 19.79 26.85-19.77 26.84 19.8 24.04-19.79 24.01 19.8 22.62-19.78 22.61 19.8 22.61-19.78 24.02 19.79 24.03-19.78 24.02 19.8 22.62-19.79 21.19 19.79"/>
                      </svg>';
                    } elseif ($highlighted_shape == 'diagonal') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M13.5,15.5c131,13.7,289.3,55.5,475,125.5"></path>
                        </svg>';
                    } 
                    elseif ($highlighted_shape == 'top-botm-line') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M8.4,143.1c14.2-8,97.6-8.8,200.6-9.2c122.3-0.4,287.5,7.2,287.5,7.2"></path>
                            <path d="M8,19.4c72.3-5.3,162-7.8,216-7.8c54,0,136.2,0,267,7.8"></path>
                        </svg>';
                    }
                    elseif ($highlighted_shape == 'strikethrough') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M3,75h493.5"></path>
                        </svg>';
                    } elseif ($highlighted_shape == 'underline') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7"></path>
                        </svg>';
                    } elseif ($highlighted_shape == 'dubl-underline') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M5,125.4c30.5-3.8,137.9-7.6,177.3-7.6c117.2,0,252.2,4.7,312.7,7.6"></path>
                            <path d="M26.9,143.8c55.1-6.1,126-6.3,162.2-6.1c46.5,0.2,203.9,3.2,268.9,6.4"></path>
                        </svg>';
                    } elseif ($highlighted_shape == 'zigzag-underline') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                        </svg>';
                    } elseif ($highlighted_shape == 'wave') {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M3,146.1c17.1-8.8,33.5-17.8,51.4-17.8c15.6,0,17.1,18.1,30.2,18.1c22.9,0,36-18.6,53.9-18.6 c17.1,0,21.3,18.5,37.5,18.5c21.3,0,31.8-18.6,49-18.6c22.1,0,18.8,18.8,36.8,18.8c18.8,0,37.5-18.6,49-18.6c20.4,0,17.1,19,36.8,19 c22.9,0,36.8-20.6,54.7-18.6c17.7,1.4,7.1,19.5,33.5,18.8c17.1,0,47.2-6.5,61.1-15.6"></path>
                        </svg>';
                    } else {
                        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,77.6c1.4,32.4,52.2,54,142.6,63.7 c66.2,7.1,212.2,7.5,273.5-8.3c64.4-16.6,104.3-57.6,33.8-98.2C386.7-4.9,179.4-1.4,126.3,20.7">
                            </path>
                        </svg>';
                    }
                $output .= '</span>';
            }
        } else {
            $output .= '<span class="animated-text-words-wrapper">';
            if(is_array($animated_text_chunk)){
                foreach($animated_text_chunk as $key => $item){
                    $output .= '<span class="animated-text '.($key==0 ? 'is-visible' : '').'">'.$item.'</span>';
                }
            }
            $output .= '</span>';
        }
        $output .= ($heading_after_part) ? '<span class="animated-heading-after-part">'.$heading_after_part.'</span>' : '';
        $output .= '</'.$heading_selector.'>';
        $output .= '</div>';

        return $output;
    }

    public function css() {
        $settings = $this->addon->settings;
        $addon_id = '#sppb-addon-' . $this->addon->id;

        //Heading Style
        $style = '';
        $style_sm = '';
        $style_xs = '';
        
        $style .= (isset($settings->heading_margin) && trim($settings->heading_margin)) ? 'margin: ' . $settings->heading_margin  . ';' : '';
        $style .= (isset($settings->heading_padding) && trim($settings->heading_padding)) ? 'padding: ' . $settings->heading_padding  . ';' : '';
        $style .= (isset($settings->heading_color) && $settings->heading_color) ? 'color: ' . $settings->heading_color  . ';' : '';
        $style .= (isset($settings->heading_fontsize) && $settings->heading_fontsize) ? 'font-size: ' . $settings->heading_fontsize  . 'px;' : '';
        $style .= (isset($settings->heading_lineheight) && $settings->heading_lineheight) ? 'line-height: ' . $settings->heading_lineheight  . 'px;' : '';
        $style .= (isset($settings->heading_letterspace) && $settings->heading_letterspace) ? 'letter-spacing: ' . $settings->heading_letterspace  . ';' : '';

        $heading_font_style = (isset($settings->heading_font_style) && $settings->heading_font_style) ? $settings->heading_font_style : '';
        if(isset($heading_font_style->underline) && $heading_font_style->underline){
			$style .= 'text-decoration:underline;';
		}
		if(isset($heading_font_style->italic) && $heading_font_style->italic){
			$style .= 'font-style:italic;';
		}
		if(isset($heading_font_style->uppercase) && $heading_font_style->uppercase){
			$style .= 'text-transform:uppercase;';
		}
		if(isset($heading_font_style->weight) && $heading_font_style->weight){
			$style .= 'font-weight:'.$heading_font_style->weight.';';
		}

        //Tab Style
        $style_sm .= (isset($settings->heading_margin_sm) && $settings->heading_margin_sm) ? 'margin: ' . $settings->heading_margin_sm  . ';' : '';
        $style_sm .= (isset($settings->heading_padding_sm) && $settings->heading_padding_sm) ? 'padding: ' . $settings->heading_padding_sm  . ';' : '';
        $style_sm .= (isset($settings->heading_fontsize_sm) && $settings->heading_fontsize_sm) ? 'font-size: ' . $settings->heading_fontsize_sm  . 'px;' : '';
        $style_sm .= (isset($settings->heading_lineheight_sm) && $settings->heading_lineheight_sm) ? 'line-height: ' . $settings->heading_lineheight_sm  . 'px;' : '';

        //Mobile Style
        $style_xs .= (isset($settings->heading_margin_xs) && $settings->heading_margin_xs) ? 'margin: ' . $settings->heading_margin_xs  . ';' : '';
        $style_xs .= (isset($settings->heading_padding_xs) && $settings->heading_padding_xs) ? 'padding: ' . $settings->heading_padding_xs  . ';' : '';
        $style_xs .= (isset($settings->heading_fontsize_xs) && $settings->heading_fontsize_xs) ? 'font-size: ' . $settings->heading_fontsize_xs  . 'px;' : '';
        $style_xs .= (isset($settings->heading_lineheight_xs) && $settings->heading_lineheight_xs) ? 'line-height: ' . $settings->heading_lineheight_xs  . 'px;' : '';

        //Animated Text Style
        $animated_text_style = '';
        $animated_text_style_sm = '';
        $animated_text_style_xs = '';
        
        $animated_text_style .= (isset($settings->animated_text_color) && $settings->animated_text_color) ? 'color: ' . $settings->animated_text_color  . ';' : '';
        $animated_text_style .= (isset($settings->animated_text_fontsize) && $settings->animated_text_fontsize) ? 'font-size: ' . $settings->animated_text_fontsize  . 'px;' : '';
        $animated_text_style .= (isset($settings->animated_text_letterspace) && $settings->animated_text_letterspace) ? 'letter-spacing: ' . $settings->animated_text_letterspace  . ';' : '';

        $animated_text_font_style = (isset($settings->animated_text_font_style) && $settings->animated_text_font_style) ? $settings->animated_text_font_style : '';
        if(isset($animated_text_font_style->underline) && $animated_text_font_style->underline){
			$animated_text_style .= 'text-decoration:underline;';
		}
		if(isset($animated_text_font_style->italic) && $animated_text_font_style->italic){
			$animated_text_style .= 'font-style:italic;';
		}
		if(isset($animated_text_font_style->uppercase) && $animated_text_font_style->uppercase){
			$animated_text_style .= 'text-transform:uppercase;';
		}
		if(isset($animated_text_font_style->weight) && $animated_text_font_style->weight){
			$animated_text_style .= 'font-weight:'.$animated_text_font_style->weight.';';
		}

        //Tab Style
        $animated_text_style_sm .= (isset($settings->animated_text_fontsize_sm) && $settings->animated_text_fontsize_sm) ? 'font-size: ' . $settings->animated_text_fontsize_sm  . 'px;' : '';

        //Mobile Style
        $animated_text_style_xs .= (isset($settings->animated_text_fontsize_xs) && $settings->animated_text_fontsize_xs) ? 'font-size: ' . $settings->animated_text_fontsize_xs  . 'px;' : '';

        //Css Output Start
        $css = '';
        if ($style || $animated_text_style) {
            $css .= $addon_id . ' .sppb-addon-title {' . $style . '}';
            $css .= $addon_id . ' .animated-heading-highlighted-text {' . $animated_text_style . '}';
            $css .= $addon_id . ' .animated-text-words-wrapper {' . $animated_text_style . '}';
        }

        if ($style_sm || $animated_text_style_sm) {
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
                $css .= $addon_id . ' .sppb-addon-title {' . $style_sm . '}';
                $css .= $addon_id . ' .animated-heading-highlighted-text {' . $animated_text_style_sm . '}';
                $css .= $addon_id . ' .animated-text-words-wrapper {' . $animated_text_style_sm . '}';
            $css .= '}';
        }

        if ($style_xs || $animated_text_style_xs) {
            $css .= '@media (max-width: 767px) {';
                $css .= $addon_id . ' .sppb-addon-title {' . $style_xs . '}';
                $css .= $addon_id . ' .animated-heading-highlighted-text {' . $animated_text_style_xs . '}';
                $css .= $addon_id . ' .animated-text-words-wrapper {' . $animated_text_style_xs . '}';
            $css .= '}';
        }
        //Shape style
        $highlighted_shape = (isset($settings->highlighted_shape) && $settings->highlighted_shape) ? $settings->highlighted_shape : '';
        if($highlighted_shape){
            $css .= $addon_id . ' .animated-heading-highlighted-wrap svg path {';
                if(isset($settings->shape_width) && $settings->shape_width){
                    $css .= 'stroke-width: '.$settings->shape_width.'px;';
                }
                if(isset($settings->shape_radius) && $settings->shape_radius){
                    $css .= 'stroke-linecap: round;';
                    $css .= 'stroke-linejoin: round;';
                }
                if(isset($settings->shape_color) && $settings->shape_color){
                    $css .= 'stroke: '.$settings->shape_color.';';
                }
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {
        $output = '
        <style type="text/css">

        #sppb-addon-{{ data.id }} .sppb-addon-title {
            <# if(_.isObject(data.heading_margin)) { #>
                margin: {{data.heading_margin.md}};
            <# } else { #>
                margin: {{data.heading_margin}};
            <# }
            if(_.isObject(data.heading_padding)){ 
            #>
                padding: {{data.heading_padding.md}};
            <# } else { #>
                padding: {{data.heading_padding}};
            <# }
            if(_.isObject(data.heading_fontsize)) {
            #>
                font-size: {{data.heading_fontsize.md}}px;
            <# } else { #>
                font-size: {{data.heading_fontsize}}px;
            <# }
            if(_.isObject(data.heading_lineheight)){
            #>
                line-height: {{data.heading_lineheight.md}}px;
            <# } else { #>
                line-height: {{data.heading_lineheight}}px;
            <# } #>
            color: {{data.heading_color}};
            letter-spacing: {{data.heading_letterspace}};

            <# if(_.isObject(data.heading_font_style)){
                if(data.heading_font_style.underline){
            #>
                    text-decoration:underline;
                <# }
                if(data.heading_font_style.italic){
                #>
                    font-style:italic;
                <# }
                if(data.heading_font_style.uppercase){
                #>
                    text-transform:uppercase;
                <# }
                if(data.heading_font_style.weight){
                #>
                    font-weight:{{data.heading_font_style.weight}};
                <# }
            } #>
        }
        #sppb-addon-{{ data.id }} .animated-heading-highlighted-text { 
            color: {{data.animated_text_color}};
            <# if(_.isObject(data.animated_text_fontsize)) { #>
                font-size: {{data.animated_text_fontsize.md}}px;
            <# } else { #>
                font-size: {{data.animated_text_fontsize}}px;
            <# } #>
            letter-spacing: {{data.animated_text_letterspace}};
            <# if(_.isObject(data.animated_text_font_style)){
                if(data.animated_text_font_style.underline){
            #>
                    text-decoration:underline;
                <# }
                if(data.animated_text_font_style.italic){
                #>
                    font-style:italic;
                <# }
                if(data.animated_text_font_style.uppercase){
                #>
                    text-transform:uppercase;
                <# }
                if(data.animated_text_font_style.weight){
                #>
                    font-weight:{{data.animated_text_font_style.weight}};
                <# }
            } #>
        }
        #sppb-addon-{{ data.id }} .animated-text-words-wrapper {
            color: {{data.animated_text_color}};
            <# if(_.isObject(data.animated_text_fontsize)) { #>
                font-size: {{data.animated_text_fontsize.md}}px;
            <# } else { #>
                font-size: {{data.animated_text_fontsize}}px;
            <# } #>
            letter-spacing: {{data.animated_text_letterspace}};
            <# if(_.isObject(data.animated_text_font_style)){
                if(data.animated_text_font_style.underline){
            #>
                    text-decoration:underline;
                <# }
                if(data.animated_text_font_style.italic){
                #>
                    font-style:italic;
                <# }
                if(data.animated_text_font_style.uppercase){
                #>
                    text-transform:uppercase;
                <# }
                if(data.animated_text_font_style.weight){
                #>
                    font-weight:{{data.animated_text_font_style.weight}};
                <# }
            } #>
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #sppb-addon-{{ data.id }} .sppb-addon-title {
                <# if(_.isObject(data.heading_margin)){ #>
                    margin: {{data.heading_margin.sm}};
                <# }
                if(_.isObject(data.heading_padding)) { 
                #>
                    padding: {{data.heading_padding.sm}};
                <# } 
                if(_.isObject(data.heading_fontsize)) {
                #>
                    font-size: {{data.heading_fontsize.sm}}px;
                <# }
                if(_.isObject(data.heading_lineheight)){
                #>
                    line-height: {{data.heading_lineheight.sm}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .animated-heading-highlighted-text {
                <# if(_.isObject(data.animated_text_fontsize)) { #>
                    font-size: {{data.animated_text_fontsize.sm}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .animated-text-words-wrapper {
                <# if(_.isObject(data.animated_text_fontsize)) { #>
                    font-size: {{data.animated_text_fontsize.sm}}px;
                <# } #>
            }
        }

        @media (max-width: 767px) {
            #sppb-addon-{{ data.id }} .sppb-addon-title {
                <# if(_.isObject(data.heading_margin)){ #>
                    margin: {{data.heading_margin.xs}};
                <# }
                if(_.isObject(data.heading_padding)) { 
                #>
                    padding: {{data.heading_padding.xs}};
                <# } 
                if(_.isObject(data.heading_fontsize)) {
                #>
                    font-size: {{data.heading_fontsize.xs}}px;
                <# }
                if(_.isObject(data.heading_lineheight)){
                #>
                    line-height: {{data.heading_lineheight.xs}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .animated-heading-highlighted-text {
                <# if(_.isObject(data.animated_text_fontsize)) { #>
                    font-size: {{data.animated_text_fontsize.xs}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .animated-text-words-wrapper {
                <# if(_.isObject(data.animated_text_fontsize)) { #>
                    font-size: {{data.animated_text_fontsize.xs}}px;
                <# } #>
            }
        }
        <# if(data.highlighted_shape){ #>
            #sppb-addon-{{ data.id }} .animated-heading-highlighted-wrap svg path {
                <# if(!_.isEmpty(data.shape_width) && data.shape_width){ #>
                    stroke-width: {{data.shape_width}}px;
                <# }
                if(data.shape_radius){
                #>
                    stroke-linecap: round;
                    stroke-linejoin: round;
                <# }
                if(!_.isEmpty(data.shape_color) && data.shape_color){
                #>
                    stroke: {{data.shape_color}};
                <# } #>
            }
        <# } #>

        </style>
        <# 
        let animated_text = (!_.isEmpty(data.animated_text) && data.animated_text) ? data.animated_text : "";

        let animated_text_chunk = "";
        if(animated_text){
            animated_text_chunk = _.split(animated_text, "\n");
        }

        let animated_text_class = "";
        if(animated_text && data.text_animation_name){
            animated_text_class = "animated-heading-text ";
            if(data.text_animation_name == "blinds"){
                animated_text_class += "letters animation-blinds";
            } else if(data.text_animation_name == "delete-typing"){
                animated_text_class += "letters type";
            } else if(data.text_animation_name == "flip"){
                animated_text_class += "text-animation-flip";
            } else if(data.text_animation_name == "fade-in"){
                animated_text_class += "zoom";
            } else if(data.text_animation_name == "loading-bar"){
                animated_text_class += "loading-bar";
            } else if(data.text_animation_name == "scale"){
                animated_text_class += "letters scale";
            } else if(data.text_animation_name == "slide"){
                animated_text_class += "letters scale";
            } else if(data.text_animation_name == "push"){
                animated_text_class += "push";
            } else if(data.text_animation_name == "wave"){
                animated_text_class += "letters animation-wave";
            } else {
                animated_text_class += "text-clip is-full-width";
            }
        }
        #>

        <div class="sppb-addon sppb-addon-animated-heading {{data.class}} {{data.alignment}}">
        <{{data.heading_selector}} class="sppb-addon-title {{animated_text_class}}">
        <# if(data.heading_before_part) { #>
            <span class="animated-heading-before-part sp-inline-editable-element" data-id={{data.id}} data-fieldName="heading_before_part" contenteditable="true">{{data.heading_before_part}}</span>
        <# }
        if(data.heading_style == "highlighted"){
            if(data.highlighted_text){
            #>
                <span class="animated-heading-highlighted-wrap">
                    <span class="animated-heading-highlighted-text sp-inline-editable-element shape-{{data.highlighted_shape}}" data-id={{data.id}} data-fieldName="highlighted_text" contenteditable="true">
                        {{data.highlighted_text}}
                    </span>
                    <# if(data.highlighted_shape == "cross"){ #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M497.4,23.9C301.6,40,155.9,80.6,4,144.4"></path>
                            <path d="M14.1,27.6c204.5,20.3,393.8,74,467.3,111.7"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "diagonal") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M13.5,15.5c131,13.7,289.3,55.5,475,125.5"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "strikethrough") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M3,75h493.5"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "top-botm-line") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M8.4,143.1c14.2-8,97.6-8.8,200.6-9.2c122.3-0.4,287.5,7.2,287.5,7.2"></path>
                            <path d="M8,19.4c72.3-5.3,162-7.8,216-7.8c54,0,136.2,0,267,7.8"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "underline") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "dubl-underline") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M5,125.4c30.5-3.8,137.9-7.6,177.3-7.6c117.2,0,252.2,4.7,312.7,7.6"></path>
                            <path d="M26.9,143.8c55.1-6.1,126-6.3,162.2-6.1c46.5,0.2,203.9,3.2,268.9,6.4"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "zigzag-underline") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "wave") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M3,146.1c17.1-8.8,33.5-17.8,51.4-17.8c15.6,0,17.1,18.1,30.2,18.1c22.9,0,36-18.6,53.9-18.6 c17.1,0,21.3,18.5,37.5,18.5c21.3,0,31.8-18.6,49-18.6c22.1,0,18.8,18.8,36.8,18.8c18.8,0,37.5-18.6,49-18.6c20.4,0,17.1,19,36.8,19 c22.9,0,36.8-20.6,54.7-18.6c17.7,1.4,7.1,19.5,33.5,18.8c17.1,0,47.2-6.5,61.1-15.6"></path>
                        </svg>
                    <# } else if (data.highlighted_shape == "bg-fill") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path fill="none" stroke="#020202" stroke-width="150" stroke-miterlimit="10" d="M0 75h500"/>
                        </svg>
                    <# } else if (data.highlighted_shape == "square") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M44.22 0c2.46 51.77-2.05 99.72-13.51 143.84 50.37-7.64 316.96-30.55 469.29-5.09-16.41-40.58-21.99-71.11-23.34-127.29C378.38 22.92 97.06 34.37 0 22.92"/>
                      </svg>
                    <# } else if (data.highlighted_shape == "sharpe-zigzag") { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M.23 139.83l28.27-19.78 25.43 19.79 28.27-19.77 22.6 19.79 29.68-19.78 25.44 19.79 25.44-19.78 28.27 19.79 26.85-19.77 26.84 19.8 24.04-19.79 24.01 19.8 22.62-19.78 22.61 19.8 22.61-19.78 24.02 19.79 24.03-19.78 24.02 19.8 22.62-19.79 21.19 19.79"/>
                      </svg>
                    <# } else { #>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,77.6c1.4,32.4,52.2,54,142.6,63.7 c66.2,7.1,212.2,7.5,273.5-8.3c64.4-16.6,104.3-57.6,33.8-98.2C386.7-4.9,179.4-1.4,126.3,20.7">
                            </path>
                        </svg>
                    <# } #>
                </span>
            <# }
        } else {
            #>
            <span class="animated-text-words-wrapper">
            <# if(_.isArray(animated_text_chunk)){
                _.each(animated_text_chunk, function(item, key){
                    let visibleClass = "";
                    if(key==0){
                        visibleClass = "is-visible";
                    }
            #>
                    <span class="animated-text {{visibleClass}}">{{item}}</span>
                <# })
            } #>
            </span>
        <# }
        if(data.heading_after_part) {
        #>
            <span class="animated-heading-after-part sp-inline-editable-element" data-id={{data.id}} data-fieldName="heading_after_part" contenteditable="true">{{data.heading_after_part}}</span>
        <# } #>
        </{{data.heading_selector}}>
        </div>
        ';

        return $output;
    }
}
