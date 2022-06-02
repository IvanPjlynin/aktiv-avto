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
		'addon_name'=>'sp_blocknumber',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_DESC'),
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
					'std'=>  '',
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
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),

				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
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
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),

				'title_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
					'placeholder'=>'10',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),

				'separator_options'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ADDON_OPTIONS')
				),
				'content_type'=>array(
					'type'=>'buttons',
					'std'=>'content',
					'values'=>array(
						array(
							'label' => 'Content',
							'value' => 'content'
						),
						array(
							'label' => 'Content Style',
							'value' => 'content_style'
						)
					)
				),

				'number'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_NUMBER_DESC'),
					'std'=>'01',
					'depends'=>array(
						array('content_type', '=', 'content'),
					),
				),

				'size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_SIZE_DESC'),
					'std'=>array('md'=>48, 'sm'=>48, 'xs'=>48),
					'max'=>'400',
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content'),
					),
				),

				'heading'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_HEADING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_HEADING_DESC'),
					'std'=> 'Block Number',
					'depends'=>array(
						array('content_type', '=', 'content'),
					),
				),

				'text'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_TEXT_DESC'),
					'std'=>'Lorem ipsum dolor sit amet consectetuer rutrum dignissim et neque id.',
					'depends'=>array(
						array('content_type', '=', 'content'),
					),
				),

				'alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values'=>array(
						'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=>'left',
					'depends'=>array(
						array('content_type', '=', 'content'),
					),
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>'',
					'depends'=>array(
						array('content_type', '=', 'content'),
					),
				),
				//Block style
				'block_styles_seprator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
					),
				),
				'block_styles'=>array(
					'type'=>'buttons',
					'std'=>'number_style',
					'values'=>array(
						array(
							'label' => 'Number Style',
							'value' => 'number_style'
						),
						array(
							'label' => 'Heading Style',
							'value' => 'heading_style'
						),
						array(
							'label' => 'Text Style',
							'value' => 'text_style'
						),
					),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
					),
				),
				//Number style
				'background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_BACKGROUND_DESC'),
					'std'=>'#03E16D',
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_COLOR_DESC'),
					'std'=>'#FFFFFF',
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'number_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'number_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'depends'=>array(array('title', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-blocknumber-number { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),
				'number_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'number_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'number_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'number_border_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
					'values'=>array(
						'solid'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
						'dashed'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
						'dotted'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
						'double'=>JText::_('Double'),
						'groove'=>JText::_('Groove'),
						'ridge'=>JText::_('Ridge'),
						'inset'=>JText::_('Inset'),
						'outset'=>JText::_('Outset'),
					),
					'std'=>'solid',
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				'border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_BLOCKNUMBER_BORDER_RADIUS_DESC'),
					'std'=>100,
					'placeholder'=>'5',
					'max'=>'200',
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),
				'number_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'number_style'),
					),
				),

				// Title style
				'heading_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),

				'heading_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE_DESC'),
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),

				'heading_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT_DESC'),
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),

				'heading_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-media-heading { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),

				'heading_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
					'desc'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_DESC'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),

				'heading_letterspace'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING_DESC'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),

				'heading_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'heading_style'),
					),
				),
				// text style
				'text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_DESC'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'text_style'),
					),
				),

				'text_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE_DESC'),
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'text_style'),
					),
				),

				'text_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT_DESC'),
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'text_style'),
					),
				),

				'text_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-blocknumber-text { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'text_style'),
					),
				),

				'text_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
					'desc'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE_DESC'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'text_style'),
					),
				),

				'text_letterspace'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING_DESC'),
					'depends'=>array(
						array('content_type', '=', 'content_style'),
						array('block_styles', '=', 'text_style'),
					),
				),

			),
		),
	)
);
