<?php
if (session_status() === PHP_SESSION_NONE) session_start();
session_unset();
session_destroy();
session_start();

$tipoUsuario = $_SESSION['tipo_usuario'] ?? null;
$erroCadastro    = isset($_GET['errorCadastro'])   ? trim($_GET['errorCadastro'])   : '';
$sucessoCadastro = isset($_GET['successCadastro']) ? (bool)$_GET['successCadastro'] : false;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/stylelogin.css" />
  <link rel="stylesheet" href="../css/styleheaderfooter.css" />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <title>EETAN | Criar conta</title>
  <script>
    function toggleUserType() {
      const userType = document.getElementById("tipo_usuario").value;
      const maspField = document.getElementById("maspField");
      maspField.style.display = userType === "professor" ? "block" : "none";
    }
  </script>
</head>

<body>
  <header class="content">
    <div class="logo">
      <a href="../html/index.php">
        <img src="../fts/Logo_EETAN.png" alt="logo_escola" />
        <h3>EETAN</h3>
      </a>
    </div>
    <nav>
      <ul class="list-menu">
        <li><a href="../html/sobre.php">Sobre</a></li>
        <li><a href="../html/cursos.php">Cursos</a></li>
        <li><a href="../html/direcao.php">Direção</a></li>
        <li><a href="../html/CorpoDocente.php">Professores</a></li>
        <?php if (!isset($tipoUsuario) || $tipoUsuario !== 'aluno'): ?>
          <li><a href="../html/matricula.php">Matricula</a></li>
        <?php endif; ?>
        <?php if (isset($tipoUsuario) && in_array($tipoUsuario, ['professor', 'aluno'], true)): ?>
          <li><a href="../html/boletim.php">Boletim</a></li>
        <?php endif; ?>
        <li><a href="../html/cadastro.php"><i class="bi bi-person-circle"></i></a></li>
        <?php if ($tipoUsuario): ?>
          <li><a href="../php/controller/logout.php" style="color:#e74c3c;"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <main>
    <form action="../php/cadastro.php" method="post">
      <h1>Criar conta</h1>
      <p style="margin-top:4px;margin-bottom:10px;font-size:.95rem;color:#4b5563;">
        Cadastre-se como <strong>Aluno</strong> ou <strong>Professor</strong> para acessar o sistema.
      </p>

      <?php if ($erroCadastro): ?>
        <div style="background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;padding:8px 10px;border-radius:8px;margin-bottom:10px;font-size:.9rem;">
          <i class="bi bi-exclamation-triangle-fill"></i>
          <?php echo htmlspecialchars($erroCadastro, ENT_QUOTES, 'UTF-8'); ?>
        </div>
      <?php endif; ?>

      <?php if ($sucessoCadastro): ?>
        <div style="background:#ecfdf3;border:1px solid #bbf7d0;color:#15803d;padding:8px 10px;border-radius:8px;margin-bottom:10px;font-size:.9rem;">
          <i class="bi bi-check-circle-fill"></i>
          Conta criada com sucesso. Você já pode fazer login.
        </div>
      <?php endif; ?>

      <label for="tipo_usuario">Você é:</label>
      <select
        id="tipo_usuario"
        name="tipo_usuario"
        onchange="toggleUserType()"
        required>
        <option value="" disabled selected>Selecione</option>
        <option value="aluno">Aluno</option>
        <option value="professor">Professor</option>
      </select>

      <label for="nome">Nome completo:</label>
      <input
        type="text"
        id="nome"
        name="nome"
        placeholder="Digite seu nome completo"
        required />

      <label for="email">E-mail:</label>
      <input
        type="email"
        id="email"
        name="email"
        placeholder="Seu e-mail para contato/login"
        required />

      <label for="usuario">Usuário:</label>
      <input
        type="text"
        id="usuario"
        name="usuario"
        placeholder="CPF (apenas números) ou usuário desejado"
        required />

      <label for="senha">Senha:</label>
      <input
        type="password"
        id="senha"
        name="senha"
        placeholder="Crie uma senha"
        required />

      <label for="senha_confirmacao">Confirmar senha:</label>
      <input
        type="password"
        id="senha_confirmacao"
        name="senha_confirmacao"
        placeholder="Repita a senha"
        required />

      <div id="maspField" style="display: none">
        <label for="masp">MASP (somente professores):</label>
        <input
          type="text"
          id="masp"
          name="masp"
          placeholder="Digite seu MASP" />
      </div>

      <button type="submit">Criar conta</button>
    </form>

    <p>Já tem uma conta?</p>
    <ul>
      <li>
        <a href="../html/cadastro.php">Entrar (login)</a>
      </li>
    </ul>
  </main>
  <footer class="footer-content">
    <div class="footer-social">
      <ul class="list-menu footer-bibi">
        <li>
          <a
            href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR"
            target="_blank"
            title="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
        </li>
        <li>
          <a
            href="https://www.instagram.com/eetan.cf/"
            target="_blank"
            title="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
        </li>
        <li>
          <a
            href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu"
            target="_blank"
            title="Localização">
            <i class="bi bi-geo-alt-fill"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="footer-info">
      <p style="color: aliceblue; margin: 0">
        &copy; 2024 ETAN - Escola Estadual Tancredo de Almeida Neves
      </p>
      <p style="margin: 0">
        <a
          target="_blank"
          style="color: aliceblue"
          href="https://api.whatsapp.com/send/?phone=31996013814&text&type=phone_number&app_absent=0"><i class="bi bi-whatsapp"></i> Contato</a>
        |
        <a style="color: aliceblue" href="../html/politica.php">
          <i class="bi bi-shield-lock"></i> Política de Privacidade
        </a>
      </p>
    </div>
  </footer>
</body>

</html>