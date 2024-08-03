<?php

require_once '../config/Database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($username, $email, $senha)
    {
        $sql = $this->conn->prepare("INSERT INTO users (nome, email, senha) VALUES (:nome, :email, :senha)");
        $sql->bindParam(':nome', $username);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':senha', $senha);
        return $sql->execute();
    }

    public function login($email, $password)
    {
        $sql = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['senha'])) {
            return $user;
        }
        return false;
    }

    public function read()
    {
        $sql = $this->conn->query("SELECT * FROM users");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $username, $email)
    {
        $sql = $this->conn->prepare("UPDATE users SET nome = :nome, email = :email WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':nome', $username);
        $sql->bindParam(':email', $email);
        return $sql->execute();
    }

    public function delete($id)
    {
        $sql = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindParam(':id', $id);
        return $sql->execute();
    }
}

?>