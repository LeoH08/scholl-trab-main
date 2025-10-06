<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
    rel="stylesheet" />
  <!-- <link rel="stylesheet" href="../css/cabeçalhoerodape.css" /> -->
  <link rel="stylesheet" href="../css/stylelayout.css" />
  <link rel="stylesheet" href="../css/stylepoli.css" />
  <title>Document</title>
  <style>
    main {
      margin-top: 100px;
      /* Ajuste para evitar sobreposição do conteúdo pelo cabeçalho */
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

  <main id="politica-privacidade">
    <h1>Política de Privacidade</h1>
    <p>
      <strong>Escola Estadual Técnica Tancredo de Almeida Neves</strong><br />
      Rua Magnólia, Bairro São Domingos – Coronel Fabriciano – MG – Brasil
    </p>

    <h2>1. Compromisso com a privacidade</h2>
    <p>
      A Escola Estadual Técnica Tancredo de Almeida Neves se compromete a
      proteger a privacidade e os dados pessoais de seus alunos, responsáveis,
      funcionários e visitantes do nosso site. Esta Política de Privacidade
      explica como coletamos, usamos, armazenamos e protegemos as informações
      fornecidas por você durante a navegação.
    </p>

    <h2>2. Coleta de informações</h2>
    <p>
      Nosso site pode coletar informações pessoais em formulários de contato,
      inscrições em eventos escolares ou outras interações voluntárias, tais
      como:
    </p>
    <ul>
      <li>Nome completo;</li>
      <li>E-mail;</li>
      <li>Telefone;</li>
      <li>Nome do aluno e série/curso;</li>
      <li>Mensagens enviadas via formulário.</li>
    </ul>

    <h2>3. Uso das informações</h2>
    <p>As informações coletadas são utilizadas exclusivamente para:</p>
    <ul>
      <li>Entrar em contato com alunos e responsáveis;</li>
      <li>Enviar comunicados escolares e informações relevantes;</li>
      <li>Processar inscrições em eventos, cursos ou atividades;</li>
      <li>Melhorar a comunicação com a comunidade escolar;</li>
      <li>Atender obrigações legais e administrativas.</li>
    </ul>

    <h2>4. Compartilhamento de dados</h2>
    <p>
      Não compartilhamos seus dados pessoais com terceiros, exceto quando:
    </p>
    <ul>
      <li>Houver obrigação legal;</li>
      <li>
        For necessário para fins educacionais ou administrativos, respeitando
        a Lei Geral de Proteção de Dados (LGPD – Lei nº 13.709/2018).
      </li>
    </ul>

    <h2>5. Armazenamento e segurança</h2>
    <p>
      As informações são armazenadas em sistemas seguros, com medidas de
      proteção contra acesso não autorizado, perda, alteração ou divulgação
      indevida.
    </p>

    <h2>6. Uso de cookies</h2>
    <p>
      Nosso site pode utilizar cookies para melhorar sua experiência de
      navegação. O usuário pode configurar seu navegador para recusar cookies,
      mas isso pode afetar algumas funcionalidades.
    </p>

    <h2>7. Direitos do titular dos dados</h2>
    <p>Você tem o direito de:</p>
    <ul>
      <li>Acessar, corrigir ou excluir seus dados pessoais;</li>
      <li>Revogar o consentimento para uso de dados, quando aplicável;</li>
      <li>Solicitar informações sobre o tratamento de seus dados.</li>
    </ul>
    <p>
      Para exercer esses direitos, entre em contato conosco pelo canal oficial
      da escola.
    </p>

    <h2>8. Alterações na política</h2>
    <p>
      Esta Política de Privacidade pode ser atualizada periodicamente. A
      versão mais recente estará sempre disponível em nosso site. Recomendamos
      que você revise regularmente.
    </p>

    <h2>9. Contato</h2>
    <p>
      Para dúvidas, sugestões ou solicitações relacionadas à privacidade de
      dados, entre em contato com a escola:
    </p>
    <ul>
      <li>
        📍 Endereço: Rua Magnólia, Bairro São Domingos, Coronel Fabriciano –
        MG, Brasil
      </li>
      <li>📧 E-mail institucional: [inserir e-mail oficial da escola]</li>
      <li>📞 Telefone: [inserir número de telefone da escola]</li>
    </ul>

    <p>
      Esta política está em conformidade com a Lei Geral de Proteção de Dados
      Pessoais (LGPD) e reflete nosso compromisso com a ética, a transparência
      e o respeito à comunidade escolar.
    </p>
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
</body>

</html>