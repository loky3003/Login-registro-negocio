<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli("localhost", "root", "", "desarrollo_web");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (
    isset($_POST['nombre'], $_POST['categoria'], $_POST['correo'],
          $_POST['telefono'], $_POST['descripcion'], $_POST['experiencia'])
) {
    $stmt = $conexion->prepare("
      INSERT INTO negocio 
      (nombre, categoria, correo, telefono, descripcion, experiencia)
      VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "ssssss",
        $_POST['nombre'],
        $_POST['categoria'],
        $_POST['correo'],
        $_POST['telefono'],
        $_POST['descripcion'],
        $_POST['experiencia']
    );
    if ($stmt->execute()) {
        // Aquí redirigimos al archivo singular
        header("Location: listar_negocio.php?registro=exito");
        exit;
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Faltan campos obligatorios.";
}
$conexion->close();
?>
