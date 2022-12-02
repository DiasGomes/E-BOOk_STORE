<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['del_editora'])) {
    header('Location: ../editora.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "DELETE FROM editora WHERE id_editora = '".$_POST['del_editora']."'");

// não conseguiu compilar setença
if (!$s) {
    header('Location: ../editora.php');
	exit();
}

$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_delete'] = true;
	header('Location: ../editora.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['deletado'] = true;
header('Location: ../editora.php');
exit();

?>
