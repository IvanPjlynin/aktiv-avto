<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_openstreetmap',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_DESC'),
		'category'=>'General',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'height' => array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_HEIGHT_DESC'),
					'placeholder'=>'400',
					'std'=>array('md'=>400),
					'max'=>2000,
					'responsive'=>true,
				),
				
				'map_style' => array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_DESC'),
					'values'=>array(
						'Stamen.TonerLite'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_LITE'),
						'Stamen.Toner'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_TONER'),
						'Stamen.TonerHybrid'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_HYBRID'),
						'Stamen.Terrain'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_TERRAIN'),
						'CartoDB.Positron'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_LIGHT_ALL'),
						'CartoDB.DarkMatter'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_DARK_ALL'),
						'Esri.DeLorme'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_DELORME'),
						'Hydda.Full'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_HYDDA_FULL'),
						'Wikimedia'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_WIKIMEDIA'),
						'CartoDB.Voyager'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_VOYAGER'),
						'Esri.NatGeoWorldMap'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_NATGEO'),
						'NASAGIBS.ViirsEarthAtNight2012'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_NASA'),
						'OpenStreetMap.Mapnik'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_MAPNIK'),
						'OpenStreetMap.HOT'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_HOT'),
						'Esri.OceanBasemap'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_OCEAN_BASE_MAP'),
						'Esri.WorldStreetMap'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_WORLDSTREET'),
						'Esri.WorldTopoMap'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_WORLD_TOPO'),
						'Esri.WorldGrayCanvas'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_STYLE_WORLD_GRAY_CANVAS'),
					),
					'std'=>'Wikimedia',
				),

				'multi_location_items' => array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_MULTI_LOCATION_ITEMS'),
					'attr'=> array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LOCATION_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_LOCATION_ITEM_TITLE_DESC'),
							'std'=>'Location Item Title',
						),
						'location_item'=>array(
							'type'=>'gmap',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_LOCATION'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_LOCATION_DESC'),
							'std'=>'40.7970,-73.9491',
						),
						'location_popup_text' => array(
							'type'=>'textarea',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_INFOWINDOW'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_INFOWINDOW_DESC'),
							'std'=>'Manhattan Island',
						),
						'custom_icon' => array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ICON'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ICON_DESC'),
							'std'=> array(
								'src' => '',
							)
						),
					),
				),

				'zoom' => array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ZOOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ZOOM_DESC'),
					'placeholder'=>'5',
					'std'=>13,
					'max'=>50,
				),

				'mousescroll' => array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_MOUSE_SCROLL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_MOUSE_SCROLL_DESC'),
					'std'=>0,
				),

				'dragging' => array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ENABLE_DRAGGING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_DRAGGING_DESC'),
					'std'=>0,
				),

				'zoomcontrol' => array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_ZOOMCONTROL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_ZOOMCONTROL_DESC'),
					'std'=>0,
				),

				'attribution' => array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_ATTRIBUTION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPENSTREETMAP_ENABLE_ATTRIBUTION_DESC'),
					'std'=>1,
				),
				
				'class' => array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),
			)
		),
	)
);
