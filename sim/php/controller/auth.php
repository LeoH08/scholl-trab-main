<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function requireLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../html/cadastro.php');
        exit();
    }
}
?>