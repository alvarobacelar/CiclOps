<?php

/*
 *  Arquivo de edição de sistema servidor
 * @author Álvaro Bacelar
 * @date 09/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {
    if ($nivel == "admin") {

        // VERIFICANDO SE EXISTE VARIÁVEL PASSADA PELA URL
        if (isset($_GET["idSistema"])) {

            $idSistema = addslashes($_GET["idSistema"]);

            $editaSistema = new ManipulateData();
            $editaSistema->setTable("sistema");
            $editaSistema->setFieldId("id_sistema");
            $editaSistema->setValueId("$idSistema");
            $editaSistema->selectAlterar();
            $alterarSistema = $editaSistema->fetch_object();
            $smarty->assign("si", $alterarSistema);

            // VERIFICA SE A VARIÁVEL DA PESQUISA PARA ALERAÇÃO DO USUARIO ESXISTE
            if (!empty($alterarSistema)) {
                // BUSCANDO O GRUPO DO SERVIDOR SELECIONADO PARA EDIÇÃO 
                $buscaServerAlt = new ManipulateData();
                $buscaServerAlt->setTable("servidor");
                $buscaServerAlt->setFieldId("id_servidor");
                $buscaServerAlt->setValueId("$alterarSistema->id_servidor");
                $buscaServerAlt->selectAlterar();
                $resServer = $buscaServerAlt->fetch_object();
                $smarty->assign("resServ", $resServer);
            }
            
            if (!empty($alterarSistema)){
                $buscaUserServidor = new ManipulateData();
                $buscaUserServidor->setTable("usuarios_servidor");
                $buscaUserServidor->setFieldId("id_usuarios_servidor");
                $buscaUserServidor->setValueId("$alterarSistema->id_usuarios_servidor");
                $buscaUserServidor->selectAlterar();
                $resultadoBusca = $buscaUserServidor->fetch_object();
                $smarty->assign("resUser", $resultadoBusca);
            }

            $buscaUserServer = new ManipulateData();
            $buscaUserServer->selectUserServidor();
            while ($resultadoUserServidores[] = $buscaUserServer->fetch_object()) {
                $smarty->assign("servidorR", $resultadoUserServidores);
            }

            $smarty->assign("conteudo", "paginas/editarSistemasCadastrados.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}