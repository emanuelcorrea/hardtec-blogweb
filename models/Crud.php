<?php
class Crud
{
    private $stmt, $query, $conn;

    public function __construct()
    {
        // $this->conn = new PDO('mysql:host=profthiago.com;dbname=proft578_hardtec;charset=utf8', 'proft578_hardtec', 'soufeliz123', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->conn = new PDO('mysql:host=localhost;dbname=db_blog;charset=utf8', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
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
                "SELECT * FROM postagem ORDER BY id_postagem DESC"
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

    public function selectArticle($slug)
    {
        try {
            $this->setQuery(
                "SELECT * FROM postagem INNER JOIN usuario ON postagem.id_usuario = usuario.id_usuario WHERE postagem.slug = '$slug' "
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetch(PDO::FETCH_OBJ);
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

    public function selectCategorys()
    {
        $this->setQuery(
            "SELECT * FROM categoria"
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

    public function deleteArticle($id_postagem)
    {
        try {
            $this->setQuery(
                "DELETE FROM postagem WHERE id_postagem = $id_postagem"
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateArticle($dados)
    {
        try {
            $this->setQuery(
                "UPDATE postagem SET titulo = :titulo, conteudo = :conteudo WHERE id_postagem = :id_postagem"
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute(array(
                ":titulo" => $dados['titulo'],
                ":conteudo" => $dados['conteudo']
            ));

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function executeQuery()
    {
        try {
            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //? Post
    public function addPost($dados)
    {
        try {
            $this->setQuery(
                "INSERT INTO postagem (id_usuario, titulo, conteudo, slug, `data`) 
                VALUES (:id_usuario, :titulo, :conteudo, :slug, NOW())"
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            if ($this->stmt->execute(array(
                ":id_usuario" => 1,
                ":titulo" => $dados['titulo'],
                ":conteudo" => $dados['conteudo'],
                ":slug" => $dados['slug']
            ))) {
                $this->addCategory($dados['categoria']);
            };

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function addCategory($categorias)
    {
        try {
            $id_postagem = $this->lastId()['id_postagem'];

            $sql = "INSERT INTO item_categoria (id_categoria, id_postagem) VALUES ";
    
            foreach($categorias as $key => $value) {
                $sql .= "($value, $id_postagem), ";
            }
            
            $this->setQuery(
                substr_replace($sql, '', -2)
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    public function lastId()
    {
        try {
            $this->setQuery(
                "SELECT id_postagem FROM postagem ORDER BY id_postagem DESC"
            );

            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return $this->stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (\PDOException $e){
            echo "Error: " . $e->getMessage();
            exit;
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
