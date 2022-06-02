 
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
jimport( 'joomla.form.form' );

class bagalleryViewGallery extends JViewLegacy
{
    protected $_album;
    protected $tags;
    protected $colors;

    public function display ($tpl = null)
    {
        if (count($errors = $this->get('Errors'))) {
            throw new \Exception(implode('<br />', $errors), 500);
            return false;
        }
        if (!JFactory::getUser()->authorise('core.edit', 'com_bagallery')) {
            throw new \Exception(JText::_('NOT_HAVE_PERMISSIONS'), 403);
        }
        $input = JFactory::getApplication()->input;
        $id = $input->get('id');
        if (empty($id)) {
            return;
        }
        $form = JForm::getInstance('gallery', JPATH_COMPONENT.'/models/forms/gallery.xml', array('control' => 'jform', 'load_data' => true));
        $data = $this->get('FormData');
        foreach ($data as $key => $value) {
            $form->setValue($key, null, $value);
        }
        $this->form = $form;
        $this->item = $this->get('Item');
        $this->tags = $this->get('Tags');
        $this->colors = $this->get('Colors');
        $this->_album = $this->getAlbum();
        
        parent::display($tpl);
    }

    protected function getAlbum()
    {
        $id = $_GET['id'];
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('album_mode')
            ->from('#__bagallery_galleries')
            ->where('`id` = '.$id);
        $db->setQuery($query);
        $res = $db->loadResult();

        return $res;
    }

    protected function addToolBar()
    {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);
        JToolBarHelper::title($isNew ? JText::_('BAGALLERY_NEW') : JText::_('BAGALLERY_EDIT'),'image');
        JToolBarHelper::apply('gallery.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('gallery.save');
        JToolBarHelper::cancel('gallery.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
    }
}