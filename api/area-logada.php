<?php
session_start();

// Se não tiver logado, redireciona para login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Área Logada</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Conteúdo restrito aqui...</p>
    <a href="logout.php">Sair</a>
</body>
</html>
