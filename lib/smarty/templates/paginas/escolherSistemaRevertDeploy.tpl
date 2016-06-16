<div class="panel panel-warning">
    <div class="panel-heading">
        <h2 class="panel-title text-capitalize"><strong>Escolha Sistema para reverter deploy</strong></h2>
    </div>

    {literal}       
        <script type="text/javascript">
            function reloadTomcat(id) {
                var reload = confirm("Deseja realmente reverter o último deploy ?");
                if (reload) {
                    $(document).ready(function () {
                        var acao = id;
                        $.ajax({
                            url: "execShellReverterDepl.php", // pagina que irá aparecer
                            type: 'POST', // metodo de recebimento: GET ou POST 
                            data: { reverterSistema: acao },
                            success: function (data) {
                                $("#conteudo").html(data);
                            },
                            error: function () { // se der erro mostrará uma mensagem
                                $("#conteudo").html("Erro ao executar os comandos");
                            },
                            beforeSend: function () { // antes de mostrar a requisição mostra uma mensagem
                                $("#conteudo").html("<center><img src='img/hourglass.gif' width='80'></center>");
                            }
                        });                       
                    });
                }
            }
        </script>
    {/literal}

    <div class="table-responsive table-bordered">
        <table class="table">

            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">1º Escolher Servidor</span></a></li>
                    <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                    <li class="active"><a >2º Escolher Sistema <span class="sr-only">(current)</span></a></li>              
            </nav>


            {if isset($sistemaDeploy)}                
                <th><center>Sistema</center></th>             
                <th><center>path sistema</center></th>
                <th><center>path tomcat</center></th>
                <th><center>Opção</center></th>
                    {foreach $sistemaDeploy as $u}
                    <tr class="text-center">                       
                        <td class="active">{$u->nome_sistema}</td>
                        <td class="active">{$u->path_sistema}</td>                        
                        <td class="active">{$u->path_usuarios_servidor}</td>
                        <td class="active">
                            {if $u->status_reverter_deploy != 1}
                                <a type="button" onclick="reloadTomcat({$u->id_sistema});" title="Ao cliar no botão será revertido o último deploy no servidor {$u->nome_sistema}" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-refresh"></span> Reverter Deploy</a>
                            {else}
                                <a type="button"  title="Ultimo deploy já foi revertido" class="btn btn-danger btn-xs disabled"> <span class="glyphicon glyphicon-refresh"></span> Reverter Deploy</a>
                            {/if}
                        </td>
                    </tr>

                {/foreach}
            {else}
                <tr class="text-center"><td><h3>Nenhum sistema cadastrado nesse servidor</h3></td></tr>
                        {/if}
        </table>
        <br>
        <div class="alert alert-success" id="conteudo" role="alert"></div>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 