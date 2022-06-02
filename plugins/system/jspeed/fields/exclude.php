<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Form\Field\TextareaField;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use JSpeed\Plugin;
use JSpeed\Helper;
use JSpeed\Admin;

include_once dirname ( dirname ( __FILE__ ) ) . '/Framework/loader.php';

Plugin::getPluginParams ();
abstract class JSpeedTextarea extends TextareaField {
	protected $aOptions = array ();
	public function setup(SimpleXMLElement $element, $value, $group = NULL) {
		$value = $this->castValue ( $value );

		return parent::setup ( $element, $value, $group );
	}
	protected function castValue($value) {
	}
}
abstract class JFormFieldExclude extends JSpeedTextarea {
	protected static $oParams = null;
	protected static $oParser = null;
	protected $ajax_params = '';
	protected $first_field = false;
	protected $filegroup = 'file';

	/**
	 *
	 * @param type $value
	 * @return type
	 */
	protected function castValue($value) {
		if (! is_array ( $value )) {
			$value = Helper::getArray ( $value );
		}

		return $value;
	}

	/**
	 *
	 * @return type
	 */
	protected function setOptions() {
		$this->aOptions = $this->getFieldOptions ();
	}

	/**
	 *
	 * @param type $sType
	 * @param type $sParam
	 * @param type $sGroup
	 */
	protected function setAjaxParams() {
		$this->ajax_params = '"type": "' . $this->filetype . '", "param": "' . $this->fieldname . '", "group": "' . $this->filegroup . '"';
	}

	/**
	 *
	 * @return type
	 */
	protected function getInput() {
		$attributes = 'class="select2-dropdown inputbox input-xlarge" multiple="multiple" data-no_results_text="Add custom item" data-paramtype="' . $this->filetype . '" data-paramname="' . $this->fieldname . '" data-filegroup="' . $this->filegroup . '"';
		$options = array ();

		foreach ( $this->value as $excludevalue ) {
			$options [$excludevalue] = Admin::{'prepare' . ucfirst ( $this->filegroup ) . 'Values'} ( $excludevalue );
		}

		$select = HTMLHelper::_ ( 'select.genericlist', $options, 'jform[params][' . $this->fieldname . '][]', $attributes, 'value', 'text', $this->value, $this->id );

		$field = '<div id="div-' . $this->fieldname . '"> <img class="dropdown-loading" src="' . Uri::root ( true ) . '/media/plg_jspeed/images/loading.gif" alt="Loading..."/>' . $select . ' </div>';

		return $field;
	}
}
