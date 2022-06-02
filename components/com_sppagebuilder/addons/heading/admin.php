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
		'addon_name'=>'heading',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADING'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADING_DESC'),
		'category'=>'General',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> '',
				),

				'title'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std'=>  'This is title'
				),

				'heading_selector'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
					'values'=>array(
						'h1'=> 'h1',
						'h2'=> 'h2',
						'h3'=> 'h3',
						'h4'=> 'h4',
						'h5'=> 'h5',
						'h6'=> 'h6',
						'p'=>	'p',
						'span'=> 'span',
						'div'=> 'div'
					),
					'std'=>'h2'
				),

				'use_link'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADING_USE_LINK'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADING_USE_LINK_DESC'),
					'std'=>0
				),

				'title_link'=>array(
					'type'=>'media',
					'format'=>'attachment',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_DESC'),
					'placeholder'=>'http://',
					'std'=>'',
					'hide_preview'=>true,
					'depends' => array('use_link' => 1)
				),

				'link_new_tab'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
					'values'=>array(
						0=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						1=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
					'std'=>'',
					'depends' => array('use_link' => 1)
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
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true
				),
				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true
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
						'10px'=> '10px',
						'custom'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM')
					),
					'std'=>'0'
				),
				'custom_letterspacing'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM_LETTER_SPACING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM_LETTER_SPACING_DESC'),
					'std'=>'',
					'depends'=>array(
						array('title_letterspace', '=', 'custom'),
					),
				),
				'title_text_transform'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_TRANSFORM'),
					'values'=>array(
						'none'=> 'None',
						'capitalize'=> 'Capitalize',
						'uppercase'=> 'Uppercase',
						'lowercase'=> 'Lowercase',
					),
					'std'=>'none'
				),

				'title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'std' => '0px 0px 30px 0px',
					'responsive'=>true
				),

				'title_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'std' => '0px 0px 0px 0px',
					'responsive'=>true
				),

				'title_icon'=>array(
					'type'=>'icon',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON'),
					'depends'=>array(array('title', '!=', '')),
				),

				'title_icon_position'=>array(
					'type'=>'select',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_POSITION'),
					'values'=>array(
						'before'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_POSITION_BEFORE'),
						'after'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_POSITION_AFTER'),
					),
					'std' => 'before',
					'depends'=>array(array('title_icon', '!=', '', 'title', '!=', '')),
				),

				'title_icon_color'=>array(
					'type'=>'color',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_COLOR'),
					'depends'=>array(array('title_icon', '!=', '', 'title', '!=', '')),
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
					'std'=>'sppb-text-center',
				),
				'title_text_shadow'=>array(
					'type'=>'boxshadow',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_SHADOW'),
					'std'=>'',
					'config' => array(
						'spread' => false
					)
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=> ''
				),

			),
		),
	)
);
