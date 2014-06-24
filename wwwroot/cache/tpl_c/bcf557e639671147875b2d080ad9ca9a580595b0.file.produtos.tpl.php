<?php /* Smarty version Smarty-3.1.12, created on 2014-06-11 10:52:19
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/produtos/produtos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1092636874539846294df466-95074598%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcf557e639671147875b2d080ad9ca9a580595b0' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/produtos/produtos.tpl',
      1 => 1402494737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1092636874539846294df466-95074598',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_539846296770a1_30302749',
  'variables' => 
  array (
    'acao' => 0,
    'remover' => 0,
    'url_retorno' => 0,
    'busca' => 0,
    'print' => 0,
    'ord_campo' => 0,
    'ord_tipo' => 0,
    'categorias' => 0,
    'categoria' => 0,
    'b' => 0,
    'result' => 0,
    'v' => 0,
    'base_url_order' => 0,
    'nav_paginacao' => 0,
    'paginacao' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539846296770a1_30302749')) {function content_539846296770a1_30302749($_smarty_tpl) {?><?php if (!is_callable('smarty_function_adm_table_title')) include '/home/mixd/wwwroot/mobile/wwwroot/application/third_party/smarty/libs_3.1.12/plugins/function.adm_table_title.php';
?><section class="cabecalho-pagina">
    <div class="botoes">
        <h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Produtos</h2>
        <div class="pull-right">
            <?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
                <a class="btn btn-primary" href="/admix/produtos/inserir/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
                <a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
                <a class="btn btn-warning imprimir" href="/admix/produtos/?print=true&<?php echo $_SERVER['QUERY_STRING'];?>
" target="_blank"><i class="icon-print"></i> Imprimir</a>
                <button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
            <?php }else{ ?>
                <button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
                <a class="btn" href="/admix/produtos/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
            <?php }?>		
        </div>
    </div>
</section>

<?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
    <section class="busca <?php if ($_smarty_tpl->tpl_vars['busca']->value&&!$_smarty_tpl->tpl_vars['print']->value){?>visible<?php }?>">
        <div class="well">
            <form id="formBuscar" method="get" action="/admix/produtos/" name="formBuscar" class="form-buscar">
                <input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
                <input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
                <div class="row-fluid">
                    <div class="span2">
                        <label for="categoria_id">Categoria</label>
                        <select name="categoria_id" id="categoria_id" data-placeholder="Escolha uma opção" class="span12 chosen">
                            <option value="">-</option>
                            <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['categoria']->value['id'];?>
" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['categoria']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==$_smarty_tpl->tpl_vars['b']->value['id']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['categoria']->value['descricao'];?>
</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="span2">
                        <label for="id">ID</label>
                        <input type="text" id="ClienteId" name="id" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['id'];?>
" />
                    </div>
                    <div class="span2">
                        <label for="descricao">Descrição</label>
                        <input type="text" id="descricao" name="descricao" class="span12" value="<?php echo $_smarty_tpl->tpl_vars['b']->value['descricao'];?>
" />
                    </div>
                    <div class="span2">
                        <label for="status">Status</label>
                        <select name="status" id="status" data-placeholder="Escolha uma opção" class="span12 chosen">
                            <option value="">-</option>
                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['b']->value['status']=='1'){?> selected="selected" <?php }?>>Ativo</option>
                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['b']->value['status']=='0'){?> selected="selected" <?php }?>>Inativo</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
                <a href="/admix/produtos/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
            </form>
        </div>		
    </section>
<?php }?>

<section class="listagem" id="no-more-tables">
    <?php if ($_smarty_tpl->tpl_vars['result']->value){?>
        <?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
            <form id="formRemover" class="acaoRemover" method="post" action="/admix/produtos/remover" name="formRemover">
                <input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
                <input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
                <input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
            <?php }else{ ?>
                <form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/produtos/removerPost" name="formRemoverDefinitivo">
                    <input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                        <input type="hidden" name="ids[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
">
                    <?php } ?>	
                <?php }?>

                <form id="formRemover" class="acaoRemover" method="post" action="/admix/produtos/remover" name="formRemover">
                    <input type="hidden" name="url_retorno" value="<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
" />
                    <input type="hidden" name="ord_campo" value="<?php echo $_smarty_tpl->tpl_vars['ord_campo']->value;?>
" />
                    <input type="hidden" name="ord_tipo" value="<?php echo $_smarty_tpl->tpl_vars['ord_tipo']->value;?>
" />
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
                                    <th class="no-filter icon1 no-print hide-mobile">
                                        <input type="checkbox" class="check-all">
                                    </th>
                                <?php }?>
                                <th>
                                    <?php echo smarty_function_adm_table_title(array('titulo'=>'#','campo'=>'id','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>

                                </th>
                                <th>
                                    <?php echo smarty_function_adm_table_title(array('titulo'=>'Descrição','campo'=>'descricao','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>

                                </th>
                                <th style="text-align: center">
                                    Preço
                                </th>
                                <th style="text-align: center">
                                    Imagem
                                </th>
                                <th style="text-align: center">
                                    <?php echo smarty_function_adm_table_title(array('titulo'=>'Status','campo'=>'status','url_base'=>$_smarty_tpl->tpl_vars['base_url_order']->value,'ord_campo'=>$_smarty_tpl->tpl_vars['ord_campo']->value,'ord_tipo'=>$_smarty_tpl->tpl_vars['ord_tipo']->value,'remover'=>$_smarty_tpl->tpl_vars['remover']->value),$_smarty_tpl);?>

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
                                        <td data-title="Remover" class="no-print hide-mobile sem-clique" style="vertical-align: middle"><input type="checkbox" name="ids[]" value=<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
></td>
                                        <?php }?>
                                    <td data-title="#" style="vertical-align: middle"><?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
</td>
                                    <td data-title="Nome" style="vertical-align: middle"><?php echo $_smarty_tpl->tpl_vars['v']->value['descricao'];?>
</td>
                                    <td data-title="Preço" style="text-align: center; vertical-align: middle">
                                        <?php echo $_smarty_tpl->tpl_vars['v']->value['preco'];?>

                                    </td>
                                    <td data-title="Imagem" style="text-align: center"><img style="max-height: 100px" src="<?php echo $_smarty_tpl->tpl_vars['v']->value['imagem'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['v']->value['descricao'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['v']->value['descricao'];?>
"></td>
                                    <td data-title="Status" style="text-align: center; vertical-align: middle"><?php if ($_smarty_tpl->tpl_vars['v']->value['status']=='1'){?><span class="label label-success">Ativo</span><?php }else{ ?><span class="label label-important">Inativo</span><?php }?></span></td>
                                    <?php if (!$_smarty_tpl->tpl_vars['remover']->value){?>
                                        <td data-title="Remover / Editar" class="no-print sem-clique" style="vertical-align: middle">
                                            <a href="/admix/produtos/alterar/<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
/?url_retorno=<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
                                            <a href="/admix/produtos/remover/<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
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