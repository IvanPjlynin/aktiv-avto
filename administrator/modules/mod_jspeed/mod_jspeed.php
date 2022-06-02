<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::modules
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */

defined('_JEXEC') or die;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use JExtStore\Module\Jspeed\Administrator\Helper\JspeedHelper;

// Manage partial language translations
$jLang = Factory::getLanguage();
$jLang->load('mod_jspeed', JPATH_BASE . '/modules/mod_jspeed', 'en-GB', true, true);
if($jLang->getTag() != 'en-GB') {
	$jLang->load('mod_jspeed', JPATH_BASE, null, true, false);
	$jLang->load('mod_jspeed', JPATH_BASE . '/modules/mod_jspeed', null, true, false);
}

require ModuleHelper::getLayoutPath('mod_jspeed', $params->get('layout', 'default'));