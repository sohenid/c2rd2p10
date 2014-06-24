<?php /* Smarty version Smarty-3.1.12, created on 2014-05-31 08:37:38
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/noticias/noticias.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7317675015389bf02b5daa9-47912338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '731bbf570592ad862d7e8394a0b024a35c2e1ea7' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/noticias/noticias.tpl',
      1 => 1377800070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7317675015389bf02b5daa9-47912338',
  'function' => 
  array (
  ),
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
    'result' => 0,
    'v' => 0,
    'base_url_order' => 0,
    'nav_paginacao' => 0,
    'paginacao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5389bf02e33969_46705642',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5389bf02e33969_46705642')) {function content_5389bf02e33969_46705642($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/mixd/wwwroot/mobile/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_adm_table_title')) include '/home/mixd/wwwroot/mobile/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.adm_table_title.php';
?><section class="cabecalho-pagina">
	<div class="botoes">
		<h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Notícias</h2>
		<div class="pull-right">
		<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
			<a class="btn btn-primary" href="/admix/noticias/inserir/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/noticias/?print=true&<?php echo $_SERVER['QUERY_STRING'];?>
" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		<?php }else{ ?>
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/noticias/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		<?php }?>		
		</div>
	</div>
</section>

<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
<section class="busca <?php if ($_smarty_tpl->tpl_vars['busca']->value&&!$_smarty_tpl->tpl_vars['print']->value){?>visible<?php }?>">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/noticias/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
		<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
		<div class="row-fluid">
			<div class="span2">
				<label for="noticiaId">Código</label>
				<input type="text" id="noticiaId" name="Noticia_Id" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Noticia_Id'];?>
" />
			</div>
			<div class="span4">
				<label for="noticiaNome">Nome</label>
				<input type="text" id="noticiaNome" name="Noticia_Nome" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['Noticia_Nome'];?>
" />
			</div>
			<div class="span2">
				<label for="noticiaDataI">A partir de</label>
				<input type="text" id="noticiaDataI" name="Noticia_DataI" class="span12 datepicker" value="<?php if ($_smarty_tpl->tpl_vars['b']->value['Noticia_DataI']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Noticia_DataI'],"%d/%m/%Y");?>
<?php }?>" />
			</div>
			<div class="span2">
				<label for="noticiaDataF">Até</label>
				<input type="text" id="noticiaDataF" name="Noticia_DataF" class="span12 datepicker" value="<?php if ($_smarty_tpl->tpl_vars['b']->value['Noticia_DataF']!=''){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['b']->value['Noticia_DataF'],"%d/%m/%Y");?>
<?php }?>" />
			</div>
			<div class="span2">
				<label for="noticiaStatus">Status</label>
				<select name="Noticia_Status" id="noticiaStatus" data-placeholder="Escolha uma opção" class="span12 chosen">
					<option value="">-</option>
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['b']->value['Noticia_Status']==1){?> selected="selected" <?php }?>>Ativo</option>
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['b']->value['Noticia_Status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
				</select>
			</div>
		</div>
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/noticias/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>
<?php }?>

<section class="listagem" id="no-more-tables">
<?php if ($_smarty_tpl->tpl_vars['result']->value){?>
	<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/noticias/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
	<input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
	<input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
	<?php }else{ ?>
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/noticias/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />
	<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
">
	<?php } ?>	
	<?php }?>
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				<?php }?>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'#','campo'=>'Noticia_Id','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Nome','campo'=>'Noticia_Nome','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Data','campo'=>'Noticia_Data','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
</th>
				<th>Ordem</th>
				<th><?php echo smarty_function_adm_table_title(array('titulo'=>'Status','campo'=>'Noticia_Status','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>
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
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value=<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
></td>
				<?php }?>
				<td data-title="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
</td>
				<td data-title="Nome"><?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Nome'];?>
</td>
				<td data-title="Data"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['Noticia_Data'],"%d/%m/%Y");?>
</td>
				<td data-title="Ordem"><?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Ordem'];?>
</td>
				<td data-title="Status"><?php if ($_smarty_tpl->tpl_vars['v']->value['Noticia_Status']==1){?><span class="label label-success">Ativo</span><?php }else{ ?><span class="label label-important">Inativo</span><?php }?></span></td>
				<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
				<td data-title="Remover / Editar" class="no-print sem-clique">
					<a href="/admix/noticias/alterar/<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
					<a href="/admix/noticias/imagens/<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" rel="tooltip" title="Imagens" class="btn-action btn-info"><i class="icon-camera default"></i></a>
					<a href="/admix/noticias/remover/<?php echo $_smarty_tpl->tpl_vars['v']->value['Noticia_Id'];?>
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
</section>	<?php }} ?>