<?php 
session_start();
require_once('../models/Crud.php');
ini_set("xdebug.overload_var_dump", "off");

$db = new Crud();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    if ($db->selectArticle($_GET['slug'])) {
        $article = $db->selectArticle($_GET['slug']);
    } else {
        header("Location: http://localhost/hardtec-blogweb");
    }
} else {
    header("Location: http://localhost/hardtec-blogweb");
}



?>
<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <!-- Title -->
        <title>Blog HARDTEC</title>

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
        <main class="article-main">
            <section class="article container">
                <!-- Cabeçalho com informações do post -->
                <div class="article-header">
                    <div class="article-header-info">
                        <!-- Título da postagem -->
                        <h1><?php echo $article->titulo?></h1>
                    </div>
                    <div class="article-image">
                        <!-- Imagem de destaque da postagem -->
                        <img src="<?php echo $article->imagem_destaque; ?>" alt="" style="height: 629px">
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