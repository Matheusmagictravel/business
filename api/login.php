<?php
session_start();
require_once __DIR__ . '/../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);

    // Buscar usuário no banco
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifica a senha
        if (password_verify($pass, $user['password'])) {
            // Salvar informação de usuário na sessão
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Redirecionar para área logada ou retornar dados
            echo "Login bem-sucedido!";
            // header("Location: /area-logada.php");
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
