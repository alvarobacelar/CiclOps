<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Editar Servidor</h2>
    </div>
    <div class="panel-body">

        {if !empty($as)}

            <form action="includes/controllers/editarServidorControl.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
                <input type="hidden" id="hiddenIdServidor" name="hiddenIdServidor" value="{$as->id_servidor}">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputServidor">Nome do Servidor</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="inputServidor" name="inputServidor" required="" value="{$as->nome_servidor}" placeholder="Nome do Usuário">
                    </div>
                </div>            


                <div class="row form-group">
                    <label class="col-sm-3 control-label" for="inputIP">IP do servidor</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" id="inputIP" name="inputIP" required="" value="{$as->ip_servidor}" placeholder="IP do servidor">

                    </div>                
                </div>

                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="selectGrupo">Grupo de servidores</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="selectGrupo" name="selectGrupo" required="">
                            <option value="{$resGrup->id_grupo_servidor}" selected="">{$resGrup->nome_grupo_servidor}</option>                        
                            {foreach $grupo as $g}
                                <option value="{$g->id_grupo_servidor}">{$g->nome_grupo_servidor}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 control-label" for="textObsServer"> Observações</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="textObsServer" name="textObsServer" placeholder="Observações do servidor (opcional)" rows="3">{$as->obs_servidor}</textarea>
                    </div>                
                </div> 
                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="radioStatus">Status do servidor</label>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" id="radioStatus" value="1" {if $as->status_servidor == "1"} checked {/if}>
                                Ativo
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" id="radioStatus" value="0" {if $as->status_servidor != "1"} checked {/if}>
                                Desativado
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
                    </div>
                </div>
            </form>
            <br />

        {else}
            <div class="alert alert-danger text-center"><h3>O servidor escolhido para edição não existe</h3></div>
        {/if}

    </div>
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 