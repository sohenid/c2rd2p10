<?php /* Smarty version Smarty-3.1.12, created on 2013-08-30 09:54:17
         compiled from "/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/usuarios/usuarios.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2141060709522095f9154490-51039430%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87b841b05fc54c1ae29cce7ac57d4d70076244ae' => 
    array (
      0 => '/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/usuarios/usuarios.tpl',
      1 => 1366980671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2141060709522095f9154490-51039430',
  'function' => 
  array (
  ),
  'variables' => 
  array (
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
  'unifunc' => 'content_522095f925b3d9_61436745',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_522095f925b3d9_61436745')) {function content_522095f925b3d9_61436745($_smarty_tpl) {?><?php if (!is_callable('smarty_function_adm_table_title')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.adm_table_title.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_thumbnail')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.thumbnail.php';
?><section class="cabecalho-pagina">
	<div class="botoes">
		<h2>Gerenciar Usuários</h2>
		<div class="pull-right">
		<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
			<a class="btn btn-primary" href="/admix/usuarios/inserir/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/usuarios/?print=true&<?php echo $_SERVER['QUERY_STRING'];?>
" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		<?php }else{ ?>
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/usuarios/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		<?php }?>			
		</div>
	</div>
</section>

<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
<section class="busca <?php if ($_smarty_tpl->tpl_vars['busca']->value&&!$_smarty_tpl->tpl_vars['print']->value){?>visible<?php }?>">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/usuarios/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
		<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
		<div class="row-fluid">
			<div class="span2">
				<label for="usuarioId">Código</label>
				<input type="text" id="usuarioId" name="Usuario_Id" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Usuario_Id'];?>
" />
			</div>
			<div class="span3">
				<label for="usuarioNome">Nome</label>
				<input type="text" id="usuarioNome" name="Usuario_Nome" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Usuario_Nome'];?>
" />
			</div>
			<div class="span3">
				<label for="usuarioEmail">E-mail</label>
				<input type="text" id="usuarioEmail" name="Usuario_Email" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Usuario_Email'];?>
" />
			</div>
			<div class="span2">
				<label for="usuarioStatus">Status</label>
				<select name="Usuario_Status" id="usuarioStatus" data-placeholder="Escolha uma opção" class="span12 chosen">
					<option value="">-</option>
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['b']->value['Usuario_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['b']->value['Usuario_Status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
				</select>
			</div>
		</div>
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/usuarios/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>
<?php }?>

<section class="listagem" id="no-more-tables">
<?php if ($_smarty_tpl->tpl_vars['result']->value){?>
	<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/usuarios/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
	<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
	<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
	<?php }else{ ?>	
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/usuarios/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Id'];?>
">
	<?php } ?>
	<?php }?>
	
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				<?php }?>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'#','campo'=>'Usuario_Id','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Nome','campo'=>'Usuario_Nome','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Email','campo'=>'Usuario_Email','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Último acesso','campo'=>'Usuario_UltimoAcesso','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Status','campo'=>'Usuario_Status','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon3 no-print"></th>
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
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value=<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Id'];?>
></td>
				<?php }?>
				<td data-title="#"><?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Administrador']==1){?><a href="#" class="fake-link" rel="tooltip" title="Administrador"><i class="icon-star default"></i></a><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Id'];?>
<?php }?></td>
				<td data-title="Nome"><?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Nome'];?>
</td>
				<td data-title="E-mail"><?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Email'];?>
</td>
				<td data-title="Último acesso"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Usuario_UltimoAcesso'],"%d/%m/%Y %H:%M");?>
</td>
				<td data-title="Status"><?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Status']==1){?><span class="label label-success">Ativo</span><?php }else{ ?><span class="label label-important">Inativo</span><?php }?></span></td>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<td data-title="Remover / Editar" class="no-print sem-clique">
					<a href="/admix/usuarios/alterar/<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil"></i></a>
					<a href="#" rel="tooltip" title="&lt;img src='<?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Imagem']){?><?php echo smarty_modifier_thumbnail($_smarty_tpl->tpl_vars['v']->value['Usuario_Imagem'],'32x32');?>
<?php }else{ ?>/assets/img/estrutura/sem-avatar.png<?php }?>' class='tooltip-img' &gt;" class="fake-link btn-action btn-info"><i class="icon-camera"></i></a>
					<a href="/admix/usuarios/remover/<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
&ord_campo=<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
&ord_tipo=<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove"></i></a>
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
</section>	<?php }} ?>