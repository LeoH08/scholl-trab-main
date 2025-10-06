<?php
/*-----------------------------------------------------------
 | 1. CONEXÃO (PDO)
 *----------------------------------------------------------*/
$host     = 'localhost';
$dbname   = 'escola_eetan'; // Verifique se o nome do banco está correto
$user     = 'root';       // Substitua 'Leozoa' pelo nome de usuário correto
$password = '';           // Substitua '00000000' pela senha correta (ou deixe vazio se não houver senha)
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // lança Exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,                  // use prepared nativo
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

/*-----------------------------------------------------------
 | 2. RECEBE E VALIDA CAMPOS DO FORMULÁRIO
 *----------------------------------------------------------*/
$required = [
    'nome',
    'data_nascimento',
    'sexo',
    'email',
    'contato',
    'endereco',
    'responsavel',
    'cpf',
    'rg',
    'escola_origem',
    'ano',
    'turno',
    'curso',
    'autorizacao_imagem'
];

# Função para validar campos obrigatórios
function validarCamposObrigatorios($campos, $dados)
{
    foreach ($campos as $campo) { // Corrigido "como" para "as"
        if (empty($dados[$campo])) {
            echo "<script>alert('O campo \"$campo\" é obrigatório. Por favor, preencha todos os campos.'); history.back();</script>";
            exit;
        }
    }
}

# Validar campos obrigatórios
validarCamposObrigatorios($required, $_POST);

# Sanitizar entradas
$nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$contato = filter_var($_POST['contato'], FILTER_SANITIZE_STRING);
// ...sanitize outros campos...

# Remova máscara do CPF
$cpf = preg_replace('/\D/', '', $_POST['cpf']); // "12345678909"

# Validação de CPF
function validarCPF($cpf)
{
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

if (!validarCPF($cpf)) {
    echo "<script>alert('CPF inválido. Por favor, verifique e tente novamente.'); history.back();</script>";
    exit;
}

# Remova máscara do RG
$rg = preg_replace('/\D/', '', $_POST['rg']); // Remove caracteres não numéricos

# Validação de RG
function validarRG($rg)
{
    return strlen($rg) >= 7 && strlen($rg) <= 14; // Exemplo: RG deve ter entre 7 e 14 dígitos
}

if (!validarRG($rg)) {
    echo "<script>alert('RG inválido. Por favor, verifique e tente novamente.'); history.back();</script>";
    exit;
}

# Validação de e-mail
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('E-mail inválido. Por favor, verifique e tente novamente.'); history.back();</script>";
    exit;
}

/*-----------------------------------------------------------
 | 3. FAZ UPLOAD DOS DOCUMENTOS
 *----------------------------------------------------------*/
$paths = []; // guardará os caminhos para inserir no DB
$uploadDir = __DIR__ . '/uploads/'; // certifique‑se de que exista (chmod 755)

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

# Melhorar segurança no upload de arquivos
if (!empty($_FILES['documentos']['name'][0])) {
    foreach ($_FILES['documentos']['tmp_name'] as $key => $tmpName) {
        $mimeType = mime_content_type($tmpName);
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($mimeType, $allowedTypes)) {
            echo "<script>alert('Tipo de arquivo inválido. Apenas PDF, JPEG e PNG são permitidos.'); history.back();</script>";
            exit;
        }
        $origName  = basename($_FILES['documentos']['name'][$key]);
        $ext       = pathinfo($origName, PATHINFO_EXTENSION);
        $newName   = uniqid('doc_') . '.' . $ext;
        $destPath  = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $destPath)) {
            $paths[] = 'uploads/' . $newName; // caminho relativo
        }
    }
}
$docPaths = implode(';', $paths); // separa por “;”

/*-----------------------------------------------------------
 | 4. INSERT PREPARADO
 *----------------------------------------------------------*/
try {
    // Verifica o maior ID atual na tabela
    $stmtMaxId = $pdo->query("SELECT MAX(id) AS max_id FROM matricula");
    $result = $stmtMaxId->fetch();
    $nextId = ($result['max_id'] ?? 0) + 1;

    // Ajusta o AUTO_INCREMENT para o próximo ID correto
    $pdo->exec("ALTER TABLE matricula AUTO_INCREMENT = $nextId");
} catch (PDOException $e) {
    die("Erro ao ajustar AUTO_INCREMENT: " . $e->getMessage());
}

