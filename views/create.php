<?php
require_once '../controllers/BaseController.php';

$verify = new BaseController;
$verify->checkAuthentication();

?>

<?php
require_once '../utils/FlashMessage.php';

$flashMessage = new FlashMessage();
$flashMessage->ShowMessage();
?>

<form method="POST" action="../public/index.php?action=create">
    <label for="title">titulo:</label>
    <input type="text" name="titulo" id="nome" required>

    <label for="desc">descrição:</label>
    <input type="text" name="descricao" id="desc" required>

    <label for="categoria">categoria:</label>
    <input type="text" name="categoria" id="categoria" required>

    <button type="submit">Criar</button>
</form>
