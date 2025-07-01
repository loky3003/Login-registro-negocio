<?php
session_start();
// 1. Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "desarrollo_web");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// 3. Verificar y sanear el ID recibido
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $id = (int) $_GET['id'];

    // 4. Preparar y ejecutar DELETE
    $stmt = $conexion->prepare("DELETE FROM negocio WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conexion->close();
        // 5. Redirigir al listado singular con mensaje
        header("Location: listar_negocio.php?eliminado=exito");
        exit();
    } else {
        // Manejo de error en ejecución
        echo "Error al eliminar: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conexion->close();
} else {
    // ID no válido o no enviado
    $conexion->close();
    header("Location: listar_negocio.php");
    exit();
}
?>