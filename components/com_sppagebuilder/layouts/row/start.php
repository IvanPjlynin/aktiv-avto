<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Component\ComponentHelper;

//no direct accees
defined('_JEXEC') or die('Restricted access');

$options = $displayData['options'];

$doc = Factory::getDocument();

//Image lazy load
$config   = ComponentHelper::getParams('com_sppagebuilder');
$lazyload = $config->get('lazyloadimg', '0');

$custom_class  = (isset($options->class) && ($options->class))?' ' . $options->class:'';
$row_id        = (isset($options->id) && $options->id)? $options->id : 'section-id-' . $options->dynamicId;
$fluid_row     = (isset($options->fullscreen) && $options->fullscreen) ? $options->fullscreen : 0;
$row_class     = (isset($options->no_gutter) && $options->no_gutter) ?  ' sppb-no-gutter' : '';

if ($lazyload && isset($options->background_type) && $options->background_type)
{
	if ($options->background_type == 'image' || $options->background_type == 'video')
	{
		$custom_class .= ' sppb-element-lazy';
	}
}

if (isset($options->columns_content_alignment) && $options->columns_content_alignment == 'top')
{
	$row_class .= (isset($options->columns_align_center) && $options->columns_align_center) ?  ' sppb-align-top' : '';
}
elseif (isset($options->columns_content_alignment) && $options->columns_content_alignment == 'bottom')
{
	$row_class .= (isset($options->columns_align_center) && $options->columns_align_center) ?  ' sppb-align-bottom' : '';
}
else
{
	$row_class .= (isset($options->columns_align_center) && $options->columns_align_center) ?  ' sppb-align-center' : '';
}

$external_video      = (isset($options->background_external_video) && $options->background_external_video) ?  $options->background_external_video : '';
$background_parallax = (isset($options->background_parallax) && $options->background_parallax) ?  (int) $options->background_parallax : 0;

$sec_cont_center = '';

if (isset($options->columns_content_alignment) && $options->columns_content_alignment == 'top')
{
	$sec_cont_center = (isset($options->columns_align_center) && $options->columns_align_center) ?  ' sppb-section-content-top' : '';
}
elseif (isset($options->columns_content_alignment) && $options->columns_content_alignment == 'bottom')
{
	$sec_cont_center = (isset($options->columns_align_center) && $options->columns_align_center) ?  ' sppb-section-content-bottom' : '';
}
else
{
	$sec_cont_center = (isset($options->columns_align_center) && $options->columns_align_center) ?  ' sppb-section-content-center' : '';
}

// Visibility
if (isset($options->hidden_md) && $options->hidden_md)
{
	$custom_class .= ' sppb-hidden-md sppb-hidden-lg';
}

if (isset($options->hidden_sm) && $options->hidden_sm)
{
	$custom_class .= ' sppb-hidden-sm';
}

if (isset($options->hidden_xs) && $options->hidden_xs)
{
	$custom_class .= ' sppb-hidden-xs';
}

$addon_attr = '';

// Animation
if (isset($options->animation) && $options->animation)
{
	$custom_class .= ' sppb-wow ' . $options->animation;

	if (isset($options->animationduration) && $options->animationduration)
	{
		$addon_attr .= ' data-sppb-wow-duration="' . $options->animationduration . 'ms"';
	}

	if (isset($options->animationdelay) && $options->animationdelay)
	{
		$addon_attr .= ' data-sppb-wow-delay="' . $options->animationdelay . 'ms"';
	}
}

if (!empty($external_video))
{
	$custom_class .= ' sppb-row-have-ext-bg';
}

// Top Shape CSS
$top_shape_css    = '';
$top_shape_css_sm = '';
$top_shape_css_xs = '';

if (isset($options->shape_width) && is_object($options->shape_width))
{
	$top_shape_css    .= (isset($options->shape_width->md) && !empty($options->shape_width->md)) ? 'width:' . $options->shape_width->md . '%;max-width:' . $options->shape_width->md . '%;' : '';
	$top_shape_css_sm .= (isset($options->shape_width->sm) && !empty($options->shape_width->sm)) ? 'width:' . $options->shape_width->sm . '%;max-width:' . $options->shape_width->sm . '%;' : '';
	$top_shape_css_xs .= (isset($options->shape_width->xs) && !empty($options->shape_width->xs)) ? 'width:' . $options->shape_width->xs . '%;max-width:' . $options->shape_width->xs . '%;' : '';
}

