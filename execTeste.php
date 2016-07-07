<?php
require_once './includes/classes/execSSH.php';

$newServer = new ExecSSH("10.0.0.11", "root", "root!@#1nf0", "22");
$newServer->setArquivoLocal("/home/infoway/logUniplam.log");
$newServer->setArquivoRemoto("/home/dolphin/testeEnvioSSH.log");
echo $newServer->executaCMD("cat /etc/passwd");

die();
if ($newServer->getErro()){
    
} else {
    echo $newServer->getErro();
}