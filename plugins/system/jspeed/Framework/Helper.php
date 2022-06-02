<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Uri\Uri as JUri;

/**
 * Utility class containing helper static functions
 */
class Helper {
	public static $preloads = array ();

	/**
	 * Check if the url is an absolute URL in some way
	 *
	 * @param string $url
	 * @return bool
	 */
	public static function isFullyQualified($url) {
		$isFullyQualified = substr ( $url, 0, 7 ) == 'http://' || substr ( $url, 0, 8 ) == 'https://' || substr ( $url, 0, 2 ) == '//';
		return $isFullyQualified;
	}

	/**
	 * Checks if file (can be external) exists
	 *
	 * @param type $sPath
	 * @return boolean
	 */
	public static function fileExists($sPath) {
		if ((strpos ( $sPath, 'http' ) === 0)) {
			$sFileHeaders = @get_headers ( $sPath );

			return ($sFileHeaders !== false && strpos ( $sFileHeaders [0], '404' ) === false);
		} else {
			return file_exists ( $sPath );
		}
	}

	/**
	 *
	 * @return boolean
	 */
	public static function isMsie() {
		$browser = Browser::getInstance ();

		return ($browser->getBrowser () == 'IE' || $browser->getBrowser () == 'Firefox');
	}

	/**
	 *
	 * @return boolean
	 */
	public static function isOldMsie() {
		$browser = Browser::getInstance ();
		
		return ($browser->getBrowser () == 'IE');
	}

	/**
	 *
	 * @return boolean
	 */
	public static function isMsieLT10() {
		$browser = Browser::getInstance ();

		return ($browser->getBrowser () == 'IE' && $browser->getVersion () < 10);
	}

	/**
	 *
	 * @param type $string
	 * @return type
	 */
	public static function cleanReplacement($string) {
		return strtr ( $string, array (
				'\\' => '\\\\',
				'$' => '\$'
		) );
	}

