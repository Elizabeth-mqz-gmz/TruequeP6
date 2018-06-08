<?php
  include "funciones.php";
  $db = conexion();
  checar_con($db);
  //Datos que se definen para la búsqueda
  $pers = "[";
  $busq = "SELECT id_usuario,nomus FROM usuario;"; //Tomar todos los chats en dónde aparezca el usuario
  $resp = mysqli_query($db,$busq);
  while($row = mysqli_fetch_assoc($resp)){ //Ir seleccionando el nombre de usuario de las personas con las que ha chateado
    $pers .= '{"usuario":"'.$row["id_usuario"].'","nomus":"'.$row["nomus"].'"},'; // //Concatenar el json
  }
  $pers[strlen($pers)-1]="]";
  echo $pers;
?>
