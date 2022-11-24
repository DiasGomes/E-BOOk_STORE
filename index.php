<?php

// arquvivo para colocar funções gearis

// conecta ao servidor da oracle
function conecta(){
    $c =  oci_connect("seu usuário oracle", "sua senha", "bdengcomp_low");
    // Se não conseguiu estabelecer conexão
    if (!$c) {
        $m = oci_error();
        trigger_error("Could not connect to database: ". $m["message"], E_USER_ERROR);
    }
    return $c;
}

?>