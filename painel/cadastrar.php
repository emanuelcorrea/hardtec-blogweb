<?php
require_once('../header.php');
require_once('../models/User.php');

if ($_SESSION['logado'] != true) {
    header("Location: " . DIRPAGE);
}

if (isset($_POST['submit'])) {
    if ($_POST['senha'] == $_POST['confirmarSenha']) {
        $user = new User();
        
        $data = array(
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        );

        if ($user->insert($data)) {
            header("Location: " . DIRPAGE . "/painel/login.php");
        }
    }
}
?>
<style>
    header.menu-navbar, footer {
        display: none;
    }
</style>

<main class="painel">
    <div class="painel cadastro">
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
                                <input type="text" name="nome" id="nome" placeholder="Nome">
                                <span></span>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span>
                                <i class="fas fa-envelope"></i>
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
                            <span>
                                <i class="fas fa-user-lock"></i>
                                <input type="password" name="confirmarSenha" id="confirmarSenha" placeholder="Confirme a senha">
                                <span></span>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Cadastro" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once('../footer.php'); ?>