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
		'addon_name'=>'image_overlay',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_DESC'),
		'category'=>'Media',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				//Background Image & Effect
				'bg_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_OPTIONS'),
				),
				'image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_IMG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_IMG_DESC'),
					'show_input' => true,
					'std'=>array(
						'src'=>'https://sppagebuilder.com/addons/image/image1.jpg',
					)
				),
				'image_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_HEIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_HEIGHT_DESC'),
					'placeholder'=>'300px',
					'depends'=>array(array('image', '!=', '')),
					'responsive' => true,
					'max'=> 1200,
					'std'=> 300
				),
				'background_image_animation'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION'),
					'values'=>array(
						'slide-top'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION_SLIDE_TOP'),
						'slide-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION_SLIDE_RIGHT'),
						'slide-bottom'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION_SLIDE_BOTTOM'),
						'slide-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION_SLIDE_LEFT'),
						'zoom-in'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION_SLIDE_ZOOMIN'),
						'zoom-out'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_BG_ANIMATION_SLIDE_ZOOMOUT'),
					),
					'depends'=>array(array('image', '!=', '')),
					'std'=>'slide-left',
				),
				'image_in_lightbox'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_IMG_IN_LIGHTBOX'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_IMG_IN_LIGHTBOX_DESC'),
					'depends'=>array(array('image', '!=', '')),
					'std'=>0,
				),
				'lightbox_icon_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_LIGHTBOX_BG'),
					'depends'=>array(
						array('image_in_lightbox', '!=', 0),
						array('image', '!=', '')
					),
					'std'=>'',
				),

				//overlay options
				'overlay_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_OVERLAY_OPTIONS'),
				),
				'overlay_mode' => array(
					'type' => 'buttons',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_OVERLAY_MODE'),
					'std' => 'normal',
					'values' => array(
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
				),
				'overlay_type'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_OVERLAY_CHOOSE'),
					'std'=>'gradient',
					'values'=>array(
						array(
							'label' => 'None',
							'value' => 'none'
						),
						array(
							'label' => 'Color',
							'value' => 'color'
						),
						array(
							'label' => 'Gradient',
							'value' => 'gradient'
						)
					),
					'depends'=>array(
						array('overlay_mode', '!=', 'hover'),
					),
				),

				'overlay_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('overlay_type', '!=', 'none'),
						array('overlay_mode', '!=', 'hover'),
						array('overlay_type', '!=', 'gradient'),
					),
					'std'=>'rgba(0, 91, 234, 0.5)'
				),
				'overlay_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std'=> array(
						"color" => "rgba(127, 0, 255, 0.8)",
						"color2" => "rgba(225, 0, 255, 0.7)",
						"deg" => "45",
						"type" => "linear"
					),
					'depends'=>array(
						array('overlay_mode', '!=', 'hover'),
						array('overlay_type', '=', 'gradient'),
					)
				),
				//Hover overlay
				'overlay_hover_type'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_OVERLAY_HOVER_CHOOSE'),
					'std'=>'none',
					'values'=>array(
						array(
							'label' => 'None',
							'value' => 'none'
						),
						array(
							'label' => 'Color',
							'value' => 'color'
						),
						array(
							'label' => 'Gradient',
							'value' => 'gradient'
						)
					),
					'depends'=>array(
						array('overlay_mode', '!=', 'normal'),
					),
				),
				'overlay_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_HOVER_COLOR'),
					'depends'=>array(
						array('overlay_hover_type', '!=', 'none'),
						array('overlay_mode', '!=', 'normal'),
						array('overlay_hover_type', '!=', 'gradient'),
					),
					'std'=>''
				),

				'overlay_hover_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_HOVER_GRADIENT'),
					'std'=> array(
						"color" => "rgba(127, 0, 255, 0.8)",
						"color2" => "rgba(225, 0, 255, 0.7)",
						"deg" => "45",
						"type" => "linear"
					),
					'depends'=>array(
						array('overlay_mode', '!=', 'normal'),
						array('overlay_hover_type', '=', 'gradient'),
					)
				),

				//Tittle
				'title_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_OPTIONS'),
				),
				'title'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std'=> 'Image Overlay'
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
					'std'=>'h4',
					'depends'=>array(array('title', '!=', '')),
				),

				'title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
					'depends'=>array(array('title', '!=', '')),
				),

				'title_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
					'std'=>'',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
					'std'=> 20
				),

				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
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

				'title_link'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_LINK'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_LINK_DESC'),
					'depends'=>array(array('title', '!=', '')),
					'std'=>'',
					'placeholder'=>'#',
				),

				'title_link_new_window'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW_DESC'),
					'depends'=>array(
						array('title', '!=', ''),
						array('title_link', '!=', ''),
					),
					'std'=>0,
				),

				'title_icon' => array(
					'type' => 'icon',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_LINK_ICON'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_LINK_ICON_DESC'),
					'depends'=>array(
						array('title', '!=', ''),
					)
				),

				'title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_MARGIN_DESC'),
					'placeholder'=>'10px',
					'depends'=>array(array('title', '!=', '')),
					'responsive' => true,
					'max' => 400,
					'std' => '',
				),
				//Subtitle
				'subtitle_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_OPTIONS'),
				),
				'sub_title'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_DESC'),
					'std'=>  'Subtitle of the Image Overlay addon',
				),

				'subtitle_heading_selector'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_HEADING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_HEADING_DESC'),
					'values'=>array(
						'h1'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
						'h2'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
						'h3'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
						'h4'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
						'h5'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
						'h6'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
						'div'=>'div',
						'span'=>'span',
						'p'=>'p',
					),
					'std'=>'div',
					'depends'=>array(array('sub_title', '!=', '')),
				),

				'sub_title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_TEXT_COLOR'),
					'depends'=>array(array('sub_title', '!=', '')),
				),

				'sub_title_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(array('sub_title', '!=', '')),
					'responsive' => true,
					'max'=> 400,
				),

				'sub_title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_FONT_FAMILY'),
					'depends'=>array(array('sub_title', '!=', '')),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-subtitle { font-family: "{{ VALUE }}"; }'
					)
				),

				'sub_title_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_FONT_STYLE'),
					'depends'=>array(array('sub_title', '!=', '')),
				),

				'sub_title_letterspace'=>array(
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
					'depends'=>array(array('sub_title', '!=', '')),
				),

				'sub_title_icon' => array(
					'type' => 'icon',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_LINK_ICON'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUBTITLE_LINK_ICON_DESC'),
					'depends'=>array(
						array('title', '!=', ''),
					)
				),

				'sub_title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SUB_TITLE_MARGIN'),
					'placeholder'=>'10px',
					'depends'=>array(array('sub_title', '!=', '')),
					'responsive' => true,
					'std' => '',
				),

				//Title & Subtitle Position
				'title_subtitle_option' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_SUBTITLE_POSITION_OPTION'),
				),
				'title_subtitle_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TITLE_SUBTITLE_POSITION'),
					'values'=>array(
						'top-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TOP_LEFT'),
						'top-center'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TOP_CENTER'),
						'top-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_TOP_RIGHT'),
						'center-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_CENTER_LEFT'),
						'center-center'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_CENTER_CENTER'),
						'center-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_CENTER_RIGHT'),
						'bottom-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_BOTTOM_LEFT'),
						'bottom-center'=> JText::_('COM_SPPAGEBUILDER_ADDON_BOTTOM_CENTER'),
						'bottom-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_BOTTOM_RIGHT'),
					),
					'std'=>'bottom-left',
					'depends'=>array(
						array('title', '!=', ''),
					),
				),

				'show_content_on_hover' => array(
					'type' => 'checkbox',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_SHOW_CONTENT'),
					'std'=>0
				),

				'content_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_PADDING'),
					'responsive' => true,
					'std' => '',
				),

				//Button
				'button_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_OPTIONS'),
				),
				'text' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
					'std' => '',
				),
				'font_family' => array(
					'type' => 'fonts',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.sppb-btn { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'font_style' => array(
					'type' => 'fontstyle',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
					'depends'=>array(
						array('text', '!=', ''),
					)
				),

				'letterspace' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
					'values' => array(
						'0' => 'Default',
						'1px' => '1px',
						'2px' => '2px',
						'3px' => '3px',
						'4px' => '4px',
						'5px' => '5px',
						'6px' => '6px',
						'7px' => '7px',
						'8px' => '8px',
						'9px' => '9px',
						'10px' => '10px'
					),
					'std' => '0',
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'url' => array(
					'type' => 'media',
					'format' => 'attachment',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
					'placeholder' => 'http://',
					'hide_preview' => true,
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'target' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
					'values' => array(
						'' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						'_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
					'depends' => array(array('url', '!=', '')),
				),
				'type' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
					'values' => array(
						'default' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
						'primary' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
						'secondary' => JText::_('COM_SPPAGEBUILDER_GLOBAL_SECONDARY'),
						'success' => JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
						'info' => JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
						'warning' => JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
						'danger' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
						'dark' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DARK'),
						'link' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
						'custom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
					),
					'std' => 'custom',
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'appearance' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_DESC'),
					'values' => array(
						'' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_FLAT'),
						'gradient' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_GRADIENT'),
						'outline' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_OUTLINE'),
						'3d' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_3D'),
					),
					'std' => '',
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'fontsize' => array(
					'type' => 'slider',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std' => array('md' => 16),
					'responsive' => true,
					'max' => 400,
					'depends' => array(
						array('type', '=', 'custom'),
						array('text', '!=', ''),
					)
				),
				'button_status' => array(
					'type' => 'buttons',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
					'std' => 'normal',
					'values' => array(
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
					'depends' => array(
						array('type', '=', 'custom'),
						array('text', '!=', ''),
					)
				),
				'background_color' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
					'std' => '#03E16D',
					'depends' => array(
						array('appearance', '!=', 'gradient'),
						array('type', '=', 'custom'),
						array('button_status', '=', 'normal'),
						array('text', '!=', ''),
					)
				),
				'background_gradient' => array(
					'type' => 'gradient',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std' => array(
						"color" => "#B4EC51",
						"color2" => "#429321",
						"deg" => "45",
						"type" => "linear"
					),
					'depends' => array(
						array('appearance', '=', 'gradient'),
						array('type', '=', 'custom'),
						array('button_status', '=', 'normal'),
					)
				),
				'color' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
					'std' => '#FFFFFF',
					'depends' => array(
						array('type', '=', 'custom'),
						array('button_status', '=', 'normal'),
						array('text', '!=', ''),
					),
				),
				'background_color_hover' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
					'std' => '#00E66E',
					'depends' => array(
						array('appearance', '!=', 'gradient'),
						array('type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					)
				),
				'background_gradient_hover' => array(
					'type' => 'gradient',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std' => array(
						"color" => "#429321",
						"color2" => "#B4EC51",
						"deg" => "45",
						"type" => "linear"
					),
					'depends' => array(
						array('appearance', '=', 'gradient'),
						array('type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					)
				),
				'color_hover' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
					'std' => '#FFFFFF',
					'depends' => array(
						array('type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					),
				),
				'button_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10px',
					'depends'=>array(
						array('text', '!=', '')
					),
					'responsive' => true,
					'std' => '10px 0px 0px 0px',
				),
				'button_padding' => array(
					'type' => 'padding',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'std'=>'',
					'depends' => array(
						array('type', '=', 'custom'),
						array('text', '!=', ''),
					),
					'responsive' => true,
				),
				'size' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DESC'),
					'values' => array(
						'' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DEFAULT'),
						'lg' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_LARGE'),
						'xlg' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_XLARGE'),
						'sm' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_SMALL'),
						'xs' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_EXTRA_SAMLL'),
					),
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'shape' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
					'values' => array(
						'rounded' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
						'square' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
						'round' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
					),
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'block' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK_DESC'),
					'values' => array(
						'' => JText::_('JNO'),
						'sppb-btn-block' => JText::_('JYES'),
					),
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'icon' => array(
					'type' => 'icon',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
					'depends'=>array(
						array('text', '!=', ''),
					)
				),
				'icon_position' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
					'values' => array(
						'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std' => 'left',
					'depends'=>array(
						array('text', '!=', ''),
					)
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
