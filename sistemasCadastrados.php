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

    if (isset($_SESSION["excluirSistema"])) {
        
    } else {
        $smarty->assign("excluirSistema", "");
    }

    $buscaSistema = new ManipulateData();    
    $buscaSistema->selectSistema();
    while ($resultadoSistema[] = $buscaSistema->fetch_object()) {
        $smarty->assign("sistemaR", $resultadoSistema);
    }

    $smarty->assign("conteudo", "paginas/sistemasCadastrados.tpl");
    $smarty->display("HTML.tpl");
}