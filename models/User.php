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

    public function create($username, $email)
    {
        $sql = $this->conn->prepare("INSERT INTO users (nome, email) VALUES (:nome, :email)");
        $sql->bindParam(':nome', $username);
        $sql->bindParam(':email', $email);
        return $sql->execute();
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