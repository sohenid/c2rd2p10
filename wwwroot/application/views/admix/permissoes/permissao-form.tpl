<div class="page-header">
	<h2>{$acao} Permissão</h2>
</div>
<form method="post" action="{$action}" class="form-horizontal validar" enctype="multipart/form-data">
{if $v.Permissao_Id}<input type="hidden" name="Permissao_Id" value="{$v.Permissao_Id}" />{/if}
	<fieldset>
		<div class="control-group">
			<label class="control-label" for="Permissao_Privado">Status</label>
			<div class="controls">
				<select name="Permissao_Privado" id="Permissao_Privado" class="span2">
					<option value="1" {if $v.Permissao_Privado == 1} selected="selected" {/if}>Privado</option>
					<option value="0" {if $v.Permissao_Privado == 0} selected="selected" {/if}>Público</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Classe</label>
			<div class="controls">
				<input type="text" class="span2" disabled="disabled" value="{$v.Permissao_Classe}">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Método</label>
			<div class="controls">
				<input type="text" class="span2" disabled="disabled" value="{$v.Permissao_Metodo}">
			</div>
		</div>
		
		<div class="control-group {if $e.Permissao_Apelido}error{/if}">
			<label class="control-label" for="Permissao_Apelido">Nome</label>
			<div class="controls">
				<input id="Permissao_Apelido" name="Permissao_Apelido" class="span3" type="text" value="{$v.Permissao_Apelido}" required="required" title="Nome">
				{if $e.Permissao_Apelido}<span class="help-inline">{$e.Permissao_Apelido}</span>{/if}
			</div>
		</div>
		
	</fieldset>
	<div class="form-actions">
		<button class="btn btn-primary" type="submit">Salvar</button>
		<button class="btn voltar" type="button">Voltar</button>
	</div>	    			
</form>