<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

$title = Text::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_CREATE_FOLDER');
?>
<button id="sp-pagebuilder-media-create-folder" data-toggle="collapse" data-target="#collapseFolder" class="btn btn-primary btn-small d-none">
	<span class="icon-folder" aria-hidden="true"></span> <?php echo $title; ?>
</button>
