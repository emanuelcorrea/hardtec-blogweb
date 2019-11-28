<?php 
require_once('config/config.php');

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
        <link rel="stylesheet" href="<?php echo DIRPAGE;?>assets/css/slidershow.css">
        <link rel="stylesheet" href="<?php echo DIRPAGE;?>assets/css/main.css">
        <link href='https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700|Roboto:400,700|Source+Sans+Pro:400,400i,600i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Play&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
    </head>
<body>
    <header class="menu-navbar">
        <div class="menu-content container-menu">
            <nav class="menu">
                <ul>
                    <li><a href="<?php echo DIRPAGE; ?>">Home</a></li>
                    <li><a href="#">Sobre</a></li>
                    <li><a href="#">Contato</a></li>
                    <!-- <li><a href="<?php echo DIRPAGE;?>conta/painel.php">Painel</a></li> -->
                </ul>
                <div class="logo">
                    <div class="logo-content">
                        <a href="<?php echo DIRPAGE; ?>"><img src="<?php echo DIRPAGE;?>assets/img/logohardtec.png" alt=""></a>
                    </div>
                </div>
                <div class="input-search">
                    <input type="text" name="search" id="search" placeholder="Digite o que está procurando...">
                    <i class="fas fa-search"></i>
                </div>
            </nav>
            <nav class="menu-mobile container">
                <i class="fas fa-bars"></i>
                <div class="logo">
                    <a href="<?php echo DIRPAGE; ?>" style="display: flex; text-decoration: none;">
                        <img src="<?php echo DIRPAGE; ?>assets/img/logo.png" width="60">
                        <h2>&nbspHard<span>Tec<span></h2>
                    </a>
                </div>
            </nav>
        </div>
    </header>
