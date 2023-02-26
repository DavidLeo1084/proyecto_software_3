<?php
// Importar la conexión
// require 'includes/config/database.php';
require 'includes/app.php';
$db = conectarDB();

// Crear email y contraseña
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Crear usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

// Agregar a la base de datos
mysqli_query($db, $query);
