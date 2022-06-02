<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

//no direct accees
defined ('_JEXEC') or die ('resticted access');

class SppagebuilderAddonArticles_scroller extends SppagebuilderAddons{

	public function render(){
		$app = Factory::getApplication();
		if($app->isClient('administrator')) {
			return ''; // prevent from loading in the admin view
		}
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$number_of_items = (isset($settings->number_of_items)) ? $settings->number_of_items : 3;
		$move_slide = (isset($settings->move_slide)) ? $settings->move_slide : 1;
		$slide_speed = (isset($settings->slide_speed)) ? $settings->slide_speed : 500;
		$carousel_autoplay = (isset($settings->carousel_autoplay)) ? $settings->carousel_autoplay : 0;
		$carousel_touch = (isset($settings->carousel_touch)) ? $settings->carousel_touch : 0;
		$carousel_arrow = (isset($settings->carousel_arrow)) ? $settings->carousel_arrow : 0;
		$carousel_content_align = (isset($settings->carousel_content_align)) ? ' '.$settings->carousel_content_align : ' sppb-text-left';

		// Addon options
		$resource 		= (isset($settings->resource) && $settings->resource) ? $settings->resource : 'article';
		$catid 			= (isset($settings->catid) && $settings->catid) ? $settings->catid : '';
		$k2catid 		= (isset($settings->k2catid) && $settings->k2catid) ? $settings->k2catid : 0;
		$article_scroll_limit = (isset($settings->article_scroll_limit) && $settings->article_scroll_limit) ? $settings->article_scroll_limit : 12;
		$ordering 		= (isset($settings->ordering) && $settings->ordering) ? $settings->ordering : 'latest';
		$show_intro 	= (isset($settings->show_intro)) ? $settings->show_intro : 1;
		$intro_limit 	= (isset($settings->intro_limit)) ? $settings->intro_limit : 100;
		$addon_style 	= (isset($settings->addon_style)) ? $settings->addon_style : 'ticker';
		$ticker_heading = (isset($settings->ticker_heading)) ? $settings->ticker_heading : 'Breaking News';

		$show_shape		= (isset($settings->show_shape)) ? $settings->show_shape : 0;
		$show_shape_class = ($show_shape) ? 'shape-enabled-need-extra-padding' : '';
		$heading_shape 	= (isset($settings->heading_shape)) ? $settings->heading_shape : 'arrow';
		$ticker_date_time = (isset($settings->ticker_date_time)) ? $settings->ticker_date_time : 0;
		$ticker_date_hour = (isset($settings->ticker_date_hour)) ? $settings->ticker_date_hour : 0;

		$ticker_date_time_class = ($ticker_date_time) ? 'date-wrapper-class' : '';
		$ticker_date_hour_class = ($ticker_date_hour) ? 'hour-wrapper-class' : '';

		$image_bg = (isset($settings->image_bg)) ? $settings->image_bg : 0;
		$image_bg_class = ($image_bg) ? 'article-image-as-bg' : '';
		$overlap_date_text = (isset($settings->overlap_date_text)) ? $settings->overlap_date_text : 0;
		$overlap_date_text_class = ($overlap_date_text) ? 'date-text-overlay' : '';

		$output   = '';
		//include k2 helper
		$k2helper 			= JPATH_ROOT . '/components/com_sppagebuilder/helpers/k2.php';
		$article_helper = JPATH_ROOT . '/components/com_sppagebuilder/helpers/articles.php';
		$isk2installed  = self::isComponentInstalled('com_k2');

		if ($resource == 'k2') {
			if ($isk2installed == 0) {
				$output .= '<p class="alert alert-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_ERORR_K2_NOTINSTALLED') . '</p>';
				return $output;
			} elseif(!file_exists($k2helper)) {
				$output .= '<p class="alert alert-danger">' . JText::_('COM_SPPAGEBUILDER_ADDON_K2_HELPER_FILE_MISSING') . '</p>';
				return $output;
			} else {
				require_once $k2helper;
			}
			$items = SppagebuilderHelperK2::getItems($article_scroll_limit, $ordering, $k2catid);
		} else {
			require_once $article_helper;
			$items = SppagebuilderHelperArticles::getArticles($article_scroll_limit, $ordering, $catid);
		}

		if (!count($items)) {
			$output .= '<p class="alert alert-warning">' . JText::_('COM_SPPAGEBUILDER_ADDON_ARTICLE_NO_ITEMS_FOUND') . '</p>';
			return $output;
		}

