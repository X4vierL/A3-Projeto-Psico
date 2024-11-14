<?php

session_start();
session_unset();
session_destroy();

echo "<script>alert('Você saiu!');top.location.href='http://localhost/A3-Projeto-Psico/main/main.php';</script>";
?>