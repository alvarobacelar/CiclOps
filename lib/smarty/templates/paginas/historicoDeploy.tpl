<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Historico de deploys</h2>
    </div>

    <div class="table-responsive table-bordered">
        <table class="table">

            {*
            <nav class="text-center">
            <ul class="pagination">
            <li class="active"><a >1º Escolher Servidor <span class="sr-only">(current)</span></a></li>
            <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
            <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">2º Escolher Sistema</span></a></li>
            <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
            <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">3º Enviar arquivo</span></a></li>
            <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
            <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">4º Iniciar Deploy</span></a></li>
            </ul>
            </nav>
            *}

            {if isset($filH)}                
                <th><center>Servidor</center></th>             
                <th><center>Sistema</center></th>
                <th><center>Nome do arquivo</center></th>
                <th><center>Enviado por</center></th>
                <th><center>Data</center></th>
                <th><center>Status</center></th>
                    {foreach $filH as $u}

                    {if $u->status_file_deploy == "0"}
                        <tr class="text-center">                       
                            <td class="alert-success">{$u->nome_servidor}<br><small>({$u->ip_servidor})</small></td>                        
                            <td class="alert-success">{$u->nome_sistema}</td>
                            <td class="alert-success">{$u->nome_original_file}</td>
                            <td class="alert-success">{$u->nome_usuario}</td>
                            <td class="alert-success">{$u->data_file_deploy|date_format:"%d/%m/%Y"}</td>
                            <td class="alert-success">
                                <button class="btn btn-success btn-xs disabled"> <span class="glyphicon glyphicon-ok-sign"></span> Deploy Realizado</button>
                            </td>
                        </tr>
                    {else}
                        <tr class="text-center">                       
                            <td class="alert-info">{$u->nome_servidor}<br><small>({$u->ip_servidor})</small></td>                        
                            <td class="alert-info">{$u->nome_sistema}</td>
                            <td class="alert-info">{$u->nome_original_file}</td>
                            <td class="alert-info">{$u->nome_usuario}</td>
                            <td class="alert-info">{$u->data_file_deploy|date_format:"%d/%m/%Y"}</td>
                            <td class="alert-info">
                                <a href="iniciarDeploy.php?idFile={$u->id_file_deploy}" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-upload"></span> Realizar Deploy</a>
                                <a href="{$u->id_file_deploy}" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-trash"></span> Excluir arquivo</a>
                            </td>
                        </tr>    
                    {/if}
                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Não há histórico de deploys realizado</h3></td></tr>
                        {/if}
        </table>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 