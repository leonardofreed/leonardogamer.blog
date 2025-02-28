<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';

// Buscar todos os clientes
$clientes = $pdo->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>
    <h1>Gerenciar Clientes</h1>
    <a href="index.php">Voltar ao Dashboard</a>

    <!-- Lista de clientes -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Bairro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente['id'] ?></td>
                    <td><?= $cliente['nome'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['endereco'] ?></td>
                    <td><?= $cliente['telefone'] ?></td>
                    <td><?= $cliente['bairro'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>