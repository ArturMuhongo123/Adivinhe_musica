<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Adivinhe a Música</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c, #928dab);
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }
    .hero {
      padding: 80px 0;
      text-align: center;
    }
    .btn-lg {
      padding: 15px 30px;
      font-size: 1.3rem;
    }
    .info-box {
      background-color: rgba(255, 255, 255, 0.05);
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    footer {
      padding: 20px;
      text-align: center;
      color: #bbb;
    }
  </style>
</head>
<body>

<div class="container hero">
  <h1 class="display-4 fw-bold text-warning"> Adivinhe a Música</h1>
  <p class="lead mt-3">Teste seus conhecimentos musicais ouvindo trechos curtos e escolhendo a música correta. Ganhe pontos, avance de nível e mostre que você é um mestre dos hits!</p>

  <a href="cadastro.php" class="btn btn-outline-light btn-lg mt-4 me-2">
    <i class="fas fa-play-circle"></i> Comece Agora
  </a>
  <a href="ranking.php" class="btn btn-warning btn-lg mt-4">
    <i class="fas fa-trophy"></i> Ver Ranking
  </a>
</div>

<div class="container mt-5">
  <div class="row text-center">

    <div class="col-md-4 info-box">
      <h5><i class="fas fa-music"></i> Como Funciona</h5>
      <p>Você ouve um trecho musical de até 20 segundos e escolhe uma das 3 alternativas.</p>
    </div>

    <div class="col-md-4 info-box">
      <h5><i class="fas fa-layer-group"></i> Três Níveis</h5>
      <p>Comece no <strong>Fácil</strong>, avance para o <strong>Médio</strong> com 15 pontos e depois para o <strong>Difícil</strong> com 30!</p>
    </div>

    <div class="col-md-4 info-box">
      <h5><i class="fas fa-star"></i> Por que Jogar?</h5>
      <p>Desafie sua memória musical, divirta-se e dispute o topo do ranking!</p>
    </div>

  </div>
</div>

<footer class="mt-5">
  <small>&copy; 2025 -Todos os direitos reservados.</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
