<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Input\Input;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Crypt\Crypt;
use Joomla\Crypt\Key;
use Joomla\CMS\Environment\Browser;

class Utilities {
	/**
	 *
	 * @return Crypt
	 */
	private static function getCrypt() {
		$crypt = new Crypt ();
		$conf = Factory::getApplication()->getConfig ();

		$key = new Key ( 'simple' );

		$key->private = $conf->get ( 'secret' );
		$key->public = $key->private;

		$crypt->setKey ( $key );

		return $crypt;
	}

	/**
	 *
	 * @param type $text
	 * @return type
	 */
	public static function translate($text) {
		if (strlen ( $text ) > 20) {
			$text = substr ( $text, 0, strpos ( wordwrap ( $text, 20 ), "\n" ) );
		}

		$text = 'PLG_JSPEED_' . strtoupper ( str_replace ( ' ', '_', $text ) );

		return Text::_ ( $text );
	}

	/**
	 *
	 * @return type
	 */
	public static function isMsieLT10() {
		$oBrowser = Browser::getInstance ();

		return (($oBrowser->getBrowser () == 'msie') && ($oBrowser->getMajor () <= '9'));
	}

	/**
	 *
	 * @param type $time
	 * @param type $timezone
	 * @return type
	 */
	public static function unixCurrentDate() {
		return Factory::getDate ( 'now', 'GMT' )->toUnix ();
	}

	/**
	 *
	 * @param type $url
	 * @return type
	 */
	public static function loadAsync($url) {
		return;
	}

	/**
	 *
	 * @return type
	 */
	public static function lnEnd() {
		$oDocument = Factory::getApplication()->getDocument ();

		return $oDocument->_getLineEnd ();
	}

	/**
	 *
	 * @return type
	 */
	public static function tab() {
		$oDocument = Factory::getApplication()->getDocument ();

		return $oDocument->_getTab ();
	}

	/**
	 *
	 * @param type $path
	 */
	public static function createFolder($path) {
		return Folder::create ( $path );
	}

	/**
	 *
	 * @param type $file
	 * @param type $contents
	 */
	public static function write($file, $contents) {
		return File::write ( $file, $contents );
	}

	/**
	 *
	 * @param type $value
	 * @return type
	 */
	public static function decrypt($value) {
		$crypt = self::getCrypt ();

		return $crypt->decrypt ( $value );
	}

	/**
	 *
	 * @param type $value
	 * @return type
	 */
	public static function encrypt($value) {
		$crypt = self::getCrypt ();

		return $crypt->encrypt ( $value );
	}

	/**
	 *
	 * @param type $value
	 * @param type $default
	 * @param type $filter
	 * @param type $method
	 */
	public static function get($value, $default = '', $filter = 'cmd', $method = 'request') {
		$input = new Input();

		return $input->$method->get ( $value, $default, $filter );
	}

	/**
	 *
	 * @return type
	 */
	public static function getLogsPath() {
		$config = Factory::getApplication()->getConfig ();

		return $config->get ( 'log_path' );
	}

	/**
	 */
	public static function menuId() {
		return Utilities::get ( 'Itemid' );
	}

	/**
	 *
	 * @param string $path
	 *        	Path of folder to read
	 * @param string $filter
	 *        	A regex filter for file names
	 * @param boolean $recurse
	 *        	True to recurse into sub-folders
	 * @param array $exclude
	 *        	An array of files to exclude
	 *        	
	 * @return array Full paths of files in the folder recursively
	 */
	public static function lsFiles($path, $filter = '.', $recurse = true, $exclude = array ()) {
		$path = rtrim ( $path, '/\\' );

		return Folder::files ( $path, $filter, $recurse, true, $exclude );
	}

	/**
	 */
	public static function isGuest() {
	}

	/**
	 */
	public static function sendHeaders($headers) {
		// print_r($headers); exit();
		if (! empty ( $headers )) {
			$app = Factory::getApplication ();

			foreach ( $headers as $header => $value ) {
				$app->setHeader ( $header, $value, true );
			}
		}
	}
}