if (isset($options->shape_height) && is_object($options->shape_height))
{
	$top_shape_css    .= (isset($options->shape_height->md) && !empty($options->shape_height->md)) ? 'height:' . $options->shape_height->md . 'px;' : '';
	$top_shape_css_sm .= (isset($options->shape_height->sm) && !empty($options->shape_height->sm)) ? 'height:' . $options->shape_height->sm . 'px;' : '';
	$top_shape_css_xs .= (isset($options->shape_height->xs) && !empty($options->shape_height->xs)) ? 'height:' . $options->shape_height->xs . 'px;' : '';
}

$top_shape_path_css = (isset($options->shape_color) && !empty($options->shape_color)) ? 'fill:' . $options->shape_color . ';' : '';

if (isset($options->show_top_shape) && $options->show_top_shape && !empty($top_shape_path_css))
{
	$doc->addStyledeclaration('#' . $row_id . ' .sppb-shape-container.sppb-top-shape > svg path, #' . $row_id . ' .sppb-shape-container.sppb-top-shape > svg polygon{' . $top_shape_path_css . '}');
}

if (isset($options->show_top_shape) && $options->show_top_shape && !empty($top_shape_css))
{
	$doc->addStyledeclaration('#' . $row_id . ' .sppb-shape-container.sppb-top-shape > svg{' . $top_shape_css . '}');
}

if (isset($options->show_top_shape) && $options->show_top_shape && !empty($top_shape_css_sm))
{
	$doc->addStyledeclaration('@media (min-width: 768px) and (max-width: 991px) { #' . $row_id . ' .sppb-shape-container.sppb-top-shape > svg{' . $top_shape_css_sm . '} }');
}

if (isset($options->show_top_shape) && $options->show_top_shape && !empty($top_shape_css_xs))
{
	$doc->addStyledeclaration('@media (max-width: 767px) { #' . $row_id . ' .sppb-shape-container.sppb-top-shape > svg{' . $top_shape_css_xs . '} }');
}

// Top Shape CSS
$bottom_shape_css    = '';
$bottom_shape_css_sm = '';
$bottom_shape_css_xs = '';

if (isset($options->bottom_shape_width) && is_object($options->bottom_shape_width))
{
	$bottom_shape_css    .= (isset($options->bottom_shape_width->md) && !empty($options->bottom_shape_width->md)) ? 'width:' . $options->bottom_shape_width->md . '%;max-width:' . $options->bottom_shape_width->md . '%;' : '';
	$bottom_shape_css_sm .= (isset($options->bottom_shape_width->sm) && !empty($options->bottom_shape_width->sm)) ? 'width:' . $options->bottom_shape_width->sm . '%;max-width:' . $options->bottom_shape_width->sm . '%;' : '';
	$bottom_shape_css_xs .= (isset($options->bottom_shape_width->xs) && !empty($options->bottom_shape_width->xs)) ? 'width:' . $options->bottom_shape_width->xs . '%;max-width:' . $options->bottom_shape_width->xs . '%;' : '';
}

if (isset($options->bottom_shape_height) && is_object($options->bottom_shape_height))
{
	$bottom_shape_css    .= (isset($options->bottom_shape_height->md) && !empty($options->bottom_shape_height->md)) ? 'height:' . $options->bottom_shape_height->md . 'px;' : '';
	$bottom_shape_css_sm .= (isset($options->bottom_shape_height->sm) && !empty($options->bottom_shape_height->sm)) ? 'height:' . $options->bottom_shape_height->sm . 'px;' : '';
	$bottom_shape_css_xs .= (isset($options->bottom_shape_height->xs) && !empty($options->bottom_shape_height->xs)) ? 'height:' . $options->bottom_shape_height->xs . 'px;' : '';
}

$bottom_shape_path_css = (isset($options->bottom_shape_color) && !empty($options->bottom_shape_color)) ? 'fill:' . $options->bottom_shape_color . ';' : '';

if (isset($options->show_bottom_shape) && $options->show_bottom_shape && !empty($bottom_shape_path_css))
{
	$doc->addStyledeclaration('#' . $row_id . ' .sppb-shape-container.sppb-bottom-shape > svg path, #' . $row_id . ' .sppb-shape-container.sppb-bottom-shape > svg polygon{' . $bottom_shape_path_css . '}');
}

