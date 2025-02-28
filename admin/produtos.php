<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';

// Adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $preco, $imagem]);
    header('Location: produtos.php');
    exit();
}

// Excluir produto
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: produtos.php');
    exit();
}

// Buscar todos os produtos
$produtos = $pdo->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <h1>Gerenciar Produtos</h1>
    <a href="index.php">Voltar ao Dashboard</a>

    <!-- Formulário para adicionar produto -->
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome do Produto" required>
        <textarea name="descricao" placeholder="Descrição" required></textarea>
        <input type="number" step="0.01" name="preco" placeholder="Preço" required>
        <input type="text" name="imagem" placeholder="URL da Imagem">
        <button type="submit" name="adicionar">Adicionar Produto</button>
    </form>

    <!-- Lista de produtos -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= $produto['nome'] ?></td>
                    <td><?= $produto['descricao'] ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><img src="<?= $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" width="50"></td>
                    <td>
                        <a href="editar_produto.php?id=<?= $produto['id'] ?>">Editar</a>
                        <a href="?excluir=<?= $produto['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>