# Verifica duplicidade de CPF ou e-mail (matricula)
try {
    $stmtCheckDuplicate = $pdo->prepare("SELECT COUNT(*) AS total FROM matricula WHERE cpf = :cpf OR email = :email");
    $stmtCheckDuplicate->execute([':cpf' => $cpf, ':email' => $_POST['email']]);
    $result = $stmtCheckDuplicate->fetch();
    if ($result['total'] > 0) {
        echo "<script>alert('Já existe uma matrícula com este CPF ou e-mail.'); history.back();</script>";
        exit;
    }
} catch (PDOException $e) {
    echo "<script>alert('Erro ao verificar duplicidade: " . $e->getMessage() . "'); history.back();</script>";
    exit;
}

// Preenche "necessidades" com "Não" se estiver em branco
$necessidades = !empty($_POST['necessidades']) ? $_POST['necessidades'] : 'Não';

$sql = "INSERT INTO matricula
    (nome,data_nascimento,sexo,email,contato,endereco,responsavel,cpf,rg,
     escola_origem,ano,turno,curso,necessidades,doc_paths,autorizacao_img)
    VALUES
    (:nome,:data_nascimento,:sexo,:email,:contato,:endereco,:responsavel,:cpf,:rg,
     :escola_origem,:ano,:turno,:curso,:necessidades,:doc_paths,:autorizacao_img)";

$stmt = $pdo->prepare($sql);

$params = [
    ':nome'              => $_POST['nome'],
    ':data_nascimento'   => $_POST['data_nascimento'],
    ':sexo'              => $_POST['sexo'],
    ':email'             => $_POST['email'],
    ':contato'           => $_POST['contato'],
    ':endereco'          => $_POST['endereco'],
    ':responsavel'       => $_POST['responsavel'],
    ':cpf'               => $cpf,
    ':rg'                => $rg, // Atualizado para usar o RG formatado
    ':escola_origem'     => $_POST['escola_origem'],
    ':ano'               => (int)$_POST['ano'],
    ':turno'             => $_POST['turno'],
    ':curso'             => $_POST['curso'],
    ':necessidades'      => $necessidades, // Atualizado para usar o valor padrão
    ':doc_paths'         => $docPaths ?: null,
    ':autorizacao_img'   => isset($_POST['autorizacao_imagem']) ? 1 : 0,
];

