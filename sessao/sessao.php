<?php
include('../config.php');
include('../verify.php');

if (!isset($_GET['id_paciente']) || empty($_GET['id_paciente'])) {
    die("Erro: Nenhum ID de paciente foi fornecido.");
}

$id_paciente = intval($_GET['id_paciente']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_sessao = $_POST['data_sessao'];
    $descricao_atividades = $_POST['descricao_atividades'];
    $observacao = $_POST['observacao'];

    if (empty($data_sessao) || empty($descricao_atividades)) {
        $error = "Todos os campos obrigatórios devem ser preenchidos.";
    } else {
        $query_last_sessao = "SELECT MAX(numero_sessao) AS ultimo_numero_sessao FROM sessao WHERE id_paciente = ?";
        $stmt_last_sessao = mysqli_prepare($con, $query_last_sessao);
        mysqli_stmt_bind_param($stmt_last_sessao, 'i', $id_paciente);
        mysqli_stmt_execute($stmt_last_sessao);
        $result_last_sessao = mysqli_stmt_get_result($stmt_last_sessao);
        $last_sessao = mysqli_fetch_assoc($result_last_sessao);

        $numero_sessao = $last_sessao['ultimo_numero_sessao'] + 1;
        $query = "INSERT INTO sessao (id_paciente, data_sessao, numero_sessao, descricao_atividades, observacao)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'isiss', $id_paciente, $data_sessao, $numero_sessao, $descricao_atividades, $observacao);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Sessão registrada com sucesso!";
        } else {
            $error = "Erro ao registrar a sessão: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Sessão</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="content-box">
        <h2>Cadastrar Nova Sessão</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php elseif (isset($success)): ?>
            <p style="color: green;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form action="sessao.php?id_paciente=<?= $id_paciente ?>" method="POST">
            <div class="form-group">
                <label>Data da Sessão:</label>
                <input type="date" name="data_sessao" required>
            </div>
            <div class="form-group">
                <label>Número da Sessão:</label>
                <input type="text" value="<?= isset($numero_sessao) ? $numero_sessao : 1 ?>" readonly>
            </div>
            <div class="form-group">
                <label>Descrição das Atividades:</label>
                <textarea name="descricao_atividades" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label>Observação:</label>
                <textarea name="observacao" rows="4"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Salvar Sessão">
            </div>
        </form>
    </div>
</body>
</html>