<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Editar usuário de servidor</h2>
    </div>
    <div class="panel-body">

        {if !empty($s)}

            <form action="includes/controllers/editarUserServidorControl.php" method="post" name="editarUserServidor" class="form-horizontal" role="form">
                <input type="hidden" id="hiddenIdUser" name="hiddenIdUser" value="{$s->id_usuarios_servidor}">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputNomeUser">Nome do usuário servidor</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" id="inputNomeUser" name="inputNomeUser" required="" value="{$s->nome_usuarios_servidor}" placeholder="Nome do Usuário de servidor">
                    </div>
                </div>   

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputSenhaUser">Senha do usuário servidor</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" id="inputSenhaUser" name="inputSenhaUser" value="{$s->senha_usuario_servidor}" required="" placeholder="Senha do Usuário de servidor">
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-3 control-label" for="inputPathTomcat">Path tomcat do usuário</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="inputPathTomcat" name="inputPathTomcat" required="" value="{$s->path_usuarios_servidor}" placeholder="EX: /opt/tomcat7">

                    </div>                
                </div> 
                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="selectServidor">Servidor do usuário</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="selectServidor" name="selectServidor" required="">
                            <option value="{$s->id_servidor}" selected="">{$resServ->nome_servidor}</option>                        
                            {foreach $servidor as $g}
                                <option value="{$g->id_servidor}">{$g->nome_servidor}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div class="form-group ">
                    <label class="col-sm-3 control-label" for="radioStatus">Status do usuário do servidor</label>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" id="radioStatus" value="1" {if $s->status_usuario_servidor == "1"} checked {/if}>
                                Ativo
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" id="radioStatus" value="0" {if $s->status_usuario_servidor != "1"} checked {/if}>
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
            <div class="alert alert-danger text-center"><h3>O usuário escolhido para edição não existe</h3></div>
        {/if}

    </div>
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 