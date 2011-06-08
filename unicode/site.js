function updateAllExceptFor(str, exception) {
	var encoding = getEncodingFromForm();
	if (exception != "str") {
		document.getElementById("string").value = str;
	}
	if (exception != "utf16-escape") {
		document.getElementById("utf16-escape").value = escapeToUtf16(str);
	}
	if (exception != "utf16r-escape") {
		document.getElementById("utf16r-escape").value = escapeToUtf16r(str);
	}
	if (exception != "utf32-escape") {
		document.getElementById("utf32-escape").value = escapeToUtf32(str);
	}
	if (exception != "numref-dec") {
		document.getElementById("numref-dec").value = escapeToNumRef(str, 10);
	}
	if (exception != "numref-hex") {
		document.getElementById("numref-hex").value = escapeToNumRef(str, 16);
	}
	if (exception != "punycode") {
		document.getElementById("punycode").value = escapeToPunyCode(str);
	}
	if (exception != "hex-escape") {
		document.getElementById("hex-escape").value = escapeToEscapedBytes(str, 16, encoding);
	}
	if (exception != "oct-escape") {
		document.getElementById("oct-escape").value = escapeToEscapedBytes(str, 8, encoding);
	}
	if (exception != "base64") {
		document.getElementById("base64").value = escapeToBase64(str, encoding);
	}
	if (exception != "quoted-printable") {
		document.getElementById("quoted-printable").value = escapeToQuotedPrintable(str, encoding);
	}
	if (exception != "url") {
		document.getElementById("url").value = escapeToUrl(str, encoding);
	}
	if (exception != "mime-b") {
		document.getElementById("mime-b").value = escapeToMime(str, "base64", encoding);
	}
	if (exception != "mime-q") {
		document.getElementById("mime-q").value = escapeToMime(str, "quoted-printable", encoding);
	}
}
function getEncodingFromForm() {
	var options = document.getElementById("encoding");
	if (options) {
		return options[options.selectedIndex].value;
	}
	return "UTF-8";
}
function toggleAll(anchor) {
	var text_node = anchor.firstChild;
	var command;
	if (text_node.nodeValue == "hide all") {
		text_node.nodeValue = "show all";
		command = "hide";
	} else {
		text_node.nodeValue = "hide all";
		command = "show";
	}
	var tables = document.getElementsByTagName("table");
	for (var i = 0; i < tables.length; ++i) {
		var table = tables[i];
		var anchors = table.getElementsByTagName("a");
		var textareas = table.getElementsByTagName("textarea");
		if (anchors.length == 1 && textareas.length == 1) {
			if (anchors[0].firstChild.nodeValue == command) {
				toggleDisplay(anchors[0], textareas[0].id);
			}
		}
	}
}
function toggleDisplay(anchor, target) {
	var element = document.getElementById(target);
	var style = element.style;
	var text_node = anchor.firstChild;
	if (text_node.nodeValue == "hide") {
		text_node.nodeValue = "show";
		style.visibility = "hidden";
		element.originalHeight = style.height;
		style.height = "0px";
	} else {
		text_node.nodeValue = "hide";
		style.height = element.originalHeight;
		style.visibility = "visible";
	}
}
function updateByString(str) {
	updateAllExceptFor(str, "str");
}
function updateByUtf16(str) {
	var unescaped = unescapeFromUtf16(str);
	updateAllExceptFor(unescaped, "utf16-escape");
}
function updateByUtf16r(str) {
	var unescaped = unescapeFromUtf16r(str);
	updateAllExceptFor(unescaped, "utf16r-escape");
}
function updateByUtf32(str) {
	var unescaped = unescapeFromUtf32(str);
	updateAllExceptFor(unescaped, "utf32-escape");
}
function updateByNumRefDec(str) {
	var unescaped = unescapeFromNumRef(str, 10);
	updateAllExceptFor(unescaped, "numref-dec");
}
function updateByNumRefHex(str) {
	var unescaped = unescapeFromNumRef(str, 16);
	updateAllExceptFor(unescaped, "numref-hex");
}
function updateByPunyCode(str) {
	var unescaped = unescapeFromPunyCode(str);
	updateAllExceptFor(unescaped, "punycode");
}
function updateByHex(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromEscapedBytes(str, 16, encoding);
	updateAllExceptFor(unescaped, "hex-escape");
}
function updateByOct(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromEscapedBytes(str, 8, encoding);
	updateAllExceptFor(unescaped, "oct-escape");
}
function updateByBase64(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromBase64(str, encoding);
	updateAllExceptFor(unescaped, "base64");
}
function updateByQuotedPrintable(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromQuotedPrintable(str, encoding);
	updateAllExceptFor(unescaped, "quoted-printable");
}
function updateByUrl(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromUrl(str, encoding);
	updateAllExceptFor(unescaped, "url");
}
function updateByMimeBase64(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromMime(str, encoding);
	updateAllExceptFor(unescaped, "mime-b");
}
function updateByMimeQuotedPrintable(str) {
	var encoding = getEncodingFromForm();
	var unescaped = unescapeFromMime(str, encoding);
	updateAllExceptFor(unescaped, "mime-q");
}
function updateByForm() {
	loadMap(document.getElementById("encoding").value,
	function() {
		var str = document.getElementById("string").value;
		var start = +new Date();
		updateAllExceptFor(str, "str");
	});
}
function waiting(flag) {
	document.getElementById("encoding").disabled = !!flag;
}
function loadMap(charset, func) {
	var loadedCharsets = {
		"iso88591": "ISO88591_MAP_ENCODED",
		"sjis": "SJIS_MAP_ENCODED",
		"gbk": "UNICODEGBTABLE",
		"big5": "UNICODEBIG5TABLE"
	};
	if (charset.indexOf("JP") > 1 || charset.indexOf("JIS") > 1) {
		if ("SJIS_MAP_ENCODED" in window) {
			return func();
		}
		charset = "sjis";
	} else if (charset.indexOf("ISO") > -1) {
		if ("ISO88591_MAP_ENCODED" in window) {
			return func();
		}
		charset = "iso88591";
	} else if (charset.indexOf("GBK") > -1) {
		if ("UNICODEGBTABLE" in window) {
			return func();
		}
		charset = "gbk";
	} else if (charset.indexOf("BIG") > -1) {
		if ("UNICODEBIG5TABLE" in window) {
			return func();
		}
		charset = "big5";
	} else {
		return func();
	}
	waiting(1);
	var scriptname = script_root_path + "map/" + charset + "_map.js";
	loadJS(scriptname,
	function() {
		func();
		waiting(0)
	});
}

