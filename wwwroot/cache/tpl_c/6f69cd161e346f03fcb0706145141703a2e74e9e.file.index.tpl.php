<?php /* Smarty version Smarty-3.1.12, created on 2013-08-30 09:00:09
         compiled from "/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74189438952208949353678-30464253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f69cd161e346f03fcb0706145141703a2e74e9e' => 
    array (
      0 => '/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/index.tpl',
      1 => 1377788446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74189438952208949353678-30464253',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteNome' => 0,
    'print' => 0,
    'usuarioAvatar' => 0,
    'usuarioNome' => 0,
    'ir' => 0,
    'malerta' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52208949377581_59443471',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52208949377581_59443471')) {function content_52208949377581_59443471($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_thumbnail')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.thumbnail.php';
if (!is_callable('smarty_function_malerta')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.malerta.php';
?><!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Administração | <?php echo $_smarty_tpl->tpl_vars['siteNome']->value;?>
</title>
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<!--[if IE 7]>
	  <link rel="stylesheet" href="/assets/css/fontawesome/font-awesome-ie7.css">
	<![endif]-->
			
    <!-- Le styles -->
    <link href="/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap/datepicker.css" rel="stylesheet">
    <link href="/assets/css/redactor/redactor.css" rel="stylesheet">
    <link href="/assets/css/bootstrap/bootstrap-image-gallery.min.css" rel="stylesheet">
	<link href="/assets/css/bootstrap/no-more-tables.css" rel="stylesheet">
    <link href="/assets/css/fontawesome/font-awesome.css" rel="stylesheet">
	<link href="/assets/css/fontawesome/font-awesome-size.css" rel="stylesheet">
	<link href="/assets/css/estrutura/flags.css" rel="stylesheet">
    <link href="/assets/css/estrutura/malerta.css" rel="stylesheet">
    <link href="/assets/css/fileupload/jquery.fileupload-ui.css" rel="stylesheet">
	<link href="/assets/css/chosen/chosen.css" rel="stylesheet">
    <link href="/assets/css/admix/daterangepicker.css" rel="stylesheet">
	<link href="/assets/css/admix/mixd.css" rel="stylesheet">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/assets/img/ico/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/img/ico/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/ico/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/ico/apple-touch-icon-114x114.png">
    
  </head>

  <body <?php if ($_smarty_tpl->tpl_vars['print']->value){?> class="print" <?php }?>>
	<div class="wrap">    
	    <div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container-fluid">
	          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <a class="brand" href="#">MIXD Internet</a>
	          <div class="nav-collapse">
	            <ul class="nav">
	            	<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrativo <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/admix/usuarios">Usuários</a></li>
							<li><a href="/admix/acessos">Acessos</a></li>
							<li><a href="/admix/configuracoes">Configurações</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Conteúdo <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="/admix/noticias">Notícias</a></li>
							<li><a href="/admix/banners">Banners</a></li>
							<li><a href="/admix/clientes">Clientes</a></li>
							<li><a href="/admix/emails">E-mails</a></li>
						</ul>
					</li>
					
	            </ul>
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li class="dropdown avatar">
	              		<a href="#" class="avatar dropdown-toggle" data-toggle="dropdown"><img src="/assets/img/estrutura/avatar.png" width="26" height="26"> <b class="caret"></b></a>
	              		<ul class="dropdown-menu">
			                <li>
			                	<a href="/admix/meusdados" class="avatar-wrap">
			                		<img src="<?php if ($_smarty_tpl->tpl_vars['usuarioAvatar']->value){?><?php echo smarty_modifier_thumbnail($_smarty_tpl->tpl_vars['usuarioAvatar']->value,'32x32');?>
<?php }else{ ?>/assets/img/estrutura/sem-avatar.png<?php }?>"> 
			                		<span class="titulo"><?php echo $_smarty_tpl->tpl_vars['usuarioNome']->value;?>
</span>
									<span class="subtitulo">Alterar meus dados</span>
								</a>
							</li>
			                <li class="divider"></li>
			                <li><a href="/admix/login/logout">Sair</a></li>
	              		</ul>
	            	</li>
	          	</ul>  
	          </div><!--/.nav-collapse -->
	        </div>
	      </div>
	    </div>
    
		<section class="body">
			<!-- Le container -->
			<div class="container-fluid"> 
				<?php echo $_smarty_tpl->tpl_vars['ir']->value;?>
	
			   
		    </div>
		</section>
    
		<div class="push"></div>
	</div><!--/.wrap -->
	
	<footer class="footer">
		<p class="pull-right"><a href="#">Subir</a></p>
		<p>Desenvolvido por <a href="http://www.mixd.com.br/" target="_blank">MIXD Internet</a>.</p>
	</footer>
    
    <!-- Le javascript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/js/jquery-1.8.2.min.js"><\/script>')</script>    
    <!--script src="/assets/js/jquery-1.8.2.min.js"></script-->
	<script src="/assets/js/date.js"></script>
    <script src="/assets/js/jquery.tools.validator.js"></script>
    <script src="/assets/js/jquery.malerta-0.1.js"></script>
    <script src="/assets/js/jquery.filestyle.mini.js"></script>
    <script src="/assets/js/redactor/langs/pt_br.js"></script>
    <script src="/assets/js/redactor/redactor.min.js"></script>
    <script src="/assets/js/jquery-ui-1.9.2.sortable.min.js"></script>
    <script src="/assets/js/jquery.ui.touch-punch.js"></script>
    <script src="/assets/js/fileupload/tmpl.min.js"></script>
    <script src="/assets/js/fileupload/load-image.min.js"></script>
    <script src="/assets/js/fileupload/canvas-to-blob.min.js"></script>
    <script src="/assets/js/fileupload/jquery.iframe-transport.js"></script>
    <script src="/assets/js/fileupload/jquery.fileupload.js"></script>
    <script src="/assets/js/fileupload/jquery.fileupload-fp.js"></script>
    <script src="/assets/js/fileupload/jquery.fileupload-ui.js"></script>
    <script src="/assets/js/fileupload/locale.js"></script>
    <script src="/assets/js/fileupload/mupload.js"></script>
    <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/js/bootstrap/bootstrap-datepicker.js"></script>
    <script src="/assets/js/bootstrap/bootstrap-image-gallery.min.js"></script>
    <script src="/assets/js/bootstrap/bootstrap-colorpicker.js"></script>
    <script src="/assets/js/jquery.chosen.min.js"></script>
    <script src="/assets/js/jquery.daterangepicker.js"></script>
    <script src="/assets/js/jquery.maskMoney.js"></script>
    <script src="/assets/js/jquery.maskedinput.1.3.1.min.js"></script>
    <script src="/assets/js/admix.js"></script>
    
    <?php echo smarty_function_malerta(array('msn'=>$_smarty_tpl->tpl_vars['malerta']->value),$_smarty_tpl);?>

</body>
</html>		<?php }} ?>