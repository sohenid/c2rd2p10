<?php /* Smarty version Smarty-3.1.12, created on 2014-06-10 12:25:03
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/clientes/cliente-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11176019205397234fbc8c37-80879213%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5656d6ab680989c7e8a0e775fa8663bf64eb6d0' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/clientes/cliente-form.tpl',
      1 => 1377787945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11176019205397234fbc8c37-80879213',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'v' => 0,
    'url_retorno' => 0,
    'acao' => 0,
    'e' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5397234fc18dc5_05615664',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397234fc18dc5_05615664')) {function content_5397234fc18dc5_05615664($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['v']->value['Cliente_Id']){?><input type="hidden" name="Cliente_Id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Cliente_Id'];?>
" /><?php }?>
<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Cliente</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/clientes/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Cliente_Status']){?>error<?php }?>">
			<label class="control-label" for="clienteStatus">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Cliente_Status" id="clienteStatus" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Cliente_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Cliente_Status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
					</select>
					<?php if ($_smarty_tpl->tpl_vars['e']->value['Cliente_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Cliente_Nome'];?>
</span><?php }?>
				</div>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Cliente_Nome']){?>error<?php }?>">
			<label class="control-label" for="Cliente_Nome">Nome</label>
			<div class="controls">
				<input id="Cliente_Nome" name="Cliente_Nome" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Cliente_Nome'];?>
" required="required" title="Nome">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Cliente_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Cliente_Nome'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Cliente_Imagem">Arquivo</label>
			<div class="controls">
				<input type="file" id="Cliente_Imagem" name="Cliente_Imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .swf .jpg .png"><i class="icon-question-sign default"></i></a>
					<?php if ($_smarty_tpl->tpl_vars['v']->value['Cliente_Imagem']){?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['Cliente_Imagem'];?>
" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/clientes/removerArquivo<?php echo $_smarty_tpl->tpl_vars['v']->value['Cliente_Imagem'];?>
/?url_retorno=<?php echo urlencode(urlencode(urlencode($_SERVER['REQUEST_URI'])));?>
'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					<?php }?>
				</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Cliente_Ordem">Ordem</label>
			<div class="controls">
				<input id="Cliente_Ordem" name="Cliente_Ordem" class="span1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Cliente_Ordem'];?>
">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
			</div>
		</div>
	</fieldset>
</form><?php }} ?>