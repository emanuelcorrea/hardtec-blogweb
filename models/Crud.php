<?php
require_once('Connection.php');

abstract class Crud extends Connection
{
    protected $query, $stmt;
    
    abstract protected function select();
    abstract protected function insert($data);
    abstract protected function delete($data);
    abstract protected function update($data);
    protected function selectById($data){}

    protected function executeQuery($arg = null)
    {
        $this->openConnection();
        
        try {
            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {

                if ($arg == 1) {
                    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $ex->getMessage();
        } finally {
            $this->conn = null;
        }
    }

    protected function executeUpdate()
    {
        $this->openConnection();
        
        try {
            $this->stmt = $this->conn->prepare($this->getQuery());
            $this->stmt->execute();

            if ($this->stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            echo "Erro na query: " . $ex->getMessage();
        } finally {
            $this->conn = null;
        }
    }

    protected function getQuery() {
        return $this->query;
    }

    protected function setQuery($query) {
        $this->query = $query;
    }
}
