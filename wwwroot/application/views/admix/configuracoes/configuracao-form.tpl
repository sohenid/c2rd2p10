<form method="post" action="{$action}" class="form-horizontal form-interno validar" enctype="multipart/form-data">

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>Configurações</h2>
			<div class="pull-right">
				<button class="btn btn-primary" type="submit"><i class="icon-ok"></i> <span class="hide-mobile">Salvar</span></button>
			</div>
		</div>
	</section>

	<fieldset>

        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>Aviso</h4>
            A alteração destes dados pode implicar em mal funcionamento do site. Caso tenha dúvidas, não altere os valores.
        </div>

		{foreach $configuracoes as $k => $v}
		{*<div class="clearfix">
			<b>{$v.Config_Nome}</b><br/>
			<input id="{$v.Config_Identificador}" name="{$v.Config_Identificador}" class="span6" type="{$v.Config_Tipo}" value="{$v.Config_Valor}">
		</div>
        <br/>
        *}
		<div class="control-group">
			<label class="control-label" for="{$v.Config_Identificador}">{$v.Config_Nome}</label>
			<div class="controls">
				<input id="{$v.Config_Identificador}" name="{$v.Config_Identificador}" class="span4" type="{$v.Config_Tipo}" value="{$v.Config_Valor}" title="{$v.Config_Nome}">
				<span class="help-inline">{$v.Config_Descricao}</span>
			</div>
		</div>    
		{/foreach}
        
	</fieldset>
	<!--div class="form-actions">
		<button class="btn btn-primary" type="submit">Salvar</button>
		<button class="btn voltar" type="button">Voltar</button>
	</div-->	    			
</form>