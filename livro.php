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
                    <h3>CADASTRO DE E-BOOKS</h3>
                </div>
                <div class="cadastro">
                    <FORM method="post" action="controle/cadastrarLivro.php">
                            <div class="cadastroRow">     
                                <span>ID: </span><input type='text' name="id"><br/>
                            </div>
                            <div class="cadastroRow">     
                                <span>Título: </span><input type='text' name="titulo"><br/>
                            </div>
                            <div class="cadastroRow">     
                                <span>Edição: </span><input type='text' name="edicao"><br/>
                            </div>
                            <div class="cadastroRow">     
                                <span>Data publicação: </span><input type='text' name="data"><br/>
                            </div>
                            <div class="cadastroRow">     
                                <span>Preço: </span><input type='text' name="preco"><br/>
                            </div>
                            <div class="cadastroRow">     
                                <span>Arquivo: </span><input type='text' name="arquivo"><br/>
                            </div>
                            <div class="cadastroRow">
                                <label for="editora-select">Editora:</label>
                                <select name='editora' class='Select'>
                                    <option value="">Escolha uma Editora</option>
                                    <?php
                                        // executa a busca sql
                                        $query = "select * from editora order by ID_EDITORA";
                                        $result = oci_parse($conexao, $query);
                                        oci_execute($result);

                                        // Acessa cada linha retornada pela query
                                        while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                                            echo "<option value='".$row['ID_EDITORA']."'>[".$row['ID_EDITORA']. "] - ". $row['NOME']."</option>";
                                        }

                                    ?>
                                </select>
                            </div>
                            <div class="cadastroRow">
                                <label for="genero-select">Gênero:</label>
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
                                <label for="autor-select">Autor:</label>
                                <select name='autor' class='Select'>
                                    <option value="">Escolha um Autor</option>
                                    <?php
                                        // executa a busca sql
                                        $query = "select * from Autor";
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
                        </FORM>

                        <?php if(isset($_SESSION['nao_cadastrado'])): ?>
                            <div class="notification">
                                <p>Campo(s) Vazio(s)<?php echo $_SESSION['nao_cadastrado'] ?></p>
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
                                <p>Livro Inserido</p>
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
                    <h3>LISTA DE LIVROS</h3>
                </div>

                <div class="listaCadastrados">
                    <?php include "controle/showLivro.php"; ?>
                </div>
            </div>
        </div>
        </div>                  
    </body>
</html>

