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

class Combiner {
	public $params = null;
	public $sLnEnd = '';
	public $sTab = '';
	public $bBackend = false;
	public static $bLogErrors = false;
	public $css = '';
	public $js = '';
	public $oCssParser;
	public $preloadedFonts = array();
	protected $oParser;
	protected $current_file = '';

	/**
	 * Minify contents
	 *
	 * @param type $sContent
	 * @param type $sUrl
	 *
	 * @return string $sMinifiedContent Minified content or original content if failed
	 */
	protected function minifyContent($sContent, $sType, $aUrl) {
		if ($this->params->get ( $sType . '_minify', 0 )) {
			$sUrl = $this->prepareFileUrl ( $aUrl, $sType );
			
			$sMinifiedContent = trim ( $sType == 'css' ? CssOptimizer::optimize ( $sContent ) : JsOptimizer::optimize ( $sContent ) );
			
			if (is_null ( $sMinifiedContent ) || $sMinifiedContent == '') {
				$sMinifiedContent = $sContent;
			}
			
			return $sMinifiedContent;
		}
		
		return $sContent;
	}
	
	/**
	 * Resolves @imports in css files, fetching contents of these files and adding them to the aggregated file
	 *
	 * @param string $sContent
	 * @return string
	 */
	protected function replaceImports($sContent) {
		if ($this->params->get ( 'replace_imports', '1' )) {
			$oCssParser = $this->oCssParser;
			
			$u = $oCssParser->u;
			
			$regex = "#(?>@?[^@'\"/]*+(?:{$u}|/|\()?)*?\K(?:@import\s*+(?:url\()?['\"]?([^\)'\";]+)['\"]?(?:\))?\s*+([^;]*);|\K$)#";
			$sImportFileContents = preg_replace_callback ( $regex, array (
					$this,
					'getImportFileContents'
			), $sContent );
			
			if (is_null ( $sImportFileContents )) {
				return $sContent;
			}
			
			$sContent = $sImportFileContents;
		} else {
			return $sContent;
		}
		
		return $sContent;
	}
	
	/**
	 * Fetches the contents of files declared with @import
	 *
	 * @param array $aMatches
	 *        	Array of regex matches
	 * @return string file contents
	 */
	protected function getImportFileContents($aMatches) {
		if (empty ( $aMatches [1] ) || preg_match ( '#^(?>\(|/\*)#', $aMatches [0] ) || ! $this->oParser->isHttpAdapterAvailable ( $aMatches [1] ) || (Url::isSSL ( $aMatches [1] ) && ! extension_loaded ( 'openssl' )) || (! Url::isHttpScheme ( $aMatches [1] ))) {
			return $aMatches [0];
		}
		
		if ($this->oParser->isDuplicated ( $aMatches [1] )) {
			return '';
		}
		
		// Need to handle file specially if it imports google font
		if (strpos ( $aMatches [1], 'fonts.googleapis.com' ) !== false) {
			// Get array of files from cache that imports Google font files
			$containsgf = Cache::getCache ( 'jspeed_particle' );
			
			// If not cache found initialize to empty array
			if ($containsgf === false) {
				$containsgf = array ();
			}
			
			// If not in array, add to array
			if (! in_array ( $this->current_file, $containsgf )) {
				$containsgf [] = $this->current_file;
				
				// Store array of filenames that imports google font files to cache
				Cache::saveCache ( $containsgf, 'jspeed_particle' );
			}
		}
		
		$aUrlArray = array ();
		
		$aUrlArray [0] ['url'] = $aMatches [1];
		$aUrlArray [0] ['media'] = $aMatches [2];
		// $aUrlArray[0]['id'] = md5($aUrlArray[0]['url'] . $this->oParser->sFileHash);
		
		$oCssParser = $this->oCssParser;
		$sFileContents = $this->combineFiles ( $aUrlArray, 'css', $oCssParser );
		
		if ($sFileContents === false) {
			return $aMatches [0];
		}
		
		return $sFileContents;
	}
	
	/**
	 *
	 * @param type $sType
	 * @param type $sUrl
	 * @return string
	 */
	protected function addCommentedUrl($sType, $sUrl) {
		$sComment = '';
		
		return $sComment;
	}
	
