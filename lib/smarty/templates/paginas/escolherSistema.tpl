<div class="panel panel-primary">
  <div class="panel-heading">
    <h2 class="panel-title">Escolha Sistema para Deploy</h2>
  </div>

  <div class="table-responsive table-bordered">
    <table class="table">

      <nav class="text-center">
        <ul class="pagination">
          <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">1º Escolher Servidor</span></a></li>
          <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
          <li class="active"><a >2º Escolher Sistema <span class="sr-only">(current)</span></a></li>
          <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
          <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">3º Enviar arquivo</span></a></li>
          <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
          <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">4º Iniciar Deploy</span></a></li>
        </ul>
      </nav>
            
      {if isset($sistemaDeploy)}
      <th><center>Sistema</center></th>
      <th><center>Datasource</center></th>
      <th><center>path sistema</center></th>
      <th><center>Opção</center></th>
      {foreach $sistemaDeploy as $u}
      <tr class="text-center">
        <td class="active">{if !empty($u->link_acesso_sistema)}<a href="{$u->link_acesso_sistema}" target="_blank" title="Acesso ao sistema {$u->nome_sistema}">{$u->nome_sistema}</a> {else} {$u->nome_sistema} {/if}</td>
        <td class="active">{$u->datasource}</td>
        <td class="active">{$u->path_sistema}</td>
        <td class="active">
          <a href="enviarArquivoServidor.php?servidor={$u->id_servidor}&sistema={$u->id_sistema}" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-search"></span> Escolher sistema</a>
        </td>
      </tr>
      {/foreach}
      {else}
      <tr class="text-center"><td><h3>Nenhum sistema cadastrado nesse servidor</h3></td></tr>
      {/if}
    </table>
  </div>
  <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center>
