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
		'addon_name'=>'sp_animated_number',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'number'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_DESC'),
					'placeholder'=>'1000',
					'std'=>'1000',
				),

				'number_before_after_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_BEF_AFT_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_BEF_AFT_TEXT_DESC'),
					'placeholder'=>'+,K,$',
					'std'=>'',
				),

				'number_before_after_text_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_BEF_AFT_TEXT_POS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_BEF_AFT_TEXT_POS_DESC'),
					'values'=>array(
						'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BEFORE'),
						'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_AFTER'),
					),
					'std'=>'left',
					'depends'=>array(
						array('number_before_after_text', '!=', ''),
					),
				),

				'duration'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_DURATION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_DURATION_DESC'),
					'placeholder'=>'1000',
					'std'=>'1000',
				),

				'color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_COLOR_DESC'),
				),

				'font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_FONT_SIZE_DESC'),
					'placeholder'=>36,
					'std'=>array(
						'md'=>36
					),
					'responsive'=>true,
					'max'=>400
				),

				'number_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_NUMBER_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-animated-number { font-family: "{{ VALUE }}"; }'
					)
				),

				'line_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_LINE_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_LINE_HEIGHT_DESC'),
					'placeholder'=>36,
					'std'=>array(
						'md'=>36
					),
					'responsive'=>true,
					'max'=>400
				),

				'number_font_wight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_FONT_WEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_FONT_WEIGHT_DESC'),
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

				'number_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_POSITION_DESC'),
					'values'=>array(
						'top'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
						'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
						'bottom'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
						'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
					),
				),

				'counter_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_OPTIONS'),
				),

				'counter_title'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_TITLE_DESC'),
					'std'=>'Animated Number',
				),

				'title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_TITLE_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_TITLE_COLOR_DESC'),
				),

				'title_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_TITLE_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_NUMBER_TITLE_FONT_SIZE_DESC'),
					'placeholder'=>18,
					'std'=>array(
						'md'=>18
					),
					'responsive'=>true,
					'max'=>400
				),

				'title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-animated-number-title{ font-family: "{{ VALUE }}"; }'
					)
				),

				'title_line_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_TITLE_LINE_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_TITLE_LINE_HEIGHT_DESC'),
					'placeholder'=>36,
					'std'=>array(
						'md'=>36
					),
					'responsive'=>true,
					'max'=>400
				),

				'title_fontstyle'=>array(
					'type'=>'fontstyle',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_FONT_STYLE'),
				),

				'title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'responsive'=>true,
					'std'=>array('md'=>'','sm'=>'','xs'=>''),
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
