/**
 * Installer progress JS app plugin
 * 
 * @package JCHAT::CPANEL::administrator::components::com_jchat
 * @subpackage js
 * @author Joomla! Extensions Store
 * @Copyright (C) 2015 Joomla! Extensions Store
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */

// Use plugin installer progress
jQuery(function($) {
	/**
	 * jQuery Installer progress bar plugin
	 */
	$.fn.InstallerProgress = function(options) {
		var targetProgressElements = new Array();
		// Init options
		var defaultOptions = {
							'cascade': new Array({'perc':20, 'time':500}, 
												 {'perc':40, 'time':800}, 
												 {'perc':50, 'time':800}, 
												 {'perc':30, 'time':400}, 
												 {'perc':80, 'time':800})
						}
		pluginOptions = $.extend({}, defaultOptions, options );
		
		// Cycle on pre initialized wrapped set
		this.each(function(index, progress) {
			// Instance manager
			targetProgressElements.push(progress);
		});

		// Reverse stack structure
		targetProgressElements.reverse();

		var counterCall = 0;
		// Start install process
		(function install() {
			var singleProgress = targetProgressElements.pop();
			if (singleProgress) {
				// Do stuff
				setTimeout(function() {
					$(singleProgress).css('width', pluginOptions.cascade[counterCall].perc + '%');
					setTimeout(function() {
						$(singleProgress).css('width', '100%').addClass('bg-success');
						// Show step details
						$('span.step_details', singleProgress).show().css('display', 'inline-block');
						counterCall++;
						// Recurse to the end
						install();
					}, pluginOptions.cascade[counterCall].time);
				}, 300);

			} else {
				$('div.alert-success').show();
				return;
			}
		})();
	};

	$('div.installcontainer div.progress-bar').InstallerProgress({});
});