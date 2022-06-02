<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonImage_carousel extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' '.$settings->class : '';
        $image_carousel_layout = (isset($settings->image_carousel_layout) && $settings->image_carousel_layout) ? $settings->image_carousel_layout : 'layout2';
        $carousel_autoplay = (isset($settings->carousel_autoplay) && $settings->carousel_autoplay) ? $settings->carousel_autoplay : 0;
        $carousel_speed = (isset($settings->carousel_speed) && $settings->carousel_speed) ? $settings->carousel_speed : 2500;
        $carousel_interval = (isset($settings->carousel_interval) && $settings->carousel_interval) ? $settings->carousel_interval : 4500;
        $carousel_margin = (isset($settings->carousel_margin) && $settings->carousel_margin) ? $settings->carousel_margin : 0;
        $carousel_center_padding = (isset($settings->carousel_center_padding) && $settings->carousel_center_padding) ? $settings->carousel_center_padding : 180;
        $carousel_center_padding_sm = (isset($settings->carousel_center_padding_sm) && $settings->carousel_center_padding_sm) ? $settings->carousel_center_padding_sm : 90;
        $carousel_center_padding_xs = (isset($settings->carousel_center_padding_xs) && $settings->carousel_center_padding_xs) ? $settings->carousel_center_padding_xs : 50;
        $carousel_item_number = (isset($settings->carousel_item_number) && $settings->carousel_item_number) ? $settings->carousel_item_number : 3;
        $carousel_item_number_sm = (isset($settings->carousel_item_number_sm) && $settings->carousel_item_number_sm) ? $settings->carousel_item_number_sm : 3;
        $carousel_item_number_xs = (isset($settings->carousel_item_number_xs) && $settings->carousel_item_number_xs) ? $settings->carousel_item_number_xs : 1;
        $carousel_height = (isset($settings->carousel_height) && $settings->carousel_height) ? $settings->carousel_height : 500;
        $carousel_height_sm = (isset($settings->carousel_height_sm) && $settings->carousel_height_sm) ? $settings->carousel_height_sm : 400;
        $carousel_height_xs = (isset($settings->carousel_height_xs) && $settings->carousel_height_xs) ? $settings->carousel_height_xs : 300;
        $carousel_bullet = (isset($settings->carousel_bullet) && $settings->carousel_bullet) ? $settings->carousel_bullet : 0;
        $carousel_overlay = (isset($settings->carousel_overlay) && $settings->carousel_overlay) ? $settings->carousel_overlay : 0;
        $carousel_fade = (isset($settings->carousel_fade) && $settings->carousel_fade) ? $settings->carousel_fade : 0;

		//Arrow style
        $carousel_arrow = (isset($settings->carousel_arrow) && $settings->carousel_arrow) ? $settings->carousel_arrow : 0;
        $arrow_icon = (isset($settings->arrow_icon) && $settings->arrow_icon) ? $settings->arrow_icon : 'angle';
        $left_arrow ='';
        $right_arrow = '';
        if($arrow_icon=='long_arrow'){
            $left_arrow ='fas fa-long-arrow-alt-right';
            $right_arrow = 'fas fa-long-arrow-alt-left';
        } else {
			$left_arrow ='fa-angle-left';
            $right_arrow = 'fa-angle-right';
        }

		//Output
		$output  = '<div class="sppb-addon sppb-carousel-extended' . $class . ' sppb-image-carousel-'.$image_carousel_layout.'" data-left-arrow="'.$left_arrow.'" data-right-arrow="'.$right_arrow.'" data-arrow="'.$carousel_arrow.'" data-dots="'.$carousel_bullet.'" data-image-layout="'.$image_carousel_layout.'" data-autoplay="'.$carousel_autoplay.'" data-speed="'.$carousel_speed.'" data-interval="'.$carousel_interval.'" data-margin="'.$carousel_margin.'" '.(($image_carousel_layout == 'layout3' || $image_carousel_layout == 'layout4') ? 'data-padding="'.$carousel_center_padding.'"' : '').' '.(($image_carousel_layout == 'layout3' || $image_carousel_layout == 'layout4') ? 'data-padding-sm="'.$carousel_center_padding_sm.'"' : '').' '.(($image_carousel_layout == 'layout3' || $image_carousel_layout == 'layout4') ? 'data-padding-xs="'.$carousel_center_padding_xs.'"' : '').' data-height="'.$carousel_height.'" data-height-sm="'.$carousel_height_sm.'" data-height-xs="'.$carousel_height_xs.'" data-item-number="'.$carousel_item_number.'" data-item-number-sm="'.$carousel_item_number_sm.'" data-item-number-xs="'.$carousel_item_number_xs.'"'. ($image_carousel_layout == 'layout1' && $carousel_fade ? ' data-fade="'.$carousel_fade.'"' : '').'>';
		if(isset($settings->sp_image_carousel_item) && is_array($settings->sp_image_carousel_item)){
			foreach($settings->sp_image_carousel_item as $item_key => $carousel_item){
                $output .= '<div class="sppb-carousel-extended-item">';

                $image_carousel_img = isset($carousel_item->image_carousel_img) && $carousel_item->image_carousel_img ? $carousel_item->image_carousel_img : '';
                $image_carousel_img_src = isset($image_carousel_img->src) ? $image_carousel_img->src : $image_carousel_img;

                if(isset($carousel_item->image_carousel_img_link) && $carousel_item->image_carousel_img_link){
                    $output .= '<a href="'.$carousel_item->image_carousel_img_link.'" '.($carousel_item->link_open_new_window ? ' rel="noopener noreferrer" target="_blank"' : '').'>';
                }
                $output .= '<img src="'.$image_carousel_img_src.'" alt="'.(isset($carousel_item->item_title) ? $carousel_item->item_title : '').'">';
                if($carousel_overlay){
                    $output .= '<div class="sppb-carousel-extended-item-overlay"></div>';
                }
                if($image_carousel_layout != ''){
                    $output .= '<div class="sppb-carousel-extended-content-wrap">';
                        if(isset($carousel_item->item_title)){
                            $output .= '<div class="sppb-carousel-extended-heading">';
                            $output .= $carousel_item->item_title;
                            $output .= '</div>';
                        }
                        if(isset($carousel_item->item_subtitle)){
                            $output .= '<div class="sppb-carousel-extended-subheading">';
                            $output .= $carousel_item->item_subtitle;
                            $output .= '</div>';
                        }
                        if(isset($carousel_item->item_description)){
                            $output .= '<div class="sppb-carousel-extended-description">';
                            $output .= $carousel_item->item_description;
                            $output .= '</div>';
                        }
                    $output .= '</div>';
                }
                if(isset($carousel_item->image_carousel_img_link) && $carousel_item->image_carousel_img_link){
                    $output .= '</a>';
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
        $image_carousel_layout = (isset($settings->image_carousel_layout) && $settings->image_carousel_layout) ? $settings->image_carousel_layout : '';
        $overlay_gradient = (isset($settings->overlay_gradient) && $settings->overlay_gradient) ? $settings->overlay_gradient : '';

        //Arrow Style
        $carousel_arrow = (isset($settings->carousel_arrow) && $settings->carousel_arrow) ? $settings->carousel_arrow : 1;
        $arrow_style = '';
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "height: " . $settings->arrow_height . "px;" : "";
        $arrow_style .= (isset($settings->arrow_height) && $settings->arrow_height) ? "line-height: " . (($settings->arrow_height)-($settings->arrow_border_width)) . "px;" : "";

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
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-nav-control .nav-control {';
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
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-nav-control .nav-control:hover{';
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
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-dots ul li {';
                    $css .= $bullet_style;
                $css .= '}';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-dots {';
                    if(isset($settings->bullet_position_verti) && $settings->bullet_position_verti != ''){
                        $css .= 'bottom: '.$settings->bullet_position_verti.'%;';
                    }
                    if(isset($settings->bullet_position_hori) && $settings->bullet_position_hori != ''){
                        $css .= 'left: '.$settings->bullet_position_hori.'px;';
                    }
                $css .= '}';
            }

            if($bullet_active_style){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-dots ul li:hover span,';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-dots ul li.active span{';
                    $css .= $bullet_active_style;
                $css .= '}';
            }
        }

        //Overaly
        $gradient_color1 = (isset($overlay_gradient->color) && $overlay_gradient->color) ? $overlay_gradient->color : 'rgba(59, 25, 208, 0.5)';
        $gradient_color2 = (isset($overlay_gradient->color2) && $overlay_gradient->color2) ? $overlay_gradient->color2 : 'rgba(255, 79, 226, 0.5)';
        $degree = $overlay_gradient->deg;
        $type = $overlay_gradient->type;
        $radialPos = (isset($overlay_gradient->radialPos) && $overlay_gradient->radialPos) ? $overlay_gradient->radialPos : 'Center Center';
        $radial_angle1 = (isset($overlay_gradient->pos) && $overlay_gradient->pos) ? $overlay_gradient->pos : '2';
        $radial_angle2 = (isset($overlay_gradient->pos2) && $overlay_gradient->pos2) ? $overlay_gradient->pos2 : '99';
        $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-item-overlay {';
            if($type!=='radial'){
                $css .= 'background: -webkit-linear-gradient('.$degree.'deg, '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
                $css .= 'background: linear-gradient('.$degree.'deg, '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
            } else {
                $css .= 'background: -webkit-radial-gradient(at '.$radialPos.', '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
                $css .= 'background: radial-gradient(at '.$radialPos.', '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
            }
        $css .= '}';

        //Content Alignment
        $item_content_verti_align = (isset($settings->item_content_verti_align) && $settings->item_content_verti_align) ? $settings->item_content_verti_align : "";
        $item_content_hori_align = (isset($settings->item_content_hori_align) && $settings->item_content_hori_align) ? $settings->item_content_hori_align : "";

        if($item_content_verti_align || $item_content_hori_align) {
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-content-wrap {';
                if($item_content_verti_align === "top"){
                    $css .= 'justify-content: flex-start;';
                } else if($item_content_verti_align === "bottom"){
                    $css .= 'justify-content: flex-end;';
                }
                if($item_content_hori_align === "left"){
                    $css .= 'align-items: flex-start;';
                    $css .= 'text-align: left;';
                } else if($item_content_hori_align === "right"){
                    $css .= 'align-items: flex-end;';
                    $css .= 'text-align: right;';
                }
            $css .='}';
        }

        //Content title style
        $title_style = '';
        $title_style .= (isset($settings->content_title_fontsize) && $settings->content_title_fontsize) ? 'font-size:'.$settings->content_title_fontsize.'px;' : '';
        $title_style .= (isset($settings->content_title_lineheight) && $settings->content_title_lineheight) ? 'line-height:'.$settings->content_title_lineheight.'px;' : '';
        $title_style .= (isset($settings->content_title_letterspace) && $settings->content_title_letterspace) ? 'letter-spacing:'.$settings->content_title_letterspace.';' : '';
        $title_style .= (isset($settings->content_title_text_color) && $settings->content_title_text_color) ? 'color:'.$settings->content_title_text_color.';' : '';
        $title_style .= (isset($settings->content_title_margin) && trim($settings->content_title_margin)) ? 'margin:'.$settings->content_title_margin.';' : '';

        $content_title_font_style = (isset($settings->content_title_font_style) && $settings->content_title_font_style) ? $settings->content_title_font_style : '';
		if(isset($content_title_font_style->underline) && $content_title_font_style->underline){
			$title_style .= 'text-decoration:underline;';
		}
		if(isset($content_title_font_style->italic) && $content_title_font_style->italic){
			$title_style .= 'font-style:italic;';
		}
		if(isset($content_title_font_style->uppercase) && $content_title_font_style->uppercase){
			$title_style .= 'text-transform:uppercase;';
		}
		if(isset($content_title_font_style->weight) && $content_title_font_style->weight){
			$title_style .= 'font-weight:'.$content_title_font_style->weight.';';
        }

        if($title_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-heading {';
                $css .= $title_style;
            $css .='}';
        }

        //Content subtitle style
        $subtile_style = '';
        $subtile_style .= (isset($settings->content_subtitle_fontsize) && $settings->content_subtitle_fontsize) ? 'font-size:'.$settings->content_subtitle_fontsize.'px;' : '';
        $subtile_style .= (isset($settings->content_subtitle_lineheight) && $settings->content_subtitle_lineheight) ? 'line-height:'.$settings->content_subtitle_lineheight.'px;' : '';
        $subtile_style .= (isset($settings->content_subtitle_letterspace) && $settings->content_subtitle_letterspace) ? 'letter-spacing:'.$settings->content_subtitle_letterspace.';' : '';
        $subtile_style .= (isset($settings->content_subtitle_text_color) && $settings->content_subtitle_text_color) ? 'color:'.$settings->content_subtitle_text_color.';' : '';

        $content_subtitle_font_style = (isset($settings->content_subtitle_font_style) && $settings->content_subtitle_font_style) ? $settings->content_subtitle_font_style : '';

		if(isset($content_subtitle_font_style->underline) && $content_subtitle_font_style->underline){
			$subtile_style .= 'text-decoration:underline;';
		}
		if(isset($content_subtitle_font_style->italic) && $content_subtitle_font_style->italic){
			$subtile_style .= 'font-style:italic;';
		}
		if(isset($content_subtitle_font_style->uppercase) && $content_subtitle_font_style->uppercase){
			$subtile_style .= 'text-transform:uppercase;';
		}
		if(isset($content_subtitle_font_style->weight) && $content_subtitle_font_style->weight){
			$subtile_style .= 'font-weight:'.$content_subtitle_font_style->weight.';';
        }

        if($subtile_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-subheading {';
                $css .= $subtile_style;
            $css .='}';
        }

        //Descrition style
        $description_style = '';
        $description_style .= (isset($settings->description_fontsize) && $settings->description_fontsize) ? 'font-size:'.$settings->description_fontsize.'px;' : '';
        $description_style .= (isset($settings->description_lineheight) && $settings->description_lineheight) ? 'line-height:'.$settings->description_lineheight.'px;' : '';
        $description_style .= (isset($settings->description_letterspace) && $settings->description_letterspace) ? 'letter-spacing:'.$settings->description_letterspace.';' : '';
        $description_style .= (isset($settings->description_text_color) && $settings->description_text_color) ? 'color:'.$settings->description_text_color.';' : '';
        $description_style .= (isset($settings->description_margin) && trim($settings->description_margin)) ? 'margin:'.$settings->description_margin.';' : '';

        $description_font_style = (isset($settings->description_font_style) && $settings->description_font_style) ? $settings->description_font_style : '';
		if(isset($description_font_style->underline) && $description_font_style->underline){
			$description_style .= 'text-decoration:underline;';
		}
		if(isset($description_font_style->italic) && $description_font_style->italic){
			$description_style .= 'font-style:italic;';
		}
		if(isset($description_font_style->uppercase) && $description_font_style->uppercase){
			$description_style .= 'text-transform:uppercase;';
		}
		if(isset($description_font_style->weight) && $description_font_style->weight){
			$description_style .= 'font-weight:'.$description_font_style->weight.';';
        }

        if($description_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-description {';
                $css .= $description_style;
            $css .='}';
        }

        //Carousel transition speed
        $carousel_speed = (isset($settings->carousel_speed)) ? $settings->carousel_speed : 2500;
        if($image_carousel_layout == 'layout3' || $image_carousel_layout == 'layout4'){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-center .sppb-carousel-extended-item .sppb-addon-wrapper {';
                $css .= 'transition: all '.$carousel_speed.'ms ease 0s;';
            $css .='}';
        }
        $arrow_height = (isset($settings->arrow_height) && $settings->arrow_height) ? $settings->arrow_height : "";
        if($arrow_height){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-nav-control {';
                $css .= 'top: -'.$arrow_height.'px;';
            $css .='}';
        }

        //Responsive tablet
        $title_style_sm = '';
        $title_style_sm .= (isset($settings->content_title_fontsize_sm) && $settings->content_title_fontsize_sm) ? 'font-size:'.$settings->content_title_fontsize_sm.'px;' : '';
        $title_style_sm .= (isset($settings->content_title_margin_sm) && trim($settings->content_title_margin_sm)) ? 'margin:'.$settings->content_title_margin_sm.';' : '';

        $subtile_style_sm = '';
        $subtile_style_sm .= (isset($settings->content_subtitle_fontsize_sm) && $settings->content_subtitle_fontsize_sm) ? 'font-size:'.$settings->content_subtitle_fontsize_sm.'px;' : '';

        $description_style_sm = '';
        $description_style_sm .= (isset($settings->description_fontsize_sm) && $settings->description_fontsize_sm) ? 'font-size:'.$settings->description_fontsize_sm.'px;' : '';
        $description_style_sm .= (isset($settings->description_margin_sm) && trim($settings->description_margin_sm)) ? 'margin:'.$settings->description_margin_sm.';' : '';

        $css .= '@media (min-width: 768px) and (max-width: 991px) {';

            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-dots {';
                if(isset($settings->bullet_position_verti) && $settings->bullet_position_verti_sm){
                    $css .= 'bottom: '.$settings->bullet_position_verti_sm.'%;';
                }
                if(isset($settings->bullet_position_hori) && $settings->bullet_position_hori_sm){
                    $css .= 'left: '.$settings->bullet_position_hori_sm.'px;';
                }
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-nav-control .nav-control {';
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

            if($title_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-heading {';
                    $css .= $title_style_sm;
                $css .='}';
            }
            if($subtile_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-subheading {';
                    $css .= $subtile_style_sm;
                $css .='}';
            }

            if($description_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-description {';
                    $css .= $description_style_sm;
                $css .='}';
            }

        $css .= '}';

        //Responsive mobile
        $title_style_xs = '';
        $title_style_xs .= (isset($settings->content_title_fontsize_xs) && $settings->content_title_fontsize_xs) ? 'font-size:'.$settings->content_title_fontsize_xs.'px;' : '';
        $title_style_xs .= (isset($settings->content_title_margin_xs) && trim($settings->content_title_margin_xs)) ? 'margin:'.$settings->content_title_margin_xs.';' : '';

        $subtile_style_xs = '';
        $subtile_style_xs .= (isset($settings->content_subtitle_fontsize_xs) && $settings->content_subtitle_fontsize_xs) ? 'font-size:'.$settings->content_subtitle_fontsize_xs.'px;' : '';

        $description_style_xs = '';
        $description_style_xs .= (isset($settings->description_fontsize_xs) && $settings->description_fontsize_xs) ? 'font-size:'.$settings->description_fontsize_xs.'px;' : '';
        $description_style_xs .= (isset($settings->description_margin_xs) && trim($settings->description_margin_xs)) ? 'margin:'.$settings->description_margin_xs.';' : '';

        $css .= '@media (max-width: 767px) {';

            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-dots {';
                if(isset($settings->bullet_position_verti) && $settings->bullet_position_verti_xs){
                    $css .= 'bottom: '.$settings->bullet_position_verti_xs.'%;';
                }
                if(isset($settings->bullet_position_hori) && $settings->bullet_position_hori_xs){
                    $css .= 'left: '.$settings->bullet_position_hori_xs.'px;';
                }
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-nav-control .nav-control {';
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

            if($title_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-heading {';
                    $css .= $title_style_xs;
                $css .='}';
            }
            if($subtile_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-subheading {';
                    $css .= $subtile_style_xs;
                $css .='}';
            }

            if($description_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-description {';
                    $css .= $description_style_xs;
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
            <# } #>

            <# if(data.image_carousel_layout == "layout3" || data.image_carousel_layout == "layout4"){ #>
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-center .sppb-carousel-extended-item .sppb-addon-wrapper {
                    transition: all {{data.carousel_speed}}ms ease 0s;
                }
            <# }

            let gradient_color1 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.color) && data.overlay_gradient.color) ? data.overlay_gradient.color : "rgba(59, 25, 208, 0.5)";
            let gradient_color2 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.color2) && data.overlay_gradient.color2) ? data.overlay_gradient.color2 : "rgba(255, 79, 226, 0.5)";
            let degree = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.deg) && data.overlay_gradient.deg)? data.overlay_gradient.deg : "";
            let type = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.type) && data.overlay_gradient.type)? data.overlay_gradient.type : "linear";
            let radialPos = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.radialPos) && data.overlay_gradient.radialPos) ? data.overlay_gradient.radialPos : "Center Center";
            let radial_angle1 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.pos) && data.overlay_gradient.pos) ? data.overlay_gradient.pos : "2";
            let radial_angle2 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.pos2) && data.overlay_gradient.pos2) ? data.overlay_gradient.pos2 : "99";

            #>
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-item-overlay {
				<# if(type!=="radial"){ #>
					background: -webkit-linear-gradient({{degree}}deg, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
					background: linear-gradient({{degree}}deg, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
				<# } else { #>
					background: -webkit-radial-gradient(at {{radialPos}}, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
					background: radial-gradient(at {{radialPos}}, {{gradient_color1}} {{radial_angle1}}%, {{gradient_color2}} {{radial_angle2}}%) transparent;
				<# } #>
            }

            <# if(data.item_content_verti_align || data.item_content_hori_align) { #>
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-content-wrap {
                    <# if(data.item_content_verti_align === "top"){ #>
                        justify-content: flex-start;
                    <# } else if(data.item_content_verti_align === "bottom"){ #>
                        justify-content: flex-end;
                    <# } #>
                    <# if(data.item_content_hori_align === "left"){ #>
                        align-items: flex-start;
                        text-align: left;
                    <# } else if(data.item_content_hori_align === "right"){ #>
                        align-items: flex-end;
                        text-align: right;
                    <# } #>
                }
            <# } #>

            #sppb-addon-{{ data.id }} .sppb-carousel-extended-heading {
                <# if(_.isObject(data.content_title_fontsize)){ #>
                    font-size:{{data.content_title_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.content_title_fontsize}}px;
                <# } #>
                letter-spacing:{{data.content_title_letterspace}};
                color:{{data.content_title_text_color}};
                line-height:{{data.content_title_lineheight}}px;
                <# if(_.isObject(data.content_title_margin)) { #>
                    margin:{{data.content_title_margin.md}};
                <# } else { #>
                    margin:{{data.content_title_margin}};
                <# }
                if(_.isObject(data.content_title_font_style)) {
                    if(data.content_title_font_style.underline) {
                #>
                        text-decoration:underline;
                    <# }
                    if(data.content_title_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.content_title_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.content_title_font_style.weight) {
                    #>
                        font-weight:{{data.content_title_font_style.weight}};
                    <# }
                } #>
            }

            #sppb-addon-{{ data.id }} .sppb-carousel-extended-subheading {
                <# if(_.isObject(data.content_subtitle_fontsize)){ #>
                    font-size:{{data.content_subtitle_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.content_subtitle_fontsize}}px;
                <# } #>
                letter-spacing:{{data.content_subtitle_letterspace}};
                color:{{data.content_subtitle_text_color}};
                line-height:{{data.content_subtitle_lineheight}}px;
                <# if(_.isObject(data.content_subtitle_font_style)) {
                    if(data.content_subtitle_font_style.underline) {
                    #>
                        text-decoration:underline;
                    <# }
                    if(data.content_subtitle_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.content_subtitle_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.content_subtitle_font_style.weight) {
                    #>
                        font-weight:{{data.content_subtitle_font_style.weight}};
                    <# }
                } #>
            }

            #sppb-addon-{{ data.id }} .sppb-carousel-extended-description {
                <# if(_.isObject(data.description_fontsize)){ #>
                    font-size:{{data.description_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.description_fontsize}}px;
                <# } #>
                letter-spacing:{{data.description_letterspace}};
                color:{{data.description_text_color}};
                line-height:{{data.description_lineheight}}px;
                <# if(_.isObject(data.description_margin)) { #>
                    margin:{{data.description_margin.md}};
                <# } else { #>
                    margin:{{data.description_margin}};
                <# } #>
                <# if(_.isObject(data.description_font_style)) {
                    if(data.description_font_style.underline) {
                    #>
                        text-decoration:underline;
                    <# }
                    if(data.description_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.description_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.description_font_style.weight) {
                    #>
                        font-weight:{{data.description_font_style.weight}};
                    <# }
                } #>
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
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-heading {
                    <# if(_.isObject(data.content_title_fontsize)){ #>
                        font-size:{{data.content_title_fontsize.sm}}px;
                    <# } #>
                    <# if(_.isObject(data.content_title_margin)) { #>
                        margin:{{data.content_title_margin.sm}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-subheading {
                    <# if(_.isObject(data.content_subtitle_fontsize)){ #>
                        font-size:{{data.content_subtitle_fontsize.sm}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-description {
                    <# if(_.isObject(data.description_fontsize)){ #>
                        font-size:{{data.description_fontsize.sm}}px;
                    <# } #>
                    <# if(_.isObject(data.description_margin)) { #>
                        margin:{{data.description_margin.sm}};
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
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-heading {
                    <# if(_.isObject(data.content_title_fontsize)){ #>
                        font-size:{{data.content_title_fontsize.xs}}px;
                    <# } #>
                    <# if(_.isObject(data.content_title_margin)) { #>
                        margin:{{data.content_title_margin.xs}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-subheading {
                    <# if(_.isObject(data.content_subtitle_fontsize)){ #>
                        font-size:{{data.content_subtitle_fontsize.xs}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-description {
                    <# if(_.isObject(data.description_fontsize)){ #>
                        font-size:{{data.description_fontsize.xs}}px;
                    <# } #>
                    <# if(_.isObject(data.description_margin)) { #>
                        margin:{{data.description_margin.xs}};
                    <# } #>
                }
            }
        </style>
        <#

        let carousel_height = data.carousel_height?.md || 500;
        let carousel_height_sm = data.carousel_height?.sm || 400;
        let carousel_height_xs = data.carousel_height?.xs || 300;

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
        let carousel_center_padding = +data.carousel_center_padding?.md || 180;
        let carousel_center_padding_sm = +data.carousel_center_padding?.sm || 90;
        let carousel_center_padding_xs = +data.carousel_center_padding?.xs || 50;
        #>
            <div class="sppb-addon sppb-carousel-extended {{data.class}} sppb-image-carousel-{{data.image_carousel_layout}}" data-left-arrow="{{left_arrow}}" data-right-arrow="{{right_arrow}}" data-arrow="{{data.carousel_arrow}}" data-dots="{{data.carousel_bullet}}" data-image-layout="{{data.image_carousel_layout}}" data-autoplay="{{data.carousel_autoplay}}" data-speed="{{data.carousel_speed}}" data-interval="{{data.carousel_interval}}" data-margin="{{data.carousel_margin}}" {{{(data.image_carousel_layout == "layout3" || data.image_carousel_layout == "layout4") ? `data-padding="${carousel_center_padding}"` : ""}}} {{{(data.image_carousel_layout == "layout3" || data.image_carousel_layout == "layout4") ? `data-padding-sm="${carousel_center_padding_sm}"` : ""}}} {{{(data.image_carousel_layout == "layout3" || data.image_carousel_layout == "layout4") ? `data-padding-xs="${carousel_center_padding_xs}"` : ""}}} data-height="{{carousel_height}}" data-height-sm="{{carousel_height_sm}}" data-height-xs="{{carousel_height_xs}}" data-item-number="{{carousel_item_number || 3}}" data-item-number-sm="{{carousel_item_number_sm || 3}}" data-item-number-xs="{{carousel_item_number_xs || 1}}" {{{data.image_carousel_layout == "layout1" && data.carousel_fade ?  `data-fade="${data.carousel_fade}"` : ""}}}>
                <# if(_.isArray(data.sp_image_carousel_item)){
                    _.each(data.sp_image_carousel_item, function(carousel_item){
                        var carouselImg = {}
                        if (typeof carousel_item.image_carousel_img !== "undefined" && typeof carousel_item.image_carousel_img.src !== "undefined") {
                            carouselImg = carousel_item.image_carousel_img
                        } else {
                            carouselImg = {src: carousel_item.image_carousel_img}
                        }
                #>
                        <div class="sppb-carousel-extended-item">
                            <# if(!_.isEmpty(carousel_item.image_carousel_img_link) && carousel_item.image_carousel_img_link){ #>
                                <a href="{{carousel_item.image_carousel_img_link}}" {{(carousel_item.link_open_new_window ? `target="_blank"` : "")}}>
                            <# }
                            if(carouselImg.src && carouselImg.src?.indexOf("http://") == -1 && carouselImg.src?.indexOf("https://") == -1){
                            #>
                                <img src=\'{{ pagebuilder_base + carouselImg.src }}\' alt="{{ carousel_item.item_title }}">
                            <# } else if(carouselImg.src){ #>
                                <img src=\'{{ carouselImg.src }}\' alt="{{ carousel_item.item_title }}">
                            <# }
                            if(data.carousel_overlay){
                            #>
                                <div class="sppb-carousel-extended-item-overlay"></div>
                            <# }
                            if(data.image_carousel_layout !== ""){
                            #>
                                <div class="sppb-carousel-extended-content-wrap">

                                    <# if(carousel_item.item_title){ #>
                                        <div class="sppb-carousel-extended-heading">
                                            {{carousel_item.item_title}}
                                        </div>
                                    <# }
                                    if(carousel_item.item_subtitle) {
                                    #>
                                        <div class="sppb-carousel-extended-subheading">
                                            {{carousel_item.item_subtitle}}
                                        </div>
                                    <# }
                                    if(carousel_item.item_description) {
                                    #>
                                        <div class="sppb-carousel-extended-description">
                                            {{carousel_item.item_description}}
                                        </div>
                                    <# } #>
                                </div>
                            <# }
                            if(!_.isEmpty(carousel_item.image_carousel_img_link) && carousel_item.image_carousel_img_link){
                            #>
                                </a>
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
