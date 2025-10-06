<?php
require_once __DIR__ . '/controller/auth.php'; // corrigido (antes: ../controller/auth.php)
requireLogin();
require_once __DIR__ . '/db/connection.php';
$pdo = $conn;

// Process search and order inputs
$search = $_GET['search'] ?? '';
$orderBy = $_GET['order_by'] ?? 'id';
$orderDir = $_GET['order_dir'] ?? 'ASC';

$allowedColumns = ['id', 'nome', 'data_nascimento', 'sexo', 'email', 'contato', 'endereco', 'responsavel', 'cpf', 'rg', 'escola_origem', 'ano', 'turno', 'curso', 'necessidades', 'doc_paths', 'autorizacao_img', 'dt_cadastro'];
$orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'id';
$orderDir = strtoupper($orderDir) === 'DESC' ? 'DESC' : 'ASC';

$stmt = $pdo->prepare("SELECT * FROM matricula WHERE CONCAT_WS(' ', id, nome, data_nascimento, sexo, email, contato, endereco, responsavel, cpf, rg, escola_origem, ano, turno, curso, necessidades, doc_paths, autorizacao_img, dt_cadastro) LIKE :search ORDER BY $orderBy $orderDir");
$stmt->execute(['search' => "%$search%"]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['delete_id'])) {
    // Excluir matrícula
    $deleteId = (int)$_POST['delete_id'];
    $stmtDelete = $pdo->prepare("DELETE FROM matricula WHERE id = :id");
    $stmtDelete->execute([':id' => $deleteId]);
    header("Location: lista_matriculas.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Matrículas ‑ EETAN</title>
  <style>
    :root {
      --background: #f5f7fb;
      --surface: #ffffff;
      --surface-alt: #f0f4fa;
      --primary: #1f4d86;
      --primary-accent: #2f6fc2;
      --primary-soft: #e0ecfa;
      --danger: #d63f42;
      --danger-accent: #ff5d60;
      --warning: #f2b63d;
      --success: #2f9d62;
      --text: #2c3e50;
      --text-soft: #627693;
      --border: #d7e1ec;
      --radius-xs: 4px;
      --radius: 10px;
      --radius-lg: 18px;
      --shadow-sm: 0 2px 6px -2px rgba(25, 44, 74, .15);
      --shadow: 0 8px 26px -8px rgba(20, 40, 70, .18);
      --transition: .28s cubic-bezier(.4, 0, .2, 1);
      font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background: linear-gradient(145deg, #f3f7fc 0%, #e7eef7 100%);
      color: var(--text);
      font-size: 14px;
      -webkit-font-smoothing: antialiased;
    }

    h1 {
      font-size: clamp(1.6rem, 1.3rem + 1vw, 2.2rem);
      font-weight: 700;
      letter-spacing: .5px;
      margin: 0 0 1.8rem;
      background: linear-gradient(90deg, var(--primary), var(--primary-accent));

      color: transparent;
      text-align: center;
    }

    .page-shell {
      max-width: 1400px;
      margin: 32px auto 56px;
      padding: 0 2rem;
    }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow);
      padding: 2.2rem 2rem 2.6rem;
      position: relative;
      overflow: hidden;
    }

    .card:before,
    .card:after {
      content: "";
      position: absolute;
      width: 340px;
      height: 340px;
      background: radial-gradient(circle at center, var(--primary-soft), transparent 70%);
      filter: blur(6px);
      opacity: .55;
      pointer-events: none;
      transition: var(--transition);
    }

    .card:before {
      top: -160px;
      right: -140px;
    }

    .card:after {
      bottom: -180px;
      left: -160px;
      opacity: .35;
    }

    /* FORM */
    .filter-form {
      display: grid;
      gap: 1rem 1.4rem;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      align-items: end;
      margin-bottom: 1.4rem;
    }

    .field {
      display: flex;
      flex-direction: column;
      gap: .45rem;
    }

    .field label {
      font-size: .7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .08rem;
      color: var(--text-soft);
    }

    .field input,
    .field select {
      appearance: none;
      background: var(--surface-alt);
      border: 1.5px solid var(--border);
      padding: .65rem .85rem;
      border-radius: var(--radius);
      font: inherit;
      font-weight: 500;
      color: var(--text);
      outline: none;
      line-height: 1.2;
      transition: var(--transition);
      box-shadow: 0 1px 0 rgba(255, 255, 255, .65);
    }

    .field input:focus,
    .field select:focus {
      border-color: var(--primary-accent);
      background: #fff;
      box-shadow: 0 0 0 4px rgba(47, 111, 194, .15);
    }

    .actions-inline {
      display: flex;
      gap: .75rem;
      flex-wrap: wrap;
      margin-top: .3rem;
    }

    .btn {
      --btn-bg: var(--primary);
      --btn-bg-hover: var(--primary-accent);
      --btn-color: #fff;
      border: none;
      padding: .75rem 1.25rem;
      font: inherit;
      font-size: .85rem;
      letter-spacing: .1rem;
      font-weight: 700;
      text-transform: uppercase;
      background: var(--btn-bg);
      color: var(--btn-color);
      border-radius: 1000px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      gap: .5rem;
      box-shadow: 0 4px 14px -4px rgba(31, 77, 134, .5);
      transition: var(--transition);
    }

    .btn:before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(120deg, rgba(255, 255, 255, .35), transparent 60%);
      transform: translateX(-60%);
      transition: var(--transition);
      mix-blend-mode: overlay;
    }

    .btn:hover {
      background: var(--btn-bg-hover);
      transform: translateY(-2px);
      box-shadow: 0 8px 22px -8px rgba(31, 77, 134, .6);
    }

    .btn:hover:before {
      transform: translateX(0);
    }

    .btn:active {
      transform: translateY(0);
      box-shadow: 0 3px 10px -2px rgba(31, 77, 134, .55);
    }

    .btn-danger {
      --btn-bg: var(--danger);
      --btn-bg-hover: var(--danger-accent);
      box-shadow: 0 4px 14px -4px rgba(214, 63, 66, .55);
    }

    .btn-secondary {
      --btn-bg: var(--surface-alt);
      --btn-bg-hover: #e3eaf3;
      --btn-color: var(--primary);
      border: 1.5px solid var(--border);
      box-shadow: none;
    }

    /* RESPONSIVE TABLE WRAPPER */
    .table-wrapper {
      position: relative;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow: hidden;
      background: var(--surface-alt);
      box-shadow: var(--shadow-sm);
    }

    .table-scroll {
      overflow-x: auto;
      scrollbar-width: thin;
      scrollbar-color: var(--primary-accent) var(--surface-alt);
    }

    .table-scroll::-webkit-scrollbar {
      height: 10px;
    }

    .table-scroll::-webkit-scrollbar-track {
      background: var(--surface-alt);
    }

    .table-scroll::-webkit-scrollbar-thumb {
      background: linear-gradient(var(--primary), var(--primary-accent));
      border-radius: 10px;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      min-width: 1200px;
      font-size: .8rem;
    }

    thead th {
      position: sticky;
      top: 0;
      background: linear-gradient(90deg, var(--primary), var(--primary-accent));
      color: #fff;
      padding: .95rem .9rem;
      text-align: left;
      font-weight: 600;
      letter-spacing: .08rem;
      text-transform: uppercase;
      font-size: .68rem;
      white-space: nowrap;
    }

    tbody td {
      background: #fff;
      border-bottom: 1px solid var(--border);
      padding: .75rem .85rem;
      vertical-align: top;
      font-weight: 500;
      color: var(--text);
    }

    tbody tr {
      transition: background .18s ease;
    }

    tbody tr:hover td {
      background: #f8fbff;
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    .docs a {
      display: inline-flex;
      align-items: center;
      gap: .35rem;
      background: var(--primary-soft);
      color: var(--primary);
      text-decoration: none;
      padding: .35rem .65rem;
      margin: 0 0 .4rem 0;
      font-size: .65rem;
      font-weight: 600;
      letter-spacing: .05rem;
      border-radius: 6px;
      transition: var(--transition);
      border: 1px solid transparent;
    }

    .docs a:hover {
      background: #fff;
      border-color: var(--primary-accent);
      color: var(--primary-accent);
      transform: translateY(-2px);
    }

    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: .5rem;
      min-width: 110px;
    }

    .action-buttons form {
      margin: 0;
    }

    .btn-sm {
      padding: .55rem .85rem;
      font-size: .6rem;
      letter-spacing: .12rem;
      font-weight: 700;
    }

    .chip {
      display: inline-flex;
      align-items: center;
      background: var(--primary-soft);
      color: var(--primary);
      font-size: .6rem;
      font-weight: 600;
      letter-spacing: .06rem;
      padding: .35rem .65rem;
      border-radius: 100px;
      text-transform: uppercase;
    }

    .chip.alt {
      background: #ffe8e8;
      color: var(--danger);
    }

    .top-toolbar {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
      margin-bottom: 1.4rem;
      align-items: center;
    }

    .back-btn {
      margin-top: 2rem;
    }

    button:focus-visible,
    .btn:focus-visible,
    a:focus-visible {
      outline: 3px solid var(--primary-accent);
      outline-offset: 2px;
    }

    @media (max-width: 920px) {
      .action-buttons {
        flex-direction: row;
        flex-wrap: wrap;
      }

      .card {
        padding: 1.8rem 1.3rem 2.3rem;
      }
    }

    @media (max-width: 640px) {
      .filter-form {
        grid-template-columns: 1fr 1fr;
      }

      .page-shell {
        padding: 0 1.25rem;
      }

      h1 {
        margin-bottom: 1.2rem;
      }

      table {
        font-size: .75rem;
      }
    }
  </style>
