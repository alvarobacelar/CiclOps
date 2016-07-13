<?php

require_once '../models/ManipulateData.php';

/* 
 * ************************************************
 *  ARQUIVO PARA EDIÇÃO DO USUÁRIO DO SERVIDOR
 *  @author Álvaro Bacelar
 *  @date 10/06/2016
 */
//CAPTANDO DADOS DO FORMULARIO
$idUser = addslashes($_POST["hiddenIdUser"]);
$nomeUser = addslashes($_POST["inputNomeUser"]);
$pathTomcat = addslashes($_POST["inputPathTomcat"]);
$servidorUser = addslashes($_POST["selectServidor"]);
$senhaUsuarioServ = addslashes($_POST["inputSenhaUser"]);
$data = date("Y-m-d");
$status = addslashes($_POST["radioStatus"]); // STATUS IGUAL A 1 SIGINIFICA QUE ESTÁ ATIVO (0 = DESATIVADO)
session_start();

if ($_SESSION["nivel"] == "admin") {

    if (isset($idUser) && !empty($nomeUser) && !empty($pathTomcat) && !empty($servidorUser) && !empty($idUser)) {

        $editaServidor = new ManipulateData();
        $editaServidor->setTable("usuarios_servidor");
        $editaServidor->setCamposBanco("id_servidor='$servidorUser',nome_usuarios_servidor='$nomeUser',path_usuarios_servidor='$pathTomcat',status_usuario_servidor='$status',senha_usuario_servidor='$senhaUsuarioServ'");
        $editaServidor->setFieldId("id_usuarios_servidor");
        $editaServidor->setValueId("$idUser");
        $editaServidor->update();

        $_SESSION["erroUser"] = "editado";
        header("location: ../../userServidorCadastrados.php");
    } else {
        $_SESSION["erroUser"] = "erroEditar";
        header("location: ../../userServidorCadastrados.php");
    }
} else {
    header("location: ../../accessDenied.php");
}
