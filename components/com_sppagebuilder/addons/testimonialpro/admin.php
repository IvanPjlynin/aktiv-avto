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
		'type'=>'repeatable',
		'addon_name'=>'sp_testimonialpro',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_DESC'),
		'category'=>'Slider',
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
                'show_quote'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_SHOW_ICON'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),

				'icon_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_ICON_SIZE'),
					'std'=>array('md'=>48, 'sm'=>48, 'xs'=>48),
					'min'=>10,
					'max'=>200,
					'responsive'=>true,
					'depends'=>array(array('show_quote', '=', 1)),
				),

				'icon_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_ICON_COLOR'),
					'std'=>'#EDEEF2',
					'depends'=>array(array('show_quote', '=', 1)),
				),

				'autoplay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_AUTOPLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_AUTOPLAY_DESC'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),

				'interval'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_INTERVAL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_INTERVAL_DESC'),
					'std'=> 5,
					'depends'=> array(
						array('autoplay', '=', 1),
					)
				),

				'speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_SPEED_DESC'),
					'std'=> 600,
				),

				'controls'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_SHOW_CONTROLLERS_DESC'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),
				'bullet_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_BULLET_BORDER_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('controls', '!=', 0),
					)
				),
				'bullet_active_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_BULLET_BG_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('controls', '!=', 0),
					)
				),
				//Arrow Controllers
				'arrow_controls'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_SHOW_ARROWS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_SHOW_ARROWS_DESC'),
					'std'=>0,
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
					'std'=>'bottom-left',
					'depends'=> array(
						array('arrow_controls', '=', 1),
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
						array('arrow_controls', '=', 1),
					),
				),
				'arrow_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'std'=>'',
					'max'=>200,
					'min'=>10,
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'std'=>'',
					'max'=>200,
					'min'=>10,
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'max'=> 100,
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'max'=> 20,
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
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
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				'arrow_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'std'=>array('md'=>'5px 5px 0px 5px', 'sm'=>'5px 5px 0px 5px', 'xs'=>'5px 5px 0px 5px'),
					'responsive'=>true,
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'normal_arrow'),
					)
				),
				//Arrow hover
				'arrow_hover_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'hover_arrow'),
					)
				),
				'arrow_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'hover_arrow'),
					)
				),
				'arrow_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
					'std'=>'',
					'depends'=> array(
						array('arrow_controls', '=', 1),
						array('arrow_style', '=', 'hover_arrow'),
					)
				),

				// Repeatable Items
				'sp_testimonialpro_item'=>array(
					'title'=>JText::_('Testimonials'),

					'attr'=>array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ITEM_TITLE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ITEM_TITLE_DESC'),
							'std'=>'John Doe',
						),

						'avatar'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_IMAGE_DESC'),
							'std'=> array(
								'src' => '',
							)
						),

						'message'=>array(
							'type'=>'editor',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ITEM_TEXT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_ITEM_TEXT_DESC'),
							'std'=> 'Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.'
						),

						'url'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_URL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_URL_DESC'),
						),

						'designation'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_DESIGNATION'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CLIENT_DESIGNATION_DESC'),
						),

					),
				),
				//Avatar
				'avatar_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_AVATAR_OPTIONS'),
				),

				'avatar_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_AVATAR_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_AVATAR_WIDTH_DESC'),
					'std'=>32,
					'min'=>16,
					'max'=>128,
					'responsive'=>true,
				),

				'avatar_shape'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_AVATAR_SHAPE'),
					'values' =>array(
						'sppb-avatar-sqaure'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_SQUARE'),
						'sppb-avatar-round'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ROUNDED'),
						'sppb-avatar-circle'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CIRCLE'),
					),
					'std' => 'sppb-avatar-circle'
				),
                'avatar_on_top'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_AVATAR_ON_TOP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_AVATAR_ON_TOP_DESC'),
					'values'=>array(
						1=>JText::_('JYES'),
						0=>JText::_('JNO'),
					),
					'std'=>1,
				),
				//Name Designation
				'name_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_CLIENT_NAME_OPTIONS'),
				),
				'name_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_COLOR'),
				),
				'name_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_FONTSIZE'),
					'max'=>100,
					'responsive'=> true,
					'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
				),
				'name_line_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_LINEHEIGHT'),
					'max'=>100,
					'responsive'=> true,
					'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
				),
				'name_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_LATTERSPACING'),
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
				'name_font_style'=>array(
					'type'=>'fontstyle',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_NAME_FONTSTYLE'),
				),
				'name_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_NAME_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-testimonial-pro-client-name { font-family: "{{ VALUE }}"; }'
					)
				),
				//Designation
				'designation_block'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_BLOCK'),
					'std'=>0,
				),
				'designation_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_COLOR'),
				),
				'designation_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_FONTSIZE'),
					'max'=>100,
					'responsive'=>true,
					'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
				),
				'designation_line_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_LINEHEIGHT'),
					'max'=>100,
					'responsive'=>true,
					'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
				),
				'designation_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_LATTERSPACING'),
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
				'designation_font_style'=>array(
					'type'=>'fontstyle',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_FONTSTYLE'),
				),
				'designation_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_PERSON_DESIGNATION_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-testimonial-pro-client-designation { font-family: "{{ VALUE }}"; }'
					)
				),
				'designation_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_DESIGNATION_MARGIN'),
					'responsive'=>true,
					'std'=>''
				),
				//Content
				'content_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_OPTIONS'),
				),
				'content_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CONTENT_COLOR'),
				),
				'content_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CONTENT_FONTSIZE'),
					'max'=> 200,
					'responsive'=> true,
					'std'=> array('md'=>16, 'sm'=>16, 'xs'=>16),
				),
				'content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-testimonial-message { font-family: "{{ VALUE }}"; }'
					)
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
				'content_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TESTIMONIAL_PRO_CONTENT_LINEHEIGHT'),
					'max'=> 200,
					'responsive'=> true,
					'std'=>array('md'=>'', 'sm'=>'', 'xs'=>''),
				),
				'content_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_MARGIN'),
					'responsive'=> true,
					'std'=> array('md'=>'0px 0px 10px 0px', 'sm'=>'0px 0px 10px 0px', 'xs'=>'0px 0px 10px 0px'),
				),
				'content_alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=> 'center'
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