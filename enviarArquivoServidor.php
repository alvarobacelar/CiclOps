<?php

/*
 *  Arquivo de envio de arquivo para o servidor
 * @author Álvaro Bacelar
 * @date 13/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {

    if ($nivel == "admin" || $nivel == "dev") {

        if (isset($_GET["servidor"]) && isset($_GET["sistema"])) {

            $sistema = addslashes($_GET["sistema"]);
            $servidor = addslashes($_GET["servidor"]);

            $buscaSistema = new ManipulateData();
            $buscaSistema->setTable("sistema");
            $buscaSistema->setFieldId("id_sistema");
            $buscaSistema->setValueId("$sistema");
            $buscaSistema->selectAlterar();

            $smarty->assign("conteudo", "paginas/enviarArquivo.tpl");
            $smarty->display("HTML.tpl");
        } else {
            
        }
    } else {
        header("Localtion: accessDenied.php");
    }
}