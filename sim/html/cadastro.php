<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$tipoUsuarioSessao = $_SESSION['tipo_usuario'] ?? null;

// mensagens de feedback (?error=...&success=1)
$erro    = isset($_GET['error'])   ? trim($_GET['error'])   : '';
$sucesso = isset($_GET['success']) ? (bool)$_GET['success'] : false;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/stylecadastro1.css" />
  <link rel="shortcut icon" href="../fts/Logo_EETAN.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
  <title>EETAN | Login</title>
  <script>
    function toggleFields() {
      const userType = document.getElementById("tipo_usuario").value;
      const alunoFields = document.getElementById("alunoFields");
      const professorFields = document.getElementById("professorFields");

      if (!alunoFields || !professorFields) return;

      alunoFields.style.display = userType === "aluno" ? "block" : "none";
      professorFields.style.display = userType === "professor" ? "block" : "none";

      Array.from(alunoFields.querySelectorAll("input")).forEach(
        (input) => (input.required = userType === "aluno")
      );
      Array.from(professorFields.querySelectorAll("input")).forEach(
        (input) => (input.required = userType === "professor")
      );
    }
  </script>
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      font-family: 'Roboto', system-ui, sans-serif;
    }

    main {
      flex: 1 0 auto;
      margin-top: 80px;
      padding: 2rem;
      overflow-y: auto;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }

    .login-wrapper {
      width: 100%;
      max-width: 520px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 16px 32px rgba(15, 23, 42, 0.16);
      padding: 24px 24px 20px;
    }

    .login-wrapper h1 {
      margin: 0 0 4px;
      font-family: 'Montserrat', system-ui, sans-serif;
      font-size: 1.6rem;
      color: #111827;
    }

    .login-subtitle {
      margin: 0 0 16px;
      font-size: .95rem;
      color: #4b5563;
    }

    .alert {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 10px;
      margin-bottom: 12px;
      border-radius: 8px;
      font-size: .9rem;
    }

    .alert-error {
      background: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fecaca;
    }

    .alert-success {
      background: #ecfdf3;
      color: #15803d;
      border: 1px solid #bbf7d0;
    }

    footer.footer-content {
      flex-shrink: 0;
      width: 100%;
      position: fixed;
      left: 0;
      bottom: 0;
      background: #213967;
      z-index: 100;
    }

    table {
      max-height: 400px;
      overflow-y: auto;
      display: block;
    }

    .auth-container {
      position: relative;
      width: 850px;
      max-width: 100%;
      height: 520px;
      max-height: calc(100vh - 200px);
      background: #fff;
      margin: 0 auto;
      border-radius: 30px;
      box-shadow: 0 0 30px rgba(0, 0, 0, .2);
      overflow: hidden;
    }

    .auth-form-box {
      position: absolute;
      right: 0;
      width: 50%;
      height: 100%;
      background: #fff;
      display: flex;
      align-items: center;
      color: #333;
      text-align: center;
      padding: 32px 40px;
      z-index: 1;
      transition: .6s ease-in-out 1.2s, visibility 0s 1s;
    }

    .auth-form-box form {
      width: 100%;
      text-align: left;
    }

    .auth-form-box h1 {
      font-family: 'Montserrat', system-ui, sans-serif;
      font-size: 1.8rem;
      margin: 0 0 8px;
      text-align: center;
      color: #111827;
    }

    .auth-form-subtitle {
      font-size: .95rem;
      color: #4b5563;
      text-align: center;
      margin-bottom: 14px;
    }

    .auth-input-box {
      position: relative;
      margin: 16px 0;
    }

    .auth-input-box input,
    .auth-input-box select {
      width: 100%;
      padding: 11px 40px 11px 14px;
      background: #f3f4f6;
      border-radius: 10px;
      border: 1px solid #e5e7eb;
      outline: none;
      font-size: .95rem;
      color: #111827;
    }

    .auth-input-box i {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 18px;
      color: #6b7280;
    }

    .auth-btn {
      width: 100%;
      height: 46px;
      background: #2563eb;
      border-radius: 999px;
      border: none;
      cursor: pointer;
      font-size: .95rem;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 10px 20px rgba(37, 99, 235, .35);
      margin-top: 10px;
    }

    .auth-toggle-box {
      position: absolute;
      width: 100%;
      height: 100%;
    }

    .auth-toggle-box::before {
      content: '';
      position: absolute;
      left: -250%;
      width: 300%;
      height: 100%;
      background: #2563eb;
      border-radius: 150px;
      z-index: 0;
      transition: 1.8s ease-in-out;
    }

    .auth-toggle-panel {
      position: absolute;
      width: 50%;
      height: 100%;
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 1;
      padding: 0 30px;
      text-align: center;
      transition: .6s ease-in-out;
    }

    .auth-toggle-panel h2 {
      font-size: 1.7rem;
      margin-bottom: 10px;
    }

    .auth-toggle-panel p {
      font-size: .95rem;
      margin-bottom: 18px;
    }

    .auth-toggle-panel .auth-btn-outline {
      width: 170px;
      height: 44px;
      background: transparent;
      border-radius: 999px;
      border: 2px solid #fff;
      cursor: pointer;
      color: #fff;
      font-weight: 600;
      font-size: .9rem;
    }

    .auth-toggle-left {
      left: 0;
    }

    .auth-toggle-right {
      right: -50%;
    }

    .auth-container.active .auth-form-box {
      right: 50%;
    }

    .auth-container.active .auth-toggle-box::before {
      left: 50%;
    }

    .auth-container.active .auth-toggle-left {
      left: -50%;
    }

    .auth-container.active .auth-toggle-right {
      right: 0;
    }

    @media screen and (max-width: 800px) {
      .auth-form-box {
        width: 100%;
        padding: 24px 20px;
      }

      .auth-toggle-panel {
        display: none;
      }

      .auth-toggle-box::before {
        display: none;
      }
    }
  </style>
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
        <?php if (!isset($tipoUsuarioSessao) || $tipoUsuarioSessao !== 'aluno'): ?>
          <li><a href="../html/matricula.php">Matricula</a></li>
        <?php endif; ?>
        <?php if (isset($tipoUsuarioSessao) && in_array($tipoUsuarioSessao, ['professor', 'aluno'], true)): ?>
          <li><a href="../html/boletim.php">Boletim</a></li>
        <?php endif; ?>
        <li><a href="../html/cadastro.php"><i class="bi bi-person-circle"></i></a></li>
        <?php if ($tipoUsuarioSessao): ?>
          <li><a href="../php/controller/logout.php" style="color:#e74c3c;"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main>
    <div class="auth-container" id="authContainer">
      <!-- Caixa de LOGIN (lado direito no desktop) -->
      <div class="auth-form-box">
        <form action="../php/controller/login.php" method="post">
          <h1>Entrar</h1>
          <p class="auth-form-subtitle">
            Acesse sua conta como <strong>Aluno</strong> ou <strong>Professor</strong>.
          </p>

          <?php if ($erro): ?>
            <div class="alert alert-error">
              <i class="bi bi-exclamation-triangle-fill"></i>
              <span><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
          <?php endif; ?>

          <?php if ($sucesso): ?>
            <div class="alert alert-success">
              <i class="bi bi-check-circle-fill"></i>
              <span>Conta criada com sucesso. Faça login abaixo.</span>
            </div>
          <?php endif; ?>

          <div class="auth-input-box">
            <select
              id="tipo_usuario"
              name="tipo_usuario"
              onchange="toggleFields()"
              required>
              <option value="" disabled selected>Você é...</option>
              <option value="aluno">Aluno</option>
              <option value="professor">Professor</option>
            </select>
            <i class="bi bi-people"></i>
          </div>
          <p style="margin:4px 0 10px;font-size:.85rem;color:#6b7280;">
            Alunos usam CPF ou usuário fornecido pela escola.
            Professores usam e‑mail institucional e MASP.
          </p>

          <!-- Campos para Aluno -->
          <div id="alunoFields" style="display: none; margin-top: 4px;">
            <div class="auth-input-box">
              <input
                type="text"
                id="aluno_usuario"
                name="aluno_usuario"
                placeholder="Email" />
              <i class="bi bi-person"></i>
            </div>
            <div class="auth-input-box">
              <input
                type="password"
                id="aluno_senha"
                name="aluno_senha"
                placeholder="Senha" />
              <i class="bi bi-lock"></i>
            </div>
          </div>

          <!-- Campos para Professor -->
          <div id="professorFields" style="display: none; margin-top: 4px;">
            <div class="auth-input-box">
              <input
                type="text"
                id="professor_usuario"
                name="professor_usuario"
                placeholder="E-mail institucional" />
              <i class="bi bi-envelope"></i>
            </div>
            <div class="auth-input-box">
              <input
                type="password"
                id="professor_senha"
                name="professor_senha"
                placeholder="Senha" />
              <i class="bi bi-lock"></i>
            </div>
            <div class="auth-input-box">
              <input
                type="text"
                id="professor_codigo"
                name="professor_codigo"
                placeholder="MASP" />
              <i class="bi bi-person-badge"></i>
            </div>
          </div>

          <button type="submit" class="auth-btn">Entrar</button>
        </form>
      </div>

      <!-- Painéis de toggle (lado esquerdo / direito) -->
      <div class="auth-toggle-box">
        <div class="auth-toggle-panel auth-toggle-left">
          <h2>Olá, seja bem-vindo!</h2>
          <p>Ainda não tem uma conta? Crie seu acesso para utilizar o sistema.</p>
          <button
            type="button"
            class="auth-btn-outline"
            onclick="window.location.href='../html/cadastro.php'">
            Realizar 
          </button>
        </div>

        <div class="auth-toggle-panel auth-toggle-right">
          <h2>Bem-vindo de volta!</h2>
          <p>Se você já tem cadastro, basta entrar com suas credenciais.</p>
          <button
            type="button"
            class="auth-btn-outline"
            onclick="document.getElementById('authContainer').classList.remove('active')">
            Já tenho conta
          </button>
        </div>
      </div>
    </div>
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
      <p style="color: aliceblue; margin: 0; ">
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

  <script>
    (function() {
      const container = document.getElementById('authContainer');
      // Se quiser começar com o painel "registro" destacado, ative:
      // container.classList.add('active');

      // Garante que os campos corretos sejam mostrados ao recarregar com algum tipo já selecionado
      document.addEventListener('DOMContentLoaded', toggleFields);
    })();
  </script>
</body>

</html>