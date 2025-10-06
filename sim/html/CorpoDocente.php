<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
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

    .content {
      width: 100vw;
      height: 70px;
      display: flex;
      justify-content: space-around;
      align-items: center;
      background-color: #213967;
      position: fixed;
      top: 0;
      padding-left: 30rem;
      z-index: 1;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      /* Space between the logo image and text */
    }

    .logo a {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .logo img {
      height: 50px;
    }

    .logo h3 {
      color: white;
      font-size: 2rem;
      margin: 0;
    }

    .content .list-menu {
      width: 600px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .content .list-menu li a {
      padding: 3rem 1rem 2rem 1rem;
      color: white;
      font-size: 1.8rem;
      text-transform: uppercase;
      font-weight: 500px;
      transition: all 200ms ease-in;
    }

    .content .list-menu li a:hover {
      background-color: #1c3f80;
      border-bottom: 4px solid #8db2f6;
      color: #8db2f6;
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
      padding-left: 0;
      list-style: none;
    }

    main ul li {
      margin: 0 0 10px;
      background: #f9fbfd;
      border: 1px solid #d6e4f1;
      border-left: 6px solid #1a73e8;
      border-radius: 10px;
      padding: 10px 14px 11px;
      font-size: 1.45rem;
      line-height: 1.4;
      transition: 0.25s;
    }

    main ul li strong {
      display: block;
      font-size: 1.55rem;
      color: #1a3f69;
      margin-bottom: 2px;
      font-weight: 600;
    }

    main ul li:hover {
      background: #f1f7fd;
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
        font-size: 1.35rem;
      }

      main ul li strong {
        font-size: 1.45rem;
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

    /* ===== NOVO: Introdução + Busca simples ===== */
    .intro-docentes {
      background: #eef4fb;
      border: 1px solid #c9dbef;
      padding: 18px 20px 22px;
      border-radius: 12px;
      font-size: 1.5rem;
      line-height: 1.5;
    }

    .intro-docentes p {
      margin: 0 0 12px;
    }

    .busca-prof {
      display: flex;
      flex-wrap: wrap;
      gap: 0.8rem;
      align-items: center;
      margin: 6px 0 4px;
    }

    .busca-prof span {
      font-weight: 600;
      font-size: 1.4rem;
      color: #1a4d86;
    }

    .busca-prof input {
      flex: 1 1 260px;
      padding: 0.7rem 1rem;
      font-size: 1.4rem;
      border: 1px solid #9fbad6;
      border-radius: 8px;
      outline: none;
      background: #fff;
      transition: 0.25s;
    }

    .busca-prof input:focus {
      border-color: #1a73e8;
      box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.25);
    }

    .resultado-info {
      margin: 6px 0 0;
      font-size: 1.3rem;
      color: #555;
    }

    /* ==== Navegação interna / utilidades ==== */
    .docentes-atalhos {
      margin: 18px 0 22px;
      display: flex;
      flex-wrap: wrap;
      gap: .7rem;
      align-items: center;
      background: #eef4fb;
      border: 1px solid #c9dbef;
      padding: 10px 14px;
      border-radius: 10px;
      font-size: 1.35rem;
    }

    .docentes-atalhos a,
    .docentes-atalhos button {
      appearance: none;
      border: 1px solid #1a73e8;
      background: #1a73e8;
      color: #fff;
      padding: .45rem .9rem;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1.25rem;
      text-decoration: none;
      line-height: 1.2;
      transition: .25s;
    }

    .docentes-atalhos a:hover,
    .docentes-atalhos button:hover {
      background: #155ec1;
      border-color: #155ec1;
    }

    .docentes-atalhos button.alt {
      background: #fff;
      color: #1a73e8;
    }

    .docentes-atalhos button.alt:hover {
      background: #e3effd;
    }

    h3 .count-sec {
      font-size: 1.2rem;
      font-weight: 500;
      color: #555;
      margin-left: .6rem;
      background: #e6eef7;
      padding: 2px 7px 3px;
      border-radius: 20px;
      vertical-align: middle;
    }

    mark {
      background: #ffe8a3;
      padding: 0 2px;
      border-radius: 3px;
    }

    #btnTopo {
      position: fixed;
      right: 14px;
      bottom: 16px;
      background: #1a73e8;
      color: #fff;
      border: none;
      padding: .7rem 1rem;
      border-radius: 30px;
      font-size: 1.25rem;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(0, 0, 0, .25);
      display: none;
      z-index: 20;
      transition: .3s;
    }

    #btnTopo:hover {
      background: #155ec1;
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
        <?php if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'aluno'): ?>
          <li><a href="../html/matricula.php">Matricula</a></li>
        <?php endif; ?>
        <?php if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'professor'): ?>
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

  <main>
    <h2>Corpo Docente da ETAN</h2>

    <!-- NOVO BLOCO INTRO + BUSCA -->
    <section class="intro-docentes">
      <p>
        Abaixo estão os professores organizados por área. Use a caixa de busca para encontrar
        rapidamente um nome ou matéria. Pais e estudantes podem consultar quem leciona cada componente.
      </p>
      <div class="busca-prof">
        <span>Buscar professor ou matéria:</span>
        <input id="buscaProf" type="search" placeholder="Ex.: Matemática, Denise, Front End">
      </div>
      <p id="resultadoInfo" class="resultado-info"></p>
      <details style="margin-top:10px; font-size:1.3rem;">
        <summary style="cursor:pointer; font-weight:600; color:#1a73e8;">Siglas / Termos</summary>
        <div style="margin-top:6px;">
          <strong>E.P.E:</strong> Estudo, Pesquisa e Extensão / <strong>ICE:</strong> Itinerário de Complementação Educacional
        </div>
      </details>
    </section>

    <!-- NOVO: atalhos / controles -->
    <nav class="docentes-atalhos" aria-label="Atalhos das seções de professores">
      <a href="#sec-gerais">Gerais</a>
      <a href="#sec-logistica">Logística</a>
      <a href="#sec-ds">Desenv. Sistemas</a>
      <button id="ordenarAZ" type="button" class="alt" aria-pressed="false">Ordenar A‑Z</button>
      <button id="limparBusca" type="button" class="alt" style="display:none;">Limpar Busca</button>
    </nav>

    <!-- Ajustado: IDs e spans de contagem -->
    <h3 id="sec-gerais">Matérias Gerais <span class="count-sec" data-sec="gerais"></span></h3>
    <ul data-sec="gerais">
      <li data-nome="Denise Nunes Pereira Fonseca Bastos" data-materias="Português Redação">
        <strong>Denise Nunes Pereira Fonseca Bastos</strong>
        Português / Redação
      </li>
      <li data-nome="José Geraldo Botelho" data-materias="Português">
        <strong>José Geraldo Botelho</strong>
        Português
      </li>
      <li data-nome="Giovani Pontes Coelho" data-materias="Matemática Estudos Orientados">
        <strong>Giovani Pontes Coelho</strong>
        Matemática / Estudos Orientados
      </li>
      <li data-nome="Geraldo Marcelino de Souza" data-materias="Matemática Robótica">
        <strong>Geraldo Marcelino de Souza</strong>
        Matemática / Robótica
      </li>
      <li data-nome="Grasielle Aparecida Lage Amorim" data-materias="História Estudos Orientados">
        <strong>Grasielle Aparecida Lage Amorim</strong>
        História / Estudos Orientados
      </li>
      <li data-nome="Ângela Coura Castro" data-materias="Geografia Estudos Orientados">
        <strong>Ângela Coura Castro</strong>
        Geografia / Estudos Orientados
      </li>
      <li data-nome="Vanersa Carla Ventura" data-materias="Biologia">
        <strong>Vanersa Carla Ventura</strong>
        Biologia
      </li>
      <li data-nome="Keila Magalhães Pereira" data-materias="Química Projeto de Vida">
        <strong>Keila Magalhães Pereira</strong>
        Química / Projeto de Vida
      </li>
      <li data-nome="Kéli de Fátima Andrade" data-materias="Inglês">
        <strong>Kéli de Fátima Andrade</strong>
        Inglês
      </li>
      <li data-nome="Karolinny de Oliveira Marinho" data-materias="Física">
        <strong>Karolinny de Oliveira Marinho</strong>
        Física
      </li>
      <li data-nome="Claudinei Vieira do Carmo" data-materias="Filosofia">
        <strong>Claudinei Vieira do Carmo</strong>
        Filosofia
      </li>
      <li data-nome="Renata Rezende Duarte" data-materias="Artes">
        <strong>Renata Rezende Duarte</strong>
        Artes
      </li>
      <li data-nome="Raufi Santiago Fonseca" data-materias="Práticas Experimentais">
        <strong>Raufi Santiago Fonseca</strong>
        Práticas Experimentais
      </li>
      <li data-nome="Selma Alcina do Carmo" data-materias="Educação Física Laboratório de Aprendizagem">
        <strong>Selma Alcina do Carmo</strong>
        Educação Física / Laboratório de Aprendizagem
      </li>
      <li data-nome="Wânia Faria de Carvalho Avelino Cardoso" data-materias="Eletivas Itinerário Técnico">
        <strong>Wânia Faria de Carvalho Avelino Cardoso</strong>
        Eletivas do Itinerário Técnico
      </li>
    </ul>

    <h3 id="sec-logistica">Curso de Logística <span class="count-sec" data-sec="logistica"></span></h3>
    <ul data-sec="logistica">
      <li data-nome="Almir Silveira Barreiros" data-materias="Logística">
        <strong>Almir Silveira Barreiros</strong>
        Logística
      </li>
    </ul>

    <h3 id="sec-ds">Curso de Desenvolvimento de Sistemas <span class="count-sec" data-sec="ds"></span></h3>
    <ul data-sec="ds">
      <li data-nome="Evânio da Paixão" data-materias="Front End Back End">
        <strong>Evânio da Paixão</strong>
        Front End 1 / Front End 2 / Back End
      </li>
      <li data-nome="Matheus Aguiar Colombari" data-materias="Banco de Dados Arquitetura Sistemas Matemática Discreta Pensamento Computacional Desenvolvimento Software EPE">
        <strong>Matheus Aguiar Colombari</strong>
        Banco de Dados / Arquitetura de Sistemas / Matemática Discreta /
        Introdução ao Pensamento Computacional / Conceitos Avançados de
        Arquitetura de Sistemas / Desenvolvimento de Software / E.P.E
      </li>
      <li data-nome="Henrique Alves Amorim" data-materias="Algoritmo Estrutura de Dados Análise Desenvolvimento Sistemas">
        <strong>Henrique Alves Amorim</strong>
        Algoritmo e Estrutura de Dados / Análise e Desenvolvimento de Sistemas
      </li>
      <li data-nome="Anna Cláudia Almeida Anício" data-materias="Lógica">
        <strong>Anna Cláudia Almeida Anício</strong>
        Lógica
      </li>
      <li data-nome="Wânia Faria de Carvalho Avelino Cardoso" data-materias="ICE">
        <strong>Wânia Faria de Carvalho Avelino Cardoso</strong>
        ICE
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

  <!-- Botão voltar ao topo -->
  <button id="btnTopo" aria-label="Voltar ao topo"><i class="bi bi-chevron-up"></i></button>

  <script>
    // ===== NOVO: Filtro simples por nome ou matéria =====
    (function() {
      const input = document.getElementById('buscaProf');
      const info = document.getElementById('resultadoInfo');
      const itens = Array.from(document.querySelectorAll('main ul li'));
      const total = itens.length;

      function norm(t) {
        return t.toLowerCase()
          .normalize('NFD')
          .replace(/[\u0300-\u036f]/g, '')
          .trim();
      }

      function filtrar() {
        const termo = norm(input.value);
        let visiveis = 0;
        itens.forEach(li => {
          const nome = norm(li.dataset.nome || '');
          const mat = norm(li.dataset.materias || '');
          const ok = !termo || nome.includes(termo) || mat.includes(termo);
          li.style.display = ok ? '' : 'none';
          if (ok) visiveis++;
        });
        info.textContent = termo ?
          `Mostrando ${visiveis} de ${total} professores` :
          `Total de professores: ${total}`;
      }
      input.addEventListener('input', filtrar);
      filtrar();
    })();

    (function enhance() {
      const input = document.getElementById('buscaProf');
      const info = document.getElementById('resultadoInfo');
      const ordenarBtn = document.getElementById('ordenarAZ');
      const limparBtn = document.getElementById('limparBusca');
      const btnTopo = document.getElementById('btnTopo');
      const uls = Array.from(document.querySelectorAll('main ul[data-sec]'));
      const counts = {};
      uls.forEach(ul => {
        const sec = ul.dataset.sec;
        counts[sec] = {
          ul,
          items: Array.from(ul.querySelectorAll('li')),
          span: document.querySelector('.count-sec[data-sec="' + sec + '"]')
        };
        // Salva HTML original de cada li e strong (para destacar depois)
        counts[sec].items.forEach(li => {
          li.dataset.originalHtml = li.innerHTML;
          const strong = li.querySelector('strong');
          if (strong) strong.dataset.originalText = strong.textContent;
        });
      });
      const total = uls.reduce((acc, u) => acc + u.querySelectorAll('li').length, 0);

      function norm(t) {
        return t.toLowerCase()
          .normalize('NFD')
          .replace(/[\u0300-\u036f]/g, '')
          .trim();
      }

      function highlightName(li, termNorm) {
        const strong = li.querySelector('strong');
        if (!strong) return;
        const original = strong.dataset.originalText || strong.textContent;
        if (!termNorm) {
          strong.innerHTML = original;
          return;
        }
        const normText = norm(original);
        let idx = normText.indexOf(termNorm);
        if (idx === -1) {
          strong.innerHTML = original;
          return;
        }
        let pieces = [];
        let last = 0;
        while (idx !== -1) {
          const end = idx + termNorm.length;
          pieces.push(original.slice(last, idx));
          pieces.push('<mark>' + original.slice(idx, end) + '</mark>');
          last = end;
          idx = normText.indexOf(termNorm, end);
        }
        pieces.push(original.slice(last));
        strong.innerHTML = pieces.join('');
      }

      function atualizarContagens() {
        Object.values(counts).forEach(obj => {
          const visiveis = obj.items.filter(li => li.style.display !== 'none').length;
          if (obj.span) obj.span.textContent = `(${visiveis})`;
        });
      }

      function filtrar() {
        const termo = norm(input.value);
        let visiveisGlobais = 0;
        Object.values(counts).forEach(obj => {
          obj.items.forEach(li => {
            const nome = norm(li.dataset.nome || '');
            const mat = norm(li.dataset.materias || '');
            const ok = !termo || nome.includes(termo) || mat.includes(termo);
            li.style.display = ok ? '' : 'none';
            highlightName(li, termo && ok ? termo : '');
            if (ok) visiveisGlobais++;
          });
        });
        info.textContent = termo ?
          `Mostrando ${visiveisGlobais} de ${total} professores` :
          `Total de professores: ${total}`;
        limparBtn.style.display = termo ? '' : 'none';
        atualizarContagens();
      }

      // Substitui antiga chamada (se houver) preservando função
      if (input) {
        input.removeEventListener('input', window.__docFiltro || (() => {}));
        input.addEventListener('input', filtrar);
        window.__docFiltro = filtrar;
      }

      limparBtn.addEventListener('click', () => {
        input.value = '';
        filtrar();
        input.focus();
      });

      // Ordenação A-Z (toggle)
      let ordenado = false;
      ordenarBtn.addEventListener('click', () => {
        ordenado = !ordenado;
        ordenarBtn.setAttribute('aria-pressed', ordenado);
        ordenarBtn.textContent = ordenado ? 'Restaurar Ordem' : 'Ordenar A‑Z';
        Object.values(counts).forEach(obj => {
          if (ordenado) {
            obj.items.sort((a, b) => {
              return a.dataset.nome.localeCompare(b.dataset.nome, 'pt', {
                sensitivity: 'base'
              });
            });
          } else {
            // Restaura ordem original usando posição no DOM salvo (índice inicial)
            obj.items.sort((a, b) => {
              return a.dataset.originalIndex - b.dataset.originalIndex;
            });
          }
          obj.items.forEach(li => obj.ul.appendChild(li));
        });
      });

      // Salva índice original
      Object.values(counts).forEach(obj => {
        obj.items.forEach((li, i) => li.dataset.originalIndex = i);
      });

      // Botão topo
      window.addEventListener('scroll', () => {
        btnTopo.style.display = window.scrollY > 300 ? 'block' : 'none';
      });
      btnTopo.addEventListener('click', () => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });

      filtrar();
    })();
  </script>
</body>

</html>