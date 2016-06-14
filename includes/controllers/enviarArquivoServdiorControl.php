<?php

require_once '../models/ManipulateData.php';

session_start();

if ($_SESSION["nivel"] == "admin" || $_SESSION["nivel"] == "dev") {

    $servidor = addslashes($_POST["servidor"]);
    $sistema = addslashes($_POST["sistema"]);
    $versao = addslashes($_POST["versaoArquivo"]);
    $userSistema = addslashes($_POST["userSistema"]);
    $idUsuario = addslashes($_SESSION["usuarioID"]);
    $obs = addslashes($_POST["textObsFile"]);
    $data = date("Y-m-d");
    $status = "1";

########################################################################
################ FAZENDO O UPLOAD DE ARQUIVO WAR ######################
########################################################################
//Filedata é a variável que o flex envia com o arquivo para upload
    $file = $_FILES['fileWar'];

    if (!empty($file)) {
// Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = '../../arquivos/';

// Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 200; // 2Mb
// Array com as extensões permitidas
        $_UP['extensoes'] = array('war');

        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = true;

        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
   

        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['fileWar']['error'] != 0) {
            $_SESSION["erroFile"] = "erro";
            header("location: ../../enviarArquivoServidor.php?servidor=" . $servidor . "&sistema=" . $sistema);
            exit();
        }

        // Caso script chegue a este ponto, não houve erro com o processo de  upload e o PHP pode continuar
        // Faz a verificação da extensão do arquivo
        $arquivo = $_FILES['fileWar']['name'];

        $extensao = substr($arquivo, - 3);

        if (array_search($extensao, $_UP['extensoes']) === false) {
            //echo "Por favor, envie arquivos com as seguintes extensões: jpg ou JPEG";
            $_SESSION["erroFile"] = "extensao";
            header("location: ../../enviarArquivoServidor.php?servidor=" . $servidor . "&sistema=" . $sistema);
            exit();
        }

        // Faz a verificação do tamanho do arquivo enviado
        else if ($_UP['tamanho'] < $_FILES['fileWar'] ['size']) {
            //echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
            $_SESSION["erroFile"] = "tamanho";
            header("location: ../../cenviarArquivoServidor.php?servidor=" . $servidor . "&sistema=" . $sistema);
            exit();
        }

        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
        else {
            // Primeiro verifica se deve trocar o nome do arquivo
            // Cria um nome baseado no UNIX TIMESTAMP atual e comextensão .jpg
            $nome_final = "serv-id-" . $servidor . "-v" . $versao . "." . "$extensao";

// Depois verifica se é possível mover o arquivo para a pasta escolhida
            if (move_uploaded_file($_FILES['fileWar'] ['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
//echo '<br /><a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>;
                $fileWar = $nome_final;
                
            } else {
                $_SESSION["erroFile"] = "erroUpload";
                header("location: ../../enviarArquivoServidor.php?servidor=" . $servidor . "&sistema=" . $sistema);
                exit();
            }
        }
########################################################################
######################## FIM DA FUNÇÃO DE UPLOAD #######################
########################################################################
    }

    if (!empty($fileWar)) {

        $cadastraFile = new ManipulateData();
        $cadastraFile->setTable("file_deploy");
        $cadastraFile->setCamposBanco("id_usuario_file_deploy,id_sistema,id_usuarios_servidor,id_servidor,nome_file_deploy,data_file_deploy,status_file_deploy,obs_file_deploy,nome_original_file");
        $cadastraFile->setDados("'$idUsuario','$sistema','$userSistema','$servidor','$fileWar','$data','$status','$obs','$arquivo'");
        $cadastraFile->insert();
        
        $_SESSION["erroFile"] = "cadastrado";
        header("Location: ../../iniciarDeploy.php?idFile=".$cadastraFile->getInsertID());
    } else {
        header("Location: ../../erro.php");
    }
} else {
    header("location: ../../accessDenied.php");
}