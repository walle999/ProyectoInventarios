<?php
session_start();
include('con_db.php');
//verifica si cierra sesión
if (isset($_POST['logout'])) {
    $query = $connection->prepare("UPDATE usuarios SET logged =0 WHERE usuario=:usuario");
    $query->bindParam("usuario", $_SESSION["user_name"], PDO::PARAM_STR);
    $query->execute();
  session_destroy();
  header("Location:index.php");
  die();
} else {
  // Show users the page!
}
?>