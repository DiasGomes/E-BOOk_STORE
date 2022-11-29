<?php

    include "controle/conexao.php";

    // executa a busca sql
    $query = "select * from genero";
    $result = oci_parse($conexao, $query);
    oci_execute($result);

    // Acessa cada linha retornada pela query
    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        echo "<div class='bloco'>";
            echo "<strong>".$row['GENERO']. "</strong><br>";
        echo "</div><br>";
    }

?>