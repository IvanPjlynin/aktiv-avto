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
            'addon_name' => 'sp_flip_box',
            'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIP_BOX'),
            'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIP_BOX_DESC'),
            'category'=>'Content',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    'flip_bhave' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP_BHAVE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP_BHAVE_DESC'),
                        'values' => array(
                            'hover' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP_BHAVE_HOVER'),
                            'click' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP_BHAVE_CLICK'),
                        ),
                        'std' => 'hover',
                    ),
                    'front_text' => array(
                        'type' => 'textarea',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_TEXT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_TEXT_DESC'),
                        'std' => '<i class="fa fa-signal" style="font-size:25px;background-color:#fff;display:inline-block;color:#007BF8;width:60px;height:60px;line-height:60px;border-radius: 50%;" aria-hidden="true"></i><h2>Product Design</h2>'
                    ),
                    'flip_text' => array(
                        'type' => 'textarea',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP_TEXT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP_TEXT_DESC'),
                        'std' => '<h3>Product Design</h3><p>Successful businesses have many things in common, today we’ll look at the big ‘R’of recognitional advertising network may help.</p><p>Recognition can be illustrated by two individuals entering a crowded room at a party.</p>'
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                    'flip_style' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLE_DESC'),
                        'values' => array(
                            'rotate_style' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_ROTATE_STYLE'),
                            'slide_style' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_SLIDE_STYLE'),
                            'fade_style' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FADE_STYLE'),
                            'threeD_style' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_3D_STYLE'),
                        ),
                        'std' => 'flat_style'
                    ),
                    'rotate' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_ROTATE'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_ROTATE_DESC'),
                        'values' => array(
                            'flip_top' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FROM_TOP'),
                            'flip_bottom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
                            'flip_left' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FROM_LEFT'),
                            'flip_right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        ),
                        'std' => 'flip_right',
                        'depends' => array(array('flip_style', '!=', 'fade_style')),
                    ),
                    'height' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_HEIGHT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_HEIGHT_DESC'),
                        'std' => '',
                        'responsive' => true,
                        'max'=>1000,
                    ),
                    'text_align' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TEXT_ALIGN'),
                        'values' => array(
                            'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                            'center' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
                            'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        ),
                        'std' => 'center',
                    ),
                    'border_styles' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLES'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLES_DESC'),
                        'values' => array(
                            'solid' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLES_BORDER_SOLID'),
                            'dashed' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLES_BORDER_DASHED'),
                            'dotted' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLES_BORDER_DOTTED'),
                            'border_radius' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_STYLES_BORDER_RADIUS'),
                        ),
                        'std' => '',
                    ),
                    'border_color' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BORDER_COLOR_DESC'),
                        'std' => '#000',
                    ),
                    //Admin Only
                    'separator_front' => array(
                        'type' => 'separator',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK'),
                    ),
                    'front_bgcolor' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BG_COLOR_FRONT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BG_COLOR_FRONT_DESC'),
                        'std' => '',
                    ),
                    'front_bgimg' => array(
                        'type' => 'media',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FRONT_BG_IMG'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FRONT_BG_IMG_DESC'),
                        'std' => array(
                            'src'=> 'https://sppagebuilder.com/addons/flipbox/flipbox-bg-1.jpg',
                        )
                    ),
                    'front_textcolor' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FRONT_TEXT_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FRONT_TEXT_COLOR_DESC'),
                        'std' => '#fff',
                    ),
                    'separator_back' => array(
                        'type' => 'separator',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_FLIP'),
                    ),
                    'back_bgcolor' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK_BG_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK_BG_COLOR_DESC'),
                        'std' => '#2E3B3E',
                    ),
                    'back_bgimg' => array(
                        'type' => 'media',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK_BG_IMG'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK_BG_IMG_DESC'),
                        'std' => array(
                            'src'=> '',
                        )
                    ),
                    'back_textcolor' => array(
                        'type' => 'color',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK_TEXT_COLOR'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_FLIPBOX_BACK_TEXT_COLOR_DESC'),
                        'std' => '#fff',
                    ),
                ),
            )
        )
);
