<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

//no direct accees
defined ('_JEXEC') or die ('restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$doc = Factory::getDocument();

SppagebuilderHelper::loadAssets('css');
$doc->addScriptdeclaration('var pagebuilder_base="' . JURI::root() . 'administrator/";');
HTMLHelper::_('jquery.framework');
SppagebuilderHelper::addScript('languages.js');

require_once JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/languages.php';
$languages = SppagebuilderHelperLanguages::language_list();

?>

<div class="sp-pagebuilder-admin">

	<div class="sp-pagebuilder-main">
		<?php
		// sidebar
		echo LayoutHelper::render('sidebar');
		?>

		<div class="sp-pagebuilder-content">
			<div class="sp-pagebuilder-row">
				<div class="col-md-12">
					<div id="j-main-container" class="j-main-container">
						<?php if (empty($languages)) : ?>
						<div class="alert alert-info">
							<span class="fas fa-info-circle" aria-hidden="true"></span><span class="sr-only"><?php echo Text::_('INFO'); ?></span>
							<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
						</div>
						<?php else : ?>
						<table class="sppb-list-table" id="languageList">
							<thead>
								<tr>
									<th class="w-1 text-center">
										#
									</th>
									<th scope="col">
										<?php echo Text::_('COM_SPPAGEBUILDER_FIELD_LANGUAGE'); ?>
									</th>
									<th scope="col" class="w-10 d-none d-md-table-cell text-center">
										<?php echo Text::_('COM_SPPAGEBUILDER_FIELD_INSTALLATION_STATUS'); ?>
									</th>
									<th scope="col" class="w-15 text-right">
										<?php echo Text::_('COM_SPPAGEBUILDER_FIELD_ACTION'); ?>
									</th>
								</tr>
							</thead>

							<tbody>
								<?php $item_no = 1;
								$newLang = (array)$languages;
								ksort($newLang);
								$languages = (object)$newLang;

								foreach ( $languages as $key => $language ) {
									$installation_status = "available";
									$installed_version = 'Not Installed';
									$update_class = '';
									$update_status = '';

									if(count((array) $this->items)) {
										foreach ($this->items as $this->item) {
											if($this->item->lang_key == $key) {
												if($this->item->state == 0) {
													$installation_status = "installed";
												} else if ($this->item->state == 1) {
													$installation_status = "enabled";
												}

												$installed_version = $this->item->version;
												if ($language->version > $this->item->version) {
													$update_class = 'badge-warning';
													$update_status = 'available';
												} else {
													$update_class = 'badge-success';
													$update_status= 'updated';
												}
											}
										}
									} ?>
									<tr data-language="<?php echo $key; ?>">
										<td class="text-center">
											<?php echo $item_no; ?>
										</td>
										<td>
											<img src="<?php echo  JURI::root(true) . '/media/mod_languages/images/' . strtolower(str_ireplace('-', '_', $language->lang_tag)); ?>.gif" alt="<?php echo $language->lang_tag; ?>" title="<?php echo $language->lang_tag; ?>">
											<span class="language-title">
												<?php echo $this->escape($language->title); ?>
											</span>
										</td>
										<td class="text-center d-none d-md-table-cell installed-version">
											<span class="badge <?php echo $update_class; ?>"><?php echo $installed_version; ?></span>
										</td>
										<td class="text-right">
											<span class="btn btn-primary btn-sm sp-pagebuilder-btn-install<?php echo ($installation_status == 'installed' || $installation_status == 'enabled') ? ' d-none' : ''; ?>" data-text="<?php echo Text::_('COM_SPPAGEBUILDER_INSTALL'); ?>" role="button"><?php echo Text::_('COM_SPPAGEBUILDER_INSTALL'); ?></span>
											<span class="btn btn-warning btn-sm sp-pagebuilder-btn-update<?php echo $update_status == 'available' ? '' : ' d-none'; ?>" role="button"><?php echo Text::_('COM_SPPAGEBUILDER_UPDATE'); ?></span>
											
											<?php if($installation_status == 'installed' || $installation_status == 'enabled') : ?>
												<span class="text text-success"><span class="fas fa-check"></span> Installed</span>
											<?php endif; ?>
										</td>
									</tr>
								<?php $item_no++; } ?>
							</tbody>
						</table>
						<?php endif; ?>
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
