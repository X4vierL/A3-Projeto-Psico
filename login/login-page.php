<!DOCTYPE html>
<html lang="pt-br">

<?php 
include ('C:\xampp\htdocs\A3-Projeto-Psico\config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['user'] ?? '');
    $password = md5(trim($_POST['password'] ?? ''));

    if (@$_POST["button"] == "Cadastrar") {
        $login = trim($_POST['login'] ?? '');

        if (empty($user) || empty($login) || empty($password)) {
            echo "<script>alert('Todos os campos são obrigatórios!');</script>";
        } else {
            if (empty($_REQUEST["id_usuario"])) {
                $inserir = "INSERT INTO usuario (nome, login, senha, nivel) VALUES ('$user', '$login', '$password', 'USER')";
                $result_inserir = mysqli_query($con, $inserir);

                if ($result_inserir) {
                    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar o usuário!');</script>";
                }
            } else {
                $atualizar = "UPDATE usuario SET 
                    nome = '$user',
                    login = '$login',
                    senha = '$password'
                    WHERE id_usuario = '{$_REQUEST['id_usuario']}'";
                $result_atualizar = mysqli_query($con, $atualizar);

                if ($result_atualizar) {
                    echo "<script>alert('Registro atualizado com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao atualizar o registro!');</script>";
                }
            }
        }
    }

    if (isset($_POST["button"]) && $_POST["button"] == "Entrar") {
        $login = trim($_POST['user'] ?? '');
        $password = md5(trim($_POST['password'] ?? ''));

        if (empty($login) || empty($password)) {
            echo "<script>alert('Usuário e senha são obrigatórios!');</script>";
        } else {
            $login_query = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$password'";
            $result_login = mysqli_query($con, $login_query);

            if ($result_login && mysqli_num_rows($result_login) > 0) {
                $coluna = mysqli_fetch_array($result_login);
                $_SESSION["id_usuario"] = $coluna["id_usuario"];
                $_SESSION["nome_usuario"] = $coluna["nome"];
                $_SESSION["nivel_usuario"] = $coluna["nivel"];
                header("Location: http://localhost/A3-Projeto-Psico/main/main.php");
                exit;
            } else {
                echo "<script>alert('Usuário ou senha incorretos!');</script>";
            }
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>A3 - TravelBnB</title>
</head>
<body>
    <div class="scene">
        <div class="card container">
            <div class="card-face login-card">
                <div class="top-text-container">
                    <h1>Bem Vindo!</h1>
                    <p>Por gentileza, entre em sua conta.</p>
                </div>
                <form action="#" name="usuario" method="POST" class="form-login">
                    <label for="user" class="input-account">
                        <input type="text" name="user" id="user" placeholder="Usuário">
                        <i class="fa-solid fa-user"></i>
                    </label>
                    <label for="password" class="input-account">
                        <input type="password" name="password" id="password" placeholder="Senha">
                        <i class="fa-solid fa-lock"></i>
                    </label>
                    <input type="submit" value="Entrar" class="button-login" name="button">
                </form>
                <div class="bottom-text-container">
                    <p>Não tem conta? Clique abaixo <i class="fa-solid fa-arrow-down"></i></p>
                    <button class="button-register" id="buttom-register">Criar minha conta</button>
                </div>
            </div>
            <div class="card-face register-card">
                <div class="top-text-container">
                    <h1>Bem Vindo!</h1>
                    <p>Preencha os dados para criar sua conta nova.</p>
                </div>
                <form action="#" name="usuario" method="POST" class="form-register">
                    <label for="user" class="input-account">
                        <input type="text" name="user" id="user" placeholder="Usuário">
                        <i class="fa-solid fa-user"></i>
                    </label>
                    <label for="login" class="input-account">
                        <input type="text" name="login" id="login" placeholder="Login">
                        <i class="fa-solid fa-envelope"></i>
                    </label>
                    <label for="password" class="input-account">
                        <input type="password" name="password" id="password" placeholder="Senha">
                        <i class="fa-solid fa-lock"></i>
                    </label>
                    <input type="submit" value="Cadastrar" name="button" class="button-login">
                </form> 
                <div class="bottom-text-container">
                    <p>Já tem uma conta? Clique abaixo <i class="fa-solid fa-arrow-down"></i></p>
                    <button class="button-login-open" id="buttom-login">Já tenho conta!</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>
</html>
