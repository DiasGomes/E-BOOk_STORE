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
            <div class="conteudoUnico">    
                <div class="titulo">
                    <h3>EDITAR PREÇOS</h3>
                </div>
                <div class="cadastro">
                    <FORM method="post" action="controle/editarPreco.php">
                    <div class="cadastroRow">
                                <label for="livro-select">Livro:</label>
                                <select name='livro' class='Select'>
                                    <option value="">Escolha o livro</option>
                                    <?php
                                    include "controle/conexao.php";
                                        // executa a busca sql
                                        $query = "select ID_EBOOK, TITULO, PRECO from E_BOOK";
                                        $result = oci_parse($conexao, $query);
                                        oci_execute($result);

                                        // Acessa cada linha retornada pela query
                                        while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                                            echo "<option value='".$row['ID_EBOOK']."'>".$row['TITULO']." R$".$row['PRECO']."</option>";                           
                                        }
                                    ?>
                                </select>
                            </div>
                        <div class="cadastroRow">     
                            <span>Novo preço: </span><input type='text' name="preco"><br/>
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
                    <?php if(isset($_SESSION['atualizado'])): ?>
                        <div class="sucesso">
                            <p>Preço atualizado</p>
                        </div>
                    <?php
                        endif;
                        unset($_SESSION['atualizado']);
                    ?>
            </div> 
        </div>

    </body>
</html>

