<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/ 

defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
 
class bagalleryModelgallery extends JModelAdmin
{
    public function getTable($type = 'Galleries', $prefix = 'GalleryTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function checkGridbox()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('extension_id ')
            ->from('#__extensions')
            ->where('element = '.$db->quote('com_gridbox'));
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public function getGridbox()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title, type, id')
            ->where('type <> '.$db->quote('system_apps'))
            ->from('#__gridbox_app');
        $db->setQuery($query);
        $apps = $db->loadObjectList();
        $obj = new stdClass();
        $obj->id = 0;
        $obj->title = JText::_('SINGLE_PAGES');
        $obj->type = '';
        $apps[] = $obj;
        usort($apps, function($a, $b){
            return ($a->id < $b->id) ? -1 : 1;
        });
        foreach ($apps as $app) {
            if (empty($app->type) || $app->type == 'single') {
                $query = $db->getQuery(true)
                    ->select('id, title')
                    ->from('#__gridbox_pages')
                    ->where('page_category <> '.$db->quote('trashed'))
                    ->where('app_id = '.$app->id)
                    ->where('published = 1');
                $db->setQuery($query);
                $pages = $db->loadObjectList();
                $app->pages = $this->setPagesLink($pages);
            } else {
                $app->link = 'index.php?option=com_gridbox&view=blog&app='.$app->id.'&id=0';
                $app->childs = $this->getCategories($app->id, 0);
            }
        }
        
        return $apps;
    }

    public function getCategories($id, $parent)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title')
            ->from('#__gridbox_categories')
            ->where('published = 1')
            ->where('app_id = '.$id)
            ->where('parent = '.$parent);
        $db->setQuery($query);
        $categories = $db->loadObjectList();
        foreach ($categories as $category) {
            $category->childs = $this->getCategories($id, $category->id);
            $category->link = 'index.php?option=com_gridbox&view=blog&app='.$id.'&id='.$category->id;
            $query = $db->getQuery(true)
                ->select('id, title, page_category, app_id')
                ->from('#__gridbox_pages')
                ->where('page_category <> '.$db->quote('trashed'))
                ->where('page_category = '.$category->id)
                ->where('published = 1');
            $db->setQuery($query);
            $pages = $db->loadObjectList();
            $category->pages = $this->setPagesLink($pages);
        }

