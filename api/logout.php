<?php
session_start();
session_destroy(); // remove todas as variáveis de sessão
header("Location: /login.html");
exit;
?>
