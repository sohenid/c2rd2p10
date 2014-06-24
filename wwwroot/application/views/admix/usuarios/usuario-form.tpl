<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
{if $v.Usuario_Id}<input type="hidden" name="Usuario_Id" value="{$v.Usuario_Id}" />{/if}
<input type="hidden" name="url_retorno" value="{$url_retorno}" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>{$acao} Usuário</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/usuarios/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="Usuario_Status">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Usuario_Status" id="Usuario_Status" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" {if $v.Usuario_Status == 1} selected="selected" {/if}>Ativo</option>
						<option value="0" {if $v.Usuario_Status == 0} selected="selected" {/if}>Inativo</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="control-group {if $e.Usuario_Nome}error{/if}">
			<label class="control-label" for="Usuario_Nome">Nome</label>
			<div class="controls">
				<input id="Usuario_Nome" name="Usuario_Nome" class="span3" type="text" value="{$v.Usuario_Nome}" required="required" title="Nome">
				{if $e.Usuario_Nome}<span class="help-inline">{$e.Usuario_Nome}</span>{/if}
			</div>
		</div>
		
		<div class="control-group {if $e.Usuario_Email}error{/if}">
			<label class="control-label" for="Usuario_Email">E-mail</label>
			<div class="controls">
				<input id="Usuario_Email" name="Usuario_Email" class="span3" type="email" value="{$v.Usuario_Email}" required="required" title="E-mail" >
				{if $e.Usuario_Email}<span class="help-inline">{$e.Usuario_Email}</span>{/if}
			</div>
		</div>
		
		<div class="control-group {if $e.Usuario_Senha}error{/if}">
			<label class="control-label" for="Usuario_Senha">Senha</label>
			<div class="controls">
				<div class="input-append">
					<input id="Usuario_Senha" name="Usuario_Senha" class="span2 pass-strength" type="password" value="" {if !$v.Usuario_Id}required="required"{/if} title="Senha">
					<span class="add-on"><span class="label label-important">fraca</span></span>
				</div>
				{if $e.Usuario_Senha}<span class="help-inline">{$e.Usuario_Senha}</span>{/if}
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="Usuario_Imagem"> Imagem Ilustrativa</label>
			<div class="controls">
				<input type="file" id="Usuario_Imagem" name="Usuario_Imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Proporcional a 640x480"><i class="icon-question-sign default"></i></a>
					{if $v.Usuario_Imagem}
						<a href="#myModalUsuario_Imagem" data-toggle="modal" rel="tooltip" title="Visualizar" class="btn-action btn-success"><i class="icon-camera default"></i></a>
						<a href="javascript:if(confirm('Deseja realmente remover esta imagem?')){ location.href='/admix/usuarios/removerImagem{$v.Usuario_Imagem}/?url_retorno={$smarty.server['REQUEST_URI']|urlencode|urlencode|urlencode}'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a><br />
						<div class="modal hide fade" id="myModalUsuario_Imagem" style="display: none;">
							<div class="modal-body">
								<img alt="" src="{$v.Usuario_Imagem}">
							</div>
							<div class="modal-footer">
								<a data-dismiss="modal" class="btn" href="#">Fechar</a>
							</div>
						</div>
					{/if}
				</span>
			</div>
		</div>

		{if $is_administrador == TRUE}
		<div class="control-group">
			<label class="control-label" for="Usuario_Administrador">Administrador</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Usuario_Administrador" id="Usuario_Administrador" data-placeholder="Escolha uma opção" class="span2 chosen mostra-permissoes">
						<option value="0" {if $v.Usuario_Administrador == 0} selected="selected" {/if}>Não</option>
						<option value="1" {if $v.Usuario_Administrador == 1} selected="selected" {/if}>Sim</option>
					</select>
				</div>	
			</div>
		</div>
		{/if}
		
		<table class="table table-striped table-condensed table-bordered table-permissoes">				
		<thead>
			<tr>
				<th class="no-filter icon1"></th>
				<th>Permissões</th>
				<th>Visualizar</th>
				<th>Cadastrar</th>
				<th>Editar</th>
				<th>Remover</th>
			</tr>
		</thead>
        <tbody>
        	{foreach $permissoes as $k => $p}
			<tr>
				<td><input type="checkbox" class="check-all-permissao"></td>
				<td><label class="table-checkbox-permissao">{$k|ucfirst}</label></td>
				<td class="sem-clique">{if isset($p.index)}<input type="checkbox" name="Permissao_Id[]" value="{$p.index}" id="pemissao{$p.index}" {if $p.index|in_array:$permissoesSelected}checked="checked"{/if} />{/if}</td>
				<td class="sem-clique">{if isset($p.inserir)}<input type="checkbox" name="Permissao_Id[]" value="{$p.inserir}" id="pemissao{$p.inserir}" {if $p.inserir|in_array:$permissoesSelected}checked="checked"{/if} />{/if}</td>
				<td class="sem-clique">{if isset($p.alterar)}<input type="checkbox" name="Permissao_Id[]" value="{$p.alterar}" id="pemissao{$p.alterar}" {if $p.alterar|in_array:$permissoesSelected}checked="checked"{/if} />{/if}</td>
				<td class="sem-clique">{if isset($p.remover)}<input type="checkbox" name="Permissao_Id[]" value="{$p.remover}" id="pemissao{$p.remover}" {if $p.remover|in_array:$permissoesSelected}checked="checked"{/if} />{/if}</td>
			</tr>
			{/foreach}
		{*foreach $listaPermissoes as $k => $v}
			<tr>
			{foreach $v as $k1 => $v1}
				<td>
					{if $k1 != 0} <input type="checkbox" name="Permissao_Id[]" value="{$k1}" id="pemissao{$k1}" {if $k1|in_array:$permissoesAtivas}checked="checked"{/if} /> {/if} 
					<label class="table-checkbox" for="pemissao{$k1}">{$v1}</label>
				</td>
			{/foreach}
			</tr>
		{/foreach*}
        </tbody>					
		</table>
				
	</fieldset>
</form>