<?php

/*
 *  Arquivo de edição de servidor
 * @author Álvaro Bacelar
 * @date 09/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {
    if ($nivel == "admin") {

        // VERIFICANDO SE EXISTE VARIÁVEL PASSADA PELA URL
        if (isset($_GET["idServer"])) {

            $idServer = addslashes($_GET["idServer"]);
            
            $editaServer = new ManipulateData();
            $editaServer->setTable("servidor");
            $editaServer->setFieldId("id_servidor");
            $editaServer->setValueId("$idServer");
            $editaServer->selectAlterar();
            $alteraServer = $editaServer->fetch_object();
            $smarty->assign("as", $alteraServer);

            $smarty->assign("conteudo", "paginas/editarServidor.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}