<?php 
session_start();
require_once('../models/Crud.php');

$db = new Crud();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>

<html lang="pt-BR">
    <head>
        <!-- Title -->
        <title>Listagem de Posts - HARDTEC</title>

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
                        <div class="title">
                            <h2>Listagem</h2>
                        </div>
                        <table>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Editar</th>
                                <th>Remover</th>
                            </tr>
                                <?php foreach($db->selectArticles() as $postagem): ?>
                            <tr>
                                <td class="img-table"><img src="<?php echo $postagem->imagem_destaque; ?>" width="250"></td>
                                <td><?php echo $postagem->id_postagem; ?></td>
                                <td><?php echo $postagem->titulo; ?></td>
                                <td>
                                    <?php foreach ($db->selectCategory($postagem->id_postagem) as $category): ?>
                                        <a href="#"><?php echo $category->nomeCategoria; ?></a><br>
                                    <?php endforeach;?>
                                </td>
                                <td><a href="<?php echo LOCALHOST;?>conta/edit.php?slug=<?php echo $postagem->slug; ?>"><i class="fas fa-edit"></i></a></td>
                                <td><a href="<?php echo LOCALHOST;?>conta/delete.php?id_postagem=<?php echo $postagem->id_postagem; ?>"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    <?php require_once('../views/footer.php'); ?>