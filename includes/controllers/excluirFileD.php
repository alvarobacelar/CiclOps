<?php

/*
 * Arquivo para exclusão do file deploy
 * @author Álvaro Bacelar
 * @date 16/06/2016
 */

require_once '../models/ManipulateData.php';
require_once '../funcoes/exeCmdShel.php';
define('PATH_ARQUIVOS', str_replace("\\", "/", getcwd()) . '/arquivos/'); // CRIANDO UMA VARIÁVEL PARA O ARQUIVO LOCAL

session_start();
if ($_SESSION["nivel"] == "admin" || $_SESSION["nivel"] == "dev") {

    if (isset($_GET["id"])) { // SE EXITIR A VARIÁVEL EXECUTA OS COMANDOS ABAIXO

        $idExcluir = addslashes($_GET["id"]);

        // CRIANDO O OBJETO PARA EXCLUSÃO DO ARQUIVO (TANTO DO SERVIDOR LOCAL QUANTO NO BANCO DE DADOS)
        $del = new ManipulateData();
        $del->setTable("file_deploy");
        $del->setCampoTable("id_file_deploy");
        $del->setFieldId("id_file_deploy");
        $del->setValueId("$idExcluir");
        // SELECIONANDO PRIMEIRO O ARQUIVO PARA EXCLUIR LOCALMENTE
        $del->selectAlterar();
        $rmF = $del->fetch_object();
        //SETANDO O COMANDO PARA EXCLUSÃO DO ARQUIVO
        $rmFile = "rm -rf " . PATH_ARQUIVOS . $rmF->nome_file_deploy;
        
        // EXECUTANDO O COMANDO PARA EXCLUIR ARQUIVO DO SERVIDOR LOCAL
        myshellexec($rmFile);
        // EXCLUINDO DADO DO BANCO
        $del->delete();
        
        $_SESSION["erroFile"] = "exclui";
        header("Location: ../../historicoDeploy.php");
    } else {
        header("location: ../../erro.php");
    }
} else {
    header("location: ../../accessDenied.php");
}