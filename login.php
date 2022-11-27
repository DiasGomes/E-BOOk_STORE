<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <div>
            <a href="cadastro.php">Cadastrar</a>
        </div>

        <h3 class="title has-text-grey">LOGIN E-BOOK STORE</h3>
        <?php if(isset($_SESSION['nao_autenticado'])): ?>
            <div class="notification is-danger">
                <p>ERRO: Usuário ou senha inválidos.</p>
            </div>
        <?php
            endif;
            unset($_SESSION['nao_autenticado']);
        ?>

        <div>
            <FORM method="post" action="controle/verificaLogin.php">
                <span>E-mail: </span><input type='text' name="email"><br/>
                <span>Senha: </span><input type='text' name="senha"><br/>
                <INPUT type="submit" value="CONECTAR">
            </FORM>
        </div> 
    </body>
</html>

