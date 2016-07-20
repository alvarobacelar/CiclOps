<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Editar Grupo</h2>
    </div>
    <div class="panel-body">

        {if !empty($gr)}
            <form action="includes/controllers/editarGrupoControl.php" method="post" name="editarGrupo" class="form-horizontal" role="form">
                <input type="hidden" id="hiddenIdGrupo" name="hiddenIdGrupo" value="{$gr->id_grupo_servidor}" >
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputGrupo">Nome do Grupo</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" id="inputGrupo" name="inputGrupo" value="{$gr->nome_grupo_servidor}" required="" placeholder="Nome do Grupo">
                    </div>
                </div>       
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputEmailGrupo">Email do Grupo</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" id="inputEmailGrupo" name="inputEmailGrupo" value="{$gr->email_grupo_servidor}" required="" placeholder="Email do Grupo">
                    </div>
                </div>  

                <div class="row form-group">
                    <label class="col-sm-2 control-label" for="textObservacaoGrupo"> Descrição</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="textObservacaoGrupo" name="textObservacaoGrupo" placeholder="Descrição do grupo" rows="3">{$gr->descricao_grupo_servidor}</textarea>
                    </div>                
                </div>            

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar</button>
                    </div>
                </div>
            </form>
        {else}
            <div class="alert alert-danger text-center"><h3>O grupo escolhido para edição não existe</h3></div>
        {/if}
        <br />
    </div>
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 