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
        </FORM>

    </body>
</html>

