<?php
namespace JExtStore\Module\Jspeed\Administrator\Helper;
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::modules
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Plugin\PluginHelper;

/**
 * Helper class for admin stats module
 *
 * @since 3.0
 */
class JspeedHelper {
	/**
	 * Method to retrieve information about the site
	 *
	 * @return array Array containing site information
	 *        
	 * @since 3.0
	 */
	public static function getPlugin() {
		PluginHelper::importPlugin('system');
		
		$jSpeedPlugin = PluginHelper::getPlugin('system', 'jspeed');
		return $jSpeedPlugin;
	}
}
