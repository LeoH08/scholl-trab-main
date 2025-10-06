<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<?php require_once '../php/controller/auth.php';
requireLogin(); ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ETAN - Corpo Docente</title>
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      list-style: none;
      border: none;
      text-decoration: none;
      font-family: "Montserrat", sans-serif;
    }

    html {
      width: 100vw;
      height: 100vh;
      font-size: 62.5%;
      overflow-x: hidden;
    }

    body {
      background-color: #f4f4f4;
      color: #333;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      padding: 40px 20px;
      max-width: 90%;
      margin: 120px auto 40px auto;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      flex: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    main:hover {
      transform: none;
      /* Remove scaling effect */
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      /* Keep original shadow */
    }

    main h2 {
      color: #1a73e8;
      border-bottom: 3px solid #1a73e8;
      padding-bottom: 10px;
      margin-bottom: 30px;
      font-size: 3rem;
      text-align: center;
      opacity: 1;
      /* Set to visible */
    }

    main h3 {
      color: #1a73e8;
      margin-top: 30px;
      margin-bottom: 15px;
      font-size: 2.4rem;
      text-align: left;
      border-left: 5px solid #1a73e8;
      padding-left: 10px;
      opacity: 1;
      /* Set to visible */
    }

    main h4 {
      color: #1a73e8;
      margin-top: 20px;
      margin-bottom: 10px;
      font-size: 2rem;
      text-align: left;
      border-left: 4px solid #1a73e8;
      padding-left: 8px;
      opacity: 1;
      /* Set to visible */
    }

    main h5 {
      color: #1a73e8;
      margin-top: 15px;
      margin-bottom: 8px;
      font-size: 1.8rem;
      text-align: left;
      border-left: 3px solid #1a73e8;
      padding-left: 6px;
      opacity: 1;
      /* Set to visible */
    }

    main h6 {
      color: #1a73e8;
      margin-top: 10px;
      margin-bottom: 5px;
      font-size: 1.6rem;
      text-align: left;
      border-left: 2px solid #1a73e8;
      padding-left: 4px;
      opacity: 1;
      /* Set to visible */
    }

    main ul {
      padding-left: 30px;
      margin-bottom: 30px;
    }

    main ul li {
      line-height: 1.8;
      font-size: 1.6rem;
      margin-bottom: 15px;
      background-color: #f9f9f9;
      padding: 12px 15px;
      border-radius: 8px;
      border-left: 5px solid #1a73e8;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      opacity: 1;
      /* Set to visible */
    }

    main ul li:hover {
      transform: none;
      /* Remove horizontal movement */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      /* Keep original shadow */
    }

    /* Keyframes for fade-in and slide-up animation */
    @keyframes fadeInSlideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Apply animation to main headings and list items */
    main h2,
    main h3,
    main h4,
    main h5,
    main h6,
    main ul li {
      animation: fadeInSlideUp 0.8s ease forwards;
      opacity: 0;
      /* Start hidden for animation */
    }

    /* Add delay for list items to create a staggered effect */
    main ul li {
      animation-delay: 0.2s;
    }

    main ul li:nth-child(2) {
      animation-delay: 0.4s;
    }

    main ul li:nth-child(3) {
      animation-delay: 0.6s;
    }

    main ul li:nth-child(4) {
      animation-delay: 0.8s;
    }

    @media (max-width: 768px) {
      main {
        padding: 20px 15px;
        margin: 100px 10px 30px 10px;
      }

      main h2 {
        font-size: 2.5rem;
      }

      main h3 {
        font-size: 2rem;
      }

      main ul li {
        font-size: 1.4rem;
      }
    }

    footer {
      background-color: #213967;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 1.5rem;
      position: relative;
      width: 100%;
      bottom: 0;
      left: 0;
    }

    footer p {
      margin: 0;
      font-size: 1.5rem;
    }

    .footer-content {
      background-color: #213967;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 1.5rem;
      position: relative;
      width: 100%;
      bottom: 0;
      left: 0;
    }

    .footer-social {
      margin-bottom: 10px;
    }

    .footer-bibi {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin: 0;
      padding: 0;
    }

    .footer-bibi li {
      display: inline;
    }

    .footer-bibi a {
      color: aliceblue;
      font-size: 2rem;
      transition: color 0.3s;
    }

    .footer-bibi a:hover {
      color: #8db2f6;
    }

    .footer-info {
      font-size: 1.4rem;
    }

    .footer-info a {
      color: aliceblue;
      transition: color 0.3s;
    }

    .footer-info a:hover {
      color: #8db2f6;
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


  <footer class="footer-content" style="background: #213967; padding: 24px 0 12px 0; margin-top: auto; width: 100vw;">
    <div class="footer-social" style="text-align: center; margin-bottom: 10px;">
      <a href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR" target="_blank"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/eetan.cf/" target="_blank"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-instagram"></i></a>
      <a href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu" target="_blank" title="Localização"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-geo-alt-fill"></i></a>
    </div>
    <div class="footer-info" style="text-align: center;">
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