<?php 
session_start(); 

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {
    header("Location: http://localhost/A3-Projeto-Psico/login/login-page.php"); 
    exit; 
} 
?> 