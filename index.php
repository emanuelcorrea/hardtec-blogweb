<?php
require_once('header.php');
require_once('models/Post.php');

$post = new Post();
?>
    <!-- Banner rotativo de imagens -->
    <div class="banner">
        <div class="caixa-slideshow">
            <div class="meus-slides-auto fade">
                <img class="img" src="assets/img/banner/bg1.jpeg">
            </div>

            <div class="meus-slides-auto fade">
                <img class="img" src="assets/img/banner/bg2.jpeg">
            </div>

            <div class="meus-slides-auto fade">
                <img class="img" src="assets/img/banner/bg3.jpeg">
            </div>

            <div class="meus-slides-auto fade">
                <img class="img" src="assets/img/banner/bg4.jpeg">
            </div>
        </div>
    </div>
    <main class="articles-main">
        <section class="articles container">
            <?php foreach ($post->select() as $article): ?>
                <!-- Artigo -->
                <article class="article">
                    <!-- Calendário -->
                    <div>
                        <div class="day">
                            <h3><?php echo ucfirst(strftime('%B', strtotime($article->data)));?></h3>
                            <h2><?php echo date('d', strtotime($article->data)); ?></h2>
                            <span><?php echo strftime('%A', strtotime($article->data));?></span>
                        </div>
                        <!-- Imagem Destaque -->
                        <header class="article-header">
                            <a href="<?php echo DIRPAGE; ?>post/<?php echo $article->slug; ?>" title="<?php echo $article->titulo; ?>"><img src="<?php if ($article->imgname != "") {echo "assets/img/post/$article->id_postagem/$article->id_postagem$article->imgtype";} else {echo "assets/img/postBanner.png";} ?>" width="350" height="220"></a>
                        </header>
                    </div>
                    <div class="media">
                        <div class="media-description">
                            <header>
                                <!-- Titulo do Post -->
                                <h1><a href="<?php echo DIRPAGE; ?>post/<?php echo $article->slug; ?>"><?php echo $article->titulo; ?></a></h1>
                                <!-- Dados do Post | Autor | Tags | Comentários -->
                                <div class="media-data">
                                    <span class="author">
                                        Por <a href="#"><?php echo $article->nome; ?></a>
                                    </span>
                                    <span class="tags">
                                        <?php foreach ($post->selectCategory($article->id_postagem) as $category): ?>
                                            <a href="#"><?php echo $category->nomeCategoria; ?></a>
                                        <?php endforeach;?>
                                    </span>
                                </div>
                            </header>
                            <!-- Descrição do Post -->
                            <p><?php echo mb_strimwidth(strip_tags($article->conteudo), 0, 250); ?>...</p>
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
<?php require_once('footer.php'); ?>