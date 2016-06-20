<?php

/*
 * Arquivo de edição de grupo
 * @author Álvaro Bacelar
 * @date 14/06/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {
    if ($nivel == "admin") {

        if ($_GET["idGrup"]) {

            $idGrupo = addslashes($_GET["idGrup"]);

            // REALIZANDO A BUSCA ESPECIFICA DE GRUPO PARA EDIÇÃO
            $editarGrupo = new ManipulateData();
            $editarGrupo->setTable("grupo_servidor");
            $editarGrupo->setFieldId("id_grupo_servidor");
            $editarGrupo->setValueId("$idGrupo");
            $editarGrupo->selectAlterar();
            $resulGrupo = $editarGrupo->fetch_object();
            $smarty->assign("gr", $resulGrupo);


            $smarty->assign("conteudo", "paginas/editarGrupo.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}