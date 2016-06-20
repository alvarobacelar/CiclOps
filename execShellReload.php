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
        $buscaFile->selectReiniciar();
        $filAr = $buscaFile->fetch_object();

        /*
         * DEFININDO AS VARIÁVEIS COM OS COMANDOS DE ENVIO DE ARQUIVO E EXECUÇÃO DO DEPLOY
         */
        $killJava = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'killall -9 java'";
        // reiniciando o tomcat passo 1
        $reiTomcat1 = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'rm -rf " . $filAr->path_usuarios_servidor . "/work/* '";
        // reiniciando tomcat passo 2
        $reiTomcat2 = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh'";
//                
//        /*
//         * EXECUÇÃO DOS COMANDOS ACIMA SETADOS
//         */
        
        echo "<strong>Matando o processo java existente </strong><br>";
        shell_exec($killJava);
        echo "<strong>Limpando o diretório work </strong><br>";
        shell_exec($reiTomcat1);
        displaysecinfo("Iniciando o tomcat <br> ", shell_exec($reiTomcat2));

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
    }
}
