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
    if (isset($_SESSION["erroSistema"])) {
        if ($_SESSION["erroSistema"] == "duplicado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Sistema já cadastrado no servidor selecionado</div>");
        } else if ($_SESSION["erroSistema"] == "Cadastrado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Sistema cadastrado com sucesso!</div>");
        } else if ($_SESSION["erroSistema"] == "editado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Sistema editado com sucesso!</div>");
        } else if ($_SESSION["erroSistema"] == "erroEditar") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Erro ao editar o sistema, não foi passado parâmetros suficiente para a edição!</div>");
        } else if ($_SESSION["erroSistema"] == "vazio") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo usuário, não foi informado nenhum parâmetro!</div>");
        }
    } else {
        $smarty->assign("erroCadastro", "");
    }
    unset($_SESSION["erroSistema"]);

    $buscaUserServer = new ManipulateData();
    $buscaUserServer->selectUserServidor();
    while ($resultadoUserServidores[] = $buscaUserServer->fetch_object()) {
        $smarty->assign("servidorR", $resultadoUserServidores);
    }

    $smarty->assign("conteudo", "paginas/cadastrarSistema.tpl");
    $smarty->display("HTML.tpl");
}