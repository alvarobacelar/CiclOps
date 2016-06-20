<?php

/*
 *  Arquivo de edição de sistema servidor
 * @author Álvaro Bacelar
 * @date 09/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {
    if ($nivel == "admin") {

        if ($_GET["id"]) {

            $idUsuario = addslashes($_GET["id"]);

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

            // REALIZANDO A BUSCA ESPECIFICA DE USUÁRIO PARA EDIÇÃO
            $editarUsuario = new ManipulateData();
            $editarUsuario->setTable("usuario");
            $editarUsuario->setFieldId("id_usuario");
            $editarUsuario->setValueId("$idUsuario");
            $editarUsuario->selectAlterar();
            $resulUsuario = $editarUsuario->fetch_object();
            $smarty->assign("us", $resulUsuario);

            if (!empty($resulUsuario)) {
                // BUSCANDO O GRUPO DO SERVIDOR SELECIONADO PARA EDIÇÃO 
                $buscaGrupoAlt = new ManipulateData();
                $buscaGrupoAlt->setTable("grupo_servidor");
                $buscaGrupoAlt->setFieldId("id_grupo_servidor");
                $buscaGrupoAlt->setValueId("$resulUsuario->id_grupo_servidor");
                $buscaGrupoAlt->selectAlterar();
                $resGrupo = $buscaGrupoAlt->fetch_object();
                $smarty->assign("resGrup", $resGrupo);
            }

            $buscaGrupo = new ManipulateData();
            $buscaGrupo->setTable("grupo_servidor");
            $buscaGrupo->select();
            while ($resultado[] = $buscaGrupo->fetch_object()) {
                $smarty->assign("grupo", $resultado);
            }

            $smarty->assign("conteudo", "paginas/editarUsuario.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: erro.php");
        }
    } else {
        header("Location: accessDenied.php");
    }
}