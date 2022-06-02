/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2022 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

jQuery(function($) {
  $(document).on('click', '.action-fix-sppagebuilder-database', function(event) {
    event.preventDefault();
    var config = Joomla.getOptions("config");
    var $this = $(this);
    var $wrapper = $('.maintenance-window-wrapper');
    
    console.log(`${config.base}?option=${config.component}&view=maintenance&task=maintenance.fix`);
    
    $.ajax({
      type : 'POST',
      url: `${config.base}?option=${config.component}&view=maintenance&task=maintenance.fix`,
      beforeSend: function()
      {
        $this.attr('disabled', 'disabled');
        $wrapper.html('<span class="fas fa-spinner fa-spin"></span> &nbsp;<strong>' + Joomla.JText._("COM_SPPAGEBUILDER_MAINTENANCE_PROGRESS") + "<strong>");
      },
      success: function (response)
      {
        var data = $.parseJSON(response);
        
        var outputHtml = '';
        
        if (data) {
          if (data.data.errors.length > 0) {
            outputHtml =
            '<div class="alert alert-danger">' +
            "<h4>" +
            Joomla.JText._("COM_SPPAGEBUILDER_MAINTENANCE_UNABLE_TO_FIX") +
            "</h4>" +
            Joomla.JText._("COM_SPPAGEBUILDER_MAINTENANCE_ISSUE_MESSAGE") +
            "</div>";
          } else {
            outputHtml = "";
          }
          
          if (data.data.html.length > 0) {
            outputHtml += data.data.html;
          } else {
            outputHtml =
            '<div class="alert alert-info">' + Joomla.JText._("COM_SPPAGEBUILDER_MAINTENANCE_IS_UPTODATE") + "</div>";
          }
          
          if (data.data.errors.length === 0) {
            $this.attr('disabled', 'disabled');
          } else {
            $this.removeAttr('disabled', 'disabled');
          }
          
        } else {
          outputHtml =
          '<div class="alert alert-info">' + Joomla.JText._("COM_SPPAGEBUILDER_MAINTENANCE_IS_UPTODATE") + "</div>";
        }
        
        $wrapper.html(outputHtml);
      }
    });
  });
});