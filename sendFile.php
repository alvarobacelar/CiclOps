<?php

/*
 *  Arquivo de deploy ajax
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';
require_once './includes/classes/execSSH.php';

if ($estaLogado == "SIM") {

    if (isset($_GET["idFile"])) {

        $idFile = addslashes($_GET["idFile"]);

        // realizando a busca no servidor do arquivo enviado
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor");
        $buscaFile->setFieldId("id_file_deploy");
        $buscaFile->setValueId("$idFile");
        $buscaFile->selectFileDeploy();
        $filAr = $buscaFile->fetch_object();

        // realizando conexão com o servidor via ssh2
        $servExec = new ExecSSH($filAr->ip_servidor, $filAr->nome_usuarios_servidor, $filAr->senha_usuario_servidor, $filAr->porta_servidor);
//        // setando o parâmetro de arquivo local
//        $servExec->setArquivoLocal(PATH_ARQUIVOS . $filAr->nome_file_deploy);
//        // setando o parâmetro de arquivo remoto
//        $servExec->setArquivoRemoto($filAr->path_home_sistema . "/" . $filAr->nome_file_deploy);
//        // função de enviar o aquivo .war para o servidor 
//        $fileSend = $servExec->enviaArquivo();               

        $scp = "scp -P " . $filAr->porta_servidor . " " . PATH_ARQUIVOS . $filAr->nome_file_deploy . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . ":" . $filAr->path_home_sistema . "/";


        $mensagemExec = "Arquivo enviado para o servidor <strong>$filAr->ip_servidor</strong>, direcionando para a página de deploy ...";
        $smarty->assign("mensage", $mensagemExec);
        //sleep(5);            
        header("Location: iniciarDeploy.php?idFile=" . $idFile);
    } else {
        header("Location: realizarDeploy.php");
    }
}
