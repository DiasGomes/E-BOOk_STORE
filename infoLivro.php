<?php 
session_start(); 
include "controle/conexao.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/controle.css">
    </head>
    <body>
        <?php include "abas.php"; ?> 
        <div class="conteudoUnico">
            <div class="titulo">
                <h3>INSERIR AUTORIAS E GÊNEROS DO E-BOOK</h3>
            </div>
            <FORM method="post" action="controle/cadastraAutoriaGenero.php">
            <div class="cadastro">
                <div class="cadastroRow">
                    <label for="genero-select">Livro: </label>
                        <select name='id' class='Select'>
                            <option value="">Escolha um livro</option>
                                <?php
                                    // executa a busca sql
                                    $query = "select id_ebook, titulo from e_book";
                                    $result = oci_parse($conexao, $query);
                                    oci_execute($result);

                                    // Acessa cada linha retornada pela query
                                    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                                        echo "<option value='".$row['ID_EBOOK']."'>[".$row['ID_EBOOK']."] - ".$row['TITULO']."</option>";               
                                    }
                                ?>
                        </select>
                </div>
                <div class="cadastroRow">
                        <label for="genero-select">Gênero: </label>
                            <select name='genero' class='Select'>
                                <option value="">Escolha um gênero</option>
                                    <?php
                                        // executa a busca sql
                                        $query = "select * from genero";
                                        $result = oci_parse($conexao, $query);
                                        oci_execute($result);

                                        // Acessa cada linha retornada pela query
                                        while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                                            echo "<option value='".$row['GENERO']."'>".$row['GENERO']."</option>";
                                                            
                                        }
                                    ?>
                            </select>
                    </div>
                    <div class="cadastroRow">
                        <label for="autor-select">Autor: </label>
                            <select name='autor' class='Select'>
                                <option value="">Escolha um Autor</option>
                                    <?php
                                        // executa a busca sql
                                        $query = "select * from Autor order by ID_AUTOR";
                                        $result = oci_parse($conexao, $query);
                                        oci_execute($result);

                                        // Acessa cada linha retornada pela query
                                        while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                                            echo "<option value='".$row['ID_AUTOR']."'>[".$row['ID_AUTOR']. "] - ". $row['PRIMEIRO_NOME'];
                                            echo " ". $row['SEGUNDO_NOME']."</option>";
                                        }
                                    ?>
                                    </select>
                    </div>
                    <div class="cadastroRow">
                        <INPUT type="submit" value="INSERIR" class="submeter">
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
                            <p>Este livro já possui esse gênero ou autor</p>
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
                            <p>Inserido</p>
                        </div>
                    <?php
                        endif;
                        unset($_SESSION['cadastrado']);
                    ?>
            </div>
            </FORM>
    </body>
</html>