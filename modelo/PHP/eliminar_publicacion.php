<?php
  //eliminar publicación;
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $publicacion = validar($_POST["publicacion"], "", $bd);
  $usuario = validar ($_POST["usuario"], "", $bd);

  //$resp = mysqli_query($bd, "SELECT imagen_publi FROM publicacion WHERE id_publicacion = $publicacion");
  //$bus = mysqli_fetch_assoc($resp);
  //if ($bus["imagen_publi"] != null)
      //unlink("../".$bus["imagen_publi"]); //eliminar imagen del subdirectorio imagenes_pub
  //eliminar imagen publicacion

  mysqli_query($bd, "DELETE FROM publicacion WHERE id_publicacion = $publicacion"); //se elimino la publicación.

  $mensaje = "Quitamos tu publicación."; //notificación
  $bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, $mensaje)";
  mysqli_query($bd, $bus);

  echo "Se ha eliminado la publicación";

  mysqli_close($bd);

?>
