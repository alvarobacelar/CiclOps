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
    
    if (isset($_SESSION["erroFile"])){
        if ($_SESSION["erroFile"] == "exclui" ){
            $smarty->assign("erroFile", "<div class='alert alert-success' role='alert'>Arquivo excluido com sucesso! </div>");
        } else {
            $smarty->assign("erroFile", "<div class='alert alert-danger' role='alert'>Erro ao excluir arquivo</div>");
        }
    } else {
        $smarty->assign("erroFile");
    }
    unset($_SESSION["erroFile"]);

    // realizando a busca no banco de dados de todos os deploys realizados com os usuários que executaram
    $buscaFile = new ManipulateData();
    $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor,usuario");
    $buscaFile->setOrderTable(" ORDER BY id_file_deploy DESC");
    $buscaFile->selectFileDeployTodos();
    while ($filAr[] = $buscaFile->fetch_object()){
        $smarty->assign("filH",$filAr);
    }
    
    $smarty->assign("conteudo", "paginas/historicoDeploy.tpl");
    $smarty->display("HTML.tpl");
    
}
