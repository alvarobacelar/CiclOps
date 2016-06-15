 
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/infra.ico">
        <title>SisDeploy - Sistema de Gerenciamento de Deploy</title>
        <!-- Bootstrap core CSS -->
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS geral da layout -->
        <link href="css/geral.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="lib/bootstrap/css/navbar-static-top.css" rel="stylesheet">

        <script src="js/valida.js" type="text/javascript"></script>

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="js/IE/ie-emulation-modes-warning.js"></script>
        
        <script src="js/jquery.min.js" type="text/javascript"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/IE/html5shiv.min.js"></script>
          <script src="js/IE/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./"><strong><span class="glyphicon glyphicon-console" aria-hidden="true"></span> SisDeploy</strong></a>
                </div>
                <div class="navbar-collapse collapse">

                    <ul class="nav navbar-nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciamento de Deploy <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">                                   
                                <li><a href="realizarDeploy.php"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Realizar Deploy</a></li>
                                <li><a href=""><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Reverter Deploy</a></li>
                                <li><a href="historicoDeploy.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Historico de Deploy</a></li>
                                <li class="divider"></li>
                                <li role="presentation" class="dropdown-header">Tomcat </li>
                                <li><a href="reiniciarTomcat.php"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reiniciar Tomcat</a></li>
                                <!--<li><a href=""><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Ficha Cadastro</a></li>-->
                                <!--<li><a href="gerarEntradaPipeiros.php"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Rel. entrada de pipeiros</a></li>-->                                    
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Servidores<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation" class="dropdown-header">Servidores</li>
                                <li><a href="cadastrarServidor.php"><span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> Servidor Novo</a></li>
                                <li><a href="servidoresCadastrados.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Cadastrados</a></li>                                
                                <li class="divider"></li>
                                <li role="presentation" class="dropdown-header">Usuários de servidores</li>
                                <li><a href="cadastrarUserServidor.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuário Novo</a></li>
                                <li><a href="userServidorCadastrados.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Cadastrados</a></li>
                                <li class="divider"></li>
                                <li role="presentation" class="dropdown-header">Sistemas</li>
                                <li><a href="cadastrarSistema.php"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> Sistema Novo</a></li>
                                <li><a href="sistemasCadastrados.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Cadastrados</a></li>
                            </ul>
                        </li> 

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuários<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">                               
                                <li role="presentation" class="dropdown-header">Grupos</li>
                                <li><a href="cadastrarGrupo.php"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Cadastrar Grupo</a></li>
                                <li><a href="gruposCadastrados.php"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Grupos Cadastrados</a></li>
                                <li class="divider"></li>
                                <li role="presentation" class="dropdown-header">Usuários</li>
                                <li><a href="cadastrarUsuario.php"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span> Cadastrar Usuários</a></li>
                                <li><a href="usuariosCadastrados.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuários Cadastrados</a></li>                                
                                <li class="divider"></li>
                                <li><a href="logAcesso.php"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Log de Acessos</a></li>                                
                            </ul>
                        </li>                    

                        {*
                        <li><a href="cadastrarOM.php">Opção 2</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opção 2 <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu"> 
                                <li><a href=""><span class="glyphicon glyphicon-tree-deciduous" aria-hidden="true"></span> Opção 2</a></li>
                                <li class="divider"></li>
                                <li role="presentation" class="dropdown-header">Opção 2</li>
                                <li><a href=""><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Opção 2</a></li>
                                <li><a href=""><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Opção 2</a></li>
                                <li><a href=""><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Opção 2</a></li>

                                <li class="divider"></li>
                                <li role="presentation" class="dropdown-header">Gerar ...</li>
                                <li><a href=""><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Iprimir</a></li>

                            </ul>
                        </li>     
                        *}
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        {* <li><a href="../navbar/">Default</a></li> *}
                        <li class="dropdown">                        
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <small>{$nomeUser}</small> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="usuario.php"><span class="glyphicon glyphicon-edit"></span> Alterar Senha</a></li>
                                <li><a href="logOUT.php"><span class="glyphicon glyphicon-off"></span> Sair</a></li>
                            </ul>
                        </li>

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">
            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">

                {include file=$conteudo} {*Conteúdo principal do sistema*}

            </div>
        </div> <!-- /container -->

        <p class="text-center rodape">
            ©2016 - Sistema de Gerenciamento de Deploy<br />
            Desenvolvido por <strong>Álvaro Bacelar</strong><br />
            Versão {$versao}
        </p>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jQuery/jquery-1.8.3.min.js"></script>
        <script src="js/jQuery/jquery.min.js"></script>
        <script src="lib/bootstrap/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="lib/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
        <script src="js/jQuery/jquery.maskedinput.min.js"></script>
        <script src="js/jQuery/jquery.validate.js"></script>
        <script src="js/jQuery/util.validate.js"></script>
        <script src="js/jQuery/validador.js"></script>
        <script src="js/jQuery/jquery.js"></script>
        <script src="js/jQuery/jquery.maskMoney.js"></script>
        <script src="js/jQuery/mascaras.js"></script>
        <script src="js/ajax.js"></script>
    </body>
</html>