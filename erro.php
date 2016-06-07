<?php
/*
 * Página de erro
 * @author Álvaro Bacelar
 * @date 07/06/2016
 */
require_once './lib/smarty/config/config.php';
//require_once './includes/funcoes/verifica.php';
//if ($estaLogado == "SIM" && !isset($active)){
    
    $smarty->assign("conteudo","paginas/erro.tpl");
    $smarty->display("HTML.tpl");
//}