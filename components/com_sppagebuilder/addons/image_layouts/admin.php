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
		'addon_name'=>'image_layouts',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_DESC'),
		'category'=>'Media',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				'image_preset_thumb'=>array(
					'type'=>'thumbnail',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_STYLE_DESC'),
					'values'=>array(
						'inline'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_layouts/assets/images/inline.png',
						'stack'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_layouts/assets/images/stack.png',
						'poster'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_layouts/assets/images/poster.png',
						'card'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_layouts/assets/images/card.png',
						'overlap'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_layouts/assets/images/overlap.png',
						'collage'=> str_replace('administrator/', '', JURI::base()) . 'components/com_sppagebuilder/addons/image_layouts/assets/images/collage.png',
					),
					'std'=>'collage',
				),

				'image'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_SELECT_DESC'),
					'show_input' => true,
					'std'=>array(
						'src'=>'http://sppagebuilder.com/addons/image_layouts/image_layouts_default.jpg',
						'width'=>'',
						'height'=>''
					)
				),
				'image_container_column' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUTS_IMG_CONTAINER'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUTS_IMG_CONTAINER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'card'),
					),
					'values'=> array(
						1=>1,
						2=>2,
						3=>3,
						4=>4,
						5=>5,
						6=>6,
						7=>7,
						8=>8,
					),
				),
				'image_border_radius' => array(
					'type' => 'slider',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'max'=> 1000,
				),
				'image_alt_text'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ALT_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ALT_TEXT_DESC'),
					'std'=>'This image for Image Layouts addon',
				),
				'image_strech'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_STREACH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_STREACH_DESC'),
					'std'=> 1,
					'depends'=> array(
						array('image_preset_thumb', '!=', 'collage'),
					),
				),
				'image_order_option'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_ORDER_OPTIONS'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
					),
					'std'=>'desktop',
					'values'=>array(
						array(
							'label' => 'Desktop',
							'value' => 'desktop'
						),
						array(
							'label' => 'Tablet',
							'value' => 'tablet'
						),
						array(
							'label' => 'Mobile',
							'value' => 'mobile'
						)
					),
				),
				'image_desktop_order'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_IMG_DESK_ORDER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_IMG_DESK_ORDER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
						array('image_order_option', '=', 'desktop'),
					),
					'values'=> array(
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
					'std'=>''
				),
				'image_tab_order'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_IMG_TAB_ORDER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_IMG_TAB_ORDER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
						array('image_order_option', '=', 'tablet'),
					),
					'values'=> array(
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
					'std'=>''
				),
				'image_mob_order'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_IMG_MOB_ORDER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_IMG_MOB_ORDER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
						array('image_order_option', '=', 'mobile'),
					),
					'values'=> array(
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
					'std'=>''
				),
				'open_in_lightbox'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OPEN_LIGHTBOX'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OPEN_LIGHTBOX_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
					),
					'std'=>0,
				),
				'image_overlay_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_DESC'),
					'std'=>'rgba(41, 14, 98, 0.5)',
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('open_in_lightbox', '!=', 0)
					),
				),
				'lightbox_icon_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_OVERLAY_LIGHTBOX_BG'),
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('open_in_lightbox', '!=', 0)
					),
					'std'=>'',
				),
				'click_url'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CLICK_URL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CLICK_URL_DESC'),
					'format'=>'attachment',
					'hide_preview'=>true,
					'std'=>'https://joomshaper.com',
				),
				'link_apear_in_title'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_TITLE_URL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_TITLE_URL_DESC'),
					'depends'=>array(
						array('image_preset_thumb', '=', 'poster'),
					),
					'std'=>1,
				),
				'url_in_new_window'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW_DESC'),
					'std'=>0,
				),
				'popup_video_on_image'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_VIDEO_POPUP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_VIDEO_POPUP_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'card'),
					),
					'std'=>0,
				),
				'popup_video_src'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_VIDEO_POPUP_SRC'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_VIDEO_POPUP_SRC_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'card'),
						array('popup_video_on_image', '=', 1),
					),
					'std'=>'https://www.youtube.com/watch?v=BWLRMBrKH_c',
				),
				//content for inline style
				'caption_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAP_SEPARATOR'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
					),
				),
				'caption_options'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAP_OPTIONS'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
					),
					'std'=>'caption',
					'values'=>array(
						array(
							'label' => 'Caption',
							'value' => 'caption'
						),
						array(
							'label' => 'Caption Style',
							'value' => 'cap_style'
						)
					),
				),

				'caption_text_separation'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAP_TEXT'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'caption'),
					),
				),
				'caption'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'caption'),
					),
					'std'=>'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.'
				),
				'caption_postion'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_POSI'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_POSI_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'caption'),
						array('caption', '!=', ''),
					),
					'values'=> array(
						'no-caption'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_NO'),
						'caption-below'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_BELOW'),
						'caption-overlay'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_OVERLAY'),
						'caption-overlay-on-over'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAPTION_OVERLAY_HOVER'),
					),
					'std'=>'caption-below'
				),

				//Caption style
				'caption_style_separation'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CAP_STYLE'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
				),
				'caption_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
				),
				'caption_background' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_DESC'),
					'std'=>'',
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
				),
				'caption_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-image-layout-caption { font-family: "{{ VALUE }}"; }'
					)
				),

				'caption_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
					'max'=> 400,
					'responsive' => true,
				),

				'caption_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
					'responsive' => true,
					'max'=> 400,
				),

				'caption_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
				),
				'caption_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'depends'=>array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
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
				'caption_padding' => array(
					'type' => 'padding',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'std'=>'',
					'depends'=> array(
						array('image_preset_thumb', '=', 'inline'),
						array('caption_options', '=', 'cap_style'),
					),
					'responsive' => true,
				),

				//Content For all
				'content_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONTENT_SEPARATOR'),
					'depends'=>array(
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'content_order_option'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_ORDER_OPTIONS'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
					),
					'std'=>'desktop',
					'values'=>array(
						array(
							'label' => 'Desktop',
							'value' => 'desktop'
						),
						array(
							'label' => 'Tablet',
							'value' => 'tablet'
						),
						array(
							'label' => 'Mobile',
							'value' => 'mobile'
						)
					),
				),
				'content_desktop_order'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_DESK_ORDER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_DESK_ORDER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
						array('content_order_option', '=', 'desktop'),
					),
					'values'=> array(
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
					'std'=>''
				),
				'content_tab_order'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_TAB_ORDER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_TAB_ORDER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
						array('content_order_option', '=', 'tablet'),
					),
					'values'=> array(
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
					'std'=>''
				),
				'content_mob_order'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_MOB_ORDER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_MOB_ORDER_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
						array('content_order_option', '=', 'mobile'),
					),
					'values'=> array(
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
					'std'=>''
				),
				
				'content_text_align'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_ALIGN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_TEXT_ALIGN_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'poster'),
					),
					'values'=>array(
						'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'responsive' => true,
					'std'=> 'left',
				),
				'content_vertical_align'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_VERT_ALIGN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONT_VERT_ALIGN_DESC'),
					'depends'=> array(
						array('image_preset_thumb', '=', 'collage'),
					),
					'values'=>array(
						'top'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
						'center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'bottom'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
					),
					'std'=> 'center',
				),
				'content_options'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_CONTENT_OPTIONS'),
					'depends'=>array(
						array('image_preset_thumb', '!=', 'inline'),
					),
					'std'=>'title',
					'values'=>array(
						array(
							'label' => 'Title',
							'value' => 'title'
						),
						array(
							'label' => 'Text Content',
							'value' => 'text_cont'
						),
						array(
							'label' => 'Button',
							'value' => 'button'
						)
					),
				),

				'title_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_OPTIONS'),
					'depends'=> array(
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'title'=>array(
					'type'=>'textarea',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'depends'=>array(
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'std'=> 'Introducing <br> <strong>IMAGE LAYOUTS ADDON</strong>'
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
						'div'=>'div',
						'span'=>'span',
						'p'=>'p',
					),
					'std'=>'h3',
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'title_background' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_DESC'),
					'std'=>'#fff',
					'depends'=> array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '=', 'overlap'),
					),
				),
				'title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-image-layout-title { font-family: "{{ VALUE }}"; }'
					)
				),

				'title_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
					'std'=>'',
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
					'max'=> 400,
				),

				'title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
					'std'=>'',
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'overlap'),
					),
					'responsive' => true,
					'max'=> 400,
				),
				'title_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'title_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
					),
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

				'title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10px',
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'overlap'),
					),
					'responsive' => true,
					'std'=>'0px 0px 15px 0px'
				),

				'title_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'placeholder'=>'10px',
					'depends'=>array(
						array('title', '!=', ''),
						array('content_options', '=', 'title'),
						array('image_preset_thumb', '!=', 'inline'),
						array('image_preset_thumb', '!=', 'overlap'),
					),
					'responsive' => true,
					'std'=>'0px 0px 0px 0px'
				),

				//Text Content
				'text_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_OPTIONS'),
					'depends'=> array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'text_content'=>array(
					'type'=>'editor',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_CONTENT'),
					'std'=>  'Non quam lacus suspendisse faucibus interdum posuere lorem ipsum. Ultricies integer quis auctor elit sed vulputate. Pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Consectetur purus ut faucibus pulvinar elementum integer. Nunc non blandit massa enim nec. Et tortor consequat id porta nibh venenatis.',
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'text_content_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'text_content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-addon-image-layout-content { font-family: "{{ VALUE }}"; }'
					)
				),

				'text_content_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
					'max'=> 400,
				),

				'text_content_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'max'=>400,
					'responsive'=>true,
					'std'=>'',
				),

				'text_content_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'text_content_letterspace'=>array(
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
					'std'=>'0px',
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),

				'text_content_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'placeholder'=>'10px',
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
					'std' => '',
				),
				
				'text_content_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'placeholder'=>'10px',
					'depends'=>array(
						array('content_options', '=', 'text_cont'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
					'std' => '',
				),

				//Button
				'button_options' => array(
					'type' => 'separator',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON_OPTIONS'),
					'depends'=> array(
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'btn_text' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
					'depends'=> array(
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'std' => 'Learn More',
				),
				'btn_font_family' => array(
					'type' => 'fonts',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.sppb-btn { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_font_style' => array(
					'type' => 'fontstyle',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),

				'btn_letterspace' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
					'values' => array(
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
					'std' => '0px',
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_url' => array(
					'type' => 'media',
					'format' => 'attachment',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
					'placeholder' => 'http://',
					'hide_preview' => true,
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_target' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
					'values' => array(
						'' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						'_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
					'depends' => array(array('btn_url', '!=', '')),
				),
				'btn_type' => array(
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
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_appearance' => array(
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
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_fontsize' => array(
					'type' => 'slider',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std' => array('md' => 16),
					'responsive' => true,
					'max' => 400,
					'depends' => array(
						array('btn_type', '=', 'custom'),
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
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
						array('btn_type', '=', 'custom'),
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_background_color' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
					'std' => '#EF6D00',
					'depends' => array(
						array('btn_appearance', '!=', 'gradient'),
						array('btn_type', '=', 'custom'),
						array('button_status', '=', 'normal'),
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_background_gradient' => array(
					'type' => 'gradient',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std' => array(
						"color" => "#B4EC51",
						"color2" => "#429321",
						"deg" => "45",
						"type" => "linear"
					),
					'depends' => array(
						array('btn_appearance', '=', 'gradient'),
						array('btn_type', '=', 'custom'),
						array('button_status', '=', 'normal'),
					)
				),
				'btn_color' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
					'std' => '#FFFFFF',
					'depends' => array(
						array('btn_type', '=', 'custom'),
						array('button_status', '=', 'normal'),
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'btn_background_color_hover' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
					'std' => '#de6906',
					'depends' => array(
						array('btn_appearance', '!=', 'gradient'),
						array('btn_type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					)
				),
				'btn_background_gradient_hover' => array(
					'type' => 'gradient',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std' => array(
						"color" => "#429321",
						"color2" => "#B4EC51",
						"deg" => "45",
						"type" => "linear"
					),
					'depends' => array(
						array('btn_appearance', '=', 'gradient'),
						array('btn_type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					)
				),
				'btn_color_hover' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
					'std' => '#FFFFFF',
					'depends' => array(
						array('btn_type', '=', 'custom'),
						array('button_status', '=', 'hover'),
					),
				),
				'button_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'placeholder'=>'10px 10px 10px 10px',
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
					'std' => '25px 0px 0px 0px',
				),
				'button_padding' => array(
					'type' => 'padding',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'std'=>'',
					'depends' => array(
						array('btn_type', '=', 'custom'),
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
					'std' => '8px 22px 10px 22px',
				),
				'btn_size' => array(
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
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'std'=>''
				),
				'btn_shape' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
					'values' => array(
						'rounded' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
						'square' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
						'round' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
					),
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					),
					'std'=>'square'
				),
				'btn_icon' => array(
					'type' => 'icon',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				'btn_icon_position' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
					'values' => array(
						'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std' => 'left',
					'depends'=>array(
						array('btn_text', '!=', ''),
						array('content_options', '=', 'button'),
						array('image_preset_thumb', '!=', 'inline'),
					)
				),
				
				'wrapper_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE_LAYOUT_WRAPPER_SEPARATOR'),
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'wrapper_color_type'=>array(
					'type'=>'buttons',
					'std'=>'color',
					'values'=>array(
						array(
							'label' => 'Background Color',
							'value' => 'color'
						),
						array(
							'label' => 'Background Gradient',
							'value' => 'gradient'
						)
					),
					'depends'=>array(
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'wrapper_background' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_DESC'),
					'std'=>'',
					'depends'=> array(
						array('image_preset_thumb', '!=', 'inline'),
						array('wrapper_color_type', '=', 'color'),
					),
				),
				'wrapper_gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'std'=> array(
						"color" => "rgba(38, 51, 159, 0.95)",
						"color2" => "rgba(61, 59, 136, 0.95)",
						"deg" => "225",
						"type" => "linear"
					),
					'depends'=>array(
						array('image_preset_thumb', '!=', 'inline'),
						array('wrapper_color_type', '=', 'gradient'),
					)
				),
				'wrapper_margin' => array(
					'type' => 'margin',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
					'std'=>'',
					'depends' => array(
						array('image_preset_thumb', '=', 'poster'),
					),
					'responsive' => true,
				),
				'wrapper_padding' => array(
					'type' => 'padding',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'std'=>'',
					'depends' => array(
						array('image_preset_thumb', '!=', 'inline'),
					),
					'responsive' => true,
				),
				'wrapper_border' => array(
					'type' => 'margin',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'depends' => array(
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'wrapper_border_color' => array(
					'type' => 'color',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends' => array(
						array('image_preset_thumb', '!=', 'inline'),
					),
				),
				'wrapper_border_radius' => array(
					'type' => 'slider',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'depends' => array(
						array('image_preset_thumb', '!=', 'inline'),
					),
					'max'=> 1000,
				),
				'wrapper_box_shadow'=>array(
					'type'=>'boxshadow',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOXSHADOW'),
					'depends'=>array(
						array('image_preset_thumb', '!=', 'inline'),
					),
					'std'=>'0 0 0 0 #fff',
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
