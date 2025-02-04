<?php
session_start();
require_once __DIR__ . '/../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);

    // Buscar usuário no banco
    $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = :email LIMIT 1");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Caso o usuário não exista
        // Podemos redirecionar de volta ao login ou exibir mensagem
        // Exemplo: redirecionar com parâmetro de erro
        header("Location: /login.html?error=notfound");
        exit;
    }

    // Verifica a senha
    if (!password_verify($pass, $user['password'])) {
        // Senha incorreta: redireciona ou exibe erro
        header("Location: /login.html?error=password");
        exit;
    }

    // Se chegou aqui, está tudo certo
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_name'] = $user['name'];

    // Redireciona para o subdomínio após login bem-sucedido
    header("Location: https://business.magictraveltur.com");
    exit;
}
?>