try {
    // Inicia transação para garantir atomicidade
    $pdo->beginTransaction();

    $stmt->execute($params); // INSERT matricula

    // 1. Verificar e-mail já existente em usuario
    $emailAluno = $_POST['email'];
    $chkUser = $pdo->prepare("SELECT id FROM usuario WHERE email = :e LIMIT 1");
    $chkUser->execute([':e' => $emailAluno]);
    if ($chkUser->fetchColumn()) {
        $pdo->rollBack();
        echo "<script>alert('E-mail já cadastrado para um usuário. Use outro.'); history.back();</script>";
        exit;
    }

    // 2. Mapear curso
    $cursoForm = strtolower(trim($_POST['curso']));
    $mapCurso = [
        'desenvolvimento' => 1,
        'ds' => 1,
        'logistica' => 2,
        'logística' => 2,
        'eja' => 10
    ];
    if (!isset($mapCurso[$cursoForm])) {
        $pdo->rollBack();
        echo "<script>alert('Curso inválido.'); history.back();</script>";
        exit;
    }
    $curso_id = $mapCurso[$cursoForm];
    $modalidade = $curso_id === 10 ? 'EJA' : 'Regular';

    // === NOVO: função robusta para gerar matrícula única ===
    function generateMatricula(PDO $pdo, string $anoAtual, int $maxTentativas = 5): string
    {
        // Obtém maior sequência já usada no ano
        $stmt = $pdo->prepare("SELECT MAX(matricula) AS max_mat FROM alunos WHERE matricula LIKE :pref");
        $stmt->execute([':pref' => $anoAtual . '%']);
        $max = $stmt->fetchColumn();

        $seq = 1;
        if ($max) {
            $seq = (int)substr($max, 4) + 1;
        }

        for ($i = 0; $i < $maxTentativas; $i++) {
            $cand = $anoAtual . str_pad($seq, 4, '0', STR_PAD_LEFT);
            $chk = $pdo->prepare("SELECT COUNT(*) FROM alunos WHERE matricula = :m");
            $chk->execute([':m' => $cand]);
            if ($chk->fetchColumn() == 0) {
                return $cand;
            }
            $seq++;
        }
        throw new RuntimeException("Não foi possível gerar matrícula única após {$maxTentativas} tentativas.");
    }

    // SUBSTITUI o bloco antigo:
    $anoAtual = date('Y');
    $matriculaGerada = generateMatricula($pdo, $anoAtual);

    // 4. Gerar username único
    function removerAcentos($str)
    {
        $tmp = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        return preg_replace('/[^A-Za-z0-9\. ]/', '', $tmp);
    }
    $nomeAluno = $_POST['nome'];
    $parts = preg_split('/\s+/', trim(mb_strtolower($nomeAluno)));
    $first = preg_replace('/[^a-z0-9]/', '', removerAcentos($parts[0] ?? 'aluno'));
    $last  = preg_replace('/[^a-z0-9]/', '', removerAcentos(end($parts) ?: $first));
    $baseUser = $first . '.' . $last;
    $username = $baseUser;
    $i = 1;
    $chkUsername = $pdo->prepare("SELECT 1 FROM usuario WHERE username = :u LIMIT 1");
    while (true) {
        $chkUsername->execute([':u' => $username]);
        if (!$chkUsername->fetchColumn()) break;
        $username = $baseUser . $i++;
    }

    // 5. Gerar senha (texto simples – manter compatível com login atual)
    $senhaGeradaPlain = substr(bin2hex(random_bytes(6)), 0, 8);

    // 6. Inserir usuário
    $insUser = $pdo->prepare("INSERT INTO usuario (username, email, senha, tipo) VALUES (:u,:e,:s,'aluno')");
    $insUser->execute([
        ':u' => $username,
        ':e' => $emailAluno,
        ':s' => $senhaGeradaPlain // (melhorar futuramente para hash + ajuste no login)
    ]);
    $usuarioId = $pdo->lastInsertId();

    // 7. Encontrar turma (EJA usa course_id=1 na tabela turmas)
    $anoSerie = (int)$_POST['ano'];
    $turmaCursoId = ($modalidade === 'EJA') ? 1 : $curso_id;
    $selTurma = $pdo->prepare("SELECT id, nome FROM turmas WHERE curso_id = :cid AND ano = :ano AND modalidade = :mod LIMIT 1");
    $selTurma->execute([
        ':cid' => $turmaCursoId,
        ':ano' => $anoSerie,
        ':mod' => $modalidade
    ]);
    $turmaRow = $selTurma->fetch();
    $turmaId = $turmaRow['id'] ?? null;
    // ALTERADO: antes usava id como texto; agora usa nome da turma
    $turmaTexto = $turmaRow['nome'] ?? null;

    // Ao inserir aluno, proteger contra condição de corrida (duplicate key)
    $insAlunoOk = false;
    $tentativasMat = 3;
    for ($t = 0; $t < $tentativasMat; $t++) {
        try {
            $insAluno = $pdo->prepare("
                INSERT INTO alunos (curso_id, turma_id, usuario_id, materias_id, matricula, nome, ano, turma, modalidade)
                VALUES (:curso_id, :turma_id, :usuario_id, NULL, :matricula, :nome, :ano, :turma, :modalidade)
            ");
            $insAluno->execute([
                ':curso_id' => $curso_id,
                ':turma_id' => $turmaId,
                ':usuario_id' => $usuarioId,
                ':matricula' => $matriculaGerada,
                ':nome' => $nomeAluno,
                ':ano' => $anoSerie,
                ':turma' => $turmaTexto,
                ':modalidade' => $modalidade
            ]);
            $insAlunoOk = true;
            break;
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // duplicate key
                $matriculaGerada = generateMatricula($pdo, $anoAtual);
                continue;
            }
            throw $e;
        }
    }
    if (!$insAlunoOk) {
        throw new RuntimeException("Falha ao inserir aluno após múltiplas tentativas de matrícula.");
    }

    // 9. Commit
    $pdo->commit();

    // 10. Preparar variáveis para exibição
    $login_username  = $username;
    $login_senha     = $senhaGeradaPlain;
    $login_matricula = $matriculaGerada;
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo "<script>alert('Erro ao concluir matricula: " . addslashes($e->getMessage()) . "'); history.back();</script>";
    exit;
}

