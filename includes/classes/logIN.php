<?php

/*
 * Classe de autenticação de usuario ao sistema
 * Data Criação: 26/06/2013
 * Versao 1.0
 */

/**
 * Classe usada pelo o model para autenticar o usuario
 *
 * @author Alvaro
 */
class LoginIn {

    // FUNCAO DE AUTENTICAÇÃO DO USUARIO
    function autentica($login, $senha) {

        // CRIANDO UM ARRAY COM OS NIVEIS DE USUARIO
        $funcao[0] = "admin";
        $funcao[1] = "dev";
        $funcao[2] = "coor";
        $funcao[3] = "suporte";
        $fun_max = 3;

        $senhaCrip = md5($senha); // criptografando a senha de login

        $db = new ManipulateData();

        $db->setTable("usuario");
        $db->login($login, $senhaCrip); // VERIFICANDO SE EXISTE USUARIO CADASTRADO NO SISTEMA


        if ($db->registros_retornados()) {

            $obj = $db->fetch_object();
            $session_id = md5(time() . $obj->id_usuario);
            $_SESSION["idSession"] = $session_id;
            $_SESSION["login"] = $obj->login_usuario;
            $_SESSION["nome"] = $obj->nome_usuario;           
            $_SESSION["funcao"] = $obj->funcao_usuario;
            $_SESSION["usuarioID"] = $obj->id_usuario;
            $id = $_SESSION["usuarioID"];

            if ($id != 4) {
                $this->logAcesso($obj->id_usuario,$obj->id_grupo_servidor); // chamando a funcao de registro de logs de acesso ao sistema
            }

            if ($fun_max > 4) {
                $_SESSION["nivel"] = "Não identificado";
            } else {
                if ($obj->nivel_usuario == 4) {
                    $_SESSION["nivel"] = $funcao[$obj->nivel_usuario];
                    $_SESSION['nivelUser'] = "OK";
                } else {
                    $_SESSION["nivel"] = $funcao[$obj->nivel_usuario];
                    $_SESSION['nivelUser'] = "NAO";
                }
            }
            $data = date("Y-m-d");
            $hora = date("H:i:s");
            $ip = $_SERVER["REMOTE_ADDR"];

            header("location: ./");
            exit;
        } else {

            $this->logAcesso(1, null, "Tentativa de acesso com o usuário: <strong>$login</strong> e Senha: <strong>$senha</strong>");

            $_SESSION["erro"] = "erro";
            header("location: ./");
            exit;
        }
    }

    //funcao para registrar log de acesso
    public function logAcesso($id,$idGrupo, $obs = "Usuário registrado") {
        $data = date('Y-m-d H:i:s');

        if ($id != "alvaro") {

            $ip = $_SERVER["REMOTE_ADDR"];
            $log = new ManipulateData();
            $log->setTable("log_usuario");
            $log->setCamposBanco("id_usuario_log,id_grupo_log,data,obs_log_usuario,ip_acesso_log");
            $log->setDados("'$id','$idGrupo','$data','$obs','$ip'");
            $log->insert();
        }
    }

}
