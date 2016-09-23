<?php

require_once './includes/classes/execSSH.php';

$vLog = "cat /opt/apache-tomcat-5.5.36-ipmt/log/catalina.out"

echo '<pre>';

// Mostra todo o resultado do comando do shell "ls", e retorna
// a última linha da saída em $last_line. Guarda o valor de retorno
// do comando shell em $retval.
$last_line = system('tail', $vLog);

// Mostrando informação adicional
echo '
</pre>
<hr />Última linha da saída: '.$last_line.'
<hr />Valor de Retorno: '.$vLog;
//if ($newServer->executaCMD("cat /etc/passwd")){
//
//}
//
//die();
//if ($newServer->getErro()){
//
//} else {
//    echo $newServer->getErro();
//}
