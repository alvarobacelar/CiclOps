<?php

/*
 *  Arquivo de grupos cadastrados
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM") {
    
    if (isset($_SESSION["excluirGrupo"])) {
        
    } else {
        $smarty->assign("excluirGrupo", "");
    }

    $buscaGrupo = new ManipulateData();
    $buscaGrupo->setTable("grupo_servidor");
    $buscaGrupo->setEstado("status_grupo_servidor");
    $buscaGrupo->setOrderTable("ORDER BY nome_grupo_servidor");
    $buscaGrupo->selectAtivo();
    while ($resultadoGrupo[] = $buscaGrupo->fetch_object()) {
        $smarty->assign("grupoR", $resultadoGrupo);
    }

    $smarty->assign("conteudo", "paginas/gruposCadastrados.tpl");
    $smarty->display("HTML.tpl");
}