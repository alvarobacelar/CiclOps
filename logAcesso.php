<?php
/*
 *  Arquivo de registro de logins dos usuários
 * @author Álvaro Bacelar
 * @date 06/05/2016
 */
require_once './lib/smarty/config/config.php';
require_once './includes/funcoes/verifica.php';
require_once './includes/models/ManipulateData.php';
require_once './includes/classes/Pagination.php';

if ($estaLogado == "SIM" && !isset($active)) {
    if ($_SESSION["nivel"] == "admin") { // se o usuário logado fo administrador, mostra a página
          
        // ########### Inicio da PAGINAÇÃO #############//
        $paginacao = new ManipulateData();
        $paginacao->setTable("log_usuario");
        if (isset($_GET["pg"])) { // se exitir uma variavel na URL é setado para a paginação
            $pg = $_GET["pg"];
        } else {
            $pg = 1;
        }
        $quantLog = 20;// Quantidade de chamado por pagina
        $inicio = ($pg * $quantLog) - $quantLog; // Definindo o inicio da paginação
        // ######### FIM DA PAGINAÇÃO ###########// 
        
        $log = new ManipulateData();
        $log->setTable("log_usuario, usuario");
        $log->setOrderTable("id_log_usuario DESC LIMIT $inicio, $quantLog"); // selecionando pipeiros dentro da paginação
        $pagina = new Pagination($pg, $quantLog, $paginacao->countTotal());
        
        $log->selectLogAcesso();
       
        
        while ($logAcesso[] = $log->fetch_object()){
            $smarty->assign("log", $logAcesso);
        }
        $smarty->assign("paginacao", $pagina->paginacao());
        
        $smarty->assign("conteudo", "paginas/logAcesso.tpl");
        $smarty->display("HTML.tpl");
    } else {
        header("location: ./accessDenied.php");
    }
}