	/**
	 * Get local path of file from the url if internal
	 * If external or php file, the url is returned
	 *
	 * @param string $sUrl
	 *        	Url of file
	 * @return string File path
	 */
	public static function getFilePath($sUrl) {
		$sUriPath = Uri::base ( true );

		$oUri = clone Uri::getInstance ();
		$oUrl = clone Uri::getInstance ( html_entity_decode ( $sUrl ) );

		// Use absolute file path if file is internal and a static file
		if (Url::isInternal ( $sUrl ) && ! Url::requiresHttpProtocol ( $sUrl )) {
			return Paths::absolutePath ( preg_replace ( '#^' . preg_quote ( $sUriPath, '#' ) . '#', '', $oUrl->getPath () ) );
		} else {
			$scheme = $oUrl->getScheme ();

			if (empty ( $scheme )) {
				$oUrl->setScheme ( $oUri->getScheme () );
			}

			$host = $oUrl->getHost ();

			if (empty ( $host )) {
				$oUrl->setHost ( $oUri->getHost () );
			}

			$path = $oUrl->getPath ();

			if (! empty ( $path )) {
				if (substr ( $path, 0, 1 ) != '/') {
					$oUrl->setPath ( $sUriPath . '/' . $path );
				}
			}

			$sUrl = $oUrl->toString ();

			$query = $oUrl->getQuery ();

			if (! empty ( $query ) && !is_null($query)) {
				parse_str ( $query, $args );

				$sUrl = str_replace ( $query, http_build_query ( $args, '', '&' ), $sUrl );
			}

			return $sUrl;
		}
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function parseUrl($sUrl) {
		preg_match ( '#^(?:([a-z][a-z0-9+.-]*+):(?=//))?(?://(?:(?:([^:@/]*+)(?::([^@/]*+))?@)?([^:/]*+)?(?::([^/]*+))?)?(?=/))?' . '((?:/|^)[^?\#\n]*+)(?:\?([^\#\n]*+))?(?:\#(.*+))?$#i', $sUrl, $m );

		$parts = array ();

		$parts ['scheme'] = ! empty ( $m [1] ) ? $m [1] : null;
		$parts ['user'] = ! empty ( $m [2] ) ? $m [2] : null;
		$parts ['pass'] = ! empty ( $m [3] ) ? $m [3] : null;
		$parts ['host'] = ! empty ( $m [4] ) ? $m [4] : null;
		$parts ['port'] = ! empty ( $m [5] ) ? $m [5] : null;
		$parts ['path'] = ! empty ( $m [6] ) ? $m [6] : '';
		$parts ['query'] = ! empty ( $m [7] ) ? $m [7] : null;
		$parts ['fragment'] = ! empty ( $m [8] ) ? $m [8] : null;

		return $parts;
	}

	/**
	 * Gets the name of the current Editor
	 *
	 * @staticvar string $sEditor
	 * @return string
	 */
	public static function getEditorName() {
		static $sEditor;

		if (! isset ( $sEditor )) {
			$sEditor = Utilities::getEditorName ();
		}

		return $sEditor;
	}

	/**
	 *
	 * @param type $aArray
	 * @param type $sString
	 * @return boolean
	 */
	public static function findExcludes($aArray, $sString, $sType = '', $fullTagString = '') {
		foreach ( $aArray as $sValue ) {
			if ($sType == 'js') {
				$sString = JsOptimizer::optimize ( $sString );
			} elseif ($sType == 'css') {
				$sString = CssOptimizer::optimize ( $sString );
			}

			if ($sValue && strpos ( htmlspecialchars_decode ( $sString ), $sValue ) !== false) {
				return true;
			}

			if ($fullTagString && strpos ( htmlspecialchars_decode ( $fullTagString ), $sValue ) !== false) {
				return true;
			}
		}

		return false;
	}

	/**
	 *
	 * @return type
	 */
	public static function getBaseFolder() {
		return Uri::base ( true ) . '/';
	}

	/**
	 *
	 * @param string $search
	 * @param string $replace
	 * @param string $subject
	 * @return type
	 */
	public static function strReplace($search, $replace, $subject) {
		return str_replace ( self::cleanPath ( $search ), $replace, self::cleanPath ( $subject ) );
	}

	/**
	 *
	 * @param type $str
	 * @return type
	 */
	public static function cleanPath($str) {
		return str_replace ( array (
				'\\\\',
				'\\'
		), '/', $str );
	}

	/**
	 * Determines if document is of html5 doctype
	 *
	 * @return boolean True if doctype is html5
	 */
	public static function isHtml5($sHtml) {
		return ( bool ) preg_match ( '#^<!DOCTYPE html>#i', trim ( $sHtml ) );
	}

	/**
	 * Determine if document is of XHTML doctype
	 *
	 * @return boolean
	 */
	public static function isXhtml($sHtml) {
		return ( bool ) preg_match ( '#^\s*+(?:<!DOCTYPE(?=[^>]+XHTML)|<\?xml.*?\?>)#i', trim ( $sHtml ) );
	}

	/**
	 * If parameter is set will minify HTML before sending to browser;
	 * Inline CSS and JS will also be minified if respective parameters are set
	 *
	 * @return string Optimized HTML
	 * @throws Exception
	 */
	public static function minifyHtml($sHtml, $oParams) {
		if ($oParams->get ( 'html_minify', 0 )) {
			$aOptions = array ();

			if ($oParams->get ( 'css_minify', 0 )) {
				$aOptions ['cssMinifier'] = array (
						'JSpeed\CssOptimizer',
						'optimize'
				);
			}

			if ($oParams->get ( 'js_minify', 0 )) {
				$aOptions ['jsMinifier'] = array (
						'JSpeed\JsOptimizer',
						'optimize'
				);
			}

			$aOptions ['jsonMinifier'] = array (
					'JSpeed\JsonOptimizer',
					'optimize'
			);
			$aOptions ['minifyLevel'] = $oParams->get ( 'html_minify_level', 2 );
			$aOptions ['isXhtml'] = self::isXhtml ( $sHtml );
			$aOptions ['isHtml5'] = self::isHtml5 ( $sHtml );

			$sHtmlMin = HtmlOptimizer::optimize ( $sHtml, $aOptions );

			if ($sHtmlMin == '') {
				$sHtmlMin = $sHtml;
			}

			$sHtml = $sHtmlMin;
		}

		return $sHtml;
	}

	/**
	 * Splits a string into an array using any regular delimiter or whitespace
	 *
	 * @param string $sString
	 *        	Delimited string of components
	 * @return array An array of the components
	 */
	public static function getArray($sString) {
		if (is_array ( $sString )) {
			$aArray = $sString;
		} else {
			$aArray = explode ( ',', trim ( $sString ) );
		}

		$aArray = array_map ( function ($sValue) {
			return trim ( $sValue );
		}, $aArray );

		return array_filter ( $aArray );
	}

	/**
	 *
	 * @param type $url
	 * @param array $params
	 */
	public static function postAsync($url, $params, array $posts) {
		foreach ( $posts as $key => &$val ) {
			if (is_array ( $val )) {
				$val = implode ( ',', $val );
			}

			$post_params [] = $key . '=' . urlencode ( $val );
		}

		$post_string = implode ( '&', $post_params );

		$parts = Helper::parseUrl ( $url );

		if (isset ( $parts ['scheme'] ) && ($parts ['scheme'] == 'https')) {
			$protocol = 'ssl://';
			$default_port = 443;
		} else {
			$protocol = '';
			$default_port = 80;
		}

		$fp = @fsockopen ( $protocol . $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : $default_port, $errno, $errstr, 1 );

		if (! $fp) {
		} else {
			$out = "POST " . $parts ['path'] . '?' . $parts ['query'] . " HTTP/1.1\r\n";
			$out .= "Host: " . $parts ['host'] . "\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "Content-Length: " . strlen ( $post_string ) . "\r\n";
			$out .= "Connection: Close\r\n\r\n";

			if (isset ( $post_string )) {
				$out .= $post_string;
			}

			fwrite ( $fp, $out );
			fclose ( $fp );
		}
	}

	/**
	 *
	 * @param type $sHtml
	 */
	public static function validateHtml($sHtml) {
		return preg_match ( '#^(?>(?><?[^<]*+)*?<html(?><?[^<]*+)*?<head(?><?[^<]*+)*?</head\s*+>)(?><?[^<]*+)*?' . '<body.*</body\s*+>(?><?[^<]*+)*?</html\s*+>#is', $sHtml );
	}

	/**
	 *
	 * @param type $image
	 * @return type
	 */
	public static function prepareImageUrl($image) {
		return array (
				'path' => Utilities::encrypt ( $image )
		);
	}

	/**
	 */
	public static function getCDNDomains($params, $path, $orig_path, $domains_only = false, $reset = false) {
		// If feature disabled just return the path if present
		if (! $params->get ( 'cdn_loading_enable', '0' ) && ! $domains_only) {
			return $domains_only ? array () : $orig_path;
		}

		// Cache processed files to ensure the same file isn't placed on a different domain
		// if it occurs on the page twice
		static $aDomain = array ();
		static $aFilePaths = array ();

		// reset $aFilePaths for unit testing
		if ($reset) {
			foreach ( $aFilePaths as $key => $value ) {
				unset ( $aFilePaths [$key] );
			}

			foreach ( $aDomain as $key => $value ) {
				unset ( $aDomain [$key] );
			}

			return false;
		}

		if (empty ( $aDomain )) {
			switch ($params->get ( 'cdn_scheme', '0' )) {
				case '1' :
					$scheme = 'http:';
					break;
				case '2' :
					$scheme = 'https:';
					break;
				case '0' :
				default :
					$scheme = '';
					break;
			}

			$aDefaultFiles = self::getStaticFiles ();

			if (trim ( $params->get ( 'cdn_loadingdomain_1', '' ) ) != '') {
				$domain1 = $params->get ( 'cdn_loadingdomain_1' );
				$staticfiles1 = implode ( '|', $params->get ( 'cdn_staticfiles', $aDefaultFiles ) );

				$aDomain [$scheme . self::prepareDomain ( $domain1 )] = $staticfiles1;
			}

			if (trim ( $params->get ( 'cdn_loadingdomain_2', '' ) ) != '') {
				$domain2 = $params->get ( 'cdn_loadingdomain_2' );
				$staticfiles2 = implode ( '|', $params->get ( 'cdn_staticfiles_2', $aDefaultFiles ) );

				$aDomain [$scheme . self::prepareDomain ( $domain2 )] = $staticfiles2;
			}

			if (trim ( $params->get ( 'cdn_loadingdomain_3', '' ) ) != '') {
				$domain3 = $params->get ( 'cdn_loadingdomain_3' );
				$staticfiles3 = implode ( '|', $params->get ( 'cdn_staticfiles_3', $aDefaultFiles ) );

				$aDomain [$scheme . self::prepareDomain ( $domain3 )] = $staticfiles3;
			}
		}

		// Sprite Generator needs this to remove CDN domains from images to create sprite
		if ($domains_only) {
			return $aDomain;
		}

		// if no domain is configured abort
		if (empty ( $aDomain )) {
			return $domains_only ? array () : $orig_path;
		}

		// If we haven't matched a cdn domain to this file yet then find one.
		if (! isset ( $aFilePaths [$path] )) {
			$aFilePaths [$path] = self::selectDomain ( $aDomain, $path );
		}

		if ($aFilePaths [$path] === false) {
			return $orig_path;
		}

		return $aFilePaths [$path];
	}

	/**
	 *
	 * @param type $domain
	 * @return type
	 */
	private static function prepareDomain($domain) {
		return '//' . preg_replace ( '#^(?:https?:)?//|/$#i', '', trim ( $domain ) );
	}

	/**
	 *
	 * @staticvar int $iIndex
	 * @param type $aDomain
	 * @return type
	 */
	private static function selectDomain(&$aDomain, $sPath) {
		// If no domain is matched to a configured file type then we'll just return the file
		$sCdnUrl = false;

		for($i = 0; count ( $aDomain ) > $i; $i ++) {
			$sStaticFiles = current ( $aDomain );
			$sDomain = key ( $aDomain );
			next ( $aDomain );

			if (current ( $aDomain ) === false) {
				reset ( $aDomain );
			}

			if (preg_match ( '#\.(?>' . $sStaticFiles . ')#i', $sPath )) {
				// Prepend the cdn domain to the file path if a match is found.
				$sCdnUrl = $sDomain . $sPath;

				break;
			}
		}

		return $sCdnUrl;
	}

	/**
	 * Returns array of default static files to load from CDN
	 *
	 *
	 * @return array $aStaticFiles Array of file type extensions
	 */
	public static function getStaticFiles() {
		$aStaticFiles = array (
				'css',
				'js',
				'jpe?g',
				'gif',
				'png',
				'ico',
				'bmp',
				'pdf',
				'webp',
				'svg'
		);

		return $aStaticFiles;
	}

	/**
	 * Returns an array of file types that will be loaded by CDN
	 *
	 * @return array $aCdnFileTypes Array of file type extensions
	 */
	public static function getCdnFileTypes($params) {
		$aCdnFileTypes = null;

		if (is_null ( $aCdnFileTypes )) {
			$aCdnFileTypes = array ();
			$aDomains = Helper::getCDNDomains ( $params, '', '', true );

			if (! empty ( $aDomains )) {
				foreach ( $aDomains as $cdn_file_types ) {
					$aCdnFileTypes = array_merge ( $aCdnFileTypes, explode ( '|', $cdn_file_types ) );
				}

				$aCdnFileTypes = array_unique ( $aCdnFileTypes );
			}
		}

		return $aCdnFileTypes;
	}
	public static function addHttp2Push($url, $type, $deferred = false, $originalImageSrc = null) {
		// Avoid invalid urls
		if ($url == '' || strpos ( $url, 'data:image' ) === 0) {
			return false;
		}

		// Skip external files
		if (! Url::isInternal ( $url )) {
			return $url;
		}

		static $bAlreadyCached = null;

		$params = Plugin::getPluginParams ();

		// If http2 is not enabled or file is deferred when 'Exclude deferred' is enabled, return
		if (! $params->get ( 'http2_push_enabled', '0' ) || ($params->get ( 'http2_exclude_deferred', '1' ) && $deferred)) {
			return $url;
		}

		if ($params->get ( 'cdn_loading_enable', '0' )) {
			static $sCdnFileTypesRegex = '';

			if (empty ( $sCdnFileTypesRegex )) {
				$sCdnFileTypesRegex = implode ( '|', self::getCdnFileTypes ( $params ) );
			}

			// If this file type will be loaded by CDN don't push
			if ($sCdnFileTypesRegex != '' && preg_match ( '#\.(?>' . $sCdnFileTypesRegex . ')#i', $url )) {
				return $url;
			}
		}

		if ($type == 'js') {
			$type = 'script';
		}

		if ($type == 'css') {
			$type = 'style';
		}

		if (! in_array ( $type, $params->get ( 'http2_file_types', array (
				'style',
				'script',
				'font',
				'image'
		) ) )) {
			return $url;
		}

		if ($params->get ( 'http2_exclude_dynamic', 0 ) && stripos ( $url, 'index.php' ) !== false) {
			return $url;
		}

		if ($type == 'font') {
			// Only push fonts of type woff, ttf
			if (preg_match ( "#\.\K(?:woff|ttf)(?=$|[\#?])#", $url, $m, $params ) == '1') {
				self::addToPreload ( $url, $type, $m [0] );
			} else {
				return $url;
			}
		}

		// Populate preload variable
		self::addToPreload ( $url, $type, '', $params );
		
		// Special handling to remove original images if optimized
		if($originalImageSrc && array_key_exists($originalImageSrc, self::$preloads)) {
			unset(self::$preloads[$originalImageSrc]);
		}
	}
	private static function addToPreload($url, $type, $ext, $params) {
		$url = html_entity_decode ( $url );

		$fixRelativeLinks = $params->get ( 'fix_relative_links', 1 );
		if ($fixRelativeLinks && (! self::isFullyQualified ( $url ) && stripos ( $url, JUri::root ( false ) ) === false) && substr ( $url, 0, 1 ) != '/' && substr ( $url, 0, 1 ) != '#') {
			$base = JUri::base ( true ) . '/';
			$url = $base . ltrim ( $url, '/' );
		}

		$preload = "<{$url}>; rel=preload; as={$type}";

		if ($type == 'font') {
			$preload .= '; crossorigin';

			switch ($ext) {
				case 'woff' :
					$preload .= '; type="font/woff"';
					break;
				case 'ttf' :
					$preload .= '; type="font/ttf"';
					break;
				default :
					break;
			}
		}

		if (! in_array ( $preload, self::$preloads )) {
			// Need to remove query string if any and trailing slash to match images conversion
			self::$preloads [md5(ltrim(preg_replace('/\?.*/', '', $url), '/'))] = $preload;
		}
	}
}
