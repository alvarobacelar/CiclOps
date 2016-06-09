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

    if (isset($_SESSION["excluirServidor"])) {
        
    } else {
        $smarty->assign("excluirServidor", "");
    }

    $buscaServer = new ManipulateData();    
    $buscaServer->selectServidor();
    while ($resultadoServidores[] = $buscaServer->fetch_object()) {
        $smarty->assign("servidorR", $resultadoServidores);
    }

    $smarty->assign("conteudo", "paginas/servidoresCadastrados.tpl");
    $smarty->display("HTML.tpl");
}