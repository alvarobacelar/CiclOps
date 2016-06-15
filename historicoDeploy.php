<?php

/*
 *  Arquivo de historico de deploys
 * @author Álvaro Bacelar
 * @date 14/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {

    // realizando a busca no banco de dados de todos os deploys realizados com os usuários que executaram
    $buscaFile = new ManipulateData();
    $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor,usuario");
    $buscaFile->setOrderTable("AND status_file_deploy = '0'");
    $buscaFile->selectFileDeployTodos();
    while ($filAr[] = $buscaFile->fetch_object()){
        $smarty->assign("filH",$filAr);
    }
    
    $smarty->assign("conteudo", "paginas/historicoDeploy.tpl");
    $smarty->display("HTML.tpl");
    
}
