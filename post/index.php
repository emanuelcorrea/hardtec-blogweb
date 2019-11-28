<?php
require_once('../header.php');
require_once('../models/Post.php');

if (isset($_GET['slug']) && !empty($_GET['slug'])) {

    $post = new Post();
    
    if ($post->selectBySlug($_GET['slug'])) {
        $article = $post->selectBySlug($_GET['slug'])[0];
    } else {
        header("Location: " . DIRPAGE);
    }
} else {
    header("Location: " . DIRPAGE);
}
?>
    <main class="article-main">
        <section class="article container-article">
            <!-- Cabeçalho com informações do post -->
            <div class="article-header">
                <div class="article-image">
                    <!-- Imagem de destaque da postagem -->
                    <img src="<?php echo DIRPAGE; ?><?php if (isset($article->imgname) && $article->imgname != null) {echo "assets/img/post/$article->id_postagem/$article->id_postagem$article->imgtype";} else {echo "assets/img/post.png";} ?>" width="1140">
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
                        <?php foreach ($post->selectCategory($article->id_postagem) as $category): ?>
                            <a href="#"><?php echo $category->nomeCategoria; ?></a>
                        <?php endforeach;?>
                    </span>
                </div>
            </div>
            <!-- Conteúdo da postagem -->
            <div class="article-content">
                <p style="font-family: 'Open Sans'; text-align: justify; font-weight: normal; font-size: 14px"><?php echo $article->conteudo; ?></p>
            </div>
        </section>
    </main>
<?php require_once('../footer.php'); ?>