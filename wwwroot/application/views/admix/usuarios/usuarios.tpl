<section class="cabecalho-pagina">
	<div class="botoes">
		<h2>Gerenciar Usuários</h2>
		<div class="pull-right">
		{if !$remover }
			<a class="btn btn-primary" href="/admix/usuarios/inserir/?url_retorno={$url_retorno}"><i class="icon-plus"></i> <span class="hide-mobile">Cadastrar</span></a>
			<a class="btn btn-success procurar" href="#"><i class="icon-search"></i> <span class="hide-mobile">Procurar</span></a>
			<a class="btn btn-warning imprimir" href="/admix/usuarios/?print=true&{$smarty.server.QUERY_STRING}" target="_blank"><i class="icon-print"></i> Imprimir</a>
			<button class="btn btn-danger btn-remover-selecionados"><i class="icon-remove"></i> Remover selecionados</button>
		{else}
			<button class="btn btn-danger btn-remover-definitivo" type="submit"><i class="icon-remove icon-white"></i> <span class="hide-mobile">Remover definitivamente</span></button>
			<a class="btn" href="/admix/usuarios/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
		{/if}			
		</div>
	</div>
</section>

{if !$remover }
<section class="busca {if $busca && !$print}visible{/if}">
	<div class="well">
	<form id="formBuscar" method="get" action="/admix/usuarios/" name="formBuscar" class="form-buscar">
		<input type="hidden" name="ord_campo" value="{$ord_campo}" />
		<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
		<div class="row-fluid">
			<div class="span2">
				<label for="usuarioId">Código</label>
				<input type="text" id="usuarioId" name="Usuario_Id" class="span12" value="{$b.Usuario_Id}" />
			</div>
			<div class="span3">
				<label for="usuarioNome">Nome</label>
				<input type="text" id="usuarioNome" name="Usuario_Nome" class="span12" value="{$b.Usuario_Nome}" />
			</div>
			<div class="span3">
				<label for="usuarioEmail">E-mail</label>
				<input type="text" id="usuarioEmail" name="Usuario_Email" class="span12" value="{$b.Usuario_Email}" />
			</div>
			<div class="span2">
				<label for="usuarioStatus">Status</label>
				<select name="Usuario_Status" id="usuarioStatus" data-placeholder="Escolha uma opção" class="span12 chosen">
					<option value="">-</option>
					<option value="1" {if $b.Usuario_Status == 1} selected="selected" {/if}>Ativo</option>
					<option value="0" {if $b.Usuario_Status == '0'} selected="selected" {/if}>Inativo</option>
				</select>
			</div>
		</div>
		<button class="btn btn-success" name="submit" type="submit"><i class="icon-search icon-white"></i>&nbsp;Procurar</button>
		<a href="/admix/usuarios/" class="btn"><i class="icon-list icon-white"></i>&nbsp;Listar tudo</a>
	</form>
	</div>		
</section>
{/if}

<section class="listagem" id="no-more-tables">
{if $result}
	{if !$remover}
	<form id="formRemover" class="acaoRemover" method="post" action="/admix/usuarios/remover" name="formRemover">
	<input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
	<input type="hidden" name="ord_campo" value="{$ord_campo}" />
	<input type="hidden" name="ord_tipo" value="{$ord_tipo}" />
	{else}	
	<form id="formRemoverDefinitivo" class="acaoRemoverDefinitivo" method="post" action="/admix/usuarios/removerPost" name="formRemoverDefinitivo">
	<input type="hidden" name="url_retorno" value="{$url_retorno|urldecode}" />
	{foreach $result as $k => $v}
	<input type="hidden" name="ids[]" value="{$v.Usuario_Id}">
	{/foreach}
	{/if}
	
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
				{if !$remover }
				<th class="no-filter icon1 no-print hide-mobile"><input type="checkbox" class="check-all"></th>
				{/if}
				<th>{adm_table_title titulo='#' campo='Usuario_Id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Nome' campo='Usuario_Nome' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Email' campo='Usuario_Email' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Último acesso' campo='Usuario_UltimoAcesso' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				<th>{adm_table_title titulo='Status' campo='Usuario_Status' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo remover=$remover}</th>
				{if !$remover }
				<th class="no-filter icon3 no-print"></th>
				{/if}
			</tr>
		</thead>
		<tbody>
			{foreach $result as $k => $v}
			<tr>
				{if !$remover}
				<td data-title="Remover" class="no-print hide-mobile sem-clique"><input type="checkbox" name="ids[]" value={$v.Usuario_Id}></td>
				{/if}
				<td data-title="#">{if $v.Usuario_Administrador == 1}<a href="#" class="fake-link" rel="tooltip" title="Administrador"><i class="icon-star default"></i></a>{else}{$v.Usuario_Id}{/if}</td>
				<td data-title="Nome">{$v.Usuario_Nome}</td>
				<td data-title="E-mail">{$v.Usuario_Email}</td>
				<td data-title="Último acesso">{$v.Usuario_UltimoAcesso|date_format:"%d/%m/%Y %H:%M"}</td>
				<td data-title="Status">{if $v.Usuario_Status == 1}<span class="label label-success">Ativo</span>{else}<span class="label label-important">Inativo</span>{/if}</span></td>
				{if !$remover}
				<td data-title="Remover / Editar" class="no-print sem-clique">
					<a href="/admix/usuarios/alterar/{$v.Usuario_Id}/?url_retorno={$url_retorno}" rel="tooltip" title="Alterar" class="btn-action btn-success"><i class="icon-pencil"></i></a>
					<a href="#" rel="tooltip" title="&lt;img src='{if $v.Usuario_Imagem}{$v.Usuario_Imagem|thumbnail:'32x32'}{else}/assets/img/estrutura/sem-avatar.png{/if}' class='tooltip-img' &gt;" class="fake-link btn-action btn-info"><i class="icon-camera"></i></a>
					<a href="/admix/usuarios/remover/{$v.Usuario_Id}/?url_retorno={$url_retorno}&ord_campo={$ord_campo}&ord_tipo={$ord_tipo}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove"></i></a>
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