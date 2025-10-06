<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// === NOVO: Definição estruturada dos cursos ===
$cursos = [
  'desenvolvimento' => [
    'nome' => 'Desenvolvimento de Sistemas',
    'resumo' => 'Forma o aluno para criar aplicações web, desktop e mobile com base em boas práticas de programação.',
    'objetivos' => [
      'Dominar lógica e estruturas de programação',
      'Compreender bancos de dados e modelagem',
      'Aplicar versionamento e metodologias ágeis',
      'Desenvolver aplicações web responsivas',
      'Introdução a APIs e integração de sistemas'
    ],
    'conteudo' => [
      'Módulo 1: Lógica, Algoritmos e Versionamento',
      'Módulo 2: Programação Front-end (HTML, CSS, JS)',
      'Módulo 3: Programação Back-end (PHP / APIs básicas)',
      'Módulo 4: Banco de Dados (Modelagem e SQL)',
      'Módulo 5: Padrões e Boas Práticas',
      'Módulo 6: Projeto Integrador'
    ],
    'publico' => 'Alunos do Ensino Médio ou iniciantes interessados em tecnologia.',
    'carga' => '800h (3 anos / Itinerário Técnico)',
    'modalidade' => 'Presencial',
    'certificacao' => 'Certificado técnico ao concluir a trajetória.',
    'instrutores' => 'Equipe técnica multidisciplinar (Front-end, Back-end e Banco de Dados).',
    'beneficios' => [
      'Base sólida para mercado ou faculdade',
      'Projetos reais e colaborativos',
      'Desenvolvimento de pensamento lógico',
      'Contato inicial com ferramentas modernas'
    ],
    'valor' => 'Gratuito (Rede Pública)',
    'matricula' => 'Inscrições na página de Matrícula.',
    'icone' => 'bi-laptop'
  ],
  'logistica' => [
    'nome' => 'Logística',
    'resumo' => 'Capacita o aluno a atuar no fluxo de materiais, armazenagem, distribuição e processos produtivos.',
    'objetivos' => [
      'Entender cadeia de suprimentos',
      'Aplicar técnicas de armazenagem e movimentação',
      'Analisar custos logísticos',
      'Planejar rotas e distribuição',
      'Introdução a indicadores operacionais'
    ],
    'conteudo' => [
      'Módulo 1: Fundamentos da Logística',
      'Módulo 2: Cadeia de Suprimentos & Distribuição',
      'Módulo 3: Armazenagem e Estoques',
      'Módulo 4: Transporte e Modais',
      'Módulo 5: Custos e Indicadores',
      'Módulo 6: Projeto Prático'
    ],
    'publico' => 'Alunos do Ensino Médio interessados em operações e gestão.',
    'carga' => '800h (3 anos / Itinerário Técnico)',
    'modalidade' => 'Presencial',
    'certificacao' => 'Certificado técnico ao final.',
    'instrutores' => 'Profissionais experientes em operações e cadeia de suprimentos.',
    'beneficios' => [
      'Visão sistêmica de processos',
      'Alta empregabilidade regional',
      'Base para áreas industriais e comerciais',
      'Desenvolve organização e análise'
    ],
    'valor' => 'Gratuito (Rede Pública)',
    'matricula' => 'Inscrições na página de Matrícula.',
    'icone' => 'bi-truck'
  ],
  'eja' => [
    'nome' => 'EJA – Educação de Jovens e Adultos',
    'resumo' => 'Oportunidade de conclusão dos estudos com reforço formativo e inclusão.',
    'objetivos' => [
      'Recuperar trajetória educacional',
      'Desenvolver competências cidadãs',
      'Estímulo à continuidade acadêmica',
      'Promover inserção social e profissional'
    ],
    'conteudo' => [
      'Linguagens e Produção de Texto',
      'Matemática aplicada ao cotidiano',
      'Ciências da Natureza contextualizadas',
      'Ciências Humanas e Sociedade',
      'Projeto de Vida e Cidadania'
    ],
    'publico' => 'Jovens e adultos que não concluíram etapas da educação básica.',
    'carga' => 'Carga adaptada por etapa cursada',
    'modalidade' => 'Presencial (horário flexível noturno)',
    'certificacao' => 'Certificação conforme etapa concluída.',
    'instrutores' => 'Docentes com experiência em mediação e inclusão.',
    'beneficios' => [
      'Ambiente acolhedor',
      'Material contextualizado',
      'Apoio pedagógico',
      'Foco em retomada de oportunidades'
    ],
    'valor' => 'Gratuito',
    'matricula' => 'Procure a secretaria ou use a página de Matrícula.',
    'icone' => 'bi-people'
  ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cursos - ETAN</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="../css/stylescursos.css">
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
    defer></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      AOS.init();
    });
  </script>
  <style>
    /* === REMOVER CSS ANTIGO DE .courses-grid-modern / .course-card-modern / toolbar / view-large === */
    /* === NOVO LAYOUT DE CURSOS (ACORDEÃO + COMPARAÇÃO) === */
    .courses-wrapper {
      max-width: 1180px;
      margin: 0 auto 70px;
      padding: 0 1.2rem;
      font-family: "Roboto", Arial, sans-serif;
    }

    .courses-header-block {
      text-align: center;
      margin: 10px 0 40px;
    }

    .courses-header-block h2 {
      font-size: clamp(2.2rem, 4vw, 3.1rem);
      font-weight: 800;
      letter-spacing: .5px;
      color: #213967;
      margin: 0 0 12px;
    }

    .courses-header-block p {
      margin: 0 auto;
      max-width: 760px;
      font-size: 1.05rem;
      line-height: 1.55;
      color: #2d465f;
      font-weight: 500;
    }

    /* Filtros */
    .course-filters {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      align-items: center;
      margin: 0 0 28px;
    }

    .course-filters input[type=search] {
      flex: 1 1 260px;
      padding: 14px 16px;
      font-size: .95rem;
      border: 2px solid #d2deeb;
      border-radius: 14px;
      background: #fff;
      transition: .25s;
    }

    .course-filters input[type=search]:focus {
      outline: none;
      border-color: #2f65b8;
      box-shadow: 0 0 0 3px #2f65b824;
    }

    .chip-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .filter-chip {
      background: #eef3f9;
      color: #264a73;
      padding: 10px 18px;
      border-radius: 40px;
      font-size: .7rem;
      letter-spacing: .14rem;
      font-weight: 700;
      text-transform: uppercase;
      border: 2px solid transparent;
      cursor: pointer;
      transition: .3s;
    }

    .filter-chip.active {
      background: #2f65b8;
      color: #fff;
      box-shadow: 0 4px 14px -4px #2f65b8aa;
    }

    .filter-actions {
      display: flex;
      gap: 10px;
      margin-left: auto;
      flex-wrap: wrap;
    }

    .btn-small {
      background: linear-gradient(135deg, #2f65b8, #1e416c);
      color: #fff;
      border: none;
      padding: 11px 20px;
      border-radius: 12px;
      font-size: .68rem;
      letter-spacing: .15rem;
      font-weight: 700;
      text-transform: uppercase;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: .3s;
    }

    .btn-small.alt {
      background: linear-gradient(135deg, #1fa870, #138252);
    }

    .btn-small:hover {
      transform: translateY(-3px);
    }

    /* Acordeão */
    .course-accordion {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    details.course-item {
      background: #ffffff;
      border: 1px solid #d6e1ed;
      border-radius: 22px;
      box-shadow: 0 6px 28px -10px rgba(33, 57, 103, .18);
      overflow: hidden;
      transition: border-color .3s, box-shadow .3s;
      position: relative;
    }

    details.course-item[open] {
      border-color: #2f65b8;
      box-shadow: 0 10px 36px -10px rgba(33, 57, 103, .28);
    }

    details.course-item summary {
      list-style: none;
      cursor: pointer;
      padding: 26px 30px 24px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      position: relative;
    }

    details.course-item summary::-webkit-details-marker {
      display: none;
    }

    .course-head-row {
      display: flex;
      gap: 18px;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    .course-icon-big {
      width: 70px;
      height: 70px;
      min-width: 70px;
      border-radius: 22px;
      background: linear-gradient(135deg, #2f65b8, #1d4070);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.05rem;
      box-shadow: 0 6px 16px -6px #2f65b8b0;
    }

    .course-title-block h3 {
      margin: 0 0 6px;
      font-size: clamp(1.4rem, 2.2vw, 1.95rem);
      font-weight: 800;
      letter-spacing: .6px;
      color: #213967;
      display: flex;
      align-items: center;
      gap: 10px;
      line-height: 1.2;
    }

    .course-title-block p {
      margin: 0;
      font-size: .98rem;
      line-height: 1.55;
      color: #2b4863;
      font-weight: 500;
      max-width: 780px;
    }

    .meta-inline {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 4px;
    }

    .meta-badge {
      background: #eef3f9;
      color: #1d4f86;
      padding: 8px 14px;
      font-size: .65rem;
      letter-spacing: .12rem;
      text-transform: uppercase;
      font-weight: 700;
      border-radius: 40px;
      display: inline-flex;
      gap: 6px;
      align-items: center;
    }

    details.course-item[open] .meta-badge {
      background: #2f65b8;
      color: #fff;
    }

    .expand-indicator {
      position: absolute;
      top: 22px;
      right: 22px;
      width: 44px;
      height: 44px;
      border-radius: 14px;
      background: #eef3f9;
      color: #2f65b8;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      transition: .4s;
      box-shadow: 0 4px 12px -6px rgba(0, 0, 0, .25);
    }

    details.course-item[open] .expand-indicator {
      transform: rotate(180deg);
      background: #2f65b8;
      color: #fff;
    }

    .course-body {
      padding: 0 30px 34px;
      display: grid;
      gap: 26px;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      border-top: 1px solid #e2eaf2;
      background: linear-gradient(180deg, #f8fbfe 0%, #ffffff 60%);
    }

    .course-section {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .course-section h4 {
      margin: 0;
      font-size: .78rem;
      letter-spacing: .14rem;
      font-weight: 800;
      text-transform: uppercase;
      color: #2f65b8;
    }

    .course-section ul,
    .course-section ol {
      margin: 0;
      padding-left: 18px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      font-size: .9rem;
      line-height: 1.45;
      color: #2d465f;
    }

    .course-section li {
      position: relative;
    }

    .course-section li::marker {
      color: #2f65b8;
      font-weight: 600;
    }

    .check-list {
      list-style: none;
      padding-left: 0;
    }

    .check-list li {
      padding-left: 20px;
    }

    .check-list li:before {
      content: "✔";
      position: absolute;
      left: 0;
      color: #1fa870;
      font-weight: 700;
    }

    .course-actions-inline {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-top: 4px;
    }

    .btn-action {
      background: linear-gradient(135deg, #2f65b8, #1e416c);
      color: #fff;
      border: none;
      padding: 14px 26px;
      font-size: .75rem;
      letter-spacing: .14rem;
      font-weight: 700;
      text-transform: uppercase;
      border-radius: 16px;
      cursor: pointer;
      box-shadow: 0 8px 24px -10px #2f65b8aa;
      position: relative;
      overflow: hidden;
      transition: .35s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-action.alt {
      background: linear-gradient(135deg, #1fa870, #138252);
      box-shadow: 0 8px 24px -10px #1fa870aa;
    }

    .btn-action:hover {
      transform: translateY(-4px);
    }

    /* Acessibilidade */
    details.course-item summary:focus-visible,
    .filter-chip:focus-visible,
    .btn-action:focus-visible,
    .btn-small:focus-visible {
      outline: 3px solid #2f65b866;
      outline-offset: 2px;
    }

    @media (max-width: 690px) {
      .course-body {
        grid-template-columns: 1fr;
      }

      .expand-indicator {
        top: 16px;
        right: 16px;
      }
    }

    /* === FAQ MODERNO / ACORDEÃO === */
    .faq-area {
      max-width: 1180px;
      margin: 40px auto 80px;
      padding: 0 1.2rem;
      font-family: "Roboto", Arial, sans-serif;
    }

    .faq-area h2 {
      text-align: center;
      font-size: clamp(2.2rem, 4vw, 2.9rem);
      font-weight: 800;
      color: #213967;
      margin: 0 0 22px;
      letter-spacing: .5px;
    }

    .faq-intro {
      text-align: center;
      max-width: 820px;
      margin: 0 auto 38px;
      font-size: 1.08rem;
      line-height: 1.65;
      color: #2a465f;
      font-weight: 500;
    }

    .faq-grid {
      display: grid;
      gap: 26px;
      grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    }

    @media (max-width:760px) {
      .faq-grid {
        grid-template-columns: 1fr;
      }
    }

    .faq-item {
      background: linear-gradient(145deg, #ffffff, #f4f8fc);
      border: 1px solid #d8e3ef;
      border-radius: 26px;
      box-shadow: 0 10px 34px -12px rgba(33, 57, 103, .18);
      overflow: hidden;
      transition: .35s;
      position: relative;
    }

    .faq-item:before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 85% 18%, rgba(47, 101, 184, .18), transparent 68%),
        radial-gradient(circle at 12% 88%, rgba(255, 179, 71, .16), transparent 70%);
      opacity: .55;
      pointer-events: none;
    }

    .faq-item:hover {
      box-shadow: 0 16px 44px -12px rgba(33, 57, 103, .28);
      transform: translateY(-4px);
    }

    .faq-item details {
      margin: 0;
    }

    .faq-item summary {
      list-style: none;
      cursor: pointer;
      padding: 28px 70px 26px 30px;
      position: relative;
      font-size: 1.18rem;
      font-weight: 700;
      color: #213967;
      letter-spacing: .4px;
      line-height: 1.3;
      display: flex;
      align-items: flex-start;
      gap: 14px;
      transition: .3s;
    }

    .faq-item summary::-webkit-details-marker {
      display: none;
    }

    .faq-item summary:focus-visible {
      outline: 3px solid #2f65b866;
      outline-offset: 3px;
      border-radius: 18px;
    }

    .faq-item summary .faq-icon {
      width: 54px;
      height: 54px;
      min-width: 54px;
      border-radius: 16px;
      background: linear-gradient(135deg, #2f65b8, #1d4070);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      box-shadow: 0 6px 16px -6px #2f65b8aa;
    }

    .faq-item details[open] summary {
      color: #1d4170;
    }

    .faq-chevron {
      position: absolute;
      top: 22px;
      right: 24px;
      width: 48px;
      height: 48px;
      border-radius: 16px;
      background: #eef3f9;
      color: #2f65b8;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      box-shadow: 0 4px 12px -6px rgba(0, 0, 0, .25);
      transition: .45s;
    }

    .faq-item details[open] .faq-chevron {
      transform: rotate(180deg);
      background: #2f65b8;
      color: #fff;
    }

    .faq-content {
      padding: 0 32px 30px 92px;
      margin-top: -6px;
      font-size: 1.02rem;
      line-height: 1.65;
      color: #2a4a63;
      font-weight: 500;
      animation: fadeSlide .55s cubic-bezier(.65, .05, .36, 1);
      position: relative;
    }

    @media (max-width:640px) {
      .faq-content {
        padding: 0 26px 28px 30px;
      }

      .faq-item summary {
        padding: 26px 64px 24px 26px;
        font-size: 1.08rem;
      }
    }

    .faq-content p {
      margin: 0 0 18px;
    }

    .faq-content p:last-child {
      margin-bottom: 0;
    }

    .faq-highlight {
      display: inline-block;
      background: #2f65b8;
      color: #fff;
      padding: 4px 12px 5px;
      border-radius: 40px;
      font-size: .65rem;
      letter-spacing: .11rem;
      font-weight: 700;
      text-transform: uppercase;
      margin: 0 0 14px;
      box-shadow: 0 4px 14px -6px #2f65b8aa;
    }

    @keyframes fadeSlide {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Botões extras (expandir tudo FAQ) */
    .faq-controls {
      text-align: center;
      margin: 10px 0 34px;
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .faq-btn {
      background: linear-gradient(135deg, #2f65b8, #1e416c);
      color: #fff;
      border: none;
      padding: 14px 28px;
      border-radius: 16px;
      font-size: .72rem;
      letter-spacing: .14rem;
      font-weight: 700;
      text-transform: uppercase;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      box-shadow: 0 8px 24px -10px #2f65b8aa;
      transition: .35s;
    }

    .faq-btn.alt {
      background: linear-gradient(135deg, #1fa870, #138252);
      box-shadow: 0 8px 24px -10px #1fa870aa;
    }

    .faq-btn:hover {
      transform: translateY(-4px);
    }

    .faq-btn:focus-visible {
      outline: 3px solid #2f65b866;
      outline-offset: 3px;
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
    <section class="courses-wrapper">
      <div class="courses-header-block">
        <h2>Nossos Cursos Técnicos & Formativos</h2>
        <p>Explore as trilhas formativas disponíveis. Abra cada curso para ver objetivos, conteúdos, diferenciais e caminhos de matrícula. Use filtros para localizar rapidamente aquilo que mais combina com você.</p>
      </div>

      <!-- NOVO: barra de controles simples -->
      <div class="courses-tools">
        <button class="btn-small" id="btnExpandAll"><i class="bi bi-arrows-expand"></i> EXPANDIR</button>
        <button class="btn-small alt" id="btnCollapseAll"><i class="bi bi-arrows-collapse"></i> RECOLHER</button>
      </div>

      <!-- Acordeão -->
      <div class="course-accordion" id="accordionCursos">
        <?php foreach ($cursos as $slug => $c): ?>
          <?php
          $isEja = stripos($c['nome'], 'EJA') !== false;
          $modTag = $c['modalidade'];
          $valorTag = $c['valor'];
          ?>
          <details class="course-item"
            data-nome="<?= htmlspecialchars(strtolower($c['nome'])) ?>"
            data-modalidade="<?= htmlspecialchars($modTag) ?>"
            data-eja="<?= $isEja ? '1' : '0' ?>"
            data-search="<?= htmlspecialchars(strtolower(
                            $c['nome'] . ' ' . implode(' ', $c['objetivos']) . ' ' . implode(' ', $c['conteudo'])
                          )) ?>">
            <summary>
              <div class="course-head-row">
                <div class="course-icon-big"><i class="bi <?= htmlspecialchars($c['icone']) ?>"></i></div>
                <div class="course-title-block">
                  <h3><?= htmlspecialchars($c['nome']) ?></h3>
                  <p><?= htmlspecialchars($c['resumo']) ?></p>
                  <div class="meta-inline">
                    <span class="meta-badge"><i class="bi bi-clock"></i><?= htmlspecialchars($c['carga']) ?></span>
                    <span class="meta-badge"><i class="bi bi-display"></i><?= htmlspecialchars($c['modalidade']) ?></span>
                    <span class="meta-badge"><i class="bi bi-cash-coin"></i><?= htmlspecialchars($c['valor']) ?></span>
                    <span class="meta-badge"><i class="bi bi-award"></i> Certificação</span>
                  </div>
                </div>
              </div>
              <div class="expand-indicator"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="course-body">
              <div class="course-section">
                <h4>Objetivos</h4>
                <ul class="check-list">
                  <?php foreach ($c['objetivos'] as $o): ?>
                    <li><?= htmlspecialchars($o) ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="course-section">
                <h4>Conteúdo Programático</h4>
                <ol>
                  <?php foreach ($c['conteudo'] as $m): ?>
                    <li><?= htmlspecialchars($m) ?></li>
                  <?php endforeach; ?>
                </ol>
              </div>
              <div class="course-section">
                <h4>Público-Alvo</h4>
                <p style="margin:0; font-size:.9rem; line-height:1.5; color:#2d465f;"><?= htmlspecialchars($c['publico']) ?></p>
                <h4 style="margin-top:18px;">Instrutores</h4>
                <p style="margin:0; font-size:.9rem; line-height:1.5; color:#2d465f;"><?= htmlspecialchars($c['instrutores']) ?></p>
              </div>
              <div class="course-section">
                <h4>Diferenciais</h4>
                <ul class="check-list">
                  <?php foreach ($c['beneficios'] as $b): ?>
                    <li><?= htmlspecialchars($b) ?></li>
                  <?php endforeach; ?>
                </ul>
                <div class="course-actions-inline">
                  <a class="btn-action alt" href="matricula.php?curso=<?= urlencode($slug) ?>"><i class="bi bi-pencil-square"></i> Matricule-se</a>
                </div>
              </div>
            </div>
          </details>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Substituir a seção FAQ antiga por esta nova -->
    <section class="faq-area">
      <h2>Perguntas Frequentes</h2>
      <p class="faq-intro">
        Tire dúvidas rápidas sobre inscrições, gratuidade, certificação e funcionamento dos cursos técnicos e da EJA.
        Se precisar de mais informações, fale com a secretaria.
      </p>

      <!-- REMOVIDO: blocos de botões Expandir/Recolher (faq-controls) -->

      <div class="faq-grid" id="faqGrid">
        <div class="faq-item">
          <details>
            <summary>
              <div class="faq-icon"><i class="bi bi-patch-question"></i></div>
              Como funciona o processo de matrícula?
              <div class="faq-chevron"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="faq-content">
              <span class="faq-highlight">Matrícula</span>
              <p>O aluno acessa a página de matrícula, preenche os dados solicitados e anexa os documentos necessários. Após o envio, a equipe escolar valida as informações e confirma o cadastro por e-mail ou contato direto.</p>
              <p><strong>Dica:</strong> mantenha CPF e e-mail corretos para evitar atrasos.</p>
            </div>
          </details>
        </div>

        <div class="faq-item">
          <details>
            <summary>
              <div class="faq-icon"><i class="bi bi-cash-coin"></i></div>
              Os cursos realmente são gratuitos?
              <div class="faq-chevron"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="faq-content">
              <span class="faq-highlight">Gratuidade</span>
              <p>Sim. Todos os cursos são oferecidos pela rede pública de ensino sem cobrança de mensalidade ou taxa de inscrição.</p>
              <p>Você só precisa manter frequência e desempenho mínimos para permanecer regularmente matriculado.</p>
            </div>
          </details>
        </div>

        <div class="faq-item">
          <details>
            <summary>
              <div class="faq-icon"><i class="bi bi-journal-check"></i></div>
              Há certificado ao final do curso?
              <div class="faq-chevron"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="faq-content">
              <span class="faq-highlight">Certificação</span>
              <p>Sim. Concluindo a carga horária e os componentes curriculares, o estudante recebe certificação técnica (no caso dos itinerários) ou conclusão da etapa (no caso da EJA).</p>
              <p>O documento é válido para prosseguir estudos ou ingressar no mercado.</p>
            </div>
          </details>
        </div>

        <div class="faq-item">
          <details>
            <summary>
              <div class="faq-icon"><i class="bi bi-clock-history"></i></div>
              Qual a duração dos cursos técnicos?
              <div class="faq-chevron"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="faq-content">
              <span class="faq-highlight">Duração</span>
              <p>Os cursos técnicos integrados acompanham os 3 anos do Ensino Médio, distribuindo teoria, prática e projetos integradores.</p>
              <p>Algumas atividades podem ocorrer em oficinas, labs ou eventos complementares.</p>
            </div>
          </details>
        </div>

        <div class="faq-item">
          <details>
            <summary>
              <div class="faq-icon"><i class="bi bi-people"></i></div>
              Quem pode ingressar no curso de EJA?
              <div class="faq-chevron"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="faq-content">
              <span class="faq-highlight">EJA</span>
              <p>Jovens e adultos que interromperam os estudos e desejam retomar a formação básica. A proposta é flexível e contextualizada.</p>
              <p>O atendimento prioriza inclusão, acolhimento e ritmo adaptado.</p>
            </div>
          </details>
        </div>

        <div class="faq-item">
          <details>
            <summary>
              <div class="faq-icon"><i class="bi bi-cpu"></i></div>
              Preciso ter conhecimento prévio em tecnologia?
              <div class="faq-chevron"><i class="bi bi-chevron-down"></i></div>
            </summary>
            <div class="faq-content">
              <span class="faq-highlight">Iniciantes</span>
              <p>Não. O curso de Desenvolvimento de Sistemas inicia com lógica, pensamento computacional e fundamentos básicos, guiando a evolução gradualmente.</p>
              <p>O importante é curiosidade, persistência e participação em projetos.</p>
            </div>
          </details>
        </div>
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

  <script>
    const accordion = document.getElementById('accordionCursos');
    const items = accordion.querySelectorAll('.course-item');
    const btnExpandAll = document.getElementById('btnExpandAll');
    const btnCollapseAll = document.getElementById('btnCollapseAll');

    btnExpandAll?.addEventListener('click', () => items.forEach(i => i.open = true));
    btnCollapseAll?.addEventListener('click', () => items.forEach(i => i.open = false));

    // Persistência do estado aberto
    const openKey = 'cursosOpen';

    function saveOpen() {
      const openIds = [];
      items.forEach((d, i) => {
        if (d.open) openIds.push(i);
      });
      sessionStorage.setItem(openKey, JSON.stringify(openIds));
    }

    function restoreOpen() {
      try {
        JSON.parse(sessionStorage.getItem(openKey) || '[]')
          .forEach(idx => {
            if (items[idx]) items[idx].open = true;
          });
      } catch {}
    }
    items.forEach(d => d.addEventListener('toggle', saveOpen));
    restoreOpen();

    // FAQ (ajustado: removidos botões expandir/recolher)
    const faqGrid = document.getElementById('faqGrid');
    const faqDetails = faqGrid.querySelectorAll('details');

    // Mantém comportamento de fechar outros ao abrir
    faqDetails.forEach(d => {
      d.addEventListener('toggle', () => {
        if (d.open) {
          faqDetails.forEach(o => {
            if (o !== d) o.open = false;
          });
        }
      });
    });
  </script>
</body>

</html>