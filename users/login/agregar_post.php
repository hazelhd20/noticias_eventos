<?php
require "conexion.php";

$nombreNoticia = $_POST['nombreNoticia'];
$fechaNoticia = $_POST['fechaNoticia'];
$descripcionCorta = $_POST['descripcionCorta'];
$descripcionLarga = $_POST['editor1'];

$nombreImagen = $_FILES['fotoNoticia']['name'];
$pesoFoto = $_FILES['fotoNoticia']['size'];
$tipoFoto = $_FILES['fotoNoticia']['type'];


// Datos de la foto
$rutaServidor = 'fotos';

$rutaTemporal = $_FILES['fotoNoticia']['tmp_name'];

// Para que no se sobreescriban los nombres de las fotos
date_default_timezone_set('UTC');
$nombreImagenUnico = date("Y-m-d-H-m-s") . "-" .  $nombreImagen;

$rutaDestino = $rutaServidor . "/" . $nombreImagenUnico;

if ($pesoFoto > 999999) {
  echo
  '<script>
      alert("Es demasiado pesada la foto para el post");
      window.history.go(-1);
  </script>';
  exit();
}

if ($tipoFoto == "image/jpeg" or $tipoFoto == "image/png" or $tipoFoto == "image/gif" or $tipoFoto == "image/jpg" or $nombreImagen == "") {
  if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
    $error = error_get_last();
    echo "Error al mover el archivo: " . $error['message'];
    exit();
  }

} else {
  echo
  '<script>
      alert("No es una imagen");
      window.history.go(-1);
  </script>';
  exit();
}

$insertar = "INSERT INTO noticias(nombreNoticia, fechaNoticia, descripcionCorta, descripcionLarga, 	rutaFoto) VALUES ('$nombreNoticia', '$fechaNoticia', '$descripcionCorta', '$descripcionLarga', '$rutaDestino')";

$query = mysqli_query($conectar, $insertar);

if ($query) {
  echo
  '<script>
      alert("El post se guardo correctamente");
      location.href="lista_posts.php"
  </script>';
} else {
  echo
  '<script>
      alert("El post no se guardo");
      location.href="posts.php"
  </script>';
}
