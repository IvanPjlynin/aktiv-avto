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

Factory::getDocument()->getWebAssetManager()
	->useScript('webcomponent.toolbar-button');

$title = Text::_('COM_SPPAGEBUILDER_MEDIA_MANAGER_UPLOAD_FILES');
?>
<joomla-toolbar-button>
	<button id="sp-pagebuilder-upload-media" class="btn btn-success">
		<span class="fas fa-upload" aria-hidden="true"></span>
		<?php echo $title; ?>
	</button>
</joomla-toolbar-button>
