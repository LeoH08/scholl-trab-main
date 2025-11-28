<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../config/security.php';
// require_once __DIR__ . '/../../../config/database.php'; // se for salvar em banco

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Permitir apenas POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Método não permitido.');
}

// Validação CSRF
$token = $_POST['csrf_token'] ?? '';
if (!hash_equals(csrf_token(), (string)$token)) {
    http_response_code(400);
    exit('Requisição inválida (CSRF).');
}

// Honeypot simples (se preenchido, provável bot)
if (!empty($_POST['_hp'] ?? '')) {
    http_response_code(204);
    exit;
}

// Funções auxiliares
function clean_string(?string $v): string
{
    return trim(filter_var($v ?? '', FILTER_SANITIZE_STRING));
}
function redirect_with_error(string $msg): void
{
    $safe = urlencode($msg);
    header("Location: ../../html/matricula.php?error={$safe}");
    exit;
}
function redirect_success(): void
{
    // redireciona para página que mostra as credenciais
    header('Location: ../../html/credenciais.php');
    exit;
}

// Coleta / sanitização dos campos
$nome            = clean_string($_POST['nome'] ?? '');
$dataNascimento  = $_POST['data_nascimento'] ?? '';
$sexo            = clean_string($_POST['sexo'] ?? '');
$cpf             = clean_string($_POST['cpf'] ?? '');
$rg              = clean_string($_POST['rg'] ?? '');
$email           = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL) ?: '';
$contato         = clean_string($_POST['contato'] ?? '');
$cep             = clean_string($_POST['cep'] ?? '');
$responsavel     = clean_string($_POST['responsavel'] ?? '');
$endereco        = clean_string($_POST['endereco'] ?? '');
$escolaOrigem    = clean_string($_POST['escola_origem'] ?? '');
$ano             = clean_string($_POST['ano'] ?? '');
$turno           = clean_string($_POST['turno'] ?? '');
$curso           = clean_string($_POST['curso'] ?? '');
$necessidades    = clean_string($_POST['necessidades'] ?? '');
$autorizacaoImg  = isset($_POST['autorizacao_imagem']) ? 1 : 0;

// Validações básicas
$erros = [];

// Campos obrigatórios
if ($nome === '')            $erros[] = 'Informe o nome completo.';
if ($dataNascimento === '')  $erros[] = 'Informe a data de nascimento.';
if ($sexo === '')            $erros[] = 'Selecione o sexo.';
if ($cpf === '')             $erros[] = 'Informe o CPF.';
if ($rg === '')              $erros[] = 'Informe o RG.';
if ($email === '')           $erros[] = 'Informe um e-mail válido.';
if ($contato === '')         $erros[] = 'Informe o número de contato.';
if ($responsavel === '')     $erros[] = 'Informe o nome do responsável.';
if ($endereco === '')        $erros[] = 'Informe o endereço completo.';
if ($escolaOrigem === '')    $erros[] = 'Informe a escola de origem.';
if ($ano === '')             $erros[] = 'Selecione o ano/série.';
if ($turno === '')           $erros[] = 'Selecione o turno.';
if ($curso === '')           $erros[] = 'Selecione o curso desejado.';
if (!$autorizacaoImg)        $erros[] = 'É necessário aceitar a autorização de uso de imagem.';

// CPF (formato 000.000.000-00)
if ($cpf !== '' && !preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf)) {
    $erros[] = 'CPF em formato inválido.';
}

// CEP opcional, se vier, validar formato
if ($cep !== '' && !preg_match('/^\d{5}-?\d{3}$/', $cep)) {
    $erros[] = 'CEP em formato inválido.';
}

// Se houver erros, redireciona com primeira mensagem
if (!empty($erros)) {
    redirect_with_error($erros[0]);
}

