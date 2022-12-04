<?php
session_start();
// Estabelece conexão
include "conexao.php";

if(empty($_POST['sobrenome']) && empty($_POST['nome']) && empty($_POST['senha']) && empty($_POST['dinheiro'])) {
    $_SESSION['nao_atualizado'] = true;
	header('Location: ../perfil.php');
	exit();
}else{
    $querySelect = "select * from cliente where EMAIL = '".$_SESSION['usuario']."'";
    $campos = oci_parse($conexao, $querySelect);
    oci_execute($campos);
    $row = oci_fetch_array($campos, OCI_ASSOC+OCI_RETURN_NULLS);
    
    // define saldo
    if(empty($_POST['dinheiro'])){
        $_POST['dinheiro'] = 0;
    }
    $saldo=$row['SALDO'] + $_POST['dinheiro'];
    
    

    // define nome
    if(empty($_POST['nome'])){
        $nome = $row['PRIMEIRO_NOME'];
    }else{
        $nome = $_POST['nome'];
    }

    // define sobrenome
    if(empty($_POST['sobrenome'])){
        $sobrenome = $row['SEGUNDO_NOME'];
    }else{
        $sobrenome = $_POST['sobrenome'];
    }

    // define senha
    if(empty($_POST['senha'])){
        $senha = $row['HASH_SENHA'];
    }else{
        $senha = $_POST['senha'];
    }

    // atualiza dados
    $query = "UPDATE CLIENTE SET PRIMEIRO_NOME='".$nome."', HASH_SENHA='".$senha."',  SEGUNDO_NOME='".$sobrenome."', SALDO=".$saldo." WHERE EMAIL ='".$_SESSION['usuario']."'";

    $result = oci_parse($conexao, $query);

    // não conseguiu compilar setença
    if (!$result) {
        $m = oci_error($conexao);
        trigger_error("Não pôde compilar a sentença: ". $m["message"], E_USER_ERROR);
    }

    // commit
    oci_execute($result, OCI_NO_AUTO_COMMIT);
    oci_commit($conexao);

    $_SESSION['atualizado'] = true;
    header('Location: ../perfil.php');
    exit();

}

?>
