<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>E-BOOK STORE</title>
        <link rel="stylesheet" type="text/css" href="css/livro.css">
    </head>
    <body>
        <div class="admin">
            <div class="titulo">
                <h2>ADMIN</h2>
            </div>
            <a href="acervo.php" class="voltar">voltar</a>
        </div>
        
        

        <div class="conteudo">
            <div class="titulo">
                <h3>CADASTRO DE EDITORAS</h3>
            </div>
            <div class="cadastro">
                <FORM method="post" action="controle/cadastrarEditora.php">
                    <div class="cadastroRow">     
                        <span>ID: </span><input type='text' name="editora_id"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Nome: </span><input type='text' name="editora_nome"><br/>
                    </div>
                    <div class="cadastroRow">
                            <INPUT type="submit" value="INSERIR" class="submeter">
                    </div>
                </FORM>
            </div>
            
            <div class="titulo">
                <h3>CADASTRO DE GÊNENROS</h3>
            </div>
            <div class="cadastro">
                <FORM method="post" action="controle/cadastrarGenero.php">
                    <div class="cadastroRow">     
                        <span>Nome: </span><input type='text' name="genero_nome"><br/>
                    </div>
                    <div class="cadastroRow">
                            <INPUT type="submit" value="INSERIR" class="submeter">
                    </div>
                </FORM>
            </div>

            <div class="titulo">
                <h3>CADASTRO DE AUTORES</h3>
            </div>
            <div class="cadastro">
            <FORM method="post" action="controle/cadastrarAutor.php">
                    <div class="cadastroRow">     
                        <span>ID: </span><input type='text' name="autor_id"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Nome: </span><input type='text' name="autor_nome"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Sobre nome: </span><input type='text' name="autor_sobrenome"><br/>
                    </div>
                    <div class="cadastroRow">
                            <INPUT type="submit" value="INSERIR" class="submeter">
                    </div>
                </FORM>
            </div>

            <div class="titulo">
                <h3>CADASTRO DE E-BOOKS</h3>
            </div>
            <div class="cadastro">
            <FORM method="post" action="controle/cadastrarBook.php">
                    <div class="cadastroRow">     
                        <span>ID: </span><input type='text' name="book_id"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Título: </span><input type='text' name="book_titulo"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Edição: </span><input type='text' name="book_edicao"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Data publicação: </span><input type='text' name="book_data"><br/>
                    </div>
                    <div class="cadastroRow">     
                        <span>Preço: </span><input type='text' name="book_preco"><br/>
                    </div>
                    <div class="cadastroRow">
                            <INPUT type="submit" value="INSERIR" class="submeter">
                    </div>
                </FORM>
            </div>
            
    </body>
</html>

