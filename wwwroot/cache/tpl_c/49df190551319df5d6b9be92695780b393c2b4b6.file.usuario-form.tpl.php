<?php /* Smarty version Smarty-3.1.12, created on 2014-05-31 08:28:56
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/usuarios/usuario-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10747413155389bcf80796a2-25386857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49df190551319df5d6b9be92695780b393c2b4b6' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/usuarios/usuario-form.tpl',
      1 => 1368714126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10747413155389bcf80796a2-25386857',
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
    'is_administrador' => 0,
    'permissoes' => 0,
    'k' => 0,
    'p' => 0,
    'permissoesSelected' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5389bcf814f535_86490657',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5389bcf814f535_86490657')) {function content_5389bcf814f535_86490657($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Id']){?><input type="hidden" name="Usuario_Id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Id'];?>
" /><?php }?>
<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Usuário</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/usuarios/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="Usuario_Status">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Usuario_Status" id="Usuario_Status" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Status']==0){?> selected="selected" <?php }?>>Inativo</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Usuario_Nome']){?>error<?php }?>">
			<label class="control-label" for="Usuario_Nome">Nome</label>
			<div class="controls">
				<input id="Usuario_Nome" name="Usuario_Nome" class="span3" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Nome'];?>
" required="required" title="Nome">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Usuario_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Usuario_Nome'];?>
</span><?php }?>
			</div>
		</div>
		
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Usuario_Email']){?>error<?php }?>">
			<label class="control-label" for="Usuario_Email">E-mail</label>
			<div class="controls">
				<input id="Usuario_Email" name="Usuario_Email" class="span3" type="email" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Email'];?>
" required="required" title="E-mail" >
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Usuario_Email']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Usuario_Email'];?>
</span><?php }?>
			</div>
		</div>
		
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Usuario_Senha']){?>error<?php }?>">
			<label class="control-label" for="Usuario_Senha">Senha</label>
			<div class="controls">
				<div class="input-append">
					<input id="Usuario_Senha" name="Usuario_Senha" class="span2 pass-strength" type="password" value="" <?php if (!$_smarty_tpl->tpl_vars['v']->value['Usuario_Id']){?>required="required"<?php }?> title="Senha">
					<span class="add-on"><span class="label label-important">fraca</span></span>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Usuario_Senha']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Usuario_Senha'];?>
</span><?php }?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="Usuario_Imagem"> Imagem Ilustrativa</label>
			<div class="controls">
				<input type="file" id="Usuario_Imagem" name="Usuario_Imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Proporcional a 640x480"><i class="icon-question-sign default"></i></a>
					<?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Imagem']){?>
						<a href="#myModalUsuario_Imagem" data-toggle="modal" rel="tooltip" title="Visualizar" class="btn-action btn-success"><i class="icon-camera default"></i></a>
						<a href="javascript:if(confirm('Deseja realmente remover esta imagem?')){ location.href='/admix/usuarios/removerImagem<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Imagem'];?>
/?url_retorno=<?php echo urlencode(urlencode(urlencode($_SERVER['REQUEST_URI'])));?>
'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a><br />
						<div class="modal hide fade" id="myModalUsuario_Imagem" style="display: none;">
							<div class="modal-body">
								<img alt="" src="<?php echo $_smarty_tpl->tpl_vars['v']->value['Usuario_Imagem'];?>
">
							</div>
							<div class="modal-footer">
								<a data-dismiss="modal" class="btn" href="#">Fechar</a>
							</div>
						</div>
					<?php }?>
				</span>
			</div>
		</div>

		<?php if ($_smarty_tpl->tpl_vars['is_administrador']->value==true){?>
		<div class="control-group">
			<label class="control-label" for="Usuario_Administrador">Administrador</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Usuario_Administrador" id="Usuario_Administrador" data-placeholder="Escolha uma opção" class="span2 chosen mostra-permissoes">
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Administrador']==0){?> selected="selected" <?php }?>>Não</option>
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Usuario_Administrador']==1){?> selected="selected" <?php }?>>Sim</option>
					</select>
				</div>	
			</div>
		</div>
		<?php }?>
		
		<table class="table table-striped table-condensed table-bordered table-permissoes">				
		<thead>
			<tr>
				<th class="no-filter icon1"></th>
				<th>Permissões</th>
				<th>Visualizar</th>
				<th>Cadastrar</th>
				<th>Editar</th>
				<th>Remover</th>
			</tr>
		</thead>
        <tbody>
        	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['permissoes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
			<tr>
				<td><input type="checkbox" class="check-all-permissao"></td>
				<td><label class="table-checkbox-permissao"><?php echo ucfirst($_smarty_tpl->tpl_vars['k']->value);?>
</label></td>
				<td class="sem-clique"><?php if (isset($_smarty_tpl->tpl_vars['p']->value['index'])){?><input type="checkbox" name="Permissao_Id[]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['index'];?>
" id="pemissao<?php echo $_smarty_tpl->tpl_vars['p']->value['index'];?>
" <?php if (in_array($_smarty_tpl->tpl_vars['p']->value['index'],$_smarty_tpl->tpl_vars['permissoesSelected']->value)){?>checked="checked"<?php }?> /><?php }?></td>
				<td class="sem-clique"><?php if (isset($_smarty_tpl->tpl_vars['p']->value['inserir'])){?><input type="checkbox" name="Permissao_Id[]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['inserir'];?>
" id="pemissao<?php echo $_smarty_tpl->tpl_vars['p']->value['inserir'];?>
" <?php if (in_array($_smarty_tpl->tpl_vars['p']->value['inserir'],$_smarty_tpl->tpl_vars['permissoesSelected']->value)){?>checked="checked"<?php }?> /><?php }?></td>
				<td class="sem-clique"><?php if (isset($_smarty_tpl->tpl_vars['p']->value['alterar'])){?><input type="checkbox" name="Permissao_Id[]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['alterar'];?>
" id="pemissao<?php echo $_smarty_tpl->tpl_vars['p']->value['alterar'];?>
" <?php if (in_array($_smarty_tpl->tpl_vars['p']->value['alterar'],$_smarty_tpl->tpl_vars['permissoesSelected']->value)){?>checked="checked"<?php }?> /><?php }?></td>
				<td class="sem-clique"><?php if (isset($_smarty_tpl->tpl_vars['p']->value['remover'])){?><input type="checkbox" name="Permissao_Id[]" value="<?php echo $_smarty_tpl->tpl_vars['p']->value['remover'];?>
" id="pemissao<?php echo $_smarty_tpl->tpl_vars['p']->value['remover'];?>
" <?php if (in_array($_smarty_tpl->tpl_vars['p']->value['remover'],$_smarty_tpl->tpl_vars['permissoesSelected']->value)){?>checked="checked"<?php }?> /><?php }?></td>
			</tr>
			<?php } ?>
		
        </tbody>					
		</table>
				
	</fieldset>
</form><?php }} ?>