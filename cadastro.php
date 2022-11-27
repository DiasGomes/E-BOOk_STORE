<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
    </head>
    <body>
        <a href="login.php">voltar</a>

        <h3 class="title has-text-grey">CADASTRO E-BOOK STORE</h3>

        <FORM method="post" action="controle/cadastrarUsuario.php">
            <span>Nome: </span><input type='text' name="nome"><br/>
            <span>Sobrenome: </span><input type='text' name="sobrenome"><br/>
            <span>E-mail: </span><input type='text' name="email"><br/>
            <span>Saldo: </span><input type='text' name="saldo"><br/>
            <span>Senha: </span><input type='text' name="senha"><br/>
            <INPUT type="submit" value="CADASTRAR">
        </FORM>

        <?php if(isset($_SESSION['nao_cadastrado'])): ?>
            <div class="notification is-danger">
                <p>ERRO: Campo não preenchido</p>
            </div>
        <?php
            endif;
            unset($_SESSION['nao_cadastrado']);
        ?>
        <?php if(isset($_SESSION['cadastrado'])): ?>
            <div class="notification is-danger">
                <p>Cadastrado com sucesso</p>
            </div>
        <?php
            endif;
            unset($_SESSION['cadastrado']);
        ?>

    </body>
</html>

