<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Usuários Cadastrados <a href="cadastrarUsuario.php" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastrar Novo</a></h2>
    </div>

    {$excluirUsuario}
    <div class="table-responsive table-bordered">
        <table class="table">


            {if isset($usuariosR)}                
                <th><center>Nome</center></th>             
                <th><center>Login</center></th>
                <th><center>Nivel</center></th>
                <th><center>Função</center></th>
                <th><center>Opção</center></th>
                    {foreach $usuariosR as $u}
                    <tr class="text-center">                       
                        <td class="active">{$u->nome_usuario}</td>                        
                        <td class="active">{$u->login_usuario}</td>
                        <td class="active">
                            {if $u->nivel_usuario == 0}
                                Administrador
                            {else if $u->nivel_usuario == 1}
                                Desenvolvedor
                            {else if $u->nivel_usuario == 2}
                                Coordenador
                            {else if $u->nivel_usuario == 3}
                                Suporte
                            {/if}
                        </td>
                        <td class="active">
                            {if $u->funcao_usuario == "Infra"} 
                                Infraestrutura 
                            {else if $u->funcao_usuario == "DD"} 
                                Desenvolvedor Dolphin 
                            {else if $u->funcao_usuario == "DS"} 
                                Desenvolverdor Sense 
                            {else if $u->funcao_usuario == "DI"} 
                                Desenvolvedor Ihealth
                            {else if $u->funcao_usuario == "SD"}
                                Suporte Dolphin
                            {else if $u->funcao_usuario == "SD"}
                                Suporte Ihealth
                            {else}
                                Função desconhecida
                            {/if}
                        </td>
                        <td class="active">
                            <a href="editarUsuario.php?id={$u->id_usuario}" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <button type="button" onclick="excluirUsuario({$u->id_usuario})" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-warning-sign"></span> Excluir</button>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Nenhum usuário cadastrado</h3></td></tr>
                        {/if}
        </table>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 