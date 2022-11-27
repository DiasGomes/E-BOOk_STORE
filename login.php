<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>

        <div class="conteudo">
            <div class="titulo">
                <h3 class="title has-text-grey">LOGIN E-BOOK STORE</h3>
            </div>

            <div class="login">

                <div>
                    <FORM method="post" action="controle/verificaLogin.php">
                        <div class="loginRow">    
                            <span>E-mail: </span><input type='text' name="email"><br/>
                        </div>
                        <div class="loginRow">    
                            <span>Senha: </span><input type='text' name="senha"><br/>
                        </div>
                        <div class="loginRow">
                            <a href="cadastro.php" id="cadastro">CADASTRAR</a>
                            <INPUT type="submit" value="CONECTAR" id="conecta">
                        </div> 
                    </FORM>
                </div>

                <?php if(isset($_SESSION['nao_autenticado'])): ?>
                    <div class="notification">
                        <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                ?>

            </div>
        </div>    
    
    </body>
</html>

