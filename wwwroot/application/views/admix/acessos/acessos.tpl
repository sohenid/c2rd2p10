<section class="cabecalho-pagina">
	<div class="botoes">
		<h2>Acessos</h2>
		<div class="pull-right">
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/acessos/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
		</div>
	</div>
</section>

<section class="busca {if $busca && !$print}visible{/if}">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/acessos/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="{$ord_campo}" />
		<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
		<div class="row-fluid">
			<div class="span3">
				<label for="acessoNome">Nome</label>
				<input type="text" id="acessoNome" name="Acesso_Nome" class="span12" value="{$b.Acesso_Nome}" />
			</div>
			<div class="span3">
				<label for="acessoEmail">E-mail</label>
				<input type="text" id="acessoEmail" name="Acesso_Email" class="span12" value="{$b.Acesso_Email}" />
			</div>
			<div class="span2">
				<label for="acessoIP">IP</label>
				<input type="text" id="acessoIP" name="Acesso_IP" class="span12" value="{$b.Acesso_IP}" />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<label for="acessoData">Período</label>
				<input type="hidden" class="date-range-value" name="Acesso_Data" id="Acesso_Data" value="{if $b.Acesso_DataI && $b.Acesso_DataF}{$b.Acesso_DataI|date_format:'d/m/Y'} - {$b.Acesso_DataF|date_format:'d/m/Y'}{/if}" />				
				<div class="date-range">
					<div class="btn-group">
						<a class="btn btn-primary" href="#"><i class="icon-calendar icon-white"></i> <span class="fake-data">{if $b.Acesso_DataI && $b.Acesso_DataF}{$b.Acesso_DataI|date_format:'d/m/Y'} - {$b.Acesso_DataF|date_format:'d/m/Y'}{else}Escolha um período{/if}</span></a>
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
{if $result}
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				<th>{adm_table_title titulo='#' campo='Acesso_Id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Nome' campo='Acesso_Nome' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='E-mail' campo='Acesso_Email' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Acesso' campo='Acesso_Data' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='IP' campo='Acesso_IP' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='País' campo='Acesso_Pais' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
			</tr>
		</thead>
		<tbody>
			{foreach $result as $k => $v}
			<tr>
				<td data-title="#">{$v.Acesso_Id}</td>
				<td data-title="Nome">{$v.Acesso_Nome}</td>
				<td data-title="E-mail">{$v.Acesso_Email}</td>
				<td data-title="Acesso">{$v.Acesso_Data|date_format:"%d/%m/%Y %H:%M:%S"}</td>
				<td data-title="IP">{$v.Acesso_IP}</td>
				<td data-title="País">{if $v.Acesso_Bandeira}<a href="#" class="country-{$v.Acesso_Bandeira} fake-link" rel="tooltip" title="{$v.Acesso_Pais}"></a>{else}<a href="#" class="country-00 fake-link" rel="tooltip" title="?"></a>{/if}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
	{$nav_paginacao}
	{$paginacao}
{else}
	<h6 class="center">Ops! Não encontramos nenhum registro.</h6>
{/if}
</section>