        return $categories;
    }

    public function setPagesLink($pages)
    {
        foreach ($pages as $page) {
            if (isset($page->page_category)) {
                $page->link = 'index.php?option=com_gridbox&view=page&blog='.$page->app_id;
                $page->link .= '&category='.$page->page_category.'&id='.$page->id;
            } else {
                $page->link = 'index.php?option=com_gridbox&view=page&id='.$page->id;
            }
        }

        return $pages;
    }

    public function getMenus()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title, menutype')
            ->from('#__menu_types')
            ->order('title ASC');
        $db->setQuery($query);
        $menus = $db->loadObjectList();
        foreach ($menus as $key => $menu) {
            $query = $db->getQuery(true)
                ->select('title, link, id')
                ->from('#__menu')
                ->where('published = 1')
                ->where('menutype = '.$db->quote($menu->menutype))
                ->where('parent_id = 1');
            $db->setQuery($query);
            $menu->childs = $db->loadObjectList();
            foreach ($menu->childs as $child) {
                $this->getChilds($child);
            }
        }

        return $menus;
    }

    public function getChilds($obj)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title, link, id')
            ->from('#__menu')
            ->where('published = 1')
            ->where('parent_id = '.$obj->id);
        $db->setQuery($query);
        $obj->childs = $db->loadObjectList();
        foreach ($obj->childs as $key => $child) {
            $this->getChilds($child);
        }

        return $obj;
    }

    public function getArticles()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('title, id')
            ->from('#__content')
            ->where('(state = 0 OR state = 1)');
        $db->setQuery($query);
        $items = $db->loadObjectList();

        return $items;
    }

    public function getTags()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title')
            ->from('#__bagallery_tags');
        $db->setQuery($query);
        $tags = $db->loadObjectList();

        return $tags;
    }

    public function getColors()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id, title')
            ->from('#__bagallery_colors');
        $db->setQuery($query);
        $tags = $db->loadObjectList();

        return $tags;
    }
 
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            $this->option . '.gallery', 'gallery', array('control' => 'jform', 'load_data' => $loadData)
        );
        
        if (empty($form)) {
            return false;
        }
 
        return $form;
    }
    
    public function save($data)
    {
        $input = JFactory::getApplication()->input;
        $data = $input->post->get('jform', array(), 'array');
        $categories = $input->post->get('cat-options', array(), 'array');
        $db = JFactory::getDBO();
        $data['title'] = strip_tags($data['title']);
        $data['saved_time'] = time();
        if(parent::save($data)) {
            $formId = $this->getState($this->getName() . '.id');
            $dirName = THUMBNAILS_BASE. '/bagallery/gallery-' .$formId. '/album/';
            $catId = array();
            $catImgs = array();
            $order = 0;
            foreach ($categories as $category) {
                if ($category != '') {
                    $category = json_decode($category);
                    $cat = explode(';', $category->settings);
                    for ($i = 0; $i < 8; $i++) {
                        if (!isset($cat[$i])) {
                            $cat[$i] = '';
                        }
                    }
                    if (empty($cat[8])) {
                        $cat[8] = $cat[0];
                    }
                    $cat[8] =  bagalleryHelper::getAlias($cat[8], '#__bagallery_items', 'lightboxUrl', $category->id);
                    $category->settings = implode(';', $cat);
                    if (!empty($cat[5])) {
                        $name = explode('/', $cat[5]);
                        $catImgs[] = 'category-'.$cat[4].'-'.end($name);
                    } else {
                        if (!in_array('image-placeholder.jpg', $catImgs)) {
                            $catImgs[] = 'image-placeholder.jpg';
                        }
                    }
                    $table = JTable::getInstance('Category', 'GalleryTable');
                    $table->load($category->id);
                    $table->bind(array('form_id' => $formId, 'title' => $cat[0], 'orders' => $order,
                        'settings' => $category->settings, 'parent' => $category->parent,
                        'access' => $category->access, 'password' => $category->password));
                    $table->store();
                    $catId[] = $table->id;
                    $order++;
                }
            }
            if (jFolder::exists($dirName)) {
                $albums  = jFolder::files($dirName);
                foreach ($albums as $value) {
                    if (!in_array($value, $catImgs)) {
                        JFile::delete($dirName.$value);
                    }
                }
            }
            $query = $db->getQuery(true);
            $query->select("id")
                ->from("#__bagallery_category")
                ->where("form_id=" . $db->Quote($formId));
            $db->setQuery($query);
            $items = $db->loadColumn();
            foreach ($items as $id) {
                if (!in_array($id, $catId)) {
                    $query = $db->getQuery(true);
                    $conditions = array(
                        $db->quoteName('id'). '=' .$db->quote($id)
                    );
                    $query->delete($db->quoteName('#__bagallery_category'))
                        ->where($conditions);
                    $db->setQuery($query)
                        ->execute();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function checkName($array, $name)
    {
        if (in_array($name, $array)) {
            $name = rand(0, 999999999).'-'.$name;
            $name = $this->checkName($array, $name);
        }

        return $name;
    }

    public function getThumbnail($id)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('thumbnail_url')
            ->from('#__bagallery_items')
            ->where('`id` = '.$id);
        $db->setQuery($query);
        $res = $db->loadResult();
        $pos = strpos($res, '/images/');
        $res = substr($res, $pos+8);
        
        return $res;
    }
    
    public function clearImageDirectory($id, $allCat, $allThumb)
    {
        
        $dir = THUMBNAILS_BASE. '/bagallery/gallery-' .$id. '/thumbnail';
        if (JFolder::exists($dir)) {
            $folders = jFolder::folders($dir);
            if (empty($folders)) {
                return;
            }
            foreach ($folders as $folder) {
                if (!in_array($folder, $allCat)) {
                    bagalleryHelper::deleteFolder($dir.'/'.$folder);
                } else {
                    $files = JFolder::files($dir .'/'.$folder);
                    if (!empty($files)) {
                        foreach ($files as $file) {
                            if (!in_array($file, $allThumb[$folder])) {
                                JFile::delete($dir .'/'.$folder. '/' .$file);
                            }
                        }
                    }
                }
            }
        }
    }
    
    public function delete(&$pks)
    {
        $pks = (array) $pks;
        foreach ($pks as $i => $pk) {
            $id = $pk;
            if (parent::delete($pk)) {
                $this->_db->setQuery("DELETE FROM #__bagallery_items WHERE `form_id`=". $id);
                $this->_db->execute();
                $this->_db->setQuery("DELETE FROM #__bagallery_category WHERE `form_id`=". $id);
                $this->_db->execute();
                $this->_db->setQuery("DELETE FROM #__bagallery_colors_map WHERE `gallery_id`=". $id);
                $this->_db->execute();
                $this->_db->setQuery("DELETE FROM #__bagallery_tags_map WHERE `gallery_id`=". $id);
                $this->_db->execute();
                if (jFolder::exists(THUMBNAILS_BASE. '/bagallery/gallery_' .$id)) {
                    bagalleryHelper::deleteFolder(THUMBNAILS_BASE. '/bagallery/gallery_' .$id);
                }
                if (jFolder::exists(THUMBNAILS_BASE. '/bagallery/gallery-' .$id)) {
                    bagalleryHelper::deleteFolder(THUMBNAILS_BASE. '/bagallery/gallery-' .$id);
                }
            } else {
                return false;
            }
        }
        return true;
    }
    
    public function checkObj($obj)
    {
        if (!isset($obj->title)) {
            $obj->title = '';
        }
        if (!isset($obj->short)) {
            $obj->short = '';
        }
        if (!isset($obj->alt)) {
            $obj->alt = '';
        }
        if (!isset($obj->description)) {
            $obj->description = '';
        }
        if (!isset($obj->link)) {
            $obj->link = '';
        }
        if (!isset($obj->video)) {
            $obj->video = '';
        }
        if (!isset($obj->lightboxUrl)) {
            $obj->lightboxUrl = '';
        }
        if (!isset($obj->hideInAll)) {
            $obj->hideInAll = 0;
        }
        return $obj;
    }
    
    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState($this->option . '.edit.gallery.data', array());
        if (empty($data))
        {
            $data = $this->getItem();
            $id = $data->id;
            if (isset($id)) {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true)
                    ->select("*")
                    ->from("#__bagallery_category")
                    ->where("form_id=" . $id)
                    ->order("orders ASC");
                $db->setQuery($query);
                $categories = $db->loadObjectList();
                $data->gallery_category = json_encode($categories);
                $query = $db->getQuery(true)
                    ->select("settings, thumbnail_url, likes")
                    ->from("#__bagallery_items")
                    ->where("form_id=" . $id)
                    ->order("id ASC");
                $db->setQuery($query);
                $items = $db->loadObjectList();
                
                foreach ($items as $item) {
                    $obj = json_decode($item->settings);
                    $obj->likes = $item->likes;
                    $obj->path = bagalleryHelper::replaceLongPath($obj->path);
                    $obj->url = bagalleryHelper::replaceLongPath($obj->url);
                    $obj->thumbnail_url = $item->thumbnail_url;
                    $item->settings = json_encode($obj);
                }
                $data->gallery_items = $data->gallery_items = json_encode($items);
            }
            
        }
        
        return $data;
    }

    

    protected function getNewTitle($title)
    {
        $table = $this->getTable();
        while ($table->load(array('title' => $title)))
        {
            $title = bagalleryHelper::increment($title);
        }

        return $title;
    }
    
    public function duplicate(&$pks)
    {
        $db = $this->getDbo();
        foreach ($pks as $pk) {
            $table = $this->getTable();
            $table->load($pk, true);
            $table->id = 0;
            $table->title = $this->getNewTitle($table->title);
            $table->published = 0;
            $table->store();
            $id = $table->id;
            $query = $db->getQuery(true);
            $query->select("*");
            $query->from("#__bagallery_category");
            $query->where("form_id=" . $pk);
            $query->order("id ASC");
            $db->setQuery($query);
            $items = $db->loadObjectList();
            foreach ($items as $item) {
                $item->id = 0;
                $item->form_id = $id;
                $db->insertObject('#__bagallery_category', $item);
            }
            $query = $db->getQuery(true);
            $query->select("*");
            $query->from("#__bagallery_items");
            $query->where("form_id=" . $pk);
            $query->order("id ASC");
            $db->setQuery($query);
            $items = $db->loadObjectList();
            foreach ($items as $key => $item) {
                $query = $db->getQuery(true)
                    ->select('*')
                    ->from('#__bagallery_colors_map')
                    ->where('`image_id` = '.$item->id);
                $db->setQuery($query);
                $colors = $db->loadObjectList();
                $query = $db->getQuery(true)
                    ->select('*')
                    ->from('#__bagallery_tags_map')
                    ->where('`image_id` = '.$item->id);
                $db->setQuery($query);
                $tags = $db->loadObjectList();
                $item->id = 0;
                $item->form_id = $id;
                if (!empty($item->thumbnail_url)) {
                    $item->thumbnail_url = str_replace('gallery-'.$pk, 'gallery-'.$id, $item->thumbnail_url);
                    $item->thumbnail_url = str_replace('gallery_'.$pk, 'gallery_'.$id, $item->thumbnail_url);
                }
                $db->insertObject('#__bagallery_items', $item);
                $imageId = $db->insertid();
                foreach ($colors as $color) {
                    $color->image_id = $imageId;
                    $color->gallery_id = $id;
                    unset($color->id);
                    $db->insertObject('#__bagallery_colors_map', $color);
                }
                foreach ($tags as $tag) {
                    $tag->image_id = $imageId;
                    $tag->gallery_id = $id;
                    unset($tag->id);
                    $db->insertObject('#__bagallery_tags_map', $tag);
                }
            }
            $query = $db->getQuery(true);
            $query->select("id, settings");
            $query->from("#__bagallery_items");
            $query->where("form_id=" . $id);
            $query->order("id ASC");
            $db->setQuery($query);
            $items = $db->loadObjectList();
            foreach ($items as $item) {
                $obj = $item->settings;
                $obj = json_decode($obj);
                $obj->id = $item->id;
                $obj = json_encode($obj);
                $query = "UPDATE `#__bagallery_items` SET `settings`=";
                $query .= $db->Quote($obj). " WHERE `id`=";
                $query .= $db->Quote($item->id);
                $db->setQuery($query)
                    ->execute();
            }
        }
    }
    
}