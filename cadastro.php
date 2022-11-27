<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/cadastro.css">
    </head>
    <body>
        <div class="conteudo">
            <div class="titulo">
                <h3 class="title has-text-grey">CADASTRO E-BOOK STORE</h3>
                    </div>

                <div class="cadastro">
                    <FORM method="post" action="controle/cadastrarUsuario.php">
                        <div class="cadastroRow">     
                            <span>Nome: </span><input type='text' name="nome"><br/>
                        </div>
                        <div class="cadastroRow">     
                            <span>Sobrenome: </span><input type='text' name="sobrenome"><br/>
                        </div>
                        <div class="cadastroRow"> 
                            <span>E-mail: </span><input type='text' name="email"><br/>
                        </div>
                        <div class="cadastroRow"> 
                            <span>Saldo: </span><input type='text' name="saldo"><br/>
                        </div>
                        <div class="cadastroRow"> 
                            <span>Senha: </span><input type='text' name="senha"><br/>
                        </div>
                        <div class="cadastroRow"> 
                            <a href="login.php" id="login">voltar</a>
                            <INPUT type="submit" value="CADASTRAR" id="atualiza">
                        </div>
                    </FORM>

        <?php if(isset($_SESSION['nao_cadastrado'])): ?>
            <div class="notification">
                <p>ERRO: Campo(s) não preenchido(s)</p>
            </div>
        <?php
            endif;
            unset($_SESSION['nao_cadastrado']);
        ?>
        <?php if(isset($_SESSION['cadastrado'])): ?>
            <div class="sucesso">
                <p>Cadastrado com sucesso</p>
            </div>
        <?php
            endif;
            unset($_SESSION['cadastrado']);
        ?>

    </body>
</html>

