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

if ($estaLogado == "SIM") {

    if (isset($_POST["fileOk"])) {
        
        $idFile = addslashes($_POST["fileOk"]);

        // realizando a busca no servidor do arquivo enviado
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor");
        $buscaFile->setFieldId("id_file_deploy");
        $buscaFile->setValueId("$idFile");
        $buscaFile->selectFileDeploy();
        $filAr = $buscaFile->fetch_object();
        
        /*
         * DEFININDO AS VARIÁVEIS COM OS COMANDOS DE ENVIO DE ARQUIVO E EXECUÇÃO DO DEPLOY
         */
        // comando para remover a pasta mais antiga do servidor 
        $rmOld = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'rm -rf " . $filAr->path_sistema . "2*'";
        // renomeando a pasta atual
        $mvArquivos = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'mv " . $filAr->path_sistema . " " . $filAr->path_sistema . date("Ymd") . "'";
        // criando a pasta nova para por novos arquivos
        $mkdir = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'mkdir -p " . $filAr->path_sistema . "' ";
        // comando para envio de arquivo para o servidor
        $scp = "scp " . PATH_ARQUIVOS . $filAr->nome_file_deploy . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . ":" . $filAr->path_sistema . "/";
        // descompactando arquivo
        $unzip = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'unzip ". $filAr->path_sistema . "/" . $filAr->nome_file_deploy . " -d " . $filAr->path_sistema . "/'";
        // matando os processos existentes do java
        $killJava = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'killall -9 java'";
        // reiniciando o tomcat passo 1
        $reiTomcat1 = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor. " 'rm -rvf " . $filAr->path_usuarios_servidor . "/work/* '";
        // reiniciando tomcat passo 2
        $reiTomcat2 = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor. " 'sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh'";
                
        /*
         * EXECUÇÃO DOS COMANDOS ACIMA SETADOS
         */
//        echo $rmOld . "<br>" . $mvArquivos . "<br>" . $mkdir . "<br>" . $scp . "<br>" . $unzip . "<br>". $killJava . "<br>" . $reiTomcat1 . "<br>" . $reiTomcat2 ;
//        die();
        displaysecinfo("Removendo o arquivo mais antigo: ", myshellexec( $rmOld ));
        myshellexec( $mvArquivos );
        myshellexec( $mkdir );
        myshellexec(  $scp );
        displaysecinfo("Descompactando o arquivo: ", myshellexec( $unzip));
        displaysecinfo("Matando o processo Java esistente: ", myshellexec(  $killJava ));
        displaysecinfo("Removendo os arquivos do diretório Work do tomcat: ", myshellexec( $reiTomcat1 ));
        displaysecinfo("Iniciando o tomcat", myshellexec( $reiTomcat2 ));
        
        /*
         * Realizando alteração no banco do file_deploy (informando que o arquivo já foi feito o deploy)
         */
        $dat = date("Y-m-d");
        $fileSistema = $filAr->path_sistema . date("Ymd");
        $altFile = new ManipulateData();
        $altFile->setTable("file_deploy");
        $altFile->setCamposBanco("status_file_deploy='0',data_file_deploy='$dat',backup_sistema='$fileSistema'"); // quando o status_reverter_deploy for igual a 1 significa que o deploy foi realizado e está habilitado pra fazer undeploy
        $altFile->setFieldId("id_file_deploy");
        $altFile->setValueId("$idFile");
        $altFile->update();
    } else {
        header("Location: realizarDeploy.php");
    }
}