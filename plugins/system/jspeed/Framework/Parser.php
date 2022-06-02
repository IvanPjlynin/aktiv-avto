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
use Joomla\CMS\Uri\Uri as JUri;
use Joomla\String\StringHelper;

/**
 * Class to parse HTML and find css and js links to replace, populating an array with matches
 * and removing found links from HTML
 */
class Parser extends BaseClass {

	/** @var array    Array of css or js urls taken from head */
	protected $aLinks = array ();

	/** @var array Array of javascript files with the defer attribute */
	protected $aDefers = array ();
	protected $aUrls = array ();
	protected $oFileRetriever;
	protected $sRegexMarker = 'JSPEEDREGEXMARKER';
	protected $containsgf = [];
	protected $preloadedModules = [];
	protected $modulePreloadObject;

	/** @var string   Html of page */
	public $sHtml = '';
	public $params = null;
	public $sLnEnd = '';
	public $sTab = '';
	public $sFileHash = '';
	public $bAmpPage = false;
	public $iIndex_js = 0;
	public $iIndex_css = 0;
	public $bExclude_js = false;
	public $bExclude_css = false;

	/**
	 * Check if the url is an absolute URL in some way
	 *
	 * @param string $url
	 * @return bool
	 */
	private function isFullyQualified($url) {
		$isFullyQualified = substr ( $url, 0, 7 ) == 'http://' || substr ( $url, 0, 8 ) == 'https://' || substr ( $url, 0, 2 ) == '//';
		return $isFullyQualified;
	}
	private function fixRelPath($m, $dir) {
		$m_array = array_filter ( $m );
		array_pop ( $m_array );
		$sPath = array_pop ( $m_array );

		if (substr ( $sPath, 0, 1 ) != '/') {
			$base = JUri::base(true) . '/';
			$sPath = $base . ltrim($sPath, '/');
		}

		return $sPath;
	}
	protected function setupExcludes() {
		JSpeedAutoLoader ( 'JSpeed\Excludes' );

		$aCBArgs = array ();
		$aExcludes = array ();
		$oParams = $this->params;

		// These parameters will be excluded while preserving execution order
		$aExJsComp = $this->getExComp ( $oParams->get ( 'exclude_js_components_by_order', '' ) );
		$aExCssComp = $this->getExComp ( $oParams->get ( 'exclude_css_components', '' ) );

		$aExcludeJs = Helper::getArray ( $oParams->get ( 'exclude_js_by_order', '' ) );
		$aExcludeCss = Helper::getArray ( $oParams->get ( 'exclude_css', '' ) );
		$aExcludeScript = Helper::getArray ( $oParams->get ( 'exclude_scripts_by_order', '' ) );
		$aExcludeStyle = Helper::getArray ( $oParams->get ( 'exclude_styles', '' ) );

		$aExcludeScript = array_map ( function ($sScript) {
			return stripslashes ( $sScript );
		}, $aExcludeScript );

		$aCBArgs ['excludes'] ['js'] = array_merge ( $aExcludeJs, $aExJsComp, array (
				'.com/maps/api/js',
				'.com/jsapi',
				'.com/uds',
				'typekit.net',
				'cdn.ampproject.org',
				'googleadservices.com/pagead/conversion'
		), Excludes::head ( 'js' ) );
		
		// Exclude itself if preload for scripts is enabled
		if($this->params->get('preload_combined_js', 0)) {
			$aCBArgs ['excludes'] ['js'][] = 'plg_jspeed';
		}
		
		$aCBArgs ['excludes'] ['css'] = array_merge ( $aExcludeCss, $aExCssComp, Excludes::head ( 'css' ) );
		$aCBArgs ['excludes'] ['js_script'] = $aExcludeScript;
		$aCBArgs ['excludes'] ['css_script'] = $aExcludeStyle;

		// These parameters will be excluded without preserving execution order
		$aExJsComp_noOrder = $this->getExComp ( $oParams->get ( 'exclude_js_components', '' ) );
		$aExcludeJs_noOrder = Helper::getArray ( $oParams->get ( 'exclude_js', '' ) );
		$aExcludeScript_noOrder = Helper::getArray ( $oParams->get ( 'exclude_scripts', '' ) );

		// If the parameter to exclude Joomla core files is enabled, initialize a default base array for $aExcludeJs_noOrder
		if($this->params->get('auto_exclude_core_files', 1)) {
			$aExcludeJs_noOrder = array_merge($aExcludeJs_noOrder, array('core.js','core.min.js'));
		}

		$aCBArgs ['excludes_no_order'] ['js'] = array_merge ( $aExcludeJs_noOrder, $aExJsComp_noOrder );
		$aCBArgs ['excludes_no_order'] ['js_script'] = $aExcludeScript_noOrder;

		$aExcludes ['head'] = $aCBArgs;

		if ($this->params->get ( 'bottom_js', '0' ) == 1) {
			$aCBArgs ['excludes'] ['js_script'] = array_merge ( $aCBArgs ['excludes'] ['js_script'], array (
					'.write(',
					'var google_conversion'
			), Excludes::body ( 'js', 'script' ) );
			$aCBArgs ['excludes'] ['js'] = array_merge ( $aCBArgs ['excludes'] ['js'], array (), Excludes::body ( 'js' ) );

			$aExcludes ['body'] = $aCBArgs;
		}

		return $aExcludes;
	}
	protected function getHtmlSearchRegex() {
		$aJsRegex = $this->getJsRegex ();
		$j = implode ( '', $aJsRegex );

		$aCssRegex = $this->getCssRegex ();
		$c = implode ( '', $aCssRegex );

		$i = $this->ifRegex ();
		$ns = '<noscript\b[^>]*+>(?><?[^<]*+)*?</noscript\s*+>';
		$a = self::HTML_ATTRIBUTE;
		$sc = "<script\b(?=(?>\s*+$a)*?\s*+(?:type\s*=\s*(?!['\"]?(?:text/javascript|application/javascript|module))))[^>]*+>(?><?[^<]*+)*?</script\s*+>";

		$sRegex = "#(?>(?:<(?!(?:!--|(?:no)?script\b)))?[^<]*+(?:$i|$ns|$sc|<!)?)*?\K(?:$j|$c|\K$)#six";

		return $sRegex;
	}
	/**
	 *
	 * @param type $sType
	 */
	protected function initSearch($aExcludes) {
		$sRegex = $this->getHtmlSearchRegex ();

		$this->searchArea ( $sRegex, 'head', $aExcludes ['head'] );

		if ($this->params->get ( 'bottom_js', '0' ) == 1) {
			$this->searchArea ( $sRegex, 'body', $aExcludes ['body'] );
		}
	}

