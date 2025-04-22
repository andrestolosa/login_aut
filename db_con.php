<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "login_aut";

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos '$database'";
?>
