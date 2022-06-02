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
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Uri\Uri;

$options   = $displayData['options'];
$doc 					 = Factory::getDocument();

//Image lazy load
$config               = ComponentHelper::getParams('com_sppagebuilder');
$lazyload             = $config->get('lazyloadimg', '0');
$placeholder          = $config->get('lazyplaceholder', '');
$lazy_bg_image        = '';
$placeholder_bg_image = '';

$row_id     			 = (isset($options->id) && $options->id) ? $options->id : 'section-id-' . $options->dynamicId;

$row_styles = '';
$style      = '';
$style_sm   = '';
$style_xs   = '';

if (isset($options->section_height))
{
	if (is_object($options->section_height))
	{
		if (isset($options->section_height->md) && $options->section_height->md)
		{
			if ($options->section_height_option == 'height')
			{
				$style .= 'height:' . $options->section_height->md . 'px;';
			}
		}

		if (isset($options->section_height->sm) && $options->section_height->sm)
		{
			if ($options->section_height_option == 'height')
			{
				$style_sm .= 'height:' . $options->section_height->sm . 'px;';
			}
		}

		if (isset($options->section_height->xs) && $options->section_height->xs)
		{
			if ($options->section_height_option == 'height')
			{
				$style_xs .= 'height:' . $options->section_height->xs . 'px;';
			}
		}
	}
	else
	{
		if ($options->section_height)
		{
			if ($options->section_height_option == 'height')
			{
				$style .= 'height:' . $options->section_height . 'px;';
			}
		}
	}
}

if (isset($options->section_min_height))
{
	if (is_object($options->section_min_height))
	{
		if (isset($options->section_min_height->md) && $options->section_min_height->md)
		{
			$style .= 'min-height:' . $options->section_min_height->md . 'px;';
		}

		if (isset($options->section_min_height->sm) && $options->section_min_height->sm)
		{
			$style_sm .= 'min-height:' . $options->section_min_height->sm . 'px;';
		}

		if (isset($options->section_min_height->xs) && $options->section_min_height->xs)
		{
			$style_xs .= 'min-height:' . $options->section_min_height->xs . 'px;';
		}
	}
	else
	{
		if ($options->section_min_height)
		{
			$style .= 'min-height:' . $options->section_min_height . 'px;';
		}
	}
}

if (isset($options->section_max_height))
{
	if (is_object($options->section_max_height))
	{
		if (isset($options->section_max_height->md) && $options->section_max_height->md)
		{
			$style .= 'max-height:' . $options->section_max_height->md . 'px;';
		}

		if (isset($options->section_max_height->sm) && $options->section_max_height->sm)
		{
			$style_sm .= 'max-height:' . $options->section_max_height->sm . 'px;';
		}

		if (isset($options->section_max_height->xs) && $options->section_max_height->xs)
		{
			$style_xs .= 'max-height:' . $options->section_max_height->xs . 'px;';
		}
	}
	else
	{
		if ($options->section_max_height)
		{
			$style .= 'max-height:' . $options->section_max_height . 'px;';
		}
	}
}

if (isset($options->section_overflow_x) && $options->section_overflow_x)
{
	$style .= 'overflow-x:' . $options->section_overflow_x . ';';
}

if (isset($options->section_overflow_y) && $options->section_overflow_y)
{
	$style .= 'overflow-y:' . $options->section_overflow_y . ';';
}

if (isset($options->section_height_option) && $options->section_height_option == 'win-height')
{
	$style .= 'height: 100vh;';
}

if (isset($options->padding))
{
	if (is_object($options->padding))
	{
		if (isset($options->padding->md) && $options->padding->md)
		{
			$style .= SppagebuilderHelperSite::getPaddingMargin($options->padding->md, 'padding');
		}

		if (isset($options->padding->sm) && $options->padding->sm)
		{
			$style_sm .= SppagebuilderHelperSite::getPaddingMargin($options->padding->sm, 'padding');
		}

		if (isset($options->padding->xs) && $options->padding->xs)
		{
			$style_xs .= SppagebuilderHelperSite::getPaddingMargin($options->padding->xs, 'padding');
		}
	}
	else
	{
		if ($options->padding)
		{
			$style .= 'padding: ' . $options->padding . ';';
		}
	}
}

