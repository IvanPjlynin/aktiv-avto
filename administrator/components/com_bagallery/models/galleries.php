<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

class bagalleryModelGalleries extends JModelList
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'title', 'state', 'published'
            );
        }
        parent::__construct($config);
    }

    public function getCount()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('COUNT(id)')
            ->from('#__bagallery_galleries');
        $db->setQuery($query);
        $count = $db->loadResult();
        return $count;
    }
    
    protected function getListQuery()
    {
        $db = JFactory::getDbo();
        $app = JFactory::getApplication();
        $query = $db->getQuery(true);
        $query->select('id, title, published');
        $query->from('#__bagallery_galleries');
        
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = $db->quote('%' . $db->escape($search, true) . '%', false);
            $query->where('title LIKE ' . $search);
        }
        
        $published = $this->getState('filter.state');
        if ($app->input->get('layout') == 'modal') {
            $published = 1;
        }

		if (is_numeric($published))
		{
			$query->where('published = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(published IN (0, 1))');
		}
        
        $orderCol = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'desc');
        if (empty($orderDirn)) {
            $orderDirn = 'desc';
        }
		if ($orderCol == 'ordering')
		{
			$orderCol = 'title ' . $orderDirn . ', ordering';
		}
		$query->order($db->escape($orderCol . ' ' . $orderDirn));
        
        return $query;
    }

    public function getItems()
    {
        $store = $this->getStoreId();
        $app = JFactory::getApplication();
        if (isset($this->cache[$store]))
        {
            return $this->cache[$store];
        }
        $query = $this->_getListQuery();
        try
        {
            if ($app->input->get('layout') == 'modal') {
                $items = $this->_getList($query, 0, 0);
            } else {
                $items = $this->_getList($query, $this->getStart(), $this->getState('list.limit'));
            }            
        }
        catch (RuntimeException $e)
        {
            $this->setError($e->getMessage());
            return false;
        }
        $this->cache[$store] = $items;

        return $this->cache[$store];
     }
    
    protected function getStoreId($id = '')
    {
        $id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.state');
        return parent::getStoreId($id);
    }
    
    protected function populateState($ordering = null, $direction = null)
    {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);
        $published = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state', '');
		$this->setState('filter.state', $published);
        
        parent::populateState('id', 'desc');
    }
    
}