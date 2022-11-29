<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['editora_id']) || empty($_POST['editora_nome'])) {
    $_SESSION['nao_cadastrado'] = true;
	header('Location: ../editora.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "INSERT INTO EDITORA VALUES (:1, :2)");

// não conseguiu compilar setença
if (!$s) {
    $_SESSION['erro_setenca'] = true;
	header('Location: ../editora.php');
	exit();
}

// determina os parâmetros da inserção
oci_bind_by_name($s, ":1", $_POST['editora_id']);
oci_bind_by_name($s, ":2", $_POST['editora_nome']);


$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_query'] = true;
	header('Location: ../editora.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['cadastrado'] = true;
header('Location: ../editora.php');
exit();

?>
