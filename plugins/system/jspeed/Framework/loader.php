<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
if (! defined ( '_JEXEC' )) {
	define ( '_JEXEC', '1' );
}

defined ( '_JEXEC' ) or die ( 'Restricted access' );
function JSpeedAutoLoader($sClass) {
	if (is_array ( $sClass )) {
		foreach ( $sClass as $class ) {
			JSpeedAutoLoader( $class );
		}
	} else {
		$class = $sClass;
	}

	$prefix = substr ( $class, 0, 7 );

	// If the class already exists do nothing.
	if (class_exists ( $class, false )) {
		return true;
	}

	if ($prefix !== 'JSpeed\\') {
		return false;
	} else {
		$class = str_replace ( $prefix, '', $class );
	}

	$class = trim($class, '\\');
	
	$filename = $class;
	$file = dirname ( __FILE__ ) . '/' . $filename . '.php';

	if (! file_exists ( $file )) {
		return false;
	} else {
		include $file;

		if (! class_exists ( $sClass ) && ! interface_exists ( $sClass )) {
			return false;
		}
	}
}

spl_autoload_register ( 'JSpeedAutoLoader', true, true );