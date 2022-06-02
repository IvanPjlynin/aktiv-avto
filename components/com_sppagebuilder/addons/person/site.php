<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonPerson extends SppagebuilderAddons{

	public function render() {
		
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';

		//Options
		$image = (isset($settings->image) && $settings->image) ? $settings->image : '';
		$image_src = isset($image->src) ? $image->src : $image;
		$image_width = (isset($image->width) && $image->width) ? $image->width : '';
		$image_height = (isset($image->height) && $image->height) ? $image->height : '';

		$name 				= (isset($settings->name) && $settings->name) ? $settings->name : '';
		$designation 	= (isset($settings->designation) && $settings->designation) ? $settings->designation : '';
		$email 				= (isset($settings->email) && $settings->email) ? $settings->email : '';
		$introtext 		= (isset($settings->introtext) && $settings->introtext) ? $settings->introtext : '';
		$facebook 		= (isset($settings->facebook) && $settings->facebook) ? $settings->facebook : '';
		$twitter 			= (isset($settings->twitter) && $settings->twitter) ? $settings->twitter : '';
		$google_plus 	= (isset($settings->google_plus) && $settings->google_plus) ? $settings->google_plus : '';
		$youtube 			= (isset($settings->youtube) && $settings->youtube) ? $settings->youtube : '';
		$linkedin 		= (isset($settings->linkedin) && $settings->linkedin) ? $settings->linkedin : '';
		$pinterest 		= (isset($settings->pinterest) && $settings->pinterest) ? $settings->pinterest : '';
		$flickr 			= (isset($settings->flickr) && $settings->flickr) ? $settings->flickr : '';
		$dribbble 		= (isset($settings->dribbble) && $settings->dribbble) ? $settings->dribbble : '';
		$behance 			= (isset($settings->behance) && $settings->behance) ? $settings->behance : '';
		$instagram 		= (isset($settings->instagram) && $settings->instagram) ? $settings->instagram : '';
		$social_position = (isset($settings->social_position) && $settings->social_position) ? $settings->social_position : '';
		$alignment 		= (isset($settings->alignment) && $settings->alignment) ? $settings->alignment : '';
		$person_style_preset 		= (isset($settings->person_style_preset) && $settings->person_style_preset) ? $settings->person_style_preset : '';
		$content_position = '';
		if($person_style_preset=='layout1'){
			$content_position = 'person-content-position-bottom-left';
		} elseif($person_style_preset=='layout2'){
			$content_position = 'person-content-position-half-overlay';
		} elseif($person_style_preset=='layout3'){
			$content_position = 'person-content-position-full-overlay';
		}
		//Lazyload image
		$placeholder = $image_src == '' ? false : $this->get_image_placeholder($image_src);
	
		if(strpos($image_src, "http://") !== false || strpos($image_src, "https://") !== false){
			$image_src = $image_src;
		} else {
			if($image_src){
				$image_src = JURI::base(true) . '/' . $image_src;
			}
		}
		
		//Output start
		$output = '';
		$social_icons = '';

		if($facebook || $twitter || $youtube || $linkedin || $pinterest || $flickr || $dribbble || $behance || $instagram) {
			$social_icons  	.= '<div class="sppb-person-social-icons">';
			$social_icons 	.= '<ul class="sppb-person-social">';

				if($facebook) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $facebook . '" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true" title="Facebook"></i></a></li>';
				if($twitter) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $twitter . '" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true" title="Twitter"></i></a></li>';
				if($youtube) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $youtube . '" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true" title="YouTube"></i></a></li>';
				if($linkedin) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $linkedin . '" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true" title="LinkedIn"></i></a></li>';
				if($pinterest) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $pinterest . '" aria-label="Pinterest"><i class="fab fa-pinterest" aria-hidden="true" title="Pinterest"></i></a></li>';
				if($flickr) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $flickr . '" aria-label="Flickr"><i class="fab fa-flickr" aria-hidden="true" title="Flickr"></i></a></li>';
				if($dribbble) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $dribbble . '" aria-label="Dribble"><i class="fab fa-dribbble" aria-hidden="true" title="Dribble"></i></a></li>';
				if($behance) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $behance . '" aria-label="Behance"><i class="fab fa-behance" aria-hidden="true" title="Behance"></i></a></li>';
				if($instagram) 		$social_icons .= '<li><a target="_blank" rel="noopener noreferrer" href="' . $instagram . '" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true" title="Instagram"></i></a></li>';
			
			$social_icons 	.= '</ul>';
			$social_icons 	.= '</div>';
		}

			$output  .= '<div class="sppb-addon sppb-addon-person ' . $alignment . ' ' . $class . ' '.$content_position.'">';
			$output  .= '<div class="sppb-addon-content">';
			if($person_style_preset=='layout4'){
				$output  .= '<div class="sppb-row sppb-no-gutter">';
					$output  .= '<div class="sppb-col-sm-5">';
			}
			if($image_src) {
					$output  .= '<div class="sppb-person-image '.($person_style_preset=='layout4'?'person-layout-4':'').'">';
					$output  .= '<img class="sppb-img-responsive'.($placeholder ? ' sppb-element-lazy' : '').'" src="' . ($placeholder ? $placeholder : $image_src) . '" alt="'. $name .'" '.($placeholder ? 'data-large="'.$image_src.'"' : '').' '.($image_width ? 'width="'.$image_width.'"' : '').' '.($image_height ? 'height="'.$image_height.'"' : '').' loading="lazy">';
					if($person_style_preset!==''){
						if($person_style_preset!=='layout4'){
							$output  .= '<div class="person-content-show-on-hover">';
							$output  .= '<div class="person-content-hover-content-wrap">';
							if($person_style_preset=='layout1'){
								if($social_position=='before') $output .= $social_icons;
								if($introtext) $output  .= '<div class="sppb-person-introtext">' . $introtext . '</div>';
								if($social_position=='after') $output .= $social_icons;
							}
							if($person_style_preset=='layout2' || $person_style_preset=='layout3'){
								if($name || $designation) {
									if($name) $output  .= '<span class="sppb-person-name">' . $name . '</span>';
									if($designation) $output  .= '<span class="sppb-person-designation">' . $designation . '</span>';
									if($social_icons) $output .= $social_icons;
								}
							}
							$output  .= '</div>';
							$output  .= '</div>';
						}
					}
					$output  .= '</div>';//.sppb-person-image
			}
			if($person_style_preset=='layout4'){
				$output  .= '</div>';
				$output  .= '<div class="sppb-col-sm-7">';
				$output  .= '<div class="sppb-person-addon-content-wrap">';
			}
			if($person_style_preset !=='layout2' && $person_style_preset !=='layout3') {
				if($name || $designation || $email) {
					$output  .= '<div class="sppb-person-information">';
					if($name) $output  .= '<span class="sppb-person-name">' . $name . '</span>';
					if($designation) $output  .= '<span class="sppb-person-designation">' . $designation . '</span>';
					if($email) $output  .= '<a href="mailto:' . $email . '" class="sppb-person-email">' . $email . '</a>';
					$output  .= '</div>';
				}
			}

			if($person_style_preset !=='layout1' && $person_style_preset !=='layout2' && $person_style_preset !=='layout3'){
				if($social_position=='before') $output .= $social_icons;
				if($introtext) $output  .= '<div class="sppb-person-introtext">' . $introtext . '</div>';
				if($social_position=='after') $output .= $social_icons;
			}
			if($person_style_preset=='layout4'){
				$output  .= '</div>';
				$output  .= '</div>';
			$output  .= '</div>';
			}
			$output  .= '</div>';
			$output  .= '</div>';

			return $output;
	}

	public function css() {
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' . $this->addon->id;

		$border_radius = (isset($settings->image_border_radius) && $settings->image_border_radius) ? 'border-radius:' . $settings->image_border_radius . 'px' : '';

		//Overlay
		$content_overlay_type = (isset($settings->content_overlay_type) && $settings->content_overlay_type) ? $settings->content_overlay_type : '';
		$content_overlay_color = (isset($settings->content_overlay_color) && $settings->content_overlay_color) ? $settings->content_overlay_color : '';
		//Gradient overlay
		$content_overlay_gradient = (isset($settings->content_overlay_gradient) && $settings->content_overlay_gradient) ? $settings->content_overlay_gradient : '';
		$gradient_color1 = (isset($content_overlay_gradient->color) && $content_overlay_gradient->color) ? $content_overlay_gradient->color : 'rgba(127, 0, 255, 0.8)';
		$gradient_color2 = (isset($content_overlay_gradient->color2) && $content_overlay_gradient->color2) ? $content_overlay_gradient->color2 : 'rgba(225, 0, 255, 0.7)';
		$gradient_degree = (isset($content_overlay_gradient->deg) && $content_overlay_gradient->deg) ? $content_overlay_gradient->deg : '';
		$gradient_type = (isset($content_overlay_gradient->type) && $content_overlay_gradient->type) ? $content_overlay_gradient->type : 'linear';
		$gradient_radialPos = (isset($content_overlay_gradient->radialPos) && $content_overlay_gradient->radialPos) ? $content_overlay_gradient->radialPos : 'Center Center';
		$gradient_radial_angle1 = (isset($content_overlay_gradient->pos) && $content_overlay_gradient->pos) ? $content_overlay_gradient->pos : '0';
		$gradient_radial_angle2 = (isset($content_overlay_gradient->pos2) && $content_overlay_gradient->pos2) ? $content_overlay_gradient->pos2 : '100';
		//Css start
		$css = '';
		if($content_overlay_type !== "none") {
			if($content_overlay_color && $content_overlay_type !== 'gradient'){
				$css .= $addon_id . ' .person-content-show-on-hover {';
					$css .= 'background:'.$content_overlay_color.';';
				$css .='}';
			}
			if($content_overlay_gradient && $content_overlay_type !== 'color'){
				$css .= $addon_id . ' .person-content-show-on-hover {';
					if($gradient_type!=='radial'){
						$css .= 'background: -webkit-linear-gradient('.$gradient_degree.'deg, '.$gradient_color1.' '.$gradient_radial_angle1.'%, '.$gradient_color2.' '.$gradient_radial_angle2.'%) transparent;';
						$css .= 'background: linear-gradient('.$gradient_degree.'deg, '.$gradient_color1.' '.$gradient_radial_angle1.'%, '.$gradient_color2.' '.$gradient_radial_angle2.'%) transparent;';
					} else {
						$css .= 'background: -webkit-radial-gradient(at '.$hover_radialPos.', '.$gradient_color1.' '.$gradient_radial_angle1.'%, '.$gradient_color2.' '.$gradient_radial_angle2.'%) transparent;';
						$css .= 'background: radial-gradient(at '.$hover_radialPos.', '.$gradient_color1.' '.$gradient_radial_angle1.'%, '.$gradient_color2.' '.$gradient_radial_angle2.'%) transparent;';
					}
				$css .='}';
			}
		}
		if($border_radius) {
			$css .= $addon_id . ' .sppb-person-image img {';
			$css .= $border_radius;
			$css .= "\n" . '}' . "\n"	;
		}
		//Preset style
		$person_style_preset = (isset($settings->person_style_preset) && $settings->person_style_preset) ? $settings->person_style_preset : '';
		$name_desig_bg = (isset($settings->name_desig_bg) && $settings->name_desig_bg) ? $settings->name_desig_bg : '';
		$name_desig_padding = (isset($settings->name_desig_padding) && trim($settings->name_desig_padding)) ? $settings->name_desig_padding : '';
		if($person_style_preset=='layout1'){
			if($name_desig_bg || $name_desig_padding) {
				$css .= $addon_id . ' .person-content-position-bottom-left .sppb-person-information {';
				$css .= 'background:'.$name_desig_bg.';';
				$css .= 'padding:'.$name_desig_padding.';';
				$css .= '}';
			}
		}
		//Name style
		$name_color = (isset($settings->name_color) && $settings->name_color) ? 'color:' . $settings->name_color : '';
		$name_style = '';
		$name_style .= (isset($settings->name_fontsize) && $settings->name_fontsize) ? 'font-size:' . $settings->name_fontsize. 'px;' : '';
		$name_style .= (isset($settings->name_lineheight) && $settings->name_lineheight) ? 'line-height:' . $settings->name_lineheight. 'px;' : '';
		$name_style .= (isset($settings->name_letterspace) && $settings->name_letterspace) ? 'letter-spacing:' . $settings->name_letterspace. ';' : '';
		$name_font_style = (isset($settings->name_font_style) && $settings->name_font_style) ?  $settings->name_font_style : '';
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
		if($name_color || $name_style) {
			$css .= $addon_id . ' .sppb-person-name {';
			$css .= $name_color.';';
			$css .= $name_style;
			$css .= '}';
		}
		//Designation style
		$designation_color = (isset($settings->designation_color) && $settings->designation_color) ? 'color:' . $settings->designation_color : '';
		$designation_style = '';
		$designation_style .= (isset($settings->designation_fontsize) && $settings->designation_fontsize) ? 'font-size:' . $settings->designation_fontsize. 'px;' : '';
		$designation_style .= (isset($settings->designation_lineheight) && $settings->designation_lineheight) ? 'line-height:' . $settings->designation_lineheight. 'px;' : '';
		$designation_style .= (isset($settings->designation_letterspace) && $settings->designation_letterspace) ? 'letter-spacing:' . $settings->designation_letterspace. ';' : '';
		$designation_style .= (isset($settings->designation_margin) && trim($settings->designation_margin)) ? 'margin:' . $settings->designation_margin. ';' : '';
		$designation_font_style = (isset($settings->designation_font_style) && $settings->designation_font_style) ?  $settings->designation_font_style : '';
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
		if($designation_color || $designation_style) {
			$css .= $addon_id . ' .sppb-person-designation {';
			$css .= $designation_color.';';
			$css .= $designation_style;
			$css .= '}';
		}
		//Introtext style
		$introtext_style = '';
		$introtext_style .= (isset($settings->introtext_color) && $settings->introtext_color) ? 'color:' . $settings->introtext_color.';' : '';
		$introtext_style .= (isset($settings->introtext_fontsize) && $settings->introtext_fontsize) ? 'font-size:' . $settings->introtext_fontsize.'px;' : '';
		$introtext_style .= (isset($settings->introtext_lineheight) && $settings->introtext_lineheight) ? 'line-height:' . $settings->introtext_lineheight.'px;' : '';
		if($introtext_style) {
			$css .= $addon_id . ' .sppb-person-introtext {';
			$css .= $introtext_style;
			$css .= '}';
		}
		//Social Icon style
		$social_icon_style = '';
		$social_icon_style .= (isset($settings->social_icon_color) && $settings->social_icon_color) ? 'color:' . $settings->social_icon_color.';' : '';
		$social_icon_style .= (isset($settings->social_icon_fontsize) && $settings->social_icon_fontsize) ? 'font-size:' . $settings->social_icon_fontsize.'px;' : '';
		if($social_icon_style) {
			$css .= $addon_id . ' .sppb-person-social > li > a {';
				$css .= $social_icon_style;
			$css .= '}';
		}
		$social_icon_margin = (isset($settings->social_icon_margin) && trim($settings->social_icon_margin)) ? 'margin:' . $settings->social_icon_margin.';' : '';
		if($social_icon_margin) {
			$css .= $addon_id . ' .sppb-person-social > li {';
			$css .= $social_icon_margin;
			$css .= '}';
		}
		$social_icon_hover_color = (isset($settings->social_icon_hover_color) && $settings->social_icon_hover_color) ? 'color:' . $settings->social_icon_hover_color.';' : '';
		if($social_icon_hover_color) {
			$css .= $addon_id . ' .sppb-person-social > li > a:hover {';
			$css .= $social_icon_hover_color;
			$css .= '}';
		}
		//Layout 4 content style
		$person_content_syle = '';
		$person_content_syle .= (isset($settings->person_content_bg) && $settings->person_content_bg) ? 'background:' . $settings->person_content_bg.';' : '';
		$person_content_syle .= (isset($settings->person_content_padding) && $settings->person_content_padding) ? 'padding:' . $settings->person_content_padding.';' : '';
		if($person_content_syle) {
			$css .= $addon_id . ' .sppb-person-addon-content-wrap {';
			$css .= $person_content_syle;
			$css .= '}';
		}
		//Table style
		//Name
		$name_style_sm = '';
		$name_style_sm .= (isset($settings->name_fontsize_sm) && $settings->name_fontsize_sm) ? 'font-size:' . $settings->name_fontsize_sm. 'px;' : '';
		$name_style_sm .= (isset($settings->name_lineheight_sm) && $settings->name_lineheight_sm) ? 'line-height:' . $settings->name_lineheight_sm. 'px;' : '';
		//Designation
		$designation_style_sm = '';
		$designation_style_sm .= (isset($settings->designation_fontsize_sm) && $settings->designation_fontsize_sm) ? 'font-size:' . $settings->designation_fontsize_sm. 'px;' : '';
		$designation_style_sm .= (isset($settings->designation_lineheight_sm) && $settings->designation_lineheight_sm) ? 'line-height:' . $settings->designation_lineheight_sm. 'px;' : '';
		$designation_style_sm .= (isset($settings->designation_margin_sm) && trim($settings->designation_margin_sm)) ? 'margin:' . $settings->designation_margin_sm. ';' : '';
		//Introtext
		$introtext_style_sm = '';
		$introtext_style_sm .= (isset($settings->introtext_fontsize_sm) && $settings->introtext_fontsize_sm) ? 'font-size:' . $settings->introtext_fontsize_sm.'px;' : '';
		$introtext_style_sm .= (isset($settings->introtext_lineheight_sm) && $settings->introtext_lineheight_sm) ? 'line-height:' . $settings->introtext_lineheight_sm.'px;' : '';
		//Social Icon
		$social_icon_margin_sm = (isset($settings->social_icon_margin_sm) && trim($settings->social_icon_margin_sm)) ? 'margin:' . $settings->social_icon_margin_sm.';' : '';
		//Layout 4 content style
		$person_content_padding_sm = (isset($settings->person_content_padding_sm) && $settings->person_content_padding_sm) ? 'padding:' . $settings->person_content_padding_sm.';' : '';
		
		if ($name_style_sm || $designation_style_sm || $introtext_style_sm || $social_icon_margin_sm || $person_content_padding_sm) {
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
				$css .= $addon_id . ' .sppb-person-name {' . $name_style_sm . '}';
				if($designation_style_sm) {
					$css .= $addon_id . ' .sppb-person-designation {';
					$css .= $designation_style_sm;
					$css .= '}';
				}
				if($introtext_style_sm) {
					$css .= $addon_id . ' .sppb-person-introtext {';
					$css .= $introtext_style_sm;
					$css .= '}';
				}
				if($social_icon_margin_sm) {
					$css .= $addon_id . ' .sppb-person-social > li {';
					$css .= $social_icon_margin_sm;
					$css .= '}';
				}
				if($person_content_padding_sm) {
					$css .= $addon_id . ' .sppb-person-addon-content-wrap {';
					$css .= $person_content_padding_sm;
					$css .= '}';
				}
            $css .= '}';
		}
		//Mobile Style
		//Name
		$name_style_xs = '';
		$name_style_xs .= (isset($settings->name_fontsize_xs) && $settings->name_fontsize_xs) ? 'font-size:' . $settings->name_fontsize_xs. 'px;' : '';
		$name_style_xs .= (isset($settings->name_lineheight_xs) && $settings->name_lineheight_xs) ? 'line-height:' . $settings->name_lineheight_xs. 'px;' : '';
		//Designation
		$designation_style_xs = '';
		$designation_style_xs .= (isset($settings->designation_fontsize_xs) && $settings->designation_fontsize_xs) ? 'font-size:' . $settings->designation_fontsize_xs. 'px;' : '';
		$designation_style_xs .= (isset($settings->designation_lineheight_xs) && $settings->designation_lineheight_xs) ? 'line-height:' . $settings->designation_lineheight_xs. 'px;' : '';
		$designation_style_xs .= (isset($settings->designation_margin_xs) && trim($settings->designation_margin_xs)) ? 'margin:' . $settings->designation_margin_xs. ';' : '';
		//Introtext
		$introtext_style_xs = '';
		$introtext_style_xs .= (isset($settings->introtext_fontsize_xs) && $settings->introtext_fontsize_xs) ? 'font-size:' . $settings->introtext_fontsize_xs.'px;' : '';
		$introtext_style_xs .= (isset($settings->introtext_lineheight_xs) && $settings->introtext_lineheight_xs) ? 'line-height:' . $settings->introtext_lineheight_xs.'px;' : '';
		//Social Icon
		$social_icon_margin_xs = (isset($settings->social_icon_margin_xs) && trim($settings->social_icon_margin_xs)) ? 'margin:' . $settings->social_icon_margin_xs.';' : '';
		//Layout 4 content style
		$person_content_padding_xs = (isset($settings->person_content_padding_xs) && $settings->person_content_padding_xs) ? 'padding:' . $settings->person_content_padding_xs.';' : '';

        if ($name_style_xs || $designation_style_xs || $introtext_style_xs || $person_content_padding_xs) {
            $css .= '@media (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-person-name {' . $name_style_xs . '}';
				if($designation_style_xs) {
					$css .= $addon_id . ' .sppb-person-designation {';
					$css .= $designation_style_xs;
					$css .= '}';
				}
				if($introtext_style_xs) {
					$css .= $addon_id . ' .sppb-person-introtext {';
					$css .= $introtext_style_xs;
					$css .= '}';
				}
				if($social_icon_margin_xs) {
					$css .= $addon_id . ' .sppb-person-social > li {';
					$css .= $social_icon_margin_xs;
					$css .= '}';
				}
				if($person_content_padding_xs) {
					$css .= $addon_id . ' .sppb-person-addon-content-wrap {';
					$css .= $person_content_padding_xs;
					$css .= '}';
				}
            $css .= '}';
        }
		return $css;
	}

	public static function getTemplate(){

		$output ='
			<style type="text/css">
				<# 
				let gradient_color1 = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.color) ? data.content_overlay_gradient.color : "rgba(127, 0, 255, 0.8)";
				let gradient_color2 = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.color2) ? data.content_overlay_gradient.color2 : "rgba(225, 0, 255, 0.7)";
				let gradient_degree = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.deg) ? data.content_overlay_gradient.deg : "";
				let gradient_type = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.type) ? data.content_overlay_gradient.type : "linear";
				let gradient_radialPos = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.radialPos) ? data.content_overlay_gradient.radialPos : "Center Center";
				let gradient_radial_angle1 = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.pos) ? data.content_overlay_gradient.pos : "0";
				let gradient_radial_angle2 = (!_.isEmpty(data.content_overlay_gradient) && data.content_overlay_gradient.pos2) ? data.content_overlay_gradient.pos2 : "100";

				if(data.content_overlay_type !== "none") {
					if(data.content_overlay_color && data.content_overlay_type !== "gradient"){
				#>
						#sppb-addon-{{ data.id }} .person-content-show-on-hover {
							background:{{data.content_overlay_color}};
						}
					<# }
					if(data.content_overlay_gradient && data.content_overlay_type !== "color"){
					#>
						#sppb-addon-{{ data.id }} .person-content-show-on-hover {
							<# if(gradient_type !== "radial"){ #>
								background: -webkit-linear-gradient({{gradient_degree}}deg, {{gradient_color1}} {{gradient_radial_angle1}}%, {{gradient_color2}} {{gradient_radial_angle2}}%) transparent;
								background: linear-gradient({{gradient_degree}}deg, {{gradient_color1}} {{gradient_radial_angle1}}%, {{gradient_color2}} {{gradient_radial_angle2}}%) transparent;
							<# } else { #>
								background: -webkit-radial-gradient(at {{hover_radialPos}}, {{gradient_color1}} {{gradient_radial_angle1}}%, {{gradient_color2}} {{gradient_radial_angle2}}%) transparent;
								background: radial-gradient(at {{hover_radialPos}}, {{gradient_color1}} {{gradient_radial_angle1}}%, {{gradient_color2}} {{gradient_radial_angle2}}%) transparent;
							<# } #>
						}
					<# } #>
				<# } #>
				<# if(data.image_border_radius) { #>
					#sppb-addon-{{ data.id }} .sppb-person-image img {
						border-radius: {{data.image_border_radius}}px;
					}
				<# } #>

				#sppb-addon-{{ data.id }} .sppb-person-name {
					<# if(data.name_color) { #>
						color: {{data.name_color}};
					<# }
					if(data.name_letterspace) {
					#>
						letter-spacing: {{data.name_letterspace}};
					<# }
					if(_.isObject(data.name_fontsize)) {
					#>
						font-size: {{data.name_fontsize.md}}px;
					<# } else { #>
						font-size: {{data.name_fontsize}}px;
					<# }
					if(_.isObject(data.name_lineheight)) {
					#>
						line-height: {{data.name_lineheight.md}}px;
					<# } else { #>
						line-height: {{data.name_lineheight}}px;
					<# }
					if(_.isObject(data.name_font_style)){
						if(data.name_font_style.underline){
					#>
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
						<# }
					} #>
				}
				
				#sppb-addon-{{ data.id }} .sppb-person-designation {
					<# if(data.designation_color) { #>
						color: {{data.designation_color}};
					<# } 
					if(data.designation_letterspace) { #>
						letter-spacing: {{data.designation_letterspace}};
					<# } 
					if(_.isObject(data.designation_fontsize)) { #>
						font-size: {{data.designation_fontsize.md}}px;
					<# } else { #>
						font-size: {{data.designation_fontsize}}px;
					<# }
					if(_.isObject(data.designation_lineheight)) { #>
						line-height: {{data.designation_lineheight.md}}px;
					<# } else { #>
						line-height: {{data.designation_lineheight}}px;
					<# }
					if(_.isObject(data.designation_margin)) { #>
						margin: {{data.designation_margin.md}};
					<# } else { #>
						margin: {{data.designation_margin}};
					<# }
					if(_.isObject(data.designation_font_style)) {
						if(data.designation_font_style.underline){ #>
							text-decoration:underline;
						<# }
						if(data.designation_font_style.italic){ #>
							font-style:italic;
						<# }
						if(data.designation_font_style.uppercase){ #>
							text-transform:uppercase;
						<# }
						if(data.designation_font_style.weight){ #>
							font-weight:{{data.designation_font_style.weight}};
						<# }
					} #>
				}
				#sppb-addon-{{ data.id }} .sppb-person-introtext {
					color:{{data.introtext_color}};
					<# if(_.isObject(data.introtext_fontsize)) { #>
						font-size:{{data.introtext_fontsize.md}}px;
					<# } else { #>
						font-size:{{data.introtext_fontsize}}px;
					<# } 
					if(_.isObject(data.introtext_lineheight)){ 
					#>
						line-height:{{data.introtext_lineheight.md}}px;
					<# } else { #>
						line-height:{{data.introtext_lineheight}}px;
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-person-social > li > a {
					color:{{data.social_icon_color}};
					font-size:{{data.social_icon_fontsize}}px;
				}
				#sppb-addon-{{ data.id }} .sppb-person-social > li {
					<# if(_.isObject(data.social_icon_margin)){ #>
						margin:{{data.social_icon_margin.md}};
					<# } else { #>
						margin:{{data.social_icon_margin}};
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sppb-person-social > li > a:hover {
					color:{{data.social_icon_hover_color}};
				}
				<# if(data.person_style_preset=="layout1"){ #>
					<# if(data.name_desig_bg || data.name_desig_padding) { #>
						#sppb-addon-{{ data.id }} .person-content-position-bottom-left .sppb-person-information {
							background:{{data.name_desig_bg}};
							padding:{{data.name_desig_padding}};
						}
					<# }
				}
				if(data.person_style_preset=="layout4") {
				#>
					#sppb-addon-{{ data.id }} .sppb-person-addon-content-wrap {
						background: {{data.person_content_bg}};
						<# if(_.isObject(data.person_content_padding)){ #>
							padding: {{data.person_content_padding.md}};
						<# } else { #>
							padding: {{data.person_content_padding}};
						<# } #>
					}
				<# } #>

				@media (min-width: 768px) and (max-width: 991px) {
					#sppb-addon-{{ data.id }} .sppb-person-name {
						<# if(_.isObject(data.name_fontsize)){ #>
							font-size: {{data.name_fontsize.sm}}px;
						<# } #>
						<# if(_.isObject(data.name_lineheight)){ #>
							line-height: {{data.name_lineheight.sm}}px;
						<# } #>
					}
					#sppb-addon-{{ data.id }} .sppb-person-designation {
						<# if(_.isObject(data.designation_fontsize)) { #>
							font-size: {{data.designation_fontsize.sm}}px;
						<# } 
						if(_.isObject(data.designation_lineheight)) {
						#>
							line-height: {{data.designation_lineheight.sm}}px;
						<# }
						if(_.isObject(data.designation_margin)) {
						#>
							margin: {{data.designation_margin.sm}};
						<# } #>
					}
					#sppb-addon-{{ data.id }} .sppb-person-introtext {
						<# if(_.isObject(data.introtext_fontsize)) { #>
							font-size:{{data.introtext_fontsize.sm}}px;
						<# }
						if(_.isObject(data.introtext_lineheight)){ 
						#>
							line-height:{{data.introtext_lineheight.sm}}px;
						<# } #>
					}
					#sppb-addon-{{ data.id }} .sppb-person-social > li {
						<# if(_.isObject(data.social_icon_margin)){ #>
							margin:{{data.social_icon_margin.sm}};
						<# } #>
					}
					<# if(data.person_style_preset=="layout4") { #>
						#sppb-addon-{{ data.id }} .sppb-person-addon-content-wrap {
							<# if(_.isObject(data.person_content_padding)){ #>
								padding: {{data.person_content_padding.sm}};
							<# } #>
						}
					<# } #>
				}
				@media (max-width: 767px) {
					#sppb-addon-{{ data.id }} .sppb-person-name {
						<# if(_.isObject(data.name_fontsize)){ #>
							font-size: {{data.name_fontsize.xs}}px;
						<# } #>
						<# if(_.isObject(data.name_lineheight)){ #>
							line-height: {{data.name_lineheight.xs}}px;
						<# } #>
					}
					#sppb-addon-{{ data.id }} .sppb-person-designation {
						<# if(_.isObject(data.designation_fontsize)) { #>
							font-size: {{data.designation_fontsize.xs}}px;
						<# } 
						if(_.isObject(data.designation_lineheight)) {
						#>
							line-height: {{data.designation_lineheight.xs}}px;
						<# }
						if(_.isObject(data.designation_margin)) {
						#>
							margin: {{data.designation_margin.xs}};
						<# } #>
					}
					#sppb-addon-{{ data.id }} .sppb-person-introtext {
						<# if(_.isObject(data.introtext_fontsize)) { #>
							font-size:{{data.introtext_fontsize.xs}}px;
						<# }
						if(_.isObject(data.introtext_lineheight)){ 
						#>
							line-height:{{data.introtext_lineheight.xs}}px;
						<# } #>
					}
					#sppb-addon-{{ data.id }} .sppb-person-social > li {
						<# if(_.isObject(data.social_icon_margin)){ #>
							margin:{{data.social_icon_margin.xs}};
						<# } #>
					}
					<# if(data.person_style_preset=="layout4") { #>
						#sppb-addon-{{ data.id }} .sppb-person-addon-content-wrap {
							<# if(_.isObject(data.person_content_padding)){ #>
								padding: {{data.person_content_padding.xs}};
							<# } #>
						}
					<# } #>
				}
			</style>
			<#
			let content_position = "";
			if(data.person_style_preset=="layout1"){
				content_position = "person-content-position-bottom-left";
			} else if(data.person_style_preset=="layout2"){
				content_position = "person-content-position-half-overlay";
			} else if(data.person_style_preset=="layout3"){
				content_position = "person-content-position-full-overlay";
			}

			let social_icon_list = "";
			if (!_.isEmpty(data.facebook)) {
				social_icon_list += `<li><a target="_blank" href="${data.facebook}"><i class="fab fa-facebook-f"></i></a></li>`;
			}
			if (!_.isEmpty(data.twitter)) {
				social_icon_list += `<li><a target="_blank" href="${data.twitter}"><i class="fab fa-twitter"></i></a></li>`;
			}
			if (!_.isEmpty(data.youtube)) {
				social_icon_list += `<li><a target="_blank" href="${data.youtube}"><i class="fab fa-youtube"></i></a></li>`;
			}
			if (!_.isEmpty(data.linkedin)) {
				social_icon_list += `<li><a target="_blank" href="${data.linkedin}"><i class="fab fa-linkedin-in"></i></a></li>`;
			}
			if (!_.isEmpty(data.pinterest)) {
				social_icon_list += `<li><a target="_blank" href="${data.pinterest}"><i class="fab fa-pinterest"></i></a></li>`;
			}
			if (!_.isEmpty(data.flickr)) {
				social_icon_list += `<li><a target="_blank" href="${data.flickr}"><i class="fab fa-flickr"></i></a></li>`;
			}
			if (!_.isEmpty(data.dribbble)) {
				social_icon_list += `<li><a target="_blank" href="${data.dribbble}"><i class="fab fa-dribbble"></i></a></li>`;
			}
			if (!_.isEmpty(data.behance)) {
				social_icon_list += `<li><a target="_blank" href="${data.behance}"><i class="fab fa-behance"></i></a></li>`;
			}
			if (!_.isEmpty(data.instagram)) {
				social_icon_list += `<li><a target="_blank" href="${data.instagram}"><i class="fab fa-instagram"></i></a></li>`;
			}
			#>
			<div class="sppb-addon sppb-addon-person {{ data.alignment }} {{ data.class}} {{content_position}}">
				<div class="sppb-addon-content">
				<# if(data.person_style_preset=="layout4"){ #>
					<div class="sppb-row sppb-no-gutter">
						<div class="sppb-col-sm-5">
				<# }
				var personImg = {}
				if (typeof data.image !== "undefined" && typeof data.image.src !== "undefined") {
					personImg = data.image
				} else {
					personImg = {src: data.image}
				}
				if(!_.isEmpty(personImg.src)) {
				#>
					<div class="sppb-person-image <# if(data.person_style_preset=="layout4"){ #> person-layout-4 <# } #>">
						<# if(personImg.src?.indexOf("https://") == -1 && personImg.src?.indexOf("http://") == -1){ #>
							<img class="sppb-img-responsive" src=\'{{ pagebuilder_base + personImg.src }}\' alt="{{ data.name }}">
						<# } else { #>
							<img class="sppb-img-responsive" src=\'{{ personImg.src }}\' alt="{{ data.name }}">
						<# } #>

						<# if(data.person_style_preset!=="") {
							if(data.person_style_preset!=="layout4"){
						#>
							<div class="person-content-show-on-hover">
							<div class="person-content-hover-content-wrap">
							<# if(data.person_style_preset=="layout1") { #>
								<# if(data.social_position == "after") { #>
									<# if(!_.isEmpty(data.introtext)) { #>
										<div class="sppb-person-introtext sp-inline-editable-element" data-id={{data.id}} data-fieldName="introtext" contenteditable="true">{{ data.introtext }}</div>
									<# } #>
								<# } #>
			
								<# if ( data.facebook || data.twitter || data.youtube || data.linkedin || data.pinterest || data.flickr || data.dribbble || data.behance || data.instagram ) { #>
									<div class="sppb-person-social-icons">
										<ul class="sppb-person-social">
											{{{social_icon_list}}}
										</ul>
									</div>
								<# } #>
			
								<# if(data.social_position == "before") { #>
									<# if(!_.isEmpty(data.introtext)) { #>
										<div class="sppb-person-introtext">{{{ data.introtext }}}</div>
									<# } #>
								<# } #>
							<# } #>

							<# if(data.person_style_preset=="layout2" || data.person_style_preset=="layout3"){ #>
								<# if(data.name || data.designation){ #>
									<# if(!_.isEmpty(data.name)) { #>
										<span class="sppb-person-name sp-inline-editable-element" data-id={{data.id}} data-fieldName="name" contenteditable="true">{{ data.name}}</span>
									<# } #>
									<# if(!_.isEmpty(data.designation)) { #>
										<span class="sppb-person-designation sp-inline-editable-element" data-id={{data.id}} data-fieldName="designation" contenteditable="true">{{ data.designation}}</span>
									<# } #>
									<# if ( data.facebook || data.twitter || data.youtube || data.linkedin || data.pinterest || data.flickr || data.dribbble || data.behance || data.instagram ) { #>
										<div class="sppb-person-social-icons">
											<ul class="sppb-person-social">
												{{{social_icon_list}}}
											</ul>
										</div>
									<# } #>
								<# } #>
							<# } #>
							
							</div>
							</div>
							<# }
						} #>
					</div>
				<# }
				if(data.person_style_preset=="layout4"){
				#>
					</div>
					<div class="sppb-col-sm-7">
					<div class="sppb-person-addon-content-wrap">
				<# }
				if(data.person_style_preset!=="layout2" && data.person_style_preset!=="layout3"){
				#>
					<# if(data.name || data.designation || data.email ){ #>
						<div class="sppb-person-information">
							<# if(!_.isEmpty(data.name)) { #>
								<span class="sppb-person-name sp-inline-editable-element" data-id={{data.id}} data-fieldName="name" contenteditable="true">{{ data.name}}</span>
							<# } #>
							<# if(!_.isEmpty(data.designation)) { #>
								<span class="sppb-person-designation sp-inline-editable-element" data-id={{data.id}} data-fieldName="designation" contenteditable="true">{{ data.designation}}</span>
							<# } #>
							<# if(!_.isEmpty(data.email)) { #>
								<a href="mailto:{{ data.email}}" class="sppb-person-email">{{ data.email}}</a>
							<# } #>
						</div>
					<# } #>
				<# } #>

				<# if(data.person_style_preset!=="layout1" && data.person_style_preset!=="layout2" && data.person_style_preset!=="layout3") { #>
					<# if(data.social_position == "after") { #>
						<# if(!_.isEmpty(data.introtext)) { #>
							<div class="sppb-person-introtext sp-inline-editable-element" data-id={{data.id}} data-fieldName="introtext" contenteditable="true">{{ data.introtext }}</div>
						<# } #>
					<# } #>

					<# if ( data.facebook || data.twitter || data.youtube || data.linkedin || data.pinterest || data.flickr || data.dribbble || data.behance || data.instagram ) { #>
						<div class="sppb-person-social-icons">
						<ul class="sppb-person-social">
							{{{social_icon_list}}}
						</ul>
						</div>
					<# } #>

					<# if(data.social_position == "before") { #>
						<# if(!_.isEmpty(data.introtext)) { #>
							<div class="sppb-person-introtext">{{{ data.introtext }}}</div>
						<# } #>
					<# } #>
				<# }
				if(data.person_style_preset=="layout4"){
				#>
					</div>
					</div>
				</div>
				<# } #>
				</div>
			</div>
			';

			return $output;
	}

}
