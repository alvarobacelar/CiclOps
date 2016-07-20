<?php

require_once '../models/ManipulateData.php';

//CAPTANDO DADOS DO FORMULARIO
$idGrupo = addslashes($_POST["hiddenIdGrupo"]);
$nome = addslashes($_POST["inputGrupo"]);
$obsGrupo = addslashes($_POST["textObservacaoGrupo"]);
$emailGrupo = addslashes($_POST["inputEmailGrupo"]);
$status = 1; // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();

if ($_SESSION["nivel"] == "admin") {

    if (!empty($nome)) {
        
        $altGrupo = new ManipulateData();
        $altGrupo->setTable("grupo_servidor");
        $altGrupo->setCamposBanco("nome_grupo_servidor='$nome',descricao_grupo_servidor='$obsGrupo',email_grupo_servidor='$emailGrupo'");
        $altGrupo->setFieldId("id_grupo_servidor");
        $altGrupo->setValueId("$idGrupo");
        $altGrupo->update();

        $_SESSION["erroGrupo"] = "editado";
        header("Location: ../../gruposCadastrados.php");
    } else {
        $_SESSION["erroGrupo"] = "vazio";
        header("Location: ../../gruposCadastrados.php");
    }
} else {
    header("Location: ../../accessDenied.php");
}

