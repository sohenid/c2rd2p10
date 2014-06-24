<?php /* Smarty version Smarty-3.1.12, created on 2014-06-11 15:06:49
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/produtos/produto-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100676962539846baeb2232-97581950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a85dd526ee2dca977367e768b49160c140af76d9' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/produtos/produto-form.tpl',
      1 => 1402510006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100676962539846baeb2232-97581950',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_539846baf053a7_24947639',
  'variables' => 
  array (
    'action' => 0,
    'v' => 0,
    'url_retorno' => 0,
    'acao' => 0,
    'e' => 0,
    'categorias' => 0,
    'categoria' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539846baf053a7_24947639')) {function content_539846baf053a7_24947639($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
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

        <div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['categoria_id']){?>error<?php }?>">
            <label class="control-label" for="categoria_id">Categoria</label>
            <div class="controls">
                <div class="span2 no-margin">
                    <select name="categoria_id" id="categoria_Id" data-placeholder="Escolha uma opção" class="span2 chosen" required="required" title="Categoria">
                        <option value="">-</option>
                        <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['categoria']->value['id'];?>
" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['categoria']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==$_smarty_tpl->tpl_vars['v']->value['categoria_id']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['categoria']->value['descricao'];?>
</option>
                        <?php } ?>
                    </select>
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['categoria_id']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['categoria_id'];?>
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
            
        <div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['preco']){?>error<?php }?>">
            <label class="control-label" for="preco">Preço</label>
            <div class="controls">
                <input id="preco" name="preco" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['preco'];?>
" required="required" title="Preço">
                <?php if ($_smarty_tpl->tpl_vars['e']->value['preco']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['preco'];?>
</span><?php }?>
            </div>
        </div>
            
        <div class="control-group banner-interno">
            <label class="control-label" for="imagem">Arquivo</label>
            <div class="controls">
                <input type="file" id="imagem" name="imagem" class="input-file span2"> 
                <span class="help-inline input-file-actions">
                    <a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .swf .jpg .png"><i class="icon-question-sign default"></i></a>
                        <?php if ($_smarty_tpl->tpl_vars['v']->value['imagem']){?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['v']->value['imagem'];?>
" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
                        <a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/produtos/removerArquivo<?php echo $_smarty_tpl->tpl_vars['v']->value['imagem'];?>
/?url_retorno=<?php echo urlencode(urlencode(urlencode($_SERVER['REQUEST_URI'])));?>
'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
                        <?php }?>
                </span>
            </div>
        </div>
    </fieldset>
</form><?php }} ?>