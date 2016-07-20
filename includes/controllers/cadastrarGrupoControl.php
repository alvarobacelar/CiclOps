<?php

require_once '../models/ManipulateData.php';

/* * ******************************************************
 * ** CADASTRO GRUPO
 * ******************************************************* */
//CAPTANDO DADOS DO FORMULARIO
$nome = addslashes($_POST["inputGrupo"]);
$obsGrupo = addslashes($_POST["textObservacaoGrupo"]);
$emailGrupo = addslashes($_POST["inputEmailGrupo"]);
$data = date("Y-m-d");
$status = 1; // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();
if (!empty($nome)) {
    //INSTACIANDO O OBJETO DE CADASTRO
    $cad = new ManipulateData(); //INSTACIANDO A CLASSE
    $cad->setTable("grupo_servidor"); //SETANDO O NOME DA TABELA
    $cad->setCampoTable("nome_grupo_servidor");

    //VERIFICANDO SE EXISTE REGISTRO CADASTRADO
    if ($cad->getDadosDuplicados("$nome") >= 1) {
        $_SESSION["erroGrupo"] = "duplicado";
        header("Location: ../../cadastrarGrupo.php");
    } else {
        $cad->setCamposBanco("nome_grupo_servidor, descricao_grupo_servidor,status_grupo_servidor,data_cadastro_grupo_servidor,email_grupo_servidor"); //CAMPOS DO BANCO DE DADOS
        $cad->setDados("'$nome', '$obsGrupo', '$status', '$data','$emailGrupo'"); //DADOS DO FORMULARIOS
        $cad->insert(); //EFETUANDO CADASTRO
        $_SESSION["erroGrupo"] = "Cadastrado";
        header("location: ../../cadastrarGrupo.php");
    }
} else {
    $_SESSION["erroGrupo"] = "vazio";
    header("Location: ../../cadastrarGrupo.php");
}
