<?php

session_start();
if (isset($_SESSION["autenticado"]) == "Si") { {
    header("Location: principal.php");
  }
}

?>
