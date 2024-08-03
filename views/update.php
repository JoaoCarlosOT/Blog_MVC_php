<?php
require_once '../controllers/BaseController.php';

$verify = new BaseController;
$verify->checkAuthentication();

?>
<form method="POST" action="../public/index.php?action=update">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <label for="title">titulo:</label>
    <input type="text" name="titulo" id="nome" required>

    <label for="desc">descrição:</label>
    <input type="text" name="descricao" id="desc" required>

    <label for="categoria">categoria:</label>
    <input type="text" name="categoria" id="categoria" required>

    <button type="submit">Atualizar</button>
</form>
