<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

SpAddonsConfig::addonConfig(
        array(
            'type' => 'content',
            'addon_name' => 'sp_pie_progress',
            'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS'),
            'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_DESC'),
            'category' => 'Content',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    'percentage' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_PERCENTAGE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_PERCENTAGE_DESC'),
                        'min' => 1,
                        'max' => 100,
                        'std' => 75
                    ),
                    'percentage_font_size' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERCENTAGE_FONT_SIZE'),
                        'std' => array('md' => 24),
                        'depends' => array(array('percentage', '!=', '')),
                        'responsive' => true,
                        'max' => 400,
                    ),
                    'percentage_color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PERCENTAGE_COLOR'),
                    ),
                    'size' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_SIZE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_SIZE_DESC'),
                        'min' => 50,
                        'max' => 1000,
                        'std' => 110
                    ),
                    'border_color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR_DESC'),
                        'std' => 'rgba(48, 113, 255, 0.10)',
                    ),
                    'border_active_color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR_ACTIVE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_COLOR_ACTIVE_DESC'),
                        'std' => '#3071FF',
                    ),
                    'border_width' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_WIDTH'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_BORDER_WIDTH_DESC'),
                        'min' => 1,
                        'max' => 100,
                        'std' => 5
                    ),
                    'animation_duration' => array(
                        'type' => 'number',
                        'title' => JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ANIMATION_DURATION_DESC'),
                    ),
                    'separator_icon' => array(
                        'type' => 'separator',
                        'title' => JText::_('Icon'),
                    ),
                    'icon_name' => array(
                        'type' => 'icon',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_NAME'),
                        'std' => ''
                    ),
                    'icon_size' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE'),
                        'values' => array(
                            'fa-fw' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE_STANDARD'),
                            'fa-lg fa-fw' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE_TINY'),
                            'fa-2x fa-fw' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE_SMALL'),
                            'fa-3x fa-fw' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE_MEDIUM'),
                            'fa-4x fa-fw' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE_LARGE'),
                            'fa-5x fa-fw' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_SIZE_EXTRA_LARGE'),
                        ),
                        'std' => 'fa-3x fa-fw',
                    ),
                    'separator1' => array(
                        'type' => 'separator',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_PIE_PROGRESS_CONTENT'),
                    ),
                    'title' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                        'std' => 'Pie Progress'
                    ),
                    'heading_selector' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
                        'values' => array(
                            'h1' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H1'),
                            'h2' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H2'),
                            'h3' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H3'),
                            'h4' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H4'),
                            'h5' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H5'),
                            'h6' => JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_H6'),
                        ),
                        'std' => 'h3',
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_font_family' => array(
                        'type' => 'fonts',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'depends' => array(array('title', '!=', '')),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.sppb-addon-title { font-family: "{{ VALUE }}"; }'
                        )
                    ),
                    'title_fontsize' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_SIZE_DESC'),
                        'std' => array('md' => 16),
                        'depends' => array(array('title', '!=', '')),
                        'responsive' => true,
                        'max' => 400,
                    ),
                    'title_lineheight' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_LINE_HEIGHT'),
                        'std' => array('md' => 22),
                        'depends' => array(array('title', '!=', '')),
                        'responsive' => true,
                        'max' => 400,
                    ),
                    'title_font_style' => array(
                        'type' => 'fontstyle',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_letterspace' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
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
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_text_color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
                        'std' => '#4A4A4A',
                        'depends' => array(array('title', '!=', '')),
                    ),
                    'title_margin_top' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_TOP_DESC'),
                        'placeholder' => '10',
                        'depends' => array(array('title', '!=', '')),
                        'responsive' => true,
                        'max' => 400,
                    ),
                    'title_margin_bottom' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_MARGIN_BOTTOM_DESC'),
                        'placeholder' => '10',
                        'depends' => array(array('title', '!=', '')),
                        'responsive' => true,
                        'max' => 400,
                    ),
                    'title_font_family' => array(
                        'type' => 'fonts',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'depends' => array(array('title', '!=', '')),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.sppb-addon-title { font-family: "{{ VALUE }}"; }'
                        )
                    ),
                    'text' => array(
                        'type' => 'editor',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
                        'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing erat eget risus sollicitudin pellentesque et non erat.'
                    ),
                    'text_font_family' => array(
                        'type' => 'fonts',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CONTENT_FONT_FAMILY_DESC'),
                        'depends' => array(array('text', '!=', '')),
                        'selector' => array(
                            'type' => 'font',
                            'font' => '{{ VALUE }}',
                            'css' => '.sppb-addon-text { font-family: "{{ VALUE }}"; }'
                        )
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                ),
            ),
        )
);
