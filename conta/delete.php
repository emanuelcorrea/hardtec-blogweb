<?php
session_start();
require_once('../models/Crud.php');

$db = new Crud();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (isset($_GET['id_postagem'])) {
    $id_postagem = $_GET['id_postagem'];

    if ($db->deleteArticle($id_postagem)) {
        header("Location: http://localhost/hardtec-blogweb/conta/painel.php");
    }
}
?>