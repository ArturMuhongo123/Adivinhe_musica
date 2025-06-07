<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$nome = $_SESSION['nome'];
$pontos = $_SESSION['pontos'] ?? 0;
$pontos_nivel = $_SESSION['pontos_nivel'] ?? 0;

if ($pontos < 15) {
    $nivel = 'facil';
} elseif ($pontos < 30) {
    $nivel = 'medio';
} else {
    $nivel = 'dificil';
}

if (!isset($_SESSION['respondidas'])) {
    $_SESSION['respondidas'] = ['facil' => [], 'medio' => [], 'dificil' => []];
}

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resposta = $_POST['resposta'];
    $correta = $_POST['correta'];
    $id_musica = $_POST['musica_id'];

    if ($resposta === $correta) {
        $pontos_nivel += 5;
        $_SESSION['pontos_nivel'] = $pontos_nivel;
        $mensagem = "<div class='alert alert-success animate__animated animate__bounceIn'>✅ Resposta correta! +5 pontos neste nível</div>
        <audio autoplay><source src='assets/sounds/acerto.mp3' type='audio/mpeg'></audio>";
    } else {
        $mensagem = "<div class='alert alert-danger animate__animated animate__shakeX'>❌ Resposta errada! Você perdeu os pontos deste nível. Tente novamente.</div>
        <audio autoplay><source src='assets/sounds/erro.mp3' type='audio/mpeg'></audio>";
        $pontos_nivel = 0;
        $_SESSION['pontos_nivel'] = 0;
        $_SESSION['respondidas'][$nivel] = [];
    }

    if (!in_array($id_musica, $_SESSION['respondidas'][$nivel])) {
        $_SESSION['respondidas'][$nivel][] = $id_musica;
    }

    if ($pontos_nivel >= 15) {
        $pontos += 15;
        $_SESSION['pontos'] = $pontos;
        $_SESSION['pontos_nivel'] = 0;
        $_SESSION['respondidas'][$nivel] = [];

        $stmt = $pdo->prepare("UPDATE usuarios SET pontos = ? WHERE id = ?");
        $stmt->execute([$pontos, $usuario_id]);

        if ($pontos >= 45) {
            header("Location: parabens.php");
            exit;
        }

        $mensagem = "<div class='alert alert-info animate__animated animate__fadeIn'>🎉 Parabéns! Você concluiu o nível <strong>$nivel</strong> e avançou!</div>";
    }
}

$respondidas = $_SESSION['respondidas'][$nivel];

if (!empty($respondidas)) {
    $placeholders = implode(',', array_fill(0, count($respondidas), '?'));
    $sql = "SELECT * FROM musicas WHERE nivel = ? AND id NOT IN ($placeholders) ORDER BY RAND() LIMIT 1";
    $params = array_merge([$nivel], $respondidas);
} else {
    $sql = "SELECT * FROM musicas WHERE nivel = ? ORDER BY RAND() LIMIT 1";
    $params = [$nivel];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$musica = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$musica) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Fim de Nível</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="background: linear-gradient(135deg, #1f1c2c, #928dab); color: white; text-align: center; padding-top: 80px;">
        <h1 class="text-warning">⚠️ Você já respondeu todas as músicas do nível <strong>$nivel</strong>.</h1>
        <p class="mt-3">Reinicie o jogo para tentar novamente com um novo desafio.</p>
        <a href="reiniciar.php" class="btn btn-success mt-3">🔁 Recomeçar o Jogo</a>
        <a href="logout.php" class="btn btn-outline-light mt-3">Sair</a>
    </body>
    </html>
    HTML;
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Adivinhe a Música - Jogo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c, #928dab);
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }
    .progress-bar-nivel {
      height: 20px;
      background-color: #198754;
      transition: width 0.4s ease;
      border-radius: 10px;
    }
    .progress-container {
      background-color: #343a40;
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .quiz-box {
      max-width: 750px;
      margin: 50px auto;
      background-color: rgba(255,255,255,0.05);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.4);
    }
  </style>
</head>
<body>

<div class="container quiz-box animate__animated animate__fadeInDown">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>🎮 Jogador: <?= htmlspecialchars($nome) ?></h4>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
  </div>

  <h5>
    🎯 Pontos totais: <strong><?= $pontos ?></strong> |
    Nível: <strong><?= ucfirst($nivel) ?></strong> |
    Progresso do nível: <strong><?= $pontos_nivel ?>/15</strong>
  </h5>

  <div class="progress-container mt-3">
    <div class="progress-bar-nivel" style="width: <?= ($pontos_nivel / 15) * 100 ?>%;"></div>
  </div>

  <?= $mensagem ?>

  <div class="mt-4">
    <p><strong>🎧 Ouça o trecho e escolha a música correta:</strong></p>
    <audio controls autoplay>
      <source src="<?= htmlspecialchars($musica['arquivo']) ?>" type="audio/mpeg">
      Seu navegador não suporta o áudio.
    </audio>

    <form method="POST" class="mt-4">
      <input type="hidden" name="correta" value="<?= $musica['correta'] ?>">
      <input type="hidden" name="musica_id" value="<?= $musica['id'] ?>">

      <div class="form-check mb-2">
        <input class="form-check-input" type="radio" id="a" name="resposta" value="A" required>
        <label class="form-check-label" for="a">A) <?= htmlspecialchars($musica['opcao_a']) ?></label>
      </div>
      <div class="form-check mb-2">
        <input class="form-check-input" type="radio" id="b" name="resposta" value="B">
        <label class="form-check-label" for="b">B) <?= htmlspecialchars($musica['opcao_b']) ?></label>
      </div>
      <div class="form-check mb-2">
        <input class="form-check-input" type="radio" id="c" name="resposta" value="C">
        <label class="form-check-label" for="c">C) <?= htmlspecialchars($musica['opcao_c']) ?></label>
      </div>

      <button type="submit" class="btn btn-warning mt-3">Responder</button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
