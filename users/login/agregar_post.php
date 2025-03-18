<?php
require "conexion.php";

$nombre_noticia = $_POST['nombre_noticia'];
$fecha_noticia = $_POST['fecha_noticia'];
$descripcion_corta = $_POST['descripcion_corta'];
$descripcion_larga = $_POST['editor1'];

$nombre_imagen = $_FILES['foto_noticia']['name'];
$peso_foto = $_FILES['foto_noticia']['size'];
$tipo_foto = $_FILES['foto_noticia']['type'];


// Datos de la foto
$ruta_servidor = 'fotos';

$ruta_temporal = $_FILES['foto_noticia']['tmp_name'];

// Para que no se sobreescriban los nombres de las fotos
date_default_timezone_set('UTC');
$nombre_imagen_unico = date("Y-m-d-H-m-s") . "-" .  $nombre_imagen;

$ruta_destino = $ruta_servidor . "/" . $nombre_imagen_unico;

if ($tipo_foto == "image/jpeg" or $tipo_foto == "image/png" or $tipo_foto == "image/gif" or $tipo_foto == "image/jpg" or $nombre_imagen == "") {
  if (!move_uploaded_file($ruta_temporal, $ruta_destino)) {
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

if ($peso_foto > 999999) {
  echo
  '<script>
      alert("Es demasiado pesada la foto para el post");
      window.history.go(-1);
  </script>';
  exit();
}

$insertar = "INSERT INTO noticias(nombre_noticia, fecha_noticia, descripcion_corta, descripcion_larga, 	ruta_foto) VALUES ('$nombre_noticia', '$fecha_noticia', '$descripcion_corta', '$descripcion_larga', '$ruta_destino')";

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
