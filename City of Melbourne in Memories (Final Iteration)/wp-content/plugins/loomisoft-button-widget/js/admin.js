jQuery(document).ready(function ($) {
	function updateColorPickers() {
		$('#widgets-right .wp-color-picker').each(function () {
			$(this).wpColorPicker();
		});
	}

	updateColorPickers();

	$(document).ajaxSuccess(function (e, xhr, settings) {
		if (settings) {
			if (settings.data) {
				if (settings.data.search) {
					if (settings.data.search('action=save-widget') != -1) {
						$('.color-field .wp-picker-container').remove();
						updateColorPickers();
					}
				}
			}
		}
	});
});