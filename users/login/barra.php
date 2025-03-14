<?php
$usuario = $_SESSION['username'];
?>
<div class="barra">
  <div class="logo_barra">
    <img src="imagenes/logo.png" alt="logo tec">
    <h4 class="correo_usuario">
      <?php echo $usuario; ?>
    </h4>
  </div>
  <ul>
    <li><a href="principal.php"><i class="fas fa-home"></i>Inicio</a></li>
    <li><a href="usuarios.php"><i class="fas fa-users"></i>Usuarios</a></li>
    <li><a href="posts.php"><i class="fas fa-book-open"></i>Posts</a></li>
    <li><a href="#"><i class="fas fa-user-tie"></i>Opcion 4</a></li>
    <li><a href="#"><i class="fas fa-file-signature"></i>Opcion 5</a></li>
  </ul>
  <div class="btn_salir">
    <a class="rojo" href="salir.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
  </div>
</div>