<?php
require_once('../header.php');
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

        header("Location: " . DIRPAGE . "painel/");
    }
}
?>
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

<?php require_once('../footer.php'); ?>