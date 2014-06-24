<?php /* Smarty version Smarty-3.1.12, created on 2014-05-31 08:29:34
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/configuracoes/configuracao-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144536795389bd1e89d859-30556827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33e0337d30031389feba0bb485435565cc08759a' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/configuracoes/configuracao-form.tpl',
      1 => 1366662595,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144536795389bd1e89d859-30556827',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'configuracoes' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5389bd1e98d415_80551883',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5389bd1e98d415_80551883')) {function content_5389bd1e98d415_80551883($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>Configurações</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
			</div>
		</div>
	</section>

	<fieldset>

        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Aviso</h4>
            A alteração destes dados pode implicar em mal funcionamento do site. Caso tenha dúvidas, não altere os valores.
        </div>

		<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['configuracoes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
		
		<div class="control-group">
			<label class="control-label" for="<?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Identificador'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Nome'];?>
</label>
			<div class="controls">
				<input id="<?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Identificador'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Identificador'];?>
" class="span4" type="<?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Tipo'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Valor'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Nome'];?>
">
				<span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['v']->value['Config_Descricao'];?>
</span>
			</div>
		</div>    
		<?php } ?>
        
	</fieldset>
	<!--div class="form-actions">
		<button class="btn btn-primary" type="submit">Salvar</button>
		<button class="btn voltar" type="button">Voltar</button>
	</div-->	    			
</form><?php }} ?>