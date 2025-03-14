<?php
$host = "localhost";
$user = "root";
$pass = "";
$bd = "blog";

$conectar = mysqli_connect($host, $user, $pass, $bd);

if ($conectar->connect_error) {
  printf("Conexion a la BD fallida", $conectar->connect_error);
}
?>