<?php

require_once '../models/ManipulateData.php';

session_start();

// captando os dados do formulario
$idCidade = addslashes($_POST["inputIdEditarCidade"]);
$cidadeNome = addslashes($_POST["inputNomeCidade"]);
$ufCidade = addslashes($_POST["inputUf"]);
$obs = addslashes($_POST["textAreaObs"]);
$dataEdicao = date("Y-m-d");

if ($_SESSION["nivel"] == "admin" || $_SESSION["nivel"] == "gerente") {

    if ($cidadeNome != "" || $ufCidade != "") {

        $editaCidade = new ManipulateData();
        $editaCidade->setTable("cidade_atuante");
        $editaCidade->setCamposBanco("nome_cidade_atuante = '$cidadeNome', uf_cidade = '$ufCidade', obs_cidade_atuante = '$obs', qnt_carradas_cidade='$qntCarradasCidade', numero_rotas_cidade='$numeroRotasCidade', valor_estimado_cidade='$valorEstimadoCidade', valor_anual_cidade='$ValorAnualCidade',  data_edicao_cidade='$dataEdicao', usuario_edicao_cidade='$usuarioEdicao'");
        $editaCidade->setFieldId("id_cidade_atuante");
        $editaCidade->setValueId("$idCidade");
        $editaCidade->update();

        $_SESSION["erroCidade"] = "OK";
        header("location: ../../cidadesCadastradas.php");
    } else {
        $_SESSION["erroCidade"] = "erro";
        header("location: ../../cidadesCadastradas.php");
    }
} else {
    header("location: ../../accessDenied.php");
}