<?php
session_start();
// Estabelece conexão
include "conexao.php";

// determina o comando SQL
$s = oci_parse($conexao, "INSERT INTO AQUISICAO VALUES (:1, :2, :3, :4)");

// não conseguiu compilar setença
if (!$s) {
    $_SESSION['erro_setenca'] = true;
	header('Location: ../acervo.php');
	exit();
}

// recebe a data atual
$data = date('d/M/y');

// determina os parâmetros da inserção
oci_bind_by_name($s, ":1", $_SESSION['usuario']);
oci_bind_by_name($s, ":2", $_POST['id']);
oci_bind_by_name($s, ":3", $data);
oci_bind_by_name($s, ":4", $_POST['preco']);

$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['nao_comprado'] = true;
	header('Location: ../acervo.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['comprado'] = true;
header('Location: ../acervo.php');
exit();

?>
