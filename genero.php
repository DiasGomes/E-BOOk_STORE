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
            <div class="conteudo">
                <div class="titulo">
                    <h3>DELETAR GÊNEROS</h3>
                </div>
                <div class="listaCadastrados">
                <FORM method="post" action="controle/deletarGenero.php">
                <div class="cadastroRow">
                    <label for="genero-select">Gênero: </label>
                        <select name='del_genero' class='Select'>
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
                        <INPUT type="submit" value="DELETAR" class="submeter">
                    </div>
                </FORM>
                    <?php if(isset($_SESSION['erro_delete'])): ?>
                            <div class="notification">
                                <p>Não foi possível excluir, pois este gênero está vinculado a uma obra</p>
                            </div>
                        <?php
                            endif;
                            unset($_SESSION['erro_delete']);
                        ?>
                        <?php if(isset($_SESSION['deletado'])): ?>
                            <div class="sucesso">
                                <p>Gênero excluido</p>
                            </div>
                        <?php
                            endif;
                            unset($_SESSION['deletado']);
                        ?>
                </div>
            </div>
        </div>
            <div class="left">
                <?php include "controle/showGenero.php"; ?>
            </div>
        </div>

    </body>
</html>

