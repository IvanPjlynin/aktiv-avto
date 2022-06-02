<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Registry\Registry;
use Joomla\CMS\Language\Language;
use Joomla\CMS\Language\LanguageHelper;
use Joomla\CMS\Form\FormField;

/**
 * Form Field class for the Joomla Platform.
 * Supports a one line text field.
 *
 * @link   http://www.w3.org/TR/html-markup/input.text.html#input.text
 * @since  11.1
 */
class JFormFieldLangLinks extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'LangLinks';

	/**
	 * Name of the layout being used to render the field
	 *
	 * @var    string
	 * @since  3.7
	 */
	protected $layout = 'joomla.form.field.langlinks';


	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the `<field>` tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 * @since   3.2
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$result = parent::setup($element, $value, $group);

		if ($result == true)
		{
		
		}

		return $result;
	}

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		
		$default='';
		
		if(is_string($this->value)) {
			$default = $this->value;
			$this->value=explode('|',$this->value);
		}
		
		$values = new Registry($this->value);
		
		$languages	= LanguageHelper::getLanguages();

		$output = array();

		foreach($languages as $lang) {

			$value = $values->get($lang->lang_code,$default);
			$output[]='<div class="input-append" style="margin-bottom: 2px;"><input class="form-control" type="text" id="'.$this->id.'_'.$lang->lang_code.'" name="'.$this->name.'['.$lang->lang_code.']'.'" placeholder="..." value="'.$value.'" /><span class="add-on">'.JText::_($lang->title).'</span></div><br />';

		}
		
		$output='<div id="'.$this->id.'">'.implode("\n",$output).'</div>';
		
		return $output;
		
	}


}
