<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class Url {

	/**
	 * Determines if file is internal
	 *
	 * @param string $sUrl
	 *        	Url of file
	 * @return boolean
	 */
	public static function isInternal($sUrl) {
		if (self::isProtocolRelative ( $sUrl )) {
			$sUrl = self::toAbsolute ( $sUrl );
		}

		$oUrl = clone Uri::getInstance ( $sUrl );

		$sUrlBase = $oUrl->toString ( array (
				'scheme',
				'user',
				'pass',
				'host',
				'port',
				'path'
		) );
		$sUrlHost = $oUrl->toString ( array (
				'scheme',
				'user',
				'pass',
				'host',
				'port'
		) );

		$sBase = Uri::base ();

		if (stripos ( $sUrlBase, $sBase ) !== 0 && ! empty ( $sUrlHost )) {
			return false;
		}

		return true;
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isAbsolute($sUrl) {
		return preg_match ( '#^http#i', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isRootRelative($sUrl) {
		return preg_match ( '#^/[^/]#', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isProtocolRelative($sUrl) {
		return preg_match ( '#^//#', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 */
	public static function isPathRelative($sUrl) {
		return self::isHttpScheme ( $sUrl ) && ! self::isAbsolute ( $sUrl ) && ! self::isProtocolRelative ( $sUrl ) && ! self::isRootRelative ( $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isSSL($sUrl) {
		return preg_match ( '#^https#i', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isDataUri($sUrl) {
		return preg_match ( '#^data:#i', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isInvalid($sUrl) {
		return (empty ( $sUrl ) || trim ( $sUrl ) == '/');
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function isHttpScheme($sUrl) {
		return ! preg_match ( '#^(?!https?)[^:/]+:#i', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function AbsToProtocolRelative($sUrl) {
		return preg_replace ( '#https?:#i', '', $sUrl );
	}

	/**
	 *
	 * @param type $sUrl
	 * @param type $sCurFile
	 */
	public static function toRootRelative($sUrl, $sCurFile = '') {
		if (self::isPathRelative ( $sUrl )) {
			$sUrl = (empty ( $sCurFile ) ? '' : dirname ( $sCurFile ) . '/') . $sUrl;
		}

		$sUrl = Uri::getInstance ( $sUrl )->toString ( array (
				'path',
				'query',
				'fragment'
		) );

		if (self::isPathRelative ( $sUrl )) {
			$sUrl = rtrim ( Uri::base ( true ), '\\/' ) . '/' . $sUrl;
		}

		return $sUrl;
	}

	/**
	 *
	 * @param type $sUrl
	 * @param type $sCurFile
	 */
	public static function toAbsolute($sUrl, $sCurFile = 'SERVER') {
		$oUri = clone Uri::getInstance ( $sCurFile );

		if (self::isPathRelative ( $sUrl )) {
			$oUri->setPath ( dirname ( $oUri->getPath () ) . '/' . $sUrl );
		}

		if (self::isRootRelative ( $sUrl )) {
			$oUri->setPath ( $sUrl );
		}

		if (self::isProtocolRelative ( $sUrl )) {
			$scheme = $oUri->getScheme ();

			if (! empty ( $scheme )) {
				$sUrl = $scheme . ':' . $sUrl;
			}

			$oUri = Uri::getInstance ( $sUrl );
		}

		$sUrl = $oUri->toString ();
		$host = $oUri->getHost ();

		if (! self::isAbsolute ( $sUrl ) && ! empty ( $host )) {
			return '//' . $sUrl;
		}

		return $sUrl;
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function requiresHttpProtocol($sUrl) {
		return preg_match ( '#\.php|^(?![^?\#]*\.(?:css|js|png|jpe?g|gif|bmp)(?:[?\#]|$)).++#i', $sUrl );
	}
}
