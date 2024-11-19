<?php
include('../config.php');
include('../verify.php');

$id_paciente = null;
$prontuario = null;
$pacientes = [];

if (isset($_GET['id_paciente']) && !empty($_GET['id_paciente'])) {
    $id_paciente = intval($_GET['id_paciente']);

    $query_prontuario = "SELECT * FROM prontuario WHERE id_paciente = ?";
    $stmt_prontuario = mysqli_prepare($con, $query_prontuario);
    mysqli_stmt_bind_param($stmt_prontuario, 'i', $id_paciente);
    mysqli_stmt_execute($stmt_prontuario);
    $result_prontuario = mysqli_stmt_get_result($stmt_prontuario);
    $prontuario = mysqli_fetch_assoc($result_prontuario);
}

$query_pacientes = "SELECT id_paciente, nome FROM paciente";
$result_pacientes = mysqli_query($con, $query_pacientes);
while ($row = mysqli_fetch_assoc($result_pacientes)) {
    $pacientes[] = $row;
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Prontuário</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="content-box">
        <h2 id="title">
            <?php
            if ($id_paciente && $prontuario) {
                echo "Editar Prontuário - Paciente: " . htmlspecialchars($prontuario['id_paciente']);
            } elseif ($id_paciente) {
                echo "Cadastrar Prontuário - Paciente Selecionado";
            } else {
                echo "Cadastrar Prontuário - Novo";
            }
            ?>
        </h2>
        <form action="salvar_prontuario.php" method="POST" class="form">
            <?php if ($prontuario): ?>
                <input type="hidden" name="id_prontuario" value="<?php echo htmlspecialchars($prontuario['id_prontuario']); ?>">
            <?php endif; ?>

            <div class="one">
                <label>Paciente:</label>
                <select name="id_paciente" required <?php echo $id_paciente ? 'readonly' : ''; ?>>
                    <?php if ($id_paciente && !$prontuario): ?>
                        <?php foreach ($pacientes as $paciente): ?>
                            <?php if ($paciente['id_paciente'] == $id_paciente): ?>
                                <option value="<?php echo $paciente['id_paciente']; ?>" selected>
                                    <?php echo htmlspecialchars($paciente['nome']); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Selecione um paciente</option>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?php echo $paciente['id_paciente']; ?>" 
                                <?php echo ($id_paciente && $paciente['id_paciente'] == $id_paciente) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($paciente['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="couple">
                <div class="one">
                    <label>Data de Abertura:</label>
                    <input type="date" name="data_abertura" 
                           value="<?php echo htmlspecialchars($prontuario['data_abertura'] ?? ''); ?>" 
                           required>
                </div>
                <div class="one">
                    <label>Data de Início dos Atendimentos:</label>
                    <input type="date" name="data_inicio_atendimentos" 
                           value="<?php echo htmlspecialchars($prontuario['data_inicio_atendimentos'] ?? ''); ?>" 
                           required>
                </div>
            </div>
            <div class="one">
                <label>Histórico Familiar:</label>
                <textarea name="historico_familiar" rows="3"><?php echo htmlspecialchars($prontuario['historico_familiar'] ?? ''); ?></textarea>
            </div>
            <div class="one">
                <label>Histórico Social:</label>
                <textarea name="historico_social" rows="3"><?php echo htmlspecialchars($prontuario['historico_social'] ?? ''); ?></textarea>
            </div>
            <div class="one">
                <label>Considerações Finais:</label>
                <textarea name="consideracoes_finais" rows="3"><?php echo htmlspecialchars($prontuario['consideracoes_finais'] ?? ''); ?></textarea>
            </div>
            <div class="one">
                <label>Observações:</label>
                <textarea name="observacoes" rows="3"><?php echo htmlspecialchars($prontuario['observacoes'] ?? ''); ?></textarea>
            </div>

            <div class="send-data">
                <input type="submit" value="<?php echo $prontuario ? 'Atualizar Prontuário' : 'Salvar Prontuário'; ?>">
            </div>
        </form>
    </div>
</body>
</html>
