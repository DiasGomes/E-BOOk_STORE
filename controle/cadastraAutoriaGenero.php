<?php

session_start(); 
include "conexao.php";

if(empty($_POST['id']) || (empty($_POST['genero']) && empty($_POST['autor']))) {
    // não inseriu o livro ou não inseriu um gênero e/ou autor
    $_SESSION['nao_cadastrado'] = true;
	header('Location: ../infoLivro.php');
	exit();
}else{
    // insere autoria
    if(!empty($_POST['autor'])){
        $result = oci_parse($conexao, "INSERT INTO AUTORIA VALUES (:1, :2)");
        checaSetenca($result, $conexao);
        oci_bind_by_name($result, ":1", $_POST['id']);
        oci_bind_by_name($result, ":2", $_POST['autor']);
        $exe = oci_execute($result, OCI_NO_AUTO_COMMIT);
        checaExecute($exe, $result);
        oci_commit($conexao);   
    }

    // insere genero
    if(!empty($_POST['genero'])){
        $result = oci_parse($conexao, "INSERT INTO EBOOK_GENERO VALUES (:1, :2)");
        checaSetenca($result);
        oci_bind_by_name($result, ":1", $_POST['id']);
        oci_bind_by_name($result, ":2", $_POST['genero']);
        $exe = oci_execute($result, OCI_NO_AUTO_COMMIT);
        checaExecute($exe);
        oci_commit($conexao); 
    }

    //exibe
    $_SESSION['cadastrado'] = true;
    header('Location: ../infoLivro.php');
    exit();

}

// funções auxiliares
function checaSetenca($s){
    if (!$s) {
        $_SESSION['erro_setenca'] = true;
        header('Location: ../infoLivro.php');
        exit();
    }
}

function checaExecute($r){
    // não conseguiu inserir os valores
    if (!$r) {
        $_SESSION['erro_query'] = true;
        header('Location: ../infoLivro.php');
        exit();
    }
}

function checaSetencaERRO($s, $c){
    if (!$s) {
        $m = oci_error($c);
        trigger_error("Não pôde compilar a sentença: ". $m["message"], E_USER_ERROR);
    }
}

function checaExecuteERRO($r, $s){
    // não conseguiu inserir os valores
    if (!$r) {
        $m = oci_error($s);
        trigger_error("Não pôde executar a sentença: ". $m["message"], E_USER_ERROR);
    }
}

?>
