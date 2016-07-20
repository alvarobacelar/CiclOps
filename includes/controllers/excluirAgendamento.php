<?php

require_once '../models/ManipulateData.php';

define('PATH_ARQUIVOS', str_replace("\\", "/", getcwd()) . '/arquivos/'); // CRIANDO UMA VARIÁVEL PARA O ARQUIVO LOCAL

session_start();
if ($_SESSION["nivel"] == "admin" || $_SESSION["nivel"] == "dev") {

    if (isset($_GET["id"])) { // SE EXITIR A VARIÁVEL EXECUTA OS COMANDOS ABAIXO
        $idExcluir = addslashes($_GET["id"]);

        // CRIANDO O OBJETO PARA EXCLUSÃO DO ARQUIVO (TANTO DO SERVIDOR LOCAL QUANTO NO BANCO DE DADOS)
        $del = new ManipulateData();
        $del->setTable("agendamento");
        $del->setCampoTable("id_file_deploy");
        $del->setValueId("$idExcluir");
        // EXCLUINDO DADO DO BANCO
        $del->delete();

        $altFile = new ManipulateData();
        $altFile->setTable("file_deploy");
        $altFile->setCamposBanco("status_file_deploy='2'"); // quando o status_reverter_deploy for igual a 3 significa que existe um agendamento
        $altFile->setFieldId("id_file_deploy");
        $altFile->setValueId("$idExcluir");
        $altFile->update();

        $_SESSION["erroFile"] = "excluiAgendamento";
        header("Location: ../../historicoDeploy.php");
    } else {
        header("location: ../../erro.php");
    }
} else {
    header("location: ../../accessDenied.php");
}