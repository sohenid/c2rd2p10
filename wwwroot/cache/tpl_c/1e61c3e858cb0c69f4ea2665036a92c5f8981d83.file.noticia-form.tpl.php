<?php /* Smarty version Smarty-3.1.12, created on 2014-05-31 08:37:43
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/noticias/noticia-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2513826745389bf07648847-63235940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e61c3e858cb0c69f4ea2665036a92c5f8981d83' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/noticias/noticia-form.tpl',
      1 => 1377798585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2513826745389bf07648847-63235940',
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
  'unifunc' => 'content_5389bf07700742_21358492',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5389bf07700742_21358492')) {function content_5389bf07700742_21358492($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/mobile/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['v']->value['Noticia_Id']){?><input type="hidden" name="Noticia_Id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
" /><?php }?>
<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Notícia</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/noticias/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Status']){?>error<?php }?>">
			<label class="control-label" for="noticiaStatus">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Noticia_Status" id="noticiaStatus" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Noticia_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Noticia_Status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
					</select>
					<?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Status']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Noticia_Status'];?>
</span><?php }?>
				</div>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Nome']){?>error<?php }?>">
			<label class="control-label" for="Noticia_Nome">Nome</label>
			<div class="controls">
				<input id="Noticia_Nome" name="Noticia_Nome" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Nome'];?>
" required="required" title="Nome">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Noticia_Nome'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Data']){?>error<?php }?>">		
			<label class="control-label" for="Noticia_Data">Data</label>
			<div class="controls">
				<input id="Noticia_Data" name="Noticia_Data" class="span2 datepicker" type="text" value="<?php if ($_smarty_tpl->tpl_vars['v']->value['Noticia_Data']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Noticia_Data'],"%d/%m/%Y");?>
<?php }else{ ?><?php echo smarty_modifier_date_format(time(),"%d/%m/%Y");?>
<?php }?>" required="required" title="Data">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Data']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Noticia_Data'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Descricao']){?>error<?php }?>">
			<label class="control-label" for="Noticia_Descricao">Descrição</label>
			<div class="controls">
				<textarea id="Noticia_Descricao" name="Noticia_Descricao" class="input-xlarge wysiwyg span10" data-image-upload="/admix/noticias/redactorImagensUpload" data-image-json="/admix/noticias/redactorImagensJson" rows="6" required="required" title="Descrição"><?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Descricao'];?>
</textarea>
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Noticia_Descricao']){?><p class="help-block"><?php echo $_smarty_tpl->tpl_vars['e']->value['Noticia_Descricao'];?>
</p><?php }?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Noticia_Ordem">Ordem</label>
			<div class="controls">
				<input id="Noticia_Ordem" name="Noticia_Ordem" class="span1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Ordem'];?>
">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
			</div>
		</div>
	</fieldset>
</form><?php }} ?>