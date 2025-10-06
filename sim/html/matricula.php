<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/stylelayout.css" />
  <link rel="stylesheet" href="../css/stylematricula.css" />
  <link
    rel="shortcut icon"
    href="../fts/Logo_EETAN.png"
    type="image/x-icon" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <title>Formulário de Matrícula - EETAN</title>
  <!-- ESTILOS ADICIONAIS (override) -->
  <style>
    .matricula-progress {
      display: flex;
      gap: 12px;
      margin: 32px 0 28px 0;
      counter-reset: step;
    }

    .matricula-progress-step {
      flex: 1;
      position: relative;
      text-align: center;
      font-size: .85rem;
      color: #5a6b85;
      font-weight: 600;
      letter-spacing: .05rem;
    }

    .matricula-progress-step:before {
      counter-increment: step;
      content: counter(step);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #dbe6f5;
      color: #213967;
      font-weight: 700;
      margin-bottom: 6px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, .08);
    }

    .matricula-progress-step.active:before,
    .matricula-progress-step.done:before {
      background: #2f65b8;
      color: #fff;
    }

    .matricula-progress-step.done {
      opacity: .75;
    }

    .matricula-progress-step.active {
      color: #2f65b8;
    }

    .matricula-fieldset {
      display: none;
      animation: fade .35s ease;
      border: 0;
      padding: 0;
      margin: 0;
    }

    .matricula-fieldset.active {
      display: block;
    }

    @keyframes fade {
      from {
        opacity: 0;
        transform: translateY(6px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    form.matricula-form .form-group {
      margin-bottom: 20px;
    }

    form.matricula-form label {
      display: block;
      font-weight: 600;
      color: #0a2351;
      margin-bottom: 6px;
    }

    form.matricula-form input,
    form.matricula-form select {
      width: 100%;
      padding: 14px 14px;
      border: 1px solid #b9c8dd;
      border-radius: 10px;
      font-size: 1.05rem;
      line-height: 1.3;
      background: #fff;
      transition: border-color .25s, box-shadow .25s, background .25s;
    }

    form.matricula-form input:focus,
    form.matricula-form select:focus {
      outline: none;
      border-color: #2f65b8;
      box-shadow: 0 0 0 3px rgba(47, 101, 184, .25);
    }

    .hint {
      font-size: .7rem;
      letter-spacing: .05rem;
      color: #45566f;
      margin-top: 4px;
    }

    .step-nav {
      display: flex;
      justify-content: space-between;
      gap: 16px;
      margin-top: 10px;
    }

    .step-nav button,
    .final-actions button {
      flex: 1;
      cursor: pointer;
      background: #2f65b8;
      color: #fff;
      font-weight: 600;
      border: 0;
      padding: 14px 18px;
      border-radius: 10px;
      font-size: 1rem;
      letter-spacing: .05rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      transition: background .25s, transform .25s;
    }

    .step-nav button[disabled] {
      opacity: .4;
      cursor: not-allowed;
    }

    .step-nav button.alt {
      background: #7b8798;
    }

    .step-nav button:hover:not([disabled]),
    .final-actions button:hover {
      background: #213967;
      transform: translateY(-2px);
    }

    .final-actions {
      margin-top: 24px;
      text-align: center;
    }

    .final-actions button {
      width: 100%;
    }

    .cep-inline {
      display: grid;
      grid-template-columns: 1fr 130px;
      gap: 12px;
    }

    @media (max-width:650px) {
      .cep-inline {
        grid-template-columns: 1fr;
      }

      .matricula-progress-step {
        font-size: .7rem;
      }

      .matricula-progress-step:before {
        width: 34px;
        height: 34px;
      }
    }

    .autocomplete-status {
      font-size: .65rem;
      color: #2f65b8;
      margin-top: 4px;
      display: none;
    }

    .matricula-form input.invalid {
      border-color: #c0392b;
      background: #ffecec;
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
    <form
      class="matricula-form"
      action="../php/controller/matricula.php"
      method="post"
      enctype="multipart/form-data"
      novalidate
      id="matriculaForm">
      <h1>Formulário de Matrícula</h1>

      <div class="matricula-progress" aria-label="Progresso do formulário">
        <div class="matricula-progress-step active" data-step-indicator="1" aria-current="step">Dados</div>
        <div class="matricula-progress-step" data-step-indicator="2">Contato</div>
        <div class="matricula-progress-step" data-step-indicator="3">Escolar</div>
      </div>

      <!-- Etapa 1 -->
      <fieldset class="matricula-fieldset active" data-step="1">
        <div class="form-group">
          <label for="nome">Nome Completo</label>
          <input type="text" id="nome" name="nome" placeholder="Ex: João da Silva" required />
          <p class="hint">Informe o nome civil completo conforme documento.</p>
        </div>
        <div class="form-group">
          <label for="data_nascimento">Data de Nascimento</label>
          <input type="date" id="data_nascimento" name="data_nascimento" required />
        </div>
        <div class="form-group">
          <label for="sexo">Sexo</label>
          <select id="sexo" name="sexo" required>
            <option value="" disabled selected>Selecione</option>
            <option value="feminino">Feminino</option>
            <option value="masculino">Masculino</option>
            <option value="outro">Outro / Prefiro não informar</option>
          </select>
        </div>
        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="text" id="cpf" name="cpf" placeholder="Ex: 123.456.789-10" maxlength="14" required />
          <p class="hint">Digite somente números ou use o formato 000.000.000-00.</p>
        </div>
        <div class="form-group">
          <label for="rg">RG (Identidade)</label>
          <input type="text" id="rg" name="rg" placeholder="Ex: MG-12.345.678" required />
        </div>
        <div class="step-nav">
          <button type="button" id="next1">Próximo &raquo;</button>
        </div>
      </fieldset>

      <!-- Etapa 2 -->
      <fieldset class="matricula-fieldset" data-step="2">
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" placeholder="Ex: aluno@email.com" required />
        </div>
        <div class="form-group">
          <label for="contato">Número de Contato (WhatsApp)</label>
          <input type="tel" id="contato" name="contato" placeholder="(31) 99999-0000" required />
        </div>
        <div class="form-group cep-inline">
          <div>
            <label for="cep">CEP</label>
            <input type="text" id="cep" name="cep" placeholder="Ex: 35170-000" pattern="\\d{5}-?\\d{3}" />
            <p class="hint">Digite CEP e saia do campo para auto-preencher endereço.</p>
          </div>
          <div>
            <label for="responsavel">Responsável</label>
            <input type="text" id="responsavel" name="responsavel" placeholder="Ex: Maria de Souza" required />
          </div>
        </div>
        <div class="form-group">
          <label for="endereco">Endereço Completo</label>
          <input
            type="text"
            id="endereco"
            name="endereco"
            placeholder="Logradouro, número, bairro, cidade - UF"
            required />
          <p class="hint">Ex: Rua das Acácias, 120, Centro, Coronel Fabriciano - MG</p>
        </div>
        <div class="step-nav">
          <button type="button" class="alt" data-prev="1">&laquo; Voltar</button>
          <button type="button" data-next="3">Próximo &raquo;</button>
        </div>
      </fieldset>

      <!-- Etapa 3 -->
      <fieldset class="matricula-fieldset" data-step="3">
        <div class="form-group">
          <label for="escola_origem">Escola de Origem</label>
          <input
            type="text"
            id="escola_origem"
            name="escola_origem"
            list="lista-escolas"
            placeholder="Digite para sugerir..."
            required
            autocomplete="off" />
          <datalist id="lista-escolas"><!-- preenchido via JS --></datalist>
          <p class="autocomplete-status" id="escolaStatus">Sugestões carregadas</p>
        </div>
        <div class="form-group">
          <label for="ano">Ano/Série</label>
          <select id="ano" name="ano" required>
            <option value="" disabled selected>Selecione</option>
            <option value="1">1º Ano</option>
            <option value="2">2º Ano</option>
            <option value="3">3º Ano</option>
          </select>
        </div>
        <div class="form-group">
          <label for="turno">Turno</label>
          <select id="turno" name="turno" required>
            <option value="" disabled selected>Selecione</option>
            <option value="integral">Integral</option>
            <option value="noturno">Noturno</option>
          </select>
        </div>
        <div class="form-group">
          <label for="curso">Curso Desejado</label>
          <select id="curso" name="curso" required>
            <option value="" disabled selected>Selecione um curso</option>
            <option value="desenvolvimento">Desenvolvimento de Sistemas</option>
            <option value="logistica">Logística</option>
            <option value="eja">EJA</option>
          </select>
        </div>
        <div class="form-group">
          <label for="necessidades">Necessidades Especiais (se houver)</label>
          <input type="text" id="necessidades" name="necessidades" placeholder="Ex: Baixa visão" />
        </div>
        <div class="form-group">
          <label for="documentos">Anexar Documentos</label>
          <input type="file" id="documentos" name="documentos[]" multiple />
          <p class="hint">RG, CPF, comprovante de residência, histórico escolar (PDF/JPG).</p>
        </div>
        <div class="form-group" style="margin-top:4px;">
          <label style="display:flex; gap:8px; align-items:center; font-weight:500;">
            <input type="checkbox" name="autorizacao_imagem" required />
            Autorizo o uso de imagem do aluno para fins institucionais.
          </label>
        </div>
        <div class="step-nav">
          <button type="button" class="alt" data-prev="2">&laquo; Voltar</button>
        </div>
        <div class="final-actions">
          <button type="submit"><i class="bi bi-send"></i> Enviar Matrícula</button>
        </div>
      </fieldset>
    </form>
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
    (function() {
      const form = document.getElementById('matriculaForm');
      const steps = Array.from(document.querySelectorAll('.matricula-fieldset'));
      const indicators = Array.from(document.querySelectorAll('[data-step-indicator]'));
      let current = 1;

      function showStep(n) {
        steps.forEach(fs => fs.classList.toggle('active', Number(fs.dataset.step) === n));
        indicators.forEach(ind => {
          const stepNum = Number(ind.dataset.stepIndicator);
          ind.classList.toggle('active', stepNum === n);
          ind.classList.toggle('done', stepNum < n);
          if (stepNum === n) ind.setAttribute('aria-current', 'step');
          else ind.removeAttribute('aria-current');
        });
        current = n;
        // Focus first input
        const first = steps.find(fs => Number(fs.dataset.step) === n).querySelector('input, select');
        if (first) setTimeout(() => first.focus(), 60);
      }

      function validateStep(n) {
        const fieldset = steps.find(fs => Number(fs.dataset.step) === n);
        let ok = true;
        if (!fieldset) return true;
        fieldset.querySelectorAll('[required]').forEach(el => {
          if (!el.value.trim()) {
            el.classList.add('invalid');
            ok = false;
          } else {
            el.classList.remove('invalid');
          }
        });
        return ok;
      }

      document.querySelectorAll('[data-next]').forEach(btn => {
        btn.addEventListener('click', () => {
          const from = current;
          if (!validateStep(from)) return;
          showStep(Number(btn.dataset.next));
        });
      });
      document.querySelectorAll('[data-prev]').forEach(btn => {
        btn.addEventListener('click', () => showStep(Number(btn.dataset.prev)));
      });
      document.getElementById('next1')?.addEventListener('click', () => {
        if (!validateStep(1)) return;
        showStep(2);
      });

      form.addEventListener('submit', e => {
        if (!validateStep(current)) {
          e.preventDefault();
          return;
        }
      });

      // CEP auto-preenchimento (ViaCEP)
      const cepInput = document.getElementById('cep');
      const enderecoInput = document.getElementById('endereco');
      if (cepInput) {
        cepInput.addEventListener('blur', () => {
          const raw = cepInput.value.replace(/\D/g, '');
          if (raw.length !== 8) return;
          fetch(`https://viacep.com.br/ws/${raw}/json/`)
            .then(r => r.json())
            .then(d => {
              if (d.erro) return;
              const comp = [
                d.logradouro || '',
                d.bairro || '',
                (d.localidade && d.uf) ? `${d.localidade} - ${d.uf}` : ''
              ].filter(Boolean).join(', ');
              if (comp && !enderecoInput.value) enderecoInput.value = comp;
            })
            .catch(() => {});
        });
      }

      // Autocomplete Escola de Origem
      const escolasBase = [
        'E.E. Tancredo de Almeida Neves',
        'E.E. Professora Maria da Conceição',
        'E.E. Coronel Fabriciano',
        'E.E. Antônio Silva',
        'Colégio Estadual Modelo',
        'Instituto Federal MG - Campus Local'
      ];
      const escolaInput = document.getElementById('escola_origem');
      const datalist = document.getElementById('lista-escolas');
      const status = document.getElementById('escolaStatus');

      function renderEscolas(filtro = '') {
        datalist.innerHTML = '';
        escolasBase
          .filter(e => e.toLowerCase().includes(filtro.toLowerCase()))
          .slice(0, 10)
          .forEach(nome => {
            const opt = document.createElement('option');
            opt.value = nome;
            datalist.appendChild(opt);
          });
        if (status) {
          status.style.display = filtro ? 'block' : 'none';
          status.textContent = datalist.children.length ?
            'Sugestões encontradas.' :
            'Nenhuma sugestão.';
        }
      }
      if (escolaInput) {
        escolaInput.addEventListener('input', () => renderEscolas(escolaInput.value.trim()));
        renderEscolas('');
      }

      // Máscaras simples (CPF / Contato)
      function maskCPF(v) {
        return v.replace(/\D/g, '')
          .replace(/(\d{3})(\d)/, '$1.$2')
          .replace(/(\d{3})(\d)/, '$1.$2')
          .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      }

      function maskPhone(v) {
        return v.replace(/\D/g, '')
          .replace(/^(\d{2})(\d)/, '($1) $2')
          .replace(/(\d{5})(\d)/, '$1-$2')
          .replace(/(-\d{4})\d+$/, '$1');
      }
      document.getElementById('cpf')?.addEventListener('input', e => {
        e.target.value = maskCPF(e.target.value);
      });
      document.getElementById('contato')?.addEventListener('input', e => {
        e.target.value = maskPhone(e.target.value);
      });
    })();
  </script>
</body>

</html>