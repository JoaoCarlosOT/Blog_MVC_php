<?php

require_once '../config/Database.php';
require_once '../controllers/BaseController.php';
session_start();

class Posts extends BaseController
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($titulo, $data, $categoria, $descricao)
    {
        $sql = $this->conn->prepare("INSERT INTO `posts`(`titulo`, `data`, `categoria`, `descricao`, `user_id`) VALUES (:titulo, :data, :categoria, :descricao, :user_id)");
        $sql->bindParam(':titulo', $titulo);
        $sql->bindParam(':data', $data);
        $sql->bindParam(':categoria', $categoria);
        $sql->bindParam(':descricao', $descricao);
        $sql->bindValue(':user_id', $_SESSION['user_id']);
        return $sql->execute();
    }

    public function read()
    {
        $sql = $this->conn->prepare("SELECT * FROM posts WHERE user_id = :user_id");
        $sql->bindValue(':user_id', $_SESSION['user_id']);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detailsPost($id)
    {
        $sql = $this->conn->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
        $sql->bindValue(':user_id', $_SESSION['user_id']);
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function search($pesquisa)
    {
        $sql = $this->conn->prepare("SELECT * FROM posts WHERE (titulo LIKE :pesquisa OR categoria LIKE :pesquisa) AND user_id = :user_id");
        $pesquisaParam = '%' . $pesquisa . '%';
        $sql->bindParam(':pesquisa', $pesquisaParam);
        $sql->bindValue(':user_id', $_SESSION['user_id']);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $titulo, $data, $categoria, $descricao)
    {
        $sql = $this->conn->prepare("UPDATE posts SET titulo = :titulo, data = :data, categoria = :categoria, descricao = :descricao WHERE id = :id AND user_id = :user_id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':titulo', $titulo);
        $sql->bindParam(':data', $data);
        $sql->bindParam(':categoria', $categoria);
        $sql->bindParam(':descricao', $descricao);
        $sql->bindValue(':user_id', $_SESSION['user_id']);
        return $sql->execute();
    }

    public function delete($id)
    {
        $sql = $this->conn->prepare("DELETE FROM posts WHERE id = :id AND user_id = :user_id");
        $sql->bindParam(':id', $id);
        $sql->bindValue(':user_id', $_SESSION['user_id']);
        return $sql->execute();
    }
}

?>
