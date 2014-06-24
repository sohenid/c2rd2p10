<section class="cabecalho-pagina">
    <div class="botoes">
        <h2>{$acao} Categorias</h2>
        <div class="pull-right">
            {if !$remover }
                <a class="btn btn-primary" href="/admix/categorias/inserir/?url_retorno={$url_retorno}"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
                <a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
                <a class="btn btn-warning imprimir" href="/admix/categorias/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
                <button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
            {else}
                <button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
                <a class="btn" href="/admix/categorias/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
            {/if}		
        </div>
    </div>
</section>

{if !$remover }
    <section class="busca {if $busca && !$print}visible{/if}">
        <div class="well">
            <form id="formBuscar" method="get" action="/admix/categorias/" name="formBuscar" class="form-buscar">
                <input type="hidden" name="ord_campo" value="{$ord_campo}" />
                <input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
                <div class="row-fluid">
                    <div class="span2">
                        <label for="id">ID</label>
                        <input type="text" id="ClienteId" name="id" class="span12" value="{$b.id}" />
                    </div>
                    <div class="span3">
                        <label for="descricao">Descrição</label>
                        <input type="text" id="descricao" name="descricao" class="span12" value="{$b.descricao}" />
                    </div>
                    <div class="span2">
                        <label for="status">Status</label>
                        <select name="status" id="status" data-placeholder="Escolha uma opção" class="span12 chosen">
                            <option value="">-</option>
                            <option value="1" {if $b.status == '1'} selected="selected" {/if}>Ativo</option>
                            <option value="0" {if $b.status == '0'} selected="selected" {/if}>Inativo</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
                <a href="/admix/categorias/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
            </form>
        </div>		
    </section>
{/if}

<section class="listagem" id="no-more-tables">
    {if $result}
        {if !$remover}
            <form id="formRemover" class="acaoRemover" method="post" action="/admix/categorias/remover" name="formRemover">
                <input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
                <input type="hidden" name="ord_campo" value="{$ord_campo}" />
                <input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
            {else}
                <form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/categorias/removerPost" name="formRemoverDefinitivo">
                    <input type="hidden" name="url_retorno" value="{$url_retorno}" />
                    {foreach $result as $k => $v}
                        <input type="hidden" name="ids[]" value="{$v.id}">
                    {/foreach}	
                {/if}

                <form id="formRemover" class="acaoRemover" method="post" action="/admix/categorias/remover" name="formRemover">
                    <input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
                    <input type="hidden" name="ord_campo" value="{$ord_campo}" />
                    <input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                {if !$remover }
                                    <th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
                                    {/if}
                                <th>
                                    {adm_table_title titulo='#' campo='id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}
                                </th>
                                <th>
                                    {adm_table_title titulo='Descrição' campo='descricao' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}
                                </th>
                                <th style="text-align: center">
                                    Imagem
                                </th>
                                <th style="text-align: center">
                                    {adm_table_title titulo='Status' campo='status' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}
                                </th>
                                {if !$remover }
                                    <th class="no-filter icon2 no-print"></th>
                                    {/if}
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $result as $k => $v}
                                <tr>
                                    {if !$remover}
                                        <td data-title="Remover" class="no-print hide-mobile sem-clique" style="vertical-align: middle"><input type="checkbox" name="ids[]" value={$v.id}></td>
                                        {/if}
                                    <td data-title="#" style="vertical-align: middle">{$v.id}</td>
                                    <td data-title="Nome" style="vertical-align: middle">{$v.descricao}</td>
                                    <td data-title="Imagem" style="text-align: center"><img style="max-height: 100px" src="{$v.imagem}" alt="{$v.descricao}" title="{$v.descricao}"></td>
                                    <td data-title="Status" style="text-align: center; vertical-align: middle">{if $v.status == '1'}<span class="label label-success">Ativo</span>{else}<span class="label label-important">Inativo</span>{/if}</span></td>
                                    {if !$remover}
                                        <td data-title="Remover / Editar" class="no-print sem-clique" style="vertical-align: middle">
                                            <a href="/admix/categorias/alterar/{$v.id}/?url_retorno={$url_retorno}" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
                                            <a href="/admix/categorias/remover/{$v.id}/?url_retorno={$url_retorno}&ord_campo={$ord_campo}&ord_tipo={$ord_tipo}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
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