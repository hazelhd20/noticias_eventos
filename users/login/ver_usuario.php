<?php
require 'seguridad.php';
require 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php include 'barra.php'; ?>
    <div class="contenido1">
      <h2 class="centrar mb16"><i class='fas fa-eye'></i> Ver usuario</h2>
      <div class="contenedor_cuadros form">
        <?php
        require "conexion.php";

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
          $id_usuario = mysqli_real_escape_string($conectar, $_GET['id']);

          $verusuario = "SELECT nombre, apellido, correo, contra, nacimiento FROM usuarios WHERE id = '$id_usuario'";
          $resultado = mysqli_query($conectar, $verusuario);

          if ($fila = $resultado->fetch_assoc()) {
        ?>
            <div class="info_usuario">
              <p><strong>Nombre del usuario:</strong></p>
              <p><?php echo htmlspecialchars($fila["nombre"] . " " . $fila["apellido"]); ?></p>
              <hr>
              <p><strong>Correo:</strong></p>
              <p><?php echo htmlspecialchars($fila["correo"]); ?></p>
              <hr>
              <p><strong>Contraseña:</strong></p>
              <p><?php echo htmlspecialchars($fila["contra"]); ?></p>
              <hr>
              <p><strong>Fecha de Nacimiento:</strong></p>
              <p><?php echo htmlspecialchars($fila["nacimiento"]); ?></p>
              <hr>
            </div>

        <?php
          } else {
            echo "<p>No se encontró el usuario.</p>";
          }
        } else {
          echo "<p>ID de usuario no válido.</p>";
        }
        ?>
      </div>
      <a href="lista_usuarios.php" class="boton_circular">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
  </div>
</body>

</html>