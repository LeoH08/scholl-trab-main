<?php
if (session_status() === PHP_SESSION_NONE) session_start();
session_unset();
session_destroy();
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
  <title>EETAN | Login</title>
  <script>
    function toggleUserType() {
      const userType = document.getElementById("tipo_usuario").value;
      const adminNotice = document.getElementById("adminNotice");
      const maspField = document.getElementById("maspField");

      adminNotice.style.display = userType === "professor" ? "block" : "none";
      maspField.style.display = userType === "professor" ? "block" : "none";
    }
  </script>
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
    <form action="../php/cadastro.php" method="post">
      <h1>Login</h1>

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

      <div
        id="adminNotice"
        style="display: none; color: red; margin-top: 10px">
        <strong>Nota:</strong> Professores têm acesso administrativo.
      </div>

      <label for="usuario">Usuário:</label>
      <input
        type="text"
        id="usuario"
        name="usuario"
        placeholder="Digite seu nome de usuário"
        required />

      <label for="senha">Senha:</label>
      <input
        type="password"
        id="senha"
        name="senha"
        placeholder="Digite sua senha"
        required />

      <!-- Campo MASP para professores -->
      <div id="maspField" style="display: none">
        <label for="masp">MASP:</label>
        <input
          type="text"
          id="masp"
          name="masp"
          placeholder="Digite seu MASP" />
      </div>

      <button type="submit">Entrar</button>
    </form>

    <p>Não tem uma conta?</p>
    <ul>
      <li>
        <a href="../html/cadastro.php">Criar conta como Aluno</a>
      </li>
      <li>
        <a href="../html/cadastro.php">Criar conta como Professor</a>
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