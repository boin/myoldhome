<?php
$dir = "./xml/";
$providers = array();
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if(is_file($dir.$file)){
            	$content = file_get_contents($dir.$file);
            	//var_dump($content);
            	$start_index = strpos($content, "ShortName>")+10;
            	$end_index = strpos($content, "</ShortName>") !== FALSE ? strpos($content, "</ShortName>") : strpos($content, "</os:ShortName>");
            	$title = substr($content, $start_index, $end_index - $start_index);
            	$start_index = strpos($content, "Description>")+12;
            	$end_index = strpos($content, "</Description>") !== FALSE ? strpos($content, "</Description>") : strpos($content, "</os:Description>");
            	$description = substr($content, $start_index, $end_index - $start_index);
            	$id = substr($file, 0, strpos($file, '.'));
            	if($id && $title)
            	$providers[$id] = array($title, $description);
            }
        }
        closedir($dh);
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="HandheldFriendly" content="true">
<title>浏览器搜索快速添加 | 黄欢 - BoinJJ</title>
<link href="/static/land.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 480px)" >
<link href="/static/site.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 481px)" >
<!--[if IE]><style type="text/css">#ff{display:none}#ie{display:block}</style><![endif]-->
<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 7]><style type="text/css">.unsupported { display: block }#ie,#ff{display:none;}</style><![endif]-->
<?php foreach($providers as $id=>$title){
echo"  <link title=\"$title[0]\" rel=\"search\" type=\"application/opensearchdescription+xml\" href=\"xml/$id.xml\" />\n";
}?>
</head>
<body>
<article id="wrapper">
  <header>
    <h1>常用搜索引擎快速添加</h1>
  </header>
  <section class="unsupported"> 
  	<h2>Sorry, 暂时不支持您的浏览器 :)</h2>
    <dl>
      <dt>目前支持…</dt>
      <dd>Internet Explorer 7 + </dd>
      <dd>Firefox 2.0 + </dd>
      <dd>更多浏览器正在测试中...</dd>
    </dl>
  </section>
  <section id="ie"> <span>Internet Explorer 请直接点击按钮添加</span>
    <ul>
      <?php foreach($providers as $id=>$title){
			echo"
				<li>
			    <button id=\"$id\" title=\"$title[1]\">$title[0]</button>
			    <p>$title[1]</p>
				</li>\n";
			}?>
    </ul>
  </section>
  <section id="ff">
    <div id="searchtip"><span>Firefox 请点搜索栏图标添加</span></div>
  </section>
  <section id="update">
    <h2>最近更新</h2>
    <ul>
      <li>
        <time>2010/12/9</time>
        更新到射手SSL版本；恩，有SSL的保护，体贴又周到</li>
    </ul>
  </section>
  <footer>
    <address>
    copyleft @ 2010 Boin <a href="mailto:me@huangh.com">联系我</a>
    </address>
  </footer>
</article>
<script type="text/javascript">
function install(id){
	var xmlpath = 'xml/'+id+'.xml';
	try{
		window.external.AddSearchProvider(xmlpath);
	}catch(e){
		alert('安装可耻地失败了……浏览器不支持么？')
	}
}
window.onload = function(){
	var bts = document.getElementsByTagName('button');
	for(var i=0;i<bts.length;i++){
		var bt=bts[i];
		bt.onclick = function(){
			if(this.id)install(this.id);	
		}
	}
}
</script>
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