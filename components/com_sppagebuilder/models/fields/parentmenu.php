<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

use Joomla\CMS\Factory;

defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

class JFormFieldParentMenu extends JFormFieldList
{
	protected $type = 'ParentMenu';

	protected function getOptions()
	{
		$options = array();

		$db    = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('DISTINCT(a.id) AS value, a.title AS text, a.level, a.lft')
			->from('#__menu AS a');

		// Filter by menu type.
		if ($menuType = $this->form->getValue('menutype'))
		{
			$query->where('a.menutype = ' . $db->quote($menuType));
		}
		else
		{
			$query->where('a.menutype = ' . $db->quote('mainmenu'));
		}

		// Filter by client id.
		$clientId = $this->getAttribute('clientid');

		if (!is_null($clientId))
		{
			$query->where($db->quoteName('a.client_id') . ' = ' . (int) $clientId);
		}

		// Prevent parenting to children of this item.
		if ($id = $this->form->getValue('id'))
		{
			$query->join('LEFT', $db->quoteName('#__menu') . ' AS p ON p.id = ' . (int) $id)
				->where('NOT(a.lft >= p.lft AND a.rgt <= p.rgt)');
		}

		$query->where('a.published != -2')
			->order('a.lft ASC');

		// Get the options.
		$db->setQuery($query);

		try
		{
			$options = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			$app = Factory::getApplication();
			$app->enqueueMessage($e->getMessage(), 'warning');
			$app->setHeader('status', '500', true);
		}

		// Pad the option text with spaces using depth level as a multiplier.
		for ($i = 0, $n = count($options); $i < $n; $i++)
		{
			if ($clientId != 0)
			{
				// Allow translation of custom admin menus
				$options[$i]->text = str_repeat('- ', $options[$i]->level) . JText::_($options[$i]->text);
			}
			else
			{
				$options[$i]->text = str_repeat('- ', $options[$i]->level) . $options[$i]->text;
			}
		}

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
