<?php
include('../config.php');
include('../verify.php');

if (!isset($_GET['id_paciente']) || empty($_GET['id_paciente'])) {
    die("Erro: Nenhum ID de paciente foi fornecido.");
}

$id_paciente = intval($_GET['id_paciente']);

$id_paciente = intval($_GET['id_paciente']);
$query_nome = "SELECT nome FROM paciente WHERE id_paciente = ?";
$stmt_nome = mysqli_prepare($con, $query_nome);
mysqli_stmt_bind_param($stmt_nome, 'i', $id_paciente);
mysqli_stmt_execute($stmt_nome);
$result_nome = mysqli_stmt_get_result($stmt_nome);

$query_sessoes = "SELECT * FROM sessao WHERE id_paciente = ?";
$stmt_sessoes = mysqli_prepare($con, $query_sessoes);
mysqli_stmt_bind_param($stmt_sessoes, 'i', $id_paciente);
mysqli_stmt_execute($stmt_sessoes);
$result_sessoes = mysqli_stmt_get_result($stmt_sessoes);

$sessoes = [];
while ($row = mysqli_fetch_assoc($result_sessoes)) {
    $sessoes[] = $row;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sessões do Paciente</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="content-box">
        <h2>Sessões do Paciente <?php if ($result_nome && $nome_paciente = mysqli_fetch_assoc($result_nome)) {
    echo $nome_paciente['nome'];
} else {
    echo "Paciente não encontrado.";
}?></h2>
        <?php if (!empty($sessoes)): ?>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Sessão</th>
                        <th>Data da Sessão</th>
                        <th>Número da Sessão</th>
                        <th>Descrição das Atividades</th>
                        <th>Observação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sessoes as $sessao): ?>
                        <tr>
                            <td><?= htmlspecialchars($sessao['id_sessao']) ?></td>
                            <td><?= htmlspecialchars($sessao['data_sessao']) ?></td>
                            <td><?= htmlspecialchars($sessao['numero_sessao']) ?></td>
                            <td><?= htmlspecialchars($sessao['descricao_atividades']) ?></td>
                            <td><?= htmlspecialchars($sessao['observacao']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Este paciente não possui sessões registradas.</p>
        <?php endif; ?>
    </div>
    <div class="actions">
        <a href="../sessao/sessao.php?id_paciente=<?= $id_paciente ?>" class="btn">Cadastrar Nova Sessão</a>
    </div>
</body>
</html>
