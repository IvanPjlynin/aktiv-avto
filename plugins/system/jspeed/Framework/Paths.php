<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Uri\Uri;

class Paths {

	/**
	 *
	 * @return type
	 */
	public static function assetPath($pathonly = false) {
		$sBaseFolder = Helper::getBaseFolder ();

		return $sBaseFolder . 'media/plg_jspeed/assets';
	}

	/**
	 */
	public static function cachePath($rootrelative = true) {
		$sCache = 'media/plg_jspeed/cache';

		if ($rootrelative) {
			return Helper::getBaseFolder () . $sCache;
		} else {
			return self::rootPath () . $sCache;
		}
	}

	/**
	 *
	 * @return type
	 */
	public static function spriteDir($url = false) {
		if ($url) {
			static $sBaseUrl = '';

			$sBaseUrl = Helper::getBaseFolder ();

			return $sBaseUrl . 'media/plg_jspeed/cache/images/';
		}

		return JPATH_ROOT . '/media/plg_jspeed/cache/images';
	}

	/**
	 *
	 * @param type $url
	 * @return type
	 */
	public static function absolutePath($url) {
		return JPATH_ROOT . DIRECTORY_SEPARATOR . ltrim ( str_replace ( '/', DIRECTORY_SEPARATOR, $url ), '\\/' );
	}

	/**
	 *
	 * @return type
	 */
	public static function rewriteBase() {
		return Helper::getBaseFolder ();
	}

	/**
	 *
	 * @param type $sPath
	 */
	public static function path2Url($sPath) {
		$oUri = clone Uri::getInstance ();
		$sUriPath = $oUri->toString ( array (
				'scheme',
				'user',
				'pass',
				'host',
				'port'
		) ) . self::rewriteBase () . Helper::strReplace ( JPATH_ROOT . DIRECTORY_SEPARATOR, '', $sPath );

		return $sUriPath;
	}

	/**
	 *
	 * @param type $function
	 */
	public static function ajaxUrl($function) {
		$url = Uri::getInstance ()->toString ( array (
				'scheme',
				'user',
				'pass',
				'host',
				'port'
		) );
		$url .= Helper::getBaseFolder ();
		$url .= 'index.php?option=com_ajax&plugin=' . $function . '&format=raw';

		return $url;
	}

	/**
	 */
	public static function rootPath() {
		return JPATH_ROOT . '/';
	}

	/**
	 */
	public static function adminController($name) {
		return Uri::getInstance ()->toString () . '&amp;task=' . $name;
	}
}
