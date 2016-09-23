<div class="panel panel-primary">

  <div class="panel-heading">

    <h2 class="panel-title">Editar Sistema</h2>
  </div>
  <div class="panel-body">

    <form action="includes/controllers/editarSistemaControl.php" method="post" name="cadastrar" class="form-horizontal" role="form" >
      <input type="hidden" id="hiddenIdSistema" name="hiddenIdSistema" value="{$si->id_sistema}">
      <div class="form-group">
        <label class="col-sm-3 control-label" for="inputNomeSistema">Nome do sistema</label>
        <div class="col-sm-4">
          <input class="form-control" type="text" id="inputNomeSistema" name="inputNomeSistema" value="{$si->nome_sistema}" required="" placeholder="EX: COOPANEST-CE Produção">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputPathHome">Path home</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" id="inputPathHome" name="inputPathHome" value="{$si->path_home_sistema}" required="" placeholder="EX: /home/dolphin">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputPathSistema">Path sistema</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" id="inputPathSistema" name="inputPathSistema" value="{$si->path_sistema}" required="" placeholder="EX: /mnt/app">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputDatasourceSistema">Datasource do banco</label>
        <div class="col-sm-2">
          <input class="form-control" type="text" id="inputDatasourceSistema" name="inputDatasourceSistema" value="{$si->datasource}" required="" placeholder="EX: uniplam3">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputPathSistema">Link de acesso</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" id="inputLinkSistema" name="inputLinkSistema" value="{$si->link_acesso_sistema}" required="" placeholder="EX: http://homologacao.infoway-pi.com.br">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputMonitorSistema">Link Monitoramento</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" id="inputMonitorSistema" name="inputMonitorSistema" value="{$si->link_monitoramento}" placeholder="EX: http://monitoramento.infoway-pi.com.br/dashboard/snapshot/bPmOOCms6cZt8sQZJ3RBV32c3zvKPEID">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="linkLog">Link Log Zabbix</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" id="linkLog" name="linkLog" value="{$si->link_log}" placeholder="Link de log tomcat do zabbix">
        </div>
      </div>
      {literal}
      <script>
      $(document).ready(function() {
        $('#inputOculto').hide();
        $('#selectStartup').change(function() {
          if ($('#selectStartup').val() == 'servico') {
            $('#inputOculto').show();
            } else {
              $('#inputOculto').hide();
            }
          });
        });
        </script>
        {/literal}

        <div class="form-group ">
          <label class="col-sm-3 control-label" for="selectServidor">Inicialização do sistema</label>
          <div class="col-sm-3">
            <select class="form-control" id="selectStartup" name="selectStartup" required="">
              <option value="{$si->startup}" selected="">{$si->startup}</option>
              <option value="script">Via script</option>
              <option value="servico">Via serviço</option>
            </select>
          </div>
          <div class="col-sm-2" id="inputOculto">
            <input class="form-control" type="text" id="inputServico" value="{$si->nome_servico}" name="inputServico" placeholder="EX: tomcat">
          </div>
        </div>
        <div class="form-group ">
          <label class="col-sm-3 control-label" for="selectServidor">Servidor do sistema</label>
          <div class="col-sm-3">
            <select class="form-control" id="selectServidor" name="selectServidor" required="">
              <option value="{$si->id_usuarios_servidor}" selected="">{$resServ->nome_servidor}</option>
              {foreach $servidorR as $s}
              <option value="{$s->id_servidor}">{$s->nome_servidor} ({$s->ip_servidor}</option>
              {/foreach}
            </select>
          </div>
        </div>
        <div class="form-group ">
          <label class="col-sm-3 control-label" for="selectUserServidor">Usuário do servidor</label>
          <div class="col-sm-3">
            <select class="form-control" id="selectUserServidor" name="selectUserServidor" required="">
              <option value="{$si->id_servidor}" selected="">{$resUser->nome_usuarios_servidor}</option>
              {foreach $servidorR as $g}
              <option value="{$g->id_usuarios_servidor}">{$g->nome_usuarios_servidor} ({$g->id_usuarios_servidor})</option>
              {/foreach}
            </select>
          </div>
        </div>

        <div class="form-group ">
          <label class="col-sm-3 control-label" for="radioStatus">Status do sistema</label>
          <div class="col-sm-3">
            <div class="radio">
              <label>
                <input type="radio" name="radioStatus" id="radioStatus" value="1" {if $si->status_sistema == "1"} checked {/if}>
                Ativo
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="radioStatus" id="radioStatus" value="0" {if $si->status_sistema != "1"} checked {/if}>
                Desativado
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-10">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</button>
          </div>
        </div>
      </form>
      <br />

    </div>
  </div>
  <center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center>
