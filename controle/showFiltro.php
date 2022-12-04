<?php
session_start();
if(!empty($_POST['filtro'])){
    $_SESSION['filtro'] = $_POST['filtro'];
    header('Location: ../acervo.php');
    exit();
}else{
    unset($_SESSION['filtro']);
    header('Location: ../acervo.php');
    exit();
}

?>