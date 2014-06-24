<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
    {if $v.id}<input type="hidden" name="id" value="{$v.id}" />{/if}
    <input type="hidden" name="url_retorno" value="{$url_retorno}" />

    <section class="cabecalho-pagina">
        <div class="botoes">
            <h2>{$acao} Chamado</h2>
            <div class="pull-right">
                <button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
                <a class="btn" href="/admix/chamados/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
            </div>
        </div>
    </section>

    <fieldset>
        <div class="control-group {if $e.status}error{/if}">
            <label class="control-label" for="status">Status</label>
            <div class="controls">
                <div class="span2 no-margin">
                    <select name="status" id="status" data-placeholder="Escolha uma opção" class="span2 chosen">
                        <option value="1" {if $v.status == '1'} selected="selected" {/if}>Aberto</option>
                        <option value="0" {if $v.status == '0'} selected="selected" {/if}>Atendido</option>
                    </select>
                    {if $e.status}<span class="help-inline">{$e.status}</span>{/if}
                </div>
            </div>
        </div>
        <div class="control-group {if $e.device_id}error{/if}">
            <label class="control-label" for="device_id">Device ID</label>
            <div class="controls">
                <input id="Noticia_Nome" name="device_id" class="span6" type="text" value="{$v.device_id}" required="required" title="Device ID">
                {if $e.device_id}<span class="help-inline">{$e.device_id}</span>{/if}
            </div>
        </div>

    </fieldset>
</form>