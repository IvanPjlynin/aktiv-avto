<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class SpriteGenerator {
	public $params = null;

	/**
	 *
	 * @return string|boolean
	 */
	public function getImageLibrary() {
		if (! extension_loaded ( 'exif' )) {
			return false;
		}

		if (extension_loaded ( 'imagick' )) {
			$sImageLibrary = 'imagick';
		} else {
			if (! extension_loaded ( 'gd' )) {
				return false;
			}

			$sImageLibrary = 'gd';
		}

		return $sImageLibrary;
	}

	/**
	 * Grabs background images with no-repeat attribute from css and merge them in one file called a sprite.
	 * Css is updated with sprite url and correct background positions for affected images.
	 * Sprite saved in {Joomla! base}/images/jspeed/
	 *
	 * @param string $sCss
	 *        	Aggregated css file before sprite generation
	 * @return string Css updated with sprite information on success. Original css on failure
	 */
	public function getSprite($sCss) {
		$sImageLibrary = $this->getImageLibrary ();

		$aMatches = $this->processCssUrls ( $sCss );

		if (empty ( $aMatches ) || $sImageLibrary === false) {
			return $sCss;
		}

		$this->params->set ( 'sprite-path', Paths::spriteDir () );

		$aSearch = $this->generateSprite ( $aMatches, new CssSpriteGenerator ( $sImageLibrary, $this->params ) );

		return $aSearch;
	}

	/**
	 * Generates sprite image and return background positions for image replaced with sprite
	 *
	 * @param array $aMatches
	 *        	Array of css declarations and image url to be included in sprite
	 * @param object $oSpriteGen
	 *        	Object of sprite generator
	 * @return array
	 */
	public function generateSprite($aMatches, $oSpriteGen) {
		$aDeclaration = $aMatches [0];
		$aImages = $aMatches [1];

		$oSpriteGen->CreateSprite ( $aImages );
		$aSpriteCss = $oSpriteGen->GetCssBackground ();

		$aPatterns = array ();
		$aPatterns [0] = '#background-position:[^;}]+;?#i'; // Background position declaration regex
		$aPatterns [1] = '#(background:[^;}]*)\b' . // Background position regex
		'((?:top|bottom|left|right|center|-?[0-9]+(?:%|[c-x]{2})?)' . '\s(?:top|bottom|left|right|center|-?[0-9]+(?:%|[c-x]{2})?))([^;}]*[;}])#i';
		$aPatterns [2] = '#(background-image:)[^;}]+;?#i'; // Background image declaration regex
		$aPatterns [3] = '#(background:[^;}]*)\b' . 'url\((?=[^\)]+\.(?:png|gif|jpe?g))[^\)]+\)' . '([^;}]*[;}])#i'; // Background image regex

		$sSpriteName = $oSpriteGen->GetSpriteFilename ();

		$aSearch = array ();
		$spritepath = Paths::spriteDir ( true ) . $sSpriteName;
		$spritepath = Helper::getCDNDomains ( $this->params, $spritepath, $spritepath );

		for($i = 0; $i < count ( $aSpriteCss ); $i ++) {
			if (isset ( $aSpriteCss [$i] )) {
				$aSearch ['needles'] [] = $aDeclaration [$i];

				$aReplacements = array ();
				$aReplacements [0] = '';
				$aReplacements [1] = '$1$3';
				$aReplacements [2] = '$1 url(' . $spritepath . '); background-position: ' . $aSpriteCss [$i] . ';';
				$aReplacements [3] = '$1url(' . $spritepath . ') ' . $aSpriteCss [$i] . '$2';

				$sReplacement = preg_replace ( $aPatterns, $aReplacements, $aDeclaration [$i] );

				if (is_null ( $sReplacement )) {
					throw new \Exception ( 'Error finding replacements for sprite background positions' );
				}

				$aSearch ['replacements'] [] = $sReplacement;
			}
		}

		return $aSearch;
	}

	/**
	 * Uses regex to find css declarations containing background images to include in sprite
	 *
	 * @param string $sCss
	 *        	Aggregated css file
	 * @return array Array of css declarations and image urls to replace with sprite
	 */
	public function processCssUrls($sCss, $bBackend = false) {
		$params = $this->params;
		$aRegexStart = array ();
		$aRegexStart [0] = '
                        #(?:{
                                (?=\s*+(?>[^}\s:]++[\s:]++)*?url\(
                                        (?=[^)]+\.(?:png|gif|jpe?g))
                                ([^)]+)\))';
		$aRegexStart [1] = '
                        (?=\s*+(?>[^}\s:]++[\s:]++)*?no-repeat)';
		$aRegexStart [2] = '
                        (?(?=\s*(?>[^};]++[;\s]++)*?background(?:-position)?\s*+:\s*+(?:[^;}\s]++[^}\S]++)*?
                                (?<p>(?:[tblrc](?:op|ottom|eft|ight|enter)|-?[0-9]+(?:%|[c-x]{2})?))(?:\s+(?&p))?)
                                        (?=\s*(?>[^};]++[;\s]++)*?background(?:-position)?\s*+:\s*+(?>[^;}\s]++[\s]++)*?
                                                (?:left|top|0(?:%|[c-x]{2})?)\s+(?:left|top|0(?:%|[c-x]{2})?)
                                        )
                        )';
		$sRegexMiddle = '   
                        [^{}]++} )';
		$sRegexEnd = '#isx';

		$aIncludeImages = Helper::getArray ( $params->get ( 'combinedimage_include_images', '' ) );
		$aExcludeImages = Helper::getArray ( $params->get ( 'combinedimage_exclude_images', '' ) );
		$sIncImagesRegex = '';

		if (! empty ( $aIncludeImages [0] )) {
			foreach ( $aIncludeImages as &$sImage ) {
				$sImage = preg_quote ( $sImage, '#' );
			}

			$sIncImagesRegex .= '
                                |(?:{
                                        (?=\s*+(?>[^}\s:]++[\s:]++)*?url';
			$sIncImagesRegex .= ' (?=[^)]* [/(](?:' . implode ( '|', $aIncludeImages ) . ')\))';
			$sIncImagesRegex .= '\(([^)]+)\)
                                        )
                                        [^{}]++ })';
		}
		$sExImagesRegex = '';
		if (! empty ( $aExcludeImages [0] )) {
			$sExImagesRegex .= '(?=\s*+(?>[^}\s:]++[\s:]++)*?url\(
                                                        [^)]++  (?<!';

			foreach ( $aExcludeImages as &$sImage ) {
				$sImage = preg_quote ( $sImage, '#' );
			}

			$sExImagesRegex .= implode ( '|', $aExcludeImages ) . ')\)
                                                        )';
		}

		$sRegexStart = implode ( '', $aRegexStart );
		$sRegex = $sRegexStart . $sExImagesRegex . $sRegexMiddle . $sIncImagesRegex . $sRegexEnd;

		if (preg_match_all ( $sRegex, $sCss, $aMatches ) === false) {
			throw new \Exception ( 'Error occurred matching for images to sprite' );
		}

		if (isset ( $aMatches [3] )) {
			$total = count ( $aMatches [1] );

			for($i = 0; $i < $total; $i ++) {
				$aMatches [1] [$i] = trim ( $aMatches [1] [$i] ) ? $aMatches [1] [$i] : $aMatches [3] [$i];
			}
		}

		if ($bBackend) {
			$aImages = array ();
			$aImagesMatches = array ();

			$aImgRegex = array ();
			$aImgRegex [0] = $aRegexStart [0];
			$aImgRegex [2] = $aRegexStart [1];
			$aImgRegex [4] = $sRegexMiddle;
			$aImgRegex [5] = $sRegexEnd;

			$sImgRegex = implode ( '', $aImgRegex );

			if (preg_match_all ( $sImgRegex, $sCss, $aImagesMatches ) === false) {
				throw new \Exception ( 'Error occurred matching for images to include' );
			}

			$aImagesMatches [0] = array_diff ( $aImagesMatches [0], $aMatches [0] );
			$aImagesMatches [1] = array_diff ( $aImagesMatches [1], $aMatches [1] );

			$oImageLibrary = $this->getImageLibrary ();

			if ($oImageLibrary === false) {
				return array ();
			}

			$oCssSpriteGen = new CssSpriteGenerator ( $oImageLibrary, $this->params, $bBackend );

			$aImages ['include'] = $oCssSpriteGen->CreateSprite ( $aImagesMatches [1] );
			$aImages ['exclude'] = $oCssSpriteGen->CreateSprite ( $aMatches [1] );

			return $aImages;
		}

		return $aMatches;
	}

	/**
	 * Constructor
	 *
	 * @param type $params
	 */
	public function __construct($params) {
		$this->params = $params;
	}
}
