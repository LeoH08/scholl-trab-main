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

// credenciais criadas no fluxo de matrícula
$credenciais = $_SESSION['credenciais_aluno'] ?? null;
// opcional: após ler, você pode limpar para não reaparecer
unset($_SESSION['credenciais_aluno']);
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
    <title>Credenciais de Acesso - EETAN</title>
    <style>
        /* estilos mínimos só para destacar o cartão de credenciais */
        .credenciais-wrapper {
            min-height: calc(100vh - 160px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 16px 40px;
            background: radial-gradient(circle at top, #e4edf9 0, #f5f7fb 40%, #eef2f7 100%);
        }

        .credenciais-card {
            max-width: 480px;
            width: 100%;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 34, 70, .18);
            padding: 28px 24px 24px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .credenciais-card h1 {
            margin: 0 0 12px;
            font-size: 1.5rem;
            color: #12284a;
        }

        .credenciais-card p {
            margin: 0 0 12px;
            color: #4b5563;
            font-size: .95rem;
        }

        .credenciais-box {
            margin: 16px 0;
            padding: 14px 16px;
            border-radius: 12px;
            background: #f3f4ff;
            border: 1px solid #c7d2fe;
            font-family: "Roboto", system-ui, sans-serif;
            font-size: .95rem;
        }

        .credenciais-box strong {
            display: inline-block;
            width: 90px;
            color: #111827;
        }

        .credenciais-actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .credenciais-actions a {
            flex: 1;
            min-width: 140px;
            text-align: center;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 600;
            font-size: .9rem;
            letter-spacing: .04rem;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            box-shadow: 0 10px 20px rgba(37, 99, 235, .35);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
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

    <main class="credenciais-wrapper">
        <section class="credenciais-card">
            <?php if ($credenciais && !empty($credenciais['usuario'])): ?>
                <h1>Credenciais criadas com sucesso</h1>
                <p>Guarde com segurança os dados abaixo. Você usará estas credenciais para acessar o sistema da escola.</p>

                <div class="credenciais-box">
                    <p><strong>Usuário:</strong> <?php echo htmlspecialchars($credenciais['usuario'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php if (!empty($credenciais['senha'])): ?>
                        <p><strong>Senha:</strong> <?php echo htmlspecialchars($credenciais['senha'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php else: ?>
                        <p><em>A senha foi definida por você durante o cadastro ou enviada ao seu e-mail/WhatsApp.</em></p>
                    <?php endif; ?>
                </div>

                <p>Recomenda-se alterar a senha no primeiro acesso, caso seja uma senha provisória.</p>

                <div class="credenciais-actions">
                    <a href="../html/cadastro.php" class="btn-primary">Ir para tela de login</a>
                    <a href="../html/index.php" class="btn-secondary">Voltar para o início</a>
                </div>
            <?php else: ?>
                <h1>Nenhuma credencial disponível</h1>
                <p>Não encontramos credenciais geradas para esta sessão. É possível que a matrícula não tenha sido concluída corretamente.</p>
                <div class="credenciais-actions">
                    <a href="../html/matricula.php" class="btn-primary">Refazer matrícula</a>
                    <a href="../html/index.php" class="btn-secondary">Voltar para o início</a>
                </div>
            <?php endif; ?>
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
</body>

</html>