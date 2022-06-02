<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Factory;
use JSpeed\Admin;
use JSpeed\Html;
use JSpeed\Plugin;
use JSpeed\Ajax;
use JSpeed\Settings;
use JSpeed\Utilities;
use JSpeed\JsonManager;

include_once JPATH_PLUGINS . '/system/jspeed/Framework/loader.php';

if (! defined ( 'JSPEED_VERSION' )) {
	$currentVersion = strval ( simplexml_load_file ( JPATH_ROOT . '/plugins/system/jspeed/jspeed.xml' )->version );
	define ( 'JSPEED_VERSION', $currentVersion );
}

$app = Factory::getApplication ();

$action = $app->input->get ( 'task', '', 'string' );

if (! $action) {
	exit ();
}

try {
	$results = JSpeedAjaxHelper::$action ();
} catch ( \Exception $e ) {
	$results = $e;
}

if (is_scalar ( $results ) || is_object ( $results )) {
	$out = ( string ) $results;
} else {
	$out = implode ( ( array ) $results );
}

echo $out;
class JSpeedAjaxHelper {
	/**
	 */
	public static function garbagecron() {
		return Ajax::garbageCron ( Settings::getInstance ( $this->params ) );
	}

	/**
	 */
	public static function exclusionfiles() {
		$aData = Utilities::get ( 'data', '', 'array' );

		$params = Plugin::getPluginParams ();
		$oAdmin = new Admin ( $params, true );
		$oHtml = new Html ( $params );

		try {
			$sHtml = $oHtml->getOriginalHtml ();
			$oAdmin->getAdminLinks ( $sHtml );
		} catch ( \Exception $e ) {
		}

		$response = array ();

		if(!empty($aData)) {
			foreach ( $aData as $sData ) {
				$options = $oAdmin->prepareFieldOptions ( $sData ['type'], $sData ['param'], $sData ['group'], false );
				$response [$sData ['id']] = new JsonManager ( $options );
			}
		}
		
		return new JsonManager ( $response );
	}
}

jexit ();
