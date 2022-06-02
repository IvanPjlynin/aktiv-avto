<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonGallery extends SppagebuilderAddons{

	public function render() {
        $settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';
		$item_alignment = (isset($settings->item_alignment) && $settings->item_alignment) ? $settings->item_alignment : '';

		$output  = '<div class="sppb-addon sppb-addon-gallery ' . $class . '">';
		$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
		$output .= '<div class="sppb-addon-content">';
		$output .= '<ul class="sppb-gallery clearfix gallery-item-'.$item_alignment.'">';

		if(isset($settings->sp_gallery_item) && count((array) $settings->sp_gallery_item)){
			foreach ($settings->sp_gallery_item as $key => $value) {
                $thumb_img = isset($value->thumb) && $value->thumb ? $value->thumb : '';
                $thumb_src = isset($thumb_img->src) ? $thumb_img->src : $thumb_img;
                $thumb_width = isset($thumb_img->width) && $thumb_img->width ? $thumb_img->width : '';
                $thumb_height = isset($thumb_img->height) && $thumb_img->height ? $thumb_img->height : '';

                $full_img = isset($value->full) && $value->full ? $value->full : '';
                $full_src = isset($full_img->src) ? $full_img->src : $full_img;

				if($thumb_src) {
                    if(strpos($thumb_src, "http://") !== false || strpos($thumb_src, "https://") !== false){
                        $thumb_src = $thumb_src;
                    } else {
                        $thumb_src = JURI::base(true) . '/' . $thumb_src;
                    }
                    $placeholder = $thumb_src == '' ? false : $this->get_image_placeholder($thumb_src);

					$output .= '<li>';
					$output .= ($full_src) ? '<a href="' . $full_src . '" class="sppb-gallery-btn">' : '';
					$output .= '<img class="sppb-img-responsive'.($placeholder ? ' sppb-element-lazy' : '').'" src="' . ($placeholder ? $placeholder : $thumb_src) . '" alt="' . (isset($value->title) ? $value->title : '') . '" '.($placeholder ? 'data-large="'.$thumb_src.'"' : '').' '.($thumb_width ? 'width="'.$thumb_width.'"' : '').' '.($thumb_height ? 'height="'.$thumb_height.'"' : '').' loading="lazy">';
					$output .= ($full_src) ? '</a>' : '';
					$output .= '</li>';
				}
			}
		}

		$output .= '</ul>';
		$output	.= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function js() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$js ='jQuery(function($){
			$("'.$addon_id.' ul li").magnificPopup({
				delegate: "a",
				type: "image",
				mainClass: "mfp-no-margins mfp-with-zoom",
				gallery:{
					enabled:true
				},
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300
				}
			});
		})';

		return $js;
	}
        
    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $settings = $this->addon->settings;

        $width = (isset($settings->width) && $settings->width) ? $settings->width : '';
        $width_sm = (isset($settings->width_sm) && $settings->width_sm) ? $settings->width_sm : '';
        $width_xs = (isset($settings->width_xs) && $settings->width_xs) ? $settings->width_xs : '';

        $height = (isset($settings->height) && $settings->height) ? $settings->height : '';
        $height_sm = (isset($settings->height_sm) && $settings->height_sm) ? $settings->height_sm : '';
        $height_xs = (isset($settings->height_xs) && $settings->height_xs) ? $settings->height_xs : '';
        
        $item_gap = (isset($settings->item_gap) && $settings->item_gap) ? $settings->item_gap : '';
        $item_gap_sm = (isset($settings->item_gap_sm) && $settings->item_gap_sm) ? $settings->item_gap_sm : '';
        $item_gap_xs = (isset($settings->item_gap_xs) && $settings->item_gap_xs) ? $settings->item_gap_xs : '';

        $css = '';
        if($width || $height || $item_gap){
            $css .= $addon_id .' .sppb-gallery img {';
            $css .= 'width:'.$width.'px;';
            $css .= 'height:'.$height.'px;';
            $css .= '}';
            
            if(!empty($item_gap)){
                $css .= $addon_id .' .sppb-gallery li {';
                $css .= 'margin:'.$item_gap.'px;';
                $css .= '}';
                $css .= $addon_id .' .sppb-gallery {';
                $css .= 'margin:-'.$item_gap.'px;';
                $css .= '}';
            }
            
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';

            $css .= $addon_id .' .sppb-gallery img {';
            $css .= 'width:'.$width_sm.'px;';
            $css .= 'height:'.$height_sm.'px;';
            $css .= '}';
            
            if(!empty($item_gap_sm)){
                $css .= $addon_id .' .sppb-gallery li {';
                $css .= 'margin:'.$item_gap_sm.'px;';
                $css .= '}';
                $css .= $addon_id .' .sppb-gallery {';
                $css .= 'margin:-'.$item_gap_sm.'px;';
                $css .= '}';
            }

            $css .= '}';

            $css .= '@media (max-width: 767px) {';

            $css .= $addon_id .' .sppb-gallery img {';
            $css .= 'width:'.$width_xs.'px;';
            $css .= 'height:'.$height_xs.'px;';
            $css .= '}';
            
            if(!empty($item_gap_xs)){
                $css .= $addon_id .' .sppb-gallery li {';
                $css .= 'margin:'.$item_gap_xs.'px;';
                $css .= '}';
                $css .= $addon_id .' .sppb-gallery {';
                $css .= 'margin:-'.$item_gap_xs.'px;';
                $css .= '}';
            }

            $css .= '}';
        }
        return $css;
    }

	public static function getTemplate() {
		$output = '
		<style type="text/css">
            #sppb-addon-{{ data.id }} .sppb-gallery img {
                <# if(_.isObject(data.width)){ #>
                    width: {{data.width.md}}px;
                <# } else { #>
                    width: {{data.width}}px;
                <# } #>
                <# if(_.isObject(data.height)){ #>
                    height: {{data.height.md}}px;
                <# } else { #>
                    height: {{data.height}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-gallery li {
                <# if(_.isObject(data.item_gap)){ #>
                    margin: {{data.item_gap.md}}px;
                <# } else { #>
                    margin: {{data.item_gap}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-gallery {
                <# if(_.isObject(data.item_gap)){ #>
                    margin: -{{data.item_gap.md}}px;
                <# } else { #>
                    margin: -{{data.item_gap}}px;
                <# } #>
            }
            @media (min-width: 768px) and (max-width: 991px) {
                #sppb-addon-{{ data.id }} .sppb-gallery img {
                    <# if(_.isObject(data.width)){ #>
                        width: {{data.width.sm}}px;
                    <# } #>
                    <# if(_.isObject(data.height)){ #>
                        height: {{data.height.sm}}px;
                    <# } #>
                }
                
                #sppb-addon-{{ data.id }} .sppb-gallery li {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: {{data.item_gap.sm}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-gallery {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: -{{data.item_gap.sm}}px;
                    <# } #>
                }
            }
            @media (max-width: 767px) {
                #sppb-addon-{{ data.id }} .sppb-gallery img {
                    <# if(_.isObject(data.width)){ #>
                        width: {{data.width.xs}}px;
                    <# } #>
                    <# if(_.isObject(data.height)){ #>
                        height: {{data.height.xs}}px;
                    <# } #>
                }
                
                #sppb-addon-{{ data.id }} .sppb-gallery li {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: {{data.item_gap.xs}}px;
                    <# } #>
                }
                #sppb-addon-{{ data.id }} .sppb-gallery {
                    <# if(_.isObject(data.item_gap)){ #>
                        margin: -{{data.item_gap.xs}}px;
                    <# } #>
                }
            }
        </style>
		<div class="sppb-addon sppb-addon-gallery {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
                <ul class="sppb-gallery clearfix gallery-item-{{data.item_alignment}}">
                
                <#
                _.each(data.sp_gallery_item, function (value, key) {
                    var thumbImg = {}
                    var fullImg = {}
                    if (typeof value.thumb !== "undefined" && typeof value.thumb.src !== "undefined") {
                        thumbImg = value.thumb
                    } else {
                        thumbImg = {src: value.thumb}
                    }
                    if (typeof value.full !== "undefined" && typeof value.full.src !== "undefined") {
                        fullImg = value.full
                    } else {
                        fullImg = {src: value.full}
                    }
					if(thumbImg.src) {
                #>
						<li>
						<# if(fullImg.src && fullImg.src?.indexOf("http://") == -1 && fullImg.src?.indexOf("https://") == -1){ #>
							<a href=\'{{ pagebuilder_base + fullImg.src }}\' class="sppb-gallery-btn">
						<# } else if(fullImg.src){ #>
							<a href=\'{{ fullImg.src }}\' class="sppb-gallery-btn">
                        <# }
                        if(thumbImg.src && thumbImg.src?.indexOf("http://") == -1 && thumbImg.src?.indexOf("https://") == -1){
                        #>
								<img class="sppb-img-responsive" src=\'{{ pagebuilder_base + thumbImg.src }}\' alt="{{ value.title }}">
							<# } else if(thumbImg.src){ #>
                                <img class="sppb-img-responsive" src=\'{{ thumbImg.src }}\' alt="{{ value.title }}">
							<# } #>
						<# if(fullImg.src){ #>
							</a>
						<# } #>
						</li>
					<# } #>
				<# }); #>
				</ul>
			</div>
		</div>
		';

		return $output;
	}

}
