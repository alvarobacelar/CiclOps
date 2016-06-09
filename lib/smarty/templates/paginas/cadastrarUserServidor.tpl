<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Cadastrar Usuário do Servidor</h2>
    </div>
    <div class="panel-body">

        {$erroCadastro} 
        <form action="includes/controllers/cadastrarUserServidorControl.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputNomeUser">Nome do usuário servidor</label>
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="inputNomeUser" name="inputNomeUser" required="" placeholder="Nome do Usuário de servidor">
                </div>
            </div>            

            <div class="row form-group">
                <label class="col-sm-3 control-label" for="inputPathTomcat">Path tomcat do usuário</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="inputPathTomcat" name="inputPathTomcat" required="" placeholder="EX: /opt/tomcat7">

                </div>                
            </div> 
            <div class="form-group ">
                <label class="col-sm-3 control-label" for="selectServidor">Servidor do usuário</label>
                <div class="col-sm-3">
                    <select class="form-control" id="selectServidor" name="selectServidor" required="">
                        <option value="" selected="">Escolha o grupo de servidores</option>                        
                        {foreach $grupo as $g}
                            <option value="{$g->id_servidor}">{$g->nome_servidor}</option>
                        {/foreach}
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar</button>
                </div>
            </div>
        </form>
        <br />

    </div>
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 