<?php
include('config.php'); 

$nome = 'Xavier';
$login = 'xavier@gmail';
$password = '123'; 
$nivel = 'ADM';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO usuario (nome, login, senha, nivel) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($query);
$stmt->bind_param("ssss", $nome, $login, $hashed_password, $nivel);

if ($stmt->execute()) {
    echo "ADM adicionado.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
