<?php
  //eliminar publicación;
  include "funciones.php";
  $bd = mysqli_connect("localhost", "root", "", "truequep6");
  checar_con($bd);

  $tabla = $_POST["tabla"];
  $publicacion = validar($_POST["publicacion"], "", $bd);
  $usuario = validar ($_POST["usuario"], "", $bd);

  //if($tabla = "publicaion"){
  //$resp = mysqli_query($bd, "SELECT imagen_publi FROM publicacion WHERE id_publicacion = $publicacion");
  //$bus = mysqli_fetch_assoc($resp);
  //if ($bus["imagen_publi"] != null)
      //unlink("../".$bus["imagen_publi"]); //eliminar imagen del subdirectorio imagenes_pub
  //eliminar imagen publicacion
  //}
  if ($tabla == "1")
    mysqli_query($bd, "DELETE FROM publicacion WHERE id_publicacion = $publicacion"); //se elimino la publicación.
  else {
    if($tabla == "2")
      mysqli_query($bd, "DELETE FROM comentario WHERE id_comen = $publicacion");
  }
  //mysqli_query($bd, $bus)

  $mensaje = "Quitamos tu publicación."; //notificación
  //$bus = "INSERT INTO notificacion (id_usu_not, men_not) VALUES ($usuario, $mensaje)";
  //mysqli_query($bd, $bus);

  echo "Se ha eliminado la publicación";

  mysqli_close($bd);

?>
