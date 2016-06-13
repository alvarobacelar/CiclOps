<?php


/*
 *  Arquivo de deploy
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM"){
    
    if ($nivel == "admin" || $nivel == "dev"){
        
        
        
        $smarty->assign("conteudo", "paginas/iniciarDeploy.tpl");
        $smarty->display("HTML.tpl");
    }
    
}

