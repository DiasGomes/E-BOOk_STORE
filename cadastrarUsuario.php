<?php
// Estabelece conexão
include "index.php";
$c = conecta();

// determina o comando SQL
$s = oci_parse($c, "INSERT INTO CLIENTE VALUES (:1, :2, :3, :4, :5)");

// não conseguiu compilar setença
if (!$s) {
    $m = oci_error($c);
    trigger_error("Não pôde compilar a sentença: ". $m["message"], E_USER_ERROR);
}

// determina os parâmetros da inserção
oci_bind_by_name($s, ":1", $_POST['nome']);
oci_bind_by_name($s, ":2", $_POST['sobrenome']);
oci_bind_by_name($s, ":3", $_POST['email']);
oci_bind_by_name($s, ":4", $_POST['saldo']);
oci_bind_by_name($s, ":5", $_POST['senha']);

// commit
oci_execute($s, OCI_NO_AUTO_COMMIT);
oci_commit($c);

//exibe
print "Cliente (".$_POST['nome']." ".$_POST['sobrenome']. ") inserido.";

?>
