<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Plugin\PluginHelper;

$doc = Factory::getDocument();

SppagebuilderHelper::loadAssets('css');
$doc->addScriptdeclaration('var pagebuilder_base="' . JURI::root() . 'administrator/";');
HTMLHelper::_('jquery.framework');
SppagebuilderHelper::addScript('integrations.js');

require_once JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/integrations.php';
$integrations = SppagebuilderHelperIntegrations::integrations();

?>

<div class="sp-pagebuilder-admin">
	<div class="sp-pagebuilder-main">
		<?php
		// sidebar
		echo LayoutHelper::render('sidebar');
		?>

		<div class="sp-pagebuilder-content">
			<div id="j-main-container" class="j-main-container">
				<div class="sp-pagebuilder-integrations">
						<div class="sp-pagebuilder-integrations-list">
						<?php foreach ($integrations as $key => $item) : ?>
							<?php
								$path = $item['group'] . '/' . $item['name'];
								$enabled = PluginHelper::isEnabled($item['group'], $item['name']);
							?>
							<?php if(file_exists(JPATH_PLUGINS . '/' . $path)): ?>
								<div class="sp-pagebuilder-integration-list-item<?php echo $enabled ? ' enabled' : ''; ?>" data-group="<?php echo $item['group']; ?>" data-name="<?php echo $item['name']; ?>" data-enabled="<?php echo $enabled ? '1' : '0'; ?>" data-integration-list-item>
									<div>
										<img class="sp-pagebuilder-integration-thumbnail" src="<?php echo JURI::root(true) .'/plugins/'. $item['group'] . '/' . $item['name'] . '/thumbnail.png'; ?>" alt="<?php echo $item['title']; ?>">
										<div class="sp-pagebuilder-integration-footer">
											<div class="sp-pagebuilder-integration-title">
												<i class="fas fa-check-circle"></i> <?php echo $item['title']; ?>
											</div>
											<div class="sp-pagebuilder-integration-actions">		
												<a class="btn btn-<?php echo $enabled ? 'danger' : 'primary'; ?> btn-sm sp-pagebuilder-btn-toggle" href="#" data-integration-toggle><?php echo $enabled ? 'Deactivate' : 'Activate'; ?></a>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<?php echo JLayoutHelper::render('footer'); ?>
		</div>
	</div>
</div>

<style>
	.subhead-collapse,
	.btn-subhead,
	.subhead {
		display: none !important;
	}
</style>
