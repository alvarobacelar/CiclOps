<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Cadastrar Usuário</h2>
    </div>
    <div class="panel-body">

        {$erroCadastro} 
        <form action="includes/controllers/cadastraUsuarioNovo.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputNome">Nome do Usuário</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="inputNome" name="inputNome" required="" placeholder="Nome do Usuário">
                </div>
            </div>            


            <div class="row form-group">
                <label class="col-sm-2 control-label" for="inputLogin">Login</label>
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="inputLogin" name="inputLogin" required="" placeholder="Login do usuário">

                </div>
                <div class="col-sm-3">
                    <select class="form-control" id="selectNivel" name="selectNivel" required="">
                        <option value="">Nivel do usuário</option>
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
                    <input class="form-control" type="password" id="inputSenha" value="" name="inputSenha" required="" placeholder="Senha">
                </div>                               
            </div>
            <div class="form-group ">
                <label class="col-sm-2 control-label" for="inputSenha2">Repita a senha</label>
                <div class="col-sm-3">
                    <input class="form-control" type="password" id="inputSenha2" value="" name="inputSenha2" required="" onblur="verificaSenha()" placeholder="Repitir senha">
                    <span id="erro-senha"></span>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" id="inputFuncao" name="inputFuncao" required="">
                        <option value="">Função do usuário</option>
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
                        <option value="" selected="">Escolha o grupo do usuário</option>                        
                        {foreach $grupo as $g}
                            <option value="{$g->id_grupo_servidor}">{$g->nome_grupo_servidor}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label" for="textObsUser"> Descrição</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="textObsUser" name="textObsUser" placeholder="Observações do usuário (opcional)" rows="3"></textarea>
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