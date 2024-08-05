<?php

require_once '../models/User.php';
require_once '../helpers/EmailHelper.php';
require_once '../utils/FlashMessage.php';

class UserController
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['senha']);
            $senha = password_hash($password, PASSWORD_DEFAULT);
            $flashMessage = new FlashMessage();

            if (!empty($username) && !empty($email) && !empty($senha)) {
                $userModel = new User();
                if ($userModel->create($username, $email, $senha)) {
                    $sendEmail = new Email();
                    $sendEmail->SendEmail($username, $email);
                    header('Location: ../views/login.php');
                    exit();
                } else {
                    $_SESSION['mensagem'] = "Erro ao criar usuário!";
                }
            } else {
                $_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
            }
        }
        require_once '../views/cadastro.php';
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['senha']);
            $flashMessage = new FlashMessage();

            if (empty($email) || empty($password)) {
                $_SESSION['mensagem'] = "O campo usuário/senha não foi preenchido!";
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
                $_SESSION['mensagem'] = "Dados inválidos!";
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
            $id = addslashes($_POST['id']);
            $username = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $flashMessage = new FlashMessage();

            if (!empty($id) && !empty($username) && !empty($email)) {
                $userModel = new User();
                if ($userModel->update($id, $username, $email)) {
                    header('Location: ../public/index.php?action=read');
                    exit();
                } else {
                    $_SESSION['mensagem'] = "Erro ao atualizar usuário!";
                }
            } else {
                $_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
            }
        } 
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $flashMessage = new FlashMessage();
            $userModel = new User();
            if ($userModel->delete($id)) {
                header('Location: ../public/index.php?action=read');
                exit();
            } else {
                $_SESSION['mensagem'] = "Erro ao deletar usuário!";
            }
        }
    }
}

?>
