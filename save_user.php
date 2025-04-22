<?php
include 'db_con.php';

$user = $_POST['user'] ?? '';
$pass = $_POST['user_pass'] ?? '';

// Validar si el usuario ya existe
$check = $conn->prepare("SELECT * FROM logs WHERE user = ?");
$check->bind_param("s", $user);
$check->execute();
$checkResult = $check->get_result();

if ($checkResult->num_rows > 0) {
    echo "<script>alert('El usuario ya está registrado'); window.location.href='index.php';</script>";
    exit;
}

// Insertar usuario nuevo
$stmt = $conn->prepare("INSERT INTO logs (user, user_pass) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();

echo "<script>alert('Usuario registrado correctamente. Inicie sesión.'); window.location.href='index.php';</script>";
?>
