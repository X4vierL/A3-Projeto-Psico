<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

    <div class="content-list">
        <h1 id="title">Pacientes</h1>
        <ul class="paciente-lista">

            <?php
            include('C:/xampp/htdocs/A3-Projeto-Psico/config.php');

            $query = "SELECT p.id_paciente, p.nome, COUNT(s.id_sessao) AS sessoes
                    FROM paciente p
                    LEFT JOIN prontuario pr ON pr.id_paciente = p.id_paciente
                    LEFT JOIN sessao s ON s.id_prontuario = pr.id_prontuario
                    GROUP BY p.id_paciente";
                    
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($paciente = mysqli_fetch_assoc($result)) {
                    echo '<li class="paciente-item">';
                    echo '<span>' . htmlspecialchars($paciente['nome']) . '</span>';
                    echo '<span>Sessões: ' . htmlspecialchars($paciente['sessoes']) . '</span>';
                    echo '<a href="../prontuario/prontuario.php?id=' . urlencode($paciente['id_paciente']) . '" class="paciente-link">Ver Prontuário</a>';
                    echo '</li>';
                }
            } else {
                echo '<li class="paciente-item">Nenhum paciente encontrado.</li>';
            }
            mysqli_close($con);
            ?>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
            <li class="paciente-item">Nenhum paciente encontrado.</li>
        </ul>
        <button onclick="window.location.href='../paciente/paciente.php'" class="button-cadastrar">Cadastrar Novo Paciente</button>
    </div>
</body>
</html>
