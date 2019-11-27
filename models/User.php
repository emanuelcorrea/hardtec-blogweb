<?php
require_once('Crud.php');

class User extends Crud
{

    //todo Insere um novo usuário no banco 
    public function insert($data)
    {
        $this->setQuery(
            "INSERT INTO usuario (nome, email, senha) VALUES ('{$data['nome']}', '{$data['email']}', '{$data['senha']}')"
        );

        return $this->executeUpdate();
    }

    //todo Deleta um usuário no banco
    public function delete($data)
    {

    }

    //todo Atualiza um usuário no banco
    public function update($data)
    {

    }

    //todo Busca todos os usuários
    public function select()
    {

    }

    //todo Faz o login do usuário
    public function login($data)
    {
        try {
            $this->setQuery(
                "SELECT * FROM usuario WHERE email = '{$data['email']}' AND senha = '{$data['senha']}'"
            );

            return $this->executeQuery(1);
        } catch (PDOException $ex) {
            echo "Erro na busca por id: " . $ex->getMessage();
        }
    }
}
