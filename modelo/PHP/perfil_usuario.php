<?php

  $bd = mysqli_connect("localhost","root","","truequep6");

  if(!$bd){
		echo mysqli_connect_error();
		echo mysqli_connect_errno();
    echo "no es posible conectarse con la base de datos";
		exit();
	}
  $id_usuario= 317341612;//Número de cuenta del usuario, obtener de session

  $perfil = array();
  $resp = mysqli_query($bd, "SELECT nomus, imagen FROM usuario WHERE id_usuario = $id_usuario");
  $perfil = mysqli_fetch_assoc($resp);

?>
