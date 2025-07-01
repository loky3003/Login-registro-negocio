<!-- registro.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #eef2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .registro-container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
    }

    .login-link a {
      color: #007bff;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="registro-container">
    <h2>Registro de Usuario</h2>

    <form action="guardar_usuario.php" method="post">
      <label for="nombre_usuario">Nombre de usuario:</label>
      <input type="text" name="nombre_usuario" id="nombre_usuario" required>

      <label for="correo">Correo electrónico:</label>
      <input type="email" name="correo" id="correo" required>

      <label for="contraseña">Contraseña:</label>
      <input type="password" name="contraseña" id="contraseña" required>

      <button type="submit">Registrarme</button>
    </form>

    <div class="login-link">
      <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>
  </div>

</body>
</html>