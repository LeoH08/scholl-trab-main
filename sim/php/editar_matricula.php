<?php
require_once '../php/controller/auth.php'; requireLogin(); 
require_once __DIR__ . '/db/connection.php';
$pdo = $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $contato = $_POST['contato'];
    $endereco = $_POST['endereco'];
    $responsavel = $_POST['responsavel'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $escola_origem = $_POST['escola_origem'];
    $ano = $_POST['ano'];
    $turno = $_POST['turno'];
    $curso = $_POST['curso'];
    $necessidades = $_POST['necessidades'];

    $stmt = $pdo->prepare("UPDATE matricula SET nome = :nome, email = :email, contato = :contato, endereco = :endereco, responsavel = :responsavel, cpf = :cpf, rg = :rg, escola_origem = :escola_origem, ano = :ano, turno = :turno, curso = :curso, necessidades = :necessidades WHERE id = :id");
    $stmt->execute([
        ':id' => $id,
        ':nome' => $nome,
        ':email' => $email,
        ':contato' => $contato,
        ':endereco' => $endereco,
        ':responsavel' => $responsavel,
        ':cpf' => $cpf,
        ':rg' => $rg,
        ':escola_origem' => $escola_origem,
        ':ano' => $ano,
        ':turno' => $turno,
        ':curso' => $curso,
        ':necessidades' => $necessidades,
    ]);

    header("Location: lista_matriculas.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM matricula WHERE id = :id");
$stmt->execute([':id' => $id]);
$matricula = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$matricula) {
    die("Matrícula não encontrada.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Matrícula</title>
    <style>
        /* Formulário de edição */
        form {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        form label {
            font-weight: bold;
        }

        form input,
        form select,
        form button {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            background-color: #002b5b;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #004080;
        }
    </style>
</head>

<body>
    <h1>Editar Matrícula</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $matricula['id'] ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($matricula['nome']) ?>" required>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($matricula['email']) ?>" required>
        <label for="contato">Contato:</label>
        <input type="text" id="contato" name="contato" value="<?= htmlspecialchars($matricula['contato']) ?>" required>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($matricula['endereco']) ?>" required>
        <label for="responsavel">Responsável:</label>
        <input type="text" id="responsavel" name="responsavel" value="<?= htmlspecialchars($matricula['responsavel']) ?>" required>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($matricula['cpf']) ?>" required>
        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg" value="<?= htmlspecialchars($matricula['rg']) ?>" required>
        <label for="escola_origem">Escola de Origem:</label>
        <input type="text" id="escola_origem" name="escola_origem" value="<?= htmlspecialchars($matricula['escola_origem']) ?>" required>
        <label for="ano">Ano:</label>
        <input type="text" id="ano" name="ano" value="<?= htmlspecialchars($matricula['ano']) ?>" required>
        <label for="turno">Turno:</label>
        <input type="text" id="turno" name="turno" value="<?= htmlspecialchars($matricula['turno']) ?>" required>
        <label for="curso">Curso:</label>
        <input type="text" id="curso" name="curso" value="<?= htmlspecialchars($matricula['curso']) ?>" required>
        <label for="necessidades">Necessidades:</label>
        <input type="text" id="necessidades" name="necessidades" value="<?= htmlspecialchars($matricula['necessidades']) ?>">
        <button type="submit">Salvar</button>
    </form>
</body>

</html>