	/**
	 *
	 * @return type
	 */
	public function getLogParam() {
		if (self::$bLogErrors == '') {
			self::$bLogErrors = $this->params->get ( 'log', 0 );
		}

		return self::$bLogErrors;
	}

	/**
	 * Get aggregated and possibly minified content from js and css files
	 *
	 * @param array $aUrlArray
	 *        	Array of urls of css or js files for aggregation
	 * @param string $sType
	 *        	css or js
	 * @return string Aggregated (and possibly minified) contents of files
	 */
	public function getContents($aUrlArray, $sType) {
		$oCssParser = $this->oCssParser;
		$aSpriteCss = array ();

		$aContentsArray = array ();

		foreach ( $aUrlArray as $index => $aUrlInnerArray ) {
			$sContents = $this->combineFiles ( $aUrlInnerArray, $sType, $oCssParser );
			$sContents = $this->prepareContents ( $sContents, false, $sType );

			$aContentsArray [$index] = $sContents;
		}

		if ($sType == 'css') {
			if ($this->params->get ( 'combinedimage_enabled', 0 )) {
				try {
					$oSpriteGenerator = new SpriteGenerator ( $this->params );
					$aSpriteCss = $oSpriteGenerator->getSprite ( $this->$sType );
				} catch ( \Exception $e ) {
					$aSpriteCss = array ();
				}
			}
		}

		$aContents = array (
				'filemtime' => Utilities::unixCurrentDate (),
				'etag' => md5 ( $this->$sType ),
				'file' => $aContentsArray,
				'spritecss' => $aSpriteCss
		);

		return $aContents;
	}

	/**
	 * Aggregate contents of CSS and JS files
	 *
	 * @param array $aUrlArray
	 *        	Array of links of files to combine
	 * @param string $sType
	 *        	css|js
	 * @return string Aggregated contents
	 * @throws Exception
	 */
	public function combineFiles($aUrlArray, $sType, $oCssParser) {
		$sContents = '';

		$oFileRetriever = FileScanner::getInstance ();

		// ADAPTIVE CONTENTS: remove any matched tag for bots
		// Check for user agent exclusion
		$isBot = false;
		if($this->params->get('adaptive_contents_enable', 0)) {
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
			}
		}
		
		// Iterate through each file/script to optimize and combine
		foreach ( $aUrlArray as $aUrl ) {
			// Truncate url to less than 40 characters
			$sUrl = $this->prepareFileUrl ( $aUrl, $sType );

			// Prevent bots response to be cached
			if($isBot) {
				$aUrl ['id'] = '';
			}
			
			// If a cache id is present then cache this individual file to avoid
			// optimizing it again if it's present on another page
			if (isset ( $aUrl ['id'] ) && $aUrl ['id'] != '') {
				if (isset ( $aUrl ['url'] )) {
					$this->current_file = $aUrl ['url'];
				}

				$function = array (
						$this,
						'cacheContent'
				);
				$args = array (
						$aUrl,
						$sType,
						$oFileRetriever,
						$oCssParser,
						true
				);

				// Optimize and cache file/script returning the optimized content
				$sCachedContent = Cache::getCallbackCache ( $aUrl ['id'], $function, $args );

				$this->$sType .= $sCachedContent;

				// Append to combined contents
				$sContents .= $this->addCommentedUrl ( $sType, $aUrl ) . $sCachedContent . $this->sLnEnd . 'DELIMITER';
			} else {
				// If we're not caching just get the optimized content
				$sContent = $this->cacheContent ( $aUrl, $sType, $oFileRetriever, $oCssParser, false );
				$sContents .= $this->addCommentedUrl ( $sType, $aUrl ) . $sContent . '|"LINE_END"|';
			}
		}

