<?php /* Smarty version Smarty-3.1.12, created on 2013-08-29 19:36:06
         compiled from "/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/emails/emails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:874973524521fccd60112c2-22329438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa78abcf054561b3f525138010b04de81809e435' => 
    array (
      0 => '/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/emails/emails.tpl',
      1 => 1365445086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '874973524521fccd60112c2-22329438',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'acao' => 0,
    'remover' => 0,
    'url_retorno' => 0,
    'busca' => 0,
    'print' => 0,
    'ord_campo' => 0,
    'ord_tipo' => 0,
    'b' => 0,
    'result' => 0,
    'v' => 0,
    'base_url_order' => 0,
    'nav_paginacao' => 0,
    'paginacao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_521fccd60c43b1_18506345',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521fccd60c43b1_18506345')) {function content_521fccd60c43b1_18506345($_smarty_tpl) {?><?php if (!is_callable('smarty_function_adm_table_title')) include '/home/mixd/wwwroot/agencialed/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.adm_table_title.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/agencialed/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
?><section class="cabecalho-pagina">
	<div class="botoes">
		<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 E-mails</h2>
		<div class="pull-right">
		<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/emails/?print=true&<?php echo $_SERVER['QUERY_STRING'];?>
" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		<?php }else{ ?>
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/emails/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		<?php }?>		
		</div>
	</div>
</section>

<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
<section class="busca <?php if ($_smarty_tpl->tpl_vars['busca']->value&&!$_smarty_tpl->tpl_vars['print']->value){?>visible<?php }?>">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/emails/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
		<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
		<div class="row-fluid">
			<div class="span2">
				<label for="emailId">Código</label>
				<input type="text" id="emailId" name="Email_Id" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Email_Id'];?>
" />
			</div>
			<div class="span3">
				<label for="emailNome">Nome</label>
				<input type="text" id="emailNome" name="Email_Nome" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Email_Nome'];?>
" />
			</div>
			<div class="span3">
				<label for="emailEmail">E-mail</label>
				<input type="text" id="emailEmail" name="Email_Email" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Email_Email'];?>
" />
			</div>
		</div>
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/emails/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>
<?php }?>

<section class="listagem" id="no-more-tables">
<?php if ($_smarty_tpl->tpl_vars['result']->value){?>
	<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/emails/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
	<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
	<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
	<?php }else{ ?>
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/emails/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Email_Id'];?>
">
	<?php } ?>
	<?php }?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				<?php }?>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'#','campo'=>'Email_Id','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Nome','campo'=>'Email_Nome','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'E-mail','campo'=>'Email_Email','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Cadastrado','campo'=>'Email_DataCadastro','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon1 no-print"></th>
				<?php }?>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			<tr>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value=<?php echo $_smarty_tpl->tpl_vars['v']->value['Email_Id'];?>
></td>
				<?php }?>
				<td data-title="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['Email_Id'];?>
</td>
				<td data-title="Nome"><?php echo $_smarty_tpl->tpl_vars['v']->value['Email_Nome'];?>
</td>
				<td data-title="E-mail"><?php echo $_smarty_tpl->tpl_vars['v']->value['Email_Email'];?>
</td>
				<td data-title="Cadastrado"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Email_DataCadastro'],"%d/%m/%Y %H:%M:%S");?>
</td>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<td data-title="Remover" class="no-print sem-clique">
					<a href="/admix/emails/remover/<?php echo $_smarty_tpl->tpl_vars['v']->value['Email_Id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
&ord_campo=<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
&ord_tipo=<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
				</td>
				<?php }?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</form>
	<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
		<?php echo $_smarty_tpl->tpl_vars['nav_paginacao']->value;?>

		<?php echo $_smarty_tpl->tpl_vars['paginacao']->value;?>

	<?php }?>
<?php }else{ ?>
	<h6 class="center">Ops! Não encontramos nenhum registro.</h6>
<?php }?>
</section><?php }} ?>