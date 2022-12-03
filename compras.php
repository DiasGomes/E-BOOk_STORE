<?php
session_start();
include "controle/conexao.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/compras.css">
    </head>
    <body>
        <?php include "abasStore.php"; ?>
        <div class="conteudo">
            <div class="titulo">
                 <h3>MEUS LIVROS</h3>
            </div>

            <div class="listaCadastrados">
                <?php include "controle/showCompras.php"; ?>
            </div>
         </div>                 
    </body>
</html>

