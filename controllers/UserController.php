<?php

require_once '../models/User.php';

class UserController
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['nome'];
            $email = $_POST['email'];

            if (!empty($username) && !empty($email)) {
                $userModel = new User();
                if ($userModel->create($username, $email)) {
                    header('Location: ../public/index.php?action=read');
                    exit();
                } else {
                    echo 'Erro ao criar usuário!';
                }
            } else {
                echo 'Todos os campos são obrigatórios!';
            }
        }
        require_once '../views/create.php';
    }

    public function read()
    {
        $userModel = new User();
        $users = $userModel->read();
        require_once '../views/read.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $username = $_POST['nome'];
            $email = $_POST['email'];

            if (!empty($id) && !empty($username) && !empty($email)) {
                $userModel = new User();
                if ($userModel->update($id, $username, $email)) {
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
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $userModel = new User();
            if ($userModel->delete($id)) {
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                echo 'Erro ao deletar usuário!';
            }
        }
    }
}

?>
