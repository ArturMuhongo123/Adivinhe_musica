<?php
session_start();
require_once 'includes/db.php';

$erro = '';
$emailDigitado = '';
$mensagem = '';

// Mensagem de sucesso após cadastro
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    $mensagem = '<div class="alert alert-success text-center animate__animated animate__fadeInDown">✅ Cadastro realizado com sucesso! Faça o login abaixo.</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $emailDigitado = htmlspecialchars($email);

    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['pontos'] = $usuario['pontos'];
            $_SESSION['pontos_nivel'] = 0;
            $_SESSION['respondidas'] = ['facil' => [], 'medio' => [], 'dificil' => []];
            header("Location: jogo.php");
            exit;
        } else {
            $erro = "Email ou senha incorretos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Login - Adivinhe a Música</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + Animate.css + FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #1f1c2c, #928dab);
      color: white;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-box {
      max-width: 450px;
      margin: 60px auto;
      padding: 30px;
      background-color: rgba(255,255,255,0.05);
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.4);
    }
    .login-box h2 {
      color: #ffc107;
    }
    .btn-login {
      background-color: #ffc107;
      border: none;
      color: #000;
      font-weight: bold;
    }
    a {
      color: #ffc107;
    }
    a:hover {
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="login-box animate__animated animate__fadeInDown">
    <h2 class="text-center mb-4"><i class="fas fa-sign-in-alt"></i> Login</h2>

    <?= $mensagem ?>

    <?php if ($erro): ?>
      <div class="alert alert-danger animate__animated animate__shakeX"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i> E-mail</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= $emailDigitado ?>" autocomplete="new-email" required>
      </div>
      <div class="mb-3">
        <label for="senha" class="form-label"><i class="fas fa-lock"></i> Senha</label>
        <input type="password" class="form-control" name="senha" id="senha" autocomplete="new-password" required>
      </div>
      <button type="submit" class="btn btn-login w-100 mt-3">Entrar</button>
    </form>

    <p class="text-center mt-4">Ainda não tem conta? <a href="cadastro.php">Cadastrar</a></p>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
