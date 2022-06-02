<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class bagalleryModelUploader extends JModelLegacy
{
    public function getUploader($dir = '')
    {
        include_once JPATH_COMPONENT.'/helpers/uploader.php';
        $uploader = new uploaderHelper($dir);

        return $uploader;
    }
}
