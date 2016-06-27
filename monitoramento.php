<?php

require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {

    if ($nivel != "admin") {
        $buscaGrupoServer = new ManipulateData();
        $buscaGrupoServer->setTable("sistema");
        $buscaGrupoServer->setFieldId("grupo_servidor.id_grupo_servidor");
        $buscaGrupoServer->setValueId("$grupo");
        $buscaGrupoServer->selectSistemaMonitor();
        while ($resultadoServ[] = $buscaGrupoServer->fetch_object()) {
            $smarty->assign("servidoresGrupo", $resultadoServ);
        }
    } else { // CASO SEJA O ADMINISTRADOR QUE ESTEJA ACESSANDO IRÁ MOSTRAR TODOS OS SERVIDORES
        $buscaGrupoServerAdmin = new ManipulateData();
        $buscaGrupoServerAdmin->setTable("sistema");
        $buscaGrupoServerAdmin->setEstado("status_servidor");
        $buscaGrupoServerAdmin->setOrderTable("WHERE sistema.link_monitoramento != ''");
        $buscaGrupoServerAdmin->select();
        while ($resulServerAdmin[] = $buscaGrupoServerAdmin->fetch_object()) {
            $smarty->assign("servidoresGrupo", $resulServerAdmin);
        }
    }

    $smarty->assign("conteudo", "paginas/monitoramento.tpl");
    $smarty->display("HTML.tpl");
}
