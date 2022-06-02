<?php
/**
 * @package SP Page Builder
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted access');

class SppagebuilderAddonJs_slideshow extends SppagebuilderAddons {

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? '' . $settings->class : '';
		$slide_vertically = (isset($settings->slide_vertically) && $settings->slide_vertically) ? $settings->slide_vertically : 0;
		$three_d_rotate = (isset($settings->three_d_rotate) && gettype($settings->three_d_rotate) == 'string') ? $settings->three_d_rotate : '';
		$autoplay = (isset($settings->autoplay) && $settings->autoplay) ? $settings->autoplay : '';
		$pause_on_hover = (isset($settings->pause_on_hover) && $settings->pause_on_hover) ? $settings->pause_on_hover : '';
		$interval = (isset($settings->interval) && $settings->interval) ? $settings->interval : 5;
		$speed = (isset($settings->speed) && $settings->speed) ? $settings->speed : '';
		$content_container_option = (isset($settings->content_container_option) && $settings->content_container_option) ? $settings->content_container_option : '';
		//Height
		$height = (isset($settings->height) && $settings->height) ? $settings->height : '';
		$custom_height = (isset($settings->custom_height) && $settings->custom_height) ? $settings->custom_height.'px' : '';
		$custom_height_sm = (isset($settings->custom_height_sm) && $settings->custom_height_sm) ? $settings->custom_height_sm.'px' : '';
		$custom_height_xs = (isset($settings->custom_height_xs) && $settings->custom_height_xs) ? $settings->custom_height_xs.'px' : '';
		$slider_animation = (isset($settings->slider_animation) && $settings->slider_animation) ? $settings->slider_animation : '';
		//Verticle slide
		$dataVerticleSlide = '';
		if($slider_animation === 'stack'){
			$dataVerticleSlide = 'data-slide-vertically="'.($slide_vertically ? 'true' : 'false').'"';
		}
		//3D rotate
		$data_three_d_rotate = '';
		if($slider_animation === '3D'){
			$data_three_d_rotate = 'data-3d-rotate="'.($three_d_rotate ? $three_d_rotate : '15').'"';
		}
		//Timer
		$timer = (isset($settings->timer) && $settings->timer) ? $settings->timer : '';
		//Slide counter
		$slide_counter = (isset($settings->slide_counter) && $settings->slide_counter) ? $settings->slide_counter : '';
		//Dot
		$dot_controllers = (isset($settings->dot_controllers) && $settings->dot_controllers) ? $settings->dot_controllers : '';
		$dot_controllers_style = (isset($settings->dot_controllers_style) && $settings->dot_controllers_style) ? $settings->dot_controllers_style : '';
		$dot_controllers_position = (isset($settings->dot_controllers_position) && $settings->dot_controllers_position) ? $settings->dot_controllers_position : '';
		//Arrow
		$arrow_controllers = (isset($settings->arrow_controllers) && $settings->arrow_controllers) ? $settings->arrow_controllers : '';
		$arrow_controllers_content = (isset($settings->arrow_controllers_content) && $settings->arrow_controllers_content) ? $settings->arrow_controllers_content : '';
		$arrow_controllers_style = (isset($settings->arrow_controllers_style) && $settings->arrow_controllers_style) ? $settings->arrow_controllers_style : '';
		$arrow_controllers_position = (isset($settings->arrow_controllers_position) && $settings->arrow_controllers_position) ? $settings->arrow_controllers_position : '';
		$arrow_on_hover = (isset($settings->arrow_on_hover) && $settings->arrow_on_hover) ? $settings->arrow_on_hover : '';
		//Line
		$line_indecator = (isset($settings->line_indecator) && $settings->line_indecator) ? $settings->line_indecator : '';

		//Height calculate
		$slider_height = '';
		$slider_height_sm = '';
		$slider_height_xs = '';
		if($height=='full'){
			$slider_height = 'full';
			$slider_height_sm = 'full';
			$slider_height_xs = 'full';
		} else {
			$slider_height = $custom_height;
			$slider_height_sm = $custom_height_sm;
			$slider_height_xs = $custom_height_xs;
		}

		//Dot classes
		$dot_style_class = '';
		$dot_position_class ='';
		if($dot_controllers){
			if($dot_controllers_style){
				$dot_style_class = 'dot-controller-'.$dot_controllers_style;
			}
			if($dot_controllers_position){
				$dot_position_class = 'dot-controller-position-'.$dot_controllers_position;
			}
		}
		//Arrow Classes
		$arrow_position_class = '';
		if($arrow_controllers_style == "along" &&  $arrow_controllers_position){
			$arrow_position_class = 'arrow-position-'.$arrow_controllers_position;
		}
		$arrow_hover_class = '';
		if($arrow_on_hover){
			$arrow_hover_class = 'arrow-show-on-hover';
		}
		//Content
		$content_vertical_alignment = (isset($settings->content_vertical_alignment) && $settings->content_vertical_alignment) ? $settings->content_vertical_alignment : '';

		//Output
		$dots = '';
		$output = '';
		$output .= '<div id="sppb-sp-slider-'. $this->addon->id .'" data-id="sppb-sp-slider-'. $this->addon->id .'" class="sppb-addon-sp-slider sp-slider '.$class.' '.$dot_style_class.' '.$dot_position_class.' '.$arrow_position_class.' '.$arrow_hover_class.'" data-height="'.$slider_height.'" data-height-sm="'.$slider_height_sm.'" data-height-xs="'.$slider_height_xs.'" data-slider-animation="'.$slider_animation.'" '.$dataVerticleSlide.' '.$data_three_d_rotate .' data-autoplay="'.($autoplay ? 'true' : 'false').'" data-interval="'.($interval ? $interval*1000 : '4000' ).'" data-timer="'.($timer ? 'true' : 'false').'" data-speed="'.($speed ? $speed : 800).'" data-dot-control="'.($dot_controllers ? 'true' : 'false').'" data-arrow-control="'.($arrow_controllers ? 'true' : 'false').'" data-indecator="'.($line_indecator ? 'true' : 'false').'" data-arrow-content="'.($arrow_controllers_content ? $arrow_controllers_content : 'text_only').'" data-slide-count="'.($slide_counter ? 'true' : 'false').'" data-dot-style="'.$dot_controllers_style.'" data-pause-hover="'.($pause_on_hover && $autoplay ? 'true' : 'false').'">';

		if(isset($settings->slideshow_items) && is_array($settings->slideshow_items)){
			$increasing_addon_id = $this->addon->id;
			foreach ($settings->slideshow_items as $item_key => $item_value) {
				if($increasing_addon_id===$increasing_addon_id){
					$increasing_addon_id++;
				}
				$uniqid = 'sp-slider-item-' . $this->addon->id .'-num-' . $item_key . '-key';

				$output .='<div id="'.$uniqid.'" class="sp-item '. (($item_key == 0) ? ' active' : '') .' '.($content_vertical_alignment ? 'slider-content-vercally-center' : '').'">';
					if($content_container_option==='bootstrap'){
						$output .= '<div class="sppb-container">';
						$output .= '<div class="sppb-row">';
						$output .= '<div class="sppb-col-sm-12">';
					} else {
						$output .= '<div class="sp-slider-content-wrap">';
					}

					$image_in_column = (isset($item_value->image_in_column) && $item_value->image_in_column) ? $item_value->image_in_column : '';

					$image_column_width = (isset($item_value->image_column_width->md) && $item_value->image_column_width->md) ? $item_value->image_column_width->md : 6;
					$image_column_width_sm = (isset($item_value->image_column_width->sm) && $item_value->image_column_width->sm) ? $item_value->image_column_width->sm : 6;
					$image_column_width_xs = (isset($item_value->image_column_width->xs) && $item_value->image_column_width->xs) ? $item_value->image_column_width->xs : 6;

					$image_column_reverse = (isset($item_value->image_column_reverse) && $item_value->image_column_reverse) ? $item_value->image_column_reverse : '';
					$icon_display_block = (isset($item_value->icon_display_block) && $item_value->icon_display_block) ? $item_value->icon_display_block : '';
					$content_alignment = (isset($item_value->content_alignment) && $item_value->content_alignment) ? $item_value->content_alignment : '';
					$image_content_alignment = (isset($item_value->image_content_alignment) && $item_value->image_content_alignment) ? $item_value->image_content_alignment : '';

						if(!$image_in_column){
							$output .='<div class="sp-slider-content-align-'.$content_alignment.'">';
							if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
								foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
									$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id .'-num-' . $inner_item_key . '-key';
									$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' '.$inner_value->content_class : '';

									//Common animation options for settings
									$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
									$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
									$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
									$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
									if($animation_timing_function == 'cubic-bezier'){
										$animation_timing_function = 'cubic-bezier('.$animation_cubic_bezier_value.')';
									}
									//Slide animation options
									$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
									$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
									$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

									//Rotate animation options
									$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
									$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

									//animation settings
									$animation_settings = '';
									if($content_animation_type == 'rotate'){
										$animation_settings = '"type":"rotate","from":"'.$animation_rotate_from.'deg", "to":"'.$animation_rotate_to.'deg","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
									} elseif($content_animation_type == 'text-animate'){
										$animation_settings = '"type":"text-animate","direction":"'.$animation_slide_direction.'","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
									} elseif($content_animation_type == 'zoom'){
										$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
									} else {
										$animation_settings = '"type":"slide","direction":"'.$animation_slide_direction.'","from":"'.$animation_slide_from.'%", "to":"0%","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
									}

									//Content type
									$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
									//Title
									$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
									$title_heading_selector = (isset($inner_value->title_heading_selector) && $inner_value->title_heading_selector) ? $inner_value->title_heading_selector : 'h2';
									//Text
									$content_text = (isset($inner_value->content_text) && $inner_value->content_text) ? $inner_value->content_text : '';
									//Image
									$image_content = (isset($inner_value->image_content) && $inner_value->image_content) ? $inner_value->image_content : '';
									$image_content_src = isset($image_content->src) ? $image_content->src : $image_content;
									//Button
									$btn_content = (isset($inner_value->btn_content) && $inner_value->btn_content) ? $inner_value->btn_content : '';
									$button_url = (isset($inner_value->button_url) && $inner_value->button_url) ? $inner_value->button_url : '';
									$button_target = (isset($inner_value->button_target) && $inner_value->button_target) ? $inner_value->button_target : '';
									$button_icon = (isset($inner_value->button_icon) && $inner_value->button_icon) ? $inner_value->button_icon : '';
									$button_icon_position = (isset($inner_value->button_icon_position) && $inner_value->button_icon_position) ? $inner_value->button_icon_position : '';

									$icon_arr = array_filter(explode(' ', $button_icon));
									if (count($icon_arr) === 1) {
										$button_icon = 'fa ' . $button_icon;
									}

									if ($button_icon_position == 'left') {
										$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"><i class="' . $button_icon . '"></i></span> ' . $btn_content . '</span>': '<span class="sp-slider-btn-text">'.$btn_content.'</span>';
									} else {
										$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text">' . $btn_content . ' <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span></span>' : '<span class="sp-slider-btn-text">'.$btn_content.'</span>';
									}

									//Icon
									$icon_content = (isset($inner_value->icon_content) && $inner_value->icon_content) ? $inner_value->icon_content : '';

									$icon_content_arr = array_filter(explode(' ', $icon_content));
									if (count($icon_content_arr) === 1) {
										$icon_content = 'fa ' . $icon_content;
									}

									if($content_type == 'text_content'){
										$output .='<div id="'.$inner_uniqid.'" class="sppb-sp-slider-text'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
										$output .= $content_text;
										$output .='</div>';
									} elseif($content_type == 'image_content'){
										$output .='<div id="'.$inner_uniqid.'" class="sppb-sp-slider-image'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
										$output .= '<img src="'.$image_content_src.'" alt="'.$title_content_title.'"/>';
										$output .='</div>';
									} elseif($content_type == 'btn_content'){
										$output .='<a id="'.$inner_uniqid.'" '.($button_target == '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '').' class="sppb-sp-slider-button'.$content_class.'" href="'.$button_url.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
										$output .= $btn_content;
										$output .='</a>';
									} elseif($content_type == 'icon_content'){
										$output .='<span id="'.$inner_uniqid.'" class="sppb-sp-slider-icon'.$content_class.' '.($icon_display_block ? 'sp-slider-icon-block' : '').'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
										$output .= '<span class="'.$icon_content.'" aria-hidden="true"></span>';
										$output .='</span>';
									} elseif($content_type == 'title_content') {
										$output .='<'.$title_heading_selector.' id="'.$inner_uniqid.'" class="sppb-sp-slider-title'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= $title_content_title;
										$output .='</'.$title_heading_selector.'>';
									}

								}
							}
							$output .='</div>';//.sp-slider-content-align
						} else {
							$output .='<div class="sppb-row">';
							if(!$image_column_reverse){
								$output .='<div class="sppb-col-xs-'.($image_column_width_xs == 12 ? 12 : (12-$image_column_width_xs)).' sppb-col-sm-'.($image_column_width_sm == 12 ? 12 : (12-$image_column_width_sm)).' sppb-col-md-'.($image_column_width == 12 ? 12 : (12-$image_column_width)).'">';
								$output .='<div class="sp-slider-content-align-'.$content_alignment.'">';
								if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
									foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
										$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id .'-num-' . $inner_item_key . '-key';
										$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' '.$inner_value->content_class : '';

										//Common animation options for settings
										$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
										$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
										$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
										$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
										if($animation_timing_function == 'cubic-bezier'){
											$animation_timing_function = 'cubic-bezier('.$animation_cubic_bezier_value.')';
										}

										//Slide animation options
										$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
										$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
										$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

										//Rotate animation options
										$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
										$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

										//animation settings
										$animation_settings = '';
										if($content_animation_type == 'rotate'){
											$animation_settings = '"type":"rotate","from":"'.$animation_rotate_from.'deg", "to":"'.$animation_rotate_to.'deg","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'text-animate'){
											$animation_settings = '"type":"text-animate","direction":"'.$animation_slide_direction.'","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'zoom'){
											$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} else {
											$animation_settings = '"type":"slide","direction":"'.$animation_slide_direction.'","from":"'.$animation_slide_from.'%", "to":"0%","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										}

										//Content type
										$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
										//Title
										$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
										$title_heading_selector = (isset($inner_value->title_heading_selector) && $inner_value->title_heading_selector) ? $inner_value->title_heading_selector : 'h2';
										//Text
										$content_text = (isset($inner_value->content_text) && $inner_value->content_text) ? $inner_value->content_text : '';
										//Button
										$btn_content = (isset($inner_value->btn_content) && $inner_value->btn_content) ? $inner_value->btn_content : '';
										$button_url = (isset($inner_value->button_url) && $inner_value->button_url) ? $inner_value->button_url : '';
										$button_target = (isset($inner_value->button_target) && $inner_value->button_target) ? $inner_value->button_target : '';
										$button_icon = (isset($inner_value->button_icon) && $inner_value->button_icon) ? $inner_value->button_icon : '';
										$button_icon_position = (isset($inner_value->button_icon_position) && $inner_value->button_icon_position) ? $inner_value->button_icon_position : '';

										$icon_arr = array_filter(explode(' ', $button_icon));
										if (count($icon_arr) === 1) {
											$button_icon = 'fa ' . $button_icon;
										}
										if ($button_icon_position == 'left') {
											$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span> ' . $btn_content . '</span>': '<span class="sp-slider-btn-text">'.$btn_content.'</span>';
										} else {
											$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text">' . $btn_content . ' <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span></span>' : '<span class="sp-slider-btn-text">'.$btn_content.'</span>';
										}

										//Icon
										$icon_content = (isset($inner_value->icon_content) && $inner_value->icon_content) ? $inner_value->icon_content : '';

										$icon_content_arr = array_filter(explode(' ', $icon_content));
										if (count($icon_content_arr) === 1) {
											$icon_content = 'fa ' . $icon_content;
										}

										if($content_type == 'text_content'){
											$output .='<div id="'.$inner_uniqid.'" class="sppb-sp-slider-text'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= $content_text;
											$output .='</div>';
										} elseif($content_type == 'btn_content'){
											$output .='<a id="'.$inner_uniqid.'" '.($button_target == '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '').' class="sppb-sp-slider-button'.$content_class.'" href="'.$button_url.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= $btn_content;
											$output .='</a>';
										} elseif($content_type == 'icon_content'){
											$output .='<span id="'.$inner_uniqid.'" class="sppb-sp-slider-icon'.$content_class.' '.($icon_display_block ? 'sp-slider-icon-block' : '').'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= '<span class="'.$icon_content.'" aria-hidden="true"></span>';
											$output .='</span>';
										} elseif($content_type == 'title_content') {
											$output .='<'.$title_heading_selector.' id="'.$inner_uniqid.'" class="sppb-sp-slider-title'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
												$output .= $title_content_title;
											$output .='</'.$title_heading_selector.'>';
										}

									}
								}
								$output .='</div>';//.sp-slider-content-align
								$output .='</div>';//sppb-column

								$output .='<div class="sppb-col-xs-'.$image_column_width_xs.' sppb-col-sm-'.$image_column_width_sm.' sppb-col-md-'.$image_column_width.' image-align-'.$image_content_alignment.'">';
								$output .='<div class="sp-slider-image-align-'.$image_content_alignment.'">';
								if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
									foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
										$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id .'-num-' . $inner_item_key . '-key';
										$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' '.$inner_value->content_class : '';

										//Common animation options for settings
										$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
										$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
										$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
										$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
										if($animation_timing_function == 'cubic-bezier'){
											$animation_timing_function = 'cubic-bezier('.$animation_cubic_bezier_value.')';
										}

										//Slide animation options
										$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
										$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
										$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

										//Rotate animation options
										$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
										$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

										//animation settings
										$animation_settings = '';
										if($content_animation_type == 'rotate'){
											$animation_settings = '"type":"rotate","from":"'.$animation_rotate_from.'deg", "to":"'.$animation_rotate_to.'deg","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'text-animate'){
											$animation_settings = '"type":"text-animate","direction":"'.$animation_slide_direction.'","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'zoom'){
											$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} else {
											$animation_settings = '"type":"slide","direction":"'.$animation_slide_direction.'","from":"'.$animation_slide_from.'%", "to":"0%","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										}

										//Content type
										$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
										//Image
										$image_content = (isset($inner_value->image_content) && $inner_value->image_content) ? $inner_value->image_content : '';
										$image_content_src = isset($image_content->src) ? $image_content->src : $image_content;
										$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';

										if($content_type == 'image_content'){
											$output .='<div id="'.$inner_uniqid.'" class="sppb-sp-slider-image'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= '<img src="'.$image_content_src.'" alt="'.$title_content_title.'">';
											$output .='</div>';
										}
									}
								}
								$output .='</div>';//.sp-slider-content-align
								$output .='</div>';//sppb-column

							} else {
								$output .='<div class="sppb-col-xs-'.$image_column_width_xs.' sppb-col-sm-'.$image_column_width_sm.' sppb-col-md-'.$image_column_width.'  image-align-'.$image_content_alignment.'">';
								$output .='<div class="sp-slider-image-align-'.$image_content_alignment.'">';
								if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
									foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
										$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id .'-num-' . $inner_item_key . '-key';
										$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' '.$inner_value->content_class : '';

										//Common animation options for settings
										$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
										$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
										$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
										$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
										if($animation_timing_function == 'cubic-bezier'){
											$animation_timing_function = 'cubic-bezier('.$animation_cubic_bezier_value.')';
										}

										//Slide animation options
										$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
										$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
										$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

										//Rotate animation options
										$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
										$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

										//animation settings
										$animation_settings = '';
										if($content_animation_type == 'rotate'){
											$animation_settings = '"type":"rotate","from":"'.$animation_rotate_from.'deg", "to":"'.$animation_rotate_to.'deg","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'text-animate'){
											$animation_settings = '"type":"text-animate","direction":"'.$animation_slide_direction.'","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'zoom'){
											$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} else {
											$animation_settings = '"type":"slide","direction":"'.$animation_slide_direction.'","from":"'.$animation_slide_from.'%", "to":"0%","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										}

										//Content type
										$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
										//Image
										$image_content = (isset($inner_value->image_content) && $inner_value->image_content) ? $inner_value->image_content : '';
										$image_content_src = isset($image_content->src) ? $image_content->src : $image_content;
										$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';

										if($content_type == 'image_content'){
											$output .='<div id="'.$inner_uniqid.'" class="sppb-sp-slider-image'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= '<img src="'.$image_content_src.'" alt="'.$title_content_title.'">';
											$output .='</div>';//.sppb-sp-slider-image
										}

									}
								}
								$output .='</div>';//.sp-slider-content-align
								$output .='</div>';//sppb-column

								$output .='<div class="sppb-col-xs-'.($image_column_width_xs == 12 ? 12 : (12-$image_column_width_xs)).' sppb-col-sm-'.($image_column_width_sm == 12 ? 12 : (12-$image_column_width_sm)).' sppb-col-md-'.($image_column_width == 12 ? 12 : (12-$image_column_width)).'">';
								$output .='<div class="sp-slider-content-align-'.$content_alignment.'">';
								if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
									foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
										$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id .'-num-' . $inner_item_key . '-key';
										$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' '.$inner_value->content_class : '';

										//Common animation options for settings
										$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
										$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
										$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
										$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
										if($animation_timing_function == 'cubic-bezier'){
											$animation_timing_function = 'cubic-bezier('.$animation_cubic_bezier_value.')';
										}

										//Slide animation options
										$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
										$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
										$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

										//Rotate animation options
										$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
										$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

										//animation settings
										$animation_settings = '';
										if($content_animation_type == 'rotate'){
											$animation_settings = '"type":"rotate","from":"'.$animation_rotate_from.'deg", "to":"'.$animation_rotate_to.'deg","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'text-animate'){
											$animation_settings = '"type":"text-animate","direction":"'.$animation_slide_direction.'","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} elseif($content_animation_type == 'zoom'){
											$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										} else {
											$animation_settings = '"type":"slide","direction":"'.$animation_slide_direction.'","from":"'.$animation_slide_from.'%", "to":"0%","duration":"'.$animation_duration.'","after":"'.$animation_delay.'", "timing_function":"'.$animation_timing_function.'"';
										}

										//Content type
										$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
										//Title
										$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
										$title_heading_selector = (isset($inner_value->title_heading_selector) && $inner_value->title_heading_selector) ? $inner_value->title_heading_selector : 'h2';
										//Text
										$content_text = (isset($inner_value->content_text) && $inner_value->content_text) ? $inner_value->content_text : '';
										//Button
										$btn_content = (isset($inner_value->btn_content) && $inner_value->btn_content) ? $inner_value->btn_content : '';
										$button_url = (isset($inner_value->button_url) && $inner_value->button_url) ? $inner_value->button_url : '';
										$button_target = (isset($inner_value->button_target) && $inner_value->button_target) ? $inner_value->button_target : '';
										$button_icon = (isset($inner_value->button_icon) && $inner_value->button_icon) ? $inner_value->button_icon : '';
										$button_icon_position = (isset($inner_value->button_icon_position) && $inner_value->button_icon_position) ? $inner_value->button_icon_position : '';

										$icon_arr = array_filter(explode(' ', $button_icon));
										if (count($icon_arr) === 1) {
											$button_icon = 'fa ' . $button_icon;
										}

										if ($button_icon_position == 'left') {
											$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span> ' . $btn_content . '</span>': '<span class="sp-slider-btn-text">'.$btn_content.'</span>';
										} else {
											$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text">' . $btn_content . ' <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span></span>' : '<span class="sp-slider-btn-text">'.$btn_content.'</span>';
										}

										//Icon
										$icon_content = (isset($inner_value->icon_content) && $inner_value->icon_content) ? $inner_value->icon_content : '';

										$icon_content_arr = array_filter(explode(' ', $icon_content));
										if (count($icon_content_arr) === 1) {
											$icon_content = 'fa ' . $icon_content;
										}

										if($content_type == 'text_content'){
											$output .='<div id="'.$inner_uniqid.'" class="sppb-sp-slider-text'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= $content_text;
											$output .='</div>';
										} elseif($content_type == 'btn_content'){
											$output .='<a id="'.$inner_uniqid.'" '.($button_target == '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '').' class="sppb-sp-slider-button'.$content_class.'" href="'.$button_url.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= $btn_content;
											$output .='</a>';
										} elseif($content_type == 'icon_content'){
											$output .='<span id="'.$inner_uniqid.'" class="sppb-sp-slider-icon'.$content_class.' '.($icon_display_block ? 'sp-slider-icon-block' : '').'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
											$output .= '<span class="'.$icon_content.'" aria-hidden="true"></span>';
											$output .='</span>';
										} elseif($content_type == 'title_content') {
											$output .='<'.$title_heading_selector.' id="'.$inner_uniqid.'" class="sppb-sp-slider-title'.$content_class.'" data-layer="true" data-animation=\'{'.$animation_settings.'}\'>';
												$output .= $title_content_title;
											$output .='</'.$title_heading_selector.'>';
										}

									}
								}
								$output .='</div>';//.sp-slider-content-align
								$output .='</div>';//sppb-column
							}
							$output .='</div>';//sppb-row
						}
						if($content_container_option==='bootstrap'){
							$output .='</div>';//.sppb-col-sm-12
							$output .='</div>';//.sppb-row
							$output .='</div>';//.sppb-container
						} else {
							$output .='</div>';//.sp-slider-content-wrap
						}
					$slider_img = (isset($item_value->slider_img) && $item_value->slider_img) ? $item_value->slider_img : '';
					$slider_img_src = isset($slider_img->src) ? $slider_img->src : $slider_img;
					if($slider_img_src){
						if(strpos($slider_img_src, "http://") !== false || strpos($slider_img_src, "https://") !== false){
							$output .= '<div class="sp-background" style="background-image: url('.$slider_img_src.');"></div>';
						} else {
							$output .= '<div class="sp-background" style="background-image: url('. JURI::base() . $slider_img_src .');"></div>';
						}
					}
					if($slider_animation != '3D'){
						$slider_video = (isset($item_value->slider_video) && $item_value->slider_video) ? $item_value->slider_video : '';
						$slider_video_src = isset($slider_video->src) ? $slider_video->src : $slider_video;
						if(($slider_video_src) && !$item_value->enable_youtube_vimeo){
							if(strpos($slider_video_src, "http://") !== false || strpos($slider_video_src, "https://") !== false){
								$output .= '<div class="sp-video-background" data-video_src="'.$slider_video_src.'"></div>';
							} else {
								$output .= '<div class="sp-video-background" data-video_src="'. JURI::base() . $slider_video_src .'"></div>';
							}
						} else if(isset($item_value->youtube_vimeo_url) && $item_value->youtube_vimeo_url && $item_value->enable_youtube_vimeo) {
							if(strpos($item_value->youtube_vimeo_url, "http://") !== false || strpos($item_value->youtube_vimeo_url, "https://") !== false){
								$output .= '<div class="sp-video-background" data-video_src="'.$item_value->youtube_vimeo_url.'"></div>';
							} else {
								$output .= '<div class="sp-video-background" data-video_src="'. JURI::base() . $item_value->youtube_vimeo_url .'"></div>';
							}
						}
					}

					if($dot_controllers_style == 'with_text'){
						$captionItem = [];
						if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
							$dot_item = 0;
							foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
								$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
								if($content_type == 'title_content' && $dot_item < 2 ) {
									array_unshift( $captionItem, $inner_value);
								}
								$dot_item++;
							}
						}
						$dots .= '<li class="'.($item_key == 0 ? 'active sp-text-thumbnail-list' : 'sp-text-thumbnail-list').'">';
							$dots .= '<div class="sp-slider-text-thumb-number">'.($item_key > 8 ? ($item_key + 1) : '0'.($item_key + 1).'').'</div>';//.sp-slider-text-thumb-number
							$dots .= '<div class="sp-dot-indicator-wrap">';
								$dots .= '<span class="dot-indicator"></span>';
							$dots .= '</div>';//.sp-dot-indicator-wrap
							$dots .= '<div class="sp-slider-text-thumb-caption">';
								if( count($captionItem) > 0 ){
									foreach($captionItem as $dot_key => $inner_value){
										//Content type
										$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
										$dots .='<div class="sp-slider-dot-indecator-text sp-dot-text-key-'.($dot_key + 1).'">';
											$dots .= $title_content_title;
										$dots .='</div>';//.sp-slider-dot-indecator-text
									}
								}
							$dots .= '</div>';//.sp-slider-text-thumb-caption
						$dots .= '</li>';
					}

				$output .= '</div>';
			}
		}
		if($dot_controllers_style == 'with_text' && $dot_controllers){
			$output .= '<div class="sp-slider-custom-dot-indecators">
						<ul>
							'.$dots.'
						</ul>';
			$output .= '</div>';//.sp-slider-custom-dot-indecators
		}

		$output .= '</div>';//.sppb-addon-sp-slider
		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/js_slider.js');
	}
	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/js_slider.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$content_container_option = (isset($settings->content_container_option) && $settings->content_container_option) ? $settings->content_container_option : '';

		//Css output start
		$css = '';

		//Timer style
		$timer_color = (isset($settings->timer_color) && $settings->timer_color) ? $settings->timer_color : '';
		if($timer_color){
			$css .= $addon_id . ' .sp-dot-indicator-wrap .dot-indicator,';
			$css .= $addon_id . ' .sp-indicator.line-indicator {';
				$css .= 'background: '.$timer_color.';';
			$css .= '}';
		}

		$timer_bg_color = (isset($settings->timer_bg_color) && $settings->timer_bg_color) ? 'background: '.$settings->timer_bg_color.';' : '';
		if($timer_bg_color){
			$css .= $addon_id . ' .sp-dot-indicator-wrap {';
				$css .= $timer_bg_color;
			$css .= '}';
		}

		$timer_style = '';
		$timer_style .= (isset($settings->timer_bg_color) && $settings->timer_bg_color) ? 'background: '.$settings->timer_bg_color.';' : '';
		$timer_style .= (isset($settings->timer_width) && $settings->timer_width) ? 'width: '.$settings->timer_width.'%;' : '';
		$timer_style .= (isset($settings->timer_top_gap) && $settings->timer_top_gap) ? 'top: '.$settings->timer_top_gap.'px;' : '';
		$timer_style .= (isset($settings->timer_left_gap) && $settings->timer_left_gap) ? 'left: '.$settings->timer_left_gap.'px;' : '';
		if($timer_style){
			$css .= $addon_id . ' .sp-indicator-container {';
				$css .= $timer_style;
			$css .= '}';
		}
		//Dot/line style
		$dot_controllers_position = (isset($settings->dot_controllers_position) && $settings->dot_controllers_position) ? $settings->dot_controllers_position : '';
		$dot_controllers_style = (isset($settings->dot_controllers_style) && $settings->dot_controllers_style) ? $settings->dot_controllers_style : '';
		$dot_ctlr_bg = (isset($settings->dot_ctlr_bg) && $settings->dot_ctlr_bg) ? $settings->dot_ctlr_bg : '';
		$dot_ctlr_height = (isset($settings->dot_ctlr_height) && $settings->dot_ctlr_height) ? $settings->dot_ctlr_height : '';
		$dot_ctlr_width = (isset($settings->dot_ctlr_width) && $settings->dot_ctlr_width) ? $settings->dot_ctlr_width : '';
		$dot_ctlr_margin = (isset($settings->dot_ctlr_margin) && trim($settings->dot_ctlr_margin)) ? $settings->dot_ctlr_margin : '';
		$dot_ctlr_border_color = (isset($settings->dot_ctlr_border_color) && $settings->dot_ctlr_border_color) ? $settings->dot_ctlr_border_color : '';
		$dot_ctlr_border_width = (isset($settings->dot_ctlr_border_width) && $settings->dot_ctlr_border_width!='') ? $settings->dot_ctlr_border_width : '2';
		$dot_ctlr_border_radius = (isset($settings->dot_ctlr_border_radius) && $settings->dot_ctlr_border_radius!='') ? $settings->dot_ctlr_border_radius : '0';

		if($dot_controllers_position == 'vertical_left' || $dot_controllers_position == 'vertical_right'){
			$css .= $addon_id . ' .sp-slider .sp-dots {';
				if($dot_ctlr_width){
					$css .= 'max-width:'.$dot_ctlr_width.'px;';
					$css .= 'height:100%;';
				}
			$css .= '}';
			$css .= $addon_id . ' .sp-slider .sp-dots ul{';
				if($dot_ctlr_width){
					$css .= 'width:'.$dot_ctlr_width.'px;';
				}
			$css .= '}';
		}

		$css .= $addon_id . ' .sp-slider .sp-dots ul li {';
			if($dot_ctlr_bg){
				$css .= 'background-color:'.$dot_ctlr_bg.';';
			}
			if($dot_ctlr_border_color){
				$css .= 'border-color:'.$dot_ctlr_border_color.';';
			}
				$css .= 'border-width:'.$dot_ctlr_border_width.'px;border-style:solid;';
			$css .= 'border-radius:'.$dot_ctlr_border_radius.'px;';
			if($dot_ctlr_height){
				$css .= 'height:'.$dot_ctlr_height.'px;';
			}
			if($dot_ctlr_width){
				$css .= 'width:'.$dot_ctlr_width.'px;';
			}
			if($dot_ctlr_margin){
				$css .= 'margin:'.$dot_ctlr_margin.';';
			}
		$css .= '}';
		//Active style options
		$dot_ctlr_hover_height = (isset($settings->dot_ctlr_hover_height) && $settings->dot_ctlr_hover_height) ? $settings->dot_ctlr_hover_height : '';
		$dot_ctlr_hover_width = (isset($settings->dot_ctlr_hover_width) && $settings->dot_ctlr_hover_width) ? $settings->dot_ctlr_hover_width : '';
		$dot_ctlr_center_bg = (isset($settings->dot_ctlr_center_bg) && $settings->dot_ctlr_center_bg) ? $settings->dot_ctlr_center_bg : '';
		$dot_ctlr_hover_border_color = (isset($settings->dot_ctlr_hover_border_color) && $settings->dot_ctlr_hover_border_color) ? $settings->dot_ctlr_hover_border_color : '';

		$css .= $addon_id . ' .sp-slider.dot-controller-line .sp-dots ul li.active span{';
			if($dot_ctlr_hover_height){
				$css .= 'height:'.$dot_ctlr_hover_height.'px;';
			}
			if($dot_ctlr_center_bg){
				$css .= 'background-color:'.$dot_ctlr_center_bg.';';
			}
			$css .= 'border-radius:'.$dot_ctlr_border_radius.'px;';
		$css .= '}';
		$css .= $addon_id . ' .sp-slider.dot-controller-line .sp-dots ul li.active{';
			$css .= 'border-radius:'.$dot_ctlr_border_radius.'px;';
			if($dot_ctlr_hover_width){
				$css .= 'width:'.$dot_ctlr_hover_width.'px;';
			}
			if($dot_ctlr_hover_border_color){
				$css .= 'border-color:'.$dot_ctlr_hover_border_color.';';
			}
		$css .= '}';
		if($dot_controllers_style !== 'line'){
			$css .= $addon_id . ' .sp-slider .sp-dots ul li span,';
			$css .= $addon_id . ' .sp-slider .sp-dots ul li:hover span,';
			$css .= $addon_id . ' .sp-slider .sp-dots ul li:hover:after,';
			$css .= $addon_id . ' .sp-slider .sp-dots ul li:after{';
				if($dot_controllers_style!=='with_image'){
					if($dot_ctlr_center_bg){
						$css .= 'background-color:'.$dot_ctlr_center_bg.';';
					}
				}
				$css .= 'border-radius:'.$dot_ctlr_border_radius.'px;';
				if($dot_ctlr_hover_height){
					$css .= 'height:'.$dot_ctlr_hover_height.'px;';
				}
				if($dot_ctlr_hover_width){
					$css .= 'width:'.$dot_ctlr_hover_width.'px;';
				}
			$css .= '}';
			$css .= $addon_id . ' .sp-slider .sp-dots ul li.active{';
				if($dot_ctlr_hover_border_color){
					$css .= 'border-color:'.$dot_ctlr_hover_border_color.';';
				}
			$css .= '}';
		}

		//Dot/line gap
		$dot_controllers_bottom_gap = (isset($settings->dot_controllers_bottom_gap) && $settings->dot_controllers_bottom_gap) ? 'bottom: '.$settings->dot_controllers_bottom_gap.'px;' : 'bottom:0px;';
		$dot_controllers_left_gap = (isset($settings->dot_controllers_left_gap) && $settings->dot_controllers_left_gap) ? 'left: '.$settings->dot_controllers_left_gap.'px;' : 'left:0px;';
		$dot_controllers_right_gap = (isset($settings->dot_controllers_right_gap) && $settings->dot_controllers_right_gap) ? 'right: '.$settings->dot_controllers_right_gap.'px;' : 'right:0px;';

		if($dot_controllers_position === 'bottom_center' && $dot_controllers_bottom_gap){
			$css .= $addon_id . ' .sp-slider .sp-dots{';
				$css .= $dot_controllers_bottom_gap;
			$css .= '}';
		}
		if($dot_controllers_position === 'bottom_left' && ($dot_controllers_bottom_gap || $dot_controllers_left_gap)){
			$css .= $addon_id . ' .sp-slider .sp-dots{';
				$css .= $dot_controllers_bottom_gap;
			$css .= '}';
			$css .= $addon_id . ' .dot-controller-position-bottom_left.sp-slider .sp-dots{';
				$css .= $dot_controllers_left_gap;
			$css .= '}';
		}
		if($dot_controllers_position === 'bottom_right' && ($dot_controllers_bottom_gap || $dot_controllers_right_gap)){
			$css .= $addon_id . ' .sp-slider .sp-dots{';
				$css .= $dot_controllers_bottom_gap;
			$css .= '}';
			$css .= $addon_id . ' .dot-controller-position-bottom_right.sp-slider .sp-dots{';
				$css .= $dot_controllers_right_gap;
			$css .= '}';
		}
		if($dot_controllers_position === 'vertical_left' && $dot_controllers_left_gap){
			$css .= $addon_id . ' .dot-controller-position-vertical_left.sp-slider .sp-dots{';
				$css .= $dot_controllers_left_gap;
			$css .= '}';
		}
		if($dot_controllers_position === 'vertical_right' && $dot_controllers_right_gap){
			$css .= $addon_id . ' .dot-controller-position-vertical_right.sp-slider .sp-dots{';
				$css .= $dot_controllers_right_gap;
			$css .= '}';
		}

		//Text thumbnail style
		$text_thumb_style = '';
		$text_thumb_style .= (isset($settings->text_thumb_ctlr_wrap_bg) && $settings->text_thumb_ctlr_wrap_bg) ? 'background:'.$settings->text_thumb_ctlr_wrap_bg.';' : '';
		$text_thumb_style .= (isset($settings->text_thumb_ctlr_wrap_padding) && trim($settings->text_thumb_ctlr_wrap_padding)) ? 'padding:'.$settings->text_thumb_ctlr_wrap_padding.';' : '';
		$text_thumb_style .= (isset($settings->text_thumb_ctlr_wrap_width) && $settings->text_thumb_ctlr_wrap_width) ? 'width:'.$settings->text_thumb_ctlr_wrap_width.'%;' : '';

		if($text_thumb_style){
			$css .= $addon_id . ' .sp-slider-custom-dot-indecators {';
				$css .= $text_thumb_style;
			$css .= '}';
		}

		$text_thumb_ctlr_individual_width = (isset($settings->text_thumb_ctlr_individual_width) && $settings->text_thumb_ctlr_individual_width) ? 'width:'.$settings->text_thumb_ctlr_individual_width.'px;' : '';
		if($text_thumb_ctlr_individual_width){
			$css .= $addon_id . ' .sp-slider-custom-dot-indecators ul li {';
				$css .= $text_thumb_ctlr_individual_width;
			$css .= '}';
		}
		//thumb number style
		$text_thumb_number_style = '';
		$text_thumb_number_style .= (isset($settings->text_thumb_number_color) && $settings->text_thumb_number_color) ? 'color:'.$settings->text_thumb_number_color.';' : '';
		$text_thumb_number_style .= (isset($settings->text_thumb_number_font_size) && $settings->text_thumb_number_font_size) ? 'font-size:'.$settings->text_thumb_number_font_size.'px;' : '';
		$text_thumb_number_style .= (isset($settings->text_thumb_number_font_weight) && $settings->text_thumb_number_font_weight) ? 'font-weight:'.$settings->text_thumb_number_font_weight.';' : '';

		if($text_thumb_number_style){
			$css .= $addon_id . ' .sp-slider-text-thumb-number {';
				$css .= $text_thumb_number_style;
			$css .= '}';
		}
		//thumb title style
		$text_thumb_title_style = '';
		$text_thumb_title_style .= (isset($settings->text_thumb_title_color) && $settings->text_thumb_title_color) ? 'color:'.$settings->text_thumb_title_color.';' : '';
		$text_thumb_title_style .= (isset($settings->text_thumb_title_font_size) && $settings->text_thumb_title_font_size) ? 'font-size:'.$settings->text_thumb_title_font_size.'px;' : '';
		$text_thumb_title_style .= (isset($settings->text_thumb_title_font_weight) && $settings->text_thumb_title_font_weight) ? 'font-weight:'.$settings->text_thumb_title_font_weight.';' : '';
		$text_thumb_title_style .= (isset($settings->text_thumb_title_lineheight) && $settings->text_thumb_title_lineheight) ? 'line-height:'.$settings->text_thumb_title_lineheight.'px;' : '';

		if($text_thumb_title_style){
			$css .= $addon_id . ' .sp-slider-dot-indecator-text.sp-dot-text-key-1 {';
				$css .= $text_thumb_title_style;
			$css .= '}';
		}
		//thumb subtitle style
		$text_thumb_subtitle_style = '';
		$text_thumb_subtitle_style .= (isset($settings->text_thumb_subtitle_color) && $settings->text_thumb_subtitle_color) ? 'color:'.$settings->text_thumb_subtitle_color.';' : '';
		$text_thumb_subtitle_style .= (isset($settings->text_thumb_subtitle_font_size) && $settings->text_thumb_subtitle_font_size) ? 'font-size:'.$settings->text_thumb_subtitle_font_size.'px;' : '';
		$text_thumb_subtitle_style .= (isset($settings->text_thumb_subtitle_font_weight) && $settings->text_thumb_subtitle_font_weight) ? 'font-weight:'.$settings->text_thumb_subtitle_font_weight.';' : '';

		if($text_thumb_subtitle_style){
			$css .= $addon_id . ' .sp-slider-dot-indecator-text.sp-dot-text-key-2 {';
				$css .= $text_thumb_subtitle_style;
			$css .= '}';
		}

		//Arrow style
		$arrow_controllers_style = (isset($settings->arrow_controllers_style) && $settings->arrow_controllers_style) ? $settings->arrow_controllers_style : '';
		$arrow_controllers_position = (isset($settings->arrow_controllers_position) && $settings->arrow_controllers_position) ? $settings->arrow_controllers_position : '';
		$arrow_ctlr_width = (isset($settings->arrow_ctlr_width) && $settings->arrow_ctlr_width) ? $settings->arrow_ctlr_width : '';
		$arrow_ctlr_height = (isset($settings->arrow_ctlr_height) && $settings->arrow_ctlr_height) ? $settings->arrow_ctlr_height : '';
		$arrow_ctlr_font_size = (isset($settings->arrow_ctlr_font_size) && $settings->arrow_ctlr_font_size) ? $settings->arrow_ctlr_font_size : '';
		$arrow_ctlr_background = (isset($settings->arrow_ctlr_background) && $settings->arrow_ctlr_background) ? $settings->arrow_ctlr_background : '';
		$arrow_ctlr_color = (isset($settings->arrow_ctlr_color) && $settings->arrow_ctlr_color) ? $settings->arrow_ctlr_color : '';
		$arrow_ctlr_border_color = (isset($settings->arrow_ctlr_border_color) && $settings->arrow_ctlr_border_color) ? $settings->arrow_ctlr_border_color : '';
		$arrow_ctlr_border_width = (isset($settings->arrow_ctlr_border_width) && $settings->arrow_ctlr_border_width !='') ? $settings->arrow_ctlr_border_width : 1;
		$arrow_ctlr_border_radius = (isset($settings->arrow_ctlr_border_radius) && $settings->arrow_ctlr_border_radius!='') ? $settings->arrow_ctlr_border_radius : '0';

		if($arrow_controllers_style !=='spread' && $arrow_ctlr_height){
			$css .= $addon_id . ' .sp-slider .sp-nav-control {';
				$css .= 'height: '.$arrow_ctlr_height.'px;';
			$css .= '}';
		}
		$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control {';
			if($arrow_ctlr_background){
				$css .= 'background: '.$arrow_ctlr_background.';';
			}
			if($arrow_ctlr_border_color){
				$css .= 'border-color: '.$arrow_ctlr_border_color.';';
			}
			$css .= 'border-radius: '.$arrow_ctlr_border_radius.'px;';
			$css .= 'border-width: '.($arrow_ctlr_border_width ? $arrow_ctlr_border_width : '0').'px;';
			if($arrow_ctlr_color){
				$css .= 'color: '.$arrow_ctlr_color.';';
			}
			if($arrow_ctlr_width){
				$css .= 'width: ' . $arrow_ctlr_width .'px;';
			}
			if($arrow_ctlr_height){
				$css .= 'height: '.$arrow_ctlr_height.'px;';
			}
			if($arrow_ctlr_font_size){
				$css .= 'font-size: '.$arrow_ctlr_font_size.'px;';
			}
		$css .= '}';

		$css .= $addon_id . ' div[class*="arrow-position-bottom"].sp-slider .sp-nav-control {';
			if($arrow_ctlr_width){
				$css .= 'width: '.(($arrow_ctlr_width * 2)+20).'px;';
			}
		$css .= '}';

		if($arrow_controllers_style==='spread' && $arrow_ctlr_height){
			$css .= $addon_id . ' .sp-slider .sp-nav-control {';
				$css .= 'top: -'.$arrow_ctlr_height.'px;';
			$css .= '}';
		}

		$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control{';
			if(!$arrow_ctlr_border_width){
				$arrow_ctlr_border_width = 1;
			}
			if($arrow_ctlr_height){
				$css .= 'line-height: '.($arrow_ctlr_height-($arrow_ctlr_border_width*2)).'px;';
			}
		$css .= '}';
		$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control i{';
			if(!$arrow_ctlr_border_width){
				$arrow_ctlr_border_width = 1;
			}
			if($arrow_ctlr_height){
				$css .= 'line-height: '.($arrow_ctlr_height-($arrow_ctlr_border_width*2)).'px;';
			}
		$css .= '}';

		//Arrow gap
		$arrow_controllers_bottom_gap = (isset($settings->arrow_controllers_bottom_gap) && $settings->arrow_controllers_bottom_gap) ? 'bottom: '.$settings->arrow_controllers_bottom_gap.'px;' : 'bottom:0px;';
		$arrow_controllers_left_gap = (isset($settings->arrow_controllers_left_gap) && $settings->arrow_controllers_left_gap) ? 'left: '.$settings->arrow_controllers_left_gap.'px;' : 'left:0px;';
		$arrow_controllers_right_gap = (isset($settings->arrow_controllers_right_gap) && $settings->arrow_controllers_right_gap) ? 'right: '.$settings->arrow_controllers_right_gap.'px;' : 'right:0px;';

		if($arrow_controllers_position=='bottom_center' && $arrow_controllers_bottom_gap){
			$css .= $addon_id . ' .sp-slider.arrow-position-bottom_center .sp-nav-control {';
				$css .= $arrow_controllers_bottom_gap;
			$css .= '}';
		}
		if($arrow_controllers_position=='bottom_left' && ($arrow_controllers_left_gap || $arrow_controllers_bottom_gap)){
			$css .= $addon_id . ' .sp-slider.arrow-position-bottom_left .sp-nav-control {';
				$css .= $arrow_controllers_bottom_gap;
				$css .= $arrow_controllers_left_gap;
			$css .= '}';
		}
		if($arrow_controllers_position=='bottom_right' && ($arrow_controllers_right_gap || $arrow_controllers_bottom_gap)){
			$css .= $addon_id . ' .sp-slider.arrow-position-bottom_right .sp-nav-control {';
				$css .= $arrow_controllers_bottom_gap;
				$css .= $arrow_controllers_right_gap;
			$css .= '}';
		}
		//Spread arrow gap
		$arrow_spread_controllers_left_gap = (isset($settings->arrow_spread_controllers_left_gap) && $settings->arrow_spread_controllers_left_gap) ? 'left: '.$settings->arrow_spread_controllers_left_gap.'px;' : 'left:0px;';
		$arrow_spread_controllers_right_gap = (isset($settings->arrow_spread_controllers_right_gap) && $settings->arrow_spread_controllers_right_gap) ? 'right: '.$settings->arrow_spread_controllers_right_gap.'px;' : 'right:0px;';
		if($arrow_controllers_style==='spread' && ($arrow_spread_controllers_left_gap || $arrow_spread_controllers_right_gap)){
			$css .= $addon_id . ' div.sp-slider .sp-nav-control {';
				$css .= $arrow_spread_controllers_left_gap;
				$css .= $arrow_spread_controllers_right_gap;
			$css .= '}';
		}

		//Arrow hover
		$arrow_ctlr_hover_background = (isset($settings->arrow_ctlr_hover_background) && $settings->arrow_ctlr_hover_background) ? $settings->arrow_ctlr_hover_background : '';
		$arrow_ctlr_hover_color = (isset($settings->arrow_ctlr_hover_color) && $settings->arrow_ctlr_hover_color) ? $settings->arrow_ctlr_hover_color : '';
		$arrow_ctlr_hover_border_color = (isset($settings->arrow_ctlr_hover_border_color) && $settings->arrow_ctlr_hover_border_color) ? $settings->arrow_ctlr_hover_border_color : '';

		$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control:hover {';
			if($arrow_ctlr_hover_background){
				$css .= 'background: '.$arrow_ctlr_hover_background.';';
			}
			if($arrow_ctlr_hover_border_color){
				$css .= 'border-color: '.$arrow_ctlr_hover_border_color.';';
			}
			if($arrow_ctlr_hover_color){
				$css .= 'color: '.$arrow_ctlr_hover_color.';';
			}
		$css .= '}';
		//Slide Counter Style
		$slide_counter = (isset($settings->slide_counter) && $settings->slide_counter) ? $settings->slide_counter : 0;
		$slide_counter_style = '';
		$slide_counter_style .= (isset($settings->slide_counter_color) && $settings->slide_counter_color) ? 'color:'.$settings->slide_counter_color.';' : '';
		$slide_counter_style .= (isset($settings->slide_counter_fontsize) && $settings->slide_counter_fontsize) ? 'font-size:'.$settings->slide_counter_fontsize.'px;' : '';
		$slide_counter_style .= (isset($settings->slide_counter_fontfamily) && $settings->slide_counter_fontfamily) ? 'font-family:'.$settings->slide_counter_fontfamily.';' : '';
		$slide_counter_style .= (isset($settings->slide_counter_bg_color) && $settings->slide_counter_bg_color) ? 'background:'.$settings->slide_counter_bg_color.';' : '';
		$slide_counter_style .= (isset($settings->slide_counter_padding) && trim($settings->slide_counter_padding)) ? 'padding:'.$settings->slide_counter_padding.';' : '';
		$slide_counter_style .= (isset($settings->slide_counter_gap_bottom) && $settings->slide_counter_gap_bottom) ? 'bottom:'.$settings->slide_counter_gap_bottom.'px;' : 'bottom:0px;';
		$slide_counter_style .= (isset($settings->slide_counter_gap_left) && $settings->slide_counter_gap_left) ? 'left:'.$settings->slide_counter_gap_left.'px;' : 'left:0px;';

		if($slide_counter_style && $slide_counter){
			$css .= $addon_id . ' .sp-slider .sp-slider_number{';
				$css .= $slide_counter_style;
			$css .= '}';
		}

		// Item content style
		if(isset($settings->slideshow_items) && is_array($settings->slideshow_items)){
			$increasing_addon_id = $this->addon->id;
			foreach ($settings->slideshow_items as $item_key => $item_value) {
				$uniqid = '#sp-slider-item-' . $this->addon->id .'-num-' . $item_key . '-key';
				if($increasing_addon_id === $increasing_addon_id){
					$increasing_addon_id++;
				}
				//Image dot style
				$slider_img = (isset($item_value->slider_img) && $item_value->slider_img) ? $item_value->slider_img : '';
				$slider_img_src = isset($slider_img->src) ? $slider_img->src : $slider_img;
				$css .= $addon_id . ' .dot-controller-with_image.sp-slider .sp-dots ul li.sp-dot-'.$item_key.' {';
					if(strpos($slider_img_src, "http://") !== false || strpos($slider_img_src, "https://") !== false){
						$css .= 'background: url(\''.$slider_img_src.'\') no-repeat scroll center center / cover;';
					} else {
						$css .= 'background: url(\''.JURI::base(). '/' .$slider_img_src.'\') no-repeat scroll center center / cover;';
					}
				$css .= '}';

				if(isset($item_value->video_volume_btn) && $item_value->video_volume_btn){
					$css .= $addon_id.' '.$uniqid.'.sp-item .sp-video-control {';
						$css .= 'display:block;';
					$css .= '}';
				} else {
					$css .= $addon_id.' '.$uniqid.'.sp-item .sp-video-control {';
						$css .= 'display:none;';
					$css .= '}';
				}
				if(isset($item_value->slider_overlay_options) && $item_value->slider_overlay_options=='color_overlay'){
					if(isset($item_value->slider_bg_overlay) && $item_value->slider_bg_overlay){
						$css .= $addon_id.' '.$uniqid.'.sp-item .sp-background:after,';
						$css .= $addon_id.' '.$uniqid.'.sp-item .sp-video-background-mask{';
							$css .= 'background:'.$item_value->slider_bg_overlay.';';
						$css .= '}';
					}
				}

				if(isset($item_value->slider_bg_gradient_overlay) && $item_value->slider_bg_gradient_overlay){
					$slider_bg_gradient_overlay = (isset($item_value->slider_bg_gradient_overlay) && $item_value->slider_bg_gradient_overlay) ? $item_value->slider_bg_gradient_overlay : '';

					$overlay_gradient_color1 = (isset($slider_bg_gradient_overlay->color) && $slider_bg_gradient_overlay->color) ? $slider_bg_gradient_overlay->color : '';
					$overlay_gradient_color2 = (isset($slider_bg_gradient_overlay->color2) && $slider_bg_gradient_overlay->color2) ? $slider_bg_gradient_overlay->color2 : '';
					$overlay_degree = (isset($slider_bg_gradient_overlay->deg) && $slider_bg_gradient_overlay->deg) ? $slider_bg_gradient_overlay->deg : '45';
					$overlay_type = (isset($slider_bg_gradient_overlay->type) && $slider_bg_gradient_overlay->type) ? $slider_bg_gradient_overlay->type : 'linear';
					$overlay_radialPos = (isset($slider_bg_gradient_overlay->radialPos) && $slider_bg_gradient_overlay->radialPos) ? $slider_bg_gradient_overlay->radialPos : '';
					$overlay_radial_angle1 = (isset($slider_bg_gradient_overlay->pos) && $slider_bg_gradient_overlay->pos) ? $slider_bg_gradient_overlay->pos : '10';
					$overlay_radial_angle2 = (isset($slider_bg_gradient_overlay->pos2) && $slider_bg_gradient_overlay->pos2) ? $slider_bg_gradient_overlay->pos2 : '100';

					$css .= $addon_id.' '.$uniqid.'.sp-item .sp-background:after,';
					$css .= $addon_id.' '.$uniqid.'.sp-item .sp-video-background-mask{';
						if($overlay_type!=='radial'){
							$css .= 'background: -webkit-linear-gradient('.$overlay_degree.'deg, '.$overlay_gradient_color1.' '.$overlay_radial_angle1.'%, '.$overlay_gradient_color2.' '.$overlay_radial_angle2.'%) transparent;';
							$css .= 'background: linear-gradient('.$overlay_degree.'deg, '.$overlay_gradient_color1.' '.$overlay_radial_angle1.'%, '.$overlay_gradient_color2.' '.$overlay_radial_angle2.'%) transparent;';
						} else {
							$css .= 'background: -webkit-radial-gradient(at '.$overlay_radialPos.', '.$overlay_gradient_color1.' '.$overlay_radial_angle1.'%, '.$overlay_gradient_color2.' '.$overlay_radial_angle2.'%) transparent;';
							$css .= 'background: radial-gradient(at '.$overlay_radialPos.', '.$overlay_gradient_color1.' '.$overlay_radial_angle1.'%, '.$overlay_gradient_color2.' '.$overlay_radial_angle2.'%) transparent;';
						}
					$css .= '}';
				}

				if(isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)){
					foreach($item_value->slideshow_inner_items as $inner_item_key => $inner_value){
						$inner_uniqid = '#sp-slider-inner-item-' . $increasing_addon_id .'-num-' . $inner_item_key . '-key';

						//Content type
						$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
						//Content style
						$content_style = '';
						$content_style_sm = '';
						$content_style_xs = '';
						if($content_type !== 'image_content'){
							$content_style .= (isset($inner_value->content_color) && $inner_value->content_color) ? 'color: ' . $inner_value->content_color . ';' : '';
							$content_style .= (isset($inner_value->content_fontsize) && $inner_value->content_fontsize->md) ? 'font-size: ' . $inner_value->content_fontsize->md . 'px;' : '';
							$content_style .= (isset($inner_value->content_lineheight) && $inner_value->content_lineheight->md) ? 'line-height: ' . $inner_value->content_lineheight->md . 'px;' : '';
							if(isset($inner_value->content_letterspacing) && $inner_value->content_letterspacing){
								$content_style .= ($inner_value->content_letterspacing != 'custom') ? 'letter-spacing: ' . $inner_value->content_letterspacing . ';' : '';
								$content_style .= (isset($inner_value->custom_letterspacing) && $inner_value->content_letterspacing == 'custom') ? 'letter-spacing: ' . $inner_value->custom_letterspacing. ';' : '';
							}
							//Tablet style
							$content_style_sm .= (isset($inner_value->content_fontsize) && $inner_value->content_fontsize->sm) ? 'font-size: ' . $inner_value->content_fontsize->sm . 'px;' : '';
							$content_style_sm .= (isset($inner_value->content_lineheight) && $inner_value->content_lineheight->sm) ? 'line-height: ' . $inner_value->content_lineheight->sm . 'px;' : '';
							//Mobile style
							$content_style_xs .= (isset($inner_value->content_fontsize) && $inner_value->content_fontsize->xs) ? 'font-size: ' . $inner_value->content_fontsize->xs . 'px;' : '';
							$content_style_xs .= (isset($inner_value->content_lineheight) && $inner_value->content_lineheight->xs) ? 'line-height: ' . $inner_value->content_lineheight->xs . 'px;' : '';

							if(isset($inner_value->content_text_shadow) && is_object($inner_value->content_text_shadow)){
								$ho = (isset($inner_value->content_text_shadow->ho) && $inner_value->content_text_shadow->ho != '') ? $inner_value->content_text_shadow->ho.'px' : '0px';
								$vo = (isset($inner_value->content_text_shadow->vo) && $inner_value->content_text_shadow->vo != '') ? $inner_value->content_text_shadow->vo.'px' : '0px';
								$blur = (isset($inner_value->content_text_shadow->blur) && $inner_value->content_text_shadow->blur != '') ? $inner_value->content_text_shadow->blur.'px' : '0px';
								$color = (isset($inner_value->content_text_shadow->color) && $inner_value->content_text_shadow->color != '') ? $inner_value->content_text_shadow->color : '';

								if(!empty($color)){
									$content_style .= "text-shadow: ${ho} ${vo} ${blur} ${color};";
								}
							}
						}
						if($content_type !== 'btn_content'){
							$content_style .= (isset($inner_value->content_background) && $inner_value->content_background) ? 'background: ' . $inner_value->content_background . ';' : '';
							$content_style .= (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->md)) ? 'margin: ' . $inner_value->content_margin->md . ';' : '';
							//Tablet style
							$content_style_sm .= (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->sm)) ? 'margin: ' . $inner_value->content_margin->sm . ';' : '';
							//Mobile
							$content_style_xs .= (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->xs)) ? 'margin: ' . $inner_value->content_margin->xs . ';' : '';
						}
						if($content_type == 'btn_content' || $content_type == 'image_content'){
							$btn_box_shadow = (isset($inner_value->btn_box_shadow) && $inner_value->btn_box_shadow) ? $inner_value->btn_box_shadow : '';
							if(is_object($btn_box_shadow)){
								$ho = (isset($btn_box_shadow->ho) && $btn_box_shadow->ho != '') ? $btn_box_shadow->ho.'px' : '0px';
								$vo = (isset($btn_box_shadow->vo) && $btn_box_shadow->vo != '') ? $btn_box_shadow->vo.'px' : '0px';
								$blur = (isset($btn_box_shadow->blur) && $btn_box_shadow->blur != '') ? $btn_box_shadow->blur.'px' : '0px';
								$spread = (isset($btn_box_shadow->spread) && $btn_box_shadow->spread != '') ? $btn_box_shadow->spread.'px' : '0px';
								$color = (isset($btn_box_shadow->color) && $btn_box_shadow->color != '') ? $btn_box_shadow->color : '#fff';
								$content_style .= "box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};";
							}
						}
						$content_style .= (isset($inner_value->content_border) && trim($inner_value->content_border)) ? 'border-width: ' . $inner_value->content_border . ';border-style: solid;' : '';
						$content_style .= (isset($inner_value->content_border_color) && $inner_value->content_border_color) ? 'border-color: ' . $inner_value->content_border_color . ';' : '';
						$content_style .= (isset($inner_value->content_border_radius) && $inner_value->content_border_radius != '') ? 'border-radius: ' . $inner_value->content_border_radius . 'px;' : '';

						$content_style .= (isset($inner_value->content_padding) && $inner_value->content_padding && trim($inner_value->content_padding->md)) ? 'padding: ' . $inner_value->content_padding->md . ';' : '';
						$content_style_sm .= (isset($inner_value->content_padding) && $inner_value->content_padding && trim($inner_value->content_padding->sm)) ? 'padding: ' . $inner_value->content_padding->sm . ';' : '';
						$content_style_xs .= (isset($inner_value->content_padding) && $inner_value->content_padding && trim($inner_value->content_padding->xs)) ? 'padding: ' . $inner_value->content_padding->xs . ';' : '';

						if($content_type !== 'icon_content'){
							if(isset($inner_value->content_font_family) && $inner_value->content_font_family) {
								$font_path = new JLayoutFile('addon.css.fontfamily', $layout_path);
								$font_path->render(array('font'=>$inner_value->content_font_family));
								$content_style .= 'font-family: ' . $inner_value->content_font_family . ';';
							}

							$content_font_style = (isset($inner_value->content_font_style) && $inner_value->content_font_style) ? $inner_value->content_font_style : '';
							if(isset($content_font_style->underline) && $content_font_style->underline){
								$content_style .= 'text-decoration:underline;';
							}
							if(isset($content_font_style->italic) && $content_font_style->italic){
								$content_style .= 'font-style:italic;';
							}
							if(isset($content_font_style->uppercase) && $content_font_style->uppercase){
								$content_style .= 'text-transform:uppercase;';
							}
							if(isset($content_font_style->weight) && $content_font_style->weight){
								$content_style .= 'font-weight:'.$content_font_style->weight.';';
							}
						}

						//Content css
						if($content_type !== 'btn_content'){
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . ' {';
								$css .= $content_style;
							$css .= '}';
						}

						//Image content style
						$image_content_style = '';
						$image_content_style_sm = '';
						$image_content_style_xs = '';
						$image_content_style .= (isset($inner_value->image_content_height) && $inner_value->image_content_height->md) ? 'height: ' . $inner_value->image_content_height->md . 'px;' : 'height: 385px;';
						$image_content_style .= (isset($inner_value->image_content_width) && $inner_value->image_content_width->md) ? 'width: ' . $inner_value->image_content_width->md . 'px;' : 'width:400px;';

						//Tablet image style
						$image_content_style_sm .= (isset($inner_value->image_content_height) && $inner_value->image_content_height && $inner_value->image_content_height->sm) ? 'height: ' . $inner_value->image_content_height->sm . 'px;' : '';
						$image_content_style_sm .= (isset($inner_value->image_content_width) && $inner_value->image_content_width->sm) ? 'width: ' . $inner_value->image_content_width->sm . 'px;' : '';
						//Mobile image style
						$image_content_style_xs .= (isset($inner_value->image_content_height) && $inner_value->image_content_height && $inner_value->image_content_height->xs) ? 'height: ' . $inner_value->image_content_height->xs . 'px;' : '';
						$image_content_style_xs .= (isset($inner_value->image_content_width) && $inner_value->image_content_width->xs) ? 'width: ' . $inner_value->image_content_width->xs . 'px;' : '';

						//Image content css
						$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . ' img {';
							$css .= $image_content_style;
						$css .= '}';

						//Button content style
						$btn_content_style = '';
						$btn_hover_content_style = '';

						$button_background_options = (isset($inner_value->button_background_options) && $inner_value->button_background_options) ? $inner_value->button_background_options : '';
						$btn_margin = (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->md)) ? 'margin: ' . $inner_value->content_margin->md . ';' : '';
						$btn_margin_sm = (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->sm)) ? 'margin: ' . $inner_value->content_margin->sm . ';' : '';
						$btn_margin_xs = (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->xs)) ? 'margin: ' . $inner_value->content_margin->xs . ';' : '';

						if($button_background_options === 'color_bg'){
							$btn_content_style .= (isset($inner_value->button_background_color) && $inner_value->button_background_color) ? 'background: ' . $inner_value->button_background_color . ';' : '';
							//Button hover bg
							$btn_hover_content_style .= (isset($inner_value->button_background_color_hover) && $inner_value->button_background_color_hover) ? 'background: ' . $inner_value->button_background_color_hover . ';' : '';
						} else {
							//Button Normal gradient
							$button_background_gradient = (isset($inner_value->button_background_gradient) && $inner_value->button_background_gradient) ? $inner_value->button_background_gradient : '';

							$gradient_color1 = (isset($button_background_gradient->color) && $button_background_gradient->color) ? $button_background_gradient->color : '';
							$gradient_color2 = (isset($button_background_gradient->color2) && $button_background_gradient->color2) ? $button_background_gradient->color2 : '';
							$degree = (isset($button_background_gradient->deg) && $button_background_gradient->deg) ? $button_background_gradient->deg : '0';
							$type = (isset($button_background_gradient->type) && $button_background_gradient->type) ? $button_background_gradient->type : '';
							$radialPos = (isset($button_background_gradient->radialPos) && $button_background_gradient->radialPos) ? $button_background_gradient->radialPos : '';
							$radial_angle1 = (isset($button_background_gradient->pos) && $button_background_gradient->pos) ? $button_background_gradient->pos : '0';
							$radial_angle2 = (isset($button_background_gradient->pos2) && $button_background_gradient->pos2) ? $button_background_gradient->pos2 : '100';

							if($type!=='radial'){
								$btn_content_style .= 'background: -webkit-linear-gradient('.$degree.'deg, '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
								$btn_content_style .= 'background: linear-gradient('.$degree.'deg, '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
							} else {
								$btn_content_style .= 'background: -webkit-radial-gradient(at '.$radialPos.', '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
								$btn_content_style .= 'background: radial-gradient(at '.$radialPos.', '.$gradient_color1.' '.$radial_angle1.'%, '.$gradient_color2.' '.$radial_angle2.'%) transparent;';
							}
							//Button hover gradient
							$button_background_gradient_hover = (isset($inner_value->button_background_gradient_hover) && $inner_value->button_background_gradient_hover) ? $inner_value->button_background_gradient_hover : '';

							$gradient_hover_color1 = (isset($button_background_gradient_hover->color) && $button_background_gradient_hover->color) ? $button_background_gradient_hover->color : '';
							$gradient_hover_color2 = (isset($button_background_gradient_hover->color2) && $button_background_gradient_hover->color2) ? $button_background_gradient_hover->color2 : '';
							$hover_degree = (isset($button_background_gradient_hover->deg) && $button_background_gradient_hover->deg) ? $button_background_gradient_hover->deg : '0';
							$hover_type = (isset($button_background_gradient_hover->type) && $button_background_gradient_hover->type) ? $button_background_gradient_hover->type : '';
							$hover_radialPos = (isset($button_background_gradient_hover->radialPos) && $button_background_gradient_hover->radialPos) ? $button_background_gradient_hover->radialPos : '';
							$hover_radial_angle1 = (isset($button_background_gradient_hover->pos) && $button_background_gradient_hover->pos) ? $button_background_gradient_hover->pos : '0';
							$hover_radial_angle2 = (isset($button_background_gradient_hover->pos2) && $button_background_gradient_hover->pos2) ? $button_background_gradient_hover->pos2 : '100';

							if($hover_type!=='radial'){
								$btn_hover_content_style .= 'background: -webkit-linear-gradient('.$hover_degree.'deg, '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hover_radial_angle2.'%) transparent;';
								$btn_hover_content_style .= 'background: linear-gradient('.$hover_degree.'deg, '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hover_radial_angle2.'%) transparent;';
							} else {
								$btn_hover_content_style .= 'background: -webkit-radial-gradient(at '.$hover_radialPos.', '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hover_radial_angle2.'%) transparent;';
								$btn_hover_content_style .= 'background: radial-gradient(at '.$hover_radialPos.', '.$gradient_hover_color1.' '.$hover_radial_angle1.'%, '.$gradient_hover_color2.' '.$hover_radial_angle2.'%) transparent;';
							}
						}

						//Button content css
						if($btn_margin){
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button {';
								$css .= $btn_margin;
							$css .= '}';
						}
						$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text{';
							$css .= $content_style;
							$css .= $btn_content_style;
						$css .= '}';
						//Button Icon style
						$button_icon_margin = (isset($inner_value->button_icon_margin) && $inner_value->button_icon_margin && trim($inner_value->button_icon_margin->md)) ? 'margin: ' . $inner_value->button_icon_margin->md . ';' : '';
						$button_icon_margin_sm = (isset($inner_value->button_icon_margin) && $inner_value->button_icon_margin && trim($inner_value->button_icon_margin->sm)) ? 'margin: ' . $inner_value->button_icon_margin->sm . ';' : '';
						$button_icon_margin_xs = (isset($inner_value->button_icon_margin) && $inner_value->button_icon_margin && trim($inner_value->button_icon_margin->xs)) ? 'margin: ' . $inner_value->button_icon_margin->xs . ';' : '';

						//Button Icon css
						if($button_icon_margin){
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-icon{';
								$css .= $button_icon_margin;
							$css .= '}';
						}

						//Button hover style
						$btn_hover_content_style .= (isset($inner_value->button_hover_color) && $inner_value->button_hover_color) ? 'color: ' . $inner_value->button_hover_color . ';' : '';
						$btn_hover_content_style .= (isset($inner_value->button_hover_border_color) && $inner_value->button_hover_border_color) ? 'border-color: ' . $inner_value->button_hover_border_color . ';' : '';

						$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text:hover,';
						$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text:focus {';
							$css .= $btn_hover_content_style;
						$css .= '}';

						//Table style
						$css .= '@media (min-width: 768px) and (max-width: 991px) {';
							//tablet content style
							if($content_type !== 'btn_content'){
								$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . ' {';
									$css .= $content_style_sm;
								$css .= '}';
							}
							//Image content css
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . ' img {';
								$css .= $image_content_style_sm;
							$css .= '}';
							//Button content css
							if($btn_margin_sm){
								$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button {';
									$css .= $btn_margin_sm;
								$css .= '}';
							}
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text{';
								$css .= $content_style_sm;
							$css .= '}';
							if($button_icon_margin_sm){
								$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-icon{';
									$css .= $button_icon_margin_sm;
								$css .= '}';
							}

						$css .= '}';
						//Mobile style
						$css .= '@media (max-width: 767px) {';
							//tablet content style
							if($content_type !== 'btn_content'){
								$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . ' {';
									$css .= $content_style_xs;
								$css .= '}';
							}
							//Image content css
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . ' img {';
								$css .= $image_content_style_xs;
							$css .= '}';
							//Button content css
							if($btn_margin_xs){
								$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button {';
									$css .= $btn_margin_xs;
								$css .= '}';
							}
							$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text{';
								$css .= $content_style_xs;
							$css .= '}';
							if($button_icon_margin_xs){
								$css .= '.sp-slider ' .$uniqid .' '. $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-icon{';
									$css .= $button_icon_margin_xs;
								$css .= '}';
							}
						$css .= '}';

					}
				}
			}
		}

		//Content container style
		$content_container_width = (isset($settings->content_container_width) && $settings->content_container_width) ? $settings->content_container_width : '100';
		if($content_container_width && $content_container_option!=='bootstrap'){
			$css .= $addon_id . ' .sp-slider .sp-slider-content-wrap {';
				$css .= 'width: ' . $content_container_width . '%;margin: 0 auto;';
			$css .= '}';
		}

		//Tablet style
		//Timer
		$timer_style_sm = '';
		$timer_style_sm .= (isset($settings->timer_width_sm) && $settings->timer_width_sm) ? 'width: '.$settings->timer_width_sm.'%;' : '';
		$timer_style_sm .= (isset($settings->timer_top_gap_sm) && $settings->timer_top_gap_sm) ? 'top: '.$settings->timer_top_gap_sm.'px;' : '';
		$timer_style_sm .= (isset($settings->timer_left_gap_sm) && $settings->timer_left_gap_sm) ? 'left: '.$settings->timer_left_gap_sm.'px;' : '';
		//Content container
		$content_container_width_sm = (isset($settings->content_container_width_sm) && $settings->content_container_width_sm) ? $settings->content_container_width_sm : '';

		//Arrow Table style
		$arrow_ctlr_width_sm = (isset($settings->arrow_ctlr_width_sm) && $settings->arrow_ctlr_width_sm) ? $settings->arrow_ctlr_width_sm : '';
		$arrow_ctlr_height_sm = (isset($settings->arrow_ctlr_height_sm) && $settings->arrow_ctlr_height_sm) ? $settings->arrow_ctlr_height_sm : '';
		$arrow_ctlr_fontsize_sm = (isset($settings->arrow_ctlr_font_size_sm) && $settings->arrow_ctlr_font_size_sm) ? $settings->arrow_ctlr_font_size_sm : '';
		//Dot/line gap tablet style
		$dot_controllers_bottom_gap_sm = (isset($settings->dot_controllers_bottom_gap_sm) && $settings->dot_controllers_bottom_gap_sm) ? 'bottom: '.$settings->dot_controllers_bottom_gap_sm.'px;' : 'bottom:0px;';
		$dot_controllers_left_gap_sm = (isset($settings->dot_controllers_left_gap_sm) && $settings->dot_controllers_left_gap_sm) ? 'left: '.$settings->dot_controllers_left_gap_sm.'px;' : 'left:0px;';
		$dot_controllers_right_gap_sm = (isset($settings->dot_controllers_right_gap_sm) && $settings->dot_controllers_right_gap_sm) ? 'right: '.$settings->dot_controllers_right_gap_sm.'px;' : 'right:0px;';

		//Arrow gap tablet style
		$arrow_controllers_bottom_gap_sm = (isset($settings->arrow_controllers_bottom_gap_sm) && $settings->arrow_controllers_bottom_gap_sm) ? 'bottom: '.$settings->arrow_controllers_bottom_gap_sm.'px;' : 'bottom:0px;';
		$arrow_controllers_left_gap_sm = (isset($settings->arrow_controllers_left_gap_sm) && $settings->arrow_controllers_left_gap_sm) ? 'left: '.$settings->arrow_controllers_left_gap_sm.'px;' : 'left:0px;';
		$arrow_controllers_right_gap_sm = (isset($settings->arrow_controllers_right_gap_sm) && $settings->arrow_controllers_right_gap_sm) ? 'right: '.$settings->arrow_controllers_right_gap_sm.'px;' : 'right:0px;';
		//Spread arrow gap tablet style
		$arrow_spread_controllers_left_gap_sm = (isset($settings->arrow_spread_controllers_left_gap_sm) && $settings->arrow_spread_controllers_left_gap_sm) ? 'left: '.$settings->arrow_spread_controllers_left_gap_sm.'px;' : 'left:0px;';
		$arrow_spread_controllers_right_gap_sm = (isset($settings->arrow_spread_controllers_right_gap_sm) && $settings->arrow_spread_controllers_right_gap_sm) ? 'right: '.$settings->arrow_spread_controllers_right_gap_sm.'px;' : 'right:0px;';

		//Slide Counter tablet Style
		$slide_counter_style_sm = '';
		$slide_counter_style_sm .= (isset($settings->slide_counter_fontsize_sm) && $settings->slide_counter_fontsize_sm) ? 'font-size:'.$settings->slide_counter_fontsize_sm.'px;' : '';
		$slide_counter_style_sm .= (isset($settings->slide_counter_padding_sm) && trim($settings->slide_counter_padding_sm)) ? 'padding:'.$settings->slide_counter_padding_sm.';' : '';
		$slide_counter_style_sm .= (isset($settings->slide_counter_gap_bottom_sm) && $settings->slide_counter_gap_bottom_sm) ? 'bottom:'.$settings->slide_counter_gap_bottom_sm.'px;' : 'bottom:0px;';
		$slide_counter_style_sm .= (isset($settings->slide_counter_gap_left_sm) && $settings->slide_counter_gap_left_sm) ? 'left:'.$settings->slide_counter_gap_left_sm.'px;' : 'left:0px;';

		$text_thumb_ctlr_individual_width = (isset($settings->text_thumb_ctlr_individual_width) && $settings->text_thumb_ctlr_individual_width) ? 'width:'.$settings->text_thumb_ctlr_individual_width.'px;' : '';
		if($text_thumb_ctlr_individual_width){
			$css .= $addon_id . ' .sp-slider-custom-dot-indecators ul li {';
				$css .= $text_thumb_ctlr_individual_width;
			$css .= '}';
		}

		//Text thumbnail style
		$text_thumb_style_sm = '';
		$text_thumb_style_sm .= (isset($settings->text_thumb_ctlr_wrap_padding_sm) && trim($settings->text_thumb_ctlr_wrap_padding_sm)) ? 'padding:'.$settings->text_thumb_ctlr_wrap_padding_sm.';' : '';
		$text_thumb_style_sm .= (isset($settings->text_thumb_ctlr_wrap_width_sm) && $settings->text_thumb_ctlr_wrap_width_sm) ? 'width:'.$settings->text_thumb_ctlr_wrap_width_sm.'%;' : '';

		$text_thumb_ctlr_individual_width_sm = (isset($settings->text_thumb_ctlr_individual_width_sm) && $settings->text_thumb_ctlr_individual_width_sm) ? 'width:'.$settings->text_thumb_ctlr_individual_width_sm.'px;' : '';
		//thumb title style
		$text_thumb_title_style_sm = '';
		$text_thumb_title_style_sm .= (isset($settings->text_thumb_title_font_size_sm) && $settings->text_thumb_title_font_size_sm) ? 'font-size:'.$settings->text_thumb_title_font_size_sm.'px;' : '';
		$text_thumb_title_style_sm .= (isset($settings->text_thumb_title_lineheight_sm) && $settings->text_thumb_title_lineheight_sm) ? 'line-height:'.$settings->text_thumb_title_lineheight_sm.'px;' : '';

		//text thumb number style table
		$text_thumb_number_style_sm = '';
		$text_thumb_number_style_sm .= (isset($settings->text_thumb_number_font_size_sm) && $settings->text_thumb_number_font_size_sm) ? 'font-size:'.$settings->text_thumb_number_font_size_sm.'px;' : '';

		//text thumb subtitle style table
		$text_thumb_subtitle_style_sm = '';
		$text_thumb_subtitle_style_sm .= (isset($settings->text_thumb_subtitle_font_size_sm) && $settings->text_thumb_subtitle_font_size_sm) ? 'font-size:'.$settings->text_thumb_subtitle_font_size_sm.'px;' : '';

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($timer_style_sm){
				$css .= $addon_id . ' .sp-indicator-container {';
					$css .= $timer_style_sm;
				$css .= '}';
			}
			if($content_container_width_sm && $content_container_option !== 'bootstrap'){
				$css .= $addon_id . ' .sp-slider .sp-slider-content-wrap {';
					$css .= 'width: ' . $content_container_width_sm . '%;margin: 0 auto;';
				$css .= '}';
			}

			if($arrow_ctlr_width_sm || $arrow_ctlr_height_sm || $arrow_ctlr_fontsize_sm){
				if($arrow_ctlr_height_sm){
					$css .= $addon_id . ' .sp-slider .sp-nav-control {';
						$css .= 'height: '.$arrow_ctlr_height_sm.'px;';
					$css .= '}';
				}
				$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control {';
					if($arrow_ctlr_width_sm){
						$css .= 'width: '.$arrow_ctlr_width_sm.'px;';
					}
					if($arrow_ctlr_height_sm){
						$css .= 'height: '.$arrow_ctlr_height_sm.'px;';
					}
					if($arrow_ctlr_fontsize_sm){
						$css .= 'font-size: '.$arrow_ctlr_fontsize_sm.'px;';
					}
				$css .= '}';

				$css .= $addon_id . ' div[class*="arrow-position-bottom"].sp-slider .sp-nav-control {';
					if($arrow_ctlr_width_sm){
						$css .= 'width: '.(($arrow_ctlr_width_sm * 2)+20).'px;';
					}
				$css .= '}';

				if($arrow_controllers_style==='spread' && $arrow_ctlr_height_sm){
					$css .= $addon_id . ' .sp-slider .sp-nav-control {';
						$css .= 'top: -'.$arrow_ctlr_height_sm.'px;';
					$css .= '}';
				}
				$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control{';
					if(!$arrow_ctlr_border_width){
						$arrow_ctlr_border_width = 1;
					}
					if($arrow_ctlr_height_sm){
						$css .= 'line-height: '.($arrow_ctlr_height_sm-($arrow_ctlr_border_width*2)).'px;';
					}
				$css .= '}';
				$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control i{';
					if(!$arrow_ctlr_border_width){
						$arrow_ctlr_border_width = 1;
					}
					if($arrow_ctlr_height_sm){
						$css .= 'line-height: '.($arrow_ctlr_height_sm-($arrow_ctlr_border_width*2)).'px;';
					}
				$css .= '}';

			}
			//Dot/line tablet css
			if($dot_controllers_position === 'bottom_center' && $dot_controllers_bottom_gap_sm){
				$css .= $addon_id . ' .sp-slider .sp-dots{';
					$css .= $dot_controllers_bottom_gap_sm;
				$css .= '}';
			}
			if($dot_controllers_position === 'bottom_left' && ($dot_controllers_bottom_gap_sm || $dot_controllers_left_gap_sm)){
				$css .= $addon_id . ' .sp-slider .sp-dots{';
					$css .= $dot_controllers_bottom_gap_sm;
				$css .= '}';
				$css .= $addon_id . ' .dot-controller-position-bottom_left.sp-slider .sp-dots{';
					$css .= $dot_controllers_left_gap_sm;
				$css .= '}';
			}
			if($dot_controllers_position === 'bottom_right' && ($dot_controllers_bottom_gap_sm || $dot_controllers_right_gap_sm)){
				$css .= $addon_id . ' .sp-slider .sp-dots{';
					$css .= $dot_controllers_bottom_gap_sm;
				$css .= '}';
				$css .= $addon_id . ' .dot-controller-position-bottom_right.sp-slider .sp-dots{';
					$css .= $dot_controllers_right_gap_sm;
				$css .= '}';
			}
			if($dot_controllers_position === 'vertical_left' && $dot_controllers_left_gap_sm){
				$css .= $addon_id . ' .dot-controller-position-vertical_left.sp-slider .sp-dots{';
					$css .= $dot_controllers_left_gap_sm;
				$css .= '}';
			}
			if($dot_controllers_position === 'vertical_right' && $dot_controllers_right_gap_sm){
				$css .= $addon_id . ' .dot-controller-position-vertical_right.sp-slider .sp-dots{';
					$css .= $dot_controllers_right_gap_sm;
				$css .= '}';
			}
			//Arrow gap tablet css
			if($arrow_controllers_position=='bottom_center' && $arrow_controllers_bottom_gap_sm){
				$css .= $addon_id . ' .sp-slider.arrow-position-bottom_center .sp-nav-control {';
					$css .= $arrow_controllers_bottom_gap_sm;
				$css .= '}';
			}
			if($arrow_controllers_position=='bottom_left' && ($arrow_controllers_left_gap_sm || $arrow_controllers_bottom_gap_sm)){
				$css .= $addon_id . ' .sp-slider.arrow-position-bottom_left .sp-nav-control {';
					$css .= $arrow_controllers_bottom_gap_sm;
					$css .= $arrow_controllers_left_gap_sm;
				$css .= '}';
			}
			if($arrow_controllers_position=='bottom_right' && ($arrow_controllers_right_gap_sm || $arrow_controllers_bottom_gap_sm)){
				$css .= $addon_id . ' .sp-slider.arrow-position-bottom_right .sp-nav-control {';
					$css .= $arrow_controllers_bottom_gap_sm;
					$css .= $arrow_controllers_right_gap_sm;
				$css .= '}';
			}
			//Spread arrow tablet css
			if($arrow_controllers_style==='spread' && ($arrow_spread_controllers_left_gap_sm || $arrow_spread_controllers_right_gap_sm)){
				$css .= $addon_id . ' div.sp-slider .sp-nav-control {';
					$css .= $arrow_spread_controllers_left_gap_sm;
					$css .= $arrow_spread_controllers_right_gap_sm;
				$css .= '}';
			}
			//Slide counter style
			if($slide_counter_style_sm && $slide_counter){
				$css .= $addon_id . ' .sp-slider .sp-slider_number{';
					$css .= $slide_counter_style_sm;
				$css .= '}';
			}

			//text thumbnail tablet style
			if($text_thumb_style_sm){
				$css .= $addon_id . ' .sp-slider-custom-dot-indecators {';
					$css .= $text_thumb_style_sm;
				$css .= '}';
			}
			if($text_thumb_ctlr_individual_width_sm){
				$css .= $addon_id . ' .sp-slider-custom-dot-indecators ul li {';
					$css .= $text_thumb_ctlr_individual_width_sm;
				$css .= '}';
			}
			if($text_thumb_number_style_sm){
				$css .= $addon_id . ' .sp-slider-text-thumb-number {';
					$css .= $text_thumb_number_style_sm;
				$css .= '}';
			}
			if($text_thumb_title_style_sm){
				$css .= $addon_id . ' .sp-slider-dot-indecator-text.sp-dot-text-key-1 {';
					$css .= $text_thumb_title_style_sm;
				$css .= '}';
			}
			if($text_thumb_subtitle_style_sm){
				$css .= $addon_id . ' .sp-slider-dot-indecator-text.sp-dot-text-key-2 {';
					$css .= $text_thumb_subtitle_style_sm;
				$css .= '}';
			}

		$css .= '}';

		//Mobile style
		//Timer
		$timer_style_xs = '';
		$timer_style_xs .= (isset($settings->timer_width_xs) && $settings->timer_width_xs) ? 'width: '.$settings->timer_width_xs.'%;' : '';
		$timer_style_xs .= (isset($settings->timer_top_gap_xs) && $settings->timer_top_gap_xs) ? 'top: '.$settings->timer_top_gap_xs.'px;' : '';
		$timer_style_xs .= (isset($settings->timer_left_gap_xs) && $settings->timer_left_gap_xs) ? 'left: '.$settings->timer_left_gap_xs.'px;' : '';
		//Content container
		$content_container_width_xs = (isset($settings->content_container_width_xs) && $settings->content_container_width_xs) ? $settings->content_container_width_xs : '';

		//Arrow Table style
		$arrow_ctlr_width_xs = (isset($settings->arrow_ctlr_width_xs) && $settings->arrow_ctlr_width_xs) ? $settings->arrow_ctlr_width_xs : '';
		$arrow_ctlr_height_xs = (isset($settings->arrow_ctlr_height_xs) && $settings->arrow_ctlr_height_xs) ? $settings->arrow_ctlr_height_xs : '';
		$arrow_ctlr_fontsize_xs = (isset($settings->arrow_ctlr_font_size_xs) && $settings->arrow_ctlr_font_size_xs) ? $settings->arrow_ctlr_font_size_xs : '';

		//Dot/line gap mobile style
		$dot_controllers_bottom_gap_xs = (isset($settings->dot_controllers_bottom_gap_xs) && $settings->dot_controllers_bottom_gap_xs) ? 'bottom: '.$settings->dot_controllers_bottom_gap_xs.'px;' : 'bottom:0px;';
		$dot_controllers_left_gap_xs = (isset($settings->dot_controllers_left_gap_xs) && $settings->dot_controllers_left_gap_xs) ? 'left: '.$settings->dot_controllers_left_gap_xs.'px;' : 'left:0px;';
		$dot_controllers_right_gap_xs = (isset($settings->dot_controllers_right_gap_xs) && $settings->dot_controllers_right_gap_xs) ? 'right: '.$settings->dot_controllers_right_gap_xs.'px;' : 'right:0px;';

		//Arrow gap mobile style
		$arrow_controllers_bottom_gap_xs = (isset($settings->arrow_controllers_bottom_gap_xs) && $settings->arrow_controllers_bottom_gap_xs) ? 'bottom: '.$settings->arrow_controllers_bottom_gap_xs.'px;' : 'bottom:0px;';
		$arrow_controllers_left_gap_xs = (isset($settings->arrow_controllers_left_gap_xs) && $settings->arrow_controllers_left_gap_xs) ? 'left: '.$settings->arrow_controllers_left_gap_xs.'px;' : 'left:0px;';
		$arrow_controllers_right_gap_xs = (isset($settings->arrow_controllers_right_gap_xs) && $settings->arrow_controllers_right_gap_xs) ? 'right: '.$settings->arrow_controllers_right_gap_xs.'px;' : 'right:0px;';
		//Spread arrow gap mobile style
		$arrow_spread_controllers_left_gap_xs = (isset($settings->arrow_spread_controllers_left_gap_xs) && $settings->arrow_spread_controllers_left_gap_xs) ? 'left: '.$settings->arrow_spread_controllers_left_gap_xs.'px;' : 'left:0px;';
		$arrow_spread_controllers_right_gap_xs = (isset($settings->arrow_spread_controllers_right_gap_xs) && $settings->arrow_spread_controllers_right_gap_xs) ? 'right: '.$settings->arrow_spread_controllers_right_gap_xs.'px;' : 'right:0px;';
		//Slide Counter mobile Style
		$slide_counter_style_xs = '';
		$slide_counter_style_xs .= (isset($settings->slide_counter_fontsize_xs) && $settings->slide_counter_fontsize_xs) ? 'font-size:'.$settings->slide_counter_fontsize_xs.'px;' : '';
		$slide_counter_style_xs .= (isset($settings->slide_counter_padding_xs) && trim($settings->slide_counter_padding_xs)) ? 'padding:'.$settings->slide_counter_padding_xs.';' : '';
		$slide_counter_style_xs .= (isset($settings->slide_counter_gap_bottom_xs) && $settings->slide_counter_gap_bottom_xs) ? 'bottom:'.$settings->slide_counter_gap_bottom_xs.'px;' : 'bottom:0px;';
		$slide_counter_style_xs .= (isset($settings->slide_counter_gap_left_xs) && $settings->slide_counter_gap_left_xs) ? 'left:'.$settings->slide_counter_gap_left_xs.'px;' : 'left:0px;';

		//Text thumbnail style
		$text_thumb_style_xs = '';
		$text_thumb_style_xs .= (isset($settings->text_thumb_ctlr_wrap_padding_xs) && trim($settings->text_thumb_ctlr_wrap_padding_xs)) ? 'padding:'.$settings->text_thumb_ctlr_wrap_padding_xs.';' : '';
		$text_thumb_style_xs .= (isset($settings->text_thumb_ctlr_wrap_width_xs) && $settings->text_thumb_ctlr_wrap_width_xs) ? 'width:'.$settings->text_thumb_ctlr_wrap_width_xs.'%;' : '';

		$text_thumb_ctlr_individual_width_xs = (isset($settings->text_thumb_ctlr_individual_width_xs) && $settings->text_thumb_ctlr_individual_width_xs) ? 'width:'.$settings->text_thumb_ctlr_individual_width_xs.'px;' : '';
		//thumb title style
		$text_thumb_title_style_xs = '';
		$text_thumb_title_style_xs .= (isset($settings->text_thumb_title_font_size_xs) && $settings->text_thumb_title_font_size_xs) ? 'font-size:'.$settings->text_thumb_title_font_size_xs.'px;' : '';
		$text_thumb_title_style_xs .= (isset($settings->text_thumb_title_lineheight_xs) && $settings->text_thumb_title_lineheight_xs) ? 'line-height:'.$settings->text_thumb_title_lineheight_xs.'px;' : '';
		// text thumb number style mobile
		$text_thumb_number_style_xs = '';
		$text_thumb_number_style_xs .= (isset($settings->text_thumb_number_font_size_xs) && $settings->text_thumb_number_font_size_xs) ? 'font-size:'.$settings->text_thumb_number_font_size_xs.'px;' : '';

		//text thumb subtitle style table
		$text_thumb_subtitle_style_xs = '';
		$text_thumb_subtitle_style_xs .= (isset($settings->text_thumb_subtitle_font_size_xs) && $settings->text_thumb_subtitle_font_size_xs) ? 'font-size:'.$settings->text_thumb_subtitle_font_size_xs.'px;' : '';

		$css .= '@media (max-width: 767px) {';
			if($timer_style_xs){
				$css .= $addon_id . ' .sp-indicator-container {';
					$css .= $timer_style_xs;
				$css .= '}';
			}
			if($content_container_width_xs && $content_container_option!=='bootstrap'){
				$css .= $addon_id . ' .sp-slider .sp-slider-content-wrap {';
					$css .= 'width: ' . $content_container_width_xs . '%;margin: 0 auto;';
				$css .= '}';
			}

			if($arrow_ctlr_width_xs || $arrow_ctlr_height_xs || $arrow_ctlr_fontsize_xs){
				if($arrow_ctlr_height_xs){
					$css .= $addon_id . ' .sp-slider .sp-nav-control {';
						$css .= 'height: '.$arrow_ctlr_height_xs.'px;';
					$css .= '}';
				}
				$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control {';
					if($arrow_ctlr_width_xs){
						$css .= 'width: '.$arrow_ctlr_width_xs.'px;';
					}
					if($arrow_ctlr_height_xs){
						$css .= 'height: '.$arrow_ctlr_height_xs.'px;';
					}
					if($arrow_ctlr_fontsize_xs){
						$css .= 'font-size: '.$arrow_ctlr_fontsize_xs.'px;';
					}
				$css .= '}';

				$css .= $addon_id . ' div[class*="arrow-position-bottom"].sp-slider .sp-nav-control {';
					if($arrow_ctlr_width_xs){
						$css .= 'width: '.(($arrow_ctlr_width_xs * 2)+20).'px;';
					}
				$css .= '}';

				if($arrow_controllers_style==='spread' && $arrow_ctlr_height_xs){
					$css .= $addon_id . ' .sp-slider .sp-nav-control {';
						$css .= 'top: -'.$arrow_ctlr_height_xs.'px;';
					$css .= '}';
				}
				$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control{';
					if(!$arrow_ctlr_border_width){
						$arrow_ctlr_border_width = 1;
					}
					if($arrow_ctlr_height_xs){
						$css .= 'line-height: '.($arrow_ctlr_height_xs-($arrow_ctlr_border_width*2)).'px;';
					}
				$css .= '}';
				$css .= $addon_id . ' .sp-slider .sp-nav-control .nav-control i{';
					if(!$arrow_ctlr_border_width){
						$arrow_ctlr_border_width = 1;
					}
					if($arrow_ctlr_height_xs){
						$css .= 'line-height: '.($arrow_ctlr_height_xs-($arrow_ctlr_border_width*2)).'px;';
					}
				$css .= '}';
			}
			//Dot/line mobile style
			if($dot_controllers_position === 'bottom_center' && $dot_controllers_bottom_gap_xs){
				$css .= $addon_id . ' .sp-slider .sp-dots{';
					$css .= $dot_controllers_bottom_gap_xs;
				$css .= '}';
			}
			if($dot_controllers_position === 'bottom_left' && ($dot_controllers_bottom_gap_xs || $dot_controllers_left_gap_xs)){
				$css .= $addon_id . ' .sp-slider .sp-dots{';
					$css .= $dot_controllers_bottom_gap_xs;
				$css .= '}';
				$css .= $addon_id . ' .dot-controller-position-bottom_left.sp-slider .sp-dots{';
					$css .= $dot_controllers_left_gap_xs;
				$css .= '}';
			}
			if($dot_controllers_position === 'bottom_right' && ($dot_controllers_bottom_gap_xs || $dot_controllers_right_gap_xs)){
				$css .= $addon_id . ' .sp-slider .sp-dots{';
					$css .= $dot_controllers_bottom_gap_xs;
				$css .= '}';
				$css .= $addon_id . ' .dot-controller-position-bottom_right.sp-slider .sp-dots{';
					$css .= $dot_controllers_right_gap_xs;
				$css .= '}';
			}
			if($dot_controllers_position === 'vertical_left' && $dot_controllers_left_gap_xs){
				$css .= $addon_id . ' .dot-controller-position-vertical_left.sp-slider .sp-dots{';
					$css .= $dot_controllers_left_gap_xs;
				$css .= '}';
			}
			if($dot_controllers_position === 'vertical_right' && $dot_controllers_right_gap_xs){
				$css .= $addon_id . ' .dot-controller-position-vertical_right.sp-slider .sp-dots{';
					$css .= $dot_controllers_right_gap_xs;
				$css .= '}';
			}

			//Arrow mobile css
			if($arrow_controllers_position=='bottom_center' && $arrow_controllers_bottom_gap_xs){
				$css .= $addon_id . ' .sp-slider.arrow-position-bottom_center .sp-nav-control {';
					$css .= $arrow_controllers_bottom_gap_xs;
				$css .= '}';
			}
			if($arrow_controllers_position=='bottom_left' && ($arrow_controllers_left_gap_xs || $arrow_controllers_bottom_gap_xs)){
				$css .= $addon_id . ' .sp-slider.arrow-position-bottom_left .sp-nav-control {';
					$css .= $arrow_controllers_bottom_gap_xs;
					$css .= $arrow_controllers_left_gap_xs;
				$css .= '}';
			}
			if($arrow_controllers_position=='bottom_right' && ($arrow_controllers_right_gap_xs || $arrow_controllers_bottom_gap_xs)){
				$css .= $addon_id . ' .sp-slider.arrow-position-bottom_right .sp-nav-control {';
					$css .= $arrow_controllers_bottom_gap_xs;
					$css .= $arrow_controllers_right_gap_xs;
				$css .= '}';
			}

			//Spread arrow mobile css
			if($arrow_controllers_style==='spread' && ($arrow_spread_controllers_left_gap_xs || $arrow_spread_controllers_right_gap_xs)){
				$css .= $addon_id . ' div.sp-slider .sp-nav-control {';
					$css .= $arrow_spread_controllers_left_gap_xs;
					$css .= $arrow_spread_controllers_right_gap_xs;
				$css .= '}';
			}
			//Slider counter style
			if($slide_counter_style_xs && $slide_counter){
				$css .= $addon_id . ' .sp-slider .sp-slider_number{';
					$css .= $slide_counter_style_xs;
				$css .= '}';
			}
			//text thumbnail mobile style
			if($text_thumb_style_xs){
				$css .= $addon_id . ' .sp-slider-custom-dot-indecators {';
					$css .= $text_thumb_style_xs;
				$css .= '}';
			}

			if($text_thumb_ctlr_individual_width_xs){
				$css .= $addon_id . ' .sp-slider-custom-dot-indecators ul li {';
					$css .= $text_thumb_ctlr_individual_width_xs;
				$css .= '}';
			}

			if($text_thumb_title_style_xs){
				$css .= $addon_id . ' .sp-slider-dot-indecator-text.sp-dot-text-key-1 {';
					$css .= $text_thumb_title_style_xs;
				$css .= '}';
			}
			if($text_thumb_number_style_xs){
				$css .= $addon_id . ' .sp-slider-text-thumb-number {';
					$css .= $text_thumb_number_style_xs;
				$css .= '}';
			}
			if($text_thumb_subtitle_style_xs){
				$css .= $addon_id . ' .sp-slider-dot-indecator-text.sp-dot-text-key-2 {';
					$css .= $text_thumb_subtitle_style_xs;
				$css .= '}';
			}

		$css .= '}';

		return $css;
	}

	 public static function getTemplate(){
		 $output = '

		 <style type="text/css">
			<# _.each (data.slideshow_items, function(item_value, item_key) {
				var slider_img = {}
				if (typeof item_value.slider_img !== "undefined" && typeof item_value.slider_img.src !== "undefined") {
					slider_img = item_value.slider_img
				} else {
					slider_img = {src: item_value.slider_img}
				}
				if(slider_img.src){
			#>
					#sppb-addon-{{ data.id }} #sp-slider-item-{{ data.id }}-num-{{ item_key }}-key .sp-background {
					<# if(slider_img.src?.indexOf("http://") == 0 || slider_img.src?.indexOf("https://") == 0){ #>
						background-image: url({{ slider_img.src }});
					<# } else { #>
						background-image: url({{ pagebuilder_base + slider_img.src }});
					<# } #>
					}
			<# }
		})
		let timer_style = "";
		timer_style += (!_.isEmpty(data.timer_bg_color) && data.timer_bg_color) ? `background: ${data.timer_bg_color};` : "";
		timer_style += (_.isObject(data.timer_width) && data.timer_width.md) ? `width: ${data.timer_width.md}%;` : "";
		timer_style += (_.isObject(data.timer_top_gap) && data.timer_top_gap.md) ? `top: ${data.timer_top_gap.md}px;` : "";
		timer_style += (_.isObject(data.timer_left_gap) && data.timer_left_gap.md) ? `left: ${data.timer_left_gap.md}px;` : "";
		let dot_ctlr_border_radius = data.dot_ctlr_border_radius || "0";
		#>

		<# if(data.timer_color){ #>
			#sppb-addon-{{ data.id }} .sp-dot-indicator-wrap .dot-indicator,
			#sppb-addon-{{ data.id }} .sp-indicator.line-indicator {
				background: {{data.timer_color}};
			}
		<# }
		if(data.timer_bg_color){
		#>
			#sppb-addon-{{ data.id }} .sp-dot-indicator-wrap{
				background: {{data.timer_bg_color}};
			}
		<#
		}
		if(timer_style){
		#>
			#sppb-addon-{{ data.id }} .sp-indicator-container {
				{{timer_style}}
			}
		<# }

		if(data.dot_controllers_position == "vertical_left" || data.dot_controllers_position == "vertical_right"){
		#>
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots {
				<# if(data.dot_ctlr_width){ #>
					max-width:{{data.dot_ctlr_width}}px;
					height:100%;
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul{
				<# if(data.dot_ctlr_width){ #>
					width:{{data.dot_ctlr_width}}px;
				<# } #>
			}
		<# } #>

		#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul li {
			<# if(data.dot_ctlr_bg){ #>
				background-color:{{data.dot_ctlr_bg}};
			<# }
			if(data.dot_ctlr_border_color){
			#>
				border-color:{{data.dot_ctlr_border_color}};
			<# }
			if(data.dot_ctlr_border_width){
			#>
				border-width:{{data.dot_ctlr_border_width}}px;
				border-style:solid;
			<# }
			if(dot_ctlr_border_radius){
			#>
				border-radius:{{dot_ctlr_border_radius}}px;
			<# }
			if(data.dot_ctlr_height){
			#>
				height:{{data.dot_ctlr_height}}px;
			<# }
			if(data.dot_ctlr_width){
			#>
				width:{{data.dot_ctlr_width}}px;
			<# }
			if(data.dot_ctlr_margin){
			#>
				margin:{{data.dot_ctlr_margin}};
			<# } #>
		}

		#sppb-addon-{{ data.id }} .sp-slider.dot-controller-line .sp-dots ul li.active span{
			<# if(data.dot_ctlr_hover_height){ #>
				height:{{data.dot_ctlr_hover_height}}px;
			<# }
			if(dot_ctlr_border_radius){ #>
				border-radius:{{dot_ctlr_border_radius}};
			<# }
			if(data.dot_ctlr_center_bg){
			#>
				background-color:{{data.dot_ctlr_center_bg}};
			<# } #>
		}
		#sppb-addon-{{ data.id }} .sp-slider.dot-controller-line .sp-dots ul li.active{
			<# if(dot_ctlr_border_radius){ #>
				border-radius:{{dot_ctlr_border_radius}};
			<# }
			if(data.dot_ctlr_hover_width){
			#>
				width:{{data.dot_ctlr_hover_width}}px;
			<# }
			if(data.dot_ctlr_hover_border_color){
			#>
				border-color:{{data.dot_ctlr_hover_border_color}};
			<# } #>
		}
		<# if(data.dot_controllers_style !== "line"){ #>
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul li span,
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul li:hover span,
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul li:hover:after,
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul li:after{
				<# if(data.dot_controllers_style!=="with_image"){
					if(data.dot_ctlr_center_bg){
				#>
						background-color:{{data.dot_ctlr_center_bg}};
					<# }
				}
				if(dot_ctlr_border_radius){
				#>
					border-radius:{{dot_ctlr_border_radius}};
				<# }
				if(data.dot_ctlr_hover_height){
				#>
					height:{{data.dot_ctlr_hover_height}}px;
				<# }
				if(data.dot_ctlr_hover_width){
				#>
					width:{{data.dot_ctlr_hover_width}}px;
				<# } #>
			}
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots ul li.active{
				<# if(data.dot_ctlr_hover_border_color){ #>
					border-color:{{data.dot_ctlr_hover_border_color}};
				<# } #>
			}
		<# } #>


		<# if(data.dot_controllers_position === "bottom_center" && _.isObject(data.dot_controllers_bottom_gap)){ #>
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
				bottom: {{data.dot_controllers_bottom_gap.md}}px;
			}
		<# }
		if(data.dot_controllers_position === "bottom_left" && (_.isObject(data.dot_controllers_bottom_gap) || _.isObject(data.dot_controllers_left_gap))){
		#>
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
				bottom: {{data.dot_controllers_bottom_gap.md}}px;
			}
			#sppb-addon-{{ data.id }} .dot-controller-position-bottom_left.sp-slider .sp-dots{
				left: {{data.dot_controllers_left_gap.md}}px;
			}
		<# }
		if(data.dot_controllers_position === "bottom_right" && (_.isObject(data.dot_controllers_bottom_gap) || _.isObject(data.dot_controllers_right_gap))){
		#>
			#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
				bottom: {{data.dot_controllers_bottom_gap.md}}px;
			}
			#sppb-addon-{{ data.id }} .dot-controller-position-bottom_right.sp-slider .sp-dots{
				right: {{data.dot_controllers_right_gap.md}}px;
			}
		<# }
		if(data.dot_controllers_position === "vertical_left" && _.isObject(data.dot_controllers_left_gap)){
		#>
			#sppb-addon-{{ data.id }} .dot-controller-position-vertical_left.sp-slider .sp-dots{
				left: {{data.dot_controllers_left_gap.md}}px;
			}
		<# }
		if(data.dot_controllers_position === "vertical_right" && _.isObject(data.dot_controllers_right_gap)){
		#>
			#sppb-addon-{{ data.id }} .dot-controller-position-vertical_right.sp-slider .sp-dots{
				right: {{data.dot_controllers_right_gap.md}}px;
			}
		<# }
		if(_.isObject(data.arrow_controllers_style !== "spread" && data.arrow_ctlr_height)){
		#>
			#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control{
				height: {{data.arrow_ctlr_height.md}}px;
			}
		<# } #>
		#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control {
			<# if(data.arrow_ctlr_background){ #>
				background: {{data.arrow_ctlr_background}};
			<# }
			if(data.arrow_ctlr_border_color){
			#>
				border-color: {{data.arrow_ctlr_border_color}};
			<# }
			let arrow_radius = data.arrow_ctlr_border_radius || "0";
			if(arrow_radius){
			#>
				border-radius: {{arrow_radius}}px;
			<# }
			if(!data.arrow_ctlr_border_width){
				data.arrow_ctlr_border_width = 1;
			}
			if(data.arrow_ctlr_border_width){
			#>
				border-width: {{data.arrow_ctlr_border_width}}px;
			<# } else { #>
				border-width: 0px;
			<# }
			if(data.arrow_ctlr_color){
			#>
				color: {{data.arrow_ctlr_color}};
			<# }
			if(_.isObject(data.arrow_ctlr_width)){
			#>
				width: {{data.arrow_ctlr_width.md}}px;
			<# }
			if(_.isObject(data.arrow_ctlr_height)){
			#>
				height: {{data.arrow_ctlr_height.md}}px;
			<# }
			if(_.isObject(data.arrow_ctlr_font_size)){
			#>
				font-size: {{data.arrow_ctlr_font_size.md}}px;
			<# } #>
		}

		#sppb-addon-{{ data.id }} div[class*="arrow-position-bottom"].sp-slider .sp-nav-control {
			<#
			if(_.isObject(data.arrow_ctlr_width) && !data.arrow_ctlr_width.md){
				data.arrow_ctlr_width.md = 70;
			}
			if(_.isObject(data.arrow_ctlr_width)){ #>
				width: {{(data.arrow_ctlr_width.md * 2)+20}}px;
			<# } #>
		}
		<# if(data.arrow_controllers_style == "spread" && data.arrow_ctlr_height){ #>
			#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control {
				<# if(_.isObject(data.arrow_ctlr_height)){ #>
					top: -{{data.arrow_ctlr_height.md}}px;
				<# } #>
			}
		<# } #>

		#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control{
			<# if(!data.arrow_ctlr_border_width){
				data.arrow_ctlr_border_width = 1;
			}
			if(_.isObject(data.arrow_ctlr_height)){
			#>
				line-height: {{data.arrow_ctlr_height.md-(data.arrow_ctlr_border_width*2)}}px;
			<# } #>
		}
		#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control i{
			<# if(!data.arrow_ctlr_border_width){
				data.arrow_ctlr_border_width = 1;
			}
			if(_.isObject(data.arrow_ctlr_height)){
			#>
				line-height: {{data.arrow_ctlr_height.md-(data.arrow_ctlr_border_width*2)}}px;
			<# } #>
		}

		<# if(data.arrow_controllers_position=="bottom_center" && data.arrow_controllers_bottom_gap){ #>
			#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_center .sp-nav-control {
				bottom: {{data.arrow_controllers_bottom_gap.md}}px;
			}
		<# }
		if(data.arrow_controllers_position=="bottom_left" && data.arrow_controllers_left_gap){
		#>
			#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_left .sp-nav-control {
				bottom: {{data.arrow_controllers_bottom_gap.md}}px;
				left: {{data.arrow_controllers_left_gap.md}}px;
			}
		<# }
		if(data.arrow_controllers_position=="bottom_right" && data.arrow_controllers_right_gap){
		#>
			#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_right .sp-nav-control {
				bottom: {{data.arrow_controllers_bottom_gap.md}}px;
				right: {{data.arrow_controllers_right_gap.md}}px;
			}
		<# } #>

		<# if(data.arrow_controllers_style==="spread" && (data.arrow_spread_controllers_left_gap || data.arrow_spread_controllers_right_gap)){ #>
			#sppb-addon-{{ data.id }} div.sp-slider .sp-nav-control {
				left: {{data.arrow_spread_controllers_left_gap.md}}px;
				right: {{data.arrow_spread_controllers_right_gap.md}}px;
			}
		<# } #>

		#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control:hover {
			<# if(data.arrow_ctlr_hover_background){ #>
				background: {{data.arrow_ctlr_hover_background}};
			<# }
			if(data.arrow_ctlr_hover_border_color){
			#>
				border-color: {{data.arrow_ctlr_hover_border_color}};
			<# }
			if(data.arrow_ctlr_hover_color){
			#>
				color: {{data.arrow_ctlr_hover_color}};
			<# } #>
		}

		<#
		let slide_counter_style = "";
		slide_counter_style += (!_.isEmpty(data.slide_counter_color) && data.slide_counter_color) ? `color:${data.slide_counter_color};` : "";
		slide_counter_style += (!_.isEmpty(data.slide_counter_fontsize) && data.slide_counter_fontsize.md) ? `font-size:${data.slide_counter_fontsize.md}px;` : "";
		slide_counter_style += (!_.isEmpty(data.slide_counter_fontfamily) && data.slide_counter_fontfamily) ? `font-family:${data.slide_counter_fontfamily};` : "";
		slide_counter_style += (!_.isEmpty(data.slide_counter_bg_color) && data.slide_counter_bg_color) ? `background:${data.slide_counter_bg_color};` : "";
		slide_counter_style += (!_.isEmpty(data.slide_counter_gap_bottom) && data.slide_counter_gap_bottom.md) ? `bottom:${data.slide_counter_gap_bottom.md}px;` : "";
		slide_counter_style += (!_.isEmpty(data.slide_counter_gap_left) && data.slide_counter_gap_left.md) ? `left:${data.slide_counter_gap_left.md}px;` : "";

		if(slide_counter_style && data.slide_counter){
		#>
			#sppb-addon-{{ data.id }} .sp-slider .sp-slider_number{
				<# if(_.isObject(data.slide_counter_padding)){ #>
					padding:{{data.slide_counter_padding.md}};
				<# } else { #>
					padding:{{data.slide_counter_padding}};
				<# } #>
				{{slide_counter_style}}
			}
		<# }

		if(!_.isEmpty(data.slideshow_items) && data.slideshow_items){
			_.each (data.slideshow_items, function(item_value, item_key){

				let uniqid = `#sp-slider-item-${data.id}-num-${item_key}-key`;
		#>
				#sppb-addon-{{ data.id }} .dot-controller-with_image.sp-slider .sp-dots ul li.sp-dot-{{item_key}}{
					<#
					var slider_img = {}
					if (typeof item_value.slider_img !== "undefined" && typeof item_value.slider_img.src !== "undefined") {
						slider_img = item_value.slider_img
					} else {
						slider_img = {src: item_value.slider_img}
					}
					if(slider_img.src){
						if(slider_img.src?.indexOf("http://") == 0 || slider_img.src?.indexOf("https://") == 0){
					#>
							background: url({{slider_img.src}}) no-repeat scroll center center / cover;
						<# } else { #>
							background: url({{pagebuilder_base + slider_img.src}}) no-repeat scroll center center / cover;
						<# }
					} #>
				}

				<# if(item_value.slider_overlay_options !== "undefined" && item_value.slider_overlay_options === "color_overlay"){
					if(!_.isEmpty(item_value.slider_bg_overlay) && item_value.slider_bg_overlay){
				#>
						#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-background:after,
						#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-video-background-mask {
							background:{{item_value.slider_bg_overlay}};
						}
					<# }
				} #>

				<#
					if(!_.isEmpty(item_value.slider_bg_gradient_overlay) && item_value.slider_bg_gradient_overlay){

						let slider_bg_gradient_overlay = (!_.isEmpty(item_value.slider_bg_gradient_overlay) && item_value.slider_bg_gradient_overlay) ? item_value.slider_bg_gradient_overlay : "";
						let overlay_gradient_color1 = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.color) ? slider_bg_gradient_overlay.color : "";
						let overlay_gradient_color2 = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.color2) ? slider_bg_gradient_overlay.color2 : "";
						let overlay_degree = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.deg) ? slider_bg_gradient_overlay.deg : "45";
						let overlay_type = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.type) ? slider_bg_gradient_overlay.type : "linear";
						let overlay_radialPos = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.radialPos) ? slider_bg_gradient_overlay.radialPos : "";
						let overlay_radial_angle1 = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.pos) ? slider_bg_gradient_overlay.pos : "10";
						let overlay_radial_angle2 = (_.isObject(slider_bg_gradient_overlay) && slider_bg_gradient_overlay.pos2) ? slider_bg_gradient_overlay.pos2 : "100";
				#>
						#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-background:after,
						#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-video-background-mask {
							<# if(overlay_type!=="radial"){ #>
								background: -webkit-linear-gradient({{overlay_degree}}deg, {{overlay_gradient_color1}} {{overlay_radial_angle1}}%, {{overlay_gradient_color2}} {{overlay_radial_angle2}}%) transparent;
								background: linear-gradient({{overlay_degree}}deg, {{overlay_gradient_color1}} {{overlay_radial_angle1}}%, {{overlay_gradient_color2}} {{overlay_radial_angle2}}%) transparent;
							<# } else { #>
								background: -webkit-radial-gradient(at {{overlay_radialPos}}, {{overlay_gradient_color1}} {{overlay_radial_angle1}}%, {{overlay_gradient_color2}} {{overlay_radial_angle2}}%) transparent;
								background: radial-gradient(at {{overlay_radialPos}}, {{overlay_gradient_color1}} {{overlay_radial_angle1}}%, {{overlay_gradient_color2}} {{overlay_radial_angle2}}%) transparent;
							<# } #>
						}
					<# } #>

				<# if(item_value.video_volume_btn !== "undefined" && item_value.video_volume_btn){ #>
					#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-video-control {
						display:block;
					}
				<# } else { #>
					#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-video-control {
						display:none;
					}
				<# } #>

				<# if(!_.isEmpty(item_value.slideshow_inner_items)){
					_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
						let inner_uniqid = `#sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
				#>

						<#

						let content_style = "";
						let content_style_sm = "";
						let content_style_xs = "";

						if(inner_value.content_type !== "image_content"){
							content_style += (!_.isEmpty(inner_value.content_color) && inner_value.content_color) ? `color:${inner_value.content_color};` : "";
							content_style += (!_.isEmpty(inner_value.content_fontsize) && inner_value.content_fontsize.md) ? `font-size:${inner_value.content_fontsize.md}px;` : "";
							content_style += (!_.isEmpty(inner_value.content_lineheight) && inner_value.content_lineheight.md) ? `line-height:${inner_value.content_lineheight.md}px;` : "";
							if(!_.isEmpty(inner_value.content_letterspacing) && inner_value.content_letterspacing){
								content_style += (inner_value.content_letterspacing !== "custom") ? `letter-spacing:${inner_value.content_letterspacing};` : "";
								content_style += (inner_value.content_letterspacing === "custom" && inner_value.custom_letterspacing) ? `letter-spacing:${inner_value.custom_letterspacing};` : "";
							}

							content_style_sm += (!_.isEmpty(inner_value.content_fontsize) && inner_value.content_fontsize.sm) ? `font-size:${inner_value.content_fontsize.sm}px;` : "";
							content_style_sm += (!_.isEmpty(inner_value.content_lineheight) && inner_value.content_lineheight.sm) ? `line-height:${inner_value.content_lineheight.sm}px;` : "";

							content_style_xs += (!_.isEmpty(inner_value.content_fontsize) && inner_value.content_fontsize.xs) ? `font-size:${inner_value.content_fontsize.xs}px;` : "";
							content_style_xs += (!_.isEmpty(inner_value.content_lineheight) && inner_value.content_lineheight.xs) ? `line-height:${inner_value.content_lineheight.xs}px;` : "";

							if(_.isObject(inner_value.content_text_shadow)){
								let ho = inner_value.content_text_shadow.ho || 0,
									vo = inner_value.content_text_shadow.vo || 0,
									blur = inner_value.content_text_shadow.blur || 0,
									color = inner_value.content_text_shadow.color || 0;

									content_style += `text-shadow: ${ho}px ${vo}px ${blur}px ${color};`;
							}
						}
						if(inner_value.content_type !== "btn_content"){
							content_style += (!_.isEmpty(inner_value.content_background) && inner_value.content_background) ? `background:${inner_value.content_background};` : "";
							content_style += (!_.isEmpty(inner_value.content_margin) && inner_value.content_margin && _.trim(inner_value.content_margin.md)) ? `margin:${inner_value.content_margin.md};` : "";

							content_style_sm += (!_.isEmpty(inner_value.content_margin) && inner_value.content_margin && _.trim(inner_value.content_margin.sm)) ? `margin:${inner_value.content_margin.sm};` : "";

							content_style_xs += (!_.isEmpty(inner_value.content_margin) && inner_value.content_margin && _.trim(inner_value.content_margin.xs)) ? `margin:${inner_value.content_margin.xs};` : "";
						}

						if(inner_value.content_type == "btn_content" || inner_value.content_type == "image_content"){
							if(_.isObject(inner_value.btn_box_shadow)){
								let ho = inner_value.btn_box_shadow.ho || 0,
									vo = inner_value.btn_box_shadow.vo || 0,
									blur = inner_value.btn_box_shadow.blur || 0,
									spread = inner_value.btn_box_shadow.spread || 0,
									color = inner_value.btn_box_shadow.color || 0;

									content_style += `box-shadow: ${ho}px ${vo}px ${blur}px ${spread}px ${color};`;
							}
						}

						content_style += (!_.isEmpty(inner_value.content_border) && _.trim(inner_value.content_border)) ? `border-width:${inner_value.content_border};border-style: solid;` : "";
						content_style += (!_.isEmpty(inner_value.content_border_color) && inner_value.content_border_color) ? `border-color:${inner_value.content_border_color};` : "";
						content_style += (!_.isEmpty(inner_value.content_border_radius) && inner_value.content_border_radius) ? `border-radius:${inner_value.content_border_radius}px;` : "";
						content_style += (!_.isEmpty(inner_value.content_padding) && inner_value.content_padding && _.trim(inner_value.content_padding.md)) ? `padding:${inner_value.content_padding.md};` : "";
						content_style_sm += (!_.isEmpty(inner_value.content_padding) && inner_value.content_padding && _.trim(inner_value.content_padding.sm)) ? `padding:${inner_value.content_padding.sm};` : "";
						content_style_xs += (!_.isEmpty(inner_value.content_padding) && inner_value.content_padding && _.trim(inner_value.content_padding.xs)) ? `padding:${inner_value.content_padding.xs};` : "";

						if(inner_value.content_type !== "icon_content"){
							content_style += (!_.isEmpty(inner_value.content_font_family) && inner_value.content_font_family) ? `font-family:${inner_value.content_font_family};` : "";

							if(_.isObject(inner_value.content_font_style) && inner_value.content_font_style.underline){
								content_style += `text-decoration:underline;`;
							}
							if(_.isObject(inner_value.content_font_style) && inner_value.content_font_style.italic){
								content_style += `font-style:italic;`;
							}
							if(_.isObject(inner_value.content_font_style) && inner_value.content_font_style.uppercase){
								content_style += `text-transform:uppercase;`;
							}
							if(_.isObject(inner_value.content_font_style) && inner_value.content_font_style.weight){
								content_style += `font-weight:${inner_value.content_font_style.weight};`;
							}
						}

						if(inner_value.content_type !== "btn_content"){
				#>
							.sp-slider {{uniqid}} {{inner_uniqid}} {
								{{content_style}}
							}
						<# }

						let image_content_style = "";
						let image_content_style_sm = "";
						let image_content_style_xs = "";

						var image_content = {}
						if(!_.isEmpty(inner_value.image_content) && inner_value.image_content){
							if (typeof inner_value.image_content !== "undefined" && typeof inner_value.image_content.src !== "undefined") {
								image_content = inner_value.image_content
							} else {
								image_content = {src: inner_value.image_content}
							}
						}

						if(image_content.src){
							if(image_content.src?.indexOf("http://") == 0 || image_content.src?.indexOf("https://") == 0){
								image_content_style += `background-image:url(${image_content.src});background-size:100% 100%;background-position:center center;background-attachment:scroll;background-repeat: no-repeat;`;
							} else {
								image_content_style += `background-image:url(${image_content.src});background-size:100% 100%;background-position:center center;background-attachment:scroll;background-repeat: no-repeat;`;
							}
						}
						image_content_style += (!_.isEmpty(inner_value.image_content_height) && inner_value.image_content_height.md) ? `height:${inner_value.image_content_height.md}px;` : "height:385px;";
						image_content_style += (!_.isEmpty(inner_value.image_content_width) && inner_value.image_content_width.md) ? `width:${inner_value.image_content_width.md}px;` : "width:400px;";

						image_content_style_sm += (!_.isEmpty(inner_value.image_content_height) && inner_value.image_content_height && inner_value.image_content_height.sm) ? `height:${inner_value.image_content_height.sm}px;` : "";
						image_content_style_sm += (!_.isEmpty(inner_value.image_content_width) && inner_value.image_content_width.sm) ? `width:${inner_value.image_content_width.sm}px;` : "";

						image_content_style_xs += (!_.isEmpty(inner_value.image_content_height) && inner_value.image_content_height && inner_value.image_content_height.xs) ? `height:${inner_value.image_content_height.xs}px;` : "";
						image_content_style_xs += (!_.isEmpty(inner_value.image_content_width) && inner_value.image_content_width.xs) ? `width:${inner_value.image_content_width.xs}px;` : "";

						#>

						.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image {
							{{image_content_style}}
						}
					<#
						let btn_content_style = "";
						let btn_hover_content_style = "";

						let btn_margin = (!_.isEmpty(inner_value.content_margin) && inner_value.content_margin && _.trim(inner_value.content_margin.md)) ? `margin: ${inner_value.content_margin.md};` : "";
						let btn_margin_sm = (!_.isEmpty(inner_value.content_margin) && inner_value.content_margin && _.trim(inner_value.content_margin.sm)) ? `margin: ${inner_value.content_margin.sm};` : "";
						let btn_margin_xs = (!_.isEmpty(inner_value.content_margin) && inner_value.content_margin && _.trim(inner_value.content_margin.xs)) ? `margin: ${inner_value.content_margin.xs};` : "";

						if(inner_value.button_background_options === "color_bg"){
							btn_content_style += (!_.isEmpty(inner_value.button_background_color) && inner_value.button_background_color) ? `background: ${inner_value.button_background_color};` : "";

							btn_hover_content_style += (!_.isEmpty(inner_value.button_background_color_hover) && inner_value.button_background_color_hover) ? `background: ${inner_value.button_background_color_hover};` : "";
						} else {
							let button_background_gradient = (!_.isEmpty(inner_value.button_background_gradient) && inner_value.button_background_gradient) ? inner_value.button_background_gradient : "";

							let gradient_color1 = (_.isObject(button_background_gradient) && button_background_gradient.color) ? button_background_gradient.color : "";
							let gradient_color2 = (_.isObject(button_background_gradient) && button_background_gradient.color2) ? button_background_gradient.color2 : "";
							let degree = (_.isObject(button_background_gradient) && button_background_gradient.deg) ? button_background_gradient.deg : "";
							let type = (_.isObject(button_background_gradient) && button_background_gradient.type) ? button_background_gradient.type : "";
							let radialPos = (_.isObject(button_background_gradient) && button_background_gradient.radialPos) ? button_background_gradient.radialPos : "";
							let radial_angle1 = (_.isObject(button_background_gradient) && button_background_gradient.pos) ? button_background_gradient.pos : "0";
							let radial_angle2 = (_.isObject(button_background_gradient) && button_background_gradient.pos2) ? button_background_gradient.pos2 : "100";

							if(type!=="radial"){
								btn_content_style += `background: -webkit-linear-gradient(${degree}deg, ${gradient_color1} ${radial_angle1}%, ${gradient_color2} ${radial_angle2}%) transparent;`;
								btn_content_style += `background: linear-gradient(${degree}deg, ${gradient_color1} ${radial_angle1}%, ${gradient_color2} ${radial_angle2}%) transparent;`;
							} else {
								btn_content_style += `background: -webkit-radial-gradient(at ${radialPos}, ${gradient_color1} ${radial_angle1}%, ${gradient_color2} ${radial_angle2}%) transparent;`;
								btn_content_style += `background: radial-gradient(at ${radialPos}, ${gradient_color1} ${radial_angle1}%, ${gradient_color2} ${radial_angle2}%) transparent;`;
							}

							let button_background_gradient_hover = (!_.isEmpty(inner_value.button_background_gradient_hover) && inner_value.button_background_gradient_hover) ? inner_value.button_background_gradient_hover : "";

							let gradient_hover_color1 = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.color) ? button_background_gradient_hover.color : "";
							let gradient_hover_color2 = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.color2) ? button_background_gradient_hover.color2 : "";
							let hover_degree = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.deg) ? button_background_gradient_hover.deg : "";
							let hover_type = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.type) ? button_background_gradient_hover.type : "";
							let hover_radialPos = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.radialPos) ? button_background_gradient_hover.radialPos : "";
							let hover_radial_angle1 = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.pos) ? button_background_gradient_hover.pos : "0";
							let hover_radial_angle2 = (_.isObject(button_background_gradient_hover) && button_background_gradient_hover.pos2) ? button_background_gradient_hover.pos2 : "100";

							if(hover_type!=="radial"){
								btn_hover_content_style += `background: -webkit-linear-gradient(${hover_degree}deg, ${gradient_hover_color1} ${hover_radial_angle1}%, ${gradient_hover_color2} ${hover_radial_angle2}%) transparent;`;
								btn_hover_content_style += `background: linear-gradient(${hover_degree}deg, ${gradient_hover_color1} ${hover_radial_angle1}%, ${gradient_hover_color2} ${hover_radial_angle2}%) transparent;`;
							} else {
								btn_hover_content_style += `background: -webkit-radial-gradient(at ${hover_radialPos}, ${gradient_hover_color1} ${hover_radial_angle1}%, ${gradient_hover_color2} ${hover_radial_angle2}%) transparent;`;
								btn_hover_content_style += `background: radial-gradient(at ${hover_radialPos}, ${gradient_hover_color1} ${hover_radial_angle1}%, ${gradient_hover_color2} ${hover_radial_angle2}%) transparent;`;
							}
						}

						if(btn_margin){
					#>
							.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button {
								{{btn_margin}}
							}
						<# } #>
						.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text{
							{{content_style}}
							{{btn_content_style}}
						}
					<#
						if(_.isObject(inner_value.button_icon_margin)){
					#>
							.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-icon{
								margin:{{inner_value.button_icon_margin.md}};
							}
						<# }

						btn_hover_content_style += (!_.isEmpty(inner_value.button_hover_color) && inner_value.button_hover_color) ? `color:${inner_value.button_hover_color};` : "";
						btn_hover_content_style += (!_.isEmpty(inner_value.button_hover_border_color) && inner_value.button_hover_border_color) ? `border-color: ${inner_value.button_hover_border_color};` : "";

						#>

						.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:hover,
						.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:focus {
							{{btn_hover_content_style}}
						}

						@media (min-width: 768px) and (max-width: 991px) {
							<# if(inner_value.content_type !== "btn_content"){ #>
								.sp-slider {{uniqid}} {{inner_uniqid}} {
									{{content_style_sm}}
								}
							<# } #>

							.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image {
								{{image_content_style_sm}}
							}

							<# if(btn_margin_sm){ #>
								.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button {
									{{btn_margin_sm}}
								}
							<# } #>
							.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text{
								{{content_style_sm}}
							}
							<# if(_.isObject(inner_value.button_icon_margin)){ #>
								.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-icon{
									{{inner_value.button_icon_margin}}
								}
							<# } #>
						}

						@media (max-width: 767px) {
							<# if(inner_value.content_type !== "btn_content"){ #>
								.sp-slider {{uniqid}} {{inner_uniqid}} {
									{{content_style_xs}}
								}
							<# } #>
							.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image {
								{{image_content_style_xs}}
							}
							<# if(btn_margin_xs){ #>
								.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button {
									{{btn_margin_xs}}
								}
							<# } #>
							.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text{
								{{content_style_xs}}
							}
							<# if(_.isObject(inner_value.button_icon_margin)){ #>
								.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-icon{
									{{inner_value.button_icon_margin}};
								}
							<# } #>
						}

					<# })
				}
			})
		} #>

		#sppb-addon-{{ data.id }} .sp-slider-custom-dot-indecators {
			background:{{data.text_thumb_ctlr_wrap_bg}};
			<# if(_.isObject(data.text_thumb_ctlr_wrap_padding)) { #>
				padding:{{data.text_thumb_ctlr_wrap_padding.md}};
			<# } else { #>
				padding:{{data.text_thumb_ctlr_wrap_padding}};
			<# }
			if(_.isObject(data.text_thumb_ctlr_wrap_width)) {
			#>
				width: {{data.text_thumb_ctlr_wrap_width.md}}%;
			<# } else { #>
				width: {{data.text_thumb_ctlr_wrap_width}}%;
			<# } #>
		}

		#sppb-addon-{{ data.id }} .sp-slider-custom-dot-indecators ul li {
			<# if(_.isObject(data.text_thumb_ctlr_individual_width)) { #>
				width:{{data.text_thumb_ctlr_individual_width.md}}px;
			<# } else { #>
				width:{{data.text_thumb_ctlr_individual_width}}px;
			<# } #>
		}

		#sppb-addon-{{ data.id }} .sp-slider-text-thumb-number {
			color:{{data.text_thumb_number_color}};
			font-weight:{{data.text_thumb_number_font_weight}};
			<# if(_.isObject(data.text_thumb_number_font_size)) { #>
				font-size:{{data.text_thumb_number_font_size.md}}px;
			<# } else { #>
				font-size:{{data.text_thumb_number_font_size}}px;
			<# } #>
		}

		#sppb-addon-{{ data.id }} .sp-slider-dot-indecator-text.sp-dot-text-key-1 {
			color:{{data.text_thumb_title_color}};
			font-weight:{{data.text_thumb_title_font_weight}};
			<# if(_.isObject(data.text_thumb_title_font_size)) { #>
				font-size:{{data.text_thumb_title_font_size.md}}px;
			<# } else { #>
				font-size:{{data.text_thumb_title_font_size}}px;
			<# }
			if(_.isObject(data.text_thumb_title_lineheight)) {
			#>
				line-height:{{data.text_thumb_title_lineheight.md}}px;
			<# } else { #>
				line-height:{{data.text_thumb_title_lineheight}}px;
			<# } #>
		}

		#sppb-addon-{{ data.id }} .sp-slider-dot-indecator-text.sp-dot-text-key-2 {
			color:{{data.text_thumb_subtitle_color}};
			font-weight:{{data.text_thumb_subtitle_font_weight}};
			<# if(_.isObject(data.text_thumb_subtitle_font_size)) { #>
				font-size:{{data.text_thumb_subtitle_font_size.md}}px;
			<# } else { #>
				font-size:{{data.text_thumb_subtitle_font_size}}px;
			<# } #>
		}

		<#
		let content_container_width = (!_.isEmpty(data.content_container_width) && data.content_container_width.md) ? data.content_container_width.md : "100";
		if(content_container_width){
		#>
			#sppb-addon-{{ data.id }} .sp-slider .sp-slider-content-wrap {
				width: {{content_container_width}}%;
				margin: 0 auto;
			}
		<# }

		let content_container_width_sm = (_.isObject(data.content_container_width) && data.content_container_width.sm) ? data.content_container_width.sm : "";

		let arrow_ctlr_width_sm = (_.isObject(data.arrow_ctlr_width) && data.arrow_ctlr_width.sm) ? data.arrow_ctlr_width.sm : "";
		let arrow_ctlr_height_sm = (_.isObject(data.arrow_ctlr_height) && data.arrow_ctlr_height.sm) ? data.arrow_ctlr_height.sm : "";
		let arrow_ctlr_fontsize_sm = (_.isObject(data.arrow_ctlr_font_size) && data.arrow_ctlr_font_size.sm) ? data.arrow_ctlr_font_size.sm : "";

		let dot_controllers_bottom_gap_sm = (_.isObject(data.dot_controllers_bottom_gap) && data.dot_controllers_bottom_gap.sm) ? data.dot_controllers_bottom_gap.sm : "";
		let dot_controllers_left_gap_sm = (_.isObject(data.dot_controllers_left_gap) && data.dot_controllers_left_gap.sm) ? data.dot_controllers_left_gap.sm : "";
		let dot_controllers_right_gap_sm = (_.isObject(data.dot_controllers_right_gap) && data.dot_controllers_right_gap.sm) ? data.dot_controllers_right_gap.sm : "";

		let arrow_controllers_bottom_gap_sm = (_.isObject(data.arrow_controllers_bottom_gap) && data.arrow_controllers_bottom_gap.sm) ? data.arrow_controllers_bottom_gap.sm : "";
		let arrow_controllers_left_gap_sm = (_.isObject(data.arrow_controllers_left_gap) && data.arrow_controllers_left_gap.sm) ? data.arrow_controllers_left_gap.sm : "";
		let arrow_controllers_right_gap_sm = (_.isObject(data.arrow_controllers_right_gap) && data.arrow_controllers_right_gap.sm) ? data.arrow_controllers_right_gap.sm : "";

		let arrow_spread_controllers_left_gap_sm = (_.isObject(data.arrow_spread_controllers_left_gap) && data.arrow_spread_controllers_left_gap.sm) ? data.arrow_spread_controllers_left_gap.sm : "";
		let arrow_spread_controllers_right_gap_sm = (_.isObject(data.arrow_spread_controllers_right_gap) && data.arrow_spread_controllers_right_gap.sm) ? data.arrow_spread_controllers_right_gap.sm : "";

		#>

		@media (min-width: 768px) and (max-width: 991px) {
			<# if(_.isObject(data.timer_width)){ #>
				#sppb-addon-{{ data.id }} .sp-indicator-container {
					width: {{data.timer_width.sm}}%;
				}
			<# } #>
			<# if(content_container_width_sm  && data.content_container_option!=="bootstrap"){ #>
				#sppb-addon-{{ data.id }} .sp-slider .sp-slider-content-wrap {
					width:{{content_container_width_sm}}%;
					margin: 0 auto;
				}
			<# }

			if(arrow_ctlr_width_sm || arrow_ctlr_height_sm || arrow_ctlr_fontsize_sm){
				if(data.arrow_controllers_style !== "spread" && arrow_ctlr_height_sm){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control {
					height:{{arrow_ctlr_height_sm}}px;
				}
			<# } #>
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control {
					<# if(arrow_ctlr_width_sm){ #>
						width:{{arrow_ctlr_width_sm}}px;
					<# }
					if(arrow_ctlr_height_sm){
					#>
						height:{{arrow_ctlr_height_sm}}px;
					<# }
					if(arrow_ctlr_fontsize_sm){
					#>
						font-size:{{arrow_ctlr_fontsize_sm}}px;
					<# } #>
				}

				#sppb-addon-{{ data.id }} div[class*="arrow-position-bottom"].sp-slider .sp-nav-control {
					<# if(arrow_ctlr_width_sm){ #>
						width: {{(arrow_ctlr_width_sm * 2)+20}}px;
					<# } #>
				}

				<# if(data.arrow_controllers_style == "spread" && arrow_ctlr_height_sm){ #>
					#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control {
						top: -{{arrow_ctlr_height_sm}}px;
					}
				<# } #>
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control{
					<# if(!data.arrow_ctlr_border_width){
						data.arrow_ctlr_border_width = 1;
					}
					if(arrow_ctlr_height_sm){
					#>
						line-height:{{arrow_ctlr_height_sm-(data.arrow_ctlr_border_width*2)}}px;
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control i{
					<# if(!data.arrow_ctlr_border_width){
						data.arrow_ctlr_border_width = 1;
					}
					if(arrow_ctlr_height_sm){
					#>
						line-height: {{arrow_ctlr_height_sm-(data.arrow_ctlr_border_width*2)}}px;
					<# } #>
				}

			<# }

			if(data.dot_controllers_position === "bottom_center" && dot_controllers_bottom_gap_sm){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
					bottom: {{dot_controllers_bottom_gap_sm}}px;
				}
			<# }
			if(data.dot_controllers_position === "bottom_left" && (dot_controllers_bottom_gap_sm || dot_controllers_left_gap_sm)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
					bottom:{{dot_controllers_bottom_gap_sm}}px;
				}
				#sppb-addon-{{ data.id }} .dot-controller-position-bottom_left.sp-slider .sp-dots{
					left: {{dot_controllers_left_gap_sm}}px;
				}
			<# }
			if(data.dot_controllers_position === "bottom_right" && (dot_controllers_bottom_gap_sm || dot_controllers_right_gap_sm)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
					bottom: {{dot_controllers_bottom_gap_sm}}px;
				}
				#sppb-addon-{{ data.id }} .dot-controller-position-bottom_right.sp-slider .sp-dots{
					right: {{dot_controllers_right_gap_sm}}px;
				}
			<# }
			if(data.dot_controllers_position === "vertical_left" && dot_controllers_left_gap_sm){
			#>
				#sppb-addon-{{ data.id }} .dot-controller-position-vertical_left.sp-slider .sp-dots{
					left: {{dot_controllers_left_gap_sm}}px;
				}
			<# }
			if(data.dot_controllers_position === "vertical_right" && dot_controllers_right_gap_sm){
			#>
				#sppb-addon-{{ data.id }} .dot-controller-position-vertical_right.sp-slider .sp-dots{
					right:{{dot_controllers_right_gap_sm}}px;
				}
			<# }
			if(data.arrow_controllers_position=="bottom_center" && arrow_controllers_bottom_gap_sm){
			#>
				#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_center .sp-nav-control {
					bottom: {{arrow_controllers_bottom_gap_sm}}px;
				}
			<# }
			if(data.arrow_controllers_position=="bottom_left" && (arrow_controllers_left_gap_sm || arrow_controllers_bottom_gap_sm)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_left .sp-nav-control {
					bottom: {{arrow_controllers_bottom_gap_sm}}px;
					left: {{arrow_controllers_left_gap_sm}}px;
				}
			<# }
			if(data.arrow_controllers_position=="bottom_right" && (arrow_controllers_right_gap_sm || arrow_controllers_bottom_gap_sm)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_right .sp-nav-control {
					bottom: {{arrow_controllers_bottom_gap_sm}}px;
					right: {{arrow_controllers_right_gap_sm}}px;
				}
			<# }
			if(data.arrow_controllers_style==="spread" && (arrow_spread_controllers_left_gap_sm || arrow_spread_controllers_right_gap_sm)){
			#>
				#sppb-addon-{{ data.id }} div.sp-slider .sp-nav-control {
					left:{{arrow_spread_controllers_left_gap_sm}}px;
					right:{{arrow_spread_controllers_right_gap_sm}}px;
				}
			<# }
			let timer_style_sm = "";
			timer_style_sm += (_.isObject(data.timer_width) && data.timer_width.sm) ? `width: ${data.timer_width.sm}%;` : "";
			timer_style_sm += (_.isObject(data.timer_top_gap) && data.timer_top_gap.sm) ? `top: ${data.timer_top_gap.sm}px;` : "";
			timer_style_sm += (_.isObject(data.timer_left_gap) && data.timer_left_gap.sm) ? `left: ${data.timer_left_gap.sm}px;` : "";

			if(timer_style_sm){
			#>
				#sppb-addon-{{ data.id }} .sp-indicator-container {
					{{timer_style_sm}}
				}
			<# }
			if(data.slide_counter){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-slider_number{
					<# if(_.isObject(data.slide_counter_padding)){ #>
						padding:{{data.slide_counter_padding.sm}};
					<# }
					if(_.isObject(data.slide_counter_fontsize)){
					#>
						font-size:{{data.slide_counter_fontsize.sm}}px;
					<# }
					if(_.isObject(data.slide_counter_gap_bottom)){
					#>
						bottom:{{data.slide_counter_gap_bottom.sm}}px;
					<# }
					if(_.isObject(data.slide_counter_gap_left)){
					#>
						left:{{data.slide_counter_gap_left.sm}}px;
					<# } #>
				}
			<# } #>

			#sppb-addon-{{ data.id }} .sp-slider-custom-dot-indecators {
				<# if(_.isObject(data.text_thumb_ctlr_wrap_padding)) { #>
					padding:{{data.text_thumb_ctlr_wrap_padding.sm}};
				<# }
				if(_.isObject(data.text_thumb_ctlr_wrap_width)) {
				#>
					width: {{data.text_thumb_ctlr_wrap_width.sm}}%;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-custom-dot-indecators ul li {
				<# if(_.isObject(data.text_thumb_ctlr_individual_width)) { #>
					width:{{data.text_thumb_ctlr_individual_width.sm}}px;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-text-thumb-number {
				<# if(_.isObject(data.text_thumb_number_font_size)) { #>
					font-size:{{data.text_thumb_number_font_size.sm}}px;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-dot-indecator-text.sp-dot-text-key-1 {
				<# if(_.isObject(data.text_thumb_title_font_size)) { #>
					font-size:{{data.text_thumb_title_font_size.sm}}px;
				<# }
				if(_.isObject(data.text_thumb_title_lineheight)) {
				#>
					line-height:{{data.text_thumb_title_lineheight.sm}}px;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-dot-indecator-text.sp-dot-text-key-2 {
				<# if(_.isObject(data.text_thumb_subtitle_font_size)) { #>
					font-size:{{data.text_thumb_subtitle_font_size.sm}}px;
				<# } #>
			}
		}
		<#
		let content_container_width_xs = (_.isObject(data.content_container_width) && data.content_container_width.xs) ? data.content_container_width.xs : "";

		let arrow_ctlr_width_xs = (_.isObject(data.arrow_ctlr_width) && data.arrow_ctlr_width.xs) ? data.arrow_ctlr_width.xs : "";
		let arrow_ctlr_height_xs = (_.isObject(data.arrow_ctlr_height) && data.arrow_ctlr_height.xs) ? data.arrow_ctlr_height.xs : "";
		let arrow_ctlr_fontsize_xs = (_.isObject(data.arrow_ctlr_font_size) && data.arrow_ctlr_font_size.xs) ? data.arrow_ctlr_font_size.xs : "";

		let dot_controllers_bottom_gap_xs = (_.isObject(data.dot_controllers_bottom_gap) && data.dot_controllers_bottom_gap.xs) ? data.dot_controllers_bottom_gap.xs : "";
		let dot_controllers_left_gap_xs = (_.isObject(data.dot_controllers_left_gap) && data.dot_controllers_left_gap.xs) ? data.dot_controllers_left_gap.xs : "";
		let dot_controllers_right_gap_xs = (_.isObject(data.dot_controllers_right_gap) && data.dot_controllers_right_gap.xs) ? data.dot_controllers_right_gap.xs : "";

		let arrow_controllers_bottom_gap_xs = (_.isObject(data.arrow_controllers_bottom_gap) && data.arrow_controllers_bottom_gap.xs) ? data.arrow_controllers_bottom_gap.xs : "";
		let arrow_controllers_left_gap_xs = (_.isObject(data.arrow_controllers_left_gap) && data.arrow_controllers_left_gap.xs) ? data.arrow_controllers_left_gap.xs : "";
		let arrow_controllers_right_gap_xs = (_.isObject(data.arrow_controllers_right_gap) && data.arrow_controllers_right_gap.xs) ? data.arrow_controllers_right_gap.xs : "";

		let arrow_spread_controllers_left_gap_xs = (_.isObject(data.arrow_spread_controllers_left_gap) && data.arrow_spread_controllers_left_gap.xs) ? data.arrow_spread_controllers_left_gap.xs : "";
		let arrow_spread_controllers_right_gap_xs = (_.isObject(data.arrow_spread_controllers_right_gap) && data.arrow_spread_controllers_right_gap.xs) ? data.arrow_spread_controllers_right_gap.xs : "";
		#>

		@media (max-width: 767px) {
			<# if(_.isObject(data.timer_width)){ #>
				#sppb-addon-{{ data.id }} .sp-indicator-container {
					width: {{data.timer_width.xs}}%;
				}
			<# }
			if(content_container_width_xs && data.content_container_option!=="bootstrap"){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-slider-content-wrap {
					width:{{content_container_width_xs}}%;
					margin: 0 auto;
				}
			<# }

			if(arrow_ctlr_width_xs || arrow_ctlr_height_xs || arrow_ctlr_fontsize_xs){
				if(data.arrow_controllers_style !== "spread" && arrow_ctlr_height_xs){
			#>
					#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control {
						height:{{arrow_ctlr_height_xs}}px;
					}
				<# } #>
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control {
					<# if(arrow_ctlr_width_xs){ #>
						width: {{arrow_ctlr_width_xs}}px;
					<# }
					if(arrow_ctlr_height_xs){
					#>
						height:{{arrow_ctlr_height_xs}}px;
					<# }
					if(arrow_ctlr_fontsize_xs){
					#>
						font-size: {{arrow_ctlr_fontsize_xs}}px;
					<# } #>
				}

				#sppb-addon-{{ data.id }} div[class*="arrow-position-bottom"].sp-slider .sp-nav-control {
					<# if(arrow_ctlr_width_xs){ #>
						width: {{(arrow_ctlr_width_xs * 2)+20}}px;
					<# } #>
				}

				<# if(data.arrow_controllers_style == "spread" && arrow_ctlr_height_xs){ #>
					#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control {
						top: -{{arrow_ctlr_height_xs}}px;
					}
				<# } #>
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control{
					<# if(!data.arrow_ctlr_border_width){
						data.arrow_ctlr_border_width = 1;
					}
					if(arrow_ctlr_height_xs){
					#>
						line-height:{{arrow_ctlr_height_xs-(data.arrow_ctlr_border_width*2)}}px;
					<# } #>
				}
				#sppb-addon-{{ data.id }} .sp-slider .sp-nav-control .nav-control i{
					<# if(!data.arrow_ctlr_border_width){
						data.arrow_ctlr_border_width = 1;
					}
					if(arrow_ctlr_height_xs){
					#>
						line-height:{{arrow_ctlr_height_xs-(data.arrow_ctlr_border_width*2)}}px;
					<# } #>
				}
			<# }

			if(data.dot_controllers_position === "bottom_center" && dot_controllers_bottom_gap_xs){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
					bottom:{{dot_controllers_bottom_gap_xs}}px;
				}
			<# }
			if(data.dot_controllers_position === "bottom_left" && (dot_controllers_bottom_gap_xs || dot_controllers_left_gap_xs)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
					bottom:{{dot_controllers_bottom_gap_xs}}px;
				}
				#sppb-addon-{{ data.id }} .dot-controller-position-bottom_left.sp-slider .sp-dots{
					left:{{dot_controllers_left_gap_xs}}px;
				}
			<# }
			if(data.dot_controllers_position === "bottom_right" && (dot_controllers_bottom_gap_xs || dot_controllers_right_gap_xs)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-dots{
					bottom:{{dot_controllers_bottom_gap_xs}}px;
				}
				#sppb-addon-{{ data.id }} .dot-controller-position-bottom_right.sp-slider .sp-dots{
					right:{{dot_controllers_right_gap_xs}}px;
				}
			<# }
			if(data.dot_controllers_position === "vertical_left" && dot_controllers_left_gap_xs){
			#>
				#sppb-addon-{{ data.id }} .dot-controller-position-vertical_left.sp-slider .sp-dots{
					left:{{dot_controllers_left_gap_xs}}px;
				}
			<# }
			if(data.dot_controllers_position === "vertical_right" && dot_controllers_right_gap_xs){
			#>
				#sppb-addon-{{ data.id }} .dot-controller-position-vertical_right.sp-slider .sp-dots{
					right:{{dot_controllers_right_gap_xs}}px;
				}
			<# }

			if(data.arrow_controllers_position=="bottom_center" && arrow_controllers_bottom_gap_xs){
			#>
				#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_center .sp-nav-control {
					bottom:{{arrow_controllers_bottom_gap_xs}}px;
				}
			<# }
			if(data.arrow_controllers_position=="bottom_left" && (arrow_controllers_left_gap_xs || arrow_controllers_bottom_gap_xs)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_left .sp-nav-control {
					bottom:{{arrow_controllers_bottom_gap_xs}}px;
					left:{{arrow_controllers_left_gap_xs}}px;
				}
			<# }
			if(data.arrow_controllers_position=="bottom_right" && (arrow_controllers_right_gap_xs || arrow_controllers_bottom_gap_xs)){
			#>
				#sppb-addon-{{ data.id }} .sp-slider.arrow-position-bottom_right .sp-nav-control {
					bottom:{{arrow_controllers_bottom_gap_xs}}px;
					right:{{arrow_controllers_right_gap_xs}}px;
				}
			<# }

			if(data.arrow_controllers_style==="spread" && (arrow_spread_controllers_left_gap_xs || arrow_spread_controllers_right_gap_xs)){
			#>
				#sppb-addon-{{ data.id }} div.sp-slider .sp-nav-control {
					left:{{arrow_spread_controllers_left_gap_xs}}px;
					right:{{arrow_spread_controllers_right_gap_xs}}px;
				}
			<# }
			let timer_style_xs = "";
			timer_style_xs += (_.isObject(data.timer_width) && data.timer_width.xs) ? `width: ${data.timer_width.xs}%;` : "";
			timer_style_xs += (_.isObject(data.timer_top_gap) && data.timer_top_gap.xs) ? `top: ${data.timer_top_gap.xs}px;` : "";
			timer_style_xs += (_.isObject(data.timer_left_gap) && data.timer_left_gap.xs) ? `left: ${data.timer_left_gap.xs}px;` : "";

			if(timer_style_xs){
			#>
				#sppb-addon-{{ data.id }} .sp-indicator-container {
					{{timer_style_xs}}
				}
			<# }
			if(data.slide_counter){
			#>
				#sppb-addon-{{ data.id }} .sp-slider .sp-slider_number{
					<# if(_.isObject(data.slide_counter_padding)){ #>
						padding:{{data.slide_counter_padding.xs}};
					<# }
					if(_.isObject(data.slide_counter_fontsize)){
					#>
						font-size:{{data.slide_counter_fontsize.xs}}px;
					<# }
					if(_.isObject(data.slide_counter_gap_bottom)){
					#>
						bottom:{{data.slide_counter_gap_bottom.xs}}px;
					<# }
					if(_.isObject(data.slide_counter_gap_left)){
					#>
						left:{{data.slide_counter_gap_left.xs}}px;
					<# } #>
				}
			<# } #>
			#sppb-addon-{{ data.id }} .sp-slider-custom-dot-indecators {
				<# if(_.isObject(data.text_thumb_ctlr_wrap_padding)) { #>
					padding:{{data.text_thumb_ctlr_wrap_padding.xs}};
				<# }
				if(_.isObject(data.text_thumb_ctlr_wrap_width)) {
				#>
					width: {{data.text_thumb_ctlr_wrap_width.xs}}%;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-custom-dot-indecators ul li {
				<# if(_.isObject(data.text_thumb_ctlr_individual_width)) { #>
					width:{{data.text_thumb_ctlr_individual_width.xs}}px;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-text-thumb-number {
				<# if(_.isObject(data.text_thumb_number_font_size)) { #>
					font-size:{{data.text_thumb_number_font_size.xs}}px;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-dot-indecator-text.sp-dot-text-key-1 {
				<# if(_.isObject(data.text_thumb_title_font_size)) { #>
					font-size:{{data.text_thumb_title_font_size.xs}}px;
				<# }
				if(_.isObject(data.text_thumb_title_lineheight)) {
				#>
					line-height:{{data.text_thumb_title_lineheight.xs}}px;
				<# } #>
			}

			#sppb-addon-{{ data.id }} .sp-slider-dot-indecator-text.sp-dot-text-key-2 {
				<# if(_.isObject(data.text_thumb_subtitle_font_size)) { #>
					font-size:{{data.text_thumb_subtitle_font_size.xs}}px;
				<# } #>
			}
		}
		</style>
		<#
			let content_class = (!_.isEmpty(data.class) && data.class) ?  data.class : "";
			let slide_vertically = (typeof data.slide_vertically !== "undefined" && data.slide_vertically) ? true : false;
			let autoplay = (typeof data.autoplay !== "undefined" && data.autoplay) ? true : false;
			let pause_on_hover = (typeof data.pause_on_hover !== "undefined" && data.pause_on_hover) ? true : false;
			let interval = (!_.isEmpty(data.interval) && data.interval) ? data.interval : 5;
			let speed = (!_.isEmpty(data.speed) && data.speed) ? data.speed : 800;

			let height = (!_.isEmpty(data.height) && data.height) ? data.height : "";
			let custom_height = (_.isObject(data.custom_height) && data.custom_height.md) ? data.custom_height.md + "px" : "";
			let custom_height_sm = (_.isObject(data.custom_height) && data.custom_height.sm) ? data.custom_height.sm + "px" : "";
			let custom_height_xs = (_.isObject(data.custom_height) && data.custom_height.xs) ? data.custom_height.xs + "px" : "";
			let slider_animation = (!_.isEmpty(data.slider_animation) && data.slider_animation) ? data.slider_animation : "";

			let dataVerticleSlide = "";
			if(slider_animation === "stack"){
				dataVerticleSlide = \'data-slide-vertically="\'+(slide_vertically ? "true" : "false")+\'"\';
			}
			let data_three_d_rotate = "";
			if(slider_animation === "3D"){
				data_three_d_rotate = \'data-3d-rotate="\'+(data.three_d_rotate ? data.three_d_rotate : "15")+\'"\';
			}
			let timer = (typeof data.timer !== "undefined" && data.timer) ? true : false;

			let dot_controllers = (typeof data.dot_controllers !== "undefined" && data.dot_controllers) ? true : false;
			let dot_controllers_style = (!_.isEmpty(data.dot_controllers_style) && data.dot_controllers_style) ? data.dot_controllers_style : "";
			let dot_controllers_position = (!_.isEmpty(data.dot_controllers_position) && data.dot_controllers_position) ? data.dot_controllers_position : "";

			let arrow_controllers = (typeof data.arrow_controllers!=="undefined" && data.arrow_controllers) ? true : false;
			let arrow_controllers_content = (!_.isEmpty(data.arrow_controllers_content) && data.arrow_controllers_content) ? data.arrow_controllers_content : "text_only";
			let arrow_controllers_style = (!_.isEmpty(data.arrow_controllers_style) && data.arrow_controllers_style) ? data.arrow_controllers_style : "";
			let arrow_controllers_position = (!_.isEmpty(data.arrow_controllers_position) && data.arrow_controllers_position) ? data.arrow_controllers_position : "";
			let arrow_on_hover = (typeof data.arrow_on_hover!=="undefined" && data.arrow_on_hover) ? true : false;

			let line_indecator = (typeof data.line_indecator!=="undefined" && data.line_indecator) ? true : false;

			let slide_counter = (typeof data.slide_counter!=="undefined" && data.slide_counter) ? true : false;

			let slider_height = "";
			let slider_height_sm = "";
			let slider_height_xs = "";
			if(height=="full"){
				slider_height = "full";
				slider_height_sm = "full";
				slider_height_xs = "full";
			} else {
				slider_height = custom_height;
				slider_height_sm = custom_height_sm;
				slider_height_xs = custom_height_xs;
			}

			let dot_style_class = "";
			let dot_position_class ="";
			if(dot_controllers){
				if(dot_controllers_style){
					dot_style_class = "dot-controller-" + dot_controllers_style;
				}
				if(dot_controllers_position){
					dot_position_class = "dot-controller-position-" + dot_controllers_position;
				}
			}

			let arrow_position_class = "";
			if(arrow_controllers_style == "along" &&  arrow_controllers_position){
				arrow_position_class = "arrow-position-" + arrow_controllers_position;
			}
			let arrow_hover_class = "";
			if(arrow_on_hover){
				arrow_hover_class = "arrow-show-on-hover";
			}

			let content_vertical_alignment = (typeof data.content_vertical_alignment !== "undefined" && data.content_vertical_alignment) ? "slider-content-vercally-center" : "";
			var dots = "";
			#>

			<div id="sppb-sp-slider-{{data.id}}" data-id="sppb-sp-slider-{{data.id}}" class="sppb-addon-sp-slider sp-slider {{content_class}} {{dot_style_class}} {{dot_position_class}} {{arrow_position_class}} {{arrow_hover_class}}" data-height="{{slider_height}}" data-height-sm="{{slider_height_sm}}" data-height-xs="{{slider_height_xs}}" data-slider-animation="{{slider_animation}}" {{{dataVerticleSlide}}} {{{data_three_d_rotate}}} data-autoplay="{{autoplay}}" data-interval="{{interval * 1000}}" data-timer="{{timer}}" data-speed="{{speed}}" data-dot-control="{{dot_controllers}}" data-arrow-control="{{arrow_controllers}}" data-indecator="{{line_indecator}}" data-arrow-content="{{arrow_controllers_content}}" data-slide-count="{{slide_counter}}" data-dot-style="{{data.dot_controllers_style}}" data-pause-hover="{{(pause_on_hover && autoplay ? \'true\' : \'false\')}}">
			<#
				if(!_.isEmpty(data.slideshow_items)){
					_.each (data.slideshow_items, function(item_value, item_key) {
						let uniqid = `sp-slider-item-${data.id}-num-${item_key}-key`;
						let last_field_key = item_key;
						let activeClass = "";
						if(item_key==0){
							activeClass = "active";
						}
			#>

					<div id="{{uniqid}}" class="sp-item {{activeClass}} {{content_vertical_alignment}}">
					<# if(data.content_container_option==="bootstrap"){ #>
						<div class="sppb-container">
						<div class="sppb-row">
						<div class="sppb-col-sm-12">
					<# } else { #>
						<div class="sp-slider-content-wrap">
					<# }
						var image_in_column = (typeof item_value.image_in_column !== "undefined" && item_value.image_in_column) ? true : false;
						var image_column_width = (_.isObject(item_value.image_column_width) && item_value.image_column_width.md) ? item_value.image_column_width.md : 6;
						var image_column_width_sm = (_.isObject(item_value.image_column_width) && item_value.image_column_width.sm) ? item_value.image_column_width.sm : 6;
						var image_column_width_xs = (_.isObject(item_value.image_column_width) && item_value.image_column_width.xs) ? item_value.image_column_width.xs : 6;
						var image_column_reverse = (typeof item_value.image_column_reverse!=="undefined" && item_value.image_column_reverse) ? true : false;
						var icon_display_block = (typeof item_value.icon_display_block!=="undefined" && item_value.icon_display_block) ? "sp-slider-icon-block" : "";
						var content_alignment = (!_.isEmpty(item_value.content_alignment) && item_value.content_alignment) ? item_value.content_alignment : "";
						var image_content_alignment = (!_.isEmpty(item_value.image_content_alignment) && item_value.image_content_alignment) ? item_value.image_content_alignment : "";

							if(!image_in_column){
					#>
								<div class="sp-slider-content-align-{{content_alignment}}">
								<#
								_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
									let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
									let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
									let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
									let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
									if(animation_timing_function == "cubic-bezier"){
										animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
									}
									let animation_settings = {};
									if(inner_value.content_animation_type == "rotate"){
										animation_settings = {
											"type":"rotate",
											"from":inner_value.animation_rotate_from + "deg",
											"to":inner_value.animation_rotate_to + "deg",
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										};
									} else if(inner_value.content_animation_type == "text-animate"){
										animation_settings = {
											"type":"text-animate",
											"direction":inner_value.animation_slide_direction,
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										}
									} else if(inner_value.content_animation_type == "zoom"){
										animation_settings = {
											"type":"zoom",
											"direction":"zoomIn",
											"from":0,
											"to":1,
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										};
									} else {
										animation_settings = {
											"type":"slide",
											"direction":inner_value.animation_slide_direction,
											"from":inner_value.animation_slide_from+"%",
											"to":"0%",
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										};
									}

									let animationJson = JSON.stringify(animation_settings);

									let btn_content = "";
									let btn_icon_arr = (typeof inner_value.button_icon !== "undefined" && inner_value.button_icon) ? inner_value.button_icon.split(" ") : "";
									let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+inner_value.button_icon : inner_value.button_icon;

									if (inner_value.button_icon_position == "left") {
										if(inner_value.button_icon) {
											btn_content = \'<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"> <i class="\' + btn_icon_name + \'"></i></span> \' + inner_value.btn_content + \'</span>\';
										} else {
											btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \'</span>\';
										}
									} else {
										if(inner_value.button_icon){
											btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \' <span class="sp-slider-btn-icon"><i class="\' + btn_icon_name + \'"></i></span></span>\';
										} else {
											btn_content = \'<span class="sp-slider-btn-text">\'+ inner_value.btn_content + \'</span>\';
										}
									}
									let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

									if(inner_value.content_type == "text_content"){
								#>
										<div id="{{inner_uniqid}}" class="sppb-sp-slider-text sp-editable-content {{content_class}}" data-id={{data.id}} data-fieldName="{{last_field_key}}-{{last_field_inner_key}}-content_text" data-layer="true" data-animation={{animationJson}}>
											{{{inner_value.content_text}}}
										</div>
									<# } else if(inner_value.content_type == "image_content"){ #>
										<div id="{{inner_uniqid}}" class="sppb-sp-slider-image {{content_class}}" data-layer="true" data-animation={{animationJson}}>
											<div class="sp-slider-caption-image"></div>
										</div>
									<# } else if(inner_value.content_type == "btn_content"){ #>
										<a id="{{inner_uniqid}}" <# if(inner_value.button_target == "_blank"){ #> target="_blank" <# } #> class="sppb-sp-slider-button {{content_class}}" href="{{inner_value.button_url}}" data-layer="true" data-animation={{animationJson}}>
										{{{btn_content}}}
										</a>
									<# } else if(inner_value.content_type == "icon_content"){
									let content_icon_arr = !_.isEmpty(inner_value.icon_content) ? inner_value.icon_content.split(" ") : "";
									let content_icon_name = content_icon_arr.length === 1 ? "fa "+inner_value.icon_content : faIconList.version === 4 ? "fa " +content_icon_arr[1] : inner_value.icon_content;
									#>
										<span id="{{inner_uniqid}}" class="sppb-sp-slider-icon {{content_class}} {{icon_display_block}}" data-layer="true" data-animation={{animationJson}}>
											<span class="{{content_icon_name}}"></span>
										</span>
									<# } else if(inner_value.content_type == "title_content") {
										if(!inner_value.title_heading_selector){
											inner_value.title_heading_selector = "h2";
										}
									#>
										<{{inner_value.title_heading_selector}} id="{{inner_uniqid}}" class="sppb-sp-slider-title sp-inline-editable-element {{content_class}}" data-id={{data.id}} data-fieldName="title_content_title" contenteditable="true" data-layer="true" data-animation={{animationJson}}>
											{{{inner_value.title_content_title}}}
										</{{inner_value.title_heading_selector}}>
									<# }

								}) #>
								</div>
							<# } else { #>
								<div class="sppb-row">
									<# if(!image_column_reverse){ #>
										<div class="sppb-col-xs-{{12-image_column_width_xs}} sppb-col-sm-{{12-image_column_width_sm}} sppb-col-md-{{12-image_column_width}}">
											<div class="sp-slider-content-align-{{content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
                          let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}

													let animationJson = JSON.stringify(animation_settings);

													let btn_content = "";
													let btn_icon_arr = (typeof inner_value.button_icon !== "undefined" && inner_value.button_icon) ? inner_value.button_icon.split(" ") : "";
													let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+inner_value.button_icon : inner_value.button_icon;

													if (inner_value.button_icon_position == "left") {
														if(inner_value.button_icon) {
															btn_content = \'<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"> <i class="\' + btn_icon_name + \'"></i></span> \' + inner_value.btn_content + \'</span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \'</span>\';
														}
													} else {
														if(inner_value.button_icon){
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \' <span class="sp-slider-btn-icon"><i class="\' + btn_icon_name + \'"></i></span></span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\'+ inner_value.btn_content + \'</span>\';
														}
													}
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

													if(inner_value.content_type == "text_content"){
												#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-text sp-editable-content {{content_class}}" data-id={{data.id}} data-fieldName="{{last_field_key}}-{{last_field_inner_key}}-content_text" data-layer="true" data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.content_text}}}
														</div>
													<# } else if(inner_value.content_type == "btn_content"){ #>
														<a id="{{inner_uniqid}}" <# if(inner_value.button_target == "_blank"){ #> target="_blank" <# } #> class="sppb-sp-slider-button {{content_class}}" href="{{inner_value.button_url}}" data-layer="true" data-animation={{animationJson}}>
														{{{btn_content}}}
														</a>
													<# } else if(inner_value.content_type == "icon_content"){
														let content_icon_arr = !_.isEmpty(inner_value.icon_content) ? inner_value.icon_content.split(" ") : "";
														let content_icon_name = content_icon_arr.length === 1 ? "fa "+inner_value.icon_content : faIconList.version === 4 ? "fa " +content_icon_arr[1] : inner_value.icon_content;
													#>
														<span id="{{inner_uniqid}}" class="sppb-sp-slider-icon {{content_class}} {{icon_display_block}}" data-layer="true" data-animation={{animationJson}}>
															<span class="{{content_icon_name}}"></span>
														</span>
													<# } else if(inner_value.content_type == "title_content") {
														if(!inner_value.title_heading_selector){
															inner_value.title_heading_selector = "h2";
														}
													#>
														<{{inner_value.title_heading_selector}} id="{{inner_uniqid}}" class="sppb-sp-slider-title sp-inline-editable-element {{content_class}}" data-id={{data.id}} data-fieldName="title_content_title" contenteditable="true" data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.title_content_title}}}
														</{{inner_value.title_heading_selector}}>
													<# }

												}) #>
											</div>
										</div>
										<div class="sppb-col-xs-{{image_column_width_xs}} sppb-col-sm-{{image_column_width_sm}} sppb-col-md-{{image_column_width}} image-align-{{image_content_alignment}}">
											<div class="sp-slider-image-align-{{image_content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
													let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}

													let animationJson = JSON.stringify(animation_settings);
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

													if(inner_value.content_type == "image_content"){
													#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-image {{content_class}}" data-layer="true" data-animation={{animationJson}}>
															<div class="sp-slider-caption-image"></div>
														</div>
													<# }
												}) #>
											</div>
										</div>
									<# } else { #>
										<div class="sppb-col-xs-{{image_column_width_xs}} sppb-col-sm-{{image_column_width_sm}} sppb-col-md-{{image_column_width}} image-align-{{image_content_alignment}}">
											<div class="sp-slider-image-align-{{image_content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
													let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}

													let animationJson = JSON.stringify(animation_settings);
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

													if(inner_value.content_type == "image_content"){
													#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-image {{content_class}}" data-layer="true" data-animation={{animationJson}}>
															<div class="sp-slider-caption-image"></div>
														</div>
													<# }
												}) #>
											</div>
										</div>
										<div class="sppb-col-xs-{{12-image_column_width_xs}} sppb-col-sm-{{12-image_column_width_sm}} sppb-col-md-{{12-image_column_width}}">
											<div class="sp-slider-content-align-{{content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
													let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}

													let animationJson = JSON.stringify(animation_settings);

													let btn_content = "";
													let btn_icon_arr = (typeof inner_value.button_icon !== "undefined" && inner_value.button_icon) ? inner_value.button_icon.split(" ") : "";
													let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+inner_value.button_icon : inner_value.button_icon;

													if (inner_value.button_icon_position == "left") {
														if(inner_value.button_icon) {
															btn_content = \'<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"> <i class="\' + btn_icon_name + \'"></i></span> \' + inner_value.btn_content + \'</span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \'</span>\';
														}
													} else {
														if(inner_value.button_icon){
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \' <span class="sp-slider-btn-icon"><i class="\' + btn_icon_name + \'"></i></span></span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\'+ inner_value.btn_content + \'</span>\';
														}
													}
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

													if(inner_value.content_type == "text_content"){
												#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-text sp-editable-content {{content_class}}" data-id={{data.id}} data-fieldName="{{last_field_key}}-{{last_field_inner_key}}-content_text" data-layer="true" data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.content_text}}}
														</div>
													<# } else if(inner_value.content_type == "btn_content"){ #>
														<a id="{{inner_uniqid}}" <# if(inner_value.button_target == "_blank"){ #> target="_blank" <# } #> class="sppb-sp-slider-button {{content_class}}" href="{{inner_value.button_url}}" data-layer="true" data-animation={{animationJson}}>
														{{{btn_content}}}
														</a>
													<# } else if(inner_value.content_type == "icon_content"){
														let content_icon_arr = !_.isEmpty(inner_value.icon_content) ? inner_value.icon_content.split(" ") : "";
														let content_icon_name = content_icon_arr.length === 1 ? "fa "+inner_value.icon_content : faIconList.version === 4 ? "fa " +content_icon_arr[1] : inner_value.icon_content;
													#>
														<span id="{{inner_uniqid}}" class="sppb-sp-slider-icon {{content_class}} {{icon_display_block}}" data-layer="true" data-animation={{animationJson}}>
															<span class="{{content_icon_name}}"></span>
														</span>
													<# } else if(inner_value.content_type == "title_content") {
														if(!inner_value.title_heading_selector){
															inner_value.title_heading_selector = "h2";
														}
													#>
														<{{inner_value.title_heading_selector}} id="{{inner_uniqid}}" class="sppb-sp-slider-title sp-inline-editable-element {{content_class}}" data-id={{data.id}} data-fieldName="title_content_title" contenteditable="true"  data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.title_content_title}}}
														</{{inner_value.title_heading_selector}}>
													<# }

												}) #>
											</div>
										</div>

									<# } #>

								</div>

							<# }
							if(data.content_container_option === "bootstrap"){
							#>
								</div>
								</div>
								</div>
							<# } else { #>
						</div>
						<# }
						if(!_.isEmpty(item_value.slider_img)){
						#>
							<div class="sp-background"></div>
						<# }
						if(data.slider_animation !== "3D"){
							var slider_video = {}
							if(!_.isEmpty(item_value.slider_video) && item_value.slider_video){
								if (typeof item_value.slider_video !== "undefined" && typeof item_value.slider_video.src !== "undefined") {
									slider_video = item_value.slider_video
								} else {
									slider_video = {src: item_value.slider_video}
								}
							}
							if(slider_video.src && !item_value.enable_youtube_vimeo){
								if(slider_video.src?.indexOf("http://") == 0 || slider_video.src?.indexOf("https://") == 0){
						#>
									<div class="sp-video-background" data-video_src="{{slider_video.src}}"></div>
								<# } else { #>
									<div class="sp-video-background" data-video_src="{{pagebuilder_base +  slider_video.src }}"></div>
								<# }
							} else if(!_.isEmpty(item_value.youtube_vimeo_url) && item_value.youtube_vimeo_url && item_value.enable_youtube_vimeo) {
								if(item_value.youtube_vimeo_url.indexOf("http://") == 0 || item_value.youtube_vimeo_url.indexOf("https://") == 0){
								#>
									<div class="sp-video-background" data-video_src="{{item_value.youtube_vimeo_url}}"></div>
								<# } else { #>
									<div class="sp-video-background" data-video_src="{{ pagebuilder_base + item_value.youtube_vimeo_url }}"></div>
								<# }
							}
						} #>

						<#
						if(data.dot_controllers_style == "with_text"){
							let captionItem = [];
							if(_.isArray(item_value.slideshow_inner_items)){
								let dot_item = 0;
								_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
									if(inner_value.content_type == "title_content" && dot_item < 2 ) {
										captionItem.unshift(inner_value);
									}
									dot_item++;
								})
							}
							dots += `<li class="${item_key == 0 ? "active sp-text-thumbnail-list" : "sp-text-thumbnail-list"}">`;
								dots += `<div class="sp-slider-text-thumb-number">${(item_key > 8 ? (item_key + 1) : "0"+(item_key + 1))}</div>`;
								dots += `<div class="sp-dot-indicator-wrap">`;
									dots += `<span class="dot-indicator"></span>`;
								dots += `</div>`;
								dots += `<div class="sp-slider-text-thumb-caption">`;
									if(_.isArray(captionItem)){
										_.each(captionItem, function(inner_value, dot_key){
											dots += `<div class="sp-slider-dot-indecator-text sp-dot-text-key-${dot_key + 1}">`;
												dots += inner_value.title_content_title;
											dots +=`</div>`;
										})
									}
								dots += `</div>`;
							dots += `</li>`;
						}
						#>
					</div>
				<# })

			} #>

			<# if(data.dot_controllers_style == "with_text" && data.dot_controllers){ #>
				<div class="sp-slider-custom-dot-indecators">
					<ul>
						{{{dots}}}
					</ul>
				</div>
			<# } #>

			</div>
		 ';

	 	return $output;
	 }

}
