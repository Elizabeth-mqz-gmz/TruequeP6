<?php
//NotificacionesTodos.php
  include "funciones.php";

  $bd = conexion();
  checar_con($bd);

  $mensaje = validar($_POST["notificacion"],"",$bd);

  $bus = "SELECT id_usuario FROM usuario";
  $resp = mysqli_query($bd, $bus);

  while($usuario = mysqli_fetch_assoc($resp)){//obtener id dle usario para mandar la notificación
    $query = "INSERT INTO notificacion (id_usu_not, men_not) VALUES (".$usuario["id_usuario"].",'$mensaje')";
    mysqli_query($bd,$query);//guardar la notificacion en la base de datos
  }
  echo $query;
  mysqli_close($bd);
?>
