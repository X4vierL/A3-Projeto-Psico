<!DOCTYPE html>
<html lang="pt-br">
<?php 
include('../verify.php'); 
include ('C:\xampp\htdocs\A3-Projeto-Psico\config.php');?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo <?php echo $_SESSION["nome_usuario"]?></h1>

        <div class="link-container">
            <a href="../pacientes_lst/pacientes_lst.php" class="link-button">Pacientes</a>
            <a href="../prontuario/prontuario.php" class="link-button">Prontuário</a>
            <a href="../logout.php" class="link-button logout-button">Logout</a>
        </div>
    </div>
</body>
</html>
