<?php
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT nome, pontos FROM usuarios ORDER BY pontos DESC LIMIT 10");
$ranking = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Ranking - Adivinhe a Música</title>
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
    }
    .ranking-box {
      max-width: 700px;
      margin: 60px auto;
      padding: 30px;
      background-color: rgba(255,255,255,0.05);
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.4);
    }
    .table-dark td,
    .table-dark th {
      background-color: transparent;
    }
    .top1 {
      background-color: rgba(255, 193, 7, 0.2) !important;
      font-weight: bold;
    }
    .btn-voltar {
      background-color: #ffc107;
      border: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="ranking-box animate__animated animate__fadeInDown">
  <h2 class="text-center text-warning mb-4"><i class="fas fa-trophy"></i> Ranking dos Melhores Jogadores</h2>

  <table class="table table-dark table-hover text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Pontos</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ranking as $i => $user): ?>
      <tr class="<?= $i === 0 ? 'top1' : '' ?>">
        <td><?= $i + 1 ?> <?= $i === 0 ? '🥇' : '' ?></td>
        <td><?= htmlspecialchars($user['nome']) ?></td>
        <td><?= $user['pontos'] ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-voltar">
      <i class="fas fa-arrow-left"></i> Voltar ao Início
    </a>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
