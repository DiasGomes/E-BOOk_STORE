<?php

    // executa a busca sql
    $query = "select e.titulo titulo, eg.genero genero, a.primeiro_nome ||' '|| segundo_nome nome from e_book e 
    left join ebook_genero eg on e.id_ebook = eg.id_ebook
    left join autoria au on e.id_ebook = au.id_ebook
    left join autor a on au.id_autor = a.id_autor";
    $result = oci_parse($conexao, $query);
    oci_execute($result);


    echo "<table>";
    echo "<tr class='cabecalho'>";
        echo "<th>TITULO</th>";
        echo "<th>GÊNERO</th>";
        echo "<th>AUTOR</th>";
    echo "</tr>";
    // Acessa cada linha retornada pela query
    while (($row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        echo "<tr class='tabelalinha'>";
            echo "<td>".$row['TITULO'] ."</td>";
            echo "<td>".$row['GENERO'] ."</td>";
            echo "<td>".$row['NOME'] ."</td>";
        echo "</tr>";
    }
    echo "</table>";

?>