<?php
/**
 * @author Joomla! Extensions Store
 * @package JSPEED::plugins::system
 * @copyright (C) 2020 - Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined ( '_JEXEC' ) or die ( 'No direct access' );
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Form Field for menu tree
 * @package JSPEED::plugins::system
 * @subpackage fields
 */
class JFormFieldMenuselection extends ListField {
	/**
	 * Tree recursion menu
	 *
	 * @access private
	 * @param int $id
	 * @param string $indent
	 * @param array $list
	 * @param array $children
	 * @param int $maxlevel
	 * @param int $level
	 * @param int $type
	 * @return array
	 */
	private static function treeRecurse($id, $indent, $list, &$children, $maxlevel = 9999, $level = 0, $type = 1) {
		if (@$children [$id] && $level <= $maxlevel) {
			foreach ( $children [$id] as $v ) {
				$id = $v->id;
				
				if ($type) {
					$pre = '<sup>|_</sup>&nbsp;';
					$spacer = '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				} else {
					$pre = '- ';
					$spacer = '&nbsp;&nbsp;';
				}
				
				if ($v->parent == 0) {
					$txt = $v->name;
				} else {
					$txt = $pre . $v->name;
				}
				$pt = $v->parent;
				$list [$id] = $v;
				$list [$id]->treename = "$indent$txt";
				$list [$id]->children = isset($children [$id]) ? count ( $children [$id] ) : 0;
				$list = self::treeRecurse ( $id, $indent . $spacer, $list, $children, $maxlevel, $level + 1, $type );
			}
		}
		return $list;
	}
	
	/**
	 * Build the multiple select list for Menu Links/Pages
	 *
	 * @access public
	 * @return array
	 */
	protected function getOptions() {
		$db = Factory::getContainer()->get('DatabaseDriver');
		
		// get a list of the menu items
		$query = 'SELECT m.id, m.parent_id AS parent, m.title AS name, m.menutype, t.title' .
				' FROM #__menu AS m' .
				' INNER JOIN #__menu_types AS t' .
				' ON m.menutype = t.menutype' .
				' WHERE m.published = 1' .
				' AND m.client_id = 0' .
				' ORDER BY m.menutype, m.parent_id, m.lft';
		$db->setQuery ( $query );
		$mitems = $db->loadObjectList ();
		$mitems_temp = $mitems;
		
		if(empty($mitems)) {
			return $mitems;
		}
		
		// establish the hierarchy of the menu
		$children = array ();
		// first pass - collect children
		foreach ( $mitems as $v ) {
			$id = $v->id;
			$pt = $v->parent;
			$list = @$children [$pt] ? $children [$pt] : array ();
			array_push ( $list, $v );
			$children [$pt] = $list;
		}
		// second pass - get an indent list of the items
		$list = self::treeRecurse ( intval ( $mitems [0]->parent ), '', array (), $children, 9999, 0, 0 );
		
		// Code that adds menu name to Display of Page(s)
		$mitems_spacer = $mitems_temp [0]->menutype;
		
		$mitems = array ();
		$lastMenuType = null;
		$tmpMenuType = null;
		foreach ( $list as $list_a ) {
			if ($list_a->menutype != $lastMenuType) {
				if ($tmpMenuType) {
					$mitems [] = HTMLHelper::_ ( 'select.option', '</OPTGROUP>' );
				}
				$mitems [] = HTMLHelper::_ ( 'select.option', '<OPTGROUP>', $list_a->title );
				$lastMenuType = $list_a->menutype;
				$tmpMenuType = $list_a->menutype;
			}
			
			$mitems [] = HTMLHelper::_ ( 'select.option', $list_a->id, $list_a->treename );
		}
		if ($lastMenuType !== null) {
			$mitems [] = HTMLHelper::_ ( 'select.option', '</OPTGROUP>' );
		}
		
		$noActiveOption = HTMLHelper::_('select.option', '0', Text::_('PLG_JSPEED_NO_EXCLUSION'));
		array_unshift($mitems, $noActiveOption);
		
		return $mitems;
	}
}