if (isset($options->margin))
{
	if (is_object($options->margin))
	{
		if (isset($options->margin->md) && $options->margin->md)
		{
			$style .= SppagebuilderHelperSite::getPaddingMargin($options->margin->md, 'margin');
		}

		if (isset($options->margin->sm) && $options->margin->sm)
		{
			$style_sm .= SppagebuilderHelperSite::getPaddingMargin($options->margin->sm, 'margin');
		}

		if (isset($options->margin->xs) && $options->margin->xs)
		{
			$style_xs .= SppagebuilderHelperSite::getPaddingMargin($options->margin->xs, 'margin');
		}
	}
	else
	{
		if ($options->margin)
		{
			$style .= 'margin: ' . $options->margin . ';';
		}
	}
}

if (isset($options->color) && $options->color)
{
	$style .= 'color:' . $options->color . ';';
}

$background_image     = (isset($options->background_image) && $options->background_image) ? $options->background_image : '';
$background_image_src = isset($background_image->src) ? $background_image->src : $background_image;

if (isset($options->background_type))
{
	if (($options->background_type == 'image' || $options->background_type == 'color') && isset($options->background_color) && $options->background_color)
	{
		$style .= 'background-color:' . $options->background_color . ';';
	}

	if (($options->background_type == 'image' && $background_image_src) || (isset($options->background_type) && $options->background_type == 'video'))
	{
		if ($lazyload)
		{
			if ($placeholder)
			{
				$placeholder_bg_image .= 'background-image:url(' . $placeholder . ');';
			}

			if (strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false)
			{
				$lazy_bg_image .= 'background-image:url(' . $background_image_src . ');';
			}
			else
			{
				$lazy_bg_image .= 'background-image:url(' . Uri::base(true) . '/' . $background_image_src . ');';
			}
		}
		else
		{
			if (strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false)
			{
				$style .= 'background-image:url(' . $background_image_src . ');';
			}
			else
			{
				$style .= 'background-image:url(' . Uri::base(true) . '/' . $background_image_src . ');';
			}
		}

		if (isset($options->background_repeat) && $options->background_repeat)
		{
			$style .= 'background-repeat:' . $options->background_repeat . ';';
		}

		if (isset($options->background_size) && $options->background_size && $options->background_size != 'custom')
		{
			$style .= 'background-size:' . $options->background_size . ';';
		}

		if (isset($options->background_attachment) && $options->background_attachment)
		{
			$style .= 'background-attachment:' . $options->background_attachment . ';';
		}

		if (isset($options->background_position) && $options->background_position && $options->background_position != 'custom')
		{
			$style .= 'background-position:' . $options->background_position . ';';
		}

		if (isset($options->background_size) && $options->background_size == 'custom')
		{
			if (isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->md))
			{
				$style .= 'background-size:' . $options->background_size_custom->md . $options->background_size_custom->unit . ';';
			}
			elseif (isset($options->background_size_custom) && !is_object($options->background_size_custom))
			{
				$style .= 'background-size:' . $options->background_size_custom . $options->background_size_custom->unit . ';';
			}
		}
	}

	if (isset($options->background_position) && $options->background_position == 'custom')
	{
		if ((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->md)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->md)))
		{
			$style .= 'background-position:' . $options->background_position_custom_x->md . $options->background_position_custom_x->unit . ' ' . $options->background_position_custom_y->md . $options->background_position_custom_y->unit . ';';
		}
		elseif (isset($options->background_position_custom_x) && !is_object($options->background_position_custom_x) || isset($options->background_position_custom_y) && !is_object($options->background_position_custom_y))
		{
			$style .= 'background-position:' . $options->background_position_custom_x . $options->background_position_custom_x->unit . ' ' . $options->background_position_custom_y . $options->background_position_custom_y->unit . ';';
		}
	}

	if ($options->background_type == 'gradient' && isset($options->background_gradient) && is_object($options->background_gradient))
	{
		$radialPos = (isset($options->background_gradient->radialPos) && !empty($options->background_gradient->radialPos)) ? $options->background_gradient->radialPos : 'center center';

		$gradientColor = (isset($options->background_gradient->color) && !empty($options->background_gradient->color)) ? $options->background_gradient->color : '';

		$gradientColor2 = (isset($options->background_gradient->color2) && !empty($options->background_gradient->color2)) ? $options->background_gradient->color2 : '';

		$gradientDeg = (isset($options->background_gradient->deg) && !empty($options->background_gradient->deg)) ? $options->background_gradient->deg : '0';

		$gradientPos = (isset($options->background_gradient->pos) && !empty($options->background_gradient->pos)) ? $options->background_gradient->pos : '0';

		$gradientPos2 = (isset($options->background_gradient->pos2) && !empty($options->background_gradient->pos2)) ? $options->background_gradient->pos2 : '100';

		if (isset($options->background_gradient->type) && $options->background_gradient->type == 'radial')
		{
			$style .= "\tbackground-image: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
		}
		else
		{
			$style .= "\tbackground-image: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%);\n";
		}
	}
}
else
{
	if (isset($options->background_color) && $options->background_color)
	{
		$style .= 'background-color:' . $options->background_color . ';';
	}

	if ($background_image_src || (isset($options->background_type) && $options->background_type == 'video'))
	{
		if ($lazyload)
		{
			if ($placeholder)
			{
				$placeholder_bg_image .= 'background-image:url(' . $placeholder . ');';
			}

			if (strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false)
			{
				$lazy_bg_image .= 'background-image:url(' . $background_image_src . ');';
			}
			else
			{
				$lazy_bg_image .= 'background-image:url(' . Uri::base(true) . '/' . $background_image_src . ');';
			}
		}
		else
		{
			if (strpos($background_image_src, "http://") !== false || strpos($background_image_src, "https://") !== false)
			{
				$style .= 'background-image:url(' . $background_image_src . ');';
			}
			else
			{
				$style .= 'background-image:url(' . Uri::base(true) . '/' . $background_image_src . ');';
			}
		}

		if (isset($options->background_repeat) && $options->background_repeat)
		{
			$style .= 'background-repeat:' . $options->background_repeat . ';';
		}

		if (isset($options->background_size) && $options->background_size && $options->background_size != 'custom')
		{
			$style .= 'background-size:' . $options->background_size . ';';
		}

		if (isset($options->background_attachment) && $options->background_attachment)
		{
			$style .= 'background-attachment:' . $options->background_attachment . ';';
		}

		if (isset($options->background_position) && $options->background_position && $options->background_position != 'custom')
		{
			$style .= 'background-position:' . $options->background_position . ';';
		}

		if (isset($options->background_size) && $options->background_size == 'custom')
		{
			if (isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->md))
			{
				$style .= 'background-size:' . $options->background_size_custom->md . $options->background_size_custom->unit . ';';
			}
			elseif (isset($options->background_size_custom) && !is_object($options->background_size_custom))
			{
				$style .= 'background-size:' . $options->background_size_custom . $options->background_size_custom->unit . ';';
			}
		}

		if (isset($options->background_position) && $options->background_position == 'custom')
		{
			if ((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->md)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->md)))
			{
				$style .= 'background-position:' . $options->background_position_custom_x->md . $options->background_position_custom_x->unit . ' ' . $options->background_position_custom_y->md . $options->background_position_custom_y->unit . ';';
			}
			elseif (isset($options->background_position_custom_x) && !is_object($options->background_position_custom_x) || isset($options->background_position_custom_y) && !is_object($options->background_position_custom_y))
			{
				$style .= 'background-position:' . $options->background_position_custom_x . $options->background_position_custom_x->unit . ' ' . $options->background_position_custom_y . $options->background_position_custom_y->unit . ';';
			}
		}
	}
}

