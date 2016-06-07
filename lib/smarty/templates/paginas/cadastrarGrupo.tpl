<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Cadastrar Grupo</h2>
    </div>
    <div class="panel-body">

        {$erroCadastro} 
        <form action="includes/controllers/cadastrarGrupoControl.php" method="post" name="cadastrarGrupo" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputGrupo">Nome do Grupo</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" id="inputGrupo" name="inputGrupo" required="" placeholder="Nome do Grupo">
                </div>
            </div>                        

            <div class="row form-group">
                <label class="col-sm-2 control-label" for="textObservacaoGrupo"> Descrição</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="textObservacaoGrupo" name="textObservacaoGrupo" required="" placeholder="Descrição do grupo" rows="3"></textarea>
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