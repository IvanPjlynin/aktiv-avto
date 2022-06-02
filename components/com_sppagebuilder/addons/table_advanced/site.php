<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonTable_advanced extends SppagebuilderAddons {

	public function render() {
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' '.$settings->class : '';
		$turn_off_heading = (isset($settings->turn_off_heading) && $settings->turn_off_heading) ? 1 : 0;
		$table_searchable = (isset($settings->table_searchable) && $settings->table_searchable) ? 1 : 0;
		$table_pagination = (isset($settings->table_pagination) && $settings->table_pagination) ? 1 : 0;
		$pagination_item = (isset($settings->pagination_item) && $settings->pagination_item) ? $settings->pagination_item : '';
		$pagination_position = (isset($settings->pagination_position) && $settings->pagination_position) ? ' '.$settings->pagination_position : ' left-pagi';
		$total_entries = (isset($settings->total_entries) && $settings->total_entries) ? 1 : 0;
		$total_entries_position = (isset($settings->total_entries_position) && $settings->total_entries_position) ? 1 : 0;
		$search_column_limit = (isset($settings->search_column_limit) && $settings->search_column_limit) ? $settings->search_column_limit : '';
		$table_sortable = (isset($settings->table_sortable) && $settings->table_sortable) ? $settings->table_sortable : '';
		$table_text_alignment = (isset($settings->table_text_alignment) && $settings->table_text_alignment) ? ' '.$settings->table_text_alignment : '';
		$turn_off_responsive = (isset($settings->turn_off_responsive) && $settings->turn_off_responsive) ? 1 : 0;

		//Output
		$output  = '<div class="sppb-addon sppb-addon-table' . $class . ''.$table_text_alignment.''.($turn_off_responsive ? ' sppb-addon-table-not-responsive' : '').'">';
		$output .= '<div class="sppb-addon-content">';
		if($table_searchable){
			$output .= '<div class="sppb-addon-table-search-wrap">';
				$output .= '<input type="text" placeholder="'.JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCH_PLACEHOLDER').'" class="sppb-form-control sppb-addon-table-search">';
				$output .= '<i class="fa fa-search" aria-hidden="true"></i>';
			$output .= '</div>';
		}
		$output .= '<table class="sppb-addon-table-main'.($turn_off_heading ? ' sppb-no-table-header' : '').'" '.($table_searchable ? 'data-searchable="true"' : 'data-searchable="false"').' '.($search_column_limit ? 'data-search-limit="'.$search_column_limit.'"' : '').' '.($table_sortable ? 'data-sortable="true"' : 'data-sortable="false"').' '.($table_pagination && $pagination_item ? 'data-pagination-item="'.$pagination_item.'"' : '').' data-responsive="'.($turn_off_responsive ? 'false' : 'true').'">';
			if(!$turn_off_heading){
			$output .= '<thead>';
				$output .= '<tr>';
					if(isset($settings->sp_table_advanced_item) && is_array($settings->sp_table_advanced_item)){
						foreach($settings->sp_table_advanced_item as $item_key => $item_value){
							$output .= '<th '.($table_sortable ? 'class="sppb-table-addon-sortable-data"' : '').' '.((isset($item_value->head_col_span) && $item_value->head_col_span) ? 'colspan="'.$item_value->head_col_span.'"' : '').'>'.(isset($item_value->content) ? $item_value->content : '').'</th>';
						}
					}
				$output .= '</tr>';
			$output .= '</thead>';
			}
			$output .= '<tbody>';
				if(isset($settings->table_advanced_item) && is_array($settings->table_advanced_item)){
					foreach($settings->table_advanced_item as $row_key => $row_value){
						$output .= '<tr>';
							if(isset($row_value->table_advanced_item) && is_array($row_value->table_advanced_item)){
								foreach($row_value->table_advanced_item as $data_key => $data_value){
									$output .= '<td '.((isset($data_value->row_span) && $data_value->row_span) ? 'rowspan="'.$data_value->row_span.'"' : '').' '.((isset($data_value->col_span) && $data_value->col_span) ? 'colspan="'.$data_value->col_span.'"' : '').''.(isset($data_value->td_inner_bg) && $data_value->td_inner_bg ? 'style="background:'.$data_value->td_inner_bg.';"' : '').'>'.(isset($data_value->content) ? $data_value->content : '').'</td>';
								}
							}
						$output .= '</tr>';
					}
				}
			$output .= '</tbody>';
		$output .= '</table>';
		
		if($table_pagination && $pagination_item){
			$output .= '<div class="sppb-addon-table-pagination-wrap'.($total_entries ? '' : $pagination_position).''.($total_entries && $total_entries_position ? ' sppb-total-entries-to-left' : '').'">';
			$output .= '<ul class="sppb-pagination"></ul>';
			if($total_entries){
				$output .= '<span class="sppb-table-total-reg"></span>';
			}
			$output .= '</div>';
		}

		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}

	public function css() {
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$css = '';
		// Header Style
		$turn_off_heading = (isset($settings->turn_off_heading) && $settings->turn_off_heading) ? 1 : 0;
		$header_style = '';
		$header_bg_options = (isset($settings->header_bg_options) && $settings->header_bg_options) ? $settings->header_bg_options : '';

		if($header_bg_options=='color_bg'){
			$header_style .= (isset($settings->header_bg_color) && $settings->header_bg_color) ? 'background: ' . $settings->header_bg_color . ';' : '';
		}
		$gradient_header_style = '';
		if($header_bg_options=='gradient_bg'){
			$header_gradient_bg = (isset($settings->header_gradient_bg) && $settings->header_gradient_bg) ? $settings->header_gradient_bg : '';

			$header_gradient_color1 = (isset($header_gradient_bg->color) && $header_gradient_bg->color) ? $header_gradient_bg->color : '';
			$header_gradient_color2 = (isset($header_gradient_bg->color2) && $header_gradient_bg->color2) ? $header_gradient_bg->color2 : '';
			$header_degree = (isset($header_gradient_bg->deg) && $header_gradient_bg->deg) ? $header_gradient_bg->deg : '45';
			$header_type = (isset($header_gradient_bg->type) && $header_gradient_bg->type) ? $header_gradient_bg->type : 'linear';
			$header_radialPos = (isset($header_gradient_bg->radialPos) && $header_gradient_bg->radialPos) ? $header_gradient_bg->radialPos : 'center center';
			$header_radial_angle1 = (isset($header_gradient_bg->pos) && $header_gradient_bg->pos) ? $header_gradient_bg->pos : '10';
			$header_radial_angle2 = (isset($header_gradient_bg->pos2) && $header_gradient_bg->pos2) ? $header_gradient_bg->pos2 : '100';

			if($header_type!=='radial'){
				$gradient_header_style .= 'background: -webkit-linear-gradient('.$header_degree.'deg, '.$header_gradient_color1.' '.$header_radial_angle1.'%, '.$header_gradient_color2.' '.$header_radial_angle2.'%) transparent;';
				$gradient_header_style .= 'background: linear-gradient('.$header_degree.'deg, '.$header_gradient_color1.' '.$header_radial_angle1.'%, '.$header_gradient_color2.' '.$header_radial_angle2.'%) transparent;';
			} else {
				$gradient_header_style .= 'background: -webkit-radial-gradient(at '.$header_radialPos.', '.$header_gradient_color1.' '.$header_radial_angle1.'%, '.$header_gradient_color2.' '.$header_radial_angle2.'%) transparent;';
				$gradient_header_style .= 'background: radial-gradient(at '.$header_radialPos.', '.$header_gradient_color1.' '.$header_radial_angle1.'%, '.$header_gradient_color2.' '.$header_radial_angle2.'%) transparent;';
			}
		}
		$header_style .= (isset($settings->header_padding) && trim($settings->header_padding)) ? 'padding: ' . $settings->header_padding . ';' : '';
		$header_style .= (isset($settings->header_border) && trim($settings->header_border)) ? 'border-width: ' . $settings->header_border . ';border-style:solid;' : '';
		$header_style .= (isset($settings->header_border_color) && $settings->header_border_color) ? 'border-color: ' . $settings->header_border_color . ';' : '';
		$header_style .= (isset($settings->header_color) && $settings->header_color) ? 'color: ' . $settings->header_color . ';' : '';
		
		if($header_style){
			if($turn_off_heading){
				$css .= $addon_id. ' .sppb-addon-table-main tbody tr:first-child td,';
			}
			$css .= $addon_id. ' .sppb-addon-table-main.bt tbody td:before,';
			$css .= $addon_id. ' .sppb-addon-table-main th {';
				$css .= $header_style;
			$css .= '}';
		}
		if($gradient_header_style){
			if($turn_off_heading){
				$css .= $addon_id. ' .sppb-addon-table-main tbody tr:first-child,';
			}
			$css .= $addon_id. ' .sppb-addon-table-main thead tr {';
				$css .= $gradient_header_style;
			$css .= '}';
		}

		// Sort Style
		$sort_style = '';
		$sort_border_style = '';
		$sort_border_style .= (isset($settings->sort_color) && $settings->sort_color) ? 'border-top-color: ' . $settings->sort_color . ';' : '';
		$sort_border_style .= (isset($settings->sort_color) && $settings->sort_color) ? 'border-bottom-color: ' . $settings->sort_color . ';' : '';
		$sort_style .= (isset($settings->sort_margin_right) && $settings->sort_margin_right != '') ? 'right: ' . $settings->sort_margin_right . 'px;' : '';
		if($sort_style){
			$css .= $addon_id. ' .sppb-table-addon-sortable {';
				$css .= $sort_style;
			$css .= '}';
		}
		if($sort_border_style){
			$css .= $addon_id. ' .sppb-table-addon-sortable:before,';
			$css .= $addon_id. ' .sppb-table-addon-sortable:after {';
				$css .= $sort_border_style;
			$css .= '}';
		}

		// TR & TD Style
		$tr_style = '';
		$tr_style .= (isset($settings->tr_bg_color) && $settings->tr_bg_color) ? 'background: ' . $settings->tr_bg_color . ';' : '';
		$tr_second_bg_color = (isset($settings->tr_second_bg_color) && $settings->tr_second_bg_color) ? 'background: ' . $settings->tr_second_bg_color . ';' : '';
		if($tr_style){
			$css .= $addon_id. ' .sppb-addon-table-main tbody tr {';
				$css .= $tr_style;
			$css .= '}';
		}
		if($tr_second_bg_color){
			$css .= $addon_id. ' .sppb-addon-table-main tbody tr:nth-child(even) {';
				$css .= $tr_second_bg_color;
			$css .= '}';
		}
		//TR hover options
		$tr_hover_style = '';
		$tr_hover_style .= (isset($settings->tr_hover_bg_color) && $settings->tr_hover_bg_color) ? 'background: ' . $settings->tr_hover_bg_color . ';' : '';
		if($tr_hover_style){
			$css .= $addon_id. ' .sppb-addon-table-main tbody tr:hover {';
				$css .= $tr_hover_style;
			$css .= '}';
		}

		$td_style = '';
		$td_style .= (isset($settings->td_bg_color) && $settings->td_bg_color) ? 'background: ' . $settings->td_bg_color . ';' : '';
		$td_style .= (isset($settings->td_padding) && trim($settings->td_padding)) ? 'padding: ' . $settings->td_padding . ';' : '';
		$td_style .= (isset($settings->td_border) && trim($settings->td_border)) ? 'border-width: ' . $settings->td_border . ';border-style:solid;' : '';
		$td_style .= (isset($settings->td_border_color) && $settings->td_border_color) ? 'border-color: ' . $settings->td_border_color . ';' : '';
		
		$td_second_bg_color = (isset($settings->td_second_bg_color) && $settings->td_second_bg_color) ? 'background: ' . $settings->td_second_bg_color . ';' : '';

		if($td_style){
			$css .= $addon_id. ' .sppb-addon-table-main tr td {';
				$css .= $td_style;
			$css .= '}';
		}
		if($td_second_bg_color){
			$css .= $addon_id. ' .sppb-addon-table-main tr td:nth-child(even) {';
				$css .= $td_second_bg_color;
			$css .= '}';
		}
		//Pagination
		$pagination_style = '';
		$pagination_style .= (isset($settings->pagi_bg_color) && $settings->pagi_bg_color) ? 'background: ' . $settings->pagi_bg_color . ';' : '';
		$pagination_style .= (isset($settings->pagi_color) && $settings->pagi_color) ? 'color: ' . $settings->pagi_color . ';' : '';
		$pagination_style .= (isset($settings->pagi_border_color) && $settings->pagi_border_color) ? 'border-color: ' . $settings->pagi_border_color . ';' : '';
		$pagination_style .= (isset($settings->pagi_border_width) && trim($settings->pagi_border_width)) ? 'border-width: ' . $settings->pagi_border_width . ';border-style:solid;' : '';
		$pagination_style .= (isset($settings->pagi_border_radius) && $settings->pagi_border_radius !='') ? 'border-radius: ' . $settings->pagi_border_radius . 'px;' : '';
		$pagination_style .= (isset($settings->pagi_margin) && $settings->pagi_margin) ? 'margin: ' . $settings->pagi_margin . 'px;' : '';
		$pagination_style .= (isset($settings->pagi_padding) && trim($settings->pagi_padding)) ? 'padding: ' . $settings->pagi_padding . ';' : '';
		
		if($pagination_style){
			$css .= $addon_id. ' .sppb-page-link {';
				$css .= $pagination_style;
			$css .= '}';
		}
		$pagi_margin = (isset($settings->pagi_margin) && $settings->pagi_margin) ? 'margin: -' . $settings->pagi_margin . 'px;' : '';
		if($pagi_margin){
			$css .= $addon_id. ' .sppb-addon-table-pagination-wrap .sppb-pagination {';
				$css .= $pagi_margin;
			$css .= '}';
		}

		$pagination_style_hover = '';
		$pagination_style_hover .= (isset($settings->pagi_hover_bg_color) && $settings->pagi_hover_bg_color) ? 'background: ' . $settings->pagi_hover_bg_color . ';' : '';
		$pagination_style_hover .= (isset($settings->pagi_hover_color) && $settings->pagi_hover_color) ? 'color: ' . $settings->pagi_hover_color . ';' : '';
		$pagination_style_hover .= (isset($settings->pagi_hover_border_color) && $settings->pagi_hover_border_color) ? 'border-color: ' . $settings->pagi_hover_border_color . ';' : '';
		if($pagination_style_hover){
			$css .= $addon_id. ' .sppb-page-item:not(.active) .sppb-page-link:hover {';
				$css .= $pagination_style_hover;
			$css .= '}';
		}

		$pagination_style_active = '';
		$pagination_style_active .= (isset($settings->pagi_active_bg_color) && $settings->pagi_active_bg_color) ? 'background: ' . $settings->pagi_active_bg_color . ';' : '';
		$pagination_style_active .= (isset($settings->pagi_active_color) && $settings->pagi_active_color) ? 'color: ' . $settings->pagi_active_color . ';' : '';
		$pagination_style_active .= (isset($settings->pagi_active_border_color) && $settings->pagi_active_border_color) ? 'border-color: ' . $settings->pagi_active_border_color . ';' : '';
		if($pagination_style_active){
			$css .= $addon_id. ' .sppb-page-item.active .sppb-page-link {';
				$css .= $pagination_style_active;
			$css .= '}';
		}
		//Total Entries Style
		$total_entries_style = '';
		$total_entries_style .= (isset($settings->total_entries_color) && $settings->total_entries_color) ? 'color: ' . $settings->total_entries_color . ';' : '';
		$total_entries_style .= (isset($settings->total_entries_fontsize) && $settings->total_entries_fontsize) ? 'font-size: ' . $settings->total_entries_fontsize . 'px;' : '';

		$total_entries_font_style = (isset($settings->total_entries_font_style) && $settings->total_entries_font_style) ? $settings->total_entries_font_style : '';
		if(isset($total_entries_font_style->underline) && $total_entries_font_style->underline){
			$total_entries_style .= 'text-decoration:underline;';
		}
		if(isset($total_entries_font_style->italic) && $total_entries_font_style->italic){
			$total_entries_style .= 'font-style:italic;';
		}
		if(isset($total_entries_font_style->uppercase) && $total_entries_font_style->uppercase){
			$total_entries_style .= 'text-transform:uppercase;';
		}
		if(isset($total_entries_font_style->weight) && $total_entries_font_style->weight){
			$total_entries_style .= 'font-weight:'.$total_entries_font_style->weight.';';
		}
		if($total_entries_style){
			$css .= $addon_id. ' .sppb-table-total-reg {';
				$css .= $total_entries_style;
			$css .= '}';
		}
		//Search Style
		$search_style = '';
		$search_style .= (isset($settings->search_bg_color) && $settings->search_bg_color) ? 'background: ' . $settings->search_bg_color . ';' : '';
		$search_style .= (isset($settings->search_text_color) && $settings->search_text_color) ? 'color: ' . $settings->search_text_color . ';' : '';
		$search_style .= (isset($settings->search_padding) && trim($settings->search_padding)) ? 'padding: ' . $settings->search_padding . ';' : '';
		$search_style .= (isset($settings->search_border_color) && $settings->search_border_color) ? 'border-color: ' . $settings->search_border_color . ';' : '';
		$search_style .= (isset($settings->search_border) && trim($settings->search_border)) ? 'border-width: ' . $settings->search_border . ';border-style:solid;' : '';

		$search_text_color = (isset($settings->search_text_color) && $settings->search_text_color) ? 'color: ' . $settings->search_text_color . ';' : '';

		if($search_style){
			$css .= $addon_id. ' .sppb-addon-table input[type="text"].sppb-addon-table-search {';
				$css .= $search_style;
			$css .= '}';
			
			$css .= $addon_id. ' .sppb-addon-table-search-wrap i,';
			$css .= $addon_id. ' .sppb-addon-table input[type="text"].sppb-addon-table-search::placeholder,';
			$css .= $addon_id. ' .sppb-addon-table input[type="text"].sppb-addon-table-search:focus {';
				$css .= $search_text_color;
			$css .= '}';
		}

		$search_margin_bottom = (isset($settings->search_margin_bottom) && $settings->search_margin_bottom) ? 'margin-bottom: ' . $settings->search_margin_bottom . 'px;' : '';
		$css .= $addon_id. ' .sppb-addon-table-search-wrap {';
			$css .= $search_margin_bottom;
		$css .= '}';

		//Responsive 
		//Tablet
		$td_style_sm = (isset($settings->td_padding_sm) && trim($settings->td_padding_sm)) ? 'padding: ' . $settings->td_padding_sm . ';' : '';
		$header_style_sm = (isset($settings->header_padding_sm) && trim($settings->header_padding_sm)) ? 'padding: ' . $settings->header_padding_sm . ';' : '';

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';
			if($td_style_sm){
				$css .= $addon_id. ' .sppb-addon-table-main tr td  {';
					$css .= $td_style_sm;
				$css .= '}';
			}
			if($header_style_sm){
				if($turn_off_heading){
					$css .= $addon_id. ' .sppb-addon-table-main tbody tr:first-child td,';
				}
				$css .= $addon_id. ' .sppb-addon-table-main.bt tbody td:before,';
				$css .= $addon_id. ' .sppb-addon-table-main th {';
					$css .= $header_style_sm;
				$css .= '}';
			}
		$css .= '}';
		//Mobile
		$td_style_xs = (isset($settings->td_padding_xs) && trim($settings->td_padding_xs)) ? 'padding: ' . $settings->td_padding_xs . ';' : '';
		$header_style_xs = (isset($settings->header_padding_xs) && trim($settings->header_padding_xs)) ? 'padding: ' . $settings->header_padding_xs . ';' : '';

		$css .= '@media (max-width: 767px) {';
			if($td_style_xs){
				$css .= $addon_id. ' .sppb-addon-table-main tr td  {';
					$css .= $td_style_xs;
				$css .= '}';
			}
			if($header_style_xs){
				if($turn_off_heading){
					$css .= $addon_id. ' .sppb-addon-table-main tbody tr:first-child td,';
				}
				$css .= $addon_id. ' .sppb-addon-table-main.bt tbody td:before,';
				$css .= $addon_id. ' .sppb-addon-table-main th {';
					$css .= $header_style_xs;
				$css .= '}';
			}
		$css .= '}';

		return $css;
	}

	public static function getTemplate()
	{
		$output = '
		<style type="text/css">
		<# if(data.turn_off_heading) { #>
			#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr:first-child td,
		<# } #>
		#sppb-addon-{{ data.id }} .sppb-addon-table-main.bt tbody td:before,
		#sppb-addon-{{ data.id }} .sppb-addon-table-main th {
			<# if(data.header_bg_options == "color_bg"){ #>
				background: {{data.header_bg_color}};
			<# }
			if(_.isObject(data.header_padding)) {
			#>
				padding: {{data.header_padding.md}};
			<# } else { #>
				padding: {{data.header_padding}};
			<# }
			if(_.trim(data.header_border)) {
			#>
				border-width: {{data.header_border}};
				border-style:solid;
			<# } #>
			border-color: {{data.header_border_color}};
			color: {{data.header_color}};
		}
		<# if(data.turn_off_heading) { #>
			#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr:first-child,
		<# } #>
		#sppb-addon-{{ data.id }} .sppb-addon-table-main thead tr {
			<# if(data.header_bg_options == "gradient_bg"){
				let header_gradient_bg = (!_.isEmpty(data.header_gradient_bg) && data.header_gradient_bg) ? data.header_gradient_bg : "";
				let header_gradient_color1 = (_.isObject(header_gradient_bg) && header_gradient_bg.color) ? header_gradient_bg.color : "";
				let header_gradient_color2 = (_.isObject(header_gradient_bg) && header_gradient_bg.color2) ? header_gradient_bg.color2 : "";
				let header_degree = (_.isObject(header_gradient_bg) && header_gradient_bg.deg) ? header_gradient_bg.deg : "45";
				let header_type = (_.isObject(header_gradient_bg) && header_gradient_bg.type) ? header_gradient_bg.type : "linear";
				let header_radialPos = (_.isObject(header_gradient_bg) && header_gradient_bg.radialPos) ? header_gradient_bg.radialPos : "center center";
				let header_radial_angle1 = (_.isObject(header_gradient_bg) && header_gradient_bg.pos) ? header_gradient_bg.pos : "10";
				let header_radial_angle2 = (_.isObject(header_gradient_bg) && header_gradient_bg.pos2) ? header_gradient_bg.pos2 : "100";
	
				if(header_type !== "radial"){
			#>
					background: -webkit-linear-gradient({{header_degree}}deg, {{header_gradient_color1}} {{header_radial_angle1}}%, {{header_gradient_color2}} {{header_radial_angle2}}%) transparent;
					background: linear-gradient({{header_degree}}deg, {{header_gradient_color1}} {{header_radial_angle1}}%, {{header_gradient_color2}} {{header_radial_angle2}}%) transparent;
				<# } else { #>
					background: -webkit-radial-gradient(at {{header_radialPos}}, {{header_gradient_color1}} {{header_radial_angle1}}%, {{header_gradient_color2}} {{header_radial_angle2}}%) transparent;
					background: radial-gradient(at {{header_radialPos}}, {{header_gradient_color1}} {{header_radial_angle1}}%, {{header_gradient_color2}} {{header_radial_angle2}}%) transparent;
				<# }
			} #>
		}

		#sppb-addon-{{ data.id }} .sppb-table-addon-sortable {
			right: {{data.sort_margin_right}}px;
		}

		#sppb-addon-{{ data.id }} .sppb-table-addon-sortable:before,
		#sppb-addon-{{ data.id }} .sppb-table-addon-sortable:after {
			border-top-color: {{data.sort_color}};
			border-bottom-color: {{data.sort_color}};
		}
	
		#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr {
			background: {{data.tr_bg_color}};
		}
		#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr:hover {
			background: {{data.tr_hover_bg_color}};
		}
		#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr:nth-child(even) {
			background: {{data.tr_second_bg_color}};
		}
		#sppb-addon-{{ data.id }} .sppb-addon-table-main tr td:nth-child(even) {
			background: {{data.td_second_bg_color}};
		}
		#sppb-addon-{{ data.id }} .sppb-addon-table-main tr td {
			<# if(_.trim(data.td_border)) { #>
				border-width: {{data.td_border}};
				border-style:solid;
			<# } #>
			border-color: {{data.td_border_color}};
			background: {{data.td_bg_color}};
			<# if(_.isObject(data.td_padding)){ #>
				padding: {{data.td_padding.md}};
			<# } else { #>
				padding: {{data.td_padding}};
			<# } #>
		}
		
		#sppb-addon-{{ data.id }} .sppb-page-link {
			background: {{data.pagi_bg_color}};
			color: {{data.pagi_color}};
			border-color: {{data.pagi_border_color}};
			border-width: {{data.pagi_border_width}};
			<# if(data.pagi_border_width) { #>
				border-style:solid;
			<# } #>
			border-radius:{{data.pagi_border_radius}}px;
			margin: {{data.pagi_margin}}px;
			<# if(_.trim(data.pagi_padding)) { #>
				padding: {{data.pagi_padding}};
			<# } #>
		}
		<# if(data.pagi_margin){ #>
			#sppb-addon-{{ data.id }} .sppb-addon-table-pagination-wrap .sppb-pagination {
				margin: -{{data.pagi_margin}}px;
			}
		<# } #>
		
		#sppb-addon-{{ data.id }} .sppb-page-item:not(.active) .sppb-page-link:hover {
			background: {{data.pagi_hover_bg_color}};
			color: {{data.pagi_hover_color}};
			border-color: {{data.pagi_hover_border_color}};
		}

		#sppb-addon-{{ data.id }} .sppb-page-item.active .sppb-page-link {
			color: {{data.pagi_active_color}};
			background: {{data.pagi_active_bg_color}};
			border-color: {{data.pagi_active_border_color}};
		}
		#sppb-addon-{{ data.id }} .sppb-addon-table input[type="text"].sppb-addon-table-search {
			background: {{data.search_bg_color}};
			color: {{data.search_text_color}};
			<# if(_.trim(data.search_padding)) { #>
				padding: {{data.search_padding}};
			<# } #>
			border-color: {{data.search_border_color}};
			border-width: {{data.search_border}};
			<# if(data.search_border) { #>
				border-style:solid;
			<# } #>
		}

		#sppb-addon-{{ data.id }} .sppb-addon-table-search-wrap {
			margin-bottom: {{data.search_margin_bottom}}px;
		}
		#sppb-addon-{{ data.id }} .sppb-addon-table-search-wrap i,
		#sppb-addon-{{ data.id }} .sppb-addon-table input[type="text"].sppb-addon-table-search::placeholder,
		#sppb-addon-{{ data.id }} .sppb-addon-table input[type="text"].sppb-addon-table-search:focus {
			color: {{data.search_text_color}};
		}

		#sppb-addon-{{ data.id }} .sppb-table-total-reg {
			color: {{data.total_entries_color}};
			font-size: {{data.total_entries_fontsize}}px;
			<# if(_.isObject(data.total_entries_font_style)) {
				if(data.total_entries_font_style.underline){
			#>
					text-decoration:underline;
				<# }
				if(data.total_entries_font_style.italic){
				#>
					font-style:italic;
				<# }
				if(data.total_entries_font_style.uppercase){
				#>
					text-transform:uppercase;
				<# }
				if(data.total_entries_font_style.weight){
				#>
					font-weight:{{data.total_entries_font_style.weight}};
				<# }
			} #>
		}

		@media (min-width: 768px) and (max-width: 991px) {
			#sppb-addon-{{ data.id }} .sppb-addon-table-main tr td  {
				<# if(_.isObject(data.td_padding)){ #>
					padding: {{data.td_padding.sm}};
				<# } #>
			}
			<# if(data.turn_off_heading) { #>
				#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr:first-child td,
			<# } #>
			#sppb-addon-{{ data.id }} .sppb-addon-table-main.bt tbody td:before,
			#sppb-addon-{{ data.id }} .sppb-addon-table-main th {
				<# if(_.isObject(data.header_padding)) { #>
					padding: {{data.header_padding.sm}};
				<# } #>
			}
		}
		@media (max-width: 767px) {
			#sppb-addon-{{ data.id }} .sppb-addon-table-main tr td  {
				<# if(_.isObject(data.td_padding)){ #>
					padding: {{data.td_padding.xs}};
				<# } #>
			}
			<# if(data.turn_off_heading) { #>
				#sppb-addon-{{ data.id }} .sppb-addon-table-main tbody tr:first-child td,
			<# } #>
			#sppb-addon-{{ data.id }} .sppb-addon-table-main.bt tbody td:before,
			#sppb-addon-{{ data.id }} .sppb-addon-table-main th {
				<# if(_.isObject(data.header_padding)) { #>
					padding: {{data.header_padding.xs}};
				<# } #>
			}
		}
		</style>

		<div class="sppb-addon sppb-addon-table {{data.class}} {{data.table_text_alignment}} {{(data.turn_off_responsive ? "sppb-addon-table-not-responsive" : "")}}">
		<div class="sppb-addon-content">
		<# if(data.table_searchable){ #>
			<div class="sppb-addon-table-search-wrap">
				<input type="text" placeholder="'.JText::_('COM_SPPAGEBUILDER_ADDON_TABLE_ADVANCED_SEARCH_PLACEHOLDER').'" class="sppb-form-control sppb-addon-table-search">
				<i class="fa fa-search"></i>
			</div>
		<# } #>
		<table class="sppb-addon-table-main {{data.turn_off_heading ? "sppb-no-table-header" : ""}}" {{{(data.table_searchable ? `data-searchable=true` : `data-searchable="false"`)}}} {{{(data.search_column_limit ? `data-search-limit="${data.search_column_limit}"` : "")}}} {{{(data.table_sortable ? `data-sortable="true"` : `data-sortable="false"`)}}}{{{(data.table_pagination && data.pagination_item ? `data-pagination-item="${data.pagination_item}"` : "")}}}>
			<# if(!data.turn_off_heading){ #>
			<thead>
				<tr>
					<# if(_.isArray(data.sp_table_advanced_item)){ #>
						<#
						_.each(data.sp_table_advanced_item, function(item_value){
						#>
							<th {{{(data.table_sortable ? `class="sppb-table-addon-sortable-data"` : "")}}} {{{(item_value.head_col_span ? `colspan="${item_value.head_col_span}"` : "")}}}>
							<# if(_.isArray(item_value.content)){
								let thItemContent = "";
								_.each(item_value.content, function(thContent){
									thItemContent += thContent;
								})
							#>
								{{{thItemContent}}}
							<# } else { #>
								{{{item_value.content}}}
							<# } #>
							</th>
						<# }) #>
					<# } #>
				</tr>
			</thead>
			<# } #>
			<tbody>
				<# if(_.isArray(data.table_advanced_item)){ #>
					<# _.each(data.table_advanced_item, function(row_value){ #>
						<tr>
							<# if(_.isArray(row_value.table_advanced_item)){ #>
								<#
								_.each(row_value.table_advanced_item, function(data_value){
								#>
									<td {{{(data_value.row_span ? `rowspan="${data_value.row_span}"` : "")}}}{{{(data_value.col_span ? `colspan="${data_value.col_span}"` : "")}}}{{{ data_value.td_inner_bg ? `style="background:${data_value.td_inner_bg};"` : ""}}}>
									<# if(_.isArray(data_value.content)){
										let tdItemContent = "";
										_.each(data_value.content, function(tdContent){
											tdItemContent += tdContent;
										})
									#>
										{{{tdItemContent}}}
									<# } else { #>
										{{{data_value.content}}}
									<# } #>
									</td>
								<# }) #>
							<# } #>
						</tr>
					<# }) #>
				<# } #>
			</tbody>
		</table>
		<# if(data.table_pagination && data.pagination_item){ #>
			<div class="sppb-addon-table-pagination-wrap {{data.total_entries ? "" : data.pagination_position}}{{data.total_entries && data.total_entries_position ? " sppb-total-entries-to-left" : ""}}">
			<ul class="sppb-pagination"></ul>
			<# if(data.total_entries){ #>
				<span class="sppb-table-total-reg"></span>
			<# } #>
			</div>
		<# } #>
		</div>
		</div>
		';
		return $output;
	}
}
