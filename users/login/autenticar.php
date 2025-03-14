<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //limpia datos de entrada (espacios)
  $correo = trim($_POST["correo"]);
  $contra = trim($_POST["contra"]);

  // verifica que los campos no esten vacios
  if (!empty($correo) && !empty($contra)) {

    $stmt = $conectar->prepare("SELECT contra FROM usuarios WHERE correo= ? LIMIT 1");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if (mysqli_num_rows($resultado) > 0) {
      $fila = $resultado->fetch_array();

      $contra_encriptada = $fila["contra"];

      if (password_verify($contra, $contra_encriptada)) {
        session_start();

        setcookie("tiempo_inicio", time(), time() + 1, "/");

        $_SESSION["username"] = $correo;
        $_SESSION["autenticado"] = "Si";
        header("Location: principal.php");
      } else {
        echo
        '<script>
            alert("contra incorrecta");
            location.href="index.php"
        </script>';
      }
    } else {
      echo
      '<script>
          alert("Correo incorrecto");
          location.href="index.php"
      </script>';
    }
  } else {
    echo
    '<script>
        alert("El usuario no existe");
        history.go(-1);
    </script>';
  }
} else {
  echo
    '<script>
        alert("llena los datos correspondientes");
        history.go(-1);
    </script>';
}

