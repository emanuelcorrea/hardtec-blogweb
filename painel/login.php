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

        $msg = "Logado com sucesso!";

        
        // header("Location: sucess.php");
    } else {
        $msg = "Usuário e/ou senha inválidos!";
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
                    <div class="msg-error">
                        <?php if (isset($msg)) { echo "<p>" . $msg . "</p>";} ?></p>
                        <script>
                            var p = document.querySelector(".msg-error p");
                            var msg = document.querySelector(".msg-error p");

                            if (p.value = 'Usuário e/ou senha inválidos!') {
                                p.classList.add('error');

                                var icon = document.createElement('i');
                                icon.className = "fa fa-spinner fa-pulse fa-3x fa-fw";
                                msg.appendChild(icon);

                            } else if (p.value = 'Ótimo! Estamos redirecionando você!'){
                                p.classList.add('sucess');

                                var icon = document.createElement('i');
                                icon.className = "fa fa-spinner fa-pulse fa-3x fa-fw";
                                msg.appendChild(icon);
                            }

                            console.log(p);
                        </script>
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