<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Editar Usuário</h2>
    </div>
    <div class="panel-body">

        {if !empty($us)}

            <form action="includes/controllers/editarUsuarioControl.php" method="post" name="editarUsuario" class="form-horizontal" role="form">
                <input type="hidden" id="hiddenIdUsuario" name="hiddenIdUsuario" value="{$us->id_usuario}" >
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputNome">Nome do Usuário</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" id="inputNome" name="inputNome" value="{$us->nome_usuario}" required="" placeholder="Nome do Usuário">
                    </div>
                </div>            


                <div class="row form-group">
                    <label class="col-sm-2 control-label" for="inputLogin">Login</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" id="inputLogin" name="inputLogin" required="" value="{$us->login_usuario}" placeholder="Login do usuário">

                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="selectNivel" name="selectNivel" required="">
                            <option value="{$us->nivel_usuario}">
                                {if $us->nivel_usuario == 0}
                                    Administrador
                                {else if $us->nivel_usuario == 1}
                                    Desenvolvedor
                                {else if $us->nivel_usuario == 2}
                                    Coordenador
                                {else if $us->nivel_usuario == 3}
                                    Suporte
                                {/if}
                            </option>
                            <option value="0">Administrador</option>
                            <option value="1">Desenvolvedor</option>
                            <option value="2">Coordenador</option>
                            <option value="3">Suporte</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="inputSenha">Senha</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="password" id="inputSenha" value="" name="inputSenha" placeholder="Senha">
                    </div>                               
                </div>
                <div class="form-group ">
                    <label class="col-sm-2 control-label" for="inputSenha2">Repita a senha</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="password" id="inputSenha2" value="" name="inputSenha2" onblur="verificaSenha()" placeholder="Repitir senha">
                        <span id="erro-senha"></span>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="inputFuncao" name="inputFuncao" required="">
                            <option value="{$us->funcao_usuario}">
                                {if $us->funcao_usuario == "DD"}
                                    Desenvolvedor Dolphin
                                {else if $us->funcao_usuario == "DI"}
                                    Desenvolvedor Ihealth
                                {else if $us->funcao_usuario == "DS"}
                                    Desenvolvedor Sense
                                {else if $us->funcao_usuario == "Infra"}
                                    Infraestrutura
                                {else if $us->funcao_usuario == "SD"}
                                    Suporte Dolphin
                                {else if $us->funcao_usuario == "SI"}
                                    Suporte Ihealth
                                {/if}
                            </option>
                            <option value="DD">Desenvolvedor Dolphin</option>
                            <option value="DI">Desenvolvedor Ihealth</option>
                            <option value="DS">Desenvolvedor Sense</option>
                            <option value="Infra">Infraestrutura</option>
                            <option value="SD">Suporte Dolphin</option>
                            <option value="SI">Suporte Ihealth</option>

                        </select>
                    </div>
                </div>

                <div class="form-group ">
                    <label class="col-sm-2 control-label" for="selectGrupo">Grupo</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="selectGrupo" name="selectGrupo" required="">
                            <option value="{$us->id_grupo_servidor}" selected="">{$resGrup->nome_grupo_servidor}</option>                        
                            {foreach $grupo as $g}
                                <option value="{$g->id_grupo_servidor}">{$g->nome_grupo_servidor}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 control-label" for="textObsUser"> Descrição</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" id="textObsUser" name="textObsUser" placeholder="Observações do usuário (opcional)" rows="3">{$us->obs_usuario}</textarea>
                    </div>                
                </div> 

                <div class="form-group ">
                    <label class="col-sm-2 control-label" for="radioStatus">Status do sistema</label>
                    <div class="col-sm-2">
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" id="radioStatus" value="1" {if $us->status_usuario == "1"} checked {/if}>
                                Ativo
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="radioStatus" id="radioStatus" value="0" {if $us->status_usuario != "1"} checked {/if}>
                                Desativado
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
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