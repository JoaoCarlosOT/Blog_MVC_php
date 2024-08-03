<?php

require_once '../models/User.php';


class UserController
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['senha'];
            $senha = password_hash($password, PASSWORD_DEFAULT);

            if (!empty($username) && !empty($email) && !empty($senha)) {
                $userModel = new User();
                if ($userModel->create($username, $email, $senha)) {
                    header('Location: ../views/login.php');
                    exit();
                } else {
                    echo 'Erro ao criar usuário!';
                }
            } else {
                echo 'Todos os campos são obrigatórios!';
            }
        }
        require_once '../views/cadastro.php';
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['senha'];

            if (empty($email) || empty($password)) {
                echo 'O campo usuário/senha não foi preenchido!';
                header('Location: ../views/login.php');
                exit();
            }

            $userModel = new User();
            $user = $userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                echo 'Dados inválidos!';
                header('Location: ../views/login.php');
                exit();
            }
        } else {
            require_once '../views/login.php';
        }
    }

    public function logout()
    {
       // session_start();
        session_unset();
        session_destroy();
        header('Location: ../public/index.php?action=login');
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
