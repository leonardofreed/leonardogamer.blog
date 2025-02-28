<?php
require_once 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce - leonardogamer.blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .message {
            padding: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao E-commerce - leonardogamer.blog</h1>
        <?php
        try {
            // Exibe uma mensagem de sucesso
            echo '<div class="message">Conexão com o banco de dados estabelecida com sucesso!</div>';
        } catch (PDOException $e) {
            // Exibe uma mensagem de erro
            echo '<div class="message">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</div>';
        }
        ?>
    </div>
</body>
</html>