// Upload de documentos (opcional)
$uploadedFiles = [];
if (!empty($_FILES['documentos']) && is_array($_FILES['documentos']['name'])) {
    $allowedMime = [
        'application/pdf',
        'image/jpeg',
        'image/png',
        'image/jpg'
    ];
    $maxSize = 5 * 1024 * 1024; // 5MB
    $uploadDir = __DIR__ . '/../../uploads/matriculas';

    if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0775, true);
    }

    foreach ($_FILES['documentos']['name'] as $idx => $original) {
        if ($_FILES['documentos']['error'][$idx] === UPLOAD_ERR_NO_FILE) {
            continue;
        }

        $tmpName = $_FILES['documentos']['tmp_name'][$idx] ?? '';
        $size    = $_FILES['documentos']['size'][$idx] ?? 0;
        $error   = $_FILES['documentos']['error'][$idx] ?? UPLOAD_ERR_OK;

        if ($error !== UPLOAD_ERR_OK || !is_uploaded_file($tmpName)) {
            continue;
        }

        if ($size > $maxSize) {
            // você pode acumular um erro ou apenas ignorar o arquivo grande
            continue;
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if (!in_array($mime, $allowedMime, true)) {
            continue;
        }

        $ext = pathinfo($original, PATHINFO_EXTENSION);
        $safeName = uniqid('doc_', true) . '.' . preg_replace('/[^a-z0-9]+/i', '', $ext);
        $destPath = $uploadDir . DIRECTORY_SEPARATOR . $safeName;

        if (move_uploaded_file($tmpName, $destPath)) {
            $uploadedFiles[] = $safeName;
        }
    }
}

// Salvando em banco (exemplo comentado)
/*
try {
    $pdo = get_pdo(); // implemente em config/database.php
    $sql = 'INSERT INTO matriculas (
                nome, data_nascimento, sexo, cpf, rg, email, contato,
                cep, responsavel, endereco, escola_origem, ano, turno,
                curso, necessidades, autorizacao_imagem, arquivos
            ) VALUES (
                :nome, :data_nascimento, :sexo, :cpf, :rg, :email, :contato,
                :cep, :responsavel, :endereco, :escola_origem, :ano, :turno,
                :curso, :necessidades, :autorizacao_imagem, :arquivos
            )';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'               => $nome,
        ':data_nascimento'    => $dataNascimento,
        ':sexo'               => $sexo,
        ':cpf'                => $cpf,
        ':rg'                 => $rg,
        ':email'              => $email,
        ':contato'            => $contato,
        ':cep'                => $cep,
        ':responsavel'        => $responsavel,
        ':endereco'           => $endereco,
        ':escola_origem'      => $escolaOrigem,
        ':ano'                => $ano,
        ':turno'              => $turno,
        ':curso'              => $curso,
        ':necessidades'       => $necessidades,
        ':autorizacao_imagem' => $autorizacaoImg,
        ':arquivos'           => json_encode($uploadedFiles, JSON_UNESCAPED_UNICODE),
    ]);
} catch (Throwable $e) {
    error_log('Erro ao salvar matrícula: ' . $e->getMessage());
    redirect_with_error('Não foi possível registrar a matrícula. Tente novamente mais tarde.');
}
*/

// EXEMPLO de criação de credenciais:
// aqui você define qual será o login do aluno. Vou supor CPF (sem máscara) + senha provisória.
$cpfSomenteDigitos = preg_replace('/\D+/', '', $cpf);
$usuarioGerado     = $cpfSomenteDigitos;           // ex.: 12345678910
$senhaProvisoria   = substr($cpfSomenteDigitos, -4) . rand(100, 999); // ex.: 8910123

// Se for salvar usuário de login em outra tabela, aqui você faz o INSERT usando password_hash($senhaProvisoria, ...)
// ...código de INSERT do usuário (opcional / a seu critério)...

// Disponibiliza as credenciais para a página credenciais.php
$_SESSION['credenciais_aluno'] = [
    'usuario' => $usuarioGerado,
    'senha'   => $senhaProvisoria,
];

// no fim, redireciona para página de credenciais
redirect_success();