	/**
	 *
	 * @param type $sRegex
	 * @param type $sType
	 * @param type $sSection
	 * @param type $aCBArgs
	 * @throws Exception
	 */
	protected function searchArea($sRegex, $sSection, $aCBArgs) {
		$obj = $this;

		$sProcessedHtml = preg_replace_callback ( $sRegex, function ($aMatches) use ($obj, $aCBArgs, $sSection) {
			return $obj->replaceScripts ( $aMatches, $aCBArgs, $sSection );
		}, $this->{'get' . ucfirst ( $sSection ) . 'Html'} () );

			// Feature to modulepreload all module scripts
			if ($this->params->get ( 'preload_module_scripts', 0 )) {
				$this->modulePreloadObject = $obj;
			}
			
		if (is_null ( $sProcessedHtml )) {
			throw new \Exception ( sprintf ( 'Error while parsing for links in %1$s', $sSection ) );
		}

		$this->{'set' . ucfirst ( $sSection ) . 'Html'} ( $sProcessedHtml );
	}

	/**
	 */
	protected function getImagesWithoutAttributes() {
		if ($this->params->get ( 'add_size_attributes', '0' )) {

			$rx = '#(?><?[^<]*+)*?\K(?:<img\s++(?!(?=(?>[^\s>]*+\s++)*?width\s*+=\s*+["\'][^\'">a-z]++[\'"])' . '(?=(?>[^\s>]*+\s++)*?height\s*+=\s*+["\'][^\'">a-z]++[\'"]))' . '(?=(?>[^\s>]*+\s++)*?src\s*+=(?:\s*+"([^">]*+)"|\s*+\'([^\'>]*+)\'|([^\s>]++)))[^>]*+>|$)#i';

			// find all images without width and height attributes and populate the $m array
			preg_match_all ( $rx, $this->getBodyHtml (), $m, PREG_PATTERN_ORDER );

			$this->aLinks ['img'] = array_map ( function ($a) {
				return array_slice ( $a, 0, - 1 );
			}, $m );
		}
	}

	/**
	 * Checks if plugin should exclude third party plugins/modules/extensions
	 *
	 *
	 * @param string $sPath
	 *        	Filesystem path of file
	 * @return bool false will not exclude third party extension
	 */
	protected function excludeExternalExtensions($sPath) {
		if (! $this->params->get ( 'include_all_extensions', '1' )) {
			return ! Url::isInternal ( $sPath ) || preg_match ( '#' . Excludes::extensions () . '#i', $sPath );
		}

		return false;
	}

	/**
	 * Generates regex for excluding components set in plugin params
	 *
	 * @param string $param
	 * @return string
	 */
	protected function getExComp($sExComParam) {
		$aComponents = Helper::getArray ( $sExComParam );
		$aExComp = array ();

		if (! empty ( $aComponents )) {
			$aExComp = array_map ( function ($sValue) {
				return $sValue . '/';
			}, $aComponents );
		}

		return $aExComp;
	}

