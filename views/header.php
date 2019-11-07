<?php
    //? Constante
    define('LOCALHOST', "http://{$_SERVER['HTTP_HOST']}/hardtec-blogweb/");
    // define('LOCALHOST', "http://{$_SERVER['HTTP_HOST']}/");
?>

    <header class="menu-navbar">
    <div class="menu-content container-menu">
        <nav class="menu">
            <ul>
                <li><a href="<?php echo LOCALHOST; ?>">Home</a></li>
                <li><a href="<?php echo LOCALHOST; ?>conta/painel.php">Painel</a></li>
                <li><a href="#">Sobre</a></li>
            </ul>
            <div class="logo">
                <div class="logo-content">
                    <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/hardtec-blogweb/assets/img/logohardtec.png" alt="">
                </div>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="admin">Login</a></li>
                <li><a href="#">Sobre</a></li>
            </ul>
        </nav>
    </div>
</header>
