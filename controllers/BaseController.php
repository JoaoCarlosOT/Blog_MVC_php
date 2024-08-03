<?php
class BaseController
{
    public function checkAuthentication()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../public/index.php?action=login');
            exit();
        }
    }
}
?>
