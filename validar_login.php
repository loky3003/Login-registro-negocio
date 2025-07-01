<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli("localhost", "root", "", "desarrollo_web");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_POST['correo'], $_POST['contraseña'])) {
    $correo = trim($_POST['correo']);
    $contraseña = $_POST['contraseña'];

    $stmt = $conexion->prepare("
      SELECT id, nombre_usuario, contraseña 
      FROM usuarios 
      WHERE correo = ?
    ");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['usuario_id']    = $usuario['id'];
            $_SESSION['nombre_usuario']= $usuario['nombre_usuario'];
            header("Location: dashboard.php");
            exit;
        }
    }
    header("Location: login.php?error=1");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>