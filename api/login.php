<?php
session_start();
require_once __DIR__ . '/../config/db_connection.php';

// Garante que só aceita requisições via POST:
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Se alguém acessar diretamente via URL, redireciona pro formulário
    header('Location: /login.html');
    exit;
}

$email = trim($_POST['email'] ?? '');
$pass  = trim($_POST['password'] ?? '');

// Opcional: se email ou senha vierem vazios, redireciona ou exibe erro
if ($email === '' || $pass === '') {
    // Você pode redirecionar com um parâmetro de erro
    // header("Location: /login.html?erro=campos_vazios");
    echo "Preencha email e senha!";
    exit;
}

// Buscar usuário no banco
$stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = :email LIMIT 1");
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Usuário não foi encontrado
    // header("Location: /login.html?erro=usuario_inexistente");
    echo "Usuário não encontrado.";
    exit;
}

// Se chegou aqui, usuário existe. Verifica a senha:
if (!password_verify($pass, $user['password'])) {
    // header("Location: /login.html?erro=senha_incorreta");
    echo "Senha incorreta.";
    exit;
}

// Se chegou aqui, a senha confere!
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['name'];

// Redireciona para a área logada
header("Location: https://business.magictraveltur.com");
exit;
