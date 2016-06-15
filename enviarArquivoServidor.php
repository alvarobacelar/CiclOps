<?php

/*
 *  Arquivo de envio de arquivo para o servidor
 * @author Álvaro Bacelar
 * @date 13/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';

if ($estaLogado == "SIM") {

    if ($nivel == "admin" || $nivel == "dev") {

        if (isset($_GET["servidor"]) && isset($_GET["sistema"])) {
            
            if (isset($_SESSION["erroFile"])){
                if ($_SESSION["erroFile"] == "erro"){
                    $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Ocorreu um erro com o arquivo</div>");
                } else if ($_SESSION["erroFile"] == "extensao"){
                    $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Extenção de arquivo inválida</div>");
                } else if ($_SESSION["erroFile"] == "tamanho"){
                     $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Tanho do arquivo é superior que o permitido</div>");
                } else if ($_SESSION["erroFile"] == "erroUpload"){
                    $smarty->assign("erroCadastro", "<div class='alert alert-danger' role='alert'>Ocorreu algum erro ao enviar o arquivo para o servidor</div>");
                }                
            } else {
                $smarty->assign("erroCadastro", "");
            }
            unset($_SESSION["erroFile"]);

            $sistema = addslashes($_GET["sistema"]);
            $servidor = addslashes($_GET["servidor"]);

            $buscaSistema = new ManipulateData();
            $buscaSistema->setTable("sistema");
            $buscaSistema->setFieldId("id_sistema");
            $buscaSistema->setValueId("$sistema");
            $buscaSistema->selectAlterar();
            $resultSist = $buscaSistema->fetch_object();
            $smarty->assign("resSistema",$resultSist);
            
            if (empty($resultSist)){ // caso não exista retorno da query acima, será redirecionado para o unicio do deploy
                header("Location: realizarDeploy.php");
                exit();
            }

            $smarty->assign("sistema",$sistema);
            $smarty->assign("servidor", $servidor);
            $smarty->assign("conteudo", "paginas/enviarArquivoServidor.tpl");
            $smarty->display("HTML.tpl");
        } else {
            header("Location: realizarDeploy.php");
        }
    } else {
        header("Localtion: accessDenied.php");
    }
}