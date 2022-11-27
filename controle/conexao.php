<?php
define('HOST', '127.0.0.1');
define('USUARIO', 'Usuario oracle');
define('SENHA', 'sua senha');
define('DB', 'bdengcomp_low');

$conexao = oci_connect(USUARIO, SENHA, DB) or die ('Não foi possível conectar');


function confereSelect($c, $s){
    if (!$s) {
        $m = oci_error($c);
        trigger_error("Could not parse statement: ". $m["message"], E_USER_ERROR);
    }
    $r = oci_execute($s);
    if (!$r) {
        $m = oci_error($s);
        trigger_error("Could not execute statement: ". $m["message"], E_USER_ERROR);
    }
}

?>