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
		'addon_name'=>'sp_pricing',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_DESC'),
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
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_TITLE_DESC'),
					'std'=>'Professional',
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
						'div'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DIV'),
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
					'std'=>array('md'=>18),
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>array('md'=>24),
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

				'title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
					'depends'=>array(array('title', '!=', '')),
					'std'=>'#464855'
				),

				'title_margin_top'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
					'placeholder'=>'10',
					'max'=>500,
					'std'=>array('md'=>0),
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'title_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
					'placeholder'=>'10',
					'max'=>500,
					'std'=>array('md'=>20),
					'responsive'=>true,
					'depends'=>array(array('title', '!=', '')),
				),

				'separator1'=>array(
					'type'=>'separator'
				),

				'price'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_DESC'),
					'std'=>'$19.99',
				),

				'price_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_COLOR'),
					'std'=>'#4060FF',
					'depends'=>array(array('price', '!=', '')),
				),

				'price_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_FONT_SIZE'),
					'std'=>array('md'=>36),
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('price', '!=', '')),
				),

				'price_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_FONT_FAMILY'),
					'depends'=>array(array('price', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-pricing-price-container { font-family: "{{ VALUE }}"; }'
					)
				),

				'price_font_weight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_FONT_WEIGHT'),
					'depends'=>array(array('price', '!=', '')),
					'values'=> array(
						100=>100,
						200=>200,
						300=>300,
						400=>400,
						500=>500,
						600=>600,
						700=>700,
						800=>800,
						900=>900,
					)
				),

				'price_symbol'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_SYMBOL'),
					'std'=>'',
					'placeholder'=>'$',
					'depends'=>array(array('price', '!=', '')),
				),

				'price_symbol_alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_SYMBOL_ALIGNMENT'),
					'values'=>array(
						'middle'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_MIDDLE'),
						'super'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
						'sub'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
					),
					'std'=>'',
					'placeholder'=>'$',
					'depends'=>array(array('price_symbol', '!=', '')),
				),

				'price_symbol_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_SYMBOL_COLOR'),
					'std'=>'',
					'depends'=>array(array('price_symbol', '!=', '')),
				),

				'price_symbol_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_SYMBOL_FONT_SIZE'),
					'std'=>'',
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('price_symbol', '!=', '')),
				),

				'duration'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_DURATION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_DURATION_DESC'),
					'std'=>'',
				),

				'duration_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_DURATION_COLOR'),
					'std'=>'',
					'depends'=>array(array('duration', '!=', '')),
				),

				'duration_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_DURATION_FONT_SIZE'),
					'std'=>'',
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('duration', '!=', '')),
				),

				'price_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_POSITION_DESC'),
					'values'=>array(
						'after'=> JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_POSITION_AFTER_TITLE'),
						'before'=> JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_POSITION_BEFORE_BUTTON'),
					),
					'std'=>'after',
				),

				'price_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_MARGIN_BOTTOM'),
					'std'=>array('md'=>30),
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('price', '!=', '')),
				),

				'price_padding_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_PADDING_BOTTOM'),
					'max'=>200,
					'responsive'=>true,
					'std'=>array('md'=>''),
					'depends'=>array(array('price', '!=', '')),
				),

				'price_border_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_BORDER_BOTTOM'),
					'max'=>15,
					'depends'=>array(array('price', '!=', '')),
				),

				'price_border_bottom_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_PRICE_BORDER_BOTTOM_COLOR'),
					'depends'=>array(array('price', '!=', '')),
				),

				'separator2'=>array(
					'type'=>'separator'
				),

				'pricing_content'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_FEATURES'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_FEATURES_DESC'),
					'std'=>'10 GB Storage
