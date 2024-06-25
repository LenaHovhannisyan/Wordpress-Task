(function ($) {
	wp.customize('primary_color', function (value) {
		value.bind(function (newval) {
			document.documentElement.style.setProperty('--primary', newval);
		});
	});

	wp.customize('secondary_color', function (value) {
		value.bind(function (newval) {
			document.documentElement.style.setProperty('--secondary', newval);
		});
	});
})(jQuery);
