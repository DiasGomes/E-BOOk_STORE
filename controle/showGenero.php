<?php

    // executa a busca sql
    $query = "select e.titulo titulo, g.genero genero from e_book e 
    right join ebook_genero eg on e.id_ebook = eg.id_ebook
    right join genero g on eg.genero = g.genero";
    $result = oci_parse($conexao, $query);
    oci_execute($result);


    echo "<table>";
    echo "<tr class='cabecalho'>";
        echo "<th>TITULO</th>";
        echo "<th>GÊNERO</th>";
    echo "</tr>";
    // Acessa cada linha retornada pela query
    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        echo "<tr class='tabelalinha'>";
            echo "<td>".$row['TITULO'] ."</td>";
            echo "<td>".$row['GENERO'] ."</td>";
        echo "</tr>";
    }
    echo "</table>";

?>