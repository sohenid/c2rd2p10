<?php /* Smarty version Smarty-3.1.12, created on 2013-08-30 09:00:03
         compiled from "/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110011267752208943e3a891-06626844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15fc6755907594a15d8311a8edb5463cb7f1cda1' => 
    array (
      0 => '/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/login.tpl',
      1 => 1369075208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110011267752208943e3a891-06626844',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteNome' => 0,
    'malerta' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52208943e4c8e1_63461745',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52208943e4c8e1_63461745')) {function content_52208943e4c8e1_63461745($_smarty_tpl) {?><?php if (!is_callable('smarty_function_malerta')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.malerta.php';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Administração | <?php echo $_smarty_tpl->tpl_vars['siteNome']->value;?>
</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<!-- Le styles -->
<link href="/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
<link href="/assets/css/fontawesome/font-awesome.css" rel="stylesheet">
<link href="/assets/css/fontawesome/font-awesome-size.css" rel="stylesheet">
<link href="/assets/css/admix/mixd.css" rel="stylesheet">
<link href="/assets/css/estrutura/malerta.css" rel="stylesheet">
    
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="/assets/img/ico/favicon.ico">
<link rel="apple-touch-icon" href="/assets/img/ico/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="/assets/img/ico/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="/assets/img/ico/apple-touch-icon-114x114.png">
<style>
body {
	padding-top: 60px; 
}
</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="well wrap-login" >
				<form class="form-vertical validar" id="form-login" action="/admix/login/logar" method="post">
					<h3>Entrar no sistema</h3>
		  			
					<label for="Usuario_Email">E-mail</label>
					<input type="text" name="Usuario_Email" id="Usuario_Email" class="span12" autofocus required title="E-mail">
			
					<label for="Usuario_Senha">Senha</label>
					<input type="password" name="Usuario_Senha" id="Usuario_Senha" class="span12" required title="Senha">
		
					<label class="checkbox">
						<input type="checkbox" checked="true"> Continuar conectado
					</label>
		
					<input type="submit" value="Entrar" class="btn btn-primary">
					<a class="btn secondary switch" data-switch="form-esqueci-senha" href="#">Esqueci minha senha</a>
				</form>
		  
				<form class="hide validar" id="form-esqueci-senha" action="/admix/login/senha" method="post">
					<h3>Esqueci minha senha</h3>
						   
					<label>Email</label>
					<input type="text" name="Usuario_Email" id="Usuario_Email" class="span12" required title="E-mail">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a class="btn secondary switch" data-switch="form-login">Voltar</a>
				</form>
			</div>				
		</div>
		<footer>
			<p>
				
			</p>
		</footer>
	</div>

<!-- Le javascript -->
<script src="/assets/js/jquery-1.8.2.min.js"></script>
<script src="/assets/js/jquery.tools.validator.min.js"></script>
<script src="/assets/js/jquery.malerta-0.1.js"></script>

<script>
$(function() {
	$('.recuperar-senha, .efetuar-login').bind({
		click: function(e) {
			e.preventDefault();
			$('#formRecuperarSenha .m-login, #formLogin .m-login').toggleClass('in');
		}
	});

	$.tools.validator.addEffect('malerta', function(errors, event) {
		var input = errors[0].input;
		input.focus();
		var mensagem = input.attr('title');
		$('body').mAlerta({message: 'Preencha o campo <strong>' + mensagem + '</strong> corretamente.', close: 3000});			
	});		

	$('form.validar').validator({ 
		singleError: 'true',
		effect: 'malerta',
		errorInputEvent: null		
	});

	$(document).delegate('.switch', 'click', function(){
		var c = $(this).attr('data-switch');
		$('#form-login').slideUp(300, function(){ $(this).addClass('hide'); });
		$('#form-esqueci-senha').slideUp(300, function(){ $(this).addClass('hide'); });
		$('#'+c).slideDown(300, function(){
			$(this).removeClass('hide');
			$('input:first', this).focus();
		});
		c = null;
	});
	
});	
</script>

    
<?php echo smarty_function_malerta(array('msn'=>$_smarty_tpl->tpl_vars['malerta']->value),$_smarty_tpl);?>

</body>
</html>		<?php }} ?>