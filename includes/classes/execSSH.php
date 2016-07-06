<?php

class ExecSSH {

    private $serverHost, $serverUser, $serverPass, $arquivoLocal, $arquivoRemoto, $serverPort, $erro, $ssh;

    function setServerHost($s) {
        $this->serverHost = $s;
    }

    function setServerUser($u) {
        $this->serverUser = $u;
    }

    function setServerPass($p) {
        $this->serverPass = $p;
    }

    function setArquivoLocal($al) {
        $this->arquivoLocal = $al;
    }

    function setArquivoRemoto($ar) {
        $this->arquivoRemoto = $ar;
    }

    function setServerPort($po) {
        $this->serverPort = $po;
    }

    function getErro() {
        return $this->erro;
    }

    /*
     * Função para realizar autenticação no servidor
     */

    function __construct($host,$user,$pass,$port) {
        /* Faz a conexão com o servidor remoto */
        if (!$this->ssh = ssh2_connect($host, $port)) {
            $this->erro = "Erro ao se conectar com o servidor...\n";
            return false;
        }
        /* Faz a autenticação no servidor remoto */
        if (!ssh2_auth_password($this->ssh, $user, $pass)) {
            $this->erro = "Erro ao efetuar autenticação no servidor remoto...\n";
            return false;
        }
    }
    
    /*
     * Função para criar diretório
     */
    function criarDiretorio(){
        /* Cria um diretório de backup se não existir */
        if (!ssh2_sftp_mkdir($ssh, '/home/dolphin/backups')) {
            $this->erro = "Diretório já existe...\n";
            return false;
        } else {
            return true;
        }
    }

    /*
     * Função para enviar o aquivo de backup
     */
    function enviaArquivo() {
        
        if (!ssh2_scp_send($this->ssh, $this->arquivoLocal, $this->arquivoRemoto, 0644)) {
            $this->erro = "Erro ao enviar o arquivo para o servidor ...\n";
            return false;
        } else {
            return true;
        }
    }
}
