<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Escolha Servidor para Deploy</h2>
    </div>

    <div class="table-responsive table-bordered">
        <table class="table">
            
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


            {if isset($servidoresGrupo)}                
                <th><center>Servidor</center></th>             
                <th><center>IP</center></th>
                <th><center>Opção</center></th>
                    {foreach $servidoresGrupo as $u}
                    <tr class="text-center">                       
                        <td class="active">{$u->nome_servidor}</td>                        
                        <td class="active">{$u->ip_servidor}</td>
                        <td class="active">
                            <a href="realizarDeploy.php?servidor={$u->id_servidor}" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-search"></span> Escolher servidor</a>
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Nenhum servidor cadastrado</h3></td></tr>
                        {/if}
        </table>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 