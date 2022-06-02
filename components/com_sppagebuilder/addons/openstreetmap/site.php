<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonOpenstreetmap extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';

		//Options
		$map_style = (isset($settings->map_style) && $settings->map_style) ? $settings->map_style : 'Wikimedia';
		$zoom = (isset($settings->zoom) && $settings->zoom) ? $settings->zoom : 0;
		$mousescroll = (isset($settings->mousescroll) && $settings->mousescroll) ? $settings->mousescroll : 0;
		$dragging = (isset($settings->dragging) && $settings->dragging) ? $settings->dragging : 0;
		$zoomcontrol = (isset($settings->zoomcontrol) && $settings->zoomcontrol) ? $settings->zoomcontrol : 0;
		$attribution = (isset($settings->attribution) && $settings->attribution) ? $settings->attribution : 0;

		$total_location = [];
		if((array) $settings->multi_location_items){
			foreach($settings->multi_location_items as $key => $item){
				$lat_long = explode(',', $item->location_item);
				$address_text = str_replace("'", "&#39;", $item->location_popup_text);
				$custom_icon = (isset($item->custom_icon) && $item->custom_icon) ? $item->custom_icon : '';
				$custom_icon_src = isset($custom_icon->src) ? $custom_icon->src : $custom_icon;
				if($custom_icon_src){
					if(strpos($custom_icon_src, "http://") !== false || strpos($custom_icon_src, "https://") !== false){
						$custom_icon = $custom_icon_src;
					} else {
						$custom_icon = JURI::base(true) . '/' . $custom_icon_src;
					}
				}
				$total_location[] = array(
					'address'=>$address_text,
					'latitude'=>$lat_long[0],
					'longitude'=>$lat_long[1],
					'custom_icon'=>$custom_icon
				);
			}
		}
		$location_json = json_encode($total_location);

		$output = '';
		if($location_json){
			$output .= '<div class="sppb-addon-openstreetmap-wrapper">';
			$output .= '<div class="sppb-addon-content">';
				$output .= '<div id="sppb-addon-osm-' . $this->addon->id .'" class="sppb-addon-openstreetmap '.$class.'" data-location=\''.$location_json.'\' data-mapstyle="' . $map_style . '" data-mapzoom="'. $zoom .'" data-mousescroll="'. $mousescroll .'" data-dragging="'. $dragging .'" data-zoomcontrol="'. $zoomcontrol .'" data-attribution="'. $attribution .'"></div>';
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	public function scripts() {
		return array(
			JURI::base(true) . '/components/com_sppagebuilder/assets/js/leaflet.js',
			JURI::base(true) . '/components/com_sppagebuilder/assets/js/leaflet.provider.js',
		);
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/leaflet.css');
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;
		$height = (isset($settings->height) && $settings->height) ? $settings->height : 0;
		$height_sm = (isset($settings->height_sm) && $settings->height_sm) ? $settings->height_sm : 0;
		$height_xs = (isset($settings->height_xs) && $settings->height_xs) ? $settings->height_xs : 0;

		$css = '';
		if($height) {
			$css .= $addon_id . ' .sppb-addon-openstreetmap {';
			$css .= 'height:' . (int) $height . 'px;';
			$css .= '}';
		}

		if ($height_sm) {
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				$css .= $addon_id . ' .sppb-addon-openstreetmap {';
				$css .= 'height:' . (int) $height_sm . 'px;';
				$css .= '}';
			$css .= '}';
		}

		if ($height_xs) {
			$css .= '@media (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-addon-openstreetmap {';
				$css .= 'height:' . (int) $height_xs . 'px;';
				$css .= '}';
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate() {
		$output = '
		<#

			let location_addr = [];
			if(_.isObject(data.multi_location_items) && data.multi_location_items){
				_.each(data.multi_location_items, function(item){
					let latLong = _.split(item.location_item, ",");

					var custom_icon = {}
					if (typeof item.custom_icon !== "undefined" && typeof item.custom_icon.src !== "undefined") {
						custom_icon = item.custom_icon
					} else {
						custom_icon = {src: item.custom_icon}
					}
					if(custom_icon.src){
						if(custom_icon.src?.indexOf("http://") == 0 || custom_icon.src?.indexOf("https://") == 0){
							custom_icon = custom_icon.src;
						} else {
							custom_icon = pagebuilder_base + "/" + custom_icon.src;
						}
					}
					let mainObj = [{
						address: item.location_popup_text,
						latitude: latLong[0],
						longitude: latLong[1],
						custom_icon: custom_icon
					}];
					location_addr = _.concat(location_addr, mainObj);
				})
			}

			let location_json = JSON.stringify(location_addr);
			
		#>
		<style type="text/css">
		#sppb-addon-{{ data.id }} .sppb-addon-openstreetmap {
			<# if(_.isObject(data.height)){ #>
				height: {{ data.height.md }}px;
			<# } else { #>
				height: {{ data.height }}px;
			<# } #>
		}
		@media (min-width: 768px) and (max-width: 991px) {
			#sppb-addon-{{ data.id }} .sppb-addon-openstreetmap {
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.sm }}px;
				<# } #>
			}
		}
		@media (max-width: 767px) {
			#sppb-addon-{{ data.id }} .sppb-addon-openstreetmap {
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.xs }}px;
				<# } #>
			}
		}
		</style>
		<div class="sppb-addon-openstreetmap-wrapper edit-view">
			<div class="sppb-addon-content">
				<div id="sppb-addon-osm-{{ data.id }}" class="sppb-addon-openstreetmap {{data.class}}" data-location=\'{{location_json}}\' data-mapstyle="{{data.map_style}}" data-mapzoom="{{data.zoom}}" data-mousescroll="{{data.mousescroll}}" data-dragging="{{data.dragging}}" data-zoomcontrol="{{data.zoomcontrol}}" data-attribution="{{data.attribution}}"></div>
			</div>
		</div>
		';

		return $output;
	}
}
