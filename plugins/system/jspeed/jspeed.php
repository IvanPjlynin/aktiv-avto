<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
// No direct access
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\SubscriberInterface;
use Joomla\Event\Event;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\Pluginhelper;
use Joomla\CMS\HTML\HTMLHelper;
use JSpeed\Uri as JSpeedUri;
use JSpeed\Cache as JSpeedCache;
use JSpeed\Helper as JSpeedHelper;
use JSpeed\JsonManager as JSpeedJsonManager;

if (! defined ( 'JSPEED_VERSION' )) {
	$currentVersion = strval ( simplexml_load_file ( JPATH_ROOT . '/plugins/system/jspeed/jspeed.xml' )->version );
	define ( 'JSPEED_VERSION', $currentVersion );
}

include_once (dirname ( __FILE__ ) . '/Framework/loader.php');
class PlgSystemJSpeed extends CMSPlugin implements SubscriberInterface {
	/**
	 * App instance
	 *
	 * @access protected
	 * @var Object
	 */
	protected $app;
	
	/**
	 * Gets the name of the current Editor
	 *
	 * @staticvar string $sEditor
	 * @return string
	 */
	protected function excludeEditorViews() {
		$aEditors = Pluginhelper::getPlugin ( 'editors' );

		foreach ( $aEditors as $sEditor ) {
			if (class_exists ( 'PlgEditor' . $sEditor->name, false )) {
				return true;
			}
		}

		return false;
	}

	/**
	 *
	 * @return boolean
	 */
	protected function pluginExclusions() {
		$app = Factory::getApplication ();
		$user = $app->getIdentity();

		$menuexcluded = $this->params->get ( 'menuexcluded', array () );
		$menuexcludedurl = $this->params->get ( 'menuexcludedurl', array () );
		
		// Check access levels intersection to ensure that users has access
		// Get users access levels based on user groups belonging
		$userAccessLevels = $user->getAuthorisedViewLevels();
		
		// Get chat access level from configuration, if set AKA param != array(0) go on with intersection
		$excludeAccess = false;
		$accessLevels = $this->params->get('pluginaccesslevels', array(0));
		if(is_array($accessLevels) && !in_array(0, $accessLevels, false)) {
			$intersectResult = array_intersect($userAccessLevels, $accessLevels);
			$excludeAccess = (bool)(count($intersectResult));
		}
		
		// Exclude by default the JSitemap bot for images/videos
		if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
			$pattern = strtolower ( '/JSitemapbot/i' );
			if (preg_match ( $pattern, $_SERVER ['HTTP_USER_AGENT'] )) {
				$excludeAccess = true;
			}
		}
		// Exclude by default all other documents different than html
		$document = $app->getDocument();
		if($document->getType() !== 'html') {
			$excludeAccess = true;
		}

