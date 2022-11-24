<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
    </head>
    <body>
    <a href="formCadastro.php">Cadastrar</a>
        <?php
        // Iniciar o PHP: rode o aplicativo c:\xampp\xampp_start.exe. (Faça sempre que quiser utilizar páginas PHP)

        // link do Browser: http://localhost/ProjetosPHP/E-book/index.php
            
            print <<<_HTML_
                <FORM method="post" action="verificaLogin.php">
                <span>E-mail: </span><input type='text' name="email"><br/>
                <span>Senha: </span><input type='text' name="senha"><br/>
                <INPUT type="submit" value="SUBMETER">
                </FORM>
            _HTML_;
            
        ?>
    </body>
</html>

