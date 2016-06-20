<?php

/*
 *  Arquivo de grupos cadastrados
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM") {

    if ($nivel == "admin") {

        // verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
        if (isset($_SESSION["erroGrupo"])) {
            if ($_SESSION["erroGrupo"] == "duplicado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Grupo já cadastrado</div>");
            } else if ($_SESSION["erroGrupo"] == "Cadastrado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Grupo cadastrado com sucesso!</div>");
            } else if ($_SESSION["erroGrupo"] == "editado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Grupo editado com sucesso!</div>");
            } else if ($_SESSION["erroGrupo"] == "vazio") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao editar o grupo. Não foi passado nenhum parâmetro.</div>");
            } else if ($_SESSION["erro"] == "vazio") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo grupo, não foi informado o nome do grupo!</div>");
            }
        } else {
            $smarty->assign("erroCadastro", "");
        }
        unset($_SESSION["erroGrupo"]);

        $buscaGrupo = new ManipulateData();
        $buscaGrupo->setTable("grupo_servidor");
        $buscaGrupo->setEstado("status_grupo_servidor");
        $buscaGrupo->setOrderTable("ORDER BY nome_grupo_servidor");
        $buscaGrupo->selectAtivo();
        while ($resultadoGrupo[] = $buscaGrupo->fetch_object()) {
            $smarty->assign("grupoR", $resultadoGrupo);
        }

        $smarty->assign("conteudo", "paginas/gruposCadastrados.tpl");
        $smarty->display("HTML.tpl");
    } else {
        header("Location: accessDenied.php");
    }
}