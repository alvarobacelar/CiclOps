<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Arquivos de backup</h2>
    </div>
    <br>

    <div class="table-responsive table-bordered">
        <table class="table">

            <th>Nome do arquivo</th>             
            <th><center>Opção</center></th>
                {foreach $arquivo as $arq}
                    {if $arq != ".."}
                        {if $arq != "."}
                        <tr>                       
                            <td class="active">{$arq}</td>                                                                                
                            <td class="active text-center">
                                <a href="{$path}{$arq}" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-download-alt"></span> Download</a>
                            </td>
                        </tr>
                    {/if}
                {/if}
            {/foreach}            
        </table>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 