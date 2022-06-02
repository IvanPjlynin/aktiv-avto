<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_articles_scroller',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_SCROLLER'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_SCROLLER_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				'addon_style'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_STYLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_STYLE_DESC'),
					'values'=>array(
						'ticker'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TICKER'),
						'scroller'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER'),
						'carousel'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CAROUSEL'),
					),
					'std'=>'ticker',
				),

				'number_of_items'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARTICLES_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARTICLES_NUMBER_DESC'),
					'std'=>3,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
					),
				),
				'number_of_items_tab'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARTICLES_NUMBER_TAB'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARTICLES_NUMBER_TAB_DESC'),
					'std'=>2,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),
				'number_of_items_mobile'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARTICLES_NUMBER_MOB'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARTICLES_NUMBER_MOB_DESC'),
					'std'=>1,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),
				
				'move_slide'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_MOVE_ARTICLES'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_MOVE_ARTICLES_DESC'),
					'std'=>1,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'slide_speed'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_SPEED'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_SPEED_DESC'),
					'std'=>500,
				),

				'carousel_autoplay'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_AUTOPLAY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_JS_SLIDER_AUTOPLAY_DESC'),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),
				
				'carousel_touch'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ENABLE_DRAGGING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CAROUSEL_DRAG_DESC'),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),

				'carousel_arrow'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ENABLE_ARROW_CONTROLLERS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ENABLE_ARROW_CONTROLLERS_DESC'),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),

				'resource'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE_DESC'),
					'values'=>array(
						'article'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE_ARTICLE'),
						'k2'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_RESOURCE_K2'),
					),
					'std'=>'article',
				),
				
				'catid'=>array(
					'type'=>'category',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_CATID'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_CATID_DESC'),
					'depends'=>array('resource'=>'article'),
					'multiple'=>true,
				),
				
				'k2catid'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_K2_CATID'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_K2_CATID_DESC'),
					'depends'=>array('resource'=>'k2'),
					'values'=> SpPgaeBuilderBase::k2CatList(),
					'multiple'=>true,
				),
				
				'ordering'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_DESC'),
					'values'=>array(
						'latest'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_LATEST'),
						'oldest'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_OLDEST'),
						'hits'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_POPULAR'),
						'featured'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_ORDERING_FEATURED'),
					),
					'std'=>'latest',
				),
				
				'article_scroll_limit'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_LIMIT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_LIMIT_DESC'),
					'std'=>'12'
				),

				'image_bg'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_IMAGE_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_IMAGE_BG_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'separator_options'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_ADDON_OPTIONS')
				),

				'ticker_heading'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_DESC'),
					'std'=>'Breaking News',
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'ticker_heading_width'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_WIDTH_DESC'),
					'max'=>100,
					'std'=>'',
					'responsive' => true,
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					)
				),

				'ticker_heading_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONTSIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONTSIZE_DESC'),
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
					'max'=>200,
					'std'=>'',
				),

				'ticker_heading_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONT_WEIGHT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_FONT_WEIGHT_DESC'),
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
					'values'=>array(
						100=> 100,
						200=> 200,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						800=> 800,
						900=> 900,
					),
					'std'=>'',
				),

				'heading_date_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_HEADING_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_HEADING_FONT_FAMILY_DESC'),
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>' h2 { font-family: "{{ VALUE }}"; }'
					)
				),

				'show_shape'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SHAPE_DESC'),
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('addon_style', '!=', 'carousel'),
					),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>1,
				),

				'heading_letter_spacing'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LETTER_SPACING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LETTER_SPACING_DESC'),
					'std'=> '',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'heading_shape'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_SHAPE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HEADING_SHAPE_DESC'),
					'values'=>array(
						'arrow'=> JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_ARROW_SHAPE'),
						'slanted-left'=> JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SLANTED_L_SHAPE'),
						'slanted-right'=> JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_SLANTED_R_SHAPE')
					),
					'std'=>'arrow',
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('show_shape', '!=', 0),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'left_side_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_BG_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),

				'left_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_LEFT_TEXT_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),

				'overlap_date_text'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'overlap_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('overlap_date_text', '!=', 0),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'overlap_text_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_SIZE_DESC'),
					'max'=> 200,
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('overlap_date_text', '!=', 0),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'overlap_text_right'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_RIGHT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_OVERLAP_TEXT_RIGHT_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('overlap_date_text', '!=', 0),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'content_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_CONTENT_BG'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_CONTENT_BG_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),

				'right_title_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_SIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_SIZE_DESC'),
					'max'=>200,
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'content_title_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_HEADING_FONT_WEIGHT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_HEADING_FONT_WEIGHT_DESC'),
					'values'=>array(
						100=> 100,
						200=> 200,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						800=> 800,
						900=> 900,
					),
					'std'=>700,
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),

				'content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CONTENT_FONT_FAMILY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CONTENT_FONT_FAMILY_DESC'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>' h2 { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),
				'title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TITLE_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),

				'show_intro'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_SHOW_INTRO'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_SHOW_INTRO_DESC'),
					'std'=>1,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),

				'intro_limit'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_INTRO_LIMIT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLES_INTRO_LIMIT_DESC'),
					'std'=>100,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('show_intro', '!=', 0),
					)
				),

				'content_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_CONTENT_FONTSIZE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_CONTENT_FONTSIZE_DESC'),
					'max'=>200,
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'carousel'),
					),
				),

				'ticker_date_time'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_DATE_TIME'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_DATE_TIME_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'ticker_date_hour'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HOUR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_TICKER_HOUR_DESC'),
					'values'=>array(
						0=> JText::_('NO'),
						1=> JText::_('YES')
					),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_TEXT_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					),
				),

				'item_bottom_gap'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BOTTOM_GAP'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BOTTOM_GAP_DESC'),
					'max'=>200,
					'std'=>1,
					'depends'=>array(
						array('addon_style', '!=', 'ticker'),
						array('addon_style', '!=', 'carousel'),
					),
				),

				//Carousel Style
				'carousel_styles'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_STYLE_OPTION'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
					'std'=>'date',
					'values'=>array(
						array(
							'label' => 'Date',
							'value' => 'date'
						),
						array(
							'label' => 'Title',
							'value' => 'title'
						),
						array(
							'label' => 'Text',
							'value' => 'text'
						),
						array(
							'label' => 'Category',
							'value' => 'category'
						),
					),
				),
				'carousel_date_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'date'),
					),
				),
				'carousel_date_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'max'=>100,
					'std'=>'',
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'date'),
					),
				),
				'carousel_date_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-articles-carousel-meta-date { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'date'),
					),
				),
				'carousel_date_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'values'=>array(
						100=> 100,
						200=> 200,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						800=> 800,
						900=> 900,
					),
					'std'=>700,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'date'),
					),
				),

				//Carousel Title
				'carousel_title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'title'),
					),
				),
				'carousel_title_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'title'),
					),
					'max'=>100,
					'responsive'=> true,
				),
				'carousel_title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-articles-carousel-link { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'title'),
					),
				),
				'carousel_title_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'values'=>array(
						100=> 100,
						200=> 200,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						800=> 800,
						900=> 900,
					),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'title'),
					),
				),
				'carousel_title_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'title'),
					),
					'responsive'=> true,
				),

				//Carousel Text
				'carousel_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'text'),
					),
				),
				'carousel_text_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'max'=>100,
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'text'),
					),
					'responsive'=> true,
				),
				'carousel_text_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-articles-carousel-introtext { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'text'),
					),
				),
				'carousel_text_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'values'=>array(
						100=> 100,
						200=> 200,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						800=> 800,
						900=> 900,
					),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'text'),
					),
				),

				//Carousel category
				'carousel_category_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'category'),
					),
				),
				'carousel_category_font_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'category'),
					),
					'max'=>100,
					'responsive'=> true,
				),
				'carousel_category_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-articles-carousel-meta-category a { font-family: "{{ VALUE }}"; }'
					),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'category'),
					),
				),
				'carousel_category_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_WEIGHT'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'category'),
					),
					'values'=>array(
						100=> 100,
						200=> 200,
						300=> 300,
						400=> 400,
						500=> 500,
						600=> 600,
						700=> 700,
						800=> 800,
						900=> 900,
					),
				),
				'carousel_category_margin'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
						array('carousel_styles', '=', 'category'),
					),
					'responsive'=> true,
				),
				
				//Caousel Global
				'carousel_content_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_CAROUSEL_CONTENT_AREA_STYLE'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),
				'carousel_content_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_BG'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
				),
				'carousel_content_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_PADDING'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
					'responsive'=> true,
					'std'=>''
				),
				'carousel_content_align'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_ALIGN'),
					'depends'=>array(
						array('addon_style', '=', 'carousel'),
					),
					'values'=> array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
				),

				'border_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_SIZE_DESC'),
					'std'=>0,
				),

				'border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_COLOR_DESC'),
					'std'=>'',
				),

				'border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_RADIUS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_BORDER_RADIUS_DESC'),
					'std'=>0,
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('addon_style', '!=', 'carousel'),
					)
				),

				'arrow_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARROW_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_SCROLLER_ARROW_COLOR_DESC'),
					'std'=>'',
					'depends'=>array(
						array('addon_style', '!=', 'scroller'),
						array('addon_style', '!=', 'carousel'),
					),
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
	