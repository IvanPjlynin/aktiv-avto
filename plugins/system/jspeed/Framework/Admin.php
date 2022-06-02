<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\String\StringHelper;

class Admin {
	protected $bBackend;
	protected $params;
	protected $links = array ();

	/**
	 *
	 * @param type $sAction
	 * @return type
	 */
	protected function getImages($sAction = 'exclude') {
		$aLinks = $this->links;
		
		$aOptions = array ();
		
		if (! empty ( $aLinks ['images'] [$sAction] )) {
			foreach ( $aLinks ['images'] [$sAction] as $sImage ) {
				$aOptions [$sImage] = $this->prepareFileValues ( $sImage );
			}
		}
		
		return array_unique ( $aOptions );
	}
	
	/**
	 *
	 * @param type $sType
	 * @param type $sExclude
	 * @return type
	 */
	protected function getOptions($sType, $sExclude = 'files') {
		$aLinks = $this->links;
		
		$aOptions = array ();
		
		if (isset ( $aLinks [$sType] )) {
			foreach ( $aLinks [$sType] as $mainType ) {
				if (! empty ( $mainType )) {
					foreach ( $mainType as $aLink ) {
						if (isset ( $aLink ['url'] ) && $aLink ['url'] != '') {
							if ($sExclude == 'files') {
								$sFile = $this->prepareFileValues ( $aLink ['url'], 'key' );
								$aOptions [$sFile] = $this->prepareFileValues ( $sFile, 'value' );
							} elseif ($sExclude == 'extensions') {
								$sExtension = $this->prepareExtensionValues ( $aLink ['url'], false );
								
								if ($sExtension === false) {
									continue;
								}
								
								$aOptions [$sExtension] = $sExtension;
							}
						} elseif (isset ( $aLink ['content'] ) && $aLink ['content'] != '') {
							if ($sExclude == 'scripts') {
								$sScript = HtmlOptimizer::cleanScript ( $aLink ['content'], 'js' );
								$sScript = trim ( JsOptimizer::optimize ( $sScript ) );
							} elseif ($sExclude == 'styles') {
								$sScript = HtmlOptimizer::cleanScript ( $aLink ['content'], 'css' );
								$sScript = trim ( CssOptimizer::optimize ( $sScript ) );
							}
							
							if (isset ( $sScript )) {
								if (StringHelper::strlen ( $sScript ) > 60) {
									$sScript = StringHelper::substr ( $sScript, 0, 60 );
								}
								
								$sScript = htmlspecialchars ( $sScript );
								
								$aOptions [addslashes ( $sScript )] = $this->prepareScriptValues ( $sScript );
							}
						}
					}
				}
			}
		}
		
		return $aOptions;
	}
	
	/**
	 * Retruns a multi-dimensional array of items to populate the multi-select exclude lists in the
	 * admin settings section
	 *
	 * @param object $sHtml
	 *        	HTML before it's optimized
	 * @param string $sCss
	 *        	Combined css contents
	 * @return array
	 */
	public function getAdminLinks($sHtml, $sCss = '') {
		if (empty ( $this->links )) {
			$hash = $this->params->get ( 'cdn_loading_enable', 0 );
			$sId = md5 ( 'getAdminLinks' . JSPEED_VERSION . serialize ( $hash ) );
			$aFunction = array (
					$this,
					'generateAdminLinks'
			);
			$aArgs = array (
					$sHtml,
					$sCss
			);
			$this->links = Cache::getCallbackCache ( $sId, $aFunction, $aArgs );
		}

		return $this->links;
	}

