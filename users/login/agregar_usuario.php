<?php
require "conexion.php";

$nombre = addslashes($_POST['nombre']);
$apellido = addslashes($_POST['apellido']);
$correo = addslashes($_POST['correo']);
$contra = addslashes($_POST['contra']);
$nacimiento = addslashes($_POST['nacimiento']);
$formulario = $_POST['formulario']; // Captura el origen del formulario

$contra_encriptada = password_hash($contra, PASSWORD_DEFAULT);

$comparar = "SELECT * FROM usuarios WHERE correo = '$correo'";
$verificar_usuario = mysqli_query($conectar, $comparar);

if (mysqli_num_rows($verificar_usuario) > 0) {
  echo "<script>
  alert('El correo ingresado ya está registrado.');
  history.go(-1);
  </script>";
  exit();
} else {
  $insertar_datos = "INSERT INTO usuarios (nombre, apellido, correo, contra, nacimiento) VALUES ('$nombre', '$apellido', '$correo', '$contra_encriptada', '$nacimiento')";
  $query = mysqli_query($conectar, $insertar_datos);

  if ($query) {
    echo "<script>
    alert('Los datos han sido guardados correctamente.');
    location.href = '". ($formulario == "interno" ? "usuarios.php" : "index.php") ."';
    </script>";
  } else {
    echo "<script>
    alert('Error al guardar los datos.');
    history.go(-1);
    </script>";
  }
}
?>
