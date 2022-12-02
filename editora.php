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

        <div class="contain">
        <div class="right">
            <div class="conteudo">
                <div class="titulo">
                    <h3>CADASTRO DE EDITORAS</h3>
                </div>
                <div class="cadastro">
                    <FORM method="post" action="controle/cadastrarEditora.php">
                        <div class="cadastroRow">     
                            <span>Nome: </span><input type='text' name="editora_nome"><br/>
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
                            <p>Editora Inserida</p>
                        </div>
                    <?php
                        endif;
                        unset($_SESSION['cadastrado']);
                    ?>
            </div>

            <div class="conteudo">
                <div class="titulo">
                    <h3>DELETAR AUTOR</h3>
                </div>
                <div class="listaCadastrados">
                <FORM method="post" action="controle/deletarEditora.php">
                <div class="cadastroRow">
                <label for="editora-select">Editora: </label>
                    <select name='del_editora' class='Select'>
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
                        <INPUT type="submit" value="DELETAR" class="submeter">
                    </div>
                </FORM>
                    <?php if(isset($_SESSION['erro_delete'])): ?>
                            <div class="notification">
                                <p>Não foi possível excluir, pois esta editora está vinculado a uma obra</p>
                            </div>
                        <?php
                            endif;
                            unset($_SESSION['erro_delete']);
                        ?>
                        <?php if(isset($_SESSION['deletado'])): ?>
                            <div class="sucesso">
                                <p>Editora excluida</p>
                            </div>
                        <?php
                            endif;
                            unset($_SESSION['deletado']);
                        ?>
            </div>
            </div>
        </div>
        <div class="left">
            <?php include "controle/showEditora.php"; ?>
        </div>
        </div>

    </body>
</html>

