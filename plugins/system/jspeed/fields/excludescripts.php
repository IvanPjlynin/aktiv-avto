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
class JFormFieldExcludescripts extends JFormFieldExclude {
	public $type = 'excludescripts';
	public $filetype = 'js';
	public $filegroup = 'script';
}
