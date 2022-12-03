<?php

// executa a busca sql
$query = "select * from e_book";
$result = oci_parse($conexao, $query);
oci_execute($result);

// Acessa cada linha retornada pela query
while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    // busca autores do livro
    $queryAutor = "select primeiro_nome, segundo_nome from autor where id_autor in(
        select id_autor from autoria where id_ebook=".$row['ID_EBOOK']."
    )";
    $autores = oci_parse($conexao, $queryAutor);
    oci_execute($autores);

    // busca os generos do livro
    $queryGenero = "select genero from ebook_genero where  id_ebook=".$row['ID_EBOOK'];
    $generos = oci_parse($conexao, $queryGenero);
    oci_execute($generos);

    // trata a nota do livro
    $nota = "sem nota";
    if($row['NUM_AVALIACOES'] > 0){
        $nota = number_format((float)($row['SOMA_AVALIACOES']/$row['NUM_AVALIACOES']), 1, '.', '');
    }
    // exibe os dados do livro
    echo "<div class='bookBlock'>";
        echo "<strong>".$row['TITULO']. "</strong>, ed ". $row['EDICAO'] .". ".$row['DATA_PUBLICACAO'] ."<br>";
        echo "Downloads: ". $row['NUMERO_COMPRAS'] . ", Nota: ".$nota ."<br>";
        echo "Preço: R$".$row['PRECO'] ."<br>";
        echo "Autores: ";
        while (($autor = oci_fetch_array($autores, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            echo $autor['PRIMEIRO_NOME']." ". $autor['SEGUNDO_NOME']."; ";
        }
        echo "<br>Gênero: ";
        while (($genero = oci_fetch_array($generos, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
            echo $genero['GENERO']."; ";
        }
        echo "<br>";
        // botão de compra
        echo "<FORM method='post' action='controle/compraLivro.php'>";
                echo "<input type='hidden' name='id' value='". $row['ID_EBOOK'] ."'>";
                echo "<input type='hidden' name='preco' value='". $row['PRECO'] ."'>";
                echo "<INPUT type='submit' value='Comprar' class='btnCompra'></FORM>";

    echo "</div><br>";
}

?>