<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/acervo.css">
    </head>
    <body>
    <script>
        function compra(id, preco){
            resultado = window.confirm("comprou: "+ id + ' por ' + preco);
            console.log("comprou: "+ id + ' por ' + preco);
        }
    </script>
    <div class="conteudo">
        <?php include "abasStore.php"; ?>
        <div class="acervo">
            
        
            <?php include "controle/showAcervo.php"; ?>
        </div>
    
    </div>
    </body>
</html>
