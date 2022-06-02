<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die('Restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'repeatable',
		'addon_name'=>'sp_carouselpro',
		'category'=>'Slider',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED_DESC'),
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				
				'carousel_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_PRO_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_PRO_HEIGHT_DESC'),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'400'),
				),

				'autoplay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_AUTOPLAY_DESC'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),

				'interval'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_INTERVAL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_INTERVAL_DESC'),
					'std'=> 5,
					'depends'=> array(
						array('autoplay', '=', 1),
					)
				),

				'speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SPEED_DESC'),
					'std'=> 600,
				),

				'controllers'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS_DESC'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),
				//Arrow Controller
				'arrows'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_ARROWS_DESC'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),
				'arrow_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_PRO_ARROWS_POSITION'),
					'values'=>array(
						'default'=>'Default',
						'bottom-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_BOTTOM_LEFT'),
						'bottom-center'=> JText::_('COM_SPPAGEBUILDER_ADDON_BOTTOM_CENTER'),
						'bottom-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_BOTTOM_RIGHT'),
					),
					'std'=>'default',
					'depends'=> array(
						array('arrows', '=', 1),
					)
				),
				'arrow_icon'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ARROWS_ICON'),
					'values'=>array(
						'angle'=>'Angle',
						'angle_dubble'=>'Angle Dubble',
						'arrow'=>'Arrow',
						'arrow_circle'=>'Arrow Circle',
						'long_arrow'=>'Long Arrow',
						'chevron'=>'Chevron',
					),
					'std'=>'chevron',
					'depends'=> array(
						array('arrows', '=', 1),
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
						array('arrows', '=', 1),
					),
				),
				'arrow_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'std'=>'',
					'max'=>200,
					'min'=>10,
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'std'=>'',
					'max'=>200,
					'min'=>10,
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'max'=> 100,
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'max'=> 20,
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'max'=> 1000,
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				//Arrow hover
				'arrow_hover_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'hover_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),
				'arrow_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'hover_arrow'),
					)
				),
				'arrow_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('arrows', '=', 1),
						array('arrow_style', '=', 'hover_arrow'),
						array('arrow_position', '!=', 'default'),
					)
				),

				// Repeatable Items
				'sp_carouselpro_item'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEMS'),
					'attr'=>  array(
						//Title
						'title_separetor'=>array(
							'type'=>'separator',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_OPTIONS'),
						),

						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_DESC'),
							'std'=>'Carousel Item Title',
						),

						'title_color'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_COLOR'),
							'std'=>'#000',
						),

						'title_font_family'=>array(
							'type'=>'fonts',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_FONT_FAMILY'),
							'depends'=>array(array('title', '!=', '')),
							'selector'=> array(
								'type'=>'font',
								'font'=>'{{ VALUE }}',
								'css'=>' h2 { font-family: "{{ VALUE }}"; }'
							)
						),

						'title_fontsize'=>array(
							'type'=>'slider',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_FONTSIZE'),
							'max'=>100,
							'std'=>array('md'=>46, 'sm'=>36, 'xs'=>16),
							'responsive' => true
						),

						'title_lineheight'=>array(
							'type'=>'slider',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_LINEHEIGHT'),
							'max'=>100,
							'std'=>array('md'=>56, 'sm'=>46, 'xs'=>20),
							'responsive' => true
						),

						'title_fontstyle'=>array(
							'type'=>'fontstyle',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_FONT_STYLE'),
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
								'10px'=> '10px'
							),
							'std'=>'0'
						),

						'title_margin'=>array(
							'type'=>'margin',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_MARGIN'),
							'std'=>array('md'=>'0px 0px 0px 0px', 'sm'=>'0px 0px 0px 0px', 'xs'=>'0px 0px 0px 0px'),
							'responsive' => true
						),
						//Content 
						'content_separetor'=>array(
							'type'=>'separator',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_OPTIONS'),
						),
						
						'content'=>array(
							'type'=>'editor',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_DESC'),
							'std'=> 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.',
						),

						'content_font_family'=>array(
							'type'=>'fonts',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
							'depends'=>array(array('content', '!=', '')),
							'selector'=> array(
								'type'=>'font',
								'font'=>'{{ VALUE }}',
								'css'=>' .sppb-carousel-pro-text .sppb-carousel-content { font-family: "{{ VALUE }}"; }'
							)
						),

						'content_fontsize'=>array(
							'type'=>'slider',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_FONTSIZE'),
							'max'=>100,
							'std'=>array('md'=>16, 'sm'=>14, 'xs'=>12),
							'responsive' => true
						),

						'content_lineheight'=>array(
							'type'=>'slider',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_LINEHEIGHT'),
							'max'=>100,
							'std'=>array('md'=>24, 'sm'=>22, 'xs'=>16),
							'responsive' => true
						),

						'content_fontweight'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONTWEIGHT'),
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

						'content_margin'=>array(
							'type'=>'margin',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_MARGIN'),
							'std'=>array('md'=>'0px 0px 0px 0px', 'sm'=>'0px 0px 0px 0px', 'xs'=>'0px 0px 0px 0px'),
							'responsive' => true
						),
						//BG and Caption
						'caption_separetor'=>array(
							'type'=>'separator',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BG_CAPTION_OPTIONS'),
						),

						'bg'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED_ITEM_BACKGROUND_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED_ITEM_BACKGROUND_IMAGE_DESC'),
							'std'=> array(
								'src' => '',
							)
						),
						
						'image'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE_DESC'),
							'std'=> array(
								'src' => '',
							)
						),

						'video'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED_ITEM_VIDEO'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED_ITEM_VIDEO_DESC'),
						),

						//Button
						'btn_separetor'=>array(
							'type'=>'separator',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_OPTIONS'),
						),

						'button_text'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
							'std'=>'Button Text',
						),

						'button_type'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
							'values'=>array(
								'default'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
								'primary'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
								'success'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
								'info'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
								'warning'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
								'danger'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
								'link'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
								'custom'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
							),
							'std'=>'default',
							'depends'=> array(
								array('button_text', '!=', ''),
							)
						),

						'fontsize' => array(
							'type' => 'slider',
							'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
							'std' => array('md' => 16),
							'responsive' => true,
							'max' => 400,
							'depends' => array(
								array('button_type', '=', 'custom'),
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
							'format'=>'attachment',
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
							'std'=>'flat',
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
								array('button_type', '=', 'custom'),
								array('button_text', '!=', ''),
							)
						),

						'button_background_color'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
							'std' => '#444444',
							'depends'=> array(
								array('button_appearance', '!=', 'gradient'),
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'normal'),
								array('button_text', '!=', ''),
							)
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
								array('button_appearance', '=', 'gradient'),
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'normal'),
								array('button_text', '!=', ''),
							)
						),

						'button_color'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
							'std' => '#fff',
							'depends'=> array(
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'normal'),
								array('button_text', '!=', ''),
							)
						),
						
						'button_padding' => array(
							'type' => 'padding',
							'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
							'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
							'std' => '',
							'depends' => array(
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'normal'),
							),
							'responsive'=>true,
						),

						'button_background_color_hover'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
							'std' => '#222',
							'depends'=> array(
								array('button_appearance', '!=', 'gradient'),
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'hover'),
								array('button_text', '!=', ''),
							)
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
								array('button_appearance', '=', 'gradient'),
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'hover'),
								array('button_text', '!=', ''),
							)
						),

						'button_color_hover'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
							'std' => '#fff',
							'depends'=> array(
								array('button_type', '=', 'custom'),
								array('button_status', '=', 'hover'),
								array('button_text', '!=', ''),
							)
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
								array('button_type', '!=', 'custom'),
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

					),
				),
				//Container Column
				'full_container'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_NO_CONTAINER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_NO_CONTAINER_DESC'),
					'std'=>0,
				),

				'content_column'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTENT_COLUMN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_CONTENT_COLUMN_DESC'),
					'values'=>array(
						1=>1,
						2=>2,
						3=>3,
						4=>4,
						5=>5,
						6=>6,
						7=>7,
						8=>8,
						9=>9,
						10=>10,
						11=>11,
						12=>12,
					),
				),

				'item_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ADVANCED_ITEM_PADDING'),
					'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
					'responsive' => true
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
