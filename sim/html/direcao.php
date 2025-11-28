<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Direção - ETAN</title>
  <link rel="stylesheet" href="../css/stylesdirecao.css" />
  <link rel="stylesheet" href="../css/stylelayout.css" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <meta
    name="description"
    content="Página da direção da Escola Estadual Tancredo de Almeida Neves. Conheça a diretora e vice-diretora." />
  <meta
    name="keywords"
    content="direção, diretora, vice-diretora, escola, ETAN" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
    defer></script>
  <link rel="stylesheet" href="../css/direcao.css" />
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      AOS.init();
    });
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
    <section class="direcao-intro animate" data-aos="fade-up" aria-labelledby="titulo-direcao">
      <h1 id="titulo-direcao">Direção Escolar</h1>
      <p class="intro-resumo">
        Conheça a equipe gestora comprometida com qualidade, inclusão e inovação pedagógica.
      </p>
      <div class="acoes-direcao">
        <a class="btn-acao" href="#projetos" aria-label="Ir para projetos e conquistas">Conheça os projetos</a>
        <a class="btn-acao secundario" href="#mensagem" aria-label="Ler mensagem da direção">Mensagem da Direção</a>
      </div>
    </section>

    <section class="cards-direcao" aria-label="Perfis da equipe gestora">
      <!-- Card Diretora -->
      <article class="card-gestora animate" data-aos="fade-up" aria-labelledby="dir-cristiane-nome">
        <div class="perfil-img">
          <img src="../fts/cristiane.PNG" alt="Foto da Diretora Cristiane" loading="lazy" />
        </div>
        <div class="perfil-conteudo">
          <h2 id="dir-cristiane-nome">Cristiane <span class="cargo">Diretora</span></h2>
          <ul class="topicos">
            <li><strong>🎓 Formação Acadêmica:</strong> Acadêmica: Licenciatura Plena em Ciências Biológicas pelo Unileste; Pós-graduação em Gestão Escolar pela FAE/UFMG; Pós-graduação em Inspeção Escolar pela FACUMINAS e Mestrado em Gestão e Avaliação da Educação Pública pela UFJF.</li>
            <li><strong>📌 Experiência Profissional:</strong> Professora de Ciências de fevereiro de 2005 a setembro de 2011. A partir daí, assumiu a gestão da escola, estando em seu 4° mandato.</li>
            <li><strong>🌟 Atuação na Gestão:</strong> Foco em clima escolar acolhedor, transparência e fortalecimento de vínculos com a comunidade.</li>
            <li><strong>💬 Valores e Visão:</strong> Proporcionar um ensino de qualidade, propiciando o crescimento e o desenvolvimento de conhecimentos inerentes à vida escolar e de princípios como o Protagonismo Juvenil, solidariedade e trabalho em equipe.</li>
          </ul>
          <blockquote class="citacao" aria-label="Citação da diretora">
            “aproveite as oportunidades porque o tempo passa rápido. A motivação é pessoal e só você conhece os seus sonhos. O esforço de hoje será recompensado. Com foco e fé você é capaz de muito mais do que imagina.”
          </blockquote>
        </div>
      </article>

      <!-- Card Vice / Coordenação (exemplo; adapte nomes se necessário) -->
      <article class="card-gestora animate" data-aos="fade-up" aria-labelledby="vice-nome">
        <div class="perfil-img">
          <img src="../fts/vice.png" alt="Foto da Vice-Diretora" loading="lazy" />
        </div>
        <div class="perfil-conteudo">
          <h2 id="vice-nome">[Nome da Vice-Diretora] <span class="cargo">Vice-Diretora</span></h2>
          <ul class="topicos">
            <li><strong>🎓 Formação Acadêmica:</strong> Licenciatura + Pós em Supervisão/Orientação Educacional.</li>
            <li><strong>📌 Experiência Profissional:</strong> Coordenação pedagógica, suporte a docentes e monitoramento de indicadores.</li>
            <li><strong>🌟 Atuação na Gestão:</strong> Apoio à implementação curricular e acompanhamento de trajetórias estudantis.</li>
            <li><strong>💬 Valores e Visão:</strong> Formação integral, inclusão e colaboração entre equipes.</li>
          </ul>
          <blockquote class="citacao">
            “Cuidar do processo formativo é tão importante quanto celebrar os resultados.”
          </blockquote>
        </div>
      </article>
    </section>

    <section id="mensagem" class="mensagem-direcao animate" data-aos="fade-up" aria-labelledby="titulo-mensagem">
      <h2 id="titulo-mensagem">Mensagem da Direção</h2>
      <p>
      Aproveite as oportunidades porque o tempo passa rápido. A motivação é pessoal e só você conhece os seus sonhos. O esforço de hoje será recompensado. Com foco e fé você é capaz de muito mais do que imagina.
      </p>
    </section>

    <section id="projetos" class="projetos-conquistas animate" data-aos="fade-up" aria-label="Projetos e conquistas">
      <h2>Projetos & Conquistas</h2>
      <div class="slider" role="region" aria-roledescription="carrossel" aria-label="Lista de conquistas">
        <div class="slider-track">
          <div class="slide" aria-label="Projeto 1">
            <h3>Robótica Educacional</h3>
            <p>Equipe finalista em mostra regional de tecnologia.</p>
          </div>
          <div class="slide" aria-label="Projeto 2">
            <h3>Clube de Leitura</h3>
            <p>Aumento de 28% na adesão a atividades literárias.</p>
          </div>
          <div class="slide" aria-label="Projeto 3">
            <h3>Feira de Ciências</h3>
            <p>Integração interdisciplinar e protagonismo estudantil.</p>
          </div>
          <div class="slide" aria-label="Projeto 4">
            <h3>Programa de Tutoria</h3>
            <p>Mentorias entre estudantes para reforço de aprendizagem.</p>
          </div>
        </div>
        <div class="dots" aria-label="Seleção de slides"></div>
      </div>
    </section>
  </main>

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
  <script src="../js/direcao.js" defer></script>
</body>

</html>