<?php

require_once '../models/ManipulateData.php';

/* *********************************************************
 * ** CADASTRO SISTEMA 
 * *********************************************************/
//CAPTANDO DADOS DO FORMULARIO
$nomeSistema = addslashes($_POST["inputNomeSistema"]);
$pathUser = addslashes($_POST["inputPathSistema"]);
$servidor = addslashes($_POST["selectServidor"]);
$linkMonitor = addslashes($_POST["inputMonitorSistema"]);
$userServidor = addslashes($_POST["selectUserServidor"]);
$pathHome = addslashes($_POST["inputPathHome"]);
$data = date("Y-m-d");
$status = 1; // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();
if (!empty($nomeSistema) && !empty($pathUser) && !empty($servidor) && !empty($userServidor)) {
    //INSTACIANDO O OBJETO DE CADASTRO
    $cad = new ManipulateData(); //INSTACIANDO A CLASSE
    $cad->setTable("sistema"); //SETANDO O NOME DA TABELA
    //$cad->setCampoTable("nome_grupo_servidor");

    //VERIFICANDO SE EXISTE REGISTRO CADASTRADO
    if ($cad->getDadosDuplicadosUserSistema("$nomeSistema") >= 1) {
        $_SESSION["erroSistema"] = "duplicado";
        header("Location: ../../cadastrarSistema.php");
    } else {
        $cad->setCamposBanco("id_usuarios_servidor,id_servidor,nome_sistema,path_sistema,data_cadastro_sistema,status_sistema, link_monitoramento,path_home_sistema"); //CAMPOS DO BANCO DE DADOS
        $cad->setDados("'$userServidor','$servidor','$nomeSistema','$pathUser','$data','$status', '$linkMonitor','$pathHome'"); //DADOS DO FORMULARIOS
        $cad->insert(); //EFETUANDO CADASTRO
        $_SESSION["erroSistema"] = "Cadastrado";
        header("location: ../../cadastrarSistema.php");
    }
} else {
    $_SESSION["erroSistema"] = "vazio";
    header("Location: ../../cadastrarSistema.php");
}
