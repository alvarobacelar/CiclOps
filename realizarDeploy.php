<?php

/*
 *  Arquivo de deploy
 * @author Álvaro Bacelar
 * @date 09/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {

    if ($nivel == "admin" || $nivel == "dev") { //  SÓ PERMITE ACESSO A PAGINA USUÁRIOS ADMINISTRADORES E DEV

        if (!isset($_GET["servidor"])) { //  SE NÃO EXISTIR VARIÁVEL NA URL
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

            $smarty->assign("conteudo", "paginas/realizarDeploy.tpl");
            $smarty->display("HTML.tpl");
        } else if (isset($_GET["servidor"])) {
            $servidorId = addslashes($_GET["servidor"]);
            $buscaSistema = new ManipulateData();
            $buscaSistema->setTable("sistema");
            $buscaSistema->setFieldId("id_servidor");
            $buscaSistema->setValueId("$servidorId");
            $buscaSistema->selectAlterar();
            while ($resulSistema[] = $buscaSistema->fetch_object()) {
                $smarty->assign("sistemaDeploy", $resulSistema);
            }

            $smarty->assign("conteudo", "paginas/escolherSistema.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}
