<?php
require_once '../controllers/BaseController.php';

$verify = new BaseController;
$verify->checkAuthentication();

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="../public/index.php?action=logout" onclick="return confirm('Tem certeza?');">logout</a>    
<h1>posts</h1>
<style>
 .description{
    width:180px;
    font-size:5px;
 }
</style>
<table>

    <div>
    <form action="../public/index.php?action=search" method="POST">

        <input type="text" placeholder="pesquise algo" name="search" required>

        <button type="submit">Pesquisar</button>
    </form>
    </div><br>
   
    <a href="../views/create.php">Criar Post</a><br>
    <?php
        require_once '../utils/FlashMessage.php';

        $flashMessage = new FlashMessage();
        $flashMessage->ShowMessage();
    ?>
    <tr>
        <th>titulo</th>
        <th>descrição</th>
        <th>data</th>
        <th>categoria</th>
        <th>Ações</th>
    </tr>
    <?php if (!empty($posts)){ ?>
        <?php foreach ($posts as $post){ ?>
        <tr>
            <td><?php echo $post['titulo']; ?></td>
            <td class="description"><?php echo $post['descricao']; ?></td>
            <td><?php echo $post['data']; ?></td>
            <td><?php echo $post['categoria']; ?></td>
            <td>
                <a href="../views/update.php?id=<?php echo $post['id']; ?>">Editar</a>
                <a href="../public/index.php?action=delete&id=<?php echo $post['id']; ?>" onclick="return confirm('Tem certeza?');">Excluir</a>
            </td>
        </tr>
        <?php }; ?>
    <?php } else{ ?>
        <tr>
            <td colspan="5">Nenhum post encontrado.</td>
        </tr>
    <?php }; ?>
</table>
</body>
</html>
