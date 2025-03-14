<?php
require "conexion.php";

$id_usuario = $_POST['id_usuario'];
$nombre = addslashes($_POST['nombre']);
$apellido = addslashes($_POST['apellido']);
$correo = addslashes($_POST['correo']);
$contra = addslashes($_POST['contra']);
$nacimiento = addslashes($_POST['nacimiento']);

require "conexion.php";

$actualizar = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', correo = '$correo', contra = '$contra', nacimiento = '$nacimiento' WHERE id = '$id_usuario'";

$query = mysqli_query($conectar, $actualizar);

if ($query) {
    echo
    '<script>
        alert("Usuario actualizado correctamente.");
        location.href="ver_usuario.php?id='.$id_usuario.'"
    </script>';
} else {
    echo
    '<script>
        alert("Error al actualizar el usuario.");
        location.href="editar_usuario.php?id='.$id_usuario.'"
    </script>';
}

?>
