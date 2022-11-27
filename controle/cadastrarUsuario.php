<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['email']) || empty($_POST['sobrenome']) || empty($_POST['nome']) || empty($_POST['senha']) || empty($_POST['saldo'])) {
    $_SESSION['nao_cadastrado'] = true;
	header('Location: ../cadastro.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "INSERT INTO CLIENTE VALUES (:1, :2, :3, :4, :5)");

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
oci_commit($conexao);

//exibe
$_SESSION['cadastrado'] = true;
header('Location: ../cadastro.php');
exit();

?>
