<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/controle.css">
    </head>
    <body>
        <?php include "abas.php"; ?>   

        <div class="contain">
            <div class="right">
            <div class="conteudo">
            <div class="titulo">
                <h3>CADASTRO DE AUTORES</h3>
            </div>
            <div class="cadastro">
            <FORM method="post" action="controle/cadastrarAutor.php">
                    <div class="cadastroRow">     
                        <span>Nome: </span><input type='text' name="autor_nome"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Sobre nome: </span><input type='text' name="autor_sobrenome"><br/>
                    </div>
                    <div class="cadastroRow">
                            <INPUT type="submit" value="INSERIR" class="submeter">
                    </div>
                </FORM>
                <?php if(isset($_SESSION['nao_cadastrado'])): ?>
                    <div class="notification">
                        <p>Campo(s) Vazio(s)<?php $_SESSION['nao_cadastrado'] ?></p>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['nao_cadastrado']);
                ?>
                <?php if(isset($_SESSION['erro_query'])): ?>
                    <div class="notification">
                        <p>Erro: Valor(es) Inválido(s)</p>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['erro_query']);
                ?>
                <?php if(isset($_SESSION['erro_setenca'])): ?>
                    <div class="notification">
                        <p>Erro: Não pôde compilar a sentença</p>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['erro_setenca']);
                ?>
                <?php if(isset($_SESSION['cadastrado'])): ?>
                    <div class="sucesso">
                        <p>Autor Inserido</p>
                    </div>
                <?php
                    endif;
                    unset($_SESSION['cadastrado']);
                ?>
            </div>

        </div>
        </div>
        <div class="left">
        <div class="conteudo">
            <div class="titulo">
                <h3>LISTA DE AUTORES</h3>
            </div>

            <div class="listaCadastrados">

            <?php include "controle/showAutor.php"; ?>

            </div>
        </div>
        </div>

        </div>   
            
    </body>
</html>

