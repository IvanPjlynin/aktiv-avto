<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class Settings {
	private $params;

	/**
	 * No direct instance
	 *
	 * @param type $params
	 */
	private function __construct($params) {
		$this->params = $params;
	}

	/**
	 *
	 * @param type $params
	 */
	public static function getInstance($params) {
		return new Settings ( $params );
	}

	/**
	 *
	 * @param type $param
	 * @param type $default
	 * @return type
	 */
	public function get($param, $default = NULL) {
		return $this->params->get ( $param, $default );
	}

	/**
	 *
	 * @param type $param
	 * @param type $value
	 */
	public function set($param, $value) {
		$this->params->set ( $param, $value );
	}

	/**
	 *
	 * @param type $param
	 * @param type $value
	 */
	public function toArray() {
		return $this->params->toArray ();
	}

	/**
	 */
	public function __clone() {
		$this->params = unserialize ( serialize ( $this->params ) );
	}

	/**
	 */
	public function getOptions() {
		return $this->params->toObject ();
	}
}
