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
                if($_SESSION['usuario'] == 'admin'): ?>
                    <a href="livro.php" class="links">Inserir Livro</a>
            <?php
                endif;
            ?>
        </div>
    
    </div>
    </body>
</html>

