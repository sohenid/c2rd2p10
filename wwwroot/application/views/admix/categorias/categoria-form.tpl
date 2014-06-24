<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
{if $v.id}<input type="hidden" name="id" value="{$v.id}" />{/if}
<input type="hidden" name="url_retorno" value="{$url_retorno}" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>{$acao} Categoria</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/categorias/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group {if $e.status}error{/if}">
			<label class="control-label" for="status">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="status" id="status" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" {if $v.status == '1'} selected="selected" {/if}>Ativo</option>
						<option value="0" {if $v.status == '0'} selected="selected" {/if}>Inativo</option>
					</select>
					{if $e.descricao}<span class="help-inline">{$e.descricao}</span>{/if}
				</div>
			</div>
		</div>
		<div class="control-group {if $e.descricao}error{/if}">
			<label class="control-label" for="descricao">Descrição</label>
			<div class="controls">
				<input id="descricao" name="descricao" class="span6" type="text" value="{$v.descricao}" required="required" title="Descrição">
				{if $e.descricao}<span class="help-inline">{$e.descricao}</span>{/if}
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="imagem">Arquivo</label>
			<div class="controls">
				<input type="file" id="imagem" name="imagem" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .gif .jpg .png"><i class="icon-question-sign default"></i></a>
					{if $v.imagem}
					<a href="{$v.imagem}" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/categorias/removerArquivo{$v.imagem}/?url_retorno={$smarty.server['REQUEST_URI']|urlencode|urlencode|urlencode}'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					{/if}
				</span>
			</div>
		</div>
	</fieldset>
</form>