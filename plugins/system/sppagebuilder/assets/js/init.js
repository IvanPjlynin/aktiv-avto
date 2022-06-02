jQuery(document).ready(function($) {

	if(spPagebuilderEnabled) {
		$(spIntergationElement).hide();
		$('.sp-pagebuilder-admin').show();
		$('.btn-action-sppagebuilder').addClass('sp-pagebuilder-btn-success active');
	} else {
		$('.sp-pagebuilder-admin').hide();
		$(spIntergationElement).show();
		$('.btn-action-editor').addClass('sp-pagebuilder-btn-success active');
	}

	$('.sp-pagebuilder-btn-switcher').on('click',function(event){
		event.preventDefault();

		$('.sp-pagebuilder-btn-switcher').removeClass('active sp-pagebuilder-btn-success');
		$(this).addClass('active').addClass('sp-pagebuilder-btn-success');

		var action = $(this).data('action');

		// get shared parent container
		var $container = $(this).parent('.sp-pagebuilder-btn-group').parent();

		if (action === 'editor') {
			$('.sp-pagebuilder-admin').hide();
			$(spIntergationElement).show();
			$('#jform_attribs_sppagebuilder_active').val('0');

			if (typeof WFEditor !== 'undefined') {
				$('.wf-editor', $container).each(function() {
					var value = this.nodeName === "TEXTAREA" ? this.value : this.innerHTML;

					// pass content from textarea to editor
					Joomla.editors.instances[this.id].setValue(value);

					// show editor and tabs
					$(this).parent('.wf-editor-container').show();
				});
			}

		} else {

			if (typeof WFEditor !== 'undefined') {
				$('.wf-editor', $container).each(function() {
					// pass content to textarea
					Joomla.editors.instances[this.id].getValue();

					// hide editor and tabs
					$(this).parent('.wf-editor-container').hide();
				});
			}

			$(spIntergationElement).hide();
			$('.sp-pagebuilder-admin').show();
			$('#jform_attribs_sppagebuilder_active').val('1');
		}
	});
});
