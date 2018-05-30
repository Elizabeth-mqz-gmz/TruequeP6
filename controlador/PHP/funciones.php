<?php
function validar ($pal,$regex){//Esta función recibe una palabra y una regex
      $pal=strip_tags($pal); //quitar las etiquetas
      $pal=mysqli_real_escape_string($conex,$pal); //quitar los comandos sql
      $val=preg_match($regex,$pal); //checar la coincidencia
      if ($regex != ""){
        if ($val==1)
          return $pal; //coincide con la regex, devuelve la cadena validada y segura
        else
          return false; //regresa falso porque no cumple con la regex
      }
      else
          return $pal;
}

function checar_con($conex){//revisa conexión escribe en pantalla si hay error 
		if(!$conex){
			echo mysqli_connect_error();
			echo mysqli_connect_errno();
			exit();
		}
}

function env_publi ($que,$usu){ //Despliega las publicaciones, si quieres solo las publicacaiones de un usuario $que = "perfil" Y $usu= num_cuenta
    $consul = "SELECT * FROM publicacion ";
    if ($que == "perfil")
      $consul = $consul."WHERE id_usuario = '$usu'";
    $consul =
    echo "<div class='publi'>";
      echo $consul;
    echo "</div>";
    return;
}
env_publi("perfil","317364741");
?>
