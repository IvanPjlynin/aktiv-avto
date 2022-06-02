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
		'addon_name'=>'sp_person',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_PHOTO'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_PHOTO_DESC'),
					'format'=>'image',
					'std'=> array(
						'src' => 'https://sppagebuilder.com/addons/person/person1.jpg',
					)
				),

				'image_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_IMAGE_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_IMAGE_BORDER_RADIUS_DESC'),
					'std'=>0,
					'max'=>400
				),
				'predefine_separator' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_PREDEFINE_OPTION'),
				),
				'person_style_preset'=>array(
					'type'=>'thumbnail',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_STYLE_DESC'),
					'values'=>array(
						'default'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/person/assets/images/default.png',
						'layout1'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/person/assets/images/layout1.png',
						'layout2'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/person/assets/images/layout2.png',
						'layout3'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/person/assets/images/layout3.png',
						'layout4'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/person/assets/images/layout4.png',
					),
					'std'=>'default',
				),

				'content_overlay_type'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_CONTENT_OVERLAY_TYPE'),
					'std'=>'gradient',
					'values'=>array(
						array(
							'label' => 'None',
							'value' => 'none'
						),
						array(
							'label' => 'Color',
							'value' => 'color'
						),
						array(
							'label' => 'Gradient',
							'value' => 'gradient'
						)
					),
					'depends'=>array(
						array('person_style_preset', '!=', 'layout4'),
					),
				),
				'content_overlay_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY'),
					'std'=>'',
					'depends'=>array(
						array('person_style_preset', '!=', 'layout4'),
						array('content_overlay_type', '=', 'color'),
					),
				),
				'content_overlay_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_CONTENT_OVERLAY_GRADIENT'),
					'std'=> array(
						"color" => "rgba(127, 0, 255, 0.8)",
						"color2" => "rgba(225, 0, 255, 0.7)",
						"deg" => "45",
						"type" => "linear"
					),
					'depends'=>array(
						array('person_style_preset', '!=', 'layout4'),
						array('content_overlay_type', '=', 'gradient'),
					)
				),
				'name_desig_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_DESING_BG'),
					'std'=> '#fff',
					'depends'=>array(
						array('person_style_preset', '=', 'layout1'),
					)
				),
				'name_desig_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_DESING_PADDING'),
					'std'=> '15px 0px 15px 15px',
					'depends'=>array(
						array('person_style_preset', '=', 'layout1'),
					)
				),
				'person_content_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_BG'),
					'std'=> '#fff',
					'depends'=>array(
						array('person_style_preset', '=', 'layout4'),
					)
				),
				'person_content_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_PADDING'),
					'depends'=>array(
						array('person_style_preset', '=', 'layout4'),
					),
					'responsive'=>true,
					'std'=> '15px 15px 15px 15px',
				),
				'name_separator' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_OPTION'),
				),
				'name'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_DESC'),
					'placeholder'=>'John Doe',
					'std'=>'Ahin Xian',
				),
				'name_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_COLOR'),
					'depends'=>array(array('name', '!=', '')),
				),
				'name_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_FONTSIZE'),
					'depends'=>array(array('name', '!=', '')),
					'max'=> 400,
					'responsive'=>true,
					'std'=> ''
				),
				'name_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_LINEHEIGHT'),
					'depends'=>array(array('name', '!=', '')),
					'max'=> 400,
					'responsive'=>true,
					'std'=> ''
				),
				'name_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_LATTERSPACING'),
					'depends'=>array(array('name', '!=', '')),
					'values'=>array(
						'-10px'=> '-10px',
						'-9px'=>  '-9px',
						'-8px'=>  '-8px',
						'-7px'=>  '-7px',
						'-6px'=>  '-6px',
						'-5px'=>  '-5px',
						'-4px'=>  '-4px',
						'-3px'=>  '-3px',
						'-2px'=>  '-2px',
						'-1px'=>  '-1px',
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
					'std'=>'0px'
				),
				'name_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_FONT_FAMILY'),
					'depends'=>array(array('name', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-person-name { font-family: "{{ VALUE }}"; }'
					)
				),
				'name_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_FONT_STYLE'),
					'depends'=>array(array('name', '!=', '')),
				),
				//Designation
				'designation_separator' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_OPTION'),
				),
				'designation'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_DESC'),
					'placeholder'=>'Creative Director',
					'std'=>'Creative Director',
				),
				'designation_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_COLOR'),
					'depends'=>array(array('designation', '!=', '')),
				),
				'designation_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_FONTSIZE'),
					'depends'=>array(array('designation', '!=', '')),
					'max'=> 400,
					'responsive'=>true,
					'std'=> ''
				),
				'designation_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_LINEHEIGHT'),
					'depends'=>array(array('designation', '!=', '')),
					'max'=> 400,
					'responsive'=>true,
					'std'=> ''
				),
				'designation_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_LATTERSPACING'),
					'depends'=>array(array('designation', '!=', '')),
					'values'=>array(
						'-10px'=> '-10px',
						'-9px'=>  '-9px',
						'-8px'=>  '-8px',
						'-7px'=>  '-7px',
						'-6px'=>  '-6px',
						'-5px'=>  '-5px',
						'-4px'=>  '-4px',
						'-3px'=>  '-3px',
						'-2px'=>  '-2px',
						'-1px'=>  '-1px',
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
					'std'=>'0px'
				),
				'designation_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_FONT_FAMILY'),
					'depends'=>array(array('designation', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-person-designation { font-family: "{{ VALUE }}"; }'
					)
				),
				'designation_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_FONT_STYLE'),
					'depends'=>array(array('designation', '!=', '')),
				),
				'designation_margin'=>array(
					'type'=>'margin',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_MARGIN'),
					'depends'=>array(array('designation', '!=', '')),
					'responsive'=>true,
					'std'=>''
				),
				'intro_separator' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_EMAIL_INTRO_OPTION'),
				),
				'email'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_EMAIL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_EMAIL_DESC'),
					'placeholder'=>'name@domain.com',
					'std'=>'',
				),

				'introtext'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INTROTEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INTROTEXT_DESC'),
					'depends'=>array(
						array('person_style_preset', '!=', 'layout3'),
					),
					'std'=>'',
				),
				'introtext_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INTROTEXT_COLOR'),
					'std'=>'',
					'depends'=>array(array('introtext', '!=', '')),
				),
				'introtext_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INTROTEXT_FONT_SIZE'),
					'depends'=>array(array('introtext', '!=', '')),
					'max'=> 200,
					'responsive'=>true,
					'std'=> ''
				),
				'introtext_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INTROTEXT_LINEHEIGHT'),
					'depends'=>array(array('introtext', '!=', '')),
					'max'=> 200,
					'responsive'=>true,
					'std'=> ''
				),
				'introtext_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INTROTEXT_FONT_FAMILY'),
					'depends'=>array(array('introtext', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-person-introtext { font-family: "{{ VALUE }}"; }'
					)
				),
				'social_separator' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_OPTION'),
				),
				'facebook'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_FACEBOOK'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_FACEBOOK_DESC'),
					'placeholder'=>'http://www.facebook.com/joomshaper',
					'std'=>'http://www.facebook.com/joomshaper',
				),

				'twitter'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_TWITTER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_TWITTER_DESC'),
					'placeholder'=>'http://twitter.com/joomshaper',
					'std'=>'http://twitter.com/joomshaper',
				),

				'youtube'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_YOUTUBE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_YOUTUBE_DESC'),
				),

				'linkedin'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_LINKEDIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_LINKEDIN_DESC'),
				),

				'pinterest'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_PINTEREST'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_PINTEREST_DESC'),
				),

				'flickr'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_FLICKR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_FLICKR_DESC'),
				),

				'dribbble'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DRIBBBLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DRIBBBLE_DESC'),
				),

				'behance'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_BEHANCE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_BEHANCE_DESC'),
				),

				'instagram'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INSTAGRAM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_INSTAGRAM_DESC'),
				),
				'social_icon_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_ICON_COLOR'),
					'std'=>'',
				),
				'social_icon_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_ICON_HOVER_COLOR'),
					'std'=>'',
				),
				'social_icon_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_ICON_FONT_SIZE'),
					'max'=> 200,
					'std'=> ''
				),
				'social_icon_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_ICON_MARGIN'),
					'responsive'=>true,
					'std'=> ''
				),
				'social_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_ICONS_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_SOCIAL_ICONS_POSITION'),
					'depends'=>array(
						array('person_style_preset', '!=', 'layout3'),
					),
					'values'=>array(
						'before'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_BEFORE_INTROTEXT'),
						'after'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_AFTER_INTROTEXT'),
					),
					'std'=>'after',
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
