<h1>Usuários</h1>
<table>
    <a href="../views/create.php">Criar usuário</a>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo htmlspecialchars($user['id']); ?></td>
        <td><?php echo htmlspecialchars($user['nome']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td>
            <a href="../views/update.php?id=<?php echo $user['id']; ?>">Editar</a>
            <a href="../public/index.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
