/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-pencil' : '&#xe000;',
			'icon-wrench' : '&#xe001;',
			'icon-list' : '&#xe002;',
			'icon-remove' : '&#xe003;',
			'icon-lock' : '&#xe004;',
			'icon-cancel-circle' : '&#xe005;',
			'icon-loop' : '&#xe006;',
			'icon-loop-2' : '&#xe007;',
			'icon-cog' : '&#xe008;',
			'icon-star' : '&#xe009;',
			'icon-star-2' : '&#xe00a;',
			'icon-reply' : '&#xe00b;',
			'icon-flag' : '&#xe00c;',
			'icon-envelop' : '&#xe00d;',
			'icon-user' : '&#xe00e;',
			'icon-redo' : '&#xe00f;',
			'icon-bubbles' : '&#xe010;',
			'icon-heart' : '&#xe011;',
			'icon-heart-2' : '&#xe012;',
			'icon-quotes-left' : '&#xe013;',
			'icon-spinner' : '&#xe014;',
			'icon-spinner-2' : '&#xe015;',
			'icon-clock' : '&#xe016;',
			'icon-loop-3' : '&#xe017;',
			'icon-twitter' : '&#xe018;',
			'icon-twitter-2' : '&#xe019;',
			'icon-twitter-3' : '&#xe01a;',
			'icon-feed' : '&#xe01b;',
			'icon-user-2' : '&#xe01c;',
			'icon-menu' : '&#xe01d;',
			'icon-home' : '&#xe01e;',
			'icon-image' : '&#xe01f;',
			'icon-undo' : '&#xe020;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; i < els.length; i += 1) {
		el = els[i];
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};