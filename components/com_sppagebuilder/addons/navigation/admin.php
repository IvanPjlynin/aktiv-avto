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
        'type'=>'general',
		'addon_name'=>'navigation',
		'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST'),
		'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_DESC'),
		'category'=>'Content',
		'attr'=>array(
            'general' => array(
                'admin_label'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                    'std'=> ''
                ),
                'sp_link_list_item'=>array(
                    'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ITEMS'),
                    'attr'=>  array(
                        'title'=>array(
                            'type'=>'text',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_TITLE'),
                            'std'=>'Home',
                        ),
                        'url'=>array(
                            'type'=>'media',
                            'format'=>'attachment',
                            'hide_preview'=>true,
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_URL'),
                            'placeholder'=>'http://',
                            'hide_preview'=>true,
                        ),
                        'icon'=>array(
                            'type'=>'icon',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ICON'),
                        ),
                        
                        'active'=>array(
                            'type'=>'checkbox',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ENABLE_ACTIVE'),
                            'std'=>0
                        ),
                        'target'=>array(
                            'type'=>'select',
                            'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
                            'values'=>array(
                                ''=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
                                '_blank'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
                            ),
                        ),
                        'class'=>array(
                            'type'=>'text',
                            'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                            'std'=> '',
                        ),
                    )
                ),
                'scroll_to'=>array(
                    'type'=>'checkbox',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ENABLE_SCROLL_TO'),
                    'std'=>0
                ),
                'scroll_to_offset'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ENABLE_SCROLL_TO_OFFSET'),
                    'depends'=>array(
                        array('scroll_to', '=', 1),
                    ),
                    'max'=> 2000,
                    'min'=> -2000,
                ),
                'sticky_menu'=>array(
                    'type'=>'checkbox',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ENABLE_STICKY'),
                    'std'=>0
                ),

                'type'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_TYPE'),
                    'values'=>array(
                        'nav'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_TYPE_NAV'),
                        'list'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_TYPE_LIST'),
                    ),
                    'std'=> 'nav'
                ),

                'align'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ALIGN'),
                    'values'=>array(
                        'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                        'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        'center'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
                    ),
                    'std'=> 'left'
                ),
                'item_style'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ITEM_STYLE'),
                ),

                'link_bg'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
				),
                'link_bg_hover'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR_HOVER'),
                    'std'=>'rgba(0, 0, 0, 0.05)',
                ),
                'link_border_radius'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_BORDER_RADIUS'),
					'std'=>3,
					'max'=>600,
                    'responsive' => true
                ),
                'link_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_FAMILY'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.sppb-link-list-wrap ul li a { font-family: "{{ VALUE }}"; }'
					)
				),
				'link_fontsize'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'max'=>200,
					'responsive'=>true
				),
				'link_lineheight'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINE_HEIGHT'),
					'std'=>'',
					'max'=>400,
					'responsive'=>true
				),

				'link_font_style'=>array(
					'type'=>'fontstyle',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_FONT_STYLE'),
				),

				'link_letterspace'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LETTER_SPACING'),
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
				'link_text_transform'=>array(
					'type'=>'select',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TEXT_TRANSFORM'),
					'values'=>array(
						'none'=> 'None',
						'capitalize'=> 'Capitalize',
						'uppercase'=> 'Uppercase',
						'lowercase'=> 'Lowercase',
					),
					'std'=>'none'
				),
                'link_margin'=>array(
                    'type'=>'margin',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
                    'responsive' => true
                ),

                'link_padding'=>array(
                    'type'=>'padding',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
                    'std'=>array('md'=> '7px 17px 7px 17px', 'sm'=> '7px 17px 7px 17px', 'xs'=> '7px 17px 7px 17px'),
                    'responsive' => true
                ),
                'active_item_style'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ACTIVE_ITEM_STYLE'),
                ),
                'link_color_active'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ACTIVE_COLOR'),
                    'std'=>'#22b8f0',
				),
                'link_bg_active'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ACTIVE_BACKGROUND_COLOR'),
                    'std'=>'rgba(0, 0, 0, 0.05)',
				),
                'link_border_radius_active'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_BORDER_RADIUS_ACTIVE'),
					'std'=>3,
					'max'=>600,
                    'responsive' => true
                ),
                'item_icon_style'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ITEM_ICON_STYLE'),
                ),
                'icon_position'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ICON_POSITION'),
                    'values'=>array(
                        'left'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
                        'right'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
                        'top'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
                    ),
                    'std'=> 'left',
                ),
                'icon_size'=>array(
					'type'=>'slider',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
					'std'=>'',
					'max'=>200,
                    'responsive'=>true,
				),
                'icon_margin'=>array(
                    'type'=>'margin',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_MARGIN'),
                    'responsive' => true
                ),
                'responsive_menu'=>array(
                    'type'=>'checkbox',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ENABLE_RESPONSIVE'),
                    'std'=>1
                ),
                'responsive_bar_style'=>array(
                    'type'=>'separator',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_RESPONSIVE_BAR'),
                    'depends'=>array(array('responsive_menu', '=', 1)),
                ),
                'responsive_bar_bg'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_COLOR'),
                    'std'=>'rgba(0, 0, 0, .1)',
                    'depends'=>array(array('responsive_menu', '=', 1)),
				),
                'responsive_bar_bg_active'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ACTIVE_BACKGROUND_COLOR'),
                    'std'=>'#22b8f0',
                    'depends'=>array(array('responsive_menu', '=', 1)),
				),
                'responsive_bar_color'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
                    'std'=>'#000',
                    'depends'=>array(array('responsive_menu', '=', 1)),
				),
                'responsive_bar_color_active'=>array(
					'type'=>'color',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_LINK_LIST_ACTIVE_COLOR'),
                    'std'=>'#fff',
                    'depends'=>array(array('responsive_menu', '=', 1)),
                ),
                'global_class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),
            )
        )
    )
);