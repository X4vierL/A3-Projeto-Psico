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
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $contato = $_POST['contato'];
    $contato_emergencia = $_POST['contato_emergencia'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $escolaridade = $_POST['escolaridade'];
    $ocupacao = $_POST['ocupacao'];
    $necessidade_especial = $_POST['necessidade_especial'];
    $estagiario_responsavel = $_POST['estagiario_responsavel'];
    $orientador_responsavel = $_POST['orientador_responsavel'];

    // Inserção no banco de dados
    $query = "INSERT INTO paciente (
        nome, genero, data_nascimento, contato, contato_emergencia, 
        email, endereco, escolaridade, ocupacao, necessidade_especial, 
        estagiario_responsavel, orientador_responsavel
    ) VALUES (
        '$nome', '$genero', '$data_nascimento', '$contato', '$contato_emergencia', 
        '$email', '$endereco', '$escolaridade', '$ocupacao', '$necessidade_especial', 
        $estagiario_responsavel, $orientador_responsavel
    )";

    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Paciente cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar o paciente!');</script>";
    }
}
?>
<div class="content-box">
<h1 id="title">Cadastro de Paciente</h1>
<form action="#" method="POST" class="form">
    <div class="content-input">
        <div class="couple">
            <div class="one">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="one">
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" maxlength="5" required>
            </div>
        </div>

        <div class="couple">
            <div class="one">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>
            <div class="one">
                <label for="contato">Contato:</label>
                <input type="text" id="contato" name="contato" maxlength="15" required>
            </div>
        </div>

        <div class="couple">
            <div class="one">
                <label for="contato_emergencia">Contato de Emergência:</label>
                <input type="text" id="contato_emergencia" name="contato_emergencia" maxlength="15" required>
            </div>
            <div class="one">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" maxlength="50" required>
            </div>
        </div>

        <div class="couple">
            <div class="one">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" maxlength="100" required>
            </div>

            <div class="one">
                <label for="escolaridade">Escolaridade:</label>
                <input type="text" id="escolaridade" name="escolaridade" maxlength="20" required>
            </div>
        </div>

        <div class="couple">
            <div class="one">
                <label for="ocupacao">Ocupação:</label>
                <input type="text" id="ocupacao" name="ocupacao" maxlength="25" required>
            </div>
            <div class="one">
                <label for="necessidade_especial">Necessidade Especial:</label>
                <input type="text" id="necessidade_especial" name="necessidade_especial" maxlength="9">
            </div>
        </div>

        <div class="couple">
            <div class="one">
                <label for="estagiario_responsavel">ID do Estagiário:</label>
                <input type="number" id="estagiario_responsavel" name="estagiario_responsavel" required>
            </div>

            <div class="one">
                <label for="orientador_responsavel">ID do Orientador:</label>
                <input type="number" id="orientador_responsavel" name="orientador_responsavel" required>
            </div>
        </div>
    </div>
    <div class="send-data">
        <input type="submit" value="Cadastrar Paciente">
    </div>
</form>
</div>
</body>
</html>
