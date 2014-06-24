<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
{if $v.Cliente_Id}<input type="hidden" name="Cliente_Id" value="{$v.Cliente_Id}" />{/if}
<input type="hidden" name="url_retorno" value="{$url_retorno}" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>{$acao} Cliente</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/clientes/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group {if $e.Cliente_Status}error{/if}">
			<label class="control-label" for="clienteStatus">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Cliente_Status" id="clienteStatus" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" {if $v.Cliente_Status == 1} selected="selected" {/if}>Ativo</option>
						<option value="0" {if $v.Cliente_Status == '0'} selected="selected" {/if}>Inativo</option>
					</select>
					{if $e.Cliente_Nome}<span class="help-inline">{$e.Cliente_Nome}</span>{/if}
				</div>
			</div>
		</div>
		<div class="control-group {if $e.Cliente_Nome}error{/if}">
			<label class="control-label" for="Cliente_Nome">Nome</label>
			<div class="controls">
				<input id="Cliente_Nome" name="Cliente_Nome" class="span6" type="text" value="{$v.Cliente_Nome}" required="required" title="Nome">
				{if $e.Cliente_Nome}<span class="help-inline">{$e.Cliente_Nome}</span>{/if}
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Cliente_Imagem">Arquivo</label>
			<div class="controls">
				<input type="file" id="Cliente_Imagem" name="Cliente_Imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .swf .jpg .png"><i class="icon-question-sign default"></i></a>
					{if $v.Cliente_Imagem}
					<a href="{$v.Cliente_Imagem}" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/clientes/removerArquivo{$v.Cliente_Imagem}/?url_retorno={$smarty.server['REQUEST_URI']|urlencode|urlencode|urlencode}'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					{/if}
				</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Cliente_Ordem">Ordem</label>
			<div class="controls">
				<input id="Cliente_Ordem" name="Cliente_Ordem" class="span1" type="text" value="{$v.Cliente_Ordem}">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
			</div>
		</div>
	</fieldset>
</form>