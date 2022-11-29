<?php

include "conexao.php";

// executa a busca sql
$query = "select titulo, edicao, link_arquivo, nome from e_book e natural join editora where id_ebook in
(select id_ebook from aquisicao where email_cliente='". $_SESSION['usuario'] ."')";
$result = oci_parse($conexao, $query);
oci_execute($result);

// Acessa cada linha retornada pela query
while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    // exibe o livro comprado
    echo "<div class='bookBlock'>";
        echo "<strong>".$row['TITULO']. "</strong>, ed ". $row['EDICAO'] .". editora:".$row['NOME'] ."<br>";
        echo "Arquivo: ". $row['LINK_ARQUIVO'] ."<br>";
    echo "</div><br>";
}

?>