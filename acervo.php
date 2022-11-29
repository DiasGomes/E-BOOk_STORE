<?php session_start(); ?>

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
    </body>
</html>

