<?php /* Smarty version Smarty-3.1.12, created on 2014-06-11 14:51:00
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/categorias/categoria-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6173774835398376e60d729-87195677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ebe06bd7c6cd1bf207c58ff68a6635bfaab8ceb' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/categorias/categoria-form.tpl',
      1 => 1402509057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6173774835398376e60d729-87195677',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5398376e6607b4_90225191',
  'variables' => 
  array (
    'action' => 0,
    'v' => 0,
    'url_retorno' => 0,
    'acao' => 0,
    'e' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5398376e6607b4_90225191')) {function content_5398376e6607b4_90225191($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['v']->value['id']){?><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" /><?php }?>
<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Categoria</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/categorias/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['status']){?>error<?php }?>">
			<label class="control-label" for="status">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="status" id="status" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['status']=='1'){?> selected="selected" <?php }?>>Ativo</option>
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
					</select>
					<?php if ($_smarty_tpl->tpl_vars['e']->value['descricao']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['descricao'];?>
</span><?php }?>
				</div>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['descricao']){?>error<?php }?>">
			<label class="control-label" for="descricao">Descrição</label>
			<div class="controls">
				<input id="descricao" name="descricao" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['descricao'];?>
" required="required" title="Descrição">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['descricao']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['descricao'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="imagem">Arquivo</label>
			<div class="controls">
				<input type="file" id="imagem" name="imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .gif .jpg .png"><i class="icon-question-sign default"></i></a>
					<?php if ($_smarty_tpl->tpl_vars['v']->value['imagem']){?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['imagem'];?>
" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/categorias/removerArquivo<?php echo $_smarty_tpl->tpl_vars['v']->value['imagem'];?>
/?url_retorno=<?php echo urlencode(urlencode(urlencode($_SERVER['REQUEST_URI'])));?>
'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					<?php }?>
				</span>
			</div>
		</div>
	</fieldset>
</form><?php }} ?>