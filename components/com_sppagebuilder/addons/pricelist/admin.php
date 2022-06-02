<?php
/**
* @package SP Page Builder
* @author JoomShaper https://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'pricelist',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				// Title
				'title'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std'=>  'Grilled Peach & Summer Berries'
				),

				'font_family'=>array(
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
					'max'=>400,
					'responsive'=>true
				),

				'title_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
					'placeholder'=>'10',
					'depends'=>array(array('title', '!=', '')),
					'max'=>400,
					'responsive'=>true
				),

				//Price Options
				'separator_price'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_STYLE'),
				),

				//Price
				'price_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_POSITION_DESC'),
					'values'=>array(
						'with-title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_WITH_TITLE'),
						'right-to-title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_RIGHT_TITLE'),
						'content-bottom'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_CONTENT_BOTTOM'),
					),
					'std'=>'right-to-title',
				),

				'price'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_DESC'),
					'placeholder'=>'$20.00',
					'std'=>  '$20.00',
					'depends'=>array(array('price_position', '!=', '')),
				),

				'zero_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_ZERO_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_ZERO_POSITION_DESC'),
					'values'=>array(
						'top'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_POSITION_TOP'),
						'baseline'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
					),
					'std'=>  '',
					'depends'=>array(
						array('price_position', '!=', ''),
					),
				),

				'price_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_COLOR'),
					'placeholder'=>'#000000',
					'std'=>  '',
					'depends'=>array(array('price_position', '!=', '')),
				),

				'price_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_FONT_SIZE'),
					'placeholder'=>'16',
					'max'=>200,
					'responsive'=>true,
					'std'=>  '',
					'depends'=>array(array('price_position', '!=', '')),
				),

				'price_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_PRICE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.pricelist-price-content { font-family: "{{ VALUE }}"; }'
					)
				),

				'price_fontweight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_FONT_WEIGHT'),
					'values'=>array(
						'100'=>100,
						'200'=>200,
						'300'=>300,
						'400'=>400,
						'500'=>500,
						'600'=>600,
						'700'=>700,
						'900'=>900,
					),
					'std'=>  700,
				),

				'price_top_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_TOP_GAP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_TOP_GAP_DESC'),
					'placeholder'=>'10',
					'std'=>  '',
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('price_position', '!=', 'right-to-title'),
					),
				),

				'price_bottom_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_BOTTOM_GAP'),
					'placeholder'=>'10',
					'std'=>  '',
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('price_position', '!=', 'right-to-title'),
					),
				),

				'discount_price'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_DISCOUNT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_DISCOUNT_DESC'),
					'placeholder'=>'$15.00',
					'std'=>  '',
					'depends'=>array(array('price_position', '!=', '')),
				),

				'discount_price_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_DIS_PRICE_COLOR'),
					'placeholder'=>'#000000',
					'std'=>  '',
					'depends'=>array(array('price_position', '!=', '')),
				),

				'discount_price_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_DIS_PRICE_POSITION'),
					'values'=>array(
						'top'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_POSITION_TOP'),
						'baseline'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
					),
					'std'=>  '',
					'depends'=>array(array('price_position', '!=', '')),
				),

				'add_line'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_DESC'),
					'std'=>1,
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('price_position', '!=', 'content-bottom'),
					),
				),

				'line_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_STYLE_DESC'),
					'values'=>array(
						'solid'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_LINE_SOLID'),
						'dotted'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_LINE_DOTTED'),
						'dashed'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_LINE_DASHED'),
						'double'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_LINE_DOUBLE'),
					),
					'std'=>'dotted',
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('add_line', '!=', 0)
					),
				),

				'line_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_SIZE_DESC'),
					'std'=>'',
					'max'=>20,
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('line_style', '!=', ''),
						array('add_line', '!=', 0)
					),
				),

				'line_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('line_style', '!=', ''),
						array('add_line', '!=', 0)
					),
				),

				'line_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_POSITION_DESC'),
					'values'=>array(
						'center'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_POSITION_CENTER'),
						'flex-end'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_POSITION_BOTTOM'),
						'title-bottom'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_POSITION_TITLE_BOTTOM'),
					),
					'std'=>'center',
					'depends'=>array(
						array('price_position', '!=', 'with-title'),
						array('price_position', '!=', 'content-bottom'),
						array('line_style', '!=', ''),
						array('add_line', '!=', 0)
					),
				),

				'line_top_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_TOP_GAP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_TOP_GAP_DESC'),
					'std'=>0,
					'max'=>100,
					'depends'=>array(
						array('line_style', '!=', ''),
						array('line_position', '!=', 'center'),
						array('line_position', '!=', 'flex-end'),
						array('price_position', '!=', 'with-title'),
						array('price_position', '!=', 'content-bottom'),
						array('add_line', '!=', 0)
					),
				),

				'line_bottom_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_BOTTOM_GAP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_LINE_BOTTOM_GAP_DESC'),
					'std'=>0,
					'max'=>100,
					'depends'=>array(
						array('line_style', '!=', ''),
						array('line_position', '!=', 'center'),
						array('line_position', '!=', 'flex-end'),
						array('price_position', '!=', 'with-title'),
						array('price_position', '!=', 'content-bottom'),
						array('add_line', '!=', 0)
					),
				),

				// Image
				'separator_image_number'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_PRICE_NUM_OPTIONS'),
				),

				'add_number_or_image'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_NUMBER_IMAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_NUMBER_IMAGE_DESC'),
					'std'=>1,
				),

				'number_or_image_left'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_IMAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_ADD_IMAGE_DESC'),
					'values'=>array(
						'image'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_LEFT_IMAGE'),
						'number'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_LEFT_NUMBER'),
					),
					'std'=>'image',
					'depends'=>array(array('add_number_or_image', '!=', 0)),
				),

				'number_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_DESC'),
					'std'=>'1',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_BG_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONTSIZE'),
					'std'=>'',
					'max'=>200,
					'responsive'=>true,
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.pricelist-left-number { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_fontweight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONTWEIGHT'),
					'values'=>array(
						'100'=>100,
						'300'=>300,
						'400'=>400,
						'500'=>500,
						'600'=>600,
						'700'=>700,
						'900'=>900,
					),
					'std'=>'',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_fontstyle'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONTSTYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONTSTYLE_DESC'),
					'values'=>array(
						'normal'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONTSTYLE_NORMAL'),
						'italic'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_FONTSTYLE_ITALIC'),
					),
					'std'=>'normal',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_top_padding'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_TOP_PADDING'),
					'max'=>200,
					'std'=>'',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'number_bottom_padding'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_NUMBER_BOTTOM_PADDING'),
					'max'=>200,
					'std'=>'',
					'depends'=>array(
						array('number_or_image_left', '!=', 'image'),
						array('add_number_or_image', '!=', 0)
					),
				),
				
				'image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_IMG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_IMG_DESC'),
					'show_input' => true,
					'depends'=>array(
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
					'std'=> array(
						'src' => 'http://demo.joomshaper.com/2015/cuisine/images/frying-pank.jpg',
					)
				),

				'image_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_WIDTH_DESC'),
					'responsive'=>true,
					'std'=>15,
					'max'=>100,
					'depends'=>array(
						array('number_or_image_left', '!=', ''),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_BORDER_RADIUS_DESC'),
					'std'=>'',
					'max'=>100,
					'depends'=>array(
						array('number_or_image_left', '!=', ''),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_gutter'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_GUTTER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_GUTTER_DESC'),
					'depends'=>array(
						array('number_or_image_left', '!=', ''),
						array('add_number_or_image', '!=', 0)
					),
					'max'=>100,
					'responsive'=>true,
					'std'=>15,
				),

				'image_tag'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_DESC'),
					'std'=>0,
					'depends'=>array(
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_tag_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_TEXT_DESC'),
					'placeholder'=>'HOT',
					'std'=>'HOT',
					'depends'=>array(
						array('image_tag', '!=', 0),
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_tag_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_BG'),
					'std'=>'#000000',
					'depends'=>array(
						array('image_tag', '!=', 0),
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_tag_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_RADIUS_DESC'),
					'std'=>'',
					'max'=>100,
					'depends'=>array(
						array('image_tag', '!=', 0),
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_tag_top_margin'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_TOP_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_TOP_MARGIN_DESC'),
					'std'=>0,
					'max'=>500,
					'depends'=>array(
						array('image_tag', '!=', 0),
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
				),

				'image_tag_left_margin'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_LEFT_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_PRICELIST_IMAGE_TAG_LEFT_MARGIN_DESC'),
					'std'=>0,
					'max'=>500,
					'depends'=>array(
						array('image_tag', '!=', 0),
						array('number_or_image_left', '!=', 'number'),
						array('add_number_or_image', '!=', 0)
					),
				),

				// Content
				'separator_content'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_OPTIONS'),
				),
				'text'=>array(
					'type'=>'editor',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
					'std'=>'Mixed greens, fresh pulled mozzarella, garden basil, Hawaiian sea salt,extra virgin olive oil'
				),

				'text_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-content { font-family: "{{ VALUE }}"; }'
					)
				),

				'text_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_SIZE'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true
				),
				
				'text_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_LINE_HEIGHT'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true
				),

				'text_fontweight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PRICELIST_TEXT_FONTWEIGHT'),
					'values'=>array(
						'100'=>100,
						'300'=>300,
						'400'=>400,
						'500'=>500,
						'600'=>600,
						'700'=>700,
						'900'=>900,
					),
					'std'=>'',
				),

				'content_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values'=>array(
						'left'=>JText::_('COM_SPPAGEBUILDER_LEFT'),
						'center'=>JText::_('COM_SPPAGEBUILDER_CENTER'),
						'right'=>JText::_('COM_SPPAGEBUILDER_RIGHT'),
					),
					'std'=>'',
					'responsive'=>true,
					'depends'=> array('price_position'=>'content-bottom'),
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
