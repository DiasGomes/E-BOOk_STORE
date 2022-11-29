<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/acervo.css">
    </head>
    <body>
    <div class="conteudo">
            <div class="titulo">
                <h1>E-BOOK STORE</h1>
            </div>
        <div>
            <a href="login.php" class="links">Logout</a>
            <a href="perfil.php" class="links">Perfil</a>
            <?php
                // apresenta aba de inserção de livros para o admin
                if($_SESSION['usuario'] == 'admin@admin.com'): ?>
                    <a href="livro.php" class="links">Editar</a>
            <?php
                endif;
            ?>
        </div>

        <div class="acervo">
                <?php include "controle/showAcervo.php"; ?>
        </div>
    
    </div>
    </body>
</html>

