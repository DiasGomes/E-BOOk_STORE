<div class="titulo">
    <h1>E-BOOK STORE</h1>
</div>
<div>
<a href="login.php" class="links">Logout</a>
<a href="acervo.php" class="links">Livros</a>
<a href="perfil.php" class="links">Perfil</a>
<a href="compras.php" class="links">Meus E-Books</a>
<?php
    // apresenta aba de inserção de livros para o admin
    if($_SESSION['usuario'] == 'admin@admin.com'): ?>
         <a href="livro.php" class="links">Editar</a>
<?php
    endif;
?>
</div>
<div id="fixo">
    <span>Saldo: R$ 
        <?php
            // faz a busca para exibir o saldo do usuário
            $query = "SELECT saldo FROM CLIENTE where email='".$_SESSION['usuario']."'";
            $result = oci_parse($conexao, $query);
            oci_execute($result);
            $row = oci_fetch_array($result, OCI_ASSOC+OCI_RETURN_NULLS);
            print $row['SALDO'];
        ?>
    </span>
</div>