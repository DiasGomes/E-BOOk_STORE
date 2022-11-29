<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['id']) || empty($_POST['titulo']) || empty($_POST['edicao']) || empty($_POST['data']) || empty($_POST['preco']) || empty($_POST['editora']) || empty($_POST['arquivo'])) {
    $_SESSION['nao_cadastrado'] = true;
	header('Location: ../livro.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "INSERT INTO E_BOOK VALUES (:1, :2, :3, :4, :5, :6, :7, :8, :9, :10)");

// não conseguiu compilar setença
if (!$s) {
    $_SESSION['erro_setenca'] = true;
	header('Location: ../livro.php');
	exit();
}
/*
$queryID = "select MAX(ID_EBOOK) MAXIMO, titulo from E_BOOK";
$maxID = oci_parse($conexao, $queryID);
oci_execute($maxID);
 */

// determina os parâmetros da inserção
oci_bind_by_name($s, ":1", $_POST['id']);
oci_bind_by_name($s, ":2", $_POST['titulo']);
oci_bind_by_name($s, ":3", $_POST['edicao']);
oci_bind_by_name($s, ":4", $_POST['data']);
oci_bind_by_name($s, ":5", $_POST['preco']);
oci_bind_by_name($s, ":6", $_POST['arquivo']);
oci_bind_by_name($s, ":7", $_POST['editora']);
// Numero_compras, Num_avaliacoes e Soma_avaliacoes tem de ser zero para um livro recém inserido
$zero=0;
oci_bind_by_name($s, ":8", $zero);
oci_bind_by_name($s, ":9", $zero);
oci_bind_by_name($s, ":10", $zero);

// commit
$r = oci_execute($s, OCI_NO_AUTO_COMMIT);
oci_commit($conexao);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_query'] = true;
	header('Location: ../livro.php');
	exit();
}

//exibe
$_SESSION['cadastrado'] = true;
header('Location: ../livro.php');
exit();

?>
