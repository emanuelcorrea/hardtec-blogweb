<?php
session_start();
ob_start();

//? Arquivo de gerenciamento do ambiente de desenvolvimento
require_once('environment.php');

//* Configurações de timezone
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

//todo Dados de conexão do banco de dados
if (ENVIRONMENT == 'production') {
    define('DBHOST', 'profthiago.com');
    define('DBNAME', 'proft578_hardtec');
    define('DBUSER', 'proft578_hardtec');
    define('DBPASS', 'soufeliz123');

    //todo Pasta do site 
    $pasta = '';
} else {
    define('DBHOST', 'localhost');
    define('DBNAME', 'db_blog');
    define('DBUSER', 'root');
    define('DBPASS', '');

    //todo Pasta do site 
    $pasta = 'hardtec-blogweb/';
}

//! Caminho relativo
define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/$pasta");

//! Caminho absoluto
define('DIRREQ', "{$_SERVER['DOCUMENT_ROOT']}/");

