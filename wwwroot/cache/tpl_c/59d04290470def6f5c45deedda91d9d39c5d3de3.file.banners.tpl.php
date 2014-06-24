<?php /* Smarty version Smarty-3.1.12, created on 2013-08-29 19:29:46
         compiled from "/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/banners/banners.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2089922968521f9418e913b2-69529297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59d04290470def6f5c45deedda91d9d39c5d3de3' => 
    array (
      0 => '/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/banners/banners.tpl',
      1 => 1377815385,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2089922968521f9418e913b2-69529297',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_521f9419066056_45748991',
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
    'l' => 0,
    'blv' => 0,
    'result' => 0,
    'v' => 0,
    'base_url_order' => 0,
    'nav_paginacao' => 0,
    'paginacao' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521f9419066056_45748991')) {function content_521f9419066056_45748991($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/agencialed/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_adm_table_title')) include '/home/mixd/wwwroot/agencialed/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.adm_table_title.php';
?><section class="cabecalho-pagina">
	<div class="botoes">
		<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Banners</h2>
		<div class="pull-right">
		<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
			<a class="btn btn-primary" href="/admix/banners/inserir/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/banners/?print=true&<?php echo $_SERVER['QUERY_STRING'];?>
" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		<?php }else{ ?>
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/banners/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		<?php }?>
		</div>
	</div>
</section>

<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
<section class="busca <?php if ($_smarty_tpl->tpl_vars['busca']->value&&!$_smarty_tpl->tpl_vars['print']->value){?>visible<?php }?>">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/banners/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
		<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
		<div class="row-fluid">
			<div class="span2">
				<label for="bannerId">Código</label>
				<input type="text" id="bannerId" name="Banner_Id" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Banner_Id'];?>
" />
			</div>
			<div class="span3">
				<label for="bannerNome">Nome</label>
				<input type="text" id="bannerNome" name="Banner_Nome" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Banner_Nome'];?>
" />
			</div>
			<div class="span2">
				<label for="bannerDataI">A partir de</label>
				<input type="text" id="bannerDataI" name="Banner_DataInicial" class="span12 datepicker" value="<?php if ($_smarty_tpl->tpl_vars['b']->value['Banner_DataInicial']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Banner_DataInicial'],"%d/%m/%Y");?>
<?php }?>" />
			</div>
			<div class="span2">
				<label for="bannerDataFinal">Até</label>
				<input type="text" id="bannerDataFinal" name="Banner_DataFinal" class="span12 datepicker" value="<?php if ($_smarty_tpl->tpl_vars['b']->value['Banner_DataFinal']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Banner_DataFinal'],"%d/%m/%Y");?>
<?php }?>" />
			</div>
			<div class="span2">
				<label for="bannerStatus">Status</label>
				<select name="Banner_Status" id="bannerStatus" data-placeholder="Escolha uma opção" class="span12 chosen">
					<option value="">-</option>
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['b']->value['Banner_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['b']->value['Banner_Status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
				</select>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<label for="bannerLocalizacao">Localização</label>
				<select id="bannerLocalizacao" name="Banner_Localizacao[]" data-placeholder="Escolha algumas opções" multiple class="span12 chosen" >
					<?php  $_smarty_tpl->tpl_vars['blv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['blv']->_loop = false;
 $_smarty_tpl->tpl_vars['bli'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['l']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['blv']->key => $_smarty_tpl->tpl_vars['blv']->value){
$_smarty_tpl->tpl_vars['blv']->_loop = true;
 $_smarty_tpl->tpl_vars['bli']->value = $_smarty_tpl->tpl_vars['blv']->key;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Id'];?>
" <?php if ($_smarty_tpl->tpl_vars['b']->value['Banner_Localizacao']&&in_array($_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Id'],$_smarty_tpl->tpl_vars['b']->value['Banner_Localizacao'])){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Nome'];?>
 (<?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Largura'];?>
x<?php echo $_smarty_tpl->tpl_vars['blv']->value['BannerLocalizacao_Altura'];?>
)</option>
					<?php } ?>
				</select>
				<!-- <input type="text" id="bannerLocalizacao" name="Banner_Localizacao" class="span3" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Banner_Localizacao'];?>
" /> -->
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12 botoes-buscar">
				<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
				<a href="/admix/banners/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
			</div>
		</div>		
	</form>
	</div>		
</section>
<?php }?>

<section class="listagem" id="no-more-tables">
<?php if ($_smarty_tpl->tpl_vars['result']->value){?>
	<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/banners/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
	<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
	<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
	<?php }else{ ?>
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/banners/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Id'];?>
">
	<?php } ?>
	<?php }?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				<?php }?>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'#','campo'=>'Banner_Id','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Nome','campo'=>'Banner_Nome','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Localização','campo'=>'Banner_Localizacao','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Data Inicial','campo'=>'Banner_DataInicial','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Data Final','campo'=>'Banner_DataFinal','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th>Ordem</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Status','campo'=>'Banner_Status','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon2 no-print"></th>
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
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value=<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Id'];?>
></td>
				<?php }?>
				<td data-title="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Id'];?>
</td>
				<td data-title="Nome"><?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Nome'];?>
</td>
				<td data-title="Localização"><?php echo $_smarty_tpl->tpl_vars['v']->value['BannerLocalizacao_Nome'];?>
 (<?php echo $_smarty_tpl->tpl_vars['v']->value['BannerLocalizacao_Largura'];?>
x<?php echo $_smarty_tpl->tpl_vars['v']->value['BannerLocalizacao_Altura'];?>
)</td>
				<td data-title="Data Inicial"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Banner_DataInicial'],"%d/%m/%Y");?>
</td>
				<td data-title="Data Final"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Banner_DataFinal'],"%d/%m/%Y");?>
</td>
				<td data-title="Ordem"><?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Ordem'];?>
</td>
				<td data-title="Status"><?php if ($_smarty_tpl->tpl_vars['v']->value['Banner_Status']==1){?><span class="label label-success">Ativo</span><?php }else{ ?><span class="label label-important">Inativo</span><?php }?></span></td>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<td data-title="Remover / Editar" class="no-print sem-clique">
					<a href="/admix/banners/alterar/<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
					<a href="/admix/banners/remover/<?php echo $_smarty_tpl->tpl_vars['v']->value['Banner_Id'];?>
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