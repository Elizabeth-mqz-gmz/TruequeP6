<?php
  include "funciones.php";
  $bd = mysqli_connect("localhost","root","","truequep6");
  checar_con($bd);
  if (iSSET($_COOKIE["usuBuscado"]))
      $id_usuario= $_COOKIE["usuBuscado"];
  else
      $id_usuario = dame_cookie();

  $perfil = array();
  $resp = mysqli_query($bd, "SELECT nomus, imagen FROM usuario WHERE id_usuario = $id_usuario");
  $perfil = mysqli_fetch_assoc($resp);
  mysqli_close($bd);
?>
