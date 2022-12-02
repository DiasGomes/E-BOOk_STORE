<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['del_genero'])) {
    header('Location: ../genero.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "DELETE FROM genero WHERE genero = '".$_POST['del_genero']."'");

// não conseguiu compilar setença
if (!$s) {
    header('Location: ../genero.php');
	exit();
}

$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_delete'] = true;
	header('Location: ../genero.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['deletado'] = true;
header('Location: ../genero.php');
exit();

?>
