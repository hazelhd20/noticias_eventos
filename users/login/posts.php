<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <script src="ckeditor/ckeditor.js"></script>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php
    include 'barra.php';
    ?>
    <div class="contenido2">
      <h2 class="centrar">Agregar posts</h2>
      <?php include 'botones_posts.php' ?>
      <form action="agregar_post.php" method="post" enctype="multipart/form-data" id="frmPost" class="form">
        <div class="fila">
          <div class="columna">
            <label for="nombre_noticia">Nombre de la noticia:</label>
            <input type="text" id="nombre_noticia" name="nombre_noticia" placeholder="Introduzca el nombre de la noticia">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="fecha_noticia">Fecha de la noticia</label>
            <input type="date" id="fecha_noticia" name="fecha_noticia">
          </div>
          <div class="columna">
            <label for="foto_noticia">Imagen de la noticia:</label>
            <input type="file" id="foto_noticia" name="foto_noticia">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="descripcion_corta">Descripcion corta de la noticia:</label>
            <input type="text" id="descripcion_corta" name="descripcion_corta" placeholder="Introduzca una descripcion corta de la noticia">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="editor1">Descripcion larga de la noticia:</label>
            <textarea class="texto_largo" name="editor1" id="editor1"></textarea>
            <script>
              CKEDITOR.replace('editor1');
            </script>
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="button">Guardar noticia</button>
      </form>
    </div>
  </div>
</body>

</html>

<script>
  document.getElementById("btn_validar").addEventListener("click", function(event) {
    event.preventDefault(); // Evita el envío por defecto

    // Obtener los valores de los campos
    const nombre_noticia = document.getElementById("nombre_noticia");
    const fecha_noticia = document.getElementById("fecha_noticia");
    const foto_noticia = document.querySelector("input[type='file']");
    const descripcion_corta = document.getElementById("descripcion_corta");
    const descripcionLarga = CKEDITOR.instances.editor1.getData().trim();

    // Expresión regular para validar formatos de imagen permitidos
    //const imagenRegex = /\.(jpg|jpeg|png)$/i;

    // Función para verificar si un campo está vacío
    function verificarCampo(campo, mensaje) {
      if (campo.value.trim() === "") {
        alert(mensaje);
        campo.focus();
        return true;
      }
      return false;
    }

    // Validaciones
    if (verificarCampo(nombre_noticia, "Por favor, introduzca el nombre de la noticia.")) return;
    if (verificarCampo(fecha_noticia, "Por favor, seleccione la fecha de la noticia.")) return;
    if (foto_noticia.files.length === 0) {
      alert("Por favor, seleccione una imagen para la noticia.");
      return;
    }
    //if (!imagenRegex.test(foto_noticia.files[0].name)) {
    //  alert("Por favor, suba una imagen válida en formato JPG, JPEG o PNG.");
    //  return;
    //}
    if (verificarCampo(descripcion_corta, "Por favor, introduzca una descripción corta.")) return;
    if (descripcionLarga === "") {
      alert("Por favor, introduzca una descripción larga.");
      return;
    }

    // Si todo es correcto, se envía el formulario
    document.getElementById("frmPost").submit();
  });
</script>