// Box Shadow
if (isset($options->row_boxshadow) && $options->row_boxshadow)
{
	if (is_object($options->row_boxshadow))
	{
		$ho     = (isset($options->row_boxshadow->ho) && $options->row_boxshadow->ho != '') ? $options->row_boxshadow->ho . 'px' : '0px';
		$vo     = (isset($options->row_boxshadow->vo) && $options->row_boxshadow->vo != '') ? $options->row_boxshadow->vo . 'px' : '0px';
		$blur   = (isset($options->row_boxshadow->blur) && $options->row_boxshadow->blur != '') ? $options->row_boxshadow->blur . 'px' : '0px';
		$spread = (isset($options->row_boxshadow->spread) && $options->row_boxshadow->spread != '') ? $options->row_boxshadow->spread . 'px' : '0px';
		$color  = (isset($options->row_boxshadow->color) && $options->row_boxshadow->color != '') ? $options->row_boxshadow->color : '#fff';

		$style .= "box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};";
	}
	else
	{
		$style .= "box-shadow: " . $options->row_boxshadow . ";";
	}
}

// Border
if (isset($options->row_border) && $options->row_border)
{
	if (isset($options->row_border_width) && $options->row_border_width)
	{
		if (is_object($options->row_border_width))
		{
			$style    .= isset($options->row_border_width->md) && trim($options->row_border_width->md) ? "border-width: " . trim($options->row_border_width->md) . ";" : "";
			$style_sm .= isset($options->row_border_width->sm) && trim($options->row_border_width->sm) ? "border-width: " . trim($options->row_border_width->sm) . ";" : "";
			$style_xs .= isset($options->row_border_width->xs) && trim($options->row_border_width->xs) ? "border-width: " . trim($options->row_border_width->xs) . ";" : "";
		}
		else
		{
			$style .= isset($options->row_border_width) && trim($options->row_border_width) ? "border-width: " . trim($options->row_border_width) . ";" : "";
		}
	}

	if (isset($options->row_border_color) && $options->row_border_color)
	{
		$style .= "border-color: " . $options->row_border_color . ";";
	}

	if (isset($options->row_border_style) && $options->row_border_style)
	{
		$style .= "border-style: " . $options->row_border_style . ";";
	}
}

