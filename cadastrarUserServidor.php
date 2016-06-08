<?php

/*
 *  Arquivo de cadastro de grupo
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM") {

// verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
    if (isset($_SESSION["erroUserServer"])) {
        if ($_SESSION["erroUserServer"] == "duplicado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Grupo já cadastrado</div>");
        } else if ($_SESSION["erroUserServer"] == "Cadastrado") {
            $smarty->assign("erroServidor", "<div class='alert alert-success' role='alert'>Grupo cadastrado com sucesso!</div>");
        } else if ($_SESSION["erroUserServer"] == "vazio") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo grupo, não foi informado o nome do grupo!</div>");
        }
    } else {
        $smarty->assign("erroCadastro", "");
    }
    unset($_SESSION["erroUserServer"]);

    $smarty->assign("conteudo", "paginas/cadastrarUserServidor.tpl");
    $smarty->display("HTML.tpl");
}