<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

SpAddonsConfig::addonConfig(
        array(
            'type' => 'repeatable',
            'addon_name' => 'sp_icons_group',
            'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICONS_GROUP'),
            'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ICONS_GROUP_DESC'),
            'category' => 'Media',
            'attr' => array(
                'general' => array(
                    'admin_label' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                        'std' => ''
                    ),
                    //Styling
                    'size' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
                        'std' => array('md' => 34),
                        'max' => 400,
                        'responsive' => true
                    ),
                    'margin' => array(
                        'type' => 'slider',
                        'title' => JText::_('COM_SPPAGEBUILDER_BUTTON_GROUP_GUTTER'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_BUTTON_GROUP_GUTTER_DESC'),
                        'responsive' => true,
                        'max' => 100,
                        'std' => array('md' => 5),
                    ),
                    'item_display' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_DISPLAY'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_DISPLAY_DESC'),
                        'values'=>array(
                            'inline-block'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_DISPLAY_INLINE'),
                            'block'=>JText::_('COM_SPPAGEBUILDER_ADDON_ICON_DISPLAY_BLOCK'),
                        ),
                        'std' => 'inline-block',
                    ),
                    'icon_alignment' => array(
                        'type' => 'select',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_ALIGNMENT'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_ALIGNMENT_DESC'),
                        'values' => array(
                            'sppb-text-left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                            'sppb-text-center' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
                            'sppb-text-right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        ),
                        'std' => 'sppb-text-center',
                    ),
                    // End styling
                    'sp_icons_group_item' => array(
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICONS_GROUP_ITEM'),
                        'attr' => array(
                            'title' => array(
                                'type' => 'text',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                                'std' => ''
                            ),
                            'icon_name' => array(
                                'type' => 'icon',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ICON_NAME'),
                                'std' => 'fa-cogs'
                            ),
                            'icon_link' => array(
                                'type' => 'text',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
                                'placeholder' => 'http://www.facebook.com/joomshaper',
                                'std' => '#',
                            ),
                            'link_open_new_window' => array(
                                'type' => 'checkbox',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_LINK_NEW_WINDOW'),
                                'std' => 0,
                            ),
                            'color' => array(
                                'type' => 'color',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
                            ),
                            'background' => array(
                                'type' => 'color',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
                            ),
                            'width' => array(
                                'type' => 'slider',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_WIDTH'),
                                'std' => array('md' => 80),
                                'max' => 500,
                                'responsive' => true
                            ),
                            'height' => array(
                                'type' => 'slider',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_HEIGHT'),
                                'std' => array('md' => 80),
                                'max' => 500,
                                'responsive' => true
                            ),
                            'border_width' => array(
                                'type' => 'slider',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
                                'placeholder' => '3',
                                'responsive' => true
                            ),
                            'border_style' => array(
                                'type' => 'select',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE'),
                                'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DESC'),
                                'values' => array(
                                    'solid' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_SOLID'),
                                    'dotted' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOTTED'),
                                    'dashed' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DASHED'),
                                    'double' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_DOUBLE'),
                                    'none' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_STYLE_NONE'),
                                ),
                                'std' => 'solid',
                                'depends' => array(array('border_width', '!==', 0))
                            ),
                            'border_radius' => array(
                                'type' => 'slider',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_RADIUS'),
                                'placeholder' => '5',
                                'max' => 500,
                                'responsive' => true,
                                'depends' => array(array('border_width', '!==', 0))
                            ),
                            'border_color' => array(
                                'type' => 'color',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR')
                            ),
                            'padding' => array(
                                'type' => 'padding',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
                                'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
                                'placeholder' => '10px',
                                'responsive' => true,
                                'std' => '20px 20px 20px 20px',
                            ),
                            'label_separator' => array(
                                'type' => 'separator',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_SHOW_LABEL_OPTIONS')
                            ),
                            'show_label' => array(
                                'type' => 'checkbox',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_SHOW_LABEL'),
                                'std' => 0,
                            ),
                            'label_position' => array(
                                'type' => 'select',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_LABEL_POSITION'),
                                'values' => array(
                                    'top' => JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
                                    'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                                    'bottom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
                                ),
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                                'std' => 'top',
                            ),
                            'label_text' => array(
                                'type' => 'text',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_LABEL_TEXT'),
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                                'placeholder' => 'Facebook',
                            ),
                            'label_size' => array(
                                'type' => 'slider',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LABEL_FONT_SIZE'),
                                'max' => 400,
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                                'std' => array('md' => 16),
                                'responsive' => true
                            ),
                            'label_lineheight'=>array(
                                'type'=>'slider',
                                'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                                'max'=> 400,
                                'responsive'=>true,
                                'std'=> ''
                            ),
                            'label_letterspace'=>array(
                                'type'=>'select',
                                'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                                'values'=>array(
                                    '-10px'=> '-10px',
                                    '-9px'=>  '-9px',
                                    '-8px'=>  '-8px',
                                    '-7px'=>  '-7px',
                                    '-6px'=>  '-6px',
                                    '-5px'=>  '-5px',
                                    '-4px'=>  '-4px',
                                    '-3px'=>  '-3px',
                                    '-2px'=>  '-2px',
                                    '-1px'=>  '-1px',
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
                                    '10px'=> '10px'
                                ),
                                'std'=>'0px'
                            ),
                            'label_font_style'=>array(
                                'type'=>'fontstyle',
                                'title'=> JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_STYLE'),
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                            ),
                            'label_margin' => array(
                                'type' => 'margin',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICONS_GROUP_MARGIN'),
                                'placeholder' => '10',
                                'responsive' => true,
                                'depends' => array(
                                    array('show_label', '=', 1)
                                ),
                                'std'=>''
                            ),
                            'separator' => array(
                                'type' => 'separator',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_MOUSE_HOVER_OPTIONS')
                            ),
                            'use_hover' => array(
                                'type' => 'checkbox',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ICON_USE_HOVER'),
                                'std' => 0,
                            ),
                            'hover_background' => array(
                                'type' => 'color',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
                                'depends' => array(
                                    array('use_hover', '=', 1)
                                )
                            ),
                            'hover_color' => array(
                                'type' => 'color',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
                                'depends' => array(
                                    array('use_hover', '=', 1)
                                )
                            ),
                            'hover_border_color' => array(
                                'type' => 'color',
                                'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
                                'depends' => array(
                                    array('use_hover', '=', 1)
                                )
                            ),
                            'icon_class' => array(
                                'type' => 'text',
                                'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                                'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                                'placeholder' => 'custom class',
                                'std' => '',
                            ),
                        )
                    ),

                    'title_separator'=>array(
                        'type'=>'separator',
                        'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_OPTIN_TITLE_SEPARATOR'),
                    ),
                    'title'=>array(
                        'type'=>'textarea',
                        'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                        'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                        'std'=>  ''
                    ),
                    'title_position'=>array(
                        'type'=>'select',
                        'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_POSITION'),
                        'depends'=>array(array('title', '!=', '')),
                        'values'=>array(
                            'top'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
                            'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                            'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        ),
                        'std'=>'top',
                    ),
                    'heading_selector'=>array(
                        'type'=>'select',
                        'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS'),
                        'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_HEADINGS_DESC'),
                        'depends'=>array(array('title', '!=', '')),
                        'values'=>array(
                            'h1'=> 'h1',
                            'h2'=> 'h2',
                            'h3'=> 'h3',
                            'h4'=> 'h4',
                            'h5'=> 'h5',
                            'h6'=> 'h6',
                            'p'=>	'p',
                            'span'=> 'span',
                            'div'=> 'div'
                        ),
                        'std'=>'h2'
                    ),
    
                    'title_font_family'=>array(
                        'type'=>'fonts',
                        'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
                        'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY_DESC'),
                        'depends'=>array(array('title', '!=', '')),
                        'selector'=> array(
                            'type'=>'font',
                            'font'=>'{{ VALUE }}',
                            'css'=>'.sppb-addon-title { font-family: "{{ VALUE }}"; }'
                        )
                    ),
    
                    'title_fontsize'=>array(
                        'type'=>'slider',
                        'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
                        'depends'=>array(array('title', '!=', '')),
                        'std'=>'',
                        'max'=>400,
                        'responsive'=>true
                    ),
                    'title_lineheight'=>array(
                        'type'=>'slider',
                        'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
                        'std'=>'',
                        'max'=>400,
                        'responsive'=>true
                    ),
    
                    'title_font_style'=>array(
                        'type'=>'fontstyle',
                        'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
                        'depends'=>array(array('title', '!=', '')),
                    ),
    
                    'title_letterspace'=>array(
                        'type'=>'select',
                        'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
                        'depends'=>array(array('title', '!=', '')),
                        'values'=>array(
                            '-10px'=> '-10px',
                            '-9px'=>  '-9px',
                            '-8px'=>  '-8px',
                            '-7px'=>  '-7px',
                            '-6px'=>  '-6px',
                            '-5px'=>  '-5px',
                            '-4px'=>  '-4px',
                            '-3px'=>  '-3px',
                            '-2px'=>  '-2px',
                            '-1px'=>  '-1px',
                            '0'=> 'Default',
                            '1px'=> '1px',
                            '2px'=> '2px',
                            '3px'=> '3px',
                            '4px'=> '4px',
                            '5px'=> '5px',
                            '6px'=>	'6px',
                            '7px'=>	'7px',
                            '8px'=>	'8px',
                            '9px'=>	'9px',
                            '10px'=> '10px'
                        ),
                        'std'=>'0'
                    ),
    
                    'title_margin'=>array(
                        'type'=>'margin',
                        'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
                        'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN_DESC'),
                        'depends'=>array(array('title', '!=', '')),
                        'std' => '0px 0px 0px 0px',
                        'responsive'=>true
                    ),
    
                    'title_padding'=>array(
                        'type'=>'padding',
                        'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
                        'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
                        'depends'=>array(array('title', '!=', '')),
                        'std' => '0px 0px 0px 0px',
                        'responsive'=>true
                    ),

                    'title_icon'=>array(
                        'type'=>'icon',
                        'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON'),
                        'depends'=>array(array('title', '!=', '')),
                    ),
    
                    'title_icon_position'=>array(
                        'type'=>'select',
                        'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_POSITION'),
                        'values'=>array(
                            'before'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_POSITION_BEFORE'),
                            'after'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_ICON_POSITION_AFTER'),
                        ),
                        'std' => 'before',
                        'depends'=>array(array('title_icon', '!=', '', 'title', '!=', '')),
                    ),
                    'class' => array(
                        'type' => 'text',
                        'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                        'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                        'std' => ''
                    ),
                ),
            )
        )
);
