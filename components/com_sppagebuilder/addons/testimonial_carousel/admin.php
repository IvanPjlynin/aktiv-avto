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
		'addon_name'=>'testimonial_carousel',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CAROUSEL'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CAROUSEL_DESC'),
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
				'testimonial_carousel_layout'=>array(
					'type'=>'thumbnail',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_LAYOUT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_LAYOUT_DESC'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'values'=>array(
						'testi_layout1'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/testimonial-carousel-1.svg',
						'testi_layout2'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/testimonial-carousel-2.svg',
						'testi_layout3'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/testimonial-carousel-3.svg',
					),
					'std'=>'testi_layout3',
				),
				'show_quote_icon'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_QUOTE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_QUOTE_DESC'),
					'depends'=> array(
						array('carousel_options', '=', 'elements'),
						array('testimonial_carousel_layout', '!=', 'testi_layout3'),
					),
					'std'=> 1,
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
					),
				),
				'carousel_margin'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN_DESC'),
					'depends'=> array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=> 15,
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
					'std'=> 1500
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

				'sp_testimonial_carousel_item'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEMS'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=> array(
						array(
							'client_name' => 'Edward Morinho',
							'client_desgination' => 'Full Stack Devloper',
							'client_message' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.',
							'show_rating' => 1,
							'client_rating'=> 4.5,
							'testimonial_carousel_img' => 'https://sppagebuilder.com/addons/testimonial_carousel/testimonial-person-1.png',
						),
						array(
							'client_name' => 'Edward Morinho',
							'client_desgination' => 'Full Stack Devloper',
							'client_message' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.',
							'show_rating' => 1,
							'client_rating'=> 4.5,
							'testimonial_carousel_img' => 'https://sppagebuilder.com/addons/testimonial_carousel/testimonial-person-2.png',
						),
						array(
							'client_name' => 'Edward Morinho',
							'client_desgination' => 'Full Stack Devloper',
							'client_message' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.',
							'show_rating' => 1,
							'client_rating' => 4.5,
							'testimonial_carousel_img' => 'https://sppagebuilder.com/addons/testimonial_carousel/testimonial-person-3.png',
						),
						array(
							'client_name' => 'Edward Morinho',
							'client_desgination' => 'Full Stack Devloper',
							'client_message' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.',
							'show_rating' => 1,
							'client_rating' => 4.5,
							'testimonial_carousel_img' => 'https://sppagebuilder.com/addons/testimonial_carousel/testimonial-person-1.png',
						),
						array(
							'client_name' => 'Edward Morinho',
							'client_desgination' => 'Full Stack Devloper',
							'client_message' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.',
							'show_rating' => 1,
							'client_rating' => 4.5,
							'testimonial_carousel_img' => 'https://sppagebuilder.com/addons/testimonial_carousel/testimonial-person-2.png',
						),
						array(
							'client_name' => 'Edward Morinho',
							'client_desgination' => 'Full Stack Devloper',
							'client_message' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.',
							'show_rating' => 1,
							'client_rating' => 4.5,
							'testimonial_carousel_img' => 'https://sppagebuilder.com/addons/testimonial_carousel/testimonial-person-3.png',
						)
					),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL_DESC'),
							'std'=>'Carousel Item Tittle',
						),
						'client_name'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_NAME'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_NAME_DESC'),
							'std' => 'Edward Morinho'
						),
						'client_desgination'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_DESIGNATION'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_DESIGNATION_DESC'),
							'std' => 'Full Stack Devloper'
						),
						'client_message'=>array(
							'type'=>'textarea',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CAROUSEL_MESSAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CAROUSEL_MESSAGE_DESC'),
							'std' => 'Testimonial carousel is modern and stylish addon for SP Page Builder . Instantly raise your website appearance with this stylish new addon.'
						),
						'show_rating'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_RATING_ENABLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_RATING_ENABLE_DESC'),
							'std' => 1,
						),
						'client_rating'=>array(
							'type' => 'slider',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_RATING'),
							'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_RATING_DESC'),
							'depends' => array(
								array('show_rating', '!=', 0),
							),
							'std' => 4.5,
							'min' => 1,
							'max' => 5,
							'step' => .5,
						),
						'testimonial_carousel_img'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLIENT_IMAGE_DESC'),
							'std'=>array(
								'src'=>'https://sppagebuilder.com/addons/image_carousel/image-carousel-default.jpg',
							)
						),
					),
				),
				//Content style
				'content_alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_RIGHT'),
					),
					'std'=>'sppb-text-center',
				),
				'content_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ITEM_BG'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '!=', 'testi_layout3'),
					),
				),
				'content_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ITEM_PADDING'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '!=', 'testi_layout3'),
					),
					'responsive' => true,
				),
				'content_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ACCORDION_ITEM_BORDER_RADIUS'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '!=', 'testi_layout3'),
					),
					'min' => 0,
					'max' => 300,
				),
				//Avatar style options
				'avatar_options'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CAROUSEL_AVATAR_OPTIONS'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
				),
				'avatar_layout'=>array(
					'type'=>'thumbnail',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_AVATAR_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_AVATAR_STYLE_DESC'),
					'depends' => array(
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '!=', 'testi_layout3'),
					),
					'values'=>array(
						'avatar_layout1'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/avatar-1.svg',
						'avatar_layout2'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/avatar-2.svg',
						'avatar_layout3'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/avatar-3.svg',
						'avatar_layout4'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/testimonial_carousel/assets/images/avatar-4.svg',
					),
					'std'=>'avatar_layout3',
				),
				'avatar_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=> 60,
					'responsive' => true,
					'min'=> 1,
					'max'=> 200,
				),
				'avatar_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=> 60,
					'responsive' => true,
					'min'=> 1,
					'max'=> 200,
				),
				'avatar_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=> 100,
					'min'=> 0,
					'max'=> 1000,
				),
				'avatar_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '!=', 'testi_layout3'),
					),
					'std'=> 15,
					'min'=> 0,
					'max'=> 200,
					'responsive' => true,
				),
				//Quote icon style
				'quote_settings'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CAROUSEL_QUOTE_OPTIONS'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('show_quote_icon', '=', 1),
					)
				),
				'quote_icon_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('show_quote_icon', '=', 1),
					),
					'std'=> '#dbdbdb',
				),
				'quote_icon_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('show_quote_icon', '=', 1),
					),
					'std'=> 50,
					'min'=> 10,
					'max'=> 200,
					'responsive' => true,
				),
				'quote_icon_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('show_quote_icon', '=', 1),
					),
					'std'=> 20,
					'min'=> 0,
					'max'=> 200,
					'responsive' => true,
				),

				//Rating style
				'rating_settings'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_RATING_OPTIONS'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					)
				),
				'rating_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=> '#ffb527',
				),
				'rating_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=> 18,
					'min'=> 0,
					'max'=> 200,
					'responsive' => true,
				),
				'rating_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=> 20,
					'min'=> 0,
					'max'=> 200,
					'responsive' => true,
				),
				//Content style
				'content_settings'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					)
				),
				'content_style'=>array(
					'type'=>'buttons',
					// 'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					),
					'std'=>'name_style',
					'values'=>array(
						array(
							'label' => 'Name Style',
							'value' => 'name_style'
						),
						array(
							'label' => 'Designation Style',
							'value' => 'designation_style'
						),
						array(
							'label' => 'Message Style',
							'value' => 'message_style'
						),
					),
					'tabs' => true,
				),
				//Name style
				'name_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'std' => '#6d7175'
				),
				'name_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'min'=> 0,
					'max'=> 400,
				),
				'name_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min'=> 0,
					'max'=> 400,
				),

				'name_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-testimonial-carousel-name { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'name_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'name_letterspace'=>array(
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
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'name_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10',
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'std' => array('md'=> '10px 0px 0px 0px', 'sm'=> '0px 0px 0px 0px', 'xs'=> '0px 0px 0px 0px')
				),
				//Designation style
				'designation_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'std' => '#888d92'
				),
				'designation_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'min'=> 0,
					'max'=> 400,
				),
				'designation_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min'=> 0,
					'max'=> 400,
				),

				'designation_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-testimonial-carousel-designation { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'designation_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'designation_letterspace'=>array(
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
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				//Message style
				'message_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_BACKGROUND'),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '=', 'testi_layout3'),
					),
					'std' => '#f8f8f8'
				),
				'message_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'std' => '#888d92'
				),
				'message_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '=', 'testi_layout3'),
					),
					'min' => 0,
					'max' => 300,
				),
				'message_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=> 18,
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'min'=> 0,
					'max'=> 400,
				),
				'message_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=> 32,
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min'=> 0,
					'max'=> 400,
					'responsive' => true,
				),
				'message_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-testimonial-carousel-message { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'message_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'message_letterspace'=>array(
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
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
				'message_margin_top'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_TOP'),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'min'=> 0,
					'max'=> 300,
				),
				'message_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_BOTTOM'),
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'std' => 40,
					'min'=> 0,
					'max'=> 300,
				),
				'message_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'placeholder'=>'10',
					'depends'=>array(
						array('content_style', '=', 'message_style'),
						array('carousel_options', '=', 'item_style'),
						array('testimonial_carousel_layout', '=', 'testi_layout3'),
					),
					'responsive' => true,
					'std' => array('md'=> '30px 30px 30px 30px', 'sm'=> '25px 25px 25px 25px', 'xs'=> '15px 15px 15px 15px'),
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
					'max'=> 100,
					'min'=> 0,
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					),
					'std'=> 12,
				),
				'bullet_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'std'=>'',
					'max'=> 100,
					'min'=> 0,
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					),
					'std'=> 12,
				),
				'bullet_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'#dbdbdb',
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
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					),
					'min'=> 0,
					'max'=> 20,
					'std'=> 0,
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
					'depends'=> array(
						array('carousel_bullet', '=', 1),
						array('carousel_navigation', '=', 'bullet_controller'),
						array('carousel_options', '=', 'elements'),
						array('bullet_style', '=', 'normal_bullet'),
					),
					'min'=> 0,
					'max'=> 1000,
				),
				//Bullet hover
				'bullet_active_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'#373bff',
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
					'std'=>'long_arrow',
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
					'std'=> 50,
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
					'std'=> 52,
				),
				'arrow_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'#373bff',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					),
				),
				'arrow_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'std'=>'#fff',
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					),
				),
				'arrow_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'min'=> 0,
					'max'=> 100,
					'std'=> 24,
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
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					),
					'min'=> 0,
					'max'=> 20,
					'std'=>0,
				),
				'arrow_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'#373bff',
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
					'depends'=> array(
						array('carousel_arrow', '=', 1),
						array('carousel_navigation', '=', 'arrow_controller'),
						array('carousel_options', '=', 'elements'),
						array('arrow_style', '=', 'normal_arrow'),
					),
					'max'=> 1000,
					'min'=> 0,
					'std'=> '0',
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
