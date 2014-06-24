<?php /* Smarty version Smarty-3.1.12, created on 2014-06-11 12:39:51
         compiled from "/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/chamados/chamado-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19905866725397379dd78a73-95469229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16e3842d5decc15d502f636ece388cf031fdf630' => 
    array (
      0 => '/home/mixd/wwwroot/mobile/wwwroot/application/views/admix/chamados/chamado-form.tpl',
      1 => 1402501155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19905866725397379dd78a73-95469229',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5397379ddeebc1_97210198',
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
<?php if ($_valid && !is_callable('content_5397379ddeebc1_97210198')) {function content_5397379ddeebc1_97210198($_smarty_tpl) {?><form method="post" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" class="form-horizontal form-interno validar" enctype="multipart/form-data">
    <?php if ($_smarty_tpl->tpl_vars['v']->value['id']){?><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['id'];?>
" /><?php }?>
    <input type="hidden" name="url_retorno" value="<?php echo $_smarty_tpl->tpl_vars['url_retorno']->value;?>
" />

    <section class="cabecalho-pagina">
        <div class="botoes">
            <h2><?php echo $_smarty_tpl->tpl_vars['acao']->value;?>
 Chamado</h2>
            <div class="pull-right">
                <button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
                <a class="btn" href="/admix/chamados/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
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
                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['v']->value['status']=='1'){?> selected="selected" <?php }?>>Aberto</option>
                        <option value="0" <?php if ($_smarty_tpl->tpl_vars['v']->value['status']=='0'){?> selected="selected" <?php }?>>Atendido</option>
                    </select>
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['status']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['status'];?>
</span><?php }?>
                </div>
            </div>
        </div>
        <div class="control-group <?php if ($_smarty_tpl->tpl_vars['e']->value['device_id']){?>error<?php }?>">
            <label class="control-label" for="device_id">Device ID</label>
            <div class="controls">
                <input id="Noticia_Nome" name="device_id" class="span6" type="text" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['device_id'];?>
" required="required" title="Device ID">
                <?php if ($_smarty_tpl->tpl_vars['e']->value['device_id']){?><span class="help-inline"><?php echo $_smarty_tpl->tpl_vars['e']->value['device_id'];?>
</span><?php }?>
            </div>
        </div>

    </fieldset>
</form><?php }} ?>