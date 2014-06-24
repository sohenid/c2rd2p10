<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    
    <title>{$seo.title}</title>
    <meta name="description" content="{$seo.description}" />
    <meta name="keywords" content="{$seo.keywords}" />
     
    <meta name="url" content="http://{$smarty.server.HTTP_HOST}/" /> 
    <meta name="siteinfo" content="robots.txt" />
    <meta name="revisit-after" content="1 weeks" />
    <meta name="robots" content="index, follow" /> 
    <meta name="author" content="http://{$smarty.server.HTTP_HOST}/" /> 
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="format-detection" content="telephone=no">

	<link rel="canonical" href="{$seo.canonical}" />  
	<link rel="index" title="{$seo.title}" href="http://{$smarty.server.HTTP_HOST}/" />

	<link href="/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/estrutura/malerta.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/fontawesome/font-awesome.css" rel="stylesheet">
    <link href="/assets/css/fontawesome/font-awesome-size.css" rel="stylesheet">
    <link href="/assets/css/allinone/allinone_bannerRotator.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/allinone/modificado.css" rel="stylesheet" type="text/css">
    
    <!-- CSS -->
    <link href="/assets/css/site/reset.css" rel="stylesheet" type="text/css" />

</head>

<body>

<!-- TOPO DA PÁGINA -->
<header class="topo">

</header>

{$ir}

<!-- RODAPÉ DA PÁGINA -->
<footer class="rodape">

</footer>

<!-- JAVA SCRIPT -->

<!--[if IE]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 

<script src="/assets/js/jquery-1.8.2.min.js"></script>
<script src="/assets/js/jquery.malerta-0.1.js"></script>
<script src="/assets/js/jquery.tools.validator.min.js"></script>
<script src="/assets/js/jquery.maskedinput.1.3.1.min.js"></script>
<script src="/assets/js/jquery.placeholder.min.js"></script>
<script src="/assets/js/bootstrap/bootstrap.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="/assets/js/allinone/allinone_bannerRotator.js" type="text/javascript"></script>


<!-- INICIALIZA-->
<script src="/assets/js/site.js"></script>

{google_analytics code={$analytics}}
{literal}
<script type="text/javascript">
window.___gcfg = { lang: 'pt-BR' };
(function(w, d, s) {
    function go(){
        var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.src = url; js.id = id;
            fjs.parentNode.insertBefore(js, fjs);
        };
        load('//connect.facebook.net/pt_BR/all.js#xfbml=1', 'fbjssdk');
        load('https://apis.google.com/js/plusone.js', 'gplus1js');
        load('//platform.twitter.com/widgets.js', 'tweetjs');
    }
    if (w.addEventListener) { w.addEventListener("load", go, false); }
    else if (w.attachEvent) { w.attachEvent("onload",go); }
}(window, document, 'script'));
</script>
{/literal}
{malerta msn=$malerta}
</body>    
</html>