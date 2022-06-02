<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class Cronjob {
	public $params;

	/**
	 *
	 * @param type $params
	 */
	public function __construct($params) {
		$this->params = $params;
	}

	/**
	 *
	 * @return string
	 */
	public function runCronTasks($oParser) {
		// $this->getAdminObject($oParser);
		$this->garbageCron ();

		return 'CRON';
	}

	/**
	 */
	public function getAdminObject($oParser) {
		try {
			$oAdmin = new Admin ( $this->params );
			$oAdmin->getAdminLinks ( $oParser->getOriginalHtml (), Utilities::menuId () );
		} catch ( \Exception $e ) {
		}
	}

	/**
	 */
	public function garbageCron() {
		Cache::gc ();
	}
}
