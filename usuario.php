<?php
// Importar la conexión
require 'includes/app.php';
$db = conectarDB();

// Crear email y contraseña
$email = "correo@correo.com";
$password = "1234567";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Crear usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

// Agregar a la base de datos
mysqli_query($db, $query);
