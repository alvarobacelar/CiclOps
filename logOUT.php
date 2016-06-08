<?php
/*
 * Arquivo para destruir todas as sessions criadas
 * Deslogando usuário
 */

session_start();
session_destroy(); // destroi todas as sessions criadas
header("Location: ./");