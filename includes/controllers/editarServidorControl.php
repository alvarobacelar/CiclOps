<?php

require_once '../models/ManipulateData.php';

session_start();

//CAPTANDO DADOS DO FORMULARIO
$idServidor = addslashes($_POST["hiddenIdServidor"]);
$servidor = addslashes($_POST["inputServidor"]);
$ipServidor = addslashes($_POST["inputIP"]);
$idGrupo = addslashes($_POST["selectGrupo"]);
$obsServidor = addslashes($_POST["textObsServer"]);
$data = date("Y-m-d");
$status = addslashes($_POST["radioStatus"]); // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO);

if ($_SESSION["nivel"] == "admin") {

    if (isset($idServidor) || !empty($idServidor)) {

        $editaServidor = new ManipulateData();
        $editaServidor->setTable("servidor");
        $editaServidor->setCamposBanco("id_grupo_servidor='$idGrupo',nome_servidor='$servidor',ip_servidor='$ipServidor',obs_servidor='$obsServidor',status_servidor='$status'");
        $editaServidor->setFieldId("id_servidor");
        $editaServidor->setValueId("$idServidor");
        $editaServidor->update();

        $_SESSION["erroServidor"] = "editado";
        header("location: ../../servidoresCadastrados.php");
    } else {
        $_SESSION["erroServidor"] = "erroEditar";
        header("location: ../../servidoresCadastrados.php");
    }
} else {
    header("location: ../../accessDenied.php");
}