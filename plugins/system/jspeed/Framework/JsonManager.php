<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
class JsonManager {
	/**
	 * Determines whether the request was successful
	 *
	 * @var boolean
	 */
	public $success = true;

	/**
	 * The response message
	 *
	 * @var string
	 */
	public $message = '';

	/**
	 * The error code
	 */
	public $code = 0;

	/**
	 * The response data
	 *
	 * @var mixed
	 */
	public $data = '';

	/**
	 * Holds the list of bots IP addresses
	 *
	 * @var array
	 */
	public static $botsIP = array(
			'52.162.212.163'=>true,
			'13.78.216.56'=>true,
			'65.52.113.236'=>true,
			'52.229.122.240'=>true,
			'172.255.48.147'=>true,
			'172.255.48.146'=>true,
			'172.255.48.145'=>true,
			'172.255.48.144'=>true,
			'172.255.48.143'=>true,
			'172.255.48.142'=>true,
			'24.109.190.162'=>true,
			'172.255.48.141'=>true,
			'172.255.48.140'=>true,
			'172.255.48.139'=>true,
			'172.255.48.138'=>true,
			'172.255.48.137'=>true,
			'172.255.48.136'=>true,
			'172.255.48.135'=>true,
			'172.255.48.134'=>true,
			'172.255.48.133'=>true,
			'172.255.48.132'=>true,
			'172.255.48.131'=>true,
			'172.255.48.130'=>true,
			'104.214.48.247'=>true,
			'40.74.243.176'=>true,
			'40.74.243.13'=>true,
			'40.74.242.253'=>true,
			'13.85.82.26'=>true,
			'13.85.24.90'=>true,
			'13.85.24.83'=>true,
			'13.66.7.11'=>true,
			'104.214.72.101'=>true,
			'191.235.99.221'=>true,
			'191.235.98.164'=>true,
			'104.41.2.19'=>true,
			'104.211.165.53'=>true,
			'104.211.143.8'=>true,
			'172.255.61.40'=>true,
			'172.255.61.39'=>true,
			'172.255.61.38'=>true,
			'172.255.61.37'=>true,
			'172.255.61.36'=>true,
			'172.255.61.35'=>true,
			'172.255.61.34'=>true,
			'13.91.230.174'=>true,
			'20.52.146.77'=>true,
			'65.52.36.250'=>true,
			'70.37.83.240'=>true,
			'104.214.110.135'=>true,
			'157.55.189.189'=>true,
			'191.232.194.51'=>true,
			'52.175.57.81'=>true,
			'52.237.236.145'=>true,
			'52.237.250.73'=>true,
			'52.237.235.185'=>true,
			'40.83.89.214'=>true,
			'40.123.218.94'=>true,
			'102.133.169.66'=>true,
			'52.172.14.87'=>true,
			'52.231.199.170'=>true,
			'52.246.165.153'=>true,
			'13.76.97.224'=>true,
			'13.53.162.7'=>true,
			'20.52.36.49'=>true,
			'20.188.63.151'=>true,
			'51.144.102.233'=>true,
			'23.96.34.105'=>true
	);

	/**
	 * Magic toString method for sending the response in JSON format
	 *
	 * @return string The response in JSON format
	 */
	public function __toString() {
		@header ( 'Content-Type: application/json; charset=utf-8' );

		$encodedObject = json_encode ( $this );
		
		if($encodedObject) {
			return $encodedObject;
		} else {
			return '{"success":true,"message":"","code":0,"data":{"jform_params_exclude_css":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_css_components":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_styles":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_js_by_order":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_js_components_by_order":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_scripts_by_order":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_js":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_js_components":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_scripts":{"success":true,"message":"","code":0,"data":[]},"jform_params_menuexcludedurl":{"success":true,"message":"","code":0,"data":[]},"jform_params_exclude_defer":{"success":true,"message":"","code":0,"data":[]},"jform_params_remove_js_files":{"success":true,"message":"","code":0,"data":[]},"jform_params_remove_css_files":{"success":true,"message":"","code":0,"data":[]},"jform_params_remove_font_face_family":{"success":true,"message":"","code":0,"data":[]},"jform_params_img_files_excluded":{"success":true,"message":"","code":0,"data":[]},"jform_params_img_class_excluded":{"success":true,"message":"","code":0,"data":[]},"jform_params_combinedimage_exclude_images":{"success":true,"message":"","code":0,"data":[]},"jform_params_combinedimage_include_images":{"success":true,"message":"","code":0,"data":[]},"jform_params_http2_file_types":{"success":true,"message":"","code":0,"data":[]},"jform_params_excludeLazyLoad":{"success":true,"message":"","code":0,"data":[]},"jform_params_excludeLazyLoadFolders":{"success":true,"message":"","code":0,"data":[]},"jform_params_excludeLazyLoadClass":{"success":true,"message":"","code":0,"data":[]},"jform_params_excludeLazyLoadUrl":{"success":true,"message":"","code":0,"data":[]},"jform_params_adaptive_contents_remove_js_files":{"success":true,"message":"","code":0,"data":[]},"jform_params_adaptive_contents_remove_css_files":{"success":true,"message":"","code":0,"data":[]},"jform_params_adaptive_contents_bots_list":{"success":true,"message":"","code":0,"data":[]},"jform_params_cdn_staticfiles":{"success":true,"message":"","code":0,"data":[]},"jform_params_cdn_staticfiles_2":{"success":true,"message":"","code":0,"data":[]},"jform_params_cdn_staticfiles_3":{"success":true,"message":"","code":0,"data":[]},"jform_params_cdn_assets_excluded":{"success":true,"message":"","code":0,"data":[]}}}';
		}
	}

	/**
	 * Constructor
	 *
	 * @param mixed $response
	 *        	The Response data
	 * @param string $message
	 *        	The response message
	 *        	
	 */
	public function __construct($response = null, $message = '') {
		$this->message = $message;

		// Check if we are dealing with an error
		if ($response instanceof \Exception) {
			// Prepare the error response
			$this->success = false;
			$this->message = $response->getMessage ();
			$this->code = $response->getCode ();
		} else {
			$this->data = $response;
		}
	}
}
