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
            include('../config.php');
            include('../verify.php');

            if (!isset($_SESSION['id_usuario'])) {
                die("Erro: Usuário não autenticado.");
            }
            $id_usuario = $_SESSION['id_usuario'];
            $nivel_usuario = $_SESSION["nivel_usuario"];
            
            if ($nivel_usuario === "ADM") {
                $query = "
                    SELECT 
                        p.id_paciente, 
                        p.nome, 
                        p.contato, 
                        COUNT(s.id_sessao) AS total_sessoes
                    FROM 
                        paciente p
                    LEFT JOIN 
                        sessao s ON s.id_paciente = p.id_paciente
                    GROUP BY 
                        p.id_paciente
                ";
            
                $result = mysqli_query($con, $query);
            
            } else {
                $query = "
                    SELECT 
                        p.id_paciente, 
                        p.nome, 
                        p.contato, 
                        COUNT(s.id_sessao) AS total_sessoes
                    FROM 
                        paciente p
                    LEFT JOIN 
                        sessao s ON s.id_paciente = p.id_paciente
                    WHERE 
                        p.estagiario_responsavel = ?
                    GROUP BY 
                        p.id_paciente
                ";
            
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'i', $id_usuario);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }

            if ($result && mysqli_num_rows($result) > 0) {
                while ($paciente = mysqli_fetch_assoc($result)) {
                    echo '<li class="paciente-item">';
                    echo '<span>' . htmlspecialchars($paciente['nome']) . ': </span>';
                    echo '<a href="../sessoes_lst/sessoes_lst.php?id_paciente=' . urlencode($paciente['id_paciente']) . '" class="paciente-link"><span>Sessões: ' . htmlspecialchars($paciente['total_sessoes']) . '</span></a>';
                    echo '<a href="../prontuario/prontuario.php?id_paciente=' . urlencode($paciente['id_paciente']) . '" class="paciente-link">Ver Prontuário</a>';
                    echo '</li>';
                }
            } else {
                echo '<li class="paciente-item">Nenhum paciente encontrado.</li>';
            }

            mysqli_close($con);
            ?>
        </ul>
        <button onclick="window.location.href='../paciente/paciente.php'" class="button-cadastrar">Cadastrar Novo Paciente</button>
    </div>

</body>
</html>
