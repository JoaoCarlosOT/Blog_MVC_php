<?php

require_once '../controllers/PostController.php';
require_once '../controllers/UserController.php';

require_once '../vendor/autoload.php';

$action = $_GET['action'] ?? 'read'; // Ação padrão

$PostController = new PostController();
$userController = new UserController();

switch ($action) {
    case 'cadastrar':
        $userController->create();
        break;
    case 'login':
        $userController->login();
        break; 
    case 'logout':
        $userController->logout();
        break;        
    case 'create':
        $PostController->create();
        break;
    case 'read':
        $PostController->read();
        break;
    case 'detailsPost':
        $PostController->detailsPost();
        break;
    case 'search':
        $PostController->search();
        break;        
    case 'update':
        $PostController->update();
        break;
    case 'delete':
        $PostController->delete();
        break;
    default:
        echo 'Ação não encontrada.';
        break;
}

?>