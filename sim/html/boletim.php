<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php require_once '../php/controller/auth.php';
requireLogin(); ?>
<?php require_once '../php/db/connection.php'; ?>
<?php
// === PRE-PROCESSAMENTO (antes de qualquer HTML) ===
function esc($str)
{
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$tipo_usuario = $_SESSION['tipo_usuario'] ?? null;

/**
 * Redireciona de forma segura mesmo se headers já tiverem sido enviados.
 */
function safe_redirect($url)
{
	if (!headers_sent()) {
		header("Location: $url");
		exit;
	}
	echo '<script>window.location.href=' . json_encode($url) . ';</script>';
	echo '<noscript><meta http-equiv="refresh" content="0;url=' . esc($url) . '"></noscript>';
	exit;
}

$aluno_id = null;
$boletins = [];
$alunos = [];
if ($tipo_usuario === 'professor') {
	$alunos_raw = $conn->query("
		SELECT a.id,
		       a.nome,
		       a.ano,
		       a.turma_id,
		       a.turma,
		       COALESCE(t.nome,'Sem Turma') AS turma_nome
		FROM alunos a
		LEFT JOIN turmas t ON t.id = a.turma_id
		ORDER BY a.ano, turma_nome, a.nome
	")->fetchAll();
	$alunos = $alunos_raw;

	$aluno_id = isset($_GET['aluno_id']) ? (int)$_GET['aluno_id'] : null;

	// Se envio de formulário ocorreu, tratar ANTES de gerar HTML
	if (
		$_SERVER['REQUEST_METHOD'] === 'POST'
		&& isset($_POST['boletins'])
		&& is_array($_POST['boletins'])
		&& $aluno_id
	) {
		foreach ($_POST['boletins'] as $boletim) {
			$boletim_id    = $boletim['boletim_id'] ?: null;
			$disciplina_id = (int)$boletim['disciplina_id'];
			$nota          = $boletim['nota'] === '' ? null : (float)$boletim['nota'];
			$frequencia    = $boletim['frequencia'] === '' ? null : (int)$boletim['frequencia'];
			$status        = $boletim['status'] ?? null;
			if ($nota !== null && $nota > 25) $nota = 25;

			if ($boletim_id) {
				$upd = $conn->prepare("UPDATE boletins SET nota = ?, frequencia = ?, status = ? WHERE id = ?");
				$upd->execute([$nota, $frequencia, $status, $boletim_id]);
			} else {
				$ins = $conn->prepare("INSERT INTO boletins (aluno_id, disciplina_id, nota, frequencia, status) VALUES (?, ?, ?, ?, ?)");
				$ins->execute([$aluno_id, $disciplina_id, $nota, $frequencia, $status]);
			}
		}
		// Redireciona para evitar reenvio do POST
		safe_redirect('boletim.php?aluno_id=' . $aluno_id);
	}

	// Após possível atualização, carrega boletins (se aluno selecionado)
	if ($aluno_id) {
		$stmt = $conn->prepare("
			SELECT d.id AS disciplina_id,
			       d.nome AS disciplina,
			       b.id AS boletim_id,
			       b.nota,
			       b.frequencia,
			       b.status
			FROM disciplinas d
			LEFT JOIN boletins b
			      ON d.id = b.disciplina_id
			     AND b.aluno_id = ?
			JOIN alunos a ON a.id = ?
			WHERE d.curso_id = a.curso_id
			  AND (d.ano = a.ano OR d.ano IS NULL)
			ORDER BY d.nome
		");
		$stmt->execute([$aluno_id, $aluno_id]);
		$boletins = $stmt->fetchAll();
	}

	// Listas para selects
	$anos_distinct = [];
	$turmas_distinct = [];
	foreach ($alunos as $r) {
		if (!empty($r['ano'])) $anos_distinct[$r['ano']] = true;
		$turmas_distinct[$r['turma_nome'] ?: 'Sem Turma'] = true;
	}
	$anos_distinct = array_keys($anos_distinct);
	sort($anos_distinct);
	$turmas_distinct = array_keys($turmas_distinct);
	sort($turmas_distinct);
} elseif ($tipo_usuario === 'aluno') {
	$usuario_id = $_SESSION['usuario_id'] ?? null;
	if ($usuario_id) {
		$stmt = $conn->prepare("
			SELECT a.id, a.nome, a.curso_id, a.ano
			FROM alunos a
			WHERE a.usuario_id = ?
		");
		$stmt->execute([$usuario_id]);
		$aluno = $stmt->fetch();

		if ($aluno) {
			$aluno_id = $aluno['id'];
			$curso_id = $aluno['curso_id'];
			$ano = $aluno['ano'];

			$stmtB = $conn->prepare("
				SELECT d.nome AS disciplina, b.nota, b.frequencia, b.status
				FROM disciplinas d
				LEFT JOIN boletins b ON d.id = b.disciplina_id AND b.aluno_id = ?
				WHERE d.curso_id = ? AND (d.ano = ? OR d.ano IS NULL)
				ORDER BY d.nome
			");
			$stmtB->execute([$aluno_id, $curso_id, $ano]);
			$boletinsAluno = $stmtB->fetchAll();
		}
	}
}
// FIM PRE-PROCESSAMENTO
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../css/stylelayout.css" />
	<link rel="shortcut icon" href="../fts/Logo_EETAN.png" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
	<title>EETAN | Boletim</title>
	<style>
		/* ======= NOVO ESTILO GLOBAL / THEME ======= */
		:root {
			--bg: #eef4fb;
			--panel: #ffffff;
			--panel-alt: #f7faff;
			--primary: #264d86;
			--primary-alt: #2f65b8;
			--gradient: linear-gradient(135deg, #2f65b8, #1e3f68);
			--accent: #ffb347;
			--success: #1fa870;
			--warn: #ff9800;
			--danger: #e74c3c;
			--muted: #6c7c92;
			--border: #d7e2f1;
			--radius: 14px;
			--shadow: 0 6px 20px -6px rgba(28, 54, 83, .18);
			--shadow-soft: 0 2px 10px -2px rgba(28, 54, 83, .12);
			--font: 'Roboto', Arial, Helvetica, sans-serif;
		}

		body.boletim-page {
			font-size: 1.35rem;
			background: radial-gradient(circle at 25% 20%, #f2f7fd, #dae4f1);
			font-family: var(--font);
			min-height: 100vh;
			-webkit-font-smoothing: antialiased;
		}

		main {
			background: transparent !important;
			box-shadow: none !important;
			padding: 20px 10px !important;
			max-width: 1220px !important;
			margin: 0 auto;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.boletim-shell {
			display: flex;
			gap: 28px;
			align-items: flex-start;
			flex-wrap: wrap;
			justify-content: center;
		}

		@media (max-width:980px) {
			.boletim-shell {
				flex-direction: column;
			}
		}

		/* Painel lateral (professor) */
		.alunos-panel {
			flex: 0 0 320px;
			max-width: 340px;
			background: var(--panel);
			border: 1px solid var(--border);
			border-radius: var(--radius);
			padding: 20px 20px 18px;
			box-shadow: var(--shadow-soft);
			position: sticky;
			top: 90px;
			align-self: flex-start;
			max-height: calc(100vh - 120px);
			/* garante visível com header */
			display: flex;
			flex-direction: column;
		}

		@media (max-width:980px) {
			.alunos-panel {
				position: relative;
				top: 0;
				width: 100%;
				max-width: 100%;
				max-height: none;
			}
		}

		.alunos-panel h3 {
			margin: 0 0 14px;
			font-size: 1.05rem;
			letter-spacing: .5px;
			font-weight: 700;
			color: var(--primary);
			display: flex;
			gap: 8px;
			align-items: center;
		}

		.alunos-panel .filtro-aluno-input {
			background: #fff;
			border: 2px solid var(--border);
			transition: .25s;
			font-size: .95rem;
			border-radius: 10px;
		}

		.alunos-panel .filtro-aluno-input:focus {
			border-color: var(--primary-alt);
			box-shadow: 0 0 0 3px #2f65b81f;
		}

		#lista-alunos {
			margin-top: 12px;
			border: 1px solid var(--border);
			border-radius: 12px;
			background: var(--panel-alt);
			padding: 6px 4px;
			box-shadow: var(--shadow-soft);
			max-height: 430px;
			overflow-y: auto;
			overflow-x: hidden;
			flex: 1;
			scrollbar-width: thin;
			scrollbar-color: var(--primary-alt) #eef3f9;
		}

		#lista-alunos::-webkit-scrollbar {
			width: 10px;
		}

		#lista-alunos::-webkit-scrollbar-track {
			background: #eef3f9;
			border-radius: 10px;
		}

		#lista-alunos::-webkit-scrollbar-thumb {
			background: linear-gradient(var(--primary-alt), var(--primary));
			border-radius: 10px;
			border: 2px solid #eef3f9;
		}

		.aluno-item {
			background: #fff;
			margin: 4px 6px;
			border: 1px solid #eef3f9;
			border-radius: 10px;
			padding: 8px 12px;
			transition: .22s;
			font-size: .92rem;
			box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
			position: relative;
			overflow: hidden;
		}

		.aluno-item:hover {
			transform: translateY(-2px);
			border-color: var(--primary-alt);
			box-shadow: 0 4px 12px -4px rgba(0, 0, 0, .15);
			background: linear-gradient(135deg, #ffffff, #f2f7ff);
		}

		.aluno-item i {
			background: var(--primary-alt);
			color: #fff !important;
			width: 30px;
			height: 30px;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1rem !important;
			box-shadow: 0 2px 6px -2px rgba(0, 0, 0, .25);
		}

		/* Conteúdo boletim */
		.boletim-conteudo {
			flex: 1;
			min-width: 520px;
			max-width: 800px;
			margin: 0 auto;
			background: var(--panel);
			border: 1px solid var(--border);
			border-radius: var(--radius);
			padding: 32px 40px 48px;
			box-shadow: var(--shadow);
			position: relative;
		}

		.boletim-conteudo:before {
			content: "";
			position: absolute;
			inset: 0;
			pointer-events: none;
			background:
				radial-gradient(circle at 90% 15%, #2f65b80d, transparent 70%),
				radial-gradient(circle at 10% 85%, #ffb34714, transparent 70%);
			border-radius: inherit;
		}

		.boletim-titulo {
			margin: 0 0 18px;
			font-size: 1.55rem;
			font-weight: 800;
			letter-spacing: .5px;
			color: var(--primary);
			display: flex;
			align-items: center;
			gap: 12px;
		}

		.boletim-titulo span.badge-aluno {
			background: var(--gradient);
			padding: 6px 16px;
			border-radius: 40px;
			color: #fff;
			font-size: .78rem;
			font-weight: 600;
			letter-spacing: .7px;
			box-shadow: 0 3px 10px -4px #2f65b8aa;
			text-transform: uppercase;
		}

		/* Tabela */
		.boletim-table {
			width: 100%;
			border-collapse: separate !important;
			border-spacing: 0;
			overflow: hidden;
			border: 1px solid var(--border);
			border-radius: 18px;
			background: var(--panel-alt);
		}

		.boletim-table thead th {
			background: var(--gradient) !important;
			color: #fff !important;
			padding: 16px 14px;
			font-size: .83rem;
			letter-spacing: .15rem;
			text-transform: uppercase;
			font-weight: 600;
			position: relative;
		}

		.boletim-table tbody tr {
			transition: .25s;
		}

		.boletim-table tbody tr:hover {
			background: #f2f7ff;
		}

		.boletim-table td {
			padding: 16px 18px;
			font-size: 2rem;
			font-weight: 600;
			color: var(--primary);
			border-bottom: 1px solid #edf2f8;
		}

		.boletim-table tbody tr:last-child td {
			border-bottom: none;
		}

		.boletim-table input[type=number],
		.boletim-table select {
			width: 100%;
			background: #fff;
			border: 1.5px solid var(--border);
			border-radius: 10px;
			padding: 10px 14px;
			font-size: 1.08rem;
			font-weight: 700;
			color: var(--primary);
			transition: .2s;
			outline: none;
		}

		.boletim-table input[type=number]:focus,
		.boletim-table select:focus {
			border-color: var(--primary-alt);
			box-shadow: 0 0 0 3px #2f65b81d;
		}

		.status-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			padding: 8px 16px;
			border-radius: 40px;
			font-size: 1rem;
			font-weight: 700;
			letter-spacing: .09rem;
			text-transform: uppercase;
			background: #ddd;
			color: #2d3b4d;
		}

		.status-aprovado {
			background: linear-gradient(135deg, #1fa870, #12824f);
			color: #fff;
		}

		.status-reprovado {
			background: linear-gradient(135deg, #e74c3c, #c0392b);
			color: #fff;
		}

		.status-cursando {
			background: linear-gradient(135deg, #2f65b8, #1e3f68);
			color: #fff;
		}

		.valor-badge {
			display: inline-block;
			min-width: 130px;
			padding: 16px 28px;
			text-align: center;
			border-radius: 10px;
			font-size: 1.25rem;
			font-weight: 700;
			letter-spacing: .05rem;
			background: #fff;
			border: 1px solid var(--border);
			box-shadow: 0 2px 4px -2px rgba(0, 0, 0, .15);
			position: relative;
		}

		.valor-badge[data-tipo=nota] {
			color: var(--primary);
		}

		.valor-badge[data-tipo=nota][data-val]::after {
			content: attr(data-val) " pts";
			font-weight: 600;
			color: var(--muted);
			display: none;
		}

		.valor-badge[data-tipo=frequencia] {
			color: #7c3;
		}

		/* Barras */
		.bar-wrap {
			position: relative;
			height: 8px;
			border-radius: 6px;
			background: #e5edf6;
			overflow: hidden;
			margin-top: 6px;
		}

		.bar-fill {
			position: absolute;
			inset: 0;
			width: 0%;
			background: linear-gradient(90deg, #2f65b8, #4fa6ff);
			transition: width .6s cubic-bezier(.65, .05, .36, 1);
		}

		.bar-fill.freq {
			background: linear-gradient(90deg, #1fa870, #7ee4b6);
		}

		/* Botões */
		.edit-btn {
			background: var(--gradient);
			border: none;
			padding: 14px 34px;
			font-size: .82rem;
			letter-spacing: .15rem;
			text-transform: uppercase;
			font-weight: 700;
			border-radius: 12px;
			color: #fff;
			cursor: pointer;
			position: relative;
			overflow: hidden;
			box-shadow: 0 6px 18px -6px #2f65b8aa;
			transition: .3s;
		}

		.edit-btn:before {
			content: "";
			position: absolute;
			inset: 0;
			background: linear-gradient(120deg, #ffffff33, #ffffff05);
			transform: translateX(-60%);
			transition: .65s;
		}

		.edit-btn:hover {
			transform: translateY(-3px);
		}

		.edit-btn:hover:before {
			transform: translateX(0);
		}

		.empty-msg {
			padding: 50px 20px;
			text-align: center;
			font-weight: 600;
			color: var(--muted);
			font-size: .9rem;
		}

		/* Student heading */
		.student-header-simple {
			background: var(--gradient);
			color: #fff;
			padding: 20px 26px;
			border-radius: 18px;
			display: flex;
			align-items: center;
			gap: 18px;
			box-shadow: 0 8px 26px -10px #1e3f6880;
			margin-bottom: 28px;
			position: relative;
			overflow: hidden;
		}

		.student-header-simple:after {
			content: "";
			position: absolute;
			width: 480px;
			height: 480px;
			background: radial-gradient(circle, #ffffff1c, #ffffff00 60%);
			top: -260px;
			right: -220px;
			transform: rotate(25deg);
			pointer-events: none;
		}

		.student-header-simple .icon {
			width: 58px;
			height: 58px;
			border-radius: 18px;
			background: #fff;
			color: var(--primary);
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.6rem;
			box-shadow: 0 6px 16px -6px rgba(0, 0, 0, .35);
		}

		/* Responsive tune */
		@media (max-width:600px) {
			.boletim-conteudo {
				padding: 22px 18px 34px;
			}

			.boletim-table thead th {
				font-size: .62rem;
				letter-spacing: .09rem;
			}

			.boletim-table td {
				padding: 10px 8px;
				font-size: .78rem;
			}

			.edit-btn {
				width: 100%;
			}

			.student-header-simple {
				flex-direction: column;
				text-align: center;
			}
		}

		@media (max-height: 680px) and (min-width: 981px) {
			.alunos-panel {
				max-height: calc(100vh - 100px);
			}
		}
	</style>
</head>

<body class="boletim-page">
	<?php require_once dirname(__DIR__, 2) . '/includes/header.php'; ?>
	<main>
		<h1>Boletim Escolar</h1>
		<?php if ($tipo_usuario === 'professor'): ?>
			<!-- Professor: painel lateral + edição de boletins -->
			<div class="boletim-shell">
				<aside class="alunos-panel">
					<h3><i class="bi bi-people-fill"></i>Alunos</h3>

					<div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:10px;">
						<div style="flex:1 1 90px; min-width:110px;">
							<label style="font-size:.65rem; font-weight:700; letter-spacing:.08rem; text-transform:uppercase; color:var(--muted);">Ano</label>
							<select id="filtro-ano-select" style="width:100%; padding:6px 8px; border:2px solid var(--border); border-radius:10px; font-size:.8rem; font-weight:600;">
								<option value="">Todos</option>
								<?php foreach ($anos_distinct as $anoOpt): ?>
									<option value="<?= esc($anoOpt) ?>"><?= esc($anoOpt) ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div style="flex:1 1 140px; min-width:140px;">
							<label style="font-size:.65rem; font-weight:700; letter-spacing:.08rem; text-transform:uppercase; color:var(--muted);">Turma</label>
							<select id="filtro-turma-select" style="width:100%; padding:6px 8px; border:2px solid var(--border); border-radius:10px; font-size:.8rem; font-weight:600;">
								<option value="">Todas</option>
								<?php foreach ($turmas_distinct as $turmaOpt): ?>
									<option value="<?= esc(strtolower($turmaOpt)) ?>"><?= esc($turmaOpt) ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div style="display:flex; gap:6px; align-items:center; margin:4px 0 6px;">
						<button type="button" id="btn-clear-filtros"
							style="flex:0 0 auto; background:var(--danger); color:#fff; border:none; padding:6px 12px; font-size:.65rem; letter-spacing:.08rem; font-weight:700; border-radius:8px; cursor:pointer; box-shadow:0 2px 6px -2px #e74c3c88;">
							Limpar
						</button>
						<div id="filtros-info"
							style="flex:1; text-align:right; font-size:.60rem; letter-spacing:.07rem; font-weight:600; color:var(--muted);">
							<span id="count-visiveis">0</span>/<span id="count-total">0</span> alunos
						</div>
					</div>

					<input id="filtro-aluno" type="text" class="filtro-aluno-input" placeholder="Filtrar por nome...">
					<div id="lista-alunos">
						<?php foreach ($alunos as $a): ?>
							<div
								class="aluno-item"
								data-nome="<?= strtolower(esc($a['nome'])) ?>"
								data-ano="<?= esc($a['ano']) ?>"
								data-turma="<?= strtolower(esc($a['turma_nome'])) ?>"
								data-turmanome="<?= esc($a['turma_nome']) ?>"
								onclick="selecionarAluno(<?= $a['id'] ?>)">
								<i class="bi bi-person"></i>
								<span><?= esc($a['nome']) ?></span>
								<div style="margin-left:auto; display:flex; gap:6px; font-size:.6rem; font-weight:700; letter-spacing:.05rem;">
									<span style="background:#e9f1fb; color:var(--primary); padding:3px 6px; border-radius:6px;"><?= esc($a['ano']) ?></span>
									<span style="background:#fff3e0; color:#b76600; padding:3px 6px; border-radius:6px;"><?= esc($a['turma_nome']) ?></span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<form id="form-aluno" method="get" style="display:none;">
						<input type="hidden" name="aluno_id" id="input-aluno-id">
					</form>
				</aside>

				<section class="boletim-conteudo">
					<h2 class="boletim-titulo">
						<i class="bi bi-journal-text" style="font-size:1.4rem;"></i>
						<span>Boletim do Aluno</span>
						<?php if ($aluno_id): ?>
							<span class="badge-aluno">
								<?php foreach ($alunos as $ax) {
									if ($ax['id'] == $aluno_id) {
										echo esc($ax['nome']);
										break;
									}
								} ?>
							</span>
						<?php endif; ?>
					</h2>

					<?php if ($aluno_id): ?>
						<form method="post">
							<table class="boletim-table">
								<thead>
									<tr>
										<th>Disciplina</th>
										<th>Nota</th>
										<th>Frequência</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($boletins)): ?>
										<?php foreach ($boletins as $i => $b): ?>
											<tr>
												<td><?= esc($b['disciplina']) ?></td>
												<td>
													<input type="hidden" name="boletins[<?= $i ?>][boletim_id]" value="<?= esc($b['boletim_id']) ?>">
													<input type="hidden" name="boletins[<?= $i ?>][disciplina_id]" value="<?= esc($b['disciplina_id']) ?>">
													<input type="number" name="boletins[<?= $i ?>][nota]" value="<?= esc($b['nota'] ?? '0') ?>" min="0" max="25" step="0.01" style="background:#fff; color:#264d86; font-size:1.15rem; font-weight:700; width:100%; min-width:80px;">
													<div class="bar-wrap">
														<div class="bar-fill" data-bar-nota data-val="<?= (float)$b['nota'] ?>"></div>
													</div>
												</td>
												<td>
													<input type="number" name="boletins[<?= $i ?>][frequencia]" value="<?= esc($b['frequencia']) ?>" min="0" max="100" step="1">
													<div class="bar-wrap">
														<div class="bar-fill freq" data-bar-freq data-val="<?= (int)$b['frequencia'] ?>"></div>
													</div>
												</td>
												<td>
													<select name="boletins[<?= $i ?>][status]" class="status-select">
														<?php $st = $b['status'] ?? ''; ?>
														<option value="Aprovado" <?= $st === 'Aprovado'  ? 'selected' : '' ?>>Aprovado</option>
														<option value="Reprovado" <?= $st === 'Reprovado' ? 'selected' : '' ?>>Reprovado</option>
														<option value="Cursando" <?= $st === 'Cursando'  ? 'selected' : '' ?>>Cursando</option>
													</select>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="4" class="empty-msg">Nenhuma disciplina localizada.</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
							<div style="text-align:center; margin-top:26px;">
								<button type="submit" class="edit-btn"><i class="bi bi-save2" style="margin-right:8px;"></i>Salvar Alterações</button>
							</div>
						</form>
					<?php else: ?>
						<div class="empty-msg">Selecione um aluno na coluna à esquerda.</div>
					<?php endif; ?>
				</section>
			</div>

		<?php elseif ($tipo_usuario === 'aluno'): ?>
			<!-- Aluno: visualização própria -->
			<div class="boletim-conteudo">
				<div class="student-header-simple">
					<div class="icon"><i class="bi bi-person-check-fill"></i></div>
					<div>
						<h2 style="margin:0 0 4px; font-size:1.4rem; font-weight:800;">
							Olá, <?= esc($aluno['nome'] ?? '') ?>
						</h2>
						<p style="margin:0; font-size:.85rem; letter-spacing:.05rem; opacity:.8;">Seu desempenho atualizado</p>
					</div>
				</div>
				<table class="boletim-table">
					<thead>
						<tr>
							<th>Disciplina</th>
							<th>Nota</th>
							<th>Frequência</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($boletinsAluno ?? [])): ?>
							<?php foreach ($boletinsAluno as $b): ?>
								<tr>
									<td><?= esc($b['disciplina']) ?></td>
									<td>
										<div class="valor-badge" data-tipo="nota"><?= esc($b['nota'] ?? '-') ?></div>
										<div class="bar-wrap">
											<div class="bar-fill" data-bar-nota data-val="<?= (float)$b['nota'] ?>"></div>
										</div>
									</td>
									<td>
										<div class="valor-badge" data-tipo="frequencia"><?= esc($b['frequencia'] ?? '-') ?>%</div>
										<div class="bar-wrap">
											<div class="bar-fill freq" data-bar-freq data-val="<?= (int)$b['frequencia'] ?>"></div>
										</div>
									</td>
									<td>
										<span class="status-badge <?=
																	($b['status'] === 'Aprovado' ? 'status-aprovado' : ($b['status'] === 'Reprovado' ? 'status-reprovado' : 'status-cursando')) ?>">
											<i class="bi bi-patch-check"></i><?= esc($b['status']) ?>
										</span>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="4" class="empty-msg">Nenhum boletim disponível.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		<?php else: ?>
			<p>Você não tem permissão para acessar esta página.</p>
		<?php endif; ?>
	</main>
	<footer class="footer-content">
		<div class="footer-social">
			<a href="https://www.facebook.com/eetan.almeidaneves?locale=pt_BR" target="_blank"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-facebook"></i></a>
			<a href="https://www.instagram.com/eetan.cf/" target="_blank"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-instagram"></i></a>
			<a href="https://www.google.com/maps/place/Escola+Estadual+Tancredo+de+Almeida+Neves/@-19.5003278,-42.637431,17z/data=!3m1!4b1!4m6!3m5!1s0xa5567c07a60a61:0x83e30fe60a08e640!8m2!3d-19.5003329!4d-42.6348561!16s%2Fg%2F11ggbds1s0?entry=ttu" target="_blank" title="Localização"><i style="padding-right: 10px; font-size: 20px; color: aliceblue" class="bi bi-geo-alt-fill"></i></a>
		</div>
		<div class="footer-info">
			<p style="color: aliceblue; margin: 0">&copy; 2024 ETAN - Escola Estadual Tancredo de Almeida Neves</p>
			<p style="margin: 0">
				<a target="_blank" style="color: aliceblue" href="https://api.whatsapp.com/send/?phone=31996013814&text&type=phone_number&app_absent=0"><i class="bi bi-whatsapp"></i> Contato</a>
				|
				<a style="color: aliceblue" href="../html/politica.php">
					<i class="bi bi-shield-lock"></i> Política de Privacidade
				</a>
			</p>
		</div>
	</footer>

	<script>
		// === Filtro alunos (professor) ===
		const filtroAlunoInput = document.getElementById('filtro-aluno');
		if (filtroAlunoInput) {
			const listaAlunos = document.getElementById('lista-alunos');
			filtroAlunoInput.addEventListener('input', () => {
				const termo = filtroAlunoInput.value.toLowerCase().trim();
				let visiveis = 0;
				listaAlunos.querySelectorAll('.aluno-item').forEach(it => {
					const show = it.dataset.nome.includes(termo);
					it.style.display = show ? '' : 'none';
					if (show) visiveis++;
				});
				listaAlunos.style.boxShadow = visiveis ? 'var(--shadow-soft)' : '0 0 0 2px var(--danger) inset';
			});
		}

		function selecionarAluno(id) {
			document.getElementById('input-aluno-id').value = id;
			document.getElementById('form-aluno').submit();
		}

		// === Barras dinâmicas ===
		document.querySelectorAll('[data-bar-nota]').forEach(el => {
			const v = parseFloat(el.dataset.val || 0);
			const pct = Math.min(100, (v / 25) * 100);
			requestAnimationFrame(() => {
				el.style.width = pct + '%';
			});
			if (pct >= 70) el.style.background = 'linear-gradient(90deg,#1fa870,#4ed49d)';
			else if (pct < 40) el.style.background = 'linear-gradient(90deg,#e74c3c,#f78b7d)';
		});
		document.querySelectorAll('[data-bar-freq]').forEach(el => {
			const v = parseFloat(el.dataset.val || 0);
			const pct = Math.min(100, v);
			requestAnimationFrame(() => {
				el.style.width = pct + '%';
			});
			if (pct < 75) el.style.background = 'linear-gradient(90deg,#ff9800,#ffb55c)';
			if (pct < 50) el.style.background = 'linear-gradient(90deg,#e74c3c,#f78b7d)';
		});

		// === Status auto badge (professor select) ===
		document.querySelectorAll('select.status-select').forEach(sel => {
			const wrapCell = sel.closest('td');

			function paint() {
				const val = sel.value;
				let cls = 'status-badge ';
				if (val === 'Aprovado') cls += 'status-aprovado';
				else if (val === 'Reprovado') cls += 'status-reprovado';
				else cls += 'status-cursando';
				if (!wrapCell.querySelector('.status-badge-preview')) {
					const span = document.createElement('span');
					span.className = cls + ' status-badge-preview';
					span.innerHTML = '<i class="bi bi-patch-check"></i>' + val;
					wrapCell.appendChild(span);
					sel.style.marginTop = '6px';
				} else {
					const s = wrapCell.querySelector('.status-badge-preview');
					s.className = cls + ' status-badge-preview';
					s.innerHTML = '<i class="bi bi-patch-check"></i>' + val;
				}
			}
			paint();
			sel.addEventListener('change', paint);
		});

		/* Ajuste defensivo: garante que a lista nunca ultrapasse a viewport */
		(function tuneListaAlunos() {
			const panel = document.querySelector('.alunos-panel');
			const lista = document.getElementById('lista-alunos');
			if (!panel || !lista) return;

			function apply() {
				const vh = window.innerHeight;
				const rect = panel.getBoundingClientRect();
				/* margem para respirar */
				const max = Math.min(Math.floor(vh - 140), 720);
				panel.style.maxHeight = max + 'px';
				/* se já tem flex:1 mantém; garante que a altura não ultrapasse */
				lista.style.maxHeight = (panel.clientHeight - (panel.querySelector('h3')?.offsetHeight || 40) - 70) + 'px';
			}
			apply();
			window.addEventListener('resize', apply);
			window.addEventListener('orientationchange', apply);
		})();

		// ================== FILTROS (Professor) ==================
		const inputNome = document.getElementById('filtro-aluno');
		const selAno = document.getElementById('filtro-ano-select');
		const selTurma = document.getElementById('filtro-turma-select');
		const listaAlunos = document.getElementById('lista-alunos');

		// NOVO: Reconstrói dinamicamente as opções de turma conforme o Ano
		function rebuildTurmas() {
			if (!selTurma || !listaAlunos) return;
			const anoSel = selAno?.value || '';
			const prevTurma = selTurma.value;
			const mapa = new Map();
			listaAlunos.querySelectorAll('.aluno-item').forEach(it => {
				if (!anoSel || it.dataset.ano === anoSel) {
					const chave = it.dataset.turma || 'sem-turma';
					const rotulo = it.dataset.turmanome || chave;
					if (!mapa.has(chave)) mapa.set(chave, rotulo);
				}
			});
			let html = '<option value="">Todas</option>';
			Array.from(mapa.entries())
				.sort((a, b) => a[1].localeCompare(b[1], 'pt-BR'))
				.forEach(([val, label]) => html += `<option value="${val}">${label}</option>`);
			selTurma.innerHTML = html;
			// Restaura turma se ainda existe, senão limpa
			if (prevTurma && mapa.has(prevTurma)) {
				selTurma.value = prevTurma;
			} else {
				selTurma.value = '';
			}
		}

		function updateListaAlunos() {
			if (!listaAlunos) return;
			const termo = (inputNome?.value || '').toLowerCase().trim();
			const anoFiltro = selAno?.value || '';
			const turmaFiltro = selTurma?.value || '';
			let visiveis = 0;
			const itens = listaAlunos.querySelectorAll('.aluno-item');
			itens.forEach(it => {
				const nomeOk = !termo || it.dataset.nome.includes(termo);
				const anoOk = !anoFiltro || it.dataset.ano === anoFiltro;
				const turmaOk = !turmaFiltro || it.dataset.turma === turmaFiltro;
				const show = nomeOk && anoOk && turmaOk;
				it.style.display = show ? '' : 'none';
				if (show) visiveis++;
			});
			const total = itens.length;
			const elVis = document.getElementById('count-visiveis');
			const elTot = document.getElementById('count-total');
			if (elVis) elVis.textContent = visiveis;
			if (elTot) elTot.textContent = total;
			listaAlunos.style.boxShadow = visiveis ? 'var(--shadow-soft)' : '0 0 0 2px var(--danger) inset';
		}

		// Botão limpar filtros (ajuste para reconstruir turmas)
		const btnClear = document.getElementById('btn-clear-filtros');
		if (btnClear) {
			btnClear.addEventListener('click', () => {
				if (inputNome) inputNome.value = '';
				if (selAno) selAno.value = '';
				rebuildTurmas(); // mostra todas as turmas novamente
				if (selTurma) selTurma.value = '';
				const qs = new URLSearchParams(location.search);
				qs.delete('ano');
				qs.delete('turma');
				const alunoKeep = qs.get('aluno_id');
				let newQs = alunoKeep ? '?aluno_id=' + encodeURIComponent(alunoKeep) : '';
				history.replaceState(null, '', 'boletim.php' + newQs);
				updateListaAlunos();
			});
		}

		[inputNome, selTurma].forEach(el => {
			if (el) {
				el.addEventListener('input', updateListaAlunos);
				el.addEventListener('change', updateListaAlunos);
			}
		});

		// Ano precisa primeiro reconstruir turmas e depois atualizar
		if (selAno) {
			selAno.addEventListener('change', () => {
				rebuildTurmas();
				updateListaAlunos();
			});
		}

		(function restoreFiltersFromQS() {
			if (!selAno || !selTurma) {
				updateListaAlunos();
				return;
			}
			const qs = new URLSearchParams(location.search);
			const anoQS = qs.get('ano');
			// Primeiro aplica ano (se existir) para filtrar turmas
			if (anoQS && [...selAno.options].some(o => o.value === anoQS)) {
				selAno.value = anoQS;
			}
			rebuildTurmas();
			const turmaQS = qs.get('turma');
			if (turmaQS && [...selTurma.options].some(o => o.value === turmaQS.toLowerCase())) {
				selTurma.value = turmaQS.toLowerCase();
			}
			updateListaAlunos();
		})();

		if (document.readyState === 'complete' || document.readyState === 'interactive') {
			setTimeout(() => {
				rebuildTurmas();
				updateListaAlunos();
			}, 0);
		} else {
			document.addEventListener('DOMContentLoaded', () => {
				rebuildTurmas();
				updateListaAlunos();
			});
		}

		function selecionarAluno(id) {
			const qs = new URLSearchParams();
			qs.set('aluno_id', id);
			if (selAno?.value) qs.set('ano', selAno.value);
			if (selTurma?.value) qs.set('turma', selTurma.value);
			location.href = 'boletim.php?' + qs.toString();
		}
	</script>
</body>

</html>