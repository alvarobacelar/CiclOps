<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Cadastrar Usuário</h2>
    </div>
    <div class="panel-body">

        {$erroCadastro} 
        <form action="includes/controllers/cadastraUsuarioNovo.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
            <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="inputNome">Nome Completo</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="inputNome" name="inputNome" required="" placeholder="Nome do Usuário">
                </div>
            </div>            
            
             
            <div class="row form-group form-group-sm">
                <label class="col-sm-2 control-label" for="inputLogin">Login</label>
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="inputLogin" name="inputLogin" required="" placeholder="Login do usuário">

                </div>
                <div class="col-sm-3">
                    <select class="form-control" id="selectNivel" name="selectNivel" required="">
                        <option value="">Nivel do usuário</option>
                        <option value="0">Administrador</option>
                        <option value="1">Desenvolvedor</option>
                        <option value="3">Coordenador</option>
                        <option value="2">Suporte</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="inputSenha">Senha</label>
                <div class="col-sm-3">
                    <input class="form-control" type="password" id="inputSenha" value="" name="inputSenha" required="" placeholder="Senha">
                </div>                               
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="inputSenha2">Repita a senha</label>
                <div class="col-sm-3">
                    <input class="form-control" type="password" id="inputSenha2" value="" name="inputSenha2" required="" onblur="verificaSenha()" placeholder="Repitir senha">
                    <span id="erro-senha"></span>
                </div>
                 <div class="col-sm-3">
                    <select class="form-control" id="inputFuncao" name="inputFuncao" required="">
                        <option value="">Função do usuário</option>
                        <option value="D">Desenvolvedor Dolphin</option>
                        <option value="I">Desenvolvedor Ihealth</option>
                        <option value="S">Desenvolvedor Sense</option>
                        <option value="Infra">Infraestrutura</option>
                        <option value="SD">Suporte Dolphin</option>
                        <option value="SI">Suporte Ihealth</option>
                        
                    </select>
                </div>
            </div>
            <!--
            <div class="form-group form-group-sm">
                <label class="col-sm-2 control-label" for="selectPosto">Posto/Graduação</label>
                <div class="col-sm-2">
                    <select class="form-control" id="selectPosto" name="selectPosto" required="">
                        <option value="" selected="">Posto/Graduação</option>
                        <option value="Gal">General</option>
                        <option value="Cel">Coronel</option>
                        <option value="TC">Tenete Coronel</option>
                        <option value="Maj">Major</option>
                        <option value="Cap">Capitão</option>
                        <option value="1º Ten">1º Tenente</option>
                        <option value="2º Ten">2º Tenente</option>
                        <option value="Asp">Aspirante</option>
                        <option value="S Ten">Sub-Tenente</option>
                        <option value="1º Sgt">1º Sargento</option>
                        <option value="2º Sgt">2º Sargento</option>
                        <option value="3º Sgt">3º Sargento</option>
                        <option value="Cb">Cabo</option>
                        <option value="Sd">Soldado</option>
                    </select>
                </div>
            </div>
            -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
            </div>
        </form>
        <br />
        
    </div>
</div>
        <center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 