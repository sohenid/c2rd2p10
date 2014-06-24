<?php /* Smarty version Smarty-3.1.12, created on 2013-08-29 15:13:22
         compiled from "/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/noticias/noticia-imagens.tpl" */ ?>
<?php /*%%SmartyHeaderCode:407065995521f8ee3c28054-43871594%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '987dccb2b98650fbab65b168aacc324c1169dc9f' => 
    array (
      0 => '/home/mixd/wwwroot/agencialed/wwwroot/application/views/admix/noticias/noticia-imagens.tpl',
      1 => 1377800001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '407065995521f8ee3c28054-43871594',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_521f8ee3c3f097_76189571',
  'variables' => 
  array (
    'id' => 0,
    'url_retorno' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521f8ee3c3f097_76189571')) {function content_521f8ee3c3f097_76189571($_smarty_tpl) {?><form id="fileupload" action="/admix/noticias/imagensUpload" method="POST" enctype="multipart/form-data">
	<input type="hidden" class="orderId" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
	<input type="hidden" class="orderPost" name="order" value="/admix/noticias/imagensOrdenar">


<!--div class="page-header">
	<h2>Inserir Imagens</h2>
</div-->

	<section class="cabecalho-pagina">
		<div class="botoes">
			<h2>Inserir Imagens</h2>
			<div class="pull-right fileupload-buttonbar">
	            <div>
		            <!-- The fileinput-button span is used to style the file input field as button -->
		            <span class="btn  btn-primary fileinput-button">
		                <i class="icon-plus icon-white"></i>
		                <span class="hide-mobile">Adicionar imagens...</span>
		                <input type="file" name="files" multiple>
		            </span>
		            <button type="submit" class="btn btn-success start">
		                <i class="icon-upload icon-white"></i>
		                <span class="hide-mobile">Começar envio</span>
		            </button>
		            <button type="reset" class="btn btn-warning cancel">
		                <i class="icon-ban-circle icon-white"></i>
		                <span class="hide-mobile">Cancelar envio</span>
		            </button>
		            <button type="button" class="btn btn-danger delete">
		                <i class="icon-remove icon-white"></i>
		                <span class="hide-mobile">Remover</span>
		            </button>
		            <span class="hide-mobile"><input type="checkbox" class="toggle"></span>
		            <a class="btn" href="/admix/noticias/<?php echo urldecode($_smarty_tpl->tpl_vars['url_retorno']->value);?>
"><i class="icon-arrow-left"></i> <span class="hide-mobile">Voltar</span></a>
				</div>
				<div class="float-progress">
			        <!-- The global progress information -->
			        <div class="span5 fileupload-progress fade">
			            <!-- The global progress bar -->
			            <div class="progress progress-success progress-striped active">
			                <div class="bar" style="width:0%;"></div>
			            </div>
			            <!-- The extended global progress information -->
			            <div class="progress-extended">&nbsp;</div>
			        </div>
				</div>
			</div>
		</div>
	</section>

	<<?php ?>?php /*
	<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar progress-fixed">
            <div>
	            <!-- The fileinput-button span is used to style the file input field as button -->
	            <span class="btn  btn-primary fileinput-button">
	                <i class="icon-plus icon-white"></i>
	                <span class="hide-mobile">Adicionar imagens...</span>
	                <input type="file" name="files" multiple>
	            </span>
	            <button type="submit" class="btn btn-success start">
	                <i class="icon-upload icon-white"></i>
	                <span class="hide-mobile">Começar envio</span>
	            </button>
	            <button type="reset" class="btn btn-warning cancel">
	                <i class="icon-ban-circle icon-white"></i>
	                <span class="hide-mobile">Cancelar envio</span>
	            </button>
	            <button type="button" class="btn btn-danger delete">
	                <i class="icon-remove icon-white"></i>
	                <span class="hide-mobile">Remover</span>
	            </button>
	            <span class="hide-mobile"><input type="checkbox" class="toggle"></span>
			</div>
			<div class="float-progress">
		        <!-- The global progress information -->
		        <div class="span5 fileupload-progress fade">
		            <!-- The global progress bar -->
		            <div class="progress progress-success progress-striped active">
		                <div class="bar" style="width:0%;"></div>
		            </div>
		            <!-- The extended global progress information -->
		            <div class="progress-extended">&nbsp;</div>
		        </div>
			</div>
    </div>
    <<?php ?>?php */?<?php ?>>
    <!-- The loading indicator is shown during file processing -->
    <div class="fileupload-loading"></div>
    <br />
    <br />
	<ul class="thumbnails files ui-sortable" data-toggle="modal-gallery" data-target="#modal-gallery"></ul>
</form>


<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Anterior</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Próxima</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>


<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="span3 template-upload fade">
		<div class="thumbnail">
        	<a href="#" class="thumbnail preview"><span class="fade"></span></a>
			{% if (file.error) { %}
	            <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
	        {% } else if (o.files.valid && !i) { %}
				<div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
	            
	            {% if (!o.options.autoUpload) { %}
				<span class="start">	            
					<button class="btn btn-primary">
	                    <i class="icon-upload icon-white"></i>
	                    <span>{%=locale.fileupload.start%}</span>
	                </button>
				</span>
	            {% } %}
	        {% } %}
        	
        	{% if (!i) { %}
			<span class="cancel">
				<button class="btn btn-warning">
	                <i class="icon-ban-circle icon-white"></i>
	                <span>{%=locale.fileupload.cancel%}</span>
	            </button>
			</span>
        	{% } %}
        </div>
    </li>
{% } %}
</script>

<!-- The template to display ftres available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <li id="item_{%=file.id%}" class="span3 template-download fade">
		<div class="thumbnail">
        {% if (file.error) { %}
            <div class="caption">
	        <p>{%=file.name%}</p>
            <p>{%=o.formatFileSize(file.size)%}</p>
            <p class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</p>
        {% } else { %}
            {% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" class="thumbnail" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}
            
            	<div class="filename">{%=file.name%}</div>
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}"><h5></h5></a>
            	<p>{%=o.formatFileSize(file.size)%}</p>
				<span class="delete">
					<button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                		<i class="icon-remove icon-white"></i>
						<span>{%=locale.fileupload.destroy%}</span>
					</button>
					<input type="checkbox" name="delete" value="1">
				</span>
        {% } %}
		</div>
    </li>
{% } %}
</script>
<?php }} ?>