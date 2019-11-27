<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');

abstract class Connection
{
    protected $conn;

    final protected function openConnection()
    {
        //todo Conexão com o banco de dados
        try {
            $this->conn = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME . ';charset=utf8', DBUSER, DBPASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();

            $this->conn = null;
            exit;
        }
    }
}
