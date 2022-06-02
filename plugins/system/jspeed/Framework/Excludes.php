<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class Excludes {
	/**
	 *
	 * @param type $type
	 * @param type $section
	 * @return type
	 */
	public static function body($type, $section = 'file') {
		if ($type == 'js') {
			if ($section == 'script') {
				return array (
						'var mapconfig90',
						'var addy'
				);
			} else {
				return array (
						'assets.pinterest.com/js/pinit.js'
				);
			}
		}

		if ($type == 'css') {
			return array ();
		}
	}

	/**
	 *
	 * @return type
	 */
	public static function extensions() {
		return '(?>components|modules|plugins/[^/]+|media(?!/system|/jui|/cms|/media|/css|/js|/images))/';
	}

	/**
	 *
	 * @param type $type
	 * @param type $section
	 * @return type
	 */
	public static function head($type, $section = 'file') {
		if ($type == 'js') {
			if ($section == 'script') {
				return array ();
			} else {
				return array (
						'plugin_googlemap3',
						'/jw_allvideos/',
						'/tinymce/'
				);
			}
		}

		if ($type == 'css') {
			return array ();
		}
	}

	/**
	 *
	 * @param type $url
	 * @return type
	 */
	public static function editors($url) {
		return (preg_match ( '#/editors/#i', $url ));
	}
}
