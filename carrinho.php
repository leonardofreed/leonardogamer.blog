<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['cliente_id'])) {
    header('Location: login.php');
    exit();
}

$cliente_id = $_SESSION['cliente_id'];

// Adicionar produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    $stmt = $pdo->prepare("INSERT INTO carrinho (cliente_id, produto_id, quantidade) VALUES (?, ?, ?)");
    $stmt->execute([$cliente_id, $produto_id, $quantidade]);
    header('Location: carrinho.php');
    exit();
}

// Buscar produtos no carrinho
$carrinho = $pdo->prepare("
    SELECT p.nome, p.preco, car.quantidade 
    FROM carrinho car
    JOIN produtos p ON car.produto_id = p.id
    WHERE car.cliente_id = ?
");
$carrinho->execute([$cliente_id]);
$itens = $carrinho->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles/carrinho.css">
</head>
<body>
    <h1>Carrinho de Compras</h1>
    <a href="index.php">Continuar Comprando</a>

    <!-- Lista de itens no carrinho -->
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Preço Unitário</th>
                <th>Quantidade</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itens as $item): ?>
                <tr>
                    <td><?= $item['nome'] ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($item['quantidade'] * $item['preco'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>