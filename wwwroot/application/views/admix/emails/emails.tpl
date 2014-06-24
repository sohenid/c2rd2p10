<section class="cabecalho-pagina">
	<div class="botoes">
		<h2>{$acao} E-mails</h2>
		<div class="pull-right">
		{if !$remover }
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/emails/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		{else}
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/emails/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		{/if}		
		</div>
	</div>
</section>

{if !$remover }
<section class="busca {if $busca && !$print}visible{/if}">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/emails/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="{$ord_campo}" />
		<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
		<div class="row-fluid">
			<div class="span2">
				<label for="emailId">Código</label>
				<input type="text" id="emailId" name="Email_Id" class="span12" value="{$b.Email_Id}" />
			</div>
			<div class="span3">
				<label for="emailNome">Nome</label>
				<input type="text" id="emailNome" name="Email_Nome" class="span12" value="{$b.Email_Nome}" />
			</div>
			<div class="span3">
				<label for="emailEmail">E-mail</label>
				<input type="text" id="emailEmail" name="Email_Email" class="span12" value="{$b.Email_Email}" />
			</div>
		</div>
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/emails/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>
{/if}

<section class="listagem" id="no-more-tables">
{if $result}
	{if !$remover}
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/emails/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
	<input type="hidden" name="ord_campo" value="{$ord_campo}" />
	<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
	{else}
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/emails/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="{$url_retorno}" />
	{foreach $result as $k => $v}
	<input type="hidden" name="ids[]" value="{$v.Email_Id}">
	{/foreach}
	{/if}
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				{if !$remover }
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				{/if}
				<th>{adm_table_title titulo='#' campo='Email_Id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Nome' campo='Email_Nome' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='E-mail' campo='Email_Email' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Cadastrado' campo='Email_DataCadastro' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				{if !$remover }
				<th class="no-filter icon1 no-print"></th>
				{/if}
			</tr>
		</thead>
		<tbody>
			{foreach $result as $k => $v}
			<tr>
				{if !$remover }
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value={$v.Email_Id}></td>
				{/if}
				<td data-title="#">{$v.Email_Id}</td>
				<td data-title="Nome">{$v.Email_Nome}</td>
				<td data-title="E-mail">{$v.Email_Email}</td>
				<td data-title="Cadastrado">{$v.Email_DataCadastro|date_format:"%d/%m/%Y %H:%M:%S"}</td>
				{if !$remover }
				<td data-title="Remover" class="no-print sem-clique">
					<a href="/admix/emails/remover/{$v.Email_Id}/?url_retorno={$url_retorno}&ord_campo={$ord_campo}&ord_tipo={$ord_tipo}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
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