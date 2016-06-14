<?php

/*
 *  Arquivo de deploy
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM") {

    if ($nivel == "admin" || $nivel == "dev") {

        if (isset($_GET["idFile"])) { //  SE NÃO HOUVER ID PASSADO NA URL REDIRECIONA PARA O INICIO DO PROCESSO DE DEPLOY
            $idFile = addslashes($_GET["idFile"]);

            $buscaFile = new ManipulateData();
            $buscaFile->setTable("file_deploy");
            $buscaFile->setFieldId("id_file_deploy");
            $buscaFile->setValueId("$idFile");
            $buscaFile->selectAlterar();
            $filAr = $buscaFile->fetch_object();
            $smarty_ > assign("file", $filAr);

            $smarty->assign("conteudo", "paginas/iniciarDeploy.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: realizarDeploy.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}

