<section class="cabecalho-pagina">
	<div class="botoes">
		<h2>{$acao} Banners</h2>
		<div class="pull-right">
		{if !$remover }
			<a class="btn btn-primary" href="/admix/banners/inserir/?url_retorno={$url_retorno}"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/banners/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		{else}
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/banners/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		{/if}
		</div>
	</div>
</section>

{if !$remover }
<section class="busca {if $busca && !$print}visible{/if}">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/banners/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="{$ord_campo}" />
		<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
		<div class="row-fluid">
			<div class="span2">
				<label for="bannerId">Código</label>
				<input type="text" id="bannerId" name="Banner_Id" class="span12" value="{$b.Banner_Id}" />
			</div>
			<div class="span3">
				<label for="bannerNome">Nome</label>
				<input type="text" id="bannerNome" name="Banner_Nome" class="span12" value="{$b.Banner_Nome}" />
			</div>
			<div class="span2">
				<label for="bannerDataI">A partir de</label>
				<input type="text" id="bannerDataI" name="Banner_DataInicial" class="span12 datepicker" value="{if $b.Banner_DataInicial <> ''}{$b.Banner_DataInicial|date_format:"%d/%m/%Y"}{/if}" />
			</div>
			<div class="span2">
				<label for="bannerDataFinal">Até</label>
				<input type="text" id="bannerDataFinal" name="Banner_DataFinal" class="span12 datepicker" value="{if $b.Banner_DataFinal <> ''}{$b.Banner_DataFinal|date_format:"%d/%m/%Y"}{/if}" />
			</div>
			<div class="span3">
				<label for="bannerStatus">Status</label>
				<select name="Banner_Status" id="bannerStatus" data-placeholder="Escolha uma opção" class="span12">
					<option value="">-</option>
					<option value="1" {if $b.Banner_Status == 1} selected="selected" {/if}>Ativo</option>
					<option value="0" {if $b.Banner_Status == '0'} selected="selected" {/if}>Inativo</option>
				</select>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<label for="bannerLocalizacao">Localização</label>
				<select id="bannerLocalizacao" name="Banner_Localizacao[]" data-placeholder="Escolha algumas opções" multiple class="span12 chosen" >
					{foreach $l as $bli => $blv}
					<option value="{$blv.BannerLocalizacao_Id}" {if $b.Banner_Localizacao && $blv.BannerLocalizacao_Id|in_array:$b.Banner_Localizacao} selected="selected" {/if}>{$blv.BannerLocalizacao_Nome} ({$blv.BannerLocalizacao_Largura}x{$blv.BannerLocalizacao_Altura})</option>
					{/foreach}
				</select>
				<!-- <input type="text" id="bannerLocalizacao" name="Banner_Localizacao" class="span3" value="{$b.Banner_Localizacao}" /> -->
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
{/if}

<section class="listagem" id="no-more-tables">
{if $result}
	{if !$remover}
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/banners/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
	<input type="hidden" name="ord_campo" value="{$ord_campo}" />
	<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
	{else}
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/banners/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="{$url_retorno}" />
	{foreach $result as $k => $v}
	<input type="hidden" name="ids[]" value="{$v.Banner_Id}">
	{/foreach}
	{/if}
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				{if !$remover }
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				{/if}
				<th>{adm_table_title titulo='#' campo='Banner_Id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Nome' campo='Banner_Nome' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Localização' campo='Banner_Localizacao' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Data Inicial' campo='Banner_DataInicial' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Data Final' campo='Banner_DataFinal' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Status' campo='Banner_Status' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				{if !$remover }
				<th class="no-filter icon2 no-print"></th>
				{/if}
			</tr>
		</thead>
		<tbody>
			{foreach $result as $k => $v}
			<tr>
				{if !$remover}
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value={$v.Banner_Id}></td>
				{/if}
				<td data-title="#">{$v.Banner_Id}</td>
				<td data-title="Nome">{$v.Banner_Nome}</td>
				<td data-title="Localização">{$v.BannerLocalizacao_Nome} ({$v.BannerLocalizacao_Largura}x{$v.BannerLocalizacao_Altura})</td>
				<td data-title="Data Inicial">{$v.Banner_DataInicial|date_format:"%d/%m/%Y"}</td>
				<td data-title="Data Final">{$v.Banner_DataFinal|date_format:"%d/%m/%Y"}</td>
				<td data-title="Status">{if $v.Banner_Status == 1}<span class="label label-success">Ativo</span>{else}<span class="label label-important">Inativo</span>{/if}</span></td>
				{if !$remover}
				<td data-title="Remover / Editar" class="no-print sem-clique">
					<a href="/admix/banners/alterar/{$v.Banner_Id}/?url_retorno={$url_retorno}" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
					<a href="/admix/banners/remover/{$v.Banner_Id}/?url_retorno={$url_retorno}&ord_campo={$ord_campo}&ord_tipo={$ord_tipo}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
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