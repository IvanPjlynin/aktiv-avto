<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

class Plugin {
	protected static $plugin = null;

	/**
	 *
	 * @return type
	 */
	private static function loadplugin() {
		if (self::$plugin !== null) {
			return self::$plugin;
		}
		
		$db = Factory::getContainer()->get('DatabaseDriver');
		$query = $db->getQuery ( true )
					->select ( 'folder AS type, element AS name, params, extension_id' )
					->from ( '#__extensions' )
					->where ( 'element = ' . $db->quote ( 'jspeed' ) )
					->where ( 'type = ' . $db->quote ( 'plugin' ) );
		
		self::$plugin = $db->setQuery ( $query )->loadObject ();
		
		return self::$plugin;
	}
	
	/**
	 *
	 * @return type
	 */
	public static function getPluginId() {
		$plugin = static::loadplugin ();

		return $plugin->extension_id;
	}

	/**
	 *
	 * @return type
	 */
	public static function getPlugin() {
		$plugin = static::loadplugin ();

		return $plugin;
	}

	/**
	 */
	public static function getPluginParams() {
		static $params = null;

		if (is_null ( $params )) {
			$plugin = self::getPlugin ();
			$pluginParams = new Registry ();
			$pluginParams->loadString ( $plugin->params );

			$params = Settings::getInstance ( $pluginParams );
		}

		return $params;
	}
}
