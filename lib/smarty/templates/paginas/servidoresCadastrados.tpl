<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Servidores Cadastrados <a href="cadastrarServidor.php" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Cadastrar Novo</a></h2>
    </div>

    {$excluirServidor}
    <div class="table-responsive table-bordered">
        <table class="table">


            {if isset($servidorR)}                
                <th><center>Nome</center></th>             
                <th><center>IP</center></th>
                <th><center>Grupo</center></th>
                <th><center>Observações</center></th>
                <th><center>Data cadastro</center></th>
                <th><center>Opção</center></th>
                    {foreach $servidorR as $u}
                    <tr class="text-center">                       
                        <td class="active">{$u->nome_servidor}</td>                        
                        <td class="active">{$u->ip_servidor}</td>
                        <td class="info"> {$u->nome_grupo_servidor} </td>
                        <td class="active"> {$u->obs_servidor} </td>
                        <td class="active"> {$u->data_cadastro_servidor|date_format:"%d/%m/%Y"} </td>
                        <td class="active">
                            <a href="editarUsuario.php?id={$u->id_servidor}" class="btn btn-warning btn-xs"> <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <button type="button" onclick="excluirServidor({$u->id_servidor})" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-warning-sign"></span> Excluir</button>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Nenhum serrvidor cadastrado</h3></td></tr>
                        {/if}
        </table>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 