<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\HTML\HTMLHelper;

FormHelper::loadFieldClass ( 'Exclude' );
class JFormFieldExcludefiles extends JFormFieldExclude {
	public $type = 'excludefiles';
	
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
	 * @since   3.2
	 */
	public function setup(SimpleXMLElement $element, $value, $group = null) {
		$return = parent::setup($element, $value, $group);
		
		if ($return) {
			$this->options = isset($this->element->option) ? $this->element->option : array();
		}
		
		return $return;
	}
	
	/**
	 *
	 * @return type
	 */
	protected function getInput() {
		$attributes = 'class="select2-dropdown inputbox input-xlarge" multiple="multiple" data-no_results_text="Add custom item" data-paramtype="' . $this->filetype . '" data-paramname="' . $this->fieldname . '" data-filegroup="' . $this->filegroup . '"';
		$options = array ();
		
		foreach ( $this->options as $option ) {
			$arrayKey = strtolower((string)$option);
			$options [$arrayKey] = HTMLHelper::_('select.option', $arrayKey, $arrayKey);
		}
		
		foreach ( $this->value as $excludevalue ) {
			$arrayKey = strtolower($excludevalue);
			if(!array_key_exists($arrayKey, $options)) {
				$options [$arrayKey] = HTMLHelper::_('select.option', $arrayKey, $arrayKey);
			}
		}
		
		$select = HTMLHelper::_ ( 'select.genericlist', $options, 'jform[params][' . $this->fieldname . '][]', $attributes, 'value', 'text', $this->value, $this->id );
		
		$field = '<div id="div-' . $this->fieldname . '"> <img class="dropdown-loading" src="' . Uri::root ( true ) . '/media/plg_jspeed/images/loading.gif" alt="Loading..."/>' . $select . ' </div>';
		
		return $field;
	}
}
