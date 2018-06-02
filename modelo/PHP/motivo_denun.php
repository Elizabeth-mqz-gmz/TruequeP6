<?php
//motivo_denun.php
//obtener lo básico de la publicación para valorar si se debe eliminar
  include "funciones.php";

  $bd = mysqli_connect("localhost","root","","truequep6");

  $id = validar($_POST["id"],"",$bd);
  $tabla = validar($_POST["tabla"], "", $bd);

  if ($tabla == "1"){
    $bus = ("SELECT id_publicacion, id_autor, imagen_publi, publicacion FROM publicacion WHERE id_publicacion = $id ");
  }
  else {
    if ($tabla == "2")
      $bus = ("SELECT id_comen, id_usu_comen, comentario FROM comentario WHERE id_comen = $id ");
  }

  $resp = mysqli_query($bd, $bus);
  $bus = mysqli_fetch_assoc($resp);

  $contenido = array();
  $contenido = json_encode($bus);
  print_r($contenido); //obtenemos el contenido de la publicación

?>
