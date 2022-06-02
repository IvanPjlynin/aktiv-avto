<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

jimport('joomla.application.component.view');

class SppagebuilderViewLanguages extends JViewLegacy {

	protected $items;
	protected $pagination;
	protected $state;

	public function display( $tpl = null ) {
		$this->items = $this->get('Items');

		if(count( $errors = $this->get('Errors'))) {
			JError::raiseError(500,implode('<br />',$errors));
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolBar()
	{
		// Set the title
		ToolbarHelper::title(Text::_('COM_SPPAGEBUILDER') . ' - ' . Text::_('COM_SPPAGEBUILDER_LANGUAGES'), 'none pbfont pbfont-pagebuilder');
	}

}
