<?php
namespace JSpeed;

/** 
 * Images optimizer and lightner for Responsivizer mobile template
 * @package JSPEED::plugins::system
 * @author Joomla! Extensions Store
 * @copyright (C)2015 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html  
 */
// no direct access
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;
use Joomla\String\StringHelper;
use Joomla\CMS\Plugin\PluginHelper;

/**
 * Optimize images on the fly using the cache
 *
 * @access public
 * @param string $sOptimizedHtml
 * @return string on success, false on failure
 */
class LightImages {
	private $lazyLoadedImage = false;
	
	private $disableSrcSet = null;
	
	private function processImageNodes(&$node, $srcSet = false, $srcSetIteration = null, $qualitySrcSet = null, $resizeFactorSrcSet = null, $originalSource = null) {
		// Always init to false for each image processing
		$this->lazyLoadedImage = false;
		
		// Srcset settings
		$originalSrc = null;
		$preSrcSetCreation = false;
		$createSrcSet = $this->disableSrcSet ? false : $this->params->get('img_processing_srcset', 0);
		$srcSetQualityStartingQuality = $this->params->get('img_processing_srcset_starting_quality', 90);
		$srcSetQualityDecreaseStep = $this->params->get('img_processing_srcset_quality_decrease_step', 15);
		$srcSetResizeStartingResize = $this->params->get('img_processing_srcset_starting_resize', 100);
		$srcSetResizeDecreaseStep = $this->params->get('img_processing_srcset_resize_decrease_step', 20);
		$srcSetOriginalImage = $this->params->get('img_processing_srcset_original_image', 0);
		
		$quality = $qualitySrcSet ? $qualitySrcSet : $this->params->get('img_quality', 70);
		
		$pngQuality = 10 - (int) ($quality / 10); // Inverted as level of compression
		$pngQuality = $pngQuality >= 10 ? 9 : $pngQuality; // Max level of compression is 9, range is 1 to 9
		$resizeFactorSwitcher = $this->params->get('img_resizing_switcher', false);
		$resizeFactor = $resizeFactorSrcSet ? $resizeFactorSrcSet : $this->params->get('img_resizing', 60);
		$resizeMinWidth = $this->params->get('img_resizing_minwidth', 640);
		$processingMinWidth = $this->params->get('img_processing_minwidth', 300);
		$processingDataSrc = $this->params->get('img_processing_datasrc', 300);
		
		// Override to leave unaltered the original image when a srcset creation is planned for this image
		if($createSrcSet && !$srcSet) {
			$quality = $srcSetQualityStartingQuality;
			$pngQuality = 10 - (int) ($srcSetQualityStartingQuality / 10);
			$resizeFactor = $srcSetResizeStartingResize;
			$preSrcSetCreation = true;
		}
		
		$cache_path = JPATH_SITE . '/media/plg_jspeed/cache/images';
		$cache_path_http = rtrim(Uri::root(true), '/') . "/media/plg_jspeed/cache/images";
		
		// Get what we want
		if ($node->nodeType == XML_ELEMENT_NODE && $node->hasAttributes()) {
			if ($node->getAttribute('height') && strpos($node->getAttribute('height'), 'px')) {
				$heightExplicitFromNode = (int) $node->getAttribute("height");
			}
			
			if ($node->getAttribute('width') && strpos($node->getAttribute('width'), 'px')) {
				$widthExplicitFromNode = (int) $node->getAttribute("width");
			}
			
			if ($node->getAttribute("src") != "")
				$src = $originalSrc = $node->getAttribute("src");
		}
		
		if (!isset($src)) {
			return false;
		}
		
		// Need to remove query string if any
		$src = preg_replace('/\?.*/', '', $src);
		
		// Check if there is a processing for a lazy loaded image having a src=data:image and a valid data-src instead
		if(StringHelper::strpos($src, 'data:image/svg+xml;bas' . 'e64') !== false && $node->hasAttribute('data-jspeed-lazyload')) {
			$src = $originalSrc = preg_replace('/\?.*/', '', $node->getAttribute('data-src'));
			$this->lazyLoadedImage = true;
			$processingDataSrc = true;
			$createSrcSet = false;
		}
		
		// Check if there is a processing for a lazy loaded image having an invalid src and a valid data-src instead
		if($processingDataSrc && $src == '#' && $node->hasAttribute('data-src')) {
			$src = $originalSrc = $node->getAttribute('data-src');
			$this->lazyLoadedImage = true;
			$processingDataSrc = true;
			$createSrcSet = false;
		}
		
		// Need to remove encoding
		$imagePath = urldecode($src);
		
		// Check for exclusions
		$imgFilesExcluded = $this->params->get('img_files_excluded', array());
		foreach ($imgFilesExcluded as $excludedImg) {
			if(StringHelper::strpos($imagePath, $excludedImg) !== false) {
				return false;
			}
		}
		
		$imgClassExcluded = $this->params->get('img_class_excluded', array());
		if ($node->hasAttribute('class') && !empty($imgClassExcluded)) {
			foreach ($imgClassExcluded as $excludedImgClass) {
				$imgAttributeClass = $node->getAttribute('class');
				if(StringHelper::strpos($imgAttributeClass, $excludedImgClass) !== false) {
					return false;
				}
			}
		}
		
		$urlparts = parse_url($imagePath);
		// Dose this URL contain a host name?
		if (!empty($urlparts["host"])) {
			// is it local?
			if (substr($imagePath, 0, strlen(Uri::root())) == Uri::root()) {
				// This is a local url
				// Remove the URL
				$imagePath = substr($imagePath, strlen(Uri::root()));
			}
		}
		
		if (isset($imagePath[0]) && $imagePath[0] == "/") {
			$root = Uri::base(true);
			if (substr($imagePath, 0, strlen($root)) == $root) {
				$imagePath = dirname($_SERVER["SCRIPT_FILENAME"]) . substr($imagePath, strlen($root));
			}
		}
		
		if (realpath($imagePath) === false) {
			return false;
		}
		
		$imagePath = realpath($imagePath);
		$path_parts = pathinfo($src);
		
		// Return false immediately if the image type is not supported
		if(isset($path_parts['extension'])) {
			$fileExtension = strtolower($path_parts['extension']);
			if (!$srcSet && ! in_array ( $fileExtension, array (
					'jpeg',
					'jpg',
					'swf',
					'psd',
					'bmp',
					'tiff',
					'jpc',
					'jp2',
					'jpf',
					'jb2',
					'swc',
					'aiff',
					'wbmp',
					'xbm',
					'gif',
					'png'
			) )) {
				return false;
			}
		} else {
			$fileExtension = null;
		}
		
		switch ($fileExtension) {
			case 'jpeg':
			case 'jpg':
			case 'swf':
			case 'psd':
			case 'bmp':
			case 'tiff':
			case 'jpc':
			case 'jp2':
			case 'jpf':
			case 'jb2':
			case 'swc':
			case 'aiff':
			case 'wbmp':
			case 'xbm':
				$new_ext = 'jpg';
				break;
			case 'gif':
				//!! GD dosent support resizing animated gifs
				$support_gif = (bool) $this->params->get('img_support_gif', 0);
				if ($support_gif) {
					$new_ext = 'png';
				} else {
					return false;
				}
				
				break;
			case 'png':
				$new_ext = 'png';
				break;
			default:
				$new_ext = 'png';
				$pref = $imagePath;
				break;
		}
		
		// Override force mode if all images must be converted to WEBP
		$jSpeedBrowser = Browser::getInstance()->getBrowser ();
		if($this->params->get('convert_all_images_to_webp', 0) && function_exists('imagewebp') && ($jSpeedBrowser != 'Safari' && $jSpeedBrowser != 'IE')) {
			$new_ext = 'webp';
		}

		// Skip images for excluded extensions
		if (isset($path_parts['extension']) && in_array(strtolower($path_parts['extension']), $this->excludedExts)) {
			return false;
		}
		
		$imagesAlgo = $this->params->get ( 'hash_images_algo', 'full' );
		if ($imagesAlgo == 'full') {
			if ($srcSet) {
				$filename = sha1 ( $originalSource ) . "_" . (4 - $srcSetIteration) . "x." . $new_ext;
			} else {
				$filename = sha1 ( $src ) . "." . $new_ext;
			}
		} elseif ($imagesAlgo == 'partial') {
			if ($srcSet) {
				$srcset_path_parts = pathinfo ( $originalSource );
				$filename = ($srcset_path_parts ['filename']) . '_' . sha1 ( $originalSource ) . "_" . (4 - $srcSetIteration) . "x." . $new_ext;
			} else {
				$filename = ($path_parts ['filename']) . '_' . sha1 ( $src ) . "." . $new_ext;
			}
		} elseif ($imagesAlgo == 'none') {
			if ($srcSet) {
				$srcset_path_parts = pathinfo ( $originalSource );
				$filename = ($srcset_path_parts ['filename']) . "_" . (4 - $srcSetIteration) . "x." . $new_ext;
			} else {
				$filename = ($path_parts ['filename']) . "." . $new_ext;
			}
		}
		
		$full_path_filename = $cache_path . "/" . $filename;
		
		// If cache file exists don't process anymore
		if ((@is_file($full_path_filename) && @is_file($imagePath) && @filemtime($full_path_filename) > @filemtime($imagePath)) || ($srcSet && @is_file($full_path_filename))) {
			// Files that are 0bytes, mean that they sould be ignored.
			if (filesize($full_path_filename) == 0) {
				return true;
			}
			
			$url = $cache_path_http . "/" . $filename;
		} elseif($this->params->get('webservice_processing', 1)) {
			$uriInstance = Uri::getInstance();
			$getDomain = rtrim($uriInstance->getScheme() . '://' . $uriInstance->getHost(), '/');
			$remoteImgUrl = $getDomain . '/' . ltrim($src, '/');
			
			$optimized_png_arr = json_decode($this->oFileRetriever->getFileContents('http://api.resmush.it/ws.php?img=' . $remoteImgUrl . '&qlty=' . $quality));
			if(isset($optimized_png_arr->dest)) {
				file_put_contents($full_path_filename, $this->oFileRetriever->getFileContents($optimized_png_arr->dest));
				$url = $cache_path_http . "/" . $filename;
			} else {
				return false;
			}
		} else {
			list($image, $image_file_size) = $this->fetchImageData($imagePath);
			if ($image === false) {
				return false;
			}
			
			$widthOriginal = imagesx($image);
			$heightOriginal = imagesy($image);
			
			if (!isset($heightExplicitFromNode) || !isset($widthExplicitFromNode)) {
				$imageWidth = $widthOriginal;
				$imageHeight = $heightOriginal;
			} else {
				$imageWidth = $widthExplicitFromNode;
				$imageHeight = $heightExplicitFromNode;
			}
			
			// Ensure that the image is worth of being processed and optimized, otherwise skip
			if($imageWidth < $processingMinWidth && !$srcSet) {
				return false;
			}
			
			// Override $imageWidth and $imageHeight if factor percentage is enabled and resizement is valid
			if ($resizeFactorSwitcher && ($imageWidth >= $resizeMinWidth || $srcSet || $preSrcSetCreation)) {
				$imageWidth = intval($imageWidth * $resizeFactor / 100);
				$imageHeight = intval($imageHeight * $resizeFactor / 100);
			}
			
			$result = @imagecreatetruecolor($imageWidth, $imageHeight);
			if ($result == false)
				return false;
				
			if ($new_ext == 'png' || $new_ext == 'webp') {
				imagealphablending($result, false);
				$transparent = imagecolorallocatealpha($result, 0, 0, 0, 127);
				imagefill($result, 0, 0, $transparent);
				imagesavealpha($result, true);
				imagealphablending($result, true);
			}
			
			$sample = @imagecopyresampled($result, $image, 0, 0, 0, 0, $imageWidth, $imageHeight, $widthOriginal, $heightOriginal);
			
			if ($sample == false)
				return false;
				
			switch ($new_ext) {
				case 'jpg':
					$save = @imagejpeg($result, $full_path_filename, $quality);
					break;
				case 'png':
					$save = @imagepng($result, $full_path_filename, $pngQuality);
					break;
				case 'webp':
					$save = @imagewebp($result, $full_path_filename, $quality);
					break;
			}
			
			if ($save == false) {
				return false;
			}
			
			@imagedestroy($image);
			@imagedestroy($result);
			
			// Make sure we are really creating a smaller image!
			if (filesize($full_path_filename) >= $image_file_size && !$srcSet && !$preSrcSetCreation) {
				// Files that are 0bytes, mean that they sould be ignored.
				unlink($full_path_filename);
				return true;
			}
			
			$url = $cache_path_http . "/" . $filename;
			
			// Make sure we are really creating a smaller image!
			if (filesize($full_path_filename) >= $image_file_size && ($srcSet || $preSrcSetCreation)) {
				// Files that are 0bytes, mean that they sould be ignored.
				unlink($full_path_filename);
				if($originalSource || $preSrcSetCreation) {
					$filename = $originalSource ? $originalSource : $src;
					$full_path_filename = $imagePath;
					$url = $filename;
				}
			}
		}
		
		// Add to HTTP2 preload and remove the original image unless there is a srcset that must keep it
		$originalImageSrcHashToRemove = $originalSource ? md5(ltrim($originalSource, '/')) : md5(ltrim($originalSrc, '/'));
		if($createSrcSet && $srcSetOriginalImage == -1) {
			// Add the original image to the preload list
			Helper::addHttp2Push ( $originalSrc, 'image', false );
			// Kill the original image removal
			$originalImageSrcHashToRemove = null;
		}
		Helper::addHttp2Push ( $url, 'image', false, $originalImageSrcHashToRemove);
		
		// Set the new image location
		if(!$srcSet) {
			if(!$this->lazyLoadedImage) {
				$node->setAttribute("src", $url);
			}
			if($processingDataSrc && $node->hasAttribute('data-src')) {
				$node->setAttribute("data-src", $url);
			}
		} else {
			// Get the current srcset populated till this recursion
			$srcSetAttribute = $node->getAttribute("srcset");
			
			list($image, $image_file_size) = $this->fetchImageData($full_path_filename);
			if ($image === false) {
				return false;
			}
			$widthSrcSetImage = imagesx($image);
			$newSrcSetImage =  $url . ' ' . $widthSrcSetImage . 'w,';
			
			// Concatenate the srcset attribute
			$newSrcSetAttribute = $srcSetAttribute . $newSrcSetImage;
			
			// Set the updated srcset attribute
			$node->setAttribute("srcset", $newSrcSetAttribute);
			
			if($srcSetOriginalImage != -1 && $srcSetIteration == $srcSetOriginalImage) {
				$node->setAttribute("src", $url);
				if($processingDataSrc && $node->hasAttribute('data-src')) {
					$node->setAttribute("data-src", $url);
				}
			}
		}

		/**
		 * Optional srcset creation using a recursive function
		 * It creates 4 srcset images:
		 * 4x that is the same as the regular img src
		 * 3x based on reduction factors for quality and resize
		 * 2x based on reduction factors for quality and resize
		 * 1x based on reduction factors for quality and resize
		 */
		if ($createSrcSet && !$srcSet) {
			for($i = 0; $i <= 3; $i ++) {
				$srcSetImgQuality = $srcSetQualityStartingQuality - ($srcSetQualityDecreaseStep * $i);
				$srcSetImgQuality = $srcSetImgQuality <= 0 ? 10 : $srcSetImgQuality;
				$srcSetImgResizeFactor = $srcSetResizeStartingResize - ($srcSetResizeDecreaseStep * $i);
				$srcSetImgResizeFactor = $srcSetImgResizeFactor <= 0 ? 10 : $srcSetImgResizeFactor;
				if($srcSetOriginalImage == -1) {
					$node->setAttribute("src", $originalSrc);
				}
				if($srcSetOriginalImage == -1 && $processingDataSrc && $node->hasAttribute('data-src')) {
					$node->setAttribute("data-src", $originalSrc);
				}
				$this->processImageNodes ( $node, true, $i, $srcSetImgQuality, $srcSetImgResizeFactor, $src );
			}
			// Trim the created srcset attribute
			$srcSetAttribute = $node->getAttribute("srcset");
			$newSrcSetAttribute = trim($srcSetAttribute, ',');
			$node->setAttribute("srcset", $newSrcSetAttribute);
		}
		
		return true;
	}
	
