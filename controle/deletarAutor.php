<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['del_autor'])) {
    header('Location: ../autor.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "DELETE FROM autor WHERE id_autor = '".$_POST['del_autor']."'");

// não conseguiu compilar setença
if (!$s) {
    header('Location: ../autor.php');
	exit();
}

$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_delete'] = true;
	header('Location: ../autor.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['deletado'] = true;
header('Location: ../autor.php');
exit();

?>
