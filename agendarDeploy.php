<?php

require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';
require_once './includes/classes/execSSH.php';

if ($estaLogado == "SIM") {

    if (isset($_POST["inputTimeAgendar"])) {
        $idFile = addslashes($_POST["idFile"]);
        $idUsuarioFileDeploy = addslashes($_POST["idUserFileDeploy"]);
        $idSistema = addslashes($_POST["idSistema"]);
        $idUsuarioServidor = addslashes($_POST["idUserServidor"]);
        $idServidor = addslashes($_POST["idServidor"]);
        $dataTime = addslashes($_POST["inputTimeAgendar"]);
        $statusAgendamento = 1; // quando o valor for atribuido a 1 significa que foi agendado mas ainda não foi executado o deploy, somente quando for 0 é que o deploy foi executado

        $buscaFileAgenda = new ManipulateData();
        $buscaFileAgenda->setTable("agendamento");
        $buscaFileAgenda->setFieldId("id_file_deploy");
        $buscaFileAgenda->setValueId($idFile);
        $buscaFileAgenda->selectAlterar();

        if ($buscaFileAgenda->registros_retornados() >= 1) {
            $_SESSION["erroFile"] = "naoAgenda";
            header("Location: historicoDeploy.php");
        } else {

            $agendaDeploy = new ManipulateData();
            $dataTimeAgendamento = $agendaDeploy->soNumero($dataTime);

            $cmdAtAgendamento = "at -f " . PATH_SISTEMA . "execShellAgendamento.php -t " . $dataTimeAgendamento;

            shell_exec($cmdAtAgendamento);

            $fileSistema = $filAr->path_sistema . date("Ymd");
            $altFile = new ManipulateData();
            $altFile->setTable("file_deploy");
            $altFile->setCamposBanco("status_file_deploy='3'"); // quando o status_reverter_deploy for igual a 3 significa que existe um agendamento
            $altFile->setFieldId("id_file_deploy");
            $altFile->setValueId("$idFile");
            $altFile->update();

            $agendaDeploy->setTable("agendamento");
            $agendaDeploy->setCamposBanco("id_file_deploy, id_usuario_file_deploy, id_sistema, id_usuarios_servidor, id_servidor, data_hora_agendamento, status_agendamento");
            $agendaDeploy->setDados("'$idFile', '$idUsuarioFileDeploy', '$idSistema', '$idUsuarioServidor', '$idServidor', '$dataTimeAgendamento', $statusAgendamento");
            $agendaDeploy->insert();

            $_SESSION["erroFile"] = "agenda";
            header("Location: historicoDeploy.php");
        }
    }
}
