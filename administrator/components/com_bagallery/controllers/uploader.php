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

class BagalleryControllerUploader extends JControllerForm
{
    public function executeAction()
    {
        $action = $this->input->get('action', '', 'string');
        $path = $this->input->get('path', '', 'raw');
        $model = $this->getModel();
        $uploader = $model->getUploader($path);
        $response = call_user_func(array($uploader, $action));
        $str = json_encode($response);
        print_r($str);exit();
    }

    public function regenerateThumbnails()
    {
        $id = $this->input->get('id', 0, 'int');
        $dir = THUMBNAILS_BASE.'/bagallery/gallery-'.$id.'/thumbnail';
        if (JFolder::exists($dir)) {
            bagalleryHelper::deleteFolder($dir);
        }
        $dir = THUMBNAILS_BASE.'/bagallery/gallery-'.$id.'/album';
        if (JFolder::exists($dir)) {
            bagalleryHelper::deleteFolder($dir);
        }
        exit();
    }

    public function checkOriginalFolder()
    {
        $dir = THUMBNAILS_BASE.'/bagallery';
        if (!JFolder::exists($dir)) {
            jFolder::create($dir);
        }
        $dir .= '/original';
        if (!JFolder::exists($dir)) {
            jFolder::create($dir);
        }
    }

    public function getVideoImage()
    {
        $id = $this->input->get('id', '', 'string');
        $type = $this->input->get('type', '', 'string');
        $model = $this->getModel();
        $this->checkOriginalFolder();
        $path = bagalleryHelper::$params->file_path.'/bagallery/original';
        $uploader = $model->getUploader($path);
        $response = $uploader->uploadVideoImage();
        $str = json_encode($response);
        print_r($str);
        exit;
    }

    public function uploadOriginal()
    {
        $this->checkOriginalFolder();
        $path = bagalleryHelper::$params->file_path.'/bagallery/original';
        $model = $this->getModel();
        $uploader = $model->getUploader($path);
        $response = $uploader->uploadFile();
        $str = json_encode($response);
        print_r($str);exit();
    }

    public function checkFileExists()
    {
        $content = file_get_contents('php://input');
        $obj = json_decode($content);
        $name = $obj->title;
        $file = bagalleryHelper::replace($name);
        $file = JFile::makeSafe($file.'.'.$obj->ext);
        $name = str_replace('-', '', $file);
        $name = str_replace($obj->ext, '', $name);
        $name = str_replace('.', '', $name);
        if ($name == '') {
            $file = date("Y-m-d-H-i-s").'.'.$obj->ext;
        }
        $obj->path = str_replace($obj->name, '', $obj->path).$file;
        echo JFile::exists(JPATH_ROOT.$obj->path);exit;
    }

    public function savePhotoEditorImage()
    {
        $content = file_get_contents('php://input');
        $obj = json_decode($content);
        if (isset($obj->title) && !empty($obj->title)) {
            $name = $obj->title;
            $file = bagalleryHelper::replace($name);
            $file = JFile::makeSafe($file.'.'.$obj->ext);
            $name = str_replace('-', '', $file);
            $name = str_replace($obj->ext, '', $name);
            $name = str_replace('.', '', $name);
            if ($name == '') {
                $file = date("Y-m-d-H-i-s").'.'.$obj->ext;
            }
            $obj->path = str_replace($obj->name, '', $obj->path).$file;
        }
        if (strpos($obj->path, '/') != 0) {
            $obj->path = '/'.$obj->path;
        }
        $data = explode(',', $obj->image);
        $method = $obj->method;
        $str = $method($data[1]);
        if ($obj->ext == 'png') {
            $imageSave = bagalleryHelper::imageSave($obj->ext);
            $imageCreate = bagalleryHelper::imageCreate($obj->ext);
            $img = imagecreatefromstring($str);
            $width = imagesx($img);
            $height = imagesy($img);
            $out = imagecreatetruecolor($width, $height);
            imagealphablending($out, false);
            imagesavealpha($out, true);
            $transparent = imagecolorallocatealpha($out, 255, 255, 255, 127);
            imagefilledrectangle($out, 0, 0, $width, $height, $transparent);          
            imagecopyresampled($out, $img, 0, 0, 0, 0, $width, $height, $width, $height);
            $imageSave($out, JPATH_ROOT.$obj->path, 9);
        } else {
            JFile::write(JPATH_ROOT.$obj->path, $str);
        }
        echo JPATH_ROOT.$obj->path;
        exit();
    }

    public function showImage()
    {
        $dir = urldecode($_GET['image']);
        $dir = JPATH_ROOT.'/'.$dir;
        $ext = strtolower(JFile::getExt($dir));
        $imageCreate = bagalleryHelper::imageCreate($ext);
        $imageSave = bagalleryHelper::imageSave($ext);
        header("Content-type: image/".$ext);
        $offset = 60 * 60 * 24 * 90;
        $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
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
}