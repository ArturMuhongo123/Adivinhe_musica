<?php
session_start();

// Zera pontuação e músicas
$_SESSION['pontos'] = 0;
$_SESSION['musicas_respondidas'] = [];

// Opcional: também zera no banco
require_once 'includes/db.php';
if (isset($_SESSION['usuario_id'])) {
    $stmt = $pdo->prepare("UPDATE usuarios SET pontos = 0 WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
}

// Redireciona para o início do jogo
header("Location: jogo.php");
exit;
