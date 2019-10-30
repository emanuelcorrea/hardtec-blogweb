<?php
class Connection
{
    public function conn()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=db_blog', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}
