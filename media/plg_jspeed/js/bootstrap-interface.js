jQuery(function($) {
	var timestamp = new Date().getTime();
	
	var datas = [];
	// Get all the multiple select fields and iterate through each
	$('select[multiple=multiple]').each(function(){
		var el = $(this);

		datas.push({'id': el.attr('id'),'type':el.attr('data-paramtype'), 'param': el.attr('data-paramname'), 'group': el.attr('data-filegroup')});

	});

	var xhr = jQuery.ajax({
		dataType: 'json',
		url: ajaxEndpoint + "&task=exclusionfiles&time=" + timestamp,
		data: {'data': datas},
		method: 'POST',
		success: function (response) {
			$.each(response.data, function(id, obj){
				$.each(obj.data, function(value, option){
					$('#' + id).append('<option value="' + value + '">' + option + '</option>');
				});
			
				$('#' + id).removeAttr('disabled');
				
				$('#' + id).prev('img.dropdown-loading').remove();
				
				$('#' + id).select2({
				    tags: true,
				    tokenSeparators: [',']
				})
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.error('Error returned from ajax function \'getmultiselect\'');
			console.error('textStatus: ' + textStatus);
			console.error('errorThrown: ' + errorThrown);
		}

	});
	
	$.fn.unchosen = function() {
		return $(this).each(function() {
			var element = $(this);
			if(element.hasClass('select2-dropdown')){
				element.next('[id*=_chzn]').remove();
			}
		});
	}
	
	setTimeout(function(){
		$(document).find("select.select2-dropdown").unchosen();
	}, 100)
	
	// Append task buttons to the toolbar if the plugin is enabled
	let isPluginEnabled = !!parseInt($('#jform_enabled').val());
	if(isPluginEnabled) {
		$('#toolbar-cancel').after(`
				<joomla-toolbar-button>
				<a class="btn btn-sm btn-primary btn-jspeed hasTooltip" href="${jSpeedClearCacheURL}" title="${PLG_JSPEED_CLEAR_CACHE_DESC}">
				<span class="icon-cancel" aria-hidden="true"></span>
				${PLG_JSPEED_CLEAR_CACHE}
				</a>
		</joomla-toolbar-button>`);
		
		$('#toolbar-cancel').after(`
				<joomla-toolbar-button>
				<a class="btn btn-sm btn-primary btn-jspeed hasTooltip" href="${jSpeedRestoreHtaccessURL}" title="${PLG_JSPEED_HTACCESS_RESTORE_DESC}">
				<span class="icon-refresh" aria-hidden="true"></span>
				${PLG_JSPEED_HTACCESS_RESTORE}
				</a>
		</joomla-toolbar-button>`);
		
		$('#toolbar-cancel').after(`
				<joomla-toolbar-button>
				<a class="btn btn-sm btn-primary btn-jspeed hasTooltip" href="${jSpeedOptimizeHtaccessURL}" title="${PLG_JSPEED_HTACCESS_SETUP_DESC}">
				<span class="icon-pencil" aria-hidden="true"></span>
				${PLG_JSPEED_HTACCESS_SETUP}
				</a>
		</joomla-toolbar-button>`);
		
		[].slice.call(document.querySelectorAll('a.btn.hasTooltip')).map(function (tooltipEl) {
			let tooltipInstance = new bootstrap.Tooltip(tooltipEl,{
				trigger:'hover', 
				html: true,
				placement: 'bottom',
				container: 'body'
			});
			return tooltipInstance;
		});
	}
});

function JSpeedUcFirst(string) {
    return string[0].toUpperCase() + string.slice(1);
}