<?php


    // executa a busca sql
    $query = "select ID_EBOOK, titulo from E_BOOK order by ID_EBOOK";
    $result = oci_parse($conexao, $query);
    oci_execute($result);

    // Acessa cada linha retornada pela query
    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        echo "<div class='bloco'>";
            echo "<strong>[".$row['ID_EBOOK']. "] - ". $row['TITULO'] ."</strong><br>";
        echo "</div><br>";
    }

?>