document.addEventListener('DOMContentLoaded', () => {
	const toggles = document.querySelectorAll('[data-submenu-toggle]');

	toggles.forEach((toggle) => {
		const targetId = toggle.getAttribute('data-submenu-toggle');
		const submenu = targetId ? document.getElementById(targetId) : null;

		if (!submenu) {
			return;
		}

		toggle.addEventListener('click', () => {
			const isHidden = submenu.classList.contains('hidden');
			submenu.classList.toggle('hidden');
			toggle.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
		});
	});
});
