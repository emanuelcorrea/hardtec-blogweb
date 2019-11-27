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
                <img src="<?php echo DIRPAGE; ?>assets/img/logo.png" width="60">
                <h2>&nbspHard<span>Tec<span></h2>
            </div>
            <div class="nav">
                <ul>
                    <li></li>
                </ul>
            </div>
            <ul>
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
        </div>
    </section>
</main>

<?php require_once('../footer.php'); ?>

<?php ?>