if (isset($options->show_bottom_shape) && $options->show_bottom_shape && !empty($bottom_shape_css))
{
	$doc->addStyledeclaration('#' . $row_id . ' .sppb-shape-container.sppb-bottom-shape > svg{' . $bottom_shape_css . '}');
}

if (isset($options->show_bottom_shape) && $options->show_bottom_shape && !empty($bottom_shape_css_sm))
{
	$doc->addStyledeclaration('@media (min-width: 768px) and (max-width: 991px) { #' . $row_id . ' .sppb-shape-container.sppb-bottom-shape > svg{' . $bottom_shape_css_sm . '} }');
}

if (isset($options->show_bottom_shape) && $options->show_bottom_shape && !empty($bottom_shape_css_xs))
{
	$doc->addStyledeclaration('@media (max-width: 767px) { #' . $row_id . ' .sppb-shape-container.sppb-bottom-shape > svg{' . $bottom_shape_css_xs . '} }');
}

// Video
$video_loop = '';

if (isset($options->video_loop) && $options->video_loop == true)
{
	$video_loop = 'loop';
}
else
{
	$video_loop = '';
}

$video_params = '';
$video_poster = '';
$mp4_url      = '';
$ogv_url      = '';

$external_background_video = 0;

if (isset($options->external_background_video) && $options->external_background_video)
{
	$external_background_video = $options->external_background_video;
}

$background_image     = (isset($options->background_image) && $options->background_image) ? $options->background_image : '';
$background_image_src = isset($background_image->src) ? $background_image->src : $background_image;

if (isset($options->background_video_mp4) && is_object($options->background_video_mp4))
{
	$options->background_video_mp4 = isset($options->background_video_mp4->src) ? $options->background_video_mp4->src : "";
}

if (isset($options->background_video_ogv) && is_object($options->background_video_ogv))
{
	$options->background_video_ogv = isset($options->background_video_ogv->src) ? $options->background_video_ogv->src : "";
}

if (isset($options->background_type))
{
	if ($options->background_type == 'video' && !$external_background_video)
	{
		if ($background_image_src)
		{
			if (strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false)
			{
				$video_poster .= $background_image_src ;
				$video_params .= $video_loop;
			}
			else
			{
				$video_poster .= Uri::base(true) . '/' . $background_image_src;
			}
		}

		if (isset($options->background_video_mp4))
		{
			$mp4_parsed = parse_url($options->background_video_mp4);
			$mp4_url    = (isset($mp4_parsed['host']) && $mp4_parsed['host']) ? $options->background_video_mp4 : Uri::base(true) . '/' . $options->background_video_mp4;
		}

		if (isset($options->background_video_ogv))
		{
			$ogv_parsed = parse_url($options->background_video_ogv);
			$ogv_url    = (isset($ogv_parsed['host']) && $ogv_parsed['host']) ? $options->background_video_ogv : Uri::base(true) . '/' . $options->background_video_ogv;
		}
	}
}
else
{
	if (isset($options->background_video) && $options->background_video && !$external_background_video)
	{
		if ($background_image_src)
		{
			if (strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false)
			{
				$video_poster .= $background_image_src;
				$video_params .= $video_loop;
			}
			else
			{
				$video_poster .= Uri::base(true) . '/' . $background_image_src;
				$video_params .= $video_loop;
			}
		}

		if (isset($options->background_video_mp4) && !is_object($options->background_video_mp4))
		{
			$mp4_parsed = parse_url($options->background_video_mp4);
			$mp4_url    = (isset($mp4_parsed['host']) && $mp4_parsed['host']) ? $options->background_video_mp4 : Uri::base(true) . '/' . $options->background_video_mp4;
		}

		if (isset($options->background_video_ogv) && !is_object($options->background_video_ogv))
		{
			$ogv_parsed = parse_url($options->background_video_ogv);
			$ogv_url    = (isset($ogv_parsed['host']) && $ogv_parsed['host']) ? $options->background_video_ogv : Uri::base(true) . '/' . $options->background_video_ogv;
		}
	}
}

$parallax_params = '';

if ($background_parallax && $background_image_src)
{
	$parallax_params = ' data-sppb-parallax="on"';
}

$video_content = '';

