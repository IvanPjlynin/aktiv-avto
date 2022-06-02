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

class Uri {
	private $oUri;

	/**
	 * No direct instances
	 *
	 * @param type $uri
	 * @return type
	 */
	private function __construct($uri) {
		$this->oUri = clone JUri::getInstance ( $uri );

		if ($uri != 'SERVER') {
			$uri = str_replace ( '\\/', '/', $uri );
			$parts = Helper::parseUrl ( $uri );

			$this->oUri->setScheme ( ! empty ( $parts ['scheme'] ) ? $parts ['scheme'] : '' );
			$this->oUri->setUser ( ! empty ( $parts ['user'] ) ? $parts ['user'] : '' );
			$this->oUri->setPass ( ! empty ( $parts ['pass'] ) ? $parts ['pass'] : '' );
			$this->oUri->setHost ( ! empty ( $parts ['host'] ) ? $parts ['host'] : '' );
			$this->oUri->setPort ( ! empty ( $parts ['port'] ) ? $parts ['port'] : '' );
			$this->oUri->setPath ( ! empty ( $parts ['path'] ) ? $parts ['path'] : '' );
			$this->oUri->setQuery ( ! empty ( $parts ['query'] ) ? $parts ['query'] : '' );
			$this->oUri->setFragment ( ! empty ( $parts ['fragment'] ) ? $parts ['fragment'] : '' );
		}

		return $this->oUri;
	}

	/**
	 *
	 * @param type $path
	 */
	public function setPath($path) {
		$this->oUri->setPath ( $path );
	}

	/**
	 *
	 * @return type
	 */
	public function getPath() {
		return $this->oUri->getPath ();
	}

	/**
	 *
	 * @param array $parts
	 * @return type
	 */
	public function toString(array $parts = array (
			'scheme',
			'user',
			'pass',
			'host',
			'port',
			'path',
			'query',
			'fragment'
	)) {
		return $this->oUri->toString ( $parts );
	}

	/**
	 *
	 * @param type $pathonly
	 * @return type
	 */
	public static function base($pathonly = false) {
		if ($pathonly) {
			return str_replace ( '/administrator', '', JUri::base ( true ) );
		}

		return str_replace ( '/administrator/', '', JUri::base () );
	}

	/**
	 *
	 * @param type $uri
	 */
	public static function getInstance($uri = 'SERVER') {
		static $instances = array ();

		if (! isset ( $instances [$uri] )) {
			$instances [$uri] = new Uri ( $uri );
		}

		return $instances [$uri];
	}

	/**
	 */
	public function __clone() {
		$this->oUri = clone $this->oUri;
	}

	/**
	 *
	 * @param type $query
	 */
	public function setQuery($query) {
		$this->oUri->setQuery ( $query );
	}

	/**
	 *
	 * @return type
	 */
	public static function currentUrl() {
		return JUri::current ();
	}

	/**
	 *
	 * @param type $host
	 */
	public function setHost($host) {
		$this->oUri->setHost ( $host );
	}

	/**
	 */
	public function getHost() {
		return $this->oUri->getHost ();
	}

	/**
	 *
	 * @return type
	 */
	public function getQuery() {
		return $this->oUri->getQuery ();
	}

	/**
	 *
	 * @return type
	 */
	public function getScheme() {
		return $this->oUri->getScheme ();
	}

	/**
	 *
	 * @param type $scheme
	 */
	public function setScheme($scheme) {
		$this->oUri->setScheme ( $scheme );
	}
}
