<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonTeam_carousel extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' '.$settings->class : '';
        $team_carousel_layout = (isset($settings->team_carousel_layout) && $settings->team_carousel_layout) ? $settings->team_carousel_layout : 'layout1';
        $carousel_autoplay = (isset($settings->carousel_autoplay) && $settings->carousel_autoplay) ? $settings->carousel_autoplay : 0;
        $carousel_speed = (isset($settings->carousel_speed) && $settings->carousel_speed) ? $settings->carousel_speed : 2500;
        $carousel_interval = (isset($settings->carousel_interval) && $settings->carousel_interval) ? $settings->carousel_interval : 4500;
        $carousel_margin = (isset($settings->carousel_margin) && $settings->carousel_margin) ? $settings->carousel_margin : 0;
        $carousel_item_number = (isset($settings->carousel_item_number) && $settings->carousel_item_number) ? $settings->carousel_item_number : 3;
        $carousel_item_number_sm = (isset($settings->carousel_item_number_sm) && $settings->carousel_item_number_sm) ? $settings->carousel_item_number_sm : 3;
        $carousel_item_number_xs = (isset($settings->carousel_item_number_xs) && $settings->carousel_item_number_xs) ? $settings->carousel_item_number_xs : 1;
        $carousel_bullet = (isset($settings->carousel_bullet) && $settings->carousel_bullet) ? $settings->carousel_bullet : 0;

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

		//Output
		$output  = '<div class="sppb-addon sppb-carousel-extended' . $class . ' sppb-team-carousel-'.$team_carousel_layout.'" data-left-arrow="'.$left_arrow.'" data-right-arrow="'.$right_arrow.'" data-arrow="'.$carousel_arrow.'" data-dots="'.$carousel_bullet.'" data-team-layout="'.$team_carousel_layout.'" data-autoplay="'.$carousel_autoplay.'" data-speed="'.$carousel_speed.'" data-interval="'.$carousel_interval.'" data-margin="'.$carousel_margin.'" data-item-number="'.$carousel_item_number.'" data-item-number-sm="'.$carousel_item_number_sm.'" data-item-number-xs="'.$carousel_item_number_xs.'">';
		if(isset($settings->sp_team_carousel_item) && is_array($settings->sp_team_carousel_item)){
			foreach($settings->sp_team_carousel_item as $item_key => $carousel_item){
                $carousel_img = isset($carousel_item->team_carousel_img) && $carousel_item->team_carousel_img ? $carousel_item->team_carousel_img : '';
                $carousel_img_src = isset($carousel_img->src) ? $carousel_img->src : $carousel_img;
                $person_profile_link = isset($carousel_item->person_profile_link) && $carousel_item->person_profile_link ? $carousel_item->person_profile_link : '';
                $link_open_new_window = (isset($carousel_item->link_open_new_window) && $carousel_item->link_open_new_window) ? $carousel_item->link_open_new_window : '';

                $content = '';
                $content .= '<div class="sppb-carousel-extended-team-content'.($team_carousel_layout ? ' sppb-carousel-'.$team_carousel_layout : '').'">';

                if($team_carousel_layout == 'layout2'){
                    $content .= '<div class="sppb-carousel-extended-item-overlay"></div>';
                }
                $content .= '<div class="sppb-carousel-extended-team-content-wrap">';
                    if(isset($carousel_item->person_name)){
                        $content .= '<div class="sppb-carousel-extended-team-name">';
                        if($person_profile_link){
                            $content .= '<a href="'.$person_profile_link.'"'.($link_open_new_window ? ' rel="noopener noreferrer" target="_blank"' : '').'>';
                        }
                        $content .= $carousel_item->person_name;
                        if($person_profile_link){
                            $content .= '</a>';
                        }
                        $content .= '</div>';
                    }
                    if(isset($carousel_item->person_designation)){
                        $content .= '<div class="sppb-carousel-extended-team-designation">';
                        $content .= $carousel_item->person_designation;
                        $content .= '</div>';
                    }
                    if(isset($carousel_item->team_carousel_item) && is_array($carousel_item->team_carousel_item)){
                        $content .= '<ul class="sppb-carousel-extended-team-social-icon">';
                            foreach($carousel_item->team_carousel_item as $inner_item_key => $inner_item_value){
                                $content .= '<li>';
                                $content .= '<a target="_blank" rel="noopener noreferrer" href="' . $inner_item_value->social_url . '" aria-label="' . $inner_item_value->title . '"><i class="' . $inner_item_value->social_icon . '" aria-hidden="true" title="' . $inner_item_value->title . '"></i></a>';
                                $content .= '</li>';
                            }
                        $content .= '</ul>';
                    }
                $content .= '</div>';
                $content .= '</div>';

                $output .= '<div class="sppb-carousel-extended-item">';
                if($team_carousel_layout == 'layout1'){
                    if($person_profile_link){
                        $output .= '<a href="'.$person_profile_link.'"'.($link_open_new_window ? ' rel="noopener noreferrer" target="_blank"' : '').'>';
                    }
                    $output .= '<img src="'.$carousel_img_src.'" alt="'.(isset($carousel_item->person_name) ? $carousel_item->person_name : '').'">';
                    if($person_profile_link){
                        $output .= '</a>';
                    }
                    $output .= $content;
                } elseif($team_carousel_layout == 'layout2'){
                    if($person_profile_link){
                        $output .= '<a href="'.$person_profile_link.'"'.($link_open_new_window ? ' rel="noopener noreferrer" target="_blank"' : '').'>';
                    }
                    $output .= '<img src="'.$carousel_img_src.'" alt="'.(isset($carousel_item->person_name) ? $carousel_item->person_name : '').'">';
                    if($person_profile_link){
                        $output .= '</a>';
                    }
                    $output .= $content;
                } else {
                    $output .= '<div class="sppb-carousel-extended-team-wrap">';
                        $output .= '<div class="sppb-carousel-extended-team-img">';
                            if($person_profile_link){
                                $output .= '<a href="'.$person_profile_link.'"'.($link_open_new_window ? ' rel="noopener noreferrer" target="_blank"' : '').'>';
                            }
                            $output .= '<img src="'.$carousel_img_src.'" alt="'.(isset($carousel_item->person_name) ? $carousel_item->person_name : '').'">';
                            if($person_profile_link){
                                $output .= '</a>';
                            }
                        $output .= '</div>';
                        $output .= $content;
                    $output .= '</div>';
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
        $team_carousel_layout = (isset($settings->team_carousel_layout) && $settings->team_carousel_layout) ? $settings->team_carousel_layout : '';
        $overlay_gradient = (isset($settings->overlay_gradient) && $settings->overlay_gradient) ? $settings->overlay_gradient : '';
        $content_bg_color = (isset($settings->content_bg_color) && $settings->content_bg_color) ? $settings->content_bg_color : '';
        
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

        if($content_bg_color){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-content.sppb-carousel-layout1{';
                $css .= 'background:'.$content_bg_color.';';
            $css .= '}';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-team-carousel-layout3 .sppb-carousel-extended-team-wrap{';
                $css .= 'background:'.$content_bg_color.';';
            $css .= '}';
        }
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
        $arrow_height = (isset($settings->arrow_height) && $settings->arrow_height) ? $settings->arrow_height : "";
        if($arrow_height){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-nav-control {';
                $css .= 'top: -'.$arrow_height.'px;';
            $css .='}';
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

        //Content name style
        $name_style = '';
        $name_style .= (isset($settings->content_name_fontsize) && $settings->content_name_fontsize) ? 'font-size:'.$settings->content_name_fontsize.'px;' : '';
        $name_style .= (isset($settings->content_name_lineheight) && $settings->content_name_lineheight) ? 'line-height:'.$settings->content_name_lineheight.'px;' : '';
        $name_style .= (isset($settings->content_name_letterspace) && $settings->content_name_letterspace) ? 'letter-spacing:'.$settings->content_name_letterspace.';' : '';
        $name_style .= (isset($settings->content_name_text_color) && $settings->content_name_text_color) ? 'color:'.$settings->content_name_text_color.';' : '';
        $name_style .= (isset($settings->content_name_margin) && trim($settings->content_name_margin)) ? 'margin:'.$settings->content_name_margin.';' : '';
        
        $content_name_font_style = (isset($settings->content_name_font_style) && $settings->content_name_font_style) ? $settings->content_name_font_style : '';
		if(isset($content_name_font_style->underline) && $content_name_font_style->underline){
			$name_style .= 'text-decoration:underline;';
		}
		if(isset($content_name_font_style->italic) && $content_name_font_style->italic){
			$name_style .= 'font-style:italic;';
		}
		if(isset($content_name_font_style->uppercase) && $content_name_font_style->uppercase){
			$name_style .= 'text-transform:uppercase;';
		}
		if(isset($content_name_font_style->weight) && $content_name_font_style->weight){
			$name_style .= 'font-weight:'.$content_name_font_style->weight.';';
        }
        
        if($name_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-name,';
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-name a {';
                $css .= $name_style;
            $css .='}';
        }

        //Content designation style
        $designation_style = '';
        $designation_style .= (isset($settings->content_designation_fontsize) && $settings->content_designation_fontsize) ? 'font-size:'.$settings->content_designation_fontsize.'px;' : '';
        $designation_style .= (isset($settings->content_designation_lineheight) && $settings->content_designation_lineheight) ? 'line-height:'.$settings->content_designation_lineheight.'px;' : '';
        $designation_style .= (isset($settings->content_designation_letterspace) && $settings->content_designation_letterspace) ? 'letter-spacing:'.$settings->content_designation_letterspace.';' : '';
        $designation_style .= (isset($settings->content_designation_text_color) && $settings->content_designation_text_color) ? 'color:'.$settings->content_designation_text_color.';' : '';
        
        $content_designation_font_style = (isset($settings->content_designation_font_style) && $settings->content_designation_font_style) ? $settings->content_designation_font_style : '';

		if(isset($content_designation_font_style->underline) && $content_designation_font_style->underline){
			$designation_style .= 'text-decoration:underline;';
		}
		if(isset($content_designation_font_style->italic) && $content_designation_font_style->italic){
			$designation_style .= 'font-style:italic;';
		}
		if(isset($content_designation_font_style->uppercase) && $content_designation_font_style->uppercase){
			$designation_style .= 'text-transform:uppercase;';
		}
		if(isset($content_designation_font_style->weight) && $content_designation_font_style->weight){
			$designation_style .= 'font-weight:'.$content_designation_font_style->weight.';';
        }
        
        if($designation_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-designation {';
                $css .= $designation_style;
            $css .='}';
        }
        
        //Social icon style
        $social_style = '';
        $social_style .= (isset($settings->social_fontsize) && $settings->social_fontsize) ? 'font-size:'.$settings->social_fontsize.'px;' : '';
        $social_style .= (isset($settings->social_text_color) && $settings->social_text_color) ? 'color:'.$settings->social_text_color.';' : '';
        $social_style .= (isset($settings->social_width) && $settings->social_width) ? 'width:'.$settings->social_width.'px;' : '';
        $social_style .= (isset($settings->social_height) && $settings->social_height) ? 'height:'.$settings->social_height.'px;line-height:'.$settings->social_height.'px;' : '';
        $social_style .= (isset($settings->social_border_width) && $settings->social_border_width) ? 'border-width:'.$settings->social_border_width.'px; border-style: solid;' : '';
        $social_style .= (isset($settings->social_border_color) && $settings->social_border_color) ? 'border-color:'.$settings->social_border_color.';' : '';
        $social_style .= (isset($settings->social_border_radius) && $settings->social_border_radius) ? 'border-radius:'.$settings->social_border_radius.'px;' : '';
        $social_margin_style = (isset($settings->social_margin) && trim($settings->social_margin)) ? 'margin:'.$settings->social_margin.';' : '';

        if($social_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon a {';
                $css .= $social_style;
            $css .= '}';
        }
        if($social_margin_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon li {';
                $css .= $social_margin_style;
            $css .= '}';
        }
        $social_hover_style = (isset($settings->social_hover_color) && $settings->social_hover_color) ? 'color:'.$settings->social_hover_color.';' : '';
        if($social_hover_style){
            $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon a:hover {';
                $css .= $social_hover_style;
            $css .= '}';
        }

        //Responsive tablet
        $name_style_sm = '';
        $name_style_sm .= (isset($settings->content_name_fontsize_sm) && $settings->content_name_fontsize_sm) ? 'font-size:'.$settings->content_name_fontsize_sm.'px;' : '';
        $name_style_sm .= (isset($settings->content_name_margin_sm) && trim($settings->content_name_margin_sm)) ? 'margin:'.$settings->content_name_margin_sm.';' : '';

        $designation_style_sm = '';
        $designation_style_sm .= (isset($settings->content_designation_fontsize_sm) && $settings->content_designation_fontsize_sm) ? 'font-size:'.$settings->content_designation_fontsize_sm.'px;' : '';

        $social_style_sm = '';
        $social_style_sm .= (isset($settings->social_fontsize_sm) && $settings->social_fontsize_sm) ? 'font-size:'.$settings->social_fontsize_sm.'px;' : '';
        $social_style_sm .= (isset($settings->social_width_sm) && $settings->social_width_sm) ? 'width:'.$settings->social_width_sm.'px;' : '';
        $social_style_sm .= (isset($settings->social_height_sm) && $settings->social_height_sm) ? 'height:'.$settings->social_height_sm.'px;' : '';
        $social_margin_style_sm = (isset($settings->social_margin_sm) && trim($settings->social_margin_sm)) ? 'margin:'.$settings->social_margin_sm.';' : '';
        
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

            if($name_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-name,';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-name a {';
                    $css .= $name_style_sm;
                $css .='}';
            }
            if($designation_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-designation {';
                    $css .= $designation_style_sm;
                $css .='}';
            }
            if($social_margin_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon li {';
                    $css .= $social_margin_style_sm;
                $css .= '}';
            }
            if($social_style_sm){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon a {';
                    $css .= $social_style_sm;
                $css .= '}';
            }

        $css .= '}';

        //Responsive mobile
        $name_style_xs = '';
        $name_style_xs .= (isset($settings->content_name_fontsize_xs) && $settings->content_name_fontsize_xs) ? 'font-size:'.$settings->content_name_fontsize_xs.'px;' : '';
        $name_style_xs .= (isset($settings->content_name_margin_xs) && trim($settings->content_name_margin_xs)) ? 'margin:'.$settings->content_name_margin_xs.';' : '';

        $designation_style_xs = '';
        $designation_style_xs .= (isset($settings->content_designation_fontsize_xs) && $settings->content_designation_fontsize_xs) ? 'font-size:'.$settings->content_designation_fontsize_xs.'px;' : '';

        $social_style_xs = '';
        $social_style_xs .= (isset($settings->social_fontsize_xs) && $settings->social_fontsize_xs) ? 'font-size:'.$settings->social_fontsize_xs.'px;' : '';
        $social_style_xs .= (isset($settings->social_width_xs) && $settings->social_width_xs) ? 'width:'.$settings->social_width_xs.'px;' : '';
        $social_style_xs .= (isset($settings->social_height_xs) && $settings->social_height_xs) ? 'height:'.$settings->social_height_xs.'px;' : '';
        $social_margin_style_xs = (isset($settings->social_margin_xs) && trim($settings->social_margin_xs)) ? 'margin:'.$settings->social_margin_xs.';' : '';

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

            if($name_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-name,';
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-name a {';
                    $css .= $name_style_xs;
                $css .='}';
            }
            if($designation_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-designation {';
                    $css .= $designation_style_xs;
                $css .='}';
            }

            if($social_margin_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon li {';
                    $css .= $social_margin_style_xs;
                $css .= '}';
            }
            if($social_style_xs){
                $css .= '#sppb-addon-' . $this->addon->id . ' .sppb-carousel-extended-team-social-icon a {';
                    $css .= $social_style_xs;
                $css .= '}';
            }

        $css .= '}';

		return $css;
	}

	public static function getTemplate() {
        $output = '
        <style  type="text/css">
            <# if(data.content_bg_color){ #>
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-content.sppb-carousel-layout1{
                    background:{{data.content_bg_color}};
                }
                #sppb-addon-{{ data.id }} .sppb-team-carousel-layout3 .sppb-carousel-extended-team-wrap{
                    background:{{data.content_bg_color}};
                }
            <# }
            if(data.carousel_arrow){
            #>
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

            let gradient_color1 = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.color) && data.overlay_gradient.color) ? data.overlay_gradient.color : "rgba(59, 25, 208, 0.5)";
            let gradient_color2 = (_.isObject(data.overlay_gradient) &&  !_.isEmpty(data.overlay_gradient.color2) && data.overlay_gradient.color2) ? data.overlay_gradient.color2 : "rgba(255, 79, 226, 0.5)";
            let degree = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.deg) && data.overlay_gradient.deg)? data.overlay_gradient.deg : "";
            let type = (_.isObject(data.overlay_gradient) && !_.isEmpty(data.overlay_gradient.type) && data.overlay_gradient.type)?data.overlay_gradient.type:"linear";
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
            
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-name,
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-name a {
                <# if(_.isObject(data.content_name_fontsize)){ #>
                    font-size:{{data.content_name_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.content_name_fontsize}}px;
                <# } #>
                letter-spacing:{{data.content_name_letterspace}};
                color:{{data.content_name_text_color}};
                line-height:{{data.content_name_lineheight}}px;
                <# if(_.isObject(data.content_name_margin)) { #>
                    margin:{{data.content_name_margin.md}};
                <# } else { #>
                    margin:{{data.content_name_margin}};
                <# }
                if(_.isObject(data.content_name_font_style)) {
                    if(data.content_name_font_style.underline) {
                #>
                        text-decoration:underline;
                    <# }
                    if(data.content_name_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.content_name_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.content_name_font_style.weight) {
                    #>
                        font-weight:{{data.content_name_font_style.weight}};
                    <# }
                } #>
            }
            
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-designation {
                <# if(_.isObject(data.content_designation_fontsize)){ #>
                    font-size:{{data.content_designation_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.content_designation_fontsize}}px;
                <# } #>
                letter-spacing:{{data.content_designation_letterspace}};
                color:{{data.content_designation_text_color}};
                line-height:{{data.content_designation_lineheight}}px;
                <# if(_.isObject(data.content_designation_font_style)) {
                    if(data.content_designation_font_style.underline) {
                    #>
                        text-decoration:underline;
                    <# }
                    if(data.content_designation_font_style.italic) {
                    #>
                        font-style:italic;
                    <# }
                    if(data.content_designation_font_style.uppercase) {
                    #>
                        text-transform:uppercase;
                    <# }
                    if(data.content_designation_font_style.weight) {
                    #>
                        font-weight:{{data.content_designation_font_style.weight}};
                    <# }
                } #>
            }

            #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon li {
                <# if(_.isObject(data.social_margin)) { #>
                    margin:{{data.social_margin.md}};
                <# } else { #>
                    margin:{{data.social_margin}};
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon a {
                <# if(_.isObject(data.social_fontsize)){ #>
                    font-size:{{data.social_fontsize.md}}px;
                <# } else { #>
                    font-size:{{data.social_fontsize}}px;
                <# }
                if(_.isObject(data.social_width)) {
                #>
                    width:{{data.social_width.md}}px;
                <# } else { #>
                    width:{{data.social_width}}px;
                <# }
                if(_.isObject(data.social_height)) {
                #>
                    height:{{data.social_height.md}}px;
                    line-height:{{data.social_height.md}}px;
                <# } else { #>
                    height:{{data.social_height}}px;
                    line-height:{{data.social_height}}px;
                <# }
                if(data.social_border_width) {
                #>
                    border-width:{{data.social_border_width}}px; 
                    border-style: solid;
                    border-color:{{data.social_border_color}};
                    border-radius:{{data.social_border_radius}}px;
                <# } #>
                color:{{data.social_text_color}};
            }
            #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon a:hover {
                color: {{data.social_hover_color}};
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
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-name,
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-name a {
                    <# if(_.isObject(data.content_name_fontsize)){ #>
                        font-size:{{data.content_name_fontsize.sm}}px;
                    <# } #>
                    <# if(_.isObject(data.content_name_margin)) { #>
                        margin:{{data.content_name_margin.sm}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-designation {
                    <# if(_.isObject(data.content_designation_fontsize)){ #>
                        font-size:{{data.content_designation_fontsize.sm}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon li {
                    <# if(_.isObject(data.social_margin)) { #>
                        margin:{{data.social_margin.sm}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon a {
                    <# if(_.isObject(data.social_fontsize)){ #>
                        font-size:{{data.social_fontsize.sm}}px;
                    <# }
                    if(_.isObject(data.social_width)) {
                    #>
                        width:{{data.social_width.sm}}px;
                    <# }
                    if(_.isObject(data.social_height)) {
                    #>
                        height:{{data.social_height.sm}}px;
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
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-name,
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-name a {
                    <# if(_.isObject(data.content_name_fontsize)){ #>
                        font-size:{{data.content_name_fontsize.xs}}px;
                    <# } #>
                    <# if(_.isObject(data.content_name_margin)) { #>
                        margin:{{data.content_name_margin.xs}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-designation {
                    <# if(_.isObject(data.content_designation_fontsize)){ #>
                        font-size:{{data.content_designation_fontsize.xs}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon li {
                    <# if(_.isObject(data.social_margin)) { #>
                        margin:{{data.social_margin.xs}};
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-carousel-extended-team-social-icon a {
                    <# if(_.isObject(data.social_fontsize)){ #>
                        font-size:{{data.social_fontsize.xs}}px;
                    <# }
                    if(_.isObject(data.social_width)) {
                    #>
                        width:{{data.social_width.xs}}px;
                    <# }
                    if(_.isObject(data.social_height)) {
                    #>
                        height:{{data.social_height.xs}}px;
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
        let carousel_item_number_sm = 2;
        let carousel_item_number_xs = 1;
        if(_.isObject(data.carousel_item_number)){
            carousel_item_number = data.carousel_item_number.md
            carousel_item_number_sm = data.carousel_item_number.sm
            carousel_item_number_xs = data.carousel_item_number.xs
        }
        #>
            <div class="sppb-addon sppb-carousel-extended {{data.class}} sppb-team-carousel-{{data.team_carousel_layout}}" data-left-arrow="{{left_arrow}}" data-right-arrow="{{right_arrow}}" data-arrow="{{data.carousel_arrow}}" data-dots="{{data.carousel_bullet}}" data-team-layout="{{data.team_carousel_layout}}" data-autoplay="{{data.carousel_autoplay}}" data-speed="{{data.carousel_speed}}" data-interval="{{data.carousel_interval}}" data-margin="{{data.carousel_margin}}" data-item-number="{{carousel_item_number || 3}}" data-item-number-sm="{{carousel_item_number_sm || 2}}" data-item-number-xs="{{carousel_item_number_xs || 1}}">
                <# if(_.isArray(data.sp_team_carousel_item)){
                    _.each(data.sp_team_carousel_item, function(carousel_item){
                        let content = "";
                        content += `<div class="sppb-carousel-extended-team-content sppb-carousel-${data.team_carousel_layout}">`;
                        var carouselImg = {}
                        if (typeof carousel_item.team_carousel_img !== "undefined" && typeof carousel_item.team_carousel_img.src !== "undefined") {
                            carouselImg = carousel_item.team_carousel_img
                        } else {
                            carouselImg = {src: carousel_item.team_carousel_img}
                        }
                        if(data.team_carousel_layout == "layout2"){
                            content += `<div class="sppb-carousel-extended-item-overlay"></div>`;
                        } 
                        content += `<div class="sppb-carousel-extended-team-content-wrap">`;
                            if(carousel_item.person_name){
                                content += `<div class="sppb-carousel-extended-team-name">`;
                                if(carousel_item.person_profile_link){
                                    content += `<a href="${carousel_item.person_profile_link}">`;
                                }
                                content += `${carousel_item.person_name}`;
                                if(carousel_item.person_profile_link){
                                    content += `</a>`;
                                }
                                content += `</div>`;
                            } 
                            if(carousel_item.person_designation) {
                                content += `<div class="sppb-carousel-extended-team-designation">${carousel_item.person_designation}</div>`;
                            }
                            if( _.isArray(carousel_item.team_carousel_item)){
                                content += `<ul class="sppb-carousel-extended-team-social-icon">`;
                                    _.each(carousel_item.team_carousel_item, function(inner_item_value){
                                        content += `<li>`;
                                        content += `<a target="_blank" rel="noopener noreferrer" href="${inner_item_value.social_url}" aria-label="${inner_item_value.title}"><i class="${inner_item_value.social_icon}" aria-hidden="true" title="${inner_item_value.title}"></i></a>`;
                                        content += `</li>`;
                                    })
                                content += `</ul>`;
                            }
                        content += `</div>`;
                        content += `</div>`;
                #>
                        <div class="sppb-carousel-extended-item">
                            <#
                            if(data.team_carousel_layout == "layout1"){
                                if(carouselImg.src && carouselImg.src?.indexOf("http://") == -1 && carouselImg.src?.indexOf("https://") == -1){

                                if(carousel_item.person_profile_link){
                                #>
                                    <a href=\'{{carousel_item.person_profile_link}}\'>
                                <# } #>
                                    <img src=\'{{ pagebuilder_base + carouselImg.src }}\' alt="{{ carousel_item.person_name }}">
                                <# if(carousel_item.person_profile_link){ #>
                                    </a>
                                <# } #>
                                <# } else if(carouselImg.src){
                                    if(carousel_item.person_profile_link){
                                #>
                                        <a href=\'{{carousel_item.person_profile_link}}\'>
                                    <# } #>
                                    <img src=\'{{ carouselImg.src }}\' alt="{{ carousel_item.person_name }}">
                                    <# if(carousel_item.person_profile_link){ #>
                                        </a>
                                    <# } #>
                                <# } #>
                                {{{content}}}
                            <# } else if(data.team_carousel_layout == "layout2") {
                                if(carouselImg.src && carouselImg.src?.indexOf("http://") == -1 && carouselImg.src?.indexOf("https://") == -1){
                                if(carousel_item.person_profile_link){
                                #>
                                    <a href=\'{{carousel_item.person_profile_link}}\'>
                                <# } #>
                                    <img src=\'{{ pagebuilder_base + carouselImg.src }}\' alt="{{ carousel_item.person_name }}">
                                <# if(carousel_item.person_profile_link){ #>
                                    </a>
                                <# } #>
                                <# } else if(carouselImg.src){
                                    if(carousel_item.person_profile_link){
                                    #>
                                        <a href=\'{{carousel_item.person_profile_link}}\'>
                                    <# } #>
                                    <img src=\'{{ carouselImg.src }}\' alt="{{ carousel_item.person_name }}">
                                    <# if(carousel_item.person_profile_link){ #>
                                        </a>
                                    <# } #>
                                <# } #>
                                    {{{content}}}
                            <# } else { #>
                                <div class="sppb-carousel-extended-team-wrap">
                                    <div class="sppb-carousel-extended-team-img">
                                        <# if(carouselImg.src && carouselImg.src?.indexOf("http://") == -1 && carouselImg.src?.indexOf("https://") == -1){
                                            if(carousel_item.person_profile_link){
                                            #>
                                                <a href=\'{{carousel_item.person_profile_link}}\'>
                                            <# } #>
                                            <img src=\'{{ pagebuilder_base + carouselImg.src }}\' alt="{{ carousel_item.person_name }}">
                                            <# if(carousel_item.person_profile_link){ #>
                                                </a>
                                            <# } #>
                                        <# } else if(carouselImg.src){
                                            if(carousel_item.person_profile_link){
                                            #>
                                                <a href=\'{{carousel_item.person_profile_link}}\'>
                                            <# } #>
                                            <img src=\'{{ carouselImg.src }}\' alt="{{ carousel_item.person_name }}">
                                            <# if(carousel_item.person_profile_link){ #>
                                                </a>
                                            <# } #>
                                        <# } #>
                                    </div>
                                    {{{content}}}
                                </div>
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
