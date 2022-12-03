<?php
session_start();
include "controle/conexao.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/perfil.css">
    </head>
    <body>
        <?php include "abasStore.php"; ?>
        <div class="conteudo">
            <div class="titulo">
                <h3 class="title has-text-grey">EDITAR PERFIL</h3>
            </div>

            <div class="perfil">
                <FORM method="post" action="controle/editarPerfil.php">
                    <div class="atualizaRow"> 
                        <span>Alterar Nome: </span><input type='text' name="nome"><br/>
                    </div>
                    <div class="atualizaRow"> 
                        <span>Alterar Sobrenome: </span><input type='text' name="sobrenome"><br/>
                    </div>
                    <div class="atualizaRow"> 
                        <span>Colocar dinheiro: </span><input type='text' name="dinheiro"><br/>
                    </div>
                    <div class="atualizaRow"> 
                        <span>Alterar Senha: </span><input type='text' name="senha"><br/>
                    </div>
                    <div class="atualizaRow"> 
                        <a href="acervo.php" id="voltar">voltar</a>
                        <INPUT type="submit" value="CADASTRAR" id="atualizar">
                    </div>
                    
                    <?php if(isset($_SESSION['nao_atualizado'])): ?>
                        <div class="notification">
                            <p>Todos os campos estão vazios</p>
                        </div>
                    <?php
                        endif;
                        unset($_SESSION['nao_atualizado']);
                    ?>

                    <?php if(isset($_SESSION['atualizado'])): ?>
                        <div class="sucesso">
                            <p>Atualizado</p>
                        </div>
                    <?php
                        endif;
                        unset($_SESSION['atualizado']);
                    ?>

                </FORM>
            </div>
        </div>
    </body>
</html>

