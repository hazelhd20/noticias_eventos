<?php
require 'seguridad.php';
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
    <div class="contenido2">
      <h2 class="centrar mb16"><i class='fas fa-edit'></i> Editar usuario</h2>
      <?php
      require "conexion.php";
      $id_usuario = $_GET['id'];

      $verusuario = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
      $resultado = mysqli_query($conectar, $verusuario);
      $fila = $resultado->fetch_array();
      ?>
      <form action="actualizar_usuario.php" method="post" id="frmEditar" class="form">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

        <div class="fila">
          <div class="columna">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
          </div>
          <div class="columna">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $fila['apellido']; ?>" required>
          </div>
        </div>

        <div class="fila">
          <div class="columna">
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" disabled value="<?php echo $fila['correo']; ?>" required>
          </div>
          <div class="columna">
            <label for="contra">Contraseña:</label>
            <input type="password" id="contra" name="contra" disabled maxlength="10" value="<?php echo $fila['contra']; ?>" required>
          </div>
        </div>

        <div class="fila">
          <div class="columna">
            <label for="nacimiento">Fecha de nacimiento</label>
            <input type="date" id="nacimiento" name="nacimiento" value="<?php echo $fila['nacimiento']; ?>" required>
            <input type="hidden" name="id_usuario" value="<?php echo $fila['id']; ?>">
            <input type="hidden" name="correo" value="<?php echo $fila['correo']; ?>">
          </div>
        </div>

        <button class="boton gris" id="btn_validar" type="button">Actualizar usuario</button>
      </form>
      <a href="lista_usuarios.php" class="boton_circular">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
  </div>
</body>

</html>

<script>
  document.getElementById("btn_validar").addEventListener("click", function(event) {
    event.preventDefault();

    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const correo = document.getElementById("correo");
    const contra = document.getElementById("contra");
    const nacimiento = document.getElementById("nacimiento");

    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function verificarCampo(campo, mensaje) {
      if (campo.value.trim() === "") {
        alert(mensaje);
        campo.focus();
        return true;
      }
      return false;
    }

    if (verificarCampo(nombre, "Por favor, introduzca su nombre.")) return;
    if (verificarCampo(apellido, "Por favor, introduzca su apellido.")) return;
    if (verificarCampo(correo, "Por favor, introduzca un correo.")) return;
    if (verificarCampo(contra, "Por favor, introduzca una contraseña.")) return;
    if (!correoRegex.test(correo.value.trim())) {
      alert("Por favor, introduzca un correo válido.");
      correo.focus();
      return;
    }
    if (verificarCampo(nacimiento, "Por favor, seleccione su fecha de nacimiento.")) return;

    document.getElementById("frmEditar").submit();
  });
</script>