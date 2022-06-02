<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

class SppagebuilderControllerIntegrations extends BaseController
{
	// Toggle integration
	public function toggle($type = '')
	{
		$report = array();
		$user   = Factory::getUser();
		$input  = Factory::getApplication()->input;
		$model  = $this->getModel('integrations');

		// Return if not authorised
		if (!$user->authorise('core.admin', 'com_sppagebuilder'))
		{
			$report['message'] = Text::_('JERROR_ALERTNOAUTHOR');
			$report['success'] = false;
			die(json_encode($report));
		}

		$group = $input->get('group', '', 'STRING');
		$name  = $input->get('name', '', 'STRING');

		$result = $model->toggle($group, $name);

		$report['result']  = $result;
		$report['success'] = true;

		die(json_encode($report));
	}
}
