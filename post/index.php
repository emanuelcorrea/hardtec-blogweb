<?php 
session_start();
require_once('../models/Crud.php');

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
            <section class="article container-article">
                <!-- Cabeçalho com informações do post -->
                <div class="article-header">
                    <div class="article-image">
                        <!-- Imagem de destaque da postagem -->
                        <img src="<?php echo LOCALHOST; ?>assets/img/post/<?php if (isset($article->imgname) && $article->imgname != null) {echo "$article->id_postagem/$article->id_postagem$article->imgtype";} else {echo "assets/img/logoHardTec.jpg";} ?>" alt="" height="629">
                    </div>
                    <div class="article-header-info">
                        <!-- Título da postagem -->
                        <h1><?php echo $article->titulo?></h1>
                    </div>
                    <!-- Dados do Post | Autor | Tags | Comentários -->
                    <div class="article-post-info">
                        <div>
                            <span class="article-info-author" title="Postado por <?php echo $article->nome; ?>"><i class="fas fa-user-tag"></i> <?php echo $article->nome; ?></span>
                            <span class="article-info-date" title="Postado <?php echo strftime('%A, %d de %B de %Y', strtotime($article->data)); ?>"><i class="fas fa-calendar-alt"></i> <?php echo date("d/m/Y",strtotime($article->data)); ?></span>
                        </div>
                        <span class="article-info-category">
                            <i class="fas fa-clipboard-list"></i>
                            <?php foreach ($db->selectCategory($article->id_postagem) as $category): ?>
                                <a href="#"><?php echo $category->nomeCategoria; ?></a>
                            <?php endforeach;?>
                        </span>
                    </div>
                </div>
                <div class="article-content">
                    <p style="font-family: 'Open Sans'; text-align: justify; font-weight: normal; font-size: 14px"><?php echo $article->conteudo; ?></p>
                </div>
            </section>
        </main>
        <?php require_once('../views/footer.php'); ?>