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
                <FORM method="post" action="cadastrarUsuario.php">
                <span>Nome: </span><input type='text' name="nome"><br/>
                <span>Sobrenome: </span><input type='text' name="sobrenome"><br/>
                <span>E-mail: </span><input type='text' name="email"><br/>
                <span>Saldo: </span><input type='text' name="saldo"><br/>
                <span>Senha: </span><input type='text' name="senha"><br/>
                <INPUT type="submit" value="CADASTRAR">
                </FORM>
            _HTML_;
            
        ?>
    </body>
</html>