	private function fetchImageData($file) {
		if(!file_exists($file)) {
			return array(false, 0);
		}
		
		$data = @file_get_contents($file);
		
		// could not open image?
		if ($data === false) {
			return array(false, strlen($data));
		}
		
		$img = @imagecreatefromstring($data);
		
		return array($img, strlen($data));
	}
	
	public function optimize($sOptimizedHtml) {
		// Avoid unuseful operations if not enabled
		if (!$this->isEnabled) {
			return false;
		}

		// App instance
		$app = Factory::getApplication();

		// Exclude by menu item
		$menuexcluded = $this->params->get ( 'img_menu_excluded', array () );
		if(in_array ( $app->input->get ( 'Itemid', '', 'int' ), $menuexcluded )) {
			return false;
		}
		
		// Ensure valid execution of plugin optimization
		$document = $app->getDocument();
		if ($document->getType() !== 'html' || $app->input->get('tmpl') === 'component') {
			return false;
		}

		if ($app->input->get("task") == "edit" || $app->isClient('administrator')) {
			return false;
		}

		// Ensure valid cache folder exists
		if (!Folder::exists(JPATH_SITE . '/media/plg_jspeed/cache/images')) {
			Folder::create(JPATH_SITE . '/media/plg_jspeed/cache/images');
		}

		$purifyString = trim($this->params->get('purify_string',''));
		
		// Check if the J4 Accessibility Checker plugin is enabled, if so disable the img_processing_entity_decode
		if(PluginHelper::isEnabled('system', 'jooa11y')) {
			$this->params->set('img_processing_entity_decode', 0);
		}
		
		if($this->params->get('img_processing_entity_decode', 1)) {
			$doc = new \DOMDocument();
		} else {
			$doc = new \DOMDocument('1.0', 'UTF-8');
		}
		libxml_use_internal_errors(true);
		
		if($this->params->get('img_processing_utf8_entity_decode', 0)) {
			$sOptimizedHtml = mb_convert_encoding($sOptimizedHtml, 'HTML-ENTITIES', 'UTF-8');
		}
		
		if($purifyString) {
			$purifyStringReplacement = trim($this->params->get('purify_string_replacement',''));
			$doc->loadHTML(preg_replace('/' . addcslashes($purifyString, '/') . '/i', $purifyStringReplacement, $sOptimizedHtml));
		} else {
			$doc->loadHTML($sOptimizedHtml);
		}
		
		if($this->params->get('img_processing_entity_decode', 1)) {
			$doc->encoding = 'utf-8';
		}
		
		libxml_clear_errors();

		$nodes = $doc->getElementsByTagName('img');

		foreach ($nodes as $node) {
			$this->processImageNodes($node);
		}
		
		if($this->params->get('img_processing_entity_decode', 1)) {
			return html_entity_decode($doc->saveHTML(), ENT_QUOTES, 'UTF-8');
		} else {
			return $doc->saveHTML();
		}
	}

	public function optimizeSingleImage(&$DOMelement) {
		$this->disableSrcSet = true;
		
		// Ensure valid cache folder exists
		if (!Folder::exists(JPATH_SITE . '/media/plg_jspeed/cache/images')) {
			Folder::create(JPATH_SITE . '/media/plg_jspeed/cache/images');
		}
		
		$this->processImageNodes($DOMelement);
	}

	public function __construct($params) {
		$this->params = $params;
		
		$this->isEnabled = $this->params->get('lightimgs_status', false);
		$this->excludedExts = $this->params->get('img_exts_excluded', array());
		
		$this->oFileRetriever = FileScanner::getInstance ();
	}
}