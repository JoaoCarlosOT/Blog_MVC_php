<?php

require_once '../controllers/UserController.php';

require_once '../vendor/autoload.php';

$action = $_GET['action'] ?? 'read'; // Ação padrão

$userController = new UserController();

switch ($action) {
    case 'create':
        $userController->create();
        break;
    case 'read':
        $userController->read();
        break;
    case 'update':
        $userController->update();
        break;
    case 'delete':
        $userController->delete();
        break;
    default:
        echo 'Ação não encontrada.';
        break;
}

?>