<?php /* Smarty version Smarty-3.1.12, created on 2014-03-11 13:28:34
         compiled from "/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/banners/banner-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74134180531f39b22f84d8-97848908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9252eb5c3871c8381afada68a16026b6042c875c' => 
    array (
      0 => '/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/banners/banner-form.tpl',
      1 => 1377815513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74134180531f39b22f84d8-97848908',
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
    'l' => 0,
    'blv' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_531f39b23aa647_48788486',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531f39b23aa647_48788486')) {function content_531f39b23aa647_48788486($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Id']){?><input type="hidden" name="Banner_Id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Id'];?>
" /><?php }?>
<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Banner</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/banners/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group">
			<label class="control-label" for="Banner_Status">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Banner_Status" id="Banner_Status" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Status']==0){?> selected="selected" <?php }?>>Inativo</option>
					</select>
				</div>
			</div>	
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Banner_Nome']){?>error<?php }?>">
			<label class="control-label" for="Banner_Nome">Nome</label>
			<div class="controls">
				<input id="Banner_Nome" name="Banner_Nome" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Nome'];?>
" required="required" title="Nome">
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Banner_Nome']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Banner_Nome'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['Banner_DataInicial']){?>error<?php }?>">		
			<label class="control-label" for="Banner_DataInicial">Data Inicial</label>
			<div class="controls">
				<input id="Banner_DataInicial" name="Banner_DataInicial" class="span2 datepicker" type="text" value="<?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_DataInicial']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Banner_DataInicial'],"%d/%m/%Y");?>
<?php }else{ ?><?php echo smarty_modifier_date_format(time(),"%d/%m/%Y");?>
<?php }?>" required="required" title="Data Inicial">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Inicio da vinculação do banner"><i class="icon-question-sign default"></i></a></span>
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Banner_DataInicial']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Banner_DataInicial'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group">		
			<label class="control-label" for="Banner_DataFinal">Data Final</label>
			<div class="controls">
				<input id="Banner_DataFinal" name="Banner_DataFinal" class="span2 datepicker" type="text" value="<?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_DataFinal']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Banner_DataFinal'],"%d/%m/%Y");?>
<?php }?>">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Não preencha para indeterminado."><i class="icon-question-sign default"></i></a></span>
				<?php if ($_smarty_tpl->tpl_vars['e']->value['Banner_DataFinal']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['Banner_DataFinal'];?>
</span><?php }?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Localizacao">Localização</label>
			<div class="controls">
				<div class="span3 no-margin">
					<select name="Banner_Localizacao" id="Banner_Localizacao" data-placeholder="Escolha uma opção" class="span3 chosen">
						<option value="">-</option>
						<?php  $_smarty_tpl->tpl_vars['blv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blv']->_loop = false;
 $_smarty_tpl->tpl_vars['bli'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['l']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blv']->key => $_smarty_tpl->tpl_vars['blv']->value){
$_smarty_tpl->tpl_vars['blv']->_loop = true;
 $_smarty_tpl->tpl_vars['bli']->value = $_smarty_tpl->tpl_vars['blv']->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Id'];?>
" <?php if ($_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Id']==$_smarty_tpl->tpl_vars['v']->value['Banner_Localizacao']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Nome'];?>
 (<?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Largura'];?>
x<?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Altura'];?>
)</option>
						<?php } ?>
					</select>
				</div>	
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Tipo">Tipo</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Banner_Tipo" id="Banner_Tipo" data-placeholder="Escolha uma opção" class="banner-tipo span2 chosen">
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Tipo']=='0'){?> selected="selected" <?php }?>>Banner Interno</option>
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Tipo']=='1'){?> selected="selected" <?php }?>>Banner Externo</option>
					</select>
				</div>	
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Conteudo">Conteúdo</label>
			<div class="controls">
				<textarea name="Banner_Conteudo" id="Banner_Conteudo" class="input-xlarge input-banner-externo span6" id="textarea" rows="3"><?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Conteudo'];?>
</textarea>
			</div>
		</div>
		<div class="control-group banner-externo">
			<label class="control-label" for="Banner_Script">Script</label>
			<div class="controls">
				<textarea name="Banner_Script" id="Banner_Script" class="input-xlarge input-banner-externo span6" id="textarea" rows="3"><?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Script'];?>
</textarea>
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Banner_Target">Target</label>
			<div class="controls">
				<div class="span3 no-margin">
					<select name="Banner_Target" id="Banner_Target" data-placeholder="Escolha uma opção" class="span3 chosen">
						<option value="_self" <?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Target']=='_self'){?> selected="selected" <?php }?>>Abrir na mesma janela</option>
						<option value="_blank" <?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Target']=='_blank'){?> selected="selected" <?php }?>>Abrir em uma nova janela</option>
					</select>
				</div>	
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Banner_Link">Link</label>
			<div class="controls">
				<input id="Banner_Link" name="Banner_Link" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Link'];?>
">
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Banner_Arquivo">Arquivo</label>
			<div class="controls">
				<input type="file" id="Banner_Arquivo" name="Banner_Arquivo" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .swf .jpg .png"><i class="icon-question-sign default"></i></a>
					<?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Arquivo']){?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Arquivo'];?>
" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/banners/removerArquivo<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Arquivo'];?>
/?url_retorno=<?php echo urlencode(urlencode(urlencode($_SERVER['REQUEST_URI'])));?>
'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					<?php }?>
				</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Ordem">Ordem</label>
			<div class="controls">
				<input id="Banner_Ordem" name="Banner_Ordem" class="span1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Ordem'];?>
">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
			</div>
		</div>
	</fieldset>
	<!--div class="form-actions">
		<button class="btn btn-primary" type="submit">Salvar</button>
		<button class="btn voltar" type="button">Voltar</button>
	</div-->	    			
</form><?php }} ?>