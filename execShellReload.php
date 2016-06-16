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

    if (isset($_POST["tomcatSistema"])) {
        
        $sistemaTomcat = addslashes($_POST["tomcatSistema"]);

        // realizando a busca no servidor do arquivo enviado
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor");
        $buscaFile->setFieldId("sistema.id_sistema");
        $buscaFile->setValueId("$sistemaTomcat");
        $buscaFile->selectFileDeploy();
        $filAr = $buscaFile->fetch_object();
        
//        sleep(4);
//        echo "teste";
//        die();
        /*
         * DEFININDO AS VARIÁVEIS COM OS COMANDOS DE ENVIO DE ARQUIVO E EXECUÇÃO DO DEPLOY
         */
        $killJava = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'killall -9 java'";
        // reiniciando o tomcat passo 1
        $reiTomcat1 = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor. " 'rm -rvf " . $filAr->path_usuarios_servidor . "/work/* '";
        // reiniciando tomcat passo 2
        $reiTomcat2 = "ssh " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor. " 'sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh'";
//                
//        /*
//         * EXECUÇÃO DOS COMANDOS ACIMA SETADOS
//         */

        
        displaysecinfo("Matando o processo Java esistente <br>", myshellexec(  $killJava ));
        displaysecinfo("Removendo os arquivos do diretório Work do tomcat <br>", myshellexec( $reiTomcat1 ));
        displaysecinfo("Iniciando o tomcat <br> ", myshellexec( $reiTomcat2 ));
        
        /*
         * Realizando alteração no banco do file_deploy (informando que o arquivo já foi feito o deploy)
         */
        $dat = "Sistema reiniciado por <strong>" . $filAr->nome_usuarios_servidor . "</strong> no dia " . date("Y-m-d");
        $altFile = new ManipulateData();
        $altFile->setTable("sistema");
        $altFile->setCamposBanco("obs_sistema='$dat'");
        $altFile->setFieldId("id_sistema");
        $altFile->setValueId("$sistemaTomcat");
        $altFile->update();
    } else {
        header("Location: reiniciarTomcat.php");
    }
}