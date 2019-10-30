<?php
class Crud
{
    private $stmt, $query, $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=db_blog', 'root', '');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function select()
    {
        try {
            $this->setQuery(
                "SELECT * FROM {$this->table}"
            );

            $this->stmt = parent::conn()->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function selectArticles()
    {
        try {
            $this->setQuery(
                "SELECT * FROM postagem"
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function selectCategory($id)
    {
        $this->setQuery(
            "SELECT item_categoria.*, categoria.nome as nomeCategoria 
            FROM item_categoria INNER JOIN categoria ON categoria.id_categoria = item_categoria.id_categoria 
            WHERE id_postagem = {$id}"
        );

        return $this->executeQuery();
    }

    public function selectObject()
    {
        try {
            $this->setQuery(
                "SELECT * FROM {$this->table}"
            );

            $this->stmt = parent::conn()->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function executeQuery()
    {
        try {
            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                var_dump($this->stmt->rowCount());
                return $this->stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //! Getters && Setters 

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }
}
