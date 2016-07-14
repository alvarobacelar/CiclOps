<?php

class ExecSSH {

    private $arquivoLocal, $arquivoRemoto, $erro, $ssh;

    function setArquivoLocal($al) {
        $this->arquivoLocal = $al;
    }

    function setArquivoRemoto($ar) {
        $this->arquivoRemoto = $ar;
    }

    function getErro() {
        return $this->erro;
    }

    /*
     * Função para realizar autenticação no servidor
     */

    function __construct($host, $user, $pass, $port) {
        /* Faz a conexão com o servidor remoto */
        $this->ssh = ssh2_connect($host, $port);

        /* Faz a autenticação no servidor remoto */
        ssh2_auth_password($this->ssh, $user, $pass);
    }

    /*
     * Função para criar diretório
     */

    function criarDiretorio() {
        /* Cria um diretório de backup se não existir */
        if (!ssh2_sftp_mkdir($ssh, '/home/dolphin/backups')) {
            $this->erro = "Diretório já existe...\n";
            return false;
        }
    }

    /*
     * Função para enviar o aquivo de backup
     */

    function enviaArquivo() {
        return ssh2_scp_send($this->ssh, "$this->arquivoLocal", "$this->arquivoRemoto", 0777);
    }

    function executaCMD($cmd) {
        return ssh2_exec($this->ssh, $cmd);
    }

    function shell($sh) {
        if (ssh2_shell($this->ssh, $sh)) {
            return true;
        } else {
            return false;
        }
    }

}
