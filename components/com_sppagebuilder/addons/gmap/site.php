<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonGmap extends SppagebuilderAddons {

	public function render() {

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$heading_selector = (isset($settings->heading_selector) && $settings->heading_selector) ? $settings->heading_selector : 'h3';

		//Options
		$map = (isset($settings->map) && $settings->map) ? $settings->map : '';
		$infowindow  = (isset($settings->infowindow) && $settings->infowindow) ? $settings->infowindow : '';
		$gmap_api = (isset($settings->gmap_api) && $settings->gmap_api) ? $settings->gmap_api : '';
		$type = (isset($settings->type) && $settings->type) ? $settings->type : '';
		$zoom = (isset($settings->zoom) && $settings->zoom) ? $settings->zoom : '';
		$mousescroll = (isset($settings->mousescroll) && $settings->mousescroll) ? $settings->mousescroll : '';
		$show_controllers = (isset($settings->show_controllers) && $settings->show_controllers) ? $settings->show_controllers : 0;

		$multi_location = (isset($settings->multi_location) && $settings->multi_location) ? $settings->multi_location : 0;
		$location_addr = [];
		if(isset($settings->multi_location_items) && $multi_location !== 0){
			foreach($settings->multi_location_items as $key => $item){
				$lat_long = explode(',', $item->location_item);
				$location_addr[] = array('address'=>$item->location_popup_text, 'latitude'=>$lat_long[0],'longitude'=>$lat_long[1]);
			}
		}
		$location_json = json_encode($location_addr);

		if($map) {
			$map = explode(',', $map);
			$output  = '<div id="sppb-addon-map-'. $this->addon->id .'" class="sppb-addon sppb-addon-gmap ' . $class . '">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div id="sppb-addon-gmap-'. $this->addon->id .'" class="sppb-addon-gmap-canvas" data-lat="' . trim($map[0]) . '" data-lng="' . trim($map[1]) . '" data-location=\''.base64_encode($location_json).'\' data-maptype="' . $type . '" data-mapzoom="' . $zoom . '" data-mousescroll="' . $mousescroll . '" data-infowindow="' . base64_encode($infowindow) . '" data-show-controll=\''.$show_controllers.'\'></div>';
			$output .= '</div>';
			$output .= '</div>';
			return $output;

		}

		return;
	}

	public function scripts() {

		jimport('joomla.application.component.helper');
		$params = JComponentHelper::getParams('com_sppagebuilder');
		$gmap_api = $params->get('gmap_api', '');

		return array(
			'https://maps.googleapis.com/maps/api/js?key='. $gmap_api,
			JURI::base(true) . '/components/com_sppagebuilder/assets/js/gmap.js'
		);
	}

	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$height = (isset($this->addon->settings->height) && $this->addon->settings->height) ? $this->addon->settings->height : 0;
		$height_sm = (isset($this->addon->settings->height_sm) && $this->addon->settings->height_sm) ? $this->addon->settings->height_sm : 0;
		$height_xs = (isset($this->addon->settings->height_xs) && $this->addon->settings->height_xs) ? $this->addon->settings->height_xs : 0;

		$css = '';
		if($height) {
			$css .= $addon_id . ' .sppb-addon-gmap-canvas {';
			$css .= 'height:' . (int) $height . 'px;';
			$css .= '}';
		}

		if ($height_sm) {
			$css .= '@media (min-width: 768px) and (max-width: 991px) {';
				$css .= $addon_id . ' .sppb-addon-gmap-canvas {';
				$css .= 'height:' . (int) $height_sm . 'px;';
				$css .= '}';
			$css .= '}';
		}

		if ($height_xs) {
			$css .= '@media (max-width: 767px) {';
				$css .= $addon_id . ' .sppb-addon-gmap-canvas {';
				$css .= 'height:' . (int) $height_xs . 'px;';
				$css .= '}';
			$css .= '}';
		}

		return $css;
	}

	public static function getTemplate() {
		$output = '
		<#
			var map = data.map?.split(",");

			var ConvertToBaseSixFour = {
				_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
				encode: function(e) {
					var t = "";
					var n, r, i, s, o, u, a;
					var f = 0;
					e = ConvertToBaseSixFour._utf8_encode(e);
					while (f < e.length) {
						n = e.charCodeAt(f++);
						r = e.charCodeAt(f++);
						i = e.charCodeAt(f++);
						s = n >> 2;
						o = (n & 3) << 4 | r >> 4;
						u = (r & 15) << 2 | i >> 6;
						a = i & 63;
						if (isNaN(r)) {
							u = a = 64
						} else if (isNaN(i)) {
							a = 64
						}
						t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
					}
					return t
				},
				_utf8_encode: function(e) {
					e = e.replace(/rn/g, "n");
					var t = "";
					for (var n = 0; n < e.length; n++) {
						var r = e.charCodeAt(n);
						if (r < 128) {
							t += String.fromCharCode(r)
						} else if (r > 127 && r < 2048) {
							t += String.fromCharCode(r >> 6 | 192);
							t += String.fromCharCode(r & 63 | 128)
						} else {
							t += String.fromCharCode(r >> 12 | 224);
							t += String.fromCharCode(r >> 6 & 63 | 128);
							t += String.fromCharCode(r & 63 | 128)
						}
					}
					return t
				}
			};
			var infoText = (!_.isEmpty(data.infowindow)) ? ConvertToBaseSixFour.encode(data.infowindow) : "";

			let location_addr = {
				address: data.infowindow,
				latitude: map?.[0],
				longitude: map?.[1]
			};
			if(_.isObject(data.multi_location_items) && data.multi_location !== 0){
				_.each(data.multi_location_items, function(item){
					let latLong = _.split(item.location_item, ",");
					let mainObj = {
						address: item.location_popup_text,
						latitude: latLong[0],
						longitude: latLong[1]
					}
					location_addr = _.concat(location_addr, mainObj);
				})
			}
			let latiLongi = _.split(location_addr.location_item, ",");

			let location_json = JSON.stringify(location_addr);
			
		#>
		<style type="text/css">
		#sppb-addon-{{ data.id }} .sppb-addon-gmap-canvas {
			<# if(_.isObject(data.height)){ #>
				height: {{ data.height.md }}px;
			<# } else { #>
				height: {{ data.height }}px;
			<# } #>
		}
		@media (min-width: 768px) and (max-width: 991px) {
			#sppb-addon-{{ data.id }} .sppb-addon-gmap-canvas {
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.sm }}px;
				<# } #>
			}
		}
		@media (max-width: 767px) {
			#sppb-addon-{{ data.id }} .sppb-addon-gmap-canvas {
				<# if(_.isObject(data.height)){ #>
					height: {{ data.height.xs }}px;
				<# } #>
			}
		}
		</style>
		<div id="sppb-addon-map-{{ data.id }}" class="sppb-addon sppb-addon-gmap {{ data.class }}">
			<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
			<div class="sppb-addon-content">
				<div id="sppb-addon-gmap-{{ data.id }}" class="sppb-addon-gmap-canvas" data-location=\'{{ConvertToBaseSixFour.encode(location_json)}}\' data-lat="{{ map?.[0] }}" data-lng="{{ map?.[1] }}" data-maptype="{{ data.type }}" data-mapzoom="{{ data.zoom }}" data-mousescroll="{{ data.mousescroll }}" data-infowindow="{{ infoText }}" data-show-controll="{{data.show_controllers}}"></div>
			</div>
		</div>
		';

		return $output;
	}
}
