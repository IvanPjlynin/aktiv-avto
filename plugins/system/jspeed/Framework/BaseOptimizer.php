<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class BaseOptimizer extends RegexConstants {
	protected $_debug = false;
	protected $_regexNum = - 1;
	protected $_limit = 0;

	/**
	 *
	 * @param type $rx
	 * @param type $code
	 * @param type $regexNum
	 * @return boolean
	 */
	protected function _debug($rx, $code, $regexNum = 0) {
		if (! $this->_debug)
			return false;

		static $pstamp = 0;

		if ($pstamp === 0) {
			$pstamp = microtime ( true );
			return;
		}

		$nstamp = microtime ( true );
		$time = $nstamp - $pstamp;

		if ($time > $this->_limit) {
			print 'num=' . $regexNum . "\n";
			print 'time=' . $time . "\n\n";
		}

		if ($regexNum == $this->_regexNum) {
			print $rx . "\n";
			print $code . "\n\n";
		}

		$pstamp = $nstamp;
	}

	/**
	 *
	 * @staticvar type $tm
	 * @param type $rx
	 * @param type $code
	 * @param type $replacement
	 * @param type $regex_num
	 * @return type
	 */
	protected function _replace($rx, $replacement, $code, $regex_num, $callback = null) {
		static $tm = false;

		if ($tm === false) {
			$this->_debug ( '', '' );
			$tm = true;
		}

		if (empty ( $callback )) {
			$op_code = preg_replace ( $rx, $replacement, $code );
		} else {
			$op_code = preg_replace_callback ( $rx, $callback, $code );
		}

		$this->_debug ( $rx, $code, $regex_num );
		$error = @array_flip ( get_defined_constants ( true ) ['pcre'] ) [preg_last_error ()];
		if (preg_last_error () != PREG_NO_ERROR) {
			throw new \Exception ( $error );
		}

		return $op_code;
	}
}
