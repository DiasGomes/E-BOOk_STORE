<?php

// Estabelece conexão
include "index.php";
$c = conecta();

// faz a busca pela senha do usuário
$s = oci_parse($c, "SELECT hash_senha FROM CLIENTE where email='".$_POST['email']."'");
if (!$s) {
    $m = oci_error($c);
    trigger_error("Could not parse statement: ". $m["message"], E_USER_ERROR);
}
$r = oci_execute($s);
if (!$r) {
    $m = oci_error($s);
    trigger_error("Could not execute statement: ". $m["message"], E_USER_ERROR);
}

// confere se a senha do usuário está correta 
$row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS);
if ($row['HASH_SENHA'] == $_POST['senha']){
    print("senha corrta");
}else{
    print("senha incorrta\n");
    print($row['HASH_SENHA']);print("!=");print($_POST['senha']);
}

?>

