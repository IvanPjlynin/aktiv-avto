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
		'addon_name'=>'sp_countdown',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_DESC'),
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
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>'',
					'max'=>500,
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

				'title_fontweight'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_WEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_WEIGHT_DESC'),
					'std'=>'',
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
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
					'placeholder'=>'10',
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'separator1'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_OPTIONS'),
				),

				'date'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_DATE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_DATE_DESC'),
					'placeholder'=>'2024/12/25',
					'std'=> '2024/12/25'
				),

				'time'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_TIME'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_TIME_DESC'),
					'placeholder'=>'20:23',
					'std'=> '20:23',
				),

				'finish_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_FINISHED_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_FINISHED_TEXT_DESC'),
					'placeholder'=>'Finally we are here',
					'std'=> 'Finally we are here',
				),

				'counter_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_HEIGHT'),
					'placeholder'=>'',
					'max'=>500,
					'responsive'=>true,
					'std'=> array('md'=>80)
				),

				'counter_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_WIDTH'),
					'placeholder'=>'',
					'max'=>500,
					'responsive'=>true,
					'std'=> array('md'=>80)
				),

				'counter_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_FONT_SIZE'),
					'std'=> array('md'=>36),
					'max'=>500,
					'responsive'=>true
				),

				'counter_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_TEXT_COLOR'),
					'std'=>'#FFFFFF',
				),

				'counter_text_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_TEXT_FONT_FAMILY'),
					'selector'=>array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-countdown-number { font-family: "{{ VALUE }}"; }',
					),
				),

				'counter_text_font_weight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_TEXT_FONT_WEIGHT'),
					'values'=>array(
						100=>100,
						200=>200,
						300=>300,
						400=>400,
						500=>500,
						600=>600,
						700=>700,
						800=>800,
						900=>900,
					),
				),

				'counter_background_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_BACKGROUND_COLOR'),
					'std'=>'#0089e6',
				),

				'counter_user_border'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_USE_BORDER'),
					'std'=>0
				),

				'counter_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'std'=>array('md'=>1),
					'depends'=>array('counter_user_border'=>1),
					'max'=>500,
					'responsive'=>true
				),

				'counter_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'#E5E5E5',
					'depends'=>array('counter_user_border'=>1)
				),

				'counter_border_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
					'values'=>array(
						'none'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_NONE'),
						'solid'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
						'double'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOUBLE'),
						'dotted'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
						'dashed'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
					),
					'std'=>'solid',
					'depends'=>array('counter_user_border'=>1)
				),

				'counter_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'std'=>array('md'=>4),
					'max'=>500,
					'responsive'=>true
				),

				'label_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_FONT_SIZE'),
					'std'=>array('md'=>14),
					'max'=>500,
					'responsive'=>true
				),

				'label_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_COLOR'),
					'std'=>'',
				),

				'label_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_FONTFAMILY'),
					'selector'=>array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-countdown-text { font-family: "{{ VALUE }}"; }',
					),
				),

				'label_font_style'=>array(
					'type'=>'fontstyle',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_FONTSTYLE'),
				),

				'label_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_COUTNDOWN_COUNTER_LABEL_MARGIN'),
					'responsive'=>true
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