// Border radius
$border_radius_style    = '';
$border_radius_style_sm = '';
$border_radius_style_xs = '';

if (isset($options->row_border_radius) && $options->row_border_radius)
{
	if (is_object($options->row_border_radius))
	{
		$border_radius_style    .= isset($options->row_border_radius->md) && $options->row_border_radius->md ? "border-radius: " . $options->row_border_radius->md . "px;" : "";
		$border_radius_style_sm .= isset($options->row_border_radius->sm) && $options->row_border_radius->sm ? "border-radius: " . $options->row_border_radius->sm . "px;" : "";
		$border_radius_style_xs .= isset($options->row_border_radius->xs) && $options->row_border_radius->xs ? "border-radius: " . $options->row_border_radius->xs . "px;" : "";
	}
	else
	{
		$border_radius_style .= isset($options->row_border_radius) && $options->row_border_radius ? "border-radius: " . $options->row_border_radius . "px;" : "";
	}
}

if (isset($options->background_type))
{
	if (isset($options->background_position) && $options->background_position == 'custom')
	{
		if ((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->sm)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->sm)))
		{
			$style_sm .= 'background-position:' . $options->background_position_custom_x->sm . $options->background_position_custom_x->unit . ' ' . $options->background_position_custom_y->sm . $options->background_position_custom_y->unit . ';';
		}

		if ((isset($options->background_position_custom_x) && is_object($options->background_position_custom_x) && isset($options->background_position_custom_x->xs)) || (isset($options->background_position_custom_y) && is_object($options->background_position_custom_y) && isset($options->background_position_custom_y->xs)))
		{
			$style_xs .= 'background-position:' . $options->background_position_custom_x->xs . $options->background_position_custom_x->unit . ' ' . $options->background_position_custom_y->xs . $options->background_position_custom_y->unit . ';';
		}
	}
}

if (isset($options->background_size) && $options->background_size == 'custom')
{
	if (isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->sm))
	{
		$style_sm .= 'background-size:' . $options->background_size_custom->sm . $options->background_size_custom->unit . ';';
	}

	if (isset($options->background_size_custom) && is_object($options->background_size_custom) && isset($options->background_size_custom->xs))
	{
		$style_xs .= 'background-size:' . $options->background_size_custom->xs . $options->background_size_custom->unit . ';';
	}
}
//Custom Row width
if (isset($options->row_width) && is_object($options->row_width) && isset($options->row_width->md) && $options->row_width->md)
{
	$style .= 'width:' . $options->row_width->md . $options->row_width->unit . ';';
}
elseif (isset($options->row_width) && !is_object($options->row_width) && !isset($options->row_width->md))
{
	$style .= 'width:' . $options->row_width . $options->row_width->unit . ';';
}

if (isset($options->row_max_width) && is_object($options->row_max_width) && isset($options->row_max_width->md) && $options->row_max_width->md)
{
	$style .= 'max-width:' . $options->row_max_width->md . $options->row_max_width->unit . ';';
}
elseif (isset($options->row_max_width) && !is_object($options->row_max_width) && !isset($options->row_max_width->md))
{
	$style .= 'max-width:' . $options->row_max_width . $options->row_max_width->unit . ';';
}

if (isset($options->row_min_width) && is_object($options->row_min_width) && isset($options->row_min_width->md) && $options->row_min_width->md)
{
	$style .= 'min-width:' . $options->row_min_width->md . $options->row_min_width->unit . ';';
}
elseif (isset($options->row_min_width) && !is_object($options->row_min_width) && !isset($options->row_min_width->md))
{
	$style .= 'min-width:' . $options->row_min_width . $options->row_min_width->unit . ';';
}
//Section overflow
// if(isset($options->section_overflow_x) && $options->section_overflow_x){
// 	$style .= 'overflow-x:'.$options->section_overflow_x.';';
// }
// if(isset($options->section_overflow_y) && $options->section_overflow_y){
// 	$style .= 'overflow-y:'.$options->section_overflow_y.';';
// }
//Responsive
//Tablet
if (isset($options->row_width) && is_object($options->row_width) && isset($options->row_width->sm) && $options->row_width->sm)
{
	$style_sm .= 'width:' . $options->row_width->sm . $options->row_width->unit . ';';
}

