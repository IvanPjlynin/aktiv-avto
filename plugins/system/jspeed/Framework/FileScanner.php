<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class FileScanner {
	protected static $instances = array ();
	protected $oHttpAdapter = Null;
	public $response_code = null;
	public $response_error = '';
	public $allow_400 = false;

	/**
	 * Private constructor, can't be directly instantiated but only through the factory getInstance public method
	 * @param $aDrivers
	 */
	private function __construct($aDrivers) {
		$this->oHttpAdapter = new Http ( $aDrivers );
	}
	
	/**
	 * @param type $sPath
	 * @return type
	 */
	public function getFileContents($sPath, $aPost = null, $aHeader = array (), $sOrigPath = '', $timeout = 7) {
		// We need to use an http adapter if it's a remote or dynamic file
		if (strpos ( $sPath, 'http' ) === 0) {
			// Initialize response code
			$this->response_code = 0;

			try {
				$sUserAgent = ! empty ( $_SERVER ['HTTP_USER_AGENT'] ) ? $_SERVER ['HTTP_USER_AGENT'] : '';
				$aHeader = array_merge ( $aHeader, array (
						'Accept-Encoding' => 'identity, deflate, *;q=0'
				) );
				$response = $this->oHttpAdapter->request ( $sPath, $aPost, $aHeader, $sUserAgent, $timeout );
				$this->response_code = $response ['code'];

				if (! isset ( $response ) || $response === false) {
					throw new \RuntimeException ( sprintf ( 'Failed getting file contents from %s', $sPath ) );
				}
			} catch ( \RuntimeException $e ) {
				// Record error message
				$this->response_error = $e->getMessage ();
			} catch ( \Exception $e ) {
				throw new \Exception ( $sPath . ': ' . $e->getMessage () );
			}

			if ($this->response_code != 200 && ! $this->allow_400) {
				// Most likely a RuntimeException has occurred here in that case we want the error message
				if ($this->response_code === 0 && $this->response_error !== '') {
					$sContents = '|"COMMENT_START ' . $this->response_error . ' COMMENT_END"|';
				} else {
					$sPath = $sOrigPath == '' ? $sPath : $sOrigPath;
					$sContents = $this->notFound ( $sPath );
				}
			} else {
				$sContents = $response ['body'];
			}
		} else {
			if (file_exists ( $sPath )) {
				$sContents = @file_get_contents ( $sPath );
			} elseif ($this->oHttpAdapter->available ()) {
				$sUriPath = Paths::path2Url ( $sPath );

				$sContents = $this->getFileContents ( $sUriPath, null, array (), $sPath );
			} else {
				$sContents = $this->notFound ( $sPath );
			}
		}

		return $sContents;
	}

	/**
	 *
	 * @return type
	 */
	public function isHttpAdapterAvailable() {
		return $this->oHttpAdapter->available ();
	}

	/**
	 *
	 * @param type $sPath
	 * @return type
	 */
	public function notFound($sPath) {
		return '|"COMMENT_START File [' . $sPath . '] not found COMMENT_END"|';
	}
	
	/**
	 *
	 * @return type
	 */
	public static function getInstance() {
		$params = Plugin::getPluginParams();
		switch($params->get('http_transport', 'curl')) {
			case 'socket';
			$aDrivers = array (
					'socket',
					'curl',
					'stream'
			);
			break;
			
			case 'curl':
				$aDrivers = array (
				'curl',
				'socket',
				'stream'
						);
				break;
				
			case 'stream':
				$aDrivers = array (
				'stream',
				'socket',
				'curl'
						);
				break;
				
		}
		
		
		$hash = serialize ( $aDrivers );
		
		if (empty ( static::$instances [$hash] )) {
			static::$instances [$hash] = new FileScanner ( $aDrivers );
		}
		
		return static::$instances [$hash];
	}
}