	/**
	 *
	 * @param type $sHtml
	 * @param type $sCss
	 * @return type
	 */
	public function generateAdminLinks($sHtml, $sCss) {
		$params = clone $this->params;
		$params->set ( 'combine_files_enable', 1 );
		$params->set ( 'javascript', 1 );
		$params->set ( 'css', 1 );
		$params->set ( 'gzip', 0 );
		$params->set ( 'css_minify', 0 );
		$params->set ( 'js_minify', 0 );
		$params->set ( 'html_minify', 0 );
		$params->set ( 'defer_js', 0 );
		$params->set ( 'defer_combined_js', 0 );
		$params->set ( 'preload_combined_js', 0 );
		$params->set ( 'preload_font_face', 0 );
		$params->set ( 'bottom_js', 2 );
		$params->set ( 'include_all_extensions', 1 );
		$params->set ( 'combinedimage_exclude_images', array () );
		$params->set ( 'combinedimage_include_images', array () );

		$params->set ( 'php_and_external_resources', 1 );
		$params->set ( 'inline_scripts', 1 );
		$params->set ( 'replace_imports', 0 );
		$params->set ( 'load_asynchronous', 0 );
		$params->set ( 'cdn_loading_enable', 0 );
		$params->set ( 'lazyload', 0 );

		try {
			$oParser = new Parser ( $params, $sHtml, FileScanner::getInstance () );
			$aLinks = $oParser->getReplacedFiles ();

			if ($sCss == '' && ! empty ( $aLinks ['css'] [0] )) {
				$oCombiner = new Combiner ( $params, $oParser );
				$oCssParser = new CssParser ( $params, $this->bBackend );

				$oCombiner->combineFiles ( $aLinks ['css'] [0], 'css', $oCssParser );
				$sCss = $oCombiner->css;
			}

			$oSpriteGenerator = new SpriteGenerator ( $params );
			$aLinks ['images'] = $oSpriteGenerator->processCssUrls ( $sCss, true );

			$sRegex = $oParser->getLazyLoadRegex ( true );

			preg_match_all ( $sRegex, $oParser->getBodyHtml (), $aMatches );

			$aLinks ['lazyloadclass'] = array_filter ( array_merge ( $aMatches [4], $aMatches [14] ) );
			$aLinks ['lazyload'] = array_merge ( $aMatches [8], $aMatches [18] );
		} catch ( \Exception $e ) {
			$aLinks = array ();
		}

		return $aLinks;
	}

	/**
	 *
	 * @param type $sExcludeParams
	 * @param type $sField
	 * @return type
	 */
	public function prepareFieldOptions($sType, $sExcludeParams, $sGroup = '', $bIncludeExcludes = true) {
		if ($sType == 'lazyload') {
			$aFieldOptions = $this->getLazyLoad ( $sGroup );
			$sGroup = 'file';
		} elseif ($sType == 'images') {
			$sGroup = 'file';
			$aM = explode ( '_', $sExcludeParams );
			$aFieldOptions = $this->getImages ( $aM [1] );
		} else {
			$aFieldOptions = $this->getOptions ( $sType, $sGroup . 's' );
		}

		$aOptions = array ();
		$oParams = $this->params;
		$aExcludes = Helper::getArray ( $oParams->get ( $sExcludeParams, array () ) );

		foreach ( $aExcludes as $sExclude ) {
			$aOptions [$sExclude] = $this->{'prepare' . ucfirst ( $sGroup ) . 'Values'} ( $sExclude );
		}

		// Should we include saved exclude parameters?
		if ($bIncludeExcludes) {
			return array_merge ( $aFieldOptions, $aOptions );
		} else {
			return array_diff ( $aFieldOptions, $aOptions );
		}
	}

