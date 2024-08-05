<?php
class FlashMessage
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function setMessage($message)
    {
        $_SESSION['mensagem'] = $message;
    }

    public function getMessage()
    {
        if (isset($_SESSION['mensagem'])) {
            $message = $_SESSION['mensagem'];
            unset($_SESSION['mensagem']);
            return $message;
        }
        return null;
    }

    public function ShowMessage()
    {
        $message = $this->getMessage();
        if ($message) {
            echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">';
            echo '<div class="alert alert-light" role="alert">';
            echo addslashes($message);
            echo '</div>';
        }
    }
}
?>
