<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php
include('C:/xampp/htdocs/A3-Projeto-Psico/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os valores do formulário
    $nome = trim($_POST['nome']);
    $genero = trim($_POST['genero']);
    $data_nascimento = trim($_POST['data_nascimento']);
    $contato = trim($_POST['contato']);
    $contato_emergencia = trim($_POST['contato_emergencia']);
    $email = trim($_POST['email']);
    $endereco = trim($_POST['endereco']);
    $escolaridade = trim($_POST['escolaridade']);
    $ocupacao = trim($_POST['ocupacao']);
    $necessidade_especial = trim($_POST['necessidade_especial']);
    $estagiario_responsavel = (int) $_POST['estagiario_responsavel'];
    $orientador_responsavel = (int) $_POST['orientador_responsavel'];

    // Validação dos IDs de estagiário e orientador
    $estagiario_exists_query = "SELECT id_usuario FROM usuario WHERE id_usuario = ?";
    $stmt1 = $con->prepare($estagiario_exists_query);
    $stmt1->bind_param("i", $estagiario_responsavel);
    $stmt1->execute();
    $estagiario_exists = $stmt1->get_result()->num_rows > 0;

    $orientador_exists_query = "SELECT id_usuario FROM usuario WHERE id_usuario = ?";
    $stmt2 = $con->prepare($orientador_exists_query);
    $stmt2->bind_param("i", $orientador_responsavel);
    $stmt2->execute();
    $orientador_exists = $stmt2->get_result()->num_rows > 0;

    if (!$estagiario_exists) {
        echo "<script>alert('O ID do estagiário não existe no sistema. Verifique e tente novamente.');</script>";
    } elseif (!$orientador_exists) {
        echo "<script>alert('O ID do orientador não existe no sistema. Verifique e tente novamente.');</script>";
    } else {
        // Inserção no banco de dados
        $insert_query = "
            INSERT INTO paciente (
                nome, genero, data_nascimento, contato, contato_emergencia, 
                email, endereco, escolaridade, ocupacao, necessidade_especial, 
                estagiario_responsavel, orientador_responsavel
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
        $stmt3 = $con->prepare($insert_query);
        $stmt3->bind_param(
            "ssssssssssii",
            $nome, $genero, $data_nascimento, $contato, $contato_emergencia,
            $email, $endereco, $escolaridade, $ocupacao, $necessidade_especial,
            $estagiario_responsavel, $orientador_responsavel
        );

        if ($stmt3->execute()) {
            echo "<script>alert('Paciente cadastrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar o paciente. Verifique os dados e tente novamente.');</script>";
        }
    }
}
?>

<div class="content-box">
    <h1 id="title">Cadastro de Paciente</h1>
    <form action="#" method="POST" class="form">
        <div class="content-input">
            <!-- Dados do formulário -->
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="genero">Gênero:</label>
            <input type="text" id="genero" name="genero" maxlength="5" required>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label for="contato">Contato:</label>
            <input type="text" id="contato" name="contato" maxlength="15" required>

            <label for="contato_emergencia">Contato de Emergência:</label>
            <input type="text" id="contato_emergencia" name="contato_emergencia" maxlength="15" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" maxlength="50" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" maxlength="100" required>

            <label for="escolaridade">Escolaridade:</label>
            <input type="text" id="escolaridade" name="escolaridade" maxlength="20" required>

            <label for="ocupacao">Ocupação:</label>
            <input type="text" id="ocupacao" name="ocupacao" maxlength="25" required>

            <label for="necessidade_especial">Necessidade Especial:</label>
            <input type="text" id="necessidade_especial" name="necessidade_especial" maxlength="9">

            <label for="estagiario_responsavel">ID do Estagiário:</label>
            <input type="number" id="estagiario_responsavel" name="estagiario_responsavel" required>

            <label for="orientador_responsavel">ID do Orientador:</label>
            <input type="number" id="orientador_responsavel" name="orientador_responsavel" required>
        </div>
        <div class="send-data">
            <input type="submit" value="Cadastrar Paciente">
        </div>
    </form>
</div>
</body>
</html>

