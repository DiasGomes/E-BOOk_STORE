<?php
session_start();
include "controle/conexao.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/acervo.css">
    </head>
    <body>
    <div class="conteudo">
        <?php include "abasStore.php"; ?>
        <div class="acervo">
            <?php include "controle/showAcervo.php"; ?>
        </div>
    
    </div>
    <?php
        if(isset($_SESSION['erro_setenca'])):
    ?>
    <script>alert('Ops! Ocorreu um erro') </script>
    <?php       
    unset($_SESSION['erro_setenca']);
    endif
    ?>
    <?php
        if(isset($_SESSION['nao_comprado'])):
    ?>
    <script>alert('Saldo Insuficiente') </script>
    <?php       
    unset($_SESSION['nao_comprado']);
    endif
    ?>
    <?php
        if(isset($_SESSION['comprado'])):
    ?>
    <script>alert('Livro comprado') </script>
    <?php       
    unset($_SESSION['comprado']);
    endif
    ?>
</html>
