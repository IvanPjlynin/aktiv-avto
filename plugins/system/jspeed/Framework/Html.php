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
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\LanguageHelper;

class Html {
	protected $params;

	/**
	 * @return string
	 */
	protected function getSiteUrl() {
		$app = Factory::getApplication ();
		$sefUrlsActive = $app->get ( 'sef', 1 );
		$sefLanguage = null;

		if ($app->isClient ( 'administrator' ) && $sefUrlsActive && $this->isMultilangEnabled ( $app )) {
			$sefs = LanguageHelper::getLanguages ( 'sef' );
			$currentLanguage = $app->getLanguage ()->getTag ();
			foreach ( $sefs as $sefLanguageObject ) {
				if ($sefLanguageObject->lang_code == $currentLanguage) {
					$sefLanguage = $sefLanguageObject->sef . '/';
				}
			}
		}

		$sSiteUrl = Uri::root () . $sefLanguage . '?jspeedtaskexec=2';

		return $sSiteUrl;
	}

	/**
	 * Method to determine if the language filter plugin is enabled.
	 * This works for both site and administrator.
	 *
	 * @return boolean True if site is supporting multiple languages; false otherwise.
	 *        
	 * @since 2.5.4
	 */
	public static function isMultilangEnabled($app) {
		// Flag to avoid doing multiple database queries.
		static $tested = false;

		// Status of language filter plugin.
		static $enabled = false;

		// If being called from the front-end, we can avoid the database query.
		if ($app->isClient ('site')) {
			$enabled = $app->getLanguageFilter ();
			return $enabled;
		}

		// If already tested, don't test again.
		if (! $tested) {
			// Determine status of language filter plug-in.
			$db = Factory::getContainer()->get('DatabaseDriver');
			$query = $db->getQuery ( true );

			$query->select ( 'enabled' );
			$query->from ( $db->quoteName ( '#__extensions' ) );
			$query->where ( $db->quoteName ( 'type' ) . ' = ' . $db->quote ( 'plugin' ) );
			$query->where ( $db->quoteName ( 'folder' ) . ' = ' . $db->quote ( 'system' ) );
			$query->where ( $db->quoteName ( 'element' ) . ' = ' . $db->quote ( 'languagefilter' ) );
			$db->setQuery ( $query );

			$enabled = $db->loadResult ();
			$tested = true;
		}

		return $enabled;
	}

	/**
	 *
	 * @return type
	 * @throws RuntimeException
	 * @throws Exception
	 */
	public function getOriginalHtml() {
		try {
			$oFileRetriever = FileScanner::getInstance ();

			$response = $oFileRetriever->getFileContents ( $this->getSiteUrl () );

			if ($oFileRetriever->response_code != 200) {
				throw new \Exception ( 'Failed to fetch the frontend HTML, HTTP status code: ' . $oFileRetriever->response_code );
			}

			return $response;
		} catch ( \Exception $e ) {
			throw new \RuntimeException ( 'No data retrieved' );
		}
	}

	/**
	 *
	 * @return type
	 */
	public static function getHomePageLink() {
		$oMenu = Factory::getApplication ()->getMenu ( 'site' );
		$oDefaultMenuItem = $oMenu->getDefault ();

		return $oDefaultMenuItem->id;
	}

	/**
	 *
	 * @param type $params
	 */
	public function __construct($params) {
		$this->params = $params;
	}
}
