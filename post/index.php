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
                        <img src="<?php echo $article->imagem_destaque; ?>" alt="" style="height: 629px">
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
                    <h2 style="font-family: 'Open Sans'; text-align: justify; font-weight: normal; font-size: 14px"><?php echo $article->conteudo; ?></h2>
                    <p style="font-family: 'Open Sans'; text-align: justify; font-weight: normal; font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore voluptas sequi officia ut, culpa id. Omnis, veritatis ipsum ducimus ut sequi dolorem iusto alias tempore. Earum inventore, provident illo incidunt excepturi sequi architecto unde pariatur fuga aliquam accusamus nemo neque ipsam velit eos. Fugit aut ex illum dolores, dicta porro consectetur sunt. Modi blanditiis incidunt sapiente voluptatibus sed dicta vel dolorum sint esse! Voluptatibus dolor, quas repellat non doloribus nulla ea nemo sequi modi, perspiciatis accusantium aliquid ducimus voluptatum, esse quod. Odit eaque saepe fugiat, rerum voluptatum, error quidem aliquam ipsum nihil quisquam quasi vel fuga quis pariatur repellat dolorem numquam vitae assumenda eos quo commodi voluptatibus nisi. Consequuntur nesciunt, quia excepturi aut fugit ab distinctio facere. Veniam repellendus provident possimus, sapiente architecto adipisci repudiandae hic animi aspernatur perferendis quo est quam iste corporis magni recusandae sed eligendi delectus facilis maxime eius facere praesentium nemo minus! Incidunt maxime iure voluptatibus vel. Nihil tempora voluptatum ducimus sed quaerat minus quo obcaecati corrupti, qui enim consequatur. Eos excepturi labore minus ipsa quisquam? Labore sapiente laboriosam recusandae, iste alias nesciunt tempora veniam doloremque dolore distinctio? Sit beatae libero nemo sequi ullam sint mollitia quod sapiente autem, fugit amet eius, fugiat eveniet id earum voluptatem expedita! Error molestias nisi doloribus beatae totam eaque obcaecati dolore unde aut omnis mollitia architecto eum iure sunt at minima numquam exercitationem officia, neque reprehenderit minus dolorem in sit? Corrupti provident sequi, enim iusto nam debitis vero. Velit temporibus voluptas consequuntur. Repellendus qui voluptas eveniet nihil. Illum blanditiis molestiae architecto explicabo recusandae veniam nemo, ut doloremque ratione in? Deserunt neque illum cum optio ipsum corporis molestias perferendis accusamus enim voluptate quos distinctio quas incidunt, pariatur libero qui harum consequatur magnam sapiente delectus ab odio aliquid tempore esse. Reprehenderit odit quaerat repellendus rerum similique nostrum voluptates unde libero dolorem id ducimus mollitia modi enim ullam architecto laudantium voluptatibus natus ab esse, et consectetur qui vitae. Saepe laudantium praesentium optio laborum illo voluptates quidem itaque omnis suscipit quas, unde molestias quae hic rerum minus quaerat? Numquam, iste cupiditate? Quam soluta, inventore doloribus quia totam sed eius id nemo, veritatis voluptates delectus aliquam ad ex perferendis labore nisi optio enim dolor explicabo ipsa quo libero nulla atque quod? Voluptatem magni quas ducimus, quia quidem rem cumque pariatur nostrum porro officia atque ullam nisi dignissimos reiciendis iste, corrupti iusto fugit laudantium molestias consectetur. Magni cum suscipit, esse, minima blanditiis ex mollitia at quidem facilis ut, cumque quis totam? Explicabo eligendi dolorum necessitatibus amet nemo minima rem perspiciatis saepe fuga non accusamus a neque ipsam facilis omnis animi deserunt veritatis voluptatem officia cumque, natus velit! Corporis obcaecati ducimus pariatur quibusdam dolorum corrupti voluptate iusto quae illo repellat perspiciatis amet, maiores asperiores libero provident qui, odit aspernatur fugiat voluptatum. Minus architecto quae harum sunt excepturi, commodi, quis, a hic dignissimos sapiente cum ab. Animi recusandae harum aperiam! Optio, dolor delectus animi numquam harum saepe tempore laborum, nesciunt possimus voluptatem nam sint perspiciatis fugit velit doloribus quo nisi molestias eaque aliquam quod qui praesentium. Est, tenetur?</p>
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