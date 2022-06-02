<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

class SppagebuilderAddonSocial_share extends SppagebuilderAddons
{

	public function render()
	{

		$doc = Factory::getDocument();

		// Options
		$class 	 			= (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
		$class 				.= (isset($this->addon->settings->social_style) && $this->addon->settings->social_style) ? ' sppb-social-share-style-' 	. str_replace('_', '-', $this->addon->settings->social_style) : '';
		$heading_selector 	= (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
		$title 				= (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$show_social_names 	= (isset($this->addon->settings->show_social_names) && $this->addon->settings->show_social_names) ? $this->addon->settings->show_social_names : '';
		$show_socials 		= (isset($this->addon->settings->show_socials) && $this->addon->settings->show_socials) ? $this->addon->settings->show_socials : '';

		$uri = Uri::getInstance();
		$current_url = $uri->toString();
		$page_title = $doc->getTitle();

		// assign col
		$share_col = 'sppb-col-sm-12';
		$icons_col = 'sppb-col-sm-12';

		$output  = '';
		$output .= '<div class="sppb-addon sppb-addon-social-share' . $class . '">';
		$output .= '<div class="sppb-social-share">';
		$output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';

		$output .= '<div class="sppb-social-share-wrap sppb-row">';

		$output .= '<div class="sppb-social-items-wrap ' . $icons_col . '">';
		$output .= '<ul>';
		if (in_array('facebook', $show_socials)) {
			$output .= '<li class="sppb-social-share-facebook">';
			$output .= '<a onClick="window.open(\'http://www.facebook.com/sharer.php?u=' . $current_url . '\',\'Facebook\',\'width=600,height=300,left=\'+(screen.availWidth/2-300)+\',top=\'+(screen.availHeight/2-150)+\'\'); return false;" href="http://www.facebook.com/sharer.php?u=' . $current_url . '">';
			$output .= '<i class="fab fa-facebook-f" aria-hidden="true"></i>';
			if ($show_social_names) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_FACEBOOK') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('twitter', $show_socials)) {
			//twitter
			$output .= '<li class="sppb-social-share-twitter">';
			$output .= '<a onClick="window.open(\'http://twitter.com/share?url=' . urlencode($current_url) . '&amp;text=' . str_replace(" ", "%20", $page_title) . '\',\'Twitter share\',\'width=600,height=300,left=\'+(screen.availWidth/2-300)+\',top=\'+(screen.availHeight/2-150)+\'\'); return false;" href="http://twitter.com/share?url=' . $current_url . '&amp;text=' . str_replace(" ", "%20", $page_title) . '">';
			$output .= '<i class="fab fa-twitter" aria-hidden="true"></i>';
			if ($show_social_names) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_TWITTER') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('linkedin', $show_socials)) {
			//linkedin
			$output .= '<li class="sppb-social-share-linkedin">';
			$output .= '<a onClick="window.open(\'http://www.linkedin.com/shareArticle?mini=true&url=' . $current_url . '\',\'Linkedin\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $current_url . '" >';
			$output .= '<i class="fab fa-linkedin" aria-hidden="true"></i>';
			if ($show_social_names) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_LINKEDIN') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('pinterest', $show_socials)) {
			$output .= '<li class="sppb-social-share-pinterest">';
			$output .= '<a onClick="window.open(\'http://pinterest.com/pin/create/button/?url=' . $current_url . '&amp;description=' . $page_title . '\',\'Pinterest\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://pinterest.com/pin/create/button/?url=' . $current_url . '&amp;description=' . $page_title . '" >';
			$output .= '<i class="fab fa-pinterest" aria-hidden="true"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_PINTEREST') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('thumblr', $show_socials)) {
			$output .= '<li class="sppb-social-share-thumblr">';
			$output .= '<a onClick="window.open(\'http://tumblr.com/share?s=&amp;v=3&amp;t=' . $page_title . '&amp;u=' . $current_url . '\',\'Thumblr\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://tumblr.com/share?s=&amp;v=3&amp;t=' . $page_title . '&amp;u=' . $current_url . '" >';
			$output .= '<i class="fab fa-tumblr"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_THUMBLR') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('getpocket', $show_socials)) {
			$output .= '<li class="sppb-social-share-getpocket">';
			$output .= '<a onClick="window.open(\'https://getpocket.com/save?url=' . $current_url . '\',\'Getpocket\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="https://getpocket.com/save?url=' . $current_url . '" >';
			$output .= '<i class="fab fa-get-pocket" aria-hidden="true"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_GETPOCKET') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('reddit', $show_socials)) {
			$output .= '<li class="sppb-social-share-reddit">';
			$output .= '<a onClick="window.open(\'http://www.reddit.com/submit?url=' . $current_url . '\',\'Reddit\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://www.reddit.com/submit?url=' . $current_url . '" >';
			$output .= '<i class="fab fa-reddit" aria-hidden="true"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_REDDIT') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('vk', $show_socials)) {
			$output .= '<li class="sppb-social-share-vk">';
			$output .= '<a onClick="window.open(\'http://vk.com/share.php?url=' . $current_url . '\',\'Vk\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://vk.com/share.php?url=' . $current_url . '" >';
			$output .= '<i class="fab fa-vk" aria-hidden="true"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_VK') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('xing', $show_socials)) {
			$output .= '<li class="sppb-social-share-xing">';
			$output .= '<a onClick="window.open(\'https://www.xing.com/spi/shares/new?cb=0&url=' . $current_url . '\',\'Xing\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="https://www.xing.com/spi/shares/new?cb=0&url=' . $current_url . '" >';
			$output .= '<i class="fab fa-xing" aria-hidden="true"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_XING') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		if (in_array('whatsapp', $show_socials)) {
			$output .= '<li class="sppb-social-share-whatsapp">';
			$output .= '<a href="https://wa.me/?text=' . $current_url . '" >';
			$output .= '<i class="fab fa-whatsapp" aria-hidden="true"></i>';
			if ($show_social_names == 1) {
				$output .= '<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_WHATSAPP') . '</span>';
			}
			$output .= '</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css()
	{
		$addon_id = '#sppb-addon-' . $this->addon->id;

		$social_use_border	= (isset($this->addon->settings->social_use_border) && $this->addon->settings->social_use_border) ? $this->addon->settings->social_use_border : '';
		$social_style 	= (isset($this->addon->settings->social_style) && $this->addon->settings->social_style) ? $this->addon->settings->social_style : '';

		$style  = (isset($this->addon->settings->background_color) && $this->addon->settings->background_color && $social_style == 'custom') ? 'background-color:' . $this->addon->settings->background_color  . ';' : '';
		$style .= (isset($this->addon->settings->social_border_width) && $this->addon->settings->social_border_width && $social_use_border) ? "border-style: solid; border-width: " . $this->addon->settings->social_border_width  . "px;" : '';
		$style .= (isset($this->addon->settings->social_border_color) && $this->addon->settings->social_border_color && $social_use_border) ? "border-color: " . $this->addon->settings->social_border_color  . ";" : '';
		$style .= (isset($this->addon->settings->social_border_radius) && $this->addon->settings->social_border_radius) ? "border-radius: " . $this->addon->settings->social_border_radius  . ";" : '';
		$hover_style = (isset($this->addon->settings->background_hover_color) && $this->addon->settings->background_hover_color && $social_style == 'custom') ? 'background-color:' . $this->addon->settings->background_hover_color  . ';' : '';
		$hover_style .= (isset($this->addon->settings->social_border_hover_color) && $this->addon->settings->social_border_hover_color && $social_use_border) ? 'border-color:' . $this->addon->settings->social_border_hover_color  . ';' : '';

		$css = '';
		if ($style) {
			$css .= $addon_id . ' .sppb-social-share-wrap ul li a {' . $style . '}';
		}

		if ($hover_style) {
			$css .= $addon_id . ' .sppb-social-share-wrap ul li a:hover {' . $hover_style . '}';
		}

		if (isset($this->addon->settings->icon_align) && $this->addon->settings->icon_align) {
			$css .= $addon_id . ' .sppb-social-share-wrap {text-align:' . $this->addon->settings->icon_align . ';}';
		}

		return $css;
	}

	public static function getTemplate()
	{
		$uri = Uri::getInstance();
		$current_url = $uri->toString();
		$page_title = Factory::getDocument()->getTitle();

		$output = '
			<#
				let current_url = "' . $current_url . '"
				let page_title = "' . $page_title . '"
				let share_col = "sppb-col-sm-12"
				let icons_col = "sppb-col-sm-12"
				let totalShareText = "' . JText::_("COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_TOTAL_SHARES") . '"

				let sShareClass = data.class || ""
					sShareClass += (!_.isEmpty(data.social_style))? " sppb-social-share-style-"+data.social_style.replace("_","-"):""
			#>

			<style type="text/css">
				#sppb-addon-{{ data.id }} .sppb-social-share-wrap ul li a {
					<# if( data.background_color && data.social_style == "custom" ) {#>
					background-color: {{ data.background_color }};
					<# } #>
					<# if( data.icon_color && data.social_style == "custom" ) {#>
						color: {{ data.icon_color }};
					<# } #>
					<# if( data.social_border_width && data.social_use_border ){ #>
						border-style: solid;
						border-width: {{ data.social_border_width }}px;
					<# } #>
					<# if( data.social_border_color && data.social_use_border ){ #>
						border-color: {{ data.social_border_color }};
					<# } #>
					<# if( data.social_border_radius ){ #>
						border-radius: {{ data.social_border_radius }};
					<# } #>
				}

				#sppb-addon-{{ data.id }}  .sppb-social-share-wrap ul li a:hover {
					<# if( data.background_hover_color && data.social_style == "custom" ) { #>
						background-color: {{ data.background_hover_color }};
					<# } #>
					<# if( data.icon_hover_color && data.social_style == "custom" ) { #>
						color: {{ data.icon_hover_color }};
					<# } #>
					<# if( data.social_border_hover_color && data.social_use_border ){ #>
						border-color: {{ data.social_border_hover_color }};
					<# } #>
				}

				<# if (data.icon_align) { #>
					#sppb-addon-{{ data.id }} .sppb-social-share-wrap{
						text-align: {{ data.icon_align }};
					}
				<# } #>

			</style>

			<div class="sppb-addon sppb-addon-social-share {{ sShareClass }}">
				<div class="sppb-social-share">
					<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
					<div class="sppb-social-share-wrap sppb-row">

					<div class="sppb-social-items-wrap {{ icons_col }}">
						<ul>
						<# if(_.indexOf(data.show_socials, "facebook") != "-1") { #>
							<li class="sppb-social-share-facebook">
							  <a onClick="window.open(\'http://www.facebook.com/sharer.php?u={{ current_url }}\',\'Facebook\',\'width=600,height=300,left=\'+(screen.availWidth/2-300)+\',top=\'+(screen.availHeight/2-150)+\'\'); return false;" href="http://www.facebook.com/sharer.php?u={{current_url}}">
									<i class="fab fa-facebook-f"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_FACEBOOK') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "twitter") != "-1") { #>
							<li class="sppb-social-share-twitter">
							  <a onClick="window.open(\'http://twitter.com/share?url={{ current_url }}&amp;text={{ page_title }}\',\'Twitter share\',\'width=600,height=300,left=\'+(screen.availWidth/2-300)+\',top=\'+(screen.availHeight/2-150)+\'\'); return false;" href="http://twitter.com/share?url={{ current_url }}&amp;text={{ page_title }}">
									<i class="fab fa-twitter"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_TWITTER') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "linkedin") != "-1") { #>
							<li class="sppb-social-share-linkedin">
							  <a onClick="window.open(\'http://www.linkedin.com/shareArticle?mini=true&url={{ current_url }}\',\'Linkedin\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://www.linkedin.com/shareArticle?mini=true&url={{ current_url }}">
									<i class="fab fa-linkedin"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_LINKEDIN') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "pinterest") != "-1") { #>
							<li class="sppb-social-share-pinterest">
							  <a onClick="window.open(\'http://pinterest.com/pin/create/button/?url={{ current_url }}&amp;description={{ page_title }}\',\'Pinterest\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://pinterest.com/pin/create/button/?url={{ current_url }}&amp;description={{ page_title }}">
									<i class="fab fa-pinterest"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_PINTEREST') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "thumblr") != "-1") { #>
							<li class="sppb-social-share-thumblr">
							  <a onClick="window.open(\'http://tumblr.com/share?s=&amp;v=3&amp;t={{ page_title }}&amp;u={{ current_url }}\',\'Thumblr\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://tumblr.com/share?s=&amp;v=3&amp;t={{ page_title }}&amp;u={{ current_url }}">
									<i class="fab fa-tumblr"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_THUMBLR') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "getpocket") != "-1") { #>
							<li class="sppb-social-share-getpocket">
							  <a onClick="window.open(\'https://getpocket.com/save?url={{ current_url }}\',\'Getpocket\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="https://getpocket.com/save?url={{ current_url }}">
									<i class="fab fa-get-pocket"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_GETPOCKET') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "reddit") != "-1") { #>
							<li class="sppb-social-share-reddit">
							  <a onClick="window.open(\'http://www.reddit.com/submit?url={{ current_url }}\',\'Reddit\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://www.reddit.com/submit?url={{ current_url }}">
									<i class="fab fa-reddit"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_REDDIT') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "vk") != "-1") { #>
							<li class="sppb-social-share-vk">
							  <a onClick="window.open(\'http://vk.com/share.php?url={{ current_url }}\',\'Vk\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="http://vk.com/share.php?url={{ current_url }}">
									<i class="fab fa-vk"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_VK') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "xing") != "-1") { #>
							<li class="sppb-social-share-xing">
							  <a onClick="window.open(\'https://www.xing.com/spi/shares/new?cb=0&url={{ current_url }}\',\'Xing\',\'width=585,height=666,left=\'+(screen.availWidth/2-292)+\',top=\'+(screen.availHeight/2-333)+\'\'); return false;" href="https://www.xing.com/spi/shares/new?cb=0&url={{ current_url }}">
									<i class="fab fa-xing"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_XING') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>

						<# if(_.indexOf(data.show_socials, "whatsapp") != "-1") { #>
							<li class="sppb-social-share-whatsapp">
							  <a href="whatsapp://send?text={{ current_url }}">
									<i class="fab fa-whatsapp"></i>
									<# if ( data.show_social_names != 0 ) { #>
										<span class="sppb-social-share-title">' . JText::_('COM_SPPAGEBUILDER_ADDON_SOCIALSHARE_WHATSAPP') . '</span>
									<# } #>
							  </a>
						  </li>
						<# } #>
						</ul>
					</div>

					</div>
				</div>
			</div>
			';

		return $output;
	}
}
