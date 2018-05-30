<?php

  $bd = mysqli_connect("localhost","root","","truequep6");

  if(!$bd){
		echo mysqli_connect_error();
		echo mysqli_connect_errno();
    echo "no es posible conectarse con la base de datos";
		exit();
	}
  $id_usuario= 317341612;
  $perfil = array();
  $bus = "SELECT nomus, imagen FROM usuario WHERE id_usuario = $id_usuario";
  $resp = mysqli_query($bd, $bus);
  $i = 0;
  $perfil = mysqli_fetch_assoc($resp);
  print_r($perfil);
  $perfil["imagen"]= str_replace("modelo", "", $perfil["imagen"]);

  echo "<img src='../".$perfil["imagen"]."' />";

  echo $perfil["nomus"];
?>
