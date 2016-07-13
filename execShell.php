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

    if (isset($_POST["fileOk"])) {

        $idFile = addslashes($_POST["fileOk"]);

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
        $unzip = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'unzip ". $filAr->path_sistema . "/" . $filAr->nome_file_deploy . " -d " . $filAr->path_sistema . "/'";
        $killJava = "killall -9 java"; // matando os processos existentes do java
        $reiTomcat1 = "rm -rf " . $filAr->path_usuarios_servidor . "/work/* ";        
        //$reiTomcat2 = "sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh";// reiniciando tomcat passo 2
        $reiTomcat2 = "ssh -p " . $filAr->porta_servidor . " " . $filAr->nome_usuarios_servidor . "@" . $filAr->ip_servidor . " 'sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh'";
        
        $rmFileLocal = "rm -rf " . PATH_ARQUIVOS . $filAr->nome_file_deploy;
        
        /*
         * Chamando o metodo para execução de comando no servidor remoto
         */
        if ($servExec->executaCMD($rmOld)){
            echo "1 - Removido os arquivos mais antigos do servidor<br>";
        } else {
            echo "Erro ao remover os arquivos antigos";
        }
        if ($servExec->executaCMD($mvArquivos)){
            echo "2 - Pasta antiga movida<br>";
        } else {
            echo "Erro ao realizar backup da pasta antiga do sistema";
        }
        if ($servExec->executaCMD($mkdir)){
            echo "3 - Criado uma nova pasta para por o arquivo war<br>";
        } else {
            echo "Erro ao criar a pasta";
        }
        if ($servExec->executaCMD($mvFileDepl)){
            echo "4 - Movido  o arquivo war para a pasta criada<br>";
        } else {
            echo "Erro ao remover os arquivos antigos";
        }
//        if ($servExec->executaCMD($unzip)){
//            echo "5 - Descompactado o arquivo War<br>";
//        } else {
//            echo "Erro ao remover os arquivos antigos";
//        }
        displaysecinfo("5 - Descompactando o arquivo: ", shell_exec($unzip));
        
        if ($servExec->executaCMD($killJava)){
            echo "6 - Sistema parado<br>";
        } else {
            echo "Erro ao parar o processo do sistema java";
        }
        if ($servExec->executaCMD($reiTomcat1)){
            echo "7 - Limpado o diretorio work<br>";
        } else {
            echo "Erro ao limpar o diretório work";
        }
       displaysecinfo("3 - Iniciando o tomcat <br> ", shell_exec($reiTomcat2));
        
        $servExec->executaCMD($rmFileLocal);
        
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
    } else {
        header("Location: realizarDeploy.php");
    }
}