		if (count((array) $items)) {
			$output  .= '<div class="sppb-addon sppb-addon-articles-'.$addon_style.' ' . $class . '">';

			$output .= '<div class="sppb-addon-content">';
				if($addon_style == 'scroller'){
					$output .= '<div class="sppb-article-scroller-wrap" data-articles="'.$number_of_items.'" data-move="'.$move_slide.'" data-speed="'.$slide_speed.'">';
					foreach ($items as $key => $item) {
						$intro_text = JHtmlString::truncate($item->introtext, $intro_limit, true, false);
						$intro_text = str_replace('...', '', $intro_text);
						$image = '';
						if ($resource == 'k2') {
							if(isset($item->image_medium) && $item->image_medium){
								$image = $item->image_medium;
							} elseif(isset($item->image_large) && $item->image_large){
								$image = $item->image_medium;
							}
						} else {
							$image = $item->image_thumbnail;
						}

						$bg_style = "";
						if($image_bg){
							$bg_style = 'style="background-image: url('. $image .');background-size: cover; background-position: center center;"';
						}
						$output .= '<div class="sppb-articles-scroller-content">';
						$output .= '<a href="'. $item->link .'" class="sppb-articles-scroller-link" itemprop="url">';

							$output .= '<div class="sppb-articles-scroller-date-left-date-container '.$image_bg_class .'" '.$bg_style.'>';
								$output .= '<div class="sppb-articles-scroller-date-left-date">';
									$output .= '<div class="sppb-articles-scroller-meta-date-left '.$overlap_date_text_class.'" itemprop="datePublished">';
									$output .='<span class="sppb-articles-scroller-day">' . Jhtml::_('date', $item->publish_up, 'd') . '</span>';
									$output .='<span class="sppb-articles-scroller-month">' . Jhtml::_('date', $item->publish_up, 'M') . '</span>';
									$output .= '</div>';
								$output .= '</div>';//.sppb-articles-scroller-date-left-date

								$output .= '<div class="sppb-articles-scroller-date-left-content">';
									$output .= '<div class="sppb-addon-articles-scroller-title">' . $item->title . '</div>';
									$output .= '<div class="sppb-articles-scroller-introtext">'. $intro_text .'...</div>';
								$output .= '</div>';//.sppb-articles-scroller-date-left-content
							$output .= '</div>';//.sppb-articles-scroller-date-left-date-container

						$output .= '</a>';
						$output .= '</div>';//.sppb-articles-scroller-content
					}
					$output .= '</div>';//.sppb-article-scroller-wrap
				} else if($addon_style == 'carousel') {
					$output .= '<div class="sppb-row">';
					$output .= '<div class="sppb-articles-carousel-wrap" data-articles="'.$number_of_items.'" data-speed="'.$slide_speed.'" data-autoplay="'.($carousel_autoplay ? 'true' : 'false').'" data-drag="'.($carousel_touch ? 'true' : 'false').'" data-arrow="'.($carousel_arrow ? 'true' : 'false').'">';
						foreach ($items as $key => $item) {
							$intro_text = JHtmlString::truncate($item->introtext, $intro_limit, true, false);
							$intro_text = str_replace('...', '', $intro_text);
							$image = '';
							if ($resource == 'k2') {
								if(isset($item->image_medium) && $item->image_medium){
									$image = $item->image_medium;
								} elseif(isset($item->image_large) && $item->image_large){
									$image = $item->image_medium;
								}
							} else {
								$image = $item->image_thumbnail;
							}

							$output .= '<div class="sppb-articles-carousel-column sppb-col-md-3">';

							$output .= '<div class="sppb-articles-carousel-img">';
								$output .= '<a href="'. $item->link .'" class="sppb-articles-carousel-img-link" itemprop="url">';
									$output .= '<img src="'.$image.'" alt="' . $item->title . '" />';
								$output .= '</a>';
							$output .= '</div>';//.sppb-articles-carousel-img

							$output .= '<div class="sppb-articles-carousel-content'.$carousel_content_align.'">';

							$output .= '<div class="sppb-articles-carousel-meta" itemprop="datePublished">';
								$output .= '<span class="sppb-articles-carousel-meta-date" itemprop="datePublished">' . Jhtml::_('date', $item->publish_up, 'DATE_FORMAT_LC3') . '</span>';
								// $author = ( $item->created_by_alias ?  $item->created_by_alias :  $item->username);
								// $output .= '<span class="sppb-articles-carousel-meta-author" itemprop="name">' . $author . '</span>';
							$output .= '</div>';//.sppb-articles-carousel-meta

							$output .= '<a href="'. $item->link .'" class="sppb-articles-carousel-link" itemprop="url">' . $item->title . '</a>';

							if($show_intro){
								$output .= '<div class="sppb-articles-carousel-introtext">'. $intro_text .'...</div>';
							}

							//Category
							if ($resource == 'k2') {
								$item->catUrl = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($item->catid.':'.urlencode($item->category_alias))));
							} else {
								$item->catUrl = JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug));
							}
							$output .= '<span class="sppb-articles-carousel-meta-category"><a href="'. $item->catUrl .'" itemprop="genre">' . $item->category . '</a></span>';

							$output .= '</div>';//.sppb-articles-carousel-content

							$output .= '</div>';//.sppb-articles-carousel-column
						}

					$output .= '</div>';//.sppb-row

					$output .= '</div>';//.sppb-article-scroller-wrap
				} else {
						$output .= '<div class="sppb-articles-ticker-wrap" data-speed="'.$slide_speed.'">';
							$output .= '<div class="sppb-articles-ticker-heading">';
							$output .= $ticker_heading;

							if($show_shape){
								if($heading_shape == 'slanted-left'){
									$output .= '<svg class="sppb-articles-ticker-shape-left" width="50" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" shape-rendering="geometricPrecision">';
									$output .= '<path d="M0 50h50L25 0H0z" fill="#E91E63"/>';
									$output .= '</svg>';
								} elseif ($heading_shape == 'slanted-right') {
									$output .= '<svg class="sppb-articles-ticker-shape-right" width="50" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" shape-rendering="geometricPrecision">';
									$output .= '<path d="M0 0h50L25 50H0z" fill="#E91E63"/>';
									$output .= '</svg>';
								} else {
									$output .= '<svg class="sppb-articles-ticker-shape-arrow" width="50" height="100%" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" shape-rendering="geometricPrecision">';
									$output .= '<path d="M0 0h25l25 25-25 25H0z" fill="#E91E63"/>';
									$output .= '</svg>';
								}
							}

							$output .= '</div>';//.sppb-articles-ticker-heading
							$output .= '<div class="sppb-articles-ticker">';
							$output .= '<div class="sppb-articles-ticker-content">';
								foreach ($items as $key => $item) {
									$output .= '<div class="sppb-articles-ticker-text '.$show_shape_class.'">';
									$output .= '<a href="'. $item->link .'">' . $item->title . '</a>';
									if($ticker_date_time || $ticker_date_hour){
										$output .= '<div class="ticker-date-time-content-wrap '.$ticker_date_time_class.' '. $ticker_date_hour_class.'">';
											$output .= '<div class="ticker-date-time">';
											if($ticker_date_time){
												$output .= '<span class="ticker-date">'. Jhtml::_('date', $item->publish_up, 'd M') . '</span>';
											}
											if($ticker_date_hour){
												$output .= '<span class="ticker-hour">'. Jhtml::_('date', $item->publish_up, 'h:i:s A') . '</span>';
											}
											$output .= '</div>';
										$output .= '</div>';
									}
									$output .= '</div>';//.sppb-articles-ticker-text
								}
							$output .= '</div>';//.sppb-articles-ticker-content
							$output .= '<div class="sppb-articles-ticker-controller">';
								$output .= '<span class="sppb-articles-ticker-left-control"></span>';
								$output .= '<span class="sppb-articles-ticker-right-control"></span>';
							$output .= '</div>';//.sppb-articles-ticker-controller
							$output .= '</div>';//.sppb-articles-ticker
						$output .= '</div>';//.sppb-articles-ticker-wrap
				}

			$output  .= '</div>';

			$output  .= '</div>';
		}

		return $output;
	}

	public function stylesheets() {
		$style_sheet = array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/jquery.bxslider.min.css');
        return $style_sheet;
	}

	public function css() {
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' .$this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';

		$left_side_bg = (isset($settings->left_side_bg) && $settings->left_side_bg) ? $settings->left_side_bg : '';

		$left_text_color = (isset($settings->left_text_color) && $settings->left_text_color) ? 'color:' .$settings->left_text_color. ';' : '';

		$content_bg = (isset($settings->content_bg) && $settings->content_bg) ? 'background-color:' .$settings->content_bg. ';' : '';
		$title_color = (isset($settings->title_color) && $settings->title_color) ? 'color:' .$settings->title_color. ';' : '';

		$text_color = (isset($settings->text_color) && $settings->text_color) ? 'color:' .$settings->text_color. ';' : '';

		$arrow_color = (isset($settings->arrow_color) && $settings->arrow_color) ? 'color:' .$settings->arrow_color. ';' : '';

		$ticker_heading_font_weight = (isset($settings->ticker_heading_font_weight) && $settings->ticker_heading_font_weight) ? 'font-weight:' .$settings->ticker_heading_font_weight. ';' : '';

		$content_title_font_weight = (isset($settings->content_title_font_weight) && $settings->content_title_font_weight) ? 'font-weight:' .$settings->content_title_font_weight. ';' : '';

		$border_size = (isset($settings->border_size) && $settings->border_size) ? 'border-width:' .$settings->border_size. 'px;' : '';
		$border_color = (isset($settings->border_color) && $settings->border_color) ? 'border-color:' .$settings->border_color. ';' : '';
		$border_radius = (isset($settings->border_radius) && $settings->border_radius) ? $settings->border_radius : 0;

		$image_bg = (isset($settings->image_bg) && $settings->image_bg) ? $settings->image_bg : 0;

		$overlap_text_color = (isset($settings->overlap_text_color) && $settings->overlap_text_color) ? 'color:' .$settings->overlap_text_color. ';' : '';
		$overlap_text_right = (isset($settings->overlap_text_right) && $settings->overlap_text_right) ? 'right:' . $settings->overlap_text_right. 'px;' : '';

		$heading_letter_spacing = (isset($settings->heading_letter_spacing) && $settings->heading_letter_spacing) ? 'letter-spacing:' . $settings->heading_letter_spacing. 'px;' : '';

		$ticker_heading_font = '';
		if (isset($settings->ticker_heading_fontsize) && $settings->ticker_heading_fontsize) {
			if(is_object($settings->ticker_heading_fontsize)){
				$ticker_heading_font .= 'font-size:' . $settings->ticker_heading_fontsize->md . 'px;';
			} else{
				$ticker_heading_font .= 'font-size:' . $settings->ticker_heading_fontsize . 'px;';
			}
		} else {
			$ticker_heading_font .= '';
		}

		$content_fontsize = '';
		if (isset($settings->content_fontsize) && $settings->content_fontsize) {
			if(is_object($settings->content_fontsize)){
				$content_fontsize .= 'font-size:' . $settings->content_fontsize->md . 'px;';
			} else{
				$content_fontsize .= 'font-size:' . $settings->content_fontsize . 'px;';
			}
		} else {
			$content_fontsize .= '';
		}

		$right_title_font_size = '';
		if (isset($settings->right_title_font_size) && $settings->right_title_font_size) {
			if(is_object($settings->right_title_font_size)){
				$right_title_font_size .= 'font-size:' . $settings->right_title_font_size->md . 'px;';
			} else{
				$right_title_font_size .= 'font-size:' . $settings->right_title_font_size . 'px;';
			}
		} else {
			$right_title_font_size .= '';
		}

		$overlap_text_font_size = '';
		if (isset($settings->overlap_text_font_size) && $settings->overlap_text_font_size) {
			if(is_object($settings->overlap_text_font_size)){
				$overlap_text_font_size .= 'font-size:' . $settings->overlap_text_font_size->md . 'px;';
			} else{
				$overlap_text_font_size .= 'font-size:' . $settings->overlap_text_font_size . 'px;';
			}
		} else {
			$overlap_text_font_size .= '';
		}

		$ticker_heading_width = '';
		if (isset($settings->ticker_heading_width) && $settings->ticker_heading_width) {
			if(is_object($settings->ticker_heading_width)){
				$ticker_heading_width = $settings->ticker_heading_width->md;
			} else{
				$ticker_heading_width = $settings->ticker_heading_width;
			}
		} else {
			$ticker_heading_width = '';
		}

		$ticker_heading_width_sm = '';
		if (isset($settings->ticker_heading_width) && $settings->ticker_heading_width) {
			if(is_object($settings->ticker_heading_width)){
				$ticker_heading_width_sm = $settings->ticker_heading_width->sm;
			} else{
				$ticker_heading_width_sm = $settings->ticker_heading_width_sm;
			}
		} else {
			$ticker_heading_width_sm = '';
		}
		$ticker_heading_width_xs = '';
		if (isset($settings->ticker_heading_width) && $settings->ticker_heading_width) {
			if(is_object($settings->ticker_heading_width)){
				$ticker_heading_width_xs = $settings->ticker_heading_width->xs;
			} else{
				$ticker_heading_width_xs = $settings->ticker_heading_width_xs;
			}
		} else {
			$ticker_heading_width_xs = '';
		}

		$item_bottom_gap = '';
		if (isset($settings->item_bottom_gap) && $settings->item_bottom_gap) {
			if(is_object($settings->item_bottom_gap)){
				$item_bottom_gap = $settings->item_bottom_gap->md;
			} else{
				$item_bottom_gap = $settings->item_bottom_gap;
			}
		} else {
			$item_bottom_gap = 1;
		}

		$heading_date_font_family = '';
		if(isset($settings->heading_date_font_family) && $settings->heading_date_font_family) {
			$font_path = new JLayoutFile('addon.css.fontfamily', $layout_path);
			$font_path->render(array('font'=>$settings->heading_date_font_family));
			$heading_date_font_family .= 'font-family: ' . $settings->heading_date_font_family . ';';
		}

		$content_font_family = '';
		if(isset($settings->content_font_family) && $settings->content_font_family) {
			$font_path = new JLayoutFile('addon.css.fontfamily', $layout_path);
			$font_path->render(array('font'=>$settings->content_font_family));
			$content_font_family .= 'font-family: ' . $settings->content_font_family . ';';
		}

		//Carousel Content style
		//Date
		$caoursel_date_style = '';
		$caoursel_date_style .= (isset($settings->carousel_date_color) && $settings->carousel_date_color) ? 'color:'.$settings->carousel_date_color.';' : '';
		$caoursel_date_style .= (isset($settings->carousel_date_font_size) && $settings->carousel_date_font_size) ? 'font-size:'.$settings->carousel_date_font_size.'px;' : '';
		$caoursel_date_style .= (isset($settings->carousel_date_font_weight) && $settings->carousel_date_font_weight) ? 'font-weight:'.$settings->carousel_date_font_weight.';' : '';
		//Title
		$caoursel_title_style = '';
		$caoursel_title_style_sm = '';
		$caoursel_title_style_xs = '';
		$caoursel_title_style .= (isset($settings->carousel_title_color) && $settings->carousel_title_color) ? 'color:'.$settings->carousel_title_color.';' : '';
		$caoursel_title_style .= (isset($settings->carousel_title_font_weight) && $settings->carousel_title_font_weight) ? 'font-weight:'.$settings->carousel_title_font_weight.';' : '';
		if(isset($settings->carousel_title_font_size) && $settings->carousel_title_font_size){
			if(is_object($settings->carousel_title_font_size)){
				$caoursel_title_style .= 'font-size:'.$settings->carousel_title_font_size->md.'px;';
			} else {
				$caoursel_title_style .= 'font-size:'.$settings->carousel_title_font_size.'px;';
			}
		}
		if(isset($settings->carousel_title_font_size) && $settings->carousel_title_font_size){
			if(is_object($settings->carousel_title_font_size)){
				$caoursel_title_style_sm .= 'font-size:'.$settings->carousel_title_font_size->sm.'px;';
			}
			if(isset($settings->carousel_title_font_size_sm)) {
				$caoursel_title_style_sm .= 'font-size:'.$settings->carousel_title_font_size_sm.'px;';
			}
		}
		if(isset($settings->carousel_title_font_size) && $settings->carousel_title_font_size){
			if(is_object($settings->carousel_title_font_size)){
				$caoursel_title_style_xs .= 'font-size:'.$settings->carousel_title_font_size->xs.'px;';
			}
			if(isset($settings->carousel_title_font_size_xs)) {
				$caoursel_title_style_xs .= 'font-size:'.$settings->carousel_title_font_size_xs.'px;';
			}
		}
		if(isset($settings->carousel_title_margin) && $settings->carousel_title_margin){
			if(is_object($settings->carousel_title_margin)){
				$caoursel_title_style .= 'margin:'.$settings->carousel_title_margin->md.';';
			} else {
				if(trim($settings->carousel_title_margin)){
					$caoursel_title_style .= 'margin:'.$settings->carousel_title_margin.';';
				}
			}
		}
		if(isset($settings->carousel_title_margin) && $settings->carousel_title_margin){
			if(is_object($settings->carousel_title_margin)){
				$caoursel_title_style_sm .= 'margin:'.$settings->carousel_title_margin->sm.';';
			}
			if(isset($settings->carousel_title_margin_sm)) {
				if(trim($settings->carousel_title_margin_sm)){
					$caoursel_title_style_sm .= 'margin:'.$settings->carousel_title_margin_sm.';';
				}
			}
		}
		if(isset($settings->carousel_title_margin) && $settings->carousel_title_margin){
			if(is_object($settings->carousel_title_margin)){
				$caoursel_title_style_xs .= 'margin:'.$settings->carousel_title_margin->xs.';';
			}
			if(isset($settings->carousel_title_margin_xs)) {
				if(trim($settings->carousel_title_margin_xs)){
					$caoursel_title_style_xs .= 'margin:'.$settings->carousel_title_margin_xs.';';
				}
			}
		}

		//Text
		$caoursel_text_style = '';
		$caoursel_text_style_sm = '';
		$caoursel_text_style_xs = '';
		$caoursel_text_style .= (isset($settings->carousel_text_color) && $settings->carousel_text_color) ? 'color:'.$settings->carousel_text_color.';' : '';
		$caoursel_text_style .= (isset($settings->carousel_text_font_weight) && $settings->carousel_text_font_weight) ? 'font-weight:'.$settings->carousel_text_font_weight.';' : '';
		if(isset($settings->carousel_text_font_size) && $settings->carousel_text_font_size){
			if(is_object($settings->carousel_text_font_size)){
				$caoursel_text_style .= 'font-size:'.$settings->carousel_text_font_size->md.'px;';
			} else {
				$caoursel_text_style .= 'font-size:'.$settings->carousel_text_font_size.'px;';
			}
		}
		if(isset($settings->carousel_text_font_size) && $settings->carousel_text_font_size){
			if(is_object($settings->carousel_text_font_size)){
				$caoursel_text_style_sm .= 'font-size:'.$settings->carousel_text_font_size->sm.'px;';
			}
			if(isset($settings->carousel_text_font_size_sm)) {
				$caoursel_text_style_sm .= 'font-size:'.$settings->carousel_text_font_size_sm.'px;';
			}
		}
		if(isset($settings->carousel_text_font_size) && $settings->carousel_text_font_size){
			if(is_object($settings->carousel_text_font_size)){
				$caoursel_text_style_xs .= 'font-size:'.$settings->carousel_text_font_size->xs.'px;';
			}
			if(isset($settings->carousel_text_font_size_xs)) {
				$caoursel_text_style_xs .= 'font-size:'.$settings->carousel_text_font_size_xs.'px;';
			}
		}

		//Category
		$caoursel_category_style = '';
		$caoursel_category_style_sm = '';
		$caoursel_category_style_xs = '';
		$caoursel_category_style .= (isset($settings->carousel_category_color) && $settings->carousel_category_color) ? 'color:'.$settings->carousel_category_color.';' : '';
		$caoursel_category_style .= (isset($settings->carousel_category_font_weight) && $settings->carousel_category_font_weight) ? 'font-weight:'.$settings->carousel_category_font_weight.';' : '';

		if(isset($settings->carousel_category_font_size) && $settings->carousel_category_font_size){
			if(is_object($settings->carousel_category_font_size)){
				$caoursel_category_style .= 'font-size:'.$settings->carousel_category_font_size->md.'px;';
			} else {
				$caoursel_category_style .= 'font-size:'.$settings->carousel_category_font_size.'px;';
			}
		}
		if(isset($settings->carousel_category_font_size) && $settings->carousel_category_font_size){
			if(is_object($settings->carousel_category_font_size)){
				$caoursel_category_style_sm .= 'font-size:'.$settings->carousel_category_font_size->sm.'px;';
			}
			if(isset($settings->carousel_category_font_size_sm)) {
				$caoursel_category_style_sm .= 'font-size:'.$settings->carousel_category_font_size_sm.'px;';
			}
		}
		if(isset($settings->carousel_category_font_size) && $settings->carousel_category_font_size){
			if(is_object($settings->carousel_category_font_size)){
				$caoursel_category_style_xs .= 'font-size:'.$settings->carousel_category_font_size->xs.'px;';
			}
			if(isset($settings->carousel_category_font_size_xs)) {
				$caoursel_category_style_xs .= 'font-size:'.$settings->carousel_category_font_size_xs.'px;';
			}
		}
		if(isset($settings->carousel_category_margin) && $settings->carousel_category_margin){
			if(is_object($settings->carousel_category_margin)){
				$caoursel_category_style .= 'margin:'.$settings->carousel_category_margin->md.';';
			} else {
				$caoursel_category_style .= 'margin:'.$settings->carousel_category_margin.';';
			}
		}
		if(isset($settings->carousel_category_margin) && $settings->carousel_category_margin){
			if(is_object($settings->carousel_category_margin)){
				$caoursel_category_style_sm .= 'margin:'.$settings->carousel_category_margin->sm.';';
			}
			if(isset($settings->carousel_category_margin_sm)) {
				$caoursel_category_style_sm .= 'margin:'.$settings->carousel_category_margin_sm.';';
			}
		}
		if(isset($settings->carousel_category_margin) && $settings->carousel_category_margin){
			if(is_object($settings->carousel_category_margin)){
				$caoursel_category_style_xs .= 'margin:'.$settings->carousel_category_margin->xs.';';
			}
			if(isset($settings->carousel_category_margin_xs)) {
				$caoursel_category_style_xs .= 'margin:'.$settings->carousel_category_margin_xs.';';
			}
		}

		//Area
		$caoursel_area_style = '';
		$caoursel_area_style_sm = '';
		$caoursel_area_style_xs = '';
		$caoursel_area_style .= (isset($settings->carousel_content_bg) && $settings->carousel_content_bg) ? 'background:'.$settings->carousel_content_bg.';' : '';
		$caoursel_area_style .= (isset($settings->border_size) && $settings->border_size) ? 'border-width:'.$settings->border_size.'px;border-style: solid;' : '';
		$caoursel_area_style .= (isset($settings->border_color) && $settings->border_color) ? 'border-color:'.$settings->border_color.';' : '';

		if(isset($settings->carousel_content_padding) && $settings->carousel_content_padding){
			if(is_object($settings->carousel_content_padding)){
				$caoursel_area_style .= 'padding:'.$settings->carousel_content_padding->md.';';
			} else {
				$caoursel_area_style .= 'padding:'.$settings->carousel_content_padding.';';
			}
		}
		if(isset($settings->carousel_content_padding) && $settings->carousel_content_padding){
			if(is_object($settings->carousel_content_padding)){
				$caoursel_area_style_sm .= 'padding:'.$settings->carousel_content_padding->sm.';';
			}
			if(isset($settings->carousel_content_padding_sm)) {
				$caoursel_area_style_sm .= 'padding:'.$settings->carousel_content_padding_sm.';';
			}
		}
		if(isset($settings->carousel_content_padding) && $settings->carousel_content_padding){
			if(is_object($settings->carousel_content_padding)){
				$caoursel_area_style_xs .= 'padding:'.$settings->carousel_content_padding->xs.';';
			}
			if(isset($settings->carousel_content_padding_xs)) {
				$caoursel_area_style_xs .= 'padding:'.$settings->carousel_content_padding_xs.';';
			}
		}


		//Start Css output
		$css = '';

		if($ticker_heading_font || $ticker_heading_font_weight){
			$css .= $addon_id . ' .sppb-articles-scroller-meta-date-left span.sppb-articles-scroller-day,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
				if($ticker_heading_font ){
					$css .= $ticker_heading_font;
				}
				if($ticker_heading_font_weight){
					$css .= $ticker_heading_font_weight;
				}
			$css .= '}';
		}

		if($content_fontsize){
			$css .= $addon_id . ' .sppb-articles-scroller-introtext,';
			$css .= $addon_id . ' .sppb-articles-ticker-text a {';
			$css .= $content_fontsize;
			$css .= '}';
		}

		if($right_title_font_size || $content_title_font_weight){
			$css .= $addon_id . ' .sppb-addon-articles-scroller-title{';
				if($right_title_font_size){
					$css .= $right_title_font_size;
				}
				if($content_title_font_weight){
					$css .= $content_title_font_weight;
				}
			$css .= '}';
		}

		if($heading_date_font_family){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= $heading_date_font_family;
			$css .= '}';
		}

		if($content_font_family){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
			$css .= $addon_id . ' .sppb-articles-ticker-text {';
			$css .= $content_font_family;
			$css .= '}';
		}

		if($ticker_heading_width){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= '-ms-flex: 0 0 '.$ticker_heading_width.'%;';
			$css .= 'flex: 0 0 '.$ticker_heading_width.'%;';
			$css .= '}';

			$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
			$css .= $addon_id . ' .sppb-articles-ticker {';
			$css .= '-ms-flex: 0 0 '.(100-$ticker_heading_width).'%;';
			$css .= 'flex: 0 0 '.(100-$ticker_heading_width).'%;';
			$css .= '}';
		}

		if($border_radius){
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= 'border-top-left-radius: '. $border_radius . 'px;';
			$css .= 'border-bottom-left-radius: '. $border_radius . 'px;';
			$css .= '}';
		}

		if($border_size || $border_color || $border_radius){
			$css .= $addon_id . ' .sppb-articles-ticker {';
				if($border_size){
					$css .= $border_size . 'border-style: solid; border-left: 0;';
				}
				if($border_color){
					$css .= $border_color;
				}
				if($border_radius){
					$css .= 'border-top-right-radius: '. $border_radius . 'px;';
					$css .= 'border-bottom-right-radius: '. $border_radius . 'px;';
				}
			$css .= '}';
		}

		if($border_size || $border_color){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date-container {';
			if($border_size || $border_color){
				$css .= $border_size . 'border-style: solid; border-left: 0;';
				if($border_color){
					$css .= $border_color;
				}
			}
			$css .= '}';
		}

		if($item_bottom_gap){
			$css .= $addon_id . ' .sppb-articles-scroller-content a {';
				$css .= 'padding-bottom:'.$item_bottom_gap.'px;';
			$css .= '}';
		}

		if($left_side_bg || $left_text_color){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
			$css .= $addon_id . ' .sppb-articles-ticker-heading {';
			$css .= 'background-color:'.$left_side_bg.';';
			$css .= $left_text_color;
			$css .= '}';
		}

		if($left_side_bg || $left_text_color){
			$css .= $addon_id . ' .ticker-date-time {';
				if($left_side_bg){
					$css .= 'background:'.$left_side_bg.';';
				}
				if($left_text_color){
					$css .= $left_text_color;
				}
			$css .= '}';
		}

		if($left_text_color){
			$css .= $addon_id . ' .sppb-articles-scroller-meta-date-left span {';
			$css .= $left_text_color;
			$css .= '}';
		}

		if($overlap_text_color || $overlap_text_right || $overlap_text_font_size){
			$css .= $addon_id . ' .date-text-overlay .sppb-articles-scroller-month {';
			$css .= $overlap_text_color;
			if($overlap_text_right){
				$css .= $overlap_text_right;
			}
			if($overlap_text_font_size){
				$css .= $overlap_text_font_size;
			}
			$css .= '}';
		}

		if($content_bg){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
			$css .= $addon_id . ' .sppb-articles-ticker,';
			$css .= $addon_id . ' .sppb-articles-ticker-ticker-modern-content {';
			$css .= $content_bg;
			$css .= '}';
		}

		if($title_color){
			$css .= $addon_id . ' .sppb-addon-articles-scroller-title,';
			$css .= $addon_id . ' .sppb-articles-ticker-text a,';
			$css .= $addon_id . ' .sppb-articles-ticker-ticker-modern-content a {';
			$css .= $title_color;
			$css .= '}';
		}

		if($text_color){
			$css .= $addon_id . ' .sppb-articles-scroller-introtext,';
			$css .= $addon_id . ' .sppb-articles-ticker-modern-text {';
			$css .= $text_color;
			$css .= '}';
		}

		if($left_side_bg){
			$css .= $addon_id . ' .sppb-articles-ticker-heading svg path {';
			$css .= 'fill:'.$left_side_bg.';';
			$css .= '}';
		}

		if($arrow_color){
			$css .= $addon_id . ' .sppb-articles-ticker-left-control,';
			$css .= $addon_id . ' .sppb-articles-ticker-right-control{';
			$css .= $arrow_color;
			$css .= '}';

			$css .= $addon_id . ' .sppb-articles-ticker-left-control a,';
			$css .= $addon_id . ' .sppb-articles-ticker-right-control a{';
			$css .= $arrow_color;
			$css .= '}';
		}

		if($image_bg){
			$css .= $addon_id . ' .sppb-articles-scroller-date-left-date-container > div{';
				$css .= 'background: transparent;position: relative;';
			$css .= '}';
		}

		if($heading_letter_spacing){
			$css .= $addon_id . ' .sppb-articles-scroller-meta-date-left .sppb-articles-scroller-day {';
			$css .= $heading_letter_spacing;
			$css .= '}';
		}
		if($caoursel_date_style){
			$css .= $addon_id . ' .sppb-articles-carousel-meta-date {';
			$css .= $caoursel_date_style;
			$css .= '}';
		}
		if($caoursel_title_style){
			$css .= $addon_id . ' .sppb-articles-carousel-link {';
			$css .= $caoursel_title_style;
			$css .= '}';
		}
		if($caoursel_text_style){
			$css .= $addon_id . ' .sppb-articles-carousel-introtext {';
			$css .= $caoursel_text_style;
			$css .= '}';
		}
		if($caoursel_category_style){
			$css .= $addon_id . ' .sppb-articles-carousel-meta-category a {';
			$css .= $caoursel_category_style;
			$css .= '}';
		}
		if($caoursel_area_style){
			$css .= $addon_id . ' .sppb-articles-carousel-content {';
			$css .= $caoursel_area_style;
			$css .= '}';
		}

		$css .= '@media only screen and (max-width: 991px) {';
			if($ticker_heading_width_sm){
				$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
				$css .= $addon_id . ' .sppb-articles-ticker-heading {';
				$css .= '-ms-flex: 0 0 '.$ticker_heading_width_sm.'%;';
				$css .= 'flex: 0 0 '.$ticker_heading_width_sm.'%;';
				$css .= '}';

				$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
				$css .= $addon_id . ' .sppb-articles-ticker {';
				$css .= '-ms-flex: 0 0 '.(100-$ticker_heading_width_sm).'%;';
				$css .= 'flex: 0 0 '.(100-$ticker_heading_width_sm).'%;';
				$css .= '}';
			}
			if($caoursel_title_style_sm){
				$css .= $addon_id . ' .sppb-articles-carousel-link {';
				$css .= $caoursel_title_style_sm;
				$css .= '}';
			}
			if($caoursel_text_style_sm){
				$css .= $addon_id . ' .sppb-articles-carousel-introtext {';
				$css .= $caoursel_text_style_sm;
				$css .= '}';
			}
			if($caoursel_category_style_sm){
				$css .= $addon_id . ' .sppb-articles-carousel-meta-category a {';
				$css .= $caoursel_category_style_sm;
				$css .= '}';
			}
			if($caoursel_area_style_sm){
				$css .= $addon_id . ' .sppb-articles-carousel-content {';
				$css .= $caoursel_area_style_sm;
				$css .= '}';
			}
		$css .= '}';

		$css .= '@media only screen and (max-width: 767px) {';
			if($ticker_heading_width_xs){
				$css .= $addon_id . ' .sppb-articles-scroller-date-left-date,';
				$css .= $addon_id . ' .sppb-articles-ticker-heading {';
				$css .= '-ms-flex: 0 0 '.$ticker_heading_width_xs.'%;';
				$css .= 'flex: 0 0 '.$ticker_heading_width_xs.'%;';
				$css .= '}';

				$css .= $addon_id . ' .sppb-articles-scroller-date-left-content,';
				$css .= $addon_id . ' .sppb-articles-ticker {';
				$css .= '-ms-flex: 0 0 '.(100-$ticker_heading_width_xs).'%;';
				$css .= 'flex: 0 0 '.(100-$ticker_heading_width_xs).'%;';
				$css .= '}';
			}
			if($caoursel_title_style_xs){
				$css .= $addon_id . ' .sppb-articles-carousel-link {';
				$css .= $caoursel_title_style_xs;
				$css .= '}';
			}
			if($caoursel_text_style_xs){
				$css .= $addon_id . ' .sppb-articles-carousel-introtext {';
				$css .= $caoursel_text_style_xs;
				$css .= '}';
			}
			if($caoursel_category_style_xs){
				$css .= $addon_id . ' .sppb-articles-carousel-meta-category a {';
				$css .= $caoursel_category_style_xs;
				$css .= '}';
			}
			if($caoursel_area_style_xs){
				$css .= $addon_id . ' .sppb-articles-carousel-content {';
				$css .= $caoursel_area_style_xs;
				$css .= '}';
			}
		$css .= '}';

		return $css;
	}

	public function scripts()
	{
		HTMLHelper::_('script', 'components/com_sppagebuilder/assets/js/jquery.bxslider.min.js', [], ['defer' => true]);
	}

	/**
	 * Load JS function
	 *
	 * @return void
	 */
	public function js()
	{
		$settings = $this->addon->settings;
		$addon_id = '#sppb-addon-' .$this->addon->id;
		$slide_speed = (isset($settings->slide_speed) && $settings->slide_speed) ? $settings->slide_speed : 500;
		$addon_style = (isset($settings->addon_style)) ? $settings->addon_style : 'ticker';
		$number_of_items = (isset($settings->number_of_items)) ? $settings->number_of_items : 3;
		$number_of_items_tab = (isset($settings->number_of_items_tab)) ? $settings->number_of_items_tab : 2;
		$number_of_items_mobile = (isset($settings->number_of_items_mobile)) ? $settings->number_of_items_mobile : 1;
		$move_slide = (isset($settings->move_slide)) ? $settings->move_slide : 1;
		$carousel_autoplay = (isset($settings->carousel_autoplay)) ? $settings->carousel_autoplay : 0;
		$carousel_touch = (isset($settings->carousel_touch)) ? $settings->carousel_touch : 0;
		$carousel_arrow = (isset($settings->carousel_arrow)) ? $settings->carousel_arrow : 0;

		if ($addon_style == 'ticker') {
			return '
				jQuery(function(){
					"use strict";
					jQuery("'.$addon_id.' .sppb-articles-ticker-content").bxSlider({
						minSlides: 1,
						maxSlides: 1,
						mode: "vertical",
						speed: '.$slide_speed.',
						pager: false,
						prevText: "<i aria-hidden=\'true\' class=\'fa fa-angle-left\'></i>",
						nextText: "<i aria-hidden=\'true\' class=\'fa fa-angle-right\'></i>",
						nextSelector: "'.$addon_id.' .sppb-articles-ticker-right-control",
						prevSelector: "'.$addon_id.' .sppb-articles-ticker-left-control",
						auto: true,
						adaptiveHeight:true,
						autoHover: true,
						touchEnabled:false,
						autoStart:true,
					});
				});
			';
		} else if($addon_style == 'carousel'){
			return '
				jQuery(function(){
					jQuery("body").on("mousedown", ".bx-viewport a", function() {
						if(jQuery(this).attr("href") && jQuery(this).attr("href") != "#") {
							window.location = jQuery(this).attr("href");
						}
					});
				});
				jQuery(function () {
					"use strict";
					var widthMatch = jQuery(window).width();
					if(widthMatch < 481){
						jQuery("'.$addon_id.' .sppb-articles-carousel-wrap").bxSlider({
							mode: "horizontal",
							slideSelector: "div.sppb-articles-carousel-column",
							minSlides: '.$number_of_items_mobile.',
							maxSlides: '.$number_of_items_mobile.',
							moveSlides: '.$number_of_items_mobile.',
							pager: true,
							controls: '.($carousel_arrow ? 'true' : 'false').',
							slideWidth: 1140,
							speed: '.$slide_speed.',
							auto: '.($carousel_autoplay ? 'true' : 'false').',
							nextText: "<i class=\'fa fa-angle-right\' aria-hidden=\'true\'></i>",
							prevText: "<i class=\'fa fa-angle-left\' aria-hidden=\'true\'></i>",
							autoHover: true,
							touchEnabled: '.($carousel_touch ? 'true' : 'false').',
							autoStart: true,
						});
					} else if(widthMatch < 992) {
						jQuery("'.$addon_id.' .sppb-articles-carousel-wrap").bxSlider({
							mode: "horizontal",
							slideSelector: "div.sppb-articles-carousel-column",
							minSlides: '.$number_of_items_tab.',
							maxSlides: '.$number_of_items_tab.',
							moveSlides: '.$number_of_items_tab.',
							pager: true,
							controls: '.($carousel_arrow ? 'true' : 'false').',
							nextText: "<i class=\'fa fa-angle-right\' aria-hidden=\'true\'></i>",
							prevText: "<i class=\'fa fa-angle-left\' aria-hidden=\'true\'></i>",
							slideWidth: 1140,
							speed: '.$slide_speed.',
							auto: '.($carousel_autoplay ? 'true' : 'false').',
							autoHover: true,
							touchEnabled: '.($carousel_touch ? 'true' : 'false').',
							autoStart: true,
						});
					} else {
						jQuery("'.$addon_id.' .sppb-articles-carousel-wrap").bxSlider({
							mode: "horizontal",
							slideSelector: "div.sppb-articles-carousel-column",
							minSlides: '.$number_of_items.',
							maxSlides: '.$number_of_items.',
							moveSlides: '.$number_of_items.',
							pager: true,
							controls: '.($carousel_arrow ? 'true' : 'false').',
							nextText: "<i class=\'fa fa-angle-right\' aria-hidden=\'true\'></i>",
							prevText: "<i class=\'fa fa-angle-left\' aria-hidden=\'true\'></i>",
							slideWidth: 1140,
							speed: '.$slide_speed.',
							auto: '.($carousel_autoplay ? 'true' : 'false').',
							autoHover: true,
							touchEnabled: '.($carousel_touch ? 'true' : 'false').',
							autoStart: true,
						});
					}
				});
			';
		} else {
			return '
				jQuery(function(){
					"use strict";
					jQuery("'.$addon_id.' .sppb-article-scroller-wrap").bxSlider({
						minSlides: '.$number_of_items.',
						mode: "vertical",
						speed: '.$slide_speed.',
						pager: false,
						controls: false,
						auto: true,
						moveSlides: '.$move_slide.',
						adaptiveHeight:true,
						touchEnabled:false,
						autoStart:true
					});
				});
			';
		}
	}
	static function isComponentInstalled($component_name){
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select( 'a.enabled' );
		$query->from($db->quoteName('#__extensions', 'a'));
		$query->where($db->quoteName('a.name')." = ".$db->quote($component_name));
		$db->setQuery($query);
		$is_enabled = $db->loadResult();

		return $is_enabled;
	}

}
