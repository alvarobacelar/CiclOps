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
        $smarty->assign("excluirUser", "");
    }

    $buscaUserServer = new ManipulateData();    
    $buscaUserServer->selectUserServidor();
    while ($resultadoUserServidores[] = $buscaUserServer->fetch_object()) {
        $smarty->assign("userR", $resultadoUserServidores);
    }

    $smarty->assign("conteudo", "paginas/userServidorCadastrados.tpl");
    $smarty->display("HTML.tpl");
}