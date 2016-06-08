<?php


// arquivos de configuração inicial do Smarty config.php
// @author Álvaro Bacelar
// @date 14/09/2014
//$root = getcwd();
//die($root);
// hack para rodar em linux e windows
session_start();
define('SMARTY_DIR', str_replace("\\", "/", getcwd()) . '/lib/smarty/lib/');
define("TEMPLATE", "");
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = str_replace("\\", "/", getcwd()) . "/lib/smarty/templates/" . TEMPLATE;
$smarty->compile_dir = str_replace("\\", "/", getcwd()) . "/lib/smarty/templates_c/";
$smarty->config_dir = str_replace("\\", "/", getcwd()) . "/lib/smarty/setup/";
$smarty->cache_dir = str_replace("\\", "/", getcwd()) . "/lib/smarty/cache/";

//$smarty->debugging = true; // debug para possivel verificação


