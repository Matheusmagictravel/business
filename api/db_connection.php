<?php
// db_connection.php

$host     = 'localhost'; 
$port     = 3306; 
$user     = 'tr3ban33_magictravelbp'; 
$password = 'Magic2023$$$'; 
$database = 'tr3ban33_magictravel_business';

try {
    // DSN de conexão
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8";

    // Cria a instância de PDO
    $pdo = new PDO($dsn, $user, $password);

    // Configura para lançar exceção em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // (Opcional) você pode testar a conexão descomentando a linha abaixo
    // echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro na conexão ao banco de dados: " . $e->getMessage();
    exit;
}
