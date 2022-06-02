<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

jimport( 'joomla.plugin.plugin' );
jimport('joomla.filesystem.folder');
 
class plgSystemBagallery extends JPlugin
{
    public function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);
    }

    public function onAfterInitialise()
    {
        $app = JFactory::getApplication();
        if ($app->isClient('site')) {
            $path = JPATH_ROOT . '/components/com_bagallery/helpers/bagallery.php';
            $params = JComponentHelper::getParams('com_bagallery');
            JLoader::register('bagalleryHelper', $path);
            bagalleryHelper::prepareParams($params);
            if (isset($_GET['fbclid'])) {
                $url = $_SERVER['REQUEST_URI'];
                $pos = strpos($url, 'fbclid');
                $delimiter = $url[$pos - 1];
                $url = str_replace($delimiter.'fbclid='.$_GET['fbclid'], '', $url);
                header('Location: '.$url);
            }
        }
    }
    
    public function onBeforeCompileHead()
    {
        $app = JFactory::getApplication();
        $loaded = JLoader::getClassList( );
        $doc = JFactory::getDocument();
        if (isset($loaded['bagalleryhelper'])) {
            $option = $app->input->get('option', '', 'string');
            $a_id = $app->input->get('a_id', '', 'string');
            if ($app->isClient('site') && empty($a_id) && $doc->getType() == 'html' && $option != 'com_config') {
                bagalleryHelper::addStyle();
            }
        }
    }

    public function onAfterRender()
    {
        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();
        if ($app->isClient('site') && $doc->getType() == 'html') {
            $this->setGalleries();
        } else if ($app->isClient('administrator') && $doc->getType() == 'html' && JVERSION >= '4.0.0') {
            $html = $app->getBody();
            $html = str_replace('<body', '<body data-joomla-version="4"', $html);
            $app->setBody($html);
        }
    }

    public function onBeforeRenderGridbox()
    {
        $this->setGalleries();
    }

    public function setGalleries()
    {
        $app = JFactory::getApplication();
        $option = $app->input->get('option', '', 'string');
        $a_id = $app->input->get('a_id', '', 'string');
        if (empty($a_id) && $option != 'com_config' && $option != 'com_search' && $option != 'com_finder') {
            $loaded = JLoader::getClassList();
            $view = $app->input->get('view', '', 'string');
            if (isset($loaded['bagalleryhelper']) && !($option == 'com_sppagebuilder' && $view == 'form')) {
                $html = $app->getBody();
                $pos = strpos($html, '</head>');
                $head = substr($html, 0, $pos);
                $body = substr($html, $pos);
                if (strpos($head, 'name="og:') !== false) {
                    $head = str_replace('name="og:', 'property="og:', $head);
                    if (strpos($head, 'prefix="og: http://ogp.me/ns#"') === false) {
                        $head = str_replace('<html', '<html prefix="og: http://ogp.me/ns#" ', $head);
                    }
                }
                $html = $head.$this->getContent($body);
                $app->setBody($html);
            }
        } else if ($option == 'com_search' || $option == 'com_finder') {
            $regex = '/\[gallery ID=+(.*?)\]/i';
            $html = $app->getBody();
            preg_match_all($regex, $html, $matches, PREG_SET_ORDER);
            if ($matches) {
                $html = @preg_replace($regex, '', $html);
                $app->setBody($html);
            }
        }
    }
    
    public function getContent($body)
    {
        $regex = '/\[gallery ID=+(.*?)\]/i';
        $array = array();
        preg_match_all($regex, $body, $matches, PREG_SET_ORDER);
        if ($matches) {
            foreach ($matches as $index => $match) {
                $gallery = explode(',', $match[1]);
                $id = $gallery[0];
                $pos = strpos($id, ' category ID');
                if ($pos !== false) {
                    $id = substr($id, 0, $pos);
                }
                if (isset($id)) {
                    if (bagalleryHelper::checkGallery($id)) {
                        if (!in_array($id, $array)) {
                            $array[] = $id;
                        }
                        $doc = JFactory::getDocument();
                        $gallery = bagalleryHelper::drawHTMLPage($match[1]);
                        $about = bagalleryHelper::aboutUs();
                        $v = $about->version;
                        $url = JURI::root().'components/com_bagallery/assets/js/ba-gallery.js?'.$v;
                        $body = @preg_replace("|\[gallery ID=".$match[1]."\]|", addcslashes($gallery, '\\$'), $body, 1);
                    }
                }
            }
            if (!empty($array)) {
                $body = bagalleryHelper::drawScripts($array).$body;
            }
        }

        return $body;
    }
}

function gallery_sc(){}