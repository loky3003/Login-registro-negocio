<?php
// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conectar a la base de datos
$conexion = new mysqli("localhost:3306", "root", "", "desarrollo_web");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Validar datos
if (
    isset($_POST['nombre_usuario']) &&
    isset($_POST['correo']) &&
    isset($_POST['contraseña'])
) {
    $nombre = $_POST['nombre_usuario'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Encriptar

    // Verificar si el correo ya está registrado
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Este correo ya está registrado. <a href='registro.php'>Intentar otro</a>";
        $stmt->close();
        $conexion->close();
        exit;
    }
    $stmt->close();

    // Insertar nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $contraseña);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Todos los campos son obligatorios.";
}

$conexion->close();
?>