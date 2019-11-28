<?php
require_once('../header.php');

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
}

?>
<style>
    header.menu-navbar, footer {
        display: none;
    }
</style>

<header class="menu-painel">
    <div class="menu-content container-menu">
        <nav class="menu">
            <div class="logo">
                <a href="<?php echo DIRPAGE; ?>" style="display: flex; text-decoration: none;">
                    <img src="<?php echo DIRPAGE; ?>assets/img/logo.png" width="60">
                    <h2>&nbspHard<span>Tec<span></h2>
                </a>
            </div>
            <div class="nav">
                <ul>
                    <li></li>
                </ul>
            </div>
            <ul>
                <li>
                    <a href="#" id="config">
                        <i class="fas fa-cog fa-spin"></i>
                    </a>
                </li>
                <li>
                    <a href="logout.php" id="logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
                <!-- <li><a href="<?php echo DIRPAGE;?>conta/painel.php">Painel</a></li> -->
            </ul>
        </nav>
    </div>
</header>
<main class="painel-main">
    <section class="painel-content">
        <div class="container-menu">
            <div class="titulo">
                <h2>Seja bem-vindo de volta, <span><?php echo $_SESSION['conta']['nome']; ?></span>!</h2>
            </div>
            <div class="boxes">
                <div class="box-title">
                    <h3>Criação </h3>&nbsp&nbsp
                    <i class="fas fa-hashtag"></i>
                </div>
                <div class="box">
                    <div>
                        <a href="<?php echo DIRPAGE;?>painel/inserir.php" style="text-decoration: none">
                            <div class="box-content">
                                <div class="box-img">
                                    <i class="fas fa-mug-hot" style="color: pink !important;"></i>
                                </div>
                                <div class="box-img-title">
                                    <h4>Criar postagem</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo DIRPAGE;?>painel/inserir.php" style="text-decoration: none">
                            <div class="box-content">
                                <div class="box-img">
                                    <i class="fas fa-tags" style="color: #7bc980 !important;"></i>
                                </div>
                                <div class="box-img-title">
                                    <h4>Criar categoria</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="box-title">
                    <h3>Listagem </h3>&nbsp&nbsp
                    <i class="fas fa-hashtag"></i>
                </div>
                <div class="box">
                    <div>
                        <a href="<?php echo DIRPAGE;?>painel/inserir.php" style="text-decoration: none">
                            <div class="box-content">
                                <div class="box-img">
                                    <i class="fas fa-mug-hot" style="color: pink !important;"></i>
                                </div>
                                <div class="box-img-title">
                                    <h4>Listar postagens</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="<?php echo DIRPAGE;?>painel/inserir.php" style="text-decoration: none">
                            <div class="box-content">
                                <div class="box-img">
                                    <i class="fas fa-tags" style="color: #7bc980 !important;"></i>
                                </div>
                                <div class="box-img-title">
                                    <h4>Listar categorias</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once('../footer.php'); ?>

<?php ?>