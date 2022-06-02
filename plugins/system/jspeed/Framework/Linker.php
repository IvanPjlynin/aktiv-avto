<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\String\StringHelper;

class Linker {

	/** @var string         Document line end */
	protected $sLnEnd;

	/** @var string         Document tab */
	protected $sTab;

	/** @var string cache id * */
	protected $params;

	/** @var array The single CSS files only minified */
	protected $minifiedFiles;
	
	/** @var boolean Store the preloaded font tags */
	protected $preloadedFonts;
	
	/** @var boolean Store the custom preloaded font links */
	protected $preloadedCustomFontLinks;
	
	/** @var boolean Store the custom preloaded scripts */
	protected $preloadedCustomScriptLinks;
	
	/** @var boolean Store the custom preloaded styles */
	protected $preloadedCustomStyleLinks;
	
	/** @var boolean Store the custom preloaded images */
	protected $preloadedCustomImageLinks;
	
	/** @var boolean Store the added html custom code */
	protected $addedHtmlCode;
	
	/** @var array Store CSS files to be loaded through JS */
	protected $cssFileLoadedByJS;
	
	/** @var array Store JS files to be loaded through JS */
	protected $jsFileLoadedByJS;
	
	/** @var Parser Object       Parser object */
	public $oParser;

	/**
	 *
	 * @param type $aUrlArrays
	 * @return type
	 */
	private function getCacheId($aUrlArrays) {
		$id = md5 ( serialize ( $aUrlArrays ) );

		return $id;
	}

	/**
	 *
	 * @return type
	 */
	protected function getNewJsLink() {
		return '<script src="URL"></script>';
	}

	/**
	 *
	 * @return string
	 */
	protected function getNewCssLink() {
		return '<link rel="stylesheet" type="text/css" href="URL" />';
	}

	/**
	 * Use generated id to cache aggregated file
	 *
	 * @param string $sType
	 *        	css or js
	 * @param string $sLink
	 *        	Url for aggregated file
	 */
	protected function getCombinedFiles($aLinks, $sId, $sType) {
		$aArgs = array (
				$aLinks,
				$sType
		);

		$oCombiner = new Combiner ( $this->params, $this->oParser );
		$aFunction = array (
				&$oCombiner,
				'getContents'
		);

		$bCached = $this->loadCache ( $aFunction, $aArgs, $sId );

		return $bCached;
	}

	/**
	 *
	 * @param type $aImgs
	 */
	protected function addImgAttributes($aImgs) {
		$sHtml = $this->oParser->getBodyHtml ();
		$sId = md5 ( serialize ( $aImgs ) );

		try {
			$aImgAttributes = $this->loadCache ( array (
					$this,
					'getCachedImgAttributes'
			), array (
					$aImgs
			), $sId );
		} catch ( \Exception $e ) {
			return;
		}

		$this->oParser->setBodyHtml ( str_replace ( $aImgs [0], $aImgAttributes, $sHtml ) );
	}

	/**
	 */
	protected function runCronTasks() {
		$sId = md5 ( 'CRONTASKS' );

		$aArgs = array (
				$this->oParser
		);

		$oCron = new Cronjob ( $this->params );
		$aFunction = array (
				$oCron,
				'runCronTasks'
		);

		try {
			$bCached = $this->loadCache ( $aFunction, $aArgs, $sId );
		} catch ( \Exception $e ) {
		}
	}

	/**
	 * Returns url of aggregated file
	 *
	 * @param string $sFile
	 *        	Aggregated file name
	 * @param string $sType
	 *        	css or js
	 * @param mixed $bGz
	 *        	True (or 1) if gzip set and enabled
	 * @param number $sTime
	 *        	Expire header time
	 * @return string Url of aggregated file
	 */
	protected function buildUrl($sId, $sType) {
		$bGz = $this->isGZ ();

		$sPath = Paths::cachePath ();
		$sUrl = $sPath . '/' . $sType . '/' . $sId . '_JSpeed.' . $sType; // . ($bGz ? '.gz' : '');

		$this->createStaticFiles ( $sId, $sType, $sUrl );

		if ($this->params->get ( 'cdn_loading_enable', '0' ) && ! Url::isRootRelative ( $sUrl )) {
			$sUrl = Url::toRootRelative ( $sUrl );
		}

		return Helper::getCDNDomains ( $this->params, $sUrl, $sUrl );
	}

