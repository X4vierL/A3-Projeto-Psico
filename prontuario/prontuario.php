<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Prontuário</title>
</head>
<body>
    <h2>Prontuário - Serviço Escola de Psicologia</h2>
    <form action="prontuario.php" method="POST">
        <label>Data de Abertura/Início dos Atendimentos:</label>
        <input type="date" name="data_abertura" required><br><br>

        <label>Nome Completo:</label>
        <input type="text" name="nome_completo" required><br><br>

        <label>Data de Nascimento:</label>
        <input type="date" name="data_nascimento" required><br><br>

        <label>Gênero:</label>
        <select name="genero" required>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
            <option value="Outro">Outro</option>
        </select><br><br>

        <label>Endereço:</label>
        <input type="text" name="endereco" required><br><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" required><br><br>

        <label>E-mail:</label>
        <input type="email" name="email" required><br><br>

        <label>Nome e Telefone de Contatos em Caso de Emergência:</label>
        <input type="text" name="contato_emergencia" required><br><br>

        <label>Escolaridade:</label>
        <input type="text" name="escolaridade" required><br><br>

        <label>Ocupação:</label>
        <input type="text" name="ocupacao" required><br><br>

        <label>Necessidade Especial:</label><br>
        <input type="checkbox" name="necessidade_especial[]" value="Cognitiva"> Cognitiva
        <input type="checkbox" name="necessidade_especial[]" value="Locomoção"> Locomoção
        <input type="checkbox" name="necessidade_especial[]" value="Visão"> Visão
        <input type="checkbox" name="necessidade_especial[]" value="Audição"> Audição
        <input type="checkbox" name="necessidade_especial[]" value="Outras"> Outras<br><br>

        <label>Estagiário(a):</label>
        <input type="text" name="estagiario_responsavel" required><br><br>

        <label>Orientador(a):</label>
        <input type="text" name="orientador_responsavel" required><br><br>

        <input type="submit" value="Salvar Prontuário">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('config.php');  // Inclua o arquivo de conexão com o banco de dados

        $data_abertura = $_POST['data_abertura'];
        $nome_completo = $_POST['nome_completo'];
        $data_nascimento = $_POST['data_nascimento'];
        $genero = $_POST['genero'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $contato_emergencia = $_POST['contato_emergencia'];
        $escolaridade = $_POST['escolaridade'];
        $ocupacao = $_POST['ocupacao'];
        $necessidade_especial = implode(', ', $_POST['necessidade_especial'] ?? []);
        $estagiario_responsavel = $_POST['estagiario_responsavel'];
        $orientador_responsavel = $_POST['orientador_responsavel'];

        $query = "INSERT INTO prontuario (
                    data_abertura, nome_completo, data_nascimento, genero, endereco,
                    telefone, email, contato_emergencia, escolaridade, ocupacao,
                    necessidade_especial, estagiario_responsavel, orientador_responsavel
                  ) VALUES (
                    '$data_abertura', '$nome_completo', '$data_nascimento', '$genero', '$endereco',
                    '$telefone', '$email', '$contato_emergencia', '$escolaridade', '$ocupacao',
                    '$necessidade_especial', '$estagiario_responsavel', '$orientador_responsavel'
                  )";

        if (mysqli_query($con, $query)) {
            echo "<p>Prontuário salvo com sucesso!</p>";
        } else {
            echo "<p>Erro ao salvar prontuário: " . mysqli_error($con) . "</p>";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>
