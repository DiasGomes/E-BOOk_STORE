<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['preco']) || empty($_POST['livro'])) {
    $_SESSION['nao_atualizado'] = true;
	header('Location: ../preco.php');
	exit();
}else{
    // atualiza dados
    $query = "UPDATE E_BOOK SET PRECO=".$_POST['preco']." WHERE ID_EBOOK ='".$_POST['livro']."'";

    $result = oci_parse($conexao, $query);

    if (!$result) {
        $_SESSION['erro_setenca'] = true;
        header('Location: ../preco.php');
        exit();
    }

    // não conseguiu compilar setença
    if (!$result) {
        $m = oci_error($conexao);
        trigger_error("Não pôde compilar a sentença: ". $m["message"], E_USER_ERROR);
    }

    // commit
    $r = oci_execute($result, OCI_NO_AUTO_COMMIT);

    if (!$r) {
        $_SESSION['erro_query'] = true;
        header('Location: ../preco.php');
        exit();
    }
    oci_commit($conexao);

    $_SESSION['atualizado'] = true;
    header('Location: ../preco.php');
    exit();

}

?>
