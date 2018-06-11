<?php
  include "funciones.php";
  $db = conexion();
  checar_con($db);
  //Datos que se definen para la búsqueda
  $pers = "[";
  $busq = "SELECT id_usuario,nomus FROM usuario;"; //Tomar todos los usuarios registrados
  $resp = mysqli_query($db,$busq);
  while($row = mysqli_fetch_assoc($resp)){ //Ir seleccionando el nombre de usuario de las personas registardos
    if ( dame_cookie() == $row["id_usuario"] )
      $pers .= '{"usuario":"usuarioOf","nomus":"'.$row["nomus"].'"},'; // //Concatenar el json
    else
      $pers .= '{"usuario":"'.$row["id_usuario"].'","nomus":"'.$row["nomus"].'"},'; // //Concatenar el json
  }
  if ($pers != "["){
      $pers[strlen($pers)-1]="]"; //Poner el corchete del final en ves de la coma
      echo $pers;
  }
  else
    echo "null";

?>
