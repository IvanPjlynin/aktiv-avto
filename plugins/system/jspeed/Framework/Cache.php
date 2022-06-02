<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\Pluginhelper;
use Joomla\CMS\Uri\Uri as JUri;

class Cache {
	/* Array of instances of cache objects */
	protected static $aCacheObject = array ();
	/**
	 *
	 * @param type $id
	 * @param type $lifetime
	 * @return type
	 */
	public static function getCache($id, $checkexpire = false) {
		$oCache = self::getCacheObject (); // Output cache implicit
		$aCache = $oCache->get ( $id );

		if ($aCache === false) {
			return false;
		}

		return $aCache ['result'];
	}

	/**
	 *
	 * @param type $id
	 * @param type $lifetime
	 * @param type $function
	 * @param type $args
	 * @return type
	 */
	public static function getCallbackCache($id, $function, $args) {
		$oCache = self::getCacheObject ( 'callback' ); // Callback cache
		$oCache->get ( $function, $args, $id );

		// Joomla! doesn't check if the cache is stored so we gotta check ourselves
		$aCache = self::getCache ( $id );

		if ($aCache === false) {
			$oCache->clean ( 'plg_jspeed' );
			$oCache->clean ( 'plg_jspeed_nowebp' );
		}

		return $aCache;
	}

	/**
	 *
	 * @param type $type
	 * @return type
	 */
	public static function getCacheObject($argtype = 'output') {
		if (empty ( self::$aCacheObject [$argtype] )) {
			$cachebase = Factory::getApplication()->get('cache_path', JPATH_CACHE);
			$group = 'plg_jspeed';
			$type = $argtype;

			// Override force mode if all images must be converted to WEBP
			$params = Plugin::getPluginParams ();
			$jSpeedBrowser = Browser::getInstance()->getBrowser ();
			if(	$params->get('lightimgs_status', false) &&
				$params->get('convert_all_images_to_webp', 0) &&
				function_exists('imagewebp') &&
				($jSpeedBrowser == 'Safari' || $jSpeedBrowser == 'IE')) {
				$group = 'plg_jspeed_nowebp';
			}
					
			if ($argtype == 'targetcache') { // Output cache implicit
				$cachebase = Paths::cachePath ( false );
				$type = 'output';
				$group = '';
			}

			if ($argtype == 'sourcecache') { // Output cache implicit
				$cachebase = Factory::getApplication()->get('cache_path', JPATH_CACHE) . '/plg_jspeed';
				$type = 'output';
				$group = '';
			}

			if (! file_exists ( $cachebase )) {
				Utilities::createFolder ( $cachebase );
			}

			$options = array (
					'defaultgroup' => $group,
					'checkTime' => true,
					'application' => 'site',
					'language' => 'en-GB',
					'cachebase' => $cachebase,
					'storage' => 'file'
			);

			$oCache = Factory::getContainer()->get(\Joomla\CMS\Cache\CacheControllerFactoryInterface::class)->createCacheController( $type, $options );

			$oCache->setCaching ( true );
			$oCache->setLifeTime ( self::getLifetime () );

			self::$aCacheObject [$argtype] = $oCache;
		}

		return self::$aCacheObject [$argtype];
	}
	protected static function getLifetime() {
		static $lifetime;

		if (! $lifetime) {
			$params = Plugin::getPluginParams ();

			$lifetime = $params->get ( 'cache_lifetime', '60' );
		}

		return ( int ) $lifetime;
	}

	/**
	 *
	 * @param type $lifetime
	 */
	public static function gc() {
		$oCache = self::getCacheObject ( 'sourcecache' );
		$oCache->gc ();

		$oStaticCache = self::getCacheObject ( 'targetcache' );
		$oStaticCache->gc ();

		// Only delete page cache
		self::deleteCache ( true );
	}

	/**
	 */
	public static function saveCache($content, $id) {
		$oCache = self::getCacheObject ();
		$oCache->store ( array (
				'result' => $content
		), $id );
	}

	/**
	 */
	public static function deleteCache($page = false) {
		$return = false;

		// Don't delete if we're only deleting page cache
		if (! $page) {
			$cacheObject = Cache::getCacheObject (); // Output cache implicit
			$oStaticCache = Cache::getCacheObject ( 'targetcache' ); // Output cache implicit

			$return |= $cacheObject->clean ( 'plg_jspeed' );
			$return |= $cacheObject->clean ( 'plg_jspeed_nowebp' );
			$return |= $oStaticCache->clean ();
		}

		$cache = Factory::getContainer()->get(\Joomla\CMS\Cache\CacheControllerFactoryInterface::class)->createCacheController( 'output', array() );

		$return |= $cache->clean ( 'page' );
		
		if(PluginHelper::getPlugin('system', 'pagecacheextended')) {
			$return |= $cache->clean ( 'pce' );
			$return |= $cache->clean ( 'pce-gzip' );
		}

		// Clean LiteSpeed cache if any installed
		Factory::getApplication()->getDispatcher()->triggerEvent ( 'onLSCacheExpired' );

		header ( 'X-LiteSpeed-Purge: *' );
		
		if(Plugin::getPluginParams()->get('clear_server_cache', 0)) {
			self::purgeServerCache(JUri::current());
		}

		return ( bool ) $return;
	}
	
	public static function purgeServerCache($url) {
		$urlFormatted = self::getUrl ( $url );
		$curl = curl_init ();
		curl_setopt ( $curl, CURLOPT_USERAGENT, 'joomla_purgeCache' );
		curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, "PURGE" );
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
				'Host: ' . $urlFormatted ['hostname']
		) );
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 200);
		curl_setopt ( $curl, CURLOPT_TIMEOUT, 200); //timeout in seconds
		curl_setopt ( $curl, CURLOPT_URL, $urlFormatted ['url'] );
		$response = curl_exec ( $curl );
		curl_close ( $curl );
		return true;
	}
	
	protected static function getUrl($url) {
		$parsedUrl = parse_url ( $url );
		$hostname = $parsedUrl ['host'];
		$address = gethostbyname ( $hostname );
		$url = $parsedUrl ['scheme'] . '://' . $address;
		if (isset($parsedUrl ['port']) && $parsedUrl ['port']) {
			$url .= ':' . $parsedUrl ['port'];
		}
		if (isset($parsedUrl ['path']) && $parsedUrl ['path']) {
			$url .= $parsedUrl ['path'];
		}
		if (isset($parsedUrl ['query']) && $parsedUrl ['query']) {
			$url .= '?' . $parsedUrl ['query'];
		}
		if (isset($parsedUrl ['fragment']) && $parsedUrl ['fragment']) {
			$url .= '#' . $parsedUrl ['fragment'];
		}
		return array (
				'url' => $url,
				'hostname' => $hostname
		);
	}
}
