<?php

// executa a busca sql
$query = "select id_ebook,titulo, edicao, link_arquivo, nome from e_book e natural join editora where id_ebook in
(select id_ebook from aquisicao where email_cliente='". $_SESSION['usuario'] ."')";
$result = oci_parse($conexao, $query);
oci_execute($result);

// Acessa cada linha retornada pela query
while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    // exibe o livro comprado
    echo "<div class='bookBlock'>";
        echo "<strong>".$row['TITULO']. "</strong>, ed ". $row['EDICAO'] .". editora:".$row['NOME'] ."<br>";
        echo "Arquivo: ". $row['LINK_ARQUIVO'] ."<br>";
        // botão de compra
        echo "<FORM method='post' action='controle/cadastraAvaliacao.php'>";
                echo "<input type='hidden' name='id' value='". $row['ID_EBOOK'] ."'>";
                echo "<label for='nota-select'>Nota: </label>";
                echo "<select name='nota' class='Select'>";
                echo "<option value=''>Escolha uma Nota</option>";
                    for($i = 0; $i < 11; $i++){
                        echo "<option value='".$i."'>".$i;
                    }
                echo "</select><br>";
                echo "<span>Comentar: </span><input type='text' name='comentario'><br>";
                echo "<INPUT type='submit' value='Avaliar' class='btnAvalia'></FORM>";
    echo "</div><br>";
}

?>