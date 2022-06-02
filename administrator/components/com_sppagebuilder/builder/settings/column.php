<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die('Restricted access');

$column_settings = array(
	'attr' => array(
		'general' => array(

			'items_align_center' => array(
				'type'  => 'checkbox',
				'title' => JText::_('COM_SPPAGEBUILDER_ROW_COLUMNS_ALIGN_CENTER'),
				'desc'  => JText::_('COM_SPPAGEBUILDER_ROW_COLUMNS_ALIGN_CENTER_DESC'),
				'std'   => 0,
			),
			'items_content_alignment' => array(
				'type'   => 'select',
				'title'  => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
				'desc'   => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
				'values' => array(
					'top'    => JText::_('COM_SPPAGEBUILDER_ADDON_OPTIN_POSITION_TOP'),
					'center' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
					'bottom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
				),
				'std'     => 'center',
				'depends' => array(
					array('items_align_center', '!=', 0),
				),
			),

			'class' => array(
				'type' 		 => 'text',
				'title' 	 => JText::_('COM_SPPAGEBUILDER_CSS_CLASS'),
				'desc' 		 => JText::_('COM_SPPAGEBUILDER_CSS_CLASS_DESC'),
				),
			),
			'style' => array(
				'height_separator' => array(
					'type'  => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_COLUMN_HEIGHT_SETTIINGS'),
				),
				'column_height' => array(
					'type'       => 'slider',
					'title'      => JText::_('COM_SPPAGEBUILDER_COLUMN_HEIGHT_OPTION'),
					'desc'       => JText::_('COM_SPPAGEBUILDER_COLUMN_HEIGHT_OPTION_DESC'),
					'max'        => 3000,
					'responsive' => true,
				),
				'column_min_height' => array(
					'type'       => 'slider',
					'title'      => JText::_('COM_SPPAGEBUILDER_COLUMN_MIN_HEIGHT_OPTION'),
					'desc'       => JText::_('COM_SPPAGEBUILDER_COLUMN_MIN_HEIGHT_OPTION_DESC'),
					'max'        => 3000,
					'responsive' => true,
				),
				'column_max_height' => array(
					'type'       => 'slider',
					'title'      => JText::_('COM_SPPAGEBUILDER_COLUMN_MAX_HEIGHT_OPTION'),
					'desc'       => JText::_('COM_SPPAGEBUILDER_COLUMN_MAX_HEIGHT_OPTION_DESC'),
					'max'        => 3000,
					'responsive' => true,
				),
				'other_separator' => array(
					'type'  => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_COLUMN_OTHER_STYLE_SETTIINGS'),
				),
				'color' => array(
					'type'  => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
				),

				'background_type' => array(
					'type'   => 'buttons',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
					'std'    => 'none',
					'values' => array(
						array(
							'label' => 'None',
							'value' => 'none',
						),
						array(
							'label' => 'Color',
							'value' => 'color',
						),
						array(
							'label' => 'Image',
							'value' => 'image',
						),
						array(
							'label' => 'Gradient',
							'value' => 'gradient',
						),
					),
				),

				'background' => array(
					'type'    => 'color',
					'title'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends' => array(
						array('background_type', '!=', 'none'),
						array('background_type', '!=', 'video'),
						array('background_type', '!=', 'gradient'),
					),
				),
				'background_gradient' => array(
					'type'  => 'gradient',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std'   => array(
						"color"  => "#00c6fb",
						"color2" => "#005bea",
						"deg"    => "45",
						"type"   => "linear",
					),
					'depends' => array(
						array('background_type', '=', 'gradient'),
					),
				),

				'background_image' => array(
					'type'   => 'media',
					'format' => 'image',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_IMAGE'),
					'std'    => array(
						'src' => '',
					),
					'depends' => array(
						array('background_type', '=', 'image'),
					),
				),

				'background_repeat' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT'),
					'values' => array(
						'no-repeat' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_NO_REPEAT'),
						'repeat'    => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_ALL'),
						'repeat-x'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_HORIZONTALLY'),
						'repeat-y'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_VERTICALLY'),
						'inherit'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
					),
					'std'     => 'no-repeat',
					'depends' => array(
						array('background_type', '=', 'image'),
						array('background_image', '!=', ''),
					),
				),

				'background_size' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE'),
					'desc'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_DESC'),
					'values' => array(
						'cover'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_COVER'),
						'contain' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_CONTAIN'),
						'inherit' => JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
						'custom'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
					),
					'std'     => 'cover',
					'depends' => array(
						array('background_type', '=', 'image'),
						array('background_image', '!=', ''),
					),
				),
				'background_size_custom' => array(
					'type'    => 'slider',
					'title'   => JText::_('COM_SPPAGEBUILDER_BACKROUND_CUSTOM_SIZE'),
					'desc'    => JText::_('COM_SPPAGEBUILDER_BACKROUND_CUSTOM_SIZE_DESC'),
					'unit'    => true,
					'max'     => 3000,
					'min'     => 0,
					'depends' => array(
						array('background_size', '=', 'custom'),
						array('background_image', '!=', ''),
					),
					'responsive' => true,
					'std'        => array('unit' => 'px'),
				),

				'background_attachment' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT'),
					'desc'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_DESC'),
					'values' => array(
						'fixed'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_FIXED'),
						'scroll'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_SCROLL'),
						'inherit' => JText::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
					),
					'std'     => 'scroll',
					'depends' => array(
						array('background_type', '=', 'image'),
						array('background_image', '!=', ''),
					),
				),

				'background_position' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_POSITION'),
					'values' => array(
						'0 0'       => JText::_('COM_SPPAGEBUILDER_LEFT_TOP'),
						'0 50%'     => JText::_('COM_SPPAGEBUILDER_LEFT_CENTER'),
						'0 100%'    => JText::_('COM_SPPAGEBUILDER_LEFT_BOTTOM'),
						'50% 0'     => JText::_('COM_SPPAGEBUILDER_CENTER_TOP'),
						'50% 50%'   => JText::_('COM_SPPAGEBUILDER_CENTER_CENTER'),
						'50% 100%'  => JText::_('COM_SPPAGEBUILDER_CENTER_BOTTOM'),
						'100% 0'    => JText::_('COM_SPPAGEBUILDER_RIGHT_TOP'),
						'100% 50%'  => JText::_('COM_SPPAGEBUILDER_RIGHT_CENTER'),
						'100% 100%' => JText::_('COM_SPPAGEBUILDER_RIGHT_BOTTOM'),
						'custom'    => JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
					),
					'std'     => '0 0',
					'depends' => array(
						array('background_type', '=', 'image'),
						array('background_image', '!=', ''),
					),
				),
				'background_position_custom_x' => array(
					'type'    => 'slider',
					'title'   => JText::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_X'),
					'desc'    => JText::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_X_DESC'),
					'unit'    => true,
					'max'     => 1000,
					'min'     => -1000,
					'depends' => array(
						array('background_position', '=', 'custom'),
						array('background_image', '!=', ''),
					),
					'responsive' => true,
					'std'        => array('unit' => 'px'),
				),
				'background_position_custom_y' => array(
					'type'    => 'slider',
					'title'   => JText::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_Y'),
					'desc'    => JText::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_Y_DESC'),
					'unit'    => true,
					'depends' => array(
						array('background_position', '=', 'custom'),
						array('background_image', '!=', ''),
					),
					'max'        => 1000,
					'min'        => -1000,
					'responsive' => true,
					'std'        => array('unit' => 'px'),
				),

				'overlay_type' => array(
					'type'   => 'buttons',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_CHOOSE'),
					'std'    => 'overlay_color',
					'values' => array(
						array(
							'label' => 'None',
							'value' => 'overlay_none',
						),
						array(
							'label' => 'Color',
							'value' => 'overlay_color',
						),
						array(
							'label' => 'Gradient',
							'value' => 'overlay_gradient',
						),
						array(
							'label' => 'Pattern',
							'value' => 'overlay_pattern',
						),
					),
					'depends' => array(
						array('background_type', '!=', 'none'),
						array('background_type', '!=', 'color'),
						array('background_type', '!=', 'gradient'),
					),
				),

				'overlay' => array(
					'type'    => 'color',
					'title'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY'),
					'desc'    => JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_DESC'),
					'depends' => array(
						array('background_type', '=', 'image'),
						array('background_image', '!=', ''),
						array('overlay_type', '=', 'overlay_color'),
					),
				),

				'gradient_overlay' => array(
					'type'  => 'gradient',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT'),
					'desc'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT_DESC'),
					'std'   => array(
						"color"  => "rgba(127, 0, 255, 0.8)",
						"color2" => "rgba(225, 0, 255, 0.7)",
						"deg"    => "45",
						"type"   => "linear",
					),
					'depends' => array(
						array('background_type', '!=', 'none'),
						array('background_type', '!=', 'color'),
						array('background_type', '!=', 'gradient'),
						array('overlay_type', '=', 'overlay_gradient'),
						array('background_image', '!=', ''),
					),
				),

				'pattern_overlay' => array(
					'type'  => 'media',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN'),
					'desc'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_DESC'),
					'std'   => array(
						'src' => '',
					),
					'depends' => array(
						array('background_type', '!=', 'none'),
						array('background_type', '!=', 'color'),
						array('background_type', '!=', 'gradient'),
						array('overlay_type', '=', 'overlay_pattern'),
						array('background_image', '!=', ''),
					),
				),

				'overlay_pattern_color' => array(
					'type'    => 'color',
					'title'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_COLOR'),
					'desc'    => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_COLOR_DESC'),
					'std'     => '',
					'depends' => array(
						array('background_type', '!=', 'none'),
						array('background_type', '!=', 'color'),
						array('background_type', '!=', 'gradient'),
						array('overlay_type', '=', 'overlay_pattern'),
						array('pattern_overlay', '!=', ''),
						array('background_image', '!=', ''),
					),
				),

				'blend_mode' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BLEND_MODE'),
					'desc'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BLEND_MODE_DESC'),
					'values' => array(
						'normal'      => 'Normal',
						'color'       => 'Color',
						'color-burn'  => 'Color Burn',
						'color-dodge' => 'Color Dodge',
						'darken'      => 'Darken',
						'difference'  => 'Difference',
						'exclusion'   => 'Exclusion',
						'hard-light'  => 'Hard Light',
						'hue'         => 'Hue',
						'lighten'     => 'Lighten',
						'luminosity'  => 'Luminosity',
						'multiply'    => 'Multiply',
						'overlay'     => 'Overlay',
						'saturation'  => 'Saturation',
						'screen'      => 'Screen',
						'soft-light'  => 'Soft Light',
					),
					'std'     => 'normal',
					'depends' => array(
						array('background_type', '!=', 'none'),
						array('background_type', '!=', 'color'),
						array('background_type', '!=', 'gradient'),
						array('background_type', '!=', 'video'),
						array('overlay_type', '!=', 'overlay_none'),
					),
				),

				'padding' => array(
					'type'       => 'padding',
					'title'      => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc'       => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'responsive' => true,
				),
				'margin' => array(
					'type'       => 'margin',
					'title'      => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'       => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'responsive' => true,
				),
				'use_border' => array(
					'type'  => 'checkbox',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_USE_BORDER'),
					'std'   => 0,
				),
				'border_width' => array(
					'type'       => 'slider',
					'title'      => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'std'        => '',
					'depends'    => array('use_border' => 1),
					'responsive' => true,
				),
				'border_color' => array(
					'type'    => 'color',
					'title'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends' => array('use_border' => 1),
				),
				'boder_style' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
					'values' => array(
						'none'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_NONE'),
						'solid'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
						'double' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOUBLE'),
						'dotted' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
						'dashed' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
					),
					'depends' => array('use_border' => 1),
				),
				'border_radius' => array(
					'type'       => 'slider',
					'title'      => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'std'        => 0,
					'max'        => 500,
					'responsive' => true,
				),

				'boxshadow' => array(
					'type'  => 'boxshadow',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BOXSHADOW'),
					'std'   => '0 0 0 0 #fff',
				),
			),
			'responsive' => array(
				'sm_col' 		 => array(
					'type'		  => 'select',
					'title'		 => JText::_('COM_SPPAGEBUILDER_LAYOUT_TABLET'),
					'desc'		  => JText::_('COM_SPPAGEBUILDER_LAYOUT_TABLET_DESC'),
					'values'	 => array(
						''          => "",
						'col-sm-1'  => 'col-sm-1',
						'col-sm-2'  => 'col-sm-2',
						'col-sm-3'  => 'col-sm-3',
						'col-sm-4'  => 'col-sm-4',
						'col-sm-5'  => 'col-sm-5',
						'col-sm-6'  => 'col-sm-6',
						'col-sm-7'  => 'col-sm-7',
						'col-sm-8'  => 'col-sm-8',
						'col-sm-9'  => 'col-sm-9',
						'col-sm-10' => 'col-sm-10',
						'col-sm-11' => 'col-sm-11',
						'col-sm-12' => 'col-sm-12',
					),
					'std'		 => '',
				),
				'xs_col' 		 => array(
					'type'		  => 'select',
					'title'		 => JText::_('COM_SPPAGEBUILDER_LAYOUT_MOBILE'),
					'desc'		  => JText::_('COM_SPPAGEBUILDER_LAYOUT_MOBILE_DESC'),
					'values'	 => array(
						''          => "",
						'col-xs-1'  => 'col-xs-1',
						'col-xs-2'  => 'col-xs-2',
						'col-xs-3'  => 'col-xs-3',
						'col-xs-4'  => 'col-xs-4',
						'col-xs-5'  => 'col-xs-5',
						'col-xs-6'  => 'col-xs-6',
						'col-xs-7'  => 'col-xs-7',
						'col-xs-8'  => 'col-xs-8',
						'col-xs-9'  => 'col-xs-9',
						'col-xs-10' => 'col-xs-10',
						'col-xs-11' => 'col-xs-11',
						'col-xs-12' => 'col-xs-12',
					),
					'std'		 => '',
				),

				'order_separator' => array(
					'type'  => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLUMN_ORDER_OPTIONS'),
				),
				'tablet_order' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLUMN_ORDER_TABLET'),
					'desc'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLUMN_ORDER_TABLET_DESC'),
					'values' => array(
						'1'  => '1',
						'2'  => '2',
						'3'  => '3',
						'4'  => '4',
						'5'  => '5',
						'6'  => '6',
						'7'  => '7',
						'8'  => '8',
						'9'  => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
					),
					'std' => '',
				),
				'mobile_order' => array(
					'type'   => 'select',
					'title'  => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLUMN_ORDER_MOBILE'),
					'desc'   => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLUMN_ORDER_MOBILE_DESC'),
					'values' => array(
						'1'  => '1',
						'2'  => '2',
						'3'  => '3',
						'4'  => '4',
						'5'  => '5',
						'6'  => '6',
						'7'  => '7',
						'8'  => '8',
						'9'  => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
					),
					'std' => '',
				),

				'separator' => array(
					'type'  => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_VISIBILITY_OPTIONS'),
				),

				'hidden_xs' 		 => array(
					'type'		  => 'checkbox',
					'title'		 => JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS'),
					'desc'		  => JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS_DESC'),
					'std'		   => '',
				),
				'hidden_sm' 		 => array(
					'type'		  => 'checkbox',
					'title'		 => JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM'),
					'desc'		  => JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM_DESC'),
					'std'		   => '',
				),
				'hidden_md' 		 => array(
					'type'		  => 'checkbox',
					'title'		 => JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD'),
					'desc'		  => JText::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD_DESC'),
					'std'		   => '',
				),

			),

			'animation' => array(
				'animation' => array(
					'type'  => 'animation',
					'title' => JText::_('COM_SPPAGEBUILDER_ANIMATION'),
					'desc'  => JText::_('COM_SPPAGEBUILDER_ANIMATION_DESC'),
				),

				'animationduration' => array(
					'type'        => 'number',
					'title'       => JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
					'desc'        => JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION_DESC'),
					'std'         => '300',
					'placeholder' => '300',
				),

				'animationdelay' => array(
					'type'        => 'number',
					'title'       => JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY'),
					'desc'        => JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY_DESC'),
					'std'         => '0',
					'placeholder' => '300',
				),
			),
	),
);
