<div class="panel panel-primary">

    <div class="panel-heading">

        <h2 class="panel-title">Grupos Cadastrados <a href="cadastrarGrupo.php" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastrar Novo</a></h2>
    </div>
    <br>
    {$erroCadastro}
    <div class="table-responsive table-bordered">
        <table class="table">


            {if isset($grupoR)}                
                <th><center>ID</center></th>
                <th><center>Grupo</center></th>
                <th><center>Observação</center></th>
                <th><center>Observação</center></th>
                <th><center>Opção</center></th>
                    {foreach $grupoR as $u}
                    <tr class="text-center">                                               
                        <td class="active">{$u->id_grupo_servidor}</td>
                        <td class="active"> {$u->nome_grupo_servidor} </td>
                        <td class="active">{$u->descricao_grupo_servidor}</td>
                        <td class="active">{if $u->status_grupo_servidor == 1}<button type="button" class="btn btn-xs btn-success" disabled="disabled"> Ativo </button>{else if $u->status_grupo_servidor == 0}<button type="button" class="btn btn-xs btn-default" disabled="disabled"> Desativado</button> {else}<button type="button" class="btn btn-xs btn-warning" disabled="disabled"> Status desconhecido</button> {/if}</td>
                        <td class="active">
                            <a href="editarGrupo.php?idGrup={$u->id_grupo_servidor}" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <button type="button" onclick="excluirUsuario({$u->id_grupo_servidor})" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-warning-sign"></span> Desativar</button>
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