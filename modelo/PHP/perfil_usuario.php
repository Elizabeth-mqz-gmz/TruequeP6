<?php
  include "funciones.php";
  $bd = mysqli_connect("localhost","root","","truequep6");
  checar_con($bd);

  $id_usuario= 317341612;//Número de cuenta del usuario, obtener de session

  $perfil = array();
  $resp = mysqli_query($bd, "SELECT nomus, imagen FROM usuario WHERE id_usuario = $id_usuario");
  $perfil = mysqli_fetch_assoc($resp);

  // Obtener publicaciones :)

?>
