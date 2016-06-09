<?php
/*
 *  Arquivo de deploy
 * @author Álvaro Bacelar
 * @date 09/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/funcoes/exeCmdShel.php';

if ($estaLogado == "SIM"){
    
    if ($nivel != "admin"){
        $buscaGrupoServer = new ManipulateData();
        $buscaGrupoServer->setTable("servidor");
        $buscaGrupoServer->setFieldId("id_grupo_servidor");
        $buscaGrupoServer->setValueId("$grupo");
        $buscaGrupoServer->selectAlterar();
        while ($resultadoServ[] = $buscaGrupoServer->fetch_object()){
            $smarty->assign("servidoresGrupo", $resultadoServ);
        }
        
    } else {
        
    }
    
    $smarty->assign("conteudo", "paginas/realizarDeploy.tpl");
    $smarty->display("HTML.tpl");
}