		return $sContents;
	}

	/**
	 * Optimize and cache contents of individual file/script returning optimized content
	 *
	 * @param string $aUrl
	 * @param type $sType
	 * @param type $oFileRetriever
	 * @return type
	 * @throws Exception
	 */
	public function cacheContent($aUrl, $sType, $oFileRetriever, $oCssParser, $bPrepare) {
		// Initialize content string
		$sContent = '';

		// Exclude whole file contents here
		$removeJS = $this->params->get('remove_js', 0);
		$removeJSFiles = $this->params->get('remove_js_files', array());
		if(isset ( $aUrl ['url'] ) && $removeJS && $sType == 'js') {
			if (! empty ( $removeJSFiles )) {
				foreach ( $removeJSFiles as $jsFileToRemove ) {
					if (stripos ( $jsFileToRemove, $aUrl ['url'] ) !== false || stripos ( $aUrl ['url'], $jsFileToRemove ) !== false) {
						return $sContent;
					}
				}
			}
		}
		$removeCSS = $this->params->get('remove_css', 0);
		$removeCSSFiles = $this->params->get('remove_css_files', array());
		if(isset ( $aUrl ['url'] ) && $removeCSS && $sType == 'css') {
			if (! empty ( $removeCSSFiles )) {
				foreach ( $removeCSSFiles as $cssFileToRemove ) {
					if (stripos ( $cssFileToRemove, $aUrl ['url'] ) !== false || stripos ( $aUrl ['url'], $cssFileToRemove ) !== false) {
						return $sContent;
					}
				}
			}
		}
		
		// ADAPTIVE CONTENTS: remove any matched tag for bots
		// Check for user agent exclusion
		if($this->params->get('adaptive_contents_enable', 0)) {
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
					// Exclude whole file contents here
					$removeAJS = $this->params->get('adaptive_contents_remove_js', 0);
					$removeAJSFiles = $this->params->get('adaptive_contents_remove_js_files', array());
					if(isset ( $aUrl ['url'] ) && $removeAJS && $sType == 'js') {
						if (! empty ( $removeAJSFiles )) {
							foreach ( $removeAJSFiles as $jsAFileToRemove ) {
								if (stripos ( $jsAFileToRemove, $aUrl ['url'] ) !== false || stripos ( $aUrl ['url'], $jsAFileToRemove ) !== false) {
									return $sContent;
								}
							}
						}
					}
					$removeACSS = $this->params->get('adaptive_contents_remove_css', 0);
					$removeACSSFiles = $this->params->get('adaptive_contents_remove_css_files', array());
					if(isset ( $aUrl ['url'] ) && $removeACSS && $sType == 'css') {
						if (! empty ( $removeACSSFiles )) {
							foreach ( $removeACSSFiles as $cssAFileToRemove ) {
								if (stripos ( $cssAFileToRemove, $aUrl ['url'] ) !== false || stripos ( $aUrl ['url'], $cssAFileToRemove ) !== false) {
									return $sContent;
								}
							}
						}
					}
				}
			}
		}
		
		// If it's a file fetch the contents of the file
		if (isset ( $aUrl ['url'] )) {
			// Convert local urls to file path
			$sPath = Helper::getFilePath ( $aUrl ['url'] );
			$sContent .= $oFileRetriever->getFileContents ( $sPath );
		} else {
			// If its a declaration just use it
			$sContent .= $aUrl ['content'];
		}

		if ($sType == 'css') {
			if (function_exists ( 'mb_convert_encoding' )) {
				$sEncoding = mb_detect_encoding ( $sContent );

				if ($sEncoding === false) {
					$sEncoding = mb_internal_encoding ();
				}

				$sContent = mb_convert_encoding ( $sContent, 'utf-8', $sEncoding );
			}

			// Remove quotations around imported urls
			$sImportContent = preg_replace ( '#@import\s(?:url\()?[\'"]([^\'"]+)[\'"](?:\))?#', '@import url($1)', $sContent );

			if (is_null ( $sImportContent )) {
				$sImportContent = $sContent;
			}

			$sContent = $sImportContent;
			unset ( $sImportContent );

			$sContent = $oCssParser->addRightBrace ( $sContent );

			$oCssParser->aUrl = $aUrl;

			$sContent = $oCssParser->correctUrl ( $sContent, $aUrl );
			$sContent = $this->replaceImports ( $sContent, $aUrl );
			$sContent = $oCssParser->handleMediaQueries ( $sContent, $aUrl ['media'] );
			
			// Remove old prefixed browser rules
			if($reduceUnusedCssMode = $this->params->get('reduce_unused_css', 0)) {
				$replacementCharacter = $reduceUnusedCssMode == 1 ? '' : ';';
				$sContent = preg_replace('/((background-color|background-image|background|position|transition|width|cursor)\s?:\s?)?-(moz|webkit|ms|o)-([^{]|\n)*;/iU', $replacementCharacter, $sContent);
			}
			
			// Add the font-display:swap to fix visible text during webfont load
			if($this->params->get('font_display_swap', 0)) {
				$sContent = preg_replace('/@font-face\s*{/i', '$0font-display:swap;', $sContent);
			}
			
			// Remove @font-face extra fonts loading
			if($this->params->get('remove_font_face', 0)) {
				$removeFontFaceFamily = $this->params->get('remove_font_face_family', array());
				$sContent = preg_replace_callback('/(@font-face)\s*({)\s*(.*)(})/imsU',
					function($matches) use ($removeFontFaceFamily) {
						$foundRemoval = false;
						foreach ($removeFontFaceFamily as $family) {
							if(stripos($matches[3], $family) !== false) {
								$foundRemoval = true;
							}
						}
						if($foundRemoval) {
							return $matches[1] . $matches[2] . $matches[4];
						} else {
							return $matches[1] . $matches[2] . $matches[3] . $matches[4];
						}
						
					},
				$sContent);
			}
			
			// Search for fonts to preload and put them in the output cache
			if ($this->params->get ( 'preload_font_face', 0 ) && ! Helper::isMsie ()) {
				$fontsToPreloadFound = false;
				$sContent = preg_replace_callback ( '/(@font-face)\s*({)\s*(.*)(})/imsU',
					function ($matches) use (&$fontsToPreloadFound) {
						preg_match_all ( '/(src):\s*url\((.*)\)/i', $matches [3], $srcMatches );
						if(!empty($srcMatches[2])) {
							$singleMultipleFonts = isset ( $srcMatches [2] [1] ) ? $srcMatches [2] [1] : $srcMatches [2] [0];
							if ($singleMultipleFonts) {
								$fontsArrayRaw = explode ( ',', $singleMultipleFonts );
								if (! empty ( $fontsArrayRaw )) {
									foreach ( $fontsArrayRaw as $rawFont ) {
										$rawFont = StringHelper::str_ireplace ( 'url(', '', $rawFont );
										$rawFontPathArray = explode ( ')', $rawFont );
										if (isset ( $rawFontPathArray [0] )) {
											$this->preloadedFonts [] = trim($rawFontPathArray [0]);
											$fontsToPreloadFound = true;
										}
									}
								}
							}
						}
						
						// Leave unaltered
						return $matches [1] . $matches [2] . $matches [3] . $matches [4];
					},
				$sContent);
				
				if (! empty ( $this->preloadedFonts ) && $fontsToPreloadFound) {
					$oCache = Cache::getCacheObject ();
					$cacheName = 'jspeed_preloaded_fonts_' . Factory::getApplication()->getTemplate();
					$oCache->store ( $this->preloadedFonts, $cacheName );
				}
			}
			
			// Process even background images of CSS files
			if($this->params->get('lightimgs_status', 0) && $this->params->get('optimize_css_background_images', 0)) {
				$lightImageOptimizer = new LightImages($this->params);
				$dom = new \DOMDocument('1.0', 'utf-8');
				$processGIF = $this->params->get('img_support_gif', 0);
				$imgsRegex = $processGIF ? '/\.jpg|\.jpeg|\.png|\.gif|\.bmp/i' : '/\.jpg|\.jpeg|\.png|\.bmp/i';
				$uriInstance = Uri::getInstance();
				$absoluteUri = rtrim($uriInstance->getScheme() . '://' . $uriInstance->getHost(), '/') . '/';
				$sContent = preg_replace_callback(
					'/(url)(\(.*\))/imU',
					function ($matches) use ($lightImageOptimizer, $dom, $imgsRegex, $absoluteUri) {
						// Apply only to jpg, jpeg, png, gif, bmp
						if(!preg_match($imgsRegex, $matches[2])) {
							return $matches[0];
						}
						
						$innerContents = trim($matches[2], '()');
						$innerContents = trim($innerContents, '\'"');
						$innerContents = trim($innerContents, '/\\');
						$innerContents = str_replace('../', '', $innerContents);
						$innerContents = '/' . $innerContents;
						
						// Call here the LightImages optimizer for this image, then replace the path with the cached image
						$element = $dom->createElement('img', '');
						$element->setAttribute('src', $innerContents);
						$lightImageOptimizer->optimizeSingleImage($element);
						$newSrc = $element->getAttribute('src');
						$newAbsoluteUri = $absoluteUri . ltrim($newSrc, '/');
						
						// Check if the image has been processed, otherwise leave it unaltered
						if(stripos($newAbsoluteUri, 'plg_jspeed/cache') === false) {
							return $matches[0];
						}
						
						return "url('" . $newAbsoluteUri . "')";
					},
					$sContent
				);
			}
		}

		if ($sType == 'js' && trim ( $sContent ) != '') {
			if ($this->params->get ( 'try_catch', '1' )) {
				$sContent = $this->addErrorHandler ( $sContent, $aUrl );
			} else {
				$sContent = $this->addSemiColon ( $sContent, $aUrl );
			}
		}

		if ($bPrepare) {
			$sContent = $this->minifyContent ( $sContent, $sType, $aUrl );
			$sContent = $this->prepareContents ( $sContent, false, $sType );
		}

		return $sContent;
	}

	/**
	 * Truncate url at the '/' less than 40 characters prepending '...' to the string
	 *
	 * @param type $aUrl
	 * @param type $sType
	 * @return type
	 */
	public function prepareFileUrl($aUrl, $sType) {
		$sUrl = isset ( $aUrl ['url'] ) ? Admin::prepareFileValues ( $aUrl ['url'], '', 40 ) : ($sType == 'css' ? 'Style' : 'Script') . ' Declaration';

		return $sUrl;
	}

	/**
	 * Add semi-colon to end of js files if non exists;
	 *
	 * @param string $sContent
	 * @return string
	 */
	public function addErrorHandler($sContent, $aUrl) {
		$sContent = 'try {' . $this->sLnEnd . $sContent . $this->sLnEnd . '} catch (e) {' . $this->sLnEnd;
		$sContent .= 'console.error(\'Error in ';
		$sContent .= isset ( $aUrl ['url'] ) ? 'file:' . $aUrl ['url'] : 'script declaration';
		$sContent .= '; Error:\' + e.message);' . $this->sLnEnd . '};';

		return $sContent;
	}

	/**
	 * Add semi-colon to end of js files if non exists;
	 *
	 * @param string $sContent
	 * @return string
	 */
	public function addSemiColon($sContent) {
		$sContent = rtrim ( $sContent );

		if (substr ( $sContent, - 1 ) != ';' && ! preg_match ( '#\|"COMMENT_START File[^"]+not found COMMENT_END"\|#', $sContent )) {
			$sContent = $sContent . ';';
		}

		return $sContent;
	}

	/**
	 * Remove placeholders from aggregated file for caching
	 *
	 * @param string $sContents
	 *        	Aggregated file contents
	 * @param string $sType
	 *        	js or css
	 * @return string
	 */
	public function prepareContents($sContents, $test = false, $sType = null) {
		// If files must be only minimized and not combined preserve the DELIMITER for later chunking back
		if($sType == 'css' && $this->params->get('only_css_minify', 0)) {
			return $sContents;
		}
		
		if($sType == 'js' && $this->params->get('only_js_minify', 0)) {
			return $sContents;
		}
		
		$sContents = str_replace ( array (
				'|"COMMENT_START',
				'|"COMMENT_IMPORT_START',
				'COMMENT_END"|',
				'DELIMITER',
				'|"LINE_END"|'
		), array (
				$this->sLnEnd . '/***! ',
				$this->sLnEnd . $this->sLnEnd . '/***! @import url',
				' !***/' . $this->sLnEnd . $this->sLnEnd,
				($test) ? 'DELIMITER' : '',
				$this->sLnEnd
		), trim ( $sContents ) );

		return $sContents;
	}

	/**
	 * Save filenames of Google fonts or files that import them
	 */
	public function saveHiddenGf($sUrl) {
		// Get array of Google font files from cache
		$containsgf = Cache::get ( 'jspeed_particle' );
	}
	
	/**
	 * Constructor
	 */
	public function __construct($params, $oParser, $bBackend = false) {
		$this->params = $params;
		$this->oParser = $oParser;
		$this->bBackend = $bBackend;
		
		$this->sLnEnd = Utilities::lnEnd ();
		$this->sTab = Utilities::tab ();
		
		$this->oCssParser = new CssParser ( $params, $bBackend );
		
		self::$bLogErrors = $this->params->get ( 'jsmin_log', 0 ) ? true : false;
	}
}