if (isset($options->row_max_width) && is_object($options->row_max_width) && isset($options->row_max_width->sm) && $options->row_max_width->sm)
{
	$style_sm .= 'max-width:' . $options->row_max_width->sm . $options->row_max_width->unit . ';';
}

if (isset($options->row_min_width) && is_object($options->row_min_width) && isset($options->row_min_width->sm) && $options->row_min_width->sm)
{
	$style_sm .= 'min-width:' . $options->row_min_width->sm . $options->row_min_width->unit . ';';
}

//Mobile
if (isset($options->row_width) && is_object($options->row_width) && isset($options->row_width->xs) && $options->row_width->xs)
{
	$style_xs .= 'width:' . $options->row_width->xs . $options->row_width->unit . ';';
}

if (isset($options->row_max_width) && is_object($options->row_max_width) && isset($options->row_max_width->xs) && $options->row_max_width->xs)
{
	$style_xs .= 'max-width:' . $options->row_max_width->xs . $options->row_max_width->unit . ';';
}

if (isset($options->row_min_width) && is_object($options->row_min_width) && isset($options->row_min_width->xs) && $options->row_min_width->xs)
{
	$style_xs .= 'min-width:' . $options->row_min_width->xs . $options->row_min_width->unit . ';';
}

if ($style)
{
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '{' . $style . '}';
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '{' . $placeholder_bg_image . '}';
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '.sppb-element-loaded {' . $lazy_bg_image . '}';
}

if ($style_sm)
{
	$row_styles .=  '@media (min-width: 768px) and (max-width: 991px) { .sp-page-builder .page-content #' . $row_id . '{' . $style_sm . '} }';
}

if ($style_xs)
{
	$row_styles .= '@media (max-width: 767px) { .sp-page-builder .page-content #' . $row_id . '{' . $style_xs . '} }';
}

if ($border_radius_style)
{
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '{' . $border_radius_style . '}';
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' .sppb-row-overlay{' . $border_radius_style . '}';
}

if ($border_radius_style_sm)
{
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '{' . $border_radius_style_sm . '}';
	$row_styles .= '@media (min-width: 768px) and (max-width: 991px) { .sp-page-builder .page-content #' . $row_id . ' .sppb-row-overlay{' . $border_radius_style_sm . '} }';
}

