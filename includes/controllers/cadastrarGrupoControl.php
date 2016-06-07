<?php


require_once '../models/ManipulateData.php';

/* * ******************************************************
 * ** CADASTRO GRUPO
 * ******************************************************* */
//CAPTANDO DADOS DO FORMULARIO
$nome = addslashes($_POST["inputGrupo"]);
$obsGrupo = addslashes($_POST["textObservacaoGrupo"]);
$data = date("Y-m-d") . " " . date("H:i:s");
$status = 1; // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();
//if ($_SESSION["nivel"] == "admin") {

        //INSTACIANDO O OBJETO DE CADASTRO
        $cad = new ManipulateData(); //INSTACIANDO A CLASSE
        $cad->setTable("grupo_servidor"); //SETANDO O NOME DA TABELA
        $cad->setCampoTable("nome_grupo_servidor");
        
        //VERIFICANDO SE EXISTE REGISTRO CADASTRADO
        if ($cad->getDadosDuplicados("$nome") >= 1) {
            $_SESSION["erroGrupo"] = "duplicado";
            header("Location: ../../cadastrarGrupo.php");
        } else {
            $cad->setCamposBanco("nome_grupo_servidor, descricao_grupo_servidor,status_grupo_servidor,data_cadastro_grupo_servidor"); //CAMPOS DO BANCO DE DADOS
            $cad->setDados("'$nome', '$obsGrupo', '$status', '$data'"); //DADOS DO FORMULARIOS
            $cad->insert(); //EFETUANDO CADASTRO
            $_SESSION["erroGrupo"] = $cad->getStatus();
            header("location: ../../cadastrarGrupo.php");
        }
//} else {
//    header("location: ../../accessDenied.php");
//}
