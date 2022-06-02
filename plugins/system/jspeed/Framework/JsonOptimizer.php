<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class JsonOptimizer extends BaseOptimizer {
	public $json;
	private function __construct($json, $options) {
		$this->json = $json;

		foreach ( $options as $key => $value ) {
			$this->{'_' . $key} = $value;
		}
	}
	private function _optimize() {
		// regex for double quoted strings
		$s1 = self::DOUBLE_QUOTE_STRING;

		// regex for single quoted string
		$s2 = self::SINGLE_QUOTE_STRING;

		// regex for block comments
		$b = self::BLOCK_COMMENT;

		// regex for line comments
		$c = self::LINE_COMMENT;

		// regex for HTML comments
		$h = self::HTML_COMMENT;

		// remove all comments
		$rx = "#(?>[^/\"'<]*+(?:$s1|$s2)?)*?\K(?>{$b}|{$c}|{$h}|$)#si";
		$this->json = $this->_replace ( $rx, '', $this->json, '1' );

		// remove whitespaces around :,{}
		$rx = "#(?>[^\"'\s]*+(?:{$s1}|{$s2})?)*?\K(?>\s++(?=[:,{}\[\]])|(?<=[:,{}\[\]])\s++|$)#s";
		$this->json = $this->_replace ( $rx, '', $this->json, '2' );

		return $this->json;
	}
	public static function optimize($json, $options = array ()) {
		$obj = new JsonOptimizer ( $json, $options );

		try {
			return $obj->_optimize ();
		} catch ( \Exception $e ) {
			return $obj->js;
		}
	}
}