if ($border_radius_style_xs)
{
	$row_styles .= '.sp-page-builder .page-content #' . $row_id . '{' . $border_radius_style_xs . '}';
	$row_styles .= '@media (max-width: 767px) { .sp-page-builder .page-content #' . $row_id . ' .sppb-row-overlay{' . $border_radius_style_xs . '} }';
}
// Overlay
if (isset($options->background_type))
{
	if ($options->background_type == 'image' || $options->background_type == 'video')
	{
		if (!isset($options->overlay_type))
		{
			$options->overlay_type = 'overlay_color';
		}

		if (isset($options->overlay) && $options->overlay && $options->overlay_type == 'overlay_color')
		{
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {background-color: ' . $options->overlay . '}';
		}

		if (isset($options->gradient_overlay) && $options->gradient_overlay && $options->overlay_type == 'overlay_gradient')
		{
			$overlay_radialPos = (isset($options->gradient_overlay->radialPos) && !empty($options->gradient_overlay->radialPos)) ? $options->gradient_overlay->radialPos : 'center center';

			$overlay_gradientColor = (isset($options->gradient_overlay->color) && !empty($options->gradient_overlay->color)) ? $options->gradient_overlay->color : '';

			$overlay_gradientColor2 = (isset($options->gradient_overlay->color2) && !empty($options->gradient_overlay->color2)) ? $options->gradient_overlay->color2 : '';

			$overlay_gradientDeg = (isset($options->gradient_overlay->deg) && !empty($options->gradient_overlay->deg)) ? $options->gradient_overlay->deg : '0';

			$overlay_gradientPos = (isset($options->gradient_overlay->pos) && !empty($options->gradient_overlay->pos)) ? $options->gradient_overlay->pos : '0';

			$overlay_gradientPos2 = (isset($options->gradient_overlay->pos2) && !empty($options->gradient_overlay->pos2)) ? $options->gradient_overlay->pos2 : '100';

			if (isset($options->gradient_overlay->type) && $options->gradient_overlay->type == 'radial')
			{
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background: radial-gradient(at ' . $overlay_radialPos . ', ' . $overlay_gradientColor . ' ' . $overlay_gradientPos . '%, ' . $overlay_gradientColor2 . ' ' . $overlay_gradientPos2 . '%) transparent;
				}';
			}
			else
			{
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background: linear-gradient(' . $overlay_gradientDeg . 'deg, ' . $overlay_gradientColor . ' ' . $overlay_gradientPos . '%, ' . $overlay_gradientColor2 . ' ' . $overlay_gradientPos2 . '%) transparent;
				}';
			}
		}

		if (isset($options->pattern_overlay) && $options->pattern_overlay && $options->overlay_type == 'overlay_pattern')
		{
			if (strpos($options->pattern_overlay->src, "http://") !== false || strpos($options->pattern_overlay->src, "https://") !== false)
			{
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-image:url(' . $options->pattern_overlay->src . ');
					background-attachment: scroll;
				}';

				if (isset($options->overlay_pattern_color))
				{
					$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
						background-color:' . $options->overlay_pattern_color . ';
					}';
				}
			}
			else
			{
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-image:url(' . Uri::base(true) . '/' . $options->pattern_overlay->src . ');
					background-attachment: scroll;
				}';

				if (isset($options->overlay_pattern_color))
				{
					$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
						background-color:' . $options->overlay_pattern_color . ';
					}';
				}
			}
		}
	}
}
else
{
	if (!isset($options->overlay_type))
	{
		$options->overlay_type = 'overlay_color';
	}

	if (isset($options->overlay) && $options->overlay && $options->overlay_type == 'overlay_color')
	{
		$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {background-color: ' . $options->overlay . '}';
	}

	if (isset($options->gradient_overlay) && $options->gradient_overlay && $options->overlay_type == 'overlay_gradient')
	{
		$overlay_radialPos = (isset($options->gradient_overlay->radialPos) && !empty($options->gradient_overlay->radialPos)) ? $options->gradient_overlay->radialPos : 'center center';

		$overlay_gradientColor = (isset($options->gradient_overlay->color) && !empty($options->gradient_overlay->color)) ? $options->gradient_overlay->color : '';

		$overlay_gradientColor2 = (isset($options->gradient_overlay->color2) && !empty($options->gradient_overlay->color2)) ? $options->gradient_overlay->color2 : '';

		$overlay_gradientDeg = (isset($options->gradient_overlay->deg) && !empty($options->gradient_overlay->deg)) ? $options->gradient_overlay->deg : '0';

		$overlay_gradientPos = (isset($options->gradient_overlay->pos) && !empty($options->gradient_overlay->pos)) ? $options->gradient_overlay->pos : '0';

		$overlay_gradientPos2 = (isset($options->gradient_overlay->pos2) && !empty($options->gradient_overlay->pos2)) ? $options->gradient_overlay->pos2 : '100';

		if (isset($options->gradient_overlay->type) && $options->gradient_overlay->type == 'radial')
		{
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background: radial-gradient(at ' . $overlay_radialPos . ', ' . $overlay_gradientColor . ' ' . $overlay_gradientPos . '%, ' . $overlay_gradientColor2 . ' ' . $overlay_gradientPos2 . '%) transparent;
			}';
		}
		else
		{
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background: linear-gradient(' . $overlay_gradientDeg . 'deg, ' . $overlay_gradientColor . ' ' . $overlay_gradientPos . '%, ' . $overlay_gradientColor2 . ' ' . $overlay_gradientPos2 . '%) transparent;
			}';
		}
	}

	if (isset($options->pattern_overlay) && $options->pattern_overlay && $options->overlay_type == 'overlay_pattern')
	{
		if (strpos($options->pattern_overlay, "http://") !== false || strpos($options->pattern_overlay, "https://") !== false)
		{
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background-image:url(' . $options->pattern_overlay . ');
				background-attachment: scroll;
			}';

			if (isset($options->overlay_pattern_color))
			{
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-color:' . $options->overlay_pattern_color . ';
				}';
			}
		}
		else
		{
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				background-image:url(' . Uri::base(true) . '/' . $options->pattern_overlay . ');
				background-attachment: scroll;
			}';

			if (isset($options->overlay_pattern_color))
			{
				$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
					background-color:' . $options->overlay_pattern_color . ';
				}';
			}
		}
	}
}

