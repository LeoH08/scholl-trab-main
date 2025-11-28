<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nós - ETAN</title>
  <link rel="stylesheet" href="../css/stylesobre1.css" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <style>
    :root {
      --c-bg: #f5f8fa;
      --c-surface: #ffffff;
      --c-alt: #f1f5f9;
      --c-primary: #1f3d63;
      --c-accent: #169b6b;
      --c-text: #2a3d4d;
      --c-muted: #647589;
      --radius: 18px;
      --shadow: 0 4px 14px -6px rgba(20, 40, 70, .18);
    }

    body {
      background: var(--c-bg);
      font-family: "Roboto", Arial, sans-serif;
      color: var(--c-text);
      line-height: 1.55;
      font-size: 1.25rem; /* aumentado */
    }

    header.content {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }

    main#sobre {
      max-width: 1180px;
      margin: 0 auto 60px;
      padding: 140px 44px 70px; /* aumentado */
    }

    .cards-grid {
      display: flex;
      flex-direction: column;
      gap: 44px; /* aumentado */
    }

    .card {
      background: var(--c-surface);
      border: 1px solid #e1e8ef;
      border-radius: var(--radius);
      padding: 36px 32px 38px; /* aumentado */
      box-shadow: var(--shadow);
      display: flex;
      flex-direction: column;
      gap: 22px; /* aumentado */
      transition: .25s;
    }

    .card:hover {
      transform: translateY(-3px);
    }

    .card h1,
    .card h2 {
      margin: 0 0 6px;
      font-weight: 700;
      color: var(--c-primary);
      font-size: 2.5rem; /* aumentado */
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .card.hero {
      background: linear-gradient(120deg, #183558, #255084);
      color: #fff;
      position: relative;
      overflow: hidden;
    }

    .card.hero:after {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 82% 18%, rgba(255, 255, 255, .18), transparent 70%), radial-gradient(circle at 12% 82%, rgba(255, 255, 255, .10), transparent 70%);
      pointer-events: none;
    }

    .card.hero h1 {
      font-size: clamp(2.5rem, 5vw, 3.5rem); /* aumentado */
      font-weight: 800;
      letter-spacing: .5px;
    }

    .tag-hero {
      display: inline-block;
      background: #ffffff22;
      border: 1px solid #ffffff40;
      padding: 10px 20px 11px; /* aumentado */
      font-size: .8rem; /* aumentado */
      letter-spacing: .16rem;
      font-weight: 700;
      text-transform: uppercase;
      border-radius: 40px;
      margin-bottom: 10px;
    }

    .card.hero p {
      color: #e6edf6;
      margin: 0;
    }

    .icon {
      width: 60px;
      height: 60px;
      border-radius: 14px;
      background: #e2f5ef;
      color: var(--c-accent);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem; /* aumentado */
    }

    .card.hero .icon {
      background: #ffffff26;
      color: #fff;
    }

    .card p {
      margin: 0;
      font-size: 1.25rem; /* aumentado */
      font-weight: 500;
      line-height: 1.6;
    }

    .list {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      gap: 14px; /* aumentado */
    }

    .list li {
      background: var(--c-alt);
      border: 1px solid #d8e2ea;
      padding: 16px 22px; /* aumentado */
      border-radius: 12px;
      font-size: 1.15rem; /* aumentado */
      font-weight: 500;
      line-height: 1.5;
    }

    .card.timeline {
      padding: 40px 32px 44px; /* aumentado */
    }

    .card.timeline h2 {
      font-size: 2rem; /* aumentado */
      letter-spacing: .5px;
    }

    .steps {
      display: grid;
      gap: 24px; /* aumentado */
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    @media (min-width: 560px) {
      .steps {
        grid-template-columns: repeat(4, minmax(0, 1fr));
      }
    }

    .step {
      background: var(--c-alt);
      border: 1px solid #d8e2ea;
      border-radius: 14px;
      padding: 26px 22px 28px; /* aumentado */
      display: flex;
      flex-direction: column;
      gap: 12px; /* aumentado */
    }

    .num {
      background: var(--c-accent);
      color: #fff;
      font-size: 1rem; /* aumentado */
      letter-spacing: .08rem;
      font-weight: 700;
      padding: 12px 20px; /* aumentado */
      border-radius: 40px;
      width: max-content;
    }

    .step h4 {
      margin: 0;
      font-size: 1.3rem; /* aumentado */
      font-weight: 700;
      color: var(--c-primary);
      letter-spacing: .4px;
    }

    .step p {
      margin: 0;
      font-size: 1.1rem; /* aumentado */
      color: var(--c-muted);
      line-height: 1.4;
    }

    .card.cta-card {
      background: linear-gradient(135deg, #183558, #255084);
      color: #fff;
      position: relative;
      overflow: hidden;
      padding: 48px 38px 54px; /* aumentado */
    }

    .card.cta-card:before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 85% 22%, rgba(255, 255, 255, .18), transparent 70%), radial-gradient(circle at 12% 85%, rgba(255, 255, 255, .12), transparent 70%);
      pointer-events: none;
    }

    .card.cta-card h2 {
      font-size: clamp(2.5rem, 4vw, 3rem); /* aumentado */
      font-weight: 800;
      margin: 0 0 12px;
      color: #fff;
    }

    .card.cta-card p {
      color: #e2edf5;
      font-size: 1.25rem; /* aumentado */
      max-width: 640px;
      margin: 0 0 26px;
      line-height: 1.5;
    }

    .card.cta-card .btn {
      background: var(--c-accent);
      color: #fff;
      text-decoration: none;
      padding: 18px 38px; /* aumentado */
      font-size: 1rem; /* aumentado */
      font-weight: 700;
      letter-spacing: .12rem;
      text-transform: uppercase;
      border-radius: 14px;
      display: inline-flex;
      gap: 8px;
      transition: .28s;
    }

    .card.cta-card .btn:hover {
      filter: brightness(1.08);
      transform: translateY(-3px);
    }

    .btn:focus-visible,
    .card:focus-within,
    .step:focus-within {
      outline: 3px solid #169b6b66;
      outline-offset: 3px;
    }

    .list.big-items li {
      font-size: 1.25rem; /* aumentado */
      line-height: 1.55;
      padding: 18px 26px; /* aumentado */
      font-weight: 600;
    }

    .list.big-items li strong {
      font-weight: 700;
      color: var(--c-primary);
    }
  </style>
</head>

<body>
  <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
  <header class="content" style="position:fixed;top:0;width:100%;z-index:1000">
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
        <?php if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'aluno'): ?>
          <li><a href="../html/matricula.php">Matricula</a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'professor'): ?>
          <li><a href="../html/boletim.php">Boletim</a></li>
        <?php endif; ?>
        <li>
          <a href="../html/cadastro.php">
            <i class="bi bi-person-circle"></i>
          </a>
        </li>
        <?php if (isset($_SESSION['tipo_usuario'])): ?>
          <li>
            <a href="../php/controller/logout.php" style="color: #e74c3c;">
              <i class="bi bi-box-arrow-right"></i> Sair
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main id="sobre">
    <div class="cards-grid">
      <section class="card hero" id="card-hero" aria-labelledby="hero-title">
        <div>
          <span class="tag-hero">Escola Técnica</span>
          <h1 id="hero-title" style="color: #fff;">Formação que Integra Conhecimento, Tecnologia e Valores</h1>
          <p>A EETAN promove educação pública moderna aliando base acadêmica sólida, itinerários técnicos e compromisso social para preparar estudantes para desafios reais.</p>
        </div>
      </section>

      <article class="card" id="identidade">
        <h2><span class="icon"><i class="bi bi-mortarboard"></i></span>Identidade</h2>
        <p><strong>História:</strong> Referência regional em ensino técnico integrado.</p>
        <p><strong>Missão:</strong> Formar cidadãos críticos, éticos e colaborativos.</p>
        <p><strong>Visão:</strong> Ser polo de inovação educacional e impacto social.</p>
        <p><strong>Valores:</strong> Respeito • Responsabilidade • Inovação • Solidariedade • Transparência • Compromisso Social.</p>
      </article>

      <article class="card" id="proposta">
        <h2><span class="icon"><i class="bi bi-journal-text"></i></span>Proposta Pedagógica</h2>
        <p>Aprendizagem ativa e interdisciplinar com foco em protagonismo estudantil.</p>
        <ul class="list big-items">
          <li><strong>Metodologias:</strong> projetos, estudos de caso, problemas reais.</li>
          <li><strong>Destaques:</strong> Desenvolvimento de Sistemas, Logística.</li>
          <li><strong>Projetos:</strong> Feira Tech, Mostra Científica, Carreiras.</li>
          <li><strong>Social:</strong> inclusão digital e apoio socioemocional.</li>
        </ul>
      </article>

      <article class="card" id="infra">
        <h2><span class="icon"><i class="bi bi-building"></i></span>Infraestrutura</h2>
        <ul class="list big-items">
          <li>Laboratórios de informática, maker e robótica.</li>
          <li>Biblioteca física e digital colaborativa.</li>
          <li>Salas multimídia e espaços de inovação.</li>
          <li>Quadras e área de convivência.</li>
          <li>Acessibilidade e apoio pedagógico.</li>
          <li>Rede estruturada e softwares educacionais.</li>
        </ul>
      </article>

      <article class="card" id="equipe">
        <h2><span class="icon"><i class="bi bi-people-fill"></i></span>Equipe</h2>
        <ul class="list big-items">
          <li>Direção estratégica e participativa.</li>
          <li>Coordenação pedagógica integrada.</li>
          <li>Docentes técnicos especializados.</li>
          <li>Professores de base articulando competências.</li>
          <li>Apoio: orientação, inclusão, tecnologia.</li>
        </ul>
        <p style="font-size:.75rem;color:var(--c-muted);">Formação continuada garante atualização.</p>
      </article>

      <article class="card" id="reconhecimento">
        <h2><span class="icon"><i class="bi bi-award"></i></span>Reconhecimento</h2>
        <ul class="list big-items">
          <li>Resultados em olimpíadas e mostras.</li>
          <li>Parcerias educacionais e comunitárias.</li>
          <li>Portfólios técnicos certificados.</li>
          <li>Projetos de impacto social contínuo.</li>
        </ul>
      </article>

      <article class="card" id="comunidade">
        <h2><span class="icon"><i class="bi bi-globe2"></i></span>Comunidade</h2>
        <ul class="list big-items">
          <li>Participação ativa das famílias.</li>
          <li>Eventos culturais e científicos.</li>
          <li>Voluntariado e sustentabilidade.</li>
          <li>Orientação acadêmica e de carreira.</li>
        </ul>
      </article>

      <section class="card timeline" id="trajetoria" aria-labelledby="traj-title">
        <h2 id="traj-title"><i class="bi bi-clock-history"></i> Trajetória Formativa</h2>
        <div class="steps">
          <div class="step"><span class="num">01</span>
            <h4>Base</h4>
            <p>Competências gerais + técnicas.</p>
          </div>
          <div class="step"><span class="num">02</span>
            <h4>Projetos</h4>
            <p>Aplicação e criação integrada.</p>
          </div>
          <div class="step"><span class="num">03</span>
            <h4>Portfólio</h4>
            <p>Registro de experiências reais.</p>
          </div>
          <div class="step"><span class="num">04</span>
            <h4>Transição</h4>
            <p>Carreira e continuidade acadêmica.</p>
          </div>
        </div>
      </section>

      <section class="card cta-card" id="matricula-card" aria-labelledby="cta-matricula">
        <h2 id="cta-matricula">Venha Construir o Futuro Conosco</h2>
        <p>Educação de qualidade, tecnologia aplicada e formação humana em ambiente acolhedor. Descubra nossos cursos e inicie sua jornada na EETAN.</p>
        <a href="matricula.php" class="btn" aria-label="Ir para matrícula">
          <i class="bi bi-pencil-square"></i> MATRÍCULA
        </a>
      </section>
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