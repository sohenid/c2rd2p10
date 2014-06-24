<div class="page-header">
	<h2>Remover Permissão</h2>
</div>
<table class="table table-striped table-condensed">
	<thead>
		<tr>
			<th>#</th>
			<th>Classe</th>
			<th>Metodo</th>
			<th>Nome</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		{foreach $result as $k => $v}
		<tr>
			<td>{$v.Permissao_Id}</td>
			<td>{$v.Permissao_Classe}</td>
			<td>{$v.Permissao_Metodo}</td>
			<td>{$v.Permissao_Apelido}</td>
			<td>{if $v.Permissao_Privado == 0}<span class="label label-success">Publico</span>{else}<span class="label label-important">Privado</span>{/if}</span></td>
		</tr>
		{/foreach}
	</tbody>	
</table>
<form method="post" action="{$action}" class="well form-inline form-remover">
	{foreach $result as $k => $v}
	<input type="hidden" name="ids[]" value="{$v.Permissao_Id}">
	{/foreach}
	<button class="btn btn-primary" type="submit">Desejo remover definitivamente todos os itens acima</button>
	<a href="/admix/permissoes" class="btn voltar">Voltar</a>
</form>