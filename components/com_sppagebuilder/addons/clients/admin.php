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
		'type'=>'repeatable',
		'addon_name'=>'sp_clients',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'title'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std'=>  ''
				),

				'heading_selector'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
					'values'=>array(
						'h1'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
						'h2'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
						'h3'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
						'h4'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
						'h5'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
						'h6'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
					),
					'std'=>'h3',
					'depends'=>array(array('title', '!=', '')),
				),

				'title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'depends'=>array(array('title', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-title { font-family: "{{ VALUE }}"; }'
					)
				),

				'title_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
					'depends'=>array(array('title', '!=', '')),
				),

				'title_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'values'=>array(
						'0'=> 'Default',
						'1px'=> '1px',
						'2px'=> '2px',
						'3px'=> '3px',
						'4px'=> '4px',
						'5px'=> '5px',
						'6px'=>	'6px',
						'7px'=>	'7px',
						'8px'=>	'8px',
						'9px'=>	'9px',
						'10px'=> '10px'
					),
					'std'=>'0',
					'depends'=>array(array('title', '!=', '')),
				),
				'title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
					'depends'=>array(array('title', '!=', '')),
				),

				'title_margin_top'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
					'placeholder'=>'10',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
					'placeholder'=>'10',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'create_carousel'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS_MAKE_CAROUSEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS_MAKE_CAROUSEL_DESC'),
					'std'=> 0,
				),
				'carousel_item_number'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_NUMBER_DESC'),
					'min'=> 1,
					'max'=> 50,
					'responsive' => true,
					'depends'=> array(
						array('create_carousel', '=', 1),
					),
				),
				'carousel_margin'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN_DESC'),
					'depends'=> array(
						array('create_carousel', '=', 1),
					),
					'std'=> 20,
				),
				'carousel_autoplay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY_DESC'),
					'depends'=>array(
						array('create_carousel', '=', 1),
					),
					'std'=>0
				),
				'carousel_speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SPEED_DESC'),
					'depends'=>array(
						array('create_carousel', '=', 1),
					),
					'std'=>2000
				),
				'carousel_interval'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_INTERVAL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL_INTERVAL_DESC'),
					'depends'=>array(
						array('create_carousel', '=', 1),
					),
					'std'=>3500
				),
				'carousel_arrow'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS_DESC'),
					'std'=>1,
					'depends'=> array(
						array('create_carousel', '=', 1),
					),
				),
				'carousel_bullet'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS_DESC'),
					'std'=>1,
					'depends'=> array(
						array('create_carousel', '=', 1),
					),
				),

				'count'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS_COUNT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS_COUNT_DESC'),
					'values'=>array(
						'sppb-col-sm-12'=>1,
						'sppb-col-sm-6'=>2,
						'sppb-col-sm-4'=>3,
						'sppb-col-sm-3'=>4,
						'sppb-col-sm-2'=>6,
					),
					'std'=>'sppb-col-sm-3',
					'depends' => array(
						array('create_carousel', '!=', 1),
					)
				),

				'alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=>'sppb-text-left',
					'depends' => array(
						array('create_carousel', '!=', 1),
					)
				),

				// Repeatable Items
				'sp_clients_item'=>array(
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENTS'),
					'attr'=>array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_TITLE_DESC'),
							'std'=>'Client 1'
						),

						'image'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMAGE_DESC'),
							'format'=>'image',
							'std'=>array(
								'src'=>'https://sppagebuilder.com/addons/clients/client1.png',
								'width'=>'',
								'height'=>''
							)
						),

						'url'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_URL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_URL_DESC'),
							'placeholder'=>'http://',
							'hide_preview'=>true,
						),
						'url_same_window'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_SAME_WINDOW'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_SAME_WINDOW_DESC'),
							'std'=> 0,
						),
					),
				),

				'add_css_filder'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_FILTER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_FILTER_DESC'),
					'values'=>array(
						'grayscale'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_FILTER_GRAYSCALE'),
						'opacity'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_FILTER_OPACITY'),
					),
					'std'=>'grayscale',
					'multiple'=>true,
				),
				'grayscale_value'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_FILTER_GRAYSCALE_PERCENTAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_FILTER_GRAYSCALE_PERCENTAGE_DESC'),
					'min'=> 0,
					'max'=> 100,
					'depends'=> array(
						array('add_css_filder', '!=', ''),
					),
					'std'=> '0',
				),
				'opacity_value'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_FILTER_OPACITY_PERCENTAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_FILTER_OPACITY_PERCENTAGE_DESC'),
					'min'=> 0,
					'max'=> 100,
					'depends'=> array(
						array('add_css_filder', '!=', ''),
					),
					'std'=> 100,
				),
				'remove_filter'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_REMOVE_FILTER'),
					'std'=> 0,
					'depends'=> array(
						array('add_css_filder', '!=', '')
					),
				),
				'scale_on_hover'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_SCALE_ON_HOVER'),
					'std'=> 0,
				),
				'scale_value'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMG_SCALE_VALUE'),
					'min'=> 0.1,
					'max'=> 5,
					'step'=> 0.1,
					'depends'=> array(
						array('scale_on_hover', '=', 1),
					),
					'std'=> 0,
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),
			),
		),
	)
);