//Blend Mode
if (isset($options->background_type) && $options->background_type)
{
	if ($options->background_type == 'image')
	{
		if (isset($options->blend_mode) && $options->blend_mode)
		{
			$row_styles .= '.sp-page-builder .page-content #' . $row_id . ' > .sppb-row-overlay {
				mix-blend-mode:' . $options->blend_mode . ';
			}';
		}
	}
}

// Row Title
if ((isset($options->title) && $options->title) || (isset($options->subtitle) && $options->subtitle))
{
	if (isset($options->title) && $options->title)
	{
		$title_style    = '';
		$title_style_sm = '';
		$title_style_xs = '';
		//Title Font Size
		if (isset($options->title_fontsize))
		{
			if (is_object($options->title_fontsize))
			{
				$title_style    .= (isset($options->title_fontsize->md) && $options->title_fontsize->md != '') ? 'font-size:' . $options->title_fontsize->md . 'px;line-height: ' . $options->title_fontsize->md . 'px;' : '';
				$title_style_sm .= (isset($options->title_fontsize->sm) && $options->title_fontsize->sm != '') ? 'font-size:' . $options->title_fontsize->sm . 'px;line-height: ' . $options->title_fontsize->sm . 'px;' : '';
				$title_style_xs .= (isset($options->title_fontsize->xs) && $options->title_fontsize->xs != '') ? 'font-size:' . $options->title_fontsize->xs . 'px;line-height: ' . $options->title_fontsize->xs . 'px;' : '';
			}
			else
			{
				$title_style .= (isset($options->title_fontsize) && $options->title_fontsize != '') ? 'font-size:' . $options->title_fontsize . 'px;line-height: ' . $options->title_fontsize . 'px;' : '';
			}
		}

		//Title Font Weight
		if (isset($options->title_fontweight))
		{
			if ($options->title_fontweight != '')
			{
				$title_style .= 'font-weight:' . $options->title_fontweight . ';';
			}
		}

		//Title Text Color
		if (isset($options->title_text_color))
		{
			if ($options->title_text_color != '')
			{
				$title_style .= 'color:' . $options->title_text_color . ';';
			}
		}

		//Title Margin Top
		if (isset($options->title_margin_top))
		{
			if (is_object($options->title_margin_top))
			{
				$title_style    .= (isset($options->title_margin_top->md) && $options->title_margin_top->md != '') ? 'margin-top:' . $options->title_margin_top->md . 'px;' : '';
				$title_style_sm .= (isset($options->title_margin_top->sm) && $options->title_margin_top->sm != '') ? 'margin-top:' . $options->title_margin_top->sm . 'px;' : '';
				$title_style_xs .= (isset($options->title_margin_top->xs) && $options->title_margin_top->xs != '') ? 'margin-top:' . $options->title_margin_top->xs . 'px;' : '';
			}
			else
			{
				$title_style .= (isset($options->title_margin_top) && $options->title_margin_top != '') ? 'margin-top:' . $options->title_margin_top . 'px;' : '';
			}
		}

		//Title Margin Bottom
		if (isset($options->title_margin_bottom))
		{
			if (is_object($options->title_margin_bottom))
			{
				$title_style    .= (isset($options->title_margin_bottom->md) && $options->title_margin_bottom->md != '') ? 'margin-bottom:' . $options->title_margin_bottom->md . 'px;' : '';
				$title_style_sm .= (isset($options->title_margin_bottom->sm) && $options->title_margin_bottom->sm != '') ? 'margin-bottom:' . $options->title_margin_bottom->sm . 'px;' : '';
				$title_style_xs .= (isset($options->title_margin_bottom->xs) && $options->title_margin_bottom->xs != '') ? 'margin-bottom:' . $options->title_margin_bottom->xs . 'px;' : '';
			}
			else
			{
				$title_style .= (isset($options->title_margin_bottom) && $options->title_margin_bottom != '') ? 'margin-bottom:' . $options->title_margin_bottom . 'px;' : '';
			}
		}

		$row_styles .= ($title_style) ? '.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-heading {' . $title_style . '}' : '';
		$row_styles .= ($title_style_sm) ? '@media (min-width: 768px) and (max-width: 991px) { .sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-heading {' . $title_style_sm . '}}' : '';
		$row_styles .= ($title_style_xs) ? '@media (max-width: 767px) { .sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-heading {' . $title_style_xs . '}}' : '';
	}

	// Subtitle font size
	if (isset($options->subtitle) && $options->subtitle)
	{
		if (isset($options->subtitle_fontsize))
		{
			$subtitle_fontsize    = '';
			$subtitle_fontsize_sm = '';
			$subtitle_fontsize_xs = '';

			if (is_object($options->subtitle_fontsize))
			{
				$subtitle_fontsize    = (isset($options->subtitle_fontsize->md) && $options->subtitle_fontsize->md != '') ? 'font-size:' . $options->subtitle_fontsize->md . 'px;' : '';
				$subtitle_fontsize_sm = (isset($options->subtitle_fontsize->sm) && $options->subtitle_fontsize->sm != '') ? 'font-size:' . $options->subtitle_fontsize->sm . 'px;' : '';
				$subtitle_fontsize_xs = (isset($options->subtitle_fontsize->xs) && $options->subtitle_fontsize->xs != '') ? 'font-size:' . $options->subtitle_fontsize->xs . 'px;' : '';
			}
			else
			{
				$subtitle_fontsize = (isset($options->subtitle_fontsize) && $options->subtitle_fontsize != '') ? 'font-size:' . $options->subtitle_fontsize . 'px;' : '';
			}
			$row_styles .= ($subtitle_fontsize) ? '.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-subheading {' . $subtitle_fontsize . '}' : '';
			$row_styles .= ($subtitle_fontsize_sm) ? '@media (min-width: 768px) and (max-width: 991px) {.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-subheading {' . $subtitle_fontsize_sm . '}}' : '';
			$row_styles .= ($subtitle_fontsize_xs) ? '@media (max-width: 767px) {.sp-page-builder .page-content #' . $row_id . ' .sppb-section-title .sppb-title-subheading {' . $subtitle_fontsize_xs . '}}' : '';
		}
	}
}

