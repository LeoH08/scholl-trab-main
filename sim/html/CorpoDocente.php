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
  <link rel="stylesheet" href="../css/stylecorpodocente.css">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <!-- Ajustes mínimos para garantir que o rodapé apareça -->
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1 0 auto;
    }

    .footer-content {
      flex-shrink: 0;
      display: block !important;
      position: relative;
      width: 100%;
      z-index: 5;
    }

    .footer-social,
    .footer-info {
      /* garante que não fiquem colados/transparentes por algum reset */
      background-color: inherit;
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

    <nav class="docentes-atalhos" aria-label="Atalhos das seções de professores">
      <a href="#sec-gerais">Gerais</a>
      <a href="#sec-logistica">Logística</a>
      <a href="#sec-ds">Desenv. Sistemas</a>
      <button id="ordenarAZ" type="button" class="alt" aria-pressed="false">Ordenar A‑Z</button>
      <button id="limparBusca" type="button" class="alt" style="display:none;">Limpar Busca</button>
    </nav>

    <h3 id="sec-gerais">Matérias Gerais <span class="count-sec" data-sec="gerais"></span></h3>
    <ul data-sec="gerais">
      <li data-nome="Denise Nunes Pereira Fonseca Bastos" data-materias="Português Redação">
        <span class="prof-avatar">D</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Denise Nunes Pereira Fonseca Bastos</strong></span>
          <div class="prof-materias">
            Português / Redação
          </div>
          <span class="prof-tag">Língua Portuguesa</span>
        </div>
      </li>
      <li data-nome="José Geraldo Botelho" data-materias="Português">
        <span class="prof-avatar">J</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>José Geraldo Botelho</strong></span>
          <div class="prof-materias">
            Português
          </div>
          <span class="prof-tag">Língua Portuguesa</span>
        </div>
      </li>
      <li data-nome="Giovani Pontes Coelho" data-materias="Matemática Estudos Orientados">
        <span class="prof-avatar">G</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Giovani Pontes Coelho</strong></span>
          <div class="prof-materias">
            Matemática / Estudos Orientados
          </div>
          <span class="prof-tag">Matemática</span>
        </div>
      </li>
      <li data-nome="Geraldo Marcelino de Souza" data-materias="Matemática Robótica">
        <span class="prof-avatar">G</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Geraldo Marcelino de Souza</strong></span>
          <div class="prof-materias">
            Matemática / Robótica
          </div>
          <span class="prof-tag">Matemática</span>
        </div>
      </li>
      <li data-nome="Grasielle Aparecida Lage Amorim" data-materias="História Estudos Orientados">
        <span class="prof-avatar">G</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Grasielle Aparecida Lage Amorim</strong></span>
          <div class="prof-materias">
            História / Estudos Orientados
          </div>
          <span class="prof-tag">História</span>
        </div>
      </li>
      <li data-nome="Ângela Coura Castro" data-materias="Geografia Estudos Orientados">
        <span class="prof-avatar">Â</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Ângela Coura Castro</strong></span>
          <div class="prof-materias">
            Geografia / Estudos Orientados
          </div>
          <span class="prof-tag">Geografia</span>
        </div>
      </li>
      <li data-nome="Vanersa Carla Ventura" data-materias="Biologia">
        <span class="prof-avatar">V</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Vanersa Carla Ventura</strong></span>
          <div class="prof-materias">
            Biologia
          </div>
          <span class="prof-tag">Biologia</span>
        </div>
      </li>
      <li data-nome="Keila Magalhães Pereira" data-materias="Química Projeto de Vida">
        <span class="prof-avatar">K</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Keila Magalhães Pereira</strong></span>
          <div class="prof-materias">
            Química / Projeto de Vida
          </div>
          <span class="prof-tag">Química</span>
        </div>
      </li>
      <li data-nome="Kéli de Fátima Andrade" data-materias="Inglês">
        <span class="prof-avatar">K</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Kéli de Fátima Andrade</strong></span>
          <div class="prof-materias">
            Inglês
          </div>
          <span class="prof-tag">Inglês</span>
        </div>
      </li>
      <li data-nome="Karolinny de Oliveira Marinho" data-materias="Física">
        <span class="prof-avatar">K</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Karolinny de Oliveira Marinho</strong></span>
          <div class="prof-materias">
            Física
          </div>
          <span class="prof-tag">Física</span>
        </div>
      </li>
      <li data-nome="Claudinei Vieira do Carmo" data-materias="Filosofia">
        <span class="prof-avatar">C</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Claudinei Vieira do Carmo</strong></span>
          <div class="prof-materias">
            Filosofia
          </div>
          <span class="prof-tag">Filosofia</span>
        </div>
      </li>
      <li data-nome="Renata Rezende Duarte" data-materias="Artes">
        <span class="prof-avatar">R</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Renata Rezende Duarte</strong></span>
          <div class="prof-materias">
            Artes
          </div>
          <span class="prof-tag">Artes</span>
        </div>
      </li>
      <li data-nome="Raufi Santiago Fonseca" data-materias="Práticas Experimentais">
        <span class="prof-avatar">R</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Raufi Santiago Fonseca</strong></span>
          <div class="prof-materias">
            Práticas Experimentais
          </div>
          <span class="prof-tag">Práticas Experimentais</span>
        </div>
      </li>
      <li data-nome="Selma Alcina do Carmo" data-materias="Educação Física Laboratório de Aprendizagem">
        <span class="prof-avatar">S</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Selma Alcina do Carmo</strong></span>
          <div class="prof-materias">
            Educação Física / Laboratório de Aprendizagem
          </div>
          <span class="prof-tag">Educação Física</span>
        </div>
      </li>
      <li data-nome="Wânia Faria de Carvalho Avelino Cardoso" data-materias="Eletivas Itinerário Técnico">
        <span class="prof-avatar">W</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Wânia Faria de Carvalho Avelino Cardoso</strong></span>
          <div class="prof-materias">
            Eletivas do Itinerário Técnico
          </div>
          <span class="prof-tag">Eletivas</span>
        </div>
      </li>
    </ul>

    <h3 id="sec-logistica">Curso de Logística <span class="count-sec" data-sec="logistica"></span></h3>
    <ul data-sec="logistica">
      <li data-nome="Almir Silveira Barreiros" data-materias="Logística">
        <span class="prof-avatar">A</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Almir Silveira Barreiros</strong></span>
          <div class="prof-materias">
            Logística
          </div>
          <span class="prof-tag">Logística</span>
        </div>
      </li>
    </ul>

    <h3 id="sec-ds">Curso de Desenvolvimento de Sistemas <span class="count-sec" data-sec="ds"></span></h3>
    <ul data-sec="ds">
      <li data-nome="Evânio da Paixão" data-materias="Front End Back End">
        <span class="prof-avatar">E</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Evânio da Paixão</strong></span>
          <div class="prof-materias">
            Front End 1 / Front End 2 / Back End
          </div>
          <span class="prof-tag">Desenvolvimento de Sistemas</span>
        </div>
      </li>
      <li data-nome="Matheus Aguiar Colombari" data-materias="Banco de Dados Arquitetura Sistemas Matemática Discreta Pensamento Computacional Desenvolvimento Software EPE">
        <span class="prof-avatar">M</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Matheus Aguiar Colombari</strong></span>
          <div class="prof-materias">
            Banco de Dados / Arquitetura de Sistemas / Matemática Discreta /
            Introdução ao Pensamento Computacional / Conceitos Avançados de
            Arquitetura de Sistemas / Desenvolvimento de Software / E.P.E
          </div>
          <span class="prof-tag">Desenvolvimento de Sistemas</span>
        </div>
      </li>
      <li data-nome="Henrique Alves Amorim" data-materias="Algoritmo Estrutura de Dados Análise Desenvolvimento Sistemas">
        <span class="prof-avatar">H</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Henrique Alves Amorim</strong></span>
          <div class="prof-materias">
            Algoritmo e Estrutura de Dados / Análise e Desenvolvimento de Sistemas
          </div>
          <span class="prof-tag">Desenvolvimento de Sistemas</span>
        </div>
      </li>
      <li data-nome="Anna Cláudia Almeida Anício" data-materias="Lógica">
        <span class="prof-avatar">A</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Anna Cláudia Almeida Anício</strong></span>
          <div class="prof-materias">
            Lógica
          </div>
          <span class="prof-tag">Desenvolvimento de Sistemas</span>
        </div>
      </li>
      <li data-nome="Wânia Faria de Carvalho Avelino Cardoso" data-materias="ICE">
        <span class="prof-avatar">W</span>
        <div class="prof-info">
          <span class="prof-nome"><strong>Wânia Faria de Carvalho Avelino Cardoso</strong></span>
          <div class="prof-materias">
            ICE
          </div>
          <span class="prof-tag">Desenvolvimento de Sistemas</span>
        </div>
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
          href="https://api.whatsapp.com/send/?phone=31996013814&text&type=phone_number&app_absent=0">
          <i class="bi bi-whatsapp"></i> Contato
        </a>
        |
        <a style="color: aliceblue" href="../html/politica.php">
          <i class="bi bi-shield-lock"></i> Política de Privacidade
        </a>
      </p>
    </div>
  </footer>

  <button id="btnTopo" aria-label="Voltar ao topo"><i class="bi bi-chevron-up"></i></button>

  <script>
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

      if (input) {
        input.addEventListener('input', filtrar);
      }

      limparBtn.addEventListener('click', () => {
        input.value = '';
        filtrar();
        input.focus();
      });

      let ordenado = false;
      ordenarBtn.addEventListener('click', () => {
        ordenado = !ordenado;
        ordenarBtn.setAttribute('aria-pressed', ordenado ? 'true' : 'false');
        ordenarBtn.textContent = ordenado ? 'Restaurar Ordem' : 'Ordenar A‑Z';

        Object.values(counts).forEach(obj => {
          if (ordenado) {
            obj.items.sort((a, b) =>
              a.dataset.nome.localeCompare(b.dataset.nome, 'pt', {
                sensitivity: 'base'
              })
            );
          } else {
            obj.items.sort((a, b) =>
              a.dataset.originalIndex - b.dataset.originalIndex
            );
          }
          obj.items.forEach(li => obj.ul.appendChild(li));
        });
      });

      Object.values(counts).forEach(obj => {
        obj.items.forEach((li, i) => li.dataset.originalIndex = i);
      });

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