<?php

/*
 * Arquivo para mostrar o erro de acesso negado
 * @author Álvaro Bacelar
 * @date 07/06/2016
 */

require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
if ($estaLogado == "SIM") {

    $smarty->assign("conteudo", "paginas/accessDenied.tpl");
    $smarty->display("HTML.tpl");
}