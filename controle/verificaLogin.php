<?php
session_start();
include('conexao.php');

if(empty($_POST['email']) || empty($_POST['senha'])) {
	header('Location: ../login.php');
	exit();
}

$usuario = $_POST['email'];
$senha = $_POST['senha'];

$query = "select * from cliente where EMAIL = '".$usuario."' and HASH_SENHA = '".$senha."'";

$result = oci_parse($conexao, $query);

oci_execute($result);
$row = oci_fetch_all($result, $res);

if($row == 1) {
	$_SESSION['usuario'] = $usuario;
	header('Location: ../acervo.php');
	exit();
} else {
    $_SESSION['nao_autenticado'] = true;
	header('Location: ../login.php');
	exit();
}

