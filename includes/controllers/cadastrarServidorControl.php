<?php

require_once '../models/ManipulateData.php';

/* * ******************************************************
 * ** CADASTRO DE SERVIDOR
 * ******************************************************* */
//CAPTANDO DADOS DO FORMULARIO
$servidor = addslashes($_POST["inputServidor"]);
$ipServidor = addslashes($_POST["inputIP"]);
$idGrupo = addslashes($_POST["selectGrupo"]);
$obsServidor = addslashes($_POST["textObsServer"]);
$data = date("Y-m-d");
$status = 1; // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();
if ($_SESSION["nivel"] == "admin") {
    if (!empty($servidor) && !empty($ipServidor) && !empty($idGrupo)) {
        //INSTACIANDO O OBJETO DE CADASTRO
        $cad = new ManipulateData(); //INSTACIANDO A CLASSE
        $cad->setTable("servidor"); //SETANDO O NOME DA TABELA
        $cad->setCampoTable("nome_servidor");

        //VERIFICANDO SE EXISTE REGISTRO CADASTRADO
        if ($cad->getDadosDuplicados("$servidor") >= 1) {
            $_SESSION["erroServidor"] = "duplicado";
            header("Location: ../../cadastrarServidor.php");
        } else if ($cad->getDadosDuplicados2("ip_servidor","$ipServidor") >= 1) {
            $_SESSION["erroServidor"] = "duplicadoIP";
            header("Location: ../../cadastrarServidor.php");
        } else {
            $cad->setCamposBanco("id_grupo_servidor, nome_servidor, ip_servidor,obs_servidor,data_cadastro_servidor,status_servidor"); //CAMPOS DO BANCO DE DADOS
            $cad->setDados("'$idGrupo', '$servidor','$ipServidor','$obsServidor','$data','$status'"); //DADOS DO FORMULARIOS
            $cad->insert(); //EFETUANDO CADASTRO
            $_SESSION["erroServidor"] = "Cadastrado";
            header("location: ../../cadastrarServidor.php");
        }
    } else {
        $_SESSION["erroServidor"] = "vazio";
        header("Location: ../../cadastrarServidor.php");
    }
} else {
    header("Location: ../../accessDenied.php");
}