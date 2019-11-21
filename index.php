<?php 
session_start();
require_once('models/Crud.php');
ini_set("xdebug.overload_var_dump", "off");

$db = new Crud();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
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
        <link rel="stylesheet" href="assets/css/slidershow.css">
        <link rel="stylesheet" href="assets/css/main.css">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700|Roboto:400,700|Source+Sans+Pro:400,400i,600i&display=swap" rel="stylesheet">

        
    </head>
    <body>
        <?php require_once('views/header.php')?>
        <div class="banner">
            <div class="caixa-slideshow">
                    <div class="meus-slides-auto fade">
                        <img class="img" src="assets/img/bgedit.jpg">
                    </div>

                    <div class="meus-slides-auto fade">
                        <img class="img" src="assets/img/bg1.jpeg">
                    </div>

                    <div class="meus-slides-auto fade">
                        <img class="img" src="assets/img/bg2.jpeg">
                    </div>
                </div>
        </div>
        <main class="articles-main">
            <section class="articles container">
                <?php foreach ($db->selectArticles() as $article): ?>
                    <!-- Artigo -->
                    <article class="article">
                        <!-- Calendário -->
                        <div class="day">
                            <h3><?php echo ucfirst(strftime('%B', strtotime($article->data)));?></h3>
                            <h2><?php echo date('d', strtotime($article->data)); ?></h2>
                            <span><?php echo strftime('%A', strtotime($article->data));?></span>
                        </div>
                        <!-- Imagem Destaque -->
                        <header class="article-header">
                            <a href="post/<?php echo $article->slug; ?>" title="<?php echo $article->titulo; ?>"><img src="<?php if ($article->imgname != "") {echo "assets/img/post/$article->id_postagem/$article->id_postagem$article->imgtype";} else {echo "assets/img/logoHardTec.jpg";} ?>" width="350" height="220"></a>
                        </header>
                        <div class="media">
                            <div class="media-description">
                                <header>
                                    <!-- Titulo do Post -->
                                    <h1><a href="post/<?php echo $article->slug; ?>"><?php echo $article->titulo; ?></a></h1>
                                    <!-- Dados do Post | Autor | Tags | Comentários -->
                                    <div class="media-data">
                                        <span class="author">
                                            Por <a href="#"><?php echo $article->nome; ?></a>
                                        </span>
                                        <span class="tags">
                                            <?php foreach ($db->selectCategory($article->id_postagem) as $category): ?>
                                                <a href="#"><?php echo $category->nomeCategoria; ?></a>
                                            <?php endforeach;?>
                                        </span>
                                        <span class="comments">
                                            <a href="#">Nenhum Comentário</a>
                                        </span>
                                    </div>
                                </header>
                                <!-- Descrição do Post -->
                                <p><?php echo strip_tags(mb_strimwidth($article->conteudo, 0, 250)); ?>...</p>
                            </div>
                        </div>
                        <!-- Botão Leia mais -->
                        <div class="read-more">
                            <a href="post/<?php echo $article->slug; ?>">Leia mais →</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        </main>
    <?php require_once('views/footer.php'); ?>