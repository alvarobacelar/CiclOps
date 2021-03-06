<div class="row">

    <div class="panel panel-primary">

        <div class="panel-heading">

            <h2 class="panel-title">Alterar senha de usuário</h2>
        </div>

        <div class="panel-body">

            {$erroSenha}
            <div class="col-md-8 col-md-offset-3">
                <img src="img/user.png" alt="usuario" width="100" class="img-circle"><br>
                <p><strong>Nome:</strong> <small>{$usuario->nome_usuario}</small></p>
                <p>
                    <strong>Função:</strong> <small>
                        {if $usuario->funcao_usuario == "DD"}
                            Desenvolvedor Dolphin
                        {else if $usuario->funcao_usuario == "DI"}
                            Desenvolvedor Ihealth
                        {else if $usuario->funcao_usuario == "DS"}
                            Desenvolvedor Sense
                        {else if $usuario->funcao_usuario == "Infra"}
                            Infraestrutura
                        {else if $usuario->funcao_usuario == "SD"}
                            Suporte Dolphin
                        {else if $usuario->funcao_usuario == "SI"}
                            Suporte Ihealth
                        {/if}
                    </small>
                </p>
                <p><strong>Login:</strong> <small>{$usuario->login_usuario}</small></p>
                <p><strong>Mudar Senha</strong></p>
                <form action="includes/controllers/mudarSenha.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="{$usuario->id_usuario}">
                    <div class="form-group form-group-sm">
                        <label class="col-sm-3 control-label" for="inputSenha">Senha Atual</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="password" value="" id="inputSenhaAtual" required="" name="inputSenhaAtual">
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-3 control-label" for="inputSenha">Nova Senha</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="password" value="" id="inputSenha" required="" name="inputSenha">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-sm-3 control-label" for="inputSenha2">Repita a senha</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="password" id="inputSenha2" onblur="verificaSenha()" required="" name="inputSenha2">
                            <div id="erro-senha"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Mudar Senha</button>
                        </div>
                    </div>
                </form>        
            </div>
        </div>
    </div>
</div>