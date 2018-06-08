<?php
  include "funciones.php";
  $bd = conexion();
  checar_con($bd);
  if (iSSET($_COOKIE["usuBuscado"])) //Checa si eso existe porque cuando le das buscar en js se crea la cookie, sólo si no se está buscando a él mismo
      $id_usuario= $_COOKIE["usuBuscado"];
  else
      $id_usuario = dame_cookie(); //Se busca a él  mismo

  $perfil = array(); //Seleccionar los datos del usuario
  $resp = mysqli_query($bd, "SELECT nomus, imagen FROM usuario WHERE id_usuario = $id_usuario");
  $perfil = mysqli_fetch_assoc($resp);
  mysqli_close($bd);
?>
