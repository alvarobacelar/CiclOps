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
    
    if ($nivel == "admin") {

// verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
        if (isset($_SESSION["erroUser"])) {
            if ($_SESSION["erroUser"] == "duplicado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Usuário já cadastrado no servidor selecionado</div>");
            } else if ($_SESSION["erroUser"] == "Cadastrado") {
                $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>");
            } else if ($_SESSION["erroUser"] == "vazio") {
                $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo usuário, não foi informado nenhum parâmetro!</div>");
            }
        } else {
            $smarty->assign("erroCadastro", "");
        }
        unset($_SESSION["erroUser"]);

        $buscaGrupo = new ManipulateData();
        $buscaGrupo->setTable("servidor");
        $buscaGrupo->select();
        while ($resultado[] = $buscaGrupo->fetch_object()) {
            $smarty->assign("grupo", $resultado);
        }

        $smarty->assign("conteudo", "paginas/cadastrarUserServidor.tpl");
        $smarty->display("HTML.tpl");
    } else {
        header("Location: accessDenied.php");
    }
}