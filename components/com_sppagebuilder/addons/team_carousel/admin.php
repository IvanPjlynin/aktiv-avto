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
		'addon_name'=>'team_carousel',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_DESC'),
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
				'team_carousel_layout'=>array(
					'type'=>'thumbnail',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_LAYOUT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_LAYOUT_DESC'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'values'=>array(
						'layout1'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/team_carousel/assets/images/team-carousel-1.svg',
						'layout2'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/team_carousel/assets/images/team-carousel-2.svg',
						'layout3'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/team_carousel/assets/images/team-carousel-3.svg',
					),
					'std'=>'layout1',
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
					'std' => 3,
				),
				'carousel_margin'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_MARGIN_DESC'),
					'depends'=> array(
						array('carousel_options', '=', 'elements'),
						array('team_carousel_layout', '!=', 'layout1'),
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
				'content_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_CONTENT_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_CONTENT_BG_DESC'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('team_carousel_layout', '!=', 'layout2'),
					),
					'std'=> '',
				),
				'overlay_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT_DESC'),
					'std'=> array(
						"color" => "rgba(0, 169, 255, .9)",
						"color2" => "rgba(0, 47, 255, .9)",
						"deg" => "125",
						"type" => "linear"
					),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
						array('team_carousel_layout', '=', 'layout2'),
					)
				),
				'content_settings'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('carousel_options', '=', 'item_style'),
					)
				),
				'content_style'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
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
							'label' => 'Social Icon Style',
							'value' => 'social_style'
						),
					),
					'tabs' => true,
				),
				//Title style
				'content_name_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'content_name_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=> 400,
				),
	
				'content_name_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-carousel-extended-team-name { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_name_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_name_letterspace'=>array(
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
	
				'content_name_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_name_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10',
					'depends'=>array(
						array('content_style', '=', 'name_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=>400,
					'responsive' => true
				),
				//Designation style
				'content_designation_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'content_designation_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=> 400,
				),
	
				'content_designation_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-carousel-extended-team-designation { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_designation_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
	
				'content_designation_letterspace'=>array(
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
	
				'content_designation_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'designation_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				//social icon style
				'social_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'social_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
				'social_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min' => 0,
					'max' => 200,
					'responsive' => true,
				),
				'social_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min' => 0,
					'max' => 200,
					'responsive' => true,
				),
				'social_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH_DESC'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min' => 0,
					'max' => 10,
				),
				'social_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_DESC'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
				'social_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'min' => 0,
					'max' => 200,
				),
				'social_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10',
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
					'max'=>400,
					'responsive' => true
				),
				'social_hover_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_ICON_HOVER_COLOR'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),
				'social_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER_DESC'),
					'depends'=>array(
						array('content_style', '=', 'social_style'),
						array('carousel_options', '=', 'item_style'),
					),
				),

				'sp_team_carousel_item'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEMS'),
					'depends' => array(
						array('carousel_options', '=', 'elements'),
					),
					'std'=> array(
						array(
							'team_carousel_img' => array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team1.jpg',
							),
							'person_name' => 'Jhon Doe',
							'person_designation' => 'Software Engineer',
							'team_carousel_item' => array(
								array(
									'title' => 'Facebook',
									'social_icon' => 'fab fa-facebook-f',
									'social_url' => 'https://facebook.com'
								),
								array(
									'title' => 'twitter',
									'social_icon' => 'fab fa-twitter',
									'social_url' => 'https://twitter.com'
								),
								array(
									'title' => 'Linkedin',
									'social_icon' => 'fab fa-linkedin',
									'social_url' => 'https://linkedin.com'
								),
								array(
									'title' => 'Instagram',
									'social_icon' => 'fab fa-instagram',
									'social_url' => 'https://instagram.com'
								),
								array(
									'title' => 'Dribbble',
									'social_icon' => 'fab fa-dribbble',
									'social_url' => 'https://dribbble.com'
								),
							),
						),
						array(
							'team_carousel_img' => array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team2.jpg',
							),
							'person_name' => 'Jhon Doe',
							'person_designation' => 'Software Engineer',
							'team_carousel_item' => array(
								array(
									'title' => 'Facebook',
									'social_icon' => 'fab fa-facebook-f',
									'social_url' => 'https://facebook.com'
								),
								array(
									'title' => 'twitter',
									'social_icon' => 'fab fa-twitter',
									'social_url' => 'https://twitter.com'
								),
								array(
									'title' => 'Linkedin',
									'social_icon' => 'fab fa-linkedin',
									'social_url' => 'https://linkedin.com'
								),
								array(
									'title' => 'Instagram',
									'social_icon' => 'fab fa-instagram',
									'social_url' => 'https://instagram.com'
								),
								array(
									'title' => 'Dribbble',
									'social_icon' => 'fab fa-dribbble',
									'social_url' => 'https://dribbble.com'
								),
							),
						),
						array(
							'team_carousel_img' => array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team3.jpg',
							),
							'person_name' => 'Jhon Doe',
							'person_designation' => 'Software Engineer',
							'team_carousel_item' => array(
								array(
									'title' => 'Facebook',
									'social_icon' => 'fab fa-facebook-f',
									'social_url' => 'https://facebook.com'
								),
								array(
									'title' => 'twitter',
									'social_icon' => 'fab fa-twitter',
									'social_url' => 'https://twitter.com'
								),
								array(
									'title' => 'Linkedin',
									'social_icon' => 'fab fa-linkedin',
									'social_url' => 'https://linkedin.com'
								),
								array(
									'title' => 'Instagram',
									'social_icon' => 'fab fa-instagram',
									'social_url' => 'https://instagram.com'
								),
								array(
									'title' => 'Dribbble',
									'social_icon' => 'fab fa-dribbble',
									'social_url' => 'https://dribbble.com'
								),
							),
						),
						array(
							'team_carousel_img' => array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team1.jpg',
							),
							'person_name' => 'Jhon Doe',
							'person_designation' => 'Software Engineer',
							'team_carousel_item' => array(
								array(
									'title' => 'Facebook',
									'social_icon' => 'fab fa-facebook-f',
									'social_url' => 'https://facebook.com'
								),
								array(
									'title' => 'twitter',
									'social_icon' => 'fab fa-twitter',
									'social_url' => 'https://twitter.com'
								),
								array(
									'title' => 'Linkedin',
									'social_icon' => 'fab fa-linkedin',
									'social_url' => 'https://linkedin.com'
								),
								array(
									'title' => 'Instagram',
									'social_icon' => 'fab fa-instagram',
									'social_url' => 'https://instagram.com'
								),
								array(
									'title' => 'Dribbble',
									'social_icon' => 'fab fa-dribbble',
									'social_url' => 'https://dribbble.com'
								),
							),
						),
						array(
							'team_carousel_img' => array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team2.jpg',
							),
							'person_name' => 'Jhon Doe',
							'person_designation' => 'Software Engineer',
							'team_carousel_item' => array(
								array(
									'title' => 'Facebook',
									'social_icon' => 'fab fa-facebook-f',
									'social_url' => 'https://facebook.com'
								),
								array(
									'title' => 'twitter',
									'social_icon' => 'fab fa-twitter',
									'social_url' => 'https://twitter.com'
								),
								array(
									'title' => 'Linkedin',
									'social_icon' => 'fab fa-linkedin',
									'social_url' => 'https://linkedin.com'
								),
								array(
									'title' => 'Instagram',
									'social_icon' => 'fab fa-instagram',
									'social_url' => 'https://instagram.com'
								),
								array(
									'title' => 'Dribbble',
									'social_icon' => 'fab fa-dribbble',
									'social_url' => 'https://dribbble.com'
								),
							),
						),
						array(
							'team_carousel_img' => array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team3.jpg',
							),
							'person_name' => 'Jhon Doe',
							'person_designation' => 'Software Engineer',
							'team_carousel_item' => array(
								array(
									'title' => 'Facebook',
									'social_icon' => 'fab fa-facebook-f',
									'social_url' => 'https://facebook.com'
								),
								array(
									'title' => 'twitter',
									'social_icon' => 'fab fa-twitter',
									'social_url' => 'https://twitter.com'
								),
								array(
									'title' => 'Linkedin',
									'social_icon' => 'fab fa-linkedin',
									'social_url' => 'https://linkedin.com'
								),
								array(
									'title' => 'Instagram',
									'social_icon' => 'fab fa-instagram',
									'social_url' => 'https://instagram.com'
								),
								array(
									'title' => 'Dribbble',
									'social_icon' => 'fab fa-dribbble',
									'social_url' => 'https://dribbble.com'
								),
							),
						)
					),
					'attr'=>  array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADMIN_LABEL_DESC'),
							'std'=>'Carousel Item Tittle',
						),
						'team_carousel_img'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE_DESC'),
							'std'=>array(
								'src'=>'https://sppagebuilder.com/addons/team_carousel/team1.jpg',
							)
						),
						'person_name'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_DESC'),
						),
						'person_designation'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_DESC'),
						),
						'person_profile_link'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SELF_PROFILE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SELF_PROFILE_DESC'),
							'placeholder'=>'http://',
							'hide_preview'=>true,
						),
						'link_open_new_window' => array(
							'type' => 'checkbox',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW'),
							'std' => 0,
							'depends'=>array(array('person_profile_link', '!=', '')),
						),
						'social_separator' => array(
							'type' => 'separator',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_OPTION'),
						),
						'team_carousel_item'=>array(
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SOCIAL_PROFILES'),
							'type'=>'repeatable',
							'attr'=>array(
								'title'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
									'std'=> 'Facebook Profile'
								),
								'social_icon'=>array(
									'type'=>'icon',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SOCIAL_ICON'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SOCIAL_ICON_DESC'),
								),
								'social_url'=>array(
									'type'=>'media',
									'hide_preview'=>true,
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SOCIAL_URL'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEAM_CAROUSEL_SOCIAL_URL_DESC'),
								),
							),
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
