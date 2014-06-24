<?php /* Smarty version Smarty-3.1.12, created on 2014-03-11 13:26:22
         compiled from "/home/mixd/wwwroot/esqueleto/wwwroot/application/views/site/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155650624852208940444fb3-01248999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd3f97affedb208f50c395c970c9d5970b3dbad3' => 
    array (
      0 => '/home/mixd/wwwroot/esqueleto/wwwroot/application/views/site/index.tpl',
      1 => 1382716791,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155650624852208940444fb3-01248999',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52208940468836_35349790',
  'variables' => 
  array (
    'seo' => 0,
    'ir' => 0,
    'analytics' => 0,
    'malerta' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52208940468836_35349790')) {function content_52208940468836_35349790($_smarty_tpl) {?><?php if (!is_callable('smarty_function_google_analytics')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.google_analytics.php';
if (!is_callable('smarty_function_malerta')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.malerta.php';
?><!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    
    <title><?php echo $_smarty_tpl->tpl_vars['seo']->value['title'];?>
</title>
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value['description'];?>
" />
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value['keywords'];?>
" />
     
    <meta name="url" content="http://<?php echo $_SERVER['HTTP_HOST'];?>
/" /> 
    <meta name="siteinfo" content="robots.txt" />
    <meta name="revisit-after" content="1 weeks" />
    <meta name="robots" content="index, follow" /> 
    <meta name="author" content="http://<?php echo $_SERVER['HTTP_HOST'];?>
/" /> 
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <meta name="format-detection" content="telephone=no">

	<link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['seo']->value['canonical'];?>
" />  
	<link rel="index" title="<?php echo $_smarty_tpl->tpl_vars['seo']->value['title'];?>
" href="http://<?php echo $_SERVER['HTTP_HOST'];?>
/" />

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

<?php echo $_smarty_tpl->tpl_vars['ir']->value;?>


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

<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['analytics']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_google_analytics(array('code'=>$_tmp1),$_smarty_tpl);?>


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

<?php echo smarty_function_malerta(array('msn'=>$_smarty_tpl->tpl_vars['malerta']->value),$_smarty_tpl);?>

</body>    
</html><?php }} ?>