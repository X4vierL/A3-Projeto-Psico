<?php
include('../config.php');
include('../verify.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_paciente = intval($_POST['id_paciente']);
    $data_abertura = $_POST['data_abertura'];
    $data_inicio_atendimentos = $_POST['data_inicio_atendimentos'];
    $historico_familiar = $_POST['historico_familiar'];
    $historico_social = $_POST['historico_social'];
    $consideracoes_finais = $_POST['consideracoes_finais'];
    $observacoes = $_POST['observacoes'];

    $query_check = "SELECT id_prontuario FROM prontuario WHERE id_paciente = ?";
    $stmt_check = mysqli_prepare($con, $query_check);
    mysqli_stmt_bind_param($stmt_check, 'i', $id_paciente);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);
    $exists = mysqli_fetch_assoc($result_check);

    if ($exists) {
        $query_update = "UPDATE prontuario SET 
                         data_abertura = ?, 
                         data_inicio_atendimentos = ?, 
                         historico_familiar = ?, 
                         historico_social = ?, 
                         consideracoes_finais = ?, 
                         observacoes = ?
                         WHERE id_paciente = ?";
        $stmt_update = mysqli_prepare($con, $query_update);
        mysqli_stmt_bind_param($stmt_update, 'ssssssi', $data_abertura, $data_inicio_atendimentos, $historico_familiar, $historico_social, $consideracoes_finais, $observacoes, $id_paciente);

        if (mysqli_stmt_execute($stmt_update)) {
            echo "Prontuário atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar prontuário: " . mysqli_error($con);
        }
    } else {
        $query_insert = "INSERT INTO prontuario (data_abertura, id_paciente, data_inicio_atendimentos, historico_familiar, historico_social, consideracoes_finais, observacoes) 
                         VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($con, $query_insert);
        mysqli_stmt_bind_param($stmt_insert, 'sisssss', $data_abertura, $id_paciente, $data_inicio_atendimentos, $historico_familiar, $historico_social, $consideracoes_finais, $observacoes);

        if (mysqli_stmt_execute($stmt_insert)) {
            echo "Prontuário salvo com sucesso!";
        } else {
            echo "Erro ao salvar prontuário: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
}
?>
