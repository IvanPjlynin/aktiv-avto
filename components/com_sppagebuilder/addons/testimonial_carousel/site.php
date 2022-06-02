<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonTestimonial_carousel extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' '.$settings->class : '';
        $testimonial_carousel_layout = (isset($settings->testimonial_carousel_layout) && $settings->testimonial_carousel_layout) ? $settings->testimonial_carousel_layout : '';
        $carousel_autoplay = (isset($settings->carousel_autoplay) && $settings->carousel_autoplay) ? $settings->carousel_autoplay : 0;
        $carousel_speed = (isset($settings->carousel_speed) && $settings->carousel_speed) ? $settings->carousel_speed : 1500;
        $carousel_interval = (isset($settings->carousel_interval) && $settings->carousel_interval) ? $settings->carousel_interval : 4500;
        $carousel_margin = (isset($settings->carousel_margin) && $settings->carousel_margin) ? $settings->carousel_margin : 0;
        $carousel_item_number = (isset($settings->carousel_item_number) && $settings->carousel_item_number) ? $settings->carousel_item_number : 3;
        $carousel_item_number_sm = (isset($settings->carousel_item_number_sm) && $settings->carousel_item_number_sm) ? $settings->carousel_item_number_sm : 3;
        $carousel_item_number_xs = (isset($settings->carousel_item_number_xs) && $settings->carousel_item_number_xs) ? $settings->carousel_item_number_xs : 1;
        $carousel_bullet = (isset($settings->carousel_bullet) && $settings->carousel_bullet) ? $settings->carousel_bullet : 0;
        $content_alignment = (isset($settings->content_alignment) && $settings->content_alignment) ? $settings->content_alignment : '';

		//Arrow style
        $carousel_arrow = (isset($settings->carousel_arrow) && $settings->carousel_arrow) ? $settings->carousel_arrow : 0;
        $arrow_icon = (isset($settings->arrow_icon) && $settings->arrow_icon) ? $settings->arrow_icon : 'angle';
        $left_arrow ='';
        $right_arrow = '';
        if($arrow_icon=='long_arrow'){
            $left_arrow ='fa-long-arrow-left';
            $right_arrow = 'fa-long-arrow-right';
        } else {
			$left_arrow ='fa-angle-left';
            $right_arrow = 'fa-angle-right';
        }

        //Quote icon
        $quote_icon = '';
        if(isset($settings->show_quote_icon) && $settings->show_quote_icon){
            $quote_icon .= '<div class="sppb-testimonial-carousel-icon">';
            $quote_icon .= '<i class="fa fa-quote-left" aria-hidden="true"></i>';
            $quote_icon .= '</div>';
        }

		//Output
		$output  = '<div class="sppb-addon sppb-carousel-extended' . $class . ' sppb-testimonial-carousel-'.$testimonial_carousel_layout.'" data-left-arrow="'.$left_arrow.'" data-right-arrow="'.$right_arrow.'" data-arrow="'.$carousel_arrow.'" data-dots="'.$carousel_bullet.'" data-testi-layout="'.$testimonial_carousel_layout.'" data-autoplay="'.$carousel_autoplay.'" data-speed="'.$carousel_speed.'" data-interval="'.$carousel_interval.'" data-margin="'.$carousel_margin.'" data-item-number="'.$carousel_item_number.'" data-item-number-sm="'.$carousel_item_number_sm.'" data-item-number-xs="'.$carousel_item_number_xs.'">';
		if(isset($settings->sp_testimonial_carousel_item) && is_array($settings->sp_testimonial_carousel_item)){
			foreach($settings->sp_testimonial_carousel_item as $item_key => $carousel_item){
                $uniqId = 'sppb-testi-'.$this->addon->id.'-carousel-item-key-'.$item_key;
                $client_details = '';

                $carousel_img = isset($carousel_item->testimonial_carousel_img) && $carousel_item->testimonial_carousel_img ? $carousel_item->testimonial_carousel_img : '';
                $carousel_img_src = isset($carousel_img->src) ? $carousel_img->src : $carousel_img;

                $client_details .= '<div class="sppb-testimonial-carousel-content-wrap">';
                    if($carousel_img_src){
                        $client_details .= '<div class="sppb-testimonial-carousel-img-wrap">';
                        $client_details .= '<img src="'.$carousel_img_src.'" alt="'.(isset($carousel_item->client_name) ? $carousel_item->client_name : '').'">';
                        $client_details .= '</div>';
                    }
                    $client_details .= '<div class="sppb-testimonial-carousel-name-designation">';
                        if(isset($carousel_item->client_name)){
                            $client_details .= '<div class="sppb-testimonial-carousel-name">';
                            $client_details .= $carousel_item->client_name;
                            $client_details .= '</div>';
                        }
                        if(isset($carousel_item->client_desgination)){
                            $client_details .= '<div class="sppb-testimonial-carousel-designation">';
                            $client_details .= $carousel_item->client_desgination;
                            $client_details .= '</div>';
                        }
                    $client_details .= '</div>';
                $client_details .= '</div>';

                $rating = '';
                if(isset($carousel_item->show_rating) && $carousel_item->show_rating){
                    $rating .= '<div class="sppb-testimonial-carousel-client-rating rating-key-'. $item_key .'"><span class="sppb-testimonial-carousel-rating"></span></div>';
                }

                $output .= '<div id="'.$uniqId.'" class="sppb-carousel-extended-item'.' '.$content_alignment.'">';
                    if($testimonial_carousel_layout == 'testi_layout1'){
                        $output .= $quote_icon;
                    }

                    if($testimonial_carousel_layout == 'testi_layout2'){
                        $output .= $client_details;
                    };

                    $output .= '<div class="sppb-testimonial-carousel-item-content">';
                    if($testimonial_carousel_layout == 'testi_layout2' || $testimonial_carousel_layout == 'testi_layout3'){
                        $output .= $rating;
                    };

                    if(isset($carousel_item->client_message)){
                        $output .= '<div class="sppb-testimonial-carousel-message">';
                        $output .= $carousel_item->client_message;
                        $output .= '</div>';
                    }

                    if($testimonial_carousel_layout == 'testi_layout1'){
                        $output .= $rating;
                    };
                    $output .= '</div>';
                    if($testimonial_carousel_layout == 'testi_layout1' || $testimonial_carousel_layout == 'testi_layout3'){
                        $output .= $client_details;
                    };

                    if($testimonial_carousel_layout == 'testi_layout2'){
                        $output .= $quote_icon;
                    }
				$output .= '</div>';
			}
		}
		$output .= '</div>';

		return $output;

	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/sp_carousel.js');
	}

	public function css() {
		$settings = $this->addon->settings;
        $css = '';
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $testimonial_carousel_layout = (isset($settings->testimonial_carousel_layout) && $settings->testimonial_carousel_layout) ? $settings->testimonial_carousel_layout : '';
        $overlay_gradient = (isset($settings->overlay_gradient) && $settings->overlay_gradient) ? $settings->overlay_gradient : '';
        
        //Arrow Style
        $carousel_arrow = (isset($settings->carousel_arrow) && $settings->carousel_arrow) ? $settings->carousel_arrow : 1;
        $arrow_style = '';
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "height: " . $settings->arrow_height . "px;" : "";
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "line-height: " . (((int) $settings->arrow_height)-((int) $settings->arrow_border_width)) . "px;" : "";

        $arrow_style .= (isset($settings->arrow_width) && $settings->arrow_width) ? "width: " . $settings->arrow_width . "px;" : "";
        $arrow_style .= (isset($settings->arrow_background) && $settings->arrow_background) ? "background: " . $settings->arrow_background . ";" : "";
        $arrow_style .= (isset($settings->arrow_color) && $settings->arrow_color) ? "color: " . $settings->arrow_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_font_size) && $settings->arrow_font_size) ? "font-size: " . $settings->arrow_font_size . "px;" : "";
        $arrow_style .= (isset($settings->arrow_border_width) && $settings->arrow_border_width) ? "border-width: " . $settings->arrow_border_width . "px;" : "";
        $arrow_style .= (isset($settings->arrow_border_width) && $settings->arrow_border_width) ? "border-style: solid;" : "";
        $arrow_style .= (isset($settings->arrow_border_color) && $settings->arrow_border_color) ? "border-color: " . $settings->arrow_border_color . ";" : "";
        $arrow_style .= (isset($settings->arrow_border_radius) && $settings->arrow_border_radius) ? "border-radius: " . $settings->arrow_border_radius . "px;" : "";
        //Arrow hover style
        $arrow_hover_style = '';
        $arrow_hover_style .= (isset($settings->arrow_hover_background) && $settings->arrow_hover_background) ? "background-color: " . $settings->arrow_hover_background . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_color) && $settings->arrow_hover_color) ? "color: " . $settings->arrow_hover_color . ";" : "";
        $arrow_hover_style .= (isset($settings->arrow_hover_border_color) && $settings->arrow_hover_border_color) ? "border-color: " . $settings->arrow_hover_border_color . ";" : "";

        if($carousel_arrow){
            if($arrow_style){
                $css .= $addon_id . ' .sppb-carousel-extended-nav-control .nav-control {';
                    $css .= $arrow_style;
                    if(isset($settings->arrow_position_verti) && $settings->arrow_position_verti != ''){
                        $css .= 'margin-top: '.$settings->arrow_position_verti.'%;';
                    }
                    if(isset($settings->arrow_position_hori) && $settings->arrow_position_hori != ''){
                        $css .= 'margin-left: '.$settings->arrow_position_hori.'px;';
                    }
                    if(isset($settings->arrow_position_hori) && $settings->arrow_position_hori != ''){
                        $css .= 'margin-right: '.$settings->arrow_position_hori.'px;';
                    }
                $css .= '}';
            }

            if($arrow_hover_style){
                $css .= $addon_id . ' .sppb-carousel-extended-nav-control .nav-control:hover{';
                    $css .= $arrow_hover_style;
                $css .= '}';
            }
        }
        //Bullet Style
        $carousel_bullet = (isset($settings->carousel_bullet) && $settings->carousel_bullet) ? $settings->carousel_bullet : 1;
        $bullet_style = '';
        $bullet_style .= (isset($settings->bullet_height) && $settings->bullet_height) ? "height: " . $settings->bullet_height . "px;" : "";
        $bullet_style .= (isset($settings->bullet_height) && $settings->bullet_height) ? "line-height: " . (($settings->bullet_height)-($settings->bullet_border_width)) . "px;" : "";

        $bullet_style .= (isset($settings->bullet_width) && $settings->bullet_width) ? "width: " . $settings->bullet_width . "px;" : "";
        $bullet_style .= (isset($settings->bullet_background) && $settings->bullet_background) ? "background: " . $settings->bullet_background . ";" : "";
        $bullet_style .= (isset($settings->bullet_border_width) && $settings->bullet_border_width) ? "border-width: " . $settings->bullet_border_width . "px;" : "";
        $bullet_style .= (isset($settings->bullet_border_width) && $settings->bullet_border_width) ? "border-style: solid;" : "";
        $bullet_style .= (isset($settings->bullet_border_color) && $settings->bullet_border_color) ? "border-color: " . $settings->bullet_border_color . ";" : "";
        $bullet_style .= (isset($settings->bullet_border_radius) && $settings->bullet_border_radius != '') ? "border-radius: " . $settings->bullet_border_radius . "px;" : "";
        //Bullet hover style
        $bullet_active_style = (isset($settings->bullet_active_background) && $settings->bullet_active_background) ? "background: " . $settings->bullet_active_background . ";" : "";

        if($carousel_bullet){
            if($bullet_style){
                $css .= $addon_id . ' .sppb-carousel-extended-dots ul li {';
                    $css .= $bullet_style;
                $css .= '}';
                $css .= $addon_id . ' .sppb-carousel-extended-dots {';
                    if(isset($settings->bullet_position_verti) && $settings->bullet_position_verti != ''){
                        $css .= 'bottom: '.$settings->bullet_position_verti.'%;';
                    }
                    if(isset($settings->bullet_position_hori) && $settings->bullet_position_hori != ''){
                        $css .= 'left: '.$settings->bullet_position_hori.'px;';
                    }
                $css .= '}';
            }

            if($bullet_active_style){
                $css .= $addon_id . ' .sppb-carousel-extended-dots ul li:hover span,';
                $css .= $addon_id . ' .sppb-carousel-extended-dots ul li.active span{';
                    $css .= $bullet_active_style;
                $css .= '}';
            }
        }

        //Avatar style
        $content_alignment = (isset($settings->content_alignment) && $settings->content_alignment) ? $settings->content_alignment : '';
        $avatar_layout = (isset($settings->avatar_layout) && $settings->avatar_layout) ? $settings->avatar_layout : '';

        $avatar_border_radius = (isset($settings->avatar_border_radius) && $settings->avatar_border_radius) ? 'border-radius:'.$settings->avatar_border_radius.'px;' : '';
        $avatar_style = '';
        $avatar_style .= (isset($settings->avatar_height) && $settings->avatar_height) ? 'height:'.$settings->avatar_height.'px;' : '';
        $avatar_style .= (isset($settings->avatar_width) && $settings->avatar_width) ? 'width:'.$settings->avatar_width.'px;' : '';

        if($testimonial_carousel_layout !== 'testi_layout3') {
            if($avatar_layout == 'avatar_layout1'){
                $avatar_style .= (isset($settings->avatar_gap) && $settings->avatar_gap) ? 'margin-right:'.$settings->avatar_gap.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout2'){
                $avatar_style .= (isset($settings->avatar_gap) && $settings->avatar_gap) ? 'margin-left:'.$settings->avatar_gap.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout3'){
                $avatar_style .= (isset($settings->avatar_gap) && $settings->avatar_gap) ? 'margin-bottom:'.$settings->avatar_gap.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout4'){
                $avatar_style .= (isset($settings->avatar_gap) && $settings->avatar_gap) ? 'margin-top:'.$settings->avatar_gap.'px;' : '';
            }
        }

        if($avatar_style){
            $css .= $addon_id . ' .sppb-testimonial-carousel-img-wrap {';
                if($content_alignment == "sppb-text-left") {
                    $css .= 'margin-right: auto;';
                } elseif($content_alignment == "sppb-text-right") {
                    $css .= 'margin-left: auto;';
                } else {
                    $css .= 'margin-left: auto;';
                    $css .= 'margin-right: auto;';
                }
                $css .= $avatar_style;
            $css .= '}';
        }
        if($avatar_border_radius){
            $css .= $addon_id . ' .sppb-testimonial-carousel-img-wrap img {';
                $css .= $avatar_border_radius;
            $css .= '}';
        }

        if($testimonial_carousel_layout == 'testi_layout3'){
            $css .= $addon_id . ' .sppb-testimonial-carousel-content-wrap {';
                $css .= 'align-items: initial;';
                $css .= 'flex-direction: column;';
            $css .= '}';
        } else {
            if($avatar_layout == 'avatar_layout2'){
                $css .= $addon_id . ' .sppb-testimonial-carousel-content-wrap {';
                    $css .= 'flex-direction: row-reverse;';
                $css .= '}';
                $css .= $addon_id . ' .sppb-testimonial-carousel-name-designation {';
                    $css .= 'text-align: right;';
                $css .= '}';
            } elseif ($avatar_layout == 'avatar_layout3') {
                $css .= $addon_id . ' .sppb-testimonial-carousel-content-wrap {';
                    $css .= 'align-items: initial;';
                    $css .= 'flex-direction: column;';
                $css .= '}';
            } elseif ($avatar_layout == 'avatar_layout4') {
                $css .= $addon_id . ' .sppb-testimonial-carousel-content-wrap {';
                    $css .= 'align-items: initial;';
                    $css .= 'flex-direction: column-reverse;';
                $css .= '}';
            }
            if($avatar_layout == 'avatar_layout1'){
                $css .= $addon_id . ' .sppb-testimonial-carousel-name-designation {';
                    $css .= 'text-align: left;';
                $css .= '}';
            }
        }

        //Quote icon style
        $quote_style = '';
        $quote_style .= (isset($settings->quote_icon_size) && $settings->quote_icon_size) ? 'font-size:'.$settings->quote_icon_size.'px;' : '';
        $quote_style .= (isset($settings->quote_icon_color) && $settings->quote_icon_color) ? 'color:'.$settings->quote_icon_color.';' : '';
        if($testimonial_carousel_layout == 'testi_layout1'){
            $quote_style .= (isset($settings->quote_icon_gap) && $settings->quote_icon_gap) ? 'margin-bottom:'.$settings->quote_icon_gap.'px;' : '';
        } elseif ($testimonial_carousel_layout == 'testi_layout2') {
            $quote_style .= (isset($settings->quote_icon_gap) && $settings->quote_icon_gap) ? 'margin-top:'.$settings->quote_icon_gap.'px;' : '';
        }
        if($quote_style){
            $css .= $addon_id . ' .sppb-testimonial-carousel-icon {';
                $css .= $quote_style;
            $css .='}';
        }

        //Rating style
        $rating_style = '';
        $rating_style .= (isset($settings->rating_size) && $settings->rating_size) ? 'font-size:'.$settings->rating_size.'px;' : '';
        $rating_style .= (isset($settings->rating_color) && $settings->rating_color) ? 'color:'.$settings->rating_color.';' : '';
        if($testimonial_carousel_layout == 'testi_layout1' || $testimonial_carousel_layout == 'testi_layout3'){
            $rating_style .= (isset($settings->rating_gap) && $settings->rating_gap) ? 'margin-bottom:'.$settings->rating_gap.'px;' : '';
        } elseif ($testimonial_carousel_layout == 'testi_layout2') {
            $rating_style .= (isset($settings->rating_gap) && $settings->rating_gap) ? 'margin-top:'.$settings->rating_gap.'px;' : '';
        }
        if($rating_style){
            $css .= $addon_id . ' .sppb-testimonial-carousel-rating{';
                $css .= $rating_style;
            $css .='}';
        }

        if(isset($settings->sp_testimonial_carousel_item) && is_array($settings->sp_testimonial_carousel_item)){
			foreach($settings->sp_testimonial_carousel_item as $item_key => $carousel_item){
                $uniqId = '#sppb-testi-'.$this->addon->id.'-carousel-item-key-'.$item_key;
                $css .= $uniqId.'.sppb-carousel-extended-item .sppb-testimonial-carousel-rating:before {';
                    $css .= 'width:'.((20 * $carousel_item->client_rating)-2).'%';
                $css .='}';
            }
        }

        //Name style
        $name_style = '';
        $name_style .= (isset($settings->name_fontsize) && $settings->name_fontsize) ? 'font-size:'.$settings->name_fontsize.'px;' : '';
        $name_style .= (isset($settings->name_lineheight) && $settings->name_lineheight) ? 'line-height:'.$settings->name_lineheight.'px;' : '';
        $name_style .= (isset($settings->name_letterspace) && $settings->name_letterspace) ? 'letter-spacing:'.$settings->name_letterspace.';' : '';
        $name_style .= (isset($settings->name_text_color) && $settings->name_text_color) ? 'color:'.$settings->name_text_color.';' : '';
        $name_style .= (isset($settings->name_margin) && trim($settings->name_margin)) ? 'margin:'.$settings->name_margin.';' : '';
        
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
		if(isset($name_font_style->weight) && $name_font_style->weight){
			$name_style .= 'font-weight:'.$name_font_style->weight.';';
        }
        
        if($name_style){
            $css .= $addon_id . ' .sppb-testimonial-carousel-name {';
                $css .= $name_style;
            $css .='}';
        }

        //Designation style
        $designation_style = '';
        $designation_style .= (isset($settings->designation_fontsize) && $settings->designation_fontsize) ? 'font-size:'.$settings->designation_fontsize.'px;' : '';
        $designation_style .= (isset($settings->designation_lineheight) && $settings->designation_lineheight) ? 'line-height:'.$settings->designation_lineheight.'px;' : '';
        $designation_style .= (isset($settings->designation_letterspace) && $settings->designation_letterspace) ? 'letter-spacing:'.$settings->designation_letterspace.';' : '';
        $designation_style .= (isset($settings->designation_text_color) && $settings->designation_text_color) ? 'color:'.$settings->designation_text_color.';' : '';
        
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
        
        if($designation_style){
            $css .= $addon_id . ' .sppb-testimonial-carousel-designation {';
                $css .= $designation_style;
            $css .='}';
        }

        //Message style
        $message_style = '';
        $message_style .= (isset($settings->message_fontsize) && $settings->message_fontsize) ? 'font-size:'.$settings->message_fontsize.'px;' : '';
        $message_style .= (isset($settings->message_lineheight) && $settings->message_lineheight) ? 'line-height:'.$settings->message_lineheight.'px;' : '';
        $message_style .= (isset($settings->message_letterspace) && $settings->message_letterspace) ? 'letter-spacing:'.$settings->message_letterspace.';' : '';
        $message_style .= (isset($settings->message_text_color) && $settings->message_text_color) ? 'color:'.$settings->message_text_color.';' : '';
        $message_style .= (isset($settings->message_margin_top) && trim($settings->message_margin_top)) ? 'margin-top:'.$settings->message_margin_top.'px;' : '';

        if($testimonial_carousel_layout != 'testi_layout3'){
            $message_style .= (isset($settings->message_margin_bottom) && trim($settings->message_margin_bottom)) ? 'margin-bottom:'.$settings->message_margin_bottom.'px;' : '';
        } else {
            $message_margin_bottom = (isset($settings->message_margin_bottom) && trim($settings->message_margin_bottom)) ? 'margin-bottom:'.$settings->message_margin_bottom.'px;' : '';
            $css .= $addon_id . ' .sppb-testimonial-carousel-item-content {';
                $css .= $message_margin_bottom;
                if(isset($settings->message_background) && $settings->message_background){
                    $css .= 'background:'.$settings->message_background.';';
                }
                if(isset($settings->message_border_radius) && $settings->message_border_radius){
                    $css .= 'border-radius:'.$settings->message_border_radius.'px;';
                }
                if(isset($settings->message_padding) && trim($settings->message_padding)) {
                    $css .= 'padding:'.$settings->message_padding.';';
                };
            $css .='}';
        }
        
        $message_font_style = (isset($settings->message_font_style) && $settings->message_font_style) ? $settings->message_font_style : '';
		if(isset($message_font_style->underline) && $message_font_style->underline){
			$message_style .= 'text-decoration:underline;';
		}
		if(isset($message_font_style->italic) && $message_font_style->italic){
			$message_style .= 'font-style:italic;';
		}
		if(isset($message_font_style->uppercase) && $message_font_style->uppercase){
			$message_style .= 'text-transform:uppercase;';
		}
		if(isset($message_font_style->weight) && $message_font_style->weight){
			$message_style .= 'font-weight:'.$message_font_style->weight.';';
        }
        
        if($message_style){
            $css .= $addon_id . ' .sppb-testimonial-carousel-message {';
                $css .= $message_style;
            $css .='}';
        }

        $arrow_height = (isset($settings->arrow_height) && $settings->arrow_height) ? $settings->arrow_height : '';
        if($arrow_height){
            $css .= $addon_id . ' .sppb-carousel-extended-nav-control {';
                $css .= 'top: -'.$arrow_height.'px;';
            $css .='}';
        }

        //Item style
        $item_style = '';
        $item_style .= (isset($settings->content_background) && $settings->content_background) ? 'background:'.$settings->content_background.';' : '';
        $item_style .= (isset($settings->content_padding) && trim($settings->content_padding)) ? 'padding:'.$settings->content_padding.';' : '';
        $item_style .= (isset($settings->content_border_radius) && $settings->content_border_radius) ? 'border-radius:'.$settings->content_border_radius.'px;' : '';
        if($item_style){
            $css .= $addon_id . ' .sppb-carousel-extended-item {';
                $css .= $item_style;
            $css .='}';
        }

        //Responsive tablet
        $name_style_sm = '';
        $name_style_sm .= (isset($settings->name_fontsize_sm) && $settings->name_fontsize_sm) ? 'font-size:'.$settings->name_fontsize_sm.'px;' : '';
        $name_style_sm .= (isset($settings->name_margin_sm) && trim($settings->name_margin_sm)) ? 'margin:'.$settings->name_margin_sm.';' : '';

        $designation_style_sm = '';
        $designation_style_sm .= (isset($settings->designation_fontsize_sm) && $settings->designation_fontsize_sm) ? 'font-size:'.$settings->designation_fontsize_sm.'px;' : '';

        $message_style_sm = '';
        $message_style_sm .= (isset($settings->message_fontsize_sm) && $settings->message_fontsize_sm) ? 'font-size:'.$settings->message_fontsize_sm.'px;' : '';
        $message_style_sm .= (isset($settings->message_lineheight_sm) && $settings->message_lineheight_sm) ? 'line-height:'.$settings->message_lineheight_sm.'px;' : '';
        $message_style_sm .= (isset($settings->message_margin_top_sm) && trim($settings->message_margin_top_sm)) ? 'margin-top:'.$settings->message_margin_top_sm.'px;' : '';

        if($testimonial_carousel_layout != 'testi_layout3'){
            $message_style_sm .= (isset($settings->message_margin_bottom_sm) && trim($settings->message_margin_bottom_sm)) ? 'margin-bottom:'.$settings->message_margin_bottom_sm.'px;' : '';
        }

        //Avatar tab style
        $avatar_style_sm = '';
        $avatar_style_sm .= (isset($settings->avatar_height_sm) && $settings->avatar_height_sm) ? 'height:'.$settings->avatar_height_sm.'px;' : '';
        $avatar_style_sm .= (isset($settings->avatar_width_sm) && $settings->avatar_width_sm) ? 'width:'.$settings->avatar_width_sm.'px;' : '';

        if($testimonial_carousel_layout !== 'testi_layout3') {
            if($avatar_layout == 'avatar_layout1'){
                $avatar_style_sm .= (isset($settings->avatar_gap_sm) && $settings->avatar_gap_sm) ? 'margin-right:'.$settings->avatar_gap_sm.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout2'){
                $avatar_style_sm .= (isset($settings->avatar_gap_sm) && $settings->avatar_gap_sm) ? 'margin-left:'.$settings->avatar_gap_sm.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout3'){
                $avatar_style_sm .= (isset($settings->avatar_gap_sm) && $settings->avatar_gap_sm) ? 'margin-bottom:'.$settings->avatar_gap_sm.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout4'){
                $avatar_style_sm .= (isset($settings->avatar_gap_sm) && $settings->avatar_gap_sm) ? 'margin-top:'.$settings->avatar_gap_sm.'px;' : '';
            }
        }

        //Quote tab icon style
        $quote_style_sm = '';
        $quote_style_sm .= (isset($settings->quote_icon_size_sm) && $settings->quote_icon_size_sm) ? 'font-size:'.$settings->quote_icon_size_sm.'px;' : '';
        if($testimonial_carousel_layout == 'testi_layout1'){
            $quote_style_sm .= (isset($settings->quote_icon_gap_sm) && $settings->quote_icon_gap_sm) ? 'margin-bottom:'.$settings->quote_icon_gap_sm.'px;' : '';
        } elseif ($testimonial_carousel_layout == 'testi_layout2') {
            $quote_style_sm .= (isset($settings->quote_icon_gap_sm) && $settings->quote_icon_gap_sm) ? 'margin-top:'.$settings->quote_icon_gap_sm.'px;' : '';
        }

        //Rating tab style
        $rating_style_sm = '';
        $rating_style_sm .= (isset($settings->rating_size_sm) && $settings->rating_size_sm) ? 'font-size:'.$settings->rating_size_sm.'px;' : '';
        if($testimonial_carousel_layout == 'testi_layout1' || $testimonial_carousel_layout == 'testi_layout3'){
            $rating_style_sm .= (isset($settings->rating_gap_sm) && $settings->rating_gap_sm) ? 'margin-bottom:'.$settings->rating_gap_sm.'px;' : '';
        } elseif ($testimonial_carousel_layout == 'testi_layout2') {
            $rating_style_sm .= (isset($settings->rating_gap_sm) && $settings->rating_gap_sm) ? 'margin-top:'.$settings->rating_gap_sm.'px;' : '';
        }

        //Item style
        $item_style_sm = '';
        $item_style_sm .= (isset($settings->content_padding_sm) && trim($settings->content_padding_sm)) ? 'padding:'.$settings->content_padding_sm.';' : '';

        $css .= '@media (min-width: 768px) and (max-width: 991px) {';

            $css .= $addon_id . ' .sppb-carousel-extended-dots {';
                if(isset($settings->bullet_position_verti) && $settings->bullet_position_verti_sm){
                    $css .= 'bottom: '.$settings->bullet_position_verti_sm.'%;';
                }
                if(isset($settings->bullet_position_hori) && $settings->bullet_position_hori_sm){
                    $css .= 'left: '.$settings->bullet_position_hori_sm.'px;';
                }
            $css .= '}';
            $css .= $addon_id . ' .sppb-carousel-extended-nav-control .nav-control {';
                $css .= $arrow_style;
                if(isset($settings->arrow_position_verti) && $settings->arrow_position_verti_sm){
                    $css .= 'margin-top: '.$settings->arrow_position_verti_sm.'%;';
                }
                if(isset($settings->arrow_position_hori) && $settings->arrow_position_hori_sm){
                    $css .= 'margin-left: '.$settings->arrow_position_hori_sm.'px;';
                }
                if(isset($settings->arrow_position_hori) && $settings->arrow_position_hori_sm){
                    $css .= 'margin-right: '.$settings->arrow_position_hori_sm.'px;';
                }
            $css .= '}';

            if($name_style_sm){
                $css .= $addon_id . ' .sppb-testimonial-carousel-name {';
                    $css .= $name_style_sm;
                $css .='}';
            }
            if($designation_style_sm){
                $css .= $addon_id . ' .sppb-testimonial-carousel-designation {';
                    $css .= $designation_style_sm;
                $css .='}';
            }

            if($message_style_sm){
                $css .= $addon_id . ' .sppb-testimonial-carousel-message {';
                    $css .= $message_style_sm;
                $css .='}';
            }
            if($avatar_style_sm){
                $css .= $addon_id . ' .sppb-testimonial-carousel-img-wrap {';
                    $css .= $avatar_style_sm;
                $css .= '}';
            }
            if($quote_style_sm){
                $css .= $addon_id . ' .sppb-testimonial-carousel-icon {';
                    $css .= $quote_style_sm;
                $css .='}';
            }
            if($rating_style_sm){
                $css .= $addon_id . ' .sppb-testimonial-carousel-rating{';
                    $css .= $rating_style_sm;
                $css .='}';
            }
            if($testimonial_carousel_layout == 'testi_layout3'){
                $message_margin_bottom_sm = (isset($settings->message_margin_bottom_sm) && trim($settings->message_margin_bottom_sm)) ? 'margin-bottom:'.$settings->message_margin_bottom_sm.'px;' : '';
                $css .= $addon_id . ' .sppb-testimonial-carousel-item-content {';
                    $css .= $message_margin_bottom_sm;
                    if(isset($settings->message_padding_sm) && trim($settings->message_padding_sm)) {
                        $css .= 'padding:'.$settings->message_padding_sm.';';
                    };
                $css .='}';
            }
            if($item_style_sm){
                $css .= $addon_id . ' .sppb-carousel-extended-item {';
                    $css .= $item_style_sm;
                $css .='}';
            }

        $css .= '}';

        //Responsive mobile
        $name_style_xs = '';
        $name_style_xs .= (isset($settings->name_fontsize_xs) && $settings->name_fontsize_xs) ? 'font-size:'.$settings->name_fontsize_xs.'px;' : '';
        $name_style_xs .= (isset($settings->name_margin_xs) && trim($settings->name_margin_xs)) ? 'margin:'.$settings->name_margin_xs.';' : '';

        $designation_style_xs = '';
        $designation_style_xs .= (isset($settings->designation_fontsize_xs) && $settings->designation_fontsize_xs) ? 'font-size:'.$settings->designation_fontsize_xs.'px;' : '';

        $message_style_xs = '';
        $message_style_xs .= (isset($settings->message_fontsize_xs) && $settings->message_fontsize_xs) ? 'font-size:'.$settings->message_fontsize_xs.'px;' : '';
        $message_style_xs .= (isset($settings->message_lineheight_xs) && $settings->message_lineheight_xs) ? 'line-height:'.$settings->message_lineheight_xs.'px;' : '';
        $message_style_xs .= (isset($settings->message_margin_top_xs) && trim($settings->message_margin_top_xs)) ? 'margin-top:'.$settings->message_margin_top_xs.'px;' : '';
        if($testimonial_carousel_layout != 'testi_layout3'){
            $message_style_xs .= (isset($settings->message_margin_bottom_xs) && trim($settings->message_margin_bottom_xs)) ? 'margin-bottom:'.$settings->message_margin_bottom_xs.'px;' : '';
        }
        //Avatar tab style
        $avatar_style_xs = '';
        $avatar_style_xs .= (isset($settings->avatar_height_xs) && $settings->avatar_height_xs) ? 'height:'.$settings->avatar_height_xs.'px;' : '';
        $avatar_style_xs .= (isset($settings->avatar_width_xs) && $settings->avatar_width_xs) ? 'width:'.$settings->avatar_width_xs.'px;' : '';

        if($testimonial_carousel_layout !== 'testi_layout3') {
            if($avatar_layout == 'avatar_layout1'){
                $avatar_style_xs .= (isset($settings->avatar_gap_xs) && $settings->avatar_gap_xs) ? 'margin-right:'.$settings->avatar_gap_xs.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout2'){
                $avatar_style_xs .= (isset($settings->avatar_gap_xs) && $settings->avatar_gap_xs) ? 'margin-left:'.$settings->avatar_gap_xs.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout3'){
                $avatar_style_xs .= (isset($settings->avatar_gap_xs) && $settings->avatar_gap_xs) ? 'margin-bottom:'.$settings->avatar_gap_xs.'px;' : '';
            } elseif($avatar_layout == 'avatar_layout4'){
                $avatar_style_xs .= (isset($settings->avatar_gap_xs) && $settings->avatar_gap_xs) ? 'margin-top:'.$settings->avatar_gap_xs.'px;' : '';
            }
        }

        //Quote tab icon style
        $quote_style_xs = '';
        $quote_style_xs .= (isset($settings->quote_icon_size_xs) && $settings->quote_icon_size_xs) ? 'font-size:'.$settings->quote_icon_size_xs.'px;' : '';
        if($testimonial_carousel_layout == 'testi_layout1'){
            $quote_style_xs .= (isset($settings->quote_icon_gap_xs) && $settings->quote_icon_gap_xs) ? 'margin-bottom:'.$settings->quote_icon_gap_xs.'px;' : '';
        } elseif ($testimonial_carousel_layout == 'testi_layout2') {
            $quote_style_xs .= (isset($settings->quote_icon_gap_xs) && $settings->quote_icon_gap_xs) ? 'margin-top:'.$settings->quote_icon_gap_xs.'px;' : '';
        }

        //Rating tab style
        $rating_style_xs = '';
        $rating_style_xs .= (isset($settings->rating_size_xs) && $settings->rating_size_xs) ? 'font-size:'.$settings->rating_size_xs.'px;' : '';
        if($testimonial_carousel_layout == 'testi_layout1' || $testimonial_carousel_layout == 'testi_layout3'){
            $rating_style_xs .= (isset($settings->rating_gap_xs) && $settings->rating_gap_xs) ? 'margin-bottom:'.$settings->rating_gap_xs.'px;' : '';
        } elseif ($testimonial_carousel_layout == 'testi_layout2') {
            $rating_style_xs .= (isset($settings->rating_gap_xs) && $settings->rating_gap_xs) ? 'margin-top:'.$settings->rating_gap_xs.'px;' : '';
        }
        //Item style
        $item_style_xs = '';
        $item_style_xs .= (isset($settings->content_padding_xs) && trim($settings->content_padding_xs)) ? 'padding:'.$settings->content_padding_xs.';' : '';

        $css .= '@media (max-width: 767px) {';

            $css .= $addon_id . ' .sppb-carousel-extended-dots {';
                if(isset($settings->bullet_position_verti) && $settings->bullet_position_verti_xs){
                    $css .= 'bottom: '.$settings->bullet_position_verti_xs.'%;';
                }
                if(isset($settings->bullet_position_hori) && $settings->bullet_position_hori_xs){
                    $css .= 'left: '.$settings->bullet_position_hori_xs.'px;';
                }
            $css .= '}';
            $css .= $addon_id . ' .sppb-carousel-extended-nav-control .nav-control {';
                $css .= $arrow_style;
                if(isset($settings->arrow_position_verti) && $settings->arrow_position_verti_xs){
                    $css .= 'margin-top: '.$settings->arrow_position_verti_xs.'%;';
                }
                if(isset($settings->arrow_position_hori) && $settings->arrow_position_hori_xs){
                    $css .= 'margin-left: '.$settings->arrow_position_hori_xs.'px;';
                }
                if(isset($settings->arrow_position_hori) && $settings->arrow_position_hori_xs){
                    $css .= 'margin-right: '.$settings->arrow_position_hori_xs.'px;';
                }
            $css .= '}';

            if($name_style_xs){
                $css .= $addon_id . ' .sppb-testimonial-carousel-name {';
                    $css .= $name_style_xs;
                $css .='}';
            }
            if($designation_style_xs){
                $css .= $addon_id . ' .sppb-testimonial-carousel-designation {';
                    $css .= $designation_style_xs;
                $css .='}';
            }

            if($message_style_xs){
                $css .= $addon_id . ' .sppb-testimonial-carousel-message {';
                    $css .= $message_style_xs;
                $css .='}';
            }

            if($avatar_style_xs){
                $css .= $addon_id . ' .sppb-testimonial-carousel-img-wrap {';
                    $css .= $avatar_style_xs;
                $css .= '}';
            }
            if($quote_style_xs){
                $css .= $addon_id . ' .sppb-testimonial-carousel-icon {';
                    $css .= $quote_style_xs;
                $css .='}';
            }
            if($rating_style_xs){
                $css .= $addon_id . ' .sppb-testimonial-carousel-rating{';
                    $css .= $rating_style_xs;
                $css .='}';
            }
            if($testimonial_carousel_layout == 'testi_layout3'){
                $message_margin_bottom_xs = (isset($settings->message_margin_bottom_xs) && trim($settings->message_margin_bottom_xs)) ? 'margin-bottom:'.$settings->message_margin_bottom_xs.'px;' : '';
                $css .= $addon_id . ' .sppb-testimonial-carousel-item-content {';
                    $css .= $message_margin_bottom_xs;
                    if(isset($settings->message_padding_xs) && trim($settings->message_padding_xs)) {
                        $css .= 'padding:'.$settings->message_padding_xs.';';
                    };
                $css .='}';
            }
            if($item_style_xs){
                $css .= $addon_id . ' .sppb-carousel-extended-item {';
                    $css .= $item_style_xs;
                $css .='}';
            }

        $css .= '}';

		return $css;
	}

	public static function getTemplate() {
        $output = '
        <style  type="text/css">
            <# if(data.carousel_arrow){ #>
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-nav-control .nav-control {
                    <# if(data.arrow_height){ #>
                        height: {{data.arrow_height}}px;
                        line-height: {{(data.arrow_height)-(data.arrow_border_width)}}px;
                    <# } #>
                    background: {{data.arrow_background}};
                    <# if(data.arrow_border_width){ #>
                        border-width: {{data.arrow_border_width}}px;
                        border-style: solid;
                    <# } #>
                    border-color: {{data.arrow_border_color}};
                    border-radius: {{data.arrow_border_radius}}px;
                    color: {{data.arrow_color}};
                    font-size: {{data.arrow_font_size}}px;
                    <# if(_.isObject(data.arrow_position_verti)) { #>
                        margin-top: {{data.arrow_position_verti.md}}%;
                    <# } else { #>
                        margin-top: {{data.arrow_position_verti}}%;
                    <# }
                    if(_.isObject(data.arrow_position_hori)) {
                    #>
                        margin-left: {{data.arrow_position_hori.md}}px;
                    <# } else { #>
                        margin-left: {{data.arrow_position_hori}}px;
                    <# }
                    if(_.isObject(data.arrow_position_hori)) {
                    #>
                        margin-right: {{data.arrow_position_hori.md}}px;
                    <# } else { #>
                        margin-right: {{data.arrow_position_hori}}px;
                    <# } #>
                    width: {{data.arrow_width}}px;
                }

                #sppb-addon-{{ data.id }} .sppb-carousel-extended-nav-control .nav-control:hover {
                    background-color: {{data.arrow_hover_background}};
                    color: {{data.arrow_hover_color}};
                    border-color: {{data.arrow_hover_border_color}};
                }

                <# if(data.arrow_height){ #>
                    #sppb-addon-{{ data.id }} .sppb-carousel-extended-nav-control {
                        top: -{{data.arrow_height}}px;
                    }
                <# }
            } #>
            <# if(data.carousel_bullet){ #>
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-dots {
                    <# if(_.isObject(data.bullet_position_verti)) { #>
                        bottom: {{data.bullet_position_verti.md}}%;
                    <# } else { #>
                        bottom: {{data.bullet_position_verti}}%;
                    <# }
                    if(_.isObject(data.bullet_position_hori)) {
                    #>
                        left: {{data.bullet_position_hori.md}}px;
                    <# } else { #>
                        left: {{data.bullet_position_hori}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-dots ul li {
                    <# if(data.bullet_height){ #>
                        height: {{data.bullet_height}}px;
                        line-height: {{(data.bullet_height)-(data.bullet_border_width)}}px;
                    <# } #>
                    background: {{data.bullet_background}};
                    <# if(data.bullet_border_width){ #>
                        border-width: {{data.bullet_border_width}}px;
                        border-style: solid;
                    <# } #>
                    border-color: {{data.bullet_border_color}};
                    border-radius: {{data.bullet_border_radius}}px;
                    width: {{data.bullet_width}}px;
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-dots ul li:hover span,
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-dots ul li.active span {
                    background: {{data.bullet_active_background}};
                }
            <# }
            if(data.testimonial_carousel_layout == "testi_layout3") {
            #>
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-content-wrap { 
                    align-items: initial;
                    flex-direction: column;
                }
            <# } else {
                if(data.avatar_layout == "avatar_layout2"){
            #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-content-wrap { 
                        flex-direction: row-reverse;
                    }
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-name-designation {
                        text-align: right;
                    }
                <# } else if (data.avatar_layout == "avatar_layout3") { #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-content-wrap { 
                        align-items: initial;
                        flex-direction: column;
                    }
                <# } else if (data.avatar_layout == "avatar_layout4") { #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-content-wrap { 
                        align-items: initial;
                        flex-direction: column-reverse;
                    }
                <# }
                if(data.avatar_layout == "avatar_layout1"){
                #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-name-designation {
                        text-align: left;
                    }
                <# }
            } #>

            #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-img-wrap {
                <# if(_.isObject(data.avatar_height)) { #>
                    height:{{data.avatar_height.md}}px;
                <# } else { #>
                    height:{{data.avatar_height}}px;
                <# }
                if(_.isObject(data.avatar_width)) {
                #>
                    width:{{data.avatar_width.md}}px;
                <# } else { #>
                    width:{{data.avatar_width}}px;
                <# }
                if(data.content_alignment == "sppb-text-left") {
                #>
                    margin-right: auto;
                <# } else if(data.content_alignment == "sppb-text-right") {
                #>
                    margin-left: auto;
                <# } else { #>
                    margin-left: auto;
                    margin-right: auto;
                <# } #>

                <# if(data.testimonial_carousel_layout !== "testi_layout3"){
                    if(data.avatar_layout == "avatar_layout1"){
                #>
                        <# if(_.isObject(data.avatar_gap)){ #>
                            margin-right:{{data.avatar_gap.md}}px;
                        <# } else { #>
                            margin-right:{{data.avatar_gap}}px;
                        <# }
                        } else if(data.avatar_layout == "avatar_layout2"){
                        if(_.isObject(data.avatar_gap)){
                        #>
                            margin-left:{{data.avatar_gap.md}}px;
                        <# } else { #>
                            margin-left:{{data.avatar_gap}}px;
                        <# }
                        } else if(data.avatar_layout == "avatar_layout3"){
                        if(_.isObject(data.avatar_gap)){
                        #>
                            margin-bottom:{{data.avatar_gap.md}}px;
                        <# } else { #>
                            margin-bottom:{{data.avatar_gap}}px;
                        <# }
                        } else if(data.avatar_layout == "avatar_layout4"){
                        if(_.isObject(data.avatar_gap)){
                        #>
                            margin-top:{{data.avatar_gap.md}}px;
                        <# } else { #>
                            margin-top:{{data.avatar_gap}}px;
                        <# }
                    }
                } #>
            }
            <# if(data.avatar_border_radius){ #>
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-img-wrap img{
                    border-radius: {{data.avatar_border_radius}}px;
                }
            <# } #>

            #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-icon {
                <# if(_.isObject(data.quote_icon_size)){ #>
                    font-size: {{data.quote_icon_size.md}}px;
                <# } else { #>
                    font-size: {{data.quote_icon_size}}px;
                <# } #>
                color:{{data.quote_icon_color}};
                <# if(data.testimonial_carousel_layout == "testi_layout1"){
                if(_.isObject(data.quote_icon_gap)){    
                #>
                    margin-bottom:{{data.quote_icon_gap.md}}px;
                <# } else { #>
                    margin-bottom:{{data.quote_icon_gap}}px;
                <# }
                } else if (data.testimonial_carousel_layout == "testi_layout2") {
                    if(_.isObject(data.quote_icon_gap)){
                #>
                    margin-top:{{data.quote_icon_gap.md}}px;
                <# } else { #>
                    margin-top:{{data.quote_icon_gap}}px;
                <# }
                } #>
            }

            #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-rating {
                <# if(_.isObject(data.rating_size)){ #>
                    font-size: {{data.rating_size.md}}px;
                <# } else { #>
                    font-size: {{data.rating_size}}px;
                <# } #>
                color:{{data.rating_color}};
                <# if(data.testimonial_carousel_layout == "testi_layout1" || data.testimonial_carousel_layout == "testi_layout3"){
                if(_.isObject(data.rating_gap)){    
                #>
                    margin-bottom:{{data.rating_gap.md}}px;
                <# } else { #>
                    margin-bottom:{{data.rating_gap}}px;
                <# }
                } else if (data.testimonial_carousel_layout == "testi_layout2") {
                    if(_.isObject(data.rating_gap)){
                #>
                    margin-top:{{data.rating_gap.md}}px;
                <# } else { #>
                    margin-top:{{data.rating_gap}}px;
                <# }
                } #>
            }
            <# if(_.isArray(data.sp_testimonial_carousel_item)){
                _.each(data.sp_testimonial_carousel_item, function(carousel_item, caro_index){
                    const uniqId = `#sppb-testi-${data.id}-carousel-item-key-${caro_index}`;
            #>
                    {{uniqId}}.sppb-carousel-extended-item .sppb-testimonial-carousel-rating:before {
                        width:{{(20 * carousel_item.client_rating)-2}}%;
                    }
                <# })
            } #>

            #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-name {
                <# if(_.isObject(data.name_fontsize)){ #>
                    font-size:{{data.name_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.name_fontsize}}px;
                <# } #>
                letter-spacing:{{data.name_letterspace}};
                color:{{data.name_text_color}};
                line-height:{{data.name_lineheight}}px;
                <# if(_.isObject(data.name_margin)) { #>
                    margin:{{data.name_margin.md}};
                <# } else { #>
                    margin:{{data.name_margin}};
                <# }
                if(_.isObject(data.name_font_style)) {
                    if(data.name_font_style.underline) {
                #>
                        text-decoration:underline;
                    <# }
                    if(data.name_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.name_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.name_font_style.weight) {
                    #>
                        font-weight:{{data.name_font_style.weight}};
                    <# }
                } #>
            }
            
            #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-designation {
                <# if(_.isObject(data.designation_fontsize)){ #>
                    font-size:{{data.designation_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.designation_fontsize}}px;
                <# } #>
                letter-spacing:{{data.designation_letterspace}};
                color:{{data.designation_text_color}};
                line-height:{{data.designation_lineheight}}px;
                <# if(_.isObject(data.designation_font_style)) {
                    if(data.designation_font_style.underline) {
                    #>
                        text-decoration:underline;
                    <# }
                    if(data.designation_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.designation_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.designation_font_style.weight) {
                    #>
                        font-weight:{{data.designation_font_style.weight}};
                    <# }
                } #>
            }

            #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-message {
                <# if(_.isObject(data.message_fontsize)){ #>
                    font-size:{{data.message_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.message_fontsize}}px;
                <# } 
                if(_.isObject(data.message_lineheight)){
                #>
                    line-height:{{data.message_lineheight.md}}px;
                <# } else { #>
                    line-height:{{data.message_lineheight}}px;
                <# } #> 
                letter-spacing:{{data.message_letterspace}};
                color:{{data.message_text_color}};
                <# if(_.isObject(data.message_margin_top)) { #>
                    margin-top:{{data.message_margin_top.md}}px;
                <# } else { #>
                    margin-top:{{data.message_margin_top}}px;
                <# }
                if(data.testimonial_carousel_layout != "testi_layout3"){
                    if(_.isObject(data.message_margin_bottom)) {
                #>
                        margin-bottom:{{data.message_margin_bottom.md}}px;
                    <# } else { #>
                        margin-bottom:{{data.message_margin_bottom}}px;
                    <# }
                } #>

                <# if(_.isObject(data.message_font_style)) {
                    if(data.message_font_style.underline) {
                    #>
                        text-decoration:underline;
                    <# }
                    if(data.message_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.message_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.message_font_style.weight) {
                    #>
                        font-weight:{{data.message_font_style.weight}};
                    <# }
                } #>
            }
            <# if(data.testimonial_carousel_layout == "testi_layout3"){ #>
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-item-content {
                    <# if(_.isObject(data.message_margin_bottom)) { #>
                        margin-bottom:{{data.message_margin_bottom.md}}px;
                    <# } else { #>
                        margin-bottom:{{data.message_margin_bottom}}px;
                    <# } #>
                    background: {{data.message_background}};
                    border-radius: {{data.message_border_radius}}px;
                    <# if(_.isObject(data.message_padding)) { #>
                        padding:{{data.message_padding.md}};
                    <# } else { #>
                        padding:{{data.message_padding}};
                    <# } #>
                }
            <# } #>
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-item {
                background:{{data.content_background}};
                <# if(_.isObject(data.content_padding)){ #>
                    padding:{{data.content_padding.md}};
                <# } else { #>
                    padding:{{data.content_padding}};
                <# } #>
                border-radius:{{data.content_border_radius}}px;
            }
            
            @media (min-width: 768px) and (max-width: 991px) {
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-nav-control .nav-control {
                    <# if(_.isObject(data.arrow_position_verti)) { #>
                        margin-top: {{data.arrow_position_verti.sm}}%;
                    <# }
                    if(_.isObject(data.arrow_position_hori)) {
                    #>
                        margin-left: {{data.arrow_position_hori.sm}}px;
                    <# }
                    if(_.isObject(data.arrow_position_hori)) {
                    #>
                        margin-right: {{data.arrow_position_hori.sm}}px;
                    <# } #>
                }
                <# if(data.carousel_bullet){ #>
                    #sppb-addon-{{ data.id }} .sppb-carousel-extended-dots {
                        <# if(_.isObject(data.bullet_position_verti)) { #>
                            bottom: {{data.bullet_position_verti.sm}}%;
                        <# }
                        if(_.isObject(data.bullet_position_hori)) {
                        #>
                            left: {{data.bullet_position_hori.sm}}px;
                        <# } #>
                    }
                <# } #>
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-name {
                    <# if(_.isObject(data.name_fontsize)){ #>
                        font-size:{{data.name_fontsize.sm}}px;
                    <# }
                    if(_.isObject(data.name_margin)) {
                        #>
                        margin:{{data.name_margin.sm}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-designation {
                    <# if(_.isObject(data.designation_fontsize)){ #>
                        font-size:{{data.designation_fontsize.sm}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-message {
                    <# if(_.isObject(data.message_fontsize)){ #>
                        font-size:{{data.message_fontsize.sm}}px;
                    <# }
                    if(_.isObject(data.message_lineheight)){
                    #>
                        line-height:{{data.message_lineheight.sm}}px;
                    <# }
                    if(_.isObject(data.message_margin_top)) {
                    #>
                        margin-top:{{data.message_margin_top.sm}}px;
                    <# }
                    if(data.testimonial_carousel_layout != "testi_layout3"){
                    #>
                        <# if(_.isObject(data.message_margin_bottom)) { #>
                            margin-top:{{data.message_margin_bottom.sm}}px;
                        <# }
                    } #>
                }
                <# if(data.testimonial_carousel_layout == "testi_layout3"){ #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-item-content {
                        <# if(_.isObject(data.message_margin_bottom)) { #>
                            margin-bottom:{{data.message_margin_bottom.sm}}px;
                        <# }
                        if(_.isObject(data.message_padding)) {
                        #>
                            padding:{{data.message_padding.sm}};
                        <# } #>
                    }
                <# } #>

                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-img-wrap {
                    <# if(_.isObject(data.avatar_height)) { #>
                        height:{{data.avatar_height.sm}}px;
                    <# }
                    if(_.isObject(data.avatar_width)) {
                    #>
                        width:{{data.avatar_width.sm}}px;
                    <# }
    
                    if(data.testimonial_carousel_layout !== "testi_layout3"){
                        if(data.avatar_layout == "avatar_layout1"){
                    #>
                            <# if(_.isObject(data.avatar_gap)){ #>
                                margin-right:{{data.avatar_gap.sm}}px;
                            <# }
                        } else if(data.avatar_layout == "avatar_layout2"){
                            if(_.isObject(data.avatar_gap)){
                            #>
                                margin-left:{{data.avatar_gap.sm}}px;
                            <# }
                        } else if(data.avatar_layout == "avatar_layout3"){
                            if(_.isObject(data.avatar_gap)){
                            #>
                                margin-bottom:{{data.avatar_gap.sm}}px;
                            <# }
                        } else if(data.avatar_layout == "avatar_layout4"){
                            if(_.isObject(data.avatar_gap)){
                            #>
                                margin-top:{{data.avatar_gap.sm}}px;
                            <# }
                        }
                    } #>
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-icon {
                    <# if(_.isObject(data.quote_icon_size)){ #>
                        font-size: {{data.quote_icon_size.sm}}px;
                    <# }
                    if(data.testimonial_carousel_layout == "testi_layout1"){
                        if(_.isObject(data.quote_icon_gap)){    
                        #>
                            margin-bottom:{{data.quote_icon_gap.sm}}px;
                        <# }
                    } else if (data.testimonial_carousel_layout == "testi_layout2") {
                            if(_.isObject(data.quote_icon_gap)){
                        #>
                            margin-top:{{data.quote_icon_gap.sm}}px;
                        <# }
                    } #>
                }
    
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-rating {
                    <# if(_.isObject(data.rating_size)){ #>
                        font-size: {{data.rating_size.sm}}px;
                    <# }
                    if(data.testimonial_carousel_layout == "testi_layout1" || data.testimonial_carousel_layout == "testi_layout3"){
                        if(_.isObject(data.rating_gap)){    
                        #>
                            margin-bottom:{{data.rating_gap.sm}}px;
                        <# }
                    } else if (data.testimonial_carousel_layout == "testi_layout2") {
                            if(_.isObject(data.rating_gap)){
                        #>
                            margin-top:{{data.rating_gap.sm}}px;
                        <# }
                    } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-item {
                    <# if(_.isObject(data.content_padding)){ #>
                        padding:{{data.content_padding.sm}};
                    <# } #>
                }
            }
            @media (max-width: 767px) {
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-nav-control .nav-control {
                    <# if(_.isObject(data.arrow_position_verti)) { #>
                        margin-top: {{data.arrow_position_verti.xs}}%;
                    <# }
                    if(_.isObject(data.arrow_position_hori)) {
                    #>
                        margin-left: {{data.arrow_position_hori.xs}}px;
                    <# }
                    if(_.isObject(data.arrow_position_hori)) {
                    #>
                        margin-right: {{data.arrow_position_hori.xs}}px;
                    <# } #>
                }
                <# if(data.carousel_bullet){ #>
                    #sppb-addon-{{ data.id }} .sppb-carousel-extended-dots {
                        <# if(_.isObject(data.bullet_position_verti)) { #>
                            bottom: {{data.bullet_position_verti.xs}}%;
                        <# }
                        if(_.isObject(data.bullet_position_hori)) {
                        #>
                            left: {{data.bullet_position_hori.xs}}px;
                        <# } #>
                    }
                <# } #>
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-name {
                    <# if(_.isObject(data.name_fontsize)){ #>
                        font-size:{{data.name_fontsize.xs}}px;
                    <# }
                    if(_.isObject(data.name_margin)) {
                    #>
                        margin:{{data.name_margin.xs}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-designation {
                    <# if(_.isObject(data.designation_fontsize)){ #>
                        font-size:{{data.designation_fontsize.xs}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-message {
                    <# if(_.isObject(data.message_fontsize)){ #>
                        font-size:{{data.message_fontsize.xs}}px;
                    <# }
                    if(_.isObject(data.message_lineheight)){
                    #>
                        line-height:{{data.message_lineheight.xs}}px;
                    <# }
                    if(_.isObject(data.message_margin_top)) {
                    #>
                        margin-top:{{data.message_margin_top.xs}}px;
                    <# }
                    if(data.testimonial_carousel_layout != "testi_layout3"){
                        if(_.isObject(data.message_margin_bottom)) {
                    #>
                            margin-bottom:{{data.message_margin_bottom.xs}}px;
                        <# }
                    } #>
                }
                <# if(data.testimonial_carousel_layout == "testi_layout3"){ #>
                    #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-item-content {
                        <# if(_.isObject(data.message_margin_bottom)) { #>
                            margin-bottom:{{data.message_margin_bottom.xs}}px;
                        <# }
                        if(_.isObject(data.message_padding)) {
                        #>
                            padding:{{data.message_padding.xs}};
                        <# } #>
                    }
                <# } #>

                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-img-wrap {
                    <# if(_.isObject(data.avatar_height)) { #>
                        height:{{data.avatar_height.xs}}px;
                    <# }
                    if(_.isObject(data.avatar_width)) {
                    #>
                        width:{{data.avatar_width.xs}}px;
                    <# }
                    if(data.testimonial_carousel_layout !== "testi_layout3"){
                        if(data.avatar_layout == "avatar_layout1"){
                    #>
                            <# if(_.isObject(data.avatar_gap)){ #>
                                margin-right:{{data.avatar_gap.xs}}px;
                            <# }
                        } else if(data.avatar_layout == "avatar_layout2"){
                            if(_.isObject(data.avatar_gap)){
                            #>
                                margin-left:{{data.avatar_gap.xs}}px;
                            <# }
                        } else if(data.avatar_layout == "avatar_layout3"){
                            if(_.isObject(data.avatar_gap)){
                            #>
                                margin-bottom:{{data.avatar_gap.xs}}px;
                            <# }
                        } else if(data.avatar_layout == "avatar_layout4"){
                            if(_.isObject(data.avatar_gap)){
                            #>
                                margin-top:{{data.avatar_gap.xs}}px;
                            <# }
                        }
                    } #>
                }
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-icon {
                    <# if(_.isObject(data.quote_icon_size)){ #>
                        font-size: {{data.quote_icon_size.xs}}px;
                    <# }
                    if(data.testimonial_carousel_layout == "testi_layout1"){
                        if(_.isObject(data.quote_icon_gap)){    
                        #>
                            margin-bottom:{{data.quote_icon_gap.xs}}px;
                        <# }
                    } else if (data.testimonial_carousel_layout == "testi_layout2") {
                            if(_.isObject(data.quote_icon_gap)){
                        #>
                            margin-top:{{data.quote_icon_gap.xs}}px;
                        <# }
                    } #>
                }
    
                #sppb-addon-{{ data.id }} .sppb-testimonial-carousel-rating {
                    <# if(_.isObject(data.rating_size)){ #>
                        font-size: {{data.rating_size.xs}}px;
                    <# }
                    if(data.testimonial_carousel_layout == "testi_layout1" || data.testimonial_carousel_layout == "testi_layout3"){
                        if(_.isObject(data.rating_gap)){    
                        #>
                            margin-bottom:{{data.rating_gap.xs}}px;
                        <# }
                    } else if (data.testimonial_carousel_layout == "testi_layout2") {
                            if(_.isObject(data.rating_gap)){
                        #>
                            margin-top:{{data.rating_gap.xs}}px;
                        <# }
                    } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-item {
                    <# if(_.isObject(data.content_padding)){ #>
                        padding:{{data.content_padding.xs}};
                    <# } #>
                }
            }
        </style>
        <#
        var left_arrow ="";
        var right_arrow = "";
        if(data.arrow_icon=="long_arrow"){
            left_arrow ="fa-long-arrow-left";
            right_arrow = "fa-long-arrow-right";
        } else {
            left_arrow ="fa-angle-left";
            right_arrow = "fa-angle-right";
        }
        let carousel_item_number = 3;
        let carousel_item_number_sm = 3;
        let carousel_item_number_xs = 1;
        if(_.isObject(data.carousel_item_number)){
            carousel_item_number = data.carousel_item_number.md
            carousel_item_number_sm = data.carousel_item_number.sm
            carousel_item_number_xs = data.carousel_item_number.xs
        }

        let quote_icon = "";
        if(data.show_quote_icon){
            quote_icon += `<div class="sppb-testimonial-carousel-icon">`;
            quote_icon += `<i class="fa fa-quote-left" aria-hidden="true"></i>`;
            quote_icon += `</div>`;
        }

        #>
            <div class="sppb-addon sppb-carousel-extended {{data.class}} sppb-testimonial-carousel-{{data.testimonial_carousel_layout}}" data-left-arrow="{{left_arrow}}" data-right-arrow="{{right_arrow}}" data-arrow="{{data.carousel_arrow}}" data-dots="{{data.carousel_bullet}}" data-testi-layout="{{data.testimonial_carousel_layout}}" data-autoplay="{{data.carousel_autoplay}}" data-speed="{{data.carousel_speed}}" data-interval="{{data.carousel_interval}}" data-margin="{{data.carousel_margin}}" data-item-number="{{carousel_item_number || 3}}" data-item-number-sm="{{carousel_item_number_sm || 3}}" data-item-number-xs="{{carousel_item_number_xs || 1}}">
                <# if(_.isArray(data.sp_testimonial_carousel_item)){
                    _.each(data.sp_testimonial_carousel_item, function(carousel_item, caro_index){
                    const uniqId= `sppb-testi-${data.id}-carousel-item-key-${caro_index}`;
                    let client_details = "";
                    var carouselImg = {}
                    if (typeof carousel_item.testimonial_carousel_img !== "undefined" && typeof carousel_item.testimonial_carousel_img.src !== "undefined") {
                        carouselImg = carousel_item.testimonial_carousel_img
                    } else {
                        carouselImg = {src: carousel_item.testimonial_carousel_img}
                    }
                    client_details += `<div class="sppb-testimonial-carousel-content-wrap">`;
                        if(carouselImg.src){
                            client_details += `<div class="sppb-testimonial-carousel-img-wrap">`;
                            client_details += `<img src=${carouselImg.src} alt=${carousel_item.client_name}>`;
                            client_details += `</div>`;
                        }
                        client_details += `<div class="sppb-testimonial-carousel-name-designation">`;
                            if(carousel_item.client_name){
                                client_details += `<div class="sppb-testimonial-carousel-name">`;
                                client_details += `${carousel_item.client_name}`;
                                client_details += `</div>`;
                            } 
                            if(carousel_item.client_desgination){
                                client_details += `<div class="sppb-testimonial-carousel-designation">`;
                                client_details += `${carousel_item.client_desgination}`;
                                client_details += `</div>`;
                            }
                        client_details += `</div>`;
                    client_details += `</div>`;
                    
                    let rating = "";
                    if(carousel_item.show_rating){
                        rating += `<div class="sppb-testimonial-carousel-client-rating"><span class="sppb-testimonial-carousel-rating"></span></div>`;
                    }
                #>
                        <div id="{{uniqId}}" class="sppb-carousel-extended-item {{data.content_alignment}}">
                            <# if(data.testimonial_carousel_layout == "testi_layout1"){ #>
                                {{{quote_icon}}}
                            <# }
        
                            if(data.testimonial_carousel_layout == "testi_layout2"){
                            #>
                                {{{client_details}}}
                            <# } #>

                            <div class="sppb-testimonial-carousel-item-content">
                            <# if(data.testimonial_carousel_layout == "testi_layout2" || data.testimonial_carousel_layout == "testi_layout3"){ #>
                                {{{rating}}}
                            <# }
        
                            if(carousel_item.client_message) {
                            #>
                                <div class="sppb-testimonial-carousel-message">
                                    {{carousel_item.client_message}}
                                </div>
                            <# }
        
                            if(data.testimonial_carousel_layout == "testi_layout1"){
                            #>
                                {{{rating}}}
                            <# } #>
                            </div>

                            <# if(data.testimonial_carousel_layout == "testi_layout1" || data.testimonial_carousel_layout == "testi_layout3"){ #>
                                {{{client_details}}}
                            <# }
        
                            if(data.testimonial_carousel_layout == "testi_layout2"){
                            #>
                                {{{quote_icon}}}
                            <# } #>
                            
                        </div>
                    <#
                    })
                } #>
            </div>
        ';
		return $output;
	}
}
