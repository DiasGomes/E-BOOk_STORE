<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/controle.css">
    </head>
    <body>
        <div class="admin">
            <div class="titulo">
                <h2>ADMIN</h2>
            </div>
            <?php include "abas.php"; ?>
        </div>  

        <div class="contain">
        <div class="right">
            <div class="conteudo">    
                <div class="titulo">
                    <h3>CADASTRO DE GÊNEROS</h3>
                </div>
                <div class="cadastro">
                    <FORM method="post" action="controle/cadastrarGenero.php">
                        <div class="cadastroRow">     
                            <span>Nome: </span><input type='text' name="genero_nome"><br/>
                        </div>
                        <div class="cadastroRow">
                                <INPUT type="submit" value="INSERIR" class="submeter">
                        </div>
                    </FORM>
                </div>
                <?php if(isset($_SESSION['nao_cadastrado'])): ?>
                        <div class="notification">
                            <p>Campo(s) Vazio(s)</p>
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
                            <p>Gênero Inserido</p>
                        </div>
                    <?php
                        endif;
                        unset($_SESSION['cadastrado']);
                    ?>
            </div> 
            </div>
            <div class="left">
                <div class="conteudo">
                    <div class="titulo">
                        <h3>LISTA DE GÊNEROS</h3>
                    </div>

                    <div class="listaCadastrados">
                        <?php include "controle/showGenero.php"; ?>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

