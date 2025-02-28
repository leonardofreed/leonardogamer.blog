<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';

// Buscar todos os pedidos (exemplo básico)
$pedidos = $pdo->query("
    SELECT c.nome AS cliente_nome, p.nome AS produto_nome, car.quantidade, p.preco 
    FROM carrinho car
    JOIN clientes c ON car.cliente_id = c.id
    JOIN produtos p ON car.produto_id = p.id
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos</title>
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <h1>Gerenciar Pedidos</h1>
    <a href="index.php">Voltar ao Dashboard</a>

    <!-- Lista de pedidos -->
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?= $pedido['cliente_nome'] ?></td>
                    <td><?= $pedido['produto_nome'] ?></td>
                    <td><?= $pedido['quantidade'] ?></td>
                    <td>R$ <?= number_format($pedido['preco'], 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($pedido['quantidade'] * $pedido['preco'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>