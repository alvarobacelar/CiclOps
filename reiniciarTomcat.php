<?php

/*
 *  Arquivo para reiniciar tomcat
 * @author Álvaro Bacelar
 * @date 15/06/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM") {

    if ($nivel == "admin" || $nivel == "dev") {

        if (!isset($_GET["servidor"])) {

            if ($nivel != "admin") {
                $buscaGrupoServer = new ManipulateData();
                $buscaGrupoServer->setTable("servidor");
                $buscaGrupoServer->setFieldId("id_grupo_servidor");
                $buscaGrupoServer->setValueId("$grupo");
                $buscaGrupoServer->selectAlterar();
                while ($resultadoServ[] = $buscaGrupoServer->fetch_object()) {
                    $smarty->assign("servidoresGrupo", $resultadoServ);
                }
            } else { // CASO SEJA O ADMINISTRADOR QUE ESTEJA ACESSANDO IRÁ MOSTRAR TODOS OS SERVIDORES
                $buscaGrupoServerAdmin = new ManipulateData();
                $buscaGrupoServerAdmin->setTable("servidor");
                $buscaGrupoServerAdmin->setEstado("status_servidor");
                $buscaGrupoServerAdmin->selectAtivo();
                while ($resulServerAdmin[] = $buscaGrupoServerAdmin->fetch_object()) {
                    $smarty->assign("servidoresGrupo", $resulServerAdmin);
                }
            }
            $smarty->assign("conteudo", "paginas/reiniciarTomcat.tpl");
            $smarty->display("HTML.tpl");
            
            // se existir variável na url será direcionado para a segunda parte de reiniciar tomcat
        } else if (isset($_GET["servidor"])) {
            $servidorId = addslashes($_GET["servidor"]);
            
            $buscaSistema = new ManipulateData();
            $buscaSistema->setTable("sistema,usuarios_servidor");
            $buscaSistema->setFieldId("sistema.id_servidor");
            $buscaSistema->setValueId("$servidorId");
            $buscaSistema->selectSistemaReinicar();
            while ($resulSistema[] = $buscaSistema->fetch_object()) {
                $smarty->assign("sistemaDeploy", $resulSistema);
            }

            $smarty->assign("conteudo", "paginas/escolherSistemaTomcat.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: accessDenied.php");
        }
    }
}