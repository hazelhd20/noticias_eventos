<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $correo = trim($_POST["correo"]);
  $contra = trim($_POST["contra"]);

  // Verifica que los campos no estén vacíos
  if (empty($correo) || empty($contra)) {
    header("Location: index.php?errorusuario=VACIO");
    exit;
  }

  $stmt = $conectar->prepare("SELECT contra FROM usuarios WHERE correo = ? LIMIT 1");
  $stmt->bind_param("s", $correo);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $contra_encriptada = $fila["contra"];

    if (password_verify($contra, $contra_encriptada)) {
      session_start();
      session_regenerate_id(true); // Evitar fijación de sesión

      $_SESSION["username"] = $correo;
      $_SESSION["autenticado"] = "Si";

      setcookie("tiempo_inicio", time(), time() + 3600, "/"); // 1 hora

      header("Location: principal.php");
      exit;
    }
  }
  // Si el usuario o la contraseña son incorrectos
  header("Location: index.php?errorusuario=SI");
  exit;

} else {
  // Si intentan acceder directamente sin enviar POST
  header("Location: index.php?errorusuario=NOPOST");
  exit;
}
