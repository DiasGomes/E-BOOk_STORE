<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
    </head>
    <body>
        <?php
        // Iniciar o PHP: rode o aplicativo c:\xampp\xampp_start.exe. (Faça sempre que quiser utilizar páginas PHP)

        // link do Browser: http://localhost/ProjetosPHP/E-book/index.php
            
            print <<<_HTML_
                <FORM method="post" action="verificaLogin.php">
                <span>Usuário: </span><input type='text' name="nome"><br/>
                <span>Senha: </span><input type='text' name="nota"><br/>
                <INPUT type="submit" value="SUBMETER">
                </FORM>
            _HTML_;
            
        ?>
    </body>
</html>

