<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Parabéns - Jogo Concluído</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + FontAwesome + Animate.css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c, #928dab);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
      padding-top: 80px;
    }
    .trophy {
      font-size: 80px;
      color: #ffc107;
    }
    .btn-custom {
      margin: 10px;
      padding: 12px 25px;
      font-size: 1.1rem;
    }
    .box {
      background-color: rgba(255,255,255,0.05);
      padding: 30px;
      margin: auto;
      border-radius: 12px;
      max-width: 600px;
      box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }
    .lead strong {
      color: #ffc107;
    }
  </style>
</head>
<body>

  <div class="box animate__animated animate__fadeInDown">
    <div class="trophy animate__animated animate__tada"> </div>
    <h1 class="display-5 fw-bold text-warning">Parabéns, <?= htmlspecialchars($_SESSION['nome']) ?>!</h1>
    <p class="lead mt-3">🎉 Você concluiu todos os níveis do jogo <strong>Adivinhe a Música</strong> com sucesso!</p>
    <p class="lead">Sua pontuação final foi de <strong><?= $_SESSION['pontos'] ?> pontos</strong>.</p>

    <div class="mt-4">
      <a href="ranking.php" class="btn btn-warning btn-custom">
        <i class="fas fa-trophy"></i> Ver Ranking
      </a>
      <a href="reiniciar.php" class="btn btn-success btn-custom">
        <i class="fas fa-redo-alt"></i> Jogar Novamente
      </a>
      <a href="logout.php" class="btn btn-outline-light btn-custom">
        <i class="fas fa-sign-out-alt"></i> Sair
      </a>
    </div>
  </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
