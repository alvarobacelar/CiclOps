#!/usr/bin/php -q

<?php
/*
 *  Arquivo de deploy agendamento
 * @author Álvaro Bacelar
 * @date 18/07/2016
 */

$localRoot = "/home/infoway/www/SisDeploy/"; // mudar esse diretório quando for para o servidor de produção 

require_once $localRoot . "includes/models/ManipulateData.php";
require_once $localRoot . "includes/funcoes/exeCmdShel.php";
require_once $localRoot . "includes/classes/execSSH.php";


$dataTima = date("YmdHi");
$buscaFileAgenda = new ManipulateData();
$buscaFileAgenda->setTable("agendamento");
$buscaFileAgenda->setFieldId("data_hora_agendamento");
$buscaFileAgenda->setValueId($dataTima);
$buscaFileAgenda->selectAlterar();

if ($buscaFileAgenda->registros_retornados() >= 1) {

    while ($resultadoAgenda = $buscaFileAgenda->fetch_object()) {

        $idFile = $resultadoAgenda->id_file_deploy;

        // realizando a busca no servidor do arquivo enviado
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor");
        $buscaFile->setFieldId("id_file_deploy");
        $buscaFile->setValueId("$idFile");
        $buscaFile->selectFileDeploy();
        $filAr = $buscaFile->fetch_object();

        // realizando conexão com o servidor via ssh2
        $servExec = new ExecSSH($filAr->ip_servidor, $filAr->nome_usuarios_servidor, $filAr->senha_usuario_servidor, $filAr->porta_servidor);

        /*
         * DEFININDO AS VARIÁVEIS COM OS COMANDOS  DE EXECUÇÃO DO DEPLOY
         */
        $rmOld = "rm -rf " . $filAr->path_sistema . "2*"; // REMOVENDO OS ARQIVOS ANTIGOS DO SISTEMA
        $mvArquivos = "mv " . $filAr->path_sistema . " " . $filAr->path_sistema . date("Ymd"); // MOVENDO O PATH ATUAL DO SISTEMA
        $mkdir = "mkdir -p " . $filAr->path_sistema; // CRIANDO UMA NOVA PASTA DO SISTEMA PARA POR O ARQUIVO WAR
        $mvFileDepl = "mv " . $filAr->path_home_sistema . "/" . $filAr->nome_file_deploy . " " . $filAr->path_sistema . "/"; // MOVENDO O ARQUIVO WAR ENVIADO ANTERIORMENTE PARA A REALIZAÇÃO DO DEPLOY
        //$unzip = "unzip ". $filAr->path_sistema . "/" . $filAr->nome_file_deploy . " -d " . $filAr->path_sistema . "/"; // descompactando arquivo        
        $unzip = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'unzip " . $filAr->path_sistema . "/" . $filAr->nome_file_deploy . " -d " . $filAr->path_sistema . "/'";
        $killJava = "killall -9 java"; // matando os processos existentes do java
        $reiTomcat1 = "rm -rf " . $filAr->path_usuarios_servidor . "/work/* ";
        //$reiTomcat2 = "sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh";// reiniciando tomcat passo 2
        $reiTomcat2 = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh'";

        /*
         * Chamando o metodo para execução de comando no servidor remoto
         */
//        $servExec->executaCMD($rmOld);
//        $servExec->executaCMD($mvArquivos);
//        $servExec->executaCMD($mkdir);
//        $servExec->executaCMD($mvFileDepl);
//        shell_exec($unzip);
//        $servExec->executaCMD($killJava);
//        $servExec->executaCMD($reiTomcat1);
//        shell_exec($reiTomcat2);

        /*
         * Realizando alteração no banco do file_deploy (informando que o arquivo já foi feito o deploy)
         */
        $dat = date("Y-m-d");
        $hora = date("H:i:s");
        $fileSistema = $filAr->path_sistema . date("Ymd");
        $altFile = new ManipulateData();
        $altFile->setTable("file_deploy");
        $altFile->setCamposBanco("status_file_deploy='0',data_file_deploy='$dat',backup_sistema='$fileSistema',hora_deploy='$hora'"); // quando o status_reverter_deploy for igual a 1 significa que o deploy foi realizado e está habilitado pra fazer undeploy
        $altFile->setFieldId("id_file_deploy");
        $altFile->setValueId("$idFile");
        $altFile->update();


        // realizando o update no banco, registrando que o deploy foi realizado
        $upAgendamento = new ManipulateData();
        $upAgendamento->setTable("agendamento");
        $upAgendamento->setFieldId("id_file_deploy");
        $upAgendamento->setValueId("$idFile");
        $upAgendamento->setCamposBanco("status_agendamento='0'");
        $upAgendamento->update();
        shell_exec("echo 'Deploy realizado' > ~/logExecucao.log");
    }
} else {
    echo "Não existe nenhum agendamento\n";
    shell_exec("echo 'nenhum agendamento existente' > ~/logExecucao.log");
}