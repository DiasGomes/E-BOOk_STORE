<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
    </head>
    <body>
        <a href="acervo.php">voltar</a>
        <h3 class="title has-text-grey">EDITAR PERFIL</h3>
        <FORM method="post" action="controle/editarPerfil.php">
            <span>Alterar Nome: </span><input type='text' name="nome"><br/>
            <span>Alterar  Sobrenome: </span><input type='text' name="sobrenome"><br/>
            <span>Saldo: 
            <?php
                include "controle/conexao.php";
                // faz a busca para exibir o saldo do usuário
                $query = "SELECT saldo FROM CLIENTE where email='".$_SESSION['usuario']."'";
                $result = oci_parse($conexao, $query);
                oci_execute($result);
                $row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS);
                print $row['SALDO'];
            ?></span><br/>
            <span>Colocar dinheiro: </span><input type='text' name="dinheiro"><br/>
            <span>Alterar Senha: </span><input type='text' name="senha"><br/>
            <INPUT type="submit" value="CADASTRAR">
            
            <?php if(isset($_SESSION['nao_atualizado'])): ?>
                <div class="notification is-danger">
                    <p>Todos os campos estão vazios</p>
                </div>
            <?php
                endif;
                unset($_SESSION['nao_atualizado']);
            ?>

            <?php if(isset($_SESSION['atualizado'])): ?>
                <div class="notification is-danger">
                    <p>Atualizado</p>
                </div>
            <?php
                endif;
                unset($_SESSION['atualizado']);
            ?>

        </FORM>

    </body>
</html>