</head>

<body>
  <div class="page-shell">
    <div class="card">
      <h1>Lista de Matrículas</h1>

      <form method="get" class="filter-form" novalidate>
        <div class="field">
          <label for="search">Pesquisar</label>
          <input type="text" id="search" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Nome, CPF, curso..." />
        </div>
        <div class="field">
          <label for="order_by">Ordenar por</label>
          <select id="order_by" name="order_by">
            <?php foreach ($allowedColumns as $column): ?>
              <option value="<?= $column ?>" <?= $column === $orderBy ? 'selected' : '' ?>>
                <?= ucfirst(str_replace('_', ' ', $column)) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label for="order_dir">Ordem</label>
          <select id="order_dir" name="order_dir">
            <option value="ASC" <?= $orderDir === 'ASC'  ? 'selected' : '' ?>>Crescente</option>
            <option value="DESC" <?= $orderDir === 'DESC' ? 'selected' : '' ?>>Decrescente</option>
          </select>
        </div>
        <div class="field" style="align-self:flex-end;">
          <button type="submit" class="btn btn-secondary" style="width:100%;"><span>Aplicar</span></button>
        </div>
      </form>

      <div class="table-wrapper">
        <div class="table-scroll">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data Nasc.</th>
                <th>Sexo</th>
                <th>Email</th>
                <th>Contato</th>
                <th>Endereço</th>
                <th>Responsável</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Escola Origem</th>
                <th>Ano</th>
                <th>Turno</th>
                <th>Curso</th>
                <th>Necessidades</th>
                <th>Docs</th>
                <th>Aut. Imagem</th>
                <th>Cadastrado em</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $r): ?>
                <tr>
                  <td><?= $r['id'] ?></td>
                  <td><?= htmlspecialchars($r['nome']) ?></td>
                  <td><?= $r['data_nascimento'] ?></td>
                  <td><?= $r['sexo'] ?></td>
                  <td><?= htmlspecialchars($r['email']) ?></td>
                  <td><?= htmlspecialchars($r['contato']) ?></td>
                  <td><?= htmlspecialchars($r['endereco']) ?></td>
                  <td><?= htmlspecialchars($r['responsavel']) ?></td>
                  <td><?= $r['cpf'] ?></td>
                  <td><?= htmlspecialchars($r['rg']) ?></td>
                  <td><?= htmlspecialchars($r['escola_origem']) ?></td>
                  <td><span class="chip"><?= $r['ano'] ?></span></td>
                  <td><span class="chip"><?= $r['turno'] ?></span></td>
                  <td><span class="chip"><?= $r['curso'] ?></span></td>
                  <td><?= htmlspecialchars($r['necessidades']) ?></td>
                  <td class="docs">
                    <?php
                    $docs = array_filter(explode(';', $r['doc_paths']));
                    foreach ($docs as $d) {
                      $label = 'Arquivo';
                      echo "<a href=\"" . htmlspecialchars($d) . "\" target=\"_blank\" rel=\"noopener\" title=\"Abrir documento\"><svg width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10z'/><polyline points='14 2 14 10 20 10'/></svg>$label</a>";
                    }
                    ?>
                  </td>
                  <td><?= $r['autorizacao_img'] ? '<span class="chip">Sim</span>' : '<span class="chip alt">Não</span>' ?></td>
                  <td><?= $r['dt_cadastro'] ?></td>
                  <td>
                    <div class="action-buttons">
                      <form action="editar_matricula.php" method="get">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                        <button type="submit" class="btn btn-sm" aria-label="Editar matrícula <?= $r['id'] ?>">Editar</button>
                      </form>
                      <form method="post" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                        <input type="hidden" name="delete_id" value="<?= $r['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm" aria-label="Excluir matrícula <?= $r['id'] ?>">Excluir</button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="back-btn">
        <button class="btn" onclick="window.location.href='/scholl-trab-main/sim/html/index.php'">
          <span>Voltar</span>
        </button>
      </div>
    </div>
  </div>
</body>

</html>