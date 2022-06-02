<?php
/**
* @package SP Page Builder
* @author JoomShaper https://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'repeatable',
		'addon_name'=>'js_slideshow',
		'category'=>'Slider',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DESC'),
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				// Slider Items
				'separator_item'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_OPT'),
				),

				'content_container_option'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTAINER_OPTION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTAINER_OPTION_DESC'),
					'values'=>array(
						'bootstrap'=>JText::_('Bootstrap'),
						'custom'=>JText::_('Custom'),
					),
					'std'=>'bootstrap',
				),

				'content_container_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_CONTAINER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_CONTAINER_DESC'),
					'std'=>array('md'=>75,'sm'=>75,'xs'=>75),
					'max'=>100,
					'responsive'=>true,
					'depends'=>array(
						array('content_container_option', '=', 'custom'),
					),
				),

				'content_vertical_alignment'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_CONTENT_VERTICAL_ALIGNMENT'),
					'std'=>1,
				),

				'slideshow_items'=>array(
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEMS'),
					'type'=>'repeatable',
					'std'=> array(
						array(
							'slider_img'=>array(
								'src'=>'https://sppagebuilder.com/addons/js_slideshow/slideshow-default-bg.jpg',
							),
							'content_alignment'=>'center',
							'slideshow_inner_items'=>array(
								array(
									'title_content_title'=>'THE AMAZING SLIDESHOW ADDON!',
									'content_type'=> 'title_content',
									'title_heading_selector'=> 'h2',
									'content_color'=>'#fff',
									'content_animation_type'=> 'slide',
									'animation_slide_direction'=>'top',
									'animation_duration'=> 800,
									'animation_delay'=> 1000,
									'animation_slide_from'=> 100,
									'animation_timing_function'=> 'ease',
								),
								array(
									'content_text'=>'<br>Want to make your website more attractive? Get a stunning hero <br>section with the Slideshow addon in SP Page Builder Pro. <br>It’s easy, fast, and gorgeous.<br><br>',
									'content_type'=> 'text_content',
									'content_color'=>'#fff',
									'content_fontsize'=>array(
										'md'=> 20,
										'sm'=> 16,
										'xs'=> 14,
									),
									'content_animation_type'=> 'slide',
									'animation_slide_direction'=>'top',
									'animation_duration'=> 800,
									'animation_delay'=> 1000,
									'animation_slide_from'=> 100,
									'animation_timing_function'=> 'ease',
								),
								array(
									'btn_content'=>'LEARN MORE',
									'content_type'=> 'btn_content',
									'content_color'=>'#fff',
									'content_animation_type'=> 'slide',
									'animation_slide_direction'=>'top',
									'animation_duration'=> 800,
									'animation_delay'=> 1000,
									'animation_slide_from'=> 100,
									'animation_timing_function'=> 'ease',
								),
							),
						),
						array(
							'slider_img'=>array(
								'src'=>'https://sppagebuilder.com/addons/js_slideshow/slideshow-default-bg.jpg',
							),
							'content_alignment'=>'center',
							'slideshow_inner_items'=>array(
								array(
									'title_content_title'=>'THE AMAZING SLIDESHOW ADDON!',
									'content_type'=> 'title_content',
									'title_heading_selector'=> 'h2',
									'content_color'=>'#fff',
									'content_animation_type'=> 'slide',
									'animation_slide_direction'=>'top',
									'animation_duration'=> 800,
									'animation_delay'=> 1000,
									'animation_slide_from'=> 100,
									'animation_timing_function'=> 'ease',
								),
								array(
									'content_text'=>'<br>Want to make your website more attractive? Get a stunning hero <br>section with the Slideshow addon in SP Page Builder Pro. <br>It’s easy, fast, and gorgeous.<br><br>',
									'content_type'=> 'text_content',
									'content_color'=>'#fff',
									'content_fontsize'=>array(
										'md'=> 20,
										'sm'=> 16,
										'xs'=> 14,
									),
									'content_animation_type'=> 'slide',
									'animation_slide_direction'=>'top',
									'animation_duration'=> 800,
									'animation_delay'=> 1000,
									'animation_slide_from'=> 100,
									'animation_timing_function'=> 'ease',
								),
								array(
									'btn_content'=>'LEARN MORE',
									'content_type'=> 'btn_content',
									'content_color'=>'#fff',
									'content_animation_type'=> 'slide',
									'animation_slide_direction'=>'top',
									'animation_duration'=> 800,
									'animation_delay'=> 1000,
									'animation_slide_from'=> 100,
									'animation_timing_function'=> 'ease',
								),
							),
						),
					),
					'attr'=>  array(
						//Admin label
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
							'std'=>'Item number 1',
						),
						'slider_bg_options'=>array(
							'type'=>'buttons',
							'std'=>'bg_image',
							'values'=>array(
								array(
									'label' => 'Image Background',
									'value' => 'bg_image'
								),
								array(
									'label' => 'Video Background',
									'value' => 'bg_video'
								),
							),
							'tabs' => true,
						),
						//Slider image
						'slider_img'=>array(
							'type'=>'media',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_BACKGROUND_IMAGE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_BACKGROUND_IMAGE_DESC'),
							'std'=>array(
								'src'=>'https://sppagebuilder.com/addons/js_slideshow/slideshow-default-bg.jpg',
							),
							'depends'=>array(
								array('slider_bg_options', '!=', 'bg_video'),
							),
						),
						'slider_video'=>array(
							'type'=>'media',
							'format'=>'video',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_BACKGROUND_VIDEO'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_BACKGROUND_VIDEO_DESC'),
							'depends'=>array(
								array('slider_bg_options', '!=', 'bg_image'),
								array('enable_youtube_vimeo', '!=', 1),
							),
							'std'=>array(
								'src'=>'',
							),
						),
						'enable_youtube_vimeo'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_YTUBE_VIMEO_VIDEO'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_YTUBE_VIMEO_VIDEO_DESC'),
							'depends'=>array(
								array('slider_bg_options', '!=', 'bg_image'),
							),
							'std'=>0,
						),
						'youtube_vimeo_url'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_YTUBE_VIMEO_VIDEO_SRC'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_YTUBE_VIMEO_VIDEO_SRC_DESC'),
							'depends'=>array(
								array('slider_bg_options', '!=', 'bg_image'),
								array('enable_youtube_vimeo', '!=', 0),
							),
						),
						'video_volume_btn'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_VOLUME_ICON'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_VOLUME_ICON_DESC'),
							'depends'=>array(
								array('slider_bg_options', '!=', 'bg_image'),
							),
							'std'=>0,
						),
						'slider_overlay_options'=>array(
							'type'=>'buttons',
							'std'=>'color_overlay',
							'values'=>array(
								array(
									'label' => 'Color Overlay',
									'value' => 'color_overlay'
								),
								array(
									'label' => 'Gradient Overlay',
									'value' => 'gradient_overaly'
								),
							),
							'tabs' => true,
						),
						'slider_bg_overlay'=>array(
							'type'=>'color',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_OVERLAY'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_OVERLAY_DESC'),
							'depends'=>array(
								array('slider_overlay_options', '=', 'color_overlay'),
							),
						),
						'slider_bg_gradient_overlay'=>array(
							'type'=>'gradient',
							'std'=> array(
								"color" => "#00ad75",
								"color2" => "#8700fc",
								"deg" => "45",
								"type" => "linear"
							),
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_GD_OVERLAY'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_GD_OVERLAY_DESC'),
							'depends'=>array(
								array('slider_overlay_options', '=', 'gradient_overaly'),
							),
						),
						//Slider Inner Item
						'slideshow_inner_items'=>array(
							'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTENTS'),
							'type'=>'repeatable',
							'attr'=>  array(
								//Admin label
								'title'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
									'std'=>'The Amazing Slideshow Addon!',
								),

								//Add content to tabs
								'content_tabs'=>array(
									'type'=>'buttons',
									'std'=>'content_type',
									'values'=>array(
										array(
											'label' => 'Content',
											'value' => 'content_type'
										),
										array(
											'label' => 'Animation',
											'value' => 'content_animation'
										),
										array(
											'label' => 'Style',
											'value' => 'content_style'
										),
									),
									'tabs' => true,
								),
								//Content Type
								'content_type_separator'=>array(
									'type'=>'separator',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTENT_TYPE_OPTION'),
									'depends'=>array(
										array('content_tabs', '=', 'content_type'),
									),
								),
								'content_type'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_CONTENT_TYPE'),
									'values'=>array(
										'title_content'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
										'text_content'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_CONTENT_TEXT'),
										'image_content'=>JText::_('COM_SPPAGEBUILDER_ADDON_IMAGE'),
										'btn_content'=>JText::_('COM_SPPAGEBUILDER_ADDON_BUTTON'),
										'icon_content'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_NAME'),
									),
									'std'=>'title_content',
									'depends'=>array(
										array('content_tabs', '=', 'content_type'),
									),
								),
								//Title Content
								'title_content_title'=>array(
									'type'=>'textarea',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_TITLE_CONTENT'),
									'std'=>'The Amazing Slideshow Addon!',
									'depends'=>array(
										array('content_type', '=', 'title_content'),
										array('content_tabs', '=', 'content_type'),
									),
								),
								'title_heading_selector'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
									'depends'=>array(
										array('content_type', '=', 'title_content'),
										array('content_tabs', '=', 'content_type'),
									),
									'values'=>array(
										'h1'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
										'h2'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
										'h3'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
										'h4'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
										'h5'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
										'h6'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
										'div'=>'div',
										'p'=>'p',
										'span'=>'span',
									),
									'std'=>'h2',
									'depends'=>array(
										array('title_content_title', '!=', ''),
										array('content_type', '=', 'title_content'),
										array('content_tabs', '=', 'content_type'),
									),
								),
								//Text Content
								'content_text'=>array(
									'type'=>'editor',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_CONTENT'),
									'std'=>'Lorem ipsum dolor sit amet, ne eam iusto sapientem persecuti, id noster volumus nec.',
									'depends'=>array(
										array('content_type', '=', 'text_content'),
										array('content_tabs', '=', 'content_type'),
									),
								),
								//Image Content
								'image_content'=>array(
									'type'=>'media',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_CONTENT'),
									'depends'=>array(
										array('content_type', '=', 'image_content'),
										array('content_tabs', '=', 'content_type'),
									),
									'std'=> array(
										'src' => '',
									)
								),
								
								//Icon Content
								'icon_content'=>array(
									'type'=>'icon',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_ICON_CONTENT'),
									'std'=>'fa-cogs',
									'depends'=>array(
										array('content_type', '=', 'icon_content'),
										array('content_tabs', '=', 'content_type'),
									),
								),

								//Button Content
								'btn_content'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_BTN_CONTENT'),
									'std'=>'Button Text',
									'depends'=>array(
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_type'),
									),
								),
								//Button Content
								'content_class'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CUSTOME_CLASS'),
									'depends'=>array(
										array('content_tabs', '=', 'content_type'),
									),
								),

								'button_url'=>array(
									'type'=>'media',
									'format'=>'attachment',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
									'placeholder'=>'http://',
									'hide_preview'=>true,
									'depends'=> array(
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_type'),
									),
									'std'=>'#'
								),
		
								'button_target'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
									'values'=>array(
										'same'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
										'_blank'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
									),
									'depends'=> array(
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_type'),
									),
									'std'=>'same',
								),

								'button_icon'=>array(
									'type'=>'icon',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
									'depends'=> array(
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_type'),
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
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_type'),
									),
									'std'=>'left'
								),

								'button_icon_margin'=>array(
									'type'=>'margin',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_ICON_MARGIN'),
									'depends'=> array(
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_type'),
									),
									'responsive'=>true,
									'std'=>''
								),

								//Animation options
								'animation_separator'=>array(
									'type'=>'separator',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTENT_ANIMATION_OPTION'),
									'depends'=>array(
										array('content_tabs', '=', 'content_animation'),
									),
								),
								'content_animation_type'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTENT_TYPE'),
									'values'=> array(
										'slide'=>'Slide',
										'rotate'=>'Rotate',
										'text-animate'=>'Text Animate',
										'zoom'=>'Zoom',
									),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_animation'),
									),
									'std'=>'slide'
								),

								//Animation type slide options
								'animation_slide_direction'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_SLIDE_DIRECTION'),
									'values'=> array(
										'top'=>'Top',
										'right'=>'Right',
										'bottom'=>'Bottom',
										'left'=>'Left',
									),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_animation_type', '!=', 'rotate'),
										array('content_animation_type', '!=', 'zoom'),
										array('content_tabs', '=', 'content_animation'),
									),
									'std'=>'bottom'
								),

								'animation_duration'=>array(
									'type'=>'number',
									'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_animation'),
									),
									'std'=>800,
								),

								'animation_delay'=>array(
									'type'=>'number',
									'title'=>JText::_('COM_SPPAGEBUILDER_ANIMATION_DELAY'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_animation'),
									),
									'std'=>1000,
								),

								'animation_slide_from'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_SLIDE_FROM'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_SLIDE_FROM_DESC'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_animation_type', '=', 'slide'),
										array('content_tabs', '=', 'content_animation'),
									),
									'min'=> -100,
									'max'=> 100,
									'std'=> '100',
								),

								//animation type rotate options
								'animation_rotate_from'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_ROTATE_FROM'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_ROTATE_FROM_DESC'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_animation_type', '=', 'rotate'),
										array('content_tabs', '=', 'content_animation'),
									),
									'max'=>360,
									'std'=>'360',
								),

								'animation_rotate_to'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_ROTATE_TO'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_ROTATE_TO_DESC'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_animation_type', '=', 'rotate'),
										array('content_tabs', '=', 'content_animation'),
									),
									'max'=>360,
									'std'=>'0',
								),
								
								'animation_timing_function'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_TIMINIG_FUNCTION'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_TIMINIG_FUNCTION_DESC'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_animation_type', '!=', 'width'),
										array('content_animation_type', '!=', 'zoom'),
										array('content_tabs', '=', 'content_animation'),
									),
									'values'=>array(
										'ease'=>'Ease',
										'ease-in'=>'Ease In',
										'ease-out'=>'Ease Out',
										'ease-in-out'=>'Ease In Out',
										'linear'=>'Linear',
										'cubic-bezier'=>'Cubic Bezier',
									),
									'std'=>'ease',
								),

								'animation_cubic_bezier_value'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_CUBIC_BEZIER'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_ANIMATION_CUBIC_BEZIER_DESC'),
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_animation_type', '!=', 'width'),
										array('content_animation_type', '!=', 'zoom'),
										array('content_tabs', '=', 'content_animation'),
										array('animation_timing_function', '=', 'cubic-bezier'),
									),
									'std'=>'0,0.46,0,0.63',
								),

								//Styleing options
								'content_separator'=>array(
									'type'=>'separator',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
									'depends'=>array(
										array('content_type', '!=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_color'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_COLOR'),
									'std'=>'#fff',
									'depends'=>array(
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_fontsize'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
									'max'=>150,
									'std'=>array('md'=>'','sm'=>'','xs'=>''),
									'responsive' => true,
									'depends'=>array(
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_lineheight'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
									'max'=>150,
									'std'=>array('md'=>'','sm'=>'','xs'=>''),
									'responsive' => true,
									'depends'=>array(
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_font_family'=>array(
									'type'=>'fonts',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
									'depends'=>array(
										array('content_type', '!=', 'icon_content'),
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
									'selector'=> array(
										'css' => '{ font-family: "{{ VALUE }}"; }',
										'type'=>'font',
										'font'=>'{{ VALUE }}',
									)
								),
								'content_font_style'=>array(
									'type'=>'fontstyle',
									'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
									'depends'=>array(
										array('content_type', '!=', 'icon_content'),
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_letterspacing'=>array(
									'type'=>'select',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
									'values'=>array(
										'-10px'=> '-10px',
										'-9px'=> '-9px',
										'-8px'=> '-8px',
										'-7px'=> '-7px',
										'-6px'=> '-6px',
										'-5px'=> '-5px',
										'-4px'=> '-4px',
										'-3px'=> '-3px',
										'-2px'=> '-2px',
										'-1px'=> '-1px',
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
										'10px'=> '10px',
										'custom'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM')
									),
									'std'=>'0px',
									'depends'=> array(
										array('content_type', '!=', 'icon_content'),
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									)
								),
								'custom_letterspacing'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM_LETTER_SPACING'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM_LETTER_SPACING_DESC'),
									'std'=>'',
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
										array('content_type', '!=', 'btn_content'),
										array('content_letterspacing', '=', 'custom'),
									),
								),
								'content_background'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
									'std'=>'',
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
										array('content_type', '!=', 'btn_content'),
									),
								),
								//Image style options
								'image_content_width'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_IMG_WIDTH'),
									'depends'=>array(
										array('content_type', '=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
									'max'=>2000,
									'responsive'=>true,
									'std'=>array('md'=>400,'sm'=>'','xs'=>''),
								),
								'image_content_height'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ITEM_IMG_HEIGHT'),
									'depends'=>array(
										array('content_type', '=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
									'max'=>2000,
									'responsive'=>true,
									'std'=>array('md'=>385,'sm'=>'','xs'=>''),
								),
								//End image style
								//Start Button Style
								'button_background_options'=>array(
									'type'=>'buttons',
									'title'=> JText::_('COM_SPPAGEBUILDER_JS_SLIDER_BTN_BG_OPTIONS'),
									'std'=>'color_bg',
									'values'=>array(
										array(
											'label' => 'Color Background',
											'value' => 'color_bg'
										),
										array(
											'label' => 'Gradient Background',
											'value' => 'color_gradient'
										),
									),
									'tabs' => true,
									'depends'=>array(
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
									)
								),

								'button_background_color'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
									'std' => '#444444',
									'depends'=> array(
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
										array('button_background_options', '=', 'color_bg'),
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
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
										array('button_background_options', '=', 'color_gradient'),
									)
								),//End Button Style

								'content_border'=>array(
									'type'=>'margin',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
									'std'=>'',
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_border_color'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
									'std'=>'',
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_border_radius'=>array(
									'type'=>'slider',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
									'std'=>'',
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_margin'=>array(
									'type'=>'margin',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
									'std'=>'',
									'responsive' => true,
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'content_padding'=>array(
									'type'=>'padding',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
									'std'=>'',
									'responsive' => true,
									'depends'=>array(
										array('content_type', '!=', ''),
										array('content_tabs', '=', 'content_style'),
									),
								),
								//Box or text shadow
								'content_text_shadow'=>array(
									'type'=>'boxshadow',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_SHADOW'),
									'config' => array(
										'spread' => false
									),
									'depends'=>array(
										array('content_type', '!=', 'image_content'),
										array('content_tabs', '=', 'content_style'),
									),
									'std'=>'0 0 0 #ffffff',
								),
								'btn_box_shadow'=>array(
									'type'=>'boxshadow',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BOXSHADOW'),
									'depends'=>array(
										array('content_type', '!=', 'text_content'),
										array('content_type', '!=', 'icon_content'),
										array('content_type', '!=', 'title_content'),
										array('content_tabs', '=', 'content_style'),
									),
									'std'=>'0 0 0 0 #ffffff',
								),
								//Button hover
								'btn_hover_separator'=>array(
									'type'=>'separator',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_HOVER_STYLE_OPTIONS'),
									'std'=>'',
									'responsive' => true,
									'depends'=>array(
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
									),
								),
								'button_hover_color'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
									'std' => '#fff',
									'depends'=> array(
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
									)
								),
								'button_background_color_hover'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
									'std' => '#222',
									'depends'=> array(
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
										array('button_background_options', '=', 'color_bg'),
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
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
										array('button_background_options', '=', 'color_gradient'),
									)
								),
								'button_hover_border_color'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_BTN_HOVER_BORDER_COLOR'),
									'std' => '#fff',
									'depends'=> array(
										array('btn_content', '!=', ''),
										array('content_type', '=', 'btn_content'),
										array('content_tabs', '=', 'content_style'),
									)
								),
							),//End Inner Item attr[array]
						),//End Inner Item
						//Start common content options
						'item_content_separator'=>array(
							'type'=>'separator',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTENT_GLOBAL_OPTIONS'),
						),
						'image_in_column'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_IN_COLUMN'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_IN_COLUMN_DESC'),
							'std'=>0,
						),
						'image_column_width'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_COLUMN_WIDTH'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_COLUMN_WIDTH_DESC'),
							'depends'=>array(
								array('image_in_column', '!=', 0),
							),
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
							'std'=>array('md'=>6, 'sm'=>6, 'xs'=>6),
							'responsive'=>true,
						),
						'image_column_reverse'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_COLUMN_REVERSE'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMAGE_COLUMN_REVERSE_DESC'),
							'std'=>0,
							'depends'=>array(
								array('image_in_column', '!=', 0),
							),
						),

						'image_content_alignment'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_IMG_CONTENT_ALIGNMENT'),
							'values'=>array(
								'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
								'center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
								'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
							),
							'std'=>'left',
							'depends'=>array(
								array('image_in_column', '!=', 0),
							),
						),

						'content_alignment'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_CONTENT_ALIGNMENT'),
							'values'=>array(
								'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
								'center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
								'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
							),
							'std'=>'center',
						),

						'icon_display_block'=>array(
							'type'=>'checkbox',
							'title'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_ICON_DISPLAY_BLOCK'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_JS_SLIDER_ICON_DISPLAY_BLOCK_DESC'),
							'std'=>0,
						),
					),
				),//End slider items
				'slideshow_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_GLOBAL_SETTINGS'),
				),
				//Slider options
				'slider_settings'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SETTINGS'),
					'std'=>'slider_global',
					'values'=>array(
						array(
							'label' => 'Slider Global Settings',
							'value' => 'slider_global'
						),
						array(
							'label' => 'Slider Controllers Settings',
							'value' => 'slider_controller'
						),
					),
					'tabs' => true,
				),

				//Global options
				'separator_global'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_GLOBAL_OPT'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'height'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_HEIGHT'),
					'values'=>array(
						'full'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_WIN_HEIGHT'),
						'custom'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CUS_HEIGHT'),
					),
					'std'=>'full',
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'custom_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'max'=>4000,
					'std'=>array('md'=>900, 'sm'=>600, 'xs'=>350),
					'responsive' => true,
					'depends'=>array(
						array('height', '!=', 'full'),
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'slider_animation'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ANIMATION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ANIMATION_DESC'),
					'values'=>array(
						'slide'=>'Slide',
						'stack'=>'Stack',
						'clip'=>'Clip',
						'bubble'=>'Bubble',
						'fade'=>'Fade',
						'3D'=>'3D',
					),
					'std'=> 'slide',
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'slide_vertically'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_VERTICALLY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_VERTICALLY_DESC'),
					'std'=> 0,
					'depends'=> array(
						array('slider_animation', '=', 'stack'),
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'three_d_rotate'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_3D_ROTATE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_3D_ROTATE_DESC'),
					'max'=> 90,
					'min'=> -90,
					'std'=> 15,
					'depends'=> array(
						array('slider_animation', '=', '3D'),
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'autoplay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_AUTOPLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_AUTOPLAY_DESC'),
					'std'=>0,
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),
				'pause_on_hover'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_PAUSE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_PAUSE_DESC'),
					'std'=>0,
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('autoplay', '=', 1),
					)
				),

				'interval'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_INTERVAL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_INTERVAL_DESC'),
					'std'=> 5,
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SPEED_DESC'),
					'std'=> 800,
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'timer'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_TIMER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_TIMER_DESC'),
					'std'=>1,
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'timer_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TIMER_BG_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('timer', '=', 1),
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'timer_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TIMER_COLOR'),
					'std'=>'',
					'depends'=> array(
						array('timer', '=', 1),
						array('slider_settings', '=', 'slider_global'),
					)
				),

				'timer_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TIMER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TIMER_WIDTH_DESC'),
					'depends'=> array(
						array('timer', '=', 1),
						array('slider_settings', '=', 'slider_global'),
					),
					'min'=>1,
					'max'=>100,
					'responsive'=>true,
					'step'=>.1,
					'std'=>array('md'=>''),
				),
				'timer_top_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TIMER_TOP_GAP'),
					'depends'=> array(
						array('timer', '=', 1),
						array('slider_settings', '=', 'slider_global'),
					),
					'min'=>0,
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>''),
				),
				'timer_left_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TIMER_LEFT_GAP'),
					'depends'=> array(
						array('timer', '=', 1),
						array('slider_settings', '=', 'slider_global'),
					),
					'min'=>0,
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>''),
				),

				'slide_counter'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_NUMBER_DESC'),
					'std'=>0,
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
					)
				),
				'slide_counter_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_COLOR'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					)
				),
				'slide_counter_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_FONTSIZE'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					),
					'min'=>5,
					'max'=>100,
					'responsive'=>true,
					'std'=>array('md'=>22),
				),
				'slide_counter_fontfamily'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_FONTFAMILY'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					)
				),
				'slide_counter_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_BG'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					)
				),
				'slide_counter_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_PADDING'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					),
					'responsive'=>true,
					'std'=>'0px 0px 0px 0px',
				),
				'slide_counter_gap_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_GAP_BOTTOM'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					),
					'min'=> 0,
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'20'),
				),
				'slide_counter_gap_left'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_NUMBER_GAP_LEFT'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_global'),
						array('slide_counter', '=', 1),
					),
					'min'=> 0,
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'20'),
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>'',
					'depends'=> array(
						array('slider_settings', '=', 'slider_global'),
					)
				),

				//Controllers
				'separator_controllers'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLER_OPT'),
					'depends'=> array(
						array('slider_settings', '=', 'slider_controller'),
					)
				),
				'controllers'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS'),
					'std'=>'dot',
					'values'=>array(
						array(
							'label' => 'Bullet/Line Controllers',
							'value' => 'dot'
						),
						array(
							'label' => 'Arrow Controllers',
							'value' => 'arrow'
						),
					),
					'tabs' => true,
					'depends'=> array(
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'dot_controllers'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_CONTROLLERS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_CONTROLLERS_DESC'),
					'std'=>1,
					'depends'=>array(
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'dot_controllers_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_STYLE_DESC'),
					'values'=>array(
						'dot'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_STYLE_DOT'),
						'line'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_STYLE_LINE'),
						'with_image'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_IMAGE_WITH'),
						'with_text'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_WITH_TEXT'),
					),
					'std'=>'dot',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'line_indecator'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_LINE_INDECATOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_LINE_INDECATOR_DESC'),
					'std'=>1,
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '=', 'line'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'dot_controllers_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_POSITION_DESC'),
					'values'=>array(
						'bottom_center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_BOTTOM_CENTER'),
						'bottom_left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_BOTTOM_LEFT'),
						'bottom_right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_BOTTOM_RIGHT'),
						'vertical_left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_VERTI_LEFT'),
						'vertical_right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_VERTI_RIGHT'),
					),
					'std'=>'bottom_center',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'dot_controllers_bottom_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_POSITION_FROM_BOTTOM'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers_position', '!=', 'vertical_left'),
						array('dot_controllers_position', '!=', 'vertical_right'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),
				'dot_controllers_left_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_POSITION_FROM_LEFT'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers_position', '!=', 'bottom_center'),
						array('dot_controllers_position', '!=', 'bottom_right'),
						array('dot_controllers_position', '!=', 'vertical_right'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),
				'dot_controllers_right_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_POSITION_FROM_RIGHT'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers_position', '!=', 'bottom_center'),
						array('dot_controllers_position', '!=', 'bottom_left'),
						array('dot_controllers_position', '!=', 'vertical_left'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),

				'dot_controller_style_option'=>array(
					'type'=>'buttons',
					'std'=>'dot_normal',
					'values'=>array(
						array(
							'label' => 'Bullet/Line Normal Style',
							'value' => 'dot_normal'
						),
						array(
							'label' => 'Bullet/Line Active Style',
							'value' => 'dot_active'
						),
					),
					'tabs' => true,
					'depends'=> array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '=', 'dot'),
					)
				),
				'dot_ctlr_style_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_STYLE_OPTION'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					)
				),
				
				'dot_ctlr_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					),
					'max'=>100,
					'std'=>'18',
				),

				'dot_ctlr_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					),
					'max'=>100,
					'std'=>'18',
				),
				'dot_ctlr_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					)
				),

				'dot_ctlr_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'std'=>'',
					'max'=>20,
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					)
				),

				'dot_ctlr_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					)
				),
				
				'dot_ctlr_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS_DESC'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					),
					'max'=>100,
					'std'=>'18',
				),

				'dot_ctlr_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'std'=>'',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_normal'),
					)
				),
				//dot/live hover
				'dot_ctlr_style_separator_hov'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_STYLE_OPTION_HOV'),
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_active'),
					)
				),
				'dot_ctlr_center_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_CENTER_BACKGROUND'),
					'std'=>'',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '!=', 'with_image'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_active'),
					)
				),
				'dot_ctlr_hover_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_ACTIVE_HEIGHT'),
					'std'=>'',
					'max'=>100,
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_active'),
					)
				),

				'dot_ctlr_hover_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_ACTIVE_WIDTH'),
					'std'=>'',
					'max'=>100,
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_active'),
					)
				),

				'dot_ctlr_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_DOT_ACTIVE_BORDER_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('dot_controllers', '!=', 0),
						array('dot_controllers_style', '!=', 'with_text'),
						array('controllers', '!=', 'arrow'),
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controller_style_option', '=', 'dot_active'),
					)
				),
				//Text thumbnail style
				'text_thumb_ctlr_wrap_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_WIDTH_DESC'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
					),
					'max'=> 100,
					'responsive'=> true,
				),
				'text_thumb_ctlr_wrap_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_BG'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
					),
				),
				'text_thumb_ctlr_wrap_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_PADDING'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
					),
					'responsive'=> true,
				),
				'text_thumb_ctlr_individual_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_ITEM_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_ITEM_WIDTH_DESC'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
					),
					'max'=> 500,
					'responsive'=> true,
				),

				'text_thumb_cont_style'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_TEXT_THUMB_CON_STYLE'),
					'std'=>'thumb_number',
					'values'=>array(
						array(
							'label' => 'Number Text',
							'value' => 'thumb_number'
						),
						array(
							'label' => 'Title Text',
							'value' => 'thumb_title'
						),
						array(
							'label' => 'Subtitle Text',
							'value' => 'thumb_subtitle'
						),
					),
					'tabs' => true,
					'depends'=> array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
					)
				),
				//Text thumb number style
				'text_thumb_number_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_number'),
					),
				),
				'text_thumb_number_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_number'),
					),
					'max'=> 100,
					'responsive'=> true,
				),
				'text_thumb_number_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_number'),
					),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.sp-slider-text-thumb-number { font-family: "{{ VALUE }}"; }'
					),
				),
				'text_thumb_number_font_weight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_number'),
					),
					'values'=> array(
						100 => 100,
						200 => 200,
						300 => 300,
						400 => 400,
						500 => 500,
						600 => 600,
						700 => 700,
						800 => 800,
						900 => 900,
					),
				),
				//Text thumb title style
				'text_thumb_title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_title'),
					),
				),
				'text_thumb_title_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_title'),
					),
					'max'=> 100,
					'responsive'=> true,
				),
				'text_thumb_title_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_title'),
					),
					'max'=> 100,
					'responsive'=> true,
				),
				'text_thumb_title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_title'),
					),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.sp-slider-dot-indecator-text.sp-dot-text-key-1 { font-family: "{{ VALUE }}"; }'
					),
				),
				'text_thumb_title_font_weight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_title'),
					),
					'values'=> array(
						100 => 100,
						200 => 200,
						300 => 300,
						400 => 400,
						500 => 500,
						600 => 600,
						700 => 700,
						800 => 800,
						900 => 900,
					),
				),
				//Text thumb subtitle style
				'text_thumb_subtitle_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_subtitle'),
					),
				),
				'text_thumb_subtitle_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_subtitle'),
					),
					'max'=> 100,
					'responsive'=> true,
				),
				'text_thumb_subtitle_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_subtitle'),
					),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.sp-slider-dot-indecator-text.sp-dot-text-key-2 { font-family: "{{ VALUE }}"; }'
					),
				),
				'text_thumb_subtitle_font_weight'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'depends'=>array(
						array('slider_settings', '=', 'slider_controller'),
						array('dot_controllers', '!=', 0),
						array('controllers', '!=', 'arrow'),
						array('dot_controllers_style', '=', 'with_text'),
						array('text_thumb_cont_style', '=', 'thumb_subtitle'),
					),
					'values'=> array(
						100 => 100,
						200 => 200,
						300 => 300,
						400 => 400,
						500 => 500,
						600 => 600,
						700 => 700,
						800 => 800,
						900 => 900,
					),
				),
				
				//Arrow controllers
				'arrow_controllers'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_ARROWS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_SHOW_ARROWS_DESC'),
					'std'=>1,
					'depends'=>array(
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'arrow_on_hover'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_ON_HOVER'),
					'std'=>0,
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'arrow_controllers_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_STYLE_DESC'),
					'values'=>array(
						'spread'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_STYLE_SPREAD'),
						'along'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_STYLE_ALONG_WITH'),
					),
					'std'=>'spread',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'arrow_controllers_content'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_CONTENT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_CONTENT_DESC'),
					'values'=>array(
						'text_only'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_CONTENT_TEXT'),
						'icon_only'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_CONTENT_ICON'),
						'long_arrow'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_LONG_ARROW'),
						'icon_with_text'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROWS_CONTENT_ICON_TEXT'),
					),
					'std'=>'icon_only',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'arrow_controllers_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION_DESC'),
					'values'=>array(
						'bottom_center'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_BOTTOM_CENTER'),
						'bottom_left'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_BOTTOM_LEFT'),
						'bottom_right'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_CONTROLLERS_BOTTOM_RIGHT'),
					),
					'std'=>'bottom_center',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_controllers_style', '!=', 'spread'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),
				'arrow_controllers_bottom_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION_FROM_BOTTOM'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_controllers_style', '!=', 'spread'),
						array('slider_settings', '=', 'slider_controller'),
						array('arrow_controllers_position', '!=', ''),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),
				'arrow_controllers_left_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION_FROM_LEFT'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_controllers_style', '!=', 'spread'),
						array('slider_settings', '=', 'slider_controller'),
						array('arrow_controllers_position', '=', 'bottom_left'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),
				'arrow_controllers_right_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION_FROM_RIGHT'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_controllers_style', '!=', 'spread'),
						array('slider_settings', '=', 'slider_controller'),
						array('arrow_controllers_position', '=', 'bottom_right'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),
				'arrow_spread_controllers_left_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION_FROM_LEFT'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_controllers_style', '=', 'spread'),
						array('slider_settings', '=', 'slider_controller'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),
				'arrow_spread_controllers_right_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_POSITION_FROM_RIGHT'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_controllers_style', '=', 'spread'),
						array('slider_settings', '=', 'slider_controller'),
					),
					'max'=>2500,
					'responsive'=>true,
					'std'=>array('md'=>'50'),
				),

				'arrow_style'=>array(
					'type'=>'buttons',
					'std'=>'arrow_normal',
					'values'=>array(
						array(
							'label' => 'Normal Arrow Style',
							'value' => 'arrow_normal'
						),
						array(
							'label' => 'Hover Arrow Style',
							'value' => 'arrow_hover'
						),
					),
					'tabs' => true,
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				//Arrow style
				'separator_arrow'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_style', '!=', 'arrow_hover'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'arrow_ctlr_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
					'max'=>300,
					'responsive'=>true,
					'std'=>array('md'=>''),
				),

				'arrow_ctlr_height'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
					'max'=>300,
					'responsive'=>true,
					'std'=>array('md'=>''),
				),

				'arrow_ctlr_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'arrow_ctlr_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
					'max'=>100,
					'responsive'=>true,
					'std'=>array('md'=>''),
				),

				'arrow_ctlr_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'arrow_ctlr_border_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'arrow_ctlr_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'arrow_ctlr_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_hover'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					),
					'std'=>'50',
					'max'=> 300,
				),

				//Arrow hover
				'separator_arrow_hover'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_ARROW_HOVER'),
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('controllers', '!=', 'dot'),
						array('arrow_style', '!=', 'arrow_normal'),
						array('slider_settings', '=', 'slider_controller'),
					),
				),

				'arrow_ctlr_hover_background'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_normal'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),

				'arrow_ctlr_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_normal'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),
				
				'arrow_ctlr_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
					'std'=>'',
					'depends'=>array(
						array('arrow_controllers', '!=', 0),
						array('arrow_style', '!=', 'arrow_normal'),
						array('controllers', '!=', 'dot'),
						array('slider_settings', '=', 'slider_controller'),
					)
				),
			),
		),
	)
);
