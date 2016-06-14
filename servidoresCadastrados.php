<?php

/*
 *  Arquivo para listar todos servidores cadastrados
 * @author Álvaro Bacelar
 * @date 07/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

/*
 * Verificando se usuário está logado
 */
if ($estaLogado == "SIM") {

    // verificação de erro de senhas ou de duplicação de usuário no cadastro (feedback para o usuário)
    if (isset($_SESSION["erroServidor"])) {
        if ($_SESSION["erroServidor"] == "duplicado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Já existe um servidor com este nome, tente por outro nome</div>");
        } else if ($_SESSION["erroServidor"] == "Cadastrado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Servidor cadastrado com sucesso!</div>");
        } else if ($_SESSION["erroServidor"] == "editado") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Servidor editado com sucesso!</div>");
        } else if ($_SESSION["erroServidor"] == "erroEditar") {
            $smarty->assign("erroCadastro", "<div class='alert alert-success' role='alert'>Erro ao editar o servdior, você não passou dados sificiente para a edição</div>");
        } else if ($_SESSION["erroServidor"] == "duplicadoIP") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Já existe um servidor cadastrado com esse endereço de IP</div>");
        } else if ($_SESSION["erroServidor"] == "vazio") {
            $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Erro ao cadastrar novo servidor, não foi informado o nome do servidor!</div>");
        }
    } else {
        $smarty->assign("erroCadastro", "");
    }
    unset($_SESSION["erroServidor"]);

    $buscaServer = new ManipulateData();    
    $buscaServer->selectServidor();
    while ($resultadoServidores[] = $buscaServer->fetch_object()) {
        $smarty->assign("servidorR", $resultadoServidores);
    }

    $smarty->assign("conteudo", "paginas/servidoresCadastrados.tpl");
    $smarty->display("HTML.tpl");
}