<form method="POST" action="../public/index.php?action=update">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

    <label for="nome">Username:</label>
    <input type="text" name="nome" id="nome"  required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <button type="submit">Atualizar</button>
</form>
