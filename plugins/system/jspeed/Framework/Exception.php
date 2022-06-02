<?php
namespace JSpeed;
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
abstract class Exception extends \Exception {
	private $trace;
	private $string;
	protected $message = 'Unknown exception';
	protected $code = 0;
	protected $file;
	protected $line;
	public function __construct($message = null, $code = 0) {
		if (! $message) {
			throw new $this ( 'Unknown ' . get_class ( $this ) );
		}
		parent::__construct ( $message, $code );
	}
	public function __toString() {
		return get_class ( $this ) . " '{$this->message}' in {$this->file}({$this->line})\n" . "{$this->getTraceAsString()}";
	}
}