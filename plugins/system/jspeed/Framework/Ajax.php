<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class Ajax {
	/**
	 *
	 * @param Settings $params
	 */
	public static function garbageCron(Settings $params) {
		Cache::gc ();
	}
}