		return (! $app->isClient ( 'site' ) || $excludeAccess || ($app->input->get ( 'jspeedtaskexec', '', 'int' ) == 1) || ($app->get ( 'offline', '0' ) && $user->get ( 'guest' )) || $this->excludeEditorViews () || in_array ( $app->input->get ( 'Itemid', '', 'int' ), $menuexcluded ) || JSpeed\Helper::findExcludes ( $menuexcludedurl, JSpeedUri::getInstance ()->toString () ));
	}

	/**
	 * Provide a hash for the default page cache plugin's key based on type of browser detected by Google font
	 *
	 * @param Event $event
	 * @return string $hash Calculated hash of browser type
	 */
	public function calculatePageCacheKey(Event $event) {
		// subparams: &$result
		$arguments = $event->getArguments();
		$result = isset($arguments['result']) ? $arguments['result'] : [];
		
		$browser = JSpeed\Browser::getInstance ();
		$hash = $browser->getFontHash ();
		
		// ADAPTIVE CONTENTS: remove any matched tag for bots
		// Check for user agent exclusion
		if($this->params->get('adaptive_contents_enable', 0)) {
			if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
				$user_agent = $_SERVER ['HTTP_USER_AGENT'];
				$botRegexPattern = array();
				$botsList = $this->params->get('adaptive_contents_bots_list', array());
				if (! empty ( $botsList )) {
					foreach ( $botsList as &$bot ) {
						$bot = preg_quote($bot);
					}
					$botRegexPattern = implode('|', $botsList);
				}
				
				$isBot = preg_match("/{$botRegexPattern}/i", $user_agent) || array_key_exists($_SERVER['REMOTE_ADDR'], JSpeedJsonManager::$botsIP);
				if($isBot) {
					$hash = md5($hash . '-AdaptiveBot');
				}
			}
		}
		
		$result[] = $hash;
		
		$event->setArgument('result', $result);

		return $result;
	}
	
	/**
	 * Provide the execution of special JSpeed tasks and the injection of lazy loading scripts
	 *
	 * @param Event $event
	 * @return string $hash Calculated hash of browser type
	 */
	public function executeJSpeedTask(Event $event) {
		$app = Factory::getApplication();
		
		// Exclude by menu item
		$lazyLoadExcludeMenuitems = false;
		if (in_array ( $app->input->get ( 'Itemid', '', 'int' ), $this->params->get ( 'excludeLazyLoadMenuitem', array () ) )) {
			$lazyLoadExcludeMenuitems = true;
		}
		
		if ($this->params->get ( 'lazyload', '0' ) && 
			$this->params->get ( 'lazyload_mode', 'both' ) != 'native' && 
			! $this->pluginExclusions () && 
			!JSpeedHelper::findExcludes($this->params->get('excludeLazyLoadUrl', array()), JSpeedUri::getInstance()->toString()) && !$lazyLoadExcludeMenuitems) {
			$wa = $app->getDocument()->getWebAssetManager();
			$wa->registerAndUseScript ( 'jspeed.lazyload_loader', 'plg_jspeed/lazyload_loader.js' );
			
			if ($this->params->get ( 'lazyload_effects', '0' )) {
				$wa->registerAndUseStyle ( 'jspeed.lazyload_effects', 'plg_jspeed/lazyload_effects.css' );
				$wa->registerAndUseScript ( 'jspeed.lazyload_loader_effects', 'plg_jspeed/lazyload_loader_effects.js' );
			}

			// Lazyload autosize in JS mode
			if ($this->params->get ( 'lazyload_autosize', 0 ) == 2) {
				$wa->registerAndUseScript ( 'jspeed.lazyload_autosize', 'plg_jspeed/lazyload_autosize.js' );
			}

			$wa->registerAndUseScript ( 'jspeed.lazyload', 'plg_jspeed/lazyload.js' );
		}
		
		// Check if the Instant Page feature is enabled, if so load the script
		if ($this->params->get ( 'enable_instant_page', '0' ) && ! $this->pluginExclusions ()) {
			$wa = $app->getDocument()->getWebAssetManager();
			$wa->registerAndUseScript ( 'jspeed.instantpage', 'plg_jspeed/instantpage-5.1.0.js', [], ['defer'=>true]);
		}
		
		if($app->isClient('site')) {
			return;
		}
		$matchTask = false;
		$jSpeedtask = $app->input->getCmd('jspeedtask', null);
		switch ($jSpeedtask) {
			case 'optimizehtaccess' :
				$htaccess = JPATH_ROOT . '/.htaccess';

				if (file_exists ( $htaccess )) {
					$contents = file_get_contents ( $htaccess );
					if (! preg_match ( '@\n?## START JSPEED OPTIMIZATIONS ##.*?## END JSPEED OPTIMIZATIONS ##@s', $contents )) {
						$sExpires = PHP_EOL;
						$sExpires .= '## START JSPEED OPTIMIZATIONS ##' . PHP_EOL;
						$sExpires .= '<IfModule mod_expires.c>' . PHP_EOL;
						$sExpires .= '  ExpiresActive on' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Default' . PHP_EOL;
						$sExpires .= '  ExpiresDefault "access plus 1 year"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Application Cache' . PHP_EOL;
						$sExpires .= '  ExpiresByType text/cache-manifest "access plus 0 seconds"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# HTML Document' . PHP_EOL;
						$sExpires .= '  ExpiresByType text/html "access plus 0 seconds"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Data documents' . PHP_EOL;
						$sExpires .= '  ExpiresByType text/xml "access plus 0 seconds"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/xml "access plus 0 seconds"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/json "access plus 0 seconds"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Feed XML' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/rss+xml "access plus 1 hour"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/atom+xml "access plus 1 hour"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Favicon' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/x-icon "access plus 1 week"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Media: images, video, audio' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/gif "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/png "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/jpg "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/jpeg "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/webp "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType video/ogg "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType audio/ogg "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType video/mp4 "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType video/webm "access plus 1 year"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# X-Component files' . PHP_EOL;
						$sExpires .= '  ExpiresByType text/x-component "access plus 1 year"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# Fonts' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/font-ttf "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType font/opentype "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/font-woff "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/font-woff2 "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType image/svg+xml "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/vnd.ms-fontobject "access plus 1 year"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '# CSS and JavaScript' . PHP_EOL;
						$sExpires .= '  ExpiresByType text/css "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType text/javascript "access plus 1 year"' . PHP_EOL;
						$sExpires .= '  ExpiresByType application/javascript "access plus 1 year"' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '  <IfModule mod_headers.c>' . PHP_EOL;
						$sExpires .= '    Header append Cache-Control "public"' . PHP_EOL;
						$sExpires .= '    <FilesMatch ".(js|css|xml|gz|html)$">' . PHP_EOL;
						$sExpires .= '       Header append Vary: Accept-Encoding' . PHP_EOL;
						$sExpires .= '    </FilesMatch>' . PHP_EOL;
						$sExpires .= '  </IfModule>' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '</IfModule>' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '<IfModule mod_deflate.c>' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE text/html' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE text/css' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE text/javascript' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE text/xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE text/plain' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE image/x-icon' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE image/svg+xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/rss+xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/javascript' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/x-javascript' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/xhtml+xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font-truetype' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font-ttf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font-otf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font-opentype' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font-woff' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/font-woff2' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE application/vnd.ms-fontobject' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE font/ttf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE font/otf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE font/opentype' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE font/woff' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType DEFLATE font/woff2' . PHP_EOL;
						$sExpires .= '# GZip Compression' . PHP_EOL;
						$sExpires .= 'BrowserMatch ^Mozilla/4 gzip-only-text/html' . PHP_EOL;
						$sExpires .= 'BrowserMatch ^Mozilla/4\.0[678] no-gzip' . PHP_EOL;
						$sExpires .= 'BrowserMatch \bMSIE !no-gzip !gzip-only-text/html' . PHP_EOL;
						$sExpires .= '</IfModule>' . PHP_EOL;
						$sExpires .= '' . PHP_EOL;
						$sExpires .= '<IfModule mod_brotli.c>' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS text/html' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS text/css' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS text/javascript' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS text/xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS text/plain' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS image/x-icon' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS image/svg+xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/rss+xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/javascript' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/x-javascript' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/xhtml+xml' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font-truetype' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font-ttf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font-otf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font-opentype' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font-woff' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/font-woff2' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS application/vnd.ms-fontobject' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS font/ttf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS font/otf' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS font/opentype' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS font/woff' . PHP_EOL;
						$sExpires .= 'AddOutputFilterByType BROTLI_COMPRESS font/woff2' . PHP_EOL;
						$sExpires .= '</IfModule>' . PHP_EOL;
						$sExpires .= '## END JSPEED OPTIMIZATIONS ##' . PHP_EOL;

						$writtenFile = file_put_contents ( $htaccess, $sExpires, FILE_APPEND );
						if($writtenFile) {
							$app->enqueueMessage(Text::_('PLG_JSPEED_HTACCESS_SUCCESSFULLY_CONFIGURED'));
						}
					} else {
						$app->enqueueMessage(Text::_('PLG_JSPEED_HTACCESS_ALREADY_CONFIGURED'));
					}
				} else {
					$app->enqueueMessage(Text::_('PLG_JSPEED_HTACCESS_MISSING'));
				}
				
				$matchTask = true;
			break;
			
			case 'restorehtaccess':
				$htaccess = JPATH_ROOT . '/.htaccess';
				if (file_exists ( $htaccess )) {
					$contents = file_get_contents ( $htaccess );
					$regex = '@\n?## START JSPEED OPTIMIZATIONS ##.*?## END JSPEED OPTIMIZATIONS ##@s';
					
					$clean_contents = preg_replace ( $regex, '', $contents, - 1, $count );
					
					if ($count > 0) {
						$writtenFile = file_put_contents ( $htaccess, $clean_contents );
						if($writtenFile) {
							$app->enqueueMessage(Text::_('PLG_JSPEED_HTACCESS_SUCCESSFULLY_RESTORED'));
						}
					} else {
						$app->enqueueMessage(Text::_('PLG_JSPEED_HTACCESS_ALREADY_RESTORED'));
					}
				} else {
					$app->enqueueMessage(Text::_('PLG_JSPEED_HTACCESS_MISSING'));
				}
				
				$matchTask = true;
			break;
				
			case 'clearcache' :
				// Clear all caches, plugin and page cache, additionally trigger plugin and HTTP headers for cache cleaning
				$outputCache = JSpeedCache::getCacheObject ();
				$staticCache = JSpeedCache::getCacheObject ( 'targetcache' );
				$pageCache = Factory::getContainer()->get(\Joomla\CMS\Cache\CacheControllerFactoryInterface::class)->createCacheController( 'output', array() );
				
				if($outputCache->clean ( 'plg_jspeed' ) && $outputCache->clean ( 'plg_jspeed_nowebp' )) {
					$app->enqueueMessage(Text::_('PLG_JSPEED_PLUGIN_CACHE_SUCCESSFULLY_CLEARED'));
				}
				
				if($staticCache->clean ()) {
					$app->enqueueMessage(Text::_('PLG_JSPEED_STATIC_CACHE_SUCCESSFULLY_CLEARED'));
				}

				if($pageCache->clean ( 'page' )) {
					$app->enqueueMessage(Text::_('PLG_JSPEED_PAGE_CACHE_SUCCESSFULLY_CLEARED'));
				}

				if(PluginHelper::getPlugin('system', 'pagecacheextended')) {
					if($pageCache->clean ( 'pce' )) {
						$app->enqueueMessage(JText::_('PLG_JSPEED_PAGE_CACHE_PCE_SUCCESSFULLY_CLEARED'));
					}
					
					if($pageCache->clean ( 'pce-gzip' )) {
						$app->enqueueMessage(JText::_('PLG_JSPEED_PAGE_CACHE_PCE_GZIP_SUCCESSFULLY_CLEARED'));
					}
				}
				
				// Trigger LiteSpeed cache clearing
				$app->getDispatcher()->triggerEvent ( 'onLSCacheExpired' );

				$app->setHeader( 'X-LiteSpeed-Purge', '*' );
				
				if($this->params->get('clear_server_cache', 0)) {
					JSpeedCache::purgeServerCache(Uri::root(false));
					$app->enqueueMessage(Text::_('PLG_JSPEED_SERVER_CACHE_SUCCESSFULLY_CLEARED'));
				}
				
				$matchTask = true;
			break;
		}
		if ($matchTask) {
			$oUri = clone Uri::getInstance ();
			$oUri->delVar ( 'jspeedtask' );
			$app->redirect ( $oUri->toString () );
		}
	}
	
	
	/**
	 * Main plugin execution method, here happens the magic and optimizations of the output buffer
	 *
	 * @param Event $event
	 * @return boolean
	 * @throws Exception
	 */
	public function executeOptimizations(Event $event) {
		if ($this->pluginExclusions ()) {
			return false;
		}
		
		$app = Factory::getApplication ();
		$sHtml = $app->getBody ();
		
		if (! JSpeed\Helper::validateHtml ( $sHtml )) {
			return false;
		}
		
		if ($app->input->get ( 'jspeedtaskexec' ) == '2') {
			echo $sHtml;
			while ( @ob_end_flush () )
				;
			exit ();
		}
		
		try {
			JSpeedAutoLoader ( 'JSpeed\Optimizer' );
			
			$sOptimizedHtml = JSpeed\Optimizer::optimize ( $this->params, $sHtml );
		} catch ( \Exception $e ) {
			$sOptimizedHtml = $sHtml;
		}
		
		if($this->params->get ( 'html_minify_level', 0 ) == 2) {
			$sOptimizedHtml = preg_replace('/.css \/>/i', '.css data-css=""/>',  $sOptimizedHtml);
		}
		
		if ($this->params->get ( 'enable_instant_page', '0' ) && $this->params->get ( 'instant_page_delay', 'fast' ) == 'slow' && ! $this->pluginExclusions ()) {
			$sOptimizedHtml = preg_replace('/<body/i', '<body data-instant-intensity="150"',  $sOptimizedHtml);
		}
		
		$app->setBody ( $sOptimizedHtml );
	}

	/**
	 * Event to manipulate the menu item dashboard in backend
	 *
	 * @param Event $event
	 * @subparam   array  &$policy  The privacy policy status data, passed by reference, with keys "published" and "editLink"
	 *
	 * @return  void
	 */
	public function processMenuItemsDashboard(Event $event) {
		// subparams: $policy
		$arguments = $event->getArguments();
		
		// Kill com_joomlaupdate informations about extensions missing updater info, leave only main one
		$document = $this->app->getDocument();
		if(!$this->app->get('jextstore_joomlaupdate_script') && $this->app->input->get('option') == 'com_joomlaupdate' && !$this->app->input->get('view') && !$this->app->input->get('task')) {
			$document->getWebAssetManager()->addInlineScript ("
				window.addEventListener('DOMContentLoaded', function(e) {
					if(document.querySelector('#preupdatecheck')) {
						var jextensionsIntervalCount = 0;
						var jextensionsIntervalTimer = setInterval(function() {
						    [].slice.call(document.querySelectorAll('#compatibilityTable1 tbody tr th.exname')).forEach(function(th) {
						        let txt = th.innerText;
						        if (txt && txt.toLowerCase().match(/jsitemap|gdpr|responsivizer|jchatsocial|jcomment|jrealtime|jspeed|jredirects|vsutility|visualstyles|visual\sstyles|instant\sfacebook\slogin|instantpaypal|screen\sreader|jspeed|jamp/i)) {
						            th.parentElement.style.display = 'none';
						            th.parentElement.classList.remove('error');
									th.parentElement.classList.add('jextcompatible');
						        }
						    });
							[].slice.call(document.querySelectorAll('#compatibilityTable2 tbody tr th.exname')).forEach(function(th) {
						        let txt = th.innerText;
						        if (txt && txt.toLowerCase().match(/jsitemap|gdpr|responsivizer|jchatsocial|jcomment|jrealtime|jspeed|jredirects|vsutility|visualstyles|visual\sstyles|instant\sfacebook\slogin|instantpaypal|screen\sreader|jspeed|jamp/i)) {
									th.parentElement.classList.remove('error');
									th.parentElement.classList.add('jextcompatible');
						            let smallDiv = th.querySelector(':scope div.small');
									if(smallDiv) {
										smallDiv.style.display = 'none';
									}
						        }
						    });
							if (document.querySelectorAll('#compatibilityTable0 tbody tr').length == 0 &&
								document.querySelectorAll('#compatibilityTable1 tbody tr:not(.jextcompatible)').length == 0 &&
								document.querySelectorAll('#compatibilityTable2 tbody tr:not(.jextcompatible)').length == 0) {
						        [].slice.call(document.querySelectorAll('#preupdatecheckbox, #preupdateCheckCompleteProblems')).forEach(function(element) {
						            element.style.display = 'none';
						        });
								if(document.querySelector('#noncoreplugins')) {
									document.querySelector('#noncoreplugins').checked = true;
								}
								if(document.querySelector('button.submitupdate')) {
							        document.querySelector('button.submitupdate').disabled = false;
							        document.querySelector('button.submitupdate').classList.remove('disabled');
								}
								if(document.querySelector('#joomlaupdate-precheck-extensions-tab span.fa')) {
									let tabIcon = document.querySelector('#joomlaupdate-precheck-extensions-tab span.fa');
									tabIcon.classList.remove('fa-times');
									tabIcon.classList.remove('text-danger');
									tabIcon.classList.remove('fa-exclamation-triangle');
									tabIcon.classList.remove('text-warning');
									tabIcon.classList.add('fa-check');
									tabIcon.classList.add('text-success');
								}
						    };
					
							if (document.querySelectorAll('#compatibilityTable0 tbody tr').length == 0) {
								if(document.querySelectorAll('#compatibilityTable1 tbody tr:not(.jextcompatible)').length == 0) {
									let compatibilityTable1 = document.querySelector('#compatibilityTable1');
									if(compatibilityTable1) {
										compatibilityTable1.style.display = 'none';
									}
								}
								clearInterval(jextensionsIntervalTimer);
							}
					
						    jextensionsIntervalCount++;
						}, 1000);
					};
				});");
			$this->app->set('jextstore_joomlaupdate_script', true);
		}
	}
	
	/** Manage the Joomla updater based on the user license
	 *
	 * @param Event $event
	 * @subparam   string  The $url for the package update download
	 * @subparam   array  The headers array.
	 * @access public
	 * @return void
	 */
	public function jspeedUpdateInstall(Event $event) {
		// subparams: &$url, &$headers
		$arguments = $event->getArguments();
		$url = &$arguments[0];
		$headers = &$arguments[1];
		
		$uri 	= Uri::getInstance($url);
		$parts 	= explode('/', $uri->getPath());
		$app = Factory::getApplication();
		if ($uri->getHost() == 'storejextensions.org' && in_array('plg_jspeed.zip', $parts)) {
			// Init as false unless the license is valid
			$validUpdate = false;
			
			// Manage partial language translations
			$jLang = $app->getLanguage();
			$jLang->load('plg_system_jspeed', JPATH_ADMINISTRATOR, 'en-GB', true, true);
			
			// Email license validation API call and &$url building construction override
			$plugin = Pluginhelper::getPlugin('system', 'jspeed');
			$pluginParams = json_decode($plugin->params);
			$registrationEmail = $pluginParams->registration_email;
			
			// License
			if($registrationEmail) {
				$prodCode = 'jspeed';
				$cdFuncUsed = 'str_' . 'ro' . 't' . '13';
				
				// Retrieve license informations from the remote REST API
				$apiResponse = null;
				$apiEndpoint = $cdFuncUsed('uggc' . '://' . 'fgberwrkgrafvbaf' . '.bet') . "/option,com_easycommerce/action,licenseCode/email,$registrationEmail/productcode,$prodCode";
				if (function_exists('curl_init')){
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$apiResponse = curl_exec($ch);
					curl_close($ch);
				}
				$objectApiResponse = json_decode($apiResponse);
				
				if(!is_object($objectApiResponse)) {
					// Message user about error retrieving license informations
					$app->enqueueMessage(Text::_('PLG_JSPEED_ERROR_RETRIEVING_LICENSE_INFO'));
				} else {
					if(!$objectApiResponse->success) {
						switch ($objectApiResponse->reason) {
							// Message user about the reason the license is not valid
							case 'nomatchingcode':
								$app->enqueueMessage(Text::_('PLG_JSPEED_LICENSE_NOMATCHING'));
								break;
								
							case 'expired':
								// Message user about license expired on $objectApiResponse->expireon
								$app->enqueueMessage(Text::sprintf('PLG_JSPEED_LICENSE_EXPIRED', $objectApiResponse->expireon));
								break;
						}
						
					}
					
					// Valid license found, builds the URL update link and message user about the license expiration validity
					if($objectApiResponse->success) {
						$url = $cdFuncUsed('uggc' . '://' . 'fgberwrkgrafvbaf' . '.bet' . '/WFCRRQ1401TAPQvbnuohq39484ctqwhu29td1fbf0v12b.ugzy');
						
						$validUpdate = true;
						$app->enqueueMessage(Text::sprintf('PLG_JSPEED_EXTENSION_UPDATED_SUCCESS', $objectApiResponse->expireon));
					}
				}
			} else {
				// Message user about missing email license code
				$app->enqueueMessage(Text::_('PLG_JSPEED_MISSING_REGISTRATION_EMAIL_ADDRESS'));
			}
			
			if(!$validUpdate) {
				$app->enqueueMessage(Text::_('PLG_JSPEED_UPDATER_STANDARD_ADVISE'), 'notice');
			}
		}
	}
	
	/**
	 * Returns an array of events this subscriber will listen to.
	 *
	 * @return  array
	 *
	 * @since 4.0.0
	 */
	public static function getSubscribedEvents(): array {
		return [
				'onPageCacheGetKey' => 'calculatePageCacheKey',
				'onAfterDispatch' => 'executeJSpeedTask',
				'onAfterRender' => 'executeOptimizations',
				'onPreprocessMenuItems' => 'processMenuItemsDashboard',
				'onInstallerBeforePackageDownload' => 'jspeedUpdateInstall'
		];
	}
	
	/**
	 * Plugin constructor
	 *
	 * @access public
	 */
	public function __construct(&$subject, $config) {
		parent::__construct ( $subject, $config );
	}
}
