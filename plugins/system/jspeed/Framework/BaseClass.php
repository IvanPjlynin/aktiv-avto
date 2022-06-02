<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Some basic utility functions required by the plugin and shared by class
 */
class BaseClass extends RegexConstants {
	protected function cleanRegexMarker($sHtml) {
		return preg_replace ( '#' . preg_quote ( $this->sRegexMarker, '#' ) . '.*+$#', '', $sHtml );
	}

	/**
	 * Search area used to find js and css files to remove
	 *
	 * @return string
	 */
	public function getHeadHtml() {
		$sHeadRegex = $this->getHeadRegex ();

		if (preg_match ( $sHeadRegex, $this->sHtml, $aHeadMatches ) === false || empty ( $aHeadMatches )) {
			throw new \Exception ( 'An error occured while trying to find the <head> tags in the HTML document. Make sure your HTML code is well formed and has opening <head> and closing </head> tags' );
		}
		
		$params = Plugin::getPluginParams ();
		if($params->get('css', 1)) {
			// Fix for J4 in order to include in the optimized file also lazyloaded CSS by core
			$aHeadMatches [0] = preg_replace("/rel\s*+=\s*+[\"']lazy-stylesheet[\"']/i", "rel=\"stylesheet\"", $aHeadMatches [0]);
			// Remove any redundant <noscript> css
			$aHeadMatches [0] = preg_replace("/<noscript>.*rel\s*+=\s*+[\"']stylesheet[\"'].*<\/noscript>/i", "", $aHeadMatches [0]);
		}

		return $aHeadMatches [0] . $this->sRegexMarker;
	}
	public function setHeadHtml($sHtml) {
		$sHtml = $this->cleanRegexMarker ( $sHtml );
		$this->sHtml = preg_replace ( $this->getHeadRegex (), Helper::cleanReplacement ( $sHtml ), $this->sHtml, 1 );
	}

	/**
	 * Fetches HTML to be sent to browser
	 *
	 * @return string
	 */
	public function getHtml() {
		return $this->sHtml;
	}

	/**
	 * Determines if file requires http protocol to get contents (Not allowed)
	 *
	 * @param string $sUrl
	 * @return boolean
	 */
	public function isHttpAdapterAvailable($sUrl) {
		return ! (preg_match ( '#^(?:http|//)#i', $sUrl ) && ! Url::isInternal ( $sUrl ) || $this->isPHPFile ( $sUrl ));
	}

	/**
	 * Regex for head search area
	 *
	 * @return string
	 */
	public function getHeadRegex($headonly = false) {
		$s = $headonly ? '<head' : '^';

		return "#$s(?><?[^<]*+(?:<script\b(?><?[^<]*+)*?</\s*script\b|" . $this->ifRegex () . ")?)*?(?:</\s*head\s*+>|(?=<body\b))#si";
	}

	/**
	 *
	 * @param type $sUrl
	 * @return type
	 */
	public function isPHPFile($sUrl) {
		return preg_match ( '#\.php|^(?![^?\#]*\.(?:css|js|png|jpe?g|gif|bmp)(?:[?\#]|$)).++#i', $sUrl );
	}

	/**
	 *
	 * @return boolean
	 */
	public function excludeDeclaration($sType) {
		return true;
	}

	/**
	 *
	 * @return boolean
	 */
	public function executeCDNParseReplacement() {
		return false;
	}

	/**
	 *
	 * @return boolean
	 */
	public function lazyLoadImages() {
		return false;
	}

	/**
	 * Regex for body section in Html
	 *
	 * @return string
	 */
	public function getBodyRegex() {
		return '#^(?><?[^<]*+(?:<script\b[^>]*+>(?><?[^<]*+)*?</\s*script\s*+>|' . $this->ifRegex () . ')?)*?(?:</\s*head\s*+>|(?=<body\b))\K.*$#si';
	}
}
