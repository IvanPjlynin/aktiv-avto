<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

require_once ( JPATH_COMPONENT .'/parser/addon-parser.php' );
require_once JPATH_COMPONENT_ADMINISTRATOR . '/builder/classes/addon.php';

$doc = Factory::getDocument();
$user = Factory::getUser();
$app = Factory::getApplication();

$params = ComponentHelper::getParams('com_sppagebuilder');

if ($params->get('fontawesome', 1))
{
	SppagebuilderHelperSite::addStylesheet('font-awesome-5.min.css');
	SppagebuilderHelperSite::addStylesheet('font-awesome-v4-shims.css');
}

if (!$params->get('disableanimatecss', 0))
{
	SppagebuilderHelperSite::addStylesheet('animate.min.css');
}

if (!$params->get('disablecss', 0))
{
	SppagebuilderHelperSite::addStylesheet('sppagebuilder.css');
}

HTMLHelper::_('jquery.framework');

HTMLHelper::_('script', 'components/com_sppagebuilder/assets/js/jquery.parallax.js');
HTMLHelper::_('script', 'components/com_sppagebuilder/assets/js/sppagebuilder.js', [], ['defer' => true]);

$menus = $app->getMenu();
$menu = $menus->getActive();
$menuClassPrefix = '';
$showPageHeading = 0;

// check active menu item
if ($menu)
{
	$menuClassPrefix 	= $menu->getParams()->get('pageclass_sfx');
	$showPageHeading 	= $menu->getParams()->get('show_page_heading');
	$menuHeading 		= $menu->getParams()->get('page_heading');
}

if (!empty($this->item))
{
	$page = $this->item;
	$page->text = SpPageBuilderAddonHelper::__($page->text);
	$content = json_decode($page->text);


// Add page css
if (isset($page->css) && $page->css)
{
	$doc->addStyledeclaration($page->css);
}

// $input = $app->input;
// $Itemid = $input->get('Itemid', 0, 'INT');

// $url = Route::_('index.php?option=com_sppagebuilder&view=form&layout=edit&tmpl=component&id=' . $page->id . '&Itemid=' . $Itemid);
// $root = Uri::base();
// $root = new Uri($root);
// $link = $root->getScheme() . '://' . $root->getHost() . (!in_array($root->getPort(),array(80,443)) ? ':'.$root->getPort() : ''). $url;
?>

<div id="sp-page-builder" class="sp-page-builder <?php echo $menuClassPrefix; ?> page-<?php echo $page->id; ?>">

	<?php if ($showPageHeading) : ?>
	<div class="page-header">
		<h1 itemprop="name">
			<?php echo $menuHeading ? $menuHeading : $page->title; ?>
		</h1>
	</div>
	<?php endif; ?>

	<div class="page-content">
		<?php $pageName = 'page-' . $page->id; ?>
		<?php echo AddonParser::viewAddons( $content, 0, $pageName ); ?>

		<?php if ($this->canEdit) : ?>
		<a class="sp-pagebuilder-page-edit" href="<?php echo $this->checked_out ? $this->item->formLink : $this->item->link . '#'; ?>">
			<?php if(!$this->checked_out) : ?>
				<span class="fas fa-lock" area-hidden="true"></span> <?php echo Text::_('COM_SPPAGEBUILDER_PAGE_CHECKED_OUT'); ?>
			<?php else: ?>
				<span class="fas fa-edit" area-hidden="true"></span> <?php echo Text::_('COM_SPPAGEBUILDER_PAGE_EDIT'); ?>
			<?php endif; ?>
		</a>
		<?php endif; ?>
	</div>
</div>
<?php } ?>

