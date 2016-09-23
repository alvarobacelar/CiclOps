<div class="panel panel-primary">

  <div class="panel-heading">

    <h2 class="panel-title">Cadastrar Sistema</h2>
  </div>
  <div class="panel-body">

    {$erroCadastro}
    <form action="includes/controllers/cadastrarSistemaControl.php" method="post" name="cadastrar" class="form-horizontal" role="form" onSubmit="return verificaSenha()">
      <div class="form-group">
        <label class="col-sm-3 control-label" for="inputNomeSistema">Nome do sistema</label>
        <div class="col-sm-4">
          <input class="form-control" type="text" id="inputNomeSistema" name="inputNomeSistema" required="" placeholder="EX: COOPANEST-CE Produção">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputPathHome">Path home</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" id="inputPathHome" name="inputPathHome" required="" placeholder="EX: /home/dolphin">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputPathSistema">Path sistema</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" id="inputPathSistema" name="inputPathSistema" required="" placeholder="EX: /mnt/app">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputDatasourceSistema">Datasource do banco</label>
        <div class="col-sm-2">
          <input class="form-control" type="text" id="inputDatasourceSistema" name="inputDatasourceSistema" required="" placeholder="EX: uniplam3">
        </div>
      </div>

      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputPathSistema">Link de acesso</label>
        <div class="col-sm-6">
          <input class="form-control" type="text" id="inputLinkSistema" name="inputLinkSistema" required="" placeholder="EX: http://homologacao.infoway-pi.com.br">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="inputMonitorSistema">Link Monitoramento</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" id="inputMonitorSistema" name="inputMonitorSistema" placeholder="EX: http://monitoramento.infoway-pi.com.br/dashboard/snapshot/bPmOOCms6cZt8sQZJ3RBV32c3zvKPEID">
        </div>
      </div>
      <div class="row form-group">
        <label class="col-sm-3 control-label" for="linkLog">Link Log Zabbix</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" id="linkLog" name="linkLog" placeholder="Link de log tomcat do zabbix">
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
            <option value="" selected="">Selecione o tipo de startup</option>
            <option value="script">Via script</option>
            <option value="servico">Via serviço</option>
          </select>
        </div>
        <div class="col-sm-2" id="inputOculto">
          <input class="form-control" type="text" id="inputServico" name="inputServico"  placeholder="EX: tomcat">
        </div>
      </div>
      <div class="form-group ">
        <label class="col-sm-3 control-label" for="selectServidor">Servidor do sistema</label>
        <div class="col-sm-3">
          <select class="form-control" id="selectServidor" name="selectServidor" required="">
            <option value="" selected="">Escolha o servidor</option>
            {foreach $serv as $g}
            <option value="{$g->id_servidor}">{$g->nome_servidor} ({$g->ip_servidor})</option>
            {/foreach}
          </select>
        </div>
      </div>
      <div class="form-group ">
        <label class="col-sm-3 control-label" for="selectUserServidor">Usuário do servidor</label>
        <div class="col-sm-3">
          <select class="form-control" id="selectUserServidor" name="selectUserServidor" required="">
            <option value="" selected="">Escolha o usuário do servidor</option>
            {foreach $usr as $g}
            <option value="{$g->id_usuarios_servidor}">{$g->nome_usuarios_servidor} ({$g->id_usuarios_servidor})</option>
            {/foreach}
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar</button>
        </div>
      </div>
    </form>
    <br />

  </div>
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center>
