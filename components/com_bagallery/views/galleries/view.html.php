<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

// import Joomla view library
jimport('joomla.application.component.view');
 

class bagalleryViewGalleries extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $state;
    protected $about;
    
    public function display($tpl = null) 
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        JHtml::_('bootstrap.framework');
        foreach ($this->items as &$item) {
            $item->order_up = true;
            $item->order_dn = true;
        }

        parent::display($tpl);
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