<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Prontuário</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="content-box">
        <h2 id="title">Prontuário - Serviço Escola de Psicologia</h2>
        <form action="prontuario.php" method="POST" class="form">
            <div class="content-input">
                <div class="couple">
                    <div class="one">
                        <label>Início do Atendimento:</label>
                        <input type="date" name="data_abertura" required>
                    </div>
                    <div class="one">
                        <label>Nome Completo:</label>
                        <input type="text" name="nome_completo" required>
                    </div>
                </div>
                <div class="couple">
                    <div class="one">
                        <label>Data de Nascimento:</label>
                        <input type="date" name="data_nascimento" required>
                    </div>
                    <div class="one">
                        <label>Gênero:</label>
                        <select name="genero" required>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                </div>
                <div class="couple">
                    <div class="one">
                        <label>Endereço:</label>
                        <input type="text" name="endereco" required>
                    </div>
                    <div class="one">
                        <label>Telefone:</label>
                        <input type="text" name="telefone" required>
                    </div>
                </div>
                <div class="couple">
                    <div class="one">
                        <label>E-mail:</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="one">
                        <label>Forma de contato em emergência:</label>
                        <input type="text" name="contato_emergencia" required>
                    </div>
                </div>
                <div class="couple">
                    <div class="one">
                        <label>Escolaridade:</label>
                        <input type="text" name="escolaridade" required>
                    </div>
                    <div class="one">
                        <label>Ocupação:</label>
                        <input type="text" name="ocupacao" required>
                    </div>
                </div>
                <div class="checklist">
                    <label>Necessidades Especiais</label>
                    <input type="checkbox" name="necessidade_especial[]" value="Cognitiva"> Cognitiva
                    <input type="checkbox" name="necessidade_especial[]" value="Locomoção"> Locomoção
                    <input type="checkbox" name="necessidade_especial[]" value="Visão"> Visão
                    <input type="checkbox" name="necessidade_especial[]" value="Audição"> Audição
                    <input type="checkbox" name="necessidade_especial[]" value="Outras"> Outras
                </div>
                <div class="couple">
                    <div class="one">
                        <label>Estagiário(a):</label>
                        <input type="text" name="estagiario_responsavel" required>
                    </div>
                    <div class="one">
                        <label>Orientador(a):</label>
                        <input type="text" name="orientador_responsavel" required>
                    </div>
                </div>
                <div class="send-data">
                    <input type="submit" value="Salvar Prontuário">
                </div>
            </div>
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Corrigir caminho para o arquivo config.php
        $configPath = realpath('../config.php');
        if ($configPath && file_exists($configPath)) {
            include($configPath);
        } else {
            die("Erro: Não foi possível incluir o arquivo config.php.");
        }

        // Verificar conexão com o banco
        if (!isset($con)) {
            die("Erro: A conexão com o banco de dados não foi inicializada.");
        }

        // Obter os valores do formulário
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

        // Inserir dados no banco
        $query = "INSERT INTO prontuario (
                    data_abertura, nome_completo, data_nascimento, genero, endereco,
                    telefone, email, contato_emergencia, escolaridade, ocupacao,
                    necessidade_especial, estagiario_responsavel, orientador_responsavel
                  ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                  )";

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'sssssssssssss', $data_abertura, $nome_completo, $data_nascimento, $genero, $endereco, $telefone, $email, $contato_emergencia, $escolaridade, $ocupacao, $necessidade_especial, $estagiario_responsavel, $orientador_responsavel);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Prontuário salvo com sucesso!</p>";
        } else {
            echo "<p>Erro ao salvar prontuário: " . mysqli_error($con) . "</p>";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>

