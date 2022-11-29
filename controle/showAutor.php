<?php

    include "controle/conexao.php";

    // executa a busca sql
    $query = "select * from autor order by ID_AUTOR";
    $result = oci_parse($conexao, $query);
    oci_execute($result);

    // Acessa cada linha retornada pela query
    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        echo "<div class='bloco'>";
            echo "<strong>[".$row['ID_AUTOR']. "] - ";
            echo $row['PRIMEIRO_NOME']. " " .$row['SEGUNDO_NOME'] ."</strong><br>";
        echo "</div><br>";
    }

?>