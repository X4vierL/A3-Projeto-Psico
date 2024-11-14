<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1>Cadastro de Paciente</h1>

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

<form action="" method="POST">
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

    <label for="estagiario_responsavel">ID do Estagiário Responsável:</label>
    <input type="number" id="estagiario_responsavel" name="estagiario_responsavel" required>

    <label for="orientador_responsavel">ID do Orientador Responsável:</label>
    <input type="number" id="orientador_responsavel" name="orientador_responsavel" required>

    <input type="submit" value="Cadastrar Paciente">
</form>

</body>
</html>
