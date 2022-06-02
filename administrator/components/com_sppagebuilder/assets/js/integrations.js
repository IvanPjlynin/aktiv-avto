/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
jQuery((function(e){e(document).on("click","[data-integration-toggle]",(function(a){a.preventDefault();var t=e(this),s=t.closest("[data-integration-list-item]").data("group"),n=t.closest("[data-integration-list-item]").data("name");e.ajax({type:"POST",url:pagebuilder_base+"index.php?option=com_sppagebuilder&task=integrations.toggle&group="+s+"&name="+n,beforeSend:function(){t.html('<span class="fas fa-spinner fa-spin" area-hidden="true"></span>')},success:function(a){var s=e.parseJSON(a);s.success?s.result?(t.closest("[data-integration-list-item]").addClass("enabled"),t.removeClass("btn-primary").addClass("btn-danger").text("Deactivate")):(t.closest("[data-integration-list-item]").removeClass("enabled"),t.removeClass("btn-danger").addClass("btn-primary").text("Activate")):alert(s.message)}})}))}));