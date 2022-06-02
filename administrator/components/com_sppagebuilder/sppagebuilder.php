<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Access\Exception\NotAllowed;
use Joomla\CMS\MVC\Controller\BaseController;

if (!Factory::getUser()->authorise('core.manage', 'com_sppagebuilder'))
{
	throw new NotAllowed(Text::_('JERROR_ALERTNOAUTHOR'), 403);
}

// Require helper file
JLoader::register('SppagebuilderHelper', __DIR__ . '/helpers/sppagebuilder.php');

$controller = BaseController::getInstance('sppagebuilder');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
