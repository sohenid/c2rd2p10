<section class="cabecalho-pagina">
    <div class="botoes">
        <h2>{$acao} Chamados</h2>
        <div class="pull-right">
            {if !$remover }
                <a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
                <a class="btn btn-warning imprimir" href="/admix/chamados/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
                <button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
            {else}
                <button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
                <a class="btn" href="/admix/chamados/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
            {/if}		
        </div>
    </div>
</section>

{if !$remover }
    <section class="busca {if $busca && !$print}visible{/if}">
        <div class="well">
            <form id="formBuscar" method="get" action="/admix/chamados/" name="formBuscar" class="form-buscar">
                <input type="hidden" name="ord_campo" value="{$ord_campo}" />
                <input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
                <div class="row-fluid">
                    <div class="span2">
                        <label for="id">Código</label>
                        <input type="text" id="id" name="id" class="span12" value="{$b.id}" />
                    </div>
                    <div class="span4">
                        <label for="device_id">Device ID</label>
                        <input type="text" id="device_id" name="device_id" class="span12" value="{$b.device_id}" />
                    </div>
                </div>
                <button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
                <a href="/admix/chamados/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
            </form>
        </div>		
    </section>
{/if}

<section class="listagem" id="no-more-tables">
    {if $result}
        {if !$remover}
            <form id="formRemover" class="acaoRemover" method="post" action="/admix/chamados/remover" name="formRemover">
                <input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
                <input type="hidden" name="ord_campo" value="{$ord_campo}" />
                <input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
            {else}
                <form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/chamados/removerPost" name="formRemoverDefinitivo">
                    <input type="hidden" name="url_retorno" value="{$url_retorno}" />
                    {foreach $result as $k => $v}
                        <input type="hidden" name="ids[]" value="{$v.id}">
                    {/foreach}	
                {/if}
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            {if !$remover }
                                <th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
                                {/if}
                            <th>{adm_table_title titulo='#' campo='id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
                            <th>{adm_table_title titulo='Device ID' campo='device_id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
                            <th>{adm_table_title titulo='Data' campo='data_insert' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
                                {if !$remover }
                                <th class="no-filter icon3 no-print"></th>
                                {/if}
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $result as $k => $v}
                            <tr>
                                {if !$remover}
                                    <td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value={$v.id}></td>
                                    {/if}
                                <td data-title="#">{$v.id}</td>
                                <td data-title="Device ID">{$v.device_id}</td>
                                <td data-title="Data">{$v.data_insert|date_format:"%d/%m/%Y às %H:%M:%S"}</td>
                                {*				<td data-title="Status">{if $v.status == 1}<span class="label label-success">Ativo</span>{else}<span class="label label-important">Inativo</span>{/if}</span></td>*}
                                {if !$remover}
                                    <td data-title="Remover / Editar" class="no-print sem-clique">
                                        <a href="/admix/chamados/alterar/{$v.id}/?url_retorno={$url_retorno}" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
                                        <a href="/admix/chamados/remover/{$v.id}/?url_retorno={$url_retorno}&ord_campo={$ord_campo}&ord_tipo={$ord_tipo}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
                                    </td>
                                {/if}
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </form>
            {if !$remover }
                {$nav_paginacao}
                {$paginacao}
            {/if}	
        {else}
            <h6 class="center">Ops! Não encontramos nenhum registro.</h6>
        {/if}
</section>	