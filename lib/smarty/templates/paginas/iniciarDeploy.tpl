<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Escolha Servidor para Deploy</h2>
    </div>

    {literal}
        <script type="text/javascript">
            $(document).ready(function () {
                $("#deploy").click(function () {
                    var acao = $(this).attr("value");
                    $.ajax({
                        url: "execShell.php", // pagina que irá aparecer
                        type: 'POST', // metodo de recebimento: GET ou POST
                        data: {fileOk: acao},
                        success: function (data) {
                            $("#conteudo").html(data);
                        },
                        error: function () { // se der erro mostrará uma mensagem
                            $("#conteudo").html("Erro ao executar os comandos");
                        },
                        beforeSend: function () { // antes de mostrar a requisição mostra uma mensagem
                            $("#conteudo").html("<center><img src='img/hourglass.gif' width='70'></center>");
                        }
                    });
                });
            });

        </script>
    {/literal}

    <div class="table-responsive table-bordered">
        <table class="table">

            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">1º Escolher Servidor</span></a></li>
                    <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                    <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">2º Escolher Sistema</span></a></li>
                    <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                    <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">3º Enviar arquivo</span></a></li>
                    <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                    <li class="active"><a >4º Inicar Deploy <span class="sr-only">(current)</span></a></li>
                </ul>
            </nav>

            {if !empty($file)}
                <th><center>Sistema</center></th>
                <th><center>Usuario</center></th>
                <th><center>Servidor</center></th>
                <th><center>Arquivo</center></th>
                <th><center>Ação</center></th>
                <tr class="text-center">
                    <td class="active">{$file->nome_sistema}</td>
                    <td class="active">{$file->nome_usuarios_servidor}</td>
                    <td class="active">{$file->nome_servidor}<br><small>(IP - {$file->ip_servidor})</small></td>
                    <td class="active">{$file->nome_file_deploy}</td>
                    <td class="active">
                        <a type="button" id="deploy" value='{$file->id_file_deploy}' title="O arquivo será enviado para o servidor {$file->ip_servidor} e depois será feito o deploy"  class="btn btn-success"> <span class="glyphicon glyphicon-share"></span> Iniciar Deploy</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-calendar"></span> Agendar</button>

                    </td>
                </tr>
            {else}
                <tr class="text-center"><td><h3>Nenhum arquivo enviado</h3></td></tr>
                        {/if}
        </table>
        <div id="load"></div>
        <br>
        <div class="alert alert-success" id="conteudo" role="alert"></div>
    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center>


<!-- MODAL -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agendamento</h4>
            </div>

            <div class="modal-body">
                <form method="post" action="agendarDeploy.php" name="agendarDeploy" id="agendarDeploy" class="form-horizontal" role="form">
                    <input type="hidden" id="idFile" name="idFile" value="{$file->id_file_deploy}">
                    <input type="hidden" id="idUserFileDeploy" name="idUserFileDeploy" value="{$file->id_usuario_file_deploy}">
                    <input type="hidden" id="idSistema" name="idSistema" value="{$file->id_sistema}">
                    <input type="hidden" id="idUserServidor" name="idUserServidor" value="{$file->id_usuarios_servidor}">
                    <input type="hidden" id="idServidor" name="idServidor" value="{$file->id_servidor}">

                    <label class="sr-only" for="inputTimeAgendar">Data time</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type="datetime-local" name="inputTimeAgendar" class="form-control" value="now" id="inputTimeAgendar" required="">
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success">Agendar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>

        </div>
    </div>
</div>
