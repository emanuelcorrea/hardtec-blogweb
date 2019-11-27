<?php 
require_once('../views/header.php');
require_once('../post/Crud.php');

$db = new Crud();

?>
        <main class="account-main container">
            <section class="account-content">
                <div class="login">
                    <div class="account">
                        <div class="account-header">
                            <h2>Entrar</h2>
                        </div>
                        <div class="login-form">
                            <form action="#" method="post">
                                <div class="row">
                                    <div class="col">
                                        <label for="user">Usuário</label>
                                        <input type="text" name="user" id="user">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="password">Senha</label>
                                        <input type="password" name="password" id="password">
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="submit" value="Entrar" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="register">
                    <div class="account-content">
                        <div class="account">
                            <div class="account-header">
                                <h2>Cadastrar</h2>
                            </div>
                            <div class="register-form">
                                <a href="#">Cadastre-se aqui</a>
                            </div>
                        </div>
                    </div>
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