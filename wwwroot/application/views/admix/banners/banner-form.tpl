<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
{if $v.Banner_Id}<input type="hidden" name="Banner_Id" value="{$v.Banner_Id}" />{/if}
<input type="hidden" name="url_retorno" value="{$url_retorno}" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>{$acao} Banner</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
				<a class="btn" href="/admix/banners/{$url_retorno|urldecode}"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
			</div>
		</div>
	</section>

	<fieldset>
		<div class="control-group">
			<label class="control-label" for="Banner_Status">Status</label>
			<div class="controls">
				<select name="Banner_Status" id="Banner_Status" class="span2">
					<option value="1" {if $v.Banner_Status == 1} selected="selected" {/if}>Ativo</option>
					<option value="0" {if $v.Banner_Status == 0} selected="selected" {/if}>Inativo</option>
				</select>
			</div>
		</div>
		<div class="control-group {if $e.Banner_Nome}error{/if}">
			<label class="control-label" for="Banner_Nome">Nome</label>
			<div class="controls">
				<input id="Banner_Nome" name="Banner_Nome" class="span6" type="text" value="{$v.Banner_Nome}" required="required" title="Nome">
				{if $e.Banner_Nome}<span class="help-inline">{$e.Banner_Nome}</span>{/if}
			</div>
		</div>
		<div class="control-group {if $e.Banner_DataInicial}error{/if}">		
			<label class="control-label" for="Banner_DataInicial">Data Inicial</label>
			<div class="controls">
				<input id="Banner_DataInicial" name="Banner_DataInicial" class="span2 datepicker" type="text" value="{if $v.Banner_DataInicial <> ''}{$v.Banner_DataInicial|date_format:"%d/%m/%Y"}{else}{$smarty.now|date_format:"%d/%m/%Y"}{/if}" required="required" title="Data Inicial">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Inicio da vinculação do banner"><i class="icon-question-sign default"></i></a></span>
				{if $e.Banner_DataInicial}<span class="help-inline">{$e.Banner_DataInicial}</span>{/if}
			</div>
		</div>
		<div class="control-group">		
			<label class="control-label" for="Banner_DataFinal">Data Final</label>
			<div class="controls">
				<input id="Banner_DataFinal" name="Banner_DataFinal" class="span2 datepicker" type="text" value="{if $v.Banner_DataFinal <> ''}{$v.Banner_DataFinal|date_format:"%d/%m/%Y"}{/if}">
				<span class="help-inline"><a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Não preencha para indeterminado."><i class="icon-question-sign default"></i></a></span>
				{if $e.Banner_DataFinal}<span class="help-inline">{$e.Banner_DataFinal}</span>{/if}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Localizacao">Localização</label>
			<div class="controls">
				<select name="Banner_Localizacao" id="Banner_Localizacao" class="span3">
					<option value="">-</option>
					{foreach $l as $bli => $blv}
					<option value="{$blv.BannerLocalizacao_Id}" {if $blv.BannerLocalizacao_Id == $v.Banner_Localizacao} selected="selected" {/if}>{$blv.BannerLocalizacao_Nome} ({$blv.BannerLocalizacao_Largura}x{$blv.BannerLocalizacao_Altura})</option>
					{/foreach}
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Tipo">Tipo</label>
			<div class="controls">
				<select name="Banner_Tipo" id="Banner_Tipo" class="banner-tipo span2">
					<option value="0" {if $v.Banner_Tipo == '0'} selected="selected" {/if}>Banner Interno</option>
					<option value="1" {if $v.Banner_Tipo == '1'} selected="selected" {/if}>Banner Externo</option>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="Banner_Conteudo">Conteúdo</label>
			<div class="controls">
				<textarea name="Banner_Conteudo" id="Banner_Conteudo" class="input-xlarge input-banner-externo span6" id="textarea" rows="3">{$v.Banner_Conteudo}</textarea>
			</div>
		</div>
		<div class="control-group banner-externo">
			<label class="control-label" for="Banner_Script">Script</label>
			<div class="controls">
				<textarea name="Banner_Script" id="Banner_Script" class="input-xlarge input-banner-externo span6" id="textarea" rows="3">{$v.Banner_Script}</textarea>
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Banner_Target">Target</label>
			<div class="controls">
				<select name="Banner_Target" id="Banner_Target" class="span3">
					<option value="_self" {if $v.Banner_Target == '_self'} selected="selected" {/if}>Abrir na mesma janela</option>
					<option value="_blank" {if $v.Banner_Target == '_blank'} selected="selected" {/if}>Abrir em uma nova janela</option>
				</select>
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Banner_Link">Link</label>
			<div class="controls">
				<input id="Banner_Link" name="Banner_Link" class="span6" type="text" value="{$v.Banner_Link}">
			</div>
		</div>
		<div class="control-group banner-interno">
			<label class="control-label" for="Banner_Arquivo">Arquivo</label>
			<div class="controls">
				<input type="file" id="Banner_Arquivo" name="Banner_Arquivo" class="input-file span2"> 
				<span class="help-inline input-file-actions">
					<a href="#" class="fake-link btn-action btn-info" rel="tooltip" title="Arquivos .swf .jpg .png"><i class="icon-question-sign default"></i></a>
					{if $v.Banner_Arquivo}
					<a href="{$v.Banner_Arquivo}" rel="tooltip" title="Visualizar" target="_blank" class="btn-action btn-success"><i class="icon-camera default"></i></a>
					<a href="javascript:if(confirm('Deseja realmente remover este arquivo?')){ location.href='/admix/banners/removerArquivo{$v.Banner_Arquivo}/?url_retorno={$smarty.server['REQUEST_URI']|urlencode|urlencode|urlencode}'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a>
					{/if}
				</span>
			</div>
		</div>
	</fieldset>
	<!--div class="form-actions">
		<button class="btn btn-primary" type="submit">Salvar</button>
		<button class="btn voltar" type="button">Voltar</button>
	</div-->	    			
</form>