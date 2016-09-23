<div class="panel panel-warning">
  <div class="panel-heading">
    <h2 class="panel-title">Escolha Sistema para Reiniciar Tomcat</h2>
  </div>

  {literal}
  <script type="text/javascript">

  function reloadTomcat(id) {
    var reload = confirm("Deseja realmente reiniciar o sistema ?");
    if (reload) {
      $(document).ready(function () {
        var acao = id;

        $.ajax({
          url: "execShellReload.php", // pagina que irá aparecer
          type: 'POST', // metodo de recebimento: GET ou POST
          data: { tomcatSistema: acao },
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
          <td class="active">{if !empty($u->link_acesso_sistema)}<a href="{$u->link_acesso_sistema}" target="_blank" title="Acesso ao sistema {$u->nome_sistema}">{$u->nome_sistema}</a> {else} {$u->nome_sistema} {/if}</td>
            <td class="active">{$u->path_sistema}</td>
            <td class="active">{$u->path_usuarios_servidor}</td>
            <td class="active">
              <a type="button" onclick="reloadTomcat({$u->id_sistema});" title="Ao cliar no botão será reiniciado o tomcat do sistema {$u->nome_sistema}" class="btn btn-danger btn-xs"> <span class="glyphicon glyphicon-refresh"></span> Reiniciar tomcat</a>
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
