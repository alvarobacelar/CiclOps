
<h2 class="text-center"><strong>Ciclo de Operações Infoway</strong></h2>
<div class="row">
  <div class="col-md-pull-9">

    <div class="col-md-pull-9">
      <div class="alert alert-success" role="alert">
        <center>
          <p>
            Deploy's realizado em <strong>{$smarty.now|date_format:"%d/%m/%Y"} <span class="label label-default">{$cont}</span></strong><br><small>Contagem por usuário</small>
          </p>
        </center>
      </div>
    </div>

    {if isset($usrDep)}

    {foreach $usrDep as $d}
    <div class="col-md-6">
      <div class="alert alert-warning alert-dismissible" role="alert">
        <span style='font-size: 13px;'> Deploy realizado por <strong>{$d->nome_usuario} </strong></span> <span class="label label-default">{$d->total}</span>
      </div>
    </div>
    {/foreach}

    {else}
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-warning" role="alert">
        <center>Nenhum deploy realizado no dia de hoje</center>
      </div>
    </div>
    {/if}


    <small>
      <div class="text-info" style=" float: right;">

      </div>
    </small>
    {*<h4><small>{if $nivel =="admin" || $nivel == "gerente"}P.S. Foi adicionada funções de exclusão automatica de informação. A mensagem será excluida automaticamente ao corrigir a alteração informada. {else}P.S. Agora ao gerar declaração, os dados, devidamente cadastrados do usuário, será automaticamente preenchido pelo sistema. Caso não vigore, saia e entre no  sistema novamente.{/if} Att. Sgt Álvaro</small></h4>*}
    <div class="clear"></div>

  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title"><strong>Lista de sistemas cadastrados do time</strong></h2>
    </div>

    <div class="table-responsive table-bordered">
      <table class="table">

          {if isset($sistemaDeploy)}
          <th>Sistema</th>
          <th class="text-left">datasource</th>
          <th class="text-right">path sistema</th>
          <th class="text-right">Log tomcat</th>

          {foreach $sistemaDeploy as $u}
          <tr class="text-center">
            <td class="active text-left">{if !empty($u->link_acesso_sistema)}<a href="{$u->link_acesso_sistema}" target="_blank" title="Acesso ao sistema {$u->nome_sistema}">{$u->nome_sistema}</a> {else} {$u->nome_sistema} {/if}</td>
            <td class="active text-left">{$u->datasource}</td>
            <td class="active text-right">{$u->path_sistema}</td>
            <td class="active text-right">{if !empty($u->link_log)}<a href="{$u->link_log}" title="ver log do sistema {$u->nome_sistema}" target="_blank">{$u->path_usuarios_servidor}/logs/catalina.out</a>{else} {$u->path_usuarios_servidor}/logs/catalina.out {/if}</td>
          </tr>
          {/foreach}
          {else}
          <tr class="text-center"><td><h3>Nenhum sistema cadastrado </h3></td></tr>
          {/if}
        </table>

      </div>
    </div>

  </div>
