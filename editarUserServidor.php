<?php

/*
 *  Arquivo de edição de usuario servidor
 * @author Álvaro Bacelar
 * @date 09/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {
    if ($nivel == "admin") {

        // VERIFICANDO SE EXISTE VARIÁVEL PASSADA PELA URL
        if (isset($_GET["idUserServer"])) {

            $idUserServer = addslashes($_GET["idUserServer"]);

            $editaUserServer = new ManipulateData();
            $editaUserServer->setTable("usuarios_servidor");
            $editaUserServer->setFieldId("id_usuarios_servidor");
            $editaUserServer->setValueId("$idUserServer");
            $editaUserServer->selectAlterar();
            $alterarUserServer = $editaUserServer->fetch_object();
            $smarty->assign("s", $alterarUserServer);

            // VERIFICA SE A VARIÁVEL DA PESQUISA PARA ALERAÇÃO DO USUARIO ESXISTE
            if (!empty($alterarUserServer)) {
                // BUSCANDO O GRUPO DO SERVIDOR SELECIONADO PARA EDIÇÃO 
                $buscaServerAlt = new ManipulateData();
                $buscaServerAlt->setTable("servidor");
                $buscaServerAlt->setFieldId("id_servidor");
                $buscaServerAlt->setValueId("$alterarUserServer->id_servidor");
                $buscaServerAlt->selectAlterar();
                $resServer = $buscaServerAlt->fetch_object();
                $smarty->assign("resServ", $resServer);
            }

            // BUSCA SERVIDORES PARA REALIZAR ALTERAÇÕES
            $buscaServidor = new ManipulateData();
            $buscaServidor->setTable("servidor");
            $buscaServidor->select();
            while ($resultado[] = $buscaServidor->fetch_object()) {
                $smarty->assign("servidor", $resultado);
            }

            $smarty->assign("conteudo", "paginas/editarUserServidor.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}