<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Administração | {$siteNome}</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!--[if IE 7]>
          <link rel="stylesheet" href="/assets/css/fontawesome/font-awesome-ie7.css">
        <![endif]-->

        <!-- Le styles -->
        <link href="/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="/assets/css/bootstrap/datepicker.css" rel="stylesheet">
        <link href="/assets/css/redactor/redactor.css" rel="stylesheet">
        <link href="/assets/css/bootstrap/bootstrap-image-gallery.min.css" rel="stylesheet">
        <link href="/assets/css/bootstrap/no-more-tables.css" rel="stylesheet">
        <link href="/assets/css/fontawesome/font-awesome.css" rel="stylesheet">
        <link href="/assets/css/fontawesome/font-awesome-size.css" rel="stylesheet">
        <link href="/assets/css/estrutura/flags.css" rel="stylesheet">
        <link href="/assets/css/estrutura/malerta.css" rel="stylesheet">
        <link href="/assets/css/fileupload/jquery.fileupload-ui.css" rel="stylesheet">
        <link href="/assets/css/chosen/chosen.css" rel="stylesheet">
        <link href="/assets/css/admix/daterangepicker.css" rel="stylesheet">
        <link href="/assets/css/admix/mixd.css" rel="stylesheet">

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="/assets/img/ico/favicon.ico">
        <link rel="apple-touch-icon" href="/assets/img/ico/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/ico/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/ico/apple-touch-icon-114x114.png">

    </head>

    <body {if $print } class="print" {/if}>
        <div class="wrap">    
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="#">MIXD Internet</a>
                        <div class="nav-collapse">
                            <ul class="nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrativo <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admix/usuarios">Usuários</a></li>
                                        <li><a href="/admix/acessos">Acessos</a></li>
                                        <li><a href="/admix/configuracoes">Configurações</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Conteúdo <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admix/chamados">Chamados</a></li>
                                        <li><a href="/admix/categorias">Categorias</a></li>
                                        <li><a href="/admix/produtos">Produtos</a></li>
                                    </ul>
                                </li>
                                {*<li><a href="#contact">Contact</a></li>*}
                            </ul>
                            <ul class="nav pull-right">
                                <li class="divider-vertical"></li>
                                <li class="dropdown avatar">
                                    <a href="#" class="avatar dropdown-toggle" data-toggle="dropdown"><img src="/assets/img/estrutura/avatar.png" width="26" height="26"> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="/admix/meusdados" class="avatar-wrap">
                                                <img src="{if $usuarioAvatar}{$usuarioAvatar|thumbnail:'32x32'}{else}/assets/img/estrutura/sem-avatar.png{/if}"> 
                                                <span class="titulo">{$usuarioNome}</span>
                                                <span class="subtitulo">Alterar meus dados</span>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="/admix/login/logout">Sair</a></li>
                                    </ul>
                                </li>
                            </ul>  
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>

            <section class="body">
                <!-- Le container -->
                <div class="container-fluid"> 
                    {$ir}	

                </div>
            </section>

            <div class="push"></div>
        </div><!--/.wrap -->

        <footer class="footer">
            <p class="pull-right"><a href="#">Subir</a></p>
            <p>Desenvolvido por <a href="http://www.mixd.com.br/" target="_blank">MIXD Internet</a>.</p>
        </footer>

        <!-- Le javascript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/assets/js/jquery-1.8.2.min.js"><\/script>')</script>    
        <!--script src="/assets/js/jquery-1.8.2.min.js"></script-->
        <script src="/assets/js/date.js"></script>
        <script src="/assets/js/jquery.tools.validator.js"></script>
        <script src="/assets/js/jquery.malerta-0.1.js"></script>
        <script src="/assets/js/jquery.filestyle.mini.js"></script>
        <script src="/assets/js/redactor/langs/pt_br.js"></script>
        <script src="/assets/js/redactor/redactor.min.js"></script>
        <script src="/assets/js/jquery-ui-1.9.2.sortable.min.js"></script>
        <script src="/assets/js/jquery.ui.touch-punch.js"></script>
        <script src="/assets/js/fileupload/tmpl.min.js"></script>
        <script src="/assets/js/fileupload/load-image.min.js"></script>
        <script src="/assets/js/fileupload/canvas-to-blob.min.js"></script>
        <script src="/assets/js/fileupload/jquery.iframe-transport.js"></script>
        <script src="/assets/js/fileupload/jquery.fileupload.js"></script>
        <script src="/assets/js/fileupload/jquery.fileupload-fp.js"></script>
        <script src="/assets/js/fileupload/jquery.fileupload-ui.js"></script>
        <script src="/assets/js/fileupload/locale.js"></script>
        <script src="/assets/js/fileupload/mupload.js"></script>
        <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="/assets/js/bootstrap/bootstrap-datepicker.js"></script>
        <script src="/assets/js/bootstrap/bootstrap-image-gallery.min.js"></script>
        <script src="/assets/js/bootstrap/bootstrap-colorpicker.js"></script>
        <script src="/assets/js/jquery.chosen.min.js"></script>
        <script src="/assets/js/jquery.daterangepicker.js"></script>
        <script src="/assets/js/jquery.maskMoney.js"></script>
        <script src="/assets/js/jquery.maskedinput.1.3.1.min.js"></script>
        <script src="/assets/js/admix.js"></script>

        {malerta msn=$malerta}

    </body>
</html>