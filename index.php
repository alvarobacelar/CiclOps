<?php

require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

//displaysecinfo ("Listagem diretório", myshellexec( "cat /etc/passwd" ));

if ($estaLogado == "SIM") {

  $dataHoje = date("Y-m-d");
  $contaDeploy = new ManipulateData();
  $contaDeploy->setTable("file_deploy");
  $contaDeploy->setOrderTable("WHERE data_file_deploy = '$dataHoje' AND status_file_deploy = '0'");
  $contagem = $contaDeploy->countTotal();
  $smarty->assign("cont", $contagem);

  $contaUserDepl = new ManipulateData();
  $contaUserDepl->setCamposBanco("$dataHoje");
  $contaUserDepl->countTotalDepl();
  while ($depUser[] = $contaUserDepl->fetch_object()){
    $smarty->assign("usrDep", $depUser);
  }

  $buscaSistema = new ManipulateData();
  if ($nivel == "admin"){
    $buscaSistema->selectSistema();
  } else {
    $buscaSistema->selectSistemaIndex("AND servidor.id_grupo_servidor = $grupo");
  }
  while ($resultadoSistema[] = $buscaSistema->fetch_object()) {
    $smarty->assign("sistemaDeploy", $resultadoSistema);
  }

  $smarty->assign("conteudo", "paginas/home.tpl");
  $smarty->display("HTML.tpl");
}