//container width
if (!$options->fullscreen && isset($options->container_width) && is_object($options->container_width) && isset($options->container_width->md) && $options->container_width->md != '')
{
	$row_styles .= '@media (min-width: 1400px) {#' . $row_id . ' > .sppb-row-container { max-width:' . $options->container_width->md . 'px;}}';
}
elseif (!$options->fullscreen && isset($options->container_width) && !is_object($options->container_width))
{
	$row_styles .= '@media (min-width: 1400px) {#' . $row_id . ' > .sppb-row-container { max-width:' . $options->container_width . 'px;}}';
}

// Gap between columns
if (!$options->no_gutter && isset($options->columns_gap) && is_object($options->columns_gap))
{
	$columns_gap_unit = $options->columns_gap->unit;

	if (isset($options->columns_gap->md) && $options->columns_gap->md != '')
	{
		$row_styles .= '#' . $row_id . ' > .sppb-row-container > .sppb-row {margin-left: -' . ($options->columns_gap->md / 2) . $columns_gap_unit . '; margin-right: -' . ($options->columns_gap->md / 2) . $columns_gap_unit . ';}';
		$row_styles .= '#' . $row_id . ' > .sppb-row-container > .sppb-row > div {padding-left: ' . ($options->columns_gap->md / 2) . $columns_gap_unit . '; padding-right: ' . ($options->columns_gap->md / 2) . $columns_gap_unit . ';}';
	}

	if (isset($options->columns_gap->sm) && $options->columns_gap->sm != '')
	{
		$row_styles .= '@media (max-width: 991.98px) {';
		$row_styles .= '#' . $row_id . ' > .sppb-row-container > .sppb-row {margin-left: -' . ($options->columns_gap->sm / 2) . $columns_gap_unit . '; margin-right: -' . ($options->columns_gap->sm / 2) . $columns_gap_unit . ';}';
		$row_styles .= '#' . $row_id . ' > .sppb-row-container > .sppb-row > div {padding-left: ' . ($options->columns_gap->sm / 2) . $columns_gap_unit . '; padding-right: ' . ($options->columns_gap->sm / 2) . $columns_gap_unit . ';}';
		$row_styles .= '}';
	}

	if (isset($options->columns_gap->xs) && $options->columns_gap->xs != '')
	{
		$row_styles .= '@media (max-width: 767.98px) {';
		$row_styles .= '#' . $row_id . ' > .sppb-row-container > .sppb-row {margin-left: -' . ($options->columns_gap->xs / 2) . $columns_gap_unit . '; margin-right: -' . ($options->columns_gap->xs / 2) . $columns_gap_unit . ';}';
		$row_styles .= '#' . $row_id . ' > .sppb-row-container > .sppb-row > div {padding-left: ' . ($options->columns_gap->xs / 2) . $columns_gap_unit . '; padding-right: ' . ($options->columns_gap->xs / 2) . $columns_gap_unit . ';}';
		$row_styles .= '}';
	}
}

echo $row_styles;
