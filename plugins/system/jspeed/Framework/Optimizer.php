<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Factory;
use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Component\ComponentHelper;

class Optimizer {
	private $jit = 1;
	public $params = null;

	/**
	 * Private Constructor, instance only by the factory method
	 *
	 * @param type $oParams
	 *        	Plugin parameters
	 */
	private function __construct($oParams) {
		JSpeedAutoLoader ( 'JSpeed\Settings' );

		ini_set ( 'pcre.backtrack_limit', 1000000 );
		ini_set ( 'pcre.recursion_limit', 100000 );

		if (version_compare ( PHP_VERSION, '7.0.0', '>=' )) {
			$this->jit = ini_get ( 'pcre.jit' );
			ini_set ( 'pcre.jit', 0 );
		}

		if ($oParams instanceof Settings) {
			$this->params = $oParams;
		} else {
			$this->params = Settings::getInstance ( $oParams );
		}
	}
	protected function sendHeaders() {
		$headers = array ();

		if ($this->params->get ( 'http2_push_enabled', '0' )) {
			$aPreloads = Helper::$preloads;

			if (! empty ( $aPreloads )) {
				$headers ['Link'] = implode ( ',', $aPreloads );
			}
		}

		if (! empty ( $headers )) {
			Utilities::sendHeaders ( $headers );
		}
	}

	/**
	 * Optimize website by aggregating css and js
	 */
	public function process($sHtml) {
		JSpeedAutoLoader ( array (
				'JSpeed\BaseClass',
				'JSpeed\Parser',
				'JSpeed\FileScanner',
				'JSpeed\Linker',
				'JSpeed\Helper'
		) );

		try {
			$oParser = new Parser ( $this->params, $sHtml, FileScanner::getInstance () );

			$oLinkBuilder = new Linker ( $oParser );
			$oLinkBuilder->generateLinks ();

			$oParser->executeCDNParseReplacement ();
			$oParser->lazyLoadImages ();
			
			// Images optimization, check exclude if mobile device Responsivizer is on execution
			$toOptimizeHtml = $oParser->getHtml ();
			$app = Factory::getApplication ();
			$isMobileOnCookie = isset($GLOBALS['_' . strtoupper('cookie')][ApplicationHelper::getHash ( 'RESPONSIVIZER_TEMPLATE' . @$_SERVER['HTTP_USER_AGENT'] )]);
			$isMobileOnApp = $app->get('ismobile', false);
			$isMobileLightImages = ComponentHelper::getParams('com_responsivizer')->get('plugin_lightimgs_status', 0);
			if($this->params->get('lightimgs_status', 0)) {
				// Exclude Responsivizer if its own light images is enabled, override JSpeed
				if(($isMobileOnCookie || $isMobileOnApp) && $isMobileLightImages) {
					// Do nothing
				} else {
					$imagesOptimizer = new LightImages($this->params);
					$optimizedImagesHtml = $imagesOptimizer->optimize($toOptimizeHtml);
					if($optimizedImagesHtml) {
						$toOptimizeHtml = $optimizedImagesHtml;
					}
				}
			}

			$sOptimizedHtml = Helper::minifyHtml ( $toOptimizeHtml, $this->params );

			$this->sendHeaders ();
		} catch ( \Exception $e ) {
			$sOptimizedHtml = $sHtml;
		}

		if (version_compare ( PHP_VERSION, '7.0.0', '>=' )) {
			ini_set ( 'pcre.jit', $this->jit );
		}

		return $sOptimizedHtml;
	}

	/**
	 * Static method to initialize the plugin
	 *
	 * @param type $params
	 *        	Plugin parameters
	 */
	public static function optimize($oParams, $sHtml) {
		if (version_compare ( PHP_VERSION, '5.3.0', '<' )) {
			throw new \Exception ( 'PHP Version not compatible, the minimum PHP version required is >= 5.3' );
		}

		$pcre_version = preg_replace ( '#(^\d++\.\d++).++$#', '$1', PCRE_VERSION );

		if (version_compare ( $pcre_version, '7.2', '<' )) {
			throw new \Exception ( 'PCRE Version not compatible, the minimum PCRE version installed on the server must be >= 7.2' );
		}

		$optimizerInstance = new Optimizer ( $oParams );

		return $optimizerInstance->process ( $sHtml );
	}
}
