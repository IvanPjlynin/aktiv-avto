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
		'addon_name'=>'table_advanced',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DESC'),
		'category'=>'Content',
		'attr'=>array(
			'general' => array(

				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'table_options'=>array(
					'type'=>'buttons',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_OPTIONS'),
					'std'=>'table_contents',
					'values'=>array(
						array(
							'label' => 'Table Contents',
							'value' => 'table_contents'
						),
						array(
							'label' => 'Table Styles',
							'value' => 'table_styles'
						),
					),
					'tabs' => true,
				),

				// Repeatable Items
				'head_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_ITEM_HEAD_SEP'),
					'depends'=>array(
						array('table_options', '=', 'table_contents')
					),
				),
				'turn_off_heading'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TURNOFF_HEADER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TURNOFF_HEADER_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents')
					),
				),
				'sp_table_advanced_item'=>array(
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_HEAD'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
						array('turn_off_heading', '=', 0),
					),
					'std' => array(
						array(
							'content' => 'First Name',
						),
						array(
							'content' => 'Last Name',
						),
						array(
							'content' => 'Countries',
						),
						array(
							'content' => 'Capitals',
						),
					),
					'attr'=>array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
							'std'=> 'Column Header <th>'
						),
						'head_col_span'=>array(
							'type'=>'number',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA_COL_SPAN'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA_COL_SPAN_DESC'),
						),
						'content'=>array(
							'type'=>'builder',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TH_CONTENT'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TH_CONTENT_DESC'),
							'std'=> 'First Name'
						),
					),

				),

				'row_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_ITEM_ROW_SEP'),
					'depends'=>array(
						array('table_options', '=', 'table_contents')
					),
				),
				'table_advanced_item'=>array(
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_ROW'),
					'depends'=>array(
						array('table_options', '=', 'table_contents')
					),
					'std' => array(
						array(
							'table_advanced_item'=>array(
								array(
									'content' => 'Ronald',
								),
								array(
									'content' => 'Curiel',
								),
								array(
									'content' => 'USA',
								),
								array(
									'content' => 'Washington, D.C.',
								),
							)
						),
						array(
							'table_advanced_item'=>array(
								array(
									'content' => 'Roger',
								),
								array(
									'content' => 'Morison',
								),
								array(
									'content' => 'Sweden',
								),
								array(
									'content' => 'Stockholm',
								),
							)
						),
						array(
							'table_advanced_item'=>array(
								array(
									'content' => 'Luca',
								),
								array(
									'content' => 'Jane',
								),
								array(
									'content' => 'Russia',
								),
								array(
									'content' => 'Moscow',
								),
							)
						),
						array(
							'table_advanced_item'=>array(
								array(
									'content' => 'Marry',
								),
								array(
									'content' => 'Chan',
								),
								array(
									'content' => 'China',
								),
								array(
									'content' => 'Beijing',
								),
							)
						),
					),
					'attr'=>array(
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
							'std'=> 'Row Admin Label'
						),

						'table_advanced_item'=>array(
							'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA'),
							'type'=>'repeatable',
							'attr'=>array(
								'title'=>array(
									'type'=>'text',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
									'std'=> 'Column Data <td>'
								),
								'row_span'=>array(
									'type'=>'number',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA_ROW_SPAN'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA_ROW_SPAN_DESC'),
								),
								'col_span'=>array(
									'type'=>'number',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA_COL_SPAN'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_DATA_COL_SPAN_DESC'),
								),
								'content'=>array(
									'type'=>'builder',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TD_CONTENT'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TD_CONTENT_DESC'),
									'std'=> 'Jhon'
								),
								'td_inner_bg'=>array(
									'type'=>'color',
									'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TD_INNER_BG'),
									'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TD_INNER_BG_DESC'),
									'std'=> ''
								),
							),
		
						),
					),

				),

				'table_searchable'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCHABLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCHABLE_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents')
					),
					'std'=> 0,
				),
				'search_column_limit'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCH_LIMIT'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCH_LIMIT_DESC'),
					'depends'=>array(
						array('table_searchable', '!=', 0),
						array('table_options', '=', 'table_contents')
					),
					'std'=> '1,2,3'
				),
				'table_sortable'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SORTABLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SORTABLE_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
						array('turn_off_heading', '=', 0),
					),
					'std'=> 0,
				),
				'table_pagination'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
					),
					'std'=> 0,
				),
				'pagination_item'=>array(
					'type'=>'number',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_NUMBER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_NUMBER_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
						array('table_pagination', '=', 1),
					),
					'std'=> 10,
				),
				'total_entries'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TOTAL_ENTRY'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TOTAL_ENTRY_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
						array('table_pagination', '=', 1),
					),
					'std'=> 0,
				),
				'total_entries_position'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TOTAL_ENTRY_POSITION'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
						array('table_pagination', '=', 1),
						array('total_entries', '=', 1),
					),
					'std'=> 0,
				),
				'pagination_position'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_POSITION'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_POSITION_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
						array('table_pagination', '=', 1),
						array('total_entries', '=', 0),
					),
					'values'=> array(
						'left-pagi'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'center-pagi'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'right-pagi'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=> 'left-pagi',
				),
				'turn_off_responsive'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TURNOFF_RESPONSIVE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TURNOFF_RESPONSIVE_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_contents'),
					),
					'std'=> 0,
				),
				//style
				'table_text_alignment'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_ALIGN'),
					'depends'=>array(
						array('table_options', '=', 'table_styles')
					),
					'values'=>array(
						'sppb-text-left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
						'sppb-text-center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
						'sppb-text-right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std'=> 'sppb-text-left',
				),
				'header_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_HEADER_SEPARATOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('turn_off_heading', '=', 0),
					),
				),
				'first_tr_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_FIRST_TR_SEPARATOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('turn_off_heading', '=', 1),
					),
				),
				'header_bg_options'=>array(
					'type'=>'buttons',
					'std'=>'color_bg',
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
					),
					'values'=>array(
						array(
							'label' => 'Color Background',
							'value' => 'color_bg'
						),
						array(
							'label' => 'Gradient Background',
							'value' => 'gradient_bg'
						),
					),
					'tabs' => true,
				),
				'header_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('header_bg_options', '=', 'color_bg'),
					),
					'std'=> '#6c7ae0',
				),
				'header_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
					),
					'std'=> '#fff',
				),

				'header_gradient_bg'=>array(
					'type'=>'gradient',
					'std'=> array(
						"color" => "#00ad75",
						"color2" => "#8700fc",
						"deg" => "45",
						"type" => "linear"
					),
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
					'depends'=>array(
						array('header_bg_options', '=', 'gradient_bg'),
						array('table_options', '=', 'table_styles'),
					),
				),

				'header_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'depends'=>array(
						array('table_options', '=', 'table_styles')
					),
					'responsive' => true,
				),
				'header_border'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_styles')
					),
				),
				'header_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles')
					),
				),
				'sort_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SORT_SEPARATOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('turn_off_heading', '=', 0),
						array('table_sortable', '=', 1),
					),
				),
				'sort_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SORT_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('turn_off_heading', '=', 0),
						array('table_sortable', '=', 1),
					),
				),
				'sort_margin_right'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SORT_MARGIN_RIGHT'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('turn_off_heading', '=', 0),
						array('table_sortable', '=', 1),
					),
					'min'=> '0',
					'max'=> '200',
				),
				'td_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TD_SEPARATOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles')
					),
				),
				'tr_td_style_options'=>array(
					'type'=>'buttons',
					'std'=>'tr_style',
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
					),
					'values'=>array(
						array(
							'label' => 'Row(<tr>) Style',
							'value' => 'tr_style'
						),
						array(
							'label' => 'Data(<td>) Style',
							'value' => 'td_style'
						),
					),
					'tabs' => true,
				),
				'tr_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'tr_style'),
					),
				),
				'tr_second_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TR_SEC_BG'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'tr_style'),
					),
				),
				'tr_hover_options'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_ROW_HOVER'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'tr_style'),
					),
				),
				'tr_hover_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'tr_style'),
					),
				),
				'td_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'td_style'),
					),
				),
				'td_second_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_TD_SEC_BG'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'td_style'),
					),
				),
				'td_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'td_style'),
					),
					'responsive'=> true,
				),
				'td_border'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'td_style'),
					),
				),
				'td_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('tr_td_style_options', '=', 'td_style'),
					),
				),
				'pagination_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_SEPARATOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles')
					),
				),
				'pagi_style_options'=>array(
					'type'=>'buttons',
					'std'=>'pagi_normal',
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
					),
					'values'=>array(
						array(
							'label' => 'Pagination Normal',
							'value' => 'pagi_normal'
						),
						array(
							'label' => 'Pagination Hover',
							'value' => 'pagi_hover'
						),
						array(
							'label' => 'Pagination Active',
							'value' => 'pagi_active'
						),
					),
					'tabs' => true,
				),
				'pagi_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
				),
				'pagi_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
				),
				'pagi_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-page-link { font-family: "{{ VALUE }}"; }'
					)
				),
				'pagi_border_width'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH_DESC'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
				),
				'pagi_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
				),
				'pagi_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
					'min'=>0,
					'max'=> 200,
				),
				'pagi_margin'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_PAGI_MARGIN_DESC'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					),
					'min'=> 0,
					'max'=> 50,
				),
				'pagi_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_normal'),
					)
				),
				'pagi_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_hover'),
					),
				),
				'pagi_hover_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_hover'),
					),
				),
				'pagi_hover_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_hover'),
					),
				),
				'pagi_active_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_active'),
					),
				),
				'pagi_active_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_active'),
					),
				),
				'pagi_active_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('table_pagination', '=', 1),
						array('table_options', '=', 'table_styles'),
						array('pagi_style_options', '=', 'pagi_active'),
					),
				),
				'total_entries_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_ENTRY_SEPARATOR'),
					'depends'=>array(
						array('total_entries', '=', 1),
						array('table_options', '=', 'table_styles'),
					),
				),
				'total_entries_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
					'depends'=>array(
						array('total_entries', '=', 1),
						array('table_options', '=', 'table_styles'),
					),
				),
				'total_entries_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'depends'=>array(
						array('total_entries', '=', 1),
						array('table_options', '=', 'table_styles'),
					),
					'max'=>400,
				),
				'total_entries_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
					'depends'=>array(
						array('total_entries', '=', 1),
						array('table_options', '=', 'table_styles'),
					),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-table-total-reg { font-family: "{{ VALUE }}"; }'
					)
				),
				'total_entries_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
					'depends'=>array(
						array('total_entries', '=', 1),
						array('table_options', '=', 'table_styles'),
					),
				),
				'search_separator'=>array(
					'type'=>'separator',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCH_SEPARATOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
				),
				'search_bg_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
				),
				'search_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
				),
				'search_border'=>array(
					'type'=>'margin',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH_DESC'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
				),
				'search_border_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
				),
				'search_padding'=>array(
					'type'=>'padding',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
				),
				'search_margin_bottom'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_BOTTOM'),
					'depends'=>array(
						array('table_options', '=', 'table_styles'),
						array('table_searchable', '=', 1)
					),
					'min'=> 0,
					'max'=> 100,
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
