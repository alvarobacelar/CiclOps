<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Grupos Cadastrados <a href="cadastrarGrupo.php" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastrar Novo</a></h2>
    </div>

    {$excluirUsuario}
    <div class="table-responsive table-bordered">
        <table class="table">


            {if isset($busca)}                
                <th><center>ID</center></th>
                <th><center>Grupo</center></th>
                <th><center>Observação</center></th>
                <th><center>Opção</center></th>
                    {foreach $busca as $u}
                    <tr class="text-center">                                               
                        <td class="active">{$u->login_usuario}</td>
                        <td class="active">  </td>
                        <td class="active">{$u->funcao_usuario}</td>
                        <td class="active">
                            <a href="editarUsuario.php?id={$u->id_usuario}" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <button type="button" onclick="excluirUsuario({$u->id_usuario})" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-warning-sign"></span> Excluir</button>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Nenhum grupo de usuários cadastrado</h3></td></tr>
                        {/if}
        </table>
    </div>
    <br />
    
</div>
        <center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 