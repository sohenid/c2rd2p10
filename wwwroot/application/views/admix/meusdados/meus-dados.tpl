<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">
<input type="hidden" name="url_retorno" value="{$url_retorno}" />

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>Alterar Meus Dados</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
			</div>
		</div>
	</section>
	<fieldset>
		
		<div class="control-group {if $e.Usuario_Nome}error{/if}">
			<label class="control-label" for="Usuario_Nome">Nome</label>
			<div class="controls">
            	<input id="Usuario_Nome" name="Usuario_Nome" class="span3" type="text" value="{$v.Usuario_Nome}" disabled="disabled">
				{if $e.Usuario_Nome}<span class="help-inline">{$e.Usuario_Nome}</span>{/if}
			</div>
		</div>
		
		<div class="control-group {if $e.Usuario_Email}error{/if}">
			<label class="control-label" for="Usuario_Email">E-mail</label>
			<div class="controls">
            	<input id="Usuario_Email" name="Usuario_Email" class="span3" type="text" value="{$v.Usuario_Email}" disabled="disabled">
				{if $e.Usuario_Email}<span class="help-inline">{$e.Usuario_Email}</span>{/if}
			</div>
		</div>
		
		<div class="control-group {if $e.Usuario_Senha}error{/if}">
			<label class="control-label" for="Usuario_Senha">Nova Senha</label>
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
						<a href="javascript:if(confirm('Deseja realmente remover esta imagem?')){ location.href='/admix/meusdados/removerImagem{$v.Usuario_Imagem}/?url_retorno={$smarty.server['REQUEST_URI']|urlencode|urlencode|urlencode}'}" rel="tooltip" title="Remover" class="btn-action btn-danger"><i class="icon-remove default"></i></a><br />
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
				
	</fieldset>
</form>