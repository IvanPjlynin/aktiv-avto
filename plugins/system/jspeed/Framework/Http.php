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
use Joomla\Registry\Registry;
use Joomla\CMS\Http\HttpFactory;

class Http {
	protected $oHttpAdapter = false;

	/**
	 *
	 * @param type $sPath
	 * @param type $aPost
	 * @return type
	 * @throws Exception
	 */
	public function request($sPath, $aPost = null, $aHeaders = null, $sUserAgent = '', $timeout = 5) {
		if (! $this->oHttpAdapter) {
			throw new \BadFunctionCallException ( Utilities::translate ( 'No HTTP Adapter present' ) );
		}

		$oUri = Uri::getInstance ( $sPath );

		$method = ! isset ( $aPost ) ? 'GET' : 'POST';

		$oResponse = $this->oHttpAdapter->request ( $method, $oUri, $aPost, $aHeaders, $timeout, $sUserAgent );

		$return = array (
				'body' => $oResponse->body,
				'code' => $oResponse->code
		);

		return $return;
	}

	/**
	 */
	public function available() {
		return $this->oHttpAdapter;
	}

	/**
	 */
	public function __construct($aDrivers) {
		$aOptions = array ();

		if (empty ( ini_get ( 'open_basedir' ) )) {
			$aOptions ['follow_location'] = true;
		}

		$oOptions = new Registry ( $aOptions );

		$this->oHttpAdapter = HttpFactory::getAvailableDriver ( $oOptions, $aDrivers );
	}
}
