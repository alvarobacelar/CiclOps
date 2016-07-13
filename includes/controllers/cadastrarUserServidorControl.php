<?php

require_once '../models/ManipulateData.php';

/* * ******************************************************
 * ** CADASTRO USUARIO SERVIDOR  
 * ******************************************************* */
//CAPTANDO DADOS DO FORMULARIO
$nomeUser = addslashes($_POST["inputNomeUser"]);
$pathTomcat = addslashes($_POST["inputPathTomcat"]);
$servidorUser = addslashes($_POST["selectServidor"]);
$senhaUsuarioServ = addslashes($_POST["inputSenhaUser"]);
$data = date("Y-m-d");
$status = 1; // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();
if (!empty($nomeUser) && !empty($pathTomcat) && !empty($servidorUser)) {
    //INSTACIANDO O OBJETO DE CADASTRO
    $cad = new ManipulateData(); //INSTACIANDO A CLASSE
    $cad->setTable("usuarios_servidor"); //SETANDO O NOME DA TABELA
    //$cad->setCampoTable("nome_grupo_servidor");

    //VERIFICANDO SE EXISTE REGISTRO CADASTRADO
    if ($cad->getDadosDuplicadosUserServer("$nomeUser","$servidorUser") >= 1) {
        $_SESSION["erroUser"] = "duplicado";
        header("Location: ../../cadastrarUserServidor.php");
    } else {
        $cad->setCamposBanco("id_servidor,nome_usuarios_servidor,path_usuarios_servidor,data_usuarios_servidor,status_usuario_servidor,senha_usuario_servidor"); //CAMPOS DO BANCO DE DADOS
        $cad->setDados("'$servidorUser','$nomeUser', '$pathTomcat', '$data', '$status','$senhaUsuarioServ'"); //DADOS DO FORMULARIOS
        $cad->insert(); //EFETUANDO CADASTRO
        $_SESSION["erroUser"] = "Cadastrado";
        header("location: ../../cadastrarUserServidor.php");
    }
} else {
    $_SESSION["erroUser"] = "vazio";
    header("Location: ../../cadastrarUserServidor.php");
}
