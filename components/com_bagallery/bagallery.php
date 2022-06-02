<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$params = JComponentHelper::getParams('com_bagallery');
define('IMAGES_BASE', JPATH_ROOT.'/'.$params->get('image_path', 'images'));
define('THUMBNAILS_BASE', JPATH_ROOT.'/'.$params->get('file_path', 'images'));
bagalleryHelper::prepareParams($params);
if (!is_dir(THUMBNAILS_BASE.'/bagallery')) {
    jimport('joomla.filesystem.folder');
    jFolder::create(THUMBNAILS_BASE.'/bagallery', 0755);
}
$controller = JControllerLegacy::getInstance('bagallery');
$controller->execute(JFactory::getApplication()->input->getCmd('task', 'display'));
$controller->redirect();