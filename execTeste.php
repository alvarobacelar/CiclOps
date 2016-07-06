<?php
require_once './includes/classes/execSSH.php';

$newServer = new ExecSSH("10.0.0.11", "dolphin", "rootinfoway", "22");
$newServer->setArquivoLocal("/home/infoway/logUniplam.log");
$newServer->setArquivoRemoto("/home/dolphin/testeEnvioSSH.log");
$newServer->enviaArquivo();

if ($newServer->getErro()){
    echo "Arquivo enviado";
} else {
    echo $newServer->getErro();
}