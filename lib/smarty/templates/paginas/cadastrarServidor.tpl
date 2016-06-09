<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Cadastrar Servidor</h2>
    </div>
    <div class="panel-body">

        {$erroCadastro} 
        <form action="includes/controllers/cadastrarServidorControl.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputServidor">Nome do Servidor</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="inputServidor" name="inputServidor" required="" placeholder="Nome do Usuário">
                </div>
            </div>            


            <div class="row form-group">
                <label class="col-sm-3 control-label" for="inputIP">IP do servidor</label>
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="inputIP" name="inputIP" required="" placeholder="IP do servidor">

                </div>                
            </div>
             
            <div class="form-group ">
                <label class="col-sm-3 control-label" for="selectGrupo">Grupo de servidores</label>
                <div class="col-sm-3">
                    <select class="form-control" id="selectGrupo" name="selectGrupo" required="">
                        <option value="" selected="">Escolha o grupo de servidores</option>                        
                        {foreach $grupo as $g}
                            <option value="{$g->id_grupo_servidor}">{$g->nome_grupo_servidor}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 control-label" for="textObsServer"> Observações</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="textObsServer" name="textObsServer" placeholder="Observações do servidor (opcional)" rows="3"></textarea>
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