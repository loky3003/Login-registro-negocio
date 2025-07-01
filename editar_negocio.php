<?php
session_start();

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verifica que se reciba un ID válido por GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de negocio no especificado o inválido.";
    exit();
}

$id = (int) $_GET['id'];
$mensaje = "";

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "desarrollo_web");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Si el formulario se envía por POST, actualiza el registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conexion->prepare("
      UPDATE negocio 
      SET nombre = ?, categoria = ?, correo = ?, telefono = ?, descripcion = ?, experiencia = ?
      WHERE id = ?
    ");
    $stmt->bind_param(
        "ssssssi",
        $_POST['nombre'],
        $_POST['categoria'],
        $_POST['correo'],
        $_POST['telefono'],
        $_POST['descripcion'],
        $_POST['experiencia'],
        $id
    );

    if ($stmt->execute()) {
        header("Location: listar_negocio.php?actualizado=exito");
        exit();
    } else {
        $mensaje = "Error al actualizar: " . $stmt->error;
    }
    $stmt->close();
}

// Obtener los datos actuales del negocio
$stmt = $conexion->prepare("SELECT * FROM negocio WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$negocio = $resultado->fetch_assoc();
$stmt->close();
$conexion->close();

if (!$negocio) {
    echo "Negocio no encontrado.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Negocio</title>
  <style>
    body { font-family: Arial, sans-serif; background-color: #f4f8fc; }
    .container { max-width: 600px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; color: #333; }
    label { display: block; margin: 15px 0 5px; font-weight: bold; }
    input, select, textarea { width: 100%; padding: 10px; margin-bottom: 5px; border: 1px solid #ccc; border-radius: 6px; }
    .radio-group { margin-bottom: 10px; }
    .radio-group label { display: inline-block; margin-right: 15px; font-weight: normal; }
    button { background-color: #007bff; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; width: 100%; margin-top: 20px; }
    button:hover { background-color: #0056b3; }
    .mensaje-error { color: red; text-align: center; margin-top: 10px; }
    .volver { display: block; text-align: center; margin-top: 20px; color: #007bff; text-decoration: none; }
    .volver:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Editar Negocio</h2>

    <?php if ($mensaje): ?>
      <p class="mensaje-error"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="POST">
      <label for="nombre">Nombre del negocio</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($negocio['nombre']) ?>" required>

      <label for="categoria">Categoría</label>
      <select name="categoria">
        <option value="comida" <?= $negocio['categoria'] === 'comida' ? 'selected' : '' ?>>Comida</option>
        <option value="servicios" <?= $negocio['categoria'] === 'servicios' ? 'selected' : '' ?>>Servicios</option>
        <option value="arte" <?= $negocio['categoria'] === 'arte' ? 'selected' : '' ?>>Arte</option>
        <option value="tecnología" <?= $negocio['categoria'] === 'tecnología' ? 'selected' : '' ?>>Tecnología</option>
      </select>

      <label for="correo">Correo electrónico</label>
      <input type="email" name="correo" value="<?= htmlspecialchars($negocio['correo']) ?>" required>

      <label for="telefono">Teléfono</label>
      <input type="text" name="telefono" value="<?= htmlspecialchars($negocio['telefono']) ?>">

      <label for="descripcion">Descripción</label>
      <textarea name="descripcion" required><?= htmlspecialchars($negocio['descripcion']) ?></textarea>

      <label for="experiencia">Nivel de experiencia</label>
      <div class="radio-group">
        <label><input type="radio" name="experiencia" value="principiante" <?= $negocio['experiencia'] === 'principiante' ? 'checked' : '' ?>> Principiante</label>
        <label><input type="radio" name="experiencia" value="intermedio" <?= $negocio['experiencia'] === 'intermedio' ? 'checked' : '' ?>> Intermedio</label>
        <label><input type="radio" name="experiencia" value="experto" <?= $negocio['experiencia'] === 'experto' ? 'checked' : '' ?>> Experto</label>
      </div>

      <button type="submit">Guardar Cambios</button>
    </form>

    <a href="listar_negocio.php" class="volver">← Volver al listado</a>
  </div>
</body>
</html>