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

function checar_con($conex){//revisa conexión escribe en pantalla si hay error //testing
		if(!$conex){
			echo mysqli_connect_error();
			echo mysqli_connect_errno();
			exit();
		}
}
