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

    if (isset($_POST["tomcatSistema"])) {

        $sistemaTomcat = addslashes($_POST["tomcatSistema"]);

        // realizando a busca no servidor do arquivo enviado
        $buscaFile = new ManipulateData();
        $buscaFile->setTable("file_deploy,sistema,usuarios_servidor,servidor");
        $buscaFile->setFieldId("sistema.id_sistema");
        $buscaFile->setValueId("$sistemaTomcat");
        $buscaFile->selectReiniciar();
        $filAr = $buscaFile->fetch_object();

        // realizando conexão com o servidor via ssh2
        $servExec = new ExecSSH($filAr->ip_servidor, $filAr->nome_usuarios_servidor, $filAr->senha_usuario_servidor, $filAr->porta_servidor);

        /*
         * DEFININDO AS VARIÁVEIS COM OS COMANDOS DE ENVIO DE ARQUIVO E EXECUÇÃO DO DEPLOY
         */
        $killJava = "killall -9 java";
        // reiniciando o tomcat passo 1
        $reiTomcat1 = "rm -rf " . $filAr->path_usuarios_servidor . "/work/* ";
        // reiniciando tomcat passo 2
        $reiTomcat2 = "sh " . $filAr->path_usuarios_servidor . "/bin/startup.sh";//    
        /*
         * EXECUÇÃO DOS COMANDOS ACIMA SETADOS
         */
        if ($servExec->executaCMD($killJava)) {
            echo "1 - Sistema parado<br>";
        } else {
            echo "Erro ao parar o processo do sistema java";
        }
        if ($servExec->executaCMD($reiTomcat1)) {
            echo "2 - Diretorio work limpado<br>";
        } else {
            echo "Erro ao limpar o diretório work";
        }
        if ($servExec->executaCMD($reiTomcat2)) {
            echo "3 - <strong>Tomcat iniciado</strong><br>";
        } else {
            echo "Erro ao levantar o sistema";
        }

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
