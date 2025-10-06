<?php
/* ------------------------------------------------------------------
 Instruções para exibir o menu (inclui link Boletim após login):

 Se o arquivo estiver em /sim/html/ (ex: /sim/html/index.php):
     require_once __DIR__ . '/../../includes/header.php';

 Se o arquivo estiver na raiz do projeto:
     require_once __DIR__ . '/includes/header.php';

 Garanta que este require venha antes de qualquer HTML.

 ------------------------------------------------------------------ */

if (session_status() === PHP_SESSION_NONE) session_start();

$tipo_nav = strtolower(trim($_SESSION['tipo_usuario'] ?? ''));

// Inferência caso não definido
if ($tipo_nav === '' && !empty($_SESSION['usuario_id'])) {
    try {
        if (!isset($conn)) {
            require_once __DIR__ . '/../php/db/connection.php';
        }
        $uid = (int)$_SESSION['usuario_id'];
        $stA = $conn->prepare("SELECT 1 FROM alunos WHERE usuario_id = ? LIMIT 1");
        $stA->execute([$uid]);
        if ($stA->fetchColumn()) {
            $tipo_nav = 'aluno';
            $_SESSION['tipo_usuario'] = 'aluno';
        } else {
            $stP = $conn->prepare("SELECT 1 FROM professores WHERE usuario_id = ? LIMIT 1");
            $stP->execute([$uid]);
            if ($stP->fetchColumn()) {
                $tipo_nav = 'professor';
                $_SESSION['tipo_usuario'] = 'professor';
            }
        }
    } catch (Throwable $e) { /* silencioso */
    }
}

function navActive($file)
{
    return basename($_SERVER['PHP_SELF']) === $file ? 'style="font-weight:700; color:#2f65b8;"' : '';
}

/* Detecta base do projeto dinamicamente */
$docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));
$projRoot = str_replace('\\', '/', realpath(dirname(__DIR__)));
$rel = trim(str_replace($docRoot, '', $projRoot), '/');
$BASE = $rel ? '/' . $rel : '';
$PAGES = $BASE . '/sim/html';

/* Fallback se caminho calculado não localizar boletim.php */
if (!is_file($_SERVER['DOCUMENT_ROOT'] . $PAGES . '/boletim.php')) {
    $PAGES = '/sim/html';
}

/* Lógica unificada para exibir link Boletim em TODAS as páginas após login */
$exibeBoletim = in_array($tipo_nav, ['aluno', 'professor'], true);
if (!$exibeBoletim && !empty($_SESSION['usuario_id'])) {
    try {
        if (!isset($conn)) require_once __DIR__ . '/../php/db/connection.php';
        $uid = (int)$_SESSION['usuario_id'];
        if (!$tipo_nav) {
            $qA = $conn->prepare("SELECT 1 FROM alunos WHERE usuario_id = ? LIMIT 1");
            $qA->execute([$uid]);
            if ($qA->fetchColumn()) {
                $tipo_nav = 'aluno';
                $_SESSION['tipo_usuario'] = 'aluno';
                $exibeBoletim = true;
            } else {
                $qP = $conn->prepare("SELECT 1 FROM professores WHERE usuario_id = ? LIMIT 1");
                $qP->execute([$uid]);
                if ($qP->fetchColumn()) {
                    $tipo_nav = 'professor';
                    $_SESSION['tipo_usuario'] = 'professor';
                    $exibeBoletim = true;
                }
            }
        } else {
            // tipo já conhecido, garante flag
            $exibeBoletim = in_array($tipo_nav, ['aluno', 'professor'], true);
        }
    } catch (Throwable $e) { /* silencioso */
    }
}

// Ajuste do caminho do logo
$logoPath = $BASE . '/sim/fts/Logo_EETAN.png';
?>
<header class="content">
    <div class="logo">
        <a href="<?= $PAGES ?>/index.php">
            <img src="<?= htmlspecialchars($logoPath) ?>" alt="Logo EETAN" />
            <h3>EETAN</h3>
        </a>
    </div>
    <nav>
        <ul class="list-menu">
            <li><a <?= navActive('sobre.php') ?> href="<?= $PAGES ?>/sobre.php">Sobre</a></li>
            <li><a <?= navActive('cursos.php') ?> href="<?= $PAGES ?>/cursos.php">Cursos</a></li>
            <li><a <?= navActive('direcao.php') ?> href="<?= $PAGES ?>/direcao.php">Direção</a></li>
            <li><a <?= navActive('CorpoDocente.php') ?> href="<?= $PAGES ?>/CorpoDocente.php">Professores</a></li>
            <?php if ($tipo_nav !== 'aluno'): ?>
                <li><a <?= navActive('matricula.php') ?> href="<?= $PAGES ?>/matricula.php">Matricula</a></li>
            <?php endif; ?>
            <?php if ($exibeBoletim): ?>
                <li><a <?= navActive('boletim.php') ?> href="<?= $PAGES ?>/boletim.php">Boletim</a></li>
            <?php endif; ?>
            <li><a <?= navActive('cadastro.php') ?> href="<?= $PAGES ?>/cadastro.php"><i class="bi bi-person-circle"></i></a></li>
            <?php if ($tipo_nav): ?>
                <li>
                    <a href="<?= $BASE ?>/sim/php/controller/logout.php" style="color:#e74c3c;">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php if (!empty($exibeBoletim)): ?>
        <!-- Fallback JS: garante o link Boletim caso o HTML original não o tenha -->
        <script>
            (function() {
                try {
                    const label = 'Boletim';
                    const href = '<?= esc($PAGES) ?>/boletim.php';
                    // procura um UL do menu
                    const ul = document.querySelector('header.content nav ul.list-menu') ||
                        document.querySelector('header.content nav ul') ||
                        document.querySelector('nav ul');
                    if (!ul) return;
                    const exists = Array.from(ul.querySelectorAll('a')).some(a => a.textContent.trim().toLowerCase() === label.toLowerCase());
                    if (exists) return;
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.href = href;
                    a.textContent = label;
                    li.appendChild(a);
                    // tenta inserir depois do primeiro item (opcional), senão adiciona ao fim
                    if (ul.children.length > 0) {
                        ul.insertBefore(li, ul.children[1] || null);
                    } else {
                        ul.appendChild(li);
                    }
                } catch (e) {
                    /* silencioso */
                }
            })();
        </script>
    <?php endif; ?>
</header>