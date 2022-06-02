<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'No direct access' );
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Form Field for access levels
 * @package JSPEED::plugins::system
 * @subpackage fields
 */
class JFormFieldJSpeedaccesslevel extends ListField {
	/**
	 * The form field type.
	 *
	 * @var string
	 */
	protected $type = 'JSpeedaccesslevel';
	
	/**
	 * Method to get the field input markup for a generic list.
	 * Use the multiple attribute to enable multiselect.
	 *
	 * @return string The field input markup.
	 */
	protected function getInput() {
		$attr = '';
		
		// Initialize some field attributes.
		$attr .= ! empty ( $this->class ) ? ' class="' . $this->class . '"' : '';
		$attr .= $this->disabled ? ' disabled' : '';
		$attr .= ! empty ( $this->size ) ? ' size="' . $this->size . '"' : '';
		$attr .= $this->multiple ? ' multiple' : '';
		$attr .= $this->required ? ' required aria-required="true"' : '';
		$attr .= $this->autofocus ? ' autofocus' : '';
		
		// Initialize JavaScript field attributes.
		$attr .= $this->onchange ? ' onchange="' . $this->onchange . '"' : '';
		
		// Get the field options.
		$options = $this->getOptions ();
		
		return HTMLHelper::_ ( 'select.genericlist', $options, $this->name, trim ( $attr ), 'value', 'text', $this->value, $this->id );
	}
	
	/**
	 * Displays a list of the available access view levels
	 *
	 * @return  array  The field option objects.
	 */
	protected function getOptions() {
		$db = Factory::getContainer()->get('DatabaseDriver');
		
		// Select all access levels but Public and Guest
		$query = $db->getQuery(true)
					->select('a.id AS value, a.title AS text')
					->from('#__viewlevels AS a')
					->where('a.id NOT IN(1,5)')
					->group('a.id, a.title, a.ordering')
					->order($db->quoteName('title') . ' ASC');
			
			// Get the options.
		$db->setQuery ( $query );
		$options = $db->loadObjectList ();
		
		array_unshift ( $options, HTMLHelper::_ ( 'select.option', '0', Text::_ ( 'PLG_JSPEED_NO_EXCLUSION' ) ) );
		
		return $options;
	}
}