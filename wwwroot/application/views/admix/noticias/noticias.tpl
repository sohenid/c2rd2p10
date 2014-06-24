<section class="cabecalho-pagina">
	<div class="botoes">
		<h2>{$acao} Notícias</h2>
		<div class="pull-right">
		{if !$remover }
			<a class="btn btn-primary" href="/admix/noticias/inserir/?url_retorno={$url_retorno}"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/noticias/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		{else}
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/noticias/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		{/if}		
		</div>
	</div>
</section>

{if !$remover }
<section class="busca {if $busca && !$print}visible{/if}">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/noticias/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="{$ord_campo}" />
		<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
		<div class="row-fluid">
			<div class="span2">
				<label for="noticiaId">Código</label>
				<input type="text" id="noticiaId" name="Noticia_Id" class="span12" value="{$b.Noticia_Id}" />
			</div>
			<div class="span4">
				<label for="noticiaNome">Nome</label>
				<input type="text" id="noticiaNome" name="Noticia_Nome" class="span12" value="{$b.Noticia_Nome}" />
			</div>
			<div class="span2">
				<label for="noticiaDataI">A partir de</label>
				<input type="text" id="noticiaDataI" name="Noticia_DataI" class="span12 datepicker" value="{if $b.Noticia_DataI <> ''}{$b.Noticia_DataI|date_format:"%d/%m/%Y"}{/if}" />
			</div>
			<div class="span2">
				<label for="noticiaDataF">Até</label>
				<input type="text" id="noticiaDataF" name="Noticia_DataF" class="span12 datepicker" value="{if $b.Noticia_DataF <> ''}{$b.Noticia_DataF|date_format:"%d/%m/%Y"}{/if}" />
			</div>
			<div class="span2">
				<label for="noticiaStatus">Status</label>
				<select name="Noticia_Status" id="noticiaStatus" data-placeholder="Escolha uma opção" class="span12 chosen">
					<option value="">-</option>
					<option value="1" {if $b.Noticia_Status == 1} selected="selected" {/if}>Ativo</option>
					<option value="0" {if $b.Noticia_Status == '0'} selected="selected" {/if}>Inativo</option>
				</select>
			</div>
		</div>
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/noticias/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>
{/if}

<section class="listagem" id="no-more-tables">
{if $result}
	{if !$remover}
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/noticias/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
	<input type="hidden" name="ord_campo" value="{$ord_campo}" />
	<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
	{else}
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/noticias/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="{$url_retorno}" />
	{foreach $result as $k => $v}
	<input type="hidden" name="ids[]" value="{$v.Noticia_Id}">
	{/foreach}	
	{/if}
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				{if !$remover }
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				{/if}
				<th>{adm_table_title titulo='#' campo='Noticia_Id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Nome' campo='Noticia_Nome' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Data' campo='Noticia_Data' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>Ordem</th>
				<th>{adm_table_title titulo='Status' campo='Noticia_Status' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				{if !$remover }
				<th class="no-filter icon3 no-print"></th>
				{/if}
			</tr>
		</thead>
		<tbody>
			{foreach $result as $k => $v}
			<tr>
				{if !$remover}
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value={$v.Noticia_Id}></td>
				{/if}
				<td data-title="#">{$v.Noticia_Id}</td>
				<td data-title="Nome">{$v.Noticia_Nome}</td>
				<td data-title="Data">{$v.Noticia_Data|date_format:"%d/%m/%Y"}</td>
				<td data-title="Ordem">{$v.Noticia_Ordem}</td>
				<td data-title="Status">{if $v.Noticia_Status == 1}<span class="label label-success">Ativo</span>{else}<span class="label label-important">Inativo</span>{/if}</span></td>
				{if !$remover}
				<td data-title="Remover / Editar" class="no-print sem-clique">
					<a href="/admix/noticias/alterar/{$v.Noticia_Id}/?url_retorno={$url_retorno}" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil default"></i></a>
					<a href="/admix/noticias/imagens/{$v.Noticia_Id}/?url_retorno={$url_retorno}" rel="tooltip" title="Imagens" class="btn-action btn-info"><i class="icon-camera default"></i></a>
					<a href="/admix/noticias/remover/{$v.Noticia_Id}/?url_retorno={$url_retorno}&ord_campo={$ord_campo}&ord_tipo={$ord_tipo}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
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