<?php

include "conexao.php";

function ola($id, $valor){
    echo  "<script>".$id." - ". $valor ."</script>";
}

// executa a busca sql
$query = "select * from e_book";
$result = oci_parse($conexao, $query);
oci_execute($result);

// Acessa cada linha retornada pela query
while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    //$livros[] = $row['ID_EBOOK'];
    //$preco[] = $row['PRECO'];
    echo "<div class='bookBlock'>";
        echo "<strong>".$row['TITULO']. "</strong>, ed ". $row['EDICAO'] .". ".$row['DATA_PUBLICACAO'] ."<br>";
        echo "Downloads: ". $row['NUMERO_COMPRAS'] . ", Nota: ".$row['MEDIA_AVAL'] ."<br>";
        echo "Preço: R$".$row['PRECO'] ."<br>";
        echo $row['LINK_ARQUIVO'] ."<br>";
        echo "<button class='btnCompra' onclick='ola(".$row['ID_EBOOK'].",".$row['PRECO'].")'>Comprar</button>";
    echo "</div><br>";
}

?>