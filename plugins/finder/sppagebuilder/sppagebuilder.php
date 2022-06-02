<?php
/**
 * @package     SP Page Builder Plugins
 * @subpackage  Finder.Sppagebuilder
 *
 * @copyright   Copyright (C) 2018 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;

defined('_JEXEC') or die;

JLoader::register('FinderIndexerAdapter', JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php');

if(!class_exists('SppagebuilderHelperSite'))
{
	require_once JPATH_ROOT . '/components/com_sppagebuilder/helpers/helper.php';
}

/**
 * Plugin class for Page Builder smart search finder plugin
 */
class PlgFinderSppagebuilder extends FinderIndexerAdapter
{
	/**
	 * The plugin context.
	 *
	 * @var		string	$context	The context.
	 * @since	1.0.0
	 */
	protected $context = 'Sppagebuilder';

	/**
	 * The extension name.
	 *
	 * @var		string	$extension	The extension name
	 * @since	1.0.0
	 */
	protected $extension = 'com_sppagebuilder';

	/**
	 * The sub layout to use when rendering the results.
	 *
	 * @var		string		$layout		The sub layout name.
	 * @since	1.0.0
	 */
	protected $layout = 'page';

	/**
	 * The type of content that the adapter indexes.
	 *
	 * @var		string		$type_title		The indexing type
	 * @since	1.0.0
	 */
	protected $type_title = 'Page';

	/**
	 * The table name.
	 *
	 * @var		string		$table	The page builder table name.
	 */
	protected $table = '#__sppagebuilder';

	/**
	 * The field the published state is stored in.
	 *
	 * @var		string		$state_field	The state field name.
	 * @since	1.0.0
	 */
	protected $state_field = 'published';

	/**
	 * Load the language file on instantiation.
	 *
	 * @var		bool	$autoloadLanguage	Auto loading language
	 * @since	1.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Method to remove the link information for items that have been deleted.
	 */
	public function onFinderAfterDelete($context, $table)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			$id = $table->id;
		}
		elseif ($context === 'com_finder.index')
		{
			$id = $table->link_id;
		}
		else
		{
			return true;
		}

		// Remove the items.
		return $this->remove($id);
	}

	/**
	 * Method to determine if the access level of an item changed.
	 */
	public function onFinderAfterSave($context, $row, $isNew)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			if (!$isNew && $this->old_access != $row->access)
			{
				$this->itemAccessChange($row);
			}

			$this->reindex($row->id);
		}

		return true;
	}

	/**
	 * Method to reindex the link information for an item that has been saved.
	 * This event is fired before the data is actually saved so we are going
	 * to queue the item to be indexed later.
	 */
	public function onFinderBeforeSave($context, $row, $isNew)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			if (!$isNew)
			{
				$this->checkItemAccess($row);
			}
		}

		return true;
	}

	/**
	 * Method to update the link information for items that have been changed
	 * from outside the edit screen. This is fired when the item is published,
	 * unpublished, archived, or unarchived from the list view.
	 */
	public function onFinderChangeState($context, $pks, $value)
	{
		if ($context === 'com_sppagebuilder.page')
		{
			$this->itemStateChange($pks, $value);
		}

		if ($context === 'com_plugins.plugin' && $value === 0)
		{
			$this->pluginDisable($pks);
		}
	}

	/**
	 * Method to index an item. The item must be a FinderIndexerResult object.
	 */
	protected function index(FinderIndexerResult $item, $format = 'html')
	{
		$item->setLanguage();

		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) === false)
		{
			return;
		}

		// Set the item context
		$item->context = 'com_sppagebuilder.page';

		$menuItem = self::getActiveMenu($item->id);

		// Set the summary and the body from page builder settings object.
		$item->summary = SppagebuilderHelperSite::getPrettyText($item->body);
		$item->body = SppagebuilderHelperSite::getPrettyText($item->body);

		$item->url = $this->getUrl($item->id, $this->extension, $this->layout);
		$link = 'index.php?option=com_sppagebuilder&view=page&id=' . $item->id;

		if ($item->language && $item->language !== '*' && Multilanguage::isEnabled())
		{
			$link .= '&lang=' . $item->language;
		}

		if (isset($menuItem->id) && $menuItem->id)
		{
			$link .= '&Itemid=' . $menuItem->id;
		}

		$item->route = $link;
		$item->path = $item->route;

		if (isset($menuItem->title) && $menuItem->title)
		{
			$item->title = $menuItem->title;
		}

		// Handle the page author data.
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'user');

		// Add the type taxonomy data.
		$item->addTaxonomy('Type', 'Page');

		// Add the language taxonomy data.
		$item->addTaxonomy('Language', $item->language);

		// Index the item.
		$this->indexer->index($item);
	}

	/**
	 * Method to setup the indexer to be run.
	 */
	protected function setup()
	{
		JLoader::register('SppagebuilderRouter', JPATH_SITE . '/components/com_sppagebuilder/route.php');

		return true;
	}

	/**
	 * Method to get the SQL query used to retrieve the list of page items.
	 */
	protected function getListQuery($query = null)
	{
		$db = Factory::getDbo();

		// Check if we can use the supplied SQL query.
		$query = $query instanceof JDatabaseQuery ? $query : $db->getQuery(true)
			->select('a.id, a.view_id, a.title AS title, a.text AS body, a.created_on AS start_date')
			->select('a.created_by, a.modified, a.modified_by, a.language')
			->select('a.access, a.catid, a.extension, a.extension_view, a.published AS state, a.ordering')

			->select('u.name')
			->from('#__sppagebuilder AS a')
			->join('LEFT', '#__users AS u ON u.id = a.created_by')
			->where($db->quoteName('a.extension') . ' = '  . $db->quote('com_sppagebuilder'));


		return $query;
	}

	public static function getActiveMenu($pageId) {
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('title, id'));
		$query->from($db->quoteName('#__menu'));
		$query->where($db->quoteName('link') . ' LIKE '. $db->quote('%option=com_sppagebuilder&view=page&id='. $pageId .'%'));
		$query->where($db->quoteName('published') . ' = '. $db->quote('1'));
		$db->setQuery($query);
		$item = $db->loadObject();

		return $item;
	}
}
