<?php

/*
 *  Arquivo de historico de deploys
 * @author Álvaro Bacelar
 * @date 14/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/classes/Pagination.php';

if ($estaLogado == "SIM") {

    if (isset($_SESSION["erroFile"])) {
        if ($_SESSION["erroFile"] == "exclui") {
            $smarty->assign("erroFile", "<div class='alert alert-success' role='alert'>Arquivo excluido com sucesso! </div>");
        } else if ($_SESSION["erroFile"] == "excluiAgendamento") {
            $smarty->assign("erroFile", "<div class='alert alert-success' role='alert'>Agendamento cancelado com sucesso! </div>");
        } else if ($_SESSION["erroFile"] == "naoAgenda") {
            $smarty->assign("erroFile", "<div class='alert alert-danger' role='alert'>Já existe um agendamento para esse arquivo. </div>");
        } else if ($_SESSION["erroFile"] == "agenda") {
            $smarty->assign("erroFile", "<div class='alert alert-success' role='alert'>Agendamento realizado com sucesso! </div>");
        } else {
            $smarty->assign("erroFile", "");
        }
    } else {
        $smarty->assign("erroFile");
    }
    unset($_SESSION["erroFile"]);


    // ########### Inicio da PAGINAÇÃO #############//
    $paginacao = new ManipulateData();
    $paginacao->setTable("file_deploy");
    if (isset($_GET["pg"])) { // se exitir uma variavel na URL é setado para a paginação
        $pg = $_GET["pg"];
    } else {
        $pg = 1;
    }
    $quantLog = 20; // Quantidade de chamado por pagina
    $inicio = ($pg * $quantLog) - $quantLog; // Definindo o inicio da paginação
    // ######### FIM DA PAGINAÇÃO ###########// 

    if ($nivel != "admin") {

        // realizando a busca no banco de dados de todos os deploys realizados com os usuários que executaram
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor,usuario");
        $buscaFile->setOrderTable("AND servidor.id_grupo_servidor = '$grupo' ORDER BY id_file_deploy DESC LIMIT $inicio, $quantLog");
        //$paginacao->setOrderTable(" WHERE servidor.id_grupo_servidor = '$grupo' ORDER BY id_file_deploy");
        $pagina = new Pagination($pg, $quantLog, $paginacao->countTotal());
        
        $buscaFile->selectFileDeployTodos();
        while ($filAr[] = $buscaFile->fetch_object()) {
            $smarty->assign("filH", $filAr);
        }
    } else {
        // realizando a busca no banco de dados de todos os deploys realizados com os usuários que executaram
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor,usuario");
        $buscaFile->setOrderTable(" ORDER BY id_file_deploy DESC LIMIT $inicio, $quantLog");        
        $pagina = new Pagination($pg, $quantLog, $paginacao->countTotal());
        $buscaFile->selectFileDeployTodos();
        while ($filAr[] = $buscaFile->fetch_object()) {
            $smarty->assign("filH", $filAr);
        }
    }

    $smarty->assign("paginacao", $pagina->paginacao());
    $smarty->assign("conteudo", "paginas/historicoDeploy.tpl");
    $smarty->display("HTML.tpl");
}
