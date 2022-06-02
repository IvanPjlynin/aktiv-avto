<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined('_JEXEC') or die ('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

$doc = Factory::getDocument();
$app = Factory::getApplication();
$view = $app->input->get('view', 'pages', 'STRING');

$sidebar_menus = array(
	array(
		'title' => 'COM_SPPAGEBUILDER_PAGES',
		'link' 	=> 'index.php?option=com_sppagebuilder&view=pages',
		'icon' 	=> 'fas fa-list-ul',
		'view'  => "pages"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_MEDIA',
		'link' 	=> 'index.php?option=com_sppagebuilder&view=media',
		'icon' 	=> 'fas fa-image',
		'view'  => "media"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_CATEGORIES',
		'link' 	=> 'index.php?option=com_categories&extension=com_sppagebuilder',
		'icon' 	=> 'fas fa-folder',
		'view'  => "categories"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_INTEGRATIONS',
		'link' 	=> 'index.php?option=com_sppagebuilder&view=integrations',
		'icon' 	=> 'fas fa-plug',
		'view'  => "integrations"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_LANGUAGES',
		'link' 	=> 'index.php?option=com_sppagebuilder&view=languages',
		'icon' 	=> 'fas fa-globe',
		'view'  => "languages"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_MAINTENANCE',
		'link' 	=> 'index.php?option=com_sppagebuilder&view=maintenance',
		'icon' 	=> 'fas fa-tools',
		'view'  => "maintenance"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_ABOUT',
		'link' 	=> 'index.php?option=com_sppagebuilder&view=about',
		'icon' 	=> 'fas fa-info-circle',
		'view'  => "about"
	),
	array(
		'title' => 'COM_SPPAGEBUILDER_DOCUMENTATION',
		'link' 	=> 'https://www.joomshaper.com/documentation/sp-page-builder/sp-page-builder-3',
		'icon' 	=> 'fas fa-book',
		'view'  => "documentation"
	),
);

// Load required javascript
HTMLHelper::_('jquery.framework');
SppagebuilderHelper::addScript('sidebar.js');
?>

<?php if(JVERSION >= 4) : ?>
<div class="d-none" data-joomla-sidebar>
	<li class="item item-level-1">
		<a class="no-dropdown has-arrow" href="javascript:void(0);" data-back-sppagebuilder aria-label="<?php echo Text::_('COM_SPPAGEBUILDER');?>">
			<span class="fas pbfont pbfont-pagebuilder" aria-hidden="true"></span>
			<span class="sidebar-item-title"><?php echo Text::_('COM_SPPAGEBUILDER');?></span>
		</a>
	</li>
</div>
<?php endif; ?>

<div class="<?php echo JVERSION < 4 ? 'sp-pagebuilder-aside' : 'd-none' ?>" data-sidebar>
	<ul class="nav flex-column main-nav sppagebuilder-nav">
		<?php if(JVERSION >= 4) : ?>
		<li class="item item-level-1">
			<a class="no-dropdown" href="javascript:void(0);" data-back-joomla aria-label="<?php echo Text::_('Back');?>">
				<span class="fas fa-chevron-left" aria-hidden="true"></span>
				<span class="sidebar-item-title"><?php echo Text::_('Back'); ?></span>
			</a>
		</li>
		<?php endif; ?>
		<?php foreach ($sidebar_menus as $item) : ?>		
		<li class="item item-sp-pagebuilder-<?php echo $item['view'] ; ?> item-level-1">
			<a class="no-dropdown <?php echo ($item['view'] == $view) ? ' mm-active' : ''; ?>" href="<?php echo Route::_($item['link']); ?>" aria-label="<?php echo Text::_($item['title']); ?>">
				<span class="<?php echo $item['icon']; ?>" aria-hidden="true"></span>
				<span class="sidebar-item-title"><?php echo Text::_($item['title']); ?></span>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
