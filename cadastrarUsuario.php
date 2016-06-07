<?php

/*
 *  Arquivo de cadastro de usuários
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
//require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

//if (){
//}

$smarty->assign("conteudo", "paginas/cadastrarUsuario.tpl");
$smarty->display("HTML.tpl");