	/**
	 * Create static combined file if not yet exists
	 *
	 *
	 * @param $sId string
	 *        	Cache id of file
	 * @param $sType string
	 *        	Type of file css|js
	 * @param $sUrl string
	 *        	Url of combine file
	 *        	
	 * @return null
	 */
	protected function createStaticFiles($sId, $sType, $sUrl) {
		// Get the last file index saved for the type file, this will indicate how many combined files are on the page
		$iIndex = $this->oParser->{'iIndex_' . $sType};

		// ADAPTIVE CONTENTS: remove any matched tag for bots
		// Check for user agent exclusion
		if($this->params->get('adaptive_contents_enable', 0) &&
		(($this->params->get('adaptive_contents_remove_all_css', 0) && $sType == 'css') ||
		 ($this->params->get('adaptive_contents_remove_all_js', 0) && $sType == 'js'))) {
			if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
				$user_agent = $_SERVER ['HTTP_USER_AGENT'];
				$botRegexPattern = array();
				$botsList = $this->params->get('adaptive_contents_bots_list', array());
				if (! empty ( $botsList )) {
					foreach ( $botsList as &$bot ) {
						$bot = preg_quote($bot);
					}
					$botRegexPattern = implode('|', $botsList);
				}
				
				$isBot = preg_match("/{$botRegexPattern}/i", $user_agent) || array_key_exists($_SERVER['REMOTE_ADDR'], JsonManager::$botsIP);
				if($isBot) {
					// File path of combined file
					// Loop through index of each file
					for($i = 0; $i <= $iIndex; $i ++) {
						$sCombinedFile = Helper::getFilePath ( str_replace ( 'JSpeed', $i, $sUrl ) );
						Utilities::write ( $sCombinedFile, '' );
					}
					return;
				}
			}
		}
						
