<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ();

JFormHelper::loadFieldClass ( 'Exclude' );
class JFormFieldRemovejsfiles extends JFormFieldExclude {
	public $type = 'removejsfiles';
	public $filetype = 'js';
	public $filegroup = 'file';
}
