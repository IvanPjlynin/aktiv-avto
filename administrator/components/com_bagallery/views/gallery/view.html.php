<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class bagalleryViewGallery extends JViewLegacy
{
    protected $about;
    protected $access;
    protected $tags;
    protected $colors;

    public function display ($tpl = null)
    {
        if (count($errors = $this->get('Errors'))) {
            throw new \Exception(implode('<br />', $errors), 500);
            return false;
        }
        $this->tags = $this->get('Tags');
        $this->colors = $this->get('Colors');
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->access = bagalleryHelper::getAccess();
        $this->about = bagalleryHelper::aboutUs();
        $this->addToolBar();
        $doc = JFactory::getDocument();
        if (JVERSION >= '4.0.0') {
            $doc->addScript(JUri::root(true).'/media/vendor/jquery/js/jquery.min.js');
        }
        $doc->addScript(JUri::root().'components/com_bagallery/assets/js/bootstrap.js?'.$this->about->version);
        $doc->addScript('//cdn.ckeditor.com/4.12.1/full/ckeditor.js');

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);
        JToolBarHelper::title($isNew ? JText::_('BAGALLERY_NEW') : JText::_('BAGALLERY_EDIT'), 'image');
        JToolBarHelper::apply('gallery.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('gallery.save');
        JToolBarHelper::cancel('gallery.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}