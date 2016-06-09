<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Sistemas Cadastrados <a href="cadastrarSistema.php" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastrar Novo</a></h2>
    </div>

    {$excluirSistema}
    <div class="table-responsive table-bordered">
        <table class="table">


            {if isset($sistemaR)}                
                <th><center>Nome</center></th>             
                <th><center>Path Sistema</center></th>
                <th><center>Usuario Servidor</center></th>
                <th><center>Servidor</center></th>
                <th><center>Data cadastro</center></th>
                <th><center>Opção</center></th>
                    {foreach $sistemaR as $u}
                    <tr class="text-center">                       
                        <td class="active">{$u->nome_sistema}</td>                        
                        <td class="active">{$u->path_sistema}</td>
                        <td class="alert-success"> {$u->nome_usuarios_servidor} </td>
                        <td class="alert-info"> {$u->nome_servidor} <br> <small>(IP - {$u->ip_servidor})</small> </td>
                        <td class="active"> {$u->data_cadastro_servidor|date_format:"%d/%m/%Y"} </td>
                        <td class="active">
                            <a href="editarUsuario.php?id={$u->id_sistema}" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <button type="button" onclick="excluirServidor({$u->id_sistema})" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-warning-sign"></span> Excluir</button>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Nenhum sistema cadastrado</h3></td></tr>
                        {/if}
        </table>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 