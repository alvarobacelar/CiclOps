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

    // verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
    if (isset($_SESSION["erroUser"])) {
        if ($_SESSION["erroUser"] == "duplicado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Usuário já cadastrado no servidor selecionado</div>");
        } else if ($_SESSION["erroUser"] == "Cadastrado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>");
        } else if ($_SESSION["erroUser"] == "editado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>");
        } else if ($_SESSION["erroUser"] == "erroEditar") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao editar usuário, não foi passado os parâmetros suficiente para a edição</div>");
        } else if ($_SESSION["erroUser"] == "vazio") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo usuário, não foi informado nenhum parâmetro!</div>");
        }
    } else {
        $smarty->assign("erroCadastro", "");
    }
    unset($_SESSION["erroUser"]);

    $buscaUserServer = new ManipulateData();
    $buscaUserServer->selectUserServidor();
    while ($resultadoUserServidores[] = $buscaUserServer->fetch_object()) {
        $smarty->assign("userR", $resultadoUserServidores);
    }

    $smarty->assign("conteudo", "paginas/userServidorCadastrados.tpl");
    $smarty->display("HTML.tpl");
}