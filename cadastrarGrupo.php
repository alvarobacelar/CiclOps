<?php
/*
 *  Arquivo de cadastro de grupo
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
//require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

//if (){

// verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
if (isset($_SESSION["erroGrupo"])) {
    if ($_SESSION["erroGrupo"] == "duplicado") {
        $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Usuário já cadastrado</div>");
    } else if ($_SESSION["erroGrupo"] == "Cadastrado") {
        $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>");
    }
} else {
    $smarty->assign("erroCadastro", "");
}

$smarty->assign("conteudo", "paginas/cadastrarGrupo.tpl");
$smarty->display("HTML.tpl");

//}