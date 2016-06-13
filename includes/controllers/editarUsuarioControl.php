<?php

require_once '../models/ManipulateData.php';

//CAPTANDO DADOS DO FORMULARIO
$id = addslashes($_POST["hiddenIdUsuario"]);
$nome = addslashes($_POST["inputNome"]);
$login = addslashes($_POST["inputLogin"]);
$nivel = addslashes($_POST["selectNivel"]);
$senha = addslashes($_POST["inputSenha"]);
$senha2 = addslashes($_POST["inputSenha2"]);
$funcao = addslashes($_POST["inputFuncao"]);
$idGrupo = addslashes($_POST["selectGrupo"]);
$obsUser = addslashes($_POST["textObsUser"]);
$status = addslashes($_POST["radioStatus"]); // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO);
session_start();

//INSTACIANDO O OBJETO DE ALTERACAO
$alt = new ManipulateData();  //INSTACIANDO A CLASSE
$alt->setTable("usuario");  //SETANDO O NOME DA TABELA

if ($_SESSION["nivel"] == "admin") {

    if (!empty($senha)) {
        if ($senha == $senha2) {
            $senhaCript = md5($senha);

            //SETANDO OS CAMPOS PARA O BANCO DE DADOS
            $alt->setCamposBanco("id_grupo_servidor='$idGrupo',nome_usuario='$nome',login_usuario='$login',senha_usuario='$senhaCript',status_usuario='$status',obs_usuario='$obsUser',nivel_usuario='$nivel',funcao_usuario='$funcao'");
            $alt->setFieldId("id_usuario"); //ENVIANDO O CAMPO REFERENTE AO CODIGO PADRAO DE PESQUISA
            $alt->setValueId("$id"); //ENVIANDO O VALOR DO CAMPO DE PESQUISA
            $alt->update(); //EFETUANDO A ALTERAÇÃO
        } else {
            $_SESSION["alterar"] = "erroSenha";
            header("location: ../../editarUsuario.php?=" . $id);
        }
    } else {
        //INSTACIANDO O OBJETO DE ALTERACAO
        //SETANDO OS CAMPOS PARA O BANCO DE DADOS
        $alt->setCamposBanco("id_grupo_servidor='$idGrupo',nome_usuario='$nome',login_usuario='$login',status_usuario='$status',obs_usuario='$obsUser',nivel_usuario='$nivel',funcao_usuario='$funcao'");
        $alt->setFieldId("id_usuario"); //ENVIANDO O CAMPO REFERENTE AO CODIGO PADRAO DE PESQUISA
        $alt->setValueId("$id"); //ENVIANDO O VALOR DO CAMPO DE PESQUISA
        $alt->update(); //EFETUANDO A ALTERAÇÃO
    }

    $_SESSION["alterar"] = "OK";
    header("Location: ../../usuariosCadastrados.php");
} else {
    header("location: ../../accessDenied.php");
}