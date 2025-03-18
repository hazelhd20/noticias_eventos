<?php
require 'seguridad.php';
require "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver usuarios</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php
    include 'barra.php';
    ?>
    <div class="contenido2">
      <h2 class="centrar">Crear post</h2>
      <?php
      include 'botones_posts.php';
      ?>

      <?php
      // Realizamos la consulta a la base de datos
      $datos = "SELECT * FROM noticias ORDER BY id_noticia ASC";
      $resultado = mysqli_query($conectar, $datos);
      ?>

      <?php
      if (mysqli_num_rows($resultado) > 0):
      ?>
        <table>
          <thead>
            <tr>
              <th class='centrar'>ID</th>
              <th>Foto noticia</th>
              <th>Titulo</th>
              <th>Fecha</th>
              <th class='centrar'>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($fila = mysqli_fetch_assoc($resultado)):
            ?>
              <tr>
                <td class='centrar'><?= $fila['id_noticia'] ?></td>
                <td class='centrar ancho_foto'><img src='<?= $fila['ruta_foto'] ?>' alt='<?= $fila['nombre_noticia'] ?>'></td>
                <td class='ancho_nombre'><?= $fila['nombre_noticia'] ?></td>
                <td><?= $fila['fecha_noticia'] ?></td>
                <td class='centrar'>
                  <a href='eliminar_post.php?id=<?= $fila['id_noticia'] ?>' onclick='return confirmarEliminar();' class='eliminar'><i class='fas fa-trash'></i></a>
                  <a href='editar_post.php?id=<?= $fila['id_noticia'] ?>' class='editar'><i class='fas fa-edit'></i></a>
                  <a href='ver_post.php?id=<?= $fila['id_noticia'] ?>' class='ver'><i class='fas fa-eye'></i></a>
                </td>
              </tr>
            <?php
            endwhile;
            ?>
          </tbody>
        </table>
      <?php
      else:
      ?>
        <p class='no-datos'>No hay datos disponibles.</p>
      <?php
      endif;
      ?>

    </div>
  </div>
</body>

</html>

<script>
  function confirmarEliminar() {
    return confirm("¿Estás seguro de que deseas eliminar esta noticia?");
  }
</script>