if (isset($options->background_type))
{
	if (!empty($external_video) && $options->external_background_video && $options->background_type == 'video')
	{
		$video = parse_url($external_video);
		$src   = '';
		$vidId = '';
		switch ($video['host']) {
			case 'youtu.be':
			$id  = trim($video['path'], '/');
			$src = '//www.youtube.com/embed/' . $id . '?playlist=' . $id . '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&mute=1';

			break;

			case 'www.youtube.com':
			case 'youtube.com':
			parse_str($video['query'], $query);
			$id  = $query['v'];
			$src = '//www.youtube.com/embed/' . $id . '?playlist=' . $id . '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&mute=1';

			break;
			case 'vimeo.com':
			case 'www.vimeo.com':
			$id  = trim($video['path'], '/');
			$src = "//player.vimeo.com/video/{$id}?background=1&autoplay=1&loop=1&title=0&byline=0&portrait=0";
		}
		$video_content .= '<div class="sppb-youtube-video-bg hidden"><iframe class="sppb-youtube-iframe" ' . ($lazyload ? 'data-src="' . $src . '"' : 'src="' . $src . '"') . ' frameborder="0" allowfullscreen></iframe></div>';
	}
}
else
{
	if (!empty($external_video) && $options->external_background_video && $options->background_video)
	{
		$video = parse_url($external_video);
		$src   = '';
		switch ($video['host']) {
			case 'youtu.be':
			$id  = trim($video['path'], '/');
			$src = '//www.youtube.com/embed/' . $id . '?playlist=' . $id . '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&mute=1';

			break;

			case 'www.youtube.com':
			case 'youtube.com':
			parse_str($video['query'], $query);
			$id  = $query['v'];
			$src = '//www.youtube.com/embed/' . $id . '?playlist=' . $id . '&iv_load_policy=3&enablejsapi=1&disablekb=1&autoplay=1&controls=0&showinfo=0&rel=0&loop=1&wmode=transparent&widgetid=1&mute=1';

			break;
			case 'vimeo.com':
			case 'www.vimeo.com':
			$id  = trim($video['path'], '/');
			$src = "//player.vimeo.com/video/{$id}?background=1&autoplay=1&loop=1&title=0&byline=0&portrait=0";
		}
		$video_content .= '<div class="sppb-youtube-video-bg hidden"><iframe class="sppb-youtube-iframe" ' . ($lazyload ? 'data-src="' . $src . '"' : 'src="' . $src . '"') . ' frameborder="0" allowfullscreen></iframe></div>';
	}
}

$shape_content = '';

if (isset($options->show_top_shape) && $options->show_top_shape && isset($options->shape_name) && $options->shape_name)
{
	$shape_class  = '';
	$shape_code   = '';
	$shape_invert = isset($options->shape_invert) && $options->shape_invert ? 1 : 0;

	if (class_exists('SppagebuilderHelperSite'))
	{
		$shape_code = SppagebuilderHelperSite::getSvgShapeCode($options->shape_name, $shape_invert);
	}

	if (isset($options->shape_flip) && $options->shape_flip)
	{
		$shape_class .= ' sppb-shape-flip';
	}

	if (isset($options->shape_invert) && $options->shape_invert && !empty($shape_code))
	{
		$shape_class .= ' sppb-shape-invert';
	}

	if (isset($options->shape_to_front) && $options->shape_to_front)
	{
		$shape_class .= ' sppb-shape-to-front';
	}

	$shape_content .= '<div class="sppb-shape-container sppb-top-shape ' . $shape_class . '">';
	$shape_content .= $shape_code;

	$shape_content .= '</div>';
}

if (isset($options->show_bottom_shape) && $options->show_bottom_shape && isset($options->bottom_shape_name) && $options->bottom_shape_name)
{
	$bottom_shape_class  = '';
	$bottom_shape_code   = '';
	$bottom_shape_invert = isset($options->bottom_shape_invert) && $options->bottom_shape_invert ? 1 : 0;

	if (class_exists('SppagebuilderHelperSite'))
	{
		$bottom_shape_code = SppagebuilderHelperSite::getSvgShapeCode($options->bottom_shape_name, $bottom_shape_invert);
	}

	if (isset($options->bottom_shape_flip) && $options->bottom_shape_flip)
	{
		$bottom_shape_class .= ' sppb-shape-flip';
	}

	if (isset($options->bottom_shape_invert) && $options->bottom_shape_invert && !empty($bottom_shape_code))
	{
		$bottom_shape_class .= ' sppb-shape-invert';
	}

	if (isset($options->bottom_shape_to_front) && $options->bottom_shape_to_front)
	{
		$bottom_shape_class .= ' sppb-shape-to-front';
	}

	$shape_content .= '<div class="sppb-shape-container sppb-bottom-shape ' . $bottom_shape_class . '">';
	$shape_content .= $bottom_shape_code;
	$shape_content .= '</div>';
}

