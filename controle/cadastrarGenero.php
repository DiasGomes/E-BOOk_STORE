<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['genero_nome'])) {
    $_SESSION['nao_cadastrado'] = true;
	header('Location: ../genero.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "INSERT INTO GENERO VALUES (:1)");

// não conseguiu compilar setença
if (!$s) {
    $_SESSION['erro_setenca'] = true;
	header('Location: ../genero.php');
	exit();
}

// determina os parâmetros da inserção
oci_bind_by_name($s, ":1", $_POST['genero_nome']);


$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_query'] = true;
	header('Location: ../genero.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['cadastrado'] = true;
header('Location: ../genero.php');
exit();

?>
