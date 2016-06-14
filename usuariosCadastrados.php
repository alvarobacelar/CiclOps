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
    // SO PERMITE ACESSO DE USUÁRIOS ADMINISTRADORES
    if ($nivel == "admin") {

        // verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
        if (isset($_SESSION["erro"])) {
            if ($_SESSION["erro"] == "ERRO") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>As senhas não conferem</div>");
            } else if ($_SESSION["erro"] == "duplicado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Usuário já cadastrado</div>");
            } else if ($_SESSION["erro"] == "erroSenha") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Senhas informadas não batem</div>");
            } else if ($_SESSION["erro"] == "Cadastrado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>");
            } else if ($_SESSION["erro"] == "vazio") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo usuário, não foi informado os parâmetros para cadastro!</div>");
            }
        } else {
            $smarty->assign("erroCadastro", "");
        }
        unset($_SESSION["erro"]);

        // REALIZANDO BUSCA NO BANCO DE DADOS DE TODOS OS USUÁRIOS CADASTRADOS
        $buscaUser = new ManipulateData();
        $buscaUser->setTable("usuario");
        $buscaUser->setEstado("status_usuario");
        $buscaUser->setOrderTable("ORDER BY nome_usuario");
        $buscaUser->selectAtivo();
        while ($resultadoUsuarios[] = $buscaUser->fetch_object()) {
            $smarty->assign("usuariosR", $resultadoUsuarios);
        }

        $smarty->assign("conteudo", "paginas/usuariosCadastrados.tpl");
        $smarty->display("HTML.tpl");
    } else {
        header("Location: accessDenied.php");
    }
}