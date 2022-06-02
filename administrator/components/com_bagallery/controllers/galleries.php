<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');
use Joomla\Archive\Archive;

class BagalleryControllerGalleries extends JControllerAdmin
{
	public function getModel($name = 'gallery', $prefix = 'bagalleryModel', $config = array()) 
	{
        $model = parent::getModel($name, $prefix, array('ignore_request' => true));
        return $model;
	}

    public function versionCompare()
    {
        $about = bagalleryHelper::aboutUs();
        $input = JFactory::getApplication()->input;
        $version = $input->get('version', '', 'string');
        $compare = version_compare($about->version, $version);
        echo $compare;
        exit();
    }

    public function cleanup()
    {
        bagalleryHelper::cleanup();
        echo JText::_('COM_BAGALLERY_N_ITEMS_DELETED');
        exit;
    }

    public function getCategories()
    {
        $id = $this->input->get('id', 0, 'int');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id, title, settings')
            ->from('#__bagallery_category')
            ->where('`form_id` = '.$id)
            ->order('orders ASC');
        $db->setQuery($query);
        $result = $db->loadObjectList();
        print_r(json_encode($result));
        exit;
    }

    public function duplicate()
    {
        $pks = $this->input->getVar('cid', array(), 'post', 'array');
        $model = $this->getModel();
        $model->duplicate($pks);
        $this->setMessage(JText::plural('GALLERY_DUPLICATED', count($pks)));
        $this->setRedirect('index.php?option=com_bagallery&view=galleries');
    }
    
    public function updateGallery()
    {
        $config = JFactory::getConfig();
        $path = $config->get('tmp_path').'/pkg_BaGallery.zip';
        $data = file_get_contents('php://input');
        $obj = json_decode($data);
        $method = $obj->method;
        $data = $method($obj->package);
        $file = fopen($path, "w+");
        fputs($file, $data);
        fclose($file);
        $this->extract($path, $config->get('tmp_path').'/pkg_BaGallery');
        $installer = JInstaller::getInstance();
        $result = $installer->update($config->get('tmp_path').'/pkg_BaGallery');
        JFile::delete($path);
        bagalleryHelper::deleteFolder($config->get('tmp_path').'/pkg_BaGallery');
        exit;
    }

    public function extract($from, $to)
    {
        if (JVERSION >= '4.0.0') {
            $archive = new Archive();
            $archive->extract($from, $to);
        } else {
            JArchive::extract($from, $to);
        }
    }

    public function checkGalleryState()
    {
        $state = bagalleryHelper::checkGalleryState();
        print_r($state);exit();
    }

    public function getUserLicense()
    {
        $input = JFactory::getApplication()->input;
        $data = $input->get('data', '', 'string');
        bagalleryHelper::setAppLicense($data);
    }

    public function addLanguage()
    {
        $input = JFactory::getApplication()->input;
        $method = $input->get('method', '', 'string');
        $url = $input->get('url', '', 'string');
        $zip = $input->get('zip', '', 'string');
        $name = explode('/', $url);
        $name = end($name);
        $config = JFactory::getConfig();
        $path = $config->get('tmp_path') . '/'. $name;
        $name = explode('.', $name);
        $data = $method($zip);
        $file = fopen($path, "w+");
        fputs($file, $data);
        fclose($file);
        $this->extract($path, $config->get('tmp_path') . '/' .$name[0]);
        $installer = JInstaller::getInstance();
        $result = $installer->install($config->get('tmp_path') . '/'. $name[0]);
        JFile::delete($path);
        bagalleryHelper::deleteFolder($config->get('tmp_path').'/'.$name[0]);
        echo JText::_('SUCCESS_INSTALL');
        exit;
    }
}