	/**
	 *
	 * @param
	 *        	$group
	 * @return type
	 */
	public function getLazyLoad($group) {
		$aLinks = $this->links;

		$aFieldOptions = array ();

		if ($group == 'file' || $group == 'folder') {
			if (! empty ( $aLinks ['lazyload'] )) {
				foreach ( $aLinks ['lazyload'] as $sImage ) {
					if ($group == 'folder') {
						$regex = '#(?<!/)/[^/\n]++$|(?<=^)[^/.\n]++$#';
						$i = 0;

						$sImage = $this->prepareFileValues ( $sImage, 'key' );
						$folder = preg_replace ( $regex, '', $sImage );

						while ( preg_match ( $regex, $folder ) ) {
							$aFieldOptions [$folder] = $this->prepareFileValues ( $folder, 'value' );

							$folder = preg_replace ( $regex, '', $folder );

							$i ++;

							if ($i == 12) {
								break;
							}
						}
					} else {
						$sImage = $this->prepareFileValues ( $sImage, 'key' );

						$aFieldOptions [$sImage] = $this->prepareFileValues ( $sImage, 'value' );
					}
				}
			}
		} elseif ($group == 'class') {
			if (! empty ( $aLinks ['lazyloadclass'] )) {
				foreach ( $aLinks ['lazyloadclass'] as $sClasses ) {
					$aClass = preg_split ( '# #', $sClasses, - 1, PREG_SPLIT_NO_EMPTY );

					foreach ( $aClass as $sClass ) {
						$aFieldOptions [$sClass] = $sClass;
					}
				}
			}
		}

		return array_filter ( $aFieldOptions );
	}

	/**
	 *
	 * @param type $sContent
	 */
	public static function prepareScriptValues($sScript) {
		$sEps = '';

		if (StringHelper::strlen ( $sScript ) > 52) {
			$sScript = StringHelper::substr ( $sScript, 0, 52 );
			$sEps = '...';
			$sScript = $sScript . $sEps;
		}

		if (StringHelper::strlen ( $sScript ) > 26) {
			$sScript = StringHelper::str_ireplace ( $sScript [26], $sScript [26] . "\n", $sScript );
		}

		return $sScript;
	}

	/**
	 *
	 * @param type $sStyle
	 * @return type
	 */
	public static function prepareStyleValues($sStyle) {
		return self::prepareScriptValues ( $sStyle );
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public static function prepareFileValues($sFile, $sType = '', $iLen = 27) {
		if ($sType != 'value') {
			$oFile = Uri::getInstance ( $sFile );

			if (Url::isInternal ( $sFile )) {
				$sFile = $oFile->getPath ();
			} else {
				$sFile = $oFile->toString ( array (
						'scheme',
						'user',
						'pass',
						'host',
						'port',
						'path'
				) );
			}

			if ($sType == 'key') {
				return $sFile;
			}
		}

		$sEps = '';

		if (StringHelper::strlen ( $sFile ) > $iLen) {
			$sFile = StringHelper::substr ( $sFile, - $iLen );
			$sFile = preg_replace ( '#^[^/]*+/#', '/', $sFile );
			$sEps = '...';
		}

		return $sEps . $sFile;
	}

	/**
	 *
	 * @param type $sUrl
	 * @return boolean
	 */
	public static function prepareExtensionValues($sUrl, $bReturn = true) {
		if ($bReturn) {
			return $sUrl;
		}

		static $sHost = '';

		$oUri = Uri::getInstance ();
		$sHost = $sHost == '' ? $oUri->toString ( array (
				'host'
		) ) : $sHost;

		$result = preg_match ( '#^(?:https?:)?//([^/]+)#', $sUrl, $m1 );
		$sExtension = isset ( $m1 [1] ) ? $m1 [1] : '';

		if ($result === 0 || $sExtension == $sHost) {
			$result2 = preg_match ( '#' . Excludes::extensions () . '([^/]+)#', $sUrl, $m );

			if ($result2 === 0) {
				return false;
			} else {
				$sExtension = $m [1];
			}
		}

		return $sExtension;
	}

	/**
	 *
	 * @param type $sImage
	 * @return type
	 */
	public static function prepareImagesValues($sImage) {
		return $sImage;
	}
	public static function prepareFolderValues($sFolder) {
		return self::prepareFileValues ( $sFolder );
	}
	public static function prepareClassValues($sClass) {
		return self::prepareFileValues ( $sClass );
	}
	
	/**
	 *
	 * @param type $params
	 * @param type $bBackend
	 */
	public function __construct(Settings $params, $bBackend = false) {
		$this->params = $params;
		$this->bBackend = $bBackend;
	}
}
