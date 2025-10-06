
<?php
session_start();
require_once '../db/connection.php';

$tipo_usuario = $_POST['tipo_usuario'] ?? '';
$username = '';
$senha = '';
$masp = '';

if ($tipo_usuario === 'aluno') {
    $username = $_POST['aluno_usuario'] ?? '';
    $senha = $_POST['aluno_senha'] ?? '';
} elseif ($tipo_usuario === 'professor') {
    $username = $_POST['professor_usuario'] ?? '';
    $senha = $_POST['professor_senha'] ?? '';
    $masp = $_POST['professor_codigo'] ?? '';
} elseif ($tipo_usuario === 'admin') {
    $username = $_POST['admin_usuario'] ?? '';
    $senha = $_POST['admin_senha'] ?? '';
} else {
    die('Tipo de usuário inválido.');
}

// Autentica na tabela usuario



$stmt = $conn->prepare("SELECT * FROM usuario WHERE (username = :username OR email = :email) AND senha = :senha AND tipo = :tipo");
$stmt->execute([
    ':username' => $username,
    ':email' => $username,
    ':senha' => $senha,
    ':tipo' => $tipo_usuario
]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['usuario_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['tipo_usuario'] = $user['tipo'];

    // Busca perfil específico
    if ($tipo_usuario === 'aluno') {
        $stmtAluno = $conn->prepare("SELECT * FROM alunos WHERE usuario_id = :uid");
        $stmtAluno->execute([':uid' => $user['id']]);
        $aluno = $stmtAluno->fetch();
        if ($aluno) {
            $_SESSION['aluno_id'] = $aluno['id'];
            header('Location: /scholl-trab-main/sim/html/index.php');
            exit;
        }
    } elseif ($tipo_usuario === 'professor') {
        $stmtProf = $conn->prepare("SELECT * FROM professores WHERE usuario_id = :uid AND masp = :masp");
        $stmtProf->execute([':uid' => $user['id'], ':masp' => $masp]);
        $prof = $stmtProf->fetch();
        if ($prof) {
            $_SESSION['professor_id'] = $prof['id'];
            header('Location: /scholl-trab-main/sim/html/admin.php');
            exit;
        }
    } elseif ($tipo_usuario === 'admin') {
        header('Location: /scholl-trab-main/sim/html/admin.php');
        exit;
    }
    // Se não achou perfil
    echo "<script>alert('Perfil não encontrado!'); window.location.href = '/scholl-trab-main/sim/html/cadastro.php';</script>";
    exit;
} else {
    echo "<script>alert('Usuário ou senha inválidos!'); window.location.href = '/scholl-trab-main/sim/html/cadastro.php';</script>";
    exit;
}
