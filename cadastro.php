<?php
require_once 'includes/db.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    if (empty($nome) || empty($email) || empty($_POST['senha'])) {
        $erro = "Todos os campos são obrigatórios.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $senha]);
            header("Location: login.php?sucesso=1");
            exit;
        } catch (PDOException $e) {
            $erro = ($e->getCode() == 23000) ? "Este e-mail já está cadastrado." : "Erro: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - Adivinhe a Música</title>
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
    .cadastro-box {
      max-width: 500px;
      margin: 60px auto;
      padding: 30px;
      background-color: rgba(255,255,255,0.05);
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.4);
    }
    .cadastro-box h2 {
      color: #ffc107;
    }
    .btn-cadastrar {
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
  <div class="cadastro-box animate__animated animate__fadeInDown">
    <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Criar Conta</h2>

    <?php if ($erro): ?>
      <div class="alert alert-danger animate__animated animate__shakeX"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <label for="nome" class="form-label"><i class="fas fa-user"></i> Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" autocomplete="new-name" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label"><i class="fas fa-envelope"></i> E-mail</label>
        <input type="email" class="form-control" name="email" id="email" autocomplete="new-email" required>
      </div>
      <div class="mb-3">
        <label for="senha" class="form-label"><i class="fas fa-lock"></i> Senha</label>
        <input type="password" class="form-control" name="senha" id="senha" autocomplete="new-password" required>
      </div>
      <button type="submit" class="btn btn-cadastrar w-100 mt-3">Cadastrar</button>
    </form>

    <p class="text-center mt-4">Já tem conta? <a href="login.php">Fazer login</a></p>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
