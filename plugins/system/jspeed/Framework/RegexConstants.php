<?php
namespace JSpeed;

/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

class RegexConstants {
	// regex for double quoted strings
	const DOUBLE_QUOTE_STRING = '"(?>(?:\\\\.)?[^\\\\"]*+)+?(?:"|(?=$))';
	// regex for single quoted string
	const SINGLE_QUOTE_STRING = "'(?>(?:\\\\.)?[^\\\\']*+)+?(?:'|(?=$))";
	// regex for block comments
	const BLOCK_COMMENT = '/\*(?>[^/\*]++|//|\*(?!/)|(?<!\*)/)*+\*/';
	// regex for line comments
	const LINE_COMMENT = '//[^\r\n]*+';
	// regex for HTML comments
	const HTML_COMMENT = '(?:(?:<!--|(?<=[\s/^])-->)[^\r\n]*+)';
	const HTML_ATTRIBUTE = '[^\s/"\'=<>]*+(?:\s*=(?>\s*+"[^">]*+"|\s*+\'[^\'>]*+\'|[^\s>]*+[\s>]))?';
	const ATTRIBUTE_VALUE = '(?>(?<=")[^">]*+|(?<=\')[^\'>]*+|(?<==)[^\s*+>]*+)';
	const URI = '(?<=url)\(\s*+(?:"[^"]*+"|\'[^\']*+\'|[^)]*+)\s*+\)';
}