// Salvar os dados em um arquivo .txt de forma organizada (sem tabela)
$txtFile = "../txt/matriculas.txt";

// Certifique-se de que as variáveis estão definidas
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$contato = $_POST['contato'];
$endereco = $_POST['endereco'];
$responsavel = $_POST['responsavel'];
$rg = $_POST['rg'];
$escola_origem = $_POST['escola_origem'];
$ano = $_POST['ano'];
$turno = $_POST['turno'];
$curso = $_POST['curso'];
$necessidades = !empty($_POST['necessidades']) ? $_POST['necessidades'] : 'Não';
$autorizacao_imagem = isset($_POST['autorizacao_imagem']) ? 'Sim' : 'Não';

$linhaTxt =
    "Nome: $nome\n" .
    "Data de Nascimento: $data_nascimento\n" .
    "Sexo: $sexo\n" .
    "Email: $email\n" .
    "Contato: $contato\n" .
    "Endereço: $endereco\n" .
    "Responsável: $responsavel\n" .
    "CPF: $cpf\n" .
    "RG: $rg\n" . // Atualizado para incluir o RG formatado
    "Escola de Origem: $escola_origem\n" .
    "Ano: $ano\n" .
    "Turno: $turno\n" .
    "Curso: $curso\n" .
    "Necessidades: $necessidades\n" . // Atualizado para incluir o valor padrão
    "Autorização de Imagem: $autorizacao_imagem\n" .
    "=== ACESSO GERADO ===\n" .
    "Usuário: " . ($login_username ?? '') . "\n" .
    "Senha: " . ($login_senha ?? '') . "\n" .
    "Matrícula: " . ($login_matricula ?? '') . "\n" .
    "-----------------------------\n";

if (!is_dir(dirname($txtFile))) {
    mkdir(dirname($txtFile), 0755, true);
}

file_put_contents($txtFile, $linhaTxt, FILE_APPEND);

function incluirCabecalho()
{
    include '../html/cabecalho.php';
}

function incluirRodape()
{
    include '../html/rodape.php';
}

$credenciaisHtml = '';
if (isset($login_username, $login_senha, $login_matricula)) {
    $credenciaisHtml = '
        <div class="dados-login" style="margin-top:25px;background:#fff;border:1px solid #d4ddeb;padding:15px 18px;border-radius:8px;text-align:left;">
            <h2 style="margin:0 0 10px;font-size:19px;color:#002b5b;">Dados de Acesso</h2>
            <p style="margin:4px 0;"><strong>Usuário:</strong> ' . htmlspecialchars($login_username) . '</p>
            <p style="margin:4px 0;"><strong>Senha:</strong> ' . htmlspecialchars($login_senha) . '</p>
            <p style="margin:4px 0;"><strong>Matrícula:</strong> ' . htmlspecialchars($login_matricula) . '</p>
            <small style="font-size:12px;color:#555;">Guarde seus dados. A senha pode ser alterada futuramente.</small>
        </div>';
}

echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Matrícula enviada - EETAN</title>
        <link rel="stylesheet" href="../css/stylelayout.css" />
        <link rel="stylesheet" href="../css/stylematricula.css" />
        <link rel="shortcut icon" href="../fts/Logo_EETAN.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    </head>
    <body>
       
        <main>
            <div class="confirmacao-matricula" style="background:#f2f6ff;padding:40px 20px;border-radius:10px;max-width:500px;margin:40px auto;text-align:center;box-shadow:0 2px 8px #002b5b22;">
                <h1 style="color:#002b5b;">Matrícula enviada com sucesso!</h1>
                <p style="color:#222;font-size:18px;">
                    Suas informações foram recebidas.<br>
                    Aguarde um e-mail de confirmação nos próximos <strong>7 dias</strong>.<br>
                    Caso não receba, entre em contato com a secretaria da escola.
                </p>' . $credenciaisHtml . '
                <a class="btn-voltar" href="../html/index.php" style="display:inline-block;margin-top:20px;padding:10px 30px;background:#002b5b;color:#fff;border-radius:5px;text-decoration:none;font-size:16px;">Voltar para o início</a>
            </div>
        </main>
        
    </body>
    </html>
';
