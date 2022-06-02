<?php
/**
* @package SP Page Builder
* @author JoomShaper http: //www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http: //www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;

$row_settings = array(
	'type'  => 'content',
	'title' => 'Section',
	'attr'  => array(
		'general' => array(
			'admin_label' => array(
				'type'  => 'text',
				'title' => Text::_('COM_SPPAGEBUILDER_ADMIN_LABEL'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_ADMIN_LABEL_DESC'),
				'std'   => '',
			),

			'separator1' => array(
				'type'  => 'separator',
				'title' => Text::_('Title Options'),
			),

			'title' => array(
				'type'  => 'textarea',
				'title' => Text::_('COM_SPPAGEBUILDER_SECTION_TITLE'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_SECTION_TITLE_DESC'),
				'css'   => 'min-height: 80px;',
				'std'   => '',
			),

			'heading_selector' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_DESC'),
				'values' => array(
					'h1' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H1'),
					'h2' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H2'),
					'h3' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H3'),
					'h4' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H4'),
					'h5' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H5'),
					'h6' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HEADINGS_H6'),
				),
				'std'     => 'h3',
				'depends' => array(
					array('title', '!=', ''),
				),
			),

			'title_fontsize' => array(
				'type'    => 'slider',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_FONT_SIZE'),
				'std'     => '',
				'depends' => array(
					array('title', '!=', ''),
				),
				'responsive' => true,
				'max'        => 500,
			),

			'title_fontweight' => array(
				'type'    => 'text',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_FONT_WEIGHT'),
				'std'     => '',
				'depends' => array(
					array('title', '!=', ''),
				),
			),

			'title_text_color' => array(
				'type'    => 'color',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_TITLE_TEXT_COLOR'),
				'depends' => array(
					array('title', '!=', ''),
				),
			),

			'title_margin_top' => array(
				'type'        => 'number',
				'title'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_TOP'),
				'placeholder' => '10',
				'depends'     => array(
					array('title', '!=', ''),
				),
				'responsive' => true,
			),

			'title_margin_bottom' => array(
				'type'        => 'number',
				'title'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_BOTTOM'),
				'placeholder' => '10',
				'depends'     => array(
					array('title', '!=', ''),
				),
				'responsive' => true,
			),

			'separator2' => array(
				'type'  => 'separator',
				'title' => Text::_('Subtitle Options'),
			),

			'subtitle' => array(
				'type'  => 'textarea',
				'title' => Text::_('COM_SPPAGEBUILDER_SECTION_SUBTITLE'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_SECTION_SUBTITLE_DESC'),
				'css'   => 'min-height: 120px;',
			),

			'subtitle_fontsize' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_SUB_TITLE_FONT_SIZE'),
				'desc'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_SUB_TITLE_FONT_SIZE_DESC'),
				'responsive' => true,
				'depends'    => array(
					array('subtitle', '!=', ''),
				),
			),

			'title_position' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_TITLE_SUBTITLE_POSITION'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_TITLE_SUBTITLE_POSITION_DESC'),
				'values' => array(
					'sppb-text-left'   => Text::_('COM_SPPAGEBUILDER_LEFT'),
					'sppb-text-center' => Text::_('COM_SPPAGEBUILDER_CENTER'),
					'sppb-text-right'  => Text::_('COM_SPPAGEBUILDER_RIGHT'),
				),
				'std' => 'sppb-text-center',
			),

			'columns_align_center' => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_COLUMNS_ALIGN_CENTER'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_ROW_COLUMNS_ALIGN_CENTER_DESC'),
				'std'   => 0,
			),

			'columns_content_alignment' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
				'values' => array(
					'top'    => Text::_('COM_SPPAGEBUILDER_ADDON_OPTIN_POSITION_TOP'),
					'center' => Text::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
					'bottom' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
				),
				'std'     => 'center',
				'depends' => array(
					array('columns_align_center', '!=', 0),
				),
			),

			'fullscreen' => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_FULLSCREEN'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_FULLSCREEN_DESC'),
				'std'   => 0,
			),

			'no_gutter' => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_NO_GUTTER'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_ROW_NO_GUTTER_DESC'),
				'std'   => 0,
			),
			'container_separator' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_CONTAINER_STYLE'),
			),
			'container_width' => array(
				'type'    => 'slider',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_CONTAINER_WIDTH'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_GLOBAL_CONTAINER_WIDTH_DESC'),
				'max'     => 1600,
				'min'     => 1200,
				'depends' => array(
					array('fullscreen', '=', 0),
				),
			),
			'columns_gap' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_COLUMNS_GAP'),
				'max'        => 100,
				'min'        => 0,
				'unit'       => true,
				'responsive' => true,
				'depends'    => array(
					array('no_gutter', '=', 0),
				),
			),

			'id' => array(
				'type'  => 'text',
				'title' => Text::_('COM_SPPAGEBUILDER_SECTION_ID'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_SECTION_ID_DESC'),
			),

			'class' => array(
				'type'  => 'text',
				'title' => Text::_('COM_SPPAGEBUILDER_CSS_CLASS'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_CSS_CLASS_DESC'),
			),

		),

		'style' => array(

			'height_separator' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_HEIGHT_SETTIINGS'),
			),
			'section_height_option' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_ROW_HEIGHT_SELECTOR'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_ROW_HEIGHT_SELECTOR_DESC'),
				'values' => array(
					'win-height' => Text::_('COM_SPPAGEBUILDER_ROW_WIN_HEIGHT'),
					'height'     => Text::_('COM_SPPAGEBUILDER_ROW_HEIGHT'),
				),
			),

			'section_height' => array(
				'type'    => 'slider',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_HEIGHT_OPTION'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_HEIGHT_OPTION_DESC'),
				'depends' => array(
					array('section_height_option', '=', 'height'),
				),
				'max'        => 3000,
				'responsive' => true,
			),
			'section_min_height' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_ROW_MIN_HEIGHT_OPTION'),
				'desc'       => Text::_('COM_SPPAGEBUILDER_ROW_MIN_HEIGHT_OPTION_DESC'),
				'max'        => 3000,
				'responsive' => true,
			),
			'section_max_height' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_ROW_MAX_HEIGHT_OPTION'),
				'desc'       => Text::_('COM_SPPAGEBUILDER_ROW_MAX_HEIGHT_OPTION_DESC'),
				'max'        => 3000,
				'responsive' => true,
			),

			'section_overflow_x' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_OVERFLOW_X'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_OVERFLOW_X_DESC'),
				'values' => array(
					'auto'    => 'Auto',
					'hidden'  => 'Hidden',
					'initial' => 'Initial',
					'scroll'  => 'Scroll',
					'visible' => 'Visible',
				),
			),

			'section_overflow_y' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_OVERFLOW_Y'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_OVERFLOW_Y_DESC'),
				'values' => array(
					'auto'    => 'Auto',
					'hidden'  => 'Hidden',
					'initial' => 'Initial',
					'scroll'  => 'Scroll',
					'visible' => 'Visible',
				),
			),
			'width_separator' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_WIDTH_SETTINGS'),
			),
			'row_width' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_ROW_WIDTH'),
				'unit'       => true,
				'max'        => 3000,
				'min'        => 0,
				'responsive' => true,
				'std'        => array('unit' => 'px'),
			),
			'row_max_width' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_MAX_WIDTH'),
				'unit'       => true,
				'max'        => 3000,
				'min'        => 0,
				'responsive' => true,
				'std'        => array('unit' => 'px'),
			),
			'row_min_width' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_MIN_WIDTH'),
				'unit'       => true,
				'max'        => 3000,
				'min'        => 0,
				'responsive' => true,
				'std'        => array('unit' => 'px'),
			),
			'other_separator' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_OTHER_SETTINGS'),
			),
			'padding' => array(
				'type'        => 'padding',
				'title'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
				'desc'        => Text::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
				'std'         => '50px 0px 50px 0px',
				'placeholder' => '10px 10px 10px 10px',
				'responsive'  => true,
			),

			'margin' => array(
				'type'        => 'margin',
				'title'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
				'desc'        => Text::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
				'std'         => '0px 0px 0px 0px',
				'placeholder' => '10px 10px 10px 10px',
				'responsive'  => true,
			),

			'color' => array(
				'type'  => 'color',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
			),

			'background_type' => array(
				'type'   => 'buttons',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
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
					array(
						'label' => 'Video',
						'value' => 'video',
					),
				),
			),

			'background_color' => array(
				'type'    => 'color',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
				'depends' => array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'video'),
					array('background_type', '!=', 'gradient'),
				),
			),
			'background_gradient' => array(
				'type'  => 'gradient',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
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
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_IMAGE'),
				'std'    => array(
					'src' => '',
				),
				'show_input' => true,
				'depends'    => array(
					array('background_type', '=', 'image'),
				),
			),

			'background_parallax' => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_PARALLAX_ENABLE'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_PARALLAX_ENABLE_DESC'),
				'std'     => '0',
				'depends' => array(
					array('background_type', '=', 'image'),
				),
			),

			'background_repeat' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT'),
				'values' => array(
					'no-repeat' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_NO_REPEAT'),
					'repeat'    => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_ALL'),
					'repeat-x'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_HORIZONTALLY'),
					'repeat-y'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_REPEAT_VERTICALLY'),
					'inherit'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
				),
				'std'     => 'no-repeat',
				'depends' => array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', ''),
				),
			),

			'background_size' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_DESC'),
				'values' => array(
					'cover'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_COVER'),
					'contain' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_SIZE_CONTAIN'),
					'inherit' => Text::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
					'custom'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
				),
				'std'     => 'cover',
				'depends' => array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', ''),
				),
			),
			'background_size_custom' => array(
				'type'    => 'slider',
				'title'   => Text::_('COM_SPPAGEBUILDER_BACKROUND_CUSTOM_SIZE'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_BACKROUND_CUSTOM_SIZE_DESC'),
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
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_DESC'),
				'values' => array(
					'fixed'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_FIXED'),
					'scroll'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_ATTACHMENT_SCROLL'),
					'inherit' => Text::_('COM_SPPAGEBUILDER_GLOBAL_INHERIT'),
				),
				'std'     => 'fixed',
				'depends' => array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', ''),
				),
			),

			'background_position' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_POSITION'),
				'values' => array(
					'0 0'       => Text::_('COM_SPPAGEBUILDER_LEFT_TOP'),
					'0 50%'     => Text::_('COM_SPPAGEBUILDER_LEFT_CENTER'),
					'0 100%'    => Text::_('COM_SPPAGEBUILDER_LEFT_BOTTOM'),
					'50% 0'     => Text::_('COM_SPPAGEBUILDER_CENTER_TOP'),
					'50% 50%'   => Text::_('COM_SPPAGEBUILDER_CENTER_CENTER'),
					'50% 100%'  => Text::_('COM_SPPAGEBUILDER_CENTER_BOTTOM'),
					'100% 0'    => Text::_('COM_SPPAGEBUILDER_RIGHT_TOP'),
					'100% 50%'  => Text::_('COM_SPPAGEBUILDER_RIGHT_CENTER'),
					'100% 100%' => Text::_('COM_SPPAGEBUILDER_RIGHT_BOTTOM'),
					'custom'    => Text::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
				),
				'std'     => '0 0',
				'depends' => array(
					array('background_type', '=', 'image'),
					array('background_image', '!=', ''),
				),
			),

			'background_position_custom_x' => array(
				'type'    => 'slider',
				'title'   => Text::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_X'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_X_DESC'),
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
				'title'   => Text::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_Y'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_BACKGROUND_CUSTOM_POSITION_Y_DESC'),
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
			'external_background_video' => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_EXTERNAL_VIDEO_ENABLE'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_EXTERNAL_VIDEO_ENABLE_DESC'),
				'std'     => '0',
				'depends' => array(
					array('background_type', '=', 'video'),
				),
			),

			'background_video_mp4' => array(
				'type'    => 'media',
				'format'  => 'video',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_VIDEO_MP4'),
				'depends' => array(
					array('background_type', '=', 'video'),
					array('external_background_video', '=', 0),
				),
				'std' => array(
					'src' => '',
				),
			),

			'background_video_ogv' => array(
				'type'    => 'media',
				'format'  => 'video',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_VIDEO_OGV'),
				'depends' => array(
					array('background_type', '=', 'video'),
					array('external_background_video', '=', 0),
				),
				'std' => array(
					'src' => '',
				),
			),

			'background_external_video' => array(
				'type'    => 'text',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_BACKGROUND_VIDEO_YOUTUBE_VIMEO'),
				'depends' => array(
					array('background_type', '=', 'video'),
					array('external_background_video', '=', 1),
				),
			),

			'video_loop' => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_VIDEO_LOOP'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_VIDEO_LOOP_DESC'),
				'std'     => 1,
				'depends' => array(
					array('background_type', '=', 'video'),
					array('external_background_video', '!=', 1),
				),
			),

			'overlay_separator' => array(
				'type'    => 'separator',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_OPTIONS'),
				'depends' => array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
				),
			),

			'overlay_type' => array(
				'type'   => 'buttons',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_CHOOSE'),
				'std'    => 'overlay_none',
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
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_DESC'),
				'depends' => array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_color'),
				),
			),

			'gradient_overlay' => array(
				'type'  => 'gradient',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_GRADIENT_DESC'),
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
				),
			),

			'pattern_overlay' => array(
				'type'    => 'media',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_DESC'),
				'std'     => '',
				'depends' => array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_pattern'),
				),
			),

			'overlay_pattern_color' => array(
				'type'    => 'color',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_COLOR'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_OVERLAY_PATTERN_COLOR_DESC'),
				'std'     => '',
				'depends' => array(
					array('background_type', '!=', 'none'),
					array('background_type', '!=', 'color'),
					array('background_type', '!=', 'gradient'),
					array('overlay_type', '=', 'overlay_pattern'),
					array('pattern_overlay', '!=', ''),
				),
			),

			'blend_mode' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BLEND_MODE'),
				'desc'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BLEND_MODE_DESC'),
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

			'row_border' => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_USE_BORDER'),
				'std'   => 0,
			),
			'row_border_width' => array(
				'type'       => 'margin',
				'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
				'desc'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH_DESC'),
				'depends'    => array('row_border' => 1),
				'responsive' => true,
			),
			'row_border_color' => array(
				'type'    => 'color',
				'title'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
				'depends' => array('row_border' => 1),
			),
			'row_border_style' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
				'values' => array(
					'none'   => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_NONE'),
					'solid'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
					'double' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOUBLE'),
					'dotted' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
					'dashed' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
				),
				'depends' => array('row_border' => 1),
				'std'     => 'solid',
			),
			'row_border_radius' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
				'desc'       => Text::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_ROW_DESC'),
				'std'        => 0,
				'max'        => 500,
				'responsive' => true,
			),
			'row_boxshadow' => array(
				'type'  => 'boxshadow',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_BOXSHADOW'),
				'std'   => '0 0 0 0 #ffffff',
			),

			'separator_shape_top' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_TOP_SHAPE'),
			),

			'show_top_shape' 		 => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_SHOW_SHAPE'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_ROW_SHOW_TOP_SHAPE_DESC'),
				'std'   => '',
			),

			'shape_name' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE'),
				'values' => array(
					'bell'           => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_BELL'),
					'brushed'        => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_BRUSHED'),
					'clouds-flat'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_FLAT'),
					'clouds-opacity' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_OPACITY'),
					'drip'           => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_DRIP'),
					'hill'           => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_HILL'),
					'hill-wave'      => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_HILL_WAVE'),
					'line-wave'      => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_LINE_WAVE'),
					'paper-torn'     => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_PAPER_TORN'),
					'pointy-wave'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_POINTY_WAVE'),
					'rocky-mountain' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_ROCKY_MOUNTAIN'),
					'shaggy'         => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SHAGGY'),
					'single-wave'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SINGLE_WAVE'),
					'slope-opacity'  => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE_OPACITY'),
					'slope'          => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE'),
					'swirl'          => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SWIRL'),
					'wavy-opacity'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_WAVY_OPACITY'),
					'waves3-opacity' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_WAVES3_OPACITY'),
					'turning-slope'  => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_TURNING_SLOPE'),
					'zigzag-sharp'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_ZIGZAG_SHARP'),
				),
				'std'     => 'clouds-flat',
				'depends' => array(
					array('show_top_shape', '=', 1),
				),
			),

			'shape_color' => array(
				'type'    => 'color',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_COLOR'),
				'std'     => '#e5e5e5',
				'depends' => array(
					array('show_top_shape', '=', 1),
				),
			),

			'shape_width' => array(
				'type'  => 'slider',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_WIDTH'),
				'std'   => array(
					'md' => 100,
					'sm' => 100,
					'xs' => 100,
				),
				'max'        => 600,
				'min'        => 100,
				'responsive' => true,
				'depends'    => array(
					array('show_top_shape', '=', 1),
				),
			),

			'shape_height' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_HEIGHT'),
				'std'        => '',
				'max'        => 600,
				'responsive' => true,
				'depends'    => array(
					array('show_top_shape', '=', 1),
				),
			),
			'shape_flip' 		 => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP_DESC'),
				'std'     => false,
				'depends' => array(
					array('show_top_shape', '=', 1),
					array('shape_name', '!=', 'bell'),
					array('shape_name', '!=', 'zigzag-sharp'),
				),
			),
			'shape_invert' 		 => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_INVERT'),
				'std'     => false,
				'depends' => array(
					array('show_top_shape', '=', 1),
					array('shape_name', '!=', 'clouds-opacity'),
					array('shape_name', '!=', 'slope-opacity'),
					array('shape_name', '!=', 'waves3-opacity'),
					array('shape_name', '!=', 'paper-torn'),
					array('shape_name', '!=', 'hill-wave'),
					array('shape_name', '!=', 'line-wave'),
					array('shape_name', '!=', 'swirl'),
					array('shape_name', '!=', 'wavy-opacity'),
					array('shape_name', '!=', 'zigzag-sharp'),
					array('shape_name', '!=', 'brushed'),
				),
			),
			'shape_to_front' 		 => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT_DESC'),
				'std'     => false,
				'depends' => array(
					array('show_top_shape', '=', 1),
				),
			),

			'separator_shape_bottom' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_BOTTOM_SHAPE'),
			),

			'show_bottom_shape' 		 => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_SHOW_SHAPE'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_ROW_SHOW_BOTTOM_SHAPE_DESC'),
				'std'   => '',
			),

			'bottom_shape_name' => array(
				'type'   => 'select',
				'title'  => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE'),
				'values' => array(
					'bell'           => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_BELL'),
					'brushed'        => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_BRUSHED'),
					'clouds-flat'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_FLAT'),
					'clouds-opacity' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_CLOUDS_OPACITY'),
					'drip'           => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_DRIP'),
					'hill'           => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_HILL'),
					'hill-wave'      => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_HILL_WAVE'),
					'line-wave'      => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_LINE_WAVE'),
					'paper-torn'     => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_PAPER_TORN'),
					'pointy-wave'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_POINTY_WAVE'),
					'rocky-mountain' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_ROCKY_MOUNTAIN'),
					'shaggy'         => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SHAGGY'),
					'single-wave'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SINGLE_WAVE'),
					'slope-opacity'  => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE_OPACITY'),
					'slope'          => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SLOPE'),
					'swirl'          => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_SWIRL'),
					'wavy-opacity'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_WAVY_OPACITY'),
					'waves3-opacity' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_WAVES3_OPACITY'),
					'turning-slope'  => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_TURNING_SLOPE'),
					'zigzag-sharp'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_ZIGZAG_SHARP'),
				),
				'std'     => 'clouds-opacity',
				'depends' => array(
					array('show_bottom_shape', '=', 1),
				),
			),

			'bottom_shape_color' => array(
				'type'    => 'color',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_COLOR'),
				'std'     => '#e5e5e5',
				'depends' => array(
					array('show_bottom_shape', '=', 1),
				),
			),

			'bottom_shape_width' => array(
				'type'  => 'slider',
				'title' => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_WIDTH'),
				'std'   => array(
					'md' => 100,
					'sm' => 100,
					'xs' => 100,
				),
				'max'        => 600,
				'min'        => 100,
				'responsive' => true,
				'depends'    => array(
					array('show_bottom_shape', '=', 1),
				),
			),

			'bottom_shape_height' => array(
				'type'       => 'slider',
				'title'      => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_HEIGHT'),
				'std'        => '',
				'max'        => 600,
				'responsive' => true,
				'depends'    => array(
					array('show_bottom_shape', '=', 1),
				),
			),
			'bottom_shape_flip' 		 => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_FLIP_DESC'),
				'std'     => false,
				'depends' => array(
					array('show_bottom_shape', '=', 1),
					array('shape_name', '!=', 'bell'),
					array('shape_name', '!=', 'zigzag-sharp'),
				),
			),
			'bottom_shape_invert' 		 => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_INVERT'),
				'std'     => false,
				'depends' => array(
					array('show_bottom_shape', '=', 1),
					array('bottom_shape_name', '!=', 'clouds-opacity'),
					array('bottom_shape_name', '!=', 'slope-opacity'),
					array('bottom_shape_name', '!=', 'waves3-opacity'),
					array('bottom_shape_name', '!=', 'paper-torn'),
					array('bottom_shape_name', '!=', 'hill-wave'),
					array('bottom_shape_name', '!=', 'line-wave'),
					array('bottom_shape_name', '!=', 'swirl'),
					array('shape_name', '!=', 'wavy-opacity'),
					array('shape_name', '!=', 'zigzag-sharp'),
					array('shape_name', '!=', 'brushed'),
				),
			),
			'bottom_shape_to_front' 		 => array(
				'type'    => 'checkbox',
				'title'   => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT'),
				'desc'    => Text::_('COM_SPPAGEBUILDER_ROW_SHAPE_TO_FRONT_DESC'),
				'std'     => false,
				'depends' => array(
					array('show_bottom_shape', '=', 1),
				),
			),

			'separator_responsive' => array(
				'type'  => 'separator',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_RESPONSIVE'),
			),

			'hidden_xs' 		 => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_XS_DESC'),
				'std'   => '',
			),
			'hidden_sm' 		 => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_SM_DESC'),
				'std'   => '',
			),
			'hidden_md' 		 => array(
				'type'  => 'checkbox',
				'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_HIDDEN_MD_DESC'),
				'std'   => '',
			),

		),

		'animation' => array(
			'animation' => array(
				'type'  => 'animation',
				'title' => Text::_('COM_SPPAGEBUILDER_ANIMATION'),
				'desc'  => Text::_('COM_SPPAGEBUILDER_ANIMATION_DESC'),
			),

			'animationduration' => array(
				'type'        => 'number',
				'title'       => Text::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
				'desc'        => Text::_('COM_SPPAGEBUILDER_ANIMATION_DURATION_DESC'),
				'std'         => '300',
				'placeholder' => '300',
			),

			'animationdelay' => array(
				'type'        => 'number',
				'title'       => Text::_('COM_SPPAGEBUILDER_ANIMATION_DELAY'),
				'desc'        => Text::_('COM_SPPAGEBUILDER_ANIMATION_DELAY_DESC'),
				'std'         => '0',
				'placeholder' => '300',
			),
		),
	),
);
