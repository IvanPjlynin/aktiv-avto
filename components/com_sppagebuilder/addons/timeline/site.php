<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

class SppagebuilderAddonTimeline extends SppagebuilderAddons {

    public function render() {
        $class              = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $heading_selector   = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';
        $title              = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';

        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-timeline ' . $class . '">';
        $output .= '<div class="sppb-addon-timeline-text-wrap">';
        $output .= ($title) ? '<' . $heading_selector . ' class="sppb-addon-title">' . $title . '</' . $heading_selector . '>' : '';
        $output .= '</div>'; //.sppb-addon-instagram-text-wrap

        $output .= '<div class="sppb-addon-timeline-wrapper">';

        foreach ($this->addon->settings->sp_timeline_items as $key => $timeline) {
            $oddeven = (round($key % 2) == 0) ? 'even' : 'odd';
            $output .= '<div class="sppb-row timeline-movement ' . $oddeven . '">';
            $output .= '<div class="timeline-badge"></div>';
            if ($oddeven == 'odd') {
                $output .= '<div class="sppb-col-xs-12 sppb-col-sm-6 timeline-item">';
                if(isset($timeline->date) && $timeline->date){
                  $output .= '<p class="timeline-date text-right text-end">' . $timeline->date . '</p>';
                }
                $output .= '</div>';
                $output .= '<div class="sppb-col-xs-12 sppb-col-sm-6 timeline-item">';
                $output .= '<div class="timeline-panel">';
                if(isset($timeline->title) && $timeline->title){
                  $output .= '<p class="title">' . $timeline->title . '</p>';
                }
                if(isset($timeline->content) && $timeline->content){
                  $output .= '<div class="details">' . $timeline->content . '</div>';
                }
                $output .= '</div>';
                $output .= '</div>';
            } elseif ($oddeven == 'even') {
                $output .= '<div class="sppb-col-xs-12 sppb-col-sm-6 timeline-item mobile-block">';
                if(isset($timeline->date) && $timeline->date){
                  $output .= '<p class="timeline-date text-left text-start">' . $timeline->date . '</p>';
                }
                $output .= '</div>';
                $output .= '<div class="sppb-col-xs-12 sppb-col-sm-6 timeline-item">';
                $output .= '<div class="timeline-panel left-part">';
                if(isset($timeline->title) && $timeline->title){
                  $output .= '<p class="title">' . $timeline->title . '</p>';
                }
                if(isset($timeline->content) && $timeline->content){
                  $output .= '<div class="details">' . $timeline->content . '</div>';
                }
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="sppb-col-xs-12 sppb-col-sm-6 timeline-item mobile-hidden">';
                if(isset($timeline->date) && $timeline->date){
                  $output .= '<p class="timeline-date text-left text-start">' . $timeline->date . '</p>';
                }
                $output .= '</div>';
            }
            $output .= '</div>'; //.timeline-movement
        } // foreach timelines

        $output .= '</div>'; //.Timeline

        $output .= '</div>'; //.sppb-addon-instagram-gallery

        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $bar_color = (isset($this->addon->settings->bar_color) && $this->addon->settings->bar_color) ? $this->addon->settings->bar_color : '#0095eb';

        $css = '';
        if ($bar_color) {
            $css .= $addon_id . ' .sppb-addon-timeline .sppb-addon-timeline-wrapper:before, ' . $addon_id . ' .sppb-addon-timeline .sppb-addon-timeline-wrapper .timeline-badge:after, '. $addon_id .' .sppb-addon-timeline .timeline-movement.even:before{';
            $css .= 'background-color: ' . $bar_color . ';';
            $css .= '}';

            $css .= $addon_id . ' .sppb-addon-timeline .sppb-addon-timeline-wrapper .timeline-badge:before, '. $addon_id .' .sppb-addon-timeline .timeline-movement.even:after{';
            $css .= 'border-color: ' . $bar_color . ';';
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate(){


      $output = '
        <#
          let bar_color = data.bar_color || "#0095eb";
          if(bar_color){
        #>
        <style type="text/css">

          #sppb-addon-{{data.id}} .sppb-addon-timeline .sppb-addon-timeline-wrapper:before,
          #sppb-addon-{{data.id}} .sppb-addon-timeline .sppb-addon-timeline-wrapper .timeline-badge:after,
          #sppb-addon-{{data.id}} .sppb-addon-timeline .timeline-movement.even:before {
            background-color: {{bar_color}};
          }

          #sppb-addon-{{data.id}} .sppb-addon-timeline .sppb-addon-timeline-wrapper .timeline-badge:before,
          #sppb-addon-{{data.id}} .sppb-addon-timeline .timeline-movement.even:after {
              border-color: {{bar_color}};
          }
        </style>

        <# } #>
        <div class="sppb-addon sppb-addon-timeline {{ data.class }}">
          <div class="sppb-addon-timeline-text-wrap">
            <# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{ data.title }}</{{ data.heading_selector }}><# } #>
          </div>

          <div class="sppb-addon-timeline-wrapper">
            <#
              _.each(data.sp_timeline_items, function(timeline_item, key){
                let oddeven = ((key%2) == 0 ) ? "even":"odd";
            #>
              <div class="sppb-row timeline-movement {{oddeven}}">
                <div class="timeline-badge"></div>
                <#
                  if(oddeven == "odd") {
                #>
                  <div class="sppb-col-xs-12 sppb-col-sm-6  timeline-item">
                    <p class="timeline-date text-right text-end">{{ timeline_item.date }}</p>
                  </div>
                  <div class="sppb-col-xs-12 sppb-col-sm-6  timeline-item">
                    <div class="timeline-panel">
                      <p class="title sp-editable-content" id="addon-title-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_timeline_items-{{key}}-title">{{ timeline_item.title }}</p>
                      <div class="details sp-editable-content" id="addon-content-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_timeline_items-{{key}}-content">{{{ timeline_item.content }}}</div>
                    </div>
                  </div>

                <# } else { #>

                  <div class="sppb-col-xs-12 sppb-col-sm-6  timeline-item mobile-block">
                    <p class="timeline-date text-left text-start">{{ timeline_item.date }}</p>
                  </div>
                  <div class="sppb-col-xs-12 sppb-col-sm-6  timeline-item">
                    <div class="timeline-panel left-part">
                      <p class="title sp-editable-content" id="addon-title-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_timeline_items-{{key}}-title">{{ timeline_item.title }}</p>
                      <div class="details sp-editable-content" id="addon-content-{{data.id}}-{{key}}" data-id={{data.id}} data-fieldName="sp_timeline_items-{{key}}-content">{{{ timeline_item.content }}}</div>
                    </div>
                  </div>
                  <div class="sppb-col-xs-12 sppb-col-sm-6  timeline-item mobile-hidden">
                    <p class="timeline-date text-left text-start">{{ timeline_item.date }}</p>
                  </div>

                <# } #>
              </div>
            <# }) #>
          </div>
        </div>';
      return $output;
    }

}
