<?php 
session_start();
require_once('../models/Crud.php');

$db = new Crud();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['submit'])) {
    $slug = str_replace(' ', '-', lcfirst($_GET['title_post']));

    $dados = array(
        "titulo" => $_GET['title_post'],
        "categoria" => $_GET['category_post'],
        "conteudo" => $_GET['content_post'],
        "slug" => $slug
    );
    
    if ($db->addPost($dados)) {
        header("Location: http://localhost/hardtec-blogweb/index.php");
    }
    
}

?>
<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <!-- Title -->
        <title>Adicionar Post - HARDTEC</title>

        <!-- Meta TAGS -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="hardtech">
        <meta name="keywords" content="hardtech">

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/css/slidershow.css">
        <link rel="stylesheet" href="../assets/css/main.css">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700|Roboto:400,700|Source+Sans+Pro:400,400i,600i&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php require_once('../views/header.php')?>
        <main class="addpost-main container">
            <section class="addpost-content">
                <div class="form">
                    <div class="account">
                        <h2>Adicionar uma nova postagem</h2>
                        <form action="#">
                            <div class="row">
                                <div class="col">
                                    <label for="title_post">Título</label>
                                    <input type="text" name="title_post" id="title_post" placeholder="Digite o título da postagem">
                                </div>
                                <div class="col">
                                    <label for="category_post">Categoria</label>
                                    <select name="category_post" id="category_post">
                                    <?php foreach ($db->selectCategorys() as $category): ?>
                                        <option value="<?php echo $category->id_categoria; ?>"><?php echo $category->nome; ?></option>
                                    <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="content_post">Conteúdo</label>
                                    <textarea name="content_post" id="content_post" cols="100" rows="25"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" value="Enviar" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
        <script>
            window.onscroll = function() {
                var scroll = window.pageYOffset;

                if (scroll > 250) {
                    document.querySelector(".logo img").style.width = "70px";
                    document.querySelector(".logo img").style.top = "0px";
                    document.querySelector(".container-menu").style.maxWidth = "1080px";
                }

                if (scroll < 250) {
                    document.querySelector(".container-menu").style.maxWidth = "1280px";
                    document.querySelector(".logo img").style.top = "10px";
                    document.querySelector(".logo img").style.width = "80px";
                }
            }
        </script>
    </body>
</html>