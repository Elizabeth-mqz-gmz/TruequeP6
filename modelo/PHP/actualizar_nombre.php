<?php
//actualizar_nombre.php
  include "funciones.php";
  $bd = conexion();
  checar_con($bd);
  $nombre = validar ($_POST["usuario"], "/[A-Za-z\d]{6,30}$/", $bd);
  if ($nombre != false){
    $usuario = dame_cookie();
    $bus = "UPDATE usuario SET nomus = '$nombre' WHERE id_usuario = $usuario";
    mysqli_query($bd, $bus);
    echo "T";
  }
  else
    echo "F";

  mysli_close($bd);
?>
