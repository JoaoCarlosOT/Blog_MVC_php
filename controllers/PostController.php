<?php

require_once '../models/Posts.php';
require_once 'BaseController.php';
require_once '../utils/FlashMessage.php';

class PostController extends BaseController
{

    public function create()
{
    $this->checkAuthentication();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = addslashes($_POST['titulo']);
        $data = date('Y-m-d H:i:s');
        $categoria = addslashes($_POST['categoria']);
        $descricao = addslashes($_POST['descricao']);
        $flashMessage = new FlashMessage();

        if (!empty($titulo) && !empty($data) && !empty($categoria) && !empty($descricao)) {
            $postModel = new Posts();
            if ($postModel->create($titulo, $data, $categoria, $descricao)) {
                //$_SESSION['mensagem'] = "Post criado com sucesso!";
                $flashMessage->setMessage("Post criado com sucesso!");
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                //$_SESSION['mensagem'] = "Erro ao criar Post!";
                $flashMessage->setMessage("Erro ao criar Post!");
            }
        } else {
            //$_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
            $flashMessage->setMessage("Todos os campos são obrigatórios!");
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
            $pesquisa = addslashes($_POST['search']);
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
            $id = addslashes($_POST['id']);
            $titulo = addslashes($_POST['titulo']);
            $data = date('Y-m-d H:i:s');
            $categoria = addslashes($_POST['categoria']);
            $descricao = addslashes($_POST['descricao']);
            $flashMessage = new FlashMessage();

            if (!empty($id) && !empty($titulo) && !empty($data) && !empty($categoria) && !empty($descricao)) {
                $postsModel = new Posts();
                if ($postsModel->update($id, $titulo, $data, $categoria, $descricao)) {
                    //$_SESSION['mensagem'] = "Post editado com sucesso!";
                    $flashMessage->setMessage("Post editado com sucesso!");
                    header('Location: ../public/index.php?action=read');
                    exit();
                } else {
                    //$_SESSION['mensagem'] = "Erro ao atualizar usuário!";
                    $flashMessage->setMessage("Erro ao atualizar usuário!");
                }
            } else {
                //$_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
                $flashMessage->setMessage("Todos os campos são obrigatórios!");
            }
        } 
    }

    public function delete()
    {
        $this->checkAuthentication();

        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
            $postsModel = new Posts();
            $flashMessage = new FlashMessage();
            if ($postsModel->delete($id)) {
                //$_SESSION['mensagem'] = "Post deletado com sucesso!";
                $flashMessage->setMessage("Post deletado com sucesso!");
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                //$_SESSION['mensagem'] = "Erro ao deletar usuário!";
                $flashMessage->setMessage("Erro ao deletar usuário!");
                header('Location: ../public/index.php?action=read');
            }
        }
    }
}

?>
