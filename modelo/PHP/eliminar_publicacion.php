<?php
  //eliminar publicación;
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $publicacion = validar($_POST["publicacion"], "", $bd);
  $usuario = validar ($_POST["usuario"], "", $bd);

  $bus = "SELECT imagen_publi FROM publicacion WHERE id_publicacion = $publicacion";
  $resp = mysqli_query($bd, $bus);
  $bus = mysqli_fetch_assoc($resp);
  unlink("../".$bus["imagen_publi"]); //eliminar imagen del subdirectorio imagenes_pub

  $bus = "DELETE FROM publicacion WHERE id_publicacion = $publicacion";
  mysqli_query($bd, $bus); //se elimino la publicación.

  $mensaje = "Quitamos tu publicación."; //notificación
  $bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, $mensaje)";
  mysqli_query($bd, $bus);

  echo "Se ha eliminado la publicación";

  mysqli_close($bd);

?>
