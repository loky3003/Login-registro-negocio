<?php
session_start();
$mensaje = "";

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $mensaje = "Has cerrado sesión correctamente. ¡Hasta pronto!";
}
if (isset($_GET['error']) && $_GET['error'] == 1) {
    $mensaje = "Correo o contraseña incorrectos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e9f0f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 350px;
      text-align: center;
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .mensaje {
      margin-top: 10px;
      font-size: 14px;
      color: #dc3545;
    }

    .mensaje.exito {
      color: green;
    }

    .link-registro {
      display: block;
      margin-top: 15px;
      text-decoration: none;
      color: #007bff;
    }

    .link-registro:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="validar_login.php" method="post">
      <input type="email" name="correo" placeholder="Correo electrónico" required>
      <input type="password" name="contraseña" placeholder="Contraseña" required>
      <button type="submit">Ingresar</button>
    </form>

    <?php if (!empty($mensaje)): ?>
      <div class="mensaje <?= (isset($_GET['logout'])) ? 'exito' : '' ?>">
        <?= htmlspecialchars($mensaje) ?>
      </div>
    <?php endif; ?>

    <a class="link-registro" href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
  </div>
</body>
</html>