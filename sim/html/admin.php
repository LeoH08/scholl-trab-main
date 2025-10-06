<?php if (session_status() === PHP_SESSION_NONE) session_start();
$tipoUsuario = $_SESSION['tipo_usuario'] ?? null; ?>
<?php require_once '../php/controller/auth.php';
requireLogin(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/stylelayout.css" />
  <link rel="shortcut icon" href="../fts/Logo_EETAN.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <title>EETAN | Admin</title>
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

  <main style="min-height: 60vh; padding: 40px 20px; max-width: 1000px; margin: 120px auto 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
    <h1 style="color: #213967; font-size: 2.4rem; margin-bottom: 1rem;">Bem-vindo à Área Administrativa</h1>
    <p style="font-size: 1.2rem; color: #333;">Use as ferramentas abaixo para gerenciar o site:</p>
    <div style="display: flex; flex-wrap: wrap; gap: 32px; margin-top: 32px; justify-content: flex-start;">
      <div style="background: #f2f6ff; border-radius: 10px; box-shadow: 0 2px 8px rgba(33,57,103,0.08); padding: 32px 28px; min-width: 260px; max-width: 340px; flex: 1; display: flex; flex-direction: column; align-items: center;">
        <i class="bi bi-people-fill" style="font-size: 2.5rem; color: #213967; margin-bottom: 12px;"></i>
        <h2 style="color: #213967; font-size: 1.3rem; margin-bottom: 10px;">Gerenciar Matrículas</h2>
        <p style="color: #333; font-size: 1rem; margin-bottom: 18px; text-align: center;">Visualize, edite e exclua matrículas de alunos cadastrados.</p>
        <a href="../php/lista_matriculas.php" style="background: #213967; color: #fff; padding: 10px 28px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: background 0.2s;">Acessar Matrículas</a>
      </div>
      <div style="background: #f2f6ff; border-radius: 10px; box-shadow: 0 2px 8px rgba(33,57,103,0.08); padding: 32px 28px; min-width: 260px; max-width: 340px; flex: 1; display: flex; flex-direction: column; align-items: center;">
        <i class="bi bi-person-check-fill" style="font-size: 2.5rem; color: #213967; margin-bottom: 12px;"></i>
        <h2 style="color: #213967; font-size: 1.3rem; margin-bottom: 10px;">Acessar Boletim</h2>
        <p style="color: #333; font-size: 1rem; margin-bottom: 18px; text-align: center;">Consulte e gerencie os boletins dos alunos cadastrados.</p>
        <a href="../html/boletim.php" style="background: #213967; color: #fff; padding: 10px 28px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: background 0.2s;">Acessar Boletim</a>
      </div>
      <div style="background: #f2f6ff; border-radius: 10px; box-shadow: 0 2px 8px rgba(33,57,103,0.08); padding: 32px 28px; min-width: 260px; max-width: 340px; flex: 1; display: flex; flex-direction: column; align-items: center;">
        <i class="bi bi-journal-text" style="font-size: 2.5rem; color: #213967; margin-bottom: 12px;"></i>
        <h2 style="color: #213967; font-size: 1.3rem; margin-bottom: 10px;">Acessar Chamada</h2>
        <p style="color: #333; font-size: 1rem; margin-bottom: 18px; text-align: center;">Consulte e gerencie as chamadas dos alunos cadastrados.</p>
        <a href="../html/chamada.php" style="background: #213967; color: #fff; padding: 10px 28px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 1.1rem; transition: background 0.2s;">Acessar Chamada</a>
      </div>
      <!-- Adicione outros cards administrativos aqui se desejar -->
    </div>
  </main>

  <footer class="footer-content">
    <div class="footer-social">
      <a href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR" target="_blank"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/eetan.cf/" target="_blank"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-instagram"></i></a>
      <a href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu" target="_blank" title="Localização"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-geo-alt-fill"></i></a>
    </div>
    <div class="footer-info">
      <p style="color: aliceblue; margin: 0">&copy; 2024 ETAN - Escola Estadual Tancredo de Almeida Neves</p>
      <p style="margin: 0">
        <a target="_blank" style="color: aliceblue" href="https://api.whatsapp.com/send/?phone=31996013814&text&type=phone_number&app_absent=0"><i class="bi bi-whatsapp"></i> Contato</a>
        |
        <a style="color: aliceblue" href="../html/politica.php">
          <i class="bi bi-shield-lock"></i> Política de Privacidade
        </a>
      </p>
    </div>
  </footer>
</body>

</html>