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
  <title>EETAN | Site Oficial</title>
  <script>
    function toggleFields() {
      const userType = document.getElementById("tipo_usuario").value;
      const alunoFields = document.getElementById("alunoFields");
      const professorFields = document.getElementById("professorFields");

      alunoFields.style.display = userType === "aluno" ? "block" : "none";
      professorFields.style.display =
        userType === "professor" ? "block" : "none";

      // Set required attributes dynamically
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
    }

    main {
      flex: 1 0 auto;
      margin-top: 80px;
      padding: 2rem;
      overflow-y: auto;
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
  </style>
</head>

<body>
  <?php if (session_status() === PHP_SESSION_NONE) session_start();
  $tipoUsuario = $_SESSION['tipo_usuario'] ?? null; ?>
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
    <form action="../php/controller/login.php" method="post">
      <h1>Login</h1>

      <label for="tipo_usuario">Você é:</label>
      <select
        id="tipo_usuario"
        name="tipo_usuario"
        onchange="toggleFields()"
        required>
        <option value="" disabled selected>Selecione</option>
        <option value="aluno">Aluno</option>
        <option value="professor">Professor</option>
      </select>

      <!-- Campos para Aluno -->
      <div id="alunoFields" style="display: none">
        <label for="aluno_usuario">Nome de Usuário:</label>
        <input
          type="text"
          id="aluno_usuario"
          name="aluno_usuario"
          placeholder="Digite seu nome de usuário" />

        <br /><label for="aluno_senha">Senha:</label>
        <input
          type="password"
          id="aluno_senha"
          name="aluno_senha"
          placeholder="Digite sua senha" />

        <br /><label for="aluno_codigo">Código de Matrícula:</label>
        <input
          type="text"
          id="aluno_codigo"
          name="aluno_codigo"
          placeholder="Digite o código único da matrícula" />
      </div>

      <!-- Campos para Professor -->
      <div id="professorFields" style="display: none">
        <label for="professor_usuario">E-mail institucional:</label>
        <input
          type="text"
          id="professor_usuario"
          name="professor_usuario"
          placeholder="Digite seu nome de usuário" />

        <br />
        <label for="professor_senha">Senha:</label>
        <input
          type="password"
          id="professor_senha"
          name="professor_senha"
          placeholder="Digite sua senha" />

        <br /><label for="professor_codigo">MASP:</label>
        <input
          type="text"
          id="professor_codigo"
          name="professor_codigo"
          placeholder="Digite o código fornecido pela escola" />
      </div>

      <button type="submit">Login</button>
    </form>
    <li>
      <a href="">é novo por aqui? Crie uma conta</a>
    </li>
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
</body>

</html>