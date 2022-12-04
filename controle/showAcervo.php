<?php

// executa a busca sql
if(isset($_SESSION['filtro'])){
    $query = "select e.id_ebook, e.titulo, e.edicao, e.preco, e.data_publicacao, e.numero_compras, round(avg(a.nota),1) media
from e_book e left join avaliacao a on e.id_ebook = a.id_ebook
group by (e.id_ebook, e.titulo, e.edicao, e.preco, e.data_publicacao, e.numero_compras)
having e.preco <".$_SESSION['filtro'];
}else{
    $query = "select e.id_ebook, e.titulo, e.edicao, e.preco, e.data_publicacao, e.numero_compras, round(avg(a.nota),1) media
from e_book e left join avaliacao a on e.id_ebook = a.id_ebook
group by (e.id_ebook, e.titulo, e.edicao, e.preco, e.data_publicacao, e.numero_compras)";
}

$result = oci_parse($conexao, $query);
$r = oci_execute($result);

if (!$r) {
    $m = oci_error($result);
    trigger_error("Could not execute statement: ". $m["message"], E_USER_ERROR);
}
   
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
    if($row['MEDIA'] != null){
        $nota = $row['MEDIA'];
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