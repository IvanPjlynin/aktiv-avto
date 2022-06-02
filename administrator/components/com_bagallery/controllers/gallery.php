<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class BagalleryControllerGallery extends JControllerForm
{
    public function save($key = null, $urlVar = null)
    {
        $data = $this->input->post->get('jform', array(), 'array');
        $model = $this->getModel();
        $table = $model->getTable();
        $url = $table->getKeyName();
        parent::save($key = $data['id'], $urlVar = $url);
    }

    public function showImage()
    {
        $dir = urldecode($_GET['image']);
        $dir = bagalleryHelper::replaceLongPath($dir);
        if (strpos($dir, '/') != 0) {
            $dir = '/'.$dir;
        }
        $dir = JPATH_ROOT.$dir;
        $ext = strtolower(JFile::getExt($dir));
        $imageCreate = bagalleryHelper::imageCreate($ext);
        $imageSave = bagalleryHelper::imageSave($ext);
        $offset = 60 * 60 * 24 * 90;
        $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
        header("Content-type: image/".$ext);
        header($ExpStr);
        if (!$img = $imageCreate($dir)) {
            $f = fopen($dir, "r");
            fpassthru($f);
        } else {
            $width = imagesx($img);
            $height = imagesy($img);
            $ratio = $width / $height;
            if ($width > $height) {
                $w = 100;
                $h = 100 / $ratio;
            } else {
                $h = 100;
                $w = 100 * $ratio;
            }
            $out = imagecreatetruecolor($w, $h);
            if ($ext == 'png' || $ext == 'webp') {
                imagealphablending($out, false);
                imagesavealpha($out, true);
                $transparent = imagecolorallocatealpha($out, 255, 255, 255, 127);
                imagefilledrectangle($out, 0, 0, $w, $h, $transparent);
            }
            imagecopyresampled($out, $img, 0, 0, 0, 0, $w, $h, $width, $height);
            $imageSave($out);
            imagedestroy($img);
            imagedestroy($out);
        }
        exit;
    }

    public function getLinksString()
    {
        $model = $this->getModel();
        $menus = $model->getMenus();
        $articles = $model->getArticles();
        $id = $model->checkGridbox();
        $str = '<ul>';
        if (!empty($id)) {
            $gridbox = $model->getGridbox();
            $str .= '<li><span><i class="zmdi zmdi-folder"></i>Gridbox';
            $str .= '</span><i class="zmdi zmdi-chevron-right"></i><ul>';
            $str .= $this->getGridboxHtml($gridbox);
            $str .= '</ul></li>';
        }
        $str .= '<li><span><i class="zmdi zmdi-folder"></i>'.JText::_('MENU');
        $str .= '</span><i class="zmdi zmdi-chevron-right"></i><ul>';
        $str .= $this->getMenusHtml($menus).'</ul></li>';

        $str .= '<li><span><i class="zmdi zmdi-folder"></i>'.JText::_('ARTICLES');
        $str .= '</span><i class="zmdi zmdi-chevron-right"></i><ul>';
        $str .= $this->getAriclesHtml($articles).'</ul></li>';

        $str .= '</ul>';
        echo $str;
        exit;
    }

    public function getGridboxHtml($obj)
    {
        $str = '';
        foreach ($obj as $value) {
            $str .= '<li';
            if (isset($value->link)) {
                $str .= ' data-url="'.$value->link.'"';
            }
            $str .= '><span><i class="zmdi zmdi-folder"></i>'.$value->title.'</span>';
            if (!empty($value->childs) || !empty($value->pages)) {
                $str .= '<i class="zmdi zmdi-chevron-right"></i><ul>';
                if (!empty($value->childs)) {
                    $str .= $this->getCategoriesHtml($value->childs);
                }
                if (isset($value->pages)) {
                    $str .= $this->getPagesHtml($value->pages);
                }
                $str .= '</ul>';
            }
            $str .= '</li>';
        }

        return $str;
    }

    public function getPagesHtml($obj)
    {
        $str = '';
        foreach ($obj as $value) {
            $str .= '<li';
            $str .= ' data-url="'.$value->link.'"';
            $str .= '><span><i class="zmdi zmdi-file"></i>'.$value->title.'</span>';
            $str .= '</li>';
        }

        return $str;
    }

    public function getCategoriesHtml($obj)
    {
        $str = '';
        foreach ($obj as $value) {
            $str .= '<li';
            $str .= ' data-url="'.$value->link.'"';
            $str .= '><span><i class="zmdi zmdi-folder"></i>'.$value->title.'</span>';
            if (!empty($value->childs) || !empty($value->pages)) {
                $str .= '<i class="zmdi zmdi-chevron-right"></i><ul>';
                $str .= $this->getCategoriesHtml($value->childs);
                $str .= $this->getPagesHtml($value->pages);
                $str .= '</ul>';
            }
            $str .= '</li>';
        }

        return $str;
    }

    public function getAriclesHtml($obj)
    {
        $str = '';
        foreach ($obj as $value) {
            $str .= '<li';
            $str .= ' data-url="index.php?option=com_content&view=article&id='.$value->id.'"';
            $str .= '><span><i class="zmdi zmdi-file"></i>'.$value->title.'</span>';
            $str .= '</li>';
        }

        return $str;
    }

    public function getMenusHtml($obj)
    {
        $str = '';
        foreach ($obj as $value) {
            $str .= '<li';
            if (isset($value->id) && !empty($value->link)) {
                $str .= ' data-url="'.$value->link.'&Itemid='.$value->id.'"';
            }
            $str .= '><span><i class="zmdi zmdi-';
            if (!empty($value->childs)) {
                $str .= 'folder';
            } else {
                $str .= 'file';
            }
            $str .= '"></i>'.$value->title.'</span>';
            if (!empty($value->childs)) {
                $str .= '<i class="zmdi zmdi-chevron-right"></i><ul>';
                $str .= $this->getMenusHtml($value->childs);
                $str .= '</ul>';
            }
            $str .= '</li>';
        }

        return $str;
    }

    public function setPagLimit()
    {
        $key = $_POST['key'];
        $value = $_POST['value'];
        setcookie($key, $value, time()+31104000);
        exit;
    }

    public function checkProductTour()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`, `id`')
            ->from('`#__bagallery_api`')
            ->where('`service` = '.$db->Quote('product_tour'));
        $db->setQuery($query);
        $result = $db->loadObject();
        if ($result->key == 'false') {
            $obj = new stdClass();
            $obj->id = $result->id;
            $obj->key = 'true';
            JFactory::getDbo()->updateObject('#__bagallery_api', $obj, 'id');
        }
        echo $result->key;
        exit;
    }

    public function checkRate()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('`key`, `id`')
            ->from('`#__bagallery_api`')
            ->where('`service` = '.$db->Quote('rate_gallery'));
        $db->setQuery($query);
        $result = $db->loadObject();
        if (empty($result)) {
            $result = 'false';
            $query = $db->getQuery(true);
            $obj = new stdClass();
            $obj->service = 'rate_gallery';
            $obj->key = strtotime('+3 days');
            $db->insertObject('#__bagallery_api', $obj);
        } else if ($result->key != 'false') {
            $now = strtotime(date('Y-m-d G:i:s'));
            if ($now - $result->key >= 0) {
                $obj = new stdClass();
                $obj->id = $result->id;
                $obj->key = 'false';
                JFactory::getDbo()->updateObject('#__bagallery_api', $obj, 'id');
                $result = 'true';
            } else {
                $result = 'false';
            }
        } else {
            $result = 'false';
        }
        echo $result;
        exit;
    }

    public function checkFileName($dir, $name)
    {
        $file = $dir.$name;
        if (JFile::exists($file)) {
            $name = rand(0, 10).'-'.$name;
            $name = $this->checkFileName($dir, $name);
        }
        return $name;
    }

    public function formUpload()
    {
        $input = JFactory::getApplication()->input;
        $items = $input->files->get('files', '', 'array');
        $dir = THUMBNAILS_BASE. '/bagallery';
        $contentLength = (int) $_SERVER['CONTENT_LENGTH'];
        $mediaHelper = new JHelperMedia;
        $uploadMaxFileSize = $mediaHelper->toBytes(ini_get('upload_max_filesize'));
        if (!JFolder::exists($dir)) {
            jFolder::create($dir);
        }
        $dir .= '/original/';
        if (!JFolder::exists($dir)) {
            jFolder::create($dir);
        }
        $images = array();
        foreach($items as $item) {
            $flag = true;
            if (($item['error'] == 1) || ($uploadMaxFileSize > 0 && $item['size'] > $uploadMaxFileSize)) {
                $flag = false;
            }
            $ext = strtolower(JFile::getExt($item['name']));
            if (bagalleryHelper::checkExt($ext) && $flag) {
                $name = str_replace('.'.$ext, '', $item['name']);
                $file = bagalleryHelper::replaceFilename($name);
                $file = JFile::makeSafe($file.'.'.$ext);
                $name = str_replace('-', '', $file);
                $name = str_replace($ext, '', $name);
                $name = str_replace('.', '', $name);
                if ($name == '') {
                    $file = date("Y-m-d-H-i-s").'.'.$ext;
                }
                $file = $this->checkFileName($dir, $file);
                if (bagalleryHelper::canComress($ext)) {
                    $file = bagalleryHelper::compressImage($item['tmp_name'], $dir, $file, $ext, false);
                } else {
                    JFile::upload($item['tmp_name'], $dir.$file);
                }
                $pos = strlen(JPATH_ROOT);
                $path = substr($dir, $pos);
                $image = new stdClass;
                $image->name = $file;
                $image->path = $image->url = $path.$file;
                $image->size = filesize(JPATH_ROOT.$image->path);
                $images[] = $image;
            }
        }
        $images = json_encode($images);
?>
    <script type="text/javascript">
        var images = <?php echo $images; ?>;
        window.parent.uploadCallback(images);
    </script>
<?php
    exit();        
    }

    public function uploadAjax()
    {
        $dir = THUMBNAILS_BASE.'/bagallery';
        $file = $_GET['file'];
        $ext = strtolower(JFile::getExt($file));
        $name = str_replace('.'.$ext, '', $file);
        $file = bagalleryHelper::replaceFilename($name);
        $file = JFile::makeSafe($file.'.'.$ext);
        $name = str_replace('-', '', $file);
        $name = str_replace($ext, '', $name);
        $name = str_replace('.', '', $name);
        if ($name == '') {
            $file = date("Y-m-d-H-i-s").'.'.$ext;
        }
        if (!JFolder::exists($dir)) {
            jFolder::create($dir);
        }
        $dir .= '/original/';
        if (!JFolder::exists($dir)) {
            jFolder::create($dir);
        }
        $file = $this->checkFileName($dir, $file);
        if (bagalleryHelper::checkExt($ext)) {
            if (bagalleryHelper::canComress($ext)) {
                $file = bagalleryHelper::compressImage(file_get_contents('php://input'), $dir, $file, $ext);
            } else {
                file_put_contents($dir.$file, file_get_contents('php://input'));
            }
            $pos = strlen(JPATH_ROOT);
            $dir = substr($dir, $pos);
            $image = new stdClass;
            $image->name = $file;
            $image->path = $image->url = $dir.$file;
            $image->size = filesize(JPATH_ROOT.$image->path);
            echo json_encode($image);
        }
        exit;
    }

    public function getSession()
    {
        $session = JFactory::getSession();
        echo new JResponseJson($session->getState());
        exit;
    }

    public function clearOld()
    {
        $itemId = $_POST['gallery_items'];
        $allThumb = $_POST['allThumb'];
        $allCat = $_POST['allCat'];
        $formId = $_POST['ba_id'];
        $itemId = json_decode($itemId);
        $allThumb = json_decode($allThumb);
        $allCat = json_decode($allCat);
        $allThumb = get_object_vars($allThumb);
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("id")
            ->from("#__bagallery_items")
            ->where("form_id=" . $db->Quote($formId));
        $db->setQuery($query);
        $items = $db->loadColumn();
        $model = $this->getModel();
        $params = JComponentHelper::getParams('com_bagallery');
        $file_path = $params->get('file_path', 'images');
        foreach ($items as $id) {
            if (!in_array($id, $itemId)) {
                $query = $db->getQuery(true);
                $thumbnail = $model->getThumbnail($id);
                $dir = JPATH_ROOT.'/'.$file_path.'/'.$thumbnail;
                if (JFile::exists($dir)) {
                    JFile::delete($dir);
                }
                $conditions = array(
                    $db->quoteName('id'). '=' .$id
                );
                $query->delete($db->quoteName('#__bagallery_items'))
                    ->where($conditions);
                $db->setQuery($query)
                    ->execute();
                $query = $db->getQuery(true)
                    ->delete('#__bagallery_tags_map')
                    ->where("image_id = " . $id);
                $db->setQuery($query)
                    ->execute();
                $query = $db->getQuery(true)
                    ->delete('#__bagallery_colors_map')
                    ->where("image_id = " . $id);
                $db->setQuery($query)
                    ->execute();
            }
        }
        $model->clearImageDirectory($formId, $allCat, $allThumb);
        jexit();
    }

    public function checkTag($title)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__bagallery_tags')
            ->where('title = '.$db->quote($title));
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public function saveTags($tags, $id, $gallery)
    {
        $db = JFactory::getDbo();
        $ids = array();
        foreach ($tags as $tag) {
            if (strpos($tag->id, 'new$') === false) {
                $ids[] = $tag->id;
            }
        }
        $query = $db->getQuery(true)
            ->delete('#__bagallery_tags_map')
            ->where('image_id = '.$id);
        if (!empty($ids)) {
            $str = implode(', ', $ids);
            $query->where('tag_id NOT IN ('.$str.')');
        }
        $db->setQuery($query)
            ->execute();
        foreach ($tags as $tag) {
            $tagId = $tag->id;
            if (strpos($tagId, 'new$') !== false) {
                $tagId = $this->checkTag($tag->title);
                if (empty($tagId)) {
                    $object = new stdClass();
                    $object->title = $tag->title;
                    $object->alias = $object->title;
                    $object->alias = bagalleryHelper::getAlias($object->alias, '#__bagallery_tags', 'alias');
                    $db->insertObject('#__bagallery_tags', $object);
                    $tagId = $db->insertid();
                }
            }
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__bagallery_tags_map')
                ->where('`image_id` = '.$id)
                ->where('`tag_id` = '.$tagId);
            $db->setQuery($query);
            $item = $db->loadResult();
            if (empty($item)) {
                $obj = new stdClass();
                $obj->image_id = $id;
                $obj->tag_id = $tagId;
                $obj->gallery_id = $gallery;
                $db->insertObject('#__bagallery_tags_map', $obj);
            }
            $tag->id = $tagId;
        }

        return $tags;
    }

    public function checkColor($title)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__bagallery_colors')
            ->where('title = '.$db->quote($title));
        $db->setQuery($query);
        $id = $db->loadResult();

        return $id;
    }

    public function saveColors($colors, $id, $gallery)
    {
        $db = JFactory::getDbo();
        $ids = array();
        foreach ($colors as $color) {
            if (strpos($color->id, 'new$') === false) {
                $ids[] = $color->id;
            }
        }
        $query = $db->getQuery(true)
            ->delete('#__bagallery_colors_map')
            ->where('image_id = '.$id);
        if (!empty($ids)) {
            $str = implode(', ', $ids);
            $query->where('color_id NOT IN ('.$str.')');
        }
        $db->setQuery($query)
            ->execute();
        foreach ($colors as $color) {
            $colorId = $color->id;
            if (strpos($colorId, 'new$') !== false) {
                $colorId = $this->checkColor($color->title);
                if (empty($colorId)) {
                    $object = new stdClass();
                    $object->title = $color->title;
                    $object->alias = $object->title;
                    $object->alias = bagalleryHelper::getAlias($object->alias, '#__bagallery_colors', 'alias');
                    $db->insertObject('#__bagallery_colors', $object);
                    $colorId = $db->insertid();
                }
            }
            $query = $db->getQuery(true)
                ->select('id')
                ->from('#__bagallery_colors_map')
                ->where('`image_id` = '.$id)
                ->where('`color_id` = '.$colorId);
            $db->setQuery($query);
            $item = $db->loadResult();
            if (empty($item)) {
                $obj = new stdClass();
                $obj->image_id = $id;
                $obj->color_id = $colorId;
                $obj->gallery_id = $gallery;
                $db->insertObject('#__bagallery_colors_map', $obj);
            }
            $color->id = $colorId;
        }

        return $colors;
    }

    public function saveItems()
    {
        $data = $_POST;
        $formId = $data['ba_id'];
        $items = $data['gallery_items'];
        $items = json_decode($items);
        $model = $this->getModel();
        $db = JFactory::getDbo();
        $id = array();
        foreach ($items as $item) {
            $obj = $item;
            $obj = $model->checkObj($obj);
            $obj->path = bagalleryHelper::replaceLongPath($obj->path);
            $obj->url = bagalleryHelper::replaceLongPath($obj->url);
            if (empty($obj->lightboxUrl)) {
                $obj->lightboxUrl = $obj->title;
            }
            if (isset($obj->tags)) {
                $tags = $obj->tags;
                unset($obj->tags);
            } else {
                $tags = array();
            }
            if (isset($obj->colors)) {
                $colors = $obj->colors;
                unset($obj->colors);
            } else {
                $colors = array();
            }
            $object = new stdClass();
            $object->form_id = $formId;
            $object->category = $obj->category;
            $object->name = $obj->name;
            $object->path = $obj->path;
            $object->url = $obj->url;
            $object->thumbnail_url = $obj->thumbnail_url;
            $object->title = $obj->title;
            $object->short = $obj->short;
            $object->alt = $obj->alt;
            $object->description = $obj->description;
            $object->link = $obj->link;
            $object->video = $obj->video;
            $object->settings = $item;
            $object->imageId = $obj->imageId;
            $object->target = $obj->target;
            $object->watermark_name = $obj->watermark_name;
            $object->lightboxUrl = $obj->lightboxUrl;
            $object->hideInAll = $obj->hideInAll;
            if (!isset($obj->id)) {
                if (!empty($obj->lightboxUrl)) {
                    $object->lightboxUrl = bagalleryHelper::getAlias($obj->lightboxUrl, '#__bagallery_items', 'lightboxUrl');
                    $obj->lightboxUrl = $object->lightboxUrl;
                }
                $object->settings = '{}';
                $db->insertObject('#__bagallery_items', $object);
                $object->id = $obj->id = $db->insertid();
                $id[] = $object->id;
            } else {
                if (!empty($obj->lightboxUrl)) {
                    $obj->lightboxUrl = bagalleryHelper::getAlias($obj->lightboxUrl, '#__bagallery_items', 'lightboxUrl', $obj->id);
                    $object->lightboxUrl = $obj->lightboxUrl;
                }
                $object->id = $obj->id;
            }
            $obj->tags = $this->saveTags($tags, $obj->id, $formId);
            $obj->colors = $this->saveColors($colors, $obj->id, $formId);
            $object->settings = json_encode($obj);
            $db->updateObject('#__bagallery_items', $object, 'id');
        }
        $id = json_encode($id);
        echo new JResponseJson(true, $id);
        jexit();
    }

    public function emptyAlbums()
    {
        $id = $_POST['ba_id'];
        if (!empty($id)) {
            $dir = THUMBNAILS_BASE. '/bagallery/gallery-' .$id. '/album';
            if (jFolder::exists($dir)) {
                bagalleryHelper::deleteFolder($dir);
            }
        }
    }

    public function emptyThumbnails()
    {
        $id = $_POST['ba_id'];
        if (!empty($id)) {
            $dir = THUMBNAILS_BASE. '/bagallery/gallery-' .$id. '/thumbnail';
            if (jFolder::exists($dir)) {
                bagalleryHelper::deleteFolder($dir);
            }
        }
    }

    public function removeWatermark()
    {
        $id = $_POST['ba_id'];
        if (!empty($id)) {
            $dir = THUMBNAILS_BASE. '/bagallery/gallery-'.$id.'/watermark';
            if (jFolder::exists($dir)) {
                bagalleryHelper::deleteFolder($dir);
            }
            $dir = THUMBNAILS_BASE. '/bagallery/gallery-'.$id.'/compression';
            if (jFolder::exists($dir)) {
                bagalleryHelper::deleteFolder($dir);
            }
        }
    }

    public function removeCompression()
    {
        $id = $_POST['ba_id'];
        if (!empty($id)) {
            $dir = THUMBNAILS_BASE. '/bagallery/gallery-'.$id.'/compression';
            if (jFolder::exists($dir)) {
                bagalleryHelper::deleteFolder($dir);
            }
        }
    }
}