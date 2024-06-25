document.addEventListener('DOMContentLoaded', function () {
	const button = document.getElementById('last-post-link');
	const dataHref = button.getAttribute('data-href');

	button.addEventListener('click', function () {
		if (dataHref) {
			window.location.href = dataHref;
		}
	});
});