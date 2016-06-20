<?php

/*
 *  Arquivo para reverter deploy ajax
 * @author Álvaro Bacelar
 * @date 15/06/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM") {

    if (isset($_POST["reverterSistema"])) {

        $idSistema = addslashes($_POST["reverterSistema"]);

        // realizando a busca no servidor do arquivo enviado
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor");
        $buscaFile->setOrderTable("ORDER BY id_file_deploy DESC LIMIT 1");
        $buscaFile->setFieldId("sistema.id_sistema");
        $buscaFile->setValueId("$idSistema");
        $buscaFile->selectFileDeploy();
        $filAr = $buscaFile->fetch_object();
 
        /*
         * DEFININDO AS VARIÁVEIS COM OS COMANDOS DE ENVIO DE ARQUIVO E EXECUÇÃO DO DEPLOY
         */
        // renomeando a pasta atual
        $mvBugado = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'mv " . $filAr->path_sistema . " " . $filAr->path_sistema . date("Ymd") . "-bugado'";
        
        $mvRever = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'mv " . $filAr->backup_sistema . " " . $filAr->path_sistema . "'";
        // matando os processos existentes do java
        $killJava = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'killall -9 java'";
        // reiniciando o tomcat passo 1
        $reiTomcat1 = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor. " 'rm -rvf " . $filAr->path_usuarios_servidor . "/work/* '";
        // reiniciando tomcat passo 2
        $reiTomcat2 = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor. " 'sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh'";

        /*
         * EXECUÇÃO DOS COMANDOS ACIMA SETADOS
         */
        echo "<strong>Matando o processo Java existente </strong><br>";
        displaysecinfo("Matando o processo Java ", myshellexec( $killJava));
        echo "<strong>Movendo a pasta com os arquivos bugado </strong><br>";
        myshellexec( $mvBugado );
        echo "<strong>Movendo a pasta backup do sistema </strong><br>";
        myshellexec( $mvRever );
        displaysecinfo("Removendo os arquivos do diretório Work do tomcat ", myshellexec( $reiTomcat1 ));
        displaysecinfo("Iniciando o tomcat ", myshellexec( $reiTomcat2 ));

        /*
         * Realizando alteração no banco do file_deploy (informando que o arquivo já foi feito o deploy)
         */
        $dat = date("Y-m-d");
        $altFile = new ManipulateData();
        $altFile->setTable("file_deploy");
        $altFile->setCamposBanco("status_file_deploy='0',data_file_deploy='$dat',status_reverter_deploy='1'");
        $altFile->setFieldId("id_sistema");
        $altFile->setValueId("$idSistema");
        $altFile->update();
    } else {
        header("Location: realizarDeploy.php");
    }
}