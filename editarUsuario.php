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

        if ($_GET["id"]) {
            
            $idUsuario = addslashes($_GET["id"]);
            
            $editarUsuario = new ManipulateData();
            $editarUsuario->setTable("usuario");
            $editarUsuario->setFieldId("id_usuario");
            $editarUsuario->setValueId("$idUsuario");
            $editarUsuario->selectAlterar();
            $resulUsuario = $editarUsuario->fetch_object();
            $smarty->assign("us", $resulUsuario);

            $buscaGrupo = new ManipulateData();
            $buscaGrupo->setTable("grupo_servidor");
            $buscaGrupo->select();
            while ($resultado[] = $buscaGrupo->fetch_object()) {
                $smarty->assign("grupo", $resultado);
            }

            $smarty->assign("conteudo", "paginas/editarUsuario.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}