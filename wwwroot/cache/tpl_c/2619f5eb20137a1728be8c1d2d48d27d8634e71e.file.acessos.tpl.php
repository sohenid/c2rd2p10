<?php /* Smarty version Smarty-3.1.12, created on 2013-08-30 09:00:25
         compiled from "/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/acessos/acessos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78947747652208959c161d6-88754773%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2619f5eb20137a1728be8c1d2d48d27d8634e71e' => 
    array (
      0 => '/home/mixd/wwwroot/esqueleto/wwwroot/application/views/admix/acessos/acessos.tpl',
      1 => 1367954427,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78947747652208959c161d6-88754773',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'busca' => 0,
    'print' => 0,
    'ord_campo' => 0,
    'ord_tipo' => 0,
    'b' => 0,
    'result' => 0,
    'base_url_order' => 0,
    'remover' => 0,
    'v' => 0,
    'nav_paginacao' => 0,
    'paginacao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_52208959cbc318_69121007',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52208959cbc318_69121007')) {function content_52208959cbc318_69121007($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_adm_table_title')) include '/home/mixd/wwwroot/esqueleto/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.adm_table_title.php';
?><section class="cabecalho-pagina">
	<div class="botoes">
		<h2>Acessos</h2>
		<div class="pull-right">
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/acessos/?print=true&<?php echo $_SERVER['QUERY_STRING'];?>
" target="_blank"><i class="icon-print"></i> Imprimir</a>
		</div>
	</div>
</section>

<section class="busca <?php if ($_smarty_tpl->tpl_vars['busca']->value&&!$_smarty_tpl->tpl_vars['print']->value){?>visible<?php }?>">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/acessos/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
		<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
		<div class="row-fluid">
			<div class="span3">
				<label for="acessoNome">Nome</label>
				<input type="text" id="acessoNome" name="Acesso_Nome" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Acesso_Nome'];?>
" />
			</div>
			<div class="span3">
				<label for="acessoEmail">E-mail</label>
				<input type="text" id="acessoEmail" name="Acesso_Email" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Acesso_Email'];?>
" />
			</div>
			<div class="span2">
				<label for="acessoIP">IP</label>
				<input type="text" id="acessoIP" name="Acesso_IP" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Acesso_IP'];?>
" />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<label for="acessoData">Período</label>
				<input type="hidden" class="date-range-value" name="Acesso_Data" id="Acesso_Data" value="<?php if ($_smarty_tpl->tpl_vars['b']->value['Acesso_DataI']&&$_smarty_tpl->tpl_vars['b']->value['Acesso_DataF']){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Acesso_DataI'],'d/m/Y');?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Acesso_DataF'],'d/m/Y');?>
<?php }?>" />				
				<div class="date-range">
					<div class="btn-group">
						<a class="btn btn-primary" href="#"><i class="icon-calendar icon-white"></i> <span class="fake-data"><?php if ($_smarty_tpl->tpl_vars['b']->value['Acesso_DataI']&&$_smarty_tpl->tpl_vars['b']->value['Acesso_DataF']){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Acesso_DataI'],'d/m/Y');?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Acesso_DataF'],'d/m/Y');?>
<?php }else{ ?>Escolha um período<?php }?></span></a>
						<a class="btn btn-primary" href="#"><span class="caret"></span></a>
					</div>				
				</div>
			</div>
		</div>	
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/acessos/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>

<section class="listagem" id="no-more-tables">
<?php if ($_smarty_tpl->tpl_vars['result']->value){?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'#','campo'=>'Acesso_Id','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Nome','campo'=>'Acesso_Nome','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'E-mail','campo'=>'Acesso_Email','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Acesso','campo'=>'Acesso_Data','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'IP','campo'=>'Acesso_IP','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'País','campo'=>'Acesso_Pais','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
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
				<td data-title="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['Acesso_Id'];?>
</td>
				<td data-title="Nome"><?php echo $_smarty_tpl->tpl_vars['v']->value['Acesso_Nome'];?>
</td>
				<td data-title="E-mail"><?php echo $_smarty_tpl->tpl_vars['v']->value['Acesso_Email'];?>
</td>
				<td data-title="Acesso"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Acesso_Data'],"%d/%m/%Y %H:%M:%S");?>
</td>
				<td data-title="IP"><?php echo $_smarty_tpl->tpl_vars['v']->value['Acesso_IP'];?>
</td>
				<td data-title="País"><?php if ($_smarty_tpl->tpl_vars['v']->value['Acesso_Bandeira']){?><a href="#" class="country-<?php echo $_smarty_tpl->tpl_vars['v']->value['Acesso_Bandeira'];?>
 fake-link" rel="tooltip" title="<?php echo $_smarty_tpl->tpl_vars['v']->value['Acesso_Pais'];?>
"></a><?php }else{ ?><a href="#" class="country-00 fake-link" rel="tooltip" title="?"></a><?php }?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php echo $_smarty_tpl->tpl_vars['nav_paginacao']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['paginacao']->value;?>

<?php }else{ ?>
	<h6 class="center">Ops! Não encontramos nenhum registro.</h6>
<?php }?>
</section><?php }} ?>