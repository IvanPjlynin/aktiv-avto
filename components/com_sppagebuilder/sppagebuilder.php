<?php

/**
 * @package   SP_Page_Builder
 * @author  JoomShaper <support@joomshaper.com>
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\MVC\Controller\BaseController;

// No direct accees
defined('_JEXEC') or die('Restricted access');

// CSRF
HTMLHelper::_('jquery.token');

// Require helper file
JLoader::register('SppagebuilderHelperSite', __DIR__ . '/helpers/helper.php');

$controller = BaseController::getInstance('Sppagebuilder');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