$html = '';

if (!$fluid_row)
{
	$html .= '<section id="' . $row_id . '" class="sppb-section' . $custom_class . '' . $sec_cont_center . '" ' . $addon_attr . $parallax_params . '>';

	if ($mp4_url || $ogv_url)
	{
		$html .= '<div class="sppb-section-background-video">';
		$html .= '<video class="section-bg-video" autoplay muted playsinline ' . $video_loop . ' ' . $video_params . '' . ($lazyload ? ' data-poster="' . $video_poster . '"' : ' poster="' . $video_poster . '"') . '>';

		if ($mp4_url)
		{
			$html .= '<source ' . ($lazyload ? 'data-large="' . $mp4_url . '"' : 'src="' . $mp4_url . '"') . ' type="video/mp4">';
		}

		if ($ogv_url)
		{
			$html .= '<source ' . ($lazyload ? 'data-large="' . $ogv_url . '"' : 'src="' . $ogv_url . '"') . ' type="video/ogg">';
		}
		$html .= '</video>';
		$html .= '</div>';
	}
	//When there was no gradient or pattern overlay after adding those option need Backward Compatiblity for pervious color overlay
	if (isset($options->overlay) && $options->overlay)
	{
		$options->overlay_type = 'overlay_color';
	}

	if ($shape_content)
	{
		$html .= $shape_content;
	}

	if ($video_content)
	{
		$html .= $video_content;
	}

	if (isset($options->overlay_type) && $options->overlay_type !== 'overlay_none')
	{
		$html .= '<div class="sppb-row-overlay"></div>';
	}
	$html .= '<div class="sppb-row-container">';
}
else
{
	$html .= '<div id="' . $row_id . '" class="sppb-section' . $custom_class . '' . $sec_cont_center . '" ' . $addon_attr . $parallax_params . '>';

	if ($mp4_url || $ogv_url)
	{
		$html .= '<div class="sppb-section-background-video">';
		$html .= '<video class="section-bg-video" autoplay muted playsinline ' . $video_loop . ' ' . $video_params . '' . ($lazyload ? ' data-poster="' . $video_poster . '"' : ' poster="' . $video_poster . '"') . '>';

		if ($mp4_url)
		{
			$html .= '<source ' . ($lazyload ? 'data-large="' . $mp4_url . '"' : 'src="' . $mp4_url . '"') . ' type="video/mp4">';
		}

		if ($ogv_url)
		{
			$html .= '<source ' . ($lazyload ? 'data-large="' . $ogv_url . '"' : 'src="' . $ogv_url . '"') . ' type="video/ogg">';
		}
		$html .= '</video>';
		$html .= '</div>';
	}
	//When theere was no gradient or pattern overlay after adding those option need Backward Compatiblity for pervious color overlay
	if (isset($options->overlay) && $options->overlay)
	{
		$options->overlay_type = 'overlay_color';
	}

	if ($shape_content)
	{
		$html .= $shape_content;
	}

	if ($video_content)
	{
		$html .= $video_content;
	}

	if (isset($options->overlay_type) && $options->overlay_type !== 'overlay_none')
	{
		$html .= '<div class="sppb-row-overlay"></div>';
	}
	$html .= '<div class="sppb-container-inner">';
}

// Row Title
if ((isset($options->title) && $options->title) || (isset($options->subtitle) && $options->subtitle))
{
	$title_position = '';

	if (isset($options->title_position) && $options->title_position)
	{
		$title_position = $options->title_position;
	}

	if ($fluid_row)
	{
		$html .= '<div class="sppb-container">';
	}
	$html .= '<div class="sppb-section-title ' . $title_position . '">';

	if (isset($options->title) && $options->title)
	{
		$heading_selector   = 'h2';

		if (isset($options->heading_selector) && $options->heading_selector)
		{
			$heading_selector = $options->heading_selector;
		}
		$html .= '<' . $heading_selector . ' class="sppb-title-heading">' . $options->title . '</' . $heading_selector . '>';
	}

	if (isset($options->subtitle) && $options->subtitle)
	{
		$html .= '<p class="sppb-title-subheading">' . $options->subtitle . '</p>';
	}
	$html .= '</div>';

	if ($fluid_row)
	{
		$html .= '</div>';
	}
}

$html .= '<div class="sppb-row' . $row_class . '">';

echo $html;
