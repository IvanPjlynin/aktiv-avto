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
		'type' => 'repeatable',
		'addon_name'=>'image_carousel',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL_DESC'),
		'category'=>'Slider',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				'carousel_options'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL_OPTIONS'),
					'std'=>'elements',
					'values'=>array(
						array(
							'label' => 'Carousel Elements',
							'value' => 'elements'
						),
						array(
							'label' => 'Carousel Items Style',
							'value' => 'item_style'
						),
					),
					'tabs' => true,
				),
				'image_carousel_layout'=>array(
					'type'=>'thumbnail',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_LAYOUT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_LAYOUT_DESC'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'values'=>array(
						'layout1'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_carousel/assets/images/imgage-carousel-1.svg',
						'layout2'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_carousel/assets/images/imgage-carousel-2.svg',
						'layout3'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_carousel/assets/images/imgage-carousel-3.svg',
						'layout4'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_carousel/assets/images/imgage-carousel-4.svg',
					),
					'std'=>'layout3',
				),
				'carousel_fade'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_FADE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_FADE_DESC'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
						array('image_carousel_layout', '=', 'layout1'),
					),
					'std'=> 0,
				),
				'carousel_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_PRO_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_PRO_HEIGHT_DESC'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'min'=> 100,
					'max'=> 1500,
					'std'=> 500,
					'responsive' => true,
				),
				'carousel_item_number'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_NUMBER_DESC'),
					'min'=> 1,
					'max'=> 15,
					'responsive' => true,
					'depends'=> array(
						array('carousel_options', '=', 'elements'),
						array('image_carousel_layout', '!=', 'layout1'),
						array('image_carousel_layout', '!=', 'layout3'),
					),
				),
				'carousel_margin'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN_DESC'),
					'depends'=> array(
						array('carousel_options', '=', 'elements'),
						array('image_carousel_layout', '!=', 'layout1'),
					),
					'std'=> 15,
				),
				'carousel_center_padding'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL_CENTER_PAD'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL_CENTER_PAD_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'elements'),
						array('image_carousel_layout', '!=', 'layout1'),
						array('image_carousel_layout', '!=', 'layout2'),
					),
					'std'=> array('md' => 180, 'sm' => 90, 'xs' => 50),
					'min' => 0,
					'max' => 500,
					'responsive' => true,
				),
				'carousel_autoplay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=>0
				),
				'carousel_speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SPEED_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=>2500
				),
				'carousel_interval'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_INTERVAL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_CAROUSEL_INTERVAL_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=>4500
				),
				'carousel_overlay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std' => 0
				),
				'overlay_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT_DESC'),
					'std'=> array(
						"color" => "rgba(59, 25, 208, 0.5)",
						"color2" => "rgba(255, 79, 226, 0.5)",
						"deg" => "125",
						"type" => "linear"
					),
					'depends'=>array(
						array('carousel_overlay', '=', 1),
						array('carousel_options', '=', 'item_style'),
					)
				),
				'content_settings'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					)
				),
				'item_content_verti_align'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_VERT_ALIGN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_VERT_ALIGN_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'values' => array(
						'top' => JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
						'middle' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MIDDLE'),
						'bottom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
					),
					'std' => 'middle',
				),
				'item_content_hori_align'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONT_HORI_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONT_HORI_ALIGNMENT_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'values' => array(
						'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'center' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std' => 'center',
				),
				'content_style'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=>'title_style',
					'values'=>array(
						array(
							'label' => 'Title Style',
							'value' => 'title_style'
						),
						array(
							'label' => 'Subtitle Style',
							'value' => 'subtitle_style'
						),
						array(
							'label' => 'Description Style',
							'value' => 'desc_style'
						),
					),
					'tabs' => true,
				),
				//Title style
				'content_title_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'content_title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=> 400,
				),
	
				'content_title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-carousel-extended-heading { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_title_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_title_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'values'=>array(
						'-10px'=> '-10px',
						'-9px'=> '-9px',
						'-8px'=> '-8px',
						'-7px'=> '-7px',
						'-6px'=> '-6px',
						'-5px'=> '-5px',
						'-4px'=> '-4px',
						'-3px'=> '-3px',
						'-2px'=> '-2px',
						'-1px'=> '-1px',
						'0px'=> 'Default',
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
					'std'=>'0px',
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10',
					'depends'=>array(
						array('content_style', '=', 'title_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=>400,
					'responsive' => true
				),
				//Subtitle style
				'content_subtitle_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'subtitle_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'content_subtitle_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'subtitle_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=> 400,
				),
	
				'content_subtitle_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-carousel-extended-subheading { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'subtitle_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_subtitle_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'subtitle_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_subtitle_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'values'=>array(
						'-10px'=> '-10px',
						'-9px'=> '-9px',
						'-8px'=> '-8px',
						'-7px'=> '-7px',
						'-6px'=> '-6px',
						'-5px'=> '-5px',
						'-4px'=> '-4px',
						'-3px'=> '-3px',
						'-2px'=> '-2px',
						'-1px'=> '-1px',
						'0px'=> 'Default',
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
					'std'=>'0px',
					'depends'=>array(
						array('content_style', '=', 'subtitle_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_subtitle_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'subtitle_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				//Description style
				'description_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'description_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=> 400,
				),
				'description_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-carousel-extended-description { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'description_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'description_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'values'=>array(
						'-10px'=> '-10px',
						'-9px'=> '-9px',
						'-8px'=> '-8px',
						'-7px'=> '-7px',
						'-6px'=> '-6px',
						'-5px'=> '-5px',
						'-4px'=> '-4px',
						'-3px'=> '-3px',
						'-2px'=> '-2px',
						'-1px'=> '-1px',
						'0px'=> 'Default',
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
					'std'=>'0px',
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'description_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'description_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10',
					'depends'=>array(
						array('content_style', '=', 'desc_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=>400,
					'responsive' => true
				),

				'sp_image_carousel_item'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEMS'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=> array(
						array(
							'image_carousel_img' => 'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
						),
						array(
							'image_carousel_img' => 'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
						),
						array(
							'image_carousel_img' => 'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
						),
						array(
							'image_carousel_img' => 'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
						),
						array(
							'image_carousel_img' => 'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
						),
						array(
							'image_carousel_img' => 'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
						)
					),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL_DESC'),
							'std'=>'Carousel Item Tittle',
						),
						'item_title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_DESC'),
						),
						'item_subtitle'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_SUBTITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_SUBTITLE_DESC'),
						),
						'item_description'=>array(
							'type'=>'textarea',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_DESCRIPTION'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_DESCRIPTION_DESC'),
						),
						'image_carousel_img'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE_DESC'),
							'std'=> array(
								'src' => 'https://sppagebuilder.com/addons/js_slideshow/slideshow-default-bg.jpg',
							),
						),
						'image_carousel_img_link'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_URL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_URL_DESC'),
							'placeholder'=>'http://',
							'hide_preview'=>true,
							'std'=>'',
						),
						'link_open_new_window' => array(
							'type' => 'checkbox',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW'),
							'std' => 0,
							'depends'=>array(array('image_carousel_img_link', '!=', '')),
						),
					),
				),
				'controller_settings'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_SEPARATOR'),
					'depends'=>array(
						array('carousel_options', '=', 'elements'),
					),
				),
				
				'carousel_navigation'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_NAVIGATION'),
					'depends'=>array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=>'bullet_controller',
					'values'=>array(
						array(
							'label' => 'Bullet Controller',
							'value' => 'bullet_controller'
						),
						array(
							'label' => 'Arrow Controller',
							'value' => 'arrow_controller'
						)
					),
				),
				'carousel_bullet'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS_DESC'),
					'std'=>1,
					'depends'=> array(
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
					),
				),
				'bullet_position_verti'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_VERTICAL_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_VERTICAL_POSITION_DESC'),
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
					),
					'min' => -100,
					'max' => 100,
					'responsive' => true,
				),
				'bullet_position_hori'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_HORI_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_HORI_POSITION_DESC'),
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
					),
					'min' => -2000,
					'max' => 2000,
					'responsive' => true,
				),

				'bullet_style'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_BULLET_STYLE'),
					'std'=>'normal_bullet',
					'values'=>array(
						array(
							'label' => 'Normal Bullet',
							'value' => 'normal_bullet'
						),
						array(
							'label' => 'Active Bullet',
							'value' => 'active_bullet'
						)
					),
					'depends'=>array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
					),
				),
				'bullet_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'std'=>'',
					'max'=>100,
					'min'=>1,
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					),
					'std'=> 4,
				),
				'bullet_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'std'=>'',
					'max'=>100,
					'min'=>10,
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					),
					'std'=> 25,
				),
				'bullet_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					)
				),
				'bullet_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'max'=> 20,
					'std'=>0,
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					)
				),
				'bullet_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					)
				),
				'bullet_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'max'=> 1000,
					'std'=>'',
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					)
				),
				//Bullet hover
				'bullet_active_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'active_bullet'),
					)
				),

				// Arrow style
				'carousel_arrow'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS_DESC'),
					'std'=>1,
					'depends'=> array(
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
					),
				),
				'arrow_position_verti'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_VERTICAL_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_VERTICAL_POSITION_DESC'),
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
					),
					'min' => -100,
					'max' => 100,
					'responsive' => true,
				),
				'arrow_position_hori'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_HORI_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTROLLER_HORI_POSITION_DESC'),
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
					),
					'min' => -200,
					'max' => 200,
					'responsive' => true,
				),
				'arrow_icon'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ARROWS_ICON'),
					'values'=>array(
						'angle'=>'Angle',
						'long_arrow'=>'Long Arrow',
					),
					'std'=>'angle',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
					)
				),

				'arrow_style'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ARROWS_STYLE'),
					'std'=>'normal_arrow',
					'values'=>array(
						array(
							'label' => 'Normal Arrow',
							'value' => 'normal_arrow'
						),
						array(
							'label' => 'Hover Arrow',
							'value' => 'hover_arrow'
						)
					),
					'depends'=>array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
					),
				),
				'arrow_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'std'=>'',
					'max'=>200,
					'min'=>10,
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					),
					'std'=> 60,
				),
				'arrow_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'std'=>'',
					'max'=>200,
					'min'=>10,
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					),
					'std'=> 60,
				),
				'arrow_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'max'=> 100,
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'max'=> 20,
					'std'=>0,
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'max'=> 1000,
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				//Arrow hover
				'arrow_hover_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'hover_arrow'),
					)
				),
				'arrow_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'hover_arrow'),
					)
				),
				'arrow_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'hover_arrow'),
					)
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