function loadJS(url, callback) {
	var head = document.getElementsByTagName("head")[0];
	var script = document.createElement('script');
	script.onload = script.onreadystatechange = script.onerror = function() {
		if (script && script.readyState && /^(?!(?:loaded|complete)$)/.test(script.readyState)) return;
		script.onload = script.onreadystatechange = script.onerror = null;
		callback();
	};
	script.src = url;
	try {
		head.appendChild(script);
	} catch(e) {}
}



function localize(lang) {
	if (lang && 'type' in lang) { // it's a event
		var elem = lang.target || lang.srcElement;
		if (elem.hash) location.hash = 'lang:' + elem.hash;
	}
	if (!window.lang) window.lang = 'en';
	if (!window.langs) window.langs = {};
	var lang = location.hash && location.hash.match(/lang:([a-z]{2})/);
	lang = (lang && lang.length > 0) ? lang[1] : window.lang;
	lang = (['en', 'zh'].indexOf(lang) > -1) ? lang: window.lang;
	//console.log(lang);
	if (lang != window.lang) {
		if (lang in window.langs) applyLang(lang);
		else loadJS(script_root_path + 'lang/' + lang + '.js',
		function() {
			applyLang(lang)
		});
	}
}

function applyLang(lang) {
	var langs = window.langs[lang];
	for (var i in langs) {
		var clz = "t:" + i,
		elems;
		if ((elems = document.getElementsByClassName(clz)).length > 0) {
			elems[0].innerHTML = langs[i];
		}
	}
	window.lang = lang;
	var langSelector = document.getElementById('lang-selector');
	if (langSelector) {
		var as = langSelector.getElementsByTagName('a');
		for (var i = 0; i < as.length; i++) {
			var a = as[i];
			if (!a.onclick) a.onclick = localize;
			a.className = a.className.replace(/\s/g, ' ').replace(/active/g, '');
			if (a.className.indexOf(lang) > -1) a.className = a.className + ' active';
		}
	}
}

function setSize(increase) {
	if (!setSize.original) {
		setSize.original = document.getElementById('string').clientHeight;
	}
	var step = 50;
	for (var i = 0; i < selects.length; i++) {
		var a = selects[i];
		if (increase && a.clientHeight) {
			a.style.height = a.clientHeight + step + "px";
		}
		if (!increase) {
			if (a.clientHeight - step < setSize.original) a.style.height = setSize.original + "px";
			else a.style.height = a.clientHeight - step + "px";
		}
	}
}

function init() {
	localize();
	updateByForm();
	var langSelector = document.getElementById('lang-selector');
	if (langSelector) {
		var as = langSelector.getElementsByTagName('a');
		for (var i = 0; i < as.length; i++) {
			var a = as[i];
			if (!a.onclick) a.onclick = localize;
			if (a.className.indexOf(lang) > -1) a.className = a.className + ' active';
		}
	}
	window.selects = document.getElementsByTagName("textarea");
}

~function() {
	if (!'getElementsByClassName' in document) {
		document.getElementsByClassName = function(cl) {
			var retnode = [];
			var elem = this.getElementsByTagName('*');
			for (var i = 0; i < elem.length; i++) {
				var classes = elem[i].className;
				if (new RegExp('\\b' + cl + '\\b').test(classes)) retnode.push(elem[i]);
			}
			return retnode;
		}
	}
} ();

window.onload = init;