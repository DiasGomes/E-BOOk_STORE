<?php
session_start();
// Estabelece conexão
include "conexao.php";

// recebe o maior id e define o proximo 
$queryMax = "select max(ID_AUTOR) MAXIMO from autor";
$resultMax = oci_parse($conexao, $queryMax);
oci_execute($resultMax);
$idMax = oci_fetch_array($resultMax, OCI_ASSOC+OCI_RETURN_NULLS);
$id = $idMax['MAXIMO'] + 1;;
echo $id;

if(empty($_POST['autor_sobrenome']) || empty($_POST['autor_nome'])) {
    $_SESSION['nao_cadastrado'] = true;
	header('Location: ../autor.php');
	exit();
}

// determina o comando SQL
$s = oci_parse($conexao, "INSERT INTO AUTOR VALUES (:1, :2, :3)");

// não conseguiu compilar setença
if (!$s) {
    $_SESSION['erro_setenca'] = true;
	header('Location: ../autor.php');
	exit();
}

// determina os parâmetros da inserção
oci_bind_by_name($s, ":1", $id);
oci_bind_by_name($s, ":2", $_POST['autor_nome']);
oci_bind_by_name($s, ":3", $_POST['autor_sobrenome']);


$r = oci_execute($s, OCI_NO_AUTO_COMMIT);

// não conseguiu inserir os valores
if (!$r) {
    $_SESSION['erro_query'] = true;
	header('Location: ../autor.php');
	exit();
}

// commit
oci_commit($conexao);

//exibe
$_SESSION['cadastrado'] = true;
header('Location: ../autor.php');
exit();

?>
