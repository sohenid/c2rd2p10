<div class="page-header">
	<h2>Gerenciar Permissões</h2>
</div>
<div class="rows right">
	<a class="btn btn-danger btn-remover-selecionados" href="#"><i class="icon-minus"></i> Remover selecionados</a>
</div>
<form id="formRemover" class="acaoRemover" method="post" action="/admix/permissoes/remover" name="formRemover">
<table class="table table-striped table-bordered table-condensed sort-table">
	<thead>
		<tr>
			<th class="no-filter icon2"></th>
			<th>#</th>
			<th>Classe</th>
			<th>Metodo</th>
			<th>Nome</th>
			<th>Status</th>
			<th class="no-filter icon1"><input type="checkbox" class="check-all"></th>
		</tr>
	</thead>
	{if $result}
	<tbody>
		{foreach $result as $k => $v}
		<tr>
			<td>
				<!-- <label class="checkbox ckb-remover"><input type="checkbox" name="ids[]" value={$v.Usuario_Id}></label> -->
				<a href="/admix/permissoes/remover/{$v.Permissao_Id}" rel="tooltip" title="Remover"><i class="icon-trash default"></i></a>&nbsp;
				<a href="/admix/permissoes/alterar/{$v.Permissao_Id}" rel="tooltip" title="Alterar"><i class="icon-pencil default"></i></a>&nbsp;
			</td>
			<td>{$v.Permissao_Id}</td>
			<td>{$v.Permissao_Classe}</td>
			<td>{$v.Permissao_Metodo}</td>
			<td>{$v.Permissao_Apelido}</td>
			<td>{if $v.Permissao_Privado == 0}<span class="label label-success">Publico</span>{else}<span class="label label-important">Privado</span>{/if}</span></td>
			<td><input type="checkbox" name="ids[]" value={$v.Permissao_Id}></td>
		</tr>
		{/foreach}
	</tbody>
	{/if}
</table>
</form>