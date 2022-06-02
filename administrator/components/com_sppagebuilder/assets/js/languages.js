/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
jQuery((function(s){s(document).on("click",".sp-pagebuilder-btn-install, .sp-pagebuilder-btn-update",(function(a){a.preventDefault();var e=s(this),n=e.closest("tr").data("language");s.ajax({type:"POST",url:pagebuilder_base+"index.php?option=com_sppagebuilder&task=languages.install&language="+n,beforeSend:function(){e.html('<span class="fas fa-spinner fa-spin" area-hidden="true"></span> Installing...')},success:function(a){var n=s.parseJSON(a);n.success?(e.closest("tr").find(".installed-version").html('<span class="badge badge-success">'+n.version+"</span>"),e.closest("td").html('<span class="text text-success"><span class="fas fa-check"></span> Installed</span>')):(e.closest("td").html('<i class="fas fa-exclamation-triangle"></i> Error'),alert(n.message))}})}))}));