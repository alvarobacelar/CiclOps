<?php

require_once '../models/ManipulateData.php';

session_start();

//CAPTANDO DADOS DO FORMULARIO
$idSistema = addslashes($_POST["hiddenIdSistema"]);
$nomeSistema = addslashes($_POST["inputNomeSistema"]);
$pathUser = addslashes($_POST["inputPathSistema"]);
$linkMonitor = addslashes($_POST["inputMonitorSistema"]);
$servidor = addslashes($_POST["selectServidor"]);
$userServidor = addslashes($_POST["selectUserServidor"]);
$data = date("Y-m-d");
$status = addslashes($_POST["radioStatus"]); // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO);

if ($_SESSION["nivel"] == "admin") {

    if (isset($idSistema) && !empty($idSistema) && !empty($nomeSistema) && !empty($pathUser) && !empty($servidor)) {

        $editaServidor = new ManipulateData();
        $editaServidor->setTable("sistema");
        $editaServidor->setCamposBanco("id_usuarios_servidor='$userServidor', id_servidor='$servidor', nome_sistema='$nomeSistema', path_sistema='$pathUser', status_sistema='$status',link_monitoramento='$linkMonitor'");
        $editaServidor->setFieldId("id_sistema");
        $editaServidor->setValueId("$idSistema");
        $editaServidor->update();

        $_SESSION["erroSistema"] = "editado";
        header("location: ../../sistemasCadastrados.php");
    } else {
        $_SESSION["erroSistema"] = "erroEditar";
        header("location: ../../sistemasCadastrados.php");
    }
} else {
    header("location: ../../accessDenied.php");
}