<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.view');
 

class bagalleryViewGalleries extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $state;
    protected $about;
    protected $count;
    
    public function display($tpl = null) 
    {
        $this->about = bagalleryHelper::aboutUs();
        $this->items = $this->get('Items');
        $this->count = $this->get('count');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->addToolBar();
        $layout = JFactory::getApplication()->input->get('layout', '', 'string');
        $doc = JFactory::getDocument();
        if ($doc->getDirection() == 'rtl') {
            $doc->addStyleSheet(JUri::root().'administrator/components/com_bagallery/assets/css/rtl-ba-admin.css?'.$this->about->version);
        }
        if (JVERSION >= '4.0.0') {
            $doc->addScript(JUri::root(true).'/media/vendor/jquery/js/jquery.min.js');
        }
        if (empty($layout)) {
            $doc->addScript('components/com_bagallery/assets/js/ba-about.js?'.$this->about->version);
            $doc->addScript(JUri::root().'components/com_bagallery/assets/js/bootstrap.js?'.$this->about->version);
        }
        foreach ($this->items as &$item) {
            $item->order_up = true;
            $item->order_dn = true;
        }
        
        parent::display($tpl);
    }
    
    protected function addToolBar ()
    {
        JToolBarHelper::title(JText::_('GALLERIES_TITLE'), 'image');
        if (JFactory::getUser()->authorise('core.create', 'com_bagallery')) {
            JToolBarHelper::addNew('gallery.add');
        }
        if (JFactory::getUser()->authorise('core.edit', 'com_bagallery')) {
            JToolBarHelper::editList('gallery.edit');
        }
        if (JFactory::getUser()->authorise('core.duplicate', 'com_bagallery')) {
            JToolBarHelper::custom('galleries.duplicate', 'copy.png', 'copy_f2.png', 'JTOOLBAR_DUPLICATE', true);
        }
        if (JFactory::getUser()->authorise('core.edit.state', 'com_bagallery')) {
            JToolbarHelper::publish('galleries.publish', 'JTOOLBAR_PUBLISH', true);
            JToolbarHelper::unpublish('galleries.unpublish', 'JTOOLBAR_UNPUBLISH', true);
        }
        if (JFactory::getUser()->authorise('core.delete', 'com_bagallery')) {
            if ($this->state->get('filter.state') == -2) {
                JToolBarHelper::deleteList('', 'galleries.delete');
            } else {
                JToolbarHelper::trash('galleries.trash');
            }
        }
        if (JFactory::getUser()->authorise('core.admin', 'com_bagallery') || JFactory::getUser()->authorise('core.options', 'com_bagallery')) {
            JToolBarHelper::preferences('com_bagallery');
        }
    }
    
    protected function getSortFields()
    {
        return array(
            'published' => JText::_('JSTATUS'),
            'title' => JText::_('JGLOBAL_TITLE'),
            'id' => JText::_('JGRID_HEADING_ID')
        );
    }
}