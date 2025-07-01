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
  <title>Registro de Negocio</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f8fc;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .radio-group {
      margin-bottom: 10px;
    }

    .radio-group label {
      display: inline-block;
      margin-right: 15px;
      font-weight: normal;
    }

    button, .logout-btn {
      background-color: #007bff;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      margin-top: 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
    }

    .logout-btn {
      background-color: #dc3545;
    }

    .logout-btn:hover {
      background-color: #c82333;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Registro de Negocio</h2>
    <form action="registrar_negocio.php" method="post">
      <label for="nombre">Nombre del negocio</label>
      <input type="text" name="nombre" required>

      <label for="categoria">Categoría</label>
      <select name="categoria" required>
        <option value="comida">Comida</option>
        <option value="servicios">Servicios</option>
        <option value="arte">Arte</option>
        <option value="tecnología">Tecnología</option>
      </select>

      <label for="correo">Correo electrónico</label>
      <input type="email" name="correo" required>

      <label for="telefono">Teléfono</label>
      <input type="text" name="telefono">

      <label for="descripcion">Descripción</label>
      <textarea name="descripcion" required></textarea>

      <label for="experiencia">Nivel de experiencia</label><br>
      <input type="radio" name="experiencia" value="principiante" required> Principiante<br>
      <input type="radio" name="experiencia" value="intermedio"> Intermedio<br>
      <input type="radio" name="experiencia" value="experto"> Experto<br>

      <button type="submit">Registrar</button>
    </form>
    <a href="logout.php" class="logout-btn">Cerrar sesión</a>
  </div>
</body>
</html>
