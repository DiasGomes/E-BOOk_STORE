<?php session_start(); 
include "controle/conexao.php";?>

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
            <div class="conteudo">
                <div class="titulo">
                    <h3>DELETAR AUTOR</h3>
                </div>
                <div class="listaCadastrados">
                <FORM method="post" action="controle/deletarAutor.php">
                <div class="cadastroRow">
                <label for="autor-select">Autor: </label>
                    <select name='del_autor' class='Select'>
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
                        <INPUT type="submit" value="DELETAR" class="submeter">
                    </div>
                </FORM>
                    <?php if(isset($_SESSION['erro_delete'])): ?>
                            <div class="notification">
                                <p>Não foi possível excluir, pois este autor está vinculado a uma obra</p>
                            </div>
                        <?php
                            endif;
                            unset($_SESSION['erro_delete']);
                        ?>
                        <?php if(isset($_SESSION['deletado'])): ?>
                            <div class="sucesso">
                                <p>Autor excluido</p>
                            </div>
                        <?php
                            endif;
                            unset($_SESSION['deletado']);
                        ?>
            </div>

        </div>
        </div>
            <div class="left">
                <?php include "controle/showAutor.php"; ?>
            </div>

        </div>   
            
    </body>
</html>

