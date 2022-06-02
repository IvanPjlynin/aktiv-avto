<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class Browser {

	// adler32 hash of response from http://fonts.googleapis.com/css?family=Racing+Sans+One/file type
	protected $fontHash = '34fd5b32/ttf';
	protected $browser = 'Unknown';
	protected $version = 0.0;
	protected static $instances = array ();
	public static function getInstance($userAgent = '') {
		if ($userAgent == '' && isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
			$userAgent = trim ( $_SERVER ['HTTP_USER_AGENT'] );
		}

		$params = Plugin::getPluginParams ();
		if($params->get('adaptive_contents_enable', 0)) {
			if(array_key_exists($_SERVER['REMOTE_ADDR'], JsonManager::$botsIP)) {
				$userAgent .= ' GTMetrix';
			}
		}

		$signature = md5 ( $userAgent );

		if (! isset ( self::$instances [$signature] )) {
			self::$instances [$signature] = new Browser ( $userAgent );
		}

		return self::$instances [$signature];
	}
	public function parseUserAgent($userAgent) {
		// Chrome
		if (preg_match ( '#^(?:(?=[^(]*+\([^AM)]*+(Android|Macintosh)))?(?>(?:Mozilla|AppleWebKit|Safari)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?|Chrome/(\d++\.\d++)[\d. ]*+|Mobile\s*+){4,5}$|' . '^(?=[^(]*+\([^A)]*+Android)(?=(?>V?[^V]*+)*?Version/)(?>(?:Mozilla|AppleWebKit|Safari|Version)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?|Chrome/(\d++\.\d++)[\d. ]*+|Mobile\s*+){5,6}$|' . '^(?>(?:Mozilla|AppleWebKit|Safari|Chrome)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?|Chromium/(\d++\.\d++)[\d. ]*+|(?:Fedora|Ubuntu)/?[\d. ]*+){5,6}#', $userAgent, $version )) {
			if (! empty ( $version [2] )) {
				$this->browser = 'Chrome';
				$this->version = ( float ) $version [2];
			} elseif (! empty ( $version [3] )) {
				$this->browser = 'Android WebView';
				$this->version = ( float ) $version [3];
			} elseif (! empty ( $version [4] )) {
				$this->browser = 'Chromium';
				$this->version = ( float ) $version [4];
			}

			if (! empty ( $version [1] ) || $this->browser == 'Android WebView') {
				if ($this->version >= 40) {
					$this->fontHash = 'c0fbf0f0/woff2';
				} elseif ($this->version >= 36) {
					$this->fontHash = 'd70f5a27/woff2';
				} elseif ($this->version >= 31) {
					$this->fontHash = '1578596c/woff';
				} else {
					$this->fontHash = '34c6462b/woff';
				}
			} else {
				if ($this->version >= 40) {
					$this->fontHash = 'd858f13e/woff2';
				} elseif ($this->version >= 36) {
					$this->fontHash = 'c9ad59db/woff2';
				} else {
					$this->fontHash = '1dc159a2/woff';
				}
			}
		} // Firefox
		elseif (preg_match ( '#^(?=(?>F?[^F]*+)*?Firefox/(\d++\.\d++))(?:(?=[^(]*+\((?>[AiM]?[^AiM)]*+)*?(Android|(?:Macintosh|iP(?:[oa]d|hone)))))?(?>(?:Mozilla|MyWebkit|Gecko|Firefox|Navigator|TenFourFox)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?|[^/]++){3,4}$#', $userAgent, $version )) {
			$this->browser = 'Firefox';
			$this->version = ( float ) $version [1];

			if (! empty ( $version [2] ) && $version [2] == 'Android') {
				if ($this->version >= 35) {
					$this->fontHash = '9a0a6e1c/woff2/woff';
				} elseif ($this->version >= 3.6) {
					$this->fontHash = '34c6462b/woff';
				}
			} elseif (! empty ( $version [2] )) // iOS
			{
				if ($this->version >= 35) {
					$this->fontHash = '34b7815d/woff2/woff';
				} elseif ($this->version >= 3.6) {
					$this->fontHash = '1578596c/woff';
				} else {
					$this->fontHash = '269b5aae/ttf';
				}
			} else {
				if ($this->version >= 35) {
					$this->fontHash = '0dc68147/woff2/woff';
				} elseif ($this->version >= 3.6) {
					$this->fontHash = '1dc159a2/woff';
				}
			}
		} // Opera
		elseif (preg_match ( '#^(?=(?>V?[^V]*+)*?Version/(\d++\.\d++))(?:(?=[^(]*+\([^O)]*+Opera\s*+Mini/(\d++\.\d++)))?(?>(?:Opera|Presto|Version)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?|[^/]++){3}$|' . '^(?=(?>O?[^O]*+)*?OPR/(\d++\.\d++))(?:(?=[^(]*+\([^M)]*+(Macintosh)))?(?>(?:Mozilla|AppleWebKit|Chrome|Safari|OPR)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?|[^/]++){5}$#', $userAgent, $version )) {
			if (! empty ( $version [2] )) {
				$this->browser = 'Opera Mini';
				$this->version = ( float ) $version [2];
			} else {
				$this->browser = 'Opera';
				$this->version = ( float ) (! empty ( $version [1] ) ? $version [1] : $version [3]);
			}

			if (! empty ( $version [4] ) && $version [4] == 'Macintosh') {
				if ($this->version >= 23) {
					$this->fontHash = 'c0fbf0f0/woff2';
				} elseif ($this->version >= 11.1) {
					$this->fontHash = '1578596c/woff';
				} else {
					$this->fontHash = '269b5aae/ttf';
				}
			} else {
				if ($this->version >= 23) {
					$this->fontHash = 'd858f13e/woff2';
				} elseif ($this->version >= 11.1) {
					$this->fontHash = '1dc159a2/woff';
				}
			}
		} // Safari
		elseif (preg_match ( '#^(?:(?=[^(]*+\(\s*+(?:Macintosh|iP(?:[oa]d|hone))[^O)]++OS\s*+X?\s*+(\d++[_.]\d*+)))?(?:(?=(?>[CV]?[^CV]*+)*?(CriOS|Version)/(\d++\.\d++)))?(?>(?:Mozilla|AppleWebKit|Version|Mobile|Safari|CriOS|OPiOS)/[\d.\w]*+\s*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?){4,5}$#', $userAgent, $version )) {
			if (! empty ( $version [2] ) && $version [2] == 'CriOS') {
				$this->browser = 'Chrome';
			} else {
				$this->browser = 'Safari';
			}

			if (! empty ( $version [3] )) {
				$this->version = ( float ) $version [3];
			}

			if (! empty ( $version [1] )) {
				$os_version = ( float ) (str_replace ( '_', '.', $version [1] )); // OS version

				if ($this->version >= 5 || $this->version == 0.0) {
					$this->fontHash = '1578596c/woff';
				} elseif ($this->version < 5 && $os_version <= 4.2) {
					$this->fontHash = 'd7745f9b/svg';
				} elseif ($this->version < 5 && $os_version > 4.2) {
					$this->fontHash = '269b5aae/ttf';
				}
			}
		} // IE
		elseif (preg_match ( '#^Mozilla/5\.0\s*+\(\s*+Windows\s++(?:NT|Phone)[^T)]*+Trident[^r)]*+rv:(\d++)\.[^)]*+\)\s*+like\s++Gecko\s*+|' . '^Mozilla/[\d. ]*+\(compatible;\s*+MSIE (\d++)\.#', $userAgent, $version )) {
			$this->browser = 'IE';
			$this->version = ( float ) (! empty ( $version [1] ) ? $version [1] : $version [2]);

			if ($this->version >= 9) {
				$this->fontHash = '1dc159a2/woff';
			} else {
				$this->fontHash = 'ea09403b/eot';
			}
		} // Edge
		elseif (preg_match ( '#^(?>(?:Mozilla|AppleWebKit|Safari|Chrome)/[\d. ]*+(?:\([^)]*+\)(?:[^()]*+\))*\s*+)?)++Edge/(\d++\.\d++)[\d. ]*+#', $userAgent, $version )) {
			$this->browser = 'Edge';
			$this->version = ( float ) (! empty ( $version [1] ) ? $version [1] : $this->version);
			$this->fontHash = '1dc159a2/woff';
		} // GTMetrix
		elseif (preg_match ( '#GTMetrix#i', $userAgent, $version )) {
			$this->browser = 'GTMetrix';
			$this->fontHash = 'gtc000mx/woff';
		} // Lighthouse
		elseif (preg_match ( '#Lighthouse#i', $userAgent, $version )) {
			$this->browser = 'Lighthouse';
			$this->fontHash = 'lgh000se/woff';
		} // Googlebot
		elseif (preg_match ( '#Googlebot#i', $userAgent, $version )) {
			$this->browser = 'Googlebot';
			$this->fontHash = 'goo001bo/woff';
		} // Bingbot
		elseif (preg_match ( '#Bingbot#i', $userAgent, $version )) {
			$this->browser = 'Bingbot';
			$this->fontHash = 'bng001bo/woff';
		} // Baiduspider
		elseif (preg_match ( '#Baiduspider#i', $userAgent, $version )) {
			$this->browser = 'Baiduspider';
			$this->fontHash = 'bdug001sp/woff';
		} // Duckduckbot
		elseif (preg_match ( '#Duckduckbot#i', $userAgent, $version )) {
			$this->browser = 'Duckduckbot';
			$this->fontHash = 'dckg001bo/woff';
		} // Twitterbot
		elseif (preg_match ( '#Twitterbot#i', $userAgent, $version )) {
			$this->browser = 'Twitterbot';
			$this->fontHash = 'twtg001bo/woff';
		} // Applebot
		elseif (preg_match ( '#Applebot#i', $userAgent, $version )) {
			$this->browser = 'Applebot';
			$this->fontHash = 'appg001bo/woff';
		} // Semrushbot
		elseif (preg_match ( '#Semrushbot#i', $userAgent, $version )) {
			$this->browser = 'Semrushbot';
			$this->fontHash = 'semg001bo/woff';
		}
	}
	public function getBrowser() {
		return $this->browser;
	}
	public function getFontHash() {
		return $this->fontHash;
	}
	public function getVersion() {
		return $this->version;
	}
	public function __construct($userAgent) {
		$this->parseUserAgent ( $userAgent );
	}
}
