<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f5f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .dashboard {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
    }
    h2 {
      color: #333;
    }
    a {
      display: block;
      margin-top: 20px;
      padding: 12px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 6px;
    }
    a:hover {
      background-color: #0056b3;
    }
    .logout {
      background-color: #dc3545;
    }
    .logout:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <h2>Bienvenido, <?= htmlspecialchars($_SESSION['nombre_usuario']) ?> 👋</h2>
    <a href="formulario.php">Registrar un Negocio</a>
    <a class="logout" href="logout.php">Cerrar Sesión</a>
  </div>
</body>
</html>