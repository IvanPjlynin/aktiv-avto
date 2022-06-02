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
		'addon_name'=>'animated_heading',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_HEADING'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_HEADING_DESC'),
		'category'=>'General',
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=>'',
				),

				'heading_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_STYLE'),
					'values'=>array(
						'highlighted'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_STYLE_HIGH'),
						'text-animation'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_STYLE_ANI_TEXT'),
					),
					'std'=>'text-animation',
				),

				'heading_before_part'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_BEFORE_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_BEFORE_TEXT_DESC'),
					'std'=>'This heading is'
				),
				
				'highlighted_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_TEXT_DESC'),
					'std'=>  'awesome',
					'depends'=>array(
						array('heading_style', '=', 'highlighted'),
					)
				),

				'highlighted_shape'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_SHAPE_DESC'),
					'values'=>array(
						'bg-fill'=>'Background Fill',
						'circle'=>'Circle',
						'cross'=>'Cross(X)',
						'diagonal'=>'Diagonal',
						'strikethrough'=>'Strikethrough',
						'square'=>'Rectangle',
						'top-botm-line'=>'Top Bottom Line',
						'underline'=>'Underline',
						'dubl-underline'=>'Dubble Underline',
						'zigzag-underline'=>'Scribble Underline',
						'sharpe-zigzag'=>'Sharpe Zigzag Underline',
						'wave'=>'Wave',
					),
					'std'=>'circle',
					'depends'=>array(
						array('heading_style', '=', 'highlighted'),
						array('highlighted_text', '!=', ''),
					)
				),

				'shape_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_ANIMATED_SHAPE_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('heading_style', '=', 'highlighted'),
						array('highlighted_shape', '!=', ''),
					)
				),

				'shape_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_ANIMATED_SHAP_WIDTH'),
					'std'=>'',
					'max'=>200,
					'depends'=>array(
						array('heading_style', '=', 'highlighted'),
						array('highlighted_shape', '!=', ''),
					)
				),

				'shape_radius'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_ANIMATED_SHAP_RADIUS'),
					'depends'=>array(
						array('heading_style', '=', 'highlighted'),
						array('highlighted_shape', '!=', ''),
					),
					'std'=>0
				),

				'animated_text'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_ANIMATED_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_ANIMATED_TEXT_DESC'),
					'std'=>'awesome
nice
cool',
					'depends'=>array(
						array('heading_style', '=', 'text-animation'),
					)
				),

				'text_animation_name'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_TEXT_ANI'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_TEXT_ANI_DESC'),
					'values'=>array(
						'blinds'=>'Blinds',
						'clip'=>'Clip',
						'delete-typing'=>'Typing',
						'flip'=>'Flip',
						'fade-in'=>'Fade In',
						'loading-bar'=>'Loading Bar',
						'scale'=>'Scale',
						'slide'=>'Swirl',
						'push'=>'Push',
						'wave'=>'Twist',
					),
					'std'=>'clip',
					'depends'=>array(
						array('heading_style', '=', 'text-animation'),
						array('animated_text', '!=', ''),
					)
				),

				'heading_after_part'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_AFTER_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_AFTER_TEXT_DESC'),
					'std'=>'from the beginning.'
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

				//Styling options
				'style_options' => array(
					'type' => 'buttons',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ANIMATED_STYLE_OPTIONS'),
					'std' => 'heading',
					'values' => array(
						array(
							'label' => 'Heading Style',
							'value' => 'heading'
						),
						array(
							'label' => 'Animated Text Style',
							'value' => 'animated'
						),
					),
					'tabs' => true,
				),

				//Heading style
				'heading_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_HEADING_STYLE_OPTIONS'),
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-title { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_letterspace'=>array(
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
					'std'=>'',
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'std' => '',
					'responsive'=>true,
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				'heading_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'std' => '',
					'responsive'=>true,
					'depends'=>array(
						array('style_options', '=', 'heading'),
					),
				),

				//Animated_text style Option
				'high_text_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ANI_TEXT_HIGHLIGHTED_STYLE_OPTIONS'),
					'depends'=>array(
						array('style_options', '=', 'animated'),
					),
				),

				'animated_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('style_options', '=', 'animated'),
					),
				),

				'animated_text_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true,
					'depends'=>array(
						array('style_options', '=', 'animated'),
					),
				),

				'animated_text_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'depends'=>array(
						array('heading_style', '=', 'text-animation'),
						array('style_options', '=', 'animated'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.animated-text-words-wrapper { font-family: "{{ VALUE }}"; }'
					)
				),

				'highlighted_text_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'depends'=>array(
						array('heading_style', '=', 'highlighted'),
						array('style_options', '=', 'animated'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.animated-heading-highlighted-wrap { font-family: "{{ VALUE }}"; }'
					)
				),

				'animated_text_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('style_options', '=', 'animated'),
					),
				),

				'animated_text_letterspace'=>array(
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
					'std'=>'',
					'depends'=>array(
						array('style_options', '=', 'animated'),
					),
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
					'std'=> ''
				),

			),
		),
	)
);
