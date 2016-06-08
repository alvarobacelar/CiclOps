<?php

/*
 *  Arquivo para listar todos usuários cadastrados
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

/*
 * Verificando se usuário está logado
 */
if ($estaLogado == "SIM") {

    if (isset($_SESSION["excluirUser"])) {
        
    } else {
        $smarty->assign("excluirUsuario", "");
    }

    $buscaUser = new ManipulateData();
    $buscaUser->setTable("usuario");
    $buscaUser->setEstado("status_usuario");
    $buscaUser->setOrderTable("ORDER BY nome_usuario");
    $buscaUser->selectAtivo();
    while ($resultadoUsuarios[] = $buscaUser->fetch_object()) {
        $smarty->assign("usuariosR", $resultadoUsuarios);
    }

    $smarty->assign("conteudo", "paginas/usuariosCadastrados.tpl");
    $smarty->display("HTML.tpl");
}