<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function get_that_filetime($file_url = false)
{
  if (!file_exists($file_url)) {
    return '';
  }

  return filemtime($file_url);
}
$tipoUsuario = $_SESSION['tipo_usuario'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="manifest" href="/site.webmanifest" />
  <link rel="stylesheet" href="../css/stylelayout.css?<?php echo get_that_filetime('../css/admin.css'); ?>" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet" />
  <!-- <link rel="stylesheet" href="../css/cabeçalhoerodape.css" /> -->
  <title>EETAN | Site Oficial</title>
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
        <li>
          <a href="../html/cadastro.php">
            <i class="bi bi-person-circle"></i>
          </a>
        </li>
        <?php if (isset($tipoUsuario)): ?>
          <li>
            <a href="../php/controller/logout.php" style="color: #e74c3c;">
              <i class="bi bi-box-arrow-right"></i> Sair
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <section class="first-section">
    <div class="conteudo-principal">
      <div class="slideshow-container">
        <img
          class="slides"
          src="../fts/capa1.png"
          alt="Volta as aulas" />
        <img
          class="slides"
          src="../fts/capa2.png"
          alt="Semana de provas" />
        <img
          class="slides"
          src="../fts/capa3.png"
          alt="Novembro Azul" />
        <img
          class="slides"
          src="../fts/capa4.png"
          alt="Novembro Azul" />

        <div class="progress-bar"></div>

        <!-- botões de navegação -->
        <button class="slide-btn prev" type="button" onclick="showPrevSlide()">&#10094;</button>
        <button class="slide-btn next" type="button" onclick="showNextSlide(true)">&#10095;</button>
      </div>
    </div>
  </section>

  <section class="sobre-nos" id="sobrenos" style="padding: 100px 0 90px 0; background: linear-gradient(120deg, #eaf0fa 60%, #f5f8ff 100%);">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 3rem; display: flex; flex-wrap: wrap; gap: 48px; justify-content: center; align-items: stretch; font-size: 1.45rem;">
      <div style="flex: 1 1 400px; min-width: 340px; background: #fff; border-radius: 28px; box-shadow: 0 6px 32px rgba(33,57,103,0.13); padding: 48px 32px; display: flex; flex-direction: column; align-items: center; margin-bottom: 24px;">
        <img src="../fts/Logo_EETAN.png" alt="Logo da Escola" style="width: 120px; height: 120px; object-fit: contain; border-radius: 16px; margin-bottom: 1.7rem; background: #f5f8ff; box-shadow: 0 2px 12px rgba(33,57,103,0.10);" />
        <h3 style="font-size: 2.1rem; color: #213967; font-weight: 700; margin-bottom: 1.2rem;">Nossa Equipe</h3>
        <p style="font-size: 1.45rem; color: #3a4a5d; text-align: center;">Professores e colaboradores dedicados, apaixonados por ensinar e transformar vidas. Juntos, construímos uma escola acolhedora e inovadora.</p>
      </div>
      <div style="flex: 2 1 540px; min-width: 380px; background: #fff; border-radius: 28px; box-shadow: 0 6px 32px rgba(33,57,103,0.13); padding: 56px 44px 48px 44px; display: flex; flex-direction: column; justify-content: center; margin-bottom: 24px;">
        <h2 style="font-size: 3.2rem; color: #213967; font-weight: 800; margin-bottom: 1.7rem; letter-spacing: -1px;">Sobre a EETAN</h2>
        <p style="font-size: 1.55rem; color: #3a4a5d; line-height: 1.8; margin-bottom: 2.5rem; text-align: justify;">A Escola Estadual Tancredo de Almeida Neves é referência em ensino público de qualidade, tradição e inovação em Coronel Fabriciano. Nossa missão é formar cidadãos críticos, preparados para os desafios do presente e do futuro, promovendo inclusão, tecnologia e valores humanos. Da EJA ao Ensino Técnico, somos uma escola que acredita no potencial de cada aluno e no poder transformador da educação.</p>
        <div style="display: flex; flex-wrap: wrap; gap: 28px; justify-content: flex-start;">
          <div style="background: #eaf0fa; border-radius: 14px; padding: 1.1rem 2rem; color: #213967; font-size: 1.35rem; font-weight: 600; display: flex; align-items: center; gap: 0.7rem;"><i class="bi bi-bullseye" style="color: #4a6fa1; font-size: 1.8rem;"></i> Missão</div>
          <div style="background: #eaf0fa; border-radius: 14px; padding: 1.1rem 2rem; color: #213967; font-size: 1.35rem; font-weight: 600; display: flex; align-items: center; gap: 0.7rem;"><i class="bi bi-eye" style="color: #4a6fa1; font-size: 1.8rem;"></i> Visão</div>
          <div style="background: #eaf0fa; border-radius: 14px; padding: 1.1rem 2rem; color: #213967; font-size: 1.35rem; font-weight: 600; display: flex; align-items: center; gap: 0.7rem;"><i class="bi bi-heart" style="color: #4a6fa1; font-size: 1.8rem;"></i> Valores</div>
        </div>
      </div>
      <div style="flex: 1 1 400px; min-width: 340px; background: #fff; border-radius: 28px; box-shadow: 0 6px 32px rgba(33,57,103,0.13); padding: 48px 32px; display: flex; flex-direction: column; align-items: center; margin-bottom: 24px;">
        <h3 style="font-size: 2.1rem; color: #213967; font-weight: 700; margin-bottom: 1.2rem;">Missão, Visão e Valores</h3>
        <ul style="padding: 0; margin: 0; list-style: none; text-align: left;">
          <li style="margin-bottom: 1.2rem; color: #4a6fa1; font-size: 1.80rem;"><b>Missão:</b> Educar com excelência, promovendo cidadania, ética e inovação.</li>
          <li style="margin-bottom: 1.2rem; color: #4a6fa1; font-size: 1.80rem;"><b>Visão:</b> Ser referência em educação pública, formando líderes para o futuro.</li>
          <li style="color: #4a6fa1; font-size: 1.80rem;"><b>Valores:</b> Respeito, inclusão, dedicação, criatividade e compromisso social.</li>
        </ul>
      </div>
    </div>
  </section>


  <footer class="footer-content">
    <div class="footer-social">
      <a
        href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR"
        target="_blank"><i
          style="padding-right: 10px; font-size: 20px; color: aliceblue"
          class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/eetan.cf/" target="_blank"><i
          style="padding-right: 10px; font-size: 20px; color: aliceblue"
          class="bi bi-instagram"></i></a>
      <a
        href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu"
        target="_blank"
        title="Localização"><i
          style="padding-right: 10px; font-size: 20px; color: aliceblue"
          class="bi bi-geo-alt-fill"></i></a>
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

  <script>
    const slideDuration = 8000; // 8s
    let slideIndex = 0;
    let slideTimer = null;

    function initSlides() {
      const slides = document.getElementsByClassName("slides");
      if (!slides.length) return;

      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
        slides[i].classList.remove("active");
      }

      slideIndex = 0;
      slides[slideIndex].style.display = "block";
      slides[slideIndex].classList.add("active");

      resetProgressBar();
      startSlideLoop();
    }

    function startSlideLoop() {
      if (slideTimer) clearTimeout(slideTimer);
      slideTimer = setTimeout(() => showNextSlide(false), slideDuration);
    }

    // próximo slide; isUser = true quando for clique do usuário
    function showNextSlide(isUser = false) {
      const slides = document.getElementsByClassName("slides");
      if (!slides.length) return;

      const newIndex = (slideIndex + 1) % slides.length;
      goToSlide(newIndex, isUser);
    }

    function showPrevSlide() {
      const slides = document.getElementsByClassName("slides");
      if (!slides.length) return;

      const newIndex = (slideIndex - 1 + slides.length) % slides.length;
      goToSlide(newIndex, true);
    }

    function goToSlide(newIndex, isUser) {
      const slides = document.getElementsByClassName("slides");
      if (!slides.length || newIndex === slideIndex) return;

      // esconde o atual
      slides[slideIndex].style.display = "none";
      slides[slideIndex].classList.remove("active");

      // mostra o novo
      slideIndex = newIndex;
      slides[slideIndex].style.display = "block";
      slides[slideIndex].classList.add("active");

      resetProgressBar();
      // sempre reinicia o timer após trocar de slide
      startSlideLoop();
    }

    function resetProgressBar() {
      const progressBar = document.querySelector(".progress-bar");
      if (!progressBar) return;

      progressBar.style.transition = "none";
      progressBar.style.width = "0%";
      void progressBar.offsetWidth;
      progressBar.style.transition = `width ${slideDuration}ms linear`;
      progressBar.style.width = "100%";
    }

    window.addEventListener("load", initSlides);
    window.addEventListener("beforeunload", () => {
      if (slideTimer) clearTimeout(slideTimer);
    });
  </script>
</body>

</html>