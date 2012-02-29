<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="HandheldFriendly" content="true">
<meta name="viewport" content="width=device-width, height=device-height, target-densityDpi=240dpi">
<title>Text Escaping and Unescaping in JavaScript | 黄欢 - BoinJJ</title>
<link href="static/land.css" rel="stylesheet" type="text/css" media="only all and (max-width: 480px)">
<link href="static/site.css" rel="stylesheet" type="text/css" media="only all and (min-width: 481px)">
<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<header id="header">
  <nav>
    <ul id="lang-selector">
      <!-- <li>fr</li>
      <li>de</li>
      <li>jp</li>-->
      <li><a href="#lang:en" class="en" title="English">en</a></li>
      <li><a href="#lang:zh" class="zh" title="中文">zh</a></li>
    </ul>
  </nav>
  <h1 id="page-title" class="t:site-title">Text Escaping and Unescaping in JavaScript</h1>
</header>
<article class="main">
  <header>
    <figure class="t:site-desc"> A collection of utilities for text escaping and unescaping in JavaScript. Try typing "abc" in the first form to see how it works.  Any form can be edited. </figure>
  </header>
  <section class="formcontainer">
    <div class="formcol">
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:plain-text">Plain text</span></th>
            <td><strong><a href="javascript:void(0)" onclick="setSize(true)">+</a></strong>&nbsp;&nbsp;<strong><a href="javascript:void(0)" onclick="setSize(false)">-</a></strong>&nbsp;&nbsp; <a href="javascript:void(0)" onclick="javascript:toggleAll(this)">hide all</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="string" onkeyup="javascript:updateByString(this.value)">中文</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:utf16-escape">\uXXXX</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'utf16-escape')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="utf16-escape" onkeyup="javascript:updateByUtf16(this.value)">\u4E2D\u6587</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:utf16r-escape">Unicode-<span class="help" title="little-endian">LE</span> (for Intel X86)</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'utf16r-escape')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="utf16r-escape" onkeyup="javascript:updateByUtf16r(this.value)">2D4E8765</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:utf32-escape">\UXXXXXXXX</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'utf32-escape')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="utf32-escape" onkeyup="javascript:updateByUtf32(this.value)">\U00004E2D\U00006587</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:numref-dec">&amp;#DDDD;</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'numref-dec')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="numref-dec" onkeyup="javascript:updateByNumRefDec(this.value)">&amp;#20013;&amp;#25991;</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:numref-hex">&amp;#xXXXX;</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'numref-hex')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="numref-hex" onkeyup="javascript:updateByNumRefHex(this.value)">&amp;#x4E2D;&amp;#x6587;</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:punycode">Punycode</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'punycode')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="punycode" onkeyup="javascript:updateByPunyCode(this.value)">fiq228c</textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="formcol lastcol">
      <form class="encoding">
        <strong class="t:encoding-tip">Encoding for the followings:</strong>
        <select id="encoding" onchange="updateByForm()">
          <option selected="selected" value="UTF-8">UTF-8</option>
          <option value="GBK">GBK</option>
          <option value="BIG5">BIG5</option>
          <option value="ISO-8859-1">ISO-8859-1</option>
          <option value="Shift_JIS">Shift_JIS</option>
          <option value="EUC-JP">EUC-JP</option>
          <option value="ISO-2022-JP">ISO-2022-JP</option>
        </select>
      </form>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:hex-escape">\xXX</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'hex-escape')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="hex-escape" onkeyup="javascript:updateByHex(this.value)">\xE4\xB8\xAD\xE6\x96\x87</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:oct-escape">\OOO</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'oct-escape')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="oct-escape" onkeyup="javascript:updateByOct(this.value)">\344\270\255\346\226\207</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:base64">Base64</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'base64')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="base64" onkeyup="javascript:updateByBase64(this.value)">5Lit5paH</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:quoted-printable">Quoted-printable</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'quoted-printable')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="quoted-printable" onkeyup="javascript:updateByQuotedPrintable(this.value)">=E4=B8=AD=E6=96=87</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:url-escape">URL</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'url')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="url" onkeyup="javascript:updateByUrl(this.value)">%E4%B8%AD%E6%96%87</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:mime-b">MIME + Base64</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'mime-b')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="mime-b" onkeyup="javascript:updateByMimeBase64(this.value)">=?UTF-8?B?5Lit5paH?=</textarea></td>
          </tr>
        </tbody>
      </table>
      <table class="form">
        <tbody>
          <tr>
            <th><span class="t:mime-q">MIME + Quoted-printable</span></th>
            <td><a href="javascript:void(0)" onclick="javascript:toggleDisplay(this, 'mime-q')">hide</a></td>
          </tr>
          <tr>
            <td class="thin" colspan="2"><textarea  rows="2" id="mime-q" onkeyup="javascript:updateByMimeQuotedPrintable(this.value)">=?UTF-8?Q?=E4=B8=AD=E6=96=87?=</textarea></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
  <section>
    <h1 class="t:site-notes">Notes</h1>
    <ul>
      <li>No data is sent to the server (i.e. everything is done in JavaScript).</li>
      <li>Conversion from Unicode to other encodings such as Shift_JIS
        can be slow first time as it needs to initialize internal conversion
        tables.</li>
      <li>Surrogate pairs in UTF-16 are supported.  Try inserting <code>\uD840\uDC0B</code> in the second form. </li>
      <li>Three-byte characters in EUC-JP are not supported.</li>
    </ul>
    <h1 class="t:site-links">Links</h1>
    <ul>
      <li><a href="http://macchiato.com/unicode/chart/">JavaScript
        Unicode Charts</a></li>
      <li><a href="http://josefsson.org/idn.php">Try GNU Libidn</a></li>
      <li><a href="http://www.ietf.org/rfc/rfc1468.txt">RFC 1468
        Japanese Character Encoding for Internet Messages</a></li>
      <li><a href="http://www.ietf.org/rfc/rfc2396.txt">RFC 2396
        Uniform Resource Identifiers (URI): Generic Syntax</a></li>
      <li><a href="http://www.ietf.org/rfc/rfc2047.txt">RFC 2047
        - MIME (Multipurpose Internet Mail Extensions)
        Part Three: Message Header Extensions for Non-ASCII Text</a></li>
      <li><a href="http://www.ietf.org/rfc/rfc3490.txt">RFC 3490
        - Internationalizing Domain Names in Applications (IDNA)</a></li>
      <li><a href="http://www.ietf.org/rfc/rfc3491.txt">RFC 3491
        - Nameprep: A Stringprep Profile for
        Internationalized Domain Names (IDN)</a></li>
      <li><a href="http://www.ietf.org/rfc/rfc3492.txt">RFC 3492
        - Punycode: A Bootstring encoding of Unicode
        for Internationalized Domain Names in Applications (IDNA)</a></li>
      <li><a href="http://en.wikipedia.org/wiki/Internationalized_domain_name"> Internationalized domain name - Wikipedia</a></li>
    </ul>
  </section>
  <section>
    <h1 class="t:site-todo">TODO</h1>
    <ul>
      <li>RESTFUL api support</li>
      <li>More languages (such as fr, jp, de)</li>
    </ul>
    <h1 class="t:site-history">HISTORY</h1>
    <ul>
      <li>I18n Support (zh, en) 2011/01/19</li>
      <li>GBK, BIG5 encoding Support 2011/01/17</li>
    </ul>
  </section>
</article>
<footer class="main">
  <address class="t:site-powered">
  Powered by Boin. based on work of <a href="http://0xcc.net/">Satoru Takabayashi</a>
  </address>
</footer>
<script type="text/javascript">
var script_root_path = '/unicode/';
</script>
<script type="text/javascript" src="site.js"></script> 
<script type="text/javascript" src="punycode.js"></script> 
<script type="text/javascript" src="strutil.js"></script> 
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-597165-4']);
  _gaq.push(['_setDomainName', '.huangh.com']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>