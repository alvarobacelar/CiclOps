<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Cadastrar Usuário do Servidor</h2>
    </div>
    <div class="panel-body">

        {$erroCadastro} 
        <form action="includes/controllers/cadastraUserServerControl.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputServidor">Nome do usuário do server</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="inputServidor" name="inputServidor" required="" placeholder="Nome do Usuário">
                </div>
            </div>            

            <div class="row form-group">
                <label class="col-sm-2 control-label" for="inputLogin">Path</label>
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="inputLogin" name="inputLogin" required="" placeholder="Login do usuário">

                </div>                
            </div> 

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar</button>
                </div>
            </div>
        </form>
        <br />

    </div>
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 