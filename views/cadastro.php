
<h1>Cadastro</h1>
<form method="POST" action="../public/index.php?action=cadastrar">
    <label for="nome">Username:</label>
    <input type="text" name="nome" id="nome" required>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>
    <button type="submit">Criar</button>
</form>
<a href="login.php">login</a>
