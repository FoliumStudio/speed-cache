/* Cache by Folium — Folium UI admin app.
 *
 * Vanilla app mounted by the shared Folium frame. Real settings arrive via
 * window.CacheByFoliumData and save through the plugin's ajax bridge.
 */
(function () {
	'use strict';

	var D = window.CacheByFoliumData || {};
	var $ = function (sel, root) { return (root || document).querySelector(sel); };
	var $$ = function (sel, root) { return Array.prototype.slice.call((root || document).querySelectorAll(sel)); };
	var icon = function (name) { return window.FL && window.FL.icon ? window.FL.icon(name) : ''; };
	var toast = function (msg) {
		if (window.Folium && window.Folium.toast) {
			window.Folium.toast(msg);
		}
	};

	var defaults = {
		settings: {
			cache_expires: 0,
			cache_new_post: 0,
			cache_new_comment: 0,
			cache_webp: 0,
			cache_compress: 0,
			excl_ids: '',
			minify_html: 0
		},
		cdnSettings: {
			cdn_root_url: '',
			cdn_file_extensions: '',
			cdn_css_root_url: '',
			cdn_css_file_extensions: '',
			cdn_js_root_url: '',
			cdn_js_file_extensions: ''
		}
	};

	var state = {
		tab: 'dashboard',
		search: '',
		dirty: false,
		saved: 0,
		settings: Object.assign({}, defaults.settings, D.settings || {}),
		cdnSettings: Object.assign({}, defaults.cdnSettings, D.cdnSettings || {}),
		cacheSize: String(D.cacheSize || '0'),
		wpCache: !!D.wpCache
	};

	var tabs = [
		{ id: 'dashboard', label: 'Dashboard' },
		{ id: 'cache', label: 'Caching' },
		{ id: 'cdn', label: 'CDN Rewrite' },
		{ id: 'tools', label: 'Tools' }
	];

	var minifyOptions = [
		['0', 'Disabled'],
		['1', 'HTML'],
		['2', 'HTML & Inline JS']
	];

	function esc(value) {
		var node = document.createElement('div');
		node.textContent = value === undefined || value === null ? '' : String(value);
		return node.innerHTML;
	}

	function isOn(key) {
		return Number(state.settings[key]) === 1;
	}

	function activeRuleCount() {
		return ['cache_new_post', 'cache_new_comment', 'cache_webp', 'cache_compress'].filter(isOn).length;
	}

	function needsCdnDetails() {
		return String(state.cdnSettings.cdn_root_url || '').trim() === '' || String(state.cdnSettings.cdn_file_extensions || '').trim() === '';
	}

	function setDirty(on) {
		state.dirty = !!on;
		updateBar();
	}

	function updateBar() {
		var active = $('#wpd-active-count');
		if (active) {
			active.textContent = String(activeRuleCount());
		}
		var dirty = $('#wpd-dirty');
		if (dirty) {
			dirty.hidden = !state.dirty;
		}
		var saved = $('#wpd-saved-note');
		if (saved) {
			saved.hidden = state.dirty || !state.saved;
		}
		var save = $('#wpd-save');
		if (save) {
			save.disabled = !state.dirty;
		}
	}

	function paintIcons(root) {
		$$('[data-ic]', root).forEach(function (el) {
			el.innerHTML = icon(el.getAttribute('data-ic'));
		});
	}

	function tabBar() {
		return '<div class="fl-tabs">' + tabs.map(function (tab) {
			return '<button class="fl-tab" data-cbf-tab="' + tab.id + '" aria-selected="' + (state.tab === tab.id ? 'true' : 'false') + '">' + tab.label + '</button>';
		}).join('') + '</div>';
	}

	function metric(label, value, foot, good) {
		return '<div class="fl-metric">' +
			'<div class="fl-metric-top"><span class="fl-metric-label">' + esc(label) + '</span>' + (good ? '<span class="fl-pill fl-pill--good"><span class="fl-dot"></span> Active</span>' : '') + '</div>' +
			'<div class="fl-metric-value' + (good ? ' is-good' : '') + '">' + value + '</div>' +
			'<div class="fl-metric-foot">' + esc(foot) + '</div>' +
		'</div>';
	}

	function dashboard() {
		return '<div class="cbf-screen wpd-section" data-screen-label="Dashboard">' +
			'<div class="cbf-hero fl-card">' +
				'<div class="cbf-hero-copy">' +
					'<span class="fl-eyebrow"><span class="fl-num">00</span> — CACHE BY FOLIUM</span>' +
					'<h2 class="fl-h1">Calmer WordPress performance.</h2>' +
					'<p class="fl-lead">Full-page cache, smart purge rules, WebP variants and CDN rewriting, wrapped in the Folium interface.</p>' +
					(state.wpCache ? '<span class="fl-pill fl-pill--good"><span class="fl-dot"></span> WP_CACHE enabled</span>' : '<span class="fl-pill fl-pill--warn"><span class="fl-dot"></span> WP_CACHE missing</span>') +
				'</div>' +
				'<div class="cbf-bolt"><span class="fl-i" data-ic="bolt"></span></div>' +
			'</div>' +
			'<div class="wpd-metrics">' +
				metric('Cached files', '<span data-cbf-cache-size>' + esc(state.cacheSize) + '</span><span class="fl-unit">Kb</span>', 'current disk cache', Number(state.cacheSize) > 0) +
				metric('Purge rules', String(activeRuleCount()) + '<span class="fl-unit">/ 4</span>', 'automatic cache clearing', activeRuleCount() > 0) +
				metric('Expiry', esc(state.settings.cache_expires || 0) + '<span class="fl-unit">hours</span>', '0 means never expires', Number(state.settings.cache_expires) > 0) +
				metric('CDN roots', String(cdnRootCount()) + '<span class="fl-unit">/ 3</span>', 'asset rewrite targets', cdnRootCount() > 0) +
			'</div>' +
			'<div class="cbf-dashboard-grid">' +
				'<div class="fl-card"><div class="fl-card-head"><div class="fl-card-title"><span class="fl-eyebrow">NEXT STEPS</span><h3 class="fl-h3">WooCommerce-aware caching</h3></div></div><div class="fl-card-pad cbf-next-steps">' +
					(needsCdnDetails() ? '<div class="fl-banner fl-banner--warn"><span class="fl-i" data-ic="warn"></span><div class="fl-banner-body"><div class="fl-banner-title">Add your CDN details</div><div class="fl-banner-desc">Add a CDN path and file extensions if you want Cache by Folium to rewrite asset URLs.</div></div><button class="fl-btn fl-btn--sm" data-cbf-tab="cdn">Open CDN Rewrite</button></div>' : '') +
					'<p class="fl-lead">Variant-safe rules for cart, checkout, currency and session-aware stores are the direction for Cache by Folium.</p>' +
				'</div></div>' +
				'<div class="fl-card"><div class="fl-card-head"><div class="fl-card-title"><span class="fl-eyebrow">TOOLS</span><h3 class="fl-h3">Cache operations</h3></div></div><div class="fl-card-pad cbf-actions"><button class="fl-btn fl-btn--primary" data-cbf-action="clear"><span class="fl-i" data-ic="refresh"></span> Clear cache</button><a class="fl-btn fl-btn--ghost" href="' + esc((D.links || {}).plugin || '#') + '" target="_blank" rel="noopener"><span class="fl-i" data-ic="external"></span> Plugin page</a></div></div>' +
			'</div>' +
		'</div>';
	}

	function cdnRootCount() {
		return ['cdn_root_url', 'cdn_css_root_url', 'cdn_js_root_url'].filter(function (key) {
			return String(state.cdnSettings[key] || '').trim() !== '';
		}).length;
	}

	function field(name, label, desc, type, options) {
		var value = state.settings[name] !== undefined ? state.settings[name] : '';
		var control = '';
		if (type === 'toggle') {
			control = '<label class="fl-switch"><input type="checkbox" data-cbf-setting="' + name + '" ' + (isOn(name) ? 'checked' : '') + '><span class="fl-track"></span><span class="fl-thumb"></span></label>';
		} else if (type === 'select') {
			control = '<select class="fl-select" data-cbf-setting="' + name + '">' + options.map(function (opt) {
				return '<option value="' + esc(opt[0]) + '" ' + (String(opt[0]) === String(value) ? 'selected' : '') + '>' + esc(opt[1]) + '</option>';
			}).join('') + '</select>';
		} else {
			control = '<input class="fl-input fl-input--mono" type="' + (type || 'text') + '" data-cbf-setting="' + name + '" value="' + esc(value) + '">';
		}
		return '<div class="fl-row cbf-row" data-search="' + esc((label + ' ' + desc).toLowerCase()) + '">' +
			'<div class="fl-row-main"><div class="fl-row-title">' + esc(label) + '</div><div class="fl-row-desc">' + desc + '</div></div>' +
			'<div class="fl-row-ctrl">' + control + '</div>' +
		'</div>';
	}

	function cdnField(name, label, desc) {
		var value = state.cdnSettings[name] || '';
		return '<div class="fl-row cbf-row" data-search="' + esc((label + ' ' + desc).toLowerCase()) + '">' +
			'<div class="fl-row-main"><div class="fl-row-title">' + esc(label) + '</div><div class="fl-row-desc">' + desc + '</div></div>' +
			'<div class="fl-row-ctrl"><input class="fl-input fl-input--mono" data-cbf-cdn="' + name + '" value="' + esc(value) + '"></div>' +
		'</div>';
	}

	function cacheSettings() {
		return section('Caching', '01 — PAGE CACHE', 'Control the disk cache and the events that should purge it.', [
			field('cache_expires', 'Cache expiry', 'Hours before cached files expire. Use <code>0</code> to keep files until a purge event.', 'number'),
			field('cache_compress', 'Compress cache', 'Create compressed cache files. Disable only if a browser or host shows odd responses.', 'toggle'),
			field('cache_new_post', 'Purge on new posts', 'Wipe cache whenever a post is published.', 'toggle'),
			field('cache_new_comment', 'Purge on new comments', 'Wipe cache whenever a new comment is posted.', 'toggle'),
			field('cache_webp', 'Cache WebP images', 'Maintain WebP-aware cached variants where supported.', 'toggle'),
			field('minify_html', 'Minification', 'Minify HTML, or HTML plus inline JavaScript.', 'select', minifyOptions),
			field('excl_ids', 'Exclusions', 'Post or page IDs separated by a <code>,</code>.', 'text')
		]);
	}

	function cdnSettings() {
		return section('CDN Rewrite', '02 — CDN REWRITE', 'Rewrite static asset URLs to the CDN roots configured below.', [
			cdnField('cdn_root_url', 'CDN path', 'Primary CDN URL for images and files.'),
			cdnField('cdn_file_extensions', 'Image and file extensions', 'Comma-separated extensions handled by the primary CDN path.'),
			cdnField('cdn_css_root_url', 'CSS CDN path', 'Optional CDN URL for stylesheets.'),
			cdnField('cdn_css_file_extensions', 'CSS file extensions', 'Extensions handled by the CSS CDN path.'),
			cdnField('cdn_js_root_url', 'JS files CDN path', 'Optional CDN URL for JavaScript files.'),
			cdnField('cdn_js_file_extensions', 'JS file extensions', 'Extensions handled by the JS CDN path.')
		]);
	}

	function section(title, eyebrow, lead, rows) {
		return '<div class="cbf-screen wpd-section" data-screen-label="' + esc(title) + '">' +
			'<div class="wpd-section-head">' +
				'<div class="fl-stack" style="gap:7px"><span class="fl-eyebrow"><span class="fl-num">' + esc(eyebrow.split(' — ')[0]) + '</span> — ' + esc(eyebrow.split(' — ')[1] || '') + '</span><h2 class="fl-h1" style="font-size:24px">' + esc(title) + '</h2><p class="fl-lead">' + esc(lead) + '</p></div>' +
			'</div>' +
			'<div class="fl-card" style="overflow:hidden"><div class="fl-rows">' + rows.join('') + '</div></div>' +
		'</div>';
	}

	function tools() {
		return '<div class="cbf-screen wpd-section" data-screen-label="Tools">' +
			'<div class="wpd-section-head"><div class="fl-stack" style="gap:7px"><span class="fl-eyebrow"><span class="fl-num">03</span> — TOOLS</span><h2 class="fl-h1" style="font-size:24px">Cache tools</h2><p class="fl-lead">Clear cached files or restore the plugin defaults.</p></div></div>' +
			'<div class="fl-banner fl-banner--accent"><span class="fl-i" data-ic="bolt"></span><div class="fl-banner-body"><div class="fl-banner-title">Current cached files: <span data-cbf-cache-size>' + esc(state.cacheSize) + '</span> Kb</div><div class="fl-banner-desc">Clearing cache removes generated files and refreshes this count.</div></div><button class="fl-btn fl-btn--primary fl-btn--sm" data-cbf-action="clear"><span class="fl-i" data-ic="refresh"></span> Clear cache</button></div>' +
			'<div class="fl-banner fl-banner--warn" style="margin-top:16px"><span class="fl-i" data-ic="warn"></span><div class="fl-banner-body"><div class="fl-banner-title">Reset settings</div><div class="fl-banner-desc">Restores cache and CDN options to their defaults. Cached files are cleared too.</div></div><button class="fl-btn fl-btn--danger fl-btn--sm" data-cbf-action="reset"><span class="fl-i" data-ic="refresh"></span> Reset to defaults</button></div>' +
		'</div>';
	}

	function body() {
		if (state.tab === 'cache') {
			return cacheSettings();
		}
		if (state.tab === 'cdn') {
			return cdnSettings();
		}
		if (state.tab === 'tools') {
			return tools();
		}
		return dashboard();
	}

	function render() {
		var root = $('#wpd');
		if (!root) {
			return;
		}
		root.setAttribute('data-layout', 'tabs');
		root.setAttribute('data-rowstyle', 'list');
		root.setAttribute('data-accent', 'amber');
		root.classList.add('cbf-app');

		var nav = $('#wpd-nav');
		if (nav) {
			nav.hidden = true;
		}
		var tabsNode = $('#wpd-tabsbar');
		if (tabsNode) {
			tabsNode.hidden = false;
			tabsNode.innerHTML = tabBar();
		}
		var main = $('#wpd-main');
		if (main) {
			main.innerHTML = body();
		}
		paintIcons(root);
		applySearch();
		updateBar();
	}

	function applySearch() {
		var q = state.search.trim().toLowerCase();
		$$('[data-search]').forEach(function (row) {
			row.hidden = !!q && row.getAttribute('data-search').indexOf(q) === -1;
		});
	}

	function payload() {
		return {
			settings: Object.assign({}, state.settings),
			cdnSettings: Object.assign({}, state.cdnSettings)
		};
	}

	function post(action, data, done) {
		var body = new FormData();
		body.append('action', action);
		body.append('nonce', D.nonce || '');
		if (data) {
			body.append('data', JSON.stringify(data));
		}
		fetch(D.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: body })
			.then(function (res) { return res.json(); })
			.then(function (json) { done(json); })
			.catch(function () { done({ success: false }); });
	}

	function save() {
		post((D.actions || {}).save, payload(), function (json) {
			if (json && json.success) {
				if (json.data && json.data.cacheSize !== undefined) {
					state.cacheSize = String(json.data.cacheSize);
				}
				state.saved = Date.now();
				setDirty(false);
				render();
				toast('Cache settings saved');
			} else {
				toast('Save failed');
			}
		});
	}

	function reset() {
		post((D.actions || {}).reset, null, function (json) {
			if (json && json.success) {
				state.settings = Object.assign({}, defaults.settings);
				state.cdnSettings = Object.assign({}, defaults.cdnSettings);
				state.cacheSize = '0';
				state.saved = Date.now();
				setDirty(false);
				render();
				toast('Cache settings reset');
			} else {
				toast('Reset failed');
			}
		});
	}

	function clearCache() {
		post((D.actions || {}).clear, null, function (json) {
			if (json && json.success) {
				if (json.data && json.data.cacheSize !== undefined) {
					state.cacheSize = String(json.data.cacheSize);
				} else {
					state.cacheSize = '0';
				}
				render();
				toast('Cache cleared');
			} else {
				toast('Clear cache failed');
			}
		});
	}

	function wire() {
		var root = $('#wpd');
		if (!root || root.getAttribute('data-cbf-wired') === '1') {
			return;
		}
		root.setAttribute('data-cbf-wired', '1');
		root.addEventListener('click', function (event) {
			var tab = event.target.closest('[data-cbf-tab]');
			if (tab) {
				state.tab = tab.getAttribute('data-cbf-tab');
				render();
				return;
			}
			var action = event.target.closest('[data-cbf-action]');
			if (action) {
				var act = action.getAttribute('data-cbf-action');
				if (act === 'clear') {
					clearCache();
				} else if (act === 'reset') {
					reset();
				}
			}
		});
		root.addEventListener('change', function (event) {
			var setting = event.target.getAttribute('data-cbf-setting');
			var cdn = event.target.getAttribute('data-cbf-cdn');
			if (setting) {
				if (event.target.type === 'checkbox') {
					state.settings[setting] = event.target.checked ? 1 : 0;
				} else {
					state.settings[setting] = event.target.value;
				}
				setDirty(true);
			}
			if (cdn) {
				state.cdnSettings[cdn] = event.target.value;
				setDirty(true);
			}
		});
		root.addEventListener('input', function (event) {
			var setting = event.target.getAttribute('data-cbf-setting');
			var cdn = event.target.getAttribute('data-cbf-cdn');
			if (setting) {
				state.settings[setting] = event.target.value;
				setDirty(true);
			}
			if (cdn) {
				state.cdnSettings[cdn] = event.target.value;
				setDirty(true);
			}
		});
	}

	if (window.Folium && window.Folium.registerApp) {
		window.Folium.registerApp('cache-performance', {
			mount: function () { render(); wire(); },
			save: save,
			reset: reset,
			filter: function (query) {
				state.search = query || '';
				applySearch();
			}
		});
	}
}());
