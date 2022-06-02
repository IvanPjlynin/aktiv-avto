<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class bagalleryViewUploader extends JViewLegacy
{
    protected $_limit;
    protected $about;
    protected $version;
    protected $uploader;
    
    public function display($tpl = null)
    {
        if (count($errors = $this->get('Errors'))) {
            throw new \Exception(implode('<br />', $errors), 500);
            return false;
        }
        $doc = JFactory::getDocument();
        $this->uploader = $this->get('Uploader');
        $this->about = bagalleryHelper::aboutUs();
        $this->version = $this->about->version;
        $this->_limit = $this->uploader->limit;
        $this->addToolBar();
        if ($doc->getDirection() == 'rtl') {
            $doc->addStyleSheet('components/com_bagallery/assets/css/rtl-ba-admin.css?'.$this->version);
        }
        $doc = JFactory::getDocument();
        if (JVERSION >= '4.0.0') {
            $doc->addScript(JUri::root().'media/vendor/jquery/js/jquery.min.js');
        }
        $doc->addScript('components/com_bagallery/assets/js/ba-uploader.js?'.$this->version);
        $doc->addScript(JUri::root().'components/com_bagallery/assets/js/bootstrap.js?'.$this->version);

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);
    }
}