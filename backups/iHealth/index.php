<?php

//require_once '../../lib/smarty/config/config.php';
//require_once '../../includes/funcoes/verifica.php';
require_once '../../includes/models/ManipulateData.php';



//    $grupLogado = $grupo;
//
//    $buscaGrupoBackup = new ManipulateData();
//    $buscaGrupoBackup->setTable("grupo_servidor");
//    $buscaGrupoBackup->setFieldId("id_grupo_servidor");
//    $buscaGrupoBackup->setValueId($grupLogado);
//    $buscaGrupoBackup->selectAlterar();
//    $nomeGrupo = $buscaGrupoBackup->fetch_object();
//    /*
//     * Se o grupo for infra, mostratudo, senão mostra somente a pasta correspondente.
//     */
//    if ($nomeGrupo->nome_grupo_servidor == "Infraestrutura") {
//        $path = "backups/";
//    } else {
//        $path = "backups/" . $nomeGrupo->nome_grupo_servidor . "/";
//    }
//  
    $path = "./";
    $diretorio = dir($path);

    echo "Lista de Arquivos do diretório '<strong>" . $path . "</strong>':<br />";
    while ($arquivo = $diretorio->read()) {
        echo "<a href='" . $path . $arquivo . "'>" . $arquivo . "</a><br />";
    }
    $diretorio->close();


//    $smarty->assign("conteudo", "paginas/filesBackups.tpl");
//    $smarty->display("HTML.tpl");
//
//    $diretorio->close();

