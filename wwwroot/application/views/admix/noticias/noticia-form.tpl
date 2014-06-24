<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
{if $v.Noticia_Id}<input type="hidden" name="Noticia_Id" value="{$v.Noticia_Id}" />{/if}
<input type="hidden" name="url_retorno" value="{$url_retorno}" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>{$acao} Notícia</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/noticias/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group {if $e.Noticia_Status}error{/if}">
			<label class="control-label" for="noticiaStatus">Status</label>
			<div class="controls">
				<div class="span2 no-margin">
					<select name="Noticia_Status" id="noticiaStatus" data-placeholder="Escolha uma opção" class="span2 chosen">
						<option value="1" {if $v.Noticia_Status == 1} selected="selected" {/if}>Ativo</option>
						<option value="0" {if $v.Noticia_Status == '0'} selected="selected" {/if}>Inativo</option>
					</select>
					{if $e.Noticia_Status}<span class="help-inline">{$e.Noticia_Status}</span>{/if}
				</div>
			</div>
		</div>
		<div class="control-group {if $e.Noticia_Nome}error{/if}">
			<label class="control-label" for="Noticia_Nome">Nome</label>
			<div class="controls">
				<input id="Noticia_Nome" name="Noticia_Nome" class="span6" type="text" value="{$v.Noticia_Nome}" required="required" title="Nome">
				{if $e.Noticia_Nome}<span class="help-inline">{$e.Noticia_Nome}</span>{/if}
			</div>
		</div>
		<div class="control-group {if $e.Noticia_Data}error{/if}">		
			<label class="control-label" for="Noticia_Data">Data</label>
			<div class="controls">
				<input id="Noticia_Data" name="Noticia_Data" class="span2 datepicker" type="text" value="{if $v.Noticia_Data <> ''}{$v.Noticia_Data|date_format:"%d/%m/%Y"}{else}{$smarty.now|date_format:"%d/%m/%Y"}{/if}" required="required" title="Data">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
				{if $e.Noticia_Data}<span class="help-inline">{$e.Noticia_Data}</span>{/if}
			</div>
		</div>
		<div class="control-group {if $e.Noticia_Descricao}error{/if}">
			<label class="control-label" for="Noticia_Descricao">Descrição</label>
			<div class="controls">
				<textarea id="Noticia_Descricao" name="Noticia_Descricao" class="input-xlarge wysiwyg span10" data-image-upload="/admix/noticias/redactorImagensUpload" data-image-json="/admix/noticias/redactorImagensJson" rows="6" required="required" title="Descrição">{$v.Noticia_Descricao}</textarea>
				{if $e.Noticia_Descricao}<p class="help-block">{$e.Noticia_Descricao}</p>{/if}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Noticia_Ordem">Ordem</label>
			<div class="controls">
				<input id="Noticia_Ordem" name="Noticia_Ordem" class="span1" type="text" value="{$v.Noticia_Ordem}">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Utilizado como critério de ordenação"><i class="icon-question-sign default"></i></a></span>
			</div>
		</div>
	</fieldset>
</form>