<?php
include 'db_con.php';

$user = $_POST['user'] ?? '';
$pass = $_POST['user_pass'] ?? '';

$query = "SELECT * FROM logs WHERE user = ? AND user_pass = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    session_start();
    $_SESSION['user'] = $user;
    header("Location: welcome.php");
    exit;
} else {
    echo "<script>alert('Usuario no existe! Regístrese!'); window.location.href='register.php';</script>";
}
?>
