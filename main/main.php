<!DOCTYPE html>
<html lang="pt-br">
<?php 
include('../verify.php'); 
include ('C:\xampp\htdocs\A3-Projeto-Psico\config.php');?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
