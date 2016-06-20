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

            if (!empty($alteraServer)) {
                // BUSCANDO O GRUPO DO SERVIDOR SELECIONADO PARA EDIÇÃO 
                $buscaGrupoAlt = new ManipulateData();
                $buscaGrupoAlt->setTable("grupo_servidor");
                $buscaGrupoAlt->setFieldId("id_grupo_servidor");
                $buscaGrupoAlt->setValueId("$alteraServer->id_grupo_servidor");
                $buscaGrupoAlt->selectAlterar();
                $resGrupo = $buscaGrupoAlt->fetch_object();
                $smarty->assign("resGrup", $resGrupo);
            }

            // BUSCA SERVIDORES PARA REALIZAR ALTERAÇÕES
            $buscaGrupo = new ManipulateData();
            $buscaGrupo->setTable("grupo_servidor");
            $buscaGrupo->select();
            while ($resultado[] = $buscaGrupo->fetch_object()) {
                $smarty->assign("grupo", $resultado);
            }

            $smarty->assign("conteudo", "paginas/editarServidor.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}