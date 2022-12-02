<?php

    // executa a busca sql
    $query = "select e.titulo titulo, ed.nome nome from e_book e 
    right join editora ed on e.id_editora = ed.id_editora";
    $result = oci_parse($conexao, $query);
    oci_execute($result);


    echo "<table>";
    echo "<tr class='cabecalho'>";
        echo "<th>TITULO</th>";
        echo "<th>EDITORA</th>";
    echo "</tr>";
    // Acessa cada linha retornada pela query
    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        echo "<tr class='tabelalinha'>";
            echo "<td>".$row['TITULO'] ."</td>";
            echo "<td>".$row['NOME'] ."</td>";
        echo "</tr>";
    }
    echo "</table>";

?>