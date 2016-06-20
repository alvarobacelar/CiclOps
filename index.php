<?php

require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

//displaysecinfo ("Listagem diretório", myshellexec( "cat /etc/passwd" ));

if ($estaLogado == "SIM") {

    
    $smarty->assign("conteudo", "paginas/home.tpl");
    $smarty->display("HTML.tpl");
}