100 GB Bandwidth
Speed 500 Mbps
DNS Automation
Support Time 24 hrs',
				),

				'pricing_content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_FEATURES_FONT_FAMILY'),
					'depends'=>array(array('pricing_content', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-pricing-features { font-family: "{{ VALUE }}"; }'
					)
				),

				'pricing_content_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_FEATURES_FONT_SIZE'),
					'std'=>array('md'=>16),
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('pricing_content', '!=', '')),
				),

				'pricing_content_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_FEATURES_GAP'),
					'std'=>array('md'=>20),
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('pricing_content', '!=', '')),
				),

				'pricing_content_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_CONTNET_MARGIN_BOTTOM'),
					'std'=>array('md'=>40),
					'max'=>500,
					'responsive'=>true,
					'depends'=>array(array('pricing_content', '!=', '')),
				),

				'separator3'=>array(
					'type'=>'separator'
				),

				//Button
				'button_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
					'std'=>'Proceed',
				),

				'button_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_FAMILY'),
					'depends'=>array(array('button_text', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-btn { font-family: "{{ VALUE }}"; }'
					)
				),

				'button_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
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
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_url'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
					'placeholder'=>'http://',
					'hide_preview'=>true,
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_target'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
					'values'=>array(
						''=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						'_blank'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_type'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
					'values'=>array(
						'default'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
						'primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
						'secondary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SECONDARY'),
						'success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
						'info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
						'warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
						'danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
						'link'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
						'custom'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
					),
					'std'=>'custom',
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_appearance'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_DESC'),
					'values'=>array(
						''=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_FLAT'),
						'gradient'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_GRADIENT'),
						'outline'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_OUTLINE'),
						'3d'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_3D'),
					),
					'std'=>'outline',
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_status'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
					'std'=>'normal',
					'values'=>array(
						array(
							'label' => 'Normal',
							'value' => 'normal'
						),
						array(
							'label' => 'Hover',
							'value' => 'hover'
						),
					),
					'tabs' => true,
					'depends'=>array(
						array('button_text', '!=', ''),
						array('button_type', '=', 'custom'),
					)
				),
	
				'button_background_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
					'std' => '#4060FF',
					'depends'=>array(
						array('button_appearance', '!=', 'gradient'),
						array('button_text', '!=', ''),
						array('button_type', '=', 'custom'),
						array('button_status', '=', 'normal'),
					),
				),
	
				'button_background_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std'=> array(
						"color" => "#B4EC51",
						"color2" => "#429321",
						"deg" => "45",
						"type" => "linear"
					),
					'depends'=>array(
						array('button_text', '!=', ''),
						array('button_appearance', '=', 'gradient'),
						array('button_type', '=', 'custom'),
						array('button_status', '=', 'normal'),
					)
				),
	
				'button_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
					'std' => '#4060FF',
					'depends'=>array(
						array('button_text', '!=', ''),
						array('button_type', '=', 'custom'),
						array('button_status', '=', 'normal'),
					),
				),
	
				'button_background_color_hover'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
					'std' => '#4060FF',
					'depends'=>array(
						array('button_appearance', '!=', 'gradient'),
						array('button_text', '!=', ''),
						array('button_type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					),
				),
	
				'button_background_gradient_hover'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std'=> array(
						"color" => "#429321",
						"color2" => "#B4EC51",
						"deg" => "45",
						"type" => "linear"
					),
					'depends'=>array(
						array('button_text', '!=', ''),
						array('button_appearance', '=', 'gradient'),
						array('button_type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					)
				),
	
				'button_color_hover'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
					'std' => '#fff',
					'depends'=>array(
						array('button_text', '!=', ''),
						array('button_type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					),
				),

				'button_size'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DESC'),
					'values'=>array(
						''=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DEFAULT'),
						'lg'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_LARGE'),
						'xlg'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_XLARGE'),
						'sm'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_SMALL'),
						'xs'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_EXTRA_SAMLL'),
					),
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),
				'button_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_PADDING_DESC'),
					'responsive'=>true,
					'depends'=> array(
						array('button_text', '!=', ''),
						array('button_type', '=', 'custom'),
					)
				),

				'button_shape'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
					'values'=>array(
						'rounded'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
						'square'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
						'round'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
					),
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_block'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK_DESC'),
					'values'=>array(
						''=>JText::_('JNO'),
						'sppb-btn-block'=>JText::_('JYES'),
					),
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_icon'=>array(
					'type'=>'icon',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
					'depends'=> array(
						array('button_text', '!=', ''),
					)
				),

				'button_icon_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
					'values'=>array(
						'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'depends'=> array(
						array('button_text', '!=', ''),
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
					'std'=>'sppb-text-center',
				),

				'pricing_hover_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_HOVER_OPTION'),
				),

				'pricing_hover_scale'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_SCALE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICING_SCALE_DESC'),
					'min'=>1,
					'max'=>3,
					'step'=>.01,
					'std'=>1,
				),

				'pricing_hover_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER_DESC'),
				),

				'pricing_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER_DESC'),
				),

				'pricing_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
				),

				'pricing_hover_boxshadow'=>array(
					'type'=>'boxshadow',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOX_SHADOW_HOVER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOX_SHADOW_HOVER_DESC'),
					'std'=>'0 0 0 0 #ffffff'
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
