<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;


class PlgButtonBagallery extends JPlugin
{
    public function onDisplay($name)
    {
        $js = "
            function SelectGallery(id) {
                if ('jInsertEditorText' in window) {
                    jInsertEditorText('[gallery ID='+id+']', '".$name."');
                    SqueezeBox.close();
                    jModalClose();
                } else {
                    for (var ind in Joomla.editors.instances) {
                        Joomla.editors.instances[ind].replaceSelection('[gallery ID='+id+']', '".$name."');
                        break;
                    }
                    if (window.jQuery) {
                        jQuery(Joomla.currentModal).modal('hide');
                    }
                }
                if (window.Joomla.Modal) {
                    window.parent.Joomla.Modal.getCurrent().close();
                }
            }";


        $doc = JFactory::getDocument();
        $doc->addScriptDeclaration($js);
        $link = 'index.php?option=com_bagallery&amp;view=galleries&amp;layout=modal&amp;tmpl=component';
        $button = new JObject;
        $button->modal = true;
        $button->class = 'btn';
        $button->link = $link;
        $button->text = 'Gallery';
        $button->name = 'picture';
        $button->options = "{handler: 'iframe', size: {x: 740, y: 545}}";
        $button->icon = 'picture';
        $button->iconSVG = '<svg width="24" height="24" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9c0 .013 0 .027.002.04V12l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15 9.499V3.5a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm4.502 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg>';

        return $button;
    }
}
