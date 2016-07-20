<?php
require_once './includes/classes/execSSH.php';

$newServer = new ExecSSH("10.0.0.11", "dolphin", "rootinfoway", "22");
//$newServer->setArquivoLocal("/home/infoway/logUniplam.log");
//$newServer->setArquivoRemoto("/home/dolphin/testeEnvioSSH.log");
$exec = $newServer->executaCMD("mkdir /home/dolphin/testeExecPHP");

if ($exec){
    echo "Pasta criada com sucesso";
} else {
    echo "Houve um erro ao criar uma pasta";
}

//if ($newServer->executaCMD("cat /etc/passwd")){
//    
//}
//
//die();
//if ($newServer->getErro()){
//    
//} else {
//    echo $newServer->getErro();
//}