		// GET the $sContent including the still present DELIMITER, then splits those up back in single files that can be minimized only
		if(($sType == 'css' && $this->params->get('only_css_minify', 0)) || ($sType == 'js' && $this->params->get('only_js_minify', 0))) {
			// Loop through index of each file
			for($i = 0; $i <= $iIndex; $i ++) {
				$aGet = array (
						'f' => $sId,
						'i' => $i,
						'type' => $sType
				);
				
				$sContent = Output::getCombinedFile ( $aGet, false );
				$sContentArray = explode('DELIMITER', $sContent);
				if(!empty($sContentArray)) {
					foreach ($sContentArray as $index=>$sContentFile) {
						if($sContentFile) {
							// Create file and any directory
							$sCombinedFileCss = Helper::getFilePath ( 'media/plg_jspeed/cache/' . $sType . '/' . ($sId . '_' . $i . '_' . $index) . '.' .$sType );
							$this->minifiedFiles[$sType][] = Uri::root(true) . '/media/plg_jspeed/cache/' . $sType . '/' . ($sId . '_' . $i . '_' . $index) . '.' . $sType;
							if(! file_exists ( $sCombinedFileCss )) {
								Utilities::write ( $sCombinedFileCss, $sContentFile );
							}
						}
					}
				}
			}
		} else {
			// Loop through index of each file
			for($i = 0; $i <= $iIndex; $i ++) {
				// File path of combined file
				$sCombinedFile = Helper::getFilePath ( str_replace ( 'JSpeed', $i, $sUrl ) );

				if (! file_exists ( $sCombinedFile )) {
					$aGet = array (
							'f' => $sId,
							'i' => $i,
							'type' => $sType
					);

					$sContent = Output::getCombinedFile ( $aGet, false );

					if ($sContent === false) {
						throw new \Exception ( 'Error retrieving combined contents' );
					}

					// Create file and any directory
					if (! Utilities::write ( $sCombinedFile, $sContent )) {
						Cache::deleteCache ();

						throw new \Exception ( 'Error creating static file' );
					}
				}
			}
		}
	}

	/**
	 *
	 * @return type
	 */
	protected function getCDNDomain($sType) {
		if ($this->params->get ( 'cdn_loading_enable', '0' )) {
			return Helper::getCDNDomains ( $this->params, Paths::assetPath ( true ) );
		}

		return Paths::assetPath ();
	}

	/**
	 * Insert url of aggregated file in html
	 *
	 * @param string $sNewLink
	 *        	Url of aggregated file
	 */
	protected function replaceLinks($sId, $sType, $sSection = 'head') {
		$oParser = $this->oParser;
		$sSearchArea = $this->oParser->getFullHtml ();

		if(($sType == 'css' && $this->params->get('only_css_minify', 0)) || ($sType == 'js' && $this->params->get('only_js_minify', 0))) {
			$sNewLink = '';
			$sUrl = $this->buildUrl ( $sId, $sType );
			// Replace everything with multiple files only minified
			if(count($this->minifiedFiles[$sType])) {
				$isAllDefer = $this->params->get ( 'defer_combined_js', 0 );
				foreach ($this->minifiedFiles[$sType] as $singleAssetFile) {
					$sLink = $this->{'getNew' . ucfirst ( $sType ) . 'Link'} ();
					if($sType == 'js' && $isAllDefer) {
						$sLink = str_replace('<script', '<script defer', $sLink);
					}
					$sNewLink .= str_replace ( 'URL', $singleAssetFile, $sLink );
				}
			}
		} else {
			$sLink = $this->{'getNew' . ucfirst ( $sType ) . 'Link'} ();
			$sUrl = $this->buildUrl ( $sId, $sType );

			$sNewLink = str_replace ( 'URL', $sUrl, $sLink );
		}

		// Check if combined script links must be loaded in preload mode
		$preloadedScript = false;
		if ($sType == 'js' && $this->params->get ( 'preload_combined_js', 0 ) && ! Helper::isMsie ()) {
			$sNewLink = str_replace ( '></script>', ' />', $sNewLink );
			$sNewLink = str_replace ( '<script', '<link rel="preload" as="script" onload="var script = document.createElement(\'script\'); script.src = this.href; document.body.appendChild(script);"', $sNewLink );
			$sNewLink = str_replace ( 'src=', 'href=', $sNewLink );
			$preloadedScript = true;
		}
		
		// Check if all new script links must have a defer attribute while preserving the execution order
		if ($sType == 'js' && $this->params->get ( 'defer_combined_js', 0 ) && ! $this->params->get ( 'load_asynchronous', 0 ) && !$preloadedScript) {
			$sNewLink = str_replace ( '></script>', ' defer></script>', $sNewLink );
		}

		// Check if all new style links must me executed in preload mode non-render blocking
		if ($sType == 'css' && $this->params->get ( 'defer_combined_css', 0 ) && ! Helper::isMsie () && !$this->preloadedFonts) {
			// Just replace with the noscript fallback tag and totally remove the CSS files
			if ($this->params->get ( 'load_css_byjs', 0 )) {
				$sNewLink = str_replace( '<link rel="stylesheet" type="text/css"', '<noscript><link rel="stylesheet" type="text/css"', $sNewLink);
				$sNewLink = str_replace( '/>', '/></noscript>', $sNewLink);
			} else {
				$loadCssDelay = $this->params->get ( 'defer_combined_css_delay', 1 );
				$sNewLink = str_replace ( '<link rel="stylesheet" type="text/css"', '<style>html{visibility:hidden}</style><link rel="preload" as="style" onload="setTimeout(function(){document.querySelector(\'html\').style.visibility=\'visible\';}, ' . $loadCssDelay . ');this.onload=null;this.rel=\'stylesheet\'"', $sNewLink );
			}
		}

		// If the last javascript file on the HTML page was not excluded while preserving
		// execution order, we may need to place it at the bottom and add the async
		// or defer attribute
		if ($sType == 'js' && ! $this->oParser->bExclude_js) {
			// Get last js index
			$iIndex = $this->oParser->iIndex_js;
			$sNewLinkLast = str_replace ( 'JSpeed', $iIndex, $sNewLink );

			// If last combined file is being inserted at the bottom of the page then
			// add the async or defer attribute
			if ($sSection == 'body') {
				// Add async attribute to last combined js file if option is set
				$sNewLinkLast = str_replace ( '></script>', $this->getAsyncAttribute ( $iIndex ) . '></script>', $sNewLinkLast );
			}

			// Insert script tag at the appropriate section in the HTML
			if ($this->params->get ( 'load_js_byjs', 0 )) {
				$this->jsFileLoadedByJS[$iIndex] = str_replace ( 'JSpeed', $iIndex, $sUrl );
			} else {
				$sSearchArea = preg_replace ( '#' . self::{'getEnd' . ucfirst ( $sSection ) . 'Tag'} () . '#i', $this->sTab . $sNewLinkLast . $this->sLnEnd . '</' . $sSection . '>', $sSearchArea, 1 );
			}

			// Add all single minified CSS files to the http2push
			if($this->params->get('only_js_minify', 0) && count($this->minifiedFiles[$sType])) {
				foreach ($this->minifiedFiles[$sType] as $singleAssetFile) {
					Helper::addHttp2Push ( $singleAssetFile, $sType );
				}
			} else {
				$url = str_replace ( 'JSpeed', $iIndex, $sUrl );
				$deferred = $this->oParser->isFileDeferred ( $sNewLinkLast );
				Helper::addHttp2Push ( $url, $sType, $deferred );
			}
		}

		// Replace placeholders in HTML with combined files
		$sSearchArea = preg_replace_callback ( '#<JSPEED_' . strtoupper ( $sType ) . '([^>]++)>#', function ($aM) use ($sNewLink, $sUrl, $sType) {
			$file = str_replace ( 'JSpeed', $aM [1], $sNewLink );

			// Add all single minified CSS files to the http2push
			if((($sType == 'css' && $this->params->get('only_css_minify', 0)) || ($sType == 'js' && $this->params->get('only_js_minify', 0))) && count($this->minifiedFiles[$sType])) {
				foreach ($this->minifiedFiles[$sType] as $singleAssetFile) {
					Helper::addHttp2Push ( $singleAssetFile, $sType );
				}
			} else {
				$url = str_replace ( 'JSpeed', $aM [1], $sUrl );
				Helper::addHttp2Push ( $url, $sType );
				
				// Add combined JS/CSS files to the array stack for later script loading
				if ($sType == 'js' && $this->params->get ( 'load_js_byjs', 0 )) {
					$this->jsFileLoadedByJS[$aM [1]] = $url;
					$file = null;
				}
				
				if ($sType == 'css' && $this->params->get ( 'load_css_byjs', 0 )) {
					$this->cssFileLoadedByJS[] = $url;
				}
			}
			
			// Check if there are any fonts found that must be preloaded
			if($sType == 'css' && $this->params->get('preload_font_face', 0) && ! Helper::isOldMsie () && !$this->preloadedFonts) {
				$oCache = Cache::getCacheObject();
				$cacheName = 'jspeed_preloaded_fonts_' . Factory::getApplication()->getTemplate();
				$preloadedFonts = $oCache->get($cacheName);
				if(!empty($preloadedFonts)) {
					foreach ($preloadedFonts as $fontToPreload) {
						$file .= '<link rel="preload" href="' . $fontToPreload . '" as="font" crossorigin />';
					}
					$this->preloadedFonts = true;
				}
			}
			
			// Check if there are any custom font links found that must be preloaded
			if($sType == 'css' && !empty($this->params->get('preload_font_links', [])) && ! Helper::isOldMsie () && !$this->preloadedCustomFontLinks) {
				$customLinksToPreload = $this->params->get('preload_font_links', []);
				foreach ($customLinksToPreload as $customLinkToPreload) {
					$type = $customLinkToPreload->type ? 'type="' . $customLinkToPreload->type . '"' : null;
					$file .= '<link rel="preload" href="' . $customLinkToPreload->value . '" as="font" ' . $type . ' crossorigin />';
				}
				$this->preloadedCustomFontLinks = true;
			}
			
			// Check if there are any custom script links found that must be preloaded
			if($sType == 'css' && !empty($this->params->get('preload_script_links', [])) && ! Helper::isOldMsie () && !$this->preloadedCustomScriptLinks) {
				$customLinksToPreload = $this->params->get('preload_script_links', []);
				foreach ($customLinksToPreload as $customLinkToPreload) {
					$file .= '<link rel="preload" href="' . $customLinkToPreload->value . '" as="script" />';
				}
				$this->preloadedCustomScriptLinks = true;
			}
			
			// Check if there are any custom style links found that must be preloaded
			if($sType == 'css' && !empty($this->params->get('preload_styles_links', [])) && ! Helper::isOldMsie () && !$this->preloadedCustomStyleLinks) {
				$customLinksToPreload = $this->params->get('preload_styles_links', []);
				foreach ($customLinksToPreload as $customLinkToPreload) {
					$file .= '<link rel="preload" href="' . $customLinkToPreload->value . '" as="style" />';
				}
				$this->preloadedCustomStyleLinks = true;
			}
			
			// Check if there are any custom image links found that must be preloaded
			if($sType == 'css' && !empty($this->params->get('preload_images_links', [])) && ! Helper::isOldMsie () && !$this->preloadedCustomImageLinks) {
				$customLinksToPreload = $this->params->get('preload_images_links', []);
				foreach ($customLinksToPreload as $customLinkToPreload) {
					$file .= '<link rel="preload" href="' . $customLinkToPreload->value . '" as="image" />';
				}
				$this->preloadedCustomImageLinks = true;
			}
			
			if($sType == 'css' && $this->params->get('add_custom_html_code', 0) && !$this->addedHtmlCode) {
				$htmlCode =  $this->params->get('custom_html_code', null);
				$file .= $htmlCode;
				$this->addedHtmlCode = true;
			}
			
			return $file;
		}, $sSearchArea );

		// Add the js files to be loaded by js inline script
		if ($sType == 'js' && $this->params->get ( 'load_js_byjs', 0 ) && !empty($this->jsFileLoadedByJS)) {
			ksort($this->jsFileLoadedByJS);
			$cssLoad = "<script>document.addEventListener('DOMContentLoaded', function() {
				var jspeed_js_urls = ['" . implode('\',\'', $this->jsFileLoadedByJS) . "'];
		    	jspeed_js_urls.forEach(function(url, index){
		       		var jspeedJsLink = document.createElement('script');
					jspeedJsLink.src = url;
					var headTag = document.getElementsByTagName('head')[0];
					headTag.appendChild(jspeedJsLink);
		    	});
			});</script>";
			$sSearchArea = StringHelper::str_ireplace('</head>', $cssLoad . '</head>', $sSearchArea);
		}

		// Add the css files to be loaded by js inline script
		if ($sType == 'css' && $this->params->get ( 'load_css_byjs', 0 ) && !empty($this->cssFileLoadedByJS)) {
			$cssLoad = "<style>html{visibility:hidden}</style>
				<script>document.addEventListener('DOMContentLoaded', function() {
				setTimeout(function(){document.querySelector('html').style.visibility='visible';}, " . $this->params->get ( 'defer_combined_css_delay', 100 ) . ");
				var jspeed_css_urls = ['" . implode('\',\'', $this->cssFileLoadedByJS) . "'];
		    	jspeed_css_urls.forEach(function(url, index){
		       		var jspeedCssLink = document.createElement('link');
					jspeedCssLink.rel = 'stylesheet';
					jspeedCssLink.href = url;
					var headTag = document.getElementsByTagName('head')[0];
					headTag.appendChild(jspeedCssLink);
		    	});
			});</script>";
			$sSearchArea = StringHelper::str_ireplace('</head>', $cssLoad . '</head>', $sSearchArea);
		}
			
		$this->oParser->setFullHtml ( $sSearchArea );
	}

	/**
	 * Adds the async attribute to the aggregated js file link
	 *
	 * @return string
	 */
	protected function getAsyncAttribute($iIndex) {
		if ($this->params->get ( 'load_asynchronous', '0' )) {
			// if there are no deferred javascript files and if the combined file wasn't split
			// then it's safe to use async, otherwise we use defer
			$aDefers = $this->oParser->getDeferredFiles ();
			$attr = ($iIndex == 0 && empty ( $aDefers )) ? 'async' : 'defer';
			$sAsyncAttribute = Helper::isXhtml ( $this->oParser->sHtml ) ? ' ' . $attr . '="' . $attr . '" ' : ' ' . $attr . ' ';

			return $sAsyncAttribute;
		} else {
			return '';
		}
	}

	/**
	 *
	 * @param type $aImgs
	 */
	public function getCachedImgAttributes($aImgs) {
		$aImgAttributes = array ();
		$total = count ( $aImgs [0] );

		for($i = 0; $i < $total; $i ++) {
			$sUrl = ! empty ( $aImgs [1] [$i] ) ? $aImgs [1] [$i] : (! empty ( $aImgs [2] [$i] ) ? $aImgs [2] [$i] : $aImgs [3] [$i]);

			if (Url::isInvalid ( $sUrl ) || ! $this->oParser->isHttpAdapterAvailable ( $sUrl ) || Url::isSSL ( $sUrl ) && ! extension_loaded ( 'openssl' ) || ! Url::isHttpScheme ( $sUrl )) {
				$aImgAttributes [] = $aImgs [0] [$i];
				continue;
			}

			$sPath = Helper::getFilePath ( $sUrl );

			if (file_exists ( $sPath )) {
				$aSize = getimagesize ( $sPath );

				if ($aSize === false || empty ( $aSize ) || ($aSize [0] == '1' && $aSize [1] == '1')) {
					$aImgAttributes [] = $aImgs [0] [$i];
					continue;
				}

				$sImg = preg_replace ( '#(?:width|height)\s*+=(?:\s*+"([^">]*+)"|\s*+\'([^\'>]*+)\'|([^\s>]++))#i', '', $aImgs [0] [$i] );
				$aImgAttributes [] = preg_replace ( '#\s*+/?>#', ' ' . $aSize [3] . ' />', $sImg );
			} else {
				$aImgAttributes [] = $aImgs [0] [$i];
				continue;
			}
		}

		return $aImgAttributes;
	}

	/**
	 * Prepare links for the combined files and insert them in the processed HTML
	 */
	public function generateLinks() {
		$aLinks = $this->oParser->getReplacedFiles ();

		// Add CSS to hide elements that are set to be lazyloaded, mask/force the add custom css code
		if($this->params->get('lazyload_html_enable', 0) && $lazyloadHtmlCssSelector = trim($this->params->get('lazyload_html_css_selector', ''))) {
			$lazyloadDelay = $this->params->get('lazyload_html_delay', 3000);
			$lazyloadMethod = $this->params->get ('lazyload_method', 'scroll');
			$importantOverride = $this->params->get('lazyload_html_use_important_override', 0) ? ' !important' : '';

			// Concatenate custom code if existing
			$customCssCode = '';
			if ($this->params->get ( 'add_custom_css_code', 0 ) && $concatenateCustomCss = trim($this->params->get ( 'custom_css_code', ''))) {
				$customCssCode = $concatenateCustomCss;
			}
			$this->params->set ( 'add_custom_css_code', 1 );
			if($lazyloadMethod == 'delay') {
				$this->params->set ( 'custom_css_code', '*[data-jspeed-dom-lazyload]{visibility:hidden' . $importantOverride . ';display:none' . $importantOverride . '}' . $customCssCode);
			} else {
				$this->params->set ( 'custom_css_code', '*[data-jspeed-dom-lazyload]{visibility:hidden' . $importantOverride . '}' . $customCssCode);
			}
			
			// Concatenate custom code if existing
			$customJsCode = '';
			if ($this->params->get ( 'add_custom_js_code', 0 ) && $concatenateCustomJs = trim($this->params->get ( 'custom_js_code', ''))) {
				$customJsCode = $concatenateCustomJs;
			}
			$this->params->set ( 'add_custom_js_code', 1 );
			if($lazyloadMethod == 'delay') {
				$this->params->set ( 'custom_js_code', 'setTimeout(function(){[].slice.call(document.querySelectorAll("*[data-jspeed-dom-lazyload]")).map(function(element){element.removeAttribute("data-jspeed-dom-lazyload")})}, ' . $lazyloadDelay . ');' . $customJsCode);
			} else {
				$this->params->set ( 'custom_js_code', 'function jspeedIsVisible(e){var t=e.getBoundingClientRect();return document.documentElement.clientHeight-t.top>0&&t.top+t.height>0}function jspeedShowVisible(){[].slice.call(document.querySelectorAll("*[data-jspeed-dom-lazyload]")).map(function(e){jspeedIsVisible(e)&&e.removeAttribute("data-jspeed-dom-lazyload")})}window.addEventListener("scroll",jspeedShowVisible),window.addEventListener("DOMContentLoaded",function(){jspeedShowVisible()});' . $customJsCode);
			}
		}

		// Add the custom CSS/JS file array
		if ($this->params->get ( 'add_custom_css_code', 0 )) {
			$customCssCode = trim($this->params->get ( 'custom_css_code', ''));
			$aMatches = array();
			$aMatches['content'] = $customCssCode;
			if($customCssCode) {
				$aLinks ['css'] [0] [] = array (
						'match' => '<style>' . $customCssCode . '</style>',
						'content' => $customCssCode,
						'id' => $this->oParser->getFileID ( $aMatches ),
						'media' => null
				);
			}
		}
		
		// Add the custom CSS/JS file array
		if ($this->params->get ( 'add_custom_js_code', 0 )) {
			$customJsCode = trim($this->params->get ( 'custom_js_code', ''));
			$aMatches = array();
			$aMatches['content'] = $customJsCode;
			if($customJsCode) {
				$aLinks ['js'] [0] [] = array (
						'match' => '<script>' . $customJsCode . '</script>',
						'content' => $customJsCode,
						'id' => $this->oParser->getFileID ( $aMatches )
				);
			}
		}

		if (! Helper::isMsieLT10 () && $this->params->get ( 'combine_files_enable', 0 ) && ! $this->oParser->bAmpPage) {
			$bCombineCss = ( bool ) $this->params->get ( 'css', 1 );
			$bCombineJs = ( bool ) $this->params->get ( 'js', 1 );

			if ($bCombineCss || $bCombineJs) {
				$this->runCronTasks ();
			}

			$replace_css_links = false;

			if ($bCombineCss && ! empty ( $aLinks ['css'] )) {
				$sCssCacheId = $this->getCacheId ( $aLinks ['css'] );
				// Optimize and cache css files
				$sCssCache = $this->getCombinedFiles ( $aLinks ['css'], $sCssCacheId, 'css' );

				$replace_css_links = true;
			}

			if ($bCombineJs) {
				$sSection = $this->params->get ( 'bottom_js', '0' ) == '1' ? 'body' : 'head';

				if (! empty ( $aLinks ['js'] )) {
					$sJsCacheId = $this->getCacheId ( $aLinks ['js'] );
					// Optimize and cache javascript files
					$this->getCombinedFiles ( $aLinks ['js'], $sJsCacheId, 'js' );

					// Insert link to combined javascript file in HTML
					$this->replaceLinks ( $sJsCacheId, 'js', $sSection );
				}

				// We also now append any deferred javascript files below the
				// last combined javascript file
				$aDefers = $this->oParser->getDeferredFiles ();

				if (! empty ( $aDefers )) {
					$sDefers = implode ( $this->sLnEnd, $aDefers );
					$sSearchArea = preg_replace ( '#' . self::{'getEnd' . ucfirst ( $sSection ) . 'Tag'} () . '#i', $this->sTab . $sDefers . $this->sLnEnd . '</' . $sSection . '>', $this->oParser->getFullHtml (), 1 );

					$this->oParser->setFullHtml ( $sSearchArea, true);
				}
			}

			if ($replace_css_links) {
				// Insert link to combined css file in HTML
				$this->replaceLinks ( $sCssCacheId, 'css' );
			}
		}

		if (! empty ( $aLinks ['img'] )) {
			$this->addImgAttributes ( $aLinks ['img'] );
		}
	}

	/**
	 * Create and cache aggregated file if it doesn't exists.
	 *
	 * @param array $aFunction
	 *        	Name of function used to aggregate files
	 * @param array $aArgs
	 *        	Arguments used by function above
	 * @param string $sId
	 *        	Generated id to identify cached file
	 * @return boolean True on success
	 */
	public function loadCache($aFunction, $aArgs, $sId) {
		$bCached = Cache::getCallbackCache ( $sId, $aFunction, $aArgs );

		if ($bCached === false) {
			throw new \Exception ( 'Error creating cache file' );
		}

		return $bCached;
	}

	/**
	 * Check if gzip is set or enabled
	 *
	 * @return boolean True if gzip parameter set and server is enabled
	 */
	public function isGZ() {
		return ($this->params->get ( 'gzip', 0 ) && extension_loaded ( 'zlib' ) && ! ini_get ( 'zlib.output_compression' ) && (ini_get ( 'output_handler' ) != 'ob_gzhandler'));
	}

	/**
	 * Determine if document is of XHTML doctype
	 *
	 * @return boolean
	 */
	public function isXhtml() {
		return ( bool ) preg_match ( '#^\s*+(?:<!DOCTYPE(?=[^>]+XHTML)|<\?xml.*?\?>)#i', trim ( $this->oParser->sHtml ) );
	}
	public function http2PushBgImages($sCssCache) {
		$oCssParser = new CssParser ( $this->params );

		foreach ( $sCssCache ['file'] as $sCss ) {
			$oCssParser->correctUrl ( $sCss, '', false, true );
		}
	}
	public static function getEndBodyTag() {
		$regex = '</body\s*+>(?=(?>[^<>]*+(' . Parser::ifRegex () . ')?)*?(?:</html\s*+>|$))';

		return $regex;
	}
	public static function getEndHeadTag() {
		return '</head\s*+>(?=(?>[^<>]*+(' . Parser::ifRegex () . ')?)*?(?:<body|$))';
	}

	/**
	 * Constructor
	 *
	 * @param Parser Object $oParser
	 */
	public function __construct($oParser = null) {
		$this->oParser = $oParser;
		$this->params = $this->oParser->params;
		$this->sLnEnd = $this->oParser->sLnEnd;
		$this->sTab = $this->oParser->sTab;
		
		$this->minifiedFiles = array();
		$this->minifiedFiles['css'] = array();
		$this->minifiedFiles['js'] = array();
	}
}
