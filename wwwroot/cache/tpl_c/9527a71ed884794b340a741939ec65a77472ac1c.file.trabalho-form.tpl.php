<?php /* Smarty version Smarty-3.1.12, created on 2013-08-30 08:52:41
         compiled from "/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/trabalhos/trabalho-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1216691546522085f0ea5e99-25847854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9527a71ed884794b340a741939ec65a77472ac1c' => 
    array (
      0 => '/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/trabalhos/trabalho-form.tpl',
      1 => 1377863554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1216691546522085f0ea5e99-25847854',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_522085f0f10f30_38976573',
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
<?php if ($_valid && !is_callable('content_522085f0f10f30_38976573')) {function content_522085f0f10f30_38976573($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['v']->value['Trabalho_Id']){?><input type="hidden" name="Trabalho_Id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Trabalho_Id'];?>
" /><?php }?>
<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Trabalho</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/trabalhos/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Trabalho_Status']){?>error<?php }?>">
			<label class="control-label" for="trabalhoStatus">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Trabalho_Status" id="trabalhoStatus" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Trabalho_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Trabalho_Status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
					</select>
					<?php if ($_smarty_tpl->tpl_vars['e']->value['Trabalho_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Trabalho_Nome'];?>
</span><?php }?>
				</div>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Trabalho_Nome']){?>error<?php }?>">
			<label class="control-label" for="Trabalho_Nome">Nome</label>
			<div class="controls">
				<input id="Trabalho_Nome" name="Trabalho_Nome" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Trabalho_Nome'];?>
" required="required" title="Nome">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Trabalho_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Trabalho_Nome'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Trabalho_Site']){?>error<?php }?>">
			<label class="control-label" for="Trabalho_Site">Site</label>
			<div class="controls">
				<input id="Trabalho_Site" name="Trabalho_Site" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Trabalho_Site'];?>
" required="required" title="Site">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Trabalho_Site']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Trabalho_Site'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Trabalho_Imagem">Arquivo</label>
			<div class="controls">
				<input type="file" id="Trabalho_Imagem" name="Trabalho_Imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .swf .jpg .png"><i class="icon-question-sign default"></i></a>
					<?php if ($_smarty_tpl->tpl_vars['v']->value['Trabalho_Imagem']){?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['Trabalho_Imagem'];?>
" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/trabalhos/removerArquivo<?php echo $_smarty_tpl->tpl_vars['v']->value['Trabalho_Imagem'];?>
/?url_retorno=<?php echo urlencode(urlencode(urlencode($_SERVER['REQUEST_URI'])));?>
'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					<?php }?>
				</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Trabalho_Ordem">Ordem</label>
			<div class="controls">
				<input id="Trabalho_Ordem" name="Trabalho_Ordem" class="span1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Trabalho_Ordem'];?>
">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
			</div>
		</div>
	</fieldset>
</form><?php }} ?>