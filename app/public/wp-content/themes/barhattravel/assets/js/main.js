(function () {
	'use strict';

	// ----- mobile menu
	var burger = document.querySelector('.bt-burger');
	var nav = document.getElementById('bt-nav');
	if (burger && nav) {
		burger.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			burger.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		nav.addEventListener('click', function (e) {
			if (e.target.tagName === 'A') {
				nav.classList.remove('is-open');
				burger.setAttribute('aria-expanded', 'false');
			}
		});
	}

	// ----- tabs
	document.querySelectorAll('.bt-tabs').forEach(function (tabs) {
		var target = tabs.dataset.target ? document.querySelector(tabs.dataset.target) : tabs.parentElement;
		tabs.querySelectorAll('.bt-tab').forEach(function (tab) {
			tab.addEventListener('click', function () {
				var key = tab.dataset.tab;
				tabs.querySelectorAll('.bt-tab').forEach(function (t) { t.classList.toggle('is-active', t === tab); });
				target.querySelectorAll('.bt-tab-panel').forEach(function (p) {
					p.classList.toggle('is-active', p.dataset.panel === key);
				});
			});
		});
	});

	// ----- accordion
	document.querySelectorAll('.bt-accordion').forEach(function (acc) {
		acc.querySelectorAll('.bt-accordion__head').forEach(function (head, idx) {
			head.setAttribute('aria-expanded', idx === 0 ? 'true' : 'false');
			head.addEventListener('click', function () {
				var expanded = head.getAttribute('aria-expanded') === 'true';
				head.setAttribute('aria-expanded', expanded ? 'false' : 'true');
			});
		});
	});

	// ----- modal open
	var modals = {};
	document.querySelectorAll('.bt-modal').forEach(function (m) {
		modals[m.dataset.form] = m;
		m.addEventListener('click', function (e) {
			if (e.target === m || e.target.closest('.bt-modal__close')) {
				closeModal(m);
			}
		});
	});
	function openModal(name, prefill) {
		var m = modals[name];
		if (!m) return;
		m.classList.add('is-open');
		document.body.style.overflow = 'hidden';
		if (prefill) {
			Object.keys(prefill).forEach(function (k) {
				var f = m.querySelector('[name="' + k + '"]');
				if (f) f.value = prefill[k];
			});
		}
		setTimeout(function () { var fi = m.querySelector('input, textarea'); if (fi) fi.focus(); }, 50);
	}
	function closeModal(m) {
		m.classList.remove('is-open');
		document.body.style.overflow = '';
	}
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			document.querySelectorAll('.bt-modal.is-open').forEach(closeModal);
		}
	});
	document.querySelectorAll('.bt-js-open').forEach(function (btn) {
		btn.addEventListener('click', function (e) {
			e.preventDefault();
			openModal(btn.dataset.form, {
				tour: btn.dataset.tour || '',
				subject: btn.dataset.subject || ''
			});
		});
	});

	// ----- forms (AJAX submit via fetch)
	document.querySelectorAll('.bt-js-form').forEach(function (form) {
		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var msg = form.querySelector('.bt-form__msg');
			var btn = form.querySelector('button[type="submit"]');
			msg.className = 'bt-form__msg';
			msg.textContent = (window.BT && BT.i18n.sending) || 'Отправка...';
			if (btn) btn.disabled = true;
			var fd = new FormData(form);
			fetch(BT.ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' })
				.then(function (r) { return r.json().catch(function () { return { ok: false, msg: 'Bad response' }; }); })
				.then(function (data) {
					if (data && data.ok) {
						msg.classList.add('is-ok');
						msg.textContent = data.msg || BT.i18n.sentOk;
						form.reset();
						setTimeout(function () {
							var m = form.closest('.bt-modal');
							if (m) closeModal(m);
						}, 1800);
					} else {
						msg.classList.add('is-err');
						msg.textContent = (data && data.msg) || BT.i18n.errGeneric;
					}
				})
				.catch(function () {
					msg.classList.add('is-err');
					msg.textContent = BT.i18n.errGeneric;
				})
				.finally(function () { if (btn) btn.disabled = false; });
		});
	});

	// ----- cookie consent
	var cookie = document.querySelector('.bt-cookie');
	if (cookie) {
		try {
			if (!localStorage.getItem('bt_cookie_accepted')) {
				setTimeout(function () { cookie.classList.add('is-show'); }, 600);
			}
		} catch (e) { /* private mode */ }
		var ok = cookie.querySelector('.bt-cookie__accept');
		ok && ok.addEventListener('click', function () {
			try { localStorage.setItem('bt_cookie_accepted', '1'); } catch (e) {}
			cookie.classList.remove('is-show');
		});
	}
})();
