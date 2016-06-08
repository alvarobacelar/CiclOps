<?php

require_once '../models/ManipulateData.php';

/* * ******************************************************
 * ** CADASTRO
 * ******************************************************* */
//CAPTANDO DADOS DO FORMULARIO
$nome = addslashes($_POST["inputNome"]);
$login = addslashes($_POST["inputLogin"]);
$nivel = addslashes($_POST["selectNivel"]);
$senha = addslashes($_POST["inputSenha"]);
$senha2 = addslashes($_POST["inputSenha2"]);
$funcao = addslashes($_POST["inputFuncao"]);
$idGrupo = addslashes($_POST["selectGrupo"]);
$obsUser = addslashes($_POST["textObsUser"]);
$data = date("Y-m-d");
$status = 1; // status igual a 1 significa que o usuário está ativo, quando é igual a 0 desativo. 

session_start();
//if ($_SESSION["nivel"] == "admin") {

if ($senha == $senha2) {

    // SE NÃO FOR PASSADO NOME E LOGIN NÃO SERÁ FEITO O CADASTRO.
    if (!empty($nome) && !empty($login)) {

        $senhaCript = md5($senha);
        //INSTACIANDO O OBJETO DE CADASTRO
        $cad = new ManipulateData(); //INSTACIANDO A CLASSE
        $cad->setTable("usuario"); //SETANDO O NOME DA TABELA
        $cad->setCampoTable("login_usuario");

        //VERIFICANDO SE EXISTE REGISTRO CADASTRADO
        if ($cad->getDadosDuplicados("$login") >= 1) {
            $_SESSION["erro"] = "duplicado";
            header("Location: ../../cadastrarUsuario.php");
        } else {
            $cad->setCamposBanco("id_grupo_servidor,nome_usuario,login_usuario,senha_usuario,status_usuario,data_cadastro_usuario,obs_usuario,nivel_usuario,funcao_usuario"); //CAMPOS DO BANCO DE DADOS
            $cad->setDados("'$idGrupo','$nome', '$login', '$senhaCript', '$status', '$data', '$obsUser', '$nivel', '$funcao'"); //DADOS DO FORMULARIOS
            $cad->insert(); //EFETUANDO CADASTRO
            $_SESSION["erro"] = $cad->getStatus();
            header("location: ../../cadastrarUsuario.php");
        }
    } else {
        $_SESSION["erro"] = "vazio";
        header("location: ../../cadastrarUsuario.php");
    }
} else {
    $_SESSION["erro"] = "ERRO";
    header("location: ../../cadastrarUsuario.php");
}
//} else {
//    header("location: ../../accessDenied.php");
//}