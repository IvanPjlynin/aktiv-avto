<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

if (!JFactory::getUser()->authorise('core.manage', 'com_bagallery')) {
    throw new \Exception(JText::_('JERROR_ALERTNOAUTHOR'), 404);
}

JLoader::register('bagalleryHelper', dirname(__FILE__).'/helpers/bagallery.php');
JHtml::addIncludePath(dirname(__FILE__).'/helpers/html');
$params = JComponentHelper::getParams('com_bagallery');
define('IMAGES_BASE', JPATH_ROOT.'/'.$params->get('image_path', 'images'));
define('THUMBNAILS_BASE', JPATH_ROOT.'/'.$params->get('file_path', 'images'));
bagalleryHelper::prepareParams($params);
if (!is_dir(THUMBNAILS_BASE.'/bagallery') || !is_dir(IMAGES_BASE)) {
    jimport('joomla.filesystem.folder');
    if (!is_dir(THUMBNAILS_BASE.'/bagallery')) {
        jFolder::create(THUMBNAILS_BASE.'/bagallery', 0755);
    }
    if (!is_dir(IMAGES_BASE)) {
        jFolder::create(IMAGES_BASE, 0755);
    }
}
$controller = JControllerLegacy::getInstance('bagallery');
$controller->execute(JFactory::getApplication()->input->getCmd('task', 'display'));
$controller->redirect(); 
