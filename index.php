<?php

require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

//displaysecinfo ("Listagem diretório", myshellexec( "cat /etc/passwd" ));

if ($estaLogado == "SIM") {

    $dataHoje = date("Y-m-d");
    $contaDeploy = new ManipulateData();
    $contaDeploy->setTable("file_deploy");
    $contaDeploy->setOrderTable("WHERE data_file_deploy = '$dataHoje'");
    $contagem = $contaDeploy->countTotal();
    $smarty->assign("cont", $contagem);
    
    $contaUserDepl = new ManipulateData();
    $contaUserDepl->setCamposBanco("$dataHoje");
    $contaUserDepl->countTotalDepl();
    while ($depUser[] = $contaUserDepl->fetch_object()){
        $smarty->assign("usrDep", $depUser);
    }
    
    $smarty->assign("conteudo", "paginas/home.tpl");
    $smarty->display("HTML.tpl");
}