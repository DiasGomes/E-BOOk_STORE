<?php
session_start();
// Estabelece conexão
include "conexao.php";

$queryExiste = "select nota,comentario from avaliacao where EMAIL_CLIENTE='".$_SESSION['usuario']."' and id_ebook=". $_POST['id'];

$existe = oci_parse($conexao, $queryExiste);

oci_execute($existe);
$av = oci_fetch_all($existe, $res);

if($av == 1) {
    // se já avaliou o livro
	// atualiza dados
    $comentario = $queryExiste['COMENTARIO'];
    if(!empty($_POST['comentario'])){
        $comentario = $_POST['comentario'];
    }
    
    $query = "UPDATE avaliacao SET NOTA=".$_POST['nota'].", COMENTARIO='".$comentario."'
    where EMAIL_CLIENTE='".$_SESSION['usuario']."' and id_ebook=". $_POST['id'];

    $result = oci_parse($conexao, $query);

    // não conseguiu compilar setença
    if (!$result) {
        $m = oci_error($conexao);
        trigger_error("Não pôde compilar a sentença: ". $m["message"], E_USER_ERROR);
    }

    // commit
    oci_execute($result, OCI_NO_AUTO_COMMIT);
    oci_commit($conexao);
	header('Location: ../compras.php');
	exit();
} else {
    // Se nunca avaliou este livro
    $s = oci_parse($conexao, "INSERT INTO AVALIACAO VALUES (:1, :2, :3, :4)");

    // não conseguiu compilar setença
    if (!$s) {
        $_SESSION['erro_setenca'] = true;
        header('Location: ../compras.php');
        exit();
    }

    // determina os parâmetros da inserção
    oci_bind_by_name($s, ":1", $_SESSION['usuario']);
    oci_bind_by_name($s, ":2", $_POST['id']);
    oci_bind_by_name($s, ":3", $_POST['nota']);
    oci_bind_by_name($s, ":4", $_POST['comentario']);


    $r = oci_execute($s, OCI_NO_AUTO_COMMIT);

    // não conseguiu inserir os valores
    if (!$r) {
        $m = oci_error($conexao);
        trigger_error("Não pôde compilar a sentença: ". $m["message"], E_USER_ERROR);
    }

    // commit
    oci_commit($conexao);
    header('Location: ../compras.php');
}

?>
