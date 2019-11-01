<?php
class Connection
{
    public function conn()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=db_blog;charset=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
