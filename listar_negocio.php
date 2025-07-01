<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "desarrollo_web");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$resultado = $conexion->query("
  SELECT id, nombre, categoria, correo, telefono 
  FROM negocio
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Negocios</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef1f6;
      margin: 0;
      padding: 20px;
    }
    .container {
      background-color: #fff;
      max-width: 900px;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .top-links {
      text-align: center;
      margin-bottom: 20px;
    }
    .top-links a {
      display: inline-block;
      margin: 0 10px;
      padding: 10px 15px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 6px;
    }
    .top-links a.btn-delete {
      background-color: #dc3545;
    }
    .top-links a:hover {
      opacity: 0.9;
    }
    .mensaje {
      color: green;
      font-weight: bold;
      text-align: center;
      margin-bottom: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #007bff;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    a.action {
      margin-right: 8px;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 4px;
      color: white;
    }
    a.edit { background-color: #28a745; }
    a.delete { background-color: #dc3545; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Listado de Negocios</h2>

    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'exito'): ?>
      <div class="mensaje">Negocio registrado con éxito.</div>
    <?php endif; ?>
    <?php if (isset($_GET['actualizado']) && $_GET['actualizado'] === 'exito'): ?>
      <div class="mensaje">Negocio actualizado correctamente.</div>
    <?php endif; ?>
    <?php if (isset($_GET['eliminado']) && $_GET['eliminado'] === 'exito'): ?>
      <div class="mensaje">Negocio eliminado correctamente.</div>
    <?php endif; ?>

    <div class="top-links">
      <a href="formulario.php">Registrar Nuevo Negocio</a>
      <a href="dashboard.php">Volver al Dashboard</a>
      <a href="logout.php" class="btn-delete">Cerrar Sesión</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= htmlspecialchars($fila['nombre']) ?></td>
            <td><?= htmlspecialchars($fila['categoria']) ?></td>
            <td><?= htmlspecialchars($fila['correo']) ?></td>
            <td><?= htmlspecialchars($fila['telefono']) ?></td>
            <td>
              <a href="editar_negocio.php?id=<?= $fila['id'] ?>" class="action edit">Editar</a>
              <a href="eliminar_negocio.php?id=<?= $fila['id'] ?>"
                 class="action delete"
                 onclick="return confirm('¿Estás seguro de eliminar este negocio?')">
                Eliminar
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
<?php $conexion->close(); ?>