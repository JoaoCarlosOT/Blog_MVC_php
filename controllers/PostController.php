<?php

require_once '../models/Posts.php';
require_once 'BaseController.php';

class PostController extends BaseController
{

    public function create()
{
    $this->checkAuthentication();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $data = date('Y-m-d H:i:s');
        $categoria = $_POST['categoria'];
        $descricao = $_POST['descricao'];

        if (!empty($titulo) && !empty($data) && !empty($categoria) && !empty($descricao)) {
            $postModel = new Posts();
            if ($postModel->create($titulo, $data, $categoria, $descricao)) {
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                echo 'Erro ao criar Post!';
            }
        } else {
            echo 'Todos os campos são obrigatórios!';
        }
    }
    require_once '../views/create.php';
}


    public function read()
    {
        $this->checkAuthentication();
        $postsModel = new Posts();
        $posts = $postsModel->read();
        require_once '../views/home.php';
    }

    public function detailsPost()
    {
        $this->checkAuthentication();
        $postsModel = new Posts();
        $posts = $postsModel->detailsPost();
        require_once '../views/home.php';
    }

    public function search()
    {
        $this->checkAuthentication();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pesquisa = $_POST['search'];
            $postsModel = new Posts();
            $posts = $postsModel->search($pesquisa);
            
            if ($posts === false) {
                $posts = [];
            }
            
            require_once '../views/home.php';
        }
    }
    

    public function update()
    {
        $this->checkAuthentication();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $data = date('Y-m-d H:i:s');
            $categoria = $_POST['categoria'];
            $descricao = $_POST['descricao'];

            if (!empty($id) && !empty($titulo) && !empty($data) && !empty($categoria) && !empty($descricao)) {
                $postsModel = new Posts();
                if ($postsModel->update($id, $titulo, $data, $categoria, $descricao)) {
                    header('Location: ../public/index.php?action=read');
                    exit();
                } else {
                    echo 'Erro ao atualizar usuário!';
                }
            } else {
                echo 'Todos os campos são obrigatórios!';
            }
        } 
    }

    public function delete()
    {
        $this->checkAuthentication();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $postsModel = new Posts();
            if ($postsModel->delete($id)) {
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                echo 'Erro ao deletar usuário!';
            }
        }
    }
}

?>
