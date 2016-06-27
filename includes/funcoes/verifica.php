<?php

/*
 * Função que força a conexão HTTPS
 *
 * function ForceHTTPS() {
 * if ($_SERVER['HTTPS'] != "on") {
 *
 * $url = $_SERVER['SERVER_NAME'];
 *
 * $new_url = "https://" . $url . $_SERVER['REQUEST_URI'];
 * header("Location: $new_url");
 * exit;
 * }
 * }
 */
$versaoSist = "1.0.1";
if (! isset ( $_SESSION )) {
	session_start ();
}
if (! isset ( $_SESSION ["idSession"] )) {
	if (! isset ( $_SESSION ["erro"] )) {
		$_SESSION ["erro"] = "erro_sessao";
	}
	$smarty->assign ( 'logado', 'NAO' );
	$estaLogado = "NAO";
	$smarty->assign ( 'nivel', 'NI' );
	$local = 0;
} else {
	// autentica o usuario	
	$nivel = $_SESSION ['nivel'];
	$funcao = $_SESSION ['funcao'];
        $grupo = $_SESSION["grupo"];
	$smarty->assign ( "nomeUser", $_SESSION ["nome"]);
	$smarty->assign ( "nivel", $nivel );
	$smarty->assign ( "funcao", $funcao );
	$smarty->assign ( "versao", "$versaoSist" );
	$estaLogado = "SIM";
}

// se não existe nenhum usuario logado, manda para a tela de login
if ($estaLogado == "NAO") {
	// verifica se houve erro no login
	if ($_SESSION ["erro"] == "erro") {
		$smarty->assign ( "erro", "<div class='alert alert-danger' role='alert'>Usuario ou senha não correspondem</div>" );
	} else {
		$smarty->assign ( "erro", "&nbsp;" );
	}
	unset ( $_SESSION ["erro"] ); // destroi a session do erro
	                          // chama a tela de login caso não houver session estartada
	$smarty->assign ( "titulo", " - Login" );
	$smarty->assign ( "versao", "$versaoSist" );
	$smarty->assign ( "conteudoLogin", "login/login.tpl" );
	$smarty->display ( "HTMLogin.tpl" );
}