	/**
	 *
	 * @param type $aAttrs
	 * @param type $aExts
	 * @param type $bFileOptional
	 */
	protected static function urlRegex($aAttrs, $aExts) {
		$sAttrs = implode ( '|', $aAttrs );
		$sExts = implode ( '|', $aExts );

		$sUrlRegex = <<<URLREGEX
						                (?>  [^\s>]*+\s  )+?  (?>$sAttrs)\s*+=\s*+["']?
						                ( (?<!["']) [^\s>]*+  | (?<!') [^"]*+ | [^']*+ )
						                                                                        
		URLREGEX;

		return $sUrlRegex;
	}

	/**
	 *
	 * @param type $sCriteria
	 * @return string
	 */
	protected static function criteriaRegex($sCriteria) {
		$sCriteriaRegex = '(?= (?> [^\s>]*+[\s] ' . $sCriteria . ' )*+  [^\s>]*+> )';

		return $sCriteriaRegex;
	}
	protected function getLazyLoadExcludes() {
		$aExcludesFiles = Helper::getArray ( $this->params->get ( 'excludeLazyLoad', array () ) );
		$aExcludesFolders = Helper::getArray ( $this->params->get ( 'excludeLazyLoadFolders', array () ) );

		$aExcludesUrl = array_merge ( $aExcludesFiles, $aExcludesFolders );

		$aExcludeClass = Helper::getArray ( $this->params->get ( 'excludeLazyLoadClass', array () ) );

		$aExcludes = array (
				'url' => $aExcludesUrl,
				'class' => $aExcludeClass
		);

		return $aExcludes;
	}

	/**
	 *
	 * @return type
	 */
	public function getOriginalHtml() {
		return $this->sHtml;
	}

	/**
	 *
	 * @return type
	 */
	public function cleanHtml() {
		$hash = preg_replace ( array (
				$this->getHeadRegex ( true ),
				'#' . $this->ifRegex () . '#',
				'#' . implode ( '', $this->getJsRegex () ) . '#ix',
				'#' . implode ( '', $this->getCssRegex () ) . '#six'
		), '', $this->sHtml );

		return $hash;
	}

	/**
	 */
	public function getHtmlHash() {
		$sHtmlHash = '';

		preg_replace_callback ( '#<(?!/)[^>]++>#i', function ($aM) use (&$sHtmlHash) {
			$sHtmlHash .= $aM [0];

			return;
		}, $this->cleanHtml (), 200 );

		return $sHtmlHash;
	}
	public function isCombineFilesSet() {
		return ! Helper::isMsieLT10 () && $this->params->get ( 'combine_files_enable', 0 ) && ! $this->bAmpPage;
	}

	/**
	 * Removes applicable js and css links from search area
	 */
	public function parseHtml() {
		if ($this->isCombineFilesSet () || $this->params->get ( 'http2_push_enabled', '0' )) {
			$this->initSearch ( $this->setupExcludes () );
		}

		$this->getImagesWithoutAttributes ();
	}

	/**
	 * Fetches class property containing array of matches of urls to be removed from HTML
	 *
	 * @return array
	 */
	public function getReplacedFiles() {
		return $this->aLinks;
	}

	/**
	 * Gets array of javascript files with the defer attributes
	 *
	 * @return array
	 */
	public function getDeferredFiles() {
		return $this->aDefers;
	}
	public function isFileDeferred($sScriptTag, $bIgnoreAsync = false) {
		$a = self::HTML_ATTRIBUTE;
		// By default exclude all kind of script that are loaded in defer mode: defer, type="module", optional async
		$autoExcludeAttr = $this->params->get ( 'auto_exclude_deferred_files', 1 );

		// Shall we ignore files that also include the async attribute
		if ($bIgnoreAsync) {
			$exclude = "(?!(?>\s*+$a)*?\s*+async\b)";
			$attr = 'defer|module';
		} else {
			$exclude = '';
			$attr = '(?:defer|async|module)';
		}

		if ($autoExcludeAttr == 0) { // Exclude nothing
			$exclude = '';
			$attr = 'jspeednoautoexclude';
		} elseif($autoExcludeAttr == 2) { // Exclude type="module"
			if ($bIgnoreAsync) {
				$exclude = "(?!(?>\s*+$a)*?\s*+async\b)";
				$attr = 'jspeednoautoexclude|"module' ;
			} else {
				$exclude = '';
				$attr = '(?:jspeednoautoexclude|async|"module)';
			}
		}

		return preg_match ( "#<\w++\b{$exclude}(?>\s*+{$a})*?\s*+{$attr}\b#i", $sScriptTag );
	}

	/**
	 * Retruns regex for content enclosed in conditional IE HTML comments
	 *
	 * @return string Conditional comments regex
	 */
	public static function ifRegex() {
		return '<!--(?>-?[^-]*+)*?-->';
	}

	/**
	 * Callback function used to remove urls of css and js files in head tags
	 *
	 * @param array $aMatches
	 *        	Array of all matches
	 * @return string Returns the url if excluded, empty string otherwise
	 */
	public function replaceScripts($aMatches, $aCBArgs, $sSection) {
		$sUrl = $aMatches ['url'] = trim ( ! empty ( $aMatches [1] ) ? $aMatches [1] : (! empty ( $aMatches [3] ) ? $aMatches [3] : '') );
		$sDeclaration = $aMatches ['content'] = ! empty ( $aMatches [2] ) ? $aMatches [2] : (! empty ( $aMatches [4] ) ? $aMatches [4] : '');

		if (preg_match ( '#^<!--#', $aMatches [0] ) || (Url::isInvalid ( $sUrl ) && trim ( $sDeclaration ) == '')) {
			return $aMatches [0];
		}

		$sType = preg_match ( '#^<script#i', $aMatches [0] ) ? 'js' : 'css';

		if ($sType == 'js' && (! $this->params->get ( 'javascript', '1' ) || ! $this->isCombineFilesSet ())) {
			$deferred = $this->isFileDeferred ( $aMatches [0] );

			Helper::addHttp2Push ( $sUrl, 'script', $deferred );

			return $aMatches [0];
		}

		if ($sType == 'css' && (! $this->params->get ( 'css', '1' ) || ! $this->isCombineFilesSet ())) {
			Helper::addHttp2Push ( $sUrl, 'style' );

			return $aMatches [0];
		}

		$aExcludes = array ();

		if (isset ( $aCBArgs ['excludes'] )) {
			$aExcludes = $aCBArgs ['excludes'];
		}

		if (isset ( $aCBArgs ['excludes_no_order'] )) {
			$aExcludes_noOrder = $aCBArgs ['excludes_no_order'];
		}

		$aRemovals = array ();

		$sMedia = '';

		if (($sType == 'css') && (preg_match ( '#media=(?(?=["\'])(?:["\']([^"\']+))|(\w+))#i', $aMatches [0], $aMediaTypes ) > 0)) {
			$sMedia .= $aMediaTypes [1] ? $aMediaTypes [1] : $aMediaTypes [2];
		}

		switch (true) {
			// These cases are being excluded without preserving execution order
			case ($sUrl != '' && ! Url::isHttpScheme ( $sUrl )) :
			case (! empty ( $sUrl ) && ! empty ( $aExcludes_noOrder ['js'] ) && Helper::findExcludes ( $aExcludes_noOrder ['js'], $sUrl )) :
			case ($sDeclaration != '' && Helper::findExcludes ( $aExcludes_noOrder ['js_script'], $sDeclaration, 'js' )) :
				// Exclude javascript files with async attributes
				if ($sUrl != '') {
					$deferred = $this->isFileDeferred ( $aMatches [0] );
					Helper::addHttp2Push ( $sUrl, $sType, $deferred );
				}

				return $aMatches [0];

			// Remove deferred javascript files (without async attributes) and add them to the $aDefers array
			case ($sUrl != '' && $sType == 'js' && $this->isFileDeferred ( $aMatches [0], true )) :

				Helper::addHttp2Push ( $sUrl, $sType, true );

				$this->aDefers [] = $aMatches [0];

				return '';

			// These cases are being excluded while preserving execution order
			case (($sUrl != '') && ! $this->isHttpAdapterAvailable ( $sUrl )) :
			case ($sUrl != '' && Url::isSSL ( $sUrl ) && ! extension_loaded ( 'openssl' )) :
			case (($sUrl != '') && ! empty ( $aExcludes [$sType] ) && Helper::findExcludes ( $aExcludes [$sType], $sUrl )) :
			case ($sDeclaration != '' && $this->excludeDeclaration ( $sType )) :
			case ($sDeclaration != '' && Helper::findExcludes ( $aExcludes [$sType . '_script'], $sDeclaration, $sType, $aMatches[0] )) :
			case (($sUrl != '') && $this->excludeExternalExtensions ( $sUrl )) :

				// We want to put the combined js files as low as possible, if files were removed before,
				// we place them just above the excluded files
				if ($sType == 'js' && ! $this->bExclude_js && ! empty ( $this->aLinks ['js'] )) {
					if(!$this->params->get('only_js_minify', 0)) {
						$aMatches [0] = '<JSPEED_JS' . $this->iIndex_js . '>' . $this->sLnEnd . $this->sTab . $aMatches [0];
					} else {
						if($this->params->get('exclude_all_scripts', 0) && $this->iIndex_js == 0) {
							$aMatches [0] = '<JSPEED_JS' . $this->iIndex_js . '>' . $this->sLnEnd . $this->sTab . $aMatches [0];
						}
					}
				}

				// Set the exclude flag so hereafter we know the last file was excluded while preserving
				// the execution order
				$this->{'bExclude_' . $sType} = true;

				if ($sUrl != '') {
					Helper::addHttp2Push ( $sUrl, $sType );
				}

				// Check if extracted excluded scripts must be loaded by defer
				if ($this->params->get ( 'defer_js', 0 )) {
					$excludedScript = false;
					$excludeDefer = $this->params->get ( 'exclude_defer', array () );
					if (! empty ( $excludeDefer )) {
						foreach ( $excludeDefer as $scriptExcludedFromDefer ) {
							if (stripos ( $scriptExcludedFromDefer, $sUrl ) !== false || stripos ( $sUrl, $scriptExcludedFromDefer ) !== false) {
								$excludedScript = true;
							}
						}
					}
					if (! $excludedScript) {
						$aMatches [0] = str_replace ( '></script>', ' defer></script>', $aMatches [0] );
					}
				}

				return $aMatches [0];

			// Remove duplicated files from the HTML. We don't need duplicates in the combined files
			// Placed below the exclusions so it's possible to exclude them
			case (($sUrl != '') && $this->isDuplicated ( $sUrl )) :

				return '';

			// These files will be combined
			default :
				$return = '';

				// mark location of first css file
				if ($sType == 'css' && empty ( $this->aLinks ['css'] )) {
					$return = '<JSPEED_CSS' . $this->iIndex_css . '>';
				}

				// The last file was excluded while preserving execution order
				if ($this->{'bExclude_' . $sType}) {
					// reset Exclude flag
					$this->{'bExclude_' . $sType} = false;

					// mark location of next removed css file
					if ($sType == 'css' && ! empty ( $this->aLinks ['css'] ) &&  ! $this->params->get('only_css_minify', 0)) {
						$return = '<JSPEED_CSS' . ++ $this->iIndex_css . '>';
					}

					if ($sType == 'js' && ! empty ( $this->aLinks ['js'] )) {
						$this->iIndex_js ++;
					}
				}

				$array = array ();

				// Remove any nonce attribute to be evaluated for the cache Id in Joomla 4
				$array ['match'] = preg_replace('/\s*nonce=".*"/iU', '', $aMatches [0]);

				if ($sUrl == '' && trim ( $sDeclaration ) != '') {
					$content = HtmlOptimizer::cleanScript ( $sDeclaration, $sType );

					$array ['content'] = $content;
				} else {
					$array ['url'] = $sUrl;
				}

				if ($this->sFileHash != '') {
					$array ['id'] = $this->getFileID ( $aMatches );
				}

				if ($sType == 'css') {
					$array ['media'] = $sMedia;
				}

				$this->aLinks [$sType] [$this->{'iIndex_' . $sType}] [] = $array;

				return $return;
		}
	}

	/**
	 * Checks if a file appears more than once on the page so it's not duplciated in the combined files
	 *
	 *
	 * @param string $sUrl
	 *        	Url of file
	 * @return bool True if already included
	 */
	public function isDuplicated($sUrl) {
		$sUrl = Uri::getInstance ( $sUrl )->toString ( array (
				'host',
				'path',
				'query'
		) );
		$return = in_array ( $sUrl, $this->aUrls );

		if (! $return) {
			$this->aUrls [] = $sUrl;
		}

		return $return;
	}

	/**
	 */
	public function getJsRegex() {
		$aRegex = array ();

		$a = self::HTML_ATTRIBUTE;
		$u = self::ATTRIBUTE_VALUE;

		$aRegex [0] = "(?:<script\b(?!(?>\s*+$a)*?\s*+type\s*+=\s*+(?![\"']?(?:text/javascript|application/javascript|module)[\"' ]))";
		$aRegex [1] = "(?>\s*+(?!src)$a)*\s*+(?:src\s*+=\s*+[\"']?($u))?[^<>]*+>((?><?[^<]*+)*?)</\s*+script\s*+>)";

		return $aRegex;
	}

	/**
	 *
	 * @return string
	 */
	public function getCssRegex() {
		$aRegex = array ();

		$a = self::HTML_ATTRIBUTE;
		$u = self::ATTRIBUTE_VALUE;

		$aRegex [0] = "(?:<link\b(?!(?>\s*+$a)*?\s*+(?:itemprop|disabled|type\s*+=\s*+(?![\"']?text/css[\"' ])|rel\s*+=\s*+(?![\"']?stylesheet[\"' ])))";
		$aRegex [1] = "(?>\s*+$a)*?\s*+href\s*+=\s*+[\"']?($u)[^<>]*+>)";
		$aRegex [3] = "|(?:<style\b(?:(?!(?:\stype\s*+=\s*+(?!(?>[\"']?(?>text/(?>css|stylesheet)|\s++)[\"' ])|\"\"|''))|(?:scoped|amp))[^>])*>((?><?[^<]+)*?)</\s*+style\s*+>)";

		return $aRegex;
	}

	/**
	 * Get the search area to be used..head section or body
	 *
	 * @param type $sHead
	 * @return type
	 */
	public function getBodyHtml() {
		if (preg_match ( $this->getBodyRegex (), $this->sHtml, $aBodyMatches ) === false || empty ( $aBodyMatches )) {
			throw new \Exception ( 'Error occurred while trying to match for search area.' . ' Check your template for open and closing body tags' );
		}

		return $aBodyMatches [0] . $this->sRegexMarker;
	}
	public function setBodyHtml($sHtml) {
		$sHtml = $this->cleanRegexMarker ( $sHtml );
		$this->sHtml = preg_replace ( $this->getBodyRegex (), Helper::cleanReplacement ( $sHtml ), $this->sHtml, 1 );
	}
	public function getFullHtml() {
		return $this->sHtml . $this->sRegexMarker;
	}
	public function setFullHtml($sHtml, $deferCall = false) {
		$this->sHtml = $this->cleanRegexMarker ( $sHtml );
		
		// Feature to modulepreload all module scripts
		if ($this->params->get ( 'preload_module_scripts', 0 ) && $deferCall) {
			$obj = $this->modulePreloadObject;
			$modulesToPreload = null;
			preg_replace_callback ( '/<script(?:.)*type="module"(?:.)*><\/script>/i', function ($aMatches) use ($obj, &$modulesToPreload) {
				// Get the script source
				preg_match('/src="(.*)"/iU', $aMatches[0], $scriptSrc);
				
				// Get all sub imports to create the import chain of modulepreload
				$oFileRetriever = FileScanner::getInstance ();
				$mainPreloadModuleScript = preg_replace('/\?.*/', '', ltrim($scriptSrc[1], '/'));
				$mainPreloadModuleScriptParts = explode('/', $mainPreloadModuleScript);
				array_pop($mainPreloadModuleScriptParts);
				$mainPreloadModuleScriptPath = implode('/', $mainPreloadModuleScriptParts);
				
				// Manage subdomain subfolder overlap
				$jPathRoot = JPATH_ROOT;
				$explodedRoot = explode('/', JPATH_ROOT);
				$explodedMatch = $mainPreloadModuleScriptParts;
				if(array_pop($explodedRoot) == array_shift($explodedMatch)) {
					$jPathRoot = dirname(JPATH_ROOT);
				}
				
				// Fetch the script content
				$scriptModuleContents = $oFileRetriever->getFileContents($jPathRoot . '/' . $mainPreloadModuleScript);
				preg_match_all('/import(.*)from[\'"](.*)[\'"];/U', $scriptModuleContents, $imports);
				
				// Generate the modules chain
				$chainImports = null;
				if(isset($imports[2]) && !empty($imports[2])) {
					$uriInstance = JUri::getInstance();
					foreach ($imports[2] as $chainImport) {
						$chainImport = preg_replace('/\.\//', '', $chainImport);
						$chainImportPath = $mainPreloadModuleScriptPath . '/' . ltrim($chainImport, '/');
						if(!array_key_exists($chainImportPath, $obj->preloadedModules)) {
							$obj->preloadedModules[$chainImportPath] = true;
							$chainImports .= '<link rel="modulepreload" href="' . (rtrim($uriInstance->getScheme() . '://' . $uriInstance->getHost(), '/')) . '/' . $chainImportPath . '">';
						}
					}
				}
				
				$modulesToPreload .= $chainImports . '<link rel="modulepreload" href="' . $scriptSrc[1] . '">';
			}, $this->sHtml );
			
			$this->sHtml = preg_replace ( '#' . Linker::getEndHeadTag () . '#i', $this->sTab . $modulesToPreload . $this->sLnEnd . '</head>', $this->sHtml, 1 );
		}
	}

	/**
	 *
	 * @return boolean
	 */
	public function excludeDeclaration($sType) {
		return ($sType == 'css' && (! $this->params->get ( 'inline_style', 1 ) || $this->params->get ( 'exclude_all_styles', 0 ))) || ($sType == 'js' && (! $this->params->get ( 'inline_scripts', 1 ) || $this->params->get ( 'exclude_all_scripts', 0 )));
	}

	/**
	 * Determines if file contents can be fetched using http protocol if required
	 *
	 * @param string $sPath
	 *        	Url of file
	 * @return boolean
	 */
	public function isHttpAdapterAvailable($sUrl) {
		if ($this->params->get ( 'php_and_external_resources', '1' )) {
			if (preg_match ( '#^(?:http|//)#i', $sUrl ) && ! Url::isInternal ( $sUrl ) || $this->isPHPFile ( $sUrl )) {
				return $this->oFileRetriever->isHttpAdapterAvailable ();
			} else {
				return true;
			}
		} else {
			return parent::isHttpAdapterAvailable ( $sUrl );
		}
	}

	/**
	 */
	public function executeCDNParseReplacement() {
		if ($this->params->get ( 'cdn_loading_enable', '0' )) {

			$static_files_array = Helper::getCdnFileTypes ( $this->params );
			$sf = implode ( '|', $static_files_array );
			$a = self::HTML_ATTRIBUTE;
			$u = self::ATTRIBUTE_VALUE;
			// Check for exclusions
			$cdnFilesExcluded = $this->params->get('cdn_assets_excluded', array());
			
			$uri = clone Uri::getInstance ();
			$port = $uri->toString ( array (
					'port'
			) );

			if (empty ( $port )) {
				$port = ':80';
			}

			$host = '(?:www\.)?' . preg_quote ( preg_replace ( '#^www\.#i', '', $uri->getHost () ), '#' ) . '(?:' . $port . ')?';

			if (preg_match ( "#<base[^>]*?\shref\s*+=\s*+[\"']\K$u#i", $this->getHeadHtml (), $mm )) {
				$oBaseDir = Uri::getInstance ( $mm [0] );
				$dir = trim ( $oBaseDir->getPath (), '/' );
			} else {
				$dir = trim ( Uri::base ( true ), '/' );
			}
			// This part should match the scheme and host of a local file
			$localhost = '(\s*+(?:(?:https?:)?//' . $host . ')?)(?!http|//)';
			$match = '(?!data:image|[\'"])' . '(?=' . $localhost . ')' . '(?=(?<=")\1((?>\.?[^\.>"?]*+)*?\.(?>' . $sf . '))["?]' . '|(?<=\')\1((?>\.?[^\.>\'?]*+)*?\.(?>' . $sf . '))[\'?]' . '|(?<=\()\1((?>\.?[^\.>)?]*+)*?\.(?>' . $sf . '))[)?]' . '|(?<==)\1((?>\.?[^\.>\s?]*+)*?\.(?>' . $sf . '))[\s?])' . '((?<=\()[^)]*+|' . $u . ')';

			$l = '(?:xlink:)?href|(?:data-)?src|content|poster';
			$x = "(?:(?:<(?:link|script|(?:amp-)?ima?ge?|a|meta|input|video))(?>\s*+$a)*?\s*+" . "(?:(?:(?:$l)\s*+=\s*+[\"']?" . "|style[^>(]*+(?<=url)\(['\"]?))";
			$x .= "|<source(?>\s*+$a)*?\s*+src(?:set)?\s*+=\s*+[\"']?)";
			$s = '<script\b(?:(?! src\*?=)[^>])*+>(?><?[^<]*+)*?</script\s*+>';

			$sRegex = '#(?:(?=[^<>]++>)(?>[\'"(\s]?[^\'"(\s>]*+)*?\s*+' . "(?:(?:$l)\s*+=\s*+[\"']?|(?<=url)\(['\"]?)|" . "(?>[<(]?[^<(]*+(?:$s)?)*?)(?:(?:$x|(?<=url)\([\"']?)?\K$match|\K$)#iS";

			$sProcessedFullHtml = preg_replace_callback ( $sRegex, function ($m) use ($dir, $cdnFilesExcluded) {
				$sPath = $this->fixRelPath ( $m, $dir );

				// Check for exclusions
				if(count($cdnFilesExcluded)) {
					foreach ($cdnFilesExcluded as $excludedFilePath) {
						if(StringHelper::strpos($sPath, $excludedFilePath) !== false) {
							return $sPath;
						}
					}
				}
				
				return Helper::getCDNDomains ( $this->params, $sPath, $m [0] );
			}, $this->getFullHtml () );

			if (is_null ( $sProcessedFullHtml )) {
				return;
			}

			$sRegex2 = "#(?:(?><?[^<]*+)*?(?:<img(?>\s*+$a)*?\s*+srcset\s*+=\s*+[\"']?\K$u|\K$))#iS";

			$sProcessedFullHtml2 = preg_replace_callback ( $sRegex2, function ($m2) use ($dir, $localhost, $sf) {
				$sRegex3 = '#(?:^|,)\s*+\K' . $localhost . '\s?(((?>\.?[^.?,]*+)?\.(?>' . $sf . ')))#iS';

				return preg_replace_callback ( $sRegex3, function ($m3) use ($dir) {
					$sPath = $this->fixRelPath ( $m3, $dir );

					return Helper::getCDNDomains ( $this->params, $sPath, $m3 [0] );
				}, $m2 [0] );
			}, $sProcessedFullHtml );

			$this->setFullHtml ( $sProcessedFullHtml2 );
		}
	}

	/**
	 *
	 * @param type $m
	 * @param type $cdn
	 * @param type $dir
	 * @return type
	 */
	public function cdnCB($m, $dir) {
		$sPath = Url::isPathRelative ( $m [0] ) ? '/' . $dir . '/' . $m [0] : $m [0];

		return Helper::getCDNDomains ( $this->params, $sPath );
	}

	/**
	 *
	 * @return type
	 */
	public function lazyLoadImages() {
		$app = Factory::getApplication();
		
		$lazyLoadExcludeUrls = Helper::findExcludes($this->params->get('excludeLazyLoadUrl', array()), Uri::getInstance()->toString());
		
		// Exclude by menu item
		$lazyLoadExcludeMenuitems = false;
		if (in_array ( $app->input->get ( 'Itemid', '', 'int' ), $this->params->get ( 'excludeLazyLoadMenuitem', array () ) )) {
			$lazyLoadExcludeMenuitems = true;
		}
		
		$bLazyLoad = ( bool ) ($this->params->get ( 'lazyload', '0' ) && ! $this->bAmpPage && !$lazyLoadExcludeUrls && !$lazyLoadExcludeMenuitems);

		if ($bLazyLoad || $this->params->get ( 'http2_push_enabled', '0' )) {

			$aExcludes = array (
					'url' => array (
							'data:image'
					),
					'class' => array()
			);

			if ($bLazyLoad) {
				if($this->params->get ( 'lazyload_mode', 'both' ) == 'both') {
					// Evaluate nonce csp feature
					$appNonce = $app->get('csp_nonce', null);
					$nonce = $appNonce ? ' nonce="' . $appNonce . '"' : '';
					
					$css = '<noscript>
								<style type="text/css"' . $nonce . '>
									.jspeed-img-lazyload{
										display: none;
									}                               
								</style>                                
							</noscript>
						</head>';
	
					$this->sHtml = preg_replace ( '#' . Linker::getEndHeadTag () . '#i', $css, $this->sHtml, 1 );
				}
				$aExcludes = array_merge_recursive ( $aExcludes, $this->getLazyLoadExcludes () );
			}

			$sRegex = $this->getLazyLoadRegex ();
			// print($sRegex); exit();
			$sBodyHtml = '<JSPEED_START>' . $this->getBodyHtml ();
			$aArgs = array (
					'regex' => $sRegex,
					'html' => $sBodyHtml,
					'lazyload' => $bLazyLoad,
					'excludes' => $aExcludes,
					'excludesurls' => $lazyLoadExcludeUrls,
					'excludemenuitems' => $lazyLoadExcludeMenuitems,
					'deferred' => (bool)$this->params->get('lazyload', 0),
					'toplevel' => true,
					'parent' => ''
			);
			$sLazyLoadBodyHtml = $this->getLazyLoadBodyHtml ( $aArgs );

			// Exclude images by CSS selector
			if($bLazyLoad && $excludeLazyLoadCssSelector = trim($this->params->get('excludeLazyLoadCssSelector', ''))) {
				$simpleHtmlDomInstance = new SimpleHtmlDom();
				$simpleHtmlDomInstance->load( $sLazyLoadBodyHtml );
				
				// Revert to plain img all matching ones removing all lazy loading
				foreach ( $simpleHtmlDomInstance->find( $excludeLazyLoadCssSelector ) as $element ) {
					$element->setAttribute('data-jspeed-exclude-lazyload', 1);
					$currentDataSrc = $element->getAttribute('data-src');
					if($currentDataSrc) {
						$element->setAttribute('src', $currentDataSrc);
					}
					$element->removeAttribute('data-src');
					$element->removeAttribute('data-jspeed-lazyload');
					$element->removeAttribute('loading');
					
					// Reset the current lazy-load added class
					$currentClasses = $element->getAttribute('class');
					$clearedClasses = StringHelper::str_ireplace('jspeed-img-lazyload', '', $currentClasses);
					if($clearedClasses) {
						$element->setAttribute('class', $clearedClasses);
					} else {
						$element->removeAttribute('class');
					}
				}
				
				$sLazyLoadBodyHtml = $simpleHtmlDomInstance->save();
			}

			if (is_null ( $sLazyLoadBodyHtml )) {
				return;
			}

			$this->setBodyHtml ( $sLazyLoadBodyHtml, $bLazyLoad );
		}
	}
	public function getLazyLoadBodyHtml($aArgs) {
		$sLazyLoadBodyHtml = preg_replace_callback ( $aArgs ['regex'], function ($aMatches) use ($aArgs) {
			if (preg_match ( '#^<JSPEED_START>#i', $aMatches [0] )) {
				$aArgs ['html'] = str_replace ( '<JSPEED_START>', '', $aMatches [0] );
				$aArgs ['lazyload'] = (bool)($this->params->get('lazyload_force_recursive', 0) && $this->params->get('lazyload', 0) && !$aArgs['excludesurls'] && !$aArgs['excludemenuitems']);
				$aArgs ['deferred'] = false;

				return $this->getLazyLoadBodyHtml ( $aArgs );
			} else {
				// Return match if it isn't an HTML element
				if (! isset ( $aMatches [2] )) {
					return $aMatches [0];
				}

				if ($aArgs ['lazyload']) {
					$base = JUri::base ( true ) . '/';
					$fixRelativeLinks = $this->params->get ( 'fix_relative_links', 1 );
					$lazyloadMode = $this->params->get ( 'lazyload_mode', 'both' );

					if ($aMatches [2] == 'img' || $aMatches [2] == 'input') {
						Helper::addHttp2Push ( $aMatches [8], 'image', true );
					}

					// Start putting together the modified element tag
					$return = '<' . $aMatches [2];

					// If a src attribute is found
					if (! empty ( $aMatches [7] )) {
						// Abort if this file is excluded
						if (Helper::findExcludes ( $aArgs ['excludes'] ['url'], $aMatches [8] ) ||
							(! empty ( $aMatches [3] ) && Helper::findExcludes ( $aArgs ['excludes'] ['class'], $aMatches [4] )) ||
							((StringHelper::strpos($aMatches[0], 'data-') !== false || StringHelper::strpos($aMatches[0], 'itemprop') !== false) && Helper::findExcludes ( $aArgs ['excludes'] ['class'], $aMatches [0] ))) {
							return $aMatches [0];
						}

						// Add the section before the src attribute and the modified src and data-src attributes
						if($lazyloadMode != 'native') {
							$return .= $aMatches [6] . 'src="';
							$return .= $aMatches [2] == 'iframe' ? 'about:blank' : 'data:image/svg+xml;base' . '64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNTAiIGhlaWdodD0iNDAwIj48L3N2Zz4=';
						} else {
							$return .= $aMatches [6] . 'src="' . $aMatches [8];
						}

						if ($fixRelativeLinks && (! $this->isFullyQualified ( $aMatches [8] ) && stripos ( $aMatches [8], JUri::root ( false ) ) === false) && substr ( $aMatches [8], 0, 1 ) != '/' && substr ( $aMatches [8], 0, 1 ) != '#') {
							$aMatches [8] = $base . ltrim ( $aMatches [8], '/' );
						}

						if($lazyloadMode != 'native') {
							$return .= '" data-jspeed-lazyload="1" loading="lazy" data-src="' . $aMatches [8] . '"';
						} else {
							$return .= '" data-jspeed-lazyload="1" loading="lazy"';
						}
					}

					// If class attribute not on the appropriate element add it
					if ($aMatches [2] != 'picture' && $aMatches [2] != 'source' && empty ( $aMatches [3] ) && $lazyloadMode != 'native') {
						$return .= ' class="jspeed-img-lazyload"';
					}

					// Lazyload autosize in PHP mode
					if($this->params->get ( 'lazyload_autosize', 0 ) == 1 && $aMatches [2] == 'img') {
						$width = $height = null;
						// Are we dealing with a relative image URL?
						if(strpos($aMatches [8], 'http') === false && strpos($aMatches [8], '//') !== 0) {
							// Manage subdomain subfolder overlap
							$explodedRoot = explode('/', JPATH_ROOT);
							$explodedMatch = explode('/', trim($aMatches [8], '/'));
							if(array_pop($explodedRoot) == array_shift($explodedMatch)) {
								$fileImagePath = dirname(JPATH_ROOT) . $aMatches [8];
							} else {
								$fileImagePath = JPATH_ROOT . $aMatches [8];
							}
							
							if(strpos($fileImagePath, '?')) {
								$chunks = explode('?', $fileImagePath);
								$fileImagePath = $chunks[0];
							}
							
							if($aMatches [8] && file_exists($fileImagePath)) {
								list( $width, $height ) = @getimagesize( $fileImagePath );
							}
						} else { // We deal with an already absolute URL, ok for image src but not for img path so clean it
							// FastImage evaluation for the found image
							$remoteAbsolute = false;
							
							// We must have a local absolute URL in order to reference a local path
							if(stripos($aMatches [8], JUri::root(false)) !== false) {
								$element_path = JPATH_ROOT . '/' . str_replace(JUri::root(false), '', $aMatches [8]);
							} else {
								$element_path = $aMatches [8];
								$remoteAbsolute = true;
							}
							// Local absolute, no problem
							if(!$remoteAbsolute) {
								list( $width, $height ) = @getimagesize( $element_path );
							} else {
								// Check if URL is incomplete format
								if(strpos($element_path, '//') === 0) {
									$element_path = 'http:' . $element_path;
								}
								$image = new FastImage($element_path);
								if($image->getHandle() !== false) {
									list( $width, $height ) = $image->getSize();
								}
							}
						}
						
						// If dimensions found set them
						if($width && $height) {
							if($this->params->get ( 'lazyload_autosize_style', 'attributes' ) == 'style') {
								if(StringHelper::strpos($return, 'style=') !== false) {
									$return = StringHelper::str_ireplace('style="', 'style="width:' . $width . 'px;height:' . $height . 'px;', $return);
								} elseif(StringHelper::strpos($aMatches [9], 'style=') !== false) {
									$aMatches [9] = StringHelper::str_ireplace('style="', 'style="width:' . $width . 'px;height:' . $height . 'px;', $aMatches [9]);
								} else {
									$return .= ' style="width:' . $width . 'px;height:' . $height . 'px"';
								}
							} else {
								$return .= ' width="' . $width . '" height="' . $height . '"';
							}
						}
					}

					// Add the rest of the opening tag
					$return .= $aMatches [9];

					// If the srcset attribute was found convert to data-srcset
					if (! empty ( $aMatches [5] )) {
						$return = str_replace ( $aMatches [5], 'data-' . $aMatches [5], $return );
					}

					if ($aMatches [2] != 'picture' && $aMatches [2] != 'source' && ! empty ( $aMatches [3] ) && $lazyloadMode != 'native') {
						// If class already on element add the lazyload class
						$return = str_replace ( $aMatches [3], $aMatches [3] . ' jspeed-img-lazyload', $return );
					}

					// Process and add content of element if not self closing
					if (isset ( $aMatches [10] )) {
						if ($aMatches [2] == 'picture') {
							$aArgsInner = $aArgs;
							$aArgsInner ['toplevel'] = false;
							$aArgsInner ['html'] = $aMatches [10];
							$aArgsInner ['parent'] = $aMatches [2];
							$aArgsInner ['regex'] = str_replace ( 'img|input', 'img|source', $aArgs ['regex'] );

							$return .= $this->getLazyLoadBodyHtml ( $aArgsInner );
						} else {
							$return .= $aMatches [10];
						}

						// close element
						$return .= "</$aMatches[2]>";
					}

					// Wrap and add img elements in noscript
					if($this->params->get ( 'lazyload_add_noscript', 1 )) {
						if ($aMatches [2] == 'img' || $aMatches [2] == 'iframe') {
							$return .= '<noscript>' . $aMatches [0] . '</noscript>';
						}
					}

					return $return;
				} else {
					if (isset ( $aMatches [7] ) && ($aMatches [2] == 'img' || $aMatches [2] == 'input')) {
						Helper::addHttp2Push ( $aMatches [8], 'image', $aArgs ['deferred'] );
					}

					return $aMatches [0];
				}
			}
		}, $aArgs ['html'] );

		return $sLazyLoadBodyHtml;
	}

	/**
	 *
	 * @return string
	 */
	public function getLazyLoadRegex($admin = false) {
		$s = '<script\b[^>]*+>(?><?[^<]*+)*?</script\s*+>';
		$n = '<noscript\b[^>]*+>(?><?[^<]*+)*?</noscript\s*+>';
		$t = '<textarea\b[^>]*+>(?><?[^<]*+)*?</textarea\s*+>';
		$tags = 'img|input';
		$a = self::HTML_ATTRIBUTE;
		$u = self::ATTRIBUTE_VALUE;

		$sRegex = "(?><?[^<]*+(?:$s|$n|$t)?)*?\K(?:";
		$sRegexImage = "(<($tags)(?!(?>\s*+$a)*?\s*+(?:data-(?>src|original)))";

		// only need input elements with type image
		$sRegexInner = "(?(?<=input)(?=(?>\s*$a)*?\s*+type\s*=\s*['\"]?\s*+image\b))";
		// capture class attribute
		$sRegexInner .= "(?:(?=(?>\s*+$a)*?\s*+(class\s*+=\s*+['\"]?($u))))?";
		// capture srcset attribute
		$sRegexInner .= "(?:(?=(?>\s*+$a)*?\s*+(srcset\s*+=\s*+['\"]?$u)))?";
		// capture src attribute
		$sRegexInner .= "(?:((?>\s*+$a)*?\s*+)(src\s*+=\s*+['\"]?($u)['\"]?))?";
		$sRegexInner .= "([^>]*+>)";

		$sRegexImage .= $sRegexInner . ')';

		if($this->params->get('lazyload_include_iframes', 1)) {
			$sRegexVideo = "(<(iframe|picture)$sRegexInner)";
		} else {
			$sRegexVideo = "(<(picture)$sRegexInner)";
		}
		
		$sRegexVideo .= "(?:((?><?[^<]*+){0,10})</\\2\s*+>)?";

		$sRegex .= "(?|(?:$sRegexImage)|(?:$sRegexVideo))";

		$sRegex .= '|\K$)';

		// Skip first 80 elements before starting to modify images for lazy load to avoid problems
		// with css render blocking
		$s80 = '(?:(?><?(?:[a-z0-9]++)(?:[^>]*+)>(?><?[^<]*+)*?(?=<[a-z0-9])){80}|$)';

		/**
		 * Capturing groups
		 * \1 Opening tag
		 * \2 Element label
		 * \3 Class attribute (less closing delimiter)
		 * \4 Value of class attribute
		 * \5 Srcset attribute (less closing delimiter)
		 * \6 Section between label and src attribute
		 * \7 src attribute
		 * \8 Value of src attribute
		 * \9 Rest of opening tag after src attribute
		 * \10 Content of non-self closing element
		 */

		if (! $admin) {
			$sFullRegex = "#(?><JSPEED_START>(?><?[^<]*+)*?{$s80})|(?:$sRegex)#i";
		} else {
			$sFullRegex = "#(?>^(?><?[^<]*+)*?{$s80}{$sRegex})|(?:$sRegex)#i";
		}

		return $sFullRegex;
	}

	/**
	 * Generates a cache id for each matched file/script.
	 * If the files is associated with Google fonts,
	 * a browser hash is also computed.
	 *
	 *
	 * @param array $aMatches
	 *        	Array of files/scripts matched to be optimized and combined
	 * @return string md5 hash for the cache id
	 */
	public function getFileID($aMatches) {
		$id = '';
		
		// If name of file present in match set id to filename
		if (! empty ( $aMatches ['url'] )) {
			$id .= $aMatches ['url'];
			
			// If file is a, or imports Google fonts, add browser hash to id
			if (strpos ( $aMatches ['url'], 'fonts.googleapis.com' ) !== false || in_array ( $aMatches ['url'], $this->containsgf )) {
				$browser = Browser::getInstance ();
				$id .= $browser->getFontHash ();
			}
			
			if($this->params->get('adaptive_contents_enable', 0) && isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
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
					$browser = Browser::getInstance ();
					$id .= $browser->getFontHash ();
				}
			}
		} else {
			// No file name present so just use contents of declaration as id
			$id .= $aMatches ['content'];
		}
		
		return md5 ( $this->sFileHash . $id );
	}

	/**
	 * Constructor
	 *
	 * @param Registry object $params Plugin parameters
	 * @param string $sHtml Page HMTL
	 */
	public function __construct($oParams, $sHtml, $oFileRetriever) {
		$this->params = $oParams;
		$this->sHtml = $sHtml;

		$this->oFileRetriever = $oFileRetriever;

		$this->sLnEnd = Utilities::lnEnd ();
		$this->sTab = Utilities::tab ();

		$oUri = Uri::getInstance ();
		$this->sFileHash = serialize ( $this->params->getOptions () ) . JSPEED_VERSION . $oUri->toString ( array (
				'scheme',
				'host'
		) );

		// Get array of filenames from cache that imports Google font files
		$containsgf = Cache::getCache ( 'jspeed_particle' );
		// If cache is not empty save to class property
		if ($containsgf !== false) {
			$this->containsgf = $containsgf;
		}

		$this->bAmpPage = ( bool ) preg_match ( '#<html [^>]*?(?:&\#26A1;|amp)(?: |>)#', $sHtml );

		$this->parseHtml ();
	}
}
