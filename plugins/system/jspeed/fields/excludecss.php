<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();
use Joomla\CMS\Form\FormHelper;

FormHelper::loadFieldClass ( 'Exclude' );
class JFormFieldExcludecss extends JFormFieldExclude {
	public $type = 'excludecss';
	public $filetype = 'css';
	public $filegroup = 'file';

	/**
	 *
	 * @return type
	 */
	protected function getInput() {
		$this->first_field = true;

		return parent::getInput ();
	}
}
