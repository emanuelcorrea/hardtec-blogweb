<?php
require_once('../models/User.php');

if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    header("Location: " . DIRPAGE);
} 

if (isset($_POST['submit'])) {
    $user = new User();
    
    $data = array(
        'email' => $_POST['email'],
        'senha' => $_POST['senha']
    );

    if ($user->login($data)) {
        $_SESSION['conta'] = $user->login($data)[0];
        $_SESSION['logado'] = true;

        $msg = "<i class='fa fa-spinner fa-pulse fa-3x fa-fw' style='color: green !important;'></i><p style='color: green !important;'>Logado com sucesso!</p>";

        
        header("Location: sucess.php");
    } else {
        $msg = "<p class='error'>Usuário e/ou senha inválidos!</p>";
    }
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
        <link rel="stylesheet" href="http://hardtec.ga/assets/css/slidershow.css">
        <link rel="stylesheet" href="http://hardtec.ga/assets/css/main.css">
        <link href='https://cdn.jsdelivr.net/npm/froala-editor@3.0.6/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700|Roboto:400,700|Source+Sans+Pro:400,400i,600i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Play&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Delius&display=swap" rel="stylesheet">
    </head>
    <body>
        <style>
            header.menu-navbar, footer {
                display: none;
            }
        </style>
        <main class="painel">
            <div class="painel">
                <div class="painel-content">
                    <div class="logo">
                        <img src="<?php echo DIRPAGE;?>/assets/img/logohardtec.png" alt="Logo HardTec" width="125"> 
                        <h3>Painel</h3>
                    </div>
                    <div class="painel-form">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="col">
                                    <span>
                                        <i class="fas fa-user"></i>
                                        <input type="text" name="email" id="email" placeholder="E-mail">
                                        <span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span>
                                        <i class="fas fa-lock"></i>
                                        <input type="password" name="senha" id="senha" placeholder="Senha">
                                        <span></span>
                                    </span>
                                </div>
                            </div>
                            <div class="msg-error">
                                <?php if (isset($msg)) { echo $msg;} ?>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="Login" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <h3>Hardtec, 2019 - Todos os direitos reservados</h3>
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
        <script>
            window.onscroll = function() {
                var scroll = window.pageYOffset;

                if (scroll > 250) {
                    document.querySelector(".logo-content img").style.width = "80px";
                    document.querySelector(".logo-content").style.top = "0px";
                    document.querySelector(".container-menu").style.maxWidth = "920px";
                }

                if (scroll < 250) {
                    document.querySelector(".container-menu").style.maxWidth = "1280px";
                    document.querySelector(".logo-content").style.top = "10px";
                    document.querySelector(".logo-content img").style.width = "90px";
                }
            }

            var indice_slide_auto = 0;
            trocarSlides();
                
            function trocarSlides() {
                var i_auto;
                var slides_auto = document.getElementsByClassName("meus-slides-auto");
                var ponto_indicador_auto = document.getElementsByClassName("ponto-indicador-slide");
                for (i_auto = 0; i_auto < slides_auto.length; i_auto++) {
                    slides_auto[i_auto].style.display = "none";  
                }
                indice_slide_auto++;
                if (indice_slide_auto > slides_auto.length) {indice_slide_auto = 1}    
                for (i_auto = 0; i_auto < ponto_indicador_auto.length; i_auto++) {
                    ponto_indicador_auto[i_auto].className = ponto_indicador_auto[i_auto].className.replace(" ativo", "");
                }
                slides_auto[indice_slide_auto-1].style.display = "block";  
                setTimeout(trocarSlides, 5000);
            }
        </script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({});
            });
        </script>
    </body>
</html>