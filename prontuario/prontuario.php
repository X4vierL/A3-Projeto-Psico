<?php
include('../config.php');
include('../verify.php');

$id_paciente = null;
$prontuario = null;
$pacientes = [];
$pacientes_sem_prontuario = [];

$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];

if ($nivel_usuario === 'ADM') {
    $query_pacientes_sem_prontuario = "
        SELECT p.id_paciente, p.nome 
        FROM paciente p 
        LEFT JOIN prontuario pr ON p.id_paciente = pr.id_paciente 
        WHERE pr.id_paciente IS NULL
    ";
    $result_pacientes_sem_prontuario = mysqli_query($con, $query_pacientes_sem_prontuario);
} else {
    $query_pacientes_sem_prontuario = "
        SELECT p.id_paciente, p.nome 
        FROM paciente p 
        LEFT JOIN prontuario pr ON p.id_paciente = pr.id_paciente 
        WHERE pr.id_paciente IS NULL AND p.estagiario_responsavel = ?
    ";
    $stmt_pacientes_sem_prontuario = mysqli_prepare($con, $query_pacientes_sem_prontuario);
    mysqli_stmt_bind_param($stmt_pacientes_sem_prontuario, 'i', $id_usuario);
    mysqli_stmt_execute($stmt_pacientes_sem_prontuario);
    $result_pacientes_sem_prontuario = mysqli_stmt_get_result($stmt_pacientes_sem_prontuario);
}

while ($row = mysqli_fetch_assoc($result_pacientes_sem_prontuario)) {
    $pacientes_sem_prontuario[] = $row;
}

$nome_paciente = "Paciente não encontrado";
if ($id_paciente) {
    foreach ($pacientes as $paciente) {
        if ($paciente['id_paciente'] == $id_paciente) {
            $nome_paciente = $paciente['nome'];
            break;
        }
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Prontuário</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="content-box">
        <h2 id="title">
            <?php
            if ($id_paciente && $prontuario) {
                echo "Editar Prontuário - Paciente: " . htmlspecialchars($nome_paciente);
            } elseif ($id_paciente) {
                echo "Cadastrar Prontuário - Paciente Selecionado";
            } else {
                echo "Cadastrar Prontuário - Novo";
            }
            ?>
        </h2>
        <form action="salvar_prontuario.php" method="POST" class="form">
            <?php if ($id_paciente): ?>
                <div class="one first">
                    <label>Paciente:</label>
                    <input type="text" value="<?php echo htmlspecialchars($nome_paciente); ?>" disabled>
                    <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($id_paciente); ?>">
                </div>
            <?php else: ?>
                <div class="one first">
                    <label>Paciente:</label>
                    <select name="id_paciente" required>
                        <option value="">Selecione um paciente</option>
                        <?php foreach ($pacientes_sem_prontuario as $paciente): ?>
                            <option value="<?php echo htmlspecialchars($paciente['id_paciente']); ?>">
                                <?php echo htmlspecialchars($paciente['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="couple">
                <div>
                    <label>Data de Abertura:</label>
                    <input type="date" name="data_abertura" 
                           value="<?php echo htmlspecialchars($prontuario['data_abertura'] ?? ''); ?>" 
                           required>
                </div>
                <div>
                    <label>Data de Início dos Atendimentos:</label>
                    <input type="date" name="data_inicio_atendimentos" 
                           value="<?php echo htmlspecialchars($prontuario['data_inicio_atendimentos'] ?? ''); ?>" 
                           required>
                </div>
            </div>
            <div class="one">
                <label>Histórico Familiar:</label>
                <textarea name="historico_familiar"><?php echo htmlspecialchars($prontuario['historico_familiar'] ?? ''); ?></textarea>
            </div>
            <div class="one">
                <label>Histórico Social:</label>
                <textarea name="historico_social" rows="3"><?php echo htmlspecialchars($prontuario['historico_social'] ?? ''); ?></textarea>
            </div>
            <div class="one">
                <label>Conclusão:</label>
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
