<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class bagalleryController extends JControllerLegacy
{
    /**
	 * display task
	 *
	 * @return void
	 */
	function display($cachable = false, $urlparams = false) 
	{
        // set default view if not set
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'galleries'));
        
        // call parent behavior
        parent::display($cachable);
    }
}