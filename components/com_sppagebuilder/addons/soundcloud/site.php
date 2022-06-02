<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

class SppagebuilderAddonSoundcloud extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$embed = (isset($this->addon->settings->embed) && $this->addon->settings->embed) ? $this->addon->settings->embed : '';

		//Output
		if($embed) {
			$output  = '<div class="sppb-addon sppb-addon-soundcloud ' . $class . '">';
			$output .= ($title) ? '<'.$heading_selector.' class="sppb-addon-title">' . $title . '</'.$heading_selector.'>' : '';
			$output .= '<div class="sppb-addon-content">';
			$output .= '<div class="sppb-embed-responsive sppb-embed-responsive-16by9">';
			$output .= $embed;
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';

			return $output;
		}

		return;
	}

	public static function getTemplate(){

		$output = '
				<div class="sppb-addon sppb-addon-soundcloud {{ data.class }}">
					<# if( !_.isEmpty( data.title ) ){ #><{{ data.heading_selector }} class="sppb-addon-title  sp-inline-editable-element" data-id={{data.id}} data-fieldName="title" contenteditable="true">{{{ data.title }}}</{{ data.heading_selector }}><# } #>
					<div class="sppb-iframe-drag-overlay"></div>
					<div class="sppb-addon-content">
						<div class="sppb-embed-responsive sppb-embed-responsive-16by9">
							{{{ data.embed }}}
						</div>
					</div>
				</div>
				';

		return $output;
	}

}
