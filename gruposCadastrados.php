<?php

/*
 *  Arquivo de grupos cadastrados
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
//require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

//if (){
//}

$smarty->assign("conteudo", "paginas/gruposCadastrados.tpl");
$smarty->display("HTML.tpl");
