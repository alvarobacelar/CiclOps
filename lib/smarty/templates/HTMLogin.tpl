
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/infra.ico">

        <title>CiclOps - Ciclo de Operações Infoway</title>

        <!-- Bootstrap core CSS -->
        <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS geral da layout -->
        <link href="css/geral.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="lib/bootstrap/css/navbar-static-top.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="js/IE/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/IE/html5shiv.min.js"></script>
          <script src="js/IE/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><strong><span class="glyphicon glyphicon-console" aria-hidden="true"></span> CiclOps</strong></a>
                    <p class="navbar-text">Ciclo de Operações Infoway</p>   
                </div>

            </div><!--/.nav-collapse -->
        </div>
    

    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <!-- Main component for a primary marketing message or call to action -->
                <div class="jumbotron">
                    <p class="lead text-center">Realize o login para ter acesso ao sistema</p><br />
                    {$erro}
                    <form action="loginSistema.php" method="post" name="logar" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputLogin" class="col-sm-2 control-label">Usuário</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputLogin" name="inputLogin" autofocus value="" placeholder="Usuário" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="inputSenha" name="inputSenha" value="" placeholder="Senha" required="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary btn-lg"> Entrar</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

        <p class="text-center rodape">
            ©2016 - Ciclo de Operações Infoway - Infraestrutura<br />
            Desenvolvido por <strong>Álvaro Bacelar</strong><br />
            Versão {$versao}
        </p>